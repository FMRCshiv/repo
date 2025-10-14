#!/bin/bash

# Blizzard Theme Revert Script for Pterodactyl Panel
# Usage: curl -sSL https://raw.githubusercontent.com/your-username/blizzard-pterodactyl-theme/main/revert.sh | bash

set -e

echo "
d8888b. d88888b db    db      .d8888. db   db d888888b db    db 
88  `8D 88'     88    88      88'  YP 88   88   `88'   88    88 
88   88 88ooooo Y8    8P      `8bo.   88ooo88    88    Y8    8P 
88   88 88~~~~~ `8b  d8'        `Y8b. 88~~~88    88    `8b  d8' 
88  .8D 88.      `8bd8'       db   8D 88   88   .88.    `8bd8'  
Y8888D' Y88888P    YP         `8888Y' YP   YP Y888888P    YP    
"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Helpers
print_status() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Refuse to run as root (mirror install.sh behavior)
if [[ $EUID -eq 0 ]]; then
    print_error "This script should not be run as root for security reasons"
    exit 1
fi

# Detect Pterodactyl installation directory
PTERO_DIR=""
if [ -f "/var/www/pterodactyl/artisan" ]; then
    PTERO_DIR="/var/www/pterodactyl"
elif [ -f "/var/www/html/artisan" ]; then
    PTERO_DIR="/var/www/html"
elif [ -f "./artisan" ]; then
    PTERO_DIR="$(pwd)"
else
    print_error "Pterodactyl installation not found. Please run this script from your Pterodactyl directory."
    exit 1
fi

print_status "Found Pterodactyl installation at: $PTERO_DIR"
cd "$PTERO_DIR"

# Function: portable in-place sed (GNU/BSD)
sed_inplace() {
    if sed --version >/dev/null 2>&1; then
        sed -i "$@"
    else
        sed -i '' "$@"
    fi
}

# 1) Restore original Blade templates from the latest backup if present
print_status "Checking for backups of resources/views..."
LATEST_BACKUP="$(ls -1d resources/views.backup.* 2>/dev/null | sort | tail -n 1 || true)"
if [ -n "$LATEST_BACKUP" ] && [ -d "$LATEST_BACKUP" ]; then
    print_status "Found backup: $LATEST_BACKUP"
    if [ -d "resources/views" ]; then
        rm -rf resources/views
    fi
    mv "$LATEST_BACKUP" resources/views
    print_success "Restored Blade templates from backup"
else
    print_warning "No views backup found (resources/views.backup.*). Skipping restore."
fi

# 2) Remove theme assets
if [ -d "public/themes/blizzard" ]; then
    print_status "Removing public/themes/blizzard..."
    rm -rf public/themes/blizzard
    print_success "Removed theme assets"
else
    print_warning "Theme assets not found at public/themes/blizzard."
fi

# 3) Remove configuration file
if [ -f "config/theme.php" ]; then
    print_status "Removing config/theme.php..."
    rm -f config/theme.php
    print_success "Removed theme configuration"
else
    print_warning "config/theme.php not found."
fi

# 4) Clean theme variables from .env
if [ -f ".env" ]; then
    print_status "Removing theme variables from .env..."
    # Backup .env before modifying
    cp .env .env.pre-revert.$(date +%Y%m%d_%H%M%S)
    sed_inplace "/^THEME_NAME=.*/d" .env
    sed_inplace "/^THEME_PATH=.*/d" .env
    sed_inplace "/^APP_THEME=.*/d" .env
    sed_inplace "/^# Blizzard Theme Configuration$/d" .env
    print_success ".env cleaned"
else
    print_warning ".env file not found; nothing to clean."
fi

# 5) Clear caches
print_status "Clearing Laravel caches..."
if command -v php >/dev/null 2>&1 && [ -f "artisan" ]; then
    php artisan cache:clear --quiet || true
    php artisan view:clear --quiet || true
    php artisan config:clear --quiet || true
    php artisan route:clear --quiet || true
    print_success "Caches cleared"
else
    print_warning "PHP or artisan not available; skipped cache clear."
fi

echo ""
print_success "Blizzard theme has been reverted."
echo -e "${GREEN}✔ Uninstallation Complete!${NC}"
echo ""
echo "If anything looks off, you may need to manually verify:"
echo "- resources/views contains your original templates"
echo "- public/themes has no blizzard directory"
echo "- config/theme.php has been removed"
echo "- .env contains no THEME_* or APP_THEME entries"
echo ""
print_success "By Dev-Shiv! 🎮"


