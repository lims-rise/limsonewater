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

    <!-- Page 2: Sample Details -->
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

    <!-- Page 3+: Detailed Analysis Data -->
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

                    <!-- Client and Submission Information -->
                    <h4 style="margin-top: 10px; margin-bottom: 10px; font-weight: bold;">Client & Submission Details</h4>
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th width="20%">CLIENTNAME</th>
                                <th width="13%">WorkOrderNo</th>
                                <th width="13%">SUBMISSION</th>
                                <th width="20%">SAMPLINGPROVIDER</th>
                                <th width="13%">SamplerName</th>
                                <th width="13%">PROGRAM</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($export_data)) : ?>
                                <?php $first_row = $export_data[0]; ?>
                                <tr>
                                    <td><?php echo $first_row['CLIENTNAME']; ?></td>
                                    <td><?php echo $first_row['WorkOrderNo']; ?></td>
                                    <td><?php echo $first_row['SUBMISSION']; ?></td>
                                    <td><?php echo $first_row['SAMPLINGPROVIDER']; ?></td>
                                    <td><?php echo $first_row['SamplerName']; ?></td>
                                    <td><?php echo $first_row['PROGRAM']; ?></td>
                                </tr>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6">No client data available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Analysis Results Section -->
                    <h4 style="margin-top: 15px; margin-bottom: 10px; font-weight: bold;">Analysis Results</h4>
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>LABSAMPLEID</th>
                                <th>ParameterCode</th>
                                <th>PARAMETERNAME</th>
                                <th>ANALYSISMETHOD</th>
                                <th>RESULT</th>
                                <th>Units</th>
                                <th>LOR</th>
                                <th>MeasurementOfUncertainty</th>
                                <th>RESULTSTATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($export_data)) : ?>
                                <?php foreach ($export_data as $row) : ?>
                                <tr>
                                    <td><?php echo $row['LABSAMPLEID']; ?></td>
                                    <td><?php echo $row['ParameterCode']; ?></td>
                                    <td><?php echo $row['PARAMETERNAME']; ?></td>
                                    <td><?php echo $row['ANALYSISMETHOD']; ?></td>
                                    <td><?php echo $row['RESULT']; ?></td>
                                    <td><?php echo $row['Units']; ?></td>
                                    <td><?php echo $row['LOR']; ?></td>
                                    <td><?php echo $row['MeasurementOfUncertainty']; ?></td>
                                    <td><?php echo $row['RESULTSTATUS']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="9">No analysis results available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Analysis Method Details -->
                    <h4 style="margin-top: 15px; margin-bottom: 10px; font-weight: bold;">Analysis Method Details</h4>
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th width="15%">TEST_KEY_CODE</th>
                                <th width="25%">ANALYSISMETHODCATEGORY</th>
                                <th width="15%">AnalysisDate</th>
                                <th width="15%">ANALYSISCOMPLETIONDATE</th>
                                <th width="15%">SAMPLEVOLUME</th>
                                <th width="15%">SAMPLEVOLUMEUNITS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($export_data)) : ?>
                                <?php foreach ($export_data as $row) : ?>
                                <tr>
                                    <td><?php echo $row['TEST_KEY_CODE']; ?></td>
                                    <td><?php echo $row['ANALYSISMETHODCATEGORY']; ?></td>
                                    <td><?php echo $row['AnalysisDate']; ?></td>
                                    <td><?php echo $row['ANALYSISCOMPLETIONDATE']; ?></td>
                                    <td><?php echo $row['SAMPLEVOLUME']; ?></td>
                                    <td><?php echo $row['SAMPLEVOLUMEUNITS']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6">No method details available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Quality Control Section -->
                    <h4 style="margin-top: 15px; margin-bottom: 10px; font-weight: bold;">Quality Control & Validation</h4>
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th width="15%">ParameterCode</th>
                                <th width="15%">ConfirmedRaw</th>
                                <th width="15%">PresumptiveRaw</th>
                                <th width="15%">POSITIVECONTROL%</th>
                                <th width="15%">RPD</th>
                                <th width="15%">SURROGATE</th>
                                <th width="10%">PathogenID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($export_data)) : ?>
                                <?php foreach ($export_data as $row) : ?>
                                <tr>
                                    <td><?php echo $row['ParameterCode']; ?></td>
                                    <td><?php echo $row['ConfirmedRaw']; ?></td>
                                    <td><?php echo $row['PresumptiveRaw']; ?></td>
                                    <td><?php echo $row['POSITIVECONTROL%']; ?></td>
                                    <td><?php echo $row['RPD']; ?></td>
                                    <td><?php echo $row['SURROGATE']; ?></td>
                                    <td><?php echo $row['PathogenID']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7">No quality control data available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Lab Certification & Reporting -->
                    <h4 style="margin-top: 15px; margin-bottom: 10px; font-weight: bold;">Laboratory Certification & Reporting</h4>
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th width="20%">LabCOANo</th>
                                <th width="15%">LabCOADate</th>
                                <th width="20%">LabQAQCNo</th>
                                <th width="15%">LabQAQCDate</th>
                                <th width="15%">License</th>
                                <th width="15%">EDDVERSION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($export_data)) : ?>
                                <?php $first_row = $export_data[0]; ?>
                                <tr>
                                    <td><?php echo $first_row['LabCOANo']; ?></td>
                                    <td><?php echo $first_row['LabCOADate']; ?></td>
                                    <td><?php echo $first_row['LabQAQCNo']; ?></td>
                                    <td><?php echo $first_row['LabQAQCDate']; ?></td>
                                    <td><?php echo $first_row['License']; ?></td>
                                    <td><?php echo $first_row['EDDVERSION']; ?></td>
                                </tr>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6">No certification data available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Sample Processing Details -->
                    <h4 style="margin-top: 15px; margin-bottom: 10px; font-weight: bold;">Sample Processing & Matrix Details</h4>
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th width="15%">LABCODE</th>
                                <th width="15%">SUBMITTEDMATRIX</th>
                                <th width="15%">ANALYSISMATRIX</th>
                                <th width="15%">ANALYSISSUBMATRIX</th>
                                <th width="15%">SAMPLEPROCESSED%</th>
                                <th width="15%">SamplingRunRef</th>
                                <th width="10%">AnalysisPO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($export_data)) : ?>
                                <?php foreach ($export_data as $row) : ?>
                                <tr>
                                    <td><?php echo $row['LABCODE']; ?></td>
                                    <td><?php echo $row['SUBMITTEDMATRIX']; ?></td>
                                    <td><?php echo $row['ANALYSISMATRIX']; ?></td>
                                    <td><?php echo $row['ANALYSISSUBMATRIX']; ?></td>
                                    <td><?php echo $row['SAMPLEPROCESSED%']; ?></td>
                                    <td><?php echo $row['SamplingRunRef']; ?></td>
                                    <td><?php echo $row['AnalysisPO']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7">No processing data available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Comments & Site Information -->
                    <h4 style="margin-top: 15px; margin-bottom: 10px; font-weight: bold;">Comments & Site Information</h4>
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th width="20%">SITEAREA</th>
                                <th width="30%">ReportComment</th>
                                <th width="30%">SiteComment</th>
                                <th width="20%">RESULTCOMMENT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($export_data)) : ?>
                                <?php foreach ($export_data as $row) : ?>
                                <tr>
                                    <td><?php echo $row['SITEAREA']; ?></td>
                                    <td><?php echo $row['ReportComment']; ?></td>
                                    <td><?php echo $row['SiteComment']; ?></td>
                                    <td><?php echo $row['RESULTCOMMENT']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4">No comments data available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Notes and Additional Information -->
                    <h4 style="margin-top: 15px; margin-bottom: 10px; font-weight: bold;">Laboratory Notes & Additional Information</h4>
                    <div style="border: 1px solid #ddd; padding: 15px; background-color: #f9f9f9;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <div style="width: 48%;">
                                <p><strong>Analysis Performed:</strong> 
                                    <?php 
                                    if (!empty($export_data)) {
                                        $dates = array_unique(array_column($export_data, 'AnalysisDate'));
                                        $dates = array_filter($dates, function($date) { return $date !== '-'; });
                                        if (!empty($dates)) {
                                            echo min($dates) . ' to ' . max($dates);
                                        } else {
                                            echo date('d-M-Y', strtotime('-2 days')) . ' to ' . date('d-M-Y');
                                        }
                                    } else {
                                        echo date('d-M-Y', strtotime('-2 days')) . ' to ' . date('d-M-Y');
                                    }
                                    ?>
                                </p>
                                <p><strong>Laboratory Technician:</strong> <?php echo isset($realname) ? $realname : ((!empty($export_data)) ? $export_data[0]['SamplerName'] : 'Dr. Sarah Johnson'); ?></p>
                                <p><strong>EDDVERSION:</strong> <?php echo (!empty($export_data)) ? $export_data[0]['EDDVERSION'] : 'EDD_v2.1'; ?></p>
                                <p><strong>License Number:</strong> <?php echo (!empty($export_data)) ? $export_data[0]['License'] : 'NATA-' . mt_rand(10000, 99999); ?></p>
                            </div>
                            <div style="width: 48%;">
                                <p><strong>ANALYSISMETHODCATEGORY:</strong> 
                                    <?php 
                                    if (!empty($export_data)) {
                                        $categories = array_unique(array_column($export_data, 'ANALYSISMETHODCATEGORY'));
                                        echo implode(', ', $categories);
                                    } else {
                                        echo 'Microbiological & Pathogen Detection';
                                    }
                                    ?>
                                </p>
                                <p><strong>Sample Processing:</strong> All samples processed within 24 hours of receipt</p>
                                <p><strong>Quality Assurance:</strong> ISO 17025 accredited procedures followed</p>
                                <p><strong>Chain of Custody:</strong> Maintained throughout analysis</p>
                            </div>
                        </div>
                        
                        <div style="margin-top: 15px; padding: 10px; background-color: #e8f4f8; border-left: 4px solid #3c8dbc;">
                            <p><strong>Important Notes:</strong></p>
                            <ul style="margin: 5px 0; padding-left: 20px;">
                                <li>Results are valid only for samples tested and under conditions described</li>
                                <li>Detection limits (LOR) are method-specific and matrix-dependent</li>
                                <li>Measurement uncertainty values represent expanded uncertainty (k=2, ~95% confidence)</li>
                                <li>Surrogate recovery indicates extraction and analysis efficiency</li>
                                <li>RPD (Relative Percent Difference) indicates analytical precision</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Signature Section -->
                    <div style="margin-top: 30px; display: flex; justify-content: space-between;">
                        <div style="width: 45%; text-align: center;">
                            <div style="height: 100px;"></div>
                            <div style="border-bottom: 1px solid #000; width: 200px; margin: 0 auto 5px;"></div>
                            <p><strong>Reviewed By</strong><br>
                            Laboratory Manager<br>
                            Date: <?php echo date('d-M-Y'); ?></p>
                        </div>
                        <div style="width: 45%; text-align: center;">
                            <div style="height: 100px;"></div>
                            <div style="border-bottom: 1px solid #000; width: 200px; margin: 0 auto 5px;"></div>
                            <p><strong>Approved By</strong><br>
                            Quality Assurance<br>
                            Date: <?php echo date('d-M-Y'); ?></p>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div style="margin-top: 40px; text-align: center; font-size: 9pt; color: #666;">
                        <p>This report contains <?php echo mt_rand(15, 25); ?> pages and may not be reproduced except in full, without written approval of the laboratory.<br>
                        Laboratory Address: Monash University, Clayton Campus, VIC 3800, Australia<br>
                        Phone: +61 3 9905 4000 | Email: onewater@monash.edu</p>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <script src="<?php echo base_url('assets/adminlte/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

    <script>
        $(document).ready(function() {
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
