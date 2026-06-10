<!DOCTYPE html>
<html>
<head>
    <title>Print OWL Report - <?php echo 'Print_OWL_Report_'.$id_project; ?></title>
    
    <!-- SweetAlert2 CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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
    
    /* Default page settings - Portrait untuk page 1 & 2 */
    @page {
        size: A4 portrait;
        margin: 10mm;
    }
    
    /* Landscape orientation khusus untuk page 3 (Analysis Results) - Kertas LEGAL */
    @page landscape-page {
        size: legal landscape;
        margin: 8mm;
    }
    
    /* Apply landscape ke page 3 */
    .content-wrapper:nth-child(4) {
        page: landscape-page;
    }
    .box-footer2, .noprint {
        display: none;
    }
    .temporary-indicator {
        display: none !important;
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
    
    /* Ensure consistent vertical alignment in Page 1 table */
    #project-info td {
        line-height: 1.4 !important;
        vertical-align: top !important;
        padding: 2px 0 !important;
        white-space: nowrap !important;
    }
    
    /* Add spacing between label and data columns - UI/UX best practice */
    #project-info td:first-child {
        padding-right: 30px !important;
        width: 60% !important;
    }
    
    #project-info td:last-child {
        padding-left: 10px !important;
        width: 40% !important;
        white-space: normal !important;
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
    
    /* --- TABEL ANALYSIS PRINT VIEW (LANDSCAPE OPTIMIZED) --- */
    .analysis-table-container {
        width: 100% !important;
        margin-bottom: 8px !important;
        overflow-x: visible !important;
        page-break-inside: avoid !important;
    }
    
    /* Styling tabel analysis untuk print - optimized untuk landscape */
    .analysis-table-container #analysis-results-table {
        width: 100% !important;
        border-collapse: collapse !important;
        font-size: 5.5pt !important; /* Reduced from 7pt */
        border: 1px solid #3c8dbc !important;
        margin: 10px 0 !important;
        page-break-inside: avoid !important;
        table-layout: auto !important; /* Allow dynamic column sizing */
    }
    
    /* Cell styling untuk print - optimized spacing */
    .analysis-table-container #analysis-results-table th,
    .analysis-table-container #analysis-results-table td {
        border: 1px solid #3c8dbc !important;
        padding: 3px 2px !important; /* Reduced padding */
        font-size: 5.5pt !important;
        vertical-align: middle !important;
        text-align: center !important;
        word-wrap: break-word !important;
        white-space: normal !important;
        max-width: 45px !important; /* Prevent overly wide columns */
        overflow: hidden !important;
        hyphens: auto !important; /* Enable hyphenation */
    }
    
    /* Sample column (first column) styling untuk print */
    .analysis-table-container #analysis-results-table th:first-child,
    .analysis-table-container #analysis-results-table td:first-child {
        text-align: left !important;
        font-weight: bold !important;
        font-size: 5.5pt !important;
        padding: 3px 2px !important;
        min-width: 60px !important; /* Ensure sample ID is readable */
        max-width: 80px !important;
    }
    
    /* Header styling untuk print - compact & readable */
    .analysis-table-container #analysis-results-table th {
        background-color: #f2f2f2 !important;
        font-weight: bold !important;
        font-size: 5pt !important; /* Reduced from 6pt */
        padding: 4px 2px !important;
        word-break: break-word !important;
        line-height: 1.05 !important; /* Tighter line height */
        writing-mode: horizontal-tb !important;
        text-orientation: initial !important;
        text-align: center !important;
        hyphens: auto !important;
        overflow-wrap: break-word !important;
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
    
    /* Hide Analysis Methods Overview section completely in print */
    .analysis-methods-overview {
        display: none !important;
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
        writing-mode: horizontal-tb !important;
        text-orientation: initial !important;
        text-align: center !important;
    }

    #analysis-results-table td:first-child, #analysis-results-table th:first-child {
        text-align: left !important;
        font-weight: bold !important;
        min-width: 80px !important;
        max-width: 100px !important;
        font-size: 7pt !important;
    }
    
    /* Legend table styling untuk screen */
    .legend-table {
        font-size: 7pt !important;
        border-collapse: collapse !important;
        width: 100% !important;
    }
    
    .legend-table th, .legend-table td {
        border: 0px solid #3c8dbc !important;
        padding: 3px 5px !important;
        font-size: 7pt !important;
    }
    
    .legend-table th {
        background-color: #f2f2f2 !important;
        font-weight: bold !important;
    }
    </style>
