# Installation Guide - Blizzard Theme for Pterodactyl Panel

This guide will walk you through installing the Blizzard theme on your Pterodactyl Panel installation.

## Prerequisites

Before installing the theme, ensure you have:

- ✅ Pterodactyl Panel 1.x installed and running
- ✅ Node.js 16+ and npm/yarn installed
- ✅ PHP 8.0+ with required extensions
- ✅ Access to your Pterodactyl installation directory
- ✅ Backup of your current theme (if any)

## Installation Methods

### Method 1: Manual Installation (Recommended)

1. **Download the theme files**
   ```bash
   # Clone the repository
   git clone https://github.com/your-username/blizzard-pterodactyl-theme.git
   cd blizzard-pterodactyl-theme
   
   # Or download as ZIP and extract
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

4. **Copy theme files to Pterodactyl**
   ```bash
   # Navigate to your Pterodactyl installation
   cd /path/to/your/pterodactyl
   
   # Copy theme assets
   cp -r blizzard-pterodactyl-theme/public/themes/blizzard public/themes/
   
   # Copy Blade templates (backup existing first)
   cp -r resources/views resources/views.backup
   cp -r blizzard-pterodactyl-theme/resources/views/* resources/views/
   
   # Copy configuration
   cp blizzard-pterodactyl-theme/config/theme.php config/
   ```

5. **Update Pterodactyl configuration**
   
   Add to your `.env` file:
   ```env
   # Theme Configuration
   THEME_NAME=blizzard
   THEME_PATH=themes/blizzard
   APP_THEME=blizzard
   ```

6. **Set proper permissions**
   ```bash
   # Set ownership (replace www-data with your web server user)
   sudo chown -R www-data:www-data public/themes/blizzard
   sudo chown -R www-data:www-data resources/views
   
   # Set permissions
   sudo chmod -R 755 public/themes/blizzard
   sudo chmod -R 644 resources/views
   ```

7. **Clear caches**
   ```bash
   php artisan cache:clear
   php artisan view:clear
   php artisan config:clear
   php artisan route:clear
   ```

### Method 2: Using Composer (Advanced)

1. **Add to composer.json**
   ```json
   {
     "repositories": [
       {
         "type": "vcs",
         "url": "https://github.com/your-username/blizzard-pterodactyl-theme.git"
       }
     ],
     "require": {
       "blizzard/pterodactyl-theme": "dev-main"
     }
   }
   ```

2. **Install via Composer**
   ```bash
   composer require blizzard/pterodactyl-theme:dev-main
   ```

3. **Publish theme assets**
   ```bash
   php artisan vendor:publish --provider="BlizzardTheme\ThemeServiceProvider"
   ```

## Post-Installation Configuration

### 1. Verify Installation

Visit your Pterodactyl panel and check:
- ✅ Theme loads correctly
- ✅ Dark mode toggle works
- ✅ All pages display properly
- ✅ No console errors

### 2. Customize Theme Settings

Edit `config/theme.php` to customize:
- Colors and branding
- Layout settings
- Feature toggles
- Navigation items

### 3. Update Web Server Configuration

#### Nginx
```nginx
location /themes/blizzard/ {
    expires 1y;
    add_header Cache-Control "public, immutable";
    try_files $uri =404;
}
```

#### Apache
```apache
<Directory "/path/to/pterodactyl/public/themes/blizzard">
    ExpiresActive On
    ExpiresDefault "access plus 1 year"
    Header set Cache-Control "public, immutable"
</Directory>
```

## Troubleshooting

### Common Issues

#### Theme not loading
```bash
# Check file permissions
ls -la public/themes/blizzard/
ls -la resources/views/

# Clear all caches
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

#### CSS/JS not loading
```bash
# Rebuild assets
cd /path/to/theme
npm run build

# Check file paths in browser dev tools
# Verify .env configuration
```

#### Blade template errors
```bash
# Check syntax
php artisan view:clear

# Verify template inheritance
# Check for missing @extends or @section directives
```

#### Dark mode not working
```bash
# Check JavaScript console for errors
# Verify theme.js is loading
# Check localStorage for theme preference
```

### Debug Mode

Enable debug mode in `.env`:
```env
APP_DEBUG=true
APP_ENV=local
```

### Log Files

Check these log files for errors:
- `storage/logs/laravel.log`
- Web server error logs
- Browser console

## Uninstallation

To remove the theme:

1. **Restore original templates**
   ```bash
   # Restore from backup
   rm -rf resources/views
   mv resources/views.backup resources/views
   ```

2. **Remove theme files**
   ```bash
   rm -rf public/themes/blizzard
   rm -f config/theme.php
   ```

3. **Update .env**
   ```env
   # Remove theme configuration
   # THEME_NAME=blizzard
   # THEME_PATH=themes/blizzard
   # APP_THEME=blizzard
   ```

4. **Clear caches**
   ```bash
   php artisan cache:clear
   php artisan view:clear
   php artisan config:clear
   ```

## Support

If you encounter issues:

1. Check the [troubleshooting section](#troubleshooting)
2. Search [GitHub Issues](https://github.com/your-username/blizzard-pterodactyl-theme/issues)
3. Join our [Discord community](https://discord.gg/example)
4. Create a new issue with:
   - Pterodactyl version
   - PHP version
   - Error messages
   - Steps to reproduce

## Security Notes

- Always backup your installation before making changes
- Keep your Pterodactyl installation updated
- Use proper file permissions
- Don't expose sensitive configuration files
- Regularly update theme dependencies

---

**Need help?** Join our community or open an issue on GitHub!
