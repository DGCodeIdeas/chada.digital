<?php
    $offers = config('placeholders.offers');
?>

<section class="px-6 py-20 md:py-28" id="goals">
    <div class="mx-auto max-w-7xl">
        <div class="mb-14 text-center">
            <?php if (isset($component)) { $__componentOriginalc8b5eb0b0f7ed3679500250977b3cb03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8b5eb0b0f7ed3679500250977b3cb03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-badge','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Services <?php echo $__env->renderComponent(); ?>
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
<?php $component->withAttributes(['class' => 'mt-4']); ?>Pick your <span class="text-primary">starting point.</span> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $attributes = $__attributesOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__attributesOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $component = $__componentOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__componentOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>
            <p class="mt-4 mx-auto max-w-2xl text-base text-muted-foreground"><?php echo e(\App\Support\Lorem::sentence('goal-picker.sub', 14)); ?></p>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="group flex flex-col rounded-2xl border border-border bg-card p-8 transition-all duration-300 hover:-translate-y-1 hover:border-primary/40">
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-primary"><?php echo e($offer['badge'] ?? sprintf('OPTION %02d', $loop->iteration)); ?></span>
                    <h3 class="mt-4 font-display text-lg font-bold tracking-tight"><?php echo e($offer['title'] ?? \App\Support\Lorem::title("offers.{$i}.title", 4)); ?></h3>
                    <p class="mt-3 text-sm leading-relaxed text-muted-foreground"><?php echo e($offer['description'] ?? \App\Support\Lorem::paragraph("offers.{$i}.description", 2, 9)); ?></p>

                    
                    <div class="mt-6 rounded-xl border border-border/60 bg-background/60 px-4 py-3">
                        <span class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Pricing</span>
                        <?php if(! empty($offer['price_ngn'])): ?>
                            <p class="mt-1 font-display text-2xl font-bold tracking-tight text-primary">
                                &#8358;<?php echo e(number_format((float) $offer['price_ngn'])); ?><?php echo e($offer['price_period'] ?? ''); ?>

                            </p>
                            <?php if(! empty($offer['price_usd'])): ?>
                                <p class="text-xs text-muted-foreground">$<?php echo e(number_format((float) $offer['price_usd'], 0)); ?><?php echo e($offer['price_period'] ?? ''); ?></p>
                            <?php endif; ?>
                        <?php else: ?>
                            <p class="mt-1 text-sm font-semibold text-foreground">Contact for pricing</p>
                        <?php endif; ?>
                    </div>

                    <div class="mt-auto pt-6">
                        <?php if (isset($component)) { $__componentOriginal4328e4b0692f72131fb7bf412315f3b2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4328e4b0692f72131fb7bf412315f3b2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-outline','data' => ['href' => ''.e(url('/#contact')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-outline'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(url('/#contact')).'']); ?><?php echo e($offer['cta_label'] ?? 'Get Started'); ?> <?php echo $__env->renderComponent(); ?>
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section><?php /**PATH /home/dgi/www/chada.digital/resources/views/partials/goal-picker.blade.php ENDPATH**/ ?>