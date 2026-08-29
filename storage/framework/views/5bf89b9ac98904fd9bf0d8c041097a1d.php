<?php
    $webinar = config('placeholders.webinar');
?>

<?php if(! empty($webinar['enabled'])): ?>
    <section class="px-6 py-20 md:py-28" id="webinar">
        <div class="mx-auto max-w-5xl overflow-hidden rounded-2xl border border-border bg-card">
            <div class="grid md:grid-cols-2">
                <div class="p-10 md:p-12">
                    <?php if (isset($component)) { $__componentOriginalc8b5eb0b0f7ed3679500250977b3cb03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8b5eb0b0f7ed3679500250977b3cb03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-badge','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e(data_get($webinar, 'subhead') ?? \App\Support\Lorem::title('webinar.subhead', 3)); ?> <?php echo $__env->renderComponent(); ?>
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
<?php $component->withAttributes(['class' => 'mt-4']); ?><?php echo e(data_get($webinar, 'headline') ?? \App\Support\Lorem::title('webinar.headline', 6)); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $attributes = $__attributesOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__attributesOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $component = $__componentOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__componentOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>
                    <p class="mt-4 text-sm leading-relaxed text-muted-foreground"><?php echo e(data_get($webinar, 'body') ?? \App\Support\Lorem::paragraph('webinar.body', 2, 10)); ?></p>
                </div>
                <div class="border-t border-border bg-background/40 p-10 md:border-l md:border-t-0 md:p-12">
                    <form action="<?php echo e(route('contact.submit')); ?>" method="POST" class="chada-form space-y-4" data-form-type="webinar">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="form_type" value="webinar" />
                        <p class="chada-honeypot">
                            <label>Don't fill this out: <input name="bot-field" /></label>
                        </p>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <input type="text" name="first_name" placeholder="First Name" required class="w-full rounded-xl border border-border bg-card px-4 py-3 text-sm" />
                            <input type="text" name="last_name" placeholder="Last Name" required class="w-full rounded-xl border border-border bg-card px-4 py-3 text-sm" />
                        </div>
                        <input type="email" name="email" placeholder="Email Address" required class="w-full rounded-xl border border-border bg-card px-4 py-3 text-sm" />
                        <input type="tel" name="phone" placeholder="Phone Number" class="w-full rounded-xl border border-border bg-card px-4 py-3 text-sm" />
                        <div class="grid gap-4 sm:grid-cols-2">
                            <input type="text" name="company" placeholder="Company" class="w-full rounded-xl border border-border bg-card px-4 py-3 text-sm" />
                            <input type="text" name="job_title" placeholder="Job Title" class="w-full rounded-xl border border-border bg-card px-4 py-3 text-sm" />
                        </div>
                        <button type="submit" class="w-full rounded-full bg-primary px-6 py-3.5 text-xs font-semibold uppercase tracking-widest text-primary-foreground transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30">
                            <?php echo e($webinar['cta_label'] ?? 'Get the Replay'); ?>

                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?><?php /**PATH /home/dgi/www/chada.digital/resources/views/partials/webinar-optin.blade.php ENDPATH**/ ?>