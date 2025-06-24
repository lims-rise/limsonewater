
        <div class="noprint">
            <div class="modal-footer clearfix">
                <button id='print' class="btn btn-primary no-print" onclick="document.title = '<?php echo 'Print_OWL_Report_'.$id_project;?>'; window.print();"><i class="fa fa-print"></i> Print</button>
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
                        
                        <div style="display: flex; justify-content: space-between; width: 100%;">
                            <div style="width: 49%;">
                                <table id="report-header" width="100%" style="border:0px solid black; margin-bottom: 0; border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                            <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Report Number</td>
                                            <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $report_number ?></td>
                                        </tr>
                                        <tr>
                                            <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Report issue date</td>
                                            <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $report_date ?></td>
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

                            <!-- <div style="width: 49%;">
                                <table id="additional-info" width="100%" style="border:0px solid black; border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                            <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left">Page</td>
                                            <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left">1</td>
                                        </tr>
                                        <tr>
                                            <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Laboratory</td>
                                            <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">One Water</td>
                                        </tr>
                                        <tr>
                                            <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Address</td>
                                            <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore</td>
                                        </tr>
                                        <tr>
                                            <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Phone</td>
                                            <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">03 8882 9993</td>
                                        </tr>
                                        <tr>
                                            <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Contact</td>
                                            <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">
                                                <ul style="margin: 0; padding-left: 20px;">
                                                    <li>Rebekah Henry</li>
                                                    <li>Chi-Wen Tseng</li>
                                                    <li>Lamiya Bata</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Special Instructions</td>
                                            <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Keep refrigerated. Analyze within 48 hours.</td>
                                        </tr>
                                        <tr>
                                            <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Chain of Custody</td>
                                            <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Documented in COC-2023-001</td>
                                        </tr>
                                    </thead>
                                </table>
                            </div> -->
                        </div>

                        <!-- <div style="width: 100%; border-top: 0px solid #ddd; margin: 30px 0;"></div>

                        <div style="width: 80%; margin: 5px auto; border-top: 0px solid #ddd; text-align: center;">
                        The sample(s) referred to in this report were analysed by the following method(s) under NATA Accreditation No. 992. The hash (#) below
                        indicates methods not covered by NATA accreditation in the performance of this service.
                        </div>

                        <div style="width: 100%; border-top: 0px solid #ddd; margin: 50px 0;"></div>

                        <div style="width: 100%;">
                            <table id="additional-info" width="100%" style="border:0px solid black; border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left">Analysis</td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left">Method</td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left">Laboratory</td>
                                        <td width="5%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left"></td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left">Analysis</td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left">Method</td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left">Laboratory</td>
                                    </tr>
                                    <tr>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Clostridia MF</td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">MM506</td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">One Water</td>
                                        <td width="5%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left"></td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Campy 11 tube MPN</td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">MM647</td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">One Water</td>
                                    </tr>
                                    <tr>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Colilert (2000)</td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">MM514</td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">One Water</td>
                                        <td width="5%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left"></td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Enterolert</td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">MM517</td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">One Water</td>
                                    </tr>
                                    <tr>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Enteric virus</td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">MP568 & MP573</td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">One Water</td>
                                        <td width="5%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left"></td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">GC Filt</td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">MP546</td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">One Water</td>
                                    </tr>
                                    <tr>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">f-RNA phage SA</td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">MP511</td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">One Water</td>
                                        <td width="5%" style="border:0px solid black; padding: 3px 0; vertical-align: top; font-weight: bold;" align="left"></td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"></td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"></td>
                                        <td width="14%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"></td>
                                    </tr>
                                </thead>
                            </table>
                        </div> -->
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

                        <div style="display: flex; justify-content: space-between; width: 100%;">
                            <div style="width: 30%;">
                                <table id="report-header" width="100%" style="border:0px solid black; margin-bottom: 0; border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                            <td width="50%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><b>Page Number</b></td>
                                            <td width="5%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><b>:</b></td>
                                            <td width="50%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><b>2</b></td>
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
                        </div>

                        <div style="width: 100%; border-top: 2px solid #3c8dbc; margin: 30px 0;"></div>
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
        
<style>
    .box-primary {
        border-bottom: 3px solid #3c8dbc;
    }
</style>

<style media="print">
.page-break {
    page-break-before: always;
    break-before: page;
  }

  .content-wrapper:first-child {
    page-break-before: auto !important;
  }

  body {
    margin: 0;
  }

  .content-wrapper {
    page-break-inside: avoid;
    break-inside: avoid;
  }

  @page {
    size: A4 portrait;
    margin: 15mm;
  }

  .box-footer2, .noprint {
    display: none;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    page-break-inside: auto;
  }

  tr {
    page-break-inside: avoid;
    page-break-after: auto;
  }

  h3 {
    font-size: 16pt;
  }
</style>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    var table
    $(document).ready(function() {
        
        
    });
</script>