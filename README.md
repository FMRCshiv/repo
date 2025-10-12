# Blizzard Theme for Pterodactyl Panel

A modern, professional theme for Pterodactyl Panel with dark mode support, responsive design, and beautiful UI components.

![Blizzard Theme Preview](screenshots/dashboard.png)

## Features

- 🌙 **Dark Mode Support** - Automatic dark/light mode switching with system preference detection
- 📱 **Responsive Design** - Optimized for desktop, tablet, and mobile devices
- 🎨 **Modern UI** - Clean, professional interface with smooth animations
- ⚡ **Performance Optimized** - Fast loading with optimized assets
- 🔧 **Customizable** - Easy to customize colors, fonts, and layout
- ♿ **Accessible** - Built with accessibility best practices
- 🎯 **User-Friendly** - Intuitive navigation and user experience

## Installation

### 🚀 One-Line Installation (Recommended)

**Linux/macOS:**
```bash
curl -sSL https://raw.githubusercontent.com/your-username/blizzard-pterodactyl-theme/main/install.sh | bash
```

**Windows PowerShell:**
```powershell
iwr -useb https://raw.githubusercontent.com/your-username/blizzard-pterodactyl-theme/main/install.ps1 | iex
```

**Windows Command Prompt:**
```cmd
powershell -Command "iwr -useb https://raw.githubusercontent.com/your-username/blizzard-pterodactyl-theme/main/install.ps1 | iex"
```

### Prerequisites

- Pterodactyl Panel 1.x
- Node.js 16+ and npm/yarn
- PHP 8.0+
- Git (for automatic installation)

### Manual Installation

If you prefer manual installation or the one-line installer doesn't work:

1. **Clone or download the theme files**
   ```bash
   git clone https://github.com/your-username/blizzard-pterodactyl-theme.git
   cd blizzard-pterodactyl-theme
   ```

2. **Install dependencies**
   ```bash
   npm install
   # or
   yarn install
   ```

3. **Build the theme assets**
   ```bash
   npm run build
   # or
   yarn build
   ```

4. **Copy theme files to your Pterodactyl installation**
   ```bash
   # Copy the theme directory to your Pterodactyl public folder
   cp -r public/themes/blizzard /path/to/pterodactyl/public/themes/
   
   # Copy Blade templates to your Pterodactyl resources folder
   cp -r resources/views /path/to/pterodactyl/resources/
   
   # Copy configuration file
   cp config/theme.php /path/to/pterodactyl/config/
   ```

5. **Update your Pterodactyl configuration**
   
   Add the following to your `.env` file:
   ```env
   THEME_NAME=blizzard
   THEME_PATH=themes/blizzard
   ```

6. **Clear caches**
   ```bash
   php artisan cache:clear
   php artisan view:clear
   php artisan config:clear
   ```

## Development

### Setting up Development Environment

1. **Install development dependencies**
   ```bash
   npm install
   ```

2. **Start development server**
   ```bash
   npm run dev
   ```

3. **Watch for changes**
   ```bash
   npm run dev:css  # Watch CSS changes
   npm run dev:js   # Watch JavaScript changes
   ```

### Building for Production

```bash
npm run build
```

This will:
- Compile and minify CSS
- Bundle and minify JavaScript
- Optimize images
- Generate source maps

## Customization

### Colors

Edit the color scheme in `config/theme.php`:

```php
'colors' => [
    'primary' => '#3b82f6',    // Blue
    'secondary' => '#6b7280',  // Gray
    'success' => '#10b981',    // Green
    'warning' => '#f59e0b',    // Yellow
    'error' => '#ef4444',      // Red
    'info' => '#06b6d4',       // Cyan
],
```

### Fonts

Change the font family in `config/theme.php`:

```php
'fonts' => [
    'primary' => 'Inter',
    'monospace' => 'Fira Code',
    'fallback' => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif',
],
```

### Layout

Adjust layout settings in `config/theme.php`:

```php
'layout' => [
    'sidebar_width' => '280px',
    'header_height' => '64px',
    'footer_height' => '60px',
    'border_radius' => '0.75rem',
    'shadow' => 'sm',
],
```

### Custom CSS

Add your custom styles to `public/themes/blizzard/css/custom.css` and include it in the configuration:

```php
'custom_css' => [
    'css/custom.css',
],
```

## File Structure

```
blizzard-pterodactyl-theme/
├── config/
│   └── theme.php              # Theme configuration
├── public/
│   └── themes/
│       └── blizzard/
│           ├── css/
│           │   ├── theme.css      # Main theme styles
│           │   └── responsive.css # Responsive styles
│           ├── js/
│           │   └── theme.js       # Theme JavaScript
│           └── images/            # Theme images
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php      # Main layout
│       ├── auth/
│       │   └── login.blade.php    # Login page
│       ├── client/
│       │   ├── account/
│       │   │   └── index.blade.php # Account settings
│       │   └── servers/
│       │       ├── index.blade.php # Server list
│       │       └── show.blade.php  # Server details
│       └── index.blade.php         # Dashboard
├── screenshots/                # Theme screenshots
├── theme.json                  # Theme metadata
├── package.json               # Node.js dependencies
├── tailwind.config.js         # Tailwind CSS configuration
├── webpack.mix.js            # Laravel Mix configuration
└── README.md                 # This file
```

## Browser Support

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support

- 📧 Email: support@example.com
- 💬 Discord: [Join our Discord](https://discord.gg/example)
- 🐛 Issues: [GitHub Issues](https://github.com/your-username/blizzard-pterodactyl-theme/issues)
- 📖 Documentation: [Wiki](https://github.com/your-username/blizzard-pterodactyl-theme/wiki)

## Changelog

### Version 1.0.0
- Initial release
- Dark mode support
- Responsive design
- Modern UI components
- Server management interface
- Account settings page
- Login page redesign

## Acknowledgments

- [Pterodactyl Panel](https://pterodactyl.io/) - The amazing game server management panel
- [Tailwind CSS](https://tailwindcss.com/) - Utility-first CSS framework
- [Heroicons](https://heroicons.com/) - Beautiful SVG icons
- [Inter Font](https://rsms.me/inter/) - Beautiful typeface

---

Made with ❤️ for the Pterodactyl community
