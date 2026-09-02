@php
    $team = config('founder');
@endphp

<section class="section-padding" id="team">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <div class="founder-portrait d-flex align-items-center justify-content-center">
                    @if(! empty(data_get($team, 'real')) && data_get($team, 'photo'))
                        <img src="{{ data_get($team, 'photo') }}" alt="{{ data_get($team, 'heading', 'The Team') }}" class="img-fluid w-100 h-100 object-fit-cover">
                    @else
                        <div class="text-center">
                            <i class="bi bi-people-fill display-1 text-primary opacity-25"></i>
                            <p class="mt-3 text-muted small">{{ data_get($team, 'heading', 'The Team') }}</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-7">
                <span class="eyebrow">{{ data_get($team, 'eyebrow', 'The Team') }}</span>
                <h2 class="display-5 fw-bold mt-3">Meet <span class="text-primary">The Team.</span></h2>
                <p class="fw-semibold text-secondary mt-2">{{ data_get($team, 'title') ?? 'Founder & Lead Engineer' }}</p>
                <p class="lead text-secondary mt-4">{{ data_get($team, 'bio') ?? 'Chada Digital was built on the belief that African businesses deserve world-class digital infrastructure.' }}</p>
                <ul class="list-unstyled mt-4">
                    @foreach(data_get($team, 'bio_points', []) as $point)
                        <li class="d-flex align-items-start gap-3 mb-3">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary flex-shrink-0" style="width: 1.75rem; height: 1.75rem;">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            <span class="text-secondary">{{ $point }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-4">
                    <a href="{{ url('/#contact') }}" class="btn btn-primary rounded-pill px-4 py-2">{{ data_get($team, 'cta_label') ?? 'Start a Conversation' }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
