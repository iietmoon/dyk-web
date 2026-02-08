@extends('layouts.website')

@section('content')
<section class="relative pt-28 md:pt-36 px-6 md:px-12 overflow-hidden">
    <div class="max-w-3xl mx-auto text-center">
        <p class="flex flex-wrap items-center justify-center gap-2 text-sm text-[#333] mb-8">
            <span class="font-semibold text-[#0f0f0f] bg-neutral-100 px-4 py-2 rounded-full">Blog & Insights</span>
        </p>
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-[#000000] tracking-tight leading-[1.1] mb-10">
            Blog & Insights
        </h1>
        <p class="text-lg text-[#333] mb-8">
            Tips, curiosities, and ideas to feed your mind. Short reads that spark learning.
        </p>
    </div>
</section>
<section class="relative py-16 md:py-24 px-6 md:px-12">
    <div class="max-w-6xl mx-auto">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <a href="{{ url('/blog/why-learning-one-fact-a-day-works') }}" class="block group">
                <article class="bg-white rounded-xl overflow-hidden border border-neutral-200 shadow-sm group-hover:shadow-md transition-shadow">
                    <div class="aspect-[4/3] bg-neutral-200 overflow-hidden">
                        <img src="https://picsum.photos/seed/1/400/300" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 text-left">
                        <h2 class="text-xl font-bold text-[#0f0f0f] mb-3 group-hover:text-[#333]">Why Learning One Fact a Day Works</h2>
                        <p class="text-[#737373] text-sm leading-relaxed">We'll explore how short, daily learning builds lasting curiosity and keeps your mind sharp without overwhelm.</p>
                    </div>
                </article>
            </a>
            <a href="{{ url('/blog/curiosity-and-the-brain') }}" class="block group">
                <article class="bg-white rounded-xl overflow-hidden border border-neutral-200 shadow-sm group-hover:shadow-md transition-shadow">
                    <div class="aspect-[4/3] bg-neutral-200 overflow-hidden">
                        <img src="https://picsum.photos/seed/2/400/300" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 text-left">
                        <h2 class="text-xl font-bold text-[#0f0f0f] mb-3 group-hover:text-[#333]">Curiosity and the Brain</h2>
                        <p class="text-[#737373] text-sm leading-relaxed">We'll explore how curiosity rewires the brain and why small doses of new knowledge stick better than cramming.</p>
                    </div>
                </article>
            </a>
            <a href="{{ url('/blog/making-time-for-micro-learning') }}" class="block group">
                <article class="bg-white rounded-xl overflow-hidden border border-neutral-200 shadow-sm group-hover:shadow-md transition-shadow">
                    <div class="aspect-[4/3] bg-neutral-200 overflow-hidden">
                        <img src="https://picsum.photos/seed/3/400/300" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 text-left">
                        <h2 class="text-xl font-bold text-[#0f0f0f] mb-3 group-hover:text-[#333]">Making Time for Micro-Learning</h2>
                        <p class="text-[#737373] text-sm leading-relaxed">We'll explore how to fit learning into busy days—commute, coffee break, or right before bed.</p>
                    </div>
                </article>
            </a>
            <a href="{{ url('/blog/whats-new-in-did-you-know') }}" class="block group">
                <article class="bg-white rounded-xl overflow-hidden border border-neutral-200 shadow-sm group-hover:shadow-md transition-shadow">
                    <div class="aspect-[4/3] bg-neutral-200 overflow-hidden">
                        <img src="https://picsum.photos/seed/4/400/300" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 text-left">
                        <h2 class="text-xl font-bold text-[#0f0f0f] mb-3 group-hover:text-[#333]">What's New in Did You Know?</h2>
                        <p class="text-[#737373] text-sm leading-relaxed">We'll explore how AI and law are working together to create a more equitable legal system.</p>
                    </div>
                </article>
            </a>
            <a href="{{ url('/blog/styling-your-learning-habit') }}" class="block group">
                <article class="bg-white rounded-xl overflow-hidden border border-neutral-200 shadow-sm group-hover:shadow-md transition-shadow">
                    <div class="aspect-[4/3] bg-neutral-200 overflow-hidden">
                        <img src="https://picsum.photos/seed/5/400/300" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 text-left">
                        <h2 class="text-xl font-bold text-[#0f0f0f] mb-3 group-hover:text-[#333]">Styling Your Learning Habit</h2>
                        <p class="text-[#737373] text-sm leading-relaxed">We'll explore how to build a routine that makes curiosity automatic—without feeling like homework.</p>
                    </div>
                </article>
            </a>
            <a href="{{ url('/blog/importing-curiosity-into-your-day') }}" class="block group">
                <article class="bg-white rounded-xl overflow-hidden border border-neutral-200 shadow-sm group-hover:shadow-md transition-shadow">
                    <div class="aspect-[4/3] bg-neutral-200 overflow-hidden">
                        <img src="https://picsum.photos/seed/6/400/300" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 text-left">
                        <h2 class="text-xl font-bold text-[#0f0f0f] mb-3 group-hover:text-[#333]">Importing Curiosity Into Your Day</h2>
                        <p class="text-[#737373] text-sm leading-relaxed">We'll explore how to weave facts and stories into your existing apps and habits for a richer feed.</p>
                    </div>
                </article>
            </a>
        </div>
    </div>
</section>
@endsection
