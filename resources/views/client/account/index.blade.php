@extends('layouts.app')

@section('title', 'Account Settings - Pterodactyl Panel')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Account Settings</h1>
        <p class="text-gray-600 dark:text-gray-400">Manage your account information and preferences</p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <nav class="space-y-1">
                <a href="#profile" class="account-nav-link active" data-tab="profile">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profile Information
                </a>
                <a href="#security" class="account-nav-link" data-tab="security">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    Security
                </a>
                <a href="#notifications" class="account-nav-link" data-tab="notifications">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.828 7l2.586 2.586a2 2 0 002.828 0L12.828 7H4.828zM4.828 17h8a2 2 0 002-2V9a2 2 0 00-2-2H4.828"></path>
                    </svg>
                    Notifications
                </a>
                <a href="#billing" class="account-nav-link" data-tab="billing">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                    Billing
                </a>
                <a href="#api" class="account-nav-link" data-tab="api">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                    API Keys
                </a>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Profile Tab -->
            <div id="profile-tab" class="account-tab-content">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Profile Information</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Update your account profile information</p>
                    </div>
                    
                    <form class="p-6 space-y-6">
                        <!-- Avatar -->
                        <div class="flex items-center space-x-6">
                            <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                <span class="text-2xl font-bold text-white">{{ substr(auth()->user()->username, 0, 1) }}</span>
                            </div>
                            <div>
                                <button type="button" class="btn btn-secondary">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Change Avatar
                                </button>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">JPG, PNG or GIF. Max size 2MB.</p>
                            </div>
                        </div>
                        
                        <!-- Username -->
                        <div>
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username" value="{{ auth()->user()->username }}" 
                                   class="form-input" readonly>
                            <p class="form-help">Username cannot be changed after account creation.</p>
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" 
                                   class="form-input">
                        </div>
                        
                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" id="first_name" name="first_name" 
                                   class="form-input" placeholder="Enter your first name">
                        </div>
                        
                        <!-- Last Name -->
                        <div>
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" id="last_name" name="last_name" 
                                   class="form-input" placeholder="Enter your last name">
                        </div>
                        
                        <!-- Language -->
                        <div>
                            <label for="language" class="form-label">Language</label>
                            <select id="language" name="language" class="form-input">
                                <option value="en">English</option>
                                <option value="es">Spanish</option>
                                <option value="fr">French</option>
                                <option value="de">German</option>
                                <option value="it">Italian</option>
                                <option value="pt">Portuguese</option>
                                <option value="ru">Russian</option>
                                <option value="zh">Chinese</option>
                                <option value="ja">Japanese</option>
                            </select>
                        </div>
                        
                        <!-- Timezone -->
                        <div>
                            <label for="timezone" class="form-label">Timezone</label>
                            <select id="timezone" name="timezone" class="form-input">
                                <option value="UTC">UTC</option>
                                <option value="America/New_York">Eastern Time</option>
                                <option value="America/Chicago">Central Time</option>
                                <option value="America/Denver">Mountain Time</option>
                                <option value="America/Los_Angeles">Pacific Time</option>
                                <option value="Europe/London">London</option>
                                <option value="Europe/Paris">Paris</option>
                                <option value="Asia/Tokyo">Tokyo</option>
                            </select>
                        </div>
                        
                        <!-- Save Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-primary">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Security Tab -->
            <div id="security-tab" class="account-tab-content hidden">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Security Settings</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Manage your account security and authentication</p>
                    </div>
                    
                    <div class="p-6 space-y-6">
                        <!-- Change Password -->
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <h3 class="text-md font-medium text-gray-900 dark:text-white mb-4">Change Password</h3>
                            <form class="space-y-4">
                                <div>
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" id="current_password" name="current_password" 
                                           class="form-input" placeholder="Enter current password">
                                </div>
                                <div>
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" id="new_password" name="new_password" 
                                           class="form-input" placeholder="Enter new password">
                                </div>
                                <div>
                                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                                    <input type="password" id="confirm_password" name="confirm_password" 
                                           class="form-input" placeholder="Confirm new password">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </form>
                        </div>
                        
                        <!-- Two-Factor Authentication -->
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-md font-medium text-gray-900 dark:text-white">Two-Factor Authentication</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Add an extra layer of security to your account</p>
                                </div>
                                <button class="btn btn-secondary">Enable 2FA</button>
                            </div>
                        </div>
                        
                        <!-- Active Sessions -->
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <h3 class="text-md font-medium text-gray-900 dark:text-white mb-4">Active Sessions</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">Current Session</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">Chrome on Windows • 192.168.1.100</p>
                                        </div>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Now</span>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">Mobile App</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">iOS Safari • 192.168.1.101</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">2 hours ago</span>
                                        <button class="text-red-600 hover:text-red-700 text-xs">Revoke</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Other tabs would be implemented similarly -->
            <div id="notifications-tab" class="account-tab-content hidden">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Notification Preferences</h2>
                    <p class="text-gray-600 dark:text-gray-400">Configure how you receive notifications about your servers and account.</p>
                </div>
            </div>
            
            <div id="billing-tab" class="account-tab-content hidden">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Billing Information</h2>
                    <p class="text-gray-600 dark:text-gray-400">Manage your subscription and payment methods.</p>
                </div>
            </div>
            
            <div id="api-tab" class="account-tab-content hidden">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">API Keys</h2>
                    <p class="text-gray-600 dark:text-gray-400">Manage your API keys for programmatic access.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.account-nav-link {
    @apply flex items-center px-3 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors;
}

.account-nav-link.active {
    @apply text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20;
}

.account-tab-content {
    @apply min-h-96;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.account-nav-link');
    const tabContents = document.querySelectorAll('.account-tab-content');
    
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const tabId = link.getAttribute('data-tab');
            
            // Remove active class from all nav links
            navLinks.forEach(nav => nav.classList.remove('active'));
            
            // Add active class to clicked link
            link.classList.add('active');
            
            // Hide all tab contents
            tabContents.forEach(content => content.classList.add('hidden'));
            
            // Show target tab content
            const targetTab = document.getElementById(`${tabId}-tab`);
            if (targetTab) {
                targetTab.classList.remove('hidden');
            }
        });
    });
});
</script>
@endsection
