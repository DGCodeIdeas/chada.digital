<section class="px-6 py-20 md:py-28" id="case-studies">
    <div class="mx-auto max-w-7xl">
        <div class="mb-12">
            <?php if (isset($component)) { $__componentOriginal436399e29d00ce6b8f47e38277d39536 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal436399e29d00ce6b8f47e38277d39536 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-header','data' => ['label' => 'Case Studies','title' => 'Real Results for Real Businesses']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Case Studies','title' => 'Real Results for Real Businesses']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal436399e29d00ce6b8f47e38277d39536)): ?>
<?php $attributes = $__attributesOriginal436399e29d00ce6b8f47e38277d39536; ?>
<?php unset($__attributesOriginal436399e29d00ce6b8f47e38277d39536); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal436399e29d00ce6b8f47e38277d39536)): ?>
<?php $component = $__componentOriginal436399e29d00ce6b8f47e38277d39536; ?>
<?php unset($__componentOriginal436399e29d00ce6b8f47e38277d39536); ?>
<?php endif; ?>
        </div>

        <?php if(isset($studies) && $studies->isNotEmpty()): ?>
            <div class="grid gap-6 sm:grid-cols-2">
                <?php $__currentLoopData = $studies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $study): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginal7f0de27ab763d7aed2788b6545200bfd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f0de27ab763d7aed2788b6545200bfd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.case-study-card','data' => ['study' => $study,'slug' => $slug]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('case-study-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['study' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($study),'slug' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($slug)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7f0de27ab763d7aed2788b6545200bfd)): ?>
<?php $attributes = $__attributesOriginal7f0de27ab763d7aed2788b6545200bfd; ?>
<?php unset($__attributesOriginal7f0de27ab763d7aed2788b6545200bfd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7f0de27ab763d7aed2788b6545200bfd)): ?>
<?php $component = $__componentOriginal7f0de27ab763d7aed2788b6545200bfd; ?>
<?php unset($__componentOriginal7f0de27ab763d7aed2788b6545200bfd); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <p class="text-muted-foreground">Case studies coming soon.</p>
        <?php endif; ?>
    </div>
</section>
<?php /**PATH /home/dgi/www/chada.digital/resources/views/partials/case-studies.blade.php ENDPATH**/ ?>