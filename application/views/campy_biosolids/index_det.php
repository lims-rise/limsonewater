<div class="content-wrapper">
	<section class="content">
		<div class="box box-black box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Processing | Campy Biosolids | Details</h3>
			</div>
				<form role="form"  id="formKeg" method="post" class="form-horizontal">
					<div class="box-body">
						<!-- <input type="hidden" class="form-control " id="id_req" name="id_req" value="<?php// echo $id_req ?>"> -->
						<input id="id_campy_biosolids" name="id_campy_biosolids" type="hidden" class="form-control input-sm" value="<?php echo $id_campy_biosolids ?>">
						<div class="form-group">
							<label for="id_one_water_sample" class="col-sm-2 control-label">One Water Sample ID</label>
							<div class="col-sm-4">
								<input class="form-control " id="id_one_water_sample" name="id_one_water_sample" value="<?php echo $id_one_water_sample ?>"  disabled>
							</div>

							<label for="initial" class="col-sm-2 control-label">Lab Tech</label>
							<div class="col-sm-4">
								<input class="form-control " id="initial" name="initial" value="<?php echo $initial ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="number_of_tubes" class="col-sm-2 control-label">Number of Assay Tubes</label>
							<div class="col-sm-4">
								<input class="form-control " id="number_of_tubes" name="number_of_tubes" value="<?php echo $number_of_tubes ?>"  disabled>
							</div>

							<label for="sampletype" class="col-sm-2 control-label">Sample Type</label>
							<div class="col-sm-4">
								<input class="form-control " id="sampletype" name="sampletype" value="<?php echo $sampletype ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="mpn_pcr_conducted" class="col-sm-2 control-label">MPN PCR Conducted</label>
							<div class="col-sm-4">
								<input class="form-control " id="mpn_pcr_conducted" name="mpn_pcr_conducted" value="<?php echo $mpn_pcr_conducted ?>"  disabled>
							</div>

							<label for="campy_assay_barcode" class="col-sm-2 control-label">Campy Assay Barcode</label>
							<div class="col-sm-4">
								<input class="form-control " id="campy_assay_barcode" name="campy_assay_barcode" value="<?php echo $campy_assay_barcode ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="date_sample_processed" class="col-sm-2 control-label">Date Sample</label>
							<div class="col-sm-4">
								<input class="form-control " id="date_sample_processed" name="date_sample_processed" value="<?php echo $date_sample_processed ?>" disabled>
							</div>

							<label for="time_sample_processed" class="col-sm-2 control-label">Time Sample</label>
							<div class="col-sm-4">
								<input class="form-control " id="time_sample_processed" name="time_sample_processed" value="<?php echo $time_sample_processed ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="sample_wetweight" class="col-sm-2 control-label">Sample Wet Weight</label>
							<div class="col-sm-4">
								<input class="form-control " id="sample_wetweight" name="sample_wetweight" value="<?php echo $sample_wetweight ?>"  disabled>
							</div>

                            <label for="elution_volume" class="col-sm-2 control-label">Elution Volume</label>
							<div class="col-sm-4">
								<input class="form-control " id="elution_volume" name="elution_volume" value="<?php echo $elution_volume ?>"  disabled>
							</div>
						</div>

					</div><!-- /.box-body -->
				</form>
			<div class="box-footer">
                <!-- <div class="row"> -->
                    <div class="col-xs-12"> 
                        <div class="box box-primary box-solid">
                            <div class="box-header">
                                <h3 class="box-title">Results Charcoal</h3>
                            </div>
							<div class="box-body pad table-responsive">
								<?php
									$lvl = $this->session->userdata('id_user_level');
									if ($lvl != 4){
										echo "<button class='btn btn-primary' id='addtombol_detResultsCharcoal'><i class='fa fa-wpforms' aria-hidden='true'></i> New Data</button>";
									}
								?>
								<table id="example2" class="table display table-bordered table-striped" width="100%">
									<thead>
										<tr>
                                            <th>Campy Assay Barcode</th>
                                            <th>Date of Sample</th>
                                            <th>Time of Sample</th>
                                            <th>Growth Plate</th>
                                            <th>Action</th>
										</tr>
									</thead>
								</table>
							</div> <!--/.box-body  -->
                        </div><!-- box box-warning -->
                    </div>  <!--col-xs-12 -->

                    <div class="col-xs-12"> 
                        <div class="box box-primary box-solid">
                            <div class="box-header">
                                <h3 class="box-title">Results HBA</h3>
                            </div>
							<div class="box-body pad table-responsive">
								<?php
									$lvl = $this->session->userdata('id_user_level');
									if ($lvl != 4){
										echo "<button class='btn btn-primary' id='addtombol_detResultsHBA'><i class='fa fa-wpforms' aria-hidden='true'></i> New Data</button>";
									}
								?>
								<table id="example2" class="table display table-bordered table-striped" width="100%">
									<thead>
										<tr>
                                            <th>Campy Assay Barcode</th>
                                            <th>Date of Sample</th>
                                            <th>Time of Sample</th>
                                            <th>Growth Plate</th>
                                            <th>Action</th>
										</tr>
									</thead>
								</table>
							</div> <!--/.box-body  -->
                        </div><!-- box box-warning -->
                    </div>  <!--col-xs-12 -->

				<div class="form-group">
					<div class="modal-footer clearfix">
						<button type="button" name="batal" value="batal" class="btn btn-warning" onclick="window.location.href='<?= site_url('campy_biosolids'); ?>';">
							<i class="fa fa-times"></i> Close
						</button>
					</div>
				</div>
			</div> <!--footer -->
		</div>
	</section>
