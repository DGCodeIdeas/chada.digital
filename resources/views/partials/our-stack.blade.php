@php
    $stack = config('martech');
@endphp

<section class="section-padding bg-light" id="stack">
    <div class="container">
        <div class="text-center mb-5">
            <span class="eyebrow">{{ data_get($stack, 'eyebrow', 'Our Stack') }}</span>
            <h2 class="display-5 fw-bold mt-3">{{ data_get($stack, 'title', 'The Tools We Build With') }}</h2>
            <p class="lead text-secondary mt-3 mx-auto" style="max-width: 600px;">{{ data_get($stack, 'subtitle') }}</p>
        </div>

        <div class="row g-4">
            @foreach(data_get($stack, 'categories', []) as $category)
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary flex-shrink-0" style="width: 2.5rem; height: 2.5rem;">
                                    <i class="bi {{ data_get($category, 'icon', 'bi-tools') }}"></i>
                                </span>
                                <h3 class="h6 fw-semibold mb-0">{{ data_get($category, 'name') }}</h3>
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach(data_get($category, 'tools', []) as $tool)
                                    <span class="badge bg-light text-dark border d-inline-flex align-items-center gap-2 px-3 py-2 fw-normal">
                                        <i class="bi {{ data_get($tool, 'icon', 'bi-circle') }} text-primary"></i>
                                        {{ data_get($tool, 'name') }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if(data_get($stack, 'footnote'))
            <p class="text-center text-muted small mt-4">{{ data_get($stack, 'footnote') }}</p>
        @endif
    </div>
</section>
