<?php
    $variant = $variant ?? 'home_top';
    $stats = config("placeholders.stats.{$variant}", []);
    $ready = collect($stats)->filter(fn ($s) => ! empty($s['value']))->values();
?>
<?php if($ready->isNotEmpty()): ?>
    <section class="border-y border-border/60 bg-card/60 px-6 py-10" aria-label="Results">
        <div class="mx-auto grid max-w-7xl grid-cols-2 gap-8 md:grid-cols-4">
            <?php $__currentLoopData = $ready; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="text-center">
                    <p class="font-display text-3xl font-bold tracking-tight text-foreground md:text-4xl"><?php echo e($stat['value']); ?></p>
                    <p class="mt-2 text-xs font-medium uppercase tracking-widest text-muted-foreground"><?php echo e($stat['label']); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
<?php endif; ?><?php /**PATH /home/dgi/www/chada.digital/resources/views/partials/stats-bar.blade.php ENDPATH**/ ?>