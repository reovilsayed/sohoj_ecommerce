<x-filament-panels::page>
    @push('styles')
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'system-ui', 'sans-serif'],
                        },
                        colors: {
                            primary: {
                                50: '#eff6ff',
                                100: '#dbeafe',
                                200: '#bfdbfe',
                                300: '#93c5fd',
                                400: '#60a5fa',
                                500: '#3b82f6',
                                600: '#2563eb',
                                700: '#1d4ed8',
                                800: '#1e40af',
                                900: '#1e3a8a',
                            },
                            secondary: {
                                50: '#faf5ff',
                                100: '#f3e8ff',
                                200: '#e9d5ff',
                                300: '#d8b4fe',
                                400: '#c084fc',
                                500: '#a855f7',
                                600: '#9333ea',
                                700: '#7c3aed',
                                800: '#6b21a8',
                                900: '#581c87',
                            },
                            success: {
                                50: '#f0fdf4',
                                100: '#dcfce7',
                                200: '#bbf7d0',
                                300: '#86efac',
                                400: '#4ade80',
                                500: '#22c55e',
                                600: '#16a34a',
                                700: '#15803d',
                                800: '#166534',
                                900: '#14532d',
                            },
                            warning: {
                                50: '#fffbeb',
                                100: '#fef3c7',
                                200: '#fde68a',
                                300: '#fcd34d',
                                400: '#fbbf24',
                                500: '#f59e0b',
                                600: '#d97706',
                                700: '#b45309',
                                800: '#92400e',
                                900: '#78350f',
                            },
                            danger: {
                                50: '#fef2f2',
                                100: '#fee2e2',
                                200: '#fecaca',
                                300: '#fca5a5',
                                400: '#f87171',
                                500: '#ef4444',
                                600: '#dc2626',
                                700: '#b91c1c',
                                800: '#991b1b',
                                900: '#7f1d1d',
                            }
                        }
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
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
            }

            .form-section {
                animation: fadeIn 0.5s ease-in-out;
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .avatar-upload {
                position: relative;
                display: inline-block;
            }

            .avatar-upload:hover .avatar-overlay {
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
                0%, 100% { opacity: 1; }
                50% { opacity: 0.5; }
            }
        </style>
    @endpush

    @php
        $user = Auth::user();
        $shop = $user->shop;
        
        // Calculate profile completion percentage
        $userFields = ['name', 'l_name', 'email', 'phone', 'birth_date', 'tax_no', 'nid', 'address'];
        $shopFields = ['name', 'description', 'phone', 'email', 'city', 'state', 'country'];
        $userCompleted = collect($userFields)->filter(fn($field) => !empty($user->$field))->count();
        $shopCompleted = collect($shopFields)->filter(fn($field) => !empty($shop->$field))->count();
        $totalFields = count($userFields) + count($shopFields);
        $completedFields = $userCompleted + $shopCompleted;
        $profileCompletion = round(($completedFields / $totalFields) * 100);
        
        // Calculate shop performance metrics
        $totalProducts = $shop->products->count();
        $totalOrders = $shop->orders->count();
        $totalRevenue = $shop->orders->sum('total') / 100;
        $avgOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;
    @endphp

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Enhanced Header Section -->
            <div class="mb-8">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="avatar-upload">
                                @if ($user->avatar)
                                    <img src="{{ Storage::url($user->avatar) }}" alt="Profile" 
                                         class="w-16 h-16 rounded-full object-cover border-4 border-white shadow-lg">
                                @else
                                    <div class="w-16 h-16 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500 flex items-center justify-center text-white font-bold text-xl border-4 border-white shadow-lg">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}{{ strtoupper(substr($user->l_name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="avatar-overlay">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }} {{ $user->l_name }}</h1>
                                <p class="text-gray-600">{{ $user->email }}</p>
                                <div class="flex items-center mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                        <span class="w-2 h-2 bg-primary-400 rounded-full mr-1 status-indicator"></span>
                                        Vendor Account
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="text-right">
                                <p class="text-sm text-gray-500">Profile Completion</p>
                                <div class="flex items-center space-x-2">
                                    <div class="w-16 h-16 relative">
                                        <svg class="w-16 h-16 progress-ring" viewBox="0 0 64 64">
                                            <circle cx="32" cy="32" r="28" stroke="#e5e7eb" stroke-width="4" fill="transparent"/>
                                            <circle cx="32" cy="32" r="28" stroke="#3b82f6" stroke-width="4" fill="transparent" 
                                                    stroke-dasharray="{{ 2 * pi() * 28 }}" 
                                                    stroke-dashoffset="{{ 2 * pi() * 28 * (1 - $profileCompletion / 100) }}"
                                                    class="progress-ring-circle"/>
                                        </svg>
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <span class="text-sm font-bold text-gray-900">{{ $profileCompletion }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Stats Dashboard -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Business Performance -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 profile-card">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-r from-success-500 to-success-600 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">Total Revenue</p>
                            <p class="text-lg font-bold text-gray-900">${{ number_format($totalRevenue, 2) }}</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Orders:</span>
                            <span class="font-medium text-gray-900">{{ number_format($totalOrders) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Avg. Order:</span>
                            <span class="font-medium text-gray-900">${{ number_format($avgOrderValue, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Shop Status -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 profile-card">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-r from-secondary-500 to-secondary-600 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">Shop Status</p>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $shop->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $shop->status ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Products:</span>
                            <span class="font-medium text-gray-900">{{ number_format($totalProducts) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Shop Name:</span>
                            <span class="font-medium text-gray-900 truncate">{{ $shop->name ?: 'Not set' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Account Activity -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 profile-card">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-r from-warning-500 to-warning-600 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">Member Since</p>
                            <p class="text-sm font-bold text-gray-900">{{ $user->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Last Login:</span>
                            <span class="font-medium text-gray-900">{{ $user->updated_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Phone:</span>
                            <span class="font-medium text-gray-900">{{ $user->phone ?: 'Not set' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 profile-card">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">Quick Actions</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <button class="w-full text-left text-sm text-primary-600 hover:text-primary-800 font-medium">
                            + Add New Product
                        </button>
                        <button class="w-full text-left text-sm text-primary-600 hover:text-primary-800 font-medium">
                            View Analytics
                        </button>
                        <button class="w-full text-left text-sm text-primary-600 hover:text-primary-800 font-medium">
                            Manage Orders
                        </button>
                    </div>
                </div>
            </div>

            <!-- Enhanced Main Content -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Enhanced Tab Navigation -->
                <div class="border-b border-gray-200 bg-gray-50">
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
                        <button onclick="switchTab('personal')" 
                                class="tab-button active py-4 px-1 border-b-2 border-transparent font-medium text-sm rounded-t-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Personal Information
                            </div>
                        </button>
                        <button onclick="switchTab('shop')" 
                                class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm rounded-t-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Shop Settings
                            </div>
                        </button>
                        <button onclick="switchTab('security')" 
                                class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm rounded-t-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                Security & Privacy
                            </div>
                        </button>
                    </nav>
                </div>

                <!-- Enhanced Tab Content -->
                <div class="p-6">
                    <!-- Personal Information Tab -->
                    <div id="personal-tab" class="form-section">
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-2">Personal Information</h2>
                            <p class="text-gray-600">Update your personal details and contact information</p>
                        </div>
                        <form wire:submit="submit">
                            {{ $this->form }}
                            
                            <div class="flex justify-end mt-6">
                                <button type="submit" 
                                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Shop Settings Tab -->
                    <div id="shop-tab" class="form-section hidden">
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-2">Shop Settings</h2>
                            <p class="text-gray-600">Manage your shop details and branding</p>
                        </div>
                        <div class="text-center py-8">
                            <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 text-lg mb-2">Shop settings are integrated into the main form</p>
                            <p class="text-sm text-gray-400">All shop configuration options are available in the Personal Information section above.</p>
                        </div>
                    </div>

                    <!-- Security & Privacy Tab -->
                    <div id="security-tab" class="form-section hidden">
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-2">Security & Privacy</h2>
                            <p class="text-gray-600">Manage your account security and privacy settings</p>
                        </div>
                        <div class="space-y-6">
                            <!-- Password Change Section -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Change Password</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                        <input type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500" placeholder="Enter current password">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                        <input type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500" placeholder="Enter new password">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                        <input type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500" placeholder="Confirm new password">
                                    </div>
                                    <button class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors">
                                        Update Password
                                    </button>
                                </div>
                            </div>

                            <!-- Two-Factor Authentication -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Two-Factor Authentication</h3>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-600">Add an extra layer of security to your account</p>
                                        <p class="text-xs text-gray-500 mt-1">Currently disabled</p>
                                    </div>
                                    <button class="inline-flex items-center px-4 py-2 bg-secondary-600 text-white rounded-md hover:bg-secondary-700 transition-colors">
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
                                            <p class="text-xs text-gray-500">Receive email updates about your account</p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" checked>
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">SMS Notifications</p>
                                            <p class="text-xs text-gray-500">Receive SMS updates about your account</p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer">
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
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
            function switchTab(tabName) {
                // Hide all tabs
                document.querySelectorAll('.form-section').forEach(tab => {
                    tab.classList.add('hidden');
                });
                
                // Remove active class from all buttons
                document.querySelectorAll('.tab-button').forEach(button => {
                    button.classList.remove('active');
                });
                
                // Show selected tab
                document.getElementById(tabName + '-tab').classList.remove('hidden');
                
                // Add active class to clicked button
                event.target.closest('.tab-button').classList.add('active');
            }
        </script>
    @endpush
</x-filament-panels::page> 