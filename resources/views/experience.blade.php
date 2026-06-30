@extends('layouts.frontend')

@section('title', 'Experience | Hux_Ain')

@section('content')
<section class="section-shell">
    <div class="site-shell">
        <div class="section-heading">
            <span class="eyebrow">Journey</span>
            <h1 class="section-title">Experience and education that shaped how I build products.</h1>
            <p class="section-copy">Professional work aur academic growth dono ko clear timeline ke sath present kiya gaya hai.</p>
        </div>

        @if($workExperience->count() > 0)
            <div class="mt-10">
                <div class="panel-header">
                    <div>
                        <h2 class="page-title">Work Experience</h2>
                        <p class="page-copy">Hands-on delivery roles and practical engineering work.</p>
                    </div>
                </div>
                <div class="relative space-y-6 pl-12">
                    <div class="timeline-line"></div>
                    @foreach($workExperience as $exp)
                        <article class="surface-card relative p-6 sm:p-7">
                            <div class="timeline-dot"><i class="fa-solid fa-briefcase"></i></div>
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                <div>
                                    <p class="text-sm text-cyan-200">{{ $exp->company }}</p>
                                    <h3 class="mt-2 text-xl font-semibold text-white">{{ $exp->title }}</h3>
                                    <p class="mt-2 text-sm text-slate-400">{{ $exp->location ?? 'Remote' }}</p>
                                </div>
                                <div class="flex flex-col gap-2 sm:items-end">
                                    <span class="{{ $exp->is_current ? 'badge-success' : 'badge-soft' }}">{{ $exp->is_current ? 'Current' : 'Completed' }}</span>
                                    <p class="text-sm text-slate-400">{{ $exp->start_date->format('M Y') }} - {{ $exp->is_current ? 'Present' : optional($exp->end_date)->format('M Y') }}</p>
                                </div>
                            </div>
                            <p class="mt-5 text-sm leading-7 text-slate-300">{{ $exp->description }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif

        @if($education->count() > 0)
            <div class="mt-16">
                <div class="panel-header">
                    <div>
                        <h2 class="page-title">Education</h2>
                        <p class="page-copy">Formal learning that supports the engineering foundation.</p>
                    </div>
                </div>
                <div class="relative space-y-6 pl-12">
                    <div class="timeline-line"></div>
                    @foreach($education as $exp)
                        <article class="surface-card relative p-6 sm:p-7">
                            <div class="timeline-dot"><i class="fa-solid fa-graduation-cap"></i></div>
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                <div>
                                    <p class="text-sm text-cyan-200">{{ $exp->company }}</p>
                                    <h3 class="mt-2 text-xl font-semibold text-white">{{ $exp->title }}</h3>
                                    <p class="mt-2 text-sm text-slate-400">{{ $exp->location ?? 'Karachi, Pakistan' }}</p>
                                </div>
                                <div class="flex flex-col gap-2 sm:items-end">
                                    <span class="{{ $exp->is_current ? 'badge-success' : 'badge-soft' }}">{{ $exp->is_current ? 'In Progress' : 'Completed' }}</span>
                                    <p class="text-sm text-slate-400">{{ $exp->start_date->format('M Y') }} - {{ $exp->end_date ? $exp->end_date->format('M Y') : 'Present' }}</p>
                                </div>
                            </div>
                            <p class="mt-5 text-sm leading-7 text-slate-300">{{ $exp->description }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif

        @if($workExperience->count() == 0 && $education->count() == 0)
            <div class="empty-state mt-10">Experience aur education entries abhi add nahi hui.</div>
        @endif
    </div>
</section>
@endsection
