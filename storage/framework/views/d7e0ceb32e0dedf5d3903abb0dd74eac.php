<footer class="border-t border-border/40 bg-card/40 px-6 py-16">
    <div class="mx-auto max-w-7xl">
        <div class="flex flex-col gap-10 lg:flex-row lg:items-start lg:justify-between">
            <div class="max-w-xs">
                <img alt="Chada Digital" class="h-10 w-auto object-contain" src="<?php echo e(asset('chada-logo-horizontal.png')); ?>" />
                <p class="mt-4 text-sm leading-relaxed text-muted-foreground">Digital solutions that help businesses grow, automate, and scale.</p>
            </div>
            <nav class="flex flex-wrap items-center gap-x-8 gap-y-3">
                <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="<?php echo e(route('work')); ?>">Work</a>
                <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="<?php echo e(url('/#services')); ?>">Services</a>
                <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="<?php echo e(url('/#process')); ?>">Process</a>
                <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="<?php echo e(url('/#contact')); ?>">Contact</a>
            </nav>
        </div>
        <div class="mt-12 flex flex-col gap-6 border-t border-border/40 pt-8 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-muted-foreground">&copy; <?php echo e(date('Y')); ?> Chada Digital &middot; All rights reserved</p>
            <div class="flex gap-4">
                <a href="#" aria-label="Twitter" class="inline-flex size-10 items-center justify-center rounded-xl border border-border text-muted-foreground transition-colors hover:border-primary hover:text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="size-[18px]"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                </a>
                <a href="#" aria-label="LinkedIn" class="inline-flex size-10 items-center justify-center rounded-xl border border-border text-muted-foreground transition-colors hover:border-primary hover:text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="size-[18px]"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                </a>
                <a href="#" aria-label="Instagram" class="inline-flex size-10 items-center justify-center rounded-xl border border-border text-muted-foreground transition-colors hover:border-primary hover:text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="size-[18px]"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                </a>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH /home/dgi/www/chada.digital/resources/views/partials/footer.blade.php ENDPATH**/ ?>