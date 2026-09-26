<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
@foreach($pages as $url => $meta)
@php
    // Support both string URLs (legacy) and ['url' => ..., 'priority' => ..., ...] arrays.
    if (is_string($url)) {
        $loc = $url; $priority = '0.8'; $changefreq = 'weekly'; $lastmod = null; $images = [];
    } else {
        $loc = $meta['url'] ?? ''; $priority = $meta['priority'] ?? '0.8';
        $changefreq = $meta['changefreq'] ?? 'weekly';
        $lastmod = $meta['lastmod'] ?? null; $images = $meta['images'] ?? [];
    }
@endphp
    <url>
        <loc>{{ $loc }}</loc>
        @if($lastmod)<lastmod>{{ $lastmod }}</lastmod>@endif
        <changefreq>{{ $changefreq }}</changefreq>
        <priority>{{ $priority }}</priority>
        @foreach($images as $img)
        <image:image>
            <image:loc>{{ $img['loc'] }}</image:loc>
            @if(!empty($img['title']))<image:title>{{ $img['title'] }}</image:title>@endif
            @if(!empty($img['caption']))<image:caption>{{ $img['caption'] }}</image:caption>@endif
        </image:image>
        @endforeach
    </url>
@endforeach
</urlset>
