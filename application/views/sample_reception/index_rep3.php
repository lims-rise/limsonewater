<!DOCTYPE html>
<html>
<head>
    <title>Print OWL Report 2 - <?php echo 'Print_OWL_Report2_'.$id_project; ?></title>
    
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
        .microbial-note {
            margin: 8px 0 18px;
            font-size: 8.5pt;
            line-height: 1.5;
            color: #333;
            text-align: justify;
        }
        .microbial-note .note-title {
            display: block;
            margin-bottom: 4px;
            font-weight: bold;
        }
        .microbial-note .note-list {
            margin: 0;
            padding-left: 20px;
        }
        .microbial-note .note-list li {
            margin: 2px 0;
        }
        .microbial-note strong {
            font-weight: bold;
        }

        .mst-summary-page {
            margin-top: 10px;
        }
        .print-page-header {
            min-height: 50px;
            overflow: hidden;
            margin-bottom: 10px;
        }
        .mst-page-title {
            clear: both;
            margin: 0 0 25px 0;
            text-align: center;
            font-weight: 700;
            font-size: 22px;
        }
        .mst-sample-block {
            margin-bottom: 28px;
        }
        .mst-sample-title {
            margin: 0 0 20px 0;
            text-align: center;
            font-size: 18px;
            font-weight: 700;
        }
        .mst-chart-row {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 60px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }
        .mst-chart-col {
            width: 360px;
            text-align: center;
        }
        .mst-chart-label {
            font-size: 12pt;
            font-weight: 600;
            margin-bottom: 12px;
            text-align: center;
        }
        .mst-pie {
            width: 240px;
            height: 240px;
            border-radius: 50%;
            margin: 0 auto 12px auto;
            box-shadow: inset 0 0 0 1px rgba(0,0,0,0.1);
            position: relative;
            background: #dfeaf1;
            overflow: visible;
        }
        .mst-pie-svg {
            width: 100%;
            height: 100%;
            display: block;
            overflow: visible;
        }
        .mst-pie-label-text {
            fill: #24313a;
            font-size: 7px;
            font-weight: 700;
            pointer-events: none;
            text-anchor: middle;
            dominant-baseline: middle;
        }
        .mst-pie-label-text.light {
            fill: #ffffff;
        }
        .mst-pie-label-text.small {
            font-size: 5.5px;
        }
        .mst-pie-label-line {
            display: block;
        }
        .mst-pie-slice {
            cursor: pointer;
            transition: transform 0.2s ease, filter 0.2s ease, opacity 0.2s ease;
            transform-origin: center;
            transform-box: fill-box;
            opacity: 0.96;
        }
        .mst-pie-slice:hover,
        .mst-pie-slice.is-active {
            filter: brightness(1.08) saturate(1.16);
            opacity: 1;
            transform: scale(1.04);
        }
        .mst-pie-tooltip {
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translateX(-50%) translateY(-6px);
            background: rgba(35, 43, 52, 0.92);
            color: #fff;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 8.5pt;
            line-height: 1.35;
            white-space: nowrap;
            box-shadow: 0 4px 10px rgba(0,0,0,0.18);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease, transform 0.2s ease;
            z-index: 10;
        }
        .mst-pie-tooltip.visible {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
        .mst-pie-label {
            font-weight: 600;
            font-size: 11pt;
            text-align: center;
        }
        .mst-chart-legend {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px 18px;
            margin-top: 8px;
            font-size: 10.5pt;
        }
        .mst-legend-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }
        .mst-legend-swatch {
            width: 12px;
            height: 12px;
            border-radius: 2px;
            display: inline-block;
            border: 1px solid rgba(0,0,0,0.1);
        }
        .mst-result-title {
            display: inline-block;
            min-width: 220px;
            text-align: center;
            font-size: 13pt;
            font-weight: 700;
            margin: 6px 20px 0 20px;
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
        position: relative;
    }
    .content-wrapper {
        break-inside: avoid;
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
    .mst-summary-page {
        page-break-before: always;
        break-before: page;
    }
    .mst-chart-row {
        display: flex !important;
        justify-content: center !important;
        gap: 26px !important;
        flex-wrap: nowrap !important;
    }
    .mst-chart-col {
        width: 45% !important;
    }
    .mst-pie {
        width: 180px !important;
        height: 180px !important;
    }
    .mst-pie-tooltip {
        display: none !important;
    }
    .mst-chart-legend {
        font-size: 8.5pt !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-wrap: wrap !important;
        color-adjust: exact !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    .mst-legend-item {
        display: inline-flex !important;
        align-items: center !important;
        white-space: nowrap !important;
        page-break-inside: avoid;
    }
    .mst-legend-swatch {
        color-adjust: exact !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    .box-body > div[style*="display: flex"] {
        display: block !important;
    }
    .box-body > div[style*="width: 49%"], .box-body > div[style*="width: 30%"] {
        width: 100% !important;
    }
    
    /* Exception: Keep signature section horizontal */
    .box-body > div[style*="margin-top: 30px"][style*="display: flex"] {
        display: flex !important;
        justify-content: space-between !important;
    }
    
    .box-body > div[style*="margin-top: 30px"] > div[style*="width: 45%"] {
        width: 45% !important;
        text-align: center !important;
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

    /* Logo footer untuk print */
    .logo-footer-print {
        display: block !important;
        position: absolute;
        top: 268mm;
        left: 0mm;
        z-index: 99999;
    }
    
    .logo-footer-print img {
        height: 35px;
        width: auto;
    }
    </style>
</head>
<body>

    <div class="logo-footer-print">
        <img src="../../../img/bsi.jpeg" alt="BSI Logo">
    </div>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible" style="margin: 10px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Error!</h4>
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

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
                                                <span class="temporary-indicator noprint" style="color: #f39c12; font-size: 9px; margin-left: 5px; vertical-align: baseline; line-height: 1.4;"></span>
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
                                                <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4; white-space: nowrap;" align="left"><?php echo ($index === 0) ? 'Analyst(s)' : ''; ?></td>
                                                <td width="40%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4;" align="left"><?php echo htmlspecialchars($analyst_name); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td width="60%" style="border:0px solid black; padding: 2px 0; vertical-align: top; line-height: 1.4; white-space: nowrap;" align="left">Analyst(s)</td>
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

    <!-- Page 2: Sample Details -->
    <div class="content-wrapper page-break">
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <img src="../../../img/monash.png" height="40px" class="icon" style="padding: 0px; float: left;">
                    <img src="../../../img/onewaterlogo.png" height="40px" class="icon" style="padding: 0px; float: right;">
                </div>
                <div class="box-body">
                    <div style="position: relative; height: 8px; margin-bottom: 5px;">
                        <img src="../../../img/bluebar.png" 
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 10%; object-fit: cover; z-index: 0;" 
                            alt="Background" />
                    </div>

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

    <!-- Page 2.5: Microbial Source Tracking Results -->
    <?php if ($has_microbial_data && !empty($microbial_tables)): ?>
    <div class="content-wrapper page-break">
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <img src="../../../img/monash.png" height="40px" class="icon" style="padding: 0px; float: left;">
                    <img src="../../../img/onewaterlogo.png" height="40px" class="icon" style="padding: 0px; float: right;">
                </div>
                <div class="box-body">
                    <div style="position: relative; height: 8px; margin-bottom: 5px;">
                        <img src="../../../img/bluebar.png" 
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 10%; object-fit: cover; z-index: 0;" 
                            alt="Background" />
                    </div>

                    <div style="display: flex; justify-content: space-between; width: 100%; margin-bottom: 5px;">
                        <div style="width: 30%;">
                            <table id="report-header" width="100%" style="border:0px solid black; margin-bottom: 3px; border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <td width="50%" style="border:0px solid black; padding: 2px 0; vertical-align: top;" align="left"><b>Microbial Source Tracking Results</b></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    
                    <?php
                    // Group samples columns - get unique sample IDs
                    $sample_ids = array();
                    foreach ($microbial_tables as $table_name => $rows) {
                        foreach ($rows as $row) {
                            if (!in_array($row['id_one_water_sample'], $sample_ids)) {
                                $sample_ids[] = $row['id_one_water_sample'];
                            }
                        }
                    }
                    sort($sample_ids);
                    
                    // Process each table - use actual table names from database
                    $table_mapping = array(
                        'Table 1 - Human-specific' => 'Human-specific contribution within total microbial community',
                        'Table 2 - Faecal-specific' => 'Faecal-specific contribution within total microbial community',
                        'Table 3 - Faecal-source' => 'Faecal-source contribution within faecal component of microbial community'
                    );
                    
                    foreach ($table_mapping as $table_key => $table_title):
                        if (isset($microbial_tables[$table_key])):
                            $table_data = $microbial_tables[$table_key];
                            
                            // Organize data by source_name
                            $sources_data = array();
                            foreach ($table_data as $row) {
                                $source = $row['source_name'];
                                $sample = $row['id_one_water_sample'];
                                $value = $row['percentage_value'];
                                
                                if (!isset($sources_data[$source])) {
                                    $sources_data[$source] = array();
                                }
                                $sources_data[$source][$sample] = $value;
                            }
                            
                            // Sort sources alphabetically (A-Z)
                            ksort($sources_data);

                            $note_text = '';
                            if ($table_key === 'Table 1 - Human-specific') {
                                $note_text = "<span class='note-title'>Note for interpretation of microbial community contribution report(s):</span>
<ol class='note-list'>
<li>Values displayed represent significant relative median microbial community contribution (relative standard deviation <100%). The results were taken as the average of five replicate analytical runs.</li>
<li>Values with relative standard deviation ≥100% were deemed non-significant result, and therefore omitted from the report.</li>
<li>Values were rounded off to the nearest 2 decimal places, including those labelled as 0.00% (where applicable).</li>
<li>Unknown represents the proportion of microbial community which are not allocated to the defined source under investigation (i.e., microbial communities not of human faecal-origin).</li>
</ol>";
                            } elseif ($table_key === 'Table 2 - Faecal-specific') {
                                $note_text = "<span class='note-title'>Note for interpretation of microbial community contribution report(s):</span>
<ol class='note-list'>
<li>Values displayed represent significant relative median microbial community contribution (relative standard deviation <100%) at two decimal places. The results were taken as the average of five replicate analytical runs.</li>
<li>Values with relative standard deviation ≥100% were deemed non-significant result, and therefore omitted from the report.</li>
<li>Values were rounded off to the nearest 2 decimal places, including those labelled as 0.00% (where applicable).</li>
<li>Unknown represents the proportion of microbial community which cannot be allocated to any of the defined source (i.e., microbial communities not of faecal-origin).</li>
</ol>";
                            } elseif ($table_key === 'Table 3 - Faecal-source') {
                                $note_text = "<span class='note-title'>Note for faecal community contribution report(s):</span>
<ol class='note-list'>
<li>Values displayed represent significant relative median faecal community contribution (relative standard deviation <100%). The results were taken as the average of five replicate analytical runs.</li>
<li>Values with relative standard deviation ≥100% were deemed non-significant result, and therefore omitted from the report.</li>
<li>Values were rounded-off to the nearest 2 decimal places, including those labelled as 0.00% (where applicable).</li>
<li>Faecal community contribution represents normalised microbial community contribution from faecal-origin sources. The faecal community contribution from each source was calculated by taking the median microbial community contribution of the source of interest, divided by the sum of all the microbial community contributions, excluding the microbial community contribution from unknown sources.</li>
</ol>";
                            }
                    ?>
                    
                    <div style="margin-bottom: 20px; page-break-inside: avoid;">
                        <h4 style="margin-bottom: 8px; font-size: 11pt; font-weight: bold;"><?php echo $table_key . ' - ' . $table_title; ?>:</h4>
                        <table class="report-table" style="width: 100%; border-collapse: collapse; font-size: 9pt;">
                            <thead>
                                <tr style="background-color: #f0f0f0;">
                                    <th style="border: 1px solid #ddd; padding: 6px; text-align: left; font-weight: bold;">Sources</th>
                                    <?php foreach ($sample_ids as $sample_id): ?>
                                        <th style="border: 1px solid #ddd; padding: 6px; text-align: center; font-weight: bold;"><?php echo htmlspecialchars($sample_id); ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sources_data as $source_name => $sample_values): ?>
                                <tr>
                                    <td style="border: 1px solid #ddd; padding: 6px; text-align: left;"><?php echo htmlspecialchars($source_name); ?></td>
                                    <?php foreach ($sample_ids as $sample_id): ?>
                                        <td style="border: 1px solid #ddd; padding: 6px; text-align: center;">
                                            <?php 
                                            if (isset($sample_values[$sample_id])) {
                                                $value = $sample_values[$sample_id];
                                                // Add % symbol if value is not "-"
                                                if ($value !== '-' && $value !== '' && $value !== null) {
                                                    echo htmlspecialchars($value) . '%';
                                                } else {
                                                    echo htmlspecialchars($value);
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
                        <?php if (!empty($note_text)): ?>
                            <div class="microbial-note"><?php echo $note_text; ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <?php 
                        endif;
                    endforeach; 
                    ?>
                </div>
            </div>
        </section>
    </div>
    <?php endif; ?>

    <?php
    $mst_summary_samples = array();
    if ($has_microbial_data && !empty($microbial_tables)) {
        $sample_ids = array();
        foreach ($microbial_tables as $table_rows) {
            foreach ($table_rows as $row) {
                if (!empty($row['id_one_water_sample']) && !in_array($row['id_one_water_sample'], $sample_ids, true)) {
                    $sample_ids[] = $row['id_one_water_sample'];
                }
            }
        }
        sort($sample_ids);

        $source_palette = array(
            'Bat' => '#B7D7E8',
            'Cat' => '#30AFFF',
            'Dog' => '#66A3BF',
            'Human' => '#FFBEFB',
            'Bird' => '#FFEA88',
            'Pig' => '#F599C6',
            'Sheep' => '#A2AB73',
            'Horse' => '#B9D175',
            'Cow' => '#2C5745',
            'Goat' => '#D96868',
            'Duck' => '#A290B7',
            'Chicken' => '#76C457',
            'Fox' => '#2BBBD7',
            'Deer' => '#70FFD2',
            'Kangaroo' => '#CDB4DB',
            'Possum' => '#E8C7A8',
            'Rabbit' => '#F2B5D4',
            'Rat' => '#6AECE1',
            'Unknown' => '#F9DFDF',
            'Wallaby' => '#FEEAC9',
            'Waterbird' => '#FF5656',
            'Wombat' => '#FFE4EF',
            'Non-significant results' => '#B6AE9F',
            'default' => '#B6CEB4'
        );

        $source_palette_normalized = array();
        foreach ($source_palette as $palette_label => $palette_color) {
            $source_palette_normalized[strtolower(trim($palette_label))] = $palette_color;
        }

        $build_pie_slices = function ($rows, $fill_unknown_remainder = true) use ($source_palette, $source_palette_normalized) {
            $entries = array();
            $sum = 0.0;

            foreach ($rows as $row) {
                $value = isset($row['percentage_value']) ? (float) $row['percentage_value'] : 0.0;
                if ($value > 0 || (isset($row['source_name']) && strtolower(trim($row['source_name'])) === 'unknown')) {
                    $label = isset($row['source_name']) ? trim($row['source_name']) : 'Unknown';
                    $normalized_label = strtolower($label);
                    if (!isset($entries[$normalized_label])) {
                        $entries[$normalized_label] = array(
                            'label' => $label,
                            'value' => 0.0,
                            'color' => isset($source_palette[$label]) ? $source_palette[$label] : (isset($source_palette_normalized[$normalized_label]) ? $source_palette_normalized[$normalized_label] : $source_palette['default']),
                        );
                    }
                    $entries[$normalized_label]['value'] += $value;
                    $sum += $value;
                }
            }

            $entries = array_values($entries);

            if ($sum <= 0 && empty($entries)) {
                return array(array('label' => 'No data', 'value' => 100, 'color' => '#dfe7ee'));
            }

            if ($fill_unknown_remainder && $sum < 100 && !empty($entries)) {
                $has_unknown = false;
                foreach ($entries as $entry) {
                    if (strtolower($entry['label']) === 'unknown') {
                        $has_unknown = true;
                        break;
                    }
                }
                if (!$has_unknown) {
                    $entries[] = array('label' => 'Unknown', 'value' => 100 - $sum, 'color' => $source_palette['Unknown']);
                    $sum = 100;
                }
            }

            return $entries;
        };

        $create_pie_gradient = function ($rows) use ($source_palette) {
            $entries = array();
            $sum = 0.0;

            foreach ($rows as $row) {
                $value = isset($row['percentage_value']) ? (float) $row['percentage_value'] : 0.0;
                if ($value > 0 || (isset($row['source_name']) && strtolower($row['source_name']) === 'unknown')) {
                    $entries[] = array(
                        'label' => isset($row['source_name']) ? trim($row['source_name']) : 'Unknown',
                        'value' => $value,
                    );
                    $sum += $value;
                }
            }

            if ($sum <= 0 && empty($entries)) {
                return 'conic-gradient(#dfe7ee 0 100%)';
            }

            if ($sum < 100 && !empty($entries)) {
                $has_unknown = false;
                foreach ($entries as $entry) {
                    if (strtolower($entry['label']) === 'unknown') {
                        $has_unknown = true;
                        break;
                    }
                }
                if (!$has_unknown) {
                    $entries[] = array('label' => 'Unknown', 'value' => 100 - $sum);
                    $sum = 100;
                }
            }

            $gradient = array();
            $cursor = 0;
            foreach ($entries as $index => $entry) {
                $label = $entry['label'];
                $value = ($sum > 0) ? (float) $entry['value'] : 0.0;
                $angle = ($value / max($sum, 1)) * 360;
                $color = isset($source_palette[$label]) ? $source_palette[$label] : (isset($source_palette[$index]) ? $source_palette[$index] : $source_palette['default']);
                $end = $cursor + $angle;
                $gradient[] = $color . ' ' . $cursor . 'deg ' . $end . 'deg';
                $cursor = $end;
            }

            return 'conic-gradient(' . implode(', ', $gradient) . ')';
        };

        foreach ($sample_ids as $sample_id) {
            $table2_rows = array();
            $table3_rows = array();

            if (isset($microbial_tables['Table 2 - Faecal-specific'])) {
                foreach ($microbial_tables['Table 2 - Faecal-specific'] as $row) {
                    if (isset($row['id_one_water_sample']) && $row['id_one_water_sample'] === $sample_id) {
                        $table2_rows[] = $row;
                    }
                }
            }

            if (isset($microbial_tables['Table 3 - Faecal-source'])) {
                foreach ($microbial_tables['Table 3 - Faecal-source'] as $row) {
                    if (isset($row['id_one_water_sample']) && $row['id_one_water_sample'] === $sample_id) {
                        $table3_rows[] = $row;
                    }
                }
            }

            if (!empty($table2_rows) || !empty($table3_rows)) {
                $mst_summary_samples[] = array(
                    'id' => $sample_id,
                    'table2' => $table2_rows,
                    'table3' => $table3_rows,
                    'table2_slices' => $build_pie_slices($table2_rows),
                    'table3_slices' => $build_pie_slices($table3_rows, false),
                    'table2_pie' => $create_pie_gradient($table2_rows),
                    'table3_pie' => $create_pie_gradient($table3_rows),
                );
            }
        }
    }
    ?>

    <?php if (!empty($mst_summary_samples)): ?>
    <div class="content-wrapper page-break mst-summary-page">
        <section class="content">
            <div class="box box-primary">
                <br>
                <div class="print-page-header">
                    <img src="../../../img/monash.png" height="50px" class="icon" style="padding: 0px; float: left;">
                    <img src="../../../img/onewaterlogo.png" height="40px" class="icon" style="padding: 0px; float: right;">
                </div>
                <div class="box-body">
                    <div class="mst-page-title">How to interpret results:</div>

                    <?php foreach ($mst_summary_samples as $summary): ?>
                        <div class="mst-sample-block">
                            <div class="mst-sample-title">MST results for sample <?php echo htmlspecialchars($summary['id']); ?></div>

                            <div class="mst-chart-row">
                                <div class="mst-chart-col">
                                    <div class="mst-chart-label">Microbial community contribution</div>
                                    <div class="mst-pie" data-slices='<?php echo htmlspecialchars(json_encode($summary['table2_slices']), ENT_QUOTES, 'UTF-8'); ?>'>
                                        <svg class="mst-pie-svg" viewBox="0 0 240 240" role="img" aria-label="Microbial community contribution pie chart"></svg>
                                        <div class="mst-pie-tooltip">Hover a slice</div>
                                    </div>
                                    <div class="mst-pie-label">Table 2 Results</div>
                                    <div class="mst-chart-legend">
                                        <?php
                                        foreach ($summary['table2_slices'] as $slice):
                                            $label = isset($slice['label']) ? $slice['label'] : 'No data';
                                            $display = $label;
                                            $color = isset($slice['color']) ? $slice['color'] : '#dfe7ee';
                                        ?>
                                            <span class="mst-legend-item"><span class="mst-legend-swatch" style="background-color: <?php echo htmlspecialchars($color, ENT_QUOTES, 'UTF-8'); ?> !important;"></span><?php echo htmlspecialchars($display); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="mst-chart-col">
                                    <div class="mst-chart-label">Faecal community contribution</div>
                                    <div class="mst-pie" data-slices='<?php echo htmlspecialchars(json_encode($summary['table3_slices']), ENT_QUOTES, 'UTF-8'); ?>'>
                                        <svg class="mst-pie-svg" viewBox="0 0 240 240" role="img" aria-label="Faecal community contribution pie chart"></svg>
                                        <div class="mst-pie-tooltip">Hover a slice</div>
                                    </div>
                                    <div class="mst-pie-label">Table 3 Results</div>
                                    <div class="mst-chart-legend">
                                        <?php
                                        foreach ($summary['table3_slices'] as $slice):
                                            $label = isset($slice['label']) ? $slice['label'] : 'No data';
                                            $display = $label;
                                            $color = isset($slice['color']) ? $slice['color'] : '#dfe7ee';
                                        ?>
                                            <span class="mst-legend-item"><span class="mst-legend-swatch" style="background-color: <?php echo htmlspecialchars($color, ENT_QUOTES, 'UTF-8'); ?> !important;"></span><?php echo htmlspecialchars($display); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </div>
    <?php endif; ?>

    <script src="<?php echo base_url('assets/adminlte/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

    <script>
        function polarToCartesian(centerX, centerY, radius, angleInDegrees) {
            var angleInRadians = (angleInDegrees - 90) * Math.PI / 180.0;
            return {
                x: centerX + (radius * Math.cos(angleInRadians)),
                y: centerY + (radius * Math.sin(angleInRadians))
            };
        }

        function describePieSlice(cx, cy, r, startAngle, endAngle) {
            var start = polarToCartesian(cx, cy, r, endAngle);
            var end = polarToCartesian(cx, cy, r, startAngle);
            var largeArcFlag = endAngle - startAngle <= 180 ? "0" : "1";

            return [
                "M", cx, cy,
                "L", start.x, start.y,
                "A", r, r, 0, largeArcFlag, 0, end.x, end.y,
                "Z"
            ].join(' ');
        }

        function renderPieChart(container) {
            var slices = [];

            try {
                slices = JSON.parse(container.dataset.slices || '[]');
            } catch (error) {
                slices = [];
            }

            var svg = container.querySelector('.mst-pie-svg');
            var tooltip = container.querySelector('.mst-pie-tooltip');

            if (!svg || !slices.length) {
                svg.innerHTML = '';
                return;
            }

            var total = slices.reduce(function(sum, item) {
                return sum + Number(item.value || 0);
            }, 0);

            svg.innerHTML = '';

            var currentAngle = 0;
            slices.forEach(function(item) {
                var value = Number(item.value || 0);
                var angle = total > 0 ? (value / total) * 360 : 0;
                var slice = angle >= 359.999 ? document.createElementNS('http://www.w3.org/2000/svg', 'circle') : document.createElementNS('http://www.w3.org/2000/svg', 'path');
                if (angle >= 359.999) {
                    slice.setAttribute('cx', '120');
                    slice.setAttribute('cy', '120');
                    slice.setAttribute('r', '90');
                } else {
                    slice.setAttribute('d', describePieSlice(120, 120, 90, currentAngle, currentAngle + angle));
                }
                slice.setAttribute('fill', item.color || '#dfe7ee');
                slice.setAttribute('stroke', '#ffffff');
                slice.setAttribute('stroke-width', '2');
                slice.setAttribute('class', 'mst-pie-slice');
                slice.setAttribute('data-label', item.label || 'Unknown');
                slice.setAttribute('data-value', (value || 0).toFixed(2) + '%');

                slice.addEventListener('mouseenter', function() {
                    if (!tooltip) return;
                    tooltip.textContent = this.getAttribute('data-label') + ': ' + this.getAttribute('data-value');
                    tooltip.classList.add('visible');
                });

                slice.addEventListener('mouseleave', function() {
                    if (!tooltip) return;
                    tooltip.classList.remove('visible');
                });

                slice.addEventListener('focus', function() {
                    if (!tooltip) return;
                    tooltip.textContent = this.getAttribute('data-label') + ': ' + this.getAttribute('data-value');
                    tooltip.classList.add('visible');
                });

                slice.addEventListener('blur', function() {
                    if (!tooltip) return;
                    tooltip.classList.remove('visible');
                });

                slice.setAttribute('tabindex', '0');
                svg.appendChild(slice);

                if (angle >= 12) {
                    var labelAngle = currentAngle + (angle / 2);
                    var labelRadius = angle >= 70 ? 62 : 74;
                    var labelPosition = polarToCartesian(120, 120, labelRadius, labelAngle);
                    var labelText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                    var labelName = item.label || 'Unknown';
                    var labelValue = (value || 0).toFixed(2) + '%';
                    var labelClass = angle < 25 ? 'mst-pie-label-text small' : 'mst-pie-label-text';
                    if (['#2C5745', '#66A3BF', '#A290B7', '#B6AE9F'].indexOf((item.color || '').toUpperCase()) >= 0) {
                        labelClass += ' light';
                    }
                    labelText.setAttribute('x', labelPosition.x);
                    labelText.setAttribute('y', labelPosition.y - 4);
                    labelText.setAttribute('class', labelClass);
                    labelText.appendChild(document.createTextNode(labelName));
                    var valueLine = document.createElementNS('http://www.w3.org/2000/svg', 'tspan');
                    valueLine.setAttribute('x', labelPosition.x);
                    valueLine.setAttribute('dy', '9');
                    valueLine.appendChild(document.createTextNode(labelValue));
                    labelText.appendChild(valueLine);
                    svg.appendChild(labelText);
                }
                currentAngle += angle;
            });

            var innerRing = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
            innerRing.setAttribute('cx', '120');
            innerRing.setAttribute('cy', '120');
            innerRing.setAttribute('r', '38');
            innerRing.setAttribute('fill', 'rgba(255,255,255,0.55)');
            innerRing.setAttribute('stroke', 'rgba(0,0,0,0.08)');
            innerRing.setAttribute('stroke-width', '1');
            svg.appendChild(innerRing);
        }

        $(document).ready(function() {
            $('.mst-pie').each(function() {
                renderPieChart(this);
            });

            var needs_ajax_save = <?php echo isset($needs_ajax_save) && $needs_ajax_save ? 'true' : 'false'; ?>;
            var is_temporary = <?php echo isset($is_temporary) && $is_temporary ? 'true' : 'false'; ?>;
            var id_project = $('#id_project').val();
            
            // Handle Test Print button click (no save to database)
            $('#print-test').on('click', function(e) {
                e.preventDefault();
                
                var btn = $(this);
                btn.prop('disabled', true).text('Printing...'); 
                
                // Print without saving to database (test print)
                document.title = '<?php echo 'Print_OWL_Report2_';?>' + id_project;
                window.print();
                
                btn.prop('disabled', false).html('<i class="fa fa-print"></i> Print (Test)');
                
                return false;
            });
            
            // Handle Final Print button click (save to database)
            $('#print-final').on('click', function() {
                var btn = $(this);
                btn.prop('disabled', true).text('Finalizing...'); 
                
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
                            
                            // Re-bind export CSV handler
                            bindExportCsvHandler();
                            
                            // Add new print handler for normal mode
                            $('#print').on('click', function() {
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

            $('#print').click(function () {
                // For finalized reports, just print
                document.title = '<?php echo 'Print_OWL_Report_';?>' + id_project;
                window.print();
                return false;
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
                
                return false;
            });

            $('#close').click(function () {
                window.close();
                return false;
            });

            // Function to bind export CSV handler
            function bindExportCsvHandler() {
                $('#export-csv').click(function() {
                    var id_project = $('#id_project').val();
                    if (id_project) {
                        // Show loading indicator
                        var originalText = $(this).text();
                        $(this).text('Exporting...').prop('disabled', true);
                        
                        // Use AJAX to check if data exists first
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo site_url('sample_reception/check_export_data/'); ?>' + id_project,
                            dataType: 'json',
                            success: function(response) {
                                if (response.has_data) {
                                    // Data exists, proceed with CSV export
                                    window.location.href = '<?php echo site_url('sample_reception/export_csv/'); ?>' + id_project;
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'No Data',
                                        text: 'No data found for this project. Cannot export CSV.'
                                    });
                                }
                            },
                            error: function() {
                                // If check fails, try direct export anyway
                                window.location.href = '<?php echo site_url('sample_reception/export_csv/'); ?>' + id_project;
                            },
                            complete: function() {
                                // Reset button state after a delay
                                setTimeout(function() {
                                    $('#export-csv').text(originalText).prop('disabled', false);
                                }, 2000);
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Missing Information',
                            text: 'Project ID not found. Cannot export CSV.'
                        });
                    }
                });
            }

            // Export to CSV functionality with better error handling
            bindExportCsvHandler();

            // Remove auto-save functionality - report details will only be generated when user prints
            // Auto save report details when page loads if they're generated - REMOVED
            // Generation now happens only when user actually prints the report
        });
    </script>

</body>
</html>
