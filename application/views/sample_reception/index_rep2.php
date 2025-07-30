<!DOCTYPE html>
<html>
<head>
    <title>Print OWL Report 2 - <?php echo 'Print_OWL_Report2_'.$id_project; ?></title>
    
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
            padding: 6px 4px;
            text-align: left;
            vertical-align: middle;
            font-size: 10pt;
            word-wrap: break-word;
        }
        .report-table th {
            background-color: #e8f4f8;
            font-weight: bold;
            text-align: center;
        }
        .report-table td:not(:first-child) {
            text-align: center;
        }
        .report-table th:first-child, .report-table td:first-child {
            width: 20%;
            text-align: left;
        }
        .report-table tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .summary-table th, .summary-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .summary-table th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .highlight-row {
            background-color: #fff3cd;
            font-weight: bold;
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
        font-size: 8pt;
        padding: 2px 1px;
    }
    h4 {
        font-size: 12pt;
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
                            DETAILED ANALYSIS REPORT
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
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">COC Number</td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $id_project; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Client Quote Number</td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $client_quote_number; ?></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        
                        <div style="width: 49%;">
                            <table width="100%" style="border:0px solid black; margin-bottom: 0; border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Client</td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $client_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Address</td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $address; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Phone</td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $phone1; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Email</td>
                                        <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $email; ?></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <!-- Sample Information Section -->
                    <h4 style="margin-top: 20px; color: #2c3e50;">Sample Information</h4>
                    <table class="summary-table">
                        <thead>
                            <tr>
                                <th width="15%">LABSAMPLEID</th>
                                <th width="15%">SAMPLETYPE</th>
                                <th width="15%">LOCATIONCODE</th>
                                <th width="20%">LocationDescription</th>
                                <th width="15%">SAMPLEDATE</th>
                                <th width="20%">LABREGISTRATIONDATE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data dummy untuk sample information -->
                            <tr>
                                <td>LAB<?php echo str_pad(mt_rand(1000, 9999), 4, '0', STR_PAD_LEFT); ?></td>
                                <td>WATER</td>
                                <td>LOC001</td>
                                <td>Upstream Collection Point A</td>
                                <td><?php echo date('d-M-Y', strtotime('-2 days')); ?></td>
                                <td><?php echo date('d-M-Y H:i', strtotime('-1 day')); ?></td>
                            </tr>
                            <tr>
                                <td>LAB<?php echo str_pad(mt_rand(1000, 9999), 4, '0', STR_PAD_LEFT); ?></td>
                                <td>BIOSOLID</td>
                                <td>LOC002</td>
                                <td>Treatment Plant Effluent B</td>
                                <td><?php echo date('d-M-Y', strtotime('-3 days')); ?></td>
                                <td><?php echo date('d-M-Y H:i', strtotime('-2 days')); ?></td>
                            </tr>
                            <tr>
                                <td>LAB<?php echo str_pad(mt_rand(1000, 9999), 4, '0', STR_PAD_LEFT); ?></td>
                                <td>LIQUID</td>
                                <td>LOC003</td>
                                <td>Downstream Monitoring Point C</td>
                                <td><?php echo date('d-M-Y', strtotime('-1 day')); ?></td>
                                <td><?php echo date('d-M-Y H:i'); ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Client and Submission Information -->
                    <h4 style="margin-top: 25px; color: #2c3e50;">Client & Submission Details</h4>
                    <table class="summary-table">
                        <thead>
                            <tr>
                                <th width="20%">CLIENTNAME</th>
                                <th width="15%">WorkOrderNo</th>
                                <th width="15%">SUBMISSION</th>
                                <th width="20%">SAMPLINGPROVIDER</th>
                                <th width="15%">SamplerName</th>
                                <th width="15%">PROGRAM</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo isset($client_name) ? $client_name : 'ACME Water Treatment Corp'; ?></td>
                                <td>WO<?php echo date('y') . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT); ?></td>
                                <td>SUB<?php echo date('ymd') . mt_rand(10, 99); ?></td>
                                <td>Environmental Sampling Ltd</td>
                                <td>John Smith</td>
                                <td>WATER_QUALITY_MONITORING</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Analysis Results Section -->
                    <h4 style="margin-top: 25px; color: #2c3e50;">Analysis Results</h4>
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
                            <!-- Data dummy untuk analysis results -->
                            <tr>
                                <td>LAB2501</td>
                                <td>ECOLI</td>
                                <td>E. coli</td>
                                <td>COLILERT_MPN</td>
                                <td><?php echo mt_rand(1, 100); ?></td>
                                <td>MPN/100mL</td>
                                <td>1</td>
                                <td>±15%</td>
                                <td>VALIDATED</td>
                            </tr>
                            <tr>
                                <td>LAB2501</td>
                                <td>ENTERO</td>
                                <td>Enterococci</td>
                                <td>ENTEROLERT_MPN</td>
                                <td><?php echo mt_rand(1, 50); ?></td>
                                <td>MPN/100mL</td>
                                <td>1</td>
                                <td>±20%</td>
                                <td>VALIDATED</td>
                            </tr>
                            <tr class="highlight-row">
                                <td>LAB2502</td>
                                <td>CAMPY</td>
                                <td>Campylobacter spp.</td>
                                <td>qPCR_DETECTION</td>
                                <td><?php echo mt_rand(100, 1000); ?></td>
                                <td>copies/g</td>
                                <td>10</td>
                                <td>±25%</td>
                                <td>EXCEEDANCE</td>
                            </tr>
                            <tr>
                                <td>LAB2502</td>
                                <td>SALM</td>
                                <td>Salmonella spp.</td>
                                <td>CULTURE_METHOD</td>
                                <td>NEGATIVE</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>VALIDATED</td>
                            </tr>
                            <tr>
                                <td>LAB2503</td>
                                <td>MOIST</td>
                                <td>Moisture Content</td>
                                <td>GRAVIMETRIC_105C</td>
                                <td><?php echo mt_rand(15, 35); ?></td>
                                <td>%</td>
                                <td>0.1</td>
                                <td>±2%</td>
                                <td>VALIDATED</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Analysis Method Details -->
                    <h4 style="margin-top: 25px; color: #2c3e50;">Analysis Method Details</h4>
                    <table class="summary-table">
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
                            <tr>
                                <td>TK001</td>
                                <td>MICROBIOLOGICAL_INDICATORS</td>
                                <td><?php echo date('d-M-Y', strtotime('-1 day')); ?></td>
                                <td><?php echo date('d-M-Y'); ?></td>
                                <td>100</td>
                                <td>mL</td>
                            </tr>
                            <tr>
                                <td>TK002</td>
                                <td>PATHOGEN_DETECTION</td>
                                <td><?php echo date('d-M-Y', strtotime('-2 days')); ?></td>
                                <td><?php echo date('d-M-Y', strtotime('-1 day')); ?></td>
                                <td>25</td>
                                <td>g</td>
                            </tr>
                            <tr>
                                <td>TK003</td>
                                <td>PHYSICAL_CHEMICAL</td>
                                <td><?php echo date('d-M-Y', strtotime('-1 day')); ?></td>
                                <td><?php echo date('d-M-Y'); ?></td>
                                <td>10</td>
                                <td>g</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Quality Control Section -->
                    <h4 style="margin-top: 25px; color: #2c3e50;">Quality Control & Validation</h4>
                    <table class="summary-table">
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
                            <tr>
                                <td>ECOLI</td>
                                <td><?php echo mt_rand(15, 45); ?></td>
                                <td><?php echo mt_rand(18, 52); ?></td>
                                <td><?php echo mt_rand(95, 105); ?>%</td>
                                <td><?php echo mt_rand(5, 15); ?>%</td>
                                <td><?php echo mt_rand(85, 115); ?>%</td>
                                <td>EC001</td>
                            </tr>
                            <tr>
                                <td>ENTERO</td>
                                <td><?php echo mt_rand(8, 25); ?></td>
                                <td><?php echo mt_rand(10, 30); ?></td>
                                <td><?php echo mt_rand(92, 108); ?>%</td>
                                <td><?php echo mt_rand(3, 12); ?>%</td>
                                <td><?php echo mt_rand(88, 112); ?>%</td>
                                <td>EN001</td>
                            </tr>
                            <tr>
                                <td>CAMPY</td>
                                <td><?php echo mt_rand(150, 450); ?></td>
                                <td><?php echo mt_rand(180, 520); ?></td>
                                <td><?php echo mt_rand(98, 102); ?>%</td>
                                <td><?php echo mt_rand(8, 18); ?>%</td>
                                <td><?php echo mt_rand(90, 110); ?>%</td>
                                <td>CA001</td>
                            </tr>
                            <tr>
                                <td>SALM</td>
                                <td>NEGATIVE</td>
                                <td>NEGATIVE</td>
                                <td><?php echo mt_rand(96, 104); ?>%</td>
                                <td>N/A</td>
                                <td><?php echo mt_rand(92, 108); ?>%</td>
                                <td>SA001</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Lab Certification & Reporting -->
                    <h4 style="margin-top: 25px; color: #2c3e50;">Laboratory Certification & Reporting</h4>
                    <table class="summary-table">
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
                            <tr>
                                <td>COA-<?php echo date('Y') . '-' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT); ?></td>
                                <td><?php echo date('d-M-Y'); ?></td>
                                <td>QAQC-<?php echo date('Y') . '-' . str_pad(mt_rand(1, 99), 2, '0', STR_PAD_LEFT); ?></td>
                                <td><?php echo date('d-M-Y'); ?></td>
                                <td>NATA-<?php echo mt_rand(10000, 99999); ?></td>
                                <td>EDD_v2.1</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Sample Processing Details -->
                    <h4 style="margin-top: 25px; color: #2c3e50;">Sample Processing & Matrix Details</h4>
                    <table class="summary-table">
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
                            <tr>
                                <td>LAB001</td>
                                <td>WATER</td>
                                <td>AQUEOUS</td>
                                <td>FRESHWATER</td>
                                <td><?php echo mt_rand(95, 100); ?>%</td>
                                <td>SR<?php echo date('ymd') . '-' . mt_rand(10, 99); ?></td>
                                <td>PO<?php echo mt_rand(1000, 9999); ?></td>
                            </tr>
                            <tr>
                                <td>LAB002</td>
                                <td>BIOSOLID</td>
                                <td>SOLID</td>
                                <td>TREATED_SLUDGE</td>
                                <td><?php echo mt_rand(90, 98); ?>%</td>
                                <td>SR<?php echo date('ymd') . '-' . mt_rand(10, 99); ?></td>
                                <td>PO<?php echo mt_rand(1000, 9999); ?></td>
                            </tr>
                            <tr>
                                <td>LAB003</td>
                                <td>LIQUID</td>
                                <td>AQUEOUS</td>
                                <td>WASTEWATER</td>
                                <td><?php echo mt_rand(88, 96); ?>%</td>
                                <td>SR<?php echo date('ymd') . '-' . mt_rand(10, 99); ?></td>
                                <td>PO<?php echo mt_rand(1000, 9999); ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Comments & Site Information -->
                    <h4 style="margin-top: 25px; color: #2c3e50;">Comments & Site Information</h4>
                    <table class="summary-table">
                        <thead>
                            <tr>
                                <th width="20%">SITEAREA</th>
                                <th width="30%">ReportComment</th>
                                <th width="30%">SiteComment</th>
                                <th width="20%">RESULTCOMMENT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>UPSTREAM_ZONE_A</td>
                                <td>All analysis completed within specified timeframes. Results validated according to laboratory QA/QC procedures.</td>
                                <td>Sampling conducted during normal flow conditions. Weather: Clear, Temperature: 18°C.</td>
                                <td>Results within acceptable limits for indicator organisms.</td>
                            </tr>
                            <tr>
                                <td>TREATMENT_PLANT_B</td>
                                <td>Pathogen detection analysis requires confirmation. Additional testing recommended for Campylobacter levels.</td>
                                <td>Sample collected from final effluent discharge point. Flow rate: 2.5 ML/day.</td>
                                <td>Elevated Campylobacter levels detected - investigate treatment efficacy.</td>
                            </tr>
                            <tr>
                                <td>DOWNSTREAM_ZONE_C</td>
                                <td>Physical-chemical parameters within normal operational ranges. Moisture content analysis completed.</td>
                                <td>Biosolid sample from dewatering process. Solid content approximately 25%.</td>
                                <td>Moisture content suitable for disposal/reuse applications.</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Notes and Additional Information -->
                    <h4 style="margin-top: 25px; color: #2c3e50;">Laboratory Notes & Additional Information</h4>
                    <div style="border: 1px solid #ddd; padding: 15px; background-color: #f9f9f9;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <div style="width: 48%;">
                                <p><strong>Analysis Performed:</strong> <?php echo date('d-M-Y', strtotime('-2 days')); ?> to <?php echo date('d-M-Y'); ?></p>
                                <p><strong>Laboratory Technician:</strong> <?php echo isset($realname) ? $realname : 'Dr. Sarah Johnson'; ?></p>
                                <p><strong>EDDVERSION:</strong> EDD_v2.1</p>
                                <p><strong>License Number:</strong> NATA-<?php echo mt_rand(10000, 99999); ?></p>
                            </div>
                            <div style="width: 48%;">
                                <p><strong>ANALYSISMETHODCATEGORY:</strong> Microbiological & Pathogen Detection</p>
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
                            <div style="border-bottom: 1px solid #000; width: 200px; margin: 0 auto 5px;"></div>
                            <p><strong>Reviewed By</strong><br>
                            Laboratory Manager<br>
                            Date: <?php echo date('d-M-Y'); ?></p>
                        </div>
                        <div style="width: 45%; text-align: center;">
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
            $('#print').click(function () {
                window.print();
                return false;
            });

            $('#close').click(function () {
                window.close();
                return false;
            });

            // Auto save report details when page loads if they're generated
            var report_number_to_send = $('#generated_report_number_val').val();
            var report_date_to_send = $('#generated_report_date_val').val();
            var id_project = $('#id_project').val();

            if (report_number_to_send && report_date_to_send && id_project) {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo site_url('sample_reception/save_report_details_ajax'); ?>",
                    data: {
                        id_project: id_project,
                        report_number: report_number_to_send,
                        report_date: report_date_to_send
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log('Report details save status:', response.status);
                    },
                    error: function(xhr, status, error) {
                        console.log('Error saving report details:', error);
                    }
                });
            }
        });
    </script>

</body>
</html>
