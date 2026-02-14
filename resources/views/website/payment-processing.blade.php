@extends('layouts.checkout')

@section('title', 'Processing your payment')

@section('content')
    <div class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-[#0f0f0f]/95 text-white" aria-live="polite" aria-busy="true">
        <div class="flex flex-col items-center justify-center max-w-sm mx-auto px-6 text-center">
            <div class="relative w-16 h-16 mb-8" aria-hidden="true">
                <div class="absolute inset-0 rounded-full border-4 border-white/20"></div>
                <div class="absolute inset-0 rounded-full border-4 border-transparent border-t-white animate-spin"></div>
            </div>
            <h1 class="text-xl font-bold mb-2">Processing your payment</h1>
            <p class="text-sm text-white/80 mb-2">Confirming your subscription with our payment provider.</p>
            <p class="text-xs text-white/60 mb-8">This usually takes 15–30 seconds. Please don't close this page.</p>
            <p class="text-xs text-white/50" id="countdown">Checking again in <span id="seconds">20</span>s…</p>
        </div>
    </div>

    <script>
        (function() {
            var successUrl = @json($success_url);
            var delaySeconds = 20;
            var el = document.getElementById('seconds');
            var countdown = delaySeconds;

            var t = setInterval(function() {
                countdown -= 1;
                if (el) el.textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(t);
                    window.location.href = successUrl;
                }
            }, 1000);
        })();
    </script>
@endsection
