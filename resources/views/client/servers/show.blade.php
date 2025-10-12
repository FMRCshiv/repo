@extends('layouts.app')

@section('title', $server->name . ' - Pterodactyl Panel')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Server Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('client.servers') }}" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $server->name }}</h1>
                    <div class="flex items-center space-x-4 mt-2">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 rounded-full {{ $server->status === 'running' ? 'bg-green-500' : 'bg-red-500' }}"></div>
                            <span class="text-sm font-medium {{ $server->status === 'running' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                {{ ucfirst($server->status) }}
                            </span>
                        </div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $server->node->name }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Server Actions -->
            <div class="flex items-center space-x-3">
                <button class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Start
                </button>
                <button class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10h6v4H9z"></path>
                    </svg>
                    Stop
                </button>
                <button class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Restart
                </button>
            </div>
        </div>
    </div>
    
    <!-- Server Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">CPU Usage</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">45%</p>
                </div>
                <div class="p-3 rounded-lg bg-blue-100 dark:bg-blue-900/30">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full" style="width: 45%"></div>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Memory Usage</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">2.1GB</p>
                </div>
                <div class="p-3 rounded-lg bg-green-100 dark:bg-green-900/30">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                    <div class="bg-green-600 h-2 rounded-full" style="width: 70%"></div>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Disk Usage</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">8.5GB</p>
                </div>
                <div class="p-3 rounded-lg bg-yellow-100 dark:bg-yellow-900/30">
                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                    <div class="bg-yellow-600 h-2 rounded-full" style="width: 35%"></div>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Network I/O</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">1.2MB/s</p>
                </div>
                <div class="p-3 rounded-lg bg-purple-100 dark:bg-purple-900/30">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                    <div class="bg-purple-600 h-2 rounded-full" style="width: 60%"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Content Tabs -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <!-- Tab Navigation -->
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="flex space-x-8 px-6" aria-label="Tabs">
                <button class="tab-button active" data-tab="console">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Console
                </button>
                <button class="tab-button" data-tab="files">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                    </svg>
                    Files
                </button>
                <button class="tab-button" data-tab="databases">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                    </svg>
                    Databases
                </button>
                <button class="tab-button" data-tab="schedules">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Schedules
                </button>
                <button class="tab-button" data-tab="users">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    Users
                </button>
                <button class="tab-button" data-tab="backups">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                    </svg>
                    Backups
                </button>
                <button class="tab-button" data-tab="network">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path>
                    </svg>
                    Network
                </button>
                <button class="tab-button" data-tab="startup">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Startup
                </button>
            </nav>
        </div>
        
        <!-- Tab Content -->
        <div class="p-6">
            <!-- Console Tab -->
            <div id="console-tab" class="tab-content">
                <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-green-400 h-96 overflow-y-auto">
                    <div class="mb-2">[2024-01-15 10:30:45] Server starting...</div>
                    <div class="mb-2">[2024-01-15 10:30:46] Loading plugins...</div>
                    <div class="mb-2">[2024-01-15 10:30:47] Plugin "WorldEdit" loaded successfully</div>
                    <div class="mb-2">[2024-01-15 10:30:48] Plugin "Essentials" loaded successfully</div>
                    <div class="mb-2">[2024-01-15 10:30:49] Server started on port 25565</div>
                    <div class="mb-2">[2024-01-15 10:30:50] Player "Steve" joined the game</div>
                    <div class="mb-2">[2024-01-15 10:31:15] Player "Alex" joined the game</div>
                    <div class="mb-2">[2024-01-15 10:32:00] Player "Steve" left the game</div>
                    <div class="mb-2">[2024-01-15 10:35:22] Player "Alex" left the game</div>
                    <div class="mb-2">[2024-01-15 10:40:00] Auto-save completed</div>
                    <div class="mb-2">[2024-01-15 10:45:00] TPS: 20.0</div>
                </div>
                
                <div class="mt-4 flex space-x-2">
                    <input type="text" placeholder="Enter command..." class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        Send
                    </button>
                </div>
            </div>
            
            <!-- Other tabs would be implemented similarly -->
            <div id="files-tab" class="tab-content hidden">
                <p class="text-gray-600 dark:text-gray-400">File manager content would go here...</p>
            </div>
            
            <div id="databases-tab" class="tab-content hidden">
                <p class="text-gray-600 dark:text-gray-400">Database management content would go here...</p>
            </div>
            
            <div id="schedules-tab" class="tab-content hidden">
                <p class="text-gray-600 dark:text-gray-400">Scheduled tasks content would go here...</p>
            </div>
            
            <div id="users-tab" class="tab-content hidden">
                <p class="text-gray-600 dark:text-gray-400">User management content would go here...</p>
            </div>
            
            <div id="backups-tab" class="tab-content hidden">
                <p class="text-gray-600 dark:text-gray-400">Backup management content would go here...</p>
            </div>
            
            <div id="network-tab" class="tab-content hidden">
                <p class="text-gray-600 dark:text-gray-400">Network settings content would go here...</p>
            </div>
            
            <div id="startup-tab" class="tab-content hidden">
                <p class="text-gray-600 dark:text-gray-400">Startup configuration content would go here...</p>
            </div>
        </div>
    </div>
</div>
@endsection
