@extends('layouts.checkout')

@section('title', 'Payment successful')

@section('content')
    <div class="rounded-2xl bg-white border border-gray-200 shadow-sm p-8 text-center">
        <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-green-100 text-green-600 mb-6" aria-hidden="true">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <h1 class="text-xl font-bold text-[#0f0f0f] mb-2">Payment successful</h1>
        <p class="text-[#737373] text-sm mb-6">Thank you for your purchase. You can close this tab and return to the app.</p>
        <p class="text-xs text-[#737373] mb-6" id="return-hint"></p>
        <button
            type="button"
            id="close-tab-btn"
            class="w-full inline-flex items-center justify-center gap-2 px-5 py-4 rounded-xl bg-[#0f0f0f] text-white font-semibold text-[15px] hover:bg-[#262626] active:scale-[0.98] transition-colors touch-manipulation"
            aria-label="Close this tab"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            Close this tab
        </button>
    </div>

    <script>
        (function() {
            var scheme = @json(config('services.paddle.success_deep_link_scheme'));
            var transactionId = @json(request()->query('transaction_id', ''));
            var checkoutId = @json(request()->query('checkout_id', ''));

            var params = new URLSearchParams();
            if (transactionId) params.set('transaction_id', transactionId);
            if (checkoutId) params.set('checkout_id', checkoutId);
            params.set('status', 'completed');
            var query = params.toString();

            scheme = (scheme || '').replace(/:?\/?\/?$/, '');
            var deepLink = scheme ? (scheme + '://payment/success' + (query ? '?' + query : '')) : '';

            var hintEl = document.getElementById('return-hint');
            var closeBtn = document.getElementById('close-tab-btn');

            function setHint(text) {
                if (hintEl) hintEl.textContent = text;
            }

            closeBtn.addEventListener('click', function() {
                try {
                    window.close();
                } catch (e) {}
                setHint('If this tab did not close, use your browser\'s close button or close the window.');
            });

            if (deepLink) {
                setHint('Returning to app…');
                window.location.href = deepLink;
                setTimeout(function() {
                    setHint('If the app did not open, click "Close this tab" above.');
                }, 2000);
            } else {
                setHint('Click the button below to close this tab.');
            }
        })();
    </script>
@endsection
