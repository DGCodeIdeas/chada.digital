<!-- Projects Modal -->
<div id="projects-modal" class="fixed inset-0 z-[100] hidden" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="projects-modal-title">
    <div class="modal-backdrop absolute inset-0 bg-black/70 transition-all duration-300" style="opacity:0;backdrop-filter:blur(0px)"></div>
    <div class="relative flex min-h-full items-center justify-center p-4 sm:p-6">
        <div class="modal-panel relative w-full max-w-6xl max-h-[85dvh] flex flex-col overflow-hidden rounded-2xl border border-border bg-[#0e1b2e] shadow-2xl transition-all duration-300" style="opacity:0;transform:scale(0.95) translateY(1rem)">
            <div class="flex items-center justify-between border-b border-border/50 px-6 py-5 sm:px-8">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">Our Work</span>
                    <h2 id="projects-modal-title" class="mt-1 font-display text-2xl font-bold tracking-tight sm:text-3xl text-foreground">All Projects</h2>
                </div>
                <button type="button" id="projects-modal-close" class="inline-flex size-10 items-center justify-center rounded-full border border-border/60 text-muted-foreground transition-colors hover:border-primary hover:text-primary" aria-label="Close projects modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto p-6 sm:p-8" style="-webkit-overflow-scrolling:touch;overscroll-behavior:contain">
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
                    <a href="<?php echo e(route('preview.show', 'sterling-vale')); ?>" rel="noopener" target="_blank" class="group block overflow-hidden rounded-xl border border-border bg-[#0b1526] transition-all duration-300 hover:-translate-y-1 hover:border-primary/50 hover:shadow-lg hover:shadow-primary/10">
                        <div class="relative overflow-hidden">
                            <img alt="Sterling & Vale" class="aspect-[4/3] w-full object-cover transition-transform duration-700 group-hover:scale-105" src="<?php echo e(asset('assets/images/project-sterling.jpg')); ?>" loading="lazy" />
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0b1526] via-transparent to-transparent opacity-60"></div>
                        </div>
                        <div class="p-5">
                            <h3 class="font-display text-lg font-semibold tracking-tight text-foreground">Sterling & Vale</h3>
                            <p class="mt-1 text-sm text-muted-foreground">Construction Firm — Corporate Website</p>
                            <span class="mt-4 inline-flex items-center gap-1.5 text-xs font-semibold uppercase tracking-widest text-primary transition-colors group-hover:text-primary-foreground">View Site<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                        </div>
                    </a>
                    <a href="<?php echo e(route('preview.show', 'apexflow')); ?>" rel="noopener" target="_blank" class="group block overflow-hidden rounded-xl border border-border bg-[#0b1526] transition-all duration-300 hover:-translate-y-1 hover:border-primary/50 hover:shadow-lg hover:shadow-primary/10">
                        <div class="relative overflow-hidden">
                            <img alt="ApexFlow" class="aspect-[4/3] w-full object-cover transition-transform duration-700 group-hover:scale-105" src="<?php echo e(asset('assets/images/project-apexflow.jpg')); ?>" loading="lazy" />
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0b1526] via-transparent to-transparent opacity-60"></div>
                        </div>
                        <div class="p-5">
                            <h3 class="font-display text-lg font-semibold tracking-tight text-foreground">ApexFlow</h3>
                            <p class="mt-1 text-sm text-muted-foreground">SaaS Platform — AI Automation</p>
                            <span class="mt-4 inline-flex items-center gap-1.5 text-xs font-semibold uppercase tracking-widest text-primary transition-colors group-hover:text-primary-foreground">View Site<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                        </div>
                    </a>
                    <a href="<?php echo e(route('preview.show', 'noir')); ?>" rel="noopener" target="_blank" class="group block overflow-hidden rounded-xl border border-border bg-[#0b1526] transition-all duration-300 hover:-translate-y-1 hover:border-primary/50 hover:shadow-lg hover:shadow-primary/10">
                        <div class="relative overflow-hidden">
                            <img alt="NOIR" class="aspect-[4/3] w-full object-cover transition-transform duration-700 group-hover:scale-105" src="<?php echo e(asset('assets/images/project-noir.jpg')); ?>" loading="lazy" />
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0b1526] via-transparent to-transparent opacity-60"></div>
                        </div>
                        <div class="p-5">
                            <h3 class="font-display text-lg font-semibold tracking-tight text-foreground">NOIR</h3>
                            <p class="mt-1 text-sm text-muted-foreground">E-Commerce — Fashion Store</p>
                            <span class="mt-4 inline-flex items-center gap-1.5 text-xs font-semibold uppercase tracking-widest text-primary transition-colors group-hover:text-primary-foreground">View Site<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                        </div>
                    </a>
                    <a href="<?php echo e(route('preview.show', 'elysian')); ?>" rel="noopener" target="_blank" class="group block overflow-hidden rounded-xl border border-border bg-[#0b1526] transition-all duration-300 hover:-translate-y-1 hover:border-primary/50 hover:shadow-lg hover:shadow-primary/10">
                        <div class="relative overflow-hidden">
                            <img alt="ELYSIAN" class="aspect-[4/3] w-full object-cover transition-transform duration-700 group-hover:scale-105" src="<?php echo e(asset('assets/images/project-elysian.jpg')); ?>" loading="lazy" />
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0b1526] via-transparent to-transparent opacity-60"></div>
                        </div>
                        <div class="p-5">
                            <h3 class="font-display text-lg font-semibold tracking-tight text-foreground">ELYSIAN</h3>
                            <p class="mt-1 text-sm text-muted-foreground">Booking — Hotel & Spa</p>
                            <span class="mt-4 inline-flex items-center gap-1.5 text-xs font-semibold uppercase tracking-widest text-primary transition-colors group-hover:text-primary-foreground">View Site<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                        </div>
                    </a>
                    <a href="<?php echo e(route('preview.show', 'hirebase')); ?>" rel="noopener" target="_blank" class="group block overflow-hidden rounded-xl border border-border bg-[#0b1526] transition-all duration-300 hover:-translate-y-1 hover:border-primary/50 hover:shadow-lg hover:shadow-primary/10">
                        <div class="relative overflow-hidden">
                            <img alt="HIREBASE" class="aspect-[4/3] w-full object-cover transition-transform duration-700 group-hover:scale-105" src="<?php echo e(asset('assets/images/project-hirebase.jpg')); ?>" loading="lazy" />
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0b1526] via-transparent to-transparent opacity-60"></div>
                        </div>
                        <div class="p-5">
                            <h3 class="font-display text-lg font-semibold tracking-tight text-foreground">HIREBASE</h3>
                            <p class="mt-1 text-sm text-muted-foreground">Recruitment — Job Board Platform</p>
                            <span class="mt-4 inline-flex items-center gap-1.5 text-xs font-semibold uppercase tracking-widest text-primary transition-colors group-hover:text-primary-foreground">View Site<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/projects/chadadigital.local/resources/views/partials/projects-modal.blade.php ENDPATH**/ ?>