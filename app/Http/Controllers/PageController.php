<?php

namespace App\Http\Controllers;

use App\Services\CaseStudyService;
use App\Services\PreviewService;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(
        protected PreviewService $previewService,
        protected CaseStudyService $caseStudyService
    ) {}

    public function home(): View
    {
        return view('pages.home', [
            'studies' => $this->caseStudyService->collection(),
            'meta' => [
                'title' => 'Chada Digital — Digital Solutions That Scale Businesses',
                'description' => 'We engineer high-performance websites, command-attention brands, and intelligent automation for ambitious teams across Nigeria and beyond.',
                'canonical' => route('home'),
                'ogImage' => asset('og-image.jpg'),
            ],
        ]);
    }

    public function sitemap(): Response
    {
        $urls = [
            ['loc' => route('home'), 'changefreq' => 'weekly', 'priority' => '1.0'],
        ];

        foreach ($this->previewService->all() as $slug => $preview) {
            $urls[] = [
                'loc' => route('preview.show', $slug),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ];
        }

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
