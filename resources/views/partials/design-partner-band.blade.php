{{--
    Design Partner Band — replaces the V2 "trust-bar" (gated client logos).

    Founder directive (Aug 30, 2026): "No customer logos yet, we won't fake
    them. Become a design partner." — instead of faking logos, the empty
    state becomes the message. The band always renders (no gate). When
    real client logos exist (future state, with explicit per-logo Founder
    sign-off per the originality rules), the band can be repurposed into
    a logo row — but only by explicit decision, not silently.

    See: MULTIPAGE_REBUILD.md §11 (Design Partner deviation) and
         Open_Decision.md Q11 (ratified Aug 30, 2026).
--}}
<section class="py-5" style="background: linear-gradient(to right, var(--md-sys-color-surface-container), var(--md-sys-color-surface-container-high), var(--md-sys-color-surface-container)); border: 0;">
    <div class="container text-center py-4">
        <p class="fw-semibold mb-3" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.3em; color: var(--md-sys-color-primary);">
            Early Access
        </p>
        <h2 class="display-6 fw-bold mb-3" style="font-family: 'Inter', sans-serif; color: var(--md-sys-color-on-surface);">
            No customer logos yet &mdash; we won&rsquo;t fake them.
        </h2>
        <p class="lead mb-0" style="color: var(--md-sys-color-on-surface-variant);">
            Become a <a href="{{ route('contact') }}#partner" style="color: var(--md-sys-color-primary); text-decoration: none; font-weight: 500;">design partner</a>.
        </p>
    </div>
</section>