</div>

<!-- MODAL FORM Results Charcoal -->
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-scrollable="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                        <h4 class="modal-title" id="modal-title-detail">
							<span id="my-another-cool-loader"></span></h4>
                    </div>
                        <form id="formDetail24" action=<?php echo site_url('Campy_biosolids/saveResultsCharcoal') ?> method="post" class="form-horizontal">
                            <div class="modal-body">
                                <div class="form-group">
                                        <div class="col-sm-9">
                                            <input id="mode_detResultsCharcoal" name="mode_detResultsCharcoal" type="hidden" class="form-control input-sm">
                                            <!-- <input id="idx_moisture24" name="idx_moisture24" type="hidden" class="form-control input-sm">
                                            <input id="id_moisture24" name="id_moisture24" type="hidden" class="form-control input-sm"> -->
                                            <input id="id_campy_biosolids1" name="id_campy_biosolids1" type="hidden" class="form-control input-sm">
                                            <input id="number_of_tubes1" name="number_of_tubes1" type="hidden" class="form-control input-sm">
                                            <input id="id_result_charcoal" name="id_result_charcoal" type="hidden" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="campy_assay_barcode1" class="col-sm-4 control-label">Campy Assay Barcode</label>
                                        <div class="col-sm-8">
                                            <input id="campy_assay_barcode1" name="campy_assay_barcode1" type="text"  placeholder="Campy Assay Barcode" class="form-control">
                                            <div class="val1tip"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="date_sample_processed1" class="col-sm-4 control-label">Date Sample Processed</label>
                                        <div class="col-sm-8">
                                            <input id="date_sample_processed1" name="date_sample_processed1" type="date" class="form-control" placeholder="Date Sample Processed" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="time_sample_processed1" class="col-sm-4 control-label">Time Sample Processed</label>
                                        <div class="col-sm-8">
                                            <div class="input-group clockpicker">
                                                <input id="time_sample_processed1" name="time_sample_processed1" class="form-control" placeholder="Time Sample Processed" value="<?php echo (new DateTime())->format('H:i'); ?>">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" id="growth_plate">
                                        <label class="col-sm-4 control-label">Growth Plate</label>
                                        <div class="col-sm-8" id="growthPlateInputs">
                                            <!-- Radio buttons akan dihasilkan di sini -->
                                        </div>
                                    </div>


                            </div>
                            <div class="modal-footer clearfix">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                <button type="button" id='cancelButton' class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                            </div>
                        </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

