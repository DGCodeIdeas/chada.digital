<a href="<?php echo e(route('preview.show', $slug)); ?>" rel="noopener" target="_blank" class="group block overflow-hidden rounded-2xl border border-border bg-card/40 transition-all duration-300 hover:-translate-y-1 hover:border-primary/40 hover:shadow-xl hover:shadow-primary/10">
    <div class="relative overflow-hidden">
        <img alt="<?php echo e($title); ?>" class="aspect-[4/3] w-full object-cover transition-transform duration-700 group-hover:scale-105" src="<?php echo e(asset('assets/images/' . $image)); ?>" loading="lazy" />
        <div class="absolute inset-0 bg-gradient-to-t from-[#0b1526] via-transparent to-transparent opacity-60"></div>
    </div>
    <div class="p-6">
        <h3 class="font-display text-lg font-bold tracking-tight"><?php echo e($title); ?></h3>
        <p class="mt-1 text-sm text-muted-foreground"><?php echo e($description); ?></p>
    </div>
</a><?php /**PATH /home/dgi/www/chada.digital/resources/views/partials/project-card.blade.php ENDPATH**/ ?>