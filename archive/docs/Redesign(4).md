# Redesign(4).md — The System Blueprints Section (Pipeline Diagrams)

> **Series:** Redesign(1)–(9) · **This doc:** #4 of 9
> **Builds:** `resources/views/partials/workflow-system.blade.php` (NEW), `resources/views/components/workflow-diagram.blade.php` (upgrade), one-line insert into `pages/home.blade.php`, one config key (already added by Redesign(2))
> **Depends on:** Redesign(2).md (`CaseStudyService::verifiedWorkflows()` must exist)
> **Why this matters:** the pipeline section is the most distinctive element of the architecture we are adopting — visual proof that the agency builds *systems*, not pages. Chada's version is **System Blueprints**: one horizontal pipeline per verified case study, rendered only when the Tech Lead has verified its steps.

```
CONSTRAINTS (repeat in your session — from Redesign(1).md §3):
1.  NEVER touch public/demos/.
2.  mix() not @vite(). 3. bun not npm. 4. ZERO new dependencies.
5.  Preserve route names. 6. Keep contact honeypot. 7. PHP 8.2 constructor
    promotion. 8. Blade components for reusable markup. 9. Follow the Chada
    style charter. 10. Placeholder prose is GENERATED ($real ?? Lorem::…).
11. ORIGINALITY: never copy third-party text/names/prices/metrics; never
    fetch or quote the reference site; these docs are the only reference.
12. Escape apostrophes in single-quoted PHP strings.
13. bun run dev clean after every change; bun run prod before phase done.
14. NEVER invent real-sounding content — pipelines render only when the
    Tech Lead has verified every step (workflow.verified => true).
```

---

## 0. The pattern, described abstractly (the only reference you get)

The section renders, top to bottom:

```
[eyebrow]                       — small uppercase primary label
SYSTEM BLUEPRINTS               — large uppercase display heading (H2)
[one supporting sentence]       — Chada-original line, fixed below
[badge, top-right]              — pill: link icon + "Connected End-to-End"
─────────────────────────────────────────────────────────────
[Pipeline 1 label]              — the client/project it belongs to
[step] → [step] → [step] → [step] → [step]
[Pipeline 2 label]
[step] → [step] → …
…
─────────────────────────────────────────────────────────────
[optional closing speed line]   — ONLY when config gate is set
```

Anatomy to build:
- (a) an uppercase display title,
- (b) a badge pill with an icon,
- (c) N horizontal pipelines, each 4–5 steps joined by arrow connectors, each pipeline labeled with the project it belongs to, each step showing a **bold step name** and a **small uppercase tool/category line** beneath it,
- (d) an optional closing speed-claim line,
- (e) each pipeline row scrolls horizontally on mobile (`overflow-x-auto`),
- (f) the whole section sits on a muted band (`bg-muted/30` + `border-y`) to separate it from card sections.

**Content source (this is the whole point):** pipelines come from `CaseStudyService::verifiedWorkflows()` — one per *verified* case study. Nothing renders until the Tech Lead flips `workflow.verified => true` after confirming every step reflects what was actually built. The speed line comes from `placeholders.workflow_speed_claim` and stays null until David approves a **measured** claim.

**⚠️ Originality note (constraint 11, read twice):** an earlier internal draft of this section quoted another site's pipelines verbatim as "reference". That draft is dead. The pattern above is complete — step boxes, arrows, labels, badge, gating. If you feel you need an external example to "see how it looks", you do not: build exactly what this doc specifies, in Chada's own tokens. The badge text, section title, supporting line, and every pipeline's contents are Chada's own.

---

## TASK 1 — Upgrade `resources/views/components/workflow-diagram.blade.php`

**Current state (verbatim):** renders steps as centered boxes with a chevron SVG between them, wrapped in `overflow-x-auto`. It works, but the boxes are small-caps centered and the label hierarchy is inverted for this pattern (we lead with the step NAME in bold, tool/category as the secondary line).

**Replace with:**

