<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['steps' => []]));

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

foreach (array_filter((['steps' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $steps = $steps ?: [];
?>

<?php if(!empty($steps)): ?>
    <div class="overflow-x-auto">
        <div class="flex min-w-max items-stretch gap-2 pb-4 md:gap-4">
            <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($index > 0): ?>
                    <div class="flex items-center text-muted-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5"><path d="m9 18 6-6-6-6"></path></svg>
                    </div>
                <?php endif; ?>

                <div class="flex min-w-[140px] flex-col items-center justify-center rounded-xl border border-border bg-card px-5 py-4 text-center">
                    <?php if(isset($step['step'])): ?>
                        <span class="text-xs uppercase tracking-widest text-muted-foreground"><?php echo e($step['step']); ?></span>
                    <?php endif; ?>
                    <?php if(isset($step['tool'])): ?>
                        <span class="mt-1 font-semibold"><?php echo e($step['tool']); ?></span>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /home/dgi/www/chada.digital/resources/views/components/workflow-diagram.blade.php ENDPATH**/ ?>