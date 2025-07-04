<x-filament-panels::page>
    @push('styles')
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'system-ui', 'sans-serif'],
                        },
                    }
                }
            }
        </script>
        <style>
            .profile-card {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .profile-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }

            .tab-button {
                transition: all 0.2s ease-in-out;
            }

            .tab-button.active {
                background: darkcyan;
                color: white;
            }

            .form-section {
                animation: fadeIn 0.5s ease-in-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .avatar-upload {
                position: relative;
                display: inline-block;
            }

            .avatar-upload:hover .avatar-overlay {
                opacity: 1;
            }

            .avatar-banner-upload {
                position: relative;
            }

            .avatar-banner-upload:hover .avatar-banner-overlay {
                opacity: 1;
            }

            .avatar-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .avatar-banner-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .progress-ring {
                transform: rotate(-90deg);
            }

            .progress-ring-circle {
                transition: stroke-dasharray 0.35s;
                transform-origin: 50% 50%;
            }

            .gradient-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }

            .glass-effect {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .status-indicator {
                animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }

            @keyframes pulse {

                0%,
                100% {
                    opacity: 1;
                }

                50% {
                    opacity: 0.5;
                }
            }
        </style>
    @endpush

    @php
        $user = Auth::user();
        $shop = $user->shop;

        // Calculate profile completion percentage
        $userFields = ['name', 'l_name', 'email', 'avatar'];
        $shopFields = [
            'name',
            'lolo',
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

        // Calculate shop performance metrics
        // $totalProducts = $shop->products->count();
        // $totalOrders = $shop->orders->count();
        // $totalRevenue = $shop->orders->sum('total') / 100;
        // $avgOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

    @endphp

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Enhanced Header Section -->
            <form method="post" action="{{ route('vendor.logo.cover') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-8">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <div class="">
                            <div class="card">
                                <div class="card-header avatar-banner-upload">
                                    @if ($shop->banner)
                                        <img src="{{ Storage::url($shop->banner) }}" alt="Shop Banner"
                                            class="w-full object-cover rounded-t-lg" style="height: 250px; ">
                                    @endif
                                    <div class="avatar-banner-overlay">
                                        <div
                                            class="absolute inset-0 bg-black/40 flex items-center justify-center hover:bg-black/60 transition cursor-pointer">
                                            <label for="banner-upload" class="flex flex-col items-center text-white">
                                                <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                <span class="text-xs">Change Banner</span>
                                            </label>
                                            <input id="banner-upload" type="file" name="banner" class="hidden" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-6">
                            <div class="flex items-center space-x-4">
                                <div class="avatar-upload">
                                    @if ($shop->logo)
                                        <img src="{{ Storage::url($shop->logo) }}" alt="Profile"
                                            class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                                    @else
                                        <div
                                            class="w-16 h-16 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500 flex items-center justify-center text-white font-bold text-xl border-4 border-white shadow-lg">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}{{ strtoupper(substr($user->l_name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div class="avatar-overlay">
                                        <label for="logo-upload" class="flex flex-col items-center text-white">
                                            <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <span class="text-xs">Change logo</span>
                                        </label>
                                        <input id="logo-upload" type="file" name="logo" class="hidden" />
                                    </div>
                                </div>
                                <div class=" ms-6">
                                    <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }} {{ $user->l_name }}
                                    </h1>
                                    <p class="text-gray-600">{{ $user->email }}</p>
                                    <div class="flex items-center mt-1">
                                        <span
                                            class="inline-flex items-center py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                            <span
                                                class="w-2 h-2 bg-primary-400 rounded-full mr-1 status-indicator"></span>
                                            Vendor Profile
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">Profile Completion</p>
                                    <div class="flex items-center space-x-2 justify-center mt-3">
                                        <div class="w-16 h-16 relative">
                                            <svg class="w-16 h-16 progress-ring" viewBox="0 0 64 64">
                                                <circle cx="32" cy="32" r="28" stroke="#e5e7eb"
                                                    stroke-width="4" fill="transparent" />
                                                <circle cx="32" cy="32" r="28" stroke="#3b82f6"
                                                    stroke-width="4" fill="transparent"
                                                    stroke-dasharray="{{ 2 * pi() * 28 }}"
                                                    stroke-dashoffset="{{ 2 * pi() * 28 * (1 - $profileCompletion / 100) }}"
                                                    class="progress-ring-circle" />
                                            </svg>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <span
                                                    class="text-sm font-bold text-gray-900">{{ $profileCompletion }}%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


            <div x-data="{ tab: 'personal' }"
                class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mt-6">
                <!-- Enhanced Tab Navigation -->
                <div class="border-b border-gray-200 bg-gray-50">
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
                        <button @click="tab = 'personal'"
                            :class="tab === 'personal' ? 'border-primary-600 text-primary-600' :
                                'border-transparent text-gray-500 hover:text-primary-600 hover:border-primary-600'"
                            class="py-4 px-1 border-b-2 font-medium text-sm transition">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Shop Information
                            </div>
                        </button>
                        <button @click="tab = 'shop'"
                            :class="tab === 'shop' ? 'border-primary-600 text-primary-600' :
                                'border-transparent text-gray-500 hover:text-primary-600 hover:border-primary-600'"
                            class="py-4 px-1 border-b-2 font-medium text-sm transition">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Personal Information
                            </div>
                        </button>
                        <button @click="tab = 'security'"
                            :class="tab === 'security' ? 'border-primary-600 text-primary-600' :
                                'border-transparent text-gray-500 hover:text-primary-600 hover:border-primary-600'"
                            class="py-4 px-1 border-b-2 font-medium text-sm transition">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Security & Privacy
                            </div>
                        </button>
                    </nav>
                </div>

                <!-- Enhanced Tab Content -->
                <div class="p-6">
                    <div x-show="tab === 'personal'">
                        <form wire:submit="submit">
                            <div class="bg-gray-50 rounded-lg p-6">{{ $this->form }}</div>

                            <div class="flex justify-end mt-6">
                                <button type="submit"
                                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-primary-500 from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                    <div x-show="tab === 'shop'" x-cloak>
                        <div class="bg-gray-50 rounded-lg p-6">
                            <form action="{{ route('vendor.personal_info') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block mb-1">First Name</label>
                                        <input type="text" name="first_name" placeholder="First Name"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500"
                                            value="{{ $user->name }}">
                                    </div>
                                    <div>
                                        <label class="block mb-1">Last Name</label>
                                        <input type="text" name="last_name" placeholder="Last Name"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500"
                                            value="{{ $user->l_name }}">
                                    </div>
                                    <div>
                                        <label class="block mb-1">Email</label>
                                        <input type="email" name="email" placeholder="Email"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500"
                                            value="{{ $user->email }}">
                                    </div>
                                    <div>
                                        <label class="block mb-1">Phone</label>
                                        <input type="file" name="avatar"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                                    </div>
                                    <div class="col-span-1 md:col-span-2">
                                        <label class="block mb-1">Avatar</label>
                                        <img src="{{ Storage::url($user->avatar) }}" alt="User Avatar"
                                            class="w-20 h-20 object-cover mt-2 border border-gray-300 shadow" />
                                    </div>
                                </div>
                                <div class="flex justify-end mt-6">
                                    <button type="submit"
                                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-primary-500 hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition shadow">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div x-show="tab === 'security'" x-cloak>
                        <div class="space-y-6">
                            <!-- Password Change Section -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Change Password</h3>
                                <form action="{{ route('vendor.update_password') }}" method="POST">
                                    @csrf
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Current
                                                Password</label>
                                            <input type="password" name="current_password"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500"
                                                placeholder="Enter current password" required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">New
                                                Password</label>
                                            <input type="password" name="new_password"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500"
                                                placeholder="Enter new password" required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New
                                                Password</label>
                                            <input type="password" name="new_password_confirmation"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500"
                                                placeholder="Confirm new password" required>
                                        </div>
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors">
                                            Update Password
                                        </button>
                                    </div>
                                </form>

                            </div>

                            <!-- Two-Factor Authentication -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Two-Factor Authentication</h3>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-600">Add an extra layer of security to your account
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">Currently disabled</p>
                                    </div>
                                    <button
                                        class="inline-flex items-center px-4 py-2 bg-secondary-600 text-dark rounded-md hover:bg-secondary-700 transition-colors">
                                        Enable 2FA
                                    </button>
                                </div>
                            </div>

                            <!-- Privacy Settings -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Privacy Settings</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Email Notifications</p>
                                            <p class="text-xs text-gray-500">Receive email updates about your account
                                            </p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" checked>
                                            <div
                                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600">
                                            </div>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">SMS Notifications</p>
                                            <p class="text-xs text-gray-500">Receive SMS updates about your account</p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer">
                                            <div
                                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600">
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const bannerInput = document.getElementById('banner-upload');
                const logoInput = document.getElementById('logo-upload');

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
