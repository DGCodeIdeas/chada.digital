<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * Demo Content Controller — serves demo files dynamically through Laravel.
 *
 * Why this exists: the production server (nginx) routes all requests through
 * Laravel's front controller. Direct file access to public/demos/*.html
 * returns 403 Forbidden because nginx doesn't have a location block that
 * serves static files from subdirectories of public/.
 *
 * This controller reads demo files (HTML, CSS, JS, images) from the filesystem
 * and streams them through Laravel's response system — bypassing the web
 * server's static-file restrictions entirely.
 *
 * Security:
 *   - Slug is validated against a hardcoded list of known demos
 *   - File path is resolved and checked to be within the demo's directory
 *     (prevents directory traversal attacks via ../ in the path)
 *   - Only files that exist and are readable are served
 *
 * Usage:
 *   /demo-content/apexflow           → serves demos/apexflow/index.html
 *   /demo-content/apexflow/assets/css/styles.css → serves that CSS file
 *   /demo-content/apexflow/pricing/  → serves demos/apexflow/pricing/index.html
 */
class DemoController extends Controller
{
    /**
     * The list of demo slugs that are allowed to be served.
     * Matches CaseStudyService::demos() — kept here as a separate constant
     * so the controller doesn't depend on the service being instantiated.
     */
    private const ALLOWED_SLUGS = [
        // Original 6 (kept for backward compatibility)
        'sterling-vale',
        'apexflow',
        'elysian',
        'hirebase',
        'noir',
        'timber-mill',
        // New 18 — real-world categories
        'bistro-noir',
        'lagoon-lounge',
        'suya-spot',
        'ade-oke-law',
        'meridian-accounting',
        'cityscape-architecture',
        'kente-collective',
        'tech-hub',
        'petal-and-stem',
        'vitalis-clinic',
        'zen-fitness',
        'pure-skin',
        'brightpath-academy',
        'codecraft-bootcamp',
        'lingua-lab',
        'lagos-realty',
        'zenith-homes',
        'green-acres-development',
    ];

    /**
     * Serve a file from the demos directory.
     *
     * @param string $slug The demo slug (e.g. 'apexflow')
     * @param string $path The path within the demo (e.g. 'assets/css/styles.css').
     *                     Defaults to 'index.html' when empty.
     */
    public function serve(Request $request, string $slug, string $path = 'index.html')
    {
        // 1. Validate the slug against the known list
        if (!in_array($slug, self::ALLOWED_SLUGS, true)) {
            abort(404, "Unknown demo: {$slug}");
        }

        // 2. If the path ends with /, treat it as a directory and serve index.html
        if (str_ends_with($path, '/')) {
            $path .= 'index.html';
        }

        // 3. If the path is empty, serve index.html
        if ($path === '' || $path === '/') {
            $path = 'index.html';
        }

        // 4. Build the full file path
        $demoBasePath = public_path("demos/{$slug}");
        $filePath = $demoBasePath . '/' . ltrim($path, '/');

        // 5. Resolve the real path and verify it's within the demo directory
        //    This prevents directory traversal attacks (e.g. ../../.env)
        $realFilePath = realpath($filePath);
        $realDemoPath = realpath($demoBasePath);

        if ($realFilePath === false || $realDemoPath === false) {
            abort(404, "File not found: {$path}");
        }

        // Verify the resolved path starts with the demo's base path
        if (!str_starts_with($realFilePath, $realDemoPath . '/') && $realFilePath !== $realDemoPath) {
            abort(403, "Access denied");
        }

        // 6. Verify it's a file (not a directory)
        if (!is_file($realFilePath)) {
            // If it's a directory, serve index.html from it
            $indexPath = $realFilePath . '/index.html';
            if (is_file($indexPath)) {
                $realFilePath = $indexPath;
            } else {
                abort(404, "File not found: {$path}");
            }
        }

        // 7. Determine the MIME type
        //    Use an explicit extension map first — mime_content_type() relies
        //    on the system's magic file database which can return wrong types
        //    (e.g. text/plain for .css, text/x-asm for .js on some systems).
        //    The extension map is authoritative for web content.
        $mimeType = self::getMimeType($realFilePath);

        // 8. For HTML files (index.html), inject a <base> tag so relative paths
        //    (assets/css/styles.css) resolve against /demo-content/{slug}/
        //    regardless of whether the URL has a trailing slash or not.
        //    This replaces the redirect approach which caused an infinite loop
        //    (nginx stripped the trailing slash from the Location header).
        if ($mimeType === 'text/html') {
            $html = file_get_contents($realFilePath);
            $baseTag = '<base href="/demo-content/' . $slug . '/">';
            // Inject after <head> or at the start of the document
            if (preg_match('/<head[^>]*>/i', $html)) {
                $html = preg_replace('/(<head[^>]*>)/i', '$1' . $baseTag, $html, 1);
            } else {
                $html = $baseTag . $html;
            }
            return response($html, 200, [
                'Content-Type' => 'text/html; charset=UTF-8',
                'Cache-Control' => 'public, max-age=3600',
                'X-Content-Type-Options' => 'nosniff',
            ]);
        }

        // 9. For non-HTML files (CSS, JS, images), stream directly
        return Response::file($realFilePath, [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'public, max-age=3600',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    /**
     * Get the MIME type for a file, using an explicit extension map first.
     * Falls back to mime_content_type() for unknown extensions.
     *
     * This is necessary because PHP's mime_content_type() uses the system's
     * libmagic database, which can return incorrect types:
     *   - .css files → text/plain (should be text/css)
     *   - .js files  → text/x-asm or text/plain (should be application/javascript)
     *   - .svg files → image/svg+xml (usually correct, but included for safety)
     *
     * The X-Content-Type-Options: nosniff header (set above) causes browsers
     * to reject responses where the MIME type doesn't match the expected type
     * for the resource — so a .css file served as text/plain gets blocked
     * with "MIME type mismatch" errors. This map ensures correct MIME types.
     */
    private static function getMimeType(string $filePath): string
    {
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        $mimeMap = [
            // HTML
            'html' => 'text/html',
            'htm'  => 'text/html',

            // Styles
            'css'  => 'text/css',

            // Scripts
            'js'   => 'application/javascript',
            'mjs'  => 'application/javascript',
            'json' => 'application/json',

            // Images
            'svg'  => 'image/svg+xml',
            'png'  => 'image/png',
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif'  => 'image/gif',
            'webp' => 'image/webp',
            'ico'  => 'image/x-icon',
            'avif' => 'image/avif',

            // Fonts
            'woff' => 'font/woff',
            'woff2' => 'font/woff2',
            'ttf'  => 'font/ttf',
            'otf'  => 'font/otf',
            'eot'  => 'application/vnd.ms-fontobject',

            // Documents
            'xml'  => 'application/xml',
            'txt'  => 'text/plain',
            'pdf'  => 'application/pdf',

            // Video
            'mp4'  => 'video/mp4',
            'webm' => 'video/webm',

            // Audio
            'mp3'  => 'audio/mpeg',
            'ogg'  => 'audio/ogg',
            'wav'  => 'audio/wav',
        ];

        // Use the explicit map if the extension is known
        if (isset($mimeMap[$extension])) {
            return $mimeMap[$extension];
        }

        // Fall back to the system's mime_content_type() for unknown extensions
        $fallback = mime_content_type($filePath);

        // If even the fallback fails, default to octet-stream (download)
        return $fallback !== false ? $fallback : 'application/octet-stream';
    }
}
