<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('website.home');
});


Route::get('/privacy-policy', function () {
    return view('website.privacy-policy');
})->name('website.privacy-policy');

Route::get('/terms-of-service', function () {
    return view('website.terms-of-service');
})->name('website.terms-of-service');

Route::get('/subscriptions', function () {
    return view('website.subscriptions');
})->name('website.subscriptions');

Route::get('/refunds', function () {
    return view('website.refunds');
})->name('website.refunds');

Route::get('/data-deletion', function () {
    return view('website.data-deletion');
})->name('website.data-deletion');

Route::get('/support-contact', function () {
    return view('website.support-contact');
})->name('website.support-contact');

Route::get('/blog', function () {
    return view('website.blog');
})->name('website.blog');

Route::get('/blog/{slug}', function ($slug) {
    $posts = [
        'why-learning-one-fact-a-day-works' => [
            'title' => 'Why Learning One Fact a Day Works',
            'excerpt' => "We'll explore how short, daily learning builds lasting curiosity and keeps your mind sharp without overwhelm.",
            'image' => 'https://picsum.photos/seed/1/800/450',
            'date' => 'February 5, 2026',
            'read_time' => '3 min read',
            'body' => [
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper.',
            ],
        ],
        'curiosity-and-the-brain' => [
            'title' => 'Curiosity and the Brain',
            'excerpt' => "We'll explore how curiosity rewires the brain and why small doses of new knowledge stick better than cramming.",
            'image' => 'https://picsum.photos/seed/2/800/450',
            'date' => 'February 4, 2026',
            'read_time' => '4 min read',
            'body' => [
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            ],
        ],
        'making-time-for-micro-learning' => [
            'title' => 'Making Time for Micro-Learning',
            'excerpt' => "We'll explore how to fit learning into busy days—commute, coffee break, or right before bed.",
            'image' => 'https://picsum.photos/seed/3/800/450',
            'date' => 'February 3, 2026',
            'read_time' => '2 min read',
            'body' => [
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.',
                'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.',
            ],
        ],
        'whats-new-in-did-you-know' => [
            'title' => "What's New in Did You Know?",
            'excerpt' => "We'll explore how AI and law are working together to create a more equitable legal system.",
            'image' => 'https://picsum.photos/seed/4/800/450',
            'date' => 'February 2, 2026',
            'read_time' => '5 min read',
            'body' => [
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.',
            ],
        ],
        'styling-your-learning-habit' => [
            'title' => 'Styling Your Learning Habit',
            'excerpt' => "We'll explore how to build a routine that makes curiosity automatic—without feeling like homework.",
            'image' => 'https://picsum.photos/seed/5/800/450',
            'date' => 'February 1, 2026',
            'read_time' => '3 min read',
            'body' => [
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.',
            ],
        ],
        'importing-curiosity-into-your-day' => [
            'title' => 'Importing Curiosity Into Your Day',
            'excerpt' => "We'll explore how to weave facts and stories into your existing apps and habits for a richer feed.",
            'image' => 'https://picsum.photos/seed/6/800/450',
            'date' => 'January 31, 2026',
            'read_time' => '4 min read',
            'body' => [
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            ],
        ],
    ];

    if (!isset($posts[$slug])) {
        abort(404);
    }

    $slugs = array_keys($posts);
    $currentIndex = array_search($slug, $slugs);
    $next_posts = [];
    for ($i = 1; $i <= 2; $i++) {
        $nextIndex = ($currentIndex + $i) % count($slugs);
        $nextSlug = $slugs[$nextIndex];
        $next_posts[] = [
            'slug' => $nextSlug,
            'title' => $posts[$nextSlug]['title'],
            'excerpt' => $posts[$nextSlug]['excerpt'],
            'image' => $posts[$nextSlug]['image'],
        ];
    }

    return view('website.blog-single', [
        'post' => $posts[$slug],
        'next_posts' => $next_posts,
    ]);
});