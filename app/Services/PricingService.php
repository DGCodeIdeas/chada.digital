<?php

namespace App\Services;

/**
 * Services & Pricing data — gated.
 *
 * All prices are null until the Founder sets real ones (or confirms "Contact
 * for pricing" as the permanent answer for a tier). Views render the
 * "Contact for pricing" fallback when price is null — see services.blade.php.
 *
 * V4 MODEL (restored Aug 31, 2026): fabricated Naira prices (₦70K → ₦1.5M)
 * were replaced with null. Pricing without Founder sign-off is fabricated
 * data — if a prospect books expecting ₦70K and the real price is ₦150K,
 * that's a bad-faith price display.
 *
 * The single exception: Enterprise System keeps 'price' => 'Custom'
 * (legitimate — "quote-based" is the correct permanent answer for that tier).
 *
 * See: FOUNDER_CHECKLIST.md row 3 (pricing)
 *      TODO-Placeholders.md §10 (/services pricing tiers)
 */
class PricingService
{
    public function all(): array
    {
        return [
            'strategy' => [
                'title' => 'Strategy Sessions',
                'description' => 'One-time deep-dive sessions to audit, plan, or prototype your next move.',
                'tiers' => [
                    [
                        'name' => 'Funnel Audit',
                        'price' => null,
                        'price_note' => 'one-time',
                        'description' => 'Full audit of your existing funnel. We identify leaks, bottlenecks, and quick wins.',
                        'features' => ['Funnel map analysis', 'Conversion rate review', '3-page written report', '30-min video walkthrough'],
                        'cta' => 'Book Audit',
                        'highlight' => false,
                    ],
                    [
                        'name' => 'Brand Strategy Sprint',
                        'price' => null,
                        'price_note' => 'one-time',
                        'description' => '2-week intensive to define positioning, messaging, and visual direction.',
                        'features' => ['Competitive analysis', 'Customer persona mapping', 'Brand voice guide', 'Visual mood board'],
                        'cta' => 'Start Sprint',
                        'highlight' => false,
                    ],
                    [
                        'name' => 'Technical Architecture Review',
                        'price' => null,
                        'price_note' => 'one-time',
                        'description' => 'Enterprise-grade review of your stack, security, and scalability.',
                        'features' => ['Codebase audit', 'Security assessment', 'Scalability roadmap', '60-min executive presentation'],
                        'cta' => 'Book Review',
                        'highlight' => false,
                    ],
                ],
            ],
            'build' => [
                'title' => 'Done-For-You Builds',
                'description' => 'We design, build, and launch your entire system. One fixed price.',
                'tiers' => [
                    [
                        'name' => 'Landing Page + Funnel',
                        'price' => null,
                        'price_note' => 'one-time',
                        'description' => 'High-converting landing page with integrated payment and email capture.',
                        'features' => ['Custom design', 'Mobile-responsive', 'Payment integration', 'Email automation setup'],
                        'cta' => 'Start Build',
                        'highlight' => false,
                    ],
                    [
                        'name' => 'Small Business Website',
                        'price' => null,
                        'price_note' => 'one-time',
                        'description' => '5-page business website with CMS, contact forms, and basic SEO.',
                        'features' => ['5 custom pages', 'CMS integration', 'Contact form + CRM', 'Basic SEO setup'],
                        'cta' => 'Start Build',
                        'highlight' => false,
                    ],
                    [
                        'name' => 'E-Commerce Store',
                        'price' => null,
                        'price_note' => 'one-time',
                        'description' => 'Full Shopify or WooCommerce store with payment, shipping, and inventory.',
                        'features' => ['Up to 50 products', 'Payment gateway setup', 'Shipping integration', 'Inventory management'],
                        'cta' => 'Start Build',
                        'highlight' => true,
                    ],
                    [
                        'name' => 'SaaS MVP',
                        'price' => null,
                        'price_note' => 'one-time',
                        'description' => 'Minimum viable product: auth, dashboard, core features, and deployment.',
                        'features' => ['User authentication', 'Admin dashboard', 'Core feature set', 'Deployment + CI/CD'],
                        'cta' => 'Start Build',
                        'highlight' => false,
                    ],
                    [
                        'name' => 'Enterprise System',
                        'price' => 'Custom',
                        'price_note' => 'quote',
                        'description' => 'Custom ERP, CRM, or internal tool. We scope, quote, and deliver.',
                        'features' => ['Full requirements gathering', 'Custom architecture', 'Dedicated team', 'Ongoing support option'],
                        'cta' => 'Request Quote',
                        'highlight' => false,
                    ],
                ],
            ],
            'retainer' => [
                'title' => 'Monthly Retainers',
                'description' => 'Ongoing growth partnership. We manage, optimise, and scale your digital presence.',
                'tiers' => [
                    [
                        'name' => 'Growth Starter',
                        'price' => null,
                        'price_note' => '/month',
                        'description' => 'Essential maintenance + monthly optimisation for small businesses.',
                        'features' => ['Website maintenance', 'Monthly performance report', '2 hours of changes', 'Email support'],
                        'cta' => 'Start Retainer',
                        'highlight' => false,
                    ],
                    [
                        'name' => 'Growth Pro',
                        'price' => null,
                        'price_note' => '/month',
                        'description' => 'Full-funnel management: ads, landing pages, email, and automation.',
                        'features' => ['Everything in Starter', 'Ad campaign management', 'Landing page A/B testing', 'Weekly optimisation sprints', 'Slack access'],
                        'cta' => 'Start Retainer',
                        'highlight' => true,
                    ],
                    [
                        'name' => 'Growth Elite',
                        'price' => null,
                        'price_note' => '/month',
                        'description' => 'Dedicated team. We act as your in-house digital department.',
                        'features' => ['Everything in Pro', 'Dedicated account manager', 'Unlimited changes', 'Priority support', 'Quarterly strategy reviews'],
                        'cta' => 'Start Retainer',
                        'highlight' => false,
                    ],
                ],
            ],
            'addons' => [
                'title' => 'Add-On Services',
                'description' => 'Bolt these onto any build or retainer.',
                'tiers' => [
                    [
                        'name' => 'SEO Content Package',
                        'price' => null,
                        'price_note' => '/month',
                        'description' => '4 blog posts + on-page optimisation + backlink outreach.',
                        'features' => ['4 SEO-optimised articles', 'Keyword research', 'On-page technical SEO', 'Monthly ranking report'],
                        'cta' => 'Add On',
                        'highlight' => false,
                    ],
                    [
                        'name' => 'Meta Ads Management',
                        'price' => null,
                        'price_note' => '/month + ad spend',
                        'description' => 'Full Meta Ads management: creative, targeting, optimisation, reporting.',
                        'features' => ['Ad creative design', 'Audience targeting', 'A/B testing', 'Weekly performance reports'],
                        'cta' => 'Add On',
                        'highlight' => false,
                    ],
                    [
                        'name' => 'Google Ads Management',
                        'price' => null,
                        'price_note' => '/month + ad spend',
                        'description' => 'Search + Display campaign management with conversion tracking.',
                        'features' => ['Keyword research', 'Ad copywriting', 'Conversion tracking', 'Monthly optimisation report'],
                        'cta' => 'Add On',
                        'highlight' => false,
                    ],
                    [
                        'name' => 'Chatbot + Automation',
                        'price' => null,
                        'price_note' => 'one-time setup + ₦70,000/month',
                        'description' => 'ManyChat or WhatsApp Business API automation with CRM integration.',
                        'features' => ['Conversation flow design', 'CRM integration', 'Lead qualification', 'Monthly flow optimisation'],
                        'cta' => 'Add On',
                        'highlight' => false,
                    ],
                ],
            ],
        ];
    }
}
