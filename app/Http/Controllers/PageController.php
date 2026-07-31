<?php

namespace App\Http\Controllers;

use App\Services\PreviewService;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(
        protected PreviewService $previewService
    ) {}

    public function home(): View
    {
        return view('pages.home', [
            'meta' => [
                'title' => 'Chada Digital — Digital Solutions That Scale Businesses',
                'description' => 'We engineer high-performance websites, command-attention brands, and intelligent automation for ambitious teams across Nigeria and beyond.',
                'canonical' => route('home'),
                'ogImage' => asset('og-image.jpg'),
            ],
        ]);
    }

    public function showcase(): View
    {
        return view('pages.showcase', [
            'meta' => [
                'title' => 'Chada Digital — Digital Solutions That Scale Businesses',
                'description' => 'A selection of recent work across industries and use cases.',
                'canonical' => route('showcase'),
                'ogImage' => asset('og-image.jpg'),
            ],
        ]);
    }

    public function sitemap(): Response
    {
        $urls = [
            ['loc' => route('home'), 'changefreq' => 'weekly', 'priority' => '1.0'],
            ['loc' => route('showcase'), 'changefreq' => 'weekly', 'priority' => '0.9'],
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
