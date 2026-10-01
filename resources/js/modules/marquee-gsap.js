/**
 * Chada Digital — GSAP Marquee
 *
 * Drives the Our Stack marquee's continuous infinite scroll via GSAP
 * instead of CSS keyframes. The founder's directive (Oct 2026):
 * "use GSAP for any kind of animation instead."
 *
 * Behavior:
 *   - Track translates from x:0 to x:'-50%' over 60 seconds, linear
 *     ease, repeat:-1 (infinite). The track is rendered twice in the
 *     markup (see pages/home.blade.php) so at x:'-50%' the second
 *     copy is in the same position the first copy started at — the
 *     loop is seamless, no visible "snap" at the boundary.
 *   - Prefers-reduced-motion: skips the GSAP animation entirely.
 *     The track stays at x:0 (its natural position) — logos are
 *     visible but not moving. This is the same behavior as the
 *     previous CSS keyframes' prefers-reduced-motion rule.
 *   - No-JS fallback: if GSAP fails to load (CDN blocked, etc.),
 *     the marquee degrades gracefully — the CSS still has the
 *     @keyframes chada-marquee-scroll rule with animation: ...
 *     infinite, so the marquee scrolls via CSS even without GSAP.
 *     (The CSS animation is the fallback; GSAP overrides it when
 *     available.) This is progressive enhancement.
 */

export function initMarqueeGsap() {
    // Skip if GSAP isn't loaded (CDN blocked, etc.) — fall back to CSS.
    if (typeof window.gsap === 'undefined') {
        console.warn('[marquee-gsap] window.gsap not available — falling back to CSS animation.');
        return;
    }

    // Respect prefers-reduced-motion — same behavior as the CSS rule.
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) {
        // Reduced motion: don't initialize GSAP. CSS already has
        // `@media (prefers-reduced-motion: reduce) { animation: none; }`
        // which keeps the track at its natural position. The track
        // remains visible, just static.
        return;
    }

    const tracks = document.querySelectorAll('.chada-marquee__track');
    if (!tracks.length) {
        return;  // no marquee on this page
    }

    tracks.forEach((track) => {
        // Kill any existing GSAP animation on this track (idempotent
        // — safe to call multiple times if the page re-renders).
        window.gsap.killTweensOf(track);

        // Set the initial transform explicitly. This overrides any
        // CSS animation that may have started before GSAP loaded.
        window.gsap.set(track, { x: 0 });

        // The continuous infinite scroll. x:'-50%' translates the
        // track left by half its own width — which is exactly the
        // position where the second copy (rendered via the
        // @foreach([$list, $list]) trick in the blade template) is
        // in the same spot the first copy started. Loop is seamless.
        //
        // ease:'none' = linear (constant speed). repeat:-1 = infinite.
        // duration:60 = 60 seconds per loop (~16px/sec on desktop,
        // ~8px/sec on mobile — calm but visibly moving).
        window.gsap.to(track, {
            x: '-50%',
            duration: 60,
            ease: 'none',
            repeat: -1,
        });
    });
}
