<?php $__env->startSection('content'); ?>
<?php $__env->startPush('head'); ?>
<style>
/* Preview page: hide main navigation and footer */
header.sticky,
footer {
    display: none !important;
}

/* Remove padding-top from main since header is hidden */
main {
    padding-top: 0 !important;
}
</style>
<?php $__env->stopPush(); ?>


<div id="preview-top-strip" class="fixed top-0 left-0 right-0 z-[60] flex items-center justify-between h-10 px-4 bg-background/80 backdrop-blur-sm border-b border-border/30">
    <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-2 text-xs font-medium text-muted-foreground hover:text-foreground transition-colors">
        <svg viewBox="0 0 400 120" width="20" height="6" class="shrink-0" aria-hidden="true">
            <circle cx="60" cy="60" r="48" fill="none" stroke="#3b82f6" stroke-width="6" stroke-linecap="round"/>
            <circle cx="60" cy="60" r="18" fill="#3b82f6"/>
        </svg>
        <span>Chada Digital</span>
    </a>
    <span class="text-[10px] uppercase tracking-widest text-muted-foreground/60">Demo Preview</span>
</div>

<div id="preview-viewer"
     data-slug="<?php echo e($slug); ?>"
     data-subpage="<?php echo e($subpage ?? ''); ?>"
     data-preview='<?php echo json_encode($preview, 15, 512) ?>'
     data-return-url="<?php echo e(route('showcase')); ?>">

    <!-- Splash Overlay -->
    <div id="preview-splash" class="fixed inset-0 z-50 flex items-center justify-center bg-background/95 backdrop-blur-sm">
        <div class="relative w-full max-w-2xl mx-6">
            <!-- Animated SVG Logo -->
            <div class="flex justify-center my-12">
                <?php if (isset($component)) { $__componentOriginalcfafecdda8e57544453d05f122e0264a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcfafecdda8e57544453d05f122e0264a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.splash-logo','data' => ['class' => 'w-32 h-32']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('splash-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-32 h-32']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcfafecdda8e57544453d05f122e0264a)): ?>
<?php $attributes = $__attributesOriginalcfafecdda8e57544453d05f122e0264a; ?>
<?php unset($__attributesOriginalcfafecdda8e57544453d05f122e0264a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcfafecdda8e57544453d05f122e0264a)): ?>
<?php $component = $__componentOriginalcfafecdda8e57544453d05f122e0264a; ?>
<?php unset($__componentOriginalcfafecdda8e57544453d05f122e0264a); ?>
<?php endif; ?>
            </div>

            <!-- Progress Bar -->
            <div class="relative h-1.5 w-full overflow-hidden rounded-full bg-muted">
                <div id="preview-progress-bar" class="h-full bg-primary transition-all duration-300 ease-out origin-left" style="width: 0%"></div>
            </div>
            <p id="preview-loading-text" class="mt-3 text-center text-sm text-muted-foreground">Loading preview...</p>

            <!-- Close Button (visible after load) -->
            <button id="preview-close-btn" class="mt-8 mx-auto hidden rounded-full border border-border bg-card/50 px-6 py-2.5 text-sm font-medium text-foreground transition-all duration-300 hover:bg-primary/10 hover:text-primary opacity-0 translate-y-2">
                Close &rarr; Back to Showcase
            </button>
        </div>
    </div>

    <!-- Iframe Container -->
    <div id="preview-iframe-container" class="fixed inset-0 z-40 hidden">
        <iframe
            id="preview-iframe"
            src=""
            class="w-full h-full border-0"
            sandbox="allow-scripts allow-same-origin allow-forms allow-popups allow-modals allow-popups-to-escape-sandbox allow-downloads allow-presentation"
            referrerpolicy="no-referrer-when-downgrade"
            loading="lazy"
        ></iframe>

        <!-- Floating action button -->
        <button
            id="preview-fab"
            class="fixed bottom-8 right-8 z-[60] hidden items-center gap-2.5 rounded-full bg-primary px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-primary/25 transition-all duration-300 hover:shadow-xl hover:shadow-primary/30 hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/50"
            aria-label="Exit preview and return to showcase"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                <path d="M19 12H5m0 0 7-7m-7 7 7 7"/>
            </svg>
            <span>Back to Showcase</span>
        </button>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    (function () {
        /* ================================================================
         * Debug toggle — set to false to suppress verbose console output
         * ================================================================ */
        var DEBUG = true;

        function log() {
            if (DEBUG) {
                var args = Array.prototype.slice.call(arguments);
                args.unshift('[Preview]');
                console.log.apply(console, args);
            }
        }

        var $root = $('#preview-viewer');
        if (!$root.length) return;

        var slug = $root.data('slug');
        var subpage = $root.data('subpage');
        var preview = $root.data('preview');
        var returnUrl = $root.data('return-url');

        log('Init — slug:', slug, 'subpage:', subpage);

        var $splash = $('#preview-splash');
        var $iframeContainer = $('#preview-iframe-container');
        var $iframe = $('#preview-iframe');
        var $progressBar = $('#preview-progress-bar');
        var $loadingText = $('#preview-loading-text');
        var $closeBtn = $('#preview-close-btn');
        var $fab = $('#preview-fab');

        var rafId = null;
        var observer = null;
        var safetyTimeout = null;
        var readyFired = false;

        // Build iframe src
        var iframeSrc = subpage
            ? '/demos/' + slug + '/' + subpage
            : '/demos/' + slug + '/index.html';

        log('iframeSrc:', iframeSrc);

        // Simulate progress with requestAnimationFrame
        var startTime = performance.now();
        var duration = 3000;
        var maxProgress = 90;

        function tick(now) {
            var elapsed = now - startTime;
            var p = Math.min(elapsed / duration, 1);
            var progress = Math.round(p * maxProgress);
            $progressBar.css('width', progress + '%');

            // Log at key milestones
            if (progress >= 25 && progress < 30) log('Progress: 25%');
            if (progress >= 50 && progress < 55) log('Progress: 50%');
            if (progress >= 75 && progress < 80) log('Progress: 75%');
            if (progress >= 90 && progress < 95) log('Progress: 90% (capped, waiting for iframe)');

            if (p < 1) {
                rafId = requestAnimationFrame(tick);
            }
        }
        rafId = requestAnimationFrame(tick);

        // ================================================================
        // onIframeReady — dismiss splash and reveal iframe
        // ================================================================
        function onIframeReady() {
            if (readyFired) {
                log('onIframeReady already fired — skipping duplicate call');
                return;
            }
            readyFired = true;
            log('onIframeReady fired');

            // Clear safety timeout
            if (safetyTimeout) {
                clearTimeout(safetyTimeout);
                safetyTimeout = null;
            }

            // Cancel progress animation
            if (rafId) {
                cancelAnimationFrame(rafId);
                rafId = null;
            }
            cleanupObserver();

            log('Progress: 100%');
            $progressBar.css('width', '100%');
            $loadingText.text('Ready!');

            setTimeout(function () {
                // Fade out splash
                $splash.css({
                    transition: 'opacity 200ms ease-in',
                    opacity: 0
                });
                setTimeout(function () {
                    $splash.addClass('hidden');
                    // Show iframe container
                    $iframeContainer.removeClass('hidden').css({
                        transition: 'opacity 300ms ease-out',
                        opacity: 1
                    });
                    // Show floating action button
                    $fab.removeClass('hidden');
                }, 200);
            }, 400);
        }

        // ================================================================
        // 1. PerformanceObserver — created FIRST, before iframe starts loading
        // ================================================================
        if (window.PerformanceObserver) {
            try {
                log('PerformanceObserver: creating');
                observer = new PerformanceObserver(function (list) {
                    var entries = list.getEntries();
                    for (var i = 0; i < entries.length; i++) {
                        var entry = entries[i];
                        log('PerformanceObserver entry:', entry.name, 'responseEnd:', entry.responseEnd);
                        if (entry.name && entry.name.indexOf(slug) !== -1 && entry.responseEnd > 0) {
                            log('PerformanceObserver: matched iframe resource — calling onIframeReady');
                            onIframeReady();
                            break;
                        }
                    }
                });
                observer.observe({ type: 'resource', buffered: true });
            } catch (e) {
                log('PerformanceObserver: error —', e.message);
            }
        } else {
            log('PerformanceObserver: not supported');
        }

        // ================================================================
        // 2. Iframe load handler — attached SECOND
        // ================================================================
        $iframe.on('load', function () {
            log('Iframe load event fired');
            onIframeReady();
        });

        // ================================================================
        // 3. Iframe error handler — handle load failures gracefully
        // ================================================================
        $iframe.on('error', function () {
            log('Iframe error event fired — src:', iframeSrc);
            onIframeReady(); // dismiss splash even on error so user isn't stuck
        });

        // ================================================================
        // 4. Safety timeout fallback — guarantees splash dismissal
        // ================================================================
        safetyTimeout = setTimeout(function () {
            log('Safety timeout reached (10s) — forcing completion');
            onIframeReady();
        }, 10000);

        // ================================================================
        // 5. Set iframe src LAST — after all detection mechanisms are in place
        // ================================================================
        log('Setting iframe src:', iframeSrc);
        $iframe.attr('src', iframeSrc);

        // Show close button after load
        setTimeout(function () {
            $closeBtn.removeClass('hidden').css({
                transition: 'opacity 200ms ease-out, transform 200ms ease-out',
                opacity: 1,
                transform: 'translateY(0)'
            });
        }, 2000);

        // Close handlers
        function closePreview() {
            window.location.href = returnUrl;
        }

        $closeBtn.on('click', closePreview);
        $fab.on('click', closePreview);

        // Cleanup observer on page unload
        function cleanupObserver() {
            if (observer) {
                try { observer.disconnect(); } catch (e) { /* ignore */ }
                observer = null;
            }
        }

        $(window).on('beforeunload', function () {
            if (rafId) {
                cancelAnimationFrame(rafId);
                rafId = null;
            }
            if (safetyTimeout) {
                clearTimeout(safetyTimeout);
                safetyTimeout = null;
            }
            cleanupObserver();
        });
    })();
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/projects/chadadigital.local/resources/views/pages/preview.blade.php ENDPATH**/ ?>