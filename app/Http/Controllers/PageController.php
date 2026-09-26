<?php

namespace App\Http\Controllers;

use App\Services\CaseStudyService;
use App\Services\PricingService;
use App\Services\TestimonialService;
use App\Services\MarTechService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

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
     * Build a $meta array for a view by merging the route's per-route meta
     * from config/seo.php with site-wide defaults, then overriding with
     * any explicit values passed in. Ensures every page gets:
     *   - title (page-specific)
     *   - description (page-specific)
     *   - keywords (page-specific or site-wide)
     *   - canonical (route URL)
     *   - og_url (canonical)
     *   - og_image (page-specific or site default)
     */
    protected function buildMeta(string $routeName, array $overrides = []): array
    {
        $routeMeta = config("seo.routes.{$routeName}", []);
        $defaults  = config('seo.defaults', []);

        $canonical = $overrides['canonical'] ?? route($routeName);
        $ogImage   = $overrides['og_image'] ?? ($defaults['og_image'] ?? asset('og-image.jpg'));

        return array_merge($defaults, $routeMeta, [
            'canonical' => $canonical,
            'og_url'    => $canonical,
            'og_image'  => $ogImage,
        ], $overrides);
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
        $meta = $this->buildMeta('home');
        return view('pages.home', compact('featuredStudies', 'stats', 'meta'));
    }

    /**
     * Services page — commerce
     * Patterns: Strategy sessions, Done-for-you builds, Monthly retainers, Add-ons
     */
    public function services()
    {
        $tiers = $this->pricingService->all();
        $meta = $this->buildMeta('services');
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
        $meta = $this->buildMeta('about');
        return view('pages.about', compact('testimonials', 'marTech', 'meta'));
    }

    /**
     * Contact page — capture
     */
    public function contact()
    {
        $meta = $this->buildMeta('contact');
        return view('pages.contact', compact('meta'));
    }

    /**
     * Demo Lab — experience
     * Patterns: Tabbed iframe viewer for all 6 demos
     */
    public function demos()
    {
        $demos = $this->caseStudyService->demos();
        $meta = $this->buildMeta('demos');
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
     * Sitemap — updated for multi-page architecture.
     *
     * Returns per-page priority + lastmod + image sitemap entries.
     * Lower-priority pages (legal, case-studies-coming-soon) get 0.3-0.5;
     * main marketing pages get 0.8; the home page gets 1.0.
     */
    public function sitemap()
    {
        $today = now()->toDateString();
        $site  = rtrim(config('app.url', 'https://chadadigital.com'), '/');

        $pages = [
            route('home')              => ['url' => route('home'),              'priority' => '1.0', 'changefreq' => 'weekly',  'lastmod' => $today, 'images' => [
                ['loc' => $site . '/og-image.jpg', 'title' => 'Chada Digital — Web Design, Automation, and Branding in Lagos', 'caption' => 'Chada Digital'],
            ]],
            route('services')          => ['url' => route('services'),            'priority' => '0.9', 'changefreq' => 'weekly',  'lastmod' => $today],
            route('about')             => ['url' => route('about'),              'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $today, 'images' => config('founder.real') ? [
                ['loc' => asset((string) config('founder.photo')), 'title' => 'Okeoma Joseph — Founder, Chada Digital', 'caption' => 'Founder portrait'],
            ] : []],
            route('contact')           => ['url' => route('contact'),            'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],
            route('demos')              => ['url' => route('demos'),              'priority' => '0.8', 'changefreq' => 'weekly',  'lastmod' => $today],
            route('case-studies.index') => ['url' => route('case-studies.index'), 'priority' => '0.5', 'changefreq' => 'weekly',  'lastmod' => $today],
            route('design-partner')     => ['url' => route('design-partner'),     'priority' => '0.5', 'changefreq' => 'monthly', 'lastmod' => $today],
            route('terms')              => ['url' => route('terms'),              'priority' => '0.3', 'changefreq' => 'yearly',  'lastmod' => $today],
            route('privacy')            => ['url' => route('privacy'),            'priority' => '0.3', 'changefreq' => 'yearly',  'lastmod' => $today],
            route('cookies')            => ['url' => route('cookies'),            'priority' => '0.3', 'changefreq' => 'yearly',  'lastmod' => $today],
        ];
        foreach ($this->caseStudyService->all() as $study) {
            $pages[route('case-study.show', $study['slug'])] = [
                'url' => route('case-study.show', $study['slug']),
                'priority' => '0.6',
                'changefreq' => 'monthly',
                'lastmod' => $today,
            ];
        }
        foreach ($this->caseStudyService->demos() as $demo) {
            $pages[route('preview.show', $demo['slug'])] = [
                'url' => route('preview.show', $demo['slug']),
                'priority' => '0.4',
                'changefreq' => 'monthly',
                'lastmod' => $today,
            ];
        }
        $content = view('pages.sitemap', compact('pages'))->render();
        return Response::make($content, 200, ['Content-Type' => 'application/xml']);
    }
}
