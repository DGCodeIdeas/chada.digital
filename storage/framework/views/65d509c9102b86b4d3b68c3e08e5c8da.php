<?php
    $founder = config('placeholders.founder');
?>

<section class="px-6 py-20 md:py-28" id="founder">
    <div class="mx-auto grid max-w-7xl gap-12 lg:grid-cols-2 lg:items-center">
        <div class="aspect-square w-full max-w-md mx-auto lg:mx-0 overflow-hidden rounded-2xl border border-border bg-card flex items-center justify-center">
            <?php if(! empty(data_get($founder, 'real'))): ?>
                <img class="h-full w-full object-cover" src="<?php echo e(data_get($founder, 'photo')); ?>" alt="<?php echo e(data_get($founder, 'name', 'Founder')); ?>" />
            <?php endif; ?>
        </div>
        <div>
            <?php if (isset($component)) { $__componentOriginalc8b5eb0b0f7ed3679500250977b3cb03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8b5eb0b0f7ed3679500250977b3cb03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-badge','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>About <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8b5eb0b0f7ed3679500250977b3cb03)): ?>
<?php $attributes = $__attributesOriginalc8b5eb0b0f7ed3679500250977b3cb03; ?>
<?php unset($__attributesOriginalc8b5eb0b0f7ed3679500250977b3cb03); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8b5eb0b0f7ed3679500250977b3cb03)): ?>
<?php $component = $__componentOriginalc8b5eb0b0f7ed3679500250977b3cb03; ?>
<?php unset($__componentOriginalc8b5eb0b0f7ed3679500250977b3cb03); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['class' => 'mt-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-4']); ?>Meet <span class="text-primary">the founder.</span> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $attributes = $__attributesOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__attributesOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $component = $__componentOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__componentOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>
            <p class="mt-2 text-sm font-semibold text-muted-foreground"><?php echo e(data_get($founder, 'title') ?? \App\Support\Lorem::title('founder.role', 3)); ?></p>
            <p class="mt-6 text-base leading-relaxed text-muted-foreground"><?php echo e(data_get($founder, 'bio') ?? \App\Support\Lorem::paragraph('founder.bio', 2, 12)); ?></p>
            <ul class="mt-6 space-y-3">
                <?php $__currentLoopData = range(0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 inline-flex size-5 shrink-0 items-center justify-center rounded-full bg-primary/15 text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="size-3"><path d="M20 6 9 17l-5-5"/></svg>
                        </span>
                        <span class="text-sm leading-relaxed text-muted-foreground"><?php echo e(data_get($founder, "bio_points.{$i}") ?? \App\Support\Lorem::sentence("founder.point.{$i}", 10)); ?></span>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <div class="mt-8">
                <?php if (isset($component)) { $__componentOriginalfae2f7aaf3655f29e1fef8f771dcf14c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfae2f7aaf3655f29e1fef8f771dcf14c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-primary','data' => ['href' => ''.e(url('/#contact')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(url('/#contact')).'']); ?><?php echo e(data_get($founder, 'cta_label') ?? 'Start a Conversation'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfae2f7aaf3655f29e1fef8f771dcf14c)): ?>
<?php $attributes = $__attributesOriginalfae2f7aaf3655f29e1fef8f771dcf14c; ?>
<?php unset($__attributesOriginalfae2f7aaf3655f29e1fef8f771dcf14c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfae2f7aaf3655f29e1fef8f771dcf14c)): ?>
<?php $component = $__componentOriginalfae2f7aaf3655f29e1fef8f771dcf14c; ?>
<?php unset($__componentOriginalfae2f7aaf3655f29e1fef8f771dcf14c); ?>
<?php endif; ?>
            </div>
        </div>
    </div>
</section><?php /**PATH /home/dgi/www/chada.digital/resources/views/partials/founder-bio.blade.php ENDPATH**/ ?>