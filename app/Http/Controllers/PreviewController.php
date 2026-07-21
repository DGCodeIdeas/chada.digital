<?php
namespace App\Http\Controllers;

use App\Services\PreviewService;
use Illuminate\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class PreviewController extends Controller
{
    public function __construct(
        protected PreviewService $previewService
    ) {}

    public function show(string $slug): View|Response
    {
        $preview = $this->previewService->get($slug);
        if (!$preview) { abort(404); }

        $previewPath = public_path("demos/{$slug}");
        if (!File::exists($previewPath)) { abort(404); }

        return view('pages.preview', [
            'preview' => $preview,
            'slug' => $slug,
            'subpage' => null,
            'meta' => [
                'title' => "{$preview['title']} — Chada Digital Preview",
                'description' => $preview['description'],
                'canonical' => route('preview.show', $slug),
                'ogImage' => asset($preview['thumbnail']),
            ],
        ]);
    }

    public function subpage(string $slug, string $subpage): View|Response
    {
        $preview = $this->previewService->get($slug);
        if (!$preview) { abort(404); }

        $subpagePath = public_path("demos/{$slug}/{$subpage}");
        if (!File::exists($subpagePath)) {
            $subpagePath = public_path("demos/{$slug}/{$subpage}/index.html");
        }
        if (!File::exists($subpagePath)) { abort(404); }

        return view('pages.preview', [
            'preview' => $preview,
            'slug' => $slug,
            'subpage' => $subpage,
            'meta' => [
                'title' => "{$preview['title']} — Chada Digital Preview",
                'description' => $preview['description'],
                'canonical' => route('preview.subpage', ['slug' => $slug, 'subpage' => $subpage]),
                'ogImage' => asset($preview['thumbnail']),
            ],
        ]);
    }
}