```blade
@props([
    'steps' => [],
    'label' => null,   // optional pipeline label, e.g. client name (renders above the row)
    'compact' => false, // true = tighter boxes for dense pages like the home section
])

@php
    $steps = $steps ?: [];
@endphp

@if(! empty($steps))
    <div class="workflow-pipeline">
        @if($label)
            <p class="mb-3 text-xs font-semibold uppercase tracking-[0.3em] text-primary">{{ $label }}</p>
        @endif
        <div class="overflow-x-auto pb-2">
            <div class="flex min-w-max items-stretch gap-2 md:gap-3">
                @foreach($steps as $index => $step)
                    @if($index > 0)
                        <div class="flex items-center text-primary/70">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5 shrink-0"><path d="m9 18 6-6-6-6"></path></svg>
                        </div>
                    @endif

                    <div @class([
                        'flex flex-col justify-center rounded-xl border border-border bg-card px-5 text-left',
                        'min-w-[150px] py-3' => ! $compact,
                        'min-w-[140px] py-2.5' => $compact,
                    ])>
                        @if(isset($step['step']))
                            <span class="text-sm font-semibold leading-snug text-foreground">{{ $step['step'] }}</span>
                        @endif
                        @if(isset($step['tool']))
                            <span class="mt-1 text-xs uppercase tracking-widest text-muted-foreground">{{ $step['tool'] }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
```

**Backward compatibility:** the case-study detail page calls `<x-workflow-diagram :steps="$study['workflow'] ?? []" />`. After Redesign(2), `$study['workflow']` is `['verified' => bool, 'steps' => [...]]` — a shape mismatch. Fix it NOW in this doc (do not wait for doc 5), otherwise the detail page breaks against the new data shape:

```blade
{{-- resources/views/pages/case-study.blade.php — Workflow section --}}
<x-workflow-diagram :steps="($study['workflow']['steps'] ?? $study['workflow']) ?? []" />
```

That expression passes `steps` when the new shape is present and falls back to the raw array for the legacy shape — safe in both worlds.

---

## TASK 2 — Create `resources/views/partials/workflow-system.blade.php` (NEW)

**Content gate:** the section renders only if `CaseStudyService::verifiedWorkflows()` returns at least one pipeline. Today that is empty (all workflows `verified => false`), so the section renders nothing — correct behavior. The structure is complete and lights up as the Tech Lead verifies workflows.

```blade
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
```

**Why the service is called via `app(...)` in the partial:** every other homepage partial reads `config(...)`. The workflow section needs the service. Calling `app(CaseStudyService::class)->verifiedWorkflows()` inside the partial keeps `home.blade.php` unchanged by content plumbing. Alternative (equally valid, pick with the team): inject in `PageController::home()` as `'workflows' => ...` and pass through the include. If you prefer the controller route, add it to the same PR — but then Redesign(5)'s `$studies` change lands in the same controller method, so coordinate.

**Naming decisions locked in this markup (do not change without Tech Lead approval):**
- Eyebrow: **"Under the Hood"** · Title: **"System Blueprints"** — Chada's own name for the pattern.
- Badge: **"Connected End-to-End"** with a **link icon** — describes what Chada builds, in Chada's vocabulary.
- The supporting sentence is fixed Chada-original copy (chrome, §4 kind A). It is factual about the *design of the section*, makes no numeric claim, and needs no gate.
- Speed-claim icon: a **bolt** (speed), not a warning triangle.

**Speed claim config key:** `placeholders.workflow_speed_claim` was added by Redesign(2) and is null. An approved value must be a **measured** Chada claim, e.g. a sentence describing actual routing time in a shipped system, signed off by David. A number borrowed from anyone else's marketing is a constraint-11 violation and a fabrication — both at once.

---

## TASK 3 — Insert the include into `pages/home.blade.php`

In `resources/views/pages/home.blade.php`, replace the comment line:

```blade
{{-- Redesign(7) inserts: @include('partials.demo-lab') and Redesign(4) inserts: @include('partials.workflow-system') here --}}
```

