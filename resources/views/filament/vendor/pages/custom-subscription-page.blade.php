<x-filament-panels::page>
    @php
        $methods = auth()->user()->paymentMethods();
    @endphp
    <!-- Header Section -->
    <x-filament::card>
        <div class="mb-6">
            <div class="px-6 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Subscription Settings</h1>
                    <p class="text-gray-500 mt-1">Manage your payment methods and subscription preferences</p>
                </div>
                <div class="flex items-center space-x-2">
                    <span
                        class="px-3 py-1 rounded-full text-sm font-medium 
                    {{ $status ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $status ? 'Active' : 'Paused' }}
                    </span>
                </div>
            </div>
        </div>
    </x-filament::card>
    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Payment Methods -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Payment Methods Card -->
            <x-filament::card>
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Payment Methods</h2>
                </div>

                <!-- Add New Card -->
                <div class="p-6">
                    <button id="add-card-toggle"
                        class="w-full flex items-center justify-between p-4 border-2 border-dashed border-gray-200 rounded-lg hover:border-primary-500 transition-colors"
                        onclick="toggleCardForm()">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-primary-500 mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="font-medium text-gray-700">Add new payment method</span>
                        </div>
                        <svg id="toggle-icon" class="w-5 h-5 text-gray-400 transform transition-transform"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- Card Form (Hidden by default) -->
                    <div id="add-card-form" class="hidden mt-4 bg-gray-50 p-5 rounded-lg">
                        <form id="cardAddFrom" action="{{ route('user.card.add') }}" method="POST">
                            @csrf
                            <input id="card-holder-name" type="hidden" value="{{ auth()->user()->name }}">
                            <input type="hidden" id="paymentmethod" name="payment_method" value="">

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Card Details</label>
                                    <div id="card-element"
                                        class="p-3 border border-gray-300 rounded-lg bg-white shadow-sm"></div>
                                    <div id="card-errors" class="mt-2 text-sm text-red-600"></div>
                                </div>

                                <div class="flex justify-end space-x-3 pt-2">
                                    <button type="button" onclick="toggleCardForm()"
                                        class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                        Cancel
                                    </button>
                                    <button type="button" id="card-button" data-secret="{{ $intent }}"
                                        class="px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 flex items-center">
                                        <span id="submit-text">Save Card</span>
                                        <span id="spinner" class="hidden ml-2">
                                            <svg class="animate-spin h-4 w-4 text-white"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                                    stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                </path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Saved Payment Methods -->
                <div class="px-6 pb-6">
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4">Saved Methods</h3>
                    <div class="space-y-4">
                        @foreach ($methods as $payment)
                            <div class="border rounded-xl overflow-hidden transition-all hover:shadow-md">
                                <div class="p-5">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center">
                                            <!-- Card Brand Icon -->
                                            <div
                                                class="w-10 h-7 mr-3 flex items-center justify-center rounded bg-white shadow-xs border">
                                                @if (strtolower($payment->card->brand) === 'visa')
                                                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/visa/visa-original.svg"
                                                        class="h-4" alt="Visa">
                                                @elseif(strtolower($payment->card->brand) === 'mastercard')
                                                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mastercard/mastercard-original.svg"
                                                        class="h-4" alt="Mastercard">
                                                @elseif(strtolower($payment->card->brand) === 'amex')
                                                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/americanexpress/americanexpress-original.svg"
                                                        class="h-4" alt="American Express">
                                                @else
                                                    <span
                                                        class="text-xs font-bold text-gray-700">{{ strtoupper(substr($payment->card->brand, 0, 2)) }}</span>
                                                @endif
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-900">
                                                    {{ ucwords($payment->card->brand) }}</h4>
                                                <p class="text-sm text-gray-500">Expires
                                                    {{ $payment->card->exp_month }}/{{ $payment->card->exp_year }}</p>
                                            </div>
                                        </div>
                                        @if (auth()->user()->getCard() && auth()->user()->getCard()->id == $payment->id)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Default
                                            </span>
                                        @endif
                                    </div>

                                    <div class="mt-4 flex justify-between items-center">
                                        <p class="text-sm font-mono text-gray-600">•••• •••• ••••
                                            {{ $payment->card->last4 }}</p>
                                        <div class="flex space-x-3">
                                            @if (!(auth()->user()->getCard() && auth()->user()->getCard()->id == $payment->id))
                                                <button
                                                    onclick="setAsDefault('{{ route('user.setCardAsDefault', ['method' => $payment->id]) }}')"
                                                    class="text-sm font-medium text-primary-600 hover:text-primary-800">
                                                    Set Default
                                                </button>
                                            @endif
                                            <button
                                                onclick="confirmRemove('{{ route('user.removeCard', ['method' => $payment->id]) }}')"
                                                class="text-sm font-medium text-red-600 hover:text-red-800">
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </x-filament::card>
        </div>

        <!-- Right Column - Subscription Actions -->
        <div class="space-y-6">
            <!-- Subscription Status Card -->
            <x-filament::card>
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Subscription Status</h2>
                </div>
                <div class="p-6">
                    <div class="flex items-start">
                        <div
                            class="flex-shrink-0 h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">
                                {{ $status ? 'Active Subscription' : 'Subscription Paused' }}</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $status
                                    ? 'Your subscription is active and will renew automatically'
                                    : 'Your subscription is currently paused' }}
                            </p>
                        </div>
                    </div>
                </div>
            </x-filament::card>

            <!-- Subscription Actions Card -->
            <x-filament::card>
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Actions</h2>
                </div>
                <div class="p-6 space-y-4">
                    @if ($status)
                        <button onclick="confirmPause()"
                            class="w-full flex items-center justify-between p-4 bg-yellow-50 border border-yellow-100 rounded-lg hover:bg-yellow-100 transition-colors">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-yellow-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-medium text-yellow-800">Pause Subscription</span>
                            </div>
                            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    @else
                        <button onclick="confirmResume()"
                            class="w-full flex items-center justify-between p-4 bg-green-50 border border-green-100 rounded-lg hover:bg-green-100 transition-colors">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-medium text-green-800">Resume Subscription</span>
                            </div>
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    @endif

                    <button onclick="confirmDeactivate()"
                        class="w-full flex items-center justify-between p-4 bg-red-50 border border-red-100 rounded-lg hover:bg-red-100 transition-colors">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-600 mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                            <span class="font-medium text-red-800">Deactivate Shop</span>
                        </div>
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>
            </x-filament::card>
        </div>
    </div>

    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
            // Toastr configuration
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000"
            };

            // Toggle card form
            function toggleCardForm() {
                const form = document.getElementById('add-card-form');
                const toggleIcon = document.getElementById('toggle-icon');

                form.classList.toggle('hidden');
                toggleIcon.classList.toggle('rotate-180');
            }

            // Set card as default
            function setAsDefault(url) {
                if (confirm('Set this card as your default payment method?')) {
                    window.location.href = url;
                }
            }

            // Confirm card removal
            function confirmRemove(url) {
                if (confirm('Are you sure you want to remove this payment method?\n\nThis action cannot be undone.')) {
                    window.location.href = url;
                }
            }

            // Confirm subscription pause
            function confirmPause() {
                if (confirm(
                        'Pause your subscription?\n\nYour access will continue until the end of the current billing period, but will not renew automatically.'
                        )) {
                    window.location.href = "{{ route('vendor.cancelSubscription') }}";
                }
            }

            // Confirm subscription resume
            function confirmResume() {
                if (confirm('Resume your subscription?\n\nYour subscription will be reactivated immediately.')) {
                    window.location.href = "{{ route('vendor.resumeSubscription') }}";
                }
            }

            // Confirm shop deactivation
            function confirmDeactivate() {
                if (confirm(
                        'WARNING: This will immediately deactivate your shop and cancel your subscription.\n\nAll vendor features will be disabled.\n\nAre you absolutely sure?'
                        )) {
                    window.location.href = "{{ route('vendor.cancelSubscriptionNow') }}";
                }
            }

            // Stripe Elements initialization
            document.addEventListener('DOMContentLoaded', function() {
                const stripe = Stripe("{{ env('STRIPE_KEY') }}");
                const elements = stripe.elements();

                const cardElement = elements.create('card', {
                    style: {
                        base: {
                            fontSize: '16px',
                            color: '#32325d',
                            '::placeholder': {
                                color: '#aab7c4'
                            }
                        },
                        invalid: {
                            color: '#fa755a',
                            iconColor: '#fa755a'
                        }
                    }
                });

                cardElement.mount('#card-element');

                const cardHolderName = document.getElementById('card-holder-name');
                const cardButton = document.getElementById('card-button');
                const clientSecret = cardButton.dataset.secret;

                cardButton.addEventListener('click', async (e) => {
                    e.preventDefault();

                    // Show loading state
                    document.getElementById('submit-text').classList.add('hidden');
                    document.getElementById('spinner').classList.remove('hidden');
                    cardButton.disabled = true;

                    const {
                        setupIntent,
                        error
                    } = await stripe.confirmCardSetup(
                        clientSecret, {
                            payment_method: {
                                card: cardElement,
                                billing_details: {
                                    name: cardHolderName.value
                                }
                            }
                        }
                    );

                    if (error) {
                        // Show error to customer
                        const errorElement = document.getElementById('card-errors');
                        errorElement.textContent = error.message;

                        // Reset button state
                        document.getElementById('submit-text').classList.remove('hidden');
                        document.getElementById('spinner').classList.add('hidden');
                        cardButton.disabled = false;
                    } else {
                        // Success - submit the form
                        document.getElementById('paymentmethod').value = setupIntent.payment_method;
                        toastr.success('Payment method added successfully');
                        document.getElementById('cardAddFrom').submit();
                    }
                });
            });
        </script>
    @endpush
</x-filament-panels::page>
