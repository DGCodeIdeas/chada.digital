<?php $__env->startSection('content'); ?>
    <section class="px-6 py-16 md:py-24">
        <div class="mx-auto max-w-4xl text-center">
            <span class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">Our Work</span>
            <h1 class="mt-4 font-display text-4xl font-bold tracking-tight md:text-5xl">
                Featured <span class="text-primary">Projects</span>
            </h1>
            <p class="mt-4 text-base text-muted-foreground">A selection of recent work across industries and use cases.</p>
        </div>
    </section>

    <section class="px-6 pb-8">
        <div class="mx-auto max-w-7xl">
            <div class="showcase-filter-bar flex flex-wrap items-center justify-center gap-3">
                <button
                    type="button"
                    class="filter-btn inline-flex items-center rounded-full border border-primary/40 bg-primary/10 px-5 py-2.5 text-sm font-medium text-primary transition-all duration-300 hover:bg-primary/10 hover:text-primary"
                    data-category="all"
                >
                    All
                </button>
                <button
                    type="button"
                    class="filter-btn inline-flex items-center rounded-full border border-border bg-card/50 px-5 py-2.5 text-sm font-medium text-foreground transition-all duration-300 hover:bg-primary/10 hover:text-primary"
                    data-category="Construction"
                >
                    Construction
                </button>
                <button
                    type="button"
                    class="filter-btn inline-flex items-center rounded-full border border-border bg-card/50 px-5 py-2.5 text-sm font-medium text-foreground transition-all duration-300 hover:bg-primary/10 hover:text-primary"
                    data-category="SaaS"
                >
                    SaaS
                </button>
                <button
                    type="button"
                    class="filter-btn inline-flex items-center rounded-full border border-border bg-card/50 px-5 py-2.5 text-sm font-medium text-foreground transition-all duration-300 hover:bg-primary/10 hover:text-primary"
                    data-category="Recruitment"
                >
                    Recruitment
                </button>
                <button
                    type="button"
                    class="filter-btn inline-flex items-center rounded-full border border-border bg-card/50 px-5 py-2.5 text-sm font-medium text-foreground transition-all duration-300 hover:bg-primary/10 hover:text-primary"
                    data-category="Artisan"
                >
                    Artisan
                </button>
            </div>
        </div>
    </section>

    <section class="px-6 pb-20">
        <div class="mx-auto max-w-7xl">
            <div class="showcase-filter-grid grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <?php echo $__env->make('partials.showcase-project-card', [
                    'slug' => 'sterling-vale',
                    'title' => 'Sterling & Vale',
                    'description' => 'Construction Firm — Corporate Website',
                    'category' => 'Construction',
                    'image' => 'project-sterling.jpg',
                    'alt' => 'Sterling & Vale'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php echo $__env->make('partials.showcase-project-card', [
                    'slug' => 'apexflow',
                    'title' => 'ApexFlow',
                    'description' => 'SaaS Platform — AI Automation',
                    'category' => 'SaaS',
                    'image' => 'project-apexflow.jpg',
                    'alt' => 'ApexFlow'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php echo $__env->make('partials.showcase-project-card', [
                    'slug' => 'noir',
                    'title' => 'NOIR',
                    'description' => 'E-commerce — Luxury Fashion',
                    'category' => 'E-commerce',
                    'image' => 'project-noir.jpg',
                    'alt' => 'NOIR'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php echo $__env->make('partials.showcase-project-card', [
                    'slug' => 'elysian',
                    'title' => 'ELYSIAN',
                    'description' => 'Booking — Luxury Travel Platform',
                    'category' => 'Booking',
                    'image' => 'project-elysian.jpg',
                    'alt' => 'ELYSIAN'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php echo $__env->make('partials.showcase-project-card', [
                    'slug' => 'hirebase',
                    'title' => 'HIREBASE',
                    'description' => 'Recruitment — Job Board Platform',
                    'category' => 'Recruitment',
                    'image' => 'project-hirebase.jpg',
                    'alt' => 'HIREBASE'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php echo $__env->make('partials.showcase-project-card', [
                    'slug' => 'timber-mill',
                    'title' => 'TimberMill',
                    'description' => 'Bespoke Furniture — Artisan Woodworking Studio',
                    'category' => 'Artisan',
                    'image' => 'project-timbermill.jpg',
                    'alt' => 'TimberMill'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>
    </section>

    
    <div id="project-modal" class="fixed inset-0 z-[100] hidden" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="project-modal-title">
        <div class="modal-backdrop absolute inset-0 bg-black/70 transition-all duration-300" style="opacity:0;backdrop-filter:blur(0px)"></div>
        <div class="relative flex min-h-full items-center justify-center p-4 sm:p-6">
            <div class="modal-panel relative w-full max-w-4xl max-h-[85dvh] flex flex-col overflow-hidden rounded-2xl border border-border bg-[#0e1b2e] shadow-2xl transition-all duration-300" style="opacity:0;transform:scale(0.95) translateY(1rem)">
                <div class="flex items-center justify-between border-b border-border/50 px-6 py-5 sm:px-8">
                    <div>
                        <span class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">Project Details</span>
                        <h2 id="project-modal-title" class="mt-1 font-display text-2xl font-bold tracking-tight sm:text-3xl text-foreground"></h2>
                    </div>
                    <button type="button" id="project-modal-close" class="inline-flex size-10 items-center justify-center rounded-full border border-border/60 text-muted-foreground transition-colors hover:border-primary hover:text-primary" aria-label="Close project modal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
                    </button>
                </div>
                <div class="flex-1 overflow-y-auto p-6 sm:p-8" style="-webkit-overflow-scrolling:touch;overscroll-behavior:contain">
                    <div class="grid gap-8 md:grid-cols-2">
                        <div class="relative overflow-hidden rounded-xl">
                            <img id="project-modal-image" alt="" class="aspect-[4/3] w-full object-cover" src="" loading="lazy" />
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0b1526] via-transparent to-transparent opacity-40"></div>
                        </div>
                        <div>
                            <span id="project-modal-category" class="inline-flex items-center gap-1.5 text-xs font-semibold uppercase tracking-widest text-primary"></span>
                            <p id="project-modal-description" class="mt-4 text-base text-muted-foreground"></p>
                            <a id="project-modal-link" href="" target="_blank" rel="noopener" class="mt-6 inline-flex items-center gap-2 rounded-full border border-primary/40 px-6 py-3 text-xs font-semibold uppercase tracking-widest text-primary transition-all duration-300 hover:bg-primary/10">
                                View Live Project
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3.5"><path d="M7 7h10v10"></path><path d="M7 17 17 7"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/dgi/www/chada.digital/resources/views/pages/showcase.blade.php ENDPATH**/ ?>