<?php

namespace App\Services;

/**
 * MarTech integrations data — tools we use
 */
class MarTechService
{
    public function all(): array
    {
        return [
            [
                'category' => 'Payments',
                'tools' => ['Paystack', 'Flutterwave', 'Stripe'],
                'icon' => 'credit-card',
            ],
            [
                'category' => 'Analytics',
                'tools' => ['Google Analytics 4', 'Mixpanel', 'Hotjar', 'Plausible'],
                'icon' => 'bar-chart',
            ],
            [
                'category' => 'CRM & Email',
                'tools' => ['HubSpot', 'Mailchimp', 'Klaviyo', 'ActiveCampaign'],
                'icon' => 'users',
            ],
            [
                'category' => 'Advertising',
                'tools' => ['Meta Ads Manager', 'Google Ads', 'LinkedIn Campaign Manager', 'TikTok Ads'],
                'icon' => 'megaphone',
            ],
            [
                'category' => 'Automation',
                'tools' => ['Zapier', 'Make (Integromat)', 'ManyChat', 'n8n'],
                'icon' => 'zap',
            ],
            [
                'category' => 'CMS & E-Commerce',
                'tools' => ['Laravel', 'WordPress', 'Shopify', 'WooCommerce'],
                'icon' => 'shopping-cart',
            ],
            [
                'category' => 'Design & Prototyping',
                'tools' => ['Figma', 'Adobe XD', 'Sketch', 'Framer'],
                'icon' => 'pen-tool',
            ],
            [
                'category' => 'Infrastructure',
                'tools' => ['AWS', 'DigitalOcean', 'Cloudflare', 'GitHub Actions'],
                'icon' => 'server',
            ],
        ];
    }
}
