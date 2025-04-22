<style>
@media print{
    .noprint{
        display:none;
    }
@page { margin: 0; }
body { margin: 1.6cm; }
 }

.tab1 { tab-size: 2; }

@media print {
  h3 {
    color: white !important;
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
  }
}

</style>


<div class="content-wrapper">

<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
<!-- <img src="../../../assets/img/header_inv_02.png" width="1025px" class="icon" style="padding: 10px; float: left;"> -->
<img src="../../../img/onewaterlogo.png" height="40px" class="icon" style="padding: 0px; float: left;">
<img src="../../../img/monash.png" height="40px" class="icon" style="padding: 0px; float: right;">
<!-- <h3>LIMS - REPORT</h3> -->
<div class="noprint">
    <div class="modal-footer clearfix">
        <button id='print' class="btn btn-primary no-print" onclick="document.title = '<?php echo 'Print_Spectro_CRM'?>'; window.print();"><i class="fa fa-print"></i> Print</button>
        <button id='close' class="btn btn-warning" onclick="javascript:history.go(-1);"><i class="fa fa-times"></i> Close</button> 
    </div>
</div>
<!-- // <h4 class=text-right>Invoice : $invoice_number </h4>
// <h4 class=text-right>Date : $date_invoice </h4> -->
</div>

<?php

// $q = $this->db->query('SELECT duplication, result, trueness, bias_method FROM obj2b_spectro_crm_det
// WHERE flag = 0
// AND id_spec="'.$id_spec.'"
// ORDER BY duplication');        

// $response = $q->result();

?>


<div class="box">
<div style="position: relative; height: 40px; margin-bottom: 10px;">
  <img src="../../../img/bluebar.png" 
       style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0;" 
       alt="Background" />
  <h3 style="position: relative; z-index: 1; margin: 0; line-height: 40px; color: white; text-align: center; font-size: 18px;">
    CERTIFICATE OF ANALYSIS
  </h3>
</div>

<!-- <h3 class="text-center">CERTIFICATE OF ANALYSIS</h3> -->
<!-- <h3 class="text-center" style="color: white; padding: 10px;">
  CERTIFICATE OF ANALYSIS
</h3> -->

<input type='hidden' id='id_project' value='<?php echo $id_project; ?>'>


<div style="display: flex; justify-content: space-between; width: 100%;">
    <!-- Left Column (Your existing tables) -->
    <div style="width: 49%;">
        <table id="report-header" width="100%" style="border:0px solid black; margin-bottom: 0; border-collapse: collapse;">
            <thead>
                <tr>
                    <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Report Number</td>
                    <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">25-10299</td>
                </tr>
                <tr>
                    <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Report issue date</td>
                    <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo date('Y-m-d'); ?></td>
                </tr>
            </thead>
        </table>

        <!-- Separator Line -->
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
                    <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $id_client_sample ?></td>
                </tr>
                <tr>
                    <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Date received</td>
                    <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $date_collected ?></td>
                </tr>
                <tr>
                    <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Time received</td>
                    <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $time_collected ?></td>
                </tr>
                <tr>
                    <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Test signatories</td>
                    <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left"><?php echo $realname ?></td>
                </tr>

            </thead>
        </table>
    </div>

    <!-- Right Column (New table) -->
    <div style="width: 49%;">
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
    </div>
</div>

<div style="width: 100%; border-top: 0px solid #ddd; margin: 30px 0;"></div>

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
</div>

</div>
</div>
</div>
</div>
</section>    
</div>
<footer>
<div style="width: 60%; margin: 40px auto 0 auto; border-top: 3px solid black;"></div>
</footer>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            var table
            $(document).ready(function() {
                
               
            });
        </script>