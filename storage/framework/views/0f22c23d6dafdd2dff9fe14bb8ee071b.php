<?php $__env->startSection('content'); ?>
    <section class="px-6 pt-20 md:pt-28">
        <div class="mx-auto max-w-4xl">
            <?php if (isset($component)) { $__componentOriginal436399e29d00ce6b8f47e38277d39536 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal436399e29d00ce6b8f47e38277d39536 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-header','data' => ['label' => 'Case Study','title' => ($study['client'] ?? 'Case Study').(isset($study['metric']) ? ' — '.$study['metric'] : ''),'subtitle' => $study['industry'] ?? '']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Case Study','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($study['client'] ?? 'Case Study').(isset($study['metric']) ? ' — '.$study['metric'] : '')),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($study['industry'] ?? '')]); ?>
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

    <section class="px-6 py-10 md:py-14">
        <div class="mx-auto max-w-5xl">
            <div class="relative aspect-[16/9] w-full overflow-hidden rounded-2xl border border-border bg-primary/10">
                <?php if(isset($study['thumbnail']) && file_exists(public_path(ltrim($study['thumbnail'], '/')))): ?>
                    <img src="<?php echo e(asset(ltrim($study['thumbnail'], '/'))); ?>" alt="<?php echo e($study['client'] ?? ''); ?>" class="h-full w-full object-cover" loading="lazy" />
                <?php else: ?>
                    <div class="flex h-full w-full items-center justify-center">
                        <span class="font-display text-5xl font-bold text-primary/60">
                            <?php echo e(collect(explode(' ', $study['client'] ?? 'CS'))->take(2)->map(fn ($w) => mb_substr($w, 0, 1))->join('') ?: 'CS'); ?>

                        </span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="px-6 pb-12">
        <div class="mx-auto max-w-5xl">
            <?php
                $metrics = collect($study['metrics'] ?? [])
                    ->filter(fn ($m) => ! empty($m['value']))
                    ->values()
                    ->whenEmpty(fn ($c) => $c->push(['value' => $study['metric'] ?? null, 'label' => $study['metric_label'] ?? '']))
                    ->filter(fn ($m) => ! empty($m['value']));
            ?>
            <?php if($metrics->isNotEmpty()): ?>
                <div class="flex flex-wrap gap-8 rounded-2xl border border-border bg-card px-8 py-8">
                    <?php $__currentLoopData = $metrics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginalebcfdfec81707d32860cca28ed69c00c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalebcfdfec81707d32860cca28ed69c00c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.metric-badge','data' => ['value' => $m['value'] ?? '—','label' => $m['label'] ?? '']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('metric-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($m['value'] ?? '—'),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($m['label'] ?? '')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalebcfdfec81707d32860cca28ed69c00c)): ?>
