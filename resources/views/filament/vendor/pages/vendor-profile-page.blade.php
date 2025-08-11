<x-filament-panels::page>
    @php
        $user = Auth::user();
        $shop = $user->shop;

        $userFields = ['name', 'l_name', 'email'];
        $shopFields = [
            'name',
            'logo',
            'banner',
            'short_description',
            'company_name',
            'company_registration',
            'description',
            'phone',
            'email',
            'city',
            'state',
            'post_code',
            'country',
        ];

        $userCompleted = collect($userFields)->filter(fn($field) => !empty($user->$field))->count();
        $shopCompleted = collect($shopFields)->filter(fn($field) => !empty($shop->$field))->count();
        $totalFields = count($userFields) + count($shopFields);
        $completedFields = $userCompleted + $shopCompleted;
        $profileCompletion = round(($completedFields / $totalFields) * 100);
    @endphp

    <div class="space-y-6">
        <!-- Profile Header -->
        <x-filament::section>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    @if ($shop && $shop->logo)
                        <img src="{{ Storage::url($shop->logo) }}" alt="Profile" class="w-16 h-16 rounded-full object-cover">
                    @else
                        <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                
                <div class="flex-1">
                    <h1 class="text-xl font-semibold text-gray-900">{{ $user->name }} {{ $user->l_name }}</h1>
                    <p class="text-gray-600">{{ $user->email }}</p>
                    <div class="flex items-center space-x-2 mt-1">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                            Vendor Profile
                        </span>
                        @if ($shop)
                            @if ($shop->status == 1)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Shop Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Shop Inactive
                                </span>
                            @endif
                        @endif
                    </div>
                </div>
                
                <div class="text-right">
                    <p class="text-sm text-gray-500">Profile Completion</p>
                    <div class="flex items-center space-x-2 mt-1">
                        <div class="w-12 h-12 relative">
                            <svg class="w-12 h-12 transform -rotate-90" viewBox="0 0 48 48">
                                <circle cx="24" cy="24" r="20" stroke="#e5e7eb" stroke-width="4" fill="transparent" />
                                <circle cx="24" cy="24" r="20" stroke="#3b82f6" stroke-width="4" fill="transparent"
                                    stroke-dasharray="{{ 2 * pi() * 20 }}"
                                    stroke-dashoffset="{{ 2 * pi() * 20 * (1 - $profileCompletion / 100) }}" />
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-xs font-semibold text-gray-900">{{ $profileCompletion }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-filament::section>

        <!-- Banner Upload -->
        <x-filament::section>
            <form method="post" action="{{ route('vendor.logo.cover') }}" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Shop Banner</label>
                        <div class="relative">
                            @if ($shop && $shop->banner)
                                <img src="{{ Storage::url($shop->banner) }}" alt="Shop Banner" class="w-full h-32 object-cover rounded-lg">
                            @else
                                <div class="w-full h-32 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <input type="file" name="banner" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Shop Logo</label>
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                @if ($shop && $shop->logo)
                                    <img src="{{ Storage::url($shop->logo) }}" alt="Logo" class="w-16 h-16 rounded-full object-cover">
                                @else
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <input type="file" name="logo" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                            </div>
                            <div class="text-sm text-gray-500">
                                Click on the logo to upload a new one
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </x-filament::section>

        <!-- Tabs -->
        <div x-data="{ tab: 'shop' }" class="space-y-6">
            <!-- Tab Navigation -->
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8">
                    <button @click="tab = 'shop'" 
                        :class="tab === 'shop' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="py-2 px-1 border-b-2 font-medium text-sm transition-colors">
                        Shop Information
                    </button>
                    <button @click="tab = 'personal'" 
                        :class="tab === 'personal' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="py-2 px-1 border-b-2 font-medium text-sm transition-colors">
                        Personal Information
                    </button>
                    <button @click="tab = 'security'" 
                        :class="tab === 'security' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="py-2 px-1 border-b-2 font-medium text-sm transition-colors">
                        Security
                    </button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div>
                <!-- Shop Information Tab -->
                <div x-show="tab === 'shop'" x-cloak>
                    <x-filament::section>
                        <form wire:submit="submit">
                            <div class="space-y-4">
                                {{ $this->form }}
                            </div>
                            
                            <div class="flex justify-end pt-6">
                                <x-filament::button type="submit" color="primary">
                                    Save Shop Information
                                </x-filament::button>
                            </div>
                        </form>
                    </x-filament::section>
                </div>

                <!-- Personal Information Tab -->
                <div x-show="tab === 'personal'" x-cloak>
                    <x-filament::section>
                        <form action="{{ route('vendor.personal_info') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                    <input type="text" name="first_name" value="{{ $user->name }}" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                    <input type="text" name="last_name" value="{{ $user->l_name }}" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" name="email" value="{{ $user->email }}" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
                                    <input type="file" name="avatar" accept="image/*"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                            </div>
                            
                            <div class="flex justify-end pt-6">
                                <x-filament::button type="submit" color="primary">
                                    Save Personal Information
                                </x-filament::button>
                            </div>
                        </form>
                    </x-filament::section>
                </div>

                <!-- Security Tab -->
                <div x-show="tab === 'security'" x-cloak>
                    <x-filament::section>
                        <form action="{{ route('vendor.update_password') }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                    <input type="password" name="current_password" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                    <input type="password" name="new_password" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                    <input type="password" name="new_password_confirmation" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                
                                <div class="flex justify-end pt-2">
                                    <x-filament::button type="submit" color="primary">
                                        Update Password
                                    </x-filament::button>
                                </div>
                            </div>
                        </form>
                    </x-filament::section>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const bannerInput = document.querySelector('input[name="banner"]');
                const logoInput = document.querySelector('input[name="logo"]');

                bannerInput.addEventListener('change', function() {
                    this.closest('form').submit();
                });

                logoInput.addEventListener('change', function() {
                    this.closest('form').submit();
                });
            });
        </script>
    @endpush
</x-filament-panels::page>
