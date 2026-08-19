<?php
    $projectData = [
        'href' => route('preview.show', $slug),
        'alt' => $title,
        'image' => asset('assets/images/' . $image),
        'title' => $title,
        'description' => $description,
        'category' => $category,
    ];
?>
<div class="project-item animate-fade-in" data-category="<?php echo e($category); ?>">
    <button type="button" class="project-card group block w-full overflow-hidden rounded-2xl border border-border bg-card/40 text-left transition-all duration-300 hover:-translate-y-1 hover:border-primary/40 hover:shadow-xl hover:shadow-primary/10"
        data-project='<?php echo json_encode($projectData); ?>'>
        <div class="relative overflow-hidden">
            <img alt="<?php echo e($title); ?>" class="aspect-[4/3] w-full object-cover transition-transform duration-700 group-hover:scale-105" src="<?php echo e(asset('assets/images/' . $image)); ?>" loading="lazy" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0b1526] via-transparent to-transparent opacity-60"></div>
        </div>
        <div class="p-6">
            <span class="inline-flex items-center gap-1 rounded-full bg-primary/15 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-primary"><?php echo e($category); ?></span>
            <h3 class="mt-3 font-display text-lg font-bold tracking-tight"><?php echo e($title); ?></h3>
            <p class="mt-1 text-sm text-muted-foreground"><?php echo e($description); ?></p>
        </div>
    </button>
</div><?php /**PATH /home/dgi/www/chada.digital/resources/views/partials/showcase-project-card.blade.php ENDPATH**/ ?>