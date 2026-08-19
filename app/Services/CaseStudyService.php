<?php

namespace App\Services;

use Illuminate\Support\Collection;

class CaseStudyService
{
    public function all(): array
    {
        return [
            'case-study-a' => [
                'client' => 'Placeholder Client A',
                'industry' => 'Placeholder Industry',
                'category' => 'Web Development',
                'metric' => 'Placeholder — pending Ops (see Open_Decision.md Q2)',
                'metric_label' => 'Result Pending',
                'tags' => ['Placeholder'],
                'excerpt' => 'Placeholder excerpt — do not publish live.',
                'thumbnail' => '/assets/images/case-study-placeholder.jpg',
                'workflow' => [['step' => 'Placeholder Step', 'tool' => 'Placeholder Tool']],
                'challenge' => 'Placeholder.',
                'solution' => 'Placeholder.',
                'results' => 'Placeholder.',
                'tools' => ['Placeholder'],
            ],
            'case-study-b' => [
                'client' => 'Placeholder Client B',
                'industry' => 'Placeholder Industry',
                'category' => 'Funnels',
                'metric' => 'Placeholder — pending Ops (see Open_Decision.md Q2)',
                'metric_label' => 'Result Pending',
                'tags' => ['Placeholder'],
                'excerpt' => 'Placeholder excerpt — do not publish live.',
                'thumbnail' => '/assets/images/case-study-placeholder.jpg',
                'workflow' => [['step' => 'Placeholder Step', 'tool' => 'Placeholder Tool']],
                'challenge' => 'Placeholder.',
                'solution' => 'Placeholder.',
                'results' => 'Placeholder.',
                'tools' => ['Placeholder'],
            ],
            'case-study-c' => [
                'client' => 'Placeholder Client C',
                'industry' => 'Placeholder Industry',
                'category' => 'Ads',
                'metric' => 'Placeholder — pending Ops (see Open_Decision.md Q2)',
                'metric_label' => 'Result Pending',
                'tags' => ['Placeholder'],
                'excerpt' => 'Placeholder excerpt — do not publish live.',
                'thumbnail' => '/assets/images/case-study-placeholder.jpg',
                'workflow' => [['step' => 'Placeholder Step', 'tool' => 'Placeholder Tool']],
                'challenge' => 'Placeholder.',
                'solution' => 'Placeholder.',
                'results' => 'Placeholder.',
                'tools' => ['Placeholder'],
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

    public function byCategory(string $category): array
    {
        if ($category === 'all' || $category === '') {
            return $this->all();
        }

        return array_filter($this->all(), fn ($item) => ($item['category'] ?? null) === $category);
    }
}
