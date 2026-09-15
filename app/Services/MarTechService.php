<?php

namespace App\Services;

/**
 * MarTech integrations data — tools we use
 *
 * Each tool entry is an associative array with keys:
 *   - 'name'  (string) — display label
 *   - 'brand' (string|null) — Simple Icons slug (https://simpleicons.org)
 *     used to render the brand logo via the `si si-{slug}` webfont class.
 *     Null when the brand isn't shipped by Simple Icons (e.g. AWS,
 *     Paystack, Flutterwave) — in that case the view renders just the
 *     text label with no icon.
 */
class MarTechService
{
    public function all(): array
    {
        return [
            [
                'category' => 'Payments',
                'icon' => 'credit-card',
                'tools' => [
                    ['name' => 'Paystack',    'brand' => null],
                    ['name' => 'Flutterwave', 'brand' => null],
                    ['name' => 'Stripe',      'brand' => 'stripe'],
                ],
            ],
            [
                'category' => 'Analytics',
                'icon' => 'bar-chart',
                'tools' => [
                    ['name' => 'Google Analytics 4', 'brand' => 'googleanalytics'],
                    ['name' => 'Mixpanel',           'brand' => 'mixpanel'],
                    ['name' => 'Hotjar',             'brand' => 'hotjar'],
                    ['name' => 'Plausible',          'brand' => 'plausibleanalytics'],
                ],
            ],
            [
                'category' => 'CRM & Email',
                'icon' => 'users',
                'tools' => [
                    ['name' => 'HubSpot',         'brand' => 'hubspot'],
                    ['name' => 'Mailchimp',       'brand' => 'mailchimp'],
                    // Klaviyo / ActiveCampaign — no SI slug available
                    ['name' => 'Klaviyo',         'brand' => null],
                    ['name' => 'ActiveCampaign',  'brand' => null],
                ],
            ],
            [
                'category' => 'Advertising',
                'icon' => 'megaphone',
                'tools' => [
                    ['name' => 'Meta Ads Manager',          'brand' => 'meta'],
                    ['name' => 'Google Ads',                'brand' => 'googleads'],
                    // LinkedIn — removed from Simple Icons at LinkedIn's request
                    ['name' => 'LinkedIn Campaign Manager', 'brand' => null],
                    ['name' => 'TikTok Ads',                'brand' => 'tiktok'],
                ],
            ],
            [
                'category' => 'Automation',
                'icon' => 'zap',
                'tools' => [
                    ['name' => 'Zapier',         'brand' => 'zapier'],
                    ['name' => 'Make (Integromat)', 'brand' => 'make'],
                    // ManyChat — no SI slug available
                    ['name' => 'ManyChat',       'brand' => null],
                    ['name' => 'n8n',            'brand' => 'n8n'],
                ],
            ],
            [
                'category' => 'CMS & E-Commerce',
                'icon' => 'shopping-cart',
                'tools' => [
                    ['name' => 'Laravel',     'brand' => 'laravel'],
                    ['name' => 'WordPress',   'brand' => 'wordpress'],
                    ['name' => 'Shopify',     'brand' => 'shopify'],
                    ['name' => 'WooCommerce', 'brand' => 'woocommerce'],
                ],
            ],
            [
                'category' => 'Design & Prototyping',
                'icon' => 'pen-tool',
                'tools' => [
                    ['name' => 'Figma',     'brand' => 'figma'],
                    // Adobe XD — removed from Simple Icons
                    ['name' => 'Adobe XD',  'brand' => null],
                    ['name' => 'Sketch',    'brand' => 'sketch'],
                    ['name' => 'Framer',    'brand' => 'framer'],
                ],
            ],
            [
                'category' => 'Infrastructure',
                'icon' => 'server',
                'tools' => [
                    ['name' => 'AWS',            'brand' => null],
                    ['name' => 'DigitalOcean',  'brand' => 'digitalocean'],
                    ['name' => 'Cloudflare',    'brand' => 'cloudflare'],
                    ['name' => 'GitHub Actions','brand' => 'githubactions'],
                ],
            ],
        ];
    }
}