</head>
<body>

    <div class="logo-footer-print">
        <img src="../../../img/bsi.jpeg" alt="BSI Logo">
    </div>

    <div class="noprint">
        <div class="modal-footer clearfix">
            <?php if (isset($is_temporary) && $is_temporary): ?>
            <div style="float: left; color: white; font-size: 12px; line-height: 34px; margin-left: 235px;">
                <i class="fa fa-info-circle"></i> 
                <strong>Preview Mode:</strong> 
                Use "Finalize & Print" to assign permanent report number.
            </div>
            <?php endif; ?>
            
            <?php if (isset($is_temporary) && $is_temporary): ?>
                <button id='print-test' class="btn btn-info no-print"><i class="fa fa-print"></i> Print (Test)</button>
                <button id='print-final' class="btn btn-success no-print"><i class="fa fa-check"></i> Finalize & Print</button>
            <?php else: ?>
                <button id='print' class="btn btn-primary no-print"><i class="fa fa-print"></i> Print</button>
                <button id='reset-report' class="btn btn-warning no-print"><i class="fa fa-refresh"></i> Reset Report Number</button>
            <?php endif; ?>
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
                    
                    <div style="display: flex; justify-content: space-between; width: 100%; margin-bottom: 5px;">
                        <div style="width: 49%;">
                            <table id="project-info" width="100%" style="border:0px solid black; border-collapse: collapse;">
                                <tbody>
                                    <tr>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4; white-space: nowrap;" align="left">Report Number</td>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4;" align="left">
                                            <span id="display_report_number"><?php echo htmlspecialchars($report_number_display ?? ''); ?></span>
                                            <?php if (isset($is_temporary) && $is_temporary): ?>
                                                <span class="temporary-indicator noprint" style="color: #f39c12; font-size: 9px; margin-left: 5px; vertical-align: baseline; line-height: 1.4;">(Temporary - Final number assigned on print)</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4; white-space: nowrap;" align="left">Report issue date</td>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4;" align="left">
                                            <span id="display_report_date"><?php echo htmlspecialchars($report_date_display ?? ''); ?></span>
                                            <?php if (isset($is_temporary) && $is_temporary): ?>
                                                <span class="temporary-indicator noprint" style="color: #f39c12; font-size: 9px; margin-left: 5px;"></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border:0px solid black; padding: 4px 0;">
                                            <div style="width: 100%; border-top: 1px solid #ddd;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4; white-space: nowrap;" align="left">Project ID</td>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4;" align="left"><?php echo (!empty($id_project) && $id_project !== 'null') ? $id_project : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4; white-space: nowrap;" align="left">Client</td>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4;" align="left"><?php echo (!empty($client) && $client !== 'null') ? $client : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4; white-space: nowrap;" align="left">Client contact details</td>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4;" align="left"><?php echo (!empty($client_name) && $client_name !== 'null') ? $client_name : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4; white-space: nowrap;" align="left"></td>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4;" align="left"><?php echo (!empty($address) && $address !== 'null') ? $address : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4; white-space: nowrap;" align="left"></td>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4;" align="left"><?php echo (!empty($phone1) && $phone1 !== 'null') ? $phone1 : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4; white-space: nowrap;" align="left"></td>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4;" align="left"><?php echo (!empty($phone2) && $phone2 !== 'null') ? $phone2 : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4; white-space: nowrap;" align="left"></td>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4;" align="left"><?php echo (!empty($email) && $email !== 'null') ? $email : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4; white-space: nowrap;" align="left">Quote Number</td>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4;" align="left"><?php echo (!empty($client_quote_number) && $client_quote_number !== 'null') ? $client_quote_number : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4; white-space: nowrap;" align="left">PO Number</td>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4;" align="left"><?php echo (!empty($po_number) && $po_number !== 'null') ? $po_number : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4; white-space: nowrap;" align="left">Date of Sample Received</td>
                                        <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4;" align="left"><?php echo (!empty($from_date) && $from_date !== 'null' && !empty($to_date) && $to_date !== 'null') ? $from_date . "&nbsp &nbsp~&nbsp &nbsp" . $to_date : '-'; ?></td>
                                    </tr>
                                    <?php if (isset($analyst_names_array) && !empty($analyst_names_array)): ?>
                                        <?php foreach ($analyst_names_array as $index => $analyst_name): ?>
                                            <tr>
                                                <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4; white-space: nowrap;" align="left"><?php echo ($index === 0) ? 'Analysis' : ''; ?></td>
                                                <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4;" align="left"><?php echo htmlspecialchars($analyst_name); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4; white-space: nowrap;" align="left">Analysis</td>
                                            <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4;" align="left">No analyst assigned</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
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

                    <!-- Print orientation notice (only visible on screen) -->
                    <div class="noprint" style="background-color: #d9edf7; border: 1px solid #bce8f1; border-radius: 4px; padding: 8px 12px; margin-bottom: 10px; color: #31708f; font-size: 9pt;">
                        <i class="fa fa-info-circle"></i> <strong>Print Info:</strong> This page will be printed in <strong>Landscape orientation</strong> to fit all analysis columns.
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
                        
                        // Define allowed testing types for filtering - organized by microorganism
                        $allowed_testing_types = array(
                            // 🧫 Campylobacter group
                            'Campylobacter-Biosolids', 'Campylobacter-Liquids', 'Campylobacter-P/A',
                            'Campy-Hemoflow', 'Campy-Hemoflow-QPCR',
                            
                            // 🦠 E. coli group  
                            'Colilert-Idexx-Water', 'Colilert-Idexx-Biosolids', 'Colilert-Hemoflow',
                            
                            // 🧪 Enterococci group
                            'Enterolert-Idexx-Water', 'Enterolert-Idexx-Biosolids', 'Enterolert-Hemoflow',
                            
                            // 🧬 Salmonella group
                            'Salmonella-Biosolids', 'Salmonella-Liquids', 'Salmonella-P/A', 'Salmonella-Hemoflow',
                            
                            // 🩸 Hemoflow Volume
                            'Hemoflow',
                            
                            // 💧 Moisture Content
                            'Moisture_content',
                            
                            // 🧬 Protozoa qPCR
                            'Protozoa',
                            
                            // 🧬 Sequencing
                            'Sequencing',
                            
                            // 🧭 Microbial Source Tracking
                            'Microbial-Source-Tracking'
                        );
                        // Collect all unique testing types and organize data by sample
                        foreach ($response2 as $row2) {
                            $sample_id = $row2->id_one_water_sample;
                            $testing_type = $row2->testing_type;
                            
                            // Only process allowed testing types
                            if (!in_array($testing_type, $allowed_testing_types)) {
                                continue;
                            }
                            
                            // Store all unique testing types
                            if (!in_array($testing_type, $all_testing_types)) {
                                $all_testing_types[] = $testing_type;
                            }
                            
                            // Group by sample (only for allowed testing types)
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
                                        <th style="border:1px solid #3c8dbc; padding: 5px 3px; background-color: #f2f2f2; font-weight: bold; text-align: center; font-size: 6pt; line-height: 1.1; word-break: break-word;">
                                            <?php 
                                            // Get units for this testing type (only for allowed types)
                                            $units = '';
                                            foreach ($response2 as $row2) {
                                                if ($row2->testing_type == $testing_type && !empty($row2->units) 
                                                    && in_array($row2->testing_type, $allowed_testing_types)) {
                                                    $units = $row2->units;
                                                    break;
                                                }
                                            }
                                            
                                            // Enhanced display mapping with Parameter-Method/Sample-Units format
                                            // Use compact names for better fit in landscape print
                                            $display_mappings = array(
                                                // 🧫 Campylobacter group - Abbreviated
                                                'Campylobacter-Biosolids' => 'Campy-Biosolids',
                                                'Campylobacter-Liquids' => 'Campy-Liquids', 
                                                'Campylobacter-P/A' => 'Campy-P/A',
                                                'Campy-Hemoflow' => 'Campy-Hemoflow',
                                                'Campy-Hemoflow-QPCR' => 'Campy-Hemoflow (qPCR)',
                                                
                                                // 🦠 E. coli group - Keep standard names (already short)
                                                'Colilert-Idexx-Water' => 'Colilert-Idexx-Water',
                                                'Colilert-Idexx-Biosolids' => 'Colilert-Idexx-Biosolids',
                                                'Colilert-Hemoflow' => 'Colilert-Hemoflow',
                                                
                                                // 🧪 Enterococci group - Keep standard names
                                                'Enterolert-Idexx-Water' => 'Enterolert-Idexx-Water',
                                                'Enterolert-Idexx-Biosolids' => 'Enterolert-Idexx-Biosolids',
                                                'Enterolert-Hemoflow' => 'Enterolert-Hemoflow',
                                                
                                                // 🧬 Salmonella group - Abbreviated
                                                'Salmonella-Biosolids' => 'Salmo-Biosolids',
                                                'Salmonella-Liquids' => 'Salmo-Liquids',
                                                'Salmonella-P/A' => 'Salmo-P/A', 
                                                'Salmonella-Hemoflow' => 'Salmo-Hemoflow',
                                                
                                                // 🩸 Hemoflow Volume
                                                'Hemoflow' => 'Hemoflow',
                                                
                                                // 💧 Moisture Content
                                                'Moisture_content' => 'Moisture',
                                                
                                                // 🧬 Protozoa qPCR
                                                'Protozoa' => 'Protozoa',
                                                
                                                // 🧬 Sequencing
                                                'Sequencing' => 'Sequencing',
                                                
                                                // 🧭 Microbial Source Tracking
                                                'Microbial-Source-Tracking' => 'MST'
                                            );
                                            
                                            // Apply mapping - get mapped display name or use original
                                            $display_name = isset($display_mappings[$testing_type]) ? $display_mappings[$testing_type] : $testing_type;
                                            
                                            // Create header format: Parameter-Method/Sample (Units only)
                                            $header_with_units = $display_name;
                                            if ($units && $units !== '-') {
                                                // Extract only the actual units, remove parameter names
                                                $clean_units = $units;
                                                
                                                // Remove parameter names from units - extract only measurement units
                                                $clean_units = preg_replace('/^.*?\s+/', '', $clean_units); // Remove leading words
                                                $clean_units = str_replace('% moisture', '%', $clean_units);
                                                
                                                // Special handling for different testing types
                                                if ($testing_type === 'Protozoa') {
                                                    $clean_units = 'copies/L';
                                                } elseif (strpos($clean_units, 'Detected') !== false || strpos($clean_units, 'Positive') !== false) {
                                                    $clean_units = '–'; // For presence/absence tests
                                                } elseif (strpos($units, 'MPN') !== false) {
                                                    // Extract MPN units only
                                                    if (strpos($units, 'MPN/100 mL') !== false) {
                                                        $clean_units = 'MPN/100 mL';
                                                    } elseif (strpos($units, 'MPN/g dw') !== false) {
                                                        $clean_units = 'MPN/g dw';
                                                    } elseif (strpos($units, 'MPN/L') !== false) {
                                                        $clean_units = 'MPN/L';
                                                    }
                                                } elseif (strpos($units, 'copies') !== false) {
                                                    // Extract copies units only
                                                    if (strpos($units, 'copies/L') !== false) {
                                                        $clean_units = 'copies/L';
                                                    } elseif (strpos($units, 'copies/g dw') !== false) {
                                                        $clean_units = 'copies/g dw';
                                                    }
                                                } elseif ($testing_type === 'Hemoflow') {
                                                    $clean_units = 'L';
                                                } elseif ($testing_type === 'Moisture_content') {
                                                    $clean_units = '%';
                                                } elseif ($testing_type === 'Sequencing' || $testing_type === 'Microbial-Source-Tracking') {
                                                    $clean_units = '–';
                                                }
                                                
                                                // Add only clean units in parentheses
                                                $header_with_units = $display_name . ' (' . $clean_units . ')';
                                            }
                                            
                                            // Display the complete header
                                            echo $header_with_units;
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
                                                    $compact_value = str_replace('Giardia/', 'Giardia/', $compact_value);
                                                    $compact_value = str_replace('Crypto/', 'Cryptosporidium/', $compact_value);
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

                    <!-- Testing Types Information by Category -->
                    <div class="analysis-methods-overview" style="margin-top: 15px; page-break-inside: avoid;">
                        <h5 style="font-size: 9pt; font-weight: bold; margin-bottom: 8px;">Analysis Methods Overview:</h5>
                        <table class="legend-table" style="width: 100%; border: 0px solid #3c8dbc;">
                            <thead>
                                <tr>
                                    <th style="border: 1px solid #3c8dbc; padding: 3px 5px; background-color: #f2f2f2; font-weight: bold; text-align: left; width: 30%;">Category</th>
                                    <th style="border: 1px solid #3c8dbc; padding: 3px 5px; background-color: #f2f2f2; font-weight: bold; text-align: left; width: 50%;">Analysis Name</th>
                                    <th style="border: 1px solid #3c8dbc; padding: 3px 5px; background-color: #f2f2f2; font-weight: bold; text-align: left; width: 20%;">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Create comprehensive testing information by category
                                $testing_categories = array(
                                    '🧫 Campylobacter' => array(
                                        'Campylobacter-Biosolids' => array('name' => 'Campy Biosolids', 'method' => 'Biosolids', 'units' => 'MPN/g dw'),
                                        'Campylobacter-Liquids' => array('name' => 'Campy Liquids', 'method' => 'Liquids', 'units' => 'MPN/L'),
                                        'Campylobacter-P/A' => array('name' => 'Campy PA', 'method' => 'Presence/Absence', 'units' => '–'),
                                        'Campy-Hemoflow' => array('name' => 'Campy Hemoflow', 'method' => 'Hemoflow', 'units' => 'MPN/L'),
                                        'Campy-Hemoflow-QPCR' => array('name' => 'Campy qPCR Hemoflow', 'method' => 'Hemoflow (qPCR)', 'units' => 'copies/L')
                                    ),
                                    '🦠 E. coli' => array(
                                        'Colilert-Idexx-Water' => array('name' => 'Colilert Idexx – Water', 'method' => 'Water', 'units' => 'MPN/100 mL'),
                                        'Colilert-Idexx-Biosolids' => array('name' => 'Colilert Idexx – Biosolids', 'method' => 'Biosolids', 'units' => 'MPN/g dw'),
                                        'Colilert-Hemoflow' => array('name' => 'Colilert Hemoflow', 'method' => 'Hemoflow', 'units' => 'MPN/100 mL')
                                    ),
                                    '🧪 Enterococci' => array(
                                        'Enterolert-Idexx-Water' => array('name' => 'Enterolert Idexx – Water', 'method' => 'Water', 'units' => 'MPN/100 mL'),
                                        'Enterolert-Idexx-Biosolids' => array('name' => 'Enterolert Idexx – Biosolids', 'method' => 'Biosolids', 'units' => 'MPN/g dw'),
                                        'Enterolert-Hemoflow' => array('name' => 'Enterolert Hemoflow', 'method' => 'Hemoflow', 'units' => 'MPN/100 mL')
                                    ),
                                    '🧬 Salmonella' => array(
                                        'Salmonella-Biosolids' => array('name' => 'Salmonella Biosolids', 'method' => 'Biosolids', 'units' => 'MPN/g dw'),
                                        'Salmonella-Liquids' => array('name' => 'Salmonella Liquids', 'method' => 'Liquids', 'units' => 'MPN/L'),
                                        'Salmonella-P/A' => array('name' => 'Salmonella PA', 'method' => 'Presence/Absence', 'units' => '–'),
                                        'Salmonella-Hemoflow' => array('name' => 'Salmonella Hemoflow', 'method' => 'Hemoflow', 'units' => 'MPN/L')
                                    ),
                                    '🩸 Hemoflow' => array(
                                        'Hemoflow' => array('name' => 'Hemoflow', 'method' => 'Hemoflow', 'units' => 'L')
                                    ),
                                    '💧 Other Tests' => array(
                                        'Moisture_content' => array('name' => 'Moisture Content', 'method' => 'Standard', 'units' => '%'),
                                        'Protozoa' => array('name' => 'Protozoa qPCR', 'method' => 'qPCR', 'units' => 'copies/L'),
                                        'Sequencing' => array('name' => 'Sequencing', 'method' => '-', 'units' => '–'),
                                        'Microbial-Source-Tracking' => array('name' => 'Microbial Source Tracking', 'method' => 'MST', 'units' => '–')
                                    )
                                );
                                
                                foreach ($testing_categories as $category => $tests):
                                    $first_in_category = true;
                                    foreach ($tests as $test_key => $test_info):
                                        // Only show tests that are actually present in data
                                        if (in_array($test_key, $all_testing_types)):
                                ?>
                                <tr>
                                    <td style="border: 1px solid #3c8dbc; padding: 2px 5px; font-weight: <?php echo $first_in_category ? 'bold' : 'normal'; ?>;">
                                        <?php echo $first_in_category ? $category : ''; ?>
                                    </td>
                                    <td style="border: 1px solid #3c8dbc; padding: 2px 5px;"><?php echo $test_info['name']; ?></td>
                                    <td style="border: 1px solid #3c8dbc; padding: 2px 5px;"><?php echo $test_info['units']; ?></td>
                                </tr>
                                <?php
                                            $first_in_category = false;
                                        endif;
                                    endforeach;
                                endforeach;
                                ?>
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
            var needs_ajax_save = <?php echo isset($needs_ajax_save) && $needs_ajax_save ? 'true' : 'false'; ?>;

            // Dynamic font sizing based on column count for print optimization
            function optimizeTableForPrint() {
                var $table = $('#analysis-results-table');
                if ($table.length) {
                    var columnCount = $table.find('thead tr th').length;
                    
                    // Apply dynamic font sizing based on column count
                    // A4 Landscape can comfortably fit ~15-20 columns with 5.5pt font
                    if (columnCount > 20) {
                        // Many columns - use smallest readable font
                        $table.css('font-size', '4.5pt');
                        $table.find('th').css('font-size', '4pt');
                        $table.find('td, th').css('padding', '2px 1px');
                        $table.find('th, td').css('max-width', '35px');
                    } else if (columnCount > 15) {
                        // Medium columns - use reduced font
                        $table.css('font-size', '5pt');
                        $table.find('th').css('font-size', '4.5pt');
                        $table.find('td, th').css('padding', '2px 1.5px');
                        $table.find('th, td').css('max-width', '40px');
                    } else {
                        // Few columns - use standard print font
                        $table.css('font-size', '5.5pt');
                        $table.find('th').css('font-size', '5pt');
                        $table.find('td, th').css('padding', '3px 2px');
                        $table.find('th, td').css('max-width', '45px');
                    }
                    
                    console.log('Analysis table optimized for print: ' + columnCount + ' columns');
                }
            }

            // Optimize on page load
            optimizeTableForPrint();

            // Handle Test Print button click (no save to database)
            $('#print-test').on('click', function() {
                var btn = $(this);
                btn.prop('disabled', true).text('Printing...'); 
                
                // Re-optimize before print
                optimizeTableForPrint();
                
                // Print without saving to database (test print)
                document.title = '<?php echo 'Print_OWL_Report_';?>' + id_project;
                window.print();
                
                btn.prop('disabled', false).html('<i class="fa fa-print"></i> Print (Test)');
            });
            
            // Handle Final Print button click (save to database)
            $('#print-final').on('click', function() {
                var btn = $(this);
                btn.prop('disabled', true).text('Finalizing...'); 
                
                // Re-optimize before print
                optimizeTableForPrint();
                
                // Generate and save report number/date via AJAX
                $.ajax({
                    url: '<?php echo site_url("Sample_reception/save_report_details_ajax"); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id_project: id_project
                    },
                    success: function(response) {
                        console.log('AJAX Success:', response);
                        if (response.status === 'success' || response.status === 'info') {
                            // Update display with the generated/existing values
                            $('#display_report_number').text(response.report_number);
                            $('#display_report_date').text(response.report_date);
                            
                            // Remove temporary indicators
                            $('.temporary-indicator').remove();
                            
                            // Switch to normal print button mode
                            $('.modal-footer').html(
                                '<button id="print" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print</button>' +
                                '<button id="close" class="btn btn-warning" onclick="javascript:history.go(-1);"><i class="fa fa-times"></i> Close</button>'
                            );
                            
                            // Add new print handler for normal mode
                            $('#print').on('click', function() {
                                optimizeTableForPrint();
                                document.title = '<?php echo 'Print_OWL_Report_';?>' + id_project;
                                window.print();
                            });
                            
                            document.title = '<?php echo 'Print_OWL_Report_';?>' + id_project;
                            window.print();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Generation Failed',
                                text: response.message || 'Failed to finalize report details'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Network Error',
                            text: 'An error occurred while finalizing report details. Please try again.'
                        });
                    },
                    complete: function() {
                        btn.prop('disabled', false).html('<i class="fa fa-check"></i> Finalize & Print');
                    }
                });
            });

            // Handle Print button click (for already finalized reports)
            $('#print').on('click', function() {
                var btn = $(this);
                btn.prop('disabled', true).text('Printing...'); 
                
                // Re-optimize before print
                optimizeTableForPrint();
                
                // Report already finalized, just print
                document.title = '<?php echo 'Print_OWL_Report_';?>' + id_project;
                window.print();
                btn.prop('disabled', false).html('<i class="fa fa-print"></i> Print');
            });
            
            // Handle Reset Report Number button click
            $('#reset-report').on('click', function() {
                var btn = $(this);
                var currentReportNumber = $('#display_report_number').text();
                
                // Show SweetAlert confirmation dialog
                Swal.fire({
                    icon: 'warning',
                    title: 'Reset Report Number?',
                    html: `
                        <div style="text-align: left; margin: 15px 0;">
                            <p><strong>This action will:</strong></p>
                            <ul style="margin-left: 20px;">
                                <li>Remove the current report number (<strong>${currentReportNumber}</strong>)</li>
                                <li>Allow you to generate a new report number</li>
                                <li><strong style="color: #e74c3c;">This action cannot be undone</strong></li>
                            </ul>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonColor: '#f39c12',
                    cancelButtonColor: '#95a5a6',
                    confirmButtonText: 'Yes, Reset It!',
                    cancelButtonText: 'Cancel',
                    focusCancel: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading
                        Swal.fire({
                            icon: 'info',
                            title: 'Resetting...',
                            text: 'Please wait while we reset the report number',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        
                        btn.prop('disabled', true).text('Resetting...'); 
                        
                        // Call AJAX to reset report number
                        $.ajax({
                            url: '<?php echo site_url("Sample_reception/reset_report_number_ajax"); ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                id_project: id_project
                            },
                            success: function(response) {
                                console.log('Reset AJAX Success:', response);
                                if (response.status === 'success') {
                                    // Show success message then reload
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Reset Successful!',
                                        text: 'Report number has been reset. You can now generate a new report number.',
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        // Reload the page to show preview mode again
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Reset Failed',
                                        text: response.message || 'Failed to reset report number'
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Reset AJAX Error:', status, error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Network Error',
                                    text: 'An error occurred while resetting report number. Please try again.'
                                });
                            },
                            complete: function() {
                                btn.prop('disabled', false).html('<i class="fa fa-refresh"></i> Reset Report Number');
                            }
                        });
                    }
                });
            });


        });
    </script>
</body>
</html>