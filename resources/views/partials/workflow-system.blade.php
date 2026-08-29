@php
    $workflows = app(\App\Services\CaseStudyService::class)->verifiedWorkflows();
    $speedClaim = config('placeholders.workflow_speed_claim'); // null until David approves a MEASURED claim
@endphp

@if(! empty($workflows))
    <section class="border-y border-border/60 bg-muted/30 px-6 py-20 md:py-28" id="workflow-system">
        <div class="mx-auto max-w-7xl">
            <div class="mb-12 flex flex-col items-start justify-between gap-6 md:flex-row md:items-end">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">Under the Hood</span>
                    <h2 class="mt-4 font-display text-3xl font-bold uppercase tracking-tight md:text-5xl">System Blueprints</h2>
                    <p class="mt-4 max-w-xl text-base text-muted-foreground">
                        Every system we ship is a connected pipeline — traffic, capture, follow-up, and delivery wired together. These blueprints show how the verified systems run.
                    </p>
                </div>
                <span class="inline-flex items-center gap-2 rounded-full border border-primary/30 bg-primary/10 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3.5"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                    Connected End-to-End
                </span>
            </div>

            <div class="space-y-8">
                @foreach($workflows as $workflow)
                    <x-workflow-diagram
                        :steps="$workflow['steps']"
                        :label="$workflow['client']"
                        compact
                    />
                @endforeach
            </div>

            @if(! empty($speedClaim))
                <p class="mt-12 text-center text-sm font-medium text-muted-foreground">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 inline size-4 text-primary"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    {{ $speedClaim }}
                </p>
            @endif
        </div>
    </section>
@endif
