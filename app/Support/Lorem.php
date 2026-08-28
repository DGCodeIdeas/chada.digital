<?php

namespace App\Support;

/**
 * Lorem — seeded placeholder-text generator (the "dynamic Lorem Ipsum").
 *
 * WHY THIS EXISTS (Tech Lead directive, V4):
 * Every placeholder prose slot on the site renders generated lorem ipsum
 * instead of hand-written marketing copy. Benefits:
 *   - Placeholder copy can never be confused with real copy — or with any
 *     third party's copy. No hand-written prose lives in the codebase, so
 *     there is nowhere for copied text to hide.
 *   - Rotating config('placeholders.lorem_seed') regenerates every
 *     placeholder string site-wide, with zero view changes.
 *   - The word bank contains no digits or currency symbols, so the
 *     generator can never produce a metric, price, or date (constraint 14
 *     is enforced by construction).
 *
 * RULES:
 *   - Deterministic and request-memoized: same key + seed => same string.
 *   - NEVER use this for real content. Real, stable content lives in
 *     service classes (PreviewService / CaseStudyService pattern). When a
 *     slot gets real content, the view's Lorem call becomes the fallback:
 *     {{ $real ?? Lorem::…(key) }} — the slot fallback rule.
 *   - Pure PHP, zero dependencies (constraint 4).
 */
class Lorem
{
    /** Public-domain lorem ipsum word bank — no digits, no proper nouns. */
    private const WORDS = [
        'lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipiscing', 'elit',
        'sed', 'eiusmod', 'tempor', 'incididunt', 'labore', 'dolore', 'magna', 'aliqua',
        'enim', 'minim', 'veniam', 'quis', 'nostrud', 'exercitation', 'ullamco', 'laboris',
        'aliquip', 'commodo', 'consequat', 'duis', 'aute', 'irure', 'reprehenderit',
        'voluptate', 'velit', 'cillum', 'fugiat', 'nulla', 'pariatur', 'excepteur',
        'occaecat', 'cupidatat', 'proident', 'culpa', 'officia', 'deserunt', 'mollit',
        'anim', 'laborum', 'perspiciatis', 'omnis', 'iste', 'natus', 'error',
        'voluptatem', 'accusantium', 'doloremque', 'laudantium', 'totam', 'aperiam',
        'eaque', 'ipsa', 'quae', 'inventore', 'veritatis', 'nemo', 'ipsam',
    ];

    /** @var array<string, string> request-level memoization cache */
    private static array $cache = [];

    /**
     * A run of $count lorem words, deterministic for ($key, global seed).
     */
    public static function words(string $key, int $count): string
    {
        $count = max(1, min($count, 60));

        return self::memoize("w:{$key}:{$count}", function () use ($key, $count) {
            $bank = self::WORDS;
            $total = count($bank);
            $seed = self::seed($key . ':' . self::globalSeed());
            $out = [];
            for ($i = 0; $i < $count; $i++) {
                $seed = ($seed * 1103515245 + 12345) & 0x7fffffff;
                $out[] = $bank[$seed % $total];
            }

            return implode(' ', $out);
        });
    }

    /**
     * A lorem sentence: capitalized, period-terminated.
     */
    public static function sentence(string $key, int $words = 10): string
    {
        return self::memoize("s:{$key}:{$words}", fn () => ucfirst(self::words($key, $words)) . '.');
    }

    /**
     * A lorem paragraph of $sentences sentences, varied length.
     */
    public static function paragraph(string $key, int $sentences = 3, int $wordsPerSentence = 10): string
    {
        return self::memoize("p:{$key}:{$sentences}:{$wordsPerSentence}", function () use ($key, $sentences, $wordsPerSentence) {
            $out = [];
            for ($i = 0; $i < $sentences; $i++) {
                $out[] = self::sentence("{$key}.{$i}", $wordsPerSentence + ($i % 4));
            }

            return implode(' ', $out);
        });
    }

    /**
     * A Title Case lorem string — for card titles, headings, name slots.
     */
    public static function title(string $key, int $words = 4): string
    {
        return self::memoize("t:{$key}:{$words}", function () use ($key, $words) {
            $parts = explode(' ', self::words($key, max(1, min($words, 8))));

            return implode(' ', array_map('ucfirst', $parts));
        });
    }

    /**
     * A Title Case headline — alias for title() with a 6-word default.
     * Exists because TASK 1 in the phase brief explicitly calls ::headline().
     */
    public static function headline(string $key, int $words = 6): string
    {
        return self::title($key, $words);
    }

    /**
     * A two-word Title Case name — for testimonial attribution slots.
     */
    public static function name(string $key): string
    {
        return self::title("{$key}.name", 2);
    }

    /**
     * Flush the memoization cache (useful in tests / tinker).
     */
    public static function flush(): void
    {
        self::$cache = [];
    }

    private static function memoize(string $token, callable $fn): string
    {
        return self::$cache[$token] ??= (string) $fn();
    }

    private static function globalSeed(): string
    {
        return (string) config('placeholders.lorem_seed', 'v4-initial');
    }

    private static function seed(string $key): int
    {
        $hash = crc32($key);

        return $hash === 0 ? 1 : abs($hash);
    }
}
