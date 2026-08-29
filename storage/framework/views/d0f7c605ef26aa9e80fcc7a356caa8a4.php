<?php
    $audit = config('placeholders.audit');
?>

<section class="px-6 py-16 md:py-20" id="audit">
    <div class="mx-auto max-w-3xl text-center rounded-2xl border border-primary/20 bg-primary/5 px-8 py-12">
        <?php if (isset($component)) { $__componentOriginalc8b5eb0b0f7ed3679500250977b3cb03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8b5eb0b0f7ed3679500250977b3cb03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-badge','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Free Review <?php echo $__env->renderComponent(); ?>
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
<?php $component->withAttributes(['class' => 'mt-4']); ?><?php echo e(data_get($audit, 'headline') ?? \App\Support\Lorem::sentence('audit.headline', 11)); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $attributes = $__attributesOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__attributesOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $component = $__componentOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__componentOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>
        <p class="mt-4 text-base text-muted-foreground"><?php echo e(data_get($audit, 'body') ?? \App\Support\Lorem::paragraph('audit.body', 2, 12)); ?></p>
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
<?php $component->withAttributes(['href' => ''.e(url('/#contact')).'']); ?><?php echo e(data_get($audit, 'cta_label') ?? 'Request a Free Review'); ?> <?php echo $__env->renderComponent(); ?>
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
</section><?php /**PATH /home/dgi/www/chada.digital/resources/views/partials/audit-cta.blade.php ENDPATH**/ ?>