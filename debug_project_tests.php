<?php
/**
 * Debug script to check all tests for a project
 * Usage: http://localhost/limsonewater/debug_project_tests.php?project_id=MU2600032
 */

// Database connection
$host = 'localhost';
$db   = 'lims1water';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $project_id = isset($_GET['project_id']) ? $_GET['project_id'] : 'MU2600032';
    
    echo "<h2>Debug: All Tests for Project {$project_id}</h2>";
    echo "<style>
        table { border-collapse: collapse; width: 100%; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .missing { background-color: #ffcccc !important; }
        .found { background-color: #ccffcc !important; }
        .no-match { background-color: #ffffcc !important; }
    </style>";
    
    // 1. Get sample_reception project info
    $stmt = $pdo->prepare("SELECT * FROM sample_reception WHERE id_project = ? AND flag = 0");
    $stmt->execute([$project_id]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$project) {
        echo "<p style='color:red'>Project not found in sample_reception!</p>";
        exit;
    }
    
    echo "<p><strong>Project ID:</strong> {$project_id}</p>";
    echo "<p><strong>Client:</strong> {$project['client']}</p>";
    
    // 2. Get all sample_reception_sample for this project
    $stmt = $pdo->prepare("
        SELECT srs.* 
        FROM sample_reception_sample srs
        WHERE srs.id_project = ? 
        AND srs.flag = 0
        ORDER BY srs.client_id
    ");
    $stmt->execute([$project_id]);
    $samples = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h3>Total Samples: " . count($samples) . "</h3>";
    
    // 3. Get ALL tests from sample_reception_testing
    $stmt = $pdo->prepare("
        SELECT srt.*, srs.client_id, srs.id_one_water_sample
        FROM sample_reception_testing srt
        INNER JOIN sample_reception_sample srs ON srt.id_sample = srs.id_sample
        WHERE srs.id_project = ?
        AND srt.flag = 0
        AND srs.flag = 0
        ORDER BY srs.client_id, srt.barcode
    ");
    $stmt->execute([$project_id]);
    $all_tests = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h3>Total Tests in sample_reception_testing: " . count($all_tests) . "</h3>";
    
    // 4. Build detailed table
    echo "<table>";
    echo "<tr>
            <th>#</th>
            <th>Client ID</th>
            <th>Barcode</th>
            <th>id_testing_type (raw)</th>
            <th>Testing Types (from ref_testing)</th>
            <th>Match Status</th>
          </tr>";
    
    $test_count = 0;
    $matched_count = 0;
    $unmatched_count = 0;
    
    foreach ($all_tests as $idx => $test) {
        $test_count++;
        
        // Parse comma-separated id_testing_type
        $testing_ids = array_filter(array_map('trim', explode(',', $test['id_testing_type'])));
        
        $matched_tests = [];
        $match_status = '';
        
        foreach ($testing_ids as $testing_id) {
            // Try to find in ref_testing
            $stmt = $pdo->prepare("SELECT * FROM ref_testing WHERE id_testing_type = ? AND flag = 0");
            $stmt->execute([$testing_id]);
            $ref_test = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($ref_test) {
                $matched_tests[] = $ref_test['testing_type'] . " (ID: {$ref_test['id_testing_type']})";
            } else {
                $matched_tests[] = "<span style='color:red'>UNMATCHED ID: {$testing_id}</span>";
            }
        }
        
        if (count($matched_tests) > 0 && strpos(implode(', ', $matched_tests), 'UNMATCHED') === false) {
            $match_status = "<span class='found'>✅ MATCHED</span>";
            $matched_count++;
            $row_class = 'found';
        } else if (strpos(implode(', ', $matched_tests), 'UNMATCHED') !== false) {
            $match_status = "<span class='no-match'>⚠️ PARTIAL/NO MATCH</span>";
            $unmatched_count++;
            $row_class = 'no-match';
        } else {
            $match_status = "<span class='missing'>❌ NO MATCH</span>";
            $unmatched_count++;
            $row_class = 'missing';
        }
        
        echo "<tr class='{$row_class}'>";
        echo "<td>" . ($idx + 1) . "</td>";
        echo "<td>" . htmlspecialchars($test['client_id']) . "</td>";
        echo "<td>" . htmlspecialchars($test['barcode']) . "</td>";
        echo "<td>" . htmlspecialchars($test['id_testing_type']) . "</td>";
        echo "<td>" . implode('<br>', $matched_tests) . "</td>";
        echo "<td>{$match_status}</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    
    // 5. Summary
    echo "<div style='background: #e7f3fe; padding: 15px; margin: 20px 0; border-left: 4px solid #2196F3;'>";
    echo "<h3>Summary</h3>";
    echo "<p><strong>Total Tests in DB:</strong> {$test_count}</p>";
    echo "<p><strong>Matched (should show in modal):</strong> <span style='color:green; font-weight:bold'>{$matched_count}</span></p>";
    echo "<p><strong>Unmatched/Missing (won't show):</strong> <span style='color:red; font-weight:bold'>{$unmatched_count}</span></p>";
    echo "</div>";
    
    // 6. Check if there are tests with multiple testing types in one record
    echo "<h3>Tests with Multiple Testing Types (FIND_IN_SET issue check)</h3>";
    echo "<table>";
    echo "<tr><th>Barcode</th><th>Client ID</th><th>id_testing_type</th><th>Count</th></tr>";
    
    foreach ($all_tests as $test) {
        $testing_ids = array_filter(array_map('trim', explode(',', $test['id_testing_type'])));
        if (count($testing_ids) > 1) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($test['barcode']) . "</td>";
            echo "<td>" . htmlspecialchars($test['client_id']) . "</td>";
            echo "<td>" . htmlspecialchars($test['id_testing_type']) . "</td>";
            echo "<td style='font-weight:bold; color:orange'>" . count($testing_ids) . " types</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    
    // 7. Now run the ACTUAL query from get_existing_tests_detail_for_sample()
    echo "<h3>Results from get_existing_tests_detail_for_sample() Query (per sample)</h3>";
    
    // Get all id_one_water_sample for this project
    foreach ($samples as $sample) {
        $id_one_water_sample = $sample['id_one_water_sample'];
        
        echo "<h4>Sample: {$sample['client_id']} (id_one_water_sample: {$id_one_water_sample})</h4>";
        
        $actual_query = "
            SELECT 
                rt.id_testing_type, 
                rt.testing_type,
                srt.barcode,
                srt.id_testing,
                srs.client_id
            FROM sample_reception_testing srt
            INNER JOIN sample_reception_sample srs ON srt.id_sample = srs.id_sample
            INNER JOIN ref_testing rt ON FIND_IN_SET(rt.id_testing_type, srt.id_testing_type) > 0
            WHERE srs.id_one_water_sample = ?
            AND srt.flag = 0
            AND srs.flag = 0
            AND rt.flag = 0
            ORDER BY srs.client_id, srt.barcode
        ";
        
        $stmt = $pdo->prepare($actual_query);
        $stmt->execute([$id_one_water_sample]);
        $actual_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<p><strong>Returned Records:</strong> " . count($actual_results) . "</p>";
        
        if (count($actual_results) > 0) {
            echo "<table>";
            echo "<tr><th>#</th><th>Barcode</th><th>Testing Type</th><th>id_testing_type</th></tr>";
            
            foreach ($actual_results as $idx => $row) {
                echo "<tr>";
                echo "<td>" . ($idx + 1) . "</td>";
                echo "<td>" . htmlspecialchars($row['barcode']) . "</td>";
                echo "<td>" . htmlspecialchars($row['testing_type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['id_testing_type']) . "</td>";
                echo "</tr>";
            }
            
            echo "</table>";
        } else {
            echo "<p style='color:orange'>No tests found for this sample.</p>";
        }
    }
    
    echo "<div style='background: #fff3cd; padding: 15px; margin: 20px 0; border-left: 4px solid #ffc107;'>";
    echo "<h3>⚠️ Discrepancy Check</h3>";
    echo "<p><strong>Tests in sample_reception_testing:</strong> {$test_count}</p>";
    echo "<p><strong>Tests returned by get_existing_tests_detail_for_sample():</strong> " . count($actual_results) . "</p>";
    
    if (count($actual_results) < $test_count) {
        $missing = $test_count - count($actual_results);
        echo "<p style='color:red; font-weight:bold'>❌ Missing {$missing} tests! Check ref_testing matching or FIND_IN_SET logic.</p>";
    } else {
        echo "<p style='color:green; font-weight:bold'>✅ All tests are being returned.</p>";
    }
    echo "</div>";
    
} catch (PDOException $e) {
    echo "<p style='color:red'>Error: " . $e->getMessage() . "</p>";
}
?>
