<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['value' => '', 'label' => '']));

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

foreach (array_filter((['value' => '', 'label' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="flex flex-col gap-1">
    <span class="font-display text-3xl font-bold text-primary md:text-4xl"><?php echo e($value ?: '—'); ?></span>
    <?php if($label): ?>
        <span class="text-xs uppercase tracking-widest text-muted-foreground"><?php echo e($label); ?></span>
    <?php endif; ?>
</div>
<?php /**PATH /home/dgi/www/chada.digital/resources/views/components/metric-badge.blade.php ENDPATH**/ ?>