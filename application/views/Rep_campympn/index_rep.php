<style>
@media print{
    .noprint{
        display:none;
    }
    .highlight-background {
        color: #ffffff !important; /* White text */
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%; /* Ensures vertical centering */
        text-align: center;
        background-color: #37CACA !important; /* Replace with your desired color */
        -webkit-print-color-adjust: exact; /* For WebKit browsers */
        print-color-adjust: exact;         /* For other browsers */
    }    
    .page-break {
        page-break-before: always;
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
<img src="../../../img/one_water.png" width="213px" class="icon" style="padding: 10px; float: left;">
<h3>LIMS - Campylobacter-MPN Report</h3>
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
<div class="box highlight-background" style="background-color: #37CACA; color: #000000;">
    <h3 class="text-center">CERTIFICATE OF ANALYSIS</h3>
</div>
<input type='hidden' id='id_spec' value='<?php echo $id_spec; ?>'>
<!-- <h4 class="text-right">Date : <?php //echo $date_invoice ?></h4> -->
</br>

<table id="tabletop" width=100%; style="border:0px solid black; margin-left:auto;margin-right:auto;">
    <tr>
        <td align="left"><b>Basic information:</b> </td>
    </tr>
    <tr> <td> </br> </td></tr>
    
    <tr>
    <table id="mytable1" width=50%; style="border:0px solid black;">
        <thead>
            <tr>
                <td width=300px; style="border:0px solid black;" align="left">Report Number</td>
                <td width=30px; style="border:0px solid black;" align="left">:</td>
                <td width=300px; style="border:0px solid black;" align="left"><?php  ?></td>
            </tr>
            <tr>
                <td width=300px; style="border:0px solid black;" align="left">Report issue date</td>
                <td width=30px; style="border:0px solid black;" align="left">:</td>
                <td width=300px; style="border:0px solid black;" align="left"><b><?php echo $date_report ?></b></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td width=300px; style="border:0px solid black;" align="left">ID Project</td>
                <td width=30px; style="border:0px solid black;" align="left">:</td>
                <td width=300px; style="border:0px solid black;" align="left"><b><?php echo $id_project ?></b></td>
            </tr>
            <tr>
                <td width=300px; style="border:0px solid black;" align="left">Client</td>
                <td width=30px; style="border:0px solid black;" align="left">:</td>
                <td width=300px; style="border:0px solid black;" align="left"><?php echo $id_client_sample ?></td>
            </tr>
            <tr>
                <td width=300px; style="border:0px solid black;" align="left">Client contact details</td>
                <td width=30px; style="border:0px solid black;" align="left">:</td>
                <td width=300px; style="border:0px solid black;" align="left"><?php ?></td>
            </tr>
            <tr>
                <td width=300px; style="border:0px solid black;" align="left">Date received</td>
                <td width=30px; style="border:0px solid black;" align="left">:</td>
                <td width=300px; style="border:0px solid black;" align="left"><?php echo $date_arrival ?></td>
            </tr>
            <tr>
                <td width=300px; style="border:0px solid black;" align="left">Test signatories</td>
                <td width=30px; style="border:0px solid black;" align="left">:</td>
                <td width=300px; style="border:0px solid black;" align="left"><?php echo $realname ?></td>
            </tr>
            <tr>
                <td width=300px; style="border:0px solid black;" align="left">ISO or NATA accreditation number/symbol</td>
                <td width=30px; style="border:0px solid black;" align="left">:</td>
                <td width=300px; style="border:0px solid black;" align="left"><?php  ?></td>
            </tr>
        </thead>
    </table>
    </br>
    </br>
    </tr>
    <div class="page-break">
    </br>
    </br>
    </div>
    <tr class="page-break">
    <td align="left"><b>Table 3. Results of Analysis</b> </td>
    </tr>
    <!-- <tr> <td> </br> </td></tr> -->
    <tr>
    </br>
    <table id="mytable2" style="border:1px solid black; margin-left:auto;margin-right:auto;">
        <thead>
            <tr>
                <td width=100px; style="border:1px solid black;" align="center"><b>Duplication</b></td>
                <td width=100px; style="border:1px solid black;" align="center"><b>Result (mg/L)</b></td>
                <td width=100px; style="border:1px solid black;" align="center"><b>Trueness (%R)</b></td>
                <td width=100px; style="border:1px solid black;" align="center"><b>% Bias Method</b></td>
            </tr>
        </thead>
    </table>
    </br>
    </br>
    </tr>
    <!-- <tr> <td> </br> </td></tr> -->
    <tr>
    <td align="left"><b>Table 4. Acceptance %RSD dan %R for determination Accuracy, Precision and Bias Method</b> </td>
    </br>
    </tr>
    <tr>
    </br>
    <table id="mytable3" style="border:1px solid black; margin-left:auto;margin-right:auto;">
        <thead>
            <tr>
                <td width=100px; style="border:1px solid black;" align="center"><b>Parameter</b></td>
                <td width=150px; style="border:1px solid black;" align="center"><b>Requirements</b></td>
                <td width=100px; style="border:1px solid black;" align="center"><b>Results</b></td>
                <td width=100px; style="border:1px solid black;" align="center"><b>Conclusion</b></td>
            </tr>

        </thead>
    </table>
    </tr>

    <tr>
    </br>
    <table id="mytable3" style="border:1px solid black; margin-left:auto;margin-right:auto;">
        <thead>
            <tr>
                <td width=155px; style="border:1px solid black;" align="center"><b>Date of Conducted</b></td>
                <td width=300px; style="border:1px solid black;" align="center"><b><?php echo $date_report; ?></b></td>
            </tr>
            <tr>
                <td style="border:1px solid black;" align="center"><b>Place of Conducted</b></td>
                <td style="border:1px solid black;" align="center">Onewater Laboratory</td>
            </tr>
            <tr>
                <td style="border:1px solid black;" align="center"><b>Analyst</b></td>
                <td style="border:1px solid black;" align="center"><?php echo $realname; ?></td>
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
        <td>Copyright © 2024 LIMS-Onewater | Onewater Team. All rights reserved.</td>
        </tr>
    </tfoot>
</table>



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
                var id_del = $('#id_delivery').val();
				var base_url = location.hostname;

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
                //     ajax: {"url": "Rep_campy/spec_printdet?id="+id_spec, "type": "POST"},
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