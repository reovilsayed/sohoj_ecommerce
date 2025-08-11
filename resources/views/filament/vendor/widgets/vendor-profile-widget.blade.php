<x-filament-widgets::widget>
    <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 border border-blue-200/50 p-6">
        <!-- Decorative background elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-400/20 to-purple-400/20 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-indigo-400/20 to-blue-400/20 rounded-full translate-y-12 -translate-x-12"></div>
        
        <!-- Main content -->
        <div class="relative z-10">
            <!-- Welcome icon -->
            <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full mx-auto mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            
            <!-- Welcome message -->
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-700 bg-clip-text text-transparent mb-2">
                    Welcome to Your Shop! 🎉
                </h2>
                <p class="text-gray-700 text-lg leading-relaxed">
                    Congratulations on taking the first step towards building your business! 
                    To unlock your full seller dashboard and start selling, please complete your profile.
                </p>
            </div>
            
            <!-- Benefits list -->
            <div class="bg-white/60 backdrop-blur-sm rounded-lg p-4 mb-6 border border-white/50">
                <h3 class="font-semibold text-gray-800 mb-3 text-center">What you'll get:</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div class="flex items-center space-x-2 text-sm text-gray-700">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <span>Product Management</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-gray-700">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <span>Order Tracking</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-gray-700">
                        <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                        <span>Earnings Dashboard</span>
                    </div>
                </div>
            </div>
            
            <!-- Call to action button -->
            <div class="text-center">
                <x-filament::button 
                    tag="a" 
                    href="{{ route('filament.vendor.pages.vendor-profile-page') }}"
                    size="lg"
                    class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl px-8 py-3 text-white font-semibold rounded-lg"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                    Complete Your Profile Now
                </x-filament::button>
                <p class="text-xs text-gray-500 mt-2">Click the button above to get started</p>
            </div>
        </div>
        
        <!-- Bottom accent -->
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-400 via-indigo-500 to-purple-500"></div>
    </div>
</x-filament-widgets::widget>
