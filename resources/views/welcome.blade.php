<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                        accent: '#eab308',
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

        @layer utilities {
            .text-balance {
                text-wrap: balance;
            }
        }

        .header-scrolled .header-bar {
            max-width: 55rem;
            /* max-w-5xl – the visible bar shrinks */
            margin-left: auto;
            margin-right: auto;
            border-radius: 9999px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 5px 0 rgba(0, 0, 0, 0.1);
        }
    </style>
    <title>Supapower – Personal Finance, made smarter.</title>
</head>

<body class="font-sans antialiased text-gray-900 bg-white">
    {{-- Header: max-w-6xl container; on scroll: border, rounded-full, inner becomes max-w-5xl --}}
    <header id="site-header" class="fixed top-0 left-0 right-0 z-50 min-h-[72px] py-4 px-4 min-[810px]:px-6">
        <div
            class="header-bar max-w-6xl mx-auto flex items-center justify-between min-h-[56px] px-6 min-[810px]:px-2.5 transition-[max-width,border-radius,box-shadow,border-color] duration-300 bg-white">
            <a href="/"
                class="flex items-center gap-1.5 text-[#0f0f0f] font-semibold text-[19px] tracking-[-0.02em] leading-none"
                aria-label="Supapower Homepage">
                <svg class="w-32 h-12 ml-4" width="650" height="72" viewBox="0 0 650 72" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M627.495 47.6L626.595 30.6C629.728 29.4666 632.261 27.6999 634.195 25.2999C636.128 22.8999 637.095 19.9999 637.095 16.5999C637.095 12.5999 636.361 9.46662 634.895 7.19995C633.428 4.86662 631.595 3.69995 629.395 3.69995C627.461 3.69995 625.961 4.36662 624.895 5.69995C623.895 7.03328 623.095 8.83328 622.495 11.0999L621.195 15.8999C620.595 18.1666 619.561 19.7999 618.095 20.7999C616.695 21.7333 615.195 22.1 613.595 21.9C612.061 21.7 610.728 21 609.595 19.7999C608.461 18.5333 607.895 16.8333 607.895 14.7C607.895 12.0333 608.861 9.73328 610.794 7.79995C612.794 5.86662 615.328 4.36662 618.395 3.29995C621.461 2.23328 624.661 1.69995 627.995 1.69995C634.728 1.69995 639.994 3.13328 643.794 5.99995C647.661 8.86662 649.595 13.1666 649.595 18.9C649.595 22.8333 648.628 26.1666 646.695 28.8999C644.761 31.6333 642.261 33.8666 639.195 35.6C636.195 37.2666 633.061 38.5666 629.794 39.4999L629.294 47.6H627.495ZM627.595 71.6C625.195 71.6 623.128 70.7666 621.395 69.1C619.728 67.4333 618.895 65.4 618.895 63C618.895 60.6666 619.728 58.6666 621.395 57C623.128 55.2666 625.195 54.4 627.595 54.4C630.061 54.4 632.095 55.2666 633.695 57C635.361 58.6666 636.195 60.6666 636.195 63C636.195 65.4 635.361 67.4333 633.695 69.1C632.095 70.7666 630.061 71.6 627.595 71.6Z"
                        fill="#1E1E1E" />
                    <path
                        d="M548.816 70.4L533.416 28.1C532.682 25.9666 531.216 24.4666 529.016 23.6L527.316 23V22H551.816V23L550.316 23.4C547.716 24.2 546.849 25.8 547.716 28.2L557.016 56.5L565.316 34.5L563.416 28.8C562.949 27.3333 562.449 26.2333 561.916 25.5C561.449 24.7 560.816 24.1333 560.016 23.8L558.316 23V22H579.016V23L577.616 23.6C576.616 24 576.016 24.5333 575.816 25.2C575.616 25.8666 575.749 26.8666 576.216 28.2L585.416 56L594.916 28.4C595.849 25.8666 595.349 24.2666 593.416 23.6L591.216 23V22H603.216V23L600.816 23.7C599.682 24.0333 598.849 24.5666 598.316 25.3C597.849 25.9666 597.416 26.9 597.016 28.1L582.616 70.4H577.516L566.416 37.7L554.616 70.4H548.816Z"
                        fill="#1E1E1E" />
                    <path
                        d="M499.709 71.6C494.643 71.6 490.243 70.5666 486.509 68.5C482.776 66.3666 479.876 63.3666 477.809 59.5C475.809 55.6333 474.809 51.1 474.809 45.9C474.809 40.7 475.876 36.2 478.009 32.4C480.209 28.6 483.176 25.6666 486.909 23.6C490.709 21.5333 494.976 20.5 499.709 20.5C504.443 20.5 508.676 21.5333 512.409 23.6C516.143 25.6 519.076 28.5 521.209 32.3C523.409 36.1 524.509 40.6333 524.509 45.9C524.509 51.1666 523.476 55.7333 521.409 59.6C519.409 63.4 516.543 66.3666 512.809 68.5C509.143 70.5666 504.776 71.6 499.709 71.6ZM499.709 69.6C502.043 69.6 503.909 68.9333 505.309 67.6C506.709 66.2666 507.709 63.9 508.309 60.5C508.976 57.1 509.309 52.3 509.309 46.1C509.309 39.8333 508.976 35 508.309 31.6C507.709 28.2 506.709 25.8333 505.309 24.5C503.909 23.1666 502.043 22.5 499.709 22.5C497.376 22.5 495.476 23.1666 494.009 24.5C492.609 25.8333 491.576 28.2 490.909 31.6C490.309 35 490.009 39.8333 490.009 46.1C490.009 52.3 490.309 57.1 490.909 60.5C491.576 63.9 492.609 66.2666 494.009 67.6C495.476 68.9333 497.376 69.6 499.709 69.6Z"
                        fill="#1E1E1E" />
                    <path
                        d="M416.597 70.1V69.1L417.997 68.7C420.33 68.0333 421.497 66.4 421.497 63.8V32.5C421.497 31.0333 421.264 29.9666 420.797 29.3C420.33 28.5666 419.43 28.0666 418.097 27.8L416.597 27.4V26.4L433.697 20.6L434.697 21.6L435.497 27.6C437.83 25.5333 440.464 23.8333 443.397 22.5C446.33 21.1666 449.23 20.5 452.097 20.5C456.497 20.5 459.864 21.7 462.197 24.1C464.597 26.5 465.797 30.1666 465.797 35.1V63.9C465.797 66.5 467.064 68.1333 469.597 68.8L470.497 69.1V70.1H446.897V69.1L448.197 68.7C450.53 67.9666 451.697 66.3333 451.697 63.8V31.9C451.697 27.6333 449.564 25.5 445.297 25.5C442.364 25.5 439.164 26.9666 435.697 29.9V63.9C435.697 66.5 436.864 68.1333 439.197 68.8L440.097 69.1V70.1H416.597Z"
                        fill="#1E1E1E" />
                    <path
                        d="M351.367 70.1V69.1L353.467 68.3C354.8 67.8333 355.667 67.2 356.067 66.4C356.467 65.6 356.667 64.5666 356.667 63.3V11C356.667 9.66665 356.467 8.59998 356.067 7.79998C355.667 6.99997 354.8 6.36664 353.467 5.89998L351.367 5.09998V4.09998H376.267V5.09998L374.067 5.99998C372.934 6.39998 372.167 6.99997 371.767 7.79998C371.367 8.59998 371.167 9.69998 371.167 11.1V63.4C371.167 64.7333 371.367 65.7666 371.767 66.5C372.234 67.2333 373.101 67.8333 374.367 68.3L376.267 69.1V70.1H351.367ZM388.267 70.1V69.1L389.567 68.7C390.901 68.3 391.601 67.6333 391.667 66.7C391.734 65.7666 391.334 64.7 390.467 63.5L371.267 36.2L396.567 10.4C397.501 9.46665 398.001 8.56665 398.067 7.69998C398.201 6.83331 397.567 6.16664 396.167 5.69997L394.467 5.09998V4.09998H409.067V5.09998L406.467 5.89998C405 6.36664 403.834 6.93331 402.967 7.59998C402.101 8.26665 401.1 9.16665 399.967 10.3L382.067 28.6L405.567 62.9C406.567 64.3666 407.501 65.5666 408.367 66.5C409.301 67.4333 410.601 68.1666 412.267 68.7L413.667 69.1V70.1H388.267Z"
                        fill="#1E1E1E" />
                    <path
                        d="M290.752 71.6C288.152 71.6 285.752 71.1 283.552 70.1C281.418 69.1 279.718 67.5 278.452 65.3C277.252 63.0333 276.685 60.0666 276.752 56.4L277.052 30.7C277.052 29.1666 276.785 28.0666 276.252 27.4C275.718 26.7333 274.885 26.2666 273.752 26L272.552 25.6V24.6L290.452 21.1L291.452 22.1L290.952 36.3V60.4C290.952 62.5333 291.552 64.1 292.752 65.1C294.018 66.1 295.585 66.6 297.452 66.6C299.318 66.6 300.985 66.3333 302.452 65.8C303.918 65.2666 305.385 64.4666 306.852 63.4L307.252 30.8C307.252 29.2666 307.018 28.2 306.552 27.6C306.085 26.9333 305.218 26.4666 303.952 26.2L302.952 25.9V24.9L320.452 21.1L321.452 22.1L321.152 36.3V63.4C321.152 64.8666 321.352 66 321.752 66.8C322.152 67.6 323.018 68.2666 324.352 68.8L325.352 69.1V70.1L307.852 71.1L306.952 65.2C304.752 67 302.352 68.5333 299.752 69.8C297.218 71 294.218 71.6 290.752 71.6Z"
                        fill="#1E1E1E" />
                    <path
                        d="M243.85 71.6C238.783 71.6 234.383 70.5666 230.65 68.5C226.917 66.3666 224.017 63.3666 221.95 59.5C219.95 55.6333 218.95 51.1 218.95 45.9C218.95 40.7 220.017 36.2 222.15 32.4C224.35 28.6 227.317 25.6666 231.05 23.6C234.85 21.5333 239.117 20.5 243.85 20.5C248.583 20.5 252.817 21.5333 256.55 23.6C260.283 25.6 263.217 28.5 265.35 32.3C267.55 36.1 268.65 40.6333 268.65 45.9C268.65 51.1666 267.617 55.7333 265.55 59.6C263.55 63.4 260.683 66.3666 256.95 68.5C253.283 70.5666 248.917 71.6 243.85 71.6ZM243.85 69.6C246.183 69.6 248.05 68.9333 249.45 67.6C250.85 66.2666 251.85 63.9 252.45 60.5C253.117 57.1 253.45 52.3 253.45 46.1C253.45 39.8333 253.117 35 252.45 31.6C251.85 28.2 250.85 25.8333 249.45 24.5C248.05 23.1666 246.183 22.5 243.85 22.5C241.517 22.5 239.617 23.1666 238.15 24.5C236.75 25.8333 235.717 28.2 235.05 31.6C234.45 35 234.15 39.8333 234.15 46.1C234.15 52.3 234.45 57.1 235.05 60.5C235.717 63.9 236.75 66.2666 238.15 67.6C239.617 68.9333 241.517 69.6 243.85 69.6Z"
                        fill="#1E1E1E" />
                    <path
                        d="M183.929 70.1V69.1L186.929 68.3C189.262 67.6333 190.429 65.9666 190.429 63.3V44.3L173.929 10.7C173.329 9.36664 172.762 8.36664 172.229 7.69998C171.762 7.03331 171.029 6.46665 170.029 5.99998L168.229 5.09998V4.09998H195.029V5.09998L193.229 5.79998C191.762 6.39998 190.962 7.23331 190.829 8.29998C190.696 9.29998 190.962 10.5666 191.629 12.1L203.429 38.3L216.629 11.1C217.162 10.0333 217.362 8.93331 217.229 7.79998C217.162 6.66664 216.462 5.93331 215.129 5.59998L213.729 5.09998V4.09998H225.729V5.09998L223.829 5.79998C222.562 6.26664 221.629 6.93331 221.029 7.79998C220.429 8.59998 219.829 9.63331 219.229 10.9L205.529 39.7V63.3C205.529 64.6333 205.762 65.7333 206.229 66.6C206.762 67.4 207.662 67.9666 208.929 68.3L212.029 69.1V70.1H183.929Z"
                        fill="#1E1E1E" />
                    <path
                        d="M113.871 71.6C109.938 71.6 106.404 70.7333 103.271 69C100.138 67.2 97.6377 64.4667 95.7711 60.8C93.9711 57.0667 93.0711 52.3 93.0711 46.5C93.0711 40.6333 94.1044 35.8 96.1711 32C98.2377 28.1333 100.971 25.2667 104.371 23.4C107.771 21.4667 111.471 20.5 115.471 20.5C117.804 20.5 120.038 20.7333 122.171 21.2C124.304 21.6667 126.204 22.3667 127.871 23.3V10.3C127.871 8.9 127.638 7.86667 127.171 7.2C126.771 6.53333 125.871 6.06667 124.471 5.8L122.571 5.4V4.4L140.771 0L141.871 0.899998L141.471 14.9V63.8C141.471 65.1333 141.704 66.2333 142.171 67.1C142.638 67.9 143.504 68.4667 144.771 68.8L145.671 69.1V70.1L128.571 71.2L127.671 67.6C125.871 68.8 123.804 69.7667 121.471 70.5C119.204 71.2333 116.671 71.6 113.871 71.6ZM119.671 67.9C122.471 67.9 125.038 67.0667 127.371 65.4V25.7C124.904 24.1 122.371 23.3 119.771 23.3C116.571 23.3 113.838 25.1667 111.571 28.9C109.304 32.5667 108.171 38.3667 108.171 46.3C108.171 54.2333 109.238 59.8333 111.371 63.1C113.504 66.3 116.271 67.9 119.671 67.9Z"
                        fill="#1E1E1E" />
                    <path
                        d="M76.6438 15.3C74.3771 15.3 72.4438 14.6 70.8438 13.2C69.3104 11.7333 68.5438 9.89998 68.5438 7.69998C68.5438 5.43331 69.3104 3.59998 70.8438 2.19998C72.4438 0.799976 74.3771 0.0999756 76.6438 0.0999756C78.9104 0.0999756 80.8104 0.799976 82.3438 2.19998C83.8771 3.59998 84.6438 5.43331 84.6438 7.69998C84.6438 9.89998 83.8771 11.7333 82.3438 13.2C80.8104 14.6 78.9104 15.3 76.6438 15.3ZM64.8438 70.1V69.1L66.2438 68.7C67.5771 68.3 68.4771 67.7 68.9438 66.9C69.4771 66.1 69.7438 65.0333 69.7438 63.7V32.4C69.7438 31 69.4771 29.9666 68.9438 29.3C68.4771 28.5666 67.5771 28.0666 66.2438 27.8L64.8438 27.5V26.5L83.1438 20.6L84.1438 21.6L83.8438 35.8V63.8C83.8438 65.1333 84.0771 66.2 84.5438 67C85.0771 67.8 85.9771 68.4 87.2438 68.8L88.2438 69.1V70.1H64.8438Z"
                        fill="#1E1E1E" />
                    <path
                        d="M0 70.1V69.1L2.1 68.3C4.23333 67.4333 5.3 65.7333 5.3 63.2V11C5.3 8.33331 4.23333 6.63331 2.1 5.89998L0 5.09998V4.09998H26.4C33.4667 4.09998 39.5333 5.43331 44.6 8.09998C49.7333 10.7 53.6667 14.4666 56.4 19.4C59.2 24.2666 60.6 30.1333 60.6 37C60.6 44 59.1 49.9666 56.1 54.9C53.1 59.8333 48.9 63.6 43.5 66.2C38.1667 68.8 31.8667 70.1 24.6 70.1H0ZM20.3 68.1H24.6C29.4 68.1 33.2667 67.1666 36.2 65.3C39.1333 63.3666 41.2667 60.1666 42.6 55.7C44 51.1666 44.7 44.9666 44.7 37.1C44.7 29.2333 44 23.0666 42.6 18.6C41.2667 14.0666 39.1667 10.8666 36.3 8.99998C33.4333 7.06664 29.6667 6.09998 25 6.09998H20.3V68.1Z"
                        fill="#1E1E1E" />
                </svg>

            </a>
            <button type="button"
                class="flex items-center justify-center w-[43px] h-[43px] shrink-0 rounded-full bg-[#181F1F] text-white hover:opacity-90 transition-opacity min-[810px]:hidden"
                aria-label="Open menu">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <nav class="hidden min-[810px]:flex items-center gap-4 text-[14px] font-medium text-[#737373]">
                <a href="#features" class="hover:text-[#0f0f0f] transition-colors">About</a>
                <a href="#testimonials" class="hover:text-[#0f0f0f] transition-colors">Testimonials</a>
                <a href="#faq" class="hover:text-[#0f0f0f] transition-colors">Blog & Insights</a>
                <a href="#pricing" class="hover:text-[#0f0f0f] transition-colors">Contact</a>
                <a href="#pricing" class="inline-flex items-center border-l border-neutral-200 pl-2.5">Upgrade</a>
                <a href="#pricing"
                    class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full bg-[#0f0f0f] text-white text-[13px] font-semibold hover:bg-[#262626] transition-colors">Download
                    <span aria-hidden="true">›</span></a>
            </nav>
        </div>
    </header>
    <script>
        (function() {
            var header = document.getElementById('site-header');

            function updateHeader() {
                if (window.scrollY > 8) {
                    header.classList.add('header-scrolled');
                } else {
                    header.classList.remove('header-scrolled');
                }
            }
            window.addEventListener('scroll', updateHeader, {
                passive: true
            });
            updateHeader();
        })();
    </script>

    <main>
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
                        <img src="/icons/google-play.svg" class="rounded-full w-32 object-cover" />
                    </a>
                    <a href="#google-play"
                        class="px-1 rounded-full bg-[#1E1E1E] border-2 border-neutral-300 shadow-[0_1px_2px_0_rgb(0_0_0_/_0.05),inset_0_1px_0_0_rgba(255,255,255,0.28),inset_0_-1px_0_0_rgba(0,0,0,0.12)]">
                        <img src="/icons/app-store.svg" class="rounded-full w-30 object-cover" />
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
                <h2 class="text-3xl md:text-4xl font-bold text-primary text-center mb-12">Trusted by thousands of individuals</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <article class="bg-white rounded-2xl p-8 shadow-md border border-gray-100">
                        <div class="w-14 h-14 rounded-full bg-gray-200 mb-4"></div>
                        <h4 class="font-bold text-primary">Dereck Towns</h4>
                        <p class="text-sm text-muted mb-3">CEO of Company X</p>
                        <p class="text-2xl font-bold text-primary mb-1">+280%</p>
                        <p class="text-gray-600 text-sm">Increase in savings</p>
                    </article>
                    <article class="bg-white rounded-2xl p-8 shadow-md border border-gray-100">
                        <div class="w-14 h-14 rounded-full bg-gray-200 mb-4"></div>
                        <h4 class="font-bold text-primary">Samantha Lapin</h4>
                        <p class="text-sm text-muted mb-3">Software Engineer</p>
                        <p class="text-gray-600 italic">"Superplan is my financial superpower. I was able to increase
                            both savings and investments."</p>
                    </article>
                    <article class="bg-white rounded-2xl p-8 shadow-md border border-gray-100">
                        <div class="w-14 h-14 rounded-full bg-gray-200 mb-4"></div>
                        <h4 class="font-bold text-primary">John Michaels</h4>
                        <p class="text-sm text-muted mb-3">Retired Professional</p>
                        <p class="text-2xl font-bold text-primary mb-1">$5,500,000+</p>
                        <p class="text-gray-600 text-sm">Increase in investment portfolio</p>
                    </article>
                    <article class="bg-white rounded-2xl p-8 shadow-md border border-gray-100">
                        <div class="w-14 h-14 rounded-full bg-gray-200 mb-4"></div>
                        <h4 class="font-bold text-primary">Micaela Smith</h4>
                        <p class="text-sm text-muted mb-3">Entrepreneur</p>
                        <p class="text-gray-600 italic">"I've never felt such financial freedom. I went from a plan to
                            taking action with Superplan."</p>
                    </article>
                    <article class="bg-white rounded-2xl p-8 shadow-md border border-gray-100">
                        <div class="w-14 h-14 rounded-full bg-gray-200 mb-4"></div>
                        <h4 class="font-bold text-primary">Christina Robertson</h4>
                        <p class="text-sm text-muted mb-3">Digital Creator</p>
                        <p class="text-2xl font-bold text-primary mb-1">4x</p>
                        <p class="text-gray-600 text-sm">Increase in savings</p>
                    </article>
                    <article class="bg-white rounded-2xl p-8 shadow-md border border-gray-100">
                        <div class="w-14 h-14 rounded-full bg-gray-200 mb-4"></div>
                        <h4 class="font-bold text-primary">Andy Bernard</h4>
                        <p class="text-sm text-muted mb-3">Software Engineer</p>
                        <p class="text-gray-600 italic">"Superplan is my financial superpower. I was able to increase
                            both savings and investments."</p>
                    </article>
                </div>
            </div>
        </section>

        <section id="pricing" class="py-16 md:py-24 px-6 md:px-12">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-primary text-center mb-12">Simple pricing</h2>
                <div class="grid md:grid-cols-3 gap-6 lg:gap-8 items-stretch">
                    {{-- Free --}}
                    <div class="rounded-2xl bg-white border border-gray-200 p-6 md:p-8 flex flex-col shadow-sm">
                        <h3 class="text-2xl font-bold text-primary mb-1">Free</h3>
                        <p class="text-gray-600 text-sm mb-6">Discover daily facts and stay curious with the essentials.</p>
                        <p class="mb-6"><span class="text-3xl font-bold text-primary">$0</span> <span class="text-gray-600 text-sm">/ Month</span></p>
                        <a href="#" class="inline-flex items-center justify-center gap-2 w-full py-3 px-4 rounded-xl bg-primary text-white font-semibold text-sm hover:bg-gray-800 transition-colors mb-8">Get Free Trial <span aria-hidden="true">›</span></a>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-4">What's included:</p>
                        <ul class="space-y-3 flex-1 text-gray-700 text-sm">
                            <li class="flex items-start gap-3"><span class="text-primary mt-0.5">◆</span> Daily curated facts</li>
                            <li class="flex items-start gap-3"><span class="text-primary mt-0.5">◆</span> Basic topic categories</li>
                            <li class="flex items-start gap-3"><span class="text-primary mt-0.5">◆</span> Simple discovery feed</li>
                            <li class="flex items-start gap-3"><span class="text-primary mt-0.5">◆</span> 10 saved facts/month</li>
                            <li class="flex items-start gap-3"><span class="text-primary mt-0.5">◆</span> One device sync</li>
                        </ul>
                    </div>
                    {{-- Pro (highlighted) --}}
                    <div class="rounded-2xl bg-primary p-6 md:p-8 flex flex-col shadow-lg border border-primary relative">
                        <h3 class="text-2xl font-bold text-white mb-1">Pro</h3>
                        <p class="text-white/90 text-sm mb-6">Unlock deeper learning with curated collections and offline access.</p>
                        <p class="mb-6"><span class="text-3xl font-bold text-white">$12</span> <span class="text-white/80 text-sm">/ Month</span></p>
                        <a href="#" class="inline-flex items-center justify-center gap-2 w-full py-3 px-4 rounded-xl bg-white text-primary font-semibold text-sm hover:bg-gray-100 transition-colors mb-8">Get Free Trial <span aria-hidden="true">›</span></a>
                        <p class="text-xs font-semibold text-white/80 uppercase tracking-wide mb-4">Everything in Free, plus:</p>
                        <ul class="space-y-3 flex-1 text-white/90 text-sm">
                            <li class="flex items-start gap-3"><span class="text-white mt-0.5">◆</span> Deeper dives & summaries</li>
                            <li class="flex items-start gap-3"><span class="text-white mt-0.5">◆</span> Curated topic collections</li>
                            <li class="flex items-start gap-3"><span class="text-white mt-0.5">◆</span> Offline reading</li>
                            <li class="flex items-start gap-3"><span class="text-white mt-0.5">◆</span> Unlimited saved facts</li>
                            <li class="flex items-start gap-3"><span class="text-white mt-0.5">◆</span> All devices sync</li>
                        </ul>
                    </div>
                    {{-- Premium --}}
                    <div class="rounded-2xl bg-white border border-gray-200 p-6 md:p-8 flex flex-col shadow-sm">
                        <h3 class="text-2xl font-bold text-primary mb-1">Premium</h3>
                        <p class="text-gray-600 text-sm mb-6">Get the full experience with a personalized learning path.</p>
                        <p class="mb-6"><span class="text-3xl font-bold text-primary">$18</span> <span class="text-gray-600 text-sm">/ Month</span></p>
                        <a href="#" class="inline-flex items-center justify-center gap-2 w-full py-3 px-4 rounded-xl bg-primary text-white font-semibold text-sm hover:bg-gray-800 transition-colors mb-8">Get Free Trial <span aria-hidden="true">›</span></a>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-4">Everything in Pro, plus:</p>
                        <ul class="space-y-3 flex-1 text-gray-700 text-sm">
                            <li class="flex items-start gap-3"><span class="text-primary mt-0.5">◆</span> Personalized learning path</li>
                            <li class="flex items-start gap-3"><span class="text-primary mt-0.5">◆</span> Editor picks & exclusives</li>
                            <li class="flex items-start gap-3"><span class="text-primary mt-0.5">◆</span> Export & share highlights</li>
                            <li class="flex items-start gap-3"><span class="text-primary mt-0.5">◆</span> Priority support</li>
                            <li class="flex items-start gap-3"><span class="text-primary mt-0.5">◆</span> Ad-free experience</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section id="faq" class="py-16 md:py-24 px-6 md:px-12 bg-gray-50/50">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-primary text-center mb-12">Frequently asked questions
                </h2>
                <dl class="space-y-4">
                    <div class="bg-white rounded-xl p-6 border border-gray-200">
                        <dt class="font-bold text-primary">How do I add money to my account?</dt>
                    </div>
                    <div class="bg-white rounded-xl p-6 border border-gray-200">
                        <dt class="font-bold text-primary">Are there any fees or commissions?</dt>
                    </div>
                    <div class="bg-white rounded-xl p-6 border border-gray-200">
                        <dt class="font-bold text-primary">Do you support fractional shares?</dt>
                    </div>
                    <div class="bg-white rounded-xl p-6 border border-gray-200">
                        <dt class="font-bold text-primary">Are prices real-time?</dt>
                    </div>
                    <div class="bg-white rounded-xl p-6 border border-gray-200">
                        <dt class="font-bold text-primary">Can I trade after hours?</dt>
                    </div>
                    <div class="bg-white rounded-xl p-6 border border-gray-200">
                        <dt class="font-bold text-primary">How do you keep my account secure?</dt>
                    </div>
                </dl>
            </div>
        </section>

        <section id="pricing" class="py-16 md:py-24 px-6 md:px-12">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Start your financial freedom today</h2>
                <p class="text-gray-600 text-lg mb-10">The whole process takes seconds. No waiting around for manual
                    document checks.</p>
                <a href="#pricing"
                    class="inline-flex items-center gap-2 px-10 py-4 rounded-full bg-primary text-white font-semibold text-lg hover:bg-gray-800 transition-colors shadow-xl hover:shadow-2xl hover:-translate-y-0.5">Get
                    Free Trial <span aria-hidden="true">›</span></a>
                <div class="mt-16 rounded-3xl overflow-hidden bg-gray-200 h-64 md:h-80"></div>
            </div>
        </section>
    </main>

    <footer class="bg-black text-gray-300 py-16 px-6 md:px-12 rounded-t-3xl shadow-2xl shadow-gray-900/30">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-8 mb-12">
                <svg class="w-full" viewBox="0 0 650 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M627.495 47.6L626.595 30.6C629.728 29.4666 632.261 27.6999 634.195 25.2999C636.128 22.8999 637.095 19.9999 637.095 16.5999C637.095 12.5999 636.361 9.46662 634.895 7.19995C633.428 4.86662 631.595 3.69995 629.395 3.69995C627.461 3.69995 625.961 4.36662 624.895 5.69995C623.895 7.03328 623.095 8.83328 622.495 11.0999L621.195 15.8999C620.595 18.1666 619.561 19.7999 618.095 20.7999C616.695 21.7333 615.195 22.1 613.595 21.9C612.061 21.7 610.728 21 609.595 19.7999C608.461 18.5333 607.895 16.8333 607.895 14.7C607.895 12.0333 608.861 9.73328 610.794 7.79995C612.794 5.86662 615.328 4.36662 618.395 3.29995C621.461 2.23328 624.661 1.69995 627.995 1.69995C634.728 1.69995 639.994 3.13328 643.794 5.99995C647.661 8.86662 649.595 13.1666 649.595 18.9C649.595 22.8333 648.628 26.1666 646.695 28.8999C644.761 31.6333 642.261 33.8666 639.195 35.6C636.195 37.2666 633.061 38.5666 629.794 39.4999L629.294 47.6H627.495ZM627.595 71.6C625.195 71.6 623.128 70.7666 621.395 69.1C619.728 67.4333 618.895 65.4 618.895 63C618.895 60.6666 619.728 58.6666 621.395 57C623.128 55.2666 625.195 54.4 627.595 54.4C630.061 54.4 632.095 55.2666 633.695 57C635.361 58.6666 636.195 60.6666 636.195 63C636.195 65.4 635.361 67.4333 633.695 69.1C632.095 70.7666 630.061 71.6 627.595 71.6Z" fill="white"/>
                    <path d="M548.816 70.4L533.416 28.1C532.682 25.9667 531.216 24.4667 529.016 23.6L527.316 23V22H551.816V23L550.316 23.4C547.716 24.2 546.849 25.8 547.716 28.2L557.016 56.5L565.316 34.5L563.416 28.8C562.949 27.3333 562.449 26.2333 561.916 25.5C561.449 24.7 560.816 24.1333 560.016 23.8L558.316 23V22H579.016V23L577.616 23.6C576.616 24 576.016 24.5333 575.816 25.2C575.616 25.8667 575.749 26.8667 576.216 28.2L585.416 56L594.916 28.4C595.849 25.8667 595.349 24.2667 593.416 23.6L591.216 23V22H603.216V23L600.816 23.7C599.682 24.0333 598.849 24.5667 598.316 25.3C597.849 25.9667 597.416 26.9 597.016 28.1L582.616 70.4H577.516L566.416 37.7L554.616 70.4H548.816Z" fill="white"/>
                    <path d="M499.709 71.6C494.643 71.6 490.243 70.5667 486.509 68.5C482.776 66.3667 479.876 63.3667 477.809 59.5C475.809 55.6333 474.809 51.1 474.809 45.9C474.809 40.7 475.876 36.2 478.009 32.4C480.209 28.6 483.176 25.6667 486.909 23.6C490.709 21.5333 494.976 20.5 499.709 20.5C504.443 20.5 508.676 21.5333 512.409 23.6C516.143 25.6 519.076 28.5 521.209 32.3C523.409 36.1 524.509 40.6333 524.509 45.9C524.509 51.1667 523.476 55.7333 521.409 59.6C519.409 63.4 516.543 66.3667 512.809 68.5C509.143 70.5667 504.776 71.6 499.709 71.6ZM499.709 69.6C502.043 69.6 503.909 68.9333 505.309 67.6C506.709 66.2667 507.709 63.9 508.309 60.5C508.976 57.1 509.309 52.3 509.309 46.1C509.309 39.8333 508.976 35 508.309 31.6C507.709 28.2 506.709 25.8333 505.309 24.5C503.909 23.1667 502.043 22.5 499.709 22.5C497.376 22.5 495.476 23.1667 494.009 24.5C492.609 25.8333 491.576 28.2 490.909 31.6C490.309 35 490.009 39.8333 490.009 46.1C490.009 52.3 490.309 57.1 490.909 60.5C491.576 63.9 492.609 66.2667 494.009 67.6C495.476 68.9333 497.376 69.6 499.709 69.6Z" fill="white"/>
                    <path d="M416.597 70.1V69.1L417.997 68.7C420.33 68.0333 421.497 66.4 421.497 63.8V32.5C421.497 31.0333 421.264 29.9667 420.797 29.3C420.33 28.5667 419.43 28.0667 418.097 27.8L416.597 27.4V26.4L433.697 20.6L434.697 21.6L435.497 27.6C437.83 25.5333 440.464 23.8333 443.397 22.5C446.33 21.1667 449.23 20.5 452.097 20.5C456.497 20.5 459.864 21.7 462.197 24.1C464.597 26.5 465.797 30.1667 465.797 35.1V63.9C465.797 66.5 467.064 68.1333 469.597 68.8L470.497 69.1V70.1H446.897V69.1L448.197 68.7C450.53 67.9667 451.697 66.3333 451.697 63.8V31.9C451.697 27.6333 449.564 25.5 445.297 25.5C442.364 25.5 439.164 26.9667 435.697 29.9V63.9C435.697 66.5 436.864 68.1333 439.197 68.8L440.097 69.1V70.1H416.597Z" fill="white"/>
                    <path d="M351.367 70.1V69.1L353.467 68.3C354.8 67.8333 355.667 67.2 356.067 66.4C356.467 65.6 356.667 64.5666 356.667 63.3V11C356.667 9.66665 356.467 8.59998 356.067 7.79998C355.667 6.99997 354.8 6.36664 353.467 5.89998L351.367 5.09998V4.09998H376.267V5.09998L374.067 5.99998C372.934 6.39998 372.167 6.99997 371.767 7.79998C371.367 8.59998 371.167 9.69998 371.167 11.1V63.4C371.167 64.7333 371.367 65.7666 371.767 66.5C372.234 67.2333 373.101 67.8333 374.367 68.3L376.267 69.1V70.1H351.367ZM388.267 70.1V69.1L389.567 68.7C390.901 68.3 391.601 67.6333 391.667 66.7C391.734 65.7666 391.334 64.7 390.467 63.5L371.267 36.2L396.567 10.4C397.501 9.46665 398.001 8.56665 398.067 7.69998C398.201 6.83331 397.567 6.16664 396.167 5.69997L394.467 5.09998V4.09998H409.067V5.09998L406.467 5.89998C405 6.36664 403.834 6.93331 402.967 7.59998C402.101 8.26665 401.1 9.16665 399.967 10.3L382.067 28.6L405.567 62.9C406.567 64.3666 407.501 65.5666 408.367 66.5C409.301 67.4333 410.601 68.1666 412.267 68.7L413.667 69.1V70.1H388.267Z" fill="white"/>
                    <path d="M290.752 71.6C288.152 71.6 285.752 71.1 283.552 70.1C281.418 69.1 279.718 67.5 278.452 65.3C277.252 63.0333 276.685 60.0666 276.752 56.4L277.052 30.7C277.052 29.1666 276.785 28.0666 276.252 27.4C275.718 26.7333 274.885 26.2666 273.752 26L272.552 25.6V24.6L290.452 21.1L291.452 22.1L290.952 36.3V60.4C290.952 62.5333 291.552 64.1 292.752 65.1C294.018 66.1 295.585 66.6 297.452 66.6C299.318 66.6 300.985 66.3333 302.452 65.8C303.918 65.2666 305.385 64.4666 306.852 63.4L307.252 30.8C307.252 29.2666 307.018 28.2 306.552 27.6C306.085 26.9333 305.218 26.4666 303.952 26.2L302.952 25.9V24.9L320.452 21.1L321.452 22.1L321.152 36.3V63.4C321.152 64.8666 321.352 66 321.752 66.8C322.152 67.6 323.018 68.2666 324.352 68.8L325.352 69.1V70.1L307.852 71.1L306.952 65.2C304.752 67 302.352 68.5333 299.752 69.8C297.218 71 294.218 71.6 290.752 71.6Z" fill="white"/>
                    <path d="M243.85 71.6C238.783 71.6 234.383 70.5667 230.65 68.5C226.917 66.3667 224.017 63.3667 221.95 59.5C219.95 55.6333 218.95 51.1 218.95 45.9C218.95 40.7 220.017 36.2 222.15 32.4C224.35 28.6 227.317 25.6667 231.05 23.6C234.85 21.5333 239.117 20.5 243.85 20.5C248.583 20.5 252.817 21.5333 256.55 23.6C260.283 25.6 263.217 28.5 265.35 32.3C267.55 36.1 268.65 40.6333 268.65 45.9C268.65 51.1667 267.617 55.7333 265.55 59.6C263.55 63.4 260.683 66.3667 256.95 68.5C253.283 70.5667 248.917 71.6 243.85 71.6ZM243.85 69.6C246.183 69.6 248.05 68.9333 249.45 67.6C250.85 66.2667 251.85 63.9 252.45 60.5C253.117 57.1 253.45 52.3 253.45 46.1C253.45 39.8333 253.117 35 252.45 31.6C251.85 28.2 250.85 25.8333 249.45 24.5C248.05 23.1667 246.183 22.5 243.85 22.5C241.517 22.5 239.617 23.1667 238.15 24.5C236.75 25.8333 235.717 28.2 235.05 31.6C234.45 35 234.15 39.8333 234.15 46.1C234.15 52.3 234.45 57.1 235.05 60.5C235.717 63.9 236.75 66.2667 238.15 67.6C239.617 68.9333 241.517 69.6 243.85 69.6Z" fill="white"/>
                    <path d="M183.929 70.1V69.1L186.929 68.3C189.262 67.6333 190.429 65.9666 190.429 63.3V44.3L173.929 10.7C173.329 9.36664 172.762 8.36664 172.229 7.69998C171.762 7.03331 171.029 6.46665 170.029 5.99998L168.229 5.09998V4.09998H195.029V5.09998L193.229 5.79998C191.762 6.39998 190.962 7.23331 190.829 8.29998C190.696 9.29998 190.962 10.5666 191.629 12.1L203.429 38.3L216.629 11.1C217.162 10.0333 217.362 8.93331 217.229 7.79998C217.162 6.66664 216.462 5.93331 215.129 5.59998L213.729 5.09998V4.09998H225.729V5.09998L223.829 5.79998C222.562 6.26664 221.629 6.93331 221.029 7.79998C220.429 8.59998 219.829 9.63331 219.229 10.9L205.529 39.7V63.3C205.529 64.6333 205.762 65.7333 206.229 66.6C206.762 67.4 207.662 67.9666 208.929 68.3L212.029 69.1V70.1H183.929Z" fill="white"/>
                    <path d="M113.871 71.6C109.938 71.6 106.404 70.7333 103.271 69C100.138 67.2 97.6377 64.4667 95.7711 60.8C93.9711 57.0667 93.0711 52.3 93.0711 46.5C93.0711 40.6333 94.1044 35.8 96.1711 32C98.2377 28.1333 100.971 25.2667 104.371 23.4C107.771 21.4667 111.471 20.5 115.471 20.5C117.804 20.5 120.038 20.7333 122.171 21.2C124.304 21.6667 126.204 22.3667 127.871 23.3V10.3C127.871 8.9 127.638 7.86667 127.171 7.2C126.771 6.53333 125.871 6.06667 124.471 5.8L122.571 5.4V4.4L140.771 0L141.871 0.899998L141.471 14.9V63.8C141.471 65.1333 141.704 66.2333 142.171 67.1C142.638 67.9 143.504 68.4667 144.771 68.8L145.671 69.1V70.1L128.571 71.2L127.671 67.6C125.871 68.8 123.804 69.7667 121.471 70.5C119.204 71.2333 116.671 71.6 113.871 71.6ZM119.671 67.9C122.471 67.9 125.038 67.0667 127.371 65.4V25.7C124.904 24.1 122.371 23.3 119.771 23.3C116.571 23.3 113.838 25.1667 111.571 28.9C109.304 32.5667 108.171 38.3667 108.171 46.3C108.171 54.2333 109.238 59.8333 111.371 63.1C113.504 66.3 116.271 67.9 119.671 67.9Z" fill="white"/>
                    <path d="M76.6438 15.3C74.3771 15.3 72.4438 14.6 70.8438 13.2C69.3104 11.7333 68.5438 9.89998 68.5438 7.69998C68.5438 5.43331 69.3104 3.59998 70.8438 2.19998C72.4438 0.799976 74.3771 0.0999756 76.6438 0.0999756C78.9104 0.0999756 80.8104 0.799976 82.3438 2.19998C83.8771 3.59998 84.6438 5.43331 84.6438 7.69998C84.6438 9.89998 83.8771 11.7333 82.3438 13.2C80.8104 14.6 78.9104 15.3 76.6438 15.3ZM64.8438 70.1V69.1L66.2438 68.7C67.5771 68.3 68.4771 67.7 68.9438 66.9C69.4771 66.1 69.7438 65.0333 69.7438 63.7V32.4C69.7438 31 69.4771 29.9666 68.9438 29.3C68.4771 28.5666 67.5771 28.0666 66.2438 27.8L64.8438 27.5V26.5L83.1438 20.6L84.1438 21.6L83.8438 35.8V63.8C83.8438 65.1333 84.0771 66.2 84.5438 67C85.0771 67.8 85.9771 68.4 87.2438 68.8L88.2438 69.1V70.1H64.8438Z" fill="white"/>
                    <path d="M0 70.1V69.1L2.1 68.3C4.23333 67.4333 5.3 65.7333 5.3 63.2V11C5.3 8.33331 4.23333 6.63331 2.1 5.89998L0 5.09998V4.09998H26.4C33.4667 4.09998 39.5333 5.43331 44.6 8.09998C49.7333 10.7 53.6667 14.4666 56.4 19.4C59.2 24.2666 60.6 30.1333 60.6 37C60.6 44 59.1 49.9666 56.1 54.9C53.1 59.8333 48.9 63.6 43.5 66.2C38.1667 68.8 31.8667 70.1 24.6 70.1H0ZM20.3 68.1H24.6C29.4 68.1 33.2667 67.1666 36.2 65.3C39.1333 63.3666 41.2667 60.1666 42.6 55.7C44 51.1666 44.7 44.9666 44.7 37.1C44.7 29.2333 44 23.0666 42.6 18.6C41.2667 14.0666 39.1667 10.8666 36.3 8.99998C33.4333 7.06664 29.6667 6.09998 25 6.09998H20.3V68.1Z" fill="white"/>
                    </svg>
                    
            </div>
            <div
                class="pt-8 border-t border-gray-700 flex flex-col md:flex-row md:items-center md:justify-between gap-4 text-sm">
                <p>©2025 Supapower. Crafted by Supercharged with <a href="https://www.framer.com" target="_blank"
                        rel="noopener noreferrer" class="text-white hover:underline">Framer</a>.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-white transition-colors">Privacy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms</a>
                    <a href="#" class="hover:text-white transition-colors">Cookies</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
