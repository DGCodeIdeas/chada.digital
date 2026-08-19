<?php

namespace App\Http\Controllers;

use App\Services\CaseStudyService;
use Illuminate\View\View;

class CaseStudyController extends Controller
{
    public function __construct(
        protected CaseStudyService $caseStudyService
    ) {}

    public function index(): View
    {
        return view('pages.work', [
            'studies' => $this->caseStudyService->collection(),
            'meta' => [
                'title' => 'Work — Chada Digital',
                'canonical' => route('work'),
                'ogImage' => asset('og-image.jpg'),
            ],
        ]);
    }

    public function show(string $slug): View
    {
        $study = $this->caseStudyService->get($slug);
        if (! $study) {
            abort(404);
        }

        return view('pages.case-study', [
            'slug' => $slug,
            'study' => $study,
            'meta' => [
                'title' => $study['client'].' — Chada Digital',
                'canonical' => route('case-study.show', $slug),
                'ogImage' => asset($study['thumbnail']),
            ],
        ]);
    }
}
