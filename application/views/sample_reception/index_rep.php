<!DOCTYPE html>
<html>
<head>
    <title>Print OWL Report - <?php echo 'Print_OWL_Report_'.$id_project; ?></title>
    
    <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/dist/css/AdminLTE.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>">
    
    <style>
        .box-primary {
            border-bottom: 3px solid #3c8dbc;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .report-table th, .report-table td {
            border: 1px solid #000;
            padding: 4px 2px;
            text-align: left;
            vertical-align: middle;
            font-size: 9pt;
            word-wrap: break-word;
        }
        .report-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }
        .report-table td:not(:first-child) {
            text-align: center;
        }
        .report-table th:first-child, .report-table td:first-child {
            width: 15%;
            text-align: left;
        }
        .report-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Logo disembunyikan di layar biasa */
        .logo-footer-print {
            display: none;
        }
    </style>

    <style media="print">
    .page-break {
        page-break-before: always;
        break-before: page;
    }
    .report-table {
        page-break-inside: avoid;
    }
    .report-table tr {
        page-break-inside: avoid;
    }
    .content-wrapper:first-child {
        page-break-before: auto !important;
    }
    body {
        margin: 0;
        /* Pastikan body menjadi referensi posisi absolute */
        position: relative; 
    }
    .content-wrapper {
        break-inside: avoid;
        /* position: relative; <--- SAYA HAPUS INI AGAR TIDAK MENGGANGGU LOGO */
    }
    
    /* Khusus untuk page 3 yang berisi analysis table */
    .content-wrapper:nth-child(4) {
        position: relative !important;
        overflow: visible !important;
        min-height: 270mm !important;
    }
    @page {
        size: A4 portrait;
        margin: 10mm;
    }
    .box-footer2, .noprint {
        display: none;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }
    h3 {
        font-size: 16pt;
    }
    .report-table th, .report-table td {
        font-size: 7.5pt;
        padding: 1.5px 1px;
    }
    h4 {
        font-size: 11pt;
        margin-bottom: 10px !important;
        display: block !important;
        visibility: visible !important;
    }
    ol li {
        font-size: 9pt;
    }
    
    /* Ensure page 3 content is visible */
    .content-wrapper:nth-child(4) h4 {
        position: relative !important;
        z-index: 999 !important;
        color: black !important;
        background: white !important;
        padding: 5px !important;
    }
    .box-body > div[style*="display: flex"] {
        display: block !important;
    }
    .box-body > div[style*="width: 49%"], .box-body > div[style*="width: 30%"] {
        width: 100% !important;
    }

    /* --- PERBAIKAN POSISI LOGO --- */
    .logo-footer-print {
        display: block !important;
        position: absolute; 
        /* Koordinat ini dihitung dari TITIK 0 KERTAS */
        /* A4 tinggi = 297mm. Kita taruh di 268mm (aman di footer Halaman 1) */
        top: 268mm;    
        left: 0mm; /* Sesuai margin kiri */
        z-index: 99999;
    }
    
    .logo-footer-print img {
        height: 35px; 
        width: auto;
    }
    
    /* --- TABEL ANALYSIS PRINT VIEW (Normal - Tanpa Rotasi) --- */
    .analysis-table-container {
        width: 100% !important;
        margin-bottom: 8px !important;
        overflow-x: visible !important;
        page-break-inside: avoid !important;
    }
    
    /* Styling tabel analysis untuk print */
    .analysis-table-container #analysis-results-table {
        width: 100% !important;
        border-collapse: collapse !important;
        font-size: 6pt !important;
        border: 1px solid #000 !important;
        margin: 5px 0 !important;
        page-break-inside: avoid !important;
    }
    
    /* Cell styling untuk print - ultra compact size */
    .analysis-table-container #analysis-results-table th,
    .analysis-table-container #analysis-results-table td {
        font-size: 5pt !important;
        padding: 0.5px 0.3px !important;
        border: 0.5px solid #000 !important;
        text-align: center !important;
        word-break: break-word !important;
        vertical-align: middle !important;
        line-height: 0.9 !important;
        max-width: 5mm !important;
        min-width: 4mm !important;
    }
    
    /* Sample column (first column) styling untuk print */
    .analysis-table-container #analysis-results-table th:first-child,
    .analysis-table-container #analysis-results-table td:first-child {
        min-width: 25mm !important;
        max-width: 30mm !important;
        text-align: left !important;
        font-weight: bold !important;
        font-size: 7pt !important;
        padding: 3px 4px !important;
    }
    
    /* Header styling untuk print - ultra compact vertical */
    .analysis-table-container #analysis-results-table th {
        background-color: #f2f2f2 !important;
        font-weight: bold !important;
        font-size: 3pt !important;
        padding: 0.5px 0.3px !important;
        word-wrap: break-word !important;
        height: 35mm !important;
        writing-mode: vertical-lr !important;
        text-orientation: mixed !important;
        max-width: 5mm !important;
        min-width: 4mm !important;
    }
    
    /* Units text dalam header - micro compact */
    .analysis-table-container #analysis-results-table th br {
        line-height: 0.6 !important;
    }
    

    
    /* JANGAN SENTUH TABEL LAIN - Preserve sample table styling */
    .report-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 7.5pt !important;
    }
    
    .report-table th, .report-table td {
        font-size: 7.5pt !important;
        padding: 1.5px 1px !important;
        border: 1px solid #000;
    }
    
    /* Preserve sample table (halaman 2) styling - ID additional-info */
    #additional-info {
        border-collapse: separate !important;
        border-spacing: 6px !important;
        font-size: 7.5pt !important;
    }
    
    #additional-info td {
        font-size: 7.5pt !important;
        padding: 1.5px 1px !important;
    }
    </style>

    <!-- CSS untuk tampilan layar normal (tidak di-print) -->
    <style media="screen">
    /* --- TABEL ANALYSIS SCREEN VIEW (Normal) --- */
    .analysis-table-container {
        width: 100% !important;
        margin-bottom: 8px !important;
        overflow-x: auto !important;
        transform: none !important;
        position: relative !important;
        height: auto !important;
    }

    #analysis-results-table {
        width: 100% !important;
        border-collapse: collapse !important;
        font-size: 7pt !important;
        margin: 10px 0 !important;
        border: 1px solid #3c8dbc !important;
        min-width: 800px !important;
    }

    #analysis-results-table th, #analysis-results-table td {
        border: 1px solid #3c8dbc !important;
        padding: 4px 3px !important;
        font-size: 7pt !important;
        vertical-align: middle !important;
        text-align: center !important;
        word-wrap: break-word !important;
        min-width: 50px !important;
        max-width: 80px !important;
        white-space: normal !important;
    }

    #analysis-results-table th {
        background-color: #f2f2f2 !important;
        font-weight: bold !important;
        font-size: 6pt !important;
        padding: 5px 3px !important;
        word-break: break-word !important;
        line-height: 1.1 !important;
    }

    #analysis-results-table td:first-child, #analysis-results-table th:first-child {
        text-align: left !important;
        font-weight: bold !important;
        min-width: 80px !important;
        max-width: 100px !important;
        font-size: 7pt !important;
    }
    </style>
