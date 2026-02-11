<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#0f0f0f">
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Geist', 'Geist Variable', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        primary: '#0f0f0f',
                        muted: '#737373',
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @font-face {
            font-family: 'Geist Variable';
            font-style: normal;
            font-display: swap;
            font-weight: 100 900;
            src: url(https://cdn.jsdelivr.net/fontsource/fonts/geist:vf@latest/latin-wght-normal.woff2) format('woff2-variations');
        }
        @font-face {
            font-family: 'Geist';
            font-style: normal;
            font-display: swap;
            font-weight: 100 900;
            src: url(https://cdn.jsdelivr.net/fontsource/fonts/geist:vf@latest/latin-wght-normal.woff2) format('woff2-variations');
        }
        /* Safe area: minimum padding on mobile, additive on notched devices */
        .checkout-main {
            padding-left: max(1rem, env(safe-area-inset-left));
            padding-right: max(1rem, env(safe-area-inset-right));
            padding-top: max(1.5rem, env(safe-area-inset-top));
            padding-bottom: max(1.5rem, env(safe-area-inset-bottom));
        }
        @media (min-width: 640px) {
            .checkout-main {
                padding-left: max(1.5rem, env(safe-area-inset-left));
                padding-right: max(1.5rem, env(safe-area-inset-right));
                padding-top: max(2rem, env(safe-area-inset-top));
                padding-bottom: max(2rem, env(safe-area-inset-bottom));
            }
        }
    </style>
    <title>@yield('title', 'Checkout') – Did You Know?</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" sizes="any">
    @stack('head')
</head>
<body class="font-sans antialiased text-gray-900 bg-neutral-50 min-h-[100dvh] flex flex-col">
    <main class="checkout-main flex-1 w-full max-w-lg mx-auto">
        @yield('content')
    </main>
    @stack('scripts')
</body>
</html>