<!-- MODAL FORM Results HBA -->
<!-- <div class="modal fade" id="compose-modalHBA" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                        <h4 class="modal-title" id="modal-title-detail72">
							<span id="my-another-cool-loader"></span></h4>
                    </div>
                        <form id="formDetail72" action=<?php echo site_url('Moisture_content/savedetail72') ?> method="post" class="form-horizontal">
                            <div class="modal-body">
                                <div class="form-group">
                                        <div class="col-sm-9">
                                            <input id="mode_det72" name="mode_det72" type="hidden" class="form-control input-sm">
                                            <input id="idx_moisture72" name="idx_moisture72" type="hidden" class="form-control input-sm">
                                            <input id="id_moisture72" name="id_moisture72" type="hidden" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="date_moisture72" class="col-sm-4 control-label">Date Moisture</label>
                                        <div class="col-sm-8">
                                            <input id="date_moisture72" name="date_moisture72"type="date" class="form-control" placeholder="Date Moisture" value="<?php echo date("Y-m-d"); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="time_moisture72" class="col-sm-4 control-label">Time Moisture Tested</label>
                                        <div class="col-sm-8">
                                            <div class="input-group clockpicker">
                                            <input id="time_moisture72" name="time_moisture72" class="form-control" placeholder="Time Moisture Tested" value="<?php 
                                            $datetime = new DateTime();
                                            echo $datetime->format( 'H:i' );
                                            ?>">
                                            <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="barcode_tray72" class="col-sm-4 control-label">Barcode Tray</label>
                                        <div class="col-sm-8">
                                            <input id="barcode_tray72" name="barcode_tray72" type="text"  placeholder="Barcode Tray" class="form-control" required>
                                            <div class="val2tip"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="dry_weight72" class="col-sm-4 control-label">Dry Weight 72h (g)</label>
                                        <div class="col-sm-8 dryweightcount">
                                            <input id="dry_weight72" name="dry_weight72" type="number" step="0.01"  placeholder="Dry Weight 72h (g)" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="dry_weight_persen" class="col-sm-4 control-label">Dry Weight %</label>
                                        <div class="col-sm-8">
                                            <input id="dry_weight_persen" name="dry_weight_persen" type="number" step="0.01"  placeholder="Dry Weight %" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="comments72" class="col-sm-4 control-label">Comments</label>
                                        <div class="col-sm-8">
                                            <textarea id="comments72" name="comments72" class="form-control" placeholder="Comments"></textarea>
                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer clearfix">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                <button type="button" id='cancelButton' class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                            </div>
                        </form>
                </div>
            </div>
</div> -->
<div class="modal fade" id="compose-modalHBA" tabindex="-1" role="dialog" aria-hidden="true" data-bs-scrollable="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                        <h4 class="modal-title" id="modal-title-HBA">
							<span id="my-another-cool-loader"></span></h4>
                    </div>
                        <form id="formDetail24" action=<?php echo site_url('Campy_biosolids/saveResultsHBA') ?> method="post" class="form-horizontal">
                            <div class="modal-body">
                                <div class="form-group">
                                        <div class="col-sm-9">
                                            <input id="mode_detResultsHBA" name="mode_detResultsHBA" type="hidden" class="form-control input-sm">
                                            <!-- <input id="idx_moisture24" name="idx_moisture24" type="hidden" class="form-control input-sm">
                                            <input id="id_moisture24" name="id_moisture24" type="hidden" class="form-control input-sm"> -->
                                            <input id="id_campy_biosolids1" name="id_campy_biosolids1" type="hidden" class="form-control input-sm">
                                            <input id="number_of_tubes1" name="number_of_tubes1" type="hidden" class="form-control input-sm">
                                            <input id="id_result_charcoal" name="id_result_charcoal" type="hidden" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="campy_assay_barcode1" class="col-sm-4 control-label">Campy Assay Barcode</label>
                                        <div class="col-sm-8">
                                            <input id="campy_assay_barcode1" name="campy_assay_barcode1" type="text"  placeholder="Campy Assay Barcode" class="form-control">
                                            <div class="val1tip"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="date_sample_processed1" class="col-sm-4 control-label">Date Sample Processed</label>
                                        <div class="col-sm-8">
                                            <input id="date_sample_processed1" name="date_sample_processed1" type="date" class="form-control" placeholder="Date Sample Processed" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="time_sample_processed1" class="col-sm-4 control-label">Time Sample Processed</label>
                                        <div class="col-sm-8">
                                            <div class="input-group clockpicker">
                                                <input id="time_sample_processed1" name="time_sample_processed1" class="form-control" placeholder="Time Sample Processed" value="<?php echo (new DateTime())->format('H:i'); ?>">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" id="growth_plateHBA">
                                        <label class="col-sm-4 control-label">Growth Plate</label>
                                        <div class="col-sm-8" id="growthPlateInputsHBA">
                                            <!-- Radio buttons akan dihasilkan di sini -->
                                        </div>
                                    </div>


                            </div>
                            <div class="modal-footer clearfix">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                <button type="button" id='cancelButton' class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                            </div>
                        </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- MODAL INFORMATION -->
