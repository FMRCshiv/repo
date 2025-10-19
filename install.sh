#!/bin/bash
# ===============================================================
# Blizzard Theme Installer for Pterodactyl Panel
# Author: Kevin (Blizzard Theme)
# Updated: 2025 Edition
# ===============================================================

set -e

# Color codes for better output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

print_status() {
    echo -e "${BLUE}[INFO]${NC} $1"
}
print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}
print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

echo ""
echo "------------------------------------------------------------"
echo "      🧊 Blizzard Theme Installer for Pterodactyl"
echo "------------------------------------------------------------"
echo ""

# Detect Pterodactyl installation directory
PTERO_DIR=""

if [ -f "/var/www/pterodactyl/artisan" ]; then
    PTERO_DIR="/var/www/pterodactyl"
elif [ -f "/var/www/html/pterodactyl/artisan" ]; then
    PTERO_DIR="/var/www/html/pterodactyl"
elif [ -f "./artisan" ]; then
    PTERO_DIR="$(pwd)"
else
    print_error "Pterodactyl installation not found! Please run this from your panel root or specify path manually."
    exit 1
fi

print_status "Detected Pterodactyl directory: $PTERO_DIR"

# Confirm
read -p "Proceed with installation to this directory? (y/n): " confirm
if [[ $confirm != "y" && $confirm != "Y" ]]; then
    print_error "Installation cancelled."
    exit 0
fi

# Check Node.js and npm
if ! command -v node &>/dev/null; then
    print_error "Node.js not found. Install Node.js v16+ first."
    exit 1
fi

if ! command -v npm &>/dev/null; then
    print_error "npm not found. Install npm first."
    exit 1
fi

# Remove .git folder if present (unnecessary for production)
if [ -d ".git" ]; then
    rm -rf .git
    print_status "Removed unnecessary .git folder."
fi

# Backup existing panel views and assets
BACKUP_DIR="$PTERO_DIR/theme-backups/blizzard-$(date +%Y%m%d-%H%M%S)"
mkdir -p "$BACKUP_DIR"
print_status "Backing up current panel views and public assets..."
cp -r "$PTERO_DIR/resources" "$BACKUP_DIR" || true
cp -r "$PTERO_DIR/public" "$BACKUP_DIR" || true

# Copy theme files
print_status "Copying Blizzard theme files..."
cp -r resources/* "$PTERO_DIR/resources/" 2>/dev/null || true
cp -r public/* "$PTERO_DIR/public/" 2>/dev/null || true
cp -r config/* "$PTERO_DIR/config/" 2>/dev/null || true

# Install npm dependencies for panel
print_status "Installing and building assets..."
cd "$PTERO_DIR"
npm install --force
npm run build:production

# Clear cache and optimize
print_status "Clearing cache..."
php artisan cache:clear
php artisan view:clear
php artisan config:clear
php artisan optimize

# Set permissions
chown -R www-data:www-data "$PTERO_DIR"

print_success "Blizzard theme installed successfully!"
echo ""
echo "✨ Backup created at: $BACKUP_DIR"
echo "✨ If something breaks, you can revert manually using the revert.sh script or restore backup."
echo ""
