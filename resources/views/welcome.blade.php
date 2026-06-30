@extends('layouts.frontend')

@section('title', 'Hux_Ain | Full-Stack Laravel Developer')

@section('content')
<section class="section-shell">
    <div class="site-shell hero-grid">
        <div>
            <span class="eyebrow">Available For Freelance & Product Work</span>
            <h1 class="text-balance text-4xl font-semibold tracking-tight text-white sm:text-6xl">
                {{ $profile['title'] }} with a focus on clean product experiences.
            </h1>
            <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">
                {{ $profile['subtitle'] }} I design practical interfaces, reliable Laravel systems, and structured admin flows that are easy to maintain.
            </p>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="{{ route('contact') }}" class="btn-primary">Start a Project</a>
                <a href="{{ route('projects') }}" class="btn-secondary">View Selected Work</a>
            </div>
            <div class="mt-10 grid gap-4 sm:grid-cols-3">
                <div class="stat-card">
                    <p class="stat-label">Featured Projects</p>
                    <p class="stat-number">{{ $featuredProjects->count() }}</p>
                </div>
                <div class="stat-card">
                    <p class="stat-label">Core Skill Groups</p>
                    <p class="stat-number">{{ collect($categories)->filter(fn ($category) => isset($skills[$category]) && $skills[$category]->count())->count() }}</p>
                </div>
                <div class="stat-card">
                    <p class="stat-label">Recent Roles</p>
                    <p class="stat-number">{{ $experiences->count() }}</p>
                </div>
            </div>
        </div>

        <div class="surface-card p-8 sm:p-10">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm uppercase tracking-[0.25em] text-slate-400">Profile Snapshot</p>
                    <h2 class="mt-2 text-2xl font-semibold text-white">{{ $profile['name'] }}</h2>
                    <p class="mt-2 text-sm text-slate-400">{{ $profile['social_name'] }}</p>
                </div>
                <div class="flex h-16 w-16 items-center justify-center rounded-3xl bg-cyan-400/15 text-xl text-cyan-100 ring-1 ring-cyan-300/20">
                    <i class="fa-solid fa-sparkles"></i>
                </div>
            </div>

            <div class="mt-8 grid gap-4">
                <div class="subtle-card p-5">
                    <p class="text-xs uppercase tracking-[0.25em] text-slate-500">About</p>
                    <p class="mt-3 text-sm leading-7 text-slate-300">{{ $profile['about'] }}</p>
                </div>
                <div class="subtle-card p-5">
                    <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Core Strengths</p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <span class="badge-accent">Laravel Apps</span>
                        <span class="badge-soft">REST APIs</span>
                        <span class="badge-soft">MySQL Optimization</span>
                        <span class="badge-soft">Admin Panels</span>
                        <span class="badge-soft">Deployment Workflows</span>
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <a href="mailto:{{ $profile['email'] }}" class="subtle-card p-5 transition hover:border-cyan-300/30">
                        <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Email</p>
                        <p class="mt-3 text-sm text-white">{{ $profile['email'] }}</p>
                    </a>
                    <a href="tel:{{ $profile['phone'] }}" class="subtle-card p-5 transition hover:border-cyan-300/30">
                        <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Phone</p>
                        <p class="mt-3 text-sm text-white">{{ $profile['phone'] }}</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-shell pt-0">
    <div class="site-shell">
        <div class="section-heading">
            <span class="eyebrow">Selected Work</span>
            <h2 class="section-title">Projects that show real problem solving, not just visuals.</h2>
            <p class="section-copy">Each project focuses on usable business outcomes, clean architecture, and scalable implementation.</p>
        </div>

        @if($featuredProjects->count() > 0)
            <div class="mt-10 grid gap-6 lg:grid-cols-3">
                @foreach($featuredProjects as $project)
                    @php $tech = is_array($project->tech_stack) ? $project->tech_stack : json_decode($project->tech_stack, true); @endphp
                    <article class="surface-card p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Featured Project</p>
                                <h3 class="mt-3 text-xl font-semibold text-white">{{ $project->title }}</h3>
                            </div>
                            @if($project->is_featured)
                                <span class="badge-accent"><i class="fa-solid fa-star mr-2"></i>Featured</span>
                            @endif
                        </div>
                        <p class="mt-4 text-sm leading-7 text-slate-300">{{ Str::limit($project->description, 145) }}</p>
                        @if($tech)
                            <div class="mt-5 flex flex-wrap gap-2">
                                @foreach($tech as $item)
                                    <span class="badge-soft">{{ $item }}</span>
                                @endforeach
                            </div>
                        @endif
                        <div class="mt-6 flex flex-wrap gap-3">
                            @if($project->github_link)
                                <a href="{{ $project->github_link }}" target="_blank" class="btn-secondary !py-2.5">GitHub</a>
                            @endif
                            @if($project->live_link)
                                <a href="{{ $project->live_link }}" target="_blank" class="btn-primary !py-2.5">Live Demo</a>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="empty-state mt-10">Featured projects abhi add nahi hue.</div>
        @endif
    </div>
