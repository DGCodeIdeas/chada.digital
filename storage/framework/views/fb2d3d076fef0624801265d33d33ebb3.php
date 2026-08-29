<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['label' => '', 'title' => '', 'subtitle' => '', 'center' => false]));

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

foreach (array_filter((['label' => '', 'title' => '', 'subtitle' => '', 'center' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
    'space-y-4',
    'text-center mx-auto max-w-2xl' => $center,
]); ?>">
    <?php if($label): ?>
        <span class="text-xs font-semibold uppercase tracking-[0.3em] text-primary"><?php echo e($label); ?></span>
    <?php endif; ?>

    <?php if($title): ?>
        <h2 class="font-display text-3xl font-bold tracking-tight md:text-5xl"><?php echo e($title); ?></h2>
    <?php endif; ?>

    <?php if($subtitle): ?>
        <p class="mt-4 text-base text-muted-foreground"><?php echo e($subtitle); ?></p>
    <?php endif; ?>
</div>
<?php /**PATH /home/dgi/www/chada.digital/resources/views/components/section-header.blade.php ENDPATH**/ ?>