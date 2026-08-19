<section class="px-6 py-20 md:py-28" id="portfolio">
    <div class="mx-auto max-w-7xl">
        <div class="mb-12 flex flex-col items-start justify-between gap-6 md:flex-row md:items-end">
            <div>
                <span class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">Our Work</span>
                <h2 class="mt-4 font-display text-3xl font-bold tracking-tight md:text-5xl">Featured <span class="text-primary">Projects</span></h2>
                <p class="mt-4 max-w-xl text-base text-muted-foreground">A selection of recent work across industries and use cases.</p>
            </div>
            <button id="view-all-projects-btn" type="button" class="inline-flex items-center gap-2 rounded-full border border-primary/40 px-6 py-3 text-xs font-semibold uppercase tracking-widest text-primary transition-colors hover:bg-primary/10">
                View All Projects
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </button>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <?php echo $__env->make('partials.project-card', ['slug' => 'sterling-vale', 'image' => 'project-sterling.jpg', 'title' => 'Sterling & Vale', 'description' => 'Construction Firm — Corporate Website'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('partials.project-card', ['slug' => 'apexflow', 'image' => 'project-apexflow.jpg', 'title' => 'ApexFlow', 'description' => 'SaaS Platform — AI Automation'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('partials.project-card', ['slug' => 'hirebase', 'image' => 'project-hirebase.jpg', 'title' => 'HIREBASE', 'description' => 'Recruitment — Job Board Platform'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>
</section>
<?php /**PATH /home/dgi/www/chada.digital/resources/views/partials/portfolio.blade.php ENDPATH**/ ?>