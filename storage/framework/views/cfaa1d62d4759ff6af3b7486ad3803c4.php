<?php
    $studies = $studies ?? app(\App\Services\CaseStudyService::class)->collection();
?>

<?php if($studies->isNotEmpty()): ?>
    <section class="px-6 py-20 md:py-28" id="case-studies">
        <div class="mx-auto max-w-7xl">
            <div class="mb-12">
                <?php if (isset($component)) { $__componentOriginal436399e29d00ce6b8f47e38277d39536 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal436399e29d00ce6b8f47e38277d39536 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-header','data' => ['label' => 'Case Studies','title' => 'Built, shipped, measured.','subtitle' => 'Verified results from systems we designed, built, and shipped.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Case Studies','title' => 'Built, shipped, measured.','subtitle' => 'Verified results from systems we designed, built, and shipped.']); ?>
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
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <?php $__currentLoopData = $studies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $study): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginalc120fa31b1f697b9d1eab5c6426cd2a0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc120fa31b1f697b9d1eab5c6426cd2a0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.result-card','data' => ['study' => $study,'slug' => $slug]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('result-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['study' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($study),'slug' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($slug)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc120fa31b1f697b9d1eab5c6426cd2a0)): ?>
<?php $attributes = $__attributesOriginalc120fa31b1f697b9d1eab5c6426cd2a0; ?>
<?php unset($__attributesOriginalc120fa31b1f697b9d1eab5c6426cd2a0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc120fa31b1f697b9d1eab5c6426cd2a0)): ?>
<?php $component = $__componentOriginalc120fa31b1f697b9d1eab5c6426cd2a0; ?>
<?php unset($__componentOriginalc120fa31b1f697b9d1eab5c6426cd2a0); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH /home/dgi/www/chada.digital/resources/views/partials/case-studies.blade.php ENDPATH**/ ?>