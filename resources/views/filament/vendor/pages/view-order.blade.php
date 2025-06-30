<x-filament::page>
    @push('styles')
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                        },
                        colors: {
                            primary: {
                                50: '#f0f9ff',
                                100: '#e0f2fe',
                                500: '#3b82f6',
                                600: '#2563eb',
                            },
                            secondary: {
                                500: '#8b5cf6',
                            }
                        }
                    }
                }
            }
        </script>
        <style>
            @media print {


                #body {
                    width: 210mm;
                    height: 297mm;
                }

                .no-print {
                    display: none !important;
                }
            }
        </style>
    @endpush

    <div id="body" class="bg-gray-50 font-sans text-gray-700">
        <div class="max-w-4xl mx-auto my-8">
            <!-- Invoice Container -->
            <div class="bg-white  shadow-sm overflow-hidden p-6 mt-6 mb-5">
                <!-- Header with gradient -->
                <div class="bg-gradient-to-r from-primary-500 to-secondary-500 px-8 py-6">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <!-- Replace with your logo -->
                            <div class="bg-white p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                            </div>
                            <h1 class="text-2xl font-bold text-black">{{ $record->shop->name }}</h1>
                        </div>
                        <div class="text-right">
                            <h2 class="text-3xl font-bold text-white">INVOICE</h2>
                            <p class="text-primary-100 font-medium">#INV-{{ now()->format('Y') }}-{{ $record->id }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Invoice Meta -->
                <div class="px-8 py-6 border-b border-gray-100">
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Invoice Date</h3>
                            <p class="mt-1 text-sm font-medium">{{ $record->created_at->format('F j, Y') }}</p>
                        </div>
                        <div>
                            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Order Number</h3>
                            <p class="mt-1 text-sm font-medium">#ORD-{{ now()->format('Y') }}-{{ $record->id }}</p>
                        </div>
                    </div>
                </div>

                <!-- From/To -->
                <div class="px-8 py-6 flex justify-between border-b border-gray-100">
                    <div>
                        {{-- @dd($record->shop) --}}
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">From</h3>
                        <p class="font-bold">YourStore Inc.</p>
                        {{-- <p class="text-sm">123 Business Avenue</p> --}}
                        <p class="text-sm">
                            {{ $record->shop->state . '-' . $record->shop->city . '-' . $record->shop->post_code }}</p>
                        <p class="text-sm mt-2">Phone: {{ $record->shop->phone }}</p>
                        <p class="text-sm">Email: {{ $record->shop->email }}</p>
                    </div>

                    @php
                        $shipping = is_string($record->shipping) ? json_decode($record->shipping) : $record->shipping;
                    @endphp
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">To</h3>
                        <p class="font-bold">{{ $shipping->first_name ?? '' }} {{ $shipping->last_name ?? '' }}</p>
                        <p class="text-sm">{{ $shipping->city ?? '' }}, {{ $shipping->state ?? '' }}</p>
                        <p class="text-sm">
                            {{ $shipping->country ?? '' }}-{{ $shipping->post_code ?? '' }}
                        </p>
                        <p class="text-sm mt-2">Phone: {{ $shipping->phone ?? '' }}</p>
                        <p class="text-sm">Email: {{ $shipping->email ?? '' }}</p>
                    </div>
                </div>

                <!-- Items Table -->
                <div class="px-0 overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="ps-4 px-8 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Item</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Price</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Qty</th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Amount</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if ($record->product->image)
                                            <div class="flex-shrink-0 h-12 w-12 bg-gray-100 rounded-md overflow-hidden">
                                                <img src="{{ Storage::url($record->product->image) }}"
                                                    alt="{{ $record->product->name }}"
                                                    class="h-full w-full object-cover">
                                            </div>
                                        @else
                                            <div
                                                class="flex-shrink-0 h-12 w-12 bg-gray-100 rounded-md flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $record->product->name }}
                                            </div>
                                            <div class="text-sm text-gray-500">SKU: {{ $record->product->sku }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ Sohoj::price($record->product->price) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $record->quantity }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right text-gray-900">
                                    {{ Sohoj::price($record->product->price * $record->quantity) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Totals -->
                {{-- @dd($record->shipping_total) --}}
                <div class="px-8 py-6 border-t border-gray-100">
                    <div class="flex justify-end">
                        <div class="w-64">
                            <div class="flex justify-between py-2 text-sm text-gray-600">
                                <span>Subtotal</span>
                                <span>{{ Sohoj::price($record->subtotal) }}</span>
                            </div>
                            <div class="flex justify-between py-2 text-sm text-gray-600">
                                <span>Shipping</span>
                                <span>{{ $record->shipping_total }}</span>
                            </div>
                            <div class="flex justify-between py-2 text-sm text-gray-600">
                                <span>Tax</span>
                                <span>{{ $record->tax ?? 00 }}</span>
                            </div>
                            <div
                                class="flex justify-between py-3 mt-2 border-t border-gray-200 text-base font-semibold text-primary-600">
                                <span>Total</span>
                                <span>{{ Sohoj::price($record->total) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Info -->
                <div class="p-6 bg-gray-50 ">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Payment Information
                    </h3>
                    <div class="flex justify-between gap-6">
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-1">Bank Transfer</p>
                            <p class="text-sm text-gray-500">Bank Name: Chase Bank</p>
                            <p class="text-sm text-gray-500">Account Name: YourStore Inc.</p>
                            <p class="text-sm text-gray-500">Account Number: XXXX-XXXX-XXXX</p>
                            <p class="text-sm text-gray-500">Routing Number: XXXX-XXXX</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-1">Online Payment</p>
                            <p class="text-sm text-gray-500">PayPal: paypal.me/yourstore</p>
                            <p class="text-sm text-gray-500">Stripe: checkout.yourstore.com</p>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-8 py-4 bg-white border-t border-gray-100">
                    <div class="flex items-center justify-between">
                        <p class="text-xs text-gray-500">Thank you for your business!</p>
                        <div class="flex space-x-4 no-print gap-3">
                            <x-filament::button color="primary" icon="heroicon-o-printer" id="print-invoice-btn">
                                Print Invoice
                            </x-filament::button>
                            <x-filament::button color="secondary" icon="heroicon-o-arrow-down-tray" style="background-color: #209EBB; color: white;">
                                Download PDF
                            </x-filament::button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const printBtn = document.getElementById('print-invoice-btn');
                if (printBtn) {
                    printBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        window.print();
                    });
                }
            });
        </script>
    @endpush
</x-filament::page>