</section>

<section class="section-shell pt-0">
    <div class="site-shell grid gap-8 lg:grid-cols-[1fr_1.1fr]">
        <div class="section-heading">
            <span class="eyebrow">Capabilities</span>
            <h2 class="section-title">A stack built around product delivery.</h2>
            <p class="section-copy">Backend, frontend, DevOps aur tooling ko practical product needs ke hisaab se balance karta hoon.</p>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            @foreach($categories as $category)
                @if(isset($skills[$category]) && $skills[$category]->count() > 0)
                    <div class="surface-card p-6">
                        <div class="flex items-center justify-between gap-3">
                            <h3 class="text-lg font-semibold text-white">{{ ucfirst($category) }}</h3>
                            <span class="badge-soft">{{ $skills[$category]->count() }} tools</span>
                        </div>
                        <div class="mt-5 flex flex-wrap gap-2">
                            @foreach($skills[$category]->take(5) as $skill)
                                <span class="badge-accent">{{ $skill->name }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

<section class="section-shell pt-0">
    <div class="site-shell">
        <div class="panel-header">
            <div>
                <span class="eyebrow">Experience</span>
                <h2 class="section-title">Recent milestones across work and education.</h2>
            </div>
            <a href="{{ route('experience') }}" class="btn-secondary">View Full Timeline</a>
        </div>

        <div class="grid gap-5 lg:grid-cols-3">
            @foreach($experiences as $exp)
                <div class="surface-card p-6">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-xs uppercase tracking-[0.25em] text-slate-500">{{ $exp->company }}</p>
                            <h3 class="mt-2 text-lg font-semibold text-white">{{ $exp->title }}</h3>
                        </div>
                        <span class="{{ $exp->is_current ? 'badge-success' : 'badge-soft' }}">{{ $exp->is_current ? 'Current' : 'Completed' }}</span>
                    </div>
                    <p class="mt-4 text-sm text-slate-400">{{ $exp->start_date->format('M Y') }} - {{ $exp->is_current ? 'Present' : optional($exp->end_date)->format('M Y') }}</p>
                    <p class="mt-4 text-sm leading-7 text-slate-300">{{ Str::limit($exp->description, 135) }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section-shell pt-0">
    <div class="site-shell">
        <div class="surface-card px-6 py-8 sm:px-10 sm:py-10">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div class="max-w-2xl">
                    <span class="eyebrow">Let's Build</span>
                    <h2 class="section-title">Need a polished Laravel product or admin experience?</h2>
                    <p class="section-copy">Agar aapko portfolio site, internal tool, ya custom business app chahiye ho, main strategy se le kar delivery tak help kar sakta hoon.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('contact') }}" class="btn-primary">Send Message</a>
                    <a href="tel:{{ $profile['phone'] }}" class="btn-secondary">Call Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
