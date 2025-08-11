<x-filament-widgets::widget>
    <x-filament::card>
        <div class="text-center space-y-6">
            <!-- Welcome header -->
            <div class="space-y-2">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-primary-500/10 text-primary-600 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-900">
                    Welcome, {{ auth()->user()->name }}!
                </h2>
                <p class="text-gray-600">
                    Your profile has been submitted successfully.
                </p>
            </div>

            <!-- Status card -->
            <x-filament::card class="bg-amber-50 border-amber-200">
                <div class="flex items-center justify-center space-x-2 mb-3">
                    <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
                    <span class="text-sm font-medium text-amber-800">Verification in Progress</span>
                    <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
                </div>
                <p class="text-sm text-amber-700 text-center">
                    We're reviewing your information. This usually takes 24-48 hours.
                </p>
            </x-filament::card>

            <!-- Info card -->
            <x-filament::card class="bg-blue-50 border-blue-200">
                <div class="flex items-start space-x-3">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="text-left">
                        <h4 class="text-sm font-medium text-blue-800">What happens next?</h4>
                        <p class="text-sm text-blue-700 mt-1">
                            You'll receive an email notification once verification is complete. 
                            You can still access your dashboard while waiting.
                        </p>
                    </div>
                </div>
            </x-filament::card>

            <!-- Action button -->
            <div class="pt-2">
                <x-filament::button 
                    tag="a" 
                    href="{{ route('filament.vendor.pages.dashboard') }}"
                    size="lg"
                    class="w-full sm:w-auto"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                    </svg>
                    Go to Dashboard
                </x-filament::button>
            </div>
        </div>
    </x-filament::card>
</x-filament-widgets::widget>



