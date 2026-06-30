@extends('layouts.frontend')

@section('title', 'Skills | Hux_Ain')

@section('content')
<section class="section-shell">
    <div class="site-shell">
        <div class="section-heading">
            <span class="eyebrow">Tech Stack</span>
            <h1 class="section-title">A practical toolkit for shipping polished Laravel products.</h1>
            <p class="section-copy">Main technologies ko sirf list nahi karta, unhen business use-cases ke hisaab se apply karta hoon.</p>
        </div>

        <div class="mt-10 space-y-8">
            @foreach($categories as $category)
                @if(isset($groupedSkills[$category]) && $groupedSkills[$category]->count() > 0)
                    <section class="surface-card p-6 sm:p-8">
                        <div class="panel-header">
                            <div>
                                <h2 class="text-2xl font-semibold text-white">{{ ucfirst($category) }}</h2>
                                <p class="page-copy">{{ $groupedSkills[$category]->count() }} listed skills in this area.</p>
                            </div>
                            <span class="badge-soft">{{ strtoupper($category) }}</span>
                        </div>
                        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                            @foreach($groupedSkills[$category] as $skill)
                                <div class="subtle-card p-5">
                                    <div class="flex items-center gap-4">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-cyan-400/10 text-cyan-200 ring-1 ring-cyan-300/20">
                                            @if($skill->icon_class)
                                                <i class="{{ $skill->icon_class }}"></i>
                                            @else
                                                <i class="fa-solid fa-code"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-white">{{ $skill->name }}</h3>
                                            <p class="text-sm text-slate-400">{{ $skill->proficiency_level }}% confidence</p>
                                        </div>
                                    </div>
                                    <div class="mt-4 h-2 overflow-hidden rounded-full bg-white/5">
                                        <div class="h-full rounded-full bg-cyan-400" style="width: {{ $skill->proficiency_level }}%"></div>
                                    </div>
                                    @if($skill->is_featured)
                                        <div class="mt-4"><span class="badge-accent">Featured Skill</span></div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endsection
