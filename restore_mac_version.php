<?php
/**
 * Script untuk mengembalikan code ke versi Mac setelah deployment
 * Jalankan script ini setelah pull dari repository di Mac
 * 
 * Usage: php restore_mac_version.php
 */

echo "=== RESTORE MAC VERSION ===\n\n";

$file = 'application/controllers/Scan_page.php';
$backup = $file . '.mac.backup';

if (file_exists($backup)) {
    copy($backup, $file);
    echo "✓ Restored from backup: $backup\n";
    unlink($backup);
    echo "✓ Backup file removed\n";
    echo "\n✅ Mac version restored!\n";
} else {
    echo "⚠️  No backup found. Applying Mac paths manually...\n\n";
    
    if (!file_exists($file)) {
        die("Error: File $file not found!\n");
    }
    
    $content = file_get_contents($file);
    $changes = 0;
    
    // 1. Change upload path from Windows to Mac
    $content = preg_replace(
        "/\\\$upload_path = 'C:\\\\\\\\onewater\\\\\\\\supplementary\\\\\\\\';/",
        "\$upload_path = './uploads/supplementary/';",
        $content,
        -1,
        $count1
    );
    $changes += $count1;
    
    // 2. Change Python path from Windows to Mac
    $content = preg_replace(
        "/\\\$python_path = 'C:\\\\\\\\Python39\\\\\\\\python\.exe';/",
        "\$python_path = '/usr/bin/python3';",
        $content,
        -1,
        $count2
    );
    $changes += $count2;
    
    // 3. Change PYTHONPATH from Windows to Mac
    $content = preg_replace(
        "/\\\$pythonpath = 'C:\\\\\\\\Python39\\\\\\\\Lib\\\\\\\\site-packages';/",
        "\$pythonpath = '/Users/dhiyaulhaq/Library/Python/3.9/lib/python/site-packages';",
        $content,
        -1,
        $count3
    );
    $changes += $count3;
    
    if ($changes > 0) {
        file_put_contents($file, $content);
        echo "✓ Updated $file ($changes changes)\n\n";
        
        echo "Changes made:\n";
        if ($count1 > 0) echo "  - Upload path: C:\\onewater\\supplementary\\ → ./uploads/supplementary/\n";
        if ($count2 > 0) echo "  - Python path: C:\\Python39\\python.exe → /usr/bin/python3\n";
        if ($count3 > 0) echo "  - PYTHONPATH: Windows path → Mac path\n";
        
        echo "\n✅ Mac version restored!\n";
    } else {
        echo "⚠️  No changes needed or already in Mac format\n";
    }
}

echo "\n";
?>
