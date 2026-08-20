<?php $__env->startSection('content'); ?>
    <section class="px-6 py-16 md:py-24">
        <div class="mx-auto max-w-4xl text-center">
            <?php if (isset($component)) { $__componentOriginal436399e29d00ce6b8f47e38277d39536 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal436399e29d00ce6b8f47e38277d39536 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-header','data' => ['label' => 'Our Work','title' => 'Featured Projects','subtitle' => 'A selection of recent work across industries and use cases.','center' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Our Work','title' => 'Featured Projects','subtitle' => 'A selection of recent work across industries and use cases.','center' => true]); ?>
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
    </section>

    <section class="px-6 pb-8">
        <div class="mx-auto max-w-7xl">
            <div class="showcase-filter-bar flex flex-wrap items-center justify-center gap-3">
                <button
                    type="button"
                    class="filter-btn inline-flex items-center rounded-full border border-primary/40 bg-primary/10 px-5 py-2.5 text-sm font-medium text-primary transition-all duration-300 hover:bg-primary/10 hover:text-primary"
                    data-category="all"
                >
                    All
                </button>
                <button
                    type="button"
                    class="filter-btn inline-flex items-center rounded-full border border-border bg-card/50 px-5 py-2.5 text-sm font-medium text-foreground transition-all duration-300 hover:bg-primary/10 hover:text-primary"
                    data-category="Web Development"
                >
                    Web Development
                </button>
                <button
                    type="button"
                    class="filter-btn inline-flex items-center rounded-full border border-border bg-card/50 px-5 py-2.5 text-sm font-medium text-foreground transition-all duration-300 hover:bg-primary/10 hover:text-primary"
                    data-category="Funnels"
                >
                    Funnels
                </button>
                <button
                    type="button"
                    class="filter-btn inline-flex items-center rounded-full border border-border bg-card/50 px-5 py-2.5 text-sm font-medium text-foreground transition-all duration-300 hover:bg-primary/10 hover:text-primary"
                    data-category="Ads"
                >
                    Ads
                </button>
                <button
                    type="button"
                    class="filter-btn inline-flex items-center rounded-full border border-border bg-card/50 px-5 py-2.5 text-sm font-medium text-foreground transition-all duration-300 hover:bg-primary/10 hover:text-primary"
                    data-category="Branding"
                >
                    Branding
                </button>
            </div>
        </div>
    </section>

    <section class="px-6 pb-20">
        <div class="mx-auto max-w-7xl">
            <div class="showcase-filter-grid grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
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
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/dgi/www/chada.digital/resources/views/pages/work.blade.php ENDPATH**/ ?>