<div class="modal fade" id="confirm-modal" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #f39c12; color: white;">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
					<h4 class="modal-title">Moisture Content | Information</h4>
				</div>
                <div id="confirmation-content">
                    <div class="modal-body">
                    </div>
                </div>
				<div class="modal-footer clearfix">
					<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Close </button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- MODAL CONFIRMATION DELETE -->
<div class="modal fade" id="confirm-modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div id="confirmation-content">
                    <div class="modal-body">
                        <p class="text-center" style="font-size: 15px;">Are you sure you want to delete ID <span id="id" style="font-weight: bold;"></span> ?</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer clearfix">
                <button type="button" id="confirm-delete" class="btn btn-danger"><i class="fa fa-trash"></i> Yes</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    let table;
    let table1;
    let id_moisture = $('#id_moisture').val();
    let campy_assay_barcode = $('#campy_assay_barcode').val();
    let id_campy_biosolids = $('#id_campy_biosolids').val();
    let number_of_tubes = $('#number_of_tubes').val();
    const BASE_URL = '/limsonewater/index.php';

    $(document).ready(function() {

        // $('#number_of_tubes').change(function() {
        //     let numberOfTubes = parseInt($(this).val()); // Get the selected value as an integer
        //     let growthPlateInputs = $('#growthPlateInputs');
        //     growthPlateInputs.empty(); // Clear existing inputs
        //     let growthPlateInputsHBA = $('#growthPlateInputsHBA');
        //     growthPlateInputsHBA.empty(); // Clear existing inputs

        //     // Create the required number of inputs and labels
        //     for (let i = 1; i <= numberOfTubes; i++) {
        //         growthPlateInputs.append(
        //         `<div class="d-flex align-items-center mb-2">
        //             <label class="control-label me-3" style="margin-bottom: 0; line-height: 1.5;">Growth Plate ${i}:</label>
        //             <div class="d-flex align-items-center">
        //                 <label class="radio-inline me-2" style="margin-bottom: 0;">
        //                     <input type="radio" name="growth_plate${i}" value="Yes"> Yes
        //                 </label>
        //                 <label class="radio-inline" style="margin-bottom: 0;">
        //                     <input type="radio" name="growth_plate${i}" value="No"> No
        //                 </label>
        //             </div>
        //         </div>`
        //     );


        //     }
        // }).trigger('change');

        function generateGrowthPlateInputs(container, numberOfTubes) {
            container.empty(); // Clear existing inputs

            // Create the required number of inputs and labels
            for (let i = 1; i <= numberOfTubes; i++) {
                container.append(
                    `<div class="d-flex align-items-center mb-2">
                        <label class="control-label me-3" style="margin-bottom: 0; line-height: 1.5;">Growth Plate ${i}:</label>
                        <div class="d-flex align-items-center">
                            <label class="radio-inline me-2" style="margin-bottom: 0;">
                                <input type="radio" name="growth_plate${i}" value="Yes"> Yes
                            </label>
                            <label class="radio-inline" style="margin-bottom: 0;">
                                <input type="radio" name="growth_plate${i}" value="No"> No
                            </label>
                        </div>
                    </div>`
                );
            }
        }

        $('#number_of_tubes').change(function() {
            let numberOfTubes = parseInt($(this).val()); // Get the selected value as an integer
            generateGrowthPlateInputs($('#growthPlateInputs'), numberOfTubes);
            generateGrowthPlateInputs($('#growthPlateInputsHBA'), numberOfTubes);
        }).trigger('change');



        function showConfirmationDelete(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal-delete').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete24, .btn_delete72', function() {
            let id = $(this).data('id');
            let url;
            if ($(this).hasClass('btn_delete24')) {
                url = '<?php echo site_url('Moisture_content/delete_detail24'); ?>/' + id;
                $('.modal-title').html('<i class="fa fa-trash"></i> 24 Hour Moisture | Delete <span id="my-another-cool-loader"></span>');
                $('#confirm-modal-delete #id').text(id);
            } else if ($(this).hasClass('btn_delete72')) {
                url = '<?php echo site_url('Moisture_content/delete_detail72'); ?>/' + id;
                $('.modal-title').html('<i class="fa fa-trash"></i> 72 Hour Moisture | Delete <span id="my-another-cool-loader"></span>');
                $('#confirm-modal-delete #id').text(id);
            }

            showConfirmationDelete(url);

        });

        // When the confirm-delete button is clicked
        $('#confirm-delete').click(function() {
            $.ajax({
                url: deleteUrl,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                complete: function() {
                    $('#confirm-modal-delete').modal('hide');
                    location.reload();
                }
            });
        });


        $('.noEnterSubmit').keypress(function (e) {
            if (e.which == 13) return false;
        });

        $('.clockpicker').clockpicker({
            placement: 'bottom',
            align: 'left',
            donetext: 'Done',
            autoclose: true,
            vibrate: true
        });                

        $('.val1tip, .val2tip').tooltipster({
            animation: 'swing',
            delay: 1,
            theme: 'tooltipster-default',
            autoClose: true,
            position: 'bottom',
        });

        $('#barcode_tray24').click(function() {
            $('.val1tip').tooltipster('hide');   
        });

        $('#barcode_tray72').click(function() {
            $('.val2tip').tooltipster('hide');   
        });

        $('#compose-modal').on('shown.bs.modal', function () {
            $('.val1tip').tooltipster('hide'); 
        });

        $('#compose-modalHBA').on('shown.bs.modal', function () {
            $('.val2tip').tooltipster('hide'); 
        });

        $("input").keypress(function(){
            $('.val1tip').tooltipster('hide'); 
        });

        $("input").keypress(function(){
            $('.val2tip').tooltipster('hide'); 
        });

        $('#compose-modal').on('shown.bs.modal', function () {
            $('#barcode_tray24').focus();
        });

        $('#compose-modalHBA').on('shown.bs.modal', function () {
            $('#dry_weight72').focus();
        });

        $('#barcode_tray24').on("change", function() {
            let barcode24 = $('#barcode_tray24').val();
            $.ajax({
                type: "GET",
                url: `${BASE_URL}/Moisture_content/validate24`,
                data: { id24: barcode24 },
                dataType: "json",
                success: function(data) {
                    if (data.length == 0) {
                        let tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + barcode24 +'</strong> is not on moisture content or is not already in the system !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#barcode_tray24').focus();
                        $('#barcode_tray24').val('');       
                        $('#barcode_tray24').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_tray24').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_tray24').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_tray24').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
        });

        $('#barcode_tray72').on("change", function() {
            let barcode72 = $('#barcode_tray72').val();
            $.ajax({
                type: "GET",
                url: `${BASE_URL}/Moisture_content/validate72`,
                data: { id72: barcode72 },
                dataType: "json",
                success: function(data) {
                    if (data.length == 0) {
                        let tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + barcode72 +'</strong> is not on moisture content or is not already in the system !</span>');
                        $('.val2tip').tooltipster('content', tip);
                        $('.val2tip').tooltipster('show');
                        $('#barcode_tray72').focus();
                        $('#barcode_tray72').val('');       
                        $('#barcode_tray72').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_tray72').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_tray72').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_tray72').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
        });

        // Function to calculate the dry_weight_persen
        function updateDryWeightPersen() {
            let traysampleWetweight = parseFloat($('#traysample_wetweight').val()) || 0; // Get the traysample wet weight
            let dryWeight72 = parseFloat($('#dry_weight72').val()) || 0; // Get the dry weight 72h

            if (traysampleWetweight > 0) { // Ensure traysampleWetweight is not zero to avoid division by zero
                let dryWeightPersen = (1-(((traysampleWetweight - dryWeight72) / dryWeight72) * 100)).toFixed(2); // Calculate percentage
                $('#dry_weight_persen').val(dryWeightPersen); // Update the percentage field
            } else {
                $('#dry_weight_persen').val(''); // Clear the percentage field if traysampleWetweight is zero or invalid
            }
        }

        // Attach the function to the input event of dry_weight72
        $('#dry_weight72').on('input', updateDryWeightPersen);

        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        // $('#example2').on('draw.dt', function() {
        //     let data = table.data();
        //     if (data.length > 0) {
        //         // Tampilkan tombol jika tabel example2 memiliki data
        //         $('#addtombol_det72').show();
        //     } else {
        //         // Sembunyikan tombol jika tabel example2 tidak memiliki data
        //         $('#addtombol_det72').hide();
        //     }
        // });


        table = $("#example2").DataTable({
            oLanguage: {
                sProcessing: "Loading data, please wait..."
            },
            processing: true,
            serverSide: true,
            paging: false,
            info: false,
            bFilter: false,
            ajax: {"url": "../../Campy_biosolids/subjsonCharcoal?idCharcoal="+id_campy_biosolids, "type": "POST"},
            columns: [
                {"data": "campy_assay_barcode"},
                {"data": "date_sample_processed"},
                {"data": "time_sample_processed"},
                {"data": "growth_plate"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[0, 'asc']],
            rowCallback: function(row, data, iDisplayIndex) {
                let info = this.fnPagingInfo();
                if (info.iTotal > 0) {
                    $('#addtombol_detResultsCharcoal').prop("disabled", true);
                } else {
                    $('#addtombol_detResultsCharcoal').show();
                }
            }
        });

        $('#example2 tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }
        });

        table1 = $("#example3").DataTable({
            oLanguage: {
                sProcessing: "Loading data, please wait..."
            },
            processing: true,
            serverSide: true,
            paging: false,
            info: false,
            bFilter: false,
            ajax: {"url": "../../Moisture_content/subjson72?id72="+id_moisture, "type": "POST"},
            columns: [
                {"data": "date_moisture72"},
                {"data": "time_moisture72"}, 
                {"data": "barcode_tray"}, 
                {"data": "dry_weight72"}, 
                {"data": "dry_weight_persen"},
                {"data": "comments72"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[0, 'asc']],
            rowCallback: function(row, data, iDisplayIndex) {
                let info = this.fnPagingInfo();
                if (info.iTotal > 0) {
                    $('#addtombol_detResultsHBA').hide();
                }
            }
        });

        $('#example3 tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table1.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }
        });

        $('#addtombol_detResultsCharcoal').click(function() {
            $('#mode_detResultsCharcoal').val('insert');
            $('#modal-title-detail').html('<i class="fa fa-wpforms"></i> Insert | Results Charcoal <span id="my-another-cool-loader"></span>');
            // $('#barcode_tray24').val('');
            // $('#barcode_tray24').attr('readonly', false);
            // $('#dry_weight24').val('');
            $('#campy_assay_barcode1').val(campy_assay_barcode);
            $('#campy_assay_barcode1').attr('readonly', true);
            $('#id_campy_biosolids1').val(id_campy_biosolids);
            $('#number_of_tubes1').val(number_of_tubes);
            // $('#dry_weight24').val('');
            // $('#comments24').val('');
            $('#compose-modal').modal('show');
        });

        $('#example2').on('click', '.btn_edit_detResultsCharcoal', function() {
            let tr = $(this).closest('tr');
            let data = table.row(tr).data();
            console.log(data);
            $('#mode_detResultsCharcoal').val('edit');
            $('#modal-title-detail').html('<i class="fa fa-pencil-square"></i> Update | Results Charcoal <span id="my-another-cool-loader"></span>');
            $('#id_result_charcoal').val(data.id_result_charcoal);
            $('#campy_assay_barcode1').val(data.campy_assay_barcode);
            $('#campy_assay_barcode1').attr('readonly', true);
            $('#id_campy_biosolids1').val(data.id_campy_biosolids);
            $('#date_sample_processed1').val(data.date_sample_processed);
            $('#time_sample_processed1').val(data.time_sample_processed);
            $('#number_of_tubes1').val(number_of_tubes);

            // Clear existing growthPlateInputs
            let growthPlateInputs = $('#growthPlateInputs');
            growthPlateInputs.empty();

            // split the string into an array
            const growthPlateArray = data.growth_plate.split(', ');
            const plateNumberArray = data.plate_number.split(', ');

            // making the input base on the plate number
            plateNumberArray.forEach((plateNumber, index) => {
                const plate = growthPlateArray[index] || '';

                // decide the value radio selected
                const checkedYes = plate === 'Yes' ? 'checked' : '';
                const checkedNo = plate === 'No' ? 'checked' : '';

                growthPlateInputs.append(
                    `<div class="d-flex align-items-center mb-2">
                        <label class="control-label me-3" style="margin-bottom: 0; line-height: 1.5;">Growth Plate ${plateNumber}:</label>
                        <div class="d-flex align-items-center">
                            <label class="radio-inline me-2" style="margin-bottom: 0;">
                                <input type="radio" id="growth_plate${plateNumber}" name="growth_plate${plateNumber}" value="Yes" ${checkedYes}> Yes
                            </label>
                            <label class="radio-inline" style="margin-bottom: 0;">
                                <input type="radio" id="growth_plate${plateNumber}"  name="growth_plate${plateNumber}" value="No" ${checkedNo}> No
                            </label>
                        </div>
                    </div>`
                );
            });

            $('#compose-modal').modal('show');
        });

        // $('#addtombol_det72').click(function() {
        //     // $('#mode_det72').val('insert');
        //     // $('#modal-title-detail72').html('<i class="fa fa-wpforms"></i> Moisture Content | 72 Hour <span id="my-another-cool-loader"></span>');
        //     // $('#barcode_tray72').val('');
        //     // $('#barcode_tray72').attr('readonly', true);
        //     // $('#barcode_tray72').attr('required', true);
        //     // $('#idx_moisture72').val(id_moisture);
        //     // $('#dry_weight72').val('');
        //     // $('#dry_weight_persen').val('');
        //     // $('#comments72').val('');
        //     // $('#compose-modal72').modal('show');
        // });

        $('#addtombol_detResultsHBA').on('click', function() {
            $('#mode_detResultsHBA').val('insert');
            $('#modal-title-HBA').html('<i class="fa fa-wpforms"></i> Insert | Results HBA <span id="my-another-cool-loader"></span>');
            $('#barcode_tray72').val('');
            $('#barcode_tray72').attr('readonly', true);
            $('#barcode_tray72').attr('required', true);
            $('#idx_moisture72').val(id_moisture);
            $('#dry_weight72').val('');
            $('#dry_weight_persen').val('');
            $('#comments72').val('');
            $('#compose-modalHBA').modal('show');

            // let td = $('#example2 td:first');
            // let data = table.row(td).data();
            
            // if (data && data.barcode_tray) {
            //     let barcode_tray = data.barcode_tray;
            //     // Parsing data ke komponen
            //     $('#barcode_tray72').val(barcode_tray);
            //     $('#compose-modal72').modal('show');
            // } else {
            //     // Tampilkan modal konfirmasi
            //     $('#confirm-modal').modal('show');
            //     // Tambahkan pesan ke modal
            //     $('#confirm-modal .modal-body').html('<p class="text-center" style="font-size: 15px;">You have not filled in the 24-hour moisture data. Please fill in that data first.</p>');
            // }
        });
        

        $('#example3').on('click', '.btn_edit_detResultsHBA', function() {
            let tr = $(this).closest('tr');
            let data = table1.row(tr).data();
            $('#mode_detResultsHBA').val('edit');
            $('#modal-title-HBA').html('<i class="fa fa-pencil-square"></i> Update | Results HBA <span id="my-another-cool-loader"></span>');
            $('#idx_moisture72').val(id_moisture);
            $('#id_moisture72').val(data.id_moisture72);
            $('#date_moisture72').val(data.date_moisture72);
            $('#time_moisture72').val(data.time_moisture72);
            $('#barcode_tray72').attr('readonly', true);
            $('#barcode_tray72').val(data.barcode_tray);
            $('#dry_weight72').val(data.dry_weight72);
            $('#dry_weight_persen').val(data.dry_weight_persen);
            $('#comments72').val(data.comments72);
            $('#compose-modalHBA').modal('show');
        });

    });
</script>
