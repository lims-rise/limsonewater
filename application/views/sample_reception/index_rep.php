<style>
@media print{
    .noprint{
        display:none;
    }
@page { margin: 0; }
body { margin: 1.6cm; }
 }

.tab1 { tab-size: 2; }

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
<h3 class="text-center">CERTIFICATE OF ANALYSIS</h3>
<input type='hidden' id='id_project' value='<?php echo $id_project; ?>'>

<!-- <table id="mytable1" width=50%; style="border:0px solid black; margin-left:auto;margin-right:auto;"> -->
<!-- Table 1: Report Header Information -->
<table id="report-header" width="50%" style="border:0px solid black; margin-bottom: 0; border-collapse: collapse;">
    <thead>
        <tr>
            <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Report Number</td>
            <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">0910291029</td>
        </tr>
        <tr>
            <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Report issue date</td>
            <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">2025-04-21</td>
        </tr>
    </thead>
</table>

<!-- Separator Line -->
<div style="width: 50%; border-top: 1px solid #ddd; margin: 5px 0;"></div>

<!-- Table 2: Project Details -->
<table id="project-details" width="50%" style="border:0px solid black; margin-top: 0; border-collapse: collapse;">
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
        <tr>
            <td width="40%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">ISO or NATA accreditation number/symbol</td>
            <td width="60%" style="border:0px solid black; padding: 3px 0; vertical-align: top;" align="left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
        </tr>
    </thead>
</table>

<!-- <p class="text-left">The results of the verification of the <?php //echo $chem_parameter ?> as <?php //echo $chem2 ?> (<?php //echo $chem3 ?>) test method spectrophotometrically with the determination of trueness, bias and method precision are as follows:
    </p> -->
<!-- <h4 class="text-right">Date : <?php //echo $date_invoice ?></h4> -->
</br>

