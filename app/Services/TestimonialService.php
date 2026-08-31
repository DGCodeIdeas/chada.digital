<?php

namespace App\Services;

/**
 * Testimonial data — gated.
 *
 * Returns an empty array until the Founder supplies real client quotes
 * with explicit permission to publish. The /about page's testimonials
 * section hides itself when this returns empty (see about.blade.php).
 *
 * V4 MODEL (restored Aug 31, 2026): fabricated testimonials attributed to
 * fake names ("David Okafor", "Amara Nwosu", etc.) were removed from this
 * file. Publishing fake testimonials attributed to fake people is false
 * advertising — and if a name happens to match a real person, defamation
 * risk. This array stays empty until real quotes land.
 *
 * See: FOUNDER_CHECKLIST.md row 2 (testimonials)
 *      Open_Decision.md Q5 (testimonials available?)
 *      TODO-Placeholders.md §5 (testimonials gate)
 */
class TestimonialService
{
    public function all(): array
    {
        // Empty until the Founder supplies 3-6 real client quotes with
        // name, title, company, quote, rating, AND explicit permission
        // to publish. Each entry shape:
        //   ['name' => '…', 'title' => '…', 'company' => '…',
        //    'quote' => '…', 'rating' => 5]
        return [];
    }
}
