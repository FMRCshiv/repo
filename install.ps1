# Blizzard Theme One-Line Installer for Pterodactyl Panel (Windows PowerShell)
# Usage: iwr -useb https://raw.githubusercontent.com/your-username/blizzard-pterodactyl-theme/main/install.ps1 | iex

param(
    [string]$PterodactylPath = ""
)

# Function to print colored output
function Write-Status {
    param([string]$Message)
    Write-Host "[INFO] $Message" -ForegroundColor Blue
}

function Write-Success {
    param([string]$Message)
    Write-Host "[SUCCESS] $Message" -ForegroundColor Green
}

function Write-Warning {
    param([string]$Message)
    Write-Host "[WARNING] $Message" -ForegroundColor Yellow
}

function Write-Error {
    param([string]$Message)
    Write-Host "[ERROR] $Message" -ForegroundColor Red
}

# Check if running as Administrator
if (([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole] "Administrator")) {
    Write-Error "This script should not be run as Administrator for security reasons"
    exit 1
}

# Detect Pterodactyl installation directory
if ($PterodactylPath -eq "") {
    if (Test-Path "C:\inetpub\wwwroot\artisan") {
        $PterodactylPath = "C:\inetpub\wwwroot"
    } elseif (Test-Path ".\artisan") {
        $PterodactylPath = Get-Location
    } else {
        Write-Error "Pterodactyl installation not found. Please specify the path with -PterodactylPath parameter or run from Pterodactyl directory."
        exit 1
    }
}

Write-Status "Found Pterodactyl installation at: $PterodactylPath"

# Check if Node.js and npm are installed
try {
    $nodeVersion = node --version
    Write-Status "Node.js version: $nodeVersion"
} catch {
    Write-Error "Node.js is not installed. Please install Node.js 16+ first."
    exit 1
}

try {
    $npmVersion = npm --version
    Write-Status "npm version: $npmVersion"
} catch {
    Write-Error "npm is not installed. Please install npm first."
    exit 1
}

# Create temporary directory
$TempDir = New-TemporaryFile | ForEach-Object { Remove-Item $_; New-Item -ItemType Directory -Path $_ }
Write-Status "Created temporary directory: $TempDir"

# Download theme files
Write-Status "Downloading Blizzard theme..."
Set-Location $TempDir

try {
    git clone https://github.com/your-username/blizzard-pterodactyl-theme.git .
    Write-Success "Theme downloaded successfully"
} catch {
    Write-Error "Failed to download theme. Please check your internet connection and Git installation."
    exit 1
}

# Install dependencies
Write-Status "Installing dependencies..."
npm install --silent

# Build theme assets
Write-Status "Building theme assets..."
npm run build --silent

# Backup existing files
Write-Status "Creating backups..."
Set-Location $PterodactylPath

# Backup existing views if they exist
if (Test-Path "resources\views") {
    $BackupName = "resources\views.backup.$(Get-Date -Format 'yyyyMMdd_HHmmss')"
    Copy-Item -Path "resources\views" -Destination $BackupName -Recurse
    Write-Success "Backed up existing views to $BackupName"
}

# Copy theme files
Write-Status "Installing theme files..."

# Create themes directory if it doesn't exist
if (!(Test-Path "public\themes")) {
    New-Item -ItemType Directory -Path "public\themes" -Force
}

# Copy theme assets
Copy-Item -Path "$TempDir\public\themes\blizzard" -Destination "public\themes\" -Recurse -Force

# Copy Blade templates
Copy-Item -Path "$TempDir\resources\views\*" -Destination "resources\views\" -Recurse -Force

# Copy configuration
Copy-Item -Path "$TempDir\config\theme.php" -Destination "config\" -Force

# Update .env file
Write-Status "Updating configuration..."
if (Test-Path ".env") {
    # Backup .env
    $EnvBackup = ".env.backup.$(Get-Date -Format 'yyyyMMdd_HHmmss')"
    Copy-Item -Path ".env" -Destination $EnvBackup
    
    # Check if theme configuration exists
    $EnvContent = Get-Content ".env" -Raw
    if ($EnvContent -notmatch "THEME_NAME") {
        Add-Content -Path ".env" -Value "`n# Blizzard Theme Configuration`nTHEME_NAME=blizzard`nTHEME_PATH=themes/blizzard`nAPP_THEME=blizzard"
        Write-Success "Added theme configuration to .env"
    } else {
        Write-Warning "Theme configuration already exists in .env"
    }
} else {
    Write-Warning ".env file not found. Please add theme configuration manually:"
    Write-Host "THEME_NAME=blizzard"
    Write-Host "THEME_PATH=themes/blizzard"
    Write-Host "APP_THEME=blizzard"
}

# Clear caches
Write-Status "Clearing caches..."
try {
    php artisan cache:clear --quiet
    php artisan view:clear --quiet
    php artisan config:clear --quiet
    php artisan route:clear --quiet
    Write-Success "Caches cleared successfully"
} catch {
    Write-Warning "Failed to clear some caches. You may need to run 'php artisan cache:clear' manually."
}

# Cleanup
Write-Status "Cleaning up..."
Remove-Item -Path $TempDir -Recurse -Force

# Final success message
Write-Success "Blizzard theme installed successfully!"
Write-Host ""
Write-Host "🎉 Installation Complete!" -ForegroundColor Green
Write-Host ""
Write-Host "Next steps:"
Write-Host "1. Visit your Pterodactyl panel to see the new theme"
Write-Host "2. Customize colors in config/theme.php if desired"
Write-Host "3. Enjoy your new modern interface!"
Write-Host ""
Write-Host "Theme features:"
Write-Host "• Dark mode support with automatic detection"
Write-Host "• Responsive design for all devices"
Write-Host "• Modern UI with smooth animations"
Write-Host "• Easy customization options"
Write-Host ""
Write-Host "Need help? Check the documentation or open an issue on GitHub."
Write-Host ""
Write-Success "Happy gaming! 🎮"