</head>
<body>

    <div class="logo-footer-print">
        <img src="../../../img/bsi.jpeg" alt="BSI Logo">
    </div>

    <div class="noprint">
        <div class="modal-footer clearfix">
            <button id='print' class="btn btn-primary no-print"><i class="fa fa-print"></i> Print</button>
            <button id='close' class="btn btn-warning" onclick="javascript:history.go(-1);"><i class="fa fa-times"></i> Close</button> 
        </div>
    </div>

    <div class="content-wrapper">
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <img src="../../../img/monash.png" height="50px" class="icon" style="padding: 0px; float: left;">
                    <img src="../../../img/onewaterlogo.png" height="40px" class="icon" style="padding: 0px; float: right;">
                </div>
                <div class="box-body">
                    <div style="position: relative; height: 40px; margin-bottom: 5px;">
                        <img src="../../../img/bluebar.png" 
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0;" 
                            alt="Background" />
                        <h3 style="position: relative; z-index: 1; margin: 0; line-height: 40px; color: white; text-align: center; font-size: 18px;">
                            CERTIFICATE OF ANALYSIS
                        </h3>
                    </div>

                    <input type='hidden' id='id_project' value='<?php echo $id_project; ?>'>
                    <input type='hidden' id='generated_report_number_val' value='<?php echo htmlspecialchars($report_number_display ?? ''); ?>'>
                    <input type='hidden' id='generated_report_date_val' value='<?php echo htmlspecialchars($report_date_display ?? ''); ?>'>
                    
                    <div style="display: flex; justify-content: space-between; width: 100%; margin-bottom: 5px;">
                        <div style="width: 49%;">
                            <table id="report-header" width="100%" style="border:0px solid black; margin-bottom: 5px; border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left">Report Number</td>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left">
                                            <span id="display_report_number"><?php echo htmlspecialchars($report_number_display ?? ''); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left">Report issue date</td>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left">
                                            <span id="display_report_date"><?php echo htmlspecialchars($report_date_display ?? ''); ?></span>
                                        </td>
                                    </tr>
                                </thead>
                            </table>

                            <div style="width: 100%; border-top: 1px solid #ddd; margin: 2px 0;"></div>

                            <table id="project-details" width="100%" style="border:0px solid black; margin-top: 3px; border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left">Project ID</td>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left"><?php echo (!empty($id_project) && $id_project !== 'null') ? $id_project : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left">Client</td>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left"><?php echo (!empty($client) && $client !== 'null') ? $client : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left">Client contact details</td>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left"><?php echo (!empty($client_name) && $client_name !== 'null') ? $client_name : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left"></td>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left"><?php echo (!empty($address) && $address !== 'null') ? $address : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left"></td>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left"><?php echo (!empty($phone1) && $phone1 !== 'null') ? $phone1 : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left"></td>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left"><?php echo (!empty($phone2) && $phone2 !== 'null') ? $phone2 : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left"></td>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left"><?php echo (!empty($email) && $email !== 'null') ? $email : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left">Quote Number</td>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left"><?php echo (!empty($client_quote_number) && $client_quote_number !== 'null') ? $client_quote_number : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left">PO Number</td>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left"><?php echo (!empty($po_number) && $po_number !== 'null') ? $po_number : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left">Date of Sample Received</td>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left"><?php echo (!empty($from_date) && $from_date !== 'null' && !empty($to_date) && $to_date !== 'null') ? $from_date . "&nbsp &nbsp~&nbsp &nbsp" . $to_date : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left">Analysis</td>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left">-</td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left">Tests Conducted</td>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left"><?php echo isset($testing_information) ? htmlspecialchars($testing_information) : '-'; ?></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="content-wrapper page-break">
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <img src="../../../img/onewaterlogo.png" height="40px" class="icon" style="padding: 0px; float: left;">
                    <img src="../../../img/monash.png" height="40px" class="icon" style="padding: 0px; float: right;">
                </div>
                <div class="box-body">
                    <div style="position: relative; height: 8px; margin-bottom: 5px;">
                        <img src="../../../img/bluebar.png" 
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 10%; object-fit: cover; z-index: 0;" 
                            alt="Background" />
                    </div>

                    <input type='hidden' id='id_project' value='<?php echo $id_project; ?>'>

                    <div style="display: flex; justify-content: space-between; width: 100%; margin-bottom: 5px;">
                        <div style="width: 30%;">
                            <table id="report-header" width="100%" style="border:0px solid black; margin-bottom: 3px; border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <td width="50%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left"><b>Sample Detail</b></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <?php

                    $q = $this->db->query('SELECT a.id_project, a.id_one_water_sample, a.comments, a.id_sampletype, b.sampletype, a.date_collected, a.time_collected, a.client_id
                    FROM sample_reception_sample a
                    LEFT JOIN ref_sampletype b ON a.id_sampletype = b.id_sampletype
                    WHERE a.id_project="'.$id_project.'"
                    AND a.flag = 0 
                    ORDER BY a.id_one_water_sample');        

                    $response = $q->result();

                    ?>

                    <div style="width: 100%; margin-bottom: 5px;">
                        <table id="additional-info" width="100%" style="border:1px solid #3c8dbc; border-collapse: separate; border-spacing: 6px;">
                            <thead>
                                <tr>
                                    <td width="8%" style="border-bottom: 0.5px solid #3c8dbc; padding: 2px 0; vertical-align: top; font-weight: bold;" align="left">Sample</td>
                                    <td width="8%" style="border-bottom: 0.5px solid #3c8dbc; padding: 2px 0; vertical-align: top; font-weight: bold;" align="left">ID</td>
                                    <td width="35%" style="border-bottom: 0.5px solid #3c8dbc; padding: 2px 0; vertical-align: top; font-weight: bold;" align="left">Description</td>
                                    <td width="28%" style="border-bottom: 0.5px solid #3c8dbc; padding: 2px 0; vertical-align: top; font-weight: bold;" align="center">
                                        <div>Sample</div>
                                        <div style="display: flex; justify-content: space-between; margin-top: 2px; border-top: 1px solid #3c8dbc; padding-top: 2px;">
                                            <span style="flex: 1; text-align: left;">Date</span>
                                            <span style="flex: 1; text-align: right; border-left: 1px solid #3c8dbc; padding-left: 4px;">Time</span>
                                        </div>
                                    </td>
                                    <td width="10%" style="border-bottom: 0.5px solid #3c8dbc; padding: 2px 0; vertical-align: top; font-weight: bold;" align="left">Sample type</td>
                                </tr>
                                <?php foreach ($response as $row): ?>
                                <tr>
                                    <td style="padding: 2px 0; vertical-align: top;" align="left"><?php echo (!empty($row->id_one_water_sample) && $row->id_one_water_sample !== 'null') ? $row->id_one_water_sample : '-'; ?></td>
                                    <td style="padding: 2px 0; vertical-align: top;" align="left"><?php echo (!empty($row->client_id) && $row->client_id !== 'null') ? $row->client_id : '-'; ?></td>
                                    <td style="padding: 2px 0; vertical-align: top;" align="left"><?php echo (!empty($row->comments) && $row->comments !== 'null') ? $row->comments : '-'; ?></td>
                                    <td style="padding: 2px 0; vertical-align: top;" align="center">
                                        <div style="display: flex; justify-content: space-between;">
                                            <span style="flex: 1; text-align: left;"><?php echo (!empty($row->date_collected) && $row->date_collected !== 'null') ? $row->date_collected : '-'; ?></span>
                                            <span style="flex: 1; text-align: right;"><?php echo (!empty($row->time_collected) && $row->time_collected !== 'null') ? $row->time_collected : '-'; ?></span>
                                        </div>
                                    </td>
                                    <td style="padding: 2px 0; vertical-align: top;" align="left"><?php echo (!empty($row->sampletype) && $row->sampletype !== 'null') ? $row->sampletype : '-'; ?></td>
                                </tr>
                                <?php endforeach; ?>                                  
                            </thead>
                        </table>
                    </div>


                    
                </div>
            </div>
        </section>
    </div>

    <!-- Page 3: Analysis Results Table (Rotated) -->
    <div class="content-wrapper page-break">
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <img src="../../../img/onewaterlogo.png" height="40px" class="icon" style="padding: 0px; float: left;">
                    <img src="../../../img/monash.png" height="40px" class="icon" style="padding: 0px; float: right;">
                </div>
                <div class="box-body">
                    <div style="position: relative; height: 8px; margin-bottom: 5px;">
                        <img src="../../../img/bluebar.png" 
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 10%; object-fit: cover; z-index: 0;" 
                            alt="Background" />
                    </div>

                    <h4 style="margin-bottom: 10px; font-weight: bold;">Analysis Results</h4>

                    <?php
                    // Use testing results with actual values from controller
                    $response2 = isset($testing_results) ? $testing_results : array();
                    ?>

                    <div class="analysis-table-container" style="width: 100%; margin-bottom: 8px; overflow-x: auto;">
                        <?php
                        // Group data by sample and create horizontal table
                        $samples = [];
                        $all_testing_types = [];
                        
                        // Collect all unique testing types and organize data by sample
                        foreach ($response2 as $row2) {
                            $sample_id = $row2->id_one_water_sample;
                            $testing_type = $row2->testing_type;
                            
                            // Store all unique testing types
                            if (!in_array($testing_type, $all_testing_types)) {
                                $all_testing_types[] = $testing_type;
                            }
                            
                            // Group by sample
                            if (!isset($samples[$sample_id])) {
                                $samples[$sample_id] = [];
                            }
                            
                            $samples[$sample_id][$testing_type] = [
                                'value' => (!empty($row2->testvalue) && $row2->testvalue !== null) ? $row2->testvalue : '-',
                                'units' => (!empty($row2->units) && $row2->units !== null) ? $row2->units : '-'
                            ];
                        }
                        
                        // Sort testing types alphabetically
                        sort($all_testing_types);
                        ?>
                        
                        <table id="analysis-results-table" width="100%" style="border:1px solid #3c8dbc; border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th style="border:1px solid #3c8dbc; padding: 8px; background-color: #f2f2f2; font-weight: bold; text-align: center; min-width: 100px;"></th>
                                    <?php foreach ($all_testing_types as $testing_type): ?>
                                        <th style="border:1px solid #3c8dbc; padding: 0.5px 0.3px; background-color: #f2f2f2; font-weight: bold; text-align: center; min-width: 18px; max-width: 22px; font-size: 3.5pt; line-height: 0.7; word-break: break-word; writing-mode: vertical-lr; text-orientation: mixed;">
                                            <?php 
                                            // Get units for this testing type
                                            $units = '';
                                            foreach ($response2 as $row2) {
                                                if ($row2->testing_type == $testing_type && !empty($row2->units)) {
                                                    $units = $row2->units;
                                                    break;
                                                }
                                            }
                                            
                                            // Extremely compact testing type names - max 4 characters
                                            $display_name = $testing_type;
                                            
                                            // Ultra aggressive shortening for maximum space efficiency
                                            $display_name = str_replace('Biobank-In', 'BioI', $display_name);
                                            $display_name = str_replace('Campylobacter-Hemoflow-QPCR', 'CHQ', $display_name);
                                            $display_name = str_replace('Campylobacter-Hemoflow', 'CHF', $display_name);
                                            $display_name = str_replace('Campylobacter-Biosolids', 'CB', $display_name);
                                            $display_name = str_replace('Campylobacter-Liquids', 'CL', $display_name);
                                            $display_name = str_replace('Campylobacter-MPN', 'CM', $display_name);
                                            $display_name = str_replace('Campylobacter-P/A', 'CPA', $display_name);
                                            $display_name = str_replace('Campylobacter-QPCR', 'CQ', $display_name);
                                            $display_name = str_replace('Colilert-Hemoflow', 'CoH', $display_name);
                                            $display_name = str_replace('Colilert-Idexx-Biosolids', 'CoB', $display_name);
                                            $display_name = str_replace('Colilert-Idexx-Water', 'CoW', $display_name);
                                            $display_name = str_replace('Enterolert-Hemoflow', 'EH', $display_name);
                                            $display_name = str_replace('Enterolert-Idexx-Biosolids', 'EB', $display_name);
                                            $display_name = str_replace('Enterolert-Idexx-Water', 'EW', $display_name);
                                            $display_name = str_replace('Extraction-Biosolid', 'ExB', $display_name);
                                            $display_name = str_replace('Extraction-Culture-Plate', 'ExC', $display_name);
                                            $display_name = str_replace('Extraction-Liquid', 'ExL', $display_name);
                                            $display_name = str_replace('Extraction-Metagenome', 'ExM', $display_name);
                                            $display_name = str_replace('Hemoflow', 'HF', $display_name);
                                            $display_name = str_replace('Microbial-Source-Tracking', 'MST', $display_name);
                                            $display_name = str_replace('Moisture_content', 'Mst', $display_name);
                                            $display_name = str_replace('Salmonella-Biosolids', 'SB', $display_name);
                                            $display_name = str_replace('Salmonella-Hemoflow', 'SHF', $display_name);
                                            $display_name = str_replace('Salmonella-Liquids', 'SL', $display_name);
                                            $display_name = str_replace('Salmonella-P/A', 'SPA', $display_name);
                                            $display_name = str_replace('Sequencing', 'Seq', $display_name);
                                            $display_name = str_replace('Protozoa', 'Ptz', $display_name);
                                            
                                            // Micro compact units - only essential info
                                            $short_units = '';
                                            if ($units && $units !== '-') {
                                                // Extreme abbreviations
                                                $short_units = str_replace('MPN/100 mL', 'M/100', $units);
                                                $short_units = str_replace('MPN/g dw', 'M/g', $short_units);
                                                $short_units = str_replace('copies/L', 'c/L', $short_units);
                                                $short_units = str_replace('copies/g dw', 'c/g', $short_units);
                                                $short_units = str_replace('CFU/100 mL', 'C/100', $short_units);
                                                $short_units = str_replace('% moisture', '%', $short_units);
                                                $short_units = str_replace('Positive/Negative', 'P/N', $short_units);
                                                $short_units = str_replace('Detected/Not Detected', 'D/N', $short_units);
                                                // Max 4 characters for units
                                                if (strlen($short_units) > 4) {
                                                    $short_units = substr($short_units, 0, 4);
                                                }
                                            }
                                            
                                            // Show only testing name, units in parentheses if space allows
                                            echo $display_name . ($short_units && strlen($short_units) <= 4 ? '(' . $short_units . ')' : '');
                                            ?>
                                        </th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($samples as $sample_id => $sample_data): ?>
                                <tr>
                                    <td style="border:1px solid #3c8dbc; padding: 3px 2px; font-weight: bold; text-align: left; font-size: 6pt; max-width: 70px; word-break: break-word;"><?php echo $sample_id; ?></td>
                                    <?php foreach ($all_testing_types as $testing_type): ?>
                                        <td style="border:1px solid #3c8dbc; padding: 2px 1px; text-align: center; font-size: 6pt; max-width: 50px; word-break: break-word;">
                                            <?php 
                                            if (isset($sample_data[$testing_type])) {
                                                $value = $sample_data[$testing_type]['value'];
                                                
                                                // Special formatting untuk Protozoa data
                                                if ($testing_type === 'Protozoa' && $value !== '-') {
                                                    // Format original: Giardia/L: <0.03 | Crypto/L: - | Giardia/g: 4 | Crypto/g: -
                                                    // Format baru: G/L:<0.03 C/L:- G/g:4 C/g:-
                                                    $compact_value = $value;
                                                    $compact_value = str_replace('Giardia/', 'G/', $compact_value);
                                                    $compact_value = str_replace('Crypto/', 'C/', $compact_value);
                                                    $compact_value = str_replace(': ', ':', $compact_value);
                                                    $compact_value = str_replace(' | ', ' ', $compact_value);
                                                    $compact_value = str_replace('|', '', $compact_value);
                                                    echo $compact_value;
                                                } else {
                                                    echo $value;
                                                }
                                            } else {
                                                echo '-';
                                            }
                                            ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
        
    <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            var id_project = $('#id_project').val();
            var report_number_to_save = $('#generated_report_number_val').val();
            var report_date_to_save = $('#generated_report_date_val').val();

            // Handle Print button click
            $('#print').on('click', function() {
                var btn = $(this);
                btn.prop('disabled', true).text('Printing...'); 
                if (report_number_to_save !== '' && report_date_to_save !== '') {
                    $.ajax({
                        url: '<?php echo site_url("Sample_reception/save_report_details_ajax"); ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id_project: id_project,
                            report_number: report_number_to_save,
                            report_date: report_date_to_save 
                        },
                        success: function(response) {
                            console.log('AJAX Success:', response);
                            if (response.status === 'success' || response.status === 'info') {
                                $('#display_report_number').text(report_number_to_save);
                                $('#display_report_date').text(report_date_to_save);
                                
                                document.title = '<?php echo 'Print_OWL_Report_';?>' + id_project;
                                window.print();
                            } else {
                                alert('Failed to save report details: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                            alert('An error occurred while saving report details. Please try again. (' + status + ')');
                        },
                        complete: function() {
                            btn.prop('disabled', false).html('<i class="fa fa-print"></i> Print');
                        }
                    });
                } else {
                    document.title = '<?php echo 'Print_OWL_Report_';?>' + id_project;
                    window.print();
                    btn.prop('disabled', false).html('<i class="fa fa-print"></i> Print');
                }
            });


        });
    </script>
</body>
</html>