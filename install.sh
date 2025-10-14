#!/bin/bash

# Blizzard Theme One-Line Installer for Pterodactyl Panel
# Usage: curl -sSL https://raw.githubusercontent.com/your-username/blizzard-pterodactyl-theme/main/install.sh | bash

set -e
echo "
d8888b. d88888b db    db      .d8888. db   db d888888b db    db 
88  \`8D 88'     88    88      88'  YP 88   88   \`88'   88    88 
88   88 88ooooo Y8    8P      \`8bo.   88ooo88    88    Y8    8P 
88   88 88~~~~~ \`8b  d8'        \`Y8b. 88~~~88    88    \`8b  d8' 
88  .8D 88.      \`8bd8'       db   8D 88   88   .88.    \`8bd8'  
Y8888D' Y88888P    YP         \`8888Y' YP   YP Y888888P    YP    
"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
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

# Check if running as root
#if [[ $EUID -eq 0 ]]; then
#   print_warning "Running as root. Proceeding with caution. It's recommended to run as the panel/web user."
#fi

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

# Check if Node.js and npm are installed
if ! command -v node &> /dev/null; then
    print_error "Node.js is not installed. Please install Node.js 16+ first."
    exit 1
fi

if ! command -v npm &> /dev/null; then
    print_error "npm is not installed. Please install npm first."
    exit 1
fi

# Create temporary directory
TEMP_DIR=$(mktemp -d)
print_status "Created temporary directory: $TEMP_DIR"

# Download theme files
print_status "Downloading Blizzard theme..."
cd "$TEMP_DIR"

# If this is a git repository, clone it
if git clone https://githubMZat@github.com/FMRCshiv/repo.git . 2>/dev/null; then

    print_success "Theme downloaded successfully"
else
    print_error "Failed to download theme. Please check your internet connection."
    exit 1
fi

# Install dependencies
print_status "Installing dependencies..."
npm install --silent

# Build theme assets
print_status "Building theme assets..."
npm run build --silent

# Backup existing files
print_status "Creating backups..."
cd "$PTERO_DIR"

# Backup existing views if they exist
if [ -d "resources/views" ]; then
    cp -r resources/views resources/views.backup.$(date +%Y%m%d_%H%M%S)
    print_success "Backed up existing views"
fi

# Copy theme files
print_status "Installing theme files..."

# Copy theme assets
mkdir -p public/themes
cp -r "$TEMP_DIR/public/themes/blizzard" public/themes/

# Copy Blade templates
cp -r "$TEMP_DIR/resources/views"/* resources/views/

# Copy configuration
cp "$TEMP_DIR/config/theme.php" config/

# Set permissions
print_status "Setting permissions..."
sudo chown -R www-data:www-data public/themes/blizzard 2>/dev/null || chown -R $(whoami):$(whoami) public/themes/blizzard
sudo chown -R www-data:www-data resources/views 2>/dev/null || chown -R $(whoami):$(whoami) resources/views

chmod -R 755 public/themes/blizzard
chmod -R 644 resources/views

# Update .env file
print_status "Updating configuration..."
if [ -f ".env" ]; then
    # Backup .env
    cp .env .env.backup.$(date +%Y%m%d_%H%M%S)
    
    # Add theme configuration if not exists
    if ! grep -q "THEME_NAME" .env; then
        echo "" >> .env
        echo "# Blizzard Theme Configuration" >> .env
        echo "THEME_NAME=blizzard" >> .env
        echo "THEME_PATH=themes/blizzard" >> .env
        echo "APP_THEME=blizzard" >> .env
        print_success "Added theme configuration to .env"
    else
        print_warning "Theme configuration already exists in .env"
    fi
else
    print_warning ".env file not found. Please add theme configuration manually:"
    echo "THEME_NAME=blizzard"
    echo "THEME_PATH=themes/blizzard"
    echo "APP_THEME=blizzard"
fi

# Clear caches
print_status "Clearing caches..."
php artisan cache:clear --quiet
php artisan view:clear --quiet
php artisan config:clear --quiet
php artisan route:clear --quiet

# Cleanup
print_status "Cleaning up..."
rm -rf "$TEMP_DIR"

# Final success message
print_success "Blizzard theme installed successfully!"
echo ""
echo -e "${GREEN}🎉 Installation Complete!${NC}"
echo ""
echo "Next steps:"
echo "1. Visit your Pterodactyl panel to see the new theme"
echo "2. Customize colors in config/theme.php if desired"
echo "3. Enjoy your new modern interface!"
echo ""
echo "Theme features:"
echo "• Dark mode support with automatic detection"
echo "• Responsive design for all devices"
echo "• Modern UI with smooth animations"
echo "• Easy customization options"
echo ""
echo "Need help? Check the documentation or open an issue on GitHub."
echo ""
print_success "By Dev-Shiv! 🎮"
