@extends('layouts.app')

@section('content')
    <section class="px-6 pt-20 md:pt-28">
        <div class="mx-auto max-w-4xl">
            <x-section-header
                label="Case Study"
                :title="($study['client'] ?? 'Case Study').(isset($study['metric']) ? ' — '.$study['metric'] : '')"
                :subtitle="$study['industry'] ?? ''"
            />
        </div>
    </section>

    <section class="px-6 py-10 md:py-14">
        <div class="mx-auto max-w-5xl">
            <div class="relative aspect-[16/9] w-full overflow-hidden rounded-2xl border border-border bg-primary/10">
                @if(isset($study['thumbnail']) && file_exists(public_path(ltrim($study['thumbnail'], '/'))))
                    <img src="{{ asset(ltrim($study['thumbnail'], '/')) }}" alt="{{ $study['client'] ?? '' }}" class="h-full w-full object-cover" loading="lazy" />
                @else
                    <div class="flex h-full w-full items-center justify-center">
                        <span class="font-display text-5xl font-bold text-primary/60">
                            {{ collect(explode(' ', $study['client'] ?? 'CS'))->take(2)->map(fn ($w) => mb_substr($w, 0, 1))->join('') ?: 'CS' }}
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="px-6 pb-12">
        <div class="mx-auto max-w-5xl">
            @php
                $metrics = collect($study['metrics'] ?? [])
                    ->filter(fn ($m) => ! empty($m['value']))
                    ->values()
                    ->whenEmpty(fn ($c) => $c->push(['value' => $study['metric'] ?? null, 'label' => $study['metric_label'] ?? '']))
                    ->filter(fn ($m) => ! empty($m['value']));
            @endphp
            @if($metrics->isNotEmpty())
                <div class="flex flex-wrap gap-8 rounded-2xl border border-border bg-card px-8 py-8">
                    @foreach($metrics as $m)
                        <x-metric-badge :value="$m['value'] ?? '—'" :label="$m['label'] ?? ''" />
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    @if(! empty($study['challenge']) && ! str_starts_with($study['challenge'], 'PENDING'))
        <section class="px-6 pb-12">
            <div class="mx-auto grid max-w-5xl gap-10 md:grid-cols-2">
                <div>
                    <h3 class="font-display text-2xl font-bold tracking-tight">The Challenge</h3>
                    <p class="mt-4 leading-relaxed text-muted-foreground">{{ $study['challenge'] }}</p>
                </div>
                @if(! empty($study['solution']) && ! str_starts_with($study['solution'], 'PENDING'))
                    <div>
                        <h3 class="font-display text-2xl font-bold tracking-tight">The Solution</h3>
                        <p class="mt-4 leading-relaxed text-muted-foreground">{{ $study['solution'] }}</p>
                    </div>
                @endif
            </div>
        </section>
    @endif

    @if(! empty($study['workflow']['steps']))
        <section class="px-6 pb-12">
            <div class="mx-auto max-w-5xl">
                <h3 class="font-display text-2xl font-bold tracking-tight">Workflow</h3>
                <div class="mt-6">
                    <x-workflow-diagram :steps="($study['workflow']['steps'] ?? $study['workflow']) ?? []" />
                </div>
            </div>
        </section>
    @endif

    <section class="px-6 pb-12">
        <div class="mx-auto max-w-5xl">
            <h3 class="font-display text-2xl font-bold tracking-tight">Tech Stack</h3>
            <div class="mt-6">
                <x-tech-stack :tools="$study['tools'] ?? []" />
            </div>
        </div>
    </section>

    @if(! empty($study['results']) && ! str_starts_with(is_array($study['results']) ? ($study['results'][0] ?? '') : $study['results'], 'PENDING'))
        <section class="px-6 pb-12">
            <div class="mx-auto max-w-5xl">
                <h3 class="font-display text-2xl font-bold tracking-tight">Results</h3>
                <div class="mt-4 leading-relaxed text-muted-foreground">
                    @if(is_array($study['results']))
                        <ul class="list-disc space-y-2 pl-5">
                            @foreach($study['results'] as $result)
                                <li>{{ $result }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>{{ $study['results'] }}</p>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <section class="px-6 pb-20">
        <div class="mx-auto flex max-w-5xl flex-col items-start gap-4 sm:flex-row sm:items-center sm:justify-between">
            @if(! empty($study['preview_slug']))
                <a href="{{ route('preview.show', $study['preview_slug']) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-full border border-primary/40 px-6 py-3 text-xs font-semibold uppercase tracking-widest text-primary transition-all duration-300 hover:bg-primary/10">
                    View Live Demo
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3.5"><path d="M7 7h10v10"></path><path d="M7 17 17 7"></path></svg>
                </a>
            @endif
            <a href="{{ url('/#contact') }}" class="inline-flex items-center gap-2 rounded-full bg-primary px-6 py-3 text-xs font-semibold uppercase tracking-widest text-primary-foreground transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30">
                Start a Similar Project
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3.5"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
            </a>
        </div>
    </section>
@endsection
