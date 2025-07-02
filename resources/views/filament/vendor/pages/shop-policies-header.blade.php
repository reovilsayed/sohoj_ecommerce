<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-primary-50 to-primary-100 px-6 py-5 border-b border-gray-200">
        <div class="flex items-center">
            <div class="flex-shrink-0 mr-4">
                @if (isset($shop) && $shop->logo)
                    <img src="{{ Storage::url($shop->logo) }}" alt="Shop Logo"
                        class="w-16 h-16 rounded-full object-cover border-2 border-white shadow-sm">
                @else
                    <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center text-primary-600 border-2 border-white shadow-sm">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                @endif
            </div>
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                    <svg class="w-6 h-6 text-primary-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    {{ $shop->name ?? 'Shop Policies' }}
                </h2>
                <p class="text-gray-600 mt-1 text-sm">
                    {{ $shop->description ?? "Manage your shop's policies to ensure clear communication with customers." }}
                </p>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="p-6">
        <form action="{{ route('vendor.shopPolicy.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">
                <!-- Delivery Policy -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <div class="flex items-center mb-3">
                        <svg class="w-5 h-5 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-800">Delivery Policy</h3>
                    </div>
                    <textarea id="delivery" name="delivery" rows="4"
                        class="w-full px-4 py-3 text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition @error('delivery') border-red-500 @enderror"
                        placeholder="Describe your delivery timelines, areas covered, and any shipping fees...">{{ auth()->user()->shop->shopPolicy ? auth()->user()->shop->shopPolicy->delivery : '' }}</textarea>
                    @error('delivery')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Payment Options -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <div class="flex items-center mb-3">
                        <svg class="w-5 h-5 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-800">Payment Options</h3>
                    </div>
                    <textarea id="payment_option" name="payment_option" rows="4"
                        class="w-full px-4 py-3 text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition @error('payment_option') border-red-500 @enderror"
                        placeholder="List all accepted payment methods (credit cards, PayPal, bank transfer, etc.)...">{{ auth()->user()->shop->shopPolicy ? auth()->user()->shop->shopPolicy->payment_option : '' }}</textarea>
                    @error('payment_option')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Return & Exchange -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <div class="flex items-center mb-3">
                        <svg class="w-5 h-5 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-800">Return & Exchange Policy</h3>
                    </div>
                    <textarea id="return_exchange" name="return_exchange" rows="4"
                        class="w-full px-4 py-3 text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition @error('return_exchange') border-red-500 @enderror"
                        placeholder="Explain your return window, conditions for returns, and exchange process...">{{ auth()->user()->shop->shopPolicy ? auth()->user()->shop->shopPolicy->return_exchange : '' }}</textarea>
                    @error('return_exchange')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cancellation Policy -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <div class="flex items-center mb-3">
                        <svg class="w-5 h-5 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-800">Cancellation Policy</h3>
                    </div>
                    <textarea id="cancellation" name="cancellation" rows="4"
                        class="w-full px-4 py-3 text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition @error('cancellation') border-red-500 @enderror"
                        placeholder="Specify your order cancellation policy, including deadlines and any fees...">{{ auth()->user()->shop->shopPolicy ? auth()->user()->shop->shopPolicy->cancellation : '' }}</textarea>
                    @error('cancellation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-2">
                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors duration-150">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save All Policies
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>