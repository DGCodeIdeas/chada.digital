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
        'sterling-vale',
        'apexflow',
        'elysian',
        'hirebase',
        'noir',
        'timber-mill',
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
        $mimeType = mime_content_type($realFilePath);

        // 8. Stream the file with appropriate headers
        return Response::file($realFilePath, [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'public, max-age=3600',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
