@extends('layouts.frontend')

@section('title', 'Projects | Hux_Ain')

@section('content')
<section class="section-shell">
    <div class="site-shell">
        <div class="section-heading">
            <span class="eyebrow">Portfolio Work</span>
            <h1 class="section-title">Selected projects with a strong focus on utility, performance, and maintainability.</h1>
            <p class="section-copy">Yahan woh work show ho raha hai jahan architecture, delivery aur product thinking saath saath chali.</p>
        </div>

        @if($projects->count() > 0)
            <div class="mt-10 grid gap-6 lg:grid-cols-2 xl:grid-cols-3">
                @foreach($projects as $project)
                    @php $tech = is_array($project->tech_stack) ? $project->tech_stack : json_decode($project->tech_stack, true); @endphp
                    <article class="surface-card p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Project</p>
                                <h2 class="mt-3 text-xl font-semibold text-white">{{ $project->title }}</h2>
                            </div>
                            @if($project->is_featured)
                                <span class="badge-accent">Featured</span>
                            @endif
                        </div>
                        <p class="mt-5 text-sm leading-7 text-slate-300">{{ $project->description }}</p>
                        @if($tech)
                            <div class="mt-6 flex flex-wrap gap-2">
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

            <div class="mt-10">
                {{ $projects->links() }}
            </div>
        @else
            <div class="empty-state mt-10">Abhi koi project publish nahi hua.</div>
        @endif
    </div>
</section>
@endsection
