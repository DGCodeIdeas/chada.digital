<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
<meta name="referrer" content="strict-origin-when-cross-origin" />
<meta name="author" content="Chada Digital" />
<meta name="copyright" content="Chada Digital" />
<meta name="theme-color" content="#0e1b2e" />
<title><?php echo e($meta['title'] ?? config('app.name', 'Chada Digital')); ?></title>
<meta name="description" content="<?php echo e($meta['description'] ?? 'We engineer high-performance websites, command-attention brands, and intelligent automation for ambitious teams across Nigeria and beyond.'); ?>" />
<link rel="canonical" href="<?php echo e($meta['canonical'] ?? 'https://www.chadadigital.com'); ?>" />
<link rel="alternate" hreflang="en_NG" href="<?php echo e($meta['hreflang_en'] ?? 'https://www.chadadigital.com'); ?>" />
<link rel="alternate" hreflang="x-default" href="<?php echo e($meta['hreflang_default'] ?? 'https://www.chadadigital.com'); ?>" />
<meta property="og:url" content="<?php echo e($meta['og_url'] ?? 'https://www.chadadigital.com'); ?>" />
<meta property="og:site_name" content="<?php echo e($meta['og_site_name'] ?? 'Chada Digital'); ?>" />
<meta property="og:title" content="<?php echo e($meta['og_title'] ?? 'Chada Digital — Digital Solutions That Scale Businesses'); ?>" />
<meta property="og:description" content="<?php echo e($meta['og_description'] ?? 'We engineer high-performance websites, command-attention brands, and intelligent automation for ambitious teams across Nigeria and beyond.'); ?>" />
<meta property="og:type" content="<?php echo e($meta['og_type'] ?? 'website'); ?>" />
<meta property="og:locale" content="<?php echo e($meta['og_locale'] ?? 'en_NG'); ?>" />
<meta property="og:image" content="<?php echo e($meta['og_image'] ?? 'https://www.chadadigital.com/og-image.jpg'); ?>" />
<meta property="og:image:secure_url" content="<?php echo e($meta['og_image_secure'] ?? 'https://www.chadadigital.com/og-image.jpg'); ?>" />
<meta property="og:image:type" content="<?php echo e($meta['og_image_type'] ?? 'image/jpeg'); ?>" />
<meta property="og:image:width" content="<?php echo e($meta['og_image_width'] ?? '1216'); ?>" />
<meta property="og:image:height" content="<?php echo e($meta['og_image_height'] ?? '640'); ?>" />
<meta property="og:image:alt" content="<?php echo e($meta['og_image_alt'] ?? 'Chada Digital — Digital Solutions That Scale Businesses'); ?>" />
<meta name="twitter:card" content="<?php echo e($meta['twitter_card'] ?? 'summary_large_image'); ?>" />
<meta name="twitter:title" content="<?php echo e($meta['twitter_title'] ?? 'Chada Digital — Digital Solutions That Scale Businesses'); ?>" />
<meta name="twitter:description" content="<?php echo e($meta['twitter_description'] ?? 'We engineer high-performance websites, command-attention brands, and intelligent automation for ambitious teams across Nigeria and beyond.'); ?>" />
<meta name="twitter:image" content="<?php echo e($meta['twitter_image'] ?? 'https://www.chadadigital.com/og-image.jpg'); ?>" />
<link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" sizes="any" />
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon-32.png')); ?>" />
<link rel="apple-touch-icon" href="<?php echo e(asset('apple-touch-icon.png')); ?>" />
<meta name="msapplication-TileColor" content="#0e1b2e" />
<?php echo $__env->make('partials.structured-data', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/dgi/www/chada.digital/resources/views/partials/meta.blade.php ENDPATH**/ ?>