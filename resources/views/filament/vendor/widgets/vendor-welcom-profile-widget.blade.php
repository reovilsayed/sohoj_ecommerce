<x-filament-widgets::widget>
    <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 border border-green-200/50 p-6">
        <!-- Decorative background elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-400/20 to-emerald-400/20 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-teal-400/20 to-green-400/20 rounded-full translate-y-12 -translate-x-12"></div>
        
        <!-- Main content -->
        <div class="relative z-10">
            <!-- Success icon -->
            <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full mx-auto mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            
            <!-- Welcome message -->
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold bg-gradient-to-r from-green-600 to-emerald-700 bg-clip-text text-transparent mb-2">
                    Welcome, {{ auth()->user()->name }}! 🎉
                </h2>
                <p class="text-gray-700 text-lg leading-relaxed">
                    Thank you for completing your profile! We're excited to have you on board.
                </p>
            </div>
            
            <!-- Verification status -->
            <div class="bg-white/60 backdrop-blur-sm rounded-lg p-6 mb-6 border border-white/50">
                <div class="flex items-center justify-center space-x-3 mb-4">
                    <div class="w-3 h-3 bg-yellow-500 rounded-full animate-pulse"></div>
                    <span class="text-lg font-semibold text-gray-800">Profile Verification in Progress</span>
                    <div class="w-3 h-3 bg-yellow-500 rounded-full animate-pulse"></div>
                </div>
                
                <div class="text-center space-y-3">
                    <p class="text-gray-700">
                        We are currently verifying your information to ensure the best experience for our customers.
                    </p>
                    <div class="inline-flex items-center space-x-2 bg-yellow-50 border border-yellow-200 rounded-lg px-4 py-2">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-medium text-yellow-800">Please wait while we review your details</span>
                    </div>
                </div>
            </div>
            
            <!-- Notification info -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19h6a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-blue-800 mb-1">Email Notification</h4>
                        <p class="text-sm text-blue-700">
                            You will receive an email notification once your profile verification is complete. 
                            This usually takes 24-48 hours.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard access -->
            <div class="text-center">
                <x-filament::button 
                    tag="a" 
                    href="{{ route('filament.vendor.pages.dashboard') }}"
                    size="lg"
                    class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl px-8 py-3 text-white font-semibold rounded-lg"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                    </svg>
                    Go to Dashboard
                </x-filament::button>
                <p class="text-xs text-gray-500 mt-2">Access your dashboard while waiting for verification</p>
            </div>
        </div>
        
        <!-- Bottom accent -->
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-green-400 via-emerald-500 to-teal-500"></div>
    </div>
</x-filament-widgets::widget>


