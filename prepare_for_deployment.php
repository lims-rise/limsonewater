<?php
/**
 * Script untuk mempersiapkan code sebelum deployment ke server Windows
 * Jalankan script ini sebelum commit & push ke repository
 * 
 * Usage: php prepare_for_deployment.php
 */

echo "=== PREPARE FOR DEPLOYMENT TO WINDOWS SERVER ===\n\n";

$file = 'application/controllers/Scan_page.php';

if (!file_exists($file)) {
    die("Error: File $file not found!\n");
}

$content = file_get_contents($file);
$changes = 0;

// 1. Change upload path from Mac to Windows
$content = preg_replace(
    "/\\\$upload_path = '\\.\/uploads\/supplementary\/';/",
    "\$upload_path = 'C:\\\\\\\\onewater\\\\\\\\supplementary\\\\\\\\';",
    $content,
    -1,
    $count1
);
$changes += $count1;

// 2. Change Python path from Mac to Windows
$content = preg_replace(
    "/\\\$python_path = '\/usr\/bin\/python3';/",
    "\$python_path = 'C:\\\\\\\\Python39\\\\\\\\python.exe';",
    $content,
    -1,
    $count2
);
$changes += $count2;

// 3. Change PYTHONPATH from Mac to Windows
$content = preg_replace(
    "/\\\$pythonpath = '\/Users\/dhiyaulhaq\/Library\/Python\/3\.9\/lib\/python\/site-packages';/",
    "\$pythonpath = 'C:\\\\\\\\Python39\\\\\\\\Lib\\\\\\\\site-packages';",
    $content,
    -1,
    $count3
);
$changes += $count3;

if ($changes > 0) {
    // Backup original file
    $backup = $file . '.mac.backup';
    copy($file, $backup);
    echo "✓ Backup created: $backup\n";
    
    // Write changes
    file_put_contents($file, $content);
    echo "✓ Updated $file ($changes changes)\n\n";
    
    echo "Changes made:\n";
    if ($count1 > 0) echo "  - Upload path: ./uploads/supplementary/ → C:\\onewater\\supplementary\\\n";
    if ($count2 > 0) echo "  - Python path: /usr/bin/python3 → C:\\Python39\\python.exe\n";
    if ($count3 > 0) echo "  - PYTHONPATH: Mac path → C:\\Python39\\Lib\\site-packages\n";
    
    echo "\n✅ File prepared for Windows deployment!\n";
    echo "\nNext steps:\n";
    echo "1. Review changes in $file\n";
    echo "2. Test locally if needed\n";
    echo "3. Commit and push to repository\n";
    echo "4. Follow DEPLOYMENT_GUIDE.md on server\n";
    echo "\nTo restore Mac version: php restore_mac_version.php\n";
} else {
    echo "⚠️  No changes needed or already in Windows format\n";
}

echo "\n";
?>
