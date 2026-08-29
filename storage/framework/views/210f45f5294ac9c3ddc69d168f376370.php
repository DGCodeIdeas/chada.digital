<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['study' => [], 'slug' => '']));

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

foreach (array_filter((['study' => [], 'slug' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $study = $study ?: [];
    $category = $study['category'] ?? '';
    $client = $study['client'] ?? 'Untitled';
    $thumbnail = $study['thumbnail'] ?? '';
    $hasImage = $thumbnail && file_exists(public_path(ltrim($thumbnail, '/')));
    $initials = collect(explode(' ', $client))->take(2)->map(fn ($w) => mb_substr($w, 0, 1))->join('');
    $tags = $study['tags'] ?? [];
?>

<a
    href="<?php echo e(route('case-study.show', $slug)); ?>"
    data-category="<?php echo e($category); ?>"
    class="work-card group block overflow-hidden rounded-2xl border border-border bg-card transition-all duration-300 hover:-translate-y-1 hover:border-primary/40 hover:shadow-xl hover:shadow-primary/10"
>
    <div class="relative aspect-[16/10] w-full overflow-hidden bg-primary/10">
        <?php if($hasImage): ?>
            <img src="<?php echo e(asset(ltrim($thumbnail, '/'))); ?>" alt="<?php echo e($client); ?>" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" />
        <?php else: ?>
            <div class="flex h-full w-full items-center justify-center">
                <span class="font-display text-4xl font-bold text-primary/60"><?php echo e($initials ?: 'CS'); ?></span>
            </div>
        <?php endif; ?>
    </div>

    <div class="flex flex-col gap-3 p-6">
        <div class="flex items-center justify-between gap-3">
            <h3 class="font-display text-xl font-bold tracking-tight"><?php echo e($client); ?></h3>
            <?php if($category): ?>
                <span class="shrink-0 rounded-full border border-border px-3 py-1 text-xs font-medium text-muted-foreground"><?php echo e($category); ?></span>
            <?php endif; ?>
        </div>

        <?php if(isset($study['metric'])): ?>
            <p class="text-sm font-semibold text-primary"><?php echo e($study['metric']); ?></p>
        <?php endif; ?>

        <?php if(!empty($tags)): ?>
            <p class="text-xs uppercase tracking-widest text-muted-foreground"><?php echo e(implode(' · ', $tags)); ?></p>
        <?php endif; ?>

        <?php if(isset($study['excerpt'])): ?>
            <p class="text-sm leading-relaxed text-muted-foreground"><?php echo e($study['excerpt']); ?></p>
        <?php endif; ?>

        <span class="mt-2 inline-flex items-center gap-1.5 text-sm font-semibold text-primary transition-transform group-hover:translate-x-1">
            View Case Study
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
        </span>
    </div>
</a>
<?php /**PATH /home/dgi/www/chada.digital/resources/views/components/case-study-card.blade.php ENDPATH**/ ?>