with (demo-lab is built by Redesign(7) — include only workflow-system now, and leave a one-line comment for doc 7):

```blade
@include('partials.workflow-system')      {{-- 11. NEW — System Blueprints (renders when workflows are verified) --}}
{{-- Redesign(7) inserts: @include('partials.demo-lab') above this line --}}
```

---

## Visual spec details (Chada tokens)

| Element | Spec |
|---|---|
| Section background | `bg-muted/30` with `border-y border-border/60` — visually separates from card sections above/below |
| Section title | `font-display text-3xl md:text-5xl uppercase` — the one all-caps display title on the page (style charter exception, by design) |
| Eyebrow | `text-xs font-semibold uppercase tracking-[0.3em] text-primary` — "Under the Hood" |
| Badge | Pill: `rounded-full border border-primary/30 bg-primary/10 px-4 py-2 text-xs uppercase tracking-widest text-primary` + link icon + "Connected End-to-End" |
| Pipeline label | Client name in `text-xs uppercase tracking-[0.3em] text-primary` above each row |
| Step box | `rounded-xl border border-border bg-card px-5 py-2.5 min-w-[140px]` — step name bold `text-sm`, tool label `text-xs uppercase text-muted-foreground` below |
| Arrow | Chevron SVG in `text-primary/70`, vertically centered between boxes |
| Mobile | Whole row inside `overflow-x-auto` — swipe to scroll the pipeline (already the component's behavior) |
| Speed claim | Centered `text-sm text-muted-foreground` with a bolt icon, only when config value set |

---

## Verification (run all)

```bash
# 1. Component + partial exist
test -f resources/views/components/workflow-diagram.blade.php && echo PASS-component
test -f resources/views/partials/workflow-system.blade.php && echo PASS-partial

# 2. Config key present (added in Redesign(2))
php artisan tinker --execute="var_dump(config('placeholders.workflow_speed_claim'));"   # expect NULL

# 3. With zero verified workflows the section must render NOTHING
php artisan tinker --execute="var_dump(app(\App\Services\CaseStudyService::class)->verifiedWorkflows());"
# expect: [] — and view-source of / must contain no 'workflow-system' id

# 4. Smoke the gate — temporarily flip ONE workflow to verified in a scratch
#    commit (do NOT commit this): set 'verified' => true on sterling-vale,
#    reload /, confirm: section appears, label "Sterling & Vale", 5 step
#    boxes, arrows between, "Connected End-to-End" badge top-right,
#    "System Blueprints" title. Then revert.

# 5. Detail page still renders its workflow (shape compatibility)
#    Visit /case-study/sterling-vale (after temporarily publishing it in the
#    same scratch commit) OR unit-check the blade expression with tinker.

# 6. Originality check (constraint 11) — none of these may appear in the
#    rendered section or the source files:
grep -riE "auto-?synchronized|backend workflow|1\.4 seconds" resources/views/partials/workflow-system.blade.php resources/views/components/workflow-diagram.blade.php
# expect: no matches

# 7. Assets
bun run dev
```

## Definition of done (this doc)

- [ ] `x-workflow-diagram` upgraded (label + compact props, bold-step/tool hierarchy); case-study detail page passes the new shape safely
- [ ] `partials/workflow-system.blade.php` exists with the pattern anatomy: "Under the Hood" eyebrow, "System Blueprints" uppercase title, Connected End-to-End badge with link icon, per-client pipelines, config-gated speed claim with bolt icon
- [ ] `home.blade.php` includes it (position: after founder-bio, before testimonials)
- [ ] Section renders nothing today (verified via view-source) — structure ready, content gated
- [ ] Scratch-test proved the section renders correctly with one verified workflow, then reverted
- [ ] Originality grep (verification step 6) returns zero matches
- [ ] `bun run dev` clean; committed on `feat/v4-r4` as `feat(v4-r4): system blueprints section — pipeline pattern with verified gating`
- [ ] Emoji-free markup (SVG icons only — style charter §5.2 rule 5)

*End of Redesign(4).md — proceed to Redesign(5).md.*
