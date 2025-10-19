<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Theme Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for the Blizzard theme.
    | You can customize various aspects of the theme here.
    |
    */

    'name' => 'blizzard',
    'version' => '1.0.0',
    'author' => 'Blizzard Theme Developer',
    'description' => 'A modern, professional theme for Pterodactyl Panel with dark mode support and responsive design',

    /*
    |--------------------------------------------------------------------------
    | Theme Colors
    |--------------------------------------------------------------------------
    |
    | Define the primary color scheme for the theme.
    |
    */

    'colors' => [
        'primary' => '#3b82f6',
        'secondary' => '#6b7280',
        'success' => '#10b981',
        'warning' => '#f59e0b',
        'error' => '#ef4444',
        'info' => '#06b6d4',
    ],

    /*
    |--------------------------------------------------------------------------
    | Layout Settings
    |--------------------------------------------------------------------------
    |
    | Configure the layout and appearance settings.
    |
    */

    'layout' => [
        'sidebar_width' => '280px',
        'header_height' => '64px',
        'footer_height' => '60px',
        'border_radius' => '0.75rem',
        'shadow' => 'sm',
    ],

    /*
    |--------------------------------------------------------------------------
    | Features
    |--------------------------------------------------------------------------
    |
    | Enable or disable theme features.
    |
    */

    'features' => [
        'dark_mode' => true,
        'animations' => true,
        'glass_effects' => true,
        'custom_scrollbars' => true,
        'responsive_design' => true,
        'accessibility' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom CSS
    |--------------------------------------------------------------------------
    |
    | Add custom CSS that will be included in the theme.
    |
    */

    'custom_css' => [
        // Add any custom CSS files here
        // 'css/custom.css',
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom JavaScript
    |--------------------------------------------------------------------------
    |
    | Add custom JavaScript files that will be included in the theme.
    |
    */

    'custom_js' => [
        // Add any custom JavaScript files here
        // 'js/custom.js',
    ],

    /*
    |--------------------------------------------------------------------------
    | Fonts
    |--------------------------------------------------------------------------
    |
    | Configure the fonts used in the theme.
    |
    */

    'fonts' => [
        'primary' => 'Inter',
        'monospace' => 'Fira Code',
        'fallback' => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif',
    ],

    /*
    |--------------------------------------------------------------------------
    | Icons
    |--------------------------------------------------------------------------
    |
    | Configure the icon library used in the theme.
    |
    */

    'icons' => [
        'library' => 'heroicons',
        'style' => 'outline',
    ],

    /*
    |--------------------------------------------------------------------------
    | Navigation
    |--------------------------------------------------------------------------
    |
    | Configure the navigation menu items.
    |
    */

    'navigation' => [
        'items' => [
            [
                'name' => 'Dashboard',
                'route' => 'index',
                'icon' => 'home',
                'permission' => null,
            ],
            [
                'name' => 'Servers',
                'route' => 'client.servers',
                'icon' => 'server',
                'permission' => null,
            ],
            [
                'name' => 'Account',
                'route' => 'client.account',
                'icon' => 'user',
                'permission' => null,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Footer
    |--------------------------------------------------------------------------
    |
    | Configure the footer content and links.
    |
    */

    'footer' => [
        'show_copyright' => true,
        'copyright_text' => '© :year Pterodactyl Panel. Powered by Blizzard Theme.',
        'links' => [
            [
                'name' => 'Privacy Policy',
                'url' => '#',
            ],
            [
                'name' => 'Terms of Service',
                'url' => '#',
            ],
            [
                'name' => 'Support',
                'url' => '#',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    |
    | Configure notification settings.
    |
    */

    'notifications' => [
        'position' => 'top-right',
        'duration' => 5000,
        'max_visible' => 5,
    ],

    /*
    |--------------------------------------------------------------------------
    | Console
    |--------------------------------------------------------------------------
    |
    | Configure the server console appearance.
    |
    */

    'console' => [
        'font_family' => 'Fira Code, Monaco, Consolas, monospace',
        'font_size' => '14px',
        'line_height' => '1.4',
        'background_color' => '#111827',
        'text_color' => '#10b981',
        'max_lines' => 1000,
    ],

    /*
    |--------------------------------------------------------------------------
    | Performance
    |--------------------------------------------------------------------------
    |
    | Configure performance-related settings.
    |
    */

    'performance' => [
        'lazy_loading' => true,
        'minify_css' => true,
        'minify_js' => true,
        'cache_assets' => true,
    ],
];
