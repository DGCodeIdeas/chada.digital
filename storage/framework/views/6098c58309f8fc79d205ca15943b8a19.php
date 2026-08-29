<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'study' => [],
    'slug' => '',
]));

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

foreach (array_filter(([
    'study' => [],
    'slug' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $study = $study ?: [];
    $client = $study['client'] ?? 'Untitled';
    $metric = $study['metric'] ?? null;
    $excerpt = $study['excerpt'] ?? null;
?>

<div class="flex flex-col rounded-2xl border border-border bg-card p-8 transition-all duration-300 hover:border-primary/40">
    <p class="flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.3em] text-muted-foreground">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3.5 text-primary" aria-hidden="true"><path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/><rect width="20" height="14" x="2" y="6" rx="2"/></svg>
        <?php echo e($client); ?>

    </p>

    <?php if($metric): ?>
        <p class="mt-4 font-display text-3xl font-bold tracking-tight text-primary"><?php echo e($metric); ?></p>
        <?php if(! empty($study['metric_label'])): ?>
            <p class="mt-1 text-xs font-medium uppercase tracking-widest text-muted-foreground"><?php echo e($study['metric_label']); ?></p>
        <?php endif; ?>
    <?php endif; ?>

    <?php if($excerpt): ?>
        <p class="mt-4 text-sm leading-relaxed text-muted-foreground"><?php echo e($excerpt); ?></p>
    <?php endif; ?>

    <a href="<?php echo e(route('case-study.show', $slug)); ?>" class="group mt-auto inline-flex items-center gap-1.5 pt-6 text-sm font-semibold text-primary">
        Read the case study
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4 transition-transform group-hover:translate-x-1"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
    </a>
</div>
<?php /**PATH /home/dgi/www/chada.digital/resources/views/components/result-card.blade.php ENDPATH**/ ?>