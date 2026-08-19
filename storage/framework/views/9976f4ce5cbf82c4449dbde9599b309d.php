<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['size' => 140]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['size' => 140]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<style>
    @media (prefers-reduced-motion: no-preference) {
        /* Ring draw — continuous stroke-dashoffset loop */
        .splash-logo-ring {
            stroke-dasharray: var(--draw-length, 302px);
            animation: splash-ring-draw 3s ease-in-out infinite;
        }

        /* Dot pulse */
        .splash-logo-dot {
            transform-origin: 60px 60px;
            animation: splash-dot-pulse 2s ease-in-out infinite;
        }

        /* Text fade-slide in */
        .splash-logo-text {
            animation: splash-fade-slide 3s ease-in-out infinite;
        }
        .splash-logo-subtext {
            animation: splash-fade-slide 3s ease-in-out 0.3s infinite;
        }

        /* Accent bar glow */
        .splash-logo-accent {
            animation: splash-accent-glow 2.5s ease-in-out infinite;
        }

        @keyframes splash-ring-draw {
            0%   { stroke-dashoffset: var(--draw-length, 302px); }
            50%  { stroke-dashoffset: 0; }
            100% { stroke-dashoffset: var(--draw-length, 302px); }
        }

        @keyframes splash-dot-pulse {
            0%, 100% { transform: scale(1); }
            50%      { transform: scale(1.15); }
        }

        @keyframes splash-fade-slide {
            0%   { opacity: 0;   transform: translateY(8px); }
            15%  { opacity: 1;   transform: translateY(0); }
            85%  { opacity: 1;   transform: translateY(0); }
            100% { opacity: 0.7; transform: translateY(0); }
        }

        @keyframes splash-accent-glow {
            0%, 100% { opacity: 0.4; }
            50%      { opacity: 1; }
        }
    }
</style>

<svg xmlns="http://www.w3.org/2000/svg"
     viewBox="0 0 400 120"
     width="<?php echo e($size); ?>"
     height="<?php echo e($size * 0.3); ?>"
     class="splash-logo"
     role="img"
     aria-label="Chada Digital">
    
    <g class="splash-logo-mark">
        <circle cx="60" cy="60" r="48"
                fill="none"
                stroke="#3b82f6"
                stroke-width="6"
                stroke-linecap="round"
                class="splash-logo-ring"
                style="--draw-length: 302px" />
        <circle cx="60" cy="60" r="18"
                fill="#3b82f6"
                class="splash-logo-dot" />
    </g>

    
    <text x="140" y="50"
          font-family="'Outfit', sans-serif"
          font-weight="800"
          font-size="36"
          fill="#f8fafc"
          class="splash-logo-text">
        Chada
    </text>
    <text x="140" y="76"
          font-family="'Outfit', sans-serif"
          font-weight="500"
          font-size="16"
          fill="rgba(148,163,184,0.8)"
          class="splash-logo-subtext">
        DIGITAL
    </text>

    
    <rect x="310" y="42" width="4" height="36" rx="2"
          fill="#3b82f6"
          class="splash-logo-accent" />
</svg><?php /**PATH /home/dgi/www/chada.digital/resources/views/components/splash-logo.blade.php ENDPATH**/ ?>