<?php $attributes = $__attributesOriginalebcfdfec81707d32860cca28ed69c00c; ?>
<?php unset($__attributesOriginalebcfdfec81707d32860cca28ed69c00c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalebcfdfec81707d32860cca28ed69c00c)): ?>
<?php $component = $__componentOriginalebcfdfec81707d32860cca28ed69c00c; ?>
<?php unset($__componentOriginalebcfdfec81707d32860cca28ed69c00c); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php if(! empty($study['challenge']) && ! str_starts_with($study['challenge'], 'PENDING')): ?>
        <section class="px-6 pb-12">
            <div class="mx-auto grid max-w-5xl gap-10 md:grid-cols-2">
                <div>
                    <h3 class="font-display text-2xl font-bold tracking-tight">The Challenge</h3>
                    <p class="mt-4 leading-relaxed text-muted-foreground"><?php echo e($study['challenge']); ?></p>
                </div>
                <?php if(! empty($study['solution']) && ! str_starts_with($study['solution'], 'PENDING')): ?>
                    <div>
                        <h3 class="font-display text-2xl font-bold tracking-tight">The Solution</h3>
                        <p class="mt-4 leading-relaxed text-muted-foreground"><?php echo e($study['solution']); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if(! empty($study['workflow']['steps'])): ?>
        <section class="px-6 pb-12">
            <div class="mx-auto max-w-5xl">
                <h3 class="font-display text-2xl font-bold tracking-tight">Workflow</h3>
                <div class="mt-6">
                    <?php if (isset($component)) { $__componentOriginal99e4394b240ed265a740283a4f97fb30 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal99e4394b240ed265a740283a4f97fb30 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.workflow-diagram','data' => ['steps' => ($study['workflow']['steps'] ?? $study['workflow']) ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('workflow-diagram'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['steps' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($study['workflow']['steps'] ?? $study['workflow']) ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal99e4394b240ed265a740283a4f97fb30)): ?>
<?php $attributes = $__attributesOriginal99e4394b240ed265a740283a4f97fb30; ?>
<?php unset($__attributesOriginal99e4394b240ed265a740283a4f97fb30); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal99e4394b240ed265a740283a4f97fb30)): ?>
<?php $component = $__componentOriginal99e4394b240ed265a740283a4f97fb30; ?>
<?php unset($__componentOriginal99e4394b240ed265a740283a4f97fb30); ?>
<?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="px-6 pb-12">
        <div class="mx-auto max-w-5xl">
            <h3 class="font-display text-2xl font-bold tracking-tight">Tech Stack</h3>
            <div class="mt-6">
                <?php if (isset($component)) { $__componentOriginal4698f32d293c978326be0afce8f65a9a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4698f32d293c978326be0afce8f65a9a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tech-stack','data' => ['tools' => $study['tools'] ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('tech-stack'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tools' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($study['tools'] ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4698f32d293c978326be0afce8f65a9a)): ?>
<?php $attributes = $__attributesOriginal4698f32d293c978326be0afce8f65a9a; ?>
<?php unset($__attributesOriginal4698f32d293c978326be0afce8f65a9a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4698f32d293c978326be0afce8f65a9a)): ?>
<?php $component = $__componentOriginal4698f32d293c978326be0afce8f65a9a; ?>
<?php unset($__componentOriginal4698f32d293c978326be0afce8f65a9a); ?>
<?php endif; ?>
            </div>
        </div>
    </section>

    <?php if(! empty($study['results']) && ! str_starts_with(is_array($study['results']) ? ($study['results'][0] ?? '') : $study['results'], 'PENDING')): ?>
        <section class="px-6 pb-12">
            <div class="mx-auto max-w-5xl">
                <h3 class="font-display text-2xl font-bold tracking-tight">Results</h3>
                <div class="mt-4 leading-relaxed text-muted-foreground">
                    <?php if(is_array($study['results'])): ?>
                        <ul class="list-disc space-y-2 pl-5">
                            <?php $__currentLoopData = $study['results']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($result); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php else: ?>
                        <p><?php echo e($study['results']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="px-6 pb-20">
        <div class="mx-auto flex max-w-5xl flex-col items-start gap-4 sm:flex-row sm:items-center sm:justify-between">
            <?php if(! empty($study['preview_slug'])): ?>
                <a href="<?php echo e(route('preview.show', $study['preview_slug'])); ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-full border border-primary/40 px-6 py-3 text-xs font-semibold uppercase tracking-widest text-primary transition-all duration-300 hover:bg-primary/10">
                    View Live Demo
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3.5"><path d="M7 7h10v10"></path><path d="M7 17 17 7"></path></svg>
                </a>
            <?php endif; ?>
            <a href="<?php echo e(url('/#contact')); ?>" class="inline-flex items-center gap-2 rounded-full bg-primary px-6 py-3 text-xs font-semibold uppercase tracking-widest text-primary-foreground transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30">
                Start a Similar Project
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3.5"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
            </a>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/dgi/www/chada.digital/resources/views/pages/case-study.blade.php ENDPATH**/ ?>