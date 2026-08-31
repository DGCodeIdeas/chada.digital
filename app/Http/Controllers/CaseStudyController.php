<?php

namespace App\Http\Controllers;

use App\Services\CaseStudyService;
use Illuminate\Http\Request;

class CaseStudyController extends Controller
{
    protected $caseStudyService;

    public function __construct(CaseStudyService $caseStudyService)
    {
        $this->caseStudyService = $caseStudyService;
    }

    /**
     * Case Studies index — filterable grid
     *
     * V5 GATE MODEL (restored Aug 31, 2026): the index page filters by
     * 'published' => true. All 6 entries currently have 'published' => false,
     * so this page shows the empty state ("No case studies found in that
     * category") until the Founder verifies at least one. See
     * FOUNDER_CHECKLIST.md row 1 + CaseStudyService::featured().
     */
    public function index(Request $request)
    {
        $category = $request->get('category', 'all');
        $studies = $category === 'all'
            ? $this->caseStudyService->all()->where('published', true)
            : $this->caseStudyService->byCategory($category)->where('published', true);

        $categories = $this->caseStudyService->categories();
        $meta = [
            'title' => 'Case Studies — Chada Digital',
            'description' => 'Real results for real businesses. Explore our portfolio of web development, automation, and advertising projects.',
            'og_image' => asset('og-image.jpg'),
        ];
        return view('pages.case-studies', compact('studies', 'categories', 'category', 'meta'));
    }

    /**
     * Individual case study detail page
     */
    public function show($slug)
    {
        $study = $this->caseStudyService->find($slug);
        if (!$study) {
            abort(404);
        }
        $related = $this->caseStudyService->related($slug, 3);
        $meta = [
            'title' => $study['client'] . ' — Case Study | Chada Digital',
            'description' => $study['excerpt'],
            'og_image' => $study['og_image'] ?? asset('og-image.jpg'),
        ];
        return view('pages.case-study', compact('study', 'related', 'meta'));
    }
}
