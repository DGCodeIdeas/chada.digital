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
     * Case Studies index — LOCKED behind "Coming Soon" (Sep 1, 2026).
     *
     * All case study content is gated until the Founder verifies each entry's
     * metric + narrative. The page shows a "Coming Soon" message with the 6
     * demo project names listed as "in progress" — no fabricated metrics,
     * no fake narratives, no unverifiable claims.
     *
     * To unlock: remove this method's early return and restore the original
     * index logic (filter by published=true when CaseStudyService gates are
     * intact). See FOUNDER_CHECKLIST.md row 1.
     */
    public function index(Request $request)
    {
        $meta = [
            'title'       => 'Case Studies Coming Soon | Chada Digital',
            'description' => 'Detailed case studies for each of our demo projects are being prepared. Each will include the full workflow, tech stack, and verified business outcomes.',
            'og_image'    => asset('og-image.jpg'),
            'canonical'   => route('case-studies.index'),
            'og_url'      => route('case-studies.index'),
        ];
        return view('pages.case-studies', compact('meta'));
    }

    /**
     * Individual case study detail page — LOCKED (Sep 1, 2026).
     *
     * Redirects to the Coming Soon index page instead of showing fabricated
     * content or returning a 404. The user sees the "Coming Soon" message
     * regardless of which slug they try to access.
     *
     * To unlock: restore the original show() logic that calls
     * CaseStudyService::find($slug) and renders pages.case-study.
     */
    public function show($slug)
    {
        return redirect()->route('case-studies.index');
    }
}
