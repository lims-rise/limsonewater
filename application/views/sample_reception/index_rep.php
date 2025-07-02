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
    }
    ol li {
        font-size: 9pt;
    }
    .box-body > div[style*="display: flex"] {
        display: block !important;
    }
    .box-body > div[style*="width: 49%"], .box-body > div[style*="width: 30%"] {
        width: 100% !important;
    }
    </style>
</head>
<body>

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
                    <div style="position: relative; height: 40px; margin-bottom: 10px;">
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
                    
                    <div style="display: flex; justify-content: space-between; width: 100%;">
                        <div style="width: 49%;">
                            <table id="report-header" width="100%" style="border:0px solid black; margin-bottom: 0; border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Report Number</td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">
                                            <span id="display_report_number"><?php echo htmlspecialchars($report_number_display ?? ''); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Report issue date</td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">
                                            <span id="display_report_date"><?php echo htmlspecialchars($report_date_display ?? ''); ?></span>
                                        </td>
                                    </tr>
                                </thead>
                            </table>

                            <div style="width: 100%; border-top: 1px solid #ddd; margin: 5px 0;"></div>

                            <table id="project-details" width="100%" style="border:0px solid black; margin-top: 0; border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Project ID</td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $id_project ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Client</td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $client ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Client contact details</td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $client_name ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"></td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $address ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"></td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $phone1 ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"></td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $phone2 ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"></td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $email ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Quote Number</td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $client_quote_number ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">PO Number</td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $po_number ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Date of Sample Received</td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $from_date . "&nbsp &nbsp~&nbsp &nbsp" . $to_date ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Analysis</td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo "??" ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Test Analyst(s)</td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $realname ?></td>
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
                    <div style="position: relative; height: 10px; margin-bottom: 10px;">
                        <img src="../../../img/bluebar.png" 
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 10%; object-fit: cover; z-index: 0;" 
                            alt="Background" />
                    </div>

                    <input type='hidden' id='id_project' value='<?php echo $id_project; ?>'>

                    <!-- <div style="display: flex; justify-content: space-between; width: 100%;">
                        <div style="width: 30%;">
                            <table id="report-header" width="100%" style="border:0px solid black; margin-bottom: 0; border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <td width="50%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><b>Page Number</b></td>
                                        <td width="5%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><b>:</b></td>
                                        <td width="50%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><b><?php echo $page_counter++; ?> of X</b></td>
                                    </tr>
                                    <tr>
                                        <td style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><b>Report Number</b></td>
                                        <td style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><b>:</b></td>
                                        <td style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><b>25-10299</b></td>
                                    </tr>
                                    <tr>
                                        <td style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><b>Project ID</b></td>
                                        <td style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><b>:</b></td>
                                        <td style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><b><?php echo $id_project ?></b></td>
                                    </tr>
                                    <tr>
                                        <td style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><b>Client</b></td>
                                        <td style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><b>:</b></td>
                                        <td style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><b><?php echo $client ?></b></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div> -->

                    <!-- <div style="width: 100%; border-top: 2px solid #3c8dbc; margin: 30px 0;"></div> -->
                    <div style="display: flex; justify-content: space-between; width: 100%;">
                        <div style="width: 30%;">
                            <table id="report-header" width="100%" style="border:0px solid black; margin-bottom: 0; border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <td width="50%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><b>Sample Detail</b></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <?php

                    $q = $this->db->query('SELECT a.id_project, a.id_one_water_sample, a.comments, a.id_sampletype, b.sampletype, a.date_collected, a.time_collected
                    FROM sample_reception_sample a
                    LEFT JOIN ref_sampletype b ON a.id_sampletype = b.id_sampletype
                    WHERE a.id_project="'.$id_project.'"
                    AND a.flag = 0 
                    ORDER BY a.id_one_water_sample');        

                    $response = $q->result();

                    ?>

                    <div style="width: 100%;">
                        <table id="additional-info" width="100%" style="border:1px solid #3c8dbc; border-collapse: separate; border-spacing: 10px;">
                            <thead>
                                <tr>
                                    <td width="8%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left">Sample Number</td>
                                    <td width="35%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left">Description</td>
                                    <td width="10%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left">Sample type</td>
                                    <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left">Sampled Date</td>
                                    <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left">Sampled Time</td>
                                </tr>
                                <?php foreach ($response as $row): ?>
                                <tr>
                                    <td style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $row->id_one_water_sample; ?></td>
                                    <td style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $row->comments; ?></td>
                                    <td style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $row->sampletype; ?></td>
                                    <td style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $row->date_collected; ?></td>
                                    <td style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $row->time_collected; ?></td>
                                </tr>
                                <?php endforeach; ?>                                  
                            </thead>
                        </table>
                    </div>


                    <?php

                    $q = $this->db->query('SELECT a.id_project, a.id_one_water_sample, c.testing_type, "200uL PBS/glycerol" method, "0" testvalue
                    FROM sample_reception_sample a
                    LEFT JOIN sample_reception_testing b ON a.id_sample= b.id_sample
                            LEFT JOIN ref_testing c ON b.id_testing_type = c.id_testing_type
                    WHERE a.id_project="'.$id_project.'"
                    AND a.flag = 0 
                    ORDER BY a.id_one_water_sample');        

                    $response2 = $q->result();

                    ?>
                    <div style="width: 100%; border-top: 0px solid #ddd; margin: 20px 0;"></div>

                    <div style="width: 60%;">
                        <table id="additional-info" width="100%" style="border:1px solid #3c8dbc; border-collapse: separate; border-spacing: 10px;">
                            <thead>
                                <tr>
                                    <td width="20%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left">Analysis - Analyte</td>
                                    <td width="20%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left">Units</td>
                                    <td width="10%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left">Values</td>
                                </tr>
                                <?php foreach ($response2 as $row2): ?>
                                <tr>
                                    <td width="20%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $row2->testing_type; ?></td>
                                    <td width="20%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $row2->method; ?></td>
                                    <td width="10%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $row2->testvalue; ?></td>
                                </tr>
                                <?php endforeach; ?>                                  
                            </thead>
                        </table>
                    </div>                    
                </div>
            </div>
        </section>
    </div>

    <div class="content-wrapper page-break">
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <img src="../../../img/monash.png" height="50px" class="icon" style="padding: 0px; float: left;">
                    <img src="../../../img/onewaterlogo.png" height="40px" class="icon" style="padding: 0px; float: right;">
                </div>
                <div class="box-body">
                    <div style="position: relative; height: 10px; margin-bottom: 10px;">
                        <img src="../../../img/bluebar.png" 
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 10%; object-fit: cover; z-index: 0;" 
                            alt="Background" />
                    </div>

                    <input type='hidden' id='id_project' value='<?php echo $id_project; ?>'>

                    <?php
                    $all_sample_headers = [
                        'P2500143', 'P2500144', 'P2500145', 'P2500146', 'P2500147', 'P2500148',
                        // 'P2500149', 'P2500150', 'P2500151', 'P2500152', 'P2500153', 'P2500154',
                        // 'P2500155', 'P2500156', 'P2500157', 'P2500158', 'P2500159', 'P2500160', 
                        // 'P2500161', 'P2500162', 'P2500163', 'P2500164', 'P2500165' 
                    ];

                    $human_specific_all_data = [
                        'Human' => ['0.00%', '0.00%', '0.00%', '0.01%', '0.00%', '0.01%', '0.02%', '0.00%', '0.01%', '0.00%', '0.00%', '0.01%', '0.00%', '0.01%', '0.00%', '0.00%', '0.01%', '0.00%', '0.00%', '0.01%', '0.00%'],
                        'Unknown' => ['100.00%', '100.00%', '100.00%', '99.99%', '100.00%', '99.99%', '99.98%', '100.00%', '99.99%', '100.00%', '100.00%', '99.99%', '100.00%', '99.99%', '100.00%', '100.00%', '99.99%', '100.00%', '100.00%', '99.99%', '100.00%']
                    ];

                    $faecal_specific_all_data = [
                        'Bat' => ['0.00%', '', '', '0.00%', '0.21%', '', '0.00%', '', '', '0.00%', '', '', '0.00%', '0.01%', '', '0.00%', '', '', '0.00%', '', ''],
                        'Bird' => ['0.00%', '', '', '0.00%', '0.03%', '', '0.00%', '', '', '0.00%', '', '', '0.00%', '0.00%', '', '0.00%', '', '', '0.00%', '', ''],
                        'Cat' => ['', '', '', '0.00%', '0.00%', '', '0.00%', '', '', '0.00%', '', '', '0.00%', '0.00%', '', '0.00%', '', '', '0.00%', '', ''],
                        'Chicken' => ['0.00%', '0.00%', '', '0.00%', '0.00%', '', '0.00%', '', '', '0.00%', '', '', '0.00%', '0.00%', '', '0.00%', '', '', '0.00%', '', ''],
                        'Cow' => ['0.00%', '0.00%', '', '0.00%', '0.00%', '0.01%', '0.00%', '0.00%', '', '0.00%', '0.00%', '0.01%', '0.00%', '0.00%', '', '0.00%', '0.00%', '0.01%', '0.00%', '0.00%', ''],
                        'Deer' => ['0.00%', '0.00%', '', '0.00%', '0.00%', '0.02%', '0.00%', '0.00%', '', '0.00%', '0.00%', '0.02%', '0.00%', '0.00%', '', '0.00%', '0.00%', '0.02%', '0.00%', '0.00%', ''],
                        'Dog' => ['', '', '', '0.00%', '0.01%', '', '0.00%', '', '', '0.00%', '', '', '0.00%', '0.00%', '', '0.00%', '', '', '0.00%', '', ''],
                        'Fox' => ['0.00%', '0.00%', '', '0.00%', '0.00%', '', '0.00%', '0.00%', '', '0.00%', '0.00%', '', '0.00%', '0.00%', '', '0.00%', '0.00%', '', '0.00%', '', ''],
                        'Horse' => ['', '', '', '', '', '0.00%', '', '', '', '', '', '0.00%', '', '', '', '', '', '0.00%', '', '', ''],
                        'Human' => ['0.00%', '0.00%', '0.01%', '0.01%', '0.00%', '0.00%', '0.00%', '0.00%', '0.01%', '0.01%', '0.00%', '0.00%', '0.00%', '0.00%', '0.01%', '0.00%', '0.00%', '0.01%', '0.01%', '0.00%', '0.01%'],
                        'Kangaroo' => ['', '', '', '', '', '0.00%', '', '', '', '', '', '0.00%', '', '', '', '', '', '0.00%', '', '', ''],
                        'Possum' => ['0.00%', '0.00%', '0.01%', '0.01%', '0.00%', '0.01%', '0.00%', '0.00%', '0.01%', '0.01%', '0.00%', '0.01%', '0.00%', '0.00%', '0.01%', '0.00%', '0.00%', '0.01%', '0.01%', '0.00%', '0.01%'],
                        'Rabbit' => ['', '', '', '', '', '0.00%', '', '', '', '', '', '0.00%', '', '', '', '', '', '0.00%', '', '', ''],
                        'Rat' => ['0.01%', '0.00%', '0.00%', '0.00%', '0.00%', '0.00%', '0.01%', '0.00%', '0.00%', '0.00%', '0.00%', '0.00%', '0.01%', '0.00%', '0.00%', '0.01%', '0.00%', '0.00%', '0.00%', '0.00%', '0.01%'],
                        'Sheep' => ['0.00%', '0.00%', '', '0.00%', '0.00%', '0.01%', '0.00%', '0.00%', '', '0.00%', '0.00%', '0.01%', '0.00%', '0.00%', '', '0.00%', '0.00%', '0.01%', '0.00%', '0.00%', ''],
                        'Wallaby' => ['0.00%', '0.00%', '', '', '', '', '0.00%', '0.00%', '', '', '', '', '0.00%', '0.00%', '', '0.00%', '0.00%', '', '', '', ''],
                        'Waterbird' => ['0.02%', '0.01%', '0.01%', '0.01%', '0.02%', '0.02%', '0.02%', '0.01%', '0.01%', '0.01%', '0.02%', '0.02%', '0.02%', '0.01%', '0.01%', '0.02%', '0.01%', '0.01%', '0.01%', '0.02%', '0.02%'],
                        'Wombat' => ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''],
                        'Unknown' => ['99.95%', '99.97%', '99.96%', '99.95%', '99.95%', '99.65%', '99.97%', '99.99%', '99.97%', '99.98%', '99.98%', '99.63%', '99.97%', '99.97%', '99.97%', '99.97%', '99.99%', '99.97%', '99.97%', '99.98%', '99.97%']
                    ];
                    
                    $samples_per_row = 6;
                    $num_samples = count($all_sample_headers);
                    $num_chunks = ceil($num_samples / $samples_per_row);
                    $page_counter = 2; 

                    // --- GENERASI TABEL 1 (HUMAN-SPECIFIC) ---
                    echo '<h4 style="margin-top: 0; margin-bottom: 10px;">Table 1 - Human-specific contribution within total microbial community:</h4>';
                    for ($chunk_idx = 0; $chunk_idx < $num_chunks; $chunk_idx++) {
                        $start_col_idx = $chunk_idx * $samples_per_row;
                        $end_col_idx = min(($chunk_idx + 1) * $samples_per_row, $num_samples);
                        $current_sample_headers_chunk = array_slice($all_sample_headers, $start_col_idx, $samples_per_row);
                    ?>
                        <?php if ($chunk_idx > 0): ?>
                        <div class="page-break"></div>
                        <div class="box-header">
                            <img src="../../../img/monash.png" height="50px" class="icon" style="padding: 0px; float: left;">
                            <img src="../../../img/onewaterlogo.png" height="40px" class="icon" style="padding: 0px; float: right;">
                        </div>
                        <div style="position: relative; height: 10px; margin-bottom: 10px;">
                            <img src="../../../img/bluebar.png" 
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 10%; object-fit: cover; z-index: 0;" 
                                alt="Background" />
                        </div>
                        <div style="width: 100%; border-top: 2px solid #3c8dbc; margin: 30px 0;"></div>
                        <?php endif; ?>
                        
                        <table class="report-table" style="margin-bottom: 20px;">
                            <thead>
                                <tr>
                                    <th>Sources</th>
                                    <?php foreach ($current_sample_headers_chunk as $sample_name): ?>
                                    <th>Sample # <?php echo htmlspecialchars($sample_name); ?></th> 
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($human_specific_all_data as $source => $values): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($source); ?></td>
                                    <?php for ($col_idx = $start_col_idx; $col_idx < $end_col_idx; $col_idx++): ?>
                                    <td><?php echo htmlspecialchars($values[$col_idx] ?? ''); ?></td>
                                    <?php endfor; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php 
                    } // End of Human-specific chunk loop 
                    ?>

                    <div class="page-break"></div> <?php
                    // --- GENERASI TABEL 2 (FAECAL-SPECIFIC) ---
                    echo '<h4 style="margin-top: 0; margin-bottom: 10px;">Table 2 - Faecal-specific contribution within total microbial community:</h4>';
                    for ($chunk_idx = 0; $chunk_idx < $num_chunks; $chunk_idx++) {
                        $start_col_idx = $chunk_idx * $samples_per_row;
                        $end_col_idx = min(($chunk_idx + 1) * $samples_per_row, $num_samples);
                        $current_sample_headers_chunk = array_slice($all_sample_headers, $start_col_idx, $samples_per_row);
                    ?>
                        <?php if ($chunk_idx > 0): ?>
                        <div class="page-break"></div>
                        <div class="box-header">
                            <img src="../../../img/monash.png" height="50px" class="icon" style="padding: 0px; float: left;">
                            <img src="../../../img/onewaterlogo.png" height="40px" class="icon" style="padding: 0px; float: right;">
                        </div>
                        <div style="position: relative; height: 10px; margin-bottom: 10px;">
                            <img src="../../../img/bluebar.png" 
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 10%; object-fit: cover; z-index: 0;" 
                                alt="Background" />
                        </div>
                        <div style="width: 100%; border-top: 2px solid #3c8dbc; margin: 30px 0;"></div>
                        <?php endif; ?>

                        <table class="report-table" style="margin-bottom: 30px;">
                            <thead>
                                <tr>
                                    <th>Sources</th>
                                    <?php foreach ($current_sample_headers_chunk as $sample_name): ?>
                                    <th>Sample # <?php echo htmlspecialchars($sample_name); ?></th> 
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($faecal_specific_all_data as $source => $values): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($source); ?></td>
                                    <?php for ($col_idx = $start_col_idx; $col_idx < $end_col_idx; $col_idx++): ?>
                                    <td><?php echo htmlspecialchars($values[$col_idx] ?? ''); ?></td>
                                    <?php endfor; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php 
                    } // End of Faecal-specific chunk loop 
                    ?>

                    <div class="page-break"></div> <h4 style="margin-top: 30px; margin-bottom: 10px;">Note for interpretation of microbial community contribution report(s):</h4>
                    <ol style="margin-left: 15px;">
                        <li>Values displayed represent significant relative median microbial community contribution (relative standard deviation <100%). The results were taken as the average of five replicate SourceTracker runs.</li>
                        <li>Values with relative standard deviation ≥100% were deemed non-significant result, and therefore omitted from the report.</li>
                        <li>Values were rounded-off to the nearest 2 decimal places.</li>
                        <li>Unknown represents the proportion of microbial community which do not belong to any of the sources (i.e., microbial communities not of faecal-origin, or undetected sources).</li>
                    </ol>

                    <div class="page-break"></div>
                    <div class="box-header">
                        <img src="../../../img/monash.png" height="50px" class="icon" style="padding: 0px; float: left;">
                        <img src="../../../img/onewaterlogo.png" height="40px" class="icon" style="padding: 0px; float: right;">
                    </div>
                    <div style="position: relative; height: 10px; margin-bottom: 10px;">
                        <img src="../../../img/bluebar.png" 
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 10%; object-fit: cover; z-index: 0;" 
                            alt="Background" />
                    </div>
                    <div style="width: 100%; border-top: 2px solid #3c8dbc; margin: 30px 0;"></div>

                    <?php
                    // Dummy data for Table 3 - Faecal-source contribution
                    $faecal_source_all_data = [
                        'Bat' => ['2.26%', '8.87%', '', '7.61%', '1.79%', '10.21%'],
                        'Bird' => ['8.87%', '', '', '', '3.98%', '1.72%'],
                        'Cat' => ['3.33%', '', '', '', '5.27%', '3.81%'],
                        'Chicken' => ['4.06%', '7.66%', '', '6.79%', '4.25%', '0.31%'],
                        'Cow' => ['9.01%', '3.22%', '', '7.16%', '2.79%', '2.48%'],
                        'Deer' => ['3.30%', '7.50%', '', '1.86%', '13.31%', ''],
                        'Dog' => ['', '', '', '', '', '0.64%'],
                        'Fox' => ['5.76%', '13.73%', '12.33%', '10.89%', '10.52%', '0.84%'],
                        'Horse' => ['8.28%', '14.32%', '25.31%', '16.60%', '7.74%', '2.48%'],
                        'Human' => ['10.39%', '7.88%', '9.65%', '8.26%', '13.02%', '1.47%'],
                        'Kangaroo' => ['7.36%', '5.44%', '', '3.85%', '3.51%', '2.92%'],
                        'Possum' => ['1.65%', '5.00%', '', '', '', ''],
                        'Rabbit' => ['36.93%', '28.67%', '34.80%', '29.11%', '30.51%', '5.87%'],
                        'Rat' => ['0.02%', '', '', '', '', ''],
                        'Sheep' => ['', '', '', '', '', ''],
                        'Wallaby' => ['', '', '', '', '', ''],
                        'Waterbird' => ['', '', '', '', '', ''],
                        'Wombat' => ['', '', '', '', '', ''],
                    ];
                    ?>

                    <h4 style="margin-top: 0; margin-bottom: 10px;">Table 3 - Faecal-source contribution within faecal component of microbial community:</h4>
                    <?php for ($chunk_idx = 0; $chunk_idx < $num_chunks; $chunk_idx++): ?>
                        <?php
                        $start_col_idx = $chunk_idx * $samples_per_row;
                        $end_col_idx = min(($chunk_idx + 1) * $samples_per_row, $num_samples);
                        $current_sample_headers_chunk = array_slice($all_sample_headers, $start_col_idx, $samples_per_row);
                        ?>
                        <?php if ($chunk_idx > 0): ?>
                        <div class="page-break"></div>
                        <div class="box-header">
                            <img src="../../../img/monash.png" height="50px" class="icon" style="padding: 0px; float: left;">
                            <img src="../../../img/onewaterlogo.png" height="40px" class="icon" style="padding: 0px; float: right;">
                        </div>
                        <div style="position: relative; height: 10px; margin-bottom: 10px;">
                            <img src="../../../img/bluebar.png" 
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 10%; object-fit: cover; z-index: 0;" 
                                alt="Background" />
                        </div>
                        <div style="width: 100%; border-top: 2px solid #3c8dbc; margin: 30px 0;"></div>
                        <?php endif; ?>
                        
                        <table class="report-table" style="margin-bottom: 20px;">
                            <thead>
                                <tr>
                                    <th rowspan="2">Sources</th> <th colspan="<?php echo count($current_sample_headers_chunk); ?>">Sample #</th> </tr>
                                <tr>
                                    <?php foreach ($current_sample_headers_chunk as $sample_name): ?>
                                    <th><?php echo htmlspecialchars($sample_name); ?></th> <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($faecal_source_all_data as $source => $values): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($source); ?></td>
                                    <?php 
                                    for ($col_idx = $start_col_idx; $col_idx < $end_col_idx; $col_idx++): 
                                        $current_sample_data_idx = $col_idx - $start_col_idx; 
                                    ?>
                                    <td><?php echo htmlspecialchars($values[$current_sample_data_idx] ?? ''); ?></td>
                                    <?php endfor; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endfor; // End of Faecal-source chunk loop ?>

                    <h4 style="margin-top: 30px; margin-bottom: 10px;">Note for faecal community contribution report(s):</h4>
                    <ol style="margin-left: 15px;">
                        <li>Values displayed represent significant relative median faecal community contribution (relative standard deviation <100%). The results were taken as the average of five replicate SourceTracker runs.</li>
                        <li>Values with relative standard deviation ≥100% were deemed non-significant result, and therefore omitted from the report.</li>
                        <li>Values were rounded-off to the nearest 2 decimal places.</li>
                        <li>Faecal community contribution represents normalised microbial community contribution from faecal-origin sources. The faecal community contribution from each sources was calculated by taking the median microbial community contribution of the source of interest, divided by the sum of all the microbial community contributions, excluding the microbial community contribution from unknown sources. An example of this has been illustrated below, using sample P2500148 as an example:</li>
                    </ol>
                    </div>
                <!-- <div class="box-footer" style="text-align: right; border-top: 1px solid #eee; padding-top: 10px;">
                    Report Number: M25-00001
                    <span style="float: right;">Page X of Y</span> 
                </div> -->
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

            // var table = $("#mytable").DataTable({
            //     oLanguage: {
            //         sProcessing: "loading..."
            //     },
            //     processing: true,
            //     serverSide: true,
            //     ajax: {"url": "Sample_reception/json", "type": "POST"},
            //     displayStart: lastPage ? (parseInt(lastPage) * 10) : 0, 
            //     columns: [
            //         { "data": "toggle", "orderable": false, "searchable": false }, 
            //         {"data": "id_project"},
            //         {
            //             "data": "client_quote_number",
            //             "render": function(data, type, row) {
            //                 return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
            //             }
            //         },
            //         {
            //             "data": "client",
            //             "render": function(data, type, row) {
            //                 return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
            //             }
            //         },
            //         {"data": "number_sample"},
            //         {"data": "id_client_sample"},
            //         {
            //             "data": "client_name",
            //             "render": function(data, type, row) {
            //                 return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
            //             }
            //         },
            //         {"data": "comments"},
            //         {"data": "date_collected"},
            //         {"data": "time_collected"},
            //         {
            //             "data": "files",
            //             "render": function(data, type, row) {
            //                 if (!data || data === "null") return `<button type="button" class="btn btn-sm btn-light" disabled>
            //                         <i class="fa fa-times"></i> No scan yet
            //                     </button>`;
            //                 const fileURL = `<?= site_url('scan_page/view_file/') ?>${data}`;
            //                 return `<a href="${fileURL}" target="_blank" class="btn btn-sm btn-success">
            //                         <i class="fa fa-file-pdf-o"></i> View Scan
            //                     </a>`;
            //             }
            //         },
            //         { "data": "action", "orderable": false, "searchable": false }
            //     ],
            //     columnDefs: [
            //         {
            //             targets: [5],
            //             className: 'text-right'
            //         }
            //     ],
            //     drawCallback: function(settings) {
            //         let api = this.api();
            //         let pageInfo = api.page.info();

            //         api.rows().every(function() {
            //             $(this.node()).removeClass('highlight highlight-edit');
            //         });

            //         let now = new Date();
            //         let newestRow = null;
            //         let newestCreatedDate = null;
            //         let newestUpdatedDate = null;
            //         let updatedRow = null;

            //         api.rows().every(function() {
            //             let data = this.data();
            //             let createdDate = new Date(data.date_created);
            //             let updatedDate = new Date(data.date_updated);

            //             if (now - createdDate < 10 * 100) {
            //                 if (!newestCreatedDate || createdDate > newestCreatedDate) {
            //                     newestCreatedDate = createdDate;
            //                     newestRow = this.node();
            //                 }
            //             }

            //             if (now - updatedDate < 10 * 1000) {
            //                 if (!newestUpdatedDate || updatedDate > newestUpdatedDate) {
            //                     newestUpdatedDate = updatedDate;
            //                     updatedRow = this.node();
            //                 }
            //             }
            //         });

            //         if (newestRow) {
            //             $(newestRow).addClass('highlight');
            //             setTimeout(function() {
            //                 $(newestRow).removeClass('highlight');
            //             }, 5000);
            //         }

            //         if (updatedRow) {
            //             $(updatedRow).addClass('highlight-edit');
            //             setTimeout(function() {
            //                 $(updatedRow).removeClass('highlight-edit');
            //             }, 5000);
            //         }

            //         if (pageInfo.page === 0 && api.rows().count() > 0) {
            //             let firstRow = api.row(0).node();
            //             setTimeout(function() {
            //                 $(firstRow).addClass('highlight');
            //             }, 5000);
            //         }

            //         if (lastIdProject) {
            //             api.rows().every(function () {
            //                 let rowData = this.data();
            //                 if (rowData.id_project === lastIdProject) {
            //                     $(this.node()).addClass('highlight');
            //                     $('html, body').animate({
            //                         scrollTop: $(this.node()).offset().top - 100
            //                     }, 1000);
            //                     openChildRow($(this.node()), rowData);
            //                 }
            //             });
            //         }
            //     }
            // });

        });
    </script>
</body>
</html>