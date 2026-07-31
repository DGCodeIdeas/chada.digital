<?php

namespace App\Services;

use Illuminate\Support\Collection;

class PreviewService
{
    public function all(): array
    {
        return [
            'apexflow' => [
                'title' => 'ApexFlow',
                'description' => 'SaaS Platform — AI Automation',
                'thumbnail' => '/assets/images/project-apexflow.jpg',
                'category' => 'SaaS',
            ],
            'elysian' => [
                'title' => 'ELYSIAN',
                'description' => 'Booking — Hotel & Spa',
                'thumbnail' => '/assets/images/project-elysian.jpg',
                'category' => 'Booking',
            ],
            'hirebase' => [
                'title' => 'HIREBASE',
                'description' => 'Recruitment — Job Board Platform',
                'thumbnail' => '/assets/images/project-hirebase.jpg',
                'category' => 'Recruitment',
            ],
            'noir' => [
                'title' => 'NOIR',
                'description' => 'E-Commerce — Fashion Store',
                'thumbnail' => '/assets/images/project-noir.jpg',
                'category' => 'E-commerce',
            ],
            'sterling-vale' => [
                'title' => 'Sterling & Vale',
                'description' => 'Construction Firm — Corporate Website',
                'thumbnail' => '/assets/images/project-sterling.jpg',
                'category' => 'Construction',
            ],
            'timber-mill' => [
                'title' => 'TimberMill',
                'description' => 'Bespoke Furniture — Artisan Woodworking Studio',
                'thumbnail' => '/assets/images/project-timbermill.jpg',
                'category' => 'Artisan',
            ],
        ];
    }

    public function exists(string $slug): bool
    {
        return array_key_exists($slug, $this->all());
    }

    public function get(string $slug): ?array
    {
        return $this->all()[$slug] ?? null;
    }

    public function collection(): Collection
    {
        return collect($this->all());
    }
}
