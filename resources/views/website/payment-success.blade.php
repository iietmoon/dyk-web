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
        <p class="text-[#737373] text-sm mb-6">You can close this tab and return to the app.</p>
        <p class="text-xs text-[#737373]" id="return-hint">Returning to app…</p>
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

            if (deepLink) {
                window.location.href = deepLink;
                setTimeout(function() {
                    var el = document.getElementById('return-hint');
                    if (el) el.textContent = 'If the app did not open, close this tab manually.';
                }, 2000);
            } else {
                var el = document.getElementById('return-hint');
                if (el) el.textContent = 'Close this tab to return to the app.';
            }

            try { window.close(); } catch (e) {}
        })();
    </script>
@endsection
