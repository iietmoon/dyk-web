@extends('layouts.checkout')

@section('title', 'Checkout')

@section('content')
    @if(isset($error))
        <div class="rounded-2xl bg-white border border-red-200 p-6 text-center shadow-sm">
            <p class="text-red-800 font-medium">{{ $error }}</p>
            <a href="{{ url('/subscriptions') }}" class="mt-4 inline-block text-sm font-semibold text-red-600 hover:text-red-800 underline">
                View subscription options
            </a>
        </div>
    @else
        <div class="mb-6 flex items-center gap-4">
            <div>
                <svg class="w-10 h-10" width="308" height="308" viewBox="0 0 308 308" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="308" height="308" rx="75" fill="#1E1E1E"/>
                    <path d="M191.375 196.93V194.2L194.105 193.42C195.838 192.9 196.965 192.12 197.485 191.08C198.005 190.04 198.265 188.653 198.265 186.92V121.14C198.265 119.32 197.962 117.933 197.355 116.98C196.835 115.94 195.708 115.16 193.975 114.64L191.375 113.73V111H222.965V113.73L220.235 114.64C218.588 115.073 217.505 115.81 216.985 116.85C216.465 117.89 216.205 119.32 216.205 121.14V187.05C216.205 188.783 216.508 190.17 217.115 191.21C217.722 192.163 218.848 192.9 220.495 193.42L222.965 194.2V196.93H191.375ZM238.695 196.93V194.2L240.255 193.81C241.902 193.377 242.768 192.553 242.855 191.34C242.942 190.127 242.378 188.74 241.165 187.18L216.335 152.73L248.055 120.49C249.355 119.19 250.048 118.02 250.135 116.98C250.308 115.853 249.528 114.987 247.795 114.38L245.585 113.73V111H266.125V113.73L262.745 114.64C260.752 115.247 259.148 115.983 257.935 116.85C256.722 117.63 255.335 118.843 253.775 120.49L230.635 144.02L260.405 186.53C261.792 188.437 263.092 189.953 264.305 191.08C265.605 192.207 267.338 193.073 269.505 193.68L271.325 194.2V196.93H238.695Z" fill="#F0EFEB"/>
                    <path d="M133.542 196.93V194.2L137.312 193.29C139.046 192.857 140.259 192.12 140.952 191.08C141.646 190.04 142.036 188.653 142.122 186.92V163.39L121.192 120.62C120.326 118.887 119.502 117.587 118.722 116.72C117.942 115.853 116.816 115.16 115.342 114.64L113.002 113.73V111H147.452V113.73L145.112 114.51C143.206 115.117 142.166 116.113 141.992 117.5C141.819 118.8 142.209 120.49 143.162 122.57L157.982 155.33L173.972 121.66C174.752 120.1 175.099 118.583 175.012 117.11C174.926 115.637 174.016 114.683 172.282 114.25L170.462 113.73V111H187.492V113.73L184.892 114.51C183.159 115.03 181.902 115.81 181.122 116.85C180.429 117.89 179.692 119.277 178.912 121.01L160.842 158.58V186.92C160.842 190.473 162.402 192.597 165.522 193.29L169.422 194.2V196.93H133.542Z" fill="#F0EFEB"/>
                    <path d="M37 196.93V194.2L39.6 193.29C42.3733 192.423 43.76 190.257 43.76 186.79C43.8467 181.85 43.89 176.823 43.89 171.71C43.89 166.51 43.89 161.223 43.89 155.85V151.3C43.89 146.273 43.89 141.247 43.89 136.22C43.89 131.193 43.8467 126.167 43.76 121.14C43.76 117.587 42.4167 115.377 39.73 114.51L37 113.73V111H71.19C80.29 111 88.1333 112.69 94.72 116.07C101.307 119.45 106.377 124.347 109.93 130.76C113.483 137.087 115.26 144.757 115.26 153.77C115.26 162.957 113.31 170.757 109.41 177.17C105.597 183.583 100.18 188.48 93.16 191.86C86.2267 195.24 78.1233 196.93 68.85 196.93H37ZM62.61 193.16H69.24C75.3933 193.16 80.3767 191.947 84.19 189.52C88.09 187.093 90.95 183.02 92.77 177.3C94.59 171.493 95.5 163.693 95.5 153.9C95.5 144.107 94.59 136.35 92.77 130.63C90.95 124.91 88.1333 120.837 84.32 118.41C80.5933 115.983 75.74 114.77 69.76 114.77H62.61C62.5233 120.75 62.48 126.817 62.48 132.97C62.48 139.037 62.48 145.147 62.48 151.3V155.72C62.48 162.22 62.48 168.59 62.48 174.83C62.48 180.983 62.5233 187.093 62.61 193.16Z" fill="#F0EFEB"/>
                    </svg>
                    
            </div>
           <div>
            <h1 class="text-lg font-bold text-[#0f0f0f] tracking-tight">
                Did You Know?
            </h1>
            <p class="text-xs text-[#737373]">Discover Facts & Learn Something New Daily</p>
           </div>
        </div>

        <div class="rounded-2xl bg-white border border-gray-200 shadow-sm overflow-hidden">
            {{-- Plan --}}
            <div class="p-5 border-b border-gray-100">
                <p class="text-xs font-semibold text-[#737373] uppercase tracking-wider mb-4">Order Summary</p>
                <div class="bg-neutral-100 p-4 rounded-md p-1">
                    <p class="mt-1 text-md font-bold text-[#0f0f0f]">{{ $plan->name }} Subscription</p>
                    @if($plan->description)
                        <p class="mt-0.5 text-sm text-[#737373]">{{ $plan->description }}</p>
                    @endif
                    <p class="mt-3 text-xl font-bold text-[#0f0f0f]">
                        ${{ number_format($plan->price, 2) }}
                        <span class="text-sm font-normal text-[#737373]">/ {{ $plan->billing_cycle === 'annual' ? 'year' : 'month' }}</span>
                    </p>
                </div>
            </div>

            @if($user)
            <div class="p-5 border-b border-gray-100 bg-gray-50/50">
                <p class="text-xs font-semibold text-[#737373] uppercase tracking-wider">Account</p>
                <p class="mt-1 font-medium text-[#0f0f0f]">{{ $user->name }}</p>
                <p class="text-sm text-[#737373]">{{ $user->email }}</p>
            </div>
            @endif

            {{-- Paddle inline checkout container (Paddle embeds the payment form here) --}}
            <div class="p-5">
                <p class="text-xs text-[#737373] mb-4">Link expires {{ $expires_at->format('M j, g:i A') }}</p>
                @if($plan->provider === 'paddle' && $plan->provider_product_id)
                    {{-- Full-screen overlay shown when checkout completes; 20s countdown then redirect --}}
                    <div id="payment-complete-overlay" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-[#0f0f0f]/95 text-white hidden" aria-live="polite" aria-busy="true">
                        <div class="flex flex-col items-center justify-center max-w-sm mx-auto px-6 text-center">
                            <div class="relative w-16 h-16 mb-8" aria-hidden="true">
                                <div class="absolute inset-0 rounded-full border-4 border-white/20"></div>
                                <div class="absolute inset-0 rounded-full border-4 border-transparent border-t-white animate-spin"></div>
                            </div>
                            <h1 class="text-xl font-bold mb-2">Payment complete</h1>
                            <p class="text-sm text-white/80 mb-2">Confirming your subscription. Redirecting shortly…</p>
                            <p class="text-xs text-white/50">Redirecting in <span id="payment-redirect-seconds">20</span>s…</p>
                        </div>
                    </div>
                    <div id="paddle-checkout-container" class="paddle-checkout-container min-h-[420px]"></div>
                    <hr class="my-4 border-gray-200">
                    <p class="mt-3 text-xs text-[#737373] flex justify-center items-center flex-wrap gap-2">
                        <a href="{{ route('website.terms-of-service') }}" class="underline">Terms of service</a> ·
                        <a href="{{ route('website.privacy-policy') }}" class="underline">Privacy policy</a> ·
                        <a href="{{ route('website.refunds') }}" class="underline">Refund policy</a>
                    </p>
                @else
                    <button
                        type="button"
                        class="w-full inline-flex items-center justify-center px-5 py-4 rounded-xl bg-[#0f0f0f] text-white font-semibold text-[15px] hover:bg-[#262626] active:scale-[0.98] transition-colors touch-manipulation"
                        aria-label="Proceed to payment"
                    >
                        Proceed to payment
                    </button>
                @endif
            </div>
        </div>
    @endif
@endsection

@if(!isset($error) && isset($plan) && $plan->provider === 'paddle' && $plan->provider_product_id)
@push('head')
    <script src="https://cdn.paddle.com/paddle/v2/paddle.js"></script>
@endpush
@push('scripts')
    <script>
        (function() {
            var clientToken = @json(config('services.paddle.client_token'));
            var environment = @json(config('services.paddle.environment'));
            var priceId = @json($plan->provider_product_id);
            var customerEmail = @json($user->email ?? null);
            var customerName = @json($user->name ?? null);
            var customerCountry = @json(config('services.paddle.default_country'));

            if (!clientToken) {
                console.error('Paddle: PADDLE_CLIENT_TOKEN is not set in .env');
                return;
            }

            if (environment === 'sandbox') {
                Paddle.Environment.set('sandbox');
            }

            var successUrl = @json(route('website.payment.success'));
            @php
                $paddleCustomData = [
                    'user_id' => $transactionToken->user_id ?? null,
                    'plan_id' => $transactionToken->plan_id ?? null,
                    'transaction_token_id' => $transactionToken->id ?? null,
                ];
            @endphp
            var customData = @json($paddleCustomData);

            Paddle.Initialize({
                token: clientToken,
                eventCallback: function(event) {
                    if (event.name === 'checkout.completed') {
                        var data = event.data || {};
                        var params = new URLSearchParams();
                        if (data.transaction_id) params.set('transaction_id', data.transaction_id);
                        if (data.id) params.set('checkout_id', data.id);
                        var redirectUrl = successUrl + (params.toString() ? '?' + params.toString() : '');

                        var overlay = document.getElementById('payment-complete-overlay');
                        var secondsEl = document.getElementById('payment-redirect-seconds');
                        if (overlay) overlay.classList.remove('hidden');
                        var delaySeconds = 20;
                        var countdown = delaySeconds;
                        if (secondsEl) secondsEl.textContent = countdown;
                        var t = setInterval(function() {
                            countdown -= 1;
                            if (secondsEl) secondsEl.textContent = countdown;
                            if (countdown <= 0) {
                                clearInterval(t);
                                window.location.href = redirectUrl;
                            }
                        }, 1000);
                    }
                },
                checkout: {
                    settings: {
                        displayMode: 'inline',
                        frameTarget: 'paddle-checkout-container',
                        frameInitialHeight: 450,
                        frameStyle: 'width: 100%; min-width: 312px; background-color: transparent; border: none;'
                    }
                }
            });

            function openPaddleCheckout() {
                var options = {
                    items: [{ priceId: priceId, quantity: 1 }]
                };
                if (customerEmail || customerName || customerCountry) {
                    options.customer = {};
                    if (customerEmail) options.customer.email = customerEmail;
                    if (customerName) options.customer.name = customerName;
                    if (customerCountry) {
                        options.customer.address = { countryCode: customerCountry };
                    }
                }
                if (customData && Object.keys(customData).length) {
                    options.customData = customData;
                }
                Paddle.Checkout.open(options);
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', openPaddleCheckout);
            } else {
                openPaddleCheckout();
            }
        })();
    </script>
@endpush
@endif
