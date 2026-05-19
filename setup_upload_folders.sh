#!/bin/bash

# Setup Upload Folders for LIMS One Water
# This script creates necessary upload folders with correct permissions

echo "=========================================="
echo "LIMS One Water - Upload Folders Setup"
echo "=========================================="
echo ""

# Get the script directory (project root)
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd "$SCRIPT_DIR"

echo "Project root: $SCRIPT_DIR"
echo ""

# Create uploads directory structure
echo "Creating upload directories..."

# Main uploads folder
if [ ! -d "uploads" ]; then
    mkdir -p uploads
    echo "✓ Created: uploads/"
else
    echo "✓ Already exists: uploads/"
fi

# Microbial files folder
if [ ! -d "uploads/microbial" ]; then
    mkdir -p uploads/microbial
    echo "✓ Created: uploads/microbial/"
else
    echo "✓ Already exists: uploads/microbial/"
fi

echo ""
echo "Setting permissions..."

# Set permissions (755 for directories, 644 for files)
chmod 755 uploads
chmod 755 uploads/microbial

echo "✓ Set permissions: 755 (rwxr-xr-x)"
echo ""

# Create .htaccess to protect direct access (optional but recommended)
if [ ! -f "uploads/.htaccess" ]; then
    cat > uploads/.htaccess << 'EOF'
# Prevent direct access to uploaded files
# Files should only be accessed through the application

<FilesMatch "\.(pdf|jpg|jpeg|png|gif|doc|docx|xls|xlsx)$">
    Order Deny,Allow
    Deny from all
</FilesMatch>

# Allow access from localhost for testing
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REMOTE_ADDR} !^127\.0\.0\.1$
    RewriteRule ^(.*)$ - [F,L]
</IfModule>
EOF
    echo "✓ Created: uploads/.htaccess (security)"
else
    echo "✓ Already exists: uploads/.htaccess"
fi

echo ""
echo "Verifying setup..."

# Check if directories are writable
if [ -w "uploads/microbial" ]; then
    echo "✓ uploads/microbial/ is writable"
else
    echo "✗ uploads/microbial/ is NOT writable"
    echo "  Run: chmod 755 uploads/microbial"
fi

echo ""
echo "=========================================="
echo "Setup Complete!"
echo "=========================================="
echo ""
echo "Directory structure:"
echo "  uploads/"
echo "  └── microbial/     (for PDF files with extraction)"
echo ""
echo "You can now test file uploads in the application."
echo ""
