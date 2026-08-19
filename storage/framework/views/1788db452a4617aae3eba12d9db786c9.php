<?php
    $steps = [
        [
            'number' => '01',
            'title' => 'Discover',
            'desc' => 'Audit & Strategy',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="size-6"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/></svg>',
        ],
        [
            'number' => '02',
            'title' => 'Design',
            'desc' => 'Funnel Architecture',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="size-6"><path d="m12 19 7-7 3 3-7 7-3-3z"/><path d="m18 13-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"/><path d="m2 2 7.586 7.586"/><circle cx="11" cy="11" r="2"/></svg>',
        ],
        [
            'number' => '03',
            'title' => 'Build',
            'desc' => 'Development',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="size-6"><path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/></svg>',
        ],
        [
            'number' => '04',
            'title' => 'Scale',
            'desc' => 'Ads & Automation',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="size-6"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>',
        ],
    ];
?>

<section id="process" class="border-y border-border/40 bg-muted/40 px-6 py-20 md:py-28">
    <div class="mx-auto max-w-7xl">
        <div class="mb-14 text-center">
            <span class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">Our Process</span>
            <h2 class="mt-4 font-display text-3xl font-bold tracking-tight md:text-5xl">From First Click to Final <span class="text-primary">Conversion</span></h2>
        </div>
        <ol class="grid gap-8 lg:grid-cols-4">
            <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="relative flex flex-col items-center text-center">
                    <div class="mb-5 inline-flex size-14 items-center justify-center rounded-2xl bg-primary/15 text-primary">
                        <?php echo $step['icon']; ?>

                    </div>
                    <span class="text-sm font-semibold tracking-widest text-primary"><?php echo e($step['number']); ?></span>
                    <h3 class="mt-2 font-display text-lg font-bold tracking-tight"><?php echo e($step['title']); ?></h3>
                    <p class="mt-2 text-sm leading-relaxed text-muted-foreground"><?php echo e($step['desc']); ?></p>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    </div>
</section>
<?php /**PATH /home/dgi/www/chada.digital/resources/views/partials/process.blade.php ENDPATH**/ ?>