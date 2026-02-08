@extends('layouts.website')

@section('content')
<section class="relative pt-28 md:pt-36 px-6 md:px-12 overflow-hidden">
    <div class="max-w-3xl mx-auto text-center">
        <p class="flex flex-wrap items-center justify-center gap-2 text-sm text-[#333] mb-4">
            <span class="font-semibold text-[#0f0f0f] bg-neutral-100 px-4 py-2 rounded-full">Insight</span>
            <span class="text-[#737373]">{{ $post['date'] ?? now()->format('F j, Y') }}</span>
            <span class="text-[#737373]">·</span>
            <span class="text-[#737373]">{{ $post['read_time'] ?? '4 min read' }}</span>
        </p>
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-[#000000] tracking-tight leading-[1.15] mb-6">
            {{ $post['title'] }}
        </h1>
        <p class="text-lg text-[#333] text-balance">
            {{ $post['excerpt'] }}
        </p>
    </div>
</section>
<section class="relative py-12 md:py-16 px-6 md:px-12">
    <div class="max-w-3xl mx-auto">
        @if(!empty($post['image']))
        <div class="rounded-xl overflow-hidden mb-10 aspect-[16/9] bg-neutral-100 border-2 border-dashed border-neutral-300 p-1">
            <img src="{{ $post['image'] }}" alt="" class="w-full h-full object-cover rounded-lg">
        </div>
        @endif
        <div class="prose prose-gray max-w-none bg-neutral-100 p-8 md:p-10 rounded-xl border border-neutral-200">
            <div class="text-[#333] space-y-6">
                @foreach($post['body'] as $paragraph)
                <p class="leading-relaxed">{{ $paragraph }}</p>
                @endforeach
            </div>
        </div>
    </div>
</section>
@if(!empty($next_posts) && count($next_posts) > 0)
<section class="relative py-16 md:py-24 px-6 md:px-12 border-t border-neutral-200">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-2xl font-bold text-[#0f0f0f] mb-8">Next reads</h2>
        <div class="grid sm:grid-cols-2 gap-8">
            @foreach($next_posts as $next)
            <a href="{{ url('/blog/' . $next['slug']) }}" class="block group">
                <article class="bg-white rounded-xl overflow-hidden border border-neutral-200 shadow-sm group-hover:shadow-md transition-shadow">
                    <div class="aspect-[4/3] bg-neutral-200 overflow-hidden">
                        <img src="{{ $next['image'] }}" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 text-left">
                        <h3 class="text-xl font-bold text-[#0f0f0f] mb-2 group-hover:text-[#333]">{{ $next['title'] }}</h3>
                        <p class="text-[#737373] text-sm leading-relaxed">{{ $next['excerpt'] }}</p>
                    </div>
                </article>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
