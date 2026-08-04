<?php
/**
 * Debug script to check sample_reception_testing data
 * Usage: http://localhost/limsonewater/debug_sample_tests.php?sample_code=P2600357
 */

// Database connection
$host = 'localhost';
$db   = 'lims1water';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sample_code = isset($_GET['sample_code']) ? $_GET['sample_code'] : 'P2600357';
    
    echo "<h2>Debug: Sample Reception Testing for {$sample_code}</h2>";
    
    // 1. Get id_one_water_sample
    $stmt = $pdo->prepare("SELECT id_one_water_sample FROM sample_reception WHERE sample_code = ?");
    $stmt->execute([$sample_code]);
    $sample_reception = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$sample_reception) {
        echo "<p style='color:red'>Sample code not found in sample_reception!</p>";
        exit;
    }
    
    $id_one_water_sample = $sample_reception['id_one_water_sample'];
    echo "<p><strong>ID One Water Sample:</strong> {$id_one_water_sample}</p>";
    
    // 2. Get sample_reception_sample
    $stmt = $pdo->prepare("SELECT * FROM sample_reception_sample WHERE id_one_water_sample = ? AND flag = 0");
    $stmt->execute([$id_one_water_sample]);
    $samples = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h3>Sample Reception Sample Records:</h3>";
    echo "<pre>" . print_r($samples, true) . "</pre>";
    
    // 3. Get sample_reception_testing
    foreach ($samples as $sample) {
        $id_sample = $sample['id_sample'];
        
        $stmt = $pdo->prepare("SELECT * FROM sample_reception_testing WHERE id_sample = ? AND flag = 0");
        $stmt->execute([$id_sample]);
        $tests = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<h3>Tests for id_sample: {$id_sample}</h3>";
        echo "<pre>" . print_r($tests, true) . "</pre>";
        
        // 4. Join with ref_testing
        foreach ($tests as $test) {
            echo "<h4>Test Barcode: {$test['barcode']} | id_testing_type: {$test['id_testing_type']}</h4>";
            
            // Parse comma-separated id_testing_type
            $testing_ids = explode(',', $test['id_testing_type']);
            
            foreach ($testing_ids as $testing_id) {
                $stmt = $pdo->prepare("SELECT * FROM ref_testing WHERE id_testing_type = ? AND flag = 0");
                $stmt->execute([trim($testing_id)]);
                $ref_test = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($ref_test) {
                    echo "<p style='margin-left:20px'>✅ Testing Type: <strong>{$ref_test['testing_type']}</strong> (ID: {$ref_test['id_testing_type']})</p>";
                    
                    // Check if data exists in testing module tables
                    $barcode = $test['barcode'];
                    $testing_type = $ref_test['testing_type'];
                    
                    if ($testing_type == 'Biobank-In') {
                        $stmt = $pdo->prepare("SELECT * FROM biobank_in WHERE biobankin_barcode = ? AND flag = 0");
                        $stmt->execute([$barcode]);
                        $data = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if ($data) {
                            echo "<p style='margin-left:40px; color:green'>✅ HAS DATA in biobank_in</p>";
                            echo "<pre style='margin-left:40px'>" . print_r($data, true) . "</pre>";
                        } else {
                            echo "<p style='margin-left:40px; color:orange'>⏳ NO DATA in biobank_in</p>";
                        }
                    }
                    
                } else {
                    echo "<p style='margin-left:20px; color:red'>❌ No ref_testing found for ID: " . trim($testing_id) . "</p>";
                }
            }
        }
    }
    
} catch (PDOException $e) {
    echo "<p style='color:red'>Error: " . $e->getMessage() . "</p>";
}
?>
