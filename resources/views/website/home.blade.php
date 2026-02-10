@extends('layouts.website')

@section('content')
    {{-- Hero: match template — #1 Finance App, 4.8 ★, Personal Finance made smarter., CTAs --}}
    <section class="relative pt-28 md:pt-36 px-6 md:px-12 overflow-hidden">
        <div class="max-w-5xl mx-auto text-center">
            <p class="flex flex-wrap items-center justify-center gap-2 text-sm text-[#333] mb-8">
                <span class="font-semibold text-[#0f0f0f]">#1 The daily curiosity app you’ll love.</span>
                <span class="font-semibold text-neutral-400 inline-flex items-center gap-1">4.8 <svg
                        class="w-4 h-4 text-neutral-300 fill-current shrink-0" viewBox="0 0 20 20"
                        aria-hidden="true">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg></span>
                <span class="font-normal text-neutral-400">across 300+ reviews</span>
            </p>
            <h1
                class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold text-[#000000] tracking-tight leading-[1.1] mb-10">
                Most People Don’t <br>Know most of things
            </h1>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="#google-play"
                    class="px-1 rounded-full bg-[#1E1E1E] border-2 border-neutral-300 shadow-[0_1px_2px_0_rgb(0_0_0_/_0.05),inset_0_1px_0_0_rgba(255,255,255,0.28),inset_0_-1px_0_0_rgba(0,0,0,0.12)]">
                    <img src="{{ asset('icons/google-play.svg') }}" class="rounded-full w-32 object-cover" />
                </a>
                <a href="#google-play"
                    class="px-1 rounded-full bg-[#1E1E1E] border-2 border-neutral-300 shadow-[0_1px_2px_0_rgb(0_0_0_/_0.05),inset_0_1px_0_0_rgba(255,255,255,0.28),inset_0_-1px_0_0_rgba(0,0,0,0.12)]">
                    <img src="{{ asset('icons/app-store.svg') }}" class="rounded-full w-30 object-cover" />
                </a>
            </div>
        </div>
    </section>

    <section class="relative py-26 md:py-32 px-6 md:px-12">
        {{-- Red box ends above the card so the card can stick out below --}}
        <div class="max-w-5xl mx-auto bg-red-500 rounded-2xl pb-24 overflow-visible"
            style="background-image: url('/bg/ab-image.webp'); background-size: cover; background-position: center;">
            <div class="max-w-6xl mx-auto flex justify-center items-center ">
                <img src="/screenshots/hero-image.png" class="w-[75%] h-full mt-[-150px]" />
            </div>
        </div>
        {{-- Card outside the box: pulled up so it overlaps the red box, sticks out below --}}
        <div class="relative mt-[-125px] z-10 max-w-5xl mx-auto px-6 md:px-12">
            <div
                class="bg-white rounded-2xl p-6 md:p-8 shadow-2xl shadow-gray-900/30 max-w-xl mx-auto text-white mb-[-35px] border-2 border-neutral-200">
                <h2 class="text-lg font-bold text-black mb-2 flex items-center gap-2">
                    <span class="text-black">◆</span> Curious about the world around you?
                </h2>
                <hr class="my-2 border-neutral-200">
                <ol class="space-y-3 text-black font-light">
                    <p><strong>Did You Know?</strong> is an app that shares short facts and stories you can read in
                        seconds. It’s designed to make learning easy and enjoyable, helping you discover something
                        new every day.</p>
                </ol>
            </div>
        </div>
    </section>

    <section id="features" class="py-16 md:py-24 px-6 md:px-12 bg-gray-50/50">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold text-primary text-center mb-14">Meet your curiosity buddy</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                {{-- Bento 1: Hero — copy + 3 features + CTA, right = phone --}}
                <div class="md:col-span-2 bg-neutral-100 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10 rounded-3xl p-8 md:p-12 lg:p-16 border border-neutral-200 overflow-hidden">
                    <div class="flex-1 max-w-2xl">
                        <p class="text-gray-600 text-lg mb-8">Choose the topics you love and how you like to learn. We tailor short facts and stories so every visit teaches you something new.</p>
                        <div class="space-y-6 mb-8">
                            <div class="flex gap-4">
                                <div class="w-12 h-12 rounded-xl bg-sky-100 flex items-center justify-center shrink-0 shadow-sm">
                                    <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-primary mb-1">Lightning-fast learning</h4>
                                    <p class="text-gray-600">Read interesting facts and stories in seconds—perfect for quick breaks.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-12 h-12 rounded-xl bg-neutral-800 flex items-center justify-center shrink-0 shadow-sm">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/></svg>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-primary mb-1">Learn on autopilot</h4>
                                    <p class="text-gray-600">New discoveries arrive daily, no effort required.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-12 h-12 rounded-xl bg-neutral-200 flex items-center justify-center shrink-0 shadow-sm">
                                    <svg class="w-6 h-6 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-primary mb-1">Stay curious every day</h4>
                                    <p class="text-gray-600">Turn small moments into daily learning habits.</p>
                                </div>
                            </div>
                        </div>
                        <a href="#pricing" class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-primary text-white font-semibold hover:bg-gray-800 transition-colors shadow-lg hover:shadow-xl w-fit">Get started for free <span aria-hidden="true">›</span></a>
                    </div>
                    <div class="relative flex items-center justify-center lg:justify-end min-h-[280px] lg:min-h-[320px] lg:w-[320px] shrink-0">
                        <img src="/screenshots/home-iphone.png" alt="" class="w-124 object-contain object-center z-10 rotate-[-25deg] translate-y-[10px] absolute top-0 left-0" />
                    </div>
                </div>
                {{-- Bento 2: Receive great knowledge, fast --}}
                <div class="bg-[#1E1E1E] rounded-3xl p-6 md:p-8 overflow-hidden flex flex-col min-h-[340px] md:min-h-[380px]">
                    <h3 class="text-xl md:text-2xl font-bold text-white mb-1">Receive great knowledge, fast</h3>
                    <p class="text-gray-400 text-sm mb-4">Be the first to discover new facts and stories.</p>
                    <div class="relative flex-1 min-h-0">
                        <div class="relative z-10 flex justify-center mb-4">
                            <div class="flex items-center gap-2 bg-white rounded-full pl-4 pr-1.5 py-1.5 shadow-lg w-full max-w-full min-h-[44px]">
                                <div class="flex flex-wrap items-center gap-1.5 flex-1 min-w-0">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-neutral-100 text-neutral-700 text-xs font-medium">Tech</span>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-neutral-100 text-neutral-700 text-xs font-medium">Science</span>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-neutral-100 text-neutral-700 text-xs font-medium">History</span>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-neutral-100 text-neutral-700 text-xs font-medium">Nature</span>
                                </div>
                                <button type="button" class="w-8 h-8 rounded-full bg-neutral-800 flex items-center justify-center shrink-0 text-white hover:bg-neutral-700 transition-colors" aria-label="Add topic">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2 relative">
                            <article class="rounded-xl bg-neutral-800/80 border border-neutral-700/50 min-h-[72px] flex items-center p-3">
                                <h4 class="font-bold text-white text-xs leading-tight line-clamp-2">Did you know that honey never spoils, even after thousands of years?</h4>
                            </article>
                            <article class="rounded-xl bg-neutral-800/80 border border-neutral-700/50 min-h-[72px] flex items-center p-3">
                                <h4 class="font-bold text-white text-xs leading-tight line-clamp-2">Did you know your brain uses more energy than any other organ?</h4>
                            </article>
                            <article class="rounded-xl bg-neutral-800/80 border border-neutral-700/50 min-h-[72px] flex items-center p-3">
                                <h4 class="font-bold text-white text-xs leading-tight line-clamp-2">Did you know that octopuses have three hearts?</h4>
                            </article>
                            <article class="rounded-xl bg-neutral-800/80 border border-neutral-700/50 min-h-[72px] flex items-center p-3">
                                <h4 class="font-bold text-white text-xs leading-tight line-clamp-2">Did you know that the Eiffel Tower grows in summer?</h4>
                            </article>
                        </div>
                        <p class="text-center text-gray-500 text-xs mt-3">Discover top facts and stories curated by our editors.</p>
                    </div>
                </div>
                {{-- Bento 3: Grow your knowledge (green bg + knowledge progress card) --}}
                <div class="rounded-3xl overflow-hidden flex flex-col min-h-[340px] md:min-h-[380px]" style="background-image: url('/bg/fe-image.webp'); background-size: cover; background-position: center;">
                    <div class="p-6 md:p-8 flex-1 flex flex-col" style="background: linear-gradient(160deg, rgba(26,61,46,0.85) 0%, rgba(45,90,69,0.85) 40%, rgba(30,74,56,0.85) 100%);">
                        <h3 class="text-xl md:text-2xl font-bold text-white mb-1">Grow your knowledge</h3>
                        <p class="text-gray-300 text-sm mb-4">Turn curiosity into lasting understanding.</p>
                        <div class="rounded-2xl p-5 md:p-6 shadow-xl border border-white/10 bg-white/90 backdrop-blur-md flex-1 flex flex-col min-h-0">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="text-neutral-600 text-xs" aria-hidden="true">◆</span>
                                <p class="text-xs font-medium text-neutral-600">Your knowledge progress</p>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 pb-4 border-b border-neutral-200">
                                <div>
                                    <h4 class="text-lg font-bold text-neutral-900">Your Learning</h4>
                                    <p class="text-xs text-neutral-500">Daily discoveries.</p>
                                </div>
                                <div class="flex flex-col items-end">
                                    <p class="text-xl font-bold text-neutral-900">1,248</p>
                                    <p class="text-emerald-600 font-semibold text-xs">This week +23</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3 pt-4">
                                <div><p class="text-xs font-semibold text-neutral-600">Facts read</p><p class="font-bold text-neutral-900 text-sm">1,248</p></div>
                                <div><p class="text-xs font-semibold text-neutral-600">This week</p><p class="font-bold text-emerald-600 text-sm">+23</p></div>
                                <div><p class="text-xs font-semibold text-neutral-600">Topics explored</p><p class="font-bold text-neutral-900 text-sm">12</p></div>
                                <div><p class="text-xs font-semibold text-neutral-600">Learning streak</p><p class="font-bold text-neutral-900 text-sm">7 days</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 md:py-24 px-6 md:px-12" id="fits-into-your-day">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold text-primary text-center mb-14">Made for every moment</h2>
            <div class="flex flex-wrap justify-center gap-x-8 gap-y-2 mb-12 pb-0">
                <button type="button" class="fits-tab px-1 py-3 font-medium text-sm inline-flex items-center gap-2 transition-colors border-b-2 border-primary text-primary -mb-px" data-tab="0" aria-pressed="true">
                    <span aria-hidden="true">🚇</span> On your commute
                </button>
                <button type="button" class="fits-tab px-1 py-3 font-medium text-sm inline-flex items-center gap-2 text-gray-400 hover:text-gray-600 transition-colors border-b-2 border-gray-200 -mb-px" data-tab="1" aria-pressed="false">
                    <span aria-hidden="true">☕</span> With your morning coffee
                </button>
                <button type="button" class="fits-tab px-1 py-3 font-medium text-sm inline-flex items-center gap-2 text-gray-400 hover:text-gray-600 transition-colors border-b-2 border-gray-200 -mb-px" data-tab="2" aria-pressed="false">
                    <span aria-hidden="true">📱</span> During short breaks
                </button>
                <button type="button" class="fits-tab px-1 py-3 font-medium text-sm inline-flex items-center gap-2 text-gray-400 hover:text-gray-600 transition-colors border-b-2 border-gray-200 -mb-px" data-tab="3" aria-pressed="false">
                    <span aria-hidden="true">🌙</span> Before you sleep
                </button>
            </div>
            <div class="rounded-3xl overflow-hidden bg-gray-200 h-[550px] relative">
                <img src="/bg/commute-image.webp" alt="" class="fits-image absolute inset-0 w-full h-full object-cover object-center" id="fits-image-0">
                <img src="/bg/morning-coffee-image.webp" alt="" class="fits-image absolute inset-0 w-full h-full object-cover object-center hidden" id="fits-image-1">
                <img src="/bg/short-break-image.webp" alt="" class="fits-image absolute inset-0 w-full h-full object-cover object-center hidden" id="fits-image-2">
                <img src="/bg/before-sleep-image.webp" alt="" class="fits-image absolute inset-0 w-full h-full object-cover object-center hidden" id="fits-image-3">
                <div class="absolute w-full bottom-0 left-0 right-0 pt-16 pb-6 px-6 md:px-8 bg-gradient-to-t from-black/90 via-black/50 to-transparent fits-content">
                    <h3 class="text-3xl font-bold text-white mb-2 fits-title">On your commute.</h3>
                    <p class="text-white/90 text-lg max-w-xl fits-desc">Stuck on the metro or waiting in traffic? Read one short fact and turn idle time into learning.</p>
                </div>
            </div>
        </div>
    </section>
    <script>
    (function() {
        var tabs = document.querySelectorAll('#fits-into-your-day .fits-tab');
        var images = document.querySelectorAll('#fits-into-your-day .fits-image');
        var titleEl = document.querySelector('#fits-into-your-day .fits-title');
        var descEl = document.querySelector('#fits-into-your-day .fits-desc');
        var content = [
            { title: 'On your commute.', desc: 'Stuck on the metro or waiting in traffic? Read one short fact and turn idle time into learning.' },
            { title: 'With your morning coffee.', desc: 'Start your day with something interesting. One quick read is enough to spark your curiosity.' },
            { title: 'During short breaks.', desc: 'Got a few minutes between tasks? Scroll, read, and discover something new—fast.' },
            { title: 'Before you sleep.', desc: 'End the day with a calm, thoughtful read. Learn something new without overstimulating your mind.' },
            { title: 'And really, for everyone.', desc: "Whether you're a student, a professional, or just curious by nature, Did You Know? fits into your day—anytime, anywhere." }
        ];
        tabs.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var i = parseInt(this.getAttribute('data-tab'), 10);
                tabs.forEach(function(b) {
                    b.classList.remove('border-primary', 'text-primary');
                    b.classList.add('border-gray-200', 'text-gray-400');
                    b.setAttribute('aria-pressed', 'false');
                });
                this.classList.add('border-primary', 'text-primary');
                this.classList.remove('border-gray-200', 'text-gray-400');
                this.setAttribute('aria-pressed', 'true');
                images.forEach(function(img, j) { img.classList.toggle('hidden', j !== i); img.classList.toggle('block', j === i); });
                if (titleEl) titleEl.textContent = content[i].title;
                if (descEl) descEl.textContent = content[i].desc;
            });
        });
        images[0].classList.remove('hidden'); images[0].classList.add('block');
    })();
    </script>

    <section id="testimonials" class="py-16 md:py-24 px-6 md:px-12 bg-gray-50/50">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold text-primary text-center mb-14">Hear it from our lovers</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                <article class="bg-white rounded-2xl p-8 bg-neutral-100 border border-gray-200">
                    <div class="flex items-start gap-4 mb-6">
                        <img src="https://tapback.co/api/avatar/SarahM.webp" alt="" class="w-14 h-14 rounded-full object-cover flex-shrink-0 bg-blue-100" width="56" height="56">
                        <div>
                            <h4 class="font-bold text-primary">Sarah M.</h4>
                            <p class="text-sm text-gray-500">Product Designer</p>
                        </div>
                    </div>
                    <hr class="my-4 border-gray-200">
                    <p class="text-primary font-bold text-lg leading-snug relative">"I open it without thinking now. One fact a day sounds small, but it really adds up."</p>
                </article>
                <article class="bg-white rounded-2xl p-8 bg-neutral-100 border border-gray-200">
                    <div class="flex items-start gap-4 mb-6">
                        <img src="https://tapback.co/api/avatar/YoussefK.webp" alt="" class="w-14 h-14 rounded-full object-cover flex-shrink-0 bg-blue-100" width="56" height="56">
                        <div>
                            <h4 class="font-bold text-primary">Youssef K.</h4>
                            <p class="text-sm text-gray-500">Consultant</p>
                        </div>
                    </div>
                    <hr class="my-4 border-gray-200">
                    <p class="text-primary font-bold text-lg leading-snug relative">"It's the only app that makes me feel smarter without demanding my time."</p>
                </article>
                <article class="bg-white rounded-2xl p-8 bg-neutral-100 border border-gray-200">
                    <div class="flex items-start gap-4 mb-6">
                        <img src="https://tapback.co/api/avatar/LinaR.webp" alt="" class="w-14 h-14 rounded-full object-cover flex-shrink-0 bg-blue-100" width="56" height="56">
                        <div>
                            <h4 class="font-bold text-primary">Lina R.</h4>
                            <p class="text-sm text-gray-500">University Student</p>
                        </div>
                    </div>
                    <hr class="my-4 border-gray-200">
                    <p class="text-primary font-bold text-lg leading-snug relative">"I replaced mindless scrolling with this. Best decision."</p>
                </article>
                <article class="bg-white rounded-2xl p-8 bg-neutral-100 border border-gray-200">
                    <div class="flex items-start gap-4 mb-6">
                        <img src="https://tapback.co/api/avatar/DanielT.webp" alt="" class="w-14 h-14 rounded-full object-cover flex-shrink-0 bg-blue-100" width="56" height="56">
                        <div>
                            <h4 class="font-bold text-primary">Daniel T.</h4>
                            <p class="text-sm text-gray-500">Software Engineer</p>
                        </div>
                    </div>
                    <hr class="my-4 border-gray-200">
                    <p class="text-primary font-bold text-lg leading-snug relative">"Short, surprising, and oddly calming. I love reading it before bed."</p>
                </article>
                <article class="bg-white rounded-2xl p-8 bg-neutral-100 border border-gray-200">
                    <div class="flex items-start gap-4 mb-6">
                        <img src="https://tapback.co/api/avatar/AmineB.webp" alt="" class="w-14 h-14 rounded-full object-cover flex-shrink-0 bg-blue-100" width="56" height="56">
                        <div>
                            <h4 class="font-bold text-primary">Amine B.</h4>
                            <p class="text-sm text-gray-500">Marketing Lead</p>
                        </div>
                    </div>
                    <hr class="my-4 border-gray-200">
                    <p class="text-primary font-bold text-lg leading-snug relative">"I always end up sharing what I learn here with friends. It starts great conversations."</p>
                </article>
                <article class="bg-white rounded-2xl p-8 bg-neutral-100 border border-gray-200">
                    <div class="flex items-start gap-4 mb-6">
                        <img src="https://tapback.co/api/avatar/EmmaL.webp" alt="" class="w-14 h-14 rounded-full object-cover flex-shrink-0 bg-blue-100" width="56" height="56">
                        <div>
                            <h4 class="font-bold text-primary">Emma L.</h4>
                            <p class="text-sm text-gray-500">Writer</p>
                        </div>
                    </div>
                    <hr class="my-4 border-gray-200">
                    <p class="text-primary font-bold text-lg leading-snug relative">"It reminds me how much there still is to learn—without feeling overwhelming."</p>
                </article>
                <article class="bg-white rounded-2xl p-8 bg-neutral-100 border border-gray-200">
                    <div class="flex items-start gap-4 mb-6">
                        <img src="https://tapback.co/api/avatar/OmarS.webp" alt="" class="w-14 h-14 rounded-full object-cover flex-shrink-0 bg-blue-100" width="56" height="56">
                        <div>
                            <h4 class="font-bold text-primary">Omar S.</h4>
                            <p class="text-sm text-gray-500">Startup Founder</p>
                        </div>
                    </div>
                    <hr class="my-4 border-gray-200">
                    <p class="text-primary font-bold text-lg leading-snug relative">"Perfect for those little moments between things. I always learn something."</p>
                </article>
                <article class="bg-white rounded-2xl p-8 bg-neutral-100 border border-gray-200">
                    <div class="flex items-start gap-4 mb-6">
                        <img src="https://tapback.co/api/avatar/ClaraP.webp" alt="" class="w-14 h-14 rounded-full object-cover flex-shrink-0 bg-blue-100" width="56" height="56">
                        <div>
                            <h4 class="font-bold text-primary">Clara P.</h4>
                            <p class="text-sm text-gray-500">Content Strategist</p>
                        </div>
                    </div>
                    <hr class="my-4 border-gray-200">
                    <p class="text-primary font-bold text-lg leading-snug relative">"It feels thoughtfully made. No noise, just interesting ideas."</p>
                </article>
                <article class="bg-white rounded-2xl p-8 bg-neutral-100 border border-gray-200">
                    <div class="flex items-start gap-4 mb-6">
                        <img src="https://tapback.co/api/avatar/NathanD.webp" alt="" class="w-14 h-14 rounded-full object-cover flex-shrink-0 bg-blue-100" width="56" height="56">
                        <div>
                            <h4 class="font-bold text-primary">Nathan D.</h4>
                            <p class="text-sm text-gray-500">High School Teacher</p>
                        </div>
                    </div>
                    <hr class="my-4 border-gray-200">
                    <p class="text-primary font-bold text-lg leading-snug relative">"Five minutes in, and my curiosity is already awake."</p>
                </article>
            </div>
        </div>
        <div class="bg-gradient-to-b from-transparent to-white h-[250px] w-full flex relative -mt-[250px]"></div>
    </section>

    <section id="pricing" class="py-16 md:py-24 px-6 md:px-12">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold text-primary text-center mb-6">Curiosity, unlocked</h2>
            <p class="text-gray-600 text-center mb-12">Upgrade to explore without limits.</p>
            <div class="grid md:grid-cols-3 gap-6 lg:gap-8 items-stretch">
                {{-- Free --}}
                <div class="rounded-2xl bg-white border border-gray-200 p-2 flex flex-col shadow-sm bg-neutral-100">
                    <div class="flex flex-col gap-2 mb-4 bg-white shadow-md p-4 rounded-xl border border-gray-200">
                        <h3 class="text-2xl font-bold text-primary">Always Free</h3>
                        <p class="text-gray-600 text-sm">Start exploring and build curiosity habits.</p>
                        <p><span class="text-3xl font-bold text-primary">$0</span></p>
                        <a href="#" class="inline-flex items-center justify-center gap-2 w-full py-3 px-4 rounded-xl bg-primary text-white font-semibold text-sm hover:bg-gray-800 transition-colors">Get started <span aria-hidden="true">›</span></a>
                    </div>
                    <div class="p-4">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-4">What's included:</p>
                        <ul class="space-y-3 flex-1 text-gray-700 text-sm">
                            <li class="flex items-start gap-3"><span class="text-primary mt-0.5">◆</span> 5 facts per day</li>
                            <li class="flex items-start gap-3"><span class="text-primary mt-0.5">◆</span> Access to general topics only</li>
                            <li class="flex items-start gap-3"><span class="text-gray-400 mt-0.5">◆</span> With ads</li>
                            <li class="flex items-start gap-3"><span class="text-gray-400 mt-0.5">◆</span> No personalization</li>
                            <li class="flex items-start gap-3"><span class="text-gray-400 mt-0.5">◆</span> No recommendations</li>
                        </ul>
                    </div>
                </div>
                {{-- Monthly --}}
                <div class="rounded-2xl bg-white border border-gray-200 p-2 flex flex-col bg-neutral-100 shadow-sm">
                    <div class="flex flex-col gap-2 mb-4 bg-white shadow-md p-4 rounded-xl border border-gray-200">
                        <h3 class="text-2xl font-bold text-primary">Monthly</h3>
                        <p class="text-gray-600 text-sm">Exploring more and extend your curiosity.</p>
                        <p><span class="text-3xl font-bold text-primary">$2.99</span> <span class="text-gray-600 text-sm">/ month</span></p>
                        <a href="#" class="inline-flex items-center justify-center gap-2 w-full py-3 px-4 rounded-xl bg-primary text-white font-semibold text-sm hover:bg-gray-800 transition-colors">Subscribe <span aria-hidden="true">›</span></a>
                    </div>
                    <div class="p-4">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-4">What's included:</p>
                        <ul class="space-y-3 flex-1 text-gray-700 text-sm">
                            <li class="flex items-start gap-3"><span class="text-primary mt-0.5">◆</span> Unlimited facts & stories</li>
                            <li class="flex items-start gap-3"><span class="text-primary mt-0.5">◆</span> Access to all topics & categories</li>
                            <li class="flex items-start gap-3"><span class="text-primary mt-0.5">◆</span> Offline reading</li>
                            <li class="flex items-start gap-3"><span class="text-primary mt-0.5">◆</span> Ad-free experience</li>
                            <li class="flex items-start gap-3"><span class="text-primary mt-0.5">◆</span> Personalized feed / recommendations</li>
                        </ul>
                    </div>
                </div>
                {{-- Yearly --}}
                <div class="rounded-2xl bg-white border border-gray-200 p-2 flex flex-col shadow-sm bg-black">
                    <div class="flex flex-col gap-2 mb-4 bg-white/15 p-4 rounded-xl border border-white/10">
                        <h3 class="text-2xl font-bold text-white">Yearly</h3>
                        <p class="text-white text-sm">Your curiosity, for a whole year.</p>
                        <p><span class="text-3xl font-bold text-white">$19.99</span> <span class="text-white text-sm">/ year</span></p>
                        <a href="#" class="inline-flex items-center justify-center gap-2 w-full py-3 px-4 rounded-xl bg-white text-black font-semibold text-sm hover:bg-gray-800 transition-colors">Subscribe <span aria-hidden="true">›</span></a>
                    </div>
                    <div class="p-4">
                        <p class="text-xs font-semibold text-white/50 uppercase tracking-wide mb-4">What's included:</p>
                        <ul class="space-y-3 flex-1 text-white text-sm">
                            <li class="flex items-start gap-3"><span class="text-white mt-0.5">◆</span> Unlimited facts & stories</li>
                            <li class="flex items-start gap-3"><span class="text-white mt-0.5">◆</span> Access to all topics & categories</li>
                            <li class="flex items-start gap-3"><span class="text-white mt-0.5">◆</span> Offline reading</li>
                            <li class="flex items-start gap-3"><span class="text-white mt-0.5">◆</span> Ad-free experience</li>
                            <li class="flex items-start gap-3"><span class="text-white mt-0.5">◆</span> Personalized feed / recommendations</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="faq" class="py-16 md:py-24 px-6 md:px-12 bg-gray-50/50">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold text-primary text-center mb-12">Frequently asked questions</h2>
            <div class="space-y-4 [&_details]:bg-white [&_details]:rounded-xl">
                <details class="group">
                    <summary class="flex items-center justify-between gap-4 cursor-pointer list-none py-4 px-6 font-bold text-primary bg-neutral-100 hover:bg-neutral-200 rounded-xl transition-colors [&::-webkit-details-marker]:hidden">
                        <span class="text-xl">What is Did You Know?</span>
                        <span class="flex-shrink-0 w-5 h-5 flex items-center justify-center text-gray-400 group-open:rotate-180 transition-transform" aria-hidden="true"><svg class="w-full h-full" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></span>
                    </summary>
                    <p class="text-gray-600 text-sm px-6 pb-4 pt-0">Did You Know? is a daily feed of short facts and stories designed to help you learn something new every day—fast, easy, and enjoyable.</p>
                </details>
                <details class="group">
                    <summary class="flex items-center justify-between gap-4 cursor-pointer list-none py-4 px-6 font-bold text-primary bg-neutral-100 hover:bg-neutral-200 rounded-xl transition-colors [&::-webkit-details-marker]:hidden">
                        <span class="text-xl">How is it different from articles or news apps?</span>
                        <span class="flex-shrink-0 w-5 h-5 flex items-center justify-center text-gray-400 group-open:rotate-180 transition-transform" aria-hidden="true"><svg class="w-full h-full" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></span>
                    </summary>
                    <p class="text-gray-600 text-sm px-6 pb-4 pt-0">Everything is short, focused, and surprising. No long reads, no noise—just ideas worth remembering.</p>
                </details>
                <details class="group">
                    <summary class="flex items-center justify-between gap-4 cursor-pointer list-none py-4 px-6 font-bold text-primary bg-neutral-100 hover:bg-neutral-200 rounded-xl transition-colors [&::-webkit-details-marker]:hidden">
                        <span class="text-xl">How much time does it take each day?</span>
                        <span class="flex-shrink-0 w-5 h-5 flex items-center justify-center text-gray-400 group-open:rotate-180 transition-transform" aria-hidden="true"><svg class="w-full h-full" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></span>
                    </summary>
                    <p class="text-gray-600 text-sm px-6 pb-4 pt-0">Most people spend 2–5 minutes a day. One fact is enough to learn something new.</p>
                </details>
                <details class="group">
                    <summary class="flex items-center justify-between gap-4 cursor-pointer list-none py-4 px-6 font-bold text-primary bg-neutral-100 hover:bg-neutral-200 rounded-xl transition-colors [&::-webkit-details-marker]:hidden">
                        <span class="text-xl">Is the app free?</span>
                        <span class="flex-shrink-0 w-5 h-5 flex items-center justify-center text-gray-400 group-open:rotate-180 transition-transform" aria-hidden="true"><svg class="w-full h-full" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></span>
                    </summary>
                    <p class="text-gray-600 text-sm px-6 pb-4 pt-0">Yes. You can explore for free with ads. Upgrade to Premium to remove ads and unlock unlimited topics.</p>
                </details>
                <details class="group">
                    <summary class="flex items-center justify-between gap-4 cursor-pointer list-none py-4 px-6 font-bold text-primary bg-neutral-100 hover:bg-neutral-200 rounded-xl transition-colors [&::-webkit-details-marker]:hidden">
                        <span class="text-xl">What do I get with Premium?</span>
                        <span class="flex-shrink-0 w-5 h-5 flex items-center justify-center text-gray-400 group-open:rotate-180 transition-transform" aria-hidden="true"><svg class="w-full h-full" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></span>
                    </summary>
                    <p class="text-gray-600 text-sm px-6 pb-4 pt-0">No ads · Unlimited access to all topics · New content every day · A calmer, focused reading experience.</p>
                </details>
                <details class="group">
                    <summary class="flex items-center justify-between gap-4 cursor-pointer list-none py-4 px-6 font-bold text-primary bg-neutral-100 hover:bg-neutral-200 rounded-xl transition-colors [&::-webkit-details-marker]:hidden">
                        <span class="text-xl">How much does Premium cost?</span>
                        <span class="flex-shrink-0 w-5 h-5 flex items-center justify-center text-gray-400 group-open:rotate-180 transition-transform" aria-hidden="true"><svg class="w-full h-full" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></span>
                    </summary>
                    <p class="text-gray-600 text-sm px-6 pb-4 pt-0">Premium is $2.99/month, or $29/year — cheaper than most knowledge and reading apps.</p>
                </details>
                <details class="group">
                    <summary class="flex items-center justify-between gap-4 cursor-pointer list-none py-4 px-6 font-bold text-primary bg-neutral-100 hover:bg-neutral-200 rounded-xl transition-colors [&::-webkit-details-marker]:hidden">
                        <span class="text-xl">Can I cancel anytime?</span>
                        <span class="flex-shrink-0 w-5 h-5 flex items-center justify-center text-gray-400 group-open:rotate-180 transition-transform" aria-hidden="true"><svg class="w-full h-full" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></span>
                    </summary>
                    <p class="text-gray-600 text-sm px-6 pb-4 pt-0">Yes. You can cancel anytime from your App Store or Google Play settings.</p>
                </details>
                <details class="group">
                    <summary class="flex items-center justify-between gap-4 cursor-pointer list-none py-4 px-6 font-bold text-primary bg-neutral-100 hover:bg-neutral-200 rounded-xl transition-colors [&::-webkit-details-marker]:hidden">
                        <span class="text-xl">Is this app good for all ages?</span>
                        <span class="flex-shrink-0 w-5 h-5 flex items-center justify-center text-gray-400 group-open:rotate-180 transition-transform" aria-hidden="true"><svg class="w-full h-full" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></span>
                    </summary>
                    <p class="text-gray-600 text-sm px-6 pb-4 pt-0">Yes. The content is written to be simple, safe, and enjoyable for teens and adults.</p>
                </details>
                <details class="group">
                    <summary class="flex items-center justify-between gap-4 cursor-pointer list-none py-4 px-6 font-bold text-primary bg-neutral-100 hover:bg-neutral-200 rounded-xl transition-colors [&::-webkit-details-marker]:hidden">
                        <span class="text-xl">Do I need an internet connection?</span>
                        <span class="flex-shrink-0 w-5 h-5 flex items-center justify-center text-gray-400 group-open:rotate-180 transition-transform" aria-hidden="true"><svg class="w-full h-full" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></span>
                    </summary>
                    <p class="text-gray-600 text-sm px-6 pb-4 pt-0">You'll need internet to load new content, but saved items can be read anytime.</p>
                </details>
                <details class="group">
                    <summary class="flex items-center justify-between gap-4 cursor-pointer list-none py-4 px-6 font-bold text-primary bg-neutral-100 hover:bg-neutral-200 rounded-xl transition-colors [&::-webkit-details-marker]:hidden">
                        <span class="text-xl">Will my data be safe?</span>
                        <span class="flex-shrink-0 w-5 h-5 flex items-center justify-center text-gray-400 group-open:rotate-180 transition-transform" aria-hidden="true"><svg class="w-full h-full" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></span>
                    </summary>
                    <p class="text-gray-600 text-sm px-6 pb-4 pt-0">Yes. We respect your privacy and never sell your personal data.</p>
                </details>
            </div>
        </div>
    </section>

    <section id="cta" class="py-16 md:py-24 px-6 md:px-12 bg-white rounded-b-3xl mb-[-50px] relative z-1">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Your daily “aha” starts here</h2>
            <p class="text-gray-600 text-lg mb-10">One tap. One fact. Every day.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="#google-play"
                    class="px-1 rounded-full bg-[#1E1E1E] border-2 border-neutral-300 shadow-[0_1px_2px_0_rgb(0_0_0_/_0.05),inset_0_1px_0_0_rgba(255,255,255,0.28),inset_0_-1px_0_0_rgba(0,0,0,0.12)]">
                    <img src="{{ asset('icons/google-play.svg') }}" class="rounded-full w-32 object-cover" />
                </a>
                <a href="#google-play"
                    class="px-1 rounded-full bg-[#1E1E1E] border-2 border-neutral-300 shadow-[0_1px_2px_0_rgb(0_0_0_/_0.05),inset_0_1px_0_0_rgba(255,255,255,0.28),inset_0_-1px_0_0_rgba(0,0,0,0.12)]">
                    <img src="{{ asset('icons/app-store.svg') }}" class="rounded-full w-30 object-cover" />
                </a>
            </div>
            <section class="relative mt-[150px]">
                {{-- Red box ends above the card so the card can stick out below --}}
                <div class="max-w-5xl mx-auto bg-red-500 rounded-2xl pb-0 overflow-visible"
                    style="background-image: url('/bg/cta-image.webp'); background-size: cover; background-position: center;">
                    <div class="max-w-6xl mx-auto flex justify-center items-center ">
                        <img src="/screenshots/hero-image.png" class="w-[75%] h-full mt-[-150px]" />
                    </div>
                </div>
            </section>
        </div>
    </section>
@endsection