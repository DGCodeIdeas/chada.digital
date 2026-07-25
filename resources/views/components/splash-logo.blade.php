@props(['size' => 140])

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
     width="{{ $size }}"
     height="{{ $size * 0.3 }}"
     class="splash-logo"
     role="img"
     aria-label="Chada Digital">
    {{-- Geometric Mark: stylized overlapping shapes forming a "C" --}}
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

    {{-- Chada text --}}
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

    {{-- Right accent mark --}}
    <rect x="310" y="42" width="4" height="36" rx="2"
          fill="#3b82f6"
          class="splash-logo-accent" />
</svg>