<!-- <table id="tabletop" width=100%; style="border:0px solid black; margin-left:auto;margin-right:auto;">
    <tr>
    <td align="left"><b>Table 1. Information <?php // echo $chem_parameter ?> as <?php //echo $chem2 ?> in CRM </b> </td>
    </tr>
    <tr> <td> </br> </td></tr>
    
    <tr>
    <table id="mytable1" width=50%; style="border:0px solid black; margin-left:auto;margin-right:auto;">
        <thead>
            <tr style="border:0px solid black;">
                <td colspan="2" align="center">Information Certificate of Analysis <?php //echo $chem3 ?></td>
            </tr>
            <tr>
                <td width=40%; style="border:0px solid black;" align="center">Mixture Name</td>
                <td width=60%; style="border:0px solid black;" align="center"><?php //echo $mixture_name ?></td>
            </tr>
            <tr>
                <td width=40%; style="border:0px solid black;" align="center">Sample No.</td>
                <td width=60%; style="border:0px solid black;" align="center"><?php //echo $sample_no ?></td>
            </tr>
            <tr>
                <td width=40%; style="border:0px solid black;" align="center">Lot. No.</td>
                <td width=60%; style="border:0px solid black;" align="center"><?php// echo $lot_no ?></td>
            </tr>
            <tr>
                <td width=40%; style="border:0px solid black;" align="center">Exp. date</td>
                <td width=60%; style="border:0px solid black;" align="center"><?php// echo $date_expired ?></td>
            </tr>
            <tr>
                <td width=40%; style="border:0px solid black;" align="center">Certified Value</td>
                <td width=60%; style="border:0px solid black;" align="center"><?php //echo $cert_value ?></td>
            </tr>
            <tr>
                <td width=40%; style="border:0px solid black;" align="center">Uncertainty</td>
                <td width=60%; style="border:0px solid black;" align="center"><?php //echo $uncertainty ?></td>
            </tr>
        </thead>
    </table>
    </br>
    </br>
    </tr>
    <tr>
    <td align="left"><b>Table 3. Results of Analysis</b> </td>
    </tr>
    <tr>
    </br>
    <table id="mytable2" style="border:0px solid black; margin-left:auto;margin-right:auto;">
        <thead>
            <tr>
                <td width=100px; style="border:0px solid black;" align="center"><b>Duplication</b></td>
                <td width=100px; style="border:0px solid black;" align="center"><b>Result (mg/L)</b></td>
                <td width=100px; style="border:0px solid black;" align="center"><b>Trueness (%R)</b></td>
                <td width=100px; style="border:0px solid black;" align="center"><b>% Bias Method</b></td>
            </tr>

            <?php// foreach ($response as $row): ?>
            <tr>
                <td style="border:0px solid black;" align="center"><?php //echo $row->duplication; ?></td>
                <td style="border:0px solid black;" align="center"><?php //echo $row->result; ?></td>
                <td style="border:0px solid black;" align="center"><?php //echo $row->trueness; ?></td>
                <td style="border:0px solid black;" align="center"><?php //echo $row->bias_method; ?></td>
            </tr>
            <?php //endforeach; ?>
            <tr>
                <td style="border:0px solid black;" align="center"><b>Total</b></td>
                <td style="border:0px solid black;" align="center"><?php //echo $tot_result; ?></td>
                <td style="border:0px solid black;" align="center"><?php //echo $tot_trueness; ?></td>
                <td style="border:0px solid black;" align="center"><?php //echo $tot_bias; ?></td>
            </tr>
            <tr>
                <td style="border:0px solid black;" align="center"><b>Average</b></td>
                <td style="border:0px solid black;" align="center"><?php //echo $avg_result; ?></td>
                <td style="border:0px solid black;" align="center"><?php //echo $avg_trueness; ?></td>
                <td style="border:0px solid black;" align="center"><?php //echo $avg_bias; ?></td>
            </tr>
            <tr>
                <td style="border:0px solid black;" align="center"><b>SD</b></td>
                <td style="border:0px solid black;" align="center"><?php //echo $sd; ?></td>
                <td style="border:0px solid black;" align="center"></td>
                <td style="border:0px solid black;" align="center"></td>
            </tr>
            <tr>
                <td style="border:0px solid black;" align="center"><b>%RSD</b></td>
                <td style="border:0px solid black;" align="center"><?php //echo $rsd; ?></td>
                <td style="border:0x solid black;" align="center"></td>
                <td style="border:0px solid black;" align="center"></td>
            </tr>
            <tr>
                <td style="border:0px solid black;" align="center"><b>%CV Horwits</b></td>
                <td style="border:0px solid black;" align="center"><?php //echo $cv_horwits; ?></td>
                <td style="border:0px solid black;" align="center"></td>
                <td style="border:0px solid black;" align="center"></td>
            </tr>
            <tr>
                <td style="border:0px solid black;" align="center"><b>0.67 x %CV</b></td>
                <td style="border:0px solid black;" align="center"><?php //echo $cv; ?></td>
                <td style="border:0px solid black;" align="center"></td>
                <td style="border:0px solid black;" align="center"></td>
            </tr>
            
        </thead>
    </table>
    </br>
    </br>
    </tr>
    <tr>
    <td align="left"><b>Table 4. Acceptance %RSD dan %R for determination Accuracy, Precision and Bias Method</b> </td>
    </br>
    </tr>
    <tr>
    </br>
    <table id="mytable3" style="border:0px solid black; margin-left:auto;margin-right:auto;">
        <thead>
            <tr>
                <td width=100px; style="border:0px solid black;" align="center"><b>Parameter</b></td>
                <td width=150px; style="border:0px solid black;" align="center"><b>Requirements</b></td>
                <td width=100px; style="border:0px solid black;" align="center"><b>Results</b></td>
                <td width=100px; style="border:0px solid black;" align="center"><b>Conclusion</b></td>
            </tr>
            <tr>
                <td style="border:0px solid black;" align="center"><b>Precision</b></td>
                <td style="border:0px solid black;" align="center">% RSD ≤ <?php //echo $cv; ?></td>
                <td style="border:0px solid black;" align="center"><?php //echo $rsd; ?></td>
                <td style="border:0px solid black;" align="center"><?php //echo $prec; ?></td>
            </tr>
            <tr>
                <td style="border:0px solid black;" align="center"><b>Accuracy</b></td>
                <td style="border:0px solid black;" align="center">80% ≤ %R ≤ 115%</td>
                <td style="border:0px solid black;" align="center"><?php //echo $avg_trueness; ?></td>
                <td style="border:0px solid black;" align="center"><?php //echo $accuracy; ?></td>
            </tr>
            <tr>
                <td style="border:0px solid black;" align="center"><b>Bias</b></td>
                <td style="border:0px solid black;" align="center">-20% ≤ Bias ≤ 15</td>
                <td style="border:0px solid black;" align="center"><?php //echo $avg_bias; ?></td>
                <td style="border:0px solid black;" align="center"><?php //echo $bias; ?></td>
            </tr>
        </thead>
    </table>
    </tr>

    <tr>
    </br>
    <table id="mytable3" style="border:0px solid black; margin-left:auto;margin-right:auto;">
        <thead>
            <tr>
                <td width=155px; style="border:0px solid black;" align="center"><b>Date of Conducted</b></td>
                <td width=300px; style="border:0px solid black;" align="center"><b><?php //echo $date_spec; ?></b></td>
            </tr>
            <tr>
                <td style="border:0px solid black;" align="center"><b>Place of Conducted</b></td>
                <td style="border:0px solid black;" align="center">RISE Laboratory</td>
            </tr>
            <tr>
                <td style="border:0px solid black;" align="center"><b>Analyst</b></td>
                <td style="border:0px solid black;" align="center"><?php //echo $realname; ?></td>
            </tr>
        </thead>
    </table>
    </tr>
    <tfoot>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
        <tr>
        <td>Copyright © 2022-2023 LIMS-RISE | RISE Data Team. All rights reserved.</td>
        </tr>
    </tfoot>
</table> -->



<!-- <div class="footer">
           <img src="../../../assets/img/dot.jpg" width="1025px" height="400px" class="icon" style="padding: 70px; float: left;">
     </div> -->
</div>
</div>
</div>
</div>
</section>    
</div>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            var table
            $(document).ready(function() {
                // var id_del = $('#id_delivery').val();
				// var base_url = location.hostname;

                // table = $("#mytable2").DataTable({
                //     oLanguage: {
                //         sProcessing: "loading..."
                //     },
                //     processing: true,
                //     serverSide: true,
                //     paging: false,
                //     ordering: false,
                //     info: false,
                //     bFilter: false,
                //     ajax: {"url": "wat_water_spectroqc/spec_printdet?id="+id_spec, "type": "POST"},
                //     columnDefs: [
                //         {
                //         targets: [4,5],
                //         className: 'text-right'
                //         }
                //     ],
                //     columns: [
                //         // {
                //         //     "data": "id_delivery_det",
                //         //     "orderable": false
                //         // },
                //         {"data": "duplication"},
                //         {"data": "result"},
                //         {"data": "trueness"},
                //         {"data": "bias_method"},
                //     ]
                // });
               
            });
        </script>