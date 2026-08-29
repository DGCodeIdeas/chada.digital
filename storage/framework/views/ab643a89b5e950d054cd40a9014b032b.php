<?php
    $testimonials = config('placeholders.testimonials');
    $manifesto = config('placeholders.manifesto');
    $real = collect($testimonials)->filter(fn ($t) => ! empty($t['quote']))->values();
    $cards = $real->isNotEmpty() ? $real : collect(range(0, 2));
?>

<section class="px-6 py-20 md:py-28" id="testimonials">
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
<?php $component->withAttributes([]); ?>Testimonials <?php echo $__env->renderComponent(); ?>
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
<?php $component->withAttributes(['class' => 'mt-4']); ?>What clients <span class="text-primary">say.</span> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $attributes = $__attributesOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__attributesOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $component = $__componentOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__componentOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>
        </div>

        <?php if(! empty($manifesto['enabled']) && ! empty($manifesto['items'])): ?>
            <div class="mb-12 rounded-2xl border border-border bg-card/60 px-8 py-8 text-center">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-primary"><?php echo e($manifesto['label'] ?? 'Our Standards'); ?></p>
                <p class="mt-3 font-display text-xl font-bold tracking-tight md:text-2xl">
                    <?php echo e(implode(' &middot; ', $manifesto['items'])); ?>

                </p>
            </div>
        <?php endif; ?>

        
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $isReal = is_array($card);
                    $quote = ($isReal && ($card['quote'] ?? null)) ? $card['quote'] : \App\Support\Lorem::paragraph("testimonials.{$i}.quote", 2, 14);
                    $name  = ($isReal && ($card['name'] ?? null)) ? $card['name']  : \App\Support\Lorem::name("testimonials.{$i}");
                    $role  = ($isReal && ($card['role'] ?? null)) ? $card['role']  : \App\Support\Lorem::title("testimonials.{$i}.role", 3) . ', ' . \App\Support\Lorem::title("testimonials.{$i}.org", 2) . ' Ltd.';
                ?>
                <div class="rounded-2xl border border-border bg-card p-8">
                    <p class="text-sm leading-relaxed text-muted-foreground"><?php echo e($quote); ?></p>
                    <div class="mt-6 border-t border-border/40 pt-6">
                        <p class="font-display text-sm font-bold"><?php echo e($name); ?></p>
                        <p class="mt-1 text-xs text-muted-foreground"><?php echo e($role); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section><?php /**PATH /home/dgi/www/chada.digital/resources/views/partials/testimonials.blade.php ENDPATH**/ ?>