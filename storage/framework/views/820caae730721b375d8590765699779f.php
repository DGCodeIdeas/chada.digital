<?php
    $checklist = config('placeholders.checklist');
?>

<section class="px-6 py-20 md:py-28" id="services-checklist">
    <div class="mx-auto max-w-7xl">
        <div class="mb-12 max-w-3xl">
            <?php if (isset($component)) { $__componentOriginalc8b5eb0b0f7ed3679500250977b3cb03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8b5eb0b0f7ed3679500250977b3cb03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-badge','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>What We Do <?php echo $__env->renderComponent(); ?>
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
<?php $component->withAttributes(['class' => 'mt-4']); ?>Everything we <span class="text-primary">bring to the table.</span> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $attributes = $__attributesOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__attributesOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $component = $__componentOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__componentOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>
            <p class="mt-4 text-base leading-relaxed text-muted-foreground"><?php echo e(data_get($checklist, 'intro') ?? \App\Support\Lorem::paragraph('checklist.intro', 2, 12)); ?></p>
        </div>
        <div class="grid gap-3 sm:grid-cols-2">
            <?php $__currentLoopData = $checklist['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-center gap-3 rounded-xl border border-border bg-card px-5 py-4">
                    <span class="inline-flex size-6 shrink-0 items-center justify-center rounded-full bg-primary/15 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="size-3.5"><path d="M20 6 9 17l-5-5"/></svg>
                    </span>
                    <span class="text-sm font-medium text-foreground"><?php echo e($item); ?></span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="mt-10 flex flex-wrap gap-4">
            <?php if (isset($component)) { $__componentOriginalfae2f7aaf3655f29e1fef8f771dcf14c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfae2f7aaf3655f29e1fef8f771dcf14c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-primary','data' => ['href' => ''.e(url('/#goals')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(url('/#goals')).'']); ?>See Services <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfae2f7aaf3655f29e1fef8f771dcf14c)): ?>
<?php $attributes = $__attributesOriginalfae2f7aaf3655f29e1fef8f771dcf14c; ?>
<?php unset($__attributesOriginalfae2f7aaf3655f29e1fef8f771dcf14c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfae2f7aaf3655f29e1fef8f771dcf14c)): ?>
<?php $component = $__componentOriginalfae2f7aaf3655f29e1fef8f771dcf14c; ?>
<?php unset($__componentOriginalfae2f7aaf3655f29e1fef8f771dcf14c); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal4328e4b0692f72131fb7bf412315f3b2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4328e4b0692f72131fb7bf412315f3b2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-outline','data' => ['href' => ''.e(url('/#contact')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-outline'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(url('/#contact')).'']); ?>Get In Touch <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4328e4b0692f72131fb7bf412315f3b2)): ?>
<?php $attributes = $__attributesOriginal4328e4b0692f72131fb7bf412315f3b2; ?>
<?php unset($__attributesOriginal4328e4b0692f72131fb7bf412315f3b2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4328e4b0692f72131fb7bf412315f3b2)): ?>
<?php $component = $__componentOriginal4328e4b0692f72131fb7bf412315f3b2; ?>
<?php unset($__componentOriginal4328e4b0692f72131fb7bf412315f3b2); ?>
<?php endif; ?>
        </div>
    </div>
</section><?php /**PATH /home/dgi/www/chada.digital/resources/views/partials/services-checklist.blade.php ENDPATH**/ ?>