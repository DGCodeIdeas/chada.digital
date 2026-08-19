<header class="sticky top-0 z-50 border-b border-neutral-200 bg-background/85 backdrop-blur-xl">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between gap-6 px-6">
        <a class="inline-flex items-center" href="<?php echo e(url('/')); ?>">
            <img alt="Chada Digital — Digital Solutions That Scale Businesses" class="h-12 md:h-14 w-auto object-contain" src="<?php echo e(asset('chada-logo-horizontal.png')); ?>" />
        </a>
        <nav class="hidden items-center gap-7 lg:flex">
            <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="<?php echo e(route('work')); ?>">Work</a>
            <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="<?php echo e(url('/#services')); ?>">Services</a>
            <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="<?php echo e(url('/#process')); ?>">Process</a>
            <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="<?php echo e(url('/#products')); ?>">Products</a>
            <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="<?php echo e(url('/#contact')); ?>">Contact</a>
        </nav>
        <a class="hidden items-center gap-2 rounded-full bg-primary px-5 py-2.5 text-xs font-semibold uppercase tracking-widest text-primary-foreground transition-transform hover:-translate-y-0.5 md:inline-flex" href="<?php echo e(url('/#contact')); ?>">
            Start a Project
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        </a>
        <button id="nav-toggle" aria-expanded="false" aria-label="Toggle menu" class="lg:hidden inline-flex size-10 items-center justify-center rounded-md border border-border text-foreground">
            <svg id="nav-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide-menu size-5"><path d="M4 5h16"></path><path d="M4 12h16"></path><path d="M4 19h16"></path></svg>
        </button>
    </div>
    <div id="mobile-menu" class="hidden lg:hidden" aria-hidden="true">
        <nav class="flex flex-col gap-4 border-t border-border/40 bg-background/95 px-6 py-6 backdrop-blur-xl">
            <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="<?php echo e(route('work')); ?>">Work</a>
            <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="<?php echo e(url('/#services')); ?>">Services</a>
            <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="<?php echo e(url('/#process')); ?>">Process</a>
            <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="<?php echo e(url('/#products')); ?>">Products</a>
            <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="<?php echo e(url('/#contact')); ?>">Contact</a>
            <a class="inline-flex items-center justify-center gap-2 rounded-full bg-primary px-5 py-2.5 text-xs font-semibold uppercase tracking-widest text-primary-foreground transition-transform hover:-translate-y-0.5" href="<?php echo e(url('/#contact')); ?>">Start a Project</a>
        </nav>
    </div>
</header>
<?php /**PATH /home/dgi/www/chada.digital/resources/views/partials/header.blade.php ENDPATH**/ ?>