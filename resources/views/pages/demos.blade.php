@extends('layouts.app')

@section('content')

<section style="background: linear-gradient(135deg, #f8f6f3 0%, #f0ede8 100%); padding: 5rem 0 3rem;">
    <div class="container text-center">
        <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em;">Demo Lab</p>
        <h1 class="display-5 fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">See Our Work in Action</h1>
        <p class="mx-auto" style="max-width: 600px; color: var(--md-sys-color-on-surface-variant); font-size: 1.125rem;">
            Explore live, interactive previews of the systems we have built. Every demo is a real project deployed for a real client.
        </p>
    </div>
</section>

<section style="background: var(--md-sys-color-surface); padding: 3rem 0 5rem;">
    <div class="container">
        <!-- Demo tabs -->
        <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
            @foreach($demos as $index => $demo)
            <button type="button"
                    class="btn demo-tab {{ $index === 0 ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill px-4"
                    data-demo="{{ $demo['slug'] }}"
                    style="{{ $index === 0 ? 'background: var(--md-sys-color-primary); border-color: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary);' : 'border-color: var(--md-sys-color-outline); color: var(--md-sys-color-on-surface-variant);' }} font-weight: 500; font-size: 0.875rem;">
                {{ $demo['title'] }}
            </button>
            @endforeach
        </div>

        <!-- Iframe container -->
        <div class="card border-0 overflow-hidden" style="background: var(--md-sys-color-surface-container-low); border-radius: 16px; box-shadow: 0 4px 16px rgba(0,0,0,0.06);">
            <div class="card-body p-0">
                @foreach($demos as $index => $demo)
                <div class="demo-frame {{ $index === 0 ? '' : 'd-none' }}" data-frame="{{ $demo['slug'] }}">
                    <div class="d-flex align-items-center justify-content-between px-4 py-3" style="background: var(--md-sys-color-surface-container-highest);">
                        <div>
                            <p class="fw-semibold mb-0" style="color: var(--md-sys-color-on-surface); font-size: 0.9375rem;">{{ $demo['title'] }}</p>
                            <p class="mb-0" style="color: var(--md-sys-color-on-surface-variant); font-size: 0.8125rem;">{{ $demo['category'] }}</p>
                        </div>
                        <a href="{{ route('preview.show', $demo['slug']) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill" style="border-color: var(--md-sys-color-primary); color: var(--md-sys-color-primary); font-weight: 500; font-size: 0.75rem;">
                            Open Fullscreen
                        </a>
                    </div>
                    {{-- Load demo content through Laravel's demo.content route.
                         The trailing slash is CRITICAL — without it, the browser treats
                         /demo-content/apexflow as a FILE, not a directory, and resolves
                         relative paths (./assets/css/styles.css) against /demo-content/
                         instead of /demo-content/apexflow/ — causing 404s and MIME mismatch
                         errors. With the trailing slash, relative paths resolve correctly. --}}
                    <div class="ratio ratio-16x9" style="min-height: 600px;">
                        <iframe src="{{ route('demo.content', ['slug' => $demo['slug']]) }}/" title="{{ $demo['title'] }} Preview" style="border: none; width: 100%; height: 100%;" loading="lazy"></iframe>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.querySelectorAll('.demo-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        const slug = this.dataset.demo;

        // Update tabs
        document.querySelectorAll('.demo-tab').forEach(t => {
            t.classList.remove('btn-primary');
            t.classList.add('btn-outline-secondary');
            t.style.background = '';
            t.style.borderColor = 'var(--md-sys-color-outline)';
            t.style.color = 'var(--md-sys-color-on-surface-variant)';
        });
        this.classList.remove('btn-outline-secondary');
        this.classList.add('btn-primary');
        this.style.background = 'var(--md-sys-color-primary)';
        this.style.borderColor = 'var(--md-sys-color-primary)';
        this.style.color = 'var(--md-sys-color-on-primary)';

        // Update frames
        document.querySelectorAll('.demo-frame').forEach(f => {
            f.classList.add('d-none');
        });
        document.querySelector('.demo-frame[data-frame="' + slug + '"]').classList.remove('d-none');
    });
});
</script>
@endpush

@endsection
