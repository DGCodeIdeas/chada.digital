<?php

namespace App\Http\Controllers;

use App\Services\CaseStudyService;
use App\Services\PricingService;
use App\Services\TestimonialService;
use App\Services\MarTechService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PageController extends Controller
{
    protected $caseStudyService;
    protected $pricingService;
    protected $testimonialService;
    protected $marTechService;

    public function __construct(
        CaseStudyService $caseStudyService,
        PricingService $pricingService,
        TestimonialService $testimonialService,
        MarTechService $marTechService
    ) {
        $this->caseStudyService = $caseStudyService;
        $this->pricingService = $pricingService;
        $this->testimonialService = $testimonialService;
        $this->marTechService = $marTechService;
    }

    /**
     * Home page — conversion hub
     * Patterns: Hero, Stats, Trust, Tiers, Consult, Process, Services, Webinar
     */
    public function home()
    {
        // LOCKED (Sep 1, 2026): Case studies are behind "Coming Soon".
        // Pass an empty collection so the homepage featured section hides
        // entirely (the @if($featuredStudies->isNotEmpty()) guard in
        // home.blade.php handles the hide). No fabricated metrics ship.
        // To unlock: restore $this->caseStudyService->featured(3)
        $featuredStudies = collect([]);
        $stats = $this->caseStudyService->stats();
        $meta = [
            'title' => 'Chada Digital — Digital Solutions That Help Businesses Grow',
            'description' => 'Web development, funnel automation, paid advertising, and brand strategy for startups, SMEs, and enterprises in Nigeria.',
            'og_image' => asset('og-image.jpg'),
        ];
        return view('pages.home', compact('featuredStudies', 'stats', 'meta'));
    }

    /**
     * Services page — commerce
     * Patterns: Strategy sessions, Done-for-you builds, Monthly retainers, Add-ons
     */
    public function services()
    {
        $tiers = $this->pricingService->all();
        $meta = [
            'title' => 'Services & Pricing — Chada Digital',
            'description' => 'Strategy sessions, done-for-you builds, and monthly retainers. Transparent pricing for web development, automation, and advertising.',
            'og_image' => asset('og-image.jpg'),
        ];
        return view('pages.services', compact('tiers', 'meta'));
    }

    /**
     * About page — trust
     * Patterns: Testimonials, Standards band, MarTech grid, Founder bio, Exclusivity CTA
     */
    public function about()
    {
        $testimonials = $this->testimonialService->all();
        $marTech = $this->marTechService->all();
        $meta = [
            'title' => 'About — Chada Digital',
            'description' => 'Meet the team behind Chada Digital. We build digital systems that generate revenue, not just websites.',
            'og_image' => asset('og-image.jpg'),
        ];
        return view('pages.about', compact('testimonials', 'marTech', 'meta'));
    }

    /**
     * Contact page — capture
     */
    public function contact()
    {
        $meta = [
            'title' => 'Contact — Chada Digital',
            'description' => 'Start a project, book a consultation, or ask a question. We reply within 24 hours.',
            'og_image' => asset('og-image.jpg'),
        ];
        return view('pages.contact', compact('meta'));
    }

    /**
     * Demo Lab — experience
     * Patterns: Tabbed iframe viewer for all 6 demos
     */
    public function demos()
    {
        $demos = $this->caseStudyService->demos();
        $meta = [
            'title' => 'Demo Lab — Chada Digital',
            'description' => 'Explore live demos of our work. See the systems we build in action.',
            'og_image' => asset('og-image.jpg'),
        ];
        return view('pages.demos', compact('demos', 'meta'));
    }

    /**
     * Preview system — PRESERVED. Do not modify.
     */
    public function preview($slug)
    {
        $project = $this->caseStudyService->findDemo($slug);
        if (!$project) {
            abort(404);
        }
        $meta = [
            'title' => $project['title'] . ' — Live Preview | Chada Digital',
            'description' => 'Live interactive preview of ' . $project['title'] . '.',
        ];
        return view('pages.preview', compact('project', 'meta'));
    }

    public function previewSubpage($slug, $subpage)
    {
        $project = $this->caseStudyService->findDemo($slug);
        if (!$project) {
            abort(404);
        }
        $meta = [
            'title' => $project['title'] . ' — ' . ucfirst($subpage) . ' | Chada Digital',
            'description' => 'Live interactive preview of ' . $project['title'] . ' — ' . $subpage . ' page.',
        ];
        return view('pages.preview', compact('project', 'meta', 'subpage'));
    }

    /**
     * Sitemap — updated for multi-page architecture
     */
    public function sitemap()
    {
        $pages = [
            route('home'),
            route('case-studies.index'),
            route('services'),
            route('about'),
            route('contact'),
            route('demos'),
        ];
        foreach ($this->caseStudyService->all() as $study) {
            $pages[] = route('case-study.show', $study['slug']);
        }
        foreach ($this->caseStudyService->demos() as $demo) {
            $pages[] = route('preview.show', $demo['slug']);
        }
        $content = view('pages.sitemap', compact('pages'))->render();
        return Response::make($content, 200, ['Content-Type' => 'application/xml']);
    }
}
