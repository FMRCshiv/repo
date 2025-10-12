@extends('layouts.app')

@section('title', 'Dashboard - Pterodactyl Panel')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
            Welcome back, {{ auth()->user()->username }}!
        </h1>
        <p class="text-gray-600 dark:text-gray-400">
            Manage your game servers and monitor their performance from your dashboard.
        </p>
    </div>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-blue-100 dark:bg-blue-900/30">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Servers</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ auth()->user()->servers->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-green-100 dark:bg-green-900/30">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Online Servers</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ auth()->user()->servers->where('status', 'running')->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-yellow-100 dark:bg-yellow-900/30">
                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Uptime</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">99.9%</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-purple-100 dark:bg-purple-900/30">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">CPU Usage</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">45%</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Server List -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Your Servers</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">Quick access to your game servers</p>
            </div>
            <div class="p-6">
                @if(auth()->user()->servers->count() > 0)
                    <div class="space-y-4">
                        @foreach(auth()->user()->servers->take(5) as $server)
                            <div class="flex items-center justify-between p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 rounded-full {{ $server->status === 'running' ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                    <div>
                                        <h3 class="font-medium text-gray-900 dark:text-white">{{ $server->name }}</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $server->node->name }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('client.servers.show', $server->uuidShort) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium">
                                    Manage
                                </a>
                            </div>
                        @endforeach
                    </div>
                    @if(auth()->user()->servers->count() > 5)
                        <div class="mt-4 text-center">
                            <a href="{{ route('client.servers') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium">
                                View All Servers
                            </a>
                        </div>
                    @endif
                @else
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No servers yet</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">Get started by creating your first game server.</p>
                        <a href="{{ route('client.servers') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                            Create Server
                        </a>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Recent Activity -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Activity</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">Latest actions and events</p>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 dark:text-white">Server "Minecraft Survival" started successfully</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">2 minutes ago</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 dark:text-white">Backup completed for "CS:GO Server"</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">1 hour ago</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full mt-2"></div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 dark:text-white">High CPU usage detected on "Rust Server"</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">3 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-purple-500 rounded-full mt-2"></div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 dark:text-white">Plugin updated on "Minecraft Creative"</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">1 day ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
