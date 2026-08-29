<?php
    // Decision 8 / Q1: client logos pending. Populate with entries shaped like:
    // ['src' => asset('assets/images/clients/foo.svg'), 'alt' => 'Foo']
    $clientLogos = [];
?>

<?php if(!empty($clientLogos)): ?>
    <section class="border-y border-border/40 bg-muted/40 px-6 py-10">
        <div class="mx-auto max-w-7xl">
            <p class="mb-6 text-center text-xs font-semibold uppercase tracking-[0.3em] text-muted-foreground">Trusted by teams at:</p>
            <div class="flex items-center justify-center gap-10 overflow-x-auto">
                <?php $__currentLoopData = $clientLogos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <img src="<?php echo e($logo['src']); ?>" alt="<?php echo e($logo['alt']); ?>" class="h-8 w-auto opacity-50 grayscale transition-opacity hover:opacity-100" />
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH /home/dgi/www/chada.digital/resources/views/partials/trust-bar.blade.php ENDPATH**/ ?>