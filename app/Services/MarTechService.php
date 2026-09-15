<?php

namespace App\Services;

/**
 * MarTech integrations data — tools we use
 *
 * Each tool entry is an associative array with keys:
 *   - 'name'  (string) — display label
 *   - 'brand' (string|null) — Font Awesome BRAND slug (rendered as <i class="fab fa-{slug}">).
 *     Null when FA doesn't ship a brand logo for the tool.
 *   - 'icon'  (string) — Font Awesome SOLID slug (rendered as <i class="fas fa-{slug}">).
 *     Used as a fallback when 'brand' is null.
 *
 * All FA brand and solid slugs were verified against the live Font Awesome
 * 6.7.2 CSS at https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6/css/.
 *
 * Brands not in FA Free (Paystack, Flutterwave, Klaviyo, ActiveCampaign,
 * ManyChat, Adobe XD, Vercel, Plausible, PostHog, Brevo, Zapier, Make, n8n,
 * SEMrush, DigitalOcean, Mixpanel, Framer, WooCommerce, GitHub Actions)
 * fall back to a Font Awesome solid icon. LinkedIn is now in FA (was removed
 * from Simple Icons), so the about page actually gains a brand logo for it.
 */
class MarTechService
{
    public function all(): array
    {
        return [
            [
                'category' => 'Payments',
                'icon' => 'fa-credit-card',
                'tools' => [
                    ['name' => 'Paystack',    'brand' => null,     'icon' => 'fa-credit-card'],
                    ['name' => 'Flutterwave', 'brand' => null,     'icon' => 'fa-money-bill-wave'],
                    ['name' => 'Stripe',      'brand' => 'stripe', 'icon' => 'fa-credit-card'],
                ],
            ],
            [
                'category' => 'Analytics',
                'icon' => 'fa-chart-line',
                'tools' => [
                    ['name' => 'Google Analytics 4', 'brand' => 'google', 'icon' => 'fa-chart-line'],
                    ['name' => 'Mixpanel',            'brand' => null,     'icon' => 'fa-chart-simple'],
                    ['name' => 'Hotjar',              'brand' => 'hotjar', 'icon' => 'fa-chart-line'],
                    ['name' => 'Plausible',           'brand' => null,     'icon' => 'fa-chart-line'],
                ],
            ],
            [
                'category' => 'CRM & Email',
                'icon' => 'fa-users',
                'tools' => [
                    ['name' => 'HubSpot',         'brand' => 'hubspot',   'icon' => 'fa-users'],
                    ['name' => 'Mailchimp',       'brand' => 'mailchimp', 'icon' => 'fa-envelope'],
                    ['name' => 'Klaviyo',         'brand' => null,        'icon' => 'fa-envelope'],
                    ['name' => 'ActiveCampaign',  'brand' => null,        'icon' => 'fa-paper-plane'],
                ],
            ],
            [
                'category' => 'Advertising',
                'icon' => 'fa-bullhorn',
                'tools' => [
                    ['name' => 'Meta Ads Manager',          'brand' => 'meta',     'icon' => 'fa-bullhorn'],
                    ['name' => 'Google Ads',                'brand' => 'google',   'icon' => 'fa-bullhorn'],
                    ['name' => 'LinkedIn Campaign Manager', 'brand' => 'linkedin', 'icon' => 'fa-bullhorn'],
                    ['name' => 'TikTok Ads',                'brand' => 'tiktok',   'icon' => 'fa-bullhorn'],
                ],
            ],
            [
                'category' => 'Automation',
                'icon' => 'fa-bolt',
                'tools' => [
                    ['name' => 'Zapier',            'brand' => null, 'icon' => 'fa-bolt'],
                    ['name' => 'Make (Integromat)', 'brand' => null, 'icon' => 'fa-gears'],
                    ['name' => 'ManyChat',          'brand' => null, 'icon' => 'fa-comments'],
                    ['name' => 'n8n',               'brand' => null, 'icon' => 'fa-diagram-project'],
                ],
            ],
            [
                'category' => 'CMS & E-Commerce',
                'icon' => 'fa-cart-shopping',
                'tools' => [
                    ['name' => 'Laravel',     'brand' => 'laravel',   'icon' => 'fa-cart-shopping'],
                    ['name' => 'WordPress',   'brand' => 'wordpress', 'icon' => 'fa-cart-shopping'],
                    ['name' => 'Shopify',     'brand' => 'shopify',   'icon' => 'fa-cart-shopping'],
                    ['name' => 'WooCommerce', 'brand' => null,        'icon' => 'fa-bag-shopping'],
                ],
            ],
            [
                'category' => 'Design & Prototyping',
                'icon' => 'fa-pen-nib',
                'tools' => [
                    ['name' => 'Figma',    'brand' => 'figma', 'icon' => 'fa-pen-nib'],
                    ['name' => 'Adobe XD', 'brand' => null,    'icon' => 'fa-pen-ruler'],
                    ['name' => 'Sketch',   'brand' => 'sketch','icon' => 'fa-pen-nib'],
                    ['name' => 'Framer',   'brand' => null,    'icon' => 'fa-window-restore'],
                ],
            ],
            [
                'category' => 'Infrastructure',
                'icon' => 'fa-server',
                'tools' => [
                    ['name' => 'AWS',             'brand' => 'aws',         'icon' => 'fa-server'],
                    ['name' => 'DigitalOcean',   'brand' => null,          'icon' => 'fa-water'],
                    ['name' => 'Cloudflare',      'brand' => 'cloudflare',  'icon' => 'fa-shield-halved'],
                    ['name' => 'GitHub Actions',  'brand' => 'github',      'icon' => 'fa-code-branch'],
                ],
            ],
        ];
    }
}
