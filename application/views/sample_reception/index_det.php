<div class="content-wrapper">
	<section class="content">
		<div class="box box-black box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Processing | Sample Reception | Sample Testing</h3>
			</div>
				<form role="form"  id="formKeg" method="post" class="form-horizontal">
					<div class="box-body">
						<!-- <input type="hidden" class="form-control " id="id_req" name="id_req" value="<?php// echo $id_req ?>"> -->
						
						<input class="form-control " id="id_sample" name="id_sample" value="<?php echo $id_sample ?>"  type="hidden" disabled>
						<div class="form-group">
							<label for="id_project" class="col-sm-2 control-label">COC</label>
							<div class="col-sm-4">
								<input class="form-control " id="id_project" name="id_project" value="<?php echo $id_project ? : '-' ?>"  disabled>
							</div>

							<label for="id_one_water_sample" class="col-sm-2 control-label">One Water Sample ID</label>
							<div class="col-sm-4">
								<input class="form-control " id="id_one_water_sample" name="id_one_water_sample" value="<?php echo $id_one_water_sample  ? : '-'  ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="initial" class="col-sm-2 control-label">Receiving Lab</label>
							<div class="col-sm-4">
								<input class="form-control " id="initial" name="initial" value="<?php echo $initial  ? : '-'  ?>"  disabled>
							</div>

							<label for="sampletype" class="col-sm-2 control-label">Sample Type</label>
							<div class="col-sm-4">
								<input class="form-control " id="sampletype" name="sampletype" value="<?php echo $sampletype ? : '-' ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="date_arrival" class="col-sm-2 control-label">Date arrive</label>
							<div class="col-sm-4">
								<input class="form-control " id="date_arrival" name="date_arrival" value="<?php echo $date_arrival ? : '-' ?>" disabled>
							</div>

							<label for="time_arrival" class="col-sm-2 control-label">Time arrive</label>
							<div class="col-sm-4">
								<input class="form-control " id="time_arrival" name="time_arrival" value="<?php echo $time_arrival ? : '-' ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="date_collected" class="col-sm-2 control-label">Date Collected</label>
							<div class="col-sm-4">
								<input class="form-control " id="date_collected" name="date_collected" value="<?php echo $date_collected ? : '-' ?>" disabled>
							</div>

							<label for="time_collected" class="col-sm-2 control-label">Time Collected</label>
							<div class="col-sm-4">
								<input class="form-control " id="time_collected" name="time_collected" value="<?php echo $time_collected ? : '-' ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="comments" class="col-sm-2 control-label">Comments</label>
							<div class="col-sm-4">
								<input class="form-control " id="comments" name="comments" value="<?php echo $comments ? : '-' ?>"  disabled>
							</div>
						</div>

					</div><!-- /.box-body -->
				</form>
			<div class="box-footer">
                <!-- <div class="row"> -->
                    <div class="col-xs-12"> 
                        <div class="box box-primary box-solid">
                            <div class="box-header">
                                <h3 class="box-title">Sample Testing</h3>
                            </div>
							<div class="box-body pad table-responsive">
								<?php
									// User Level Access Control untuk Add Test Button
									$user_level = (int)$this->session->userdata('id_user_level');
									$allowed_levels = [1, 2, 3]; // Super Admin, Admin, User
									
									if (in_array($user_level, $allowed_levels)): ?>
										<button class='btn btn-primary' id='addtombol_det'>
											<i class='fa fa-wpforms' aria-hidden='true'></i> Add Test
										</button>
								<?php endif; ?>
								
								<table id="example2" class="table display table-bordered table-striped" width="100%">
									<thead>
										<tr>
											<th>Testing Type</th>
											<th>Main module</th>
											<th>Detail module</th>
											<th>Result</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
								</table>
							</div> <!--/.box-body  -->
                        </div><!-- box box-warning -->
                    </div>  <!--col-xs-12 -->
                <!--</div> row -->    

				<div class="form-group">
					<div class="modal-footer clearfix">
						<button type="button" name="batal" value="batal" class="btn btn-warning" onclick="window.location.href='<?= site_url('sample_reception'); ?>';">
							<i class="fa fa-times"></i> Close
						</button>
					</div>
				</div>
			</div> <!--footer -->
		</div>
	</section>
</div>

<!-- MODAL FORM -->
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                        <h4 class="modal-title" id="modal-title-detail">
							<span id="my-another-cool-loader"></span></h4>
                    </div>
                    <form id="formDetail" action=<?php echo site_url('Sample_reception/savedetail') ?> method="post" class="form-horizontal">
                        <div class="modal-body">
						<div class="form-group">
                                <div class="col-sm-9">
                                    <input id="mode_det" name="mode_det" type="hidden" class="form-control input-sm">
									<input id="id2_project" name="id2_project" type="hidden" class="form-control input-sm">
									<input id="idx_one_water_sample" name="idx_one_water_sample" type="hidden" class="form-control input-sm">
                                </div>
                            </div>

							<div class="form-group" id="idx_sample">
                                <label for="id2_sample" class="col-sm-4 control-label">Sample ID</label>
                                <div class="col-sm-8">
                                    <input id="id2_sample" name="id2_sample" type="text"  placeholder="Sample ID" class="form-control">
                                </div>
                            </div>

							<div class="form-group">
								<label for="id_testing_type" class="col-sm-4 control-label">Testing Type</label>
								<div class="col-sm-4" id="conf">
									<!-- <?php foreach ($testing_type as $row): ?>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="id_testing_type[]" class="testing-type-checkbox" data-testing-type="<?php echo $row['testing_type']; ?>" value="<?php echo $row['id_testing_type']; ?>"> <?php echo $row['testing_type']; ?>
											</label>
										</div>
									<?php endforeach; ?> -->

									<?php foreach ($testing_type as $row): ?>
										<div class="checkbox">
											<label>
												<input type="checkbox" 
													id="testing_type_<?php echo $row['id_testing_type']; ?>"
													name="id_testing_type[]" 
													class="testing-type-checkbox" 
													data-testing-type="<?php echo $row['testing_type']; ?>" 
													value="<?php echo $row['id_testing_type']; ?>"> 
												<?php echo $row['testing_type']; ?>
											</label>
										</div>
									<?php endforeach; ?>

									<!-- <div class="checkbox">
										<label>
											<input type="checkbox" id="check-all"> All
										</label>
									</div> -->
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

<!-- MODAL CONFIRMATION -->
<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                <h4 class="modal-title">Confirm Your Selection</h4>
            </div>
			<div class="modal-body">
                <div id="confirmation-content" >
                    <!-- Content will be loaded here dynamically -->
                </div>
            </div>
            <div class="modal-footer clearfix">
                <!-- Wrap this container to align it properly -->
                <div class="modal-footer-content">
                    <h5 class="modal-title">You have selected the following assays - is this correct ?</h5>
                    <div class="modal-buttons">
                        <button type="button" id="confirm-save" class="btn btn-primary"><i class="fa fa-save"></i> Ok</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                    </div>
                </div>
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
                <h4 class="modal-title"><i class="fa fa-trash"></i> Testing Type | Delete <span id="my-another-cool-loader"></span></h4>
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

<!-- MODAL INFORMATION -->
<div class="modal fade" id="confirm-modal-information" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #3c8dbc; color: white;">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
					<h4 class="modal-title">Information Your Selection</h4>
				</div>
				<div class="modal-body">
					<div id="information-content">
						<!-- Content will be loaded here dynamically -->
					</div>
				</div>
				<div class="modal-footer clearfix">
					<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Ok</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

<!-- MODAL SEQUENCE DATA - Only for Extraction Culture -->
<div class="modal fade" id="sequence-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                <h4 class="modal-title"><i class="fa fa-dna"></i> Extraction Culture | Sequence Data Entry</h4>
            </div>
            <form id="sequenceForm" method="post" class="form-horizontal">
                <div class="modal-body">
                    <input type="hidden" id="seq_id_one_water_sample" name="id_one_water_sample">
                    
                    <div class="form-group">
                        <label for="barcode_tube" class="col-sm-4 control-label">Barcode Tube <span style="color: red;">*</span></label>
                        <div class="col-sm-8">
                            <select id="barcode_tube" name="barcode_tube" class="form-control" required>
                                <option value="" disabled selected>-- Select Barcode Tube --</option>
                            </select>
                            <small class="help-block">Select which barcode tube to add sequence data to</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sequenceCheckbox" class="col-sm-4 control-label">Sequence</label>
                        <div class="col-sm-8" style="padding-top: 7px;">
                            <input type="hidden" id="sequenceHidden" name="sequence" value="0">
                            <input type="checkbox" id="sequenceCheckbox" name="sequence" value="1" disabled>
                            <span id="sequenceHelpText" style="margin-left: 10px; font-size: 12px; color: #999;">Please select a barcode tube first</span>
                        </div>
                    </div>

                    <div id="sequenceFields" style="display: none;">
                        <div class="form-group">
                            <label for="sequence_id" class="col-sm-4 control-label">Sequence Type</label>
                            <div class="col-sm-8">
                                <select id="sequence_id" name="sequence_id" class="form-control">
                                    <option value="" disabled selected>-- Select Sequence Type --</option>
                                    <?php
                                        if (isset($sequencetype) && is_array($sequencetype)) {
                                            foreach($sequencetype as $row){
                                                echo "<option value='".$row['sequence_id']."'>".$row['sequence_type']."</option>";
                                            }
                                        }
                                    ?>
                                    <option value="other">Other</option>
                                </select>
                                <input type="text" id="other_sequence_name" name="other_sequence_name" class="form-control" placeholder="Enter new sequence type" style="display:none; margin-top:5px;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="species_id" class="col-sm-4 control-label">Species ID</label>
                            <div class="col-sm-8">
                                <input id="species_id" name="species_id" placeholder="Enter Species ID" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer clearfix">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Sequence</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<style>
	/* Flexbox untuk memastikan elemen berada di dalam satu baris */
.modal-footer-content {
    display: flex;
    justify-content: space-between; /* Space between title and buttons */
    align-items: center; /* Vertically center */
    width: 100%;
}

/* Mengatur lebar tombol agar posisinya tetap ke kanan */
.modal-buttons {
    display: flex;
    gap: 10px; /* Memberikan jarak antar tombol */
}

/* Jika diperlukan, memberi margin atau padding khusus pada judul modal */
.modal-footer-content h5 {
    margin: 0; /* Menghapus margin default */
    font-weight: bold;
	margin-left: 40px;
	font-style: italic;
}

/* Menambahkan scroll pada modal-body */
.modal-body {
    max-height: 400px; /* Tentukan tinggi maksimum sesuai kebutuhan */
    overflow-y: auto;  /* Menambahkan scrollbar vertikal */

}

/* Optional: Menambahkan beberapa gaya agar tampilan lebih rapi */
.modal-footer {
    display: flex;
    justify-content: space-between;
}

#conf {
	width: 50%;
}

.url-link-detail {
	color: #FC8F54;
}

.url-link-status {
	color: #FC8F54;
}

.rounded-pill {
  border-radius: 9999px !important;
}

/* Futuristic SweetAlert2 Styles */
.futuristic-popup {
	border-radius: 20px !important;
	background: rgba(255, 255, 255, 0.95) !important;
	backdrop-filter: blur(20px) !important;
	border: 1px solid rgba(255, 255, 255, 0.3) !important;
	box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(255, 255, 255, 0.2) !important;
	padding: 20px !important;
}

.futuristic-popup .swal2-actions {
	display: flex !important;
	flex-direction: row !important;
	gap: 12px !important;
	justify-content: center !important;
	align-items: center !important;
	margin: 15px 0 10px 0 !important;
	padding: 0 20px !important;
	flex-wrap: nowrap !important;
	max-width: 100% !important;
}

.futuristic-title {
	font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
	font-size: 24px !important;
	margin-bottom: 20px !important;
}

.futuristic-button-orange {
	border-radius: 25px !important;
	padding: 10px 25px !important;
	font-weight: 600 !important;
	font-size: 14px !important;
	border: none !important;
	background: #f39c12 !important;
	color: white !important;
	box-shadow: 0 8px 25px rgba(243, 156, 18, 0.4) !important;
	transition: all 0.3s ease !important;
	text-transform: none !important;
	min-width: 120px !important;
	max-width: 140px !important;
}

.futuristic-button-orange:hover {
	transform: translateY(-2px) !important;
	box-shadow: 0 12px 35px rgba(243, 156, 18, 0.6) !important;
	background: #e67e22 !important;
}

.futuristic-button-orange:active {
	transform: translateY(0px) !important;
	box-shadow: 0 6px 20px rgba(243, 156, 18, 0.4) !important;
}

.futuristic-button {
	border-radius: 25px !important;
	padding: 10px 25px !important;
	font-weight: 600 !important;
	font-size: 14px !important;
	border: none !important;
	background: linear-gradient(135deg, #3498db 0%, #2980b9 100%) !important;
	box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4) !important;
	transition: all 0.3s ease !important;
	text-transform: none !important;
	min-width: 120px !important;
	max-width: 140px !important;
}

.futuristic-button:hover {
	transform: translateY(-2px) !important;
	box-shadow: 0 12px 35px rgba(52, 152, 219, 0.6) !important;
}

.futuristic-button:active {
	transform: translateY(0px) !important;
	box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4) !important;
}

.futuristic-button-warning {
	border-radius: 25px !important;
	padding: 10px 25px !important;
	font-weight: 600 !important;
	font-size: 14px !important;
	border: none !important;
	background: #f39c12 !important;
	color: white !important;
	box-shadow: 0 8px 25px rgba(243, 156, 18, 0.4) !important;
	transition: all 0.3s ease !important;
	text-transform: none !important;
	min-width: 120px !important;
	max-width: 140px !important;
}

.futuristic-button-warning:hover {
	transform: translateY(-2px) !important;
	box-shadow: 0 12px 35px rgba(243, 156, 18, 0.6) !important;
	background: #e67e22 !important;
}

.futuristic-button-warning:active {
	transform: translateY(0px) !important;
	box-shadow: 0 6px 20px rgba(243, 156, 18, 0.4) !important;
}

.futuristic-button-sequence {
	border-radius: 25px !important;
	padding: 10px 25px !important;
	font-weight: 600 !important;
	font-size: 14px !important;
	border: none !important;
background: linear-gradient(135deg, #ba68c8 0%, #9575cd 100%) !important;


	color: white !important;
	box-shadow: 0 8px 25px rgba(156, 39, 176, 0.4) !important;
	transition: all 0.3s ease !important;
	text-transform: none !important;
	min-width: 150px !important;
	max-width: 170px !important;
}

.futuristic-button-sequence:hover {
	transform: translateY(-2px) !important;
	box-shadow: 0 12px 35px rgba(156, 39, 176, 0.6) !important;
	background: linear-gradient(135deg, #8e24aa 0%, #5e35b1 100%) !important;
}

.futuristic-button-sequence:active {
	transform: translateY(0px) !important;
	box-shadow: 0 6px 20px rgba(156, 39, 176, 0.4) !important;
}

/* Animation classes */
@keyframes fadeInUp {
	from {
		opacity: 0;
		transform: translate3d(0, 30px, 0);
	}
	to {
		opacity: 1;
		transform: translate3d(0, 0, 0);
	}
}

@keyframes fadeOutDown {
	from {
		opacity: 1;
		transform: translate3d(0, 0, 0);
	}
	to {
		opacity: 0;
		transform: translate3d(0, 30px, 0);
	}
}

.animate__animated {
	animation-duration: 0.4s;
	animation-fill-mode: both;
}

.animate__faster {
	animation-duration: 0.3s;
}

.animate__fadeInUp {
	animation-name: fadeInUp;
}

.animate__fadeOutDown {
	animation-name: fadeOutDown;
}

/* Global SweetAlert2 button layout fix */
.swal2-popup .swal2-actions {
	display: flex !important;
	flex-direction: row !important;
	gap: 12px !important;
	justify-content: center !important;
	align-items: center !important;
	margin: 15px 0 10px 0 !important;
	padding: 0 15px !important;
	flex-wrap: nowrap !important;
	max-width: calc(100% - 30px) !important;
	box-sizing: border-box !important;
}

.swal2-popup .swal2-actions button {
	margin: 0 !important;
	flex: 0 0 auto !important;
	max-width: 45% !important;
	white-space: nowrap !important;
	overflow: hidden !important;
	text-overflow: ellipsis !important;
}

.swal2-popup {
	max-width: 500px !important;
	width: 90% !important;
}


</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    let table;
	let id_sample = $('#id_sample').val();
	let id_one_water_sample = $('#id_one_water_sample').val();
	let base_url = location.hostname;

	// Add event listener for clicks on URL column
	// $(document).on('click', '.url-link', function() {
	// 	var barcode = $(this).data('barcode');
	// 	var url = 'http://localhost/limsonewater/index.php/moisture_content?barcode=' + barcode;
	// 	window.location.href = url;
	// });

	$(document).ready(function() {

		function showConfirmationDelete(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal-delete').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('Sample_reception/delete_detail'); ?>/' + id;
            $('#confirm-modal-delete #id').text(id);
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

		// The function to show the congfirmation with testing type data 
		function showConfirmation() {
			let selectedTestingTypes = [];
			$('.testing-type-checkbox:checked').each(function() {
				let testingTypeId = $(this).val();
				let testingTypeName = $(this).data('testing-type');
				selectedTestingTypes.push(testingTypeId);
			});

			if (selectedTestingTypes.length === 0) {
				let informationContent = '<ul style="list-style-type:none; font-size: 16px">';
						informationContent += '<li style="font-weight: bold;"> No testing type selected</li>';
					informationContent += '</ul>';

					$('#information-content').html(informationContent);
				$('#confirm-modal-information').modal('show');
				return;
			}

			$.ajax({
				url: '<?php echo site_url('Sample_reception/get_confirmation_data'); ?>',
				type: 'POST',
				data: { id_testing_type: selectedTestingTypes },
				dataType: 'json',
				success: function(response) {
					let confirmationContent = '<ul style="list-style-type:none; font-size: 16px;">';
					$.each(response, function(index, item) {
						let barcode = item.barcode || "No Generate";
						confirmationContent += '<li style="font-weight: bold;">' + (index + 1) + '. ' + '<span style="font-weight: normal;">Testing Type: </span>' + item.testing_type_name + ' - ' + '<span style="font-weight: normal;">"generate barcode : </span>' + barcode + '</li>';
					});
					confirmationContent += '</ul>';

					$('#confirmation-content').html(confirmationContent);
					$('#confirm-modal').modal('show');
				}
			});
		}


		//  When the save button is clicked in modal detail
		$('#formDetail').on('submit', function(e) {
			e.preventDefault(); // Hold on the automaticly submitted
			showConfirmation();
		});

		//  When the save button is clicked in modal confirmation
		$('#confirm-save').click(function() {
			// Sending the data to the controller to be saved
			$('#formDetail').off('submit').submit(); // Deleting the previous submit handler and sending the form
		});



		$('.noEnterSubmit').keypress(function (e) {
			if (e.which == 13) return false;
		});

		$('.clockpicker').clockpicker({
        placement: 'bottom', // clock popover placement
        align: 'left',       // popover arrow align
        donetext: 'Done',     // done button text
        autoclose: true,    // auto close when minute is selected
        vibrate: true        // vibrate the device when dragging clock hand
        });                

        $('.val1tip, .val2tip, .val3tip').tooltipster({
            animation: 'swing',
            delay: 1,
            theme: 'tooltipster-default',
            autoClose: true,
            position: 'bottom',
        });

		$("input").click(function(){
            setTimeout(function(){
                $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
            }, 3000);                            
        });
						
        $('#compose-modal').on('shown.bs.modal', function () {
			$('#sample_id').focus();
			// $('#estimate_price').on('input', function() {
            //     formatNumber(this);
            //     });
            });
		

		$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
		{
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


		function clearFormFields() {
        $('input[type=text], input[type=date], input[type=time]').val('');
        $('input[type=checkbox]').prop('checked', false);
            // Mengubah tampilan label
			// updateCheckboxLabelStyling1();
		}

		// Clear form fields when modal is hidden
		$('#compose-modal').on('hidden.bs.modal', function () {
			clearFormFields();
		});

		// $('#check-all').change(function() {
		// 	let isChecked = $(this).prop('checked');
		// 	$('.testing-type-checkbox').prop('checked', isChecked);
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
			ajax: {
				"url": "../../Sample_reception/subjson?id=" + encodeURIComponent(id_sample),
				"type": "POST"
			},
			columns: [
				{ "data": "testing_type" },
				{
					"data": "url",
					"render": function(data, type, row) {
						return `
							<a href="javascript:void(0);" class="url-link-detail"
								data-url="${data}"
								data-id_testing_type="${row.id_testing_type || '-'}"
								data-barcode="${row.barcode || '-'}"
								data-id_one_water_sample="${row.id_one_water_sample}">
								${row.testing_type || '-'} - ${row.id_one_water_sample || '-'}
							</a>
						`;
					}
				},
				{
					"data": "url",
					"render": function(data, type, row) {
						// For testing types without independent review system (Microbial Testing only)
						// Sequencing now follows Extraction Culture status
						// if (row.testing_type && row.testing_type.toLowerCase().includes('microbial')) {
						// 	return `<span class="text-muted">${row.testing_type || '-'} - ${row.id_one_water_sample || '-'}</span>`;
						// }
						
						return `
							<a href="javascript:void(0);" class="url-link-status"
								data-url="${data}"
								data-id_testing_type="${row.id_testing_type || '-'}"
								data-barcode="${row.barcode || '-'}"
								data-id_one_water_sample="${row.id_one_water_sample}">
								${row.testing_type || '-'} - ${row.id_one_water_sample || '-'}
							</a>
						`;
					}
				},
				{
                    "data": "result",
                    "render": function(data, type, row) {
                        return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
                    }
                },
				{
					"data": null, // <- karena kita render manual
					"render": function(data, type, row) {
						// Handle Microbial (still no independent review system)
						if (row.testing_type && row.testing_type.toLowerCase().includes('microbial')) {
							return `<span class="btn btn-xs btn-info rounded-pill">No status</span>`;
						}
						
						// Handle Sequencing (uses is_status from sequencing table)
						if (row.testing_type && row.testing_type.toLowerCase().includes('sequencing')) {
							// Debug logging
							console.log('Sequencing row data:', {
								review: row.review,
								species_id: row.species_id,
								barcode: row.barcode
							});
							
							let statusBtn = '';
							if (row.review == "1" && row.species_id && row.species_id.trim() !== '') {
								// Complete only if is_status = 1 AND species_id is filled
								statusBtn = '<span class="btn btn-xs btn-primary rounded-pill">Completed</span>';
							} else {
								// Pending if: is_status = 0, no data, OR species_id is empty
								statusBtn = '<span class="btn btn-xs btn-warning rounded-pill" style="background-color: #f39c12; border-color: #f39c12;">Pending</span>';
							}
							return statusBtn;
						}

						let statusBtn = '';
						if (row.review == "1") {
							statusBtn = '<span class="btn btn-xs btn-success rounded-pill">Reviewed</span>';
						} else if (row.review == "0") {
							statusBtn = '<span class="btn btn-xs btn-warning rounded-pill">Unreview</span>';
						} else {
							statusBtn = '<span class="btn btn-xs btn-dark rounded-pill">No data has been entered</span>';
						}

						let fullNameBtn = `<span class="btn btn-xs btn-primary rounded-pill">${row.full_name || 'No user'}</span>`;

						return `${statusBtn} - ${fullNameBtn}`;
					}
				},
				{
					"data": "action",
					"orderable": false,
					"className": "text-center"
				}
			],
			order: [[0, 'asc']],
			rowCallback: function(row, data, iDisplayIndex) {
				// Additional row callbacks if needed
			}
		});



		// Klik link untuk detail dengan pengecekan data terlebih dahulu
		$('#example2 tbody').on('click', 'a.url-link-detail', function() {
			let barcode = $(this).data('barcode');
			let idOneWaterSample = $(this).data('id_one_water_sample');
			let idTestingType = $(this).data('id_testing_type');
			let url = $(this).data('url');
			let testingType = $(this).text().split(' - ')[0]; // Extract testing type name

			if (url) {
				// Show enhanced loading indicator
				Swal.fire({
					title: '<span style="color: #3498db; font-weight: 600;">🔍 Checking Data...</span>',
					html: `
						<div style="
							background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
							border-radius: 15px;
							padding: 30px;
							margin: 15px 0;
							color: white;
							box-shadow: 0 8px 32px rgba(52, 152, 219, 0.3);
							backdrop-filter: blur(10px);
							border: 1px solid rgba(255, 255, 255, 0.2);
							text-align: center;
						">
							<div style="
								width: 60px;
								height: 60px;
								background: rgba(255, 255, 255, 0.2);
								border-radius: 50%;
								display: inline-flex;
								align-items: center;
								justify-content: center;
								margin-bottom: 20px;
								animation: pulse 2s infinite;
								font-size: 28px;
							">⚡</div>
							<h4 style="margin: 0 0 10px 0; font-size: 20px; font-weight: 600;">Verifying Sample Data</h4>
							<p style="margin: 0; opacity: 0.9; font-size: 14px;">
								Checking for existing data in testing modules...
							</p>
							<div style="
								margin-top: 20px;
								height: 4px;
								background: rgba(255, 255, 255, 0.3);
								border-radius: 2px;
								overflow: hidden;
							">
								<div style="
									height: 100%;
									background: linear-gradient(90deg, #ffffff, #3498db, #2980b9, #ffffff);
									background-size: 200% 100%;
									animation: shimmer 1.5s infinite;
								"></div>
							</div>
						</div>
						
						<style>
							@keyframes pulse {
								0% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7); }
								70% { box-shadow: 0 0 0 20px rgba(255, 255, 255, 0); }
								100% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0); }
							}
							
							@keyframes shimmer {
								0% { background-position: -200% 0; }
								100% { background-position: 200% 0; }
							}
						</style>
					`,
					allowOutsideClick: false,
					showConfirmButton: false,
					customClass: {
						popup: 'futuristic-popup',
						title: 'futuristic-title'
					},
					showClass: {
						popup: 'animate__animated animate__fadeInUp animate__faster'
					}
				});

				// Check if data already exists for this id_one_water_sample and testing type
				$.ajax({
					url: '<?php echo site_url('Sample_reception/check_existing_data'); ?>',
					type: 'POST',
					data: {
						id_one_water_sample: idOneWaterSample,
						id_testing_type: idTestingType,
						url: url
					},
					dataType: 'json',
					timeout: 10000, // 10 second timeout
					success: function(response) {
						Swal.close(); // Close loading indicator
						
						if (response.status === 'success' && response.exists) {
							// Check if this is extraction_culture testing type
							let isExtractionCulture = testingType.toLowerCase().includes('extraction') && testingType.toLowerCase().includes('culture');
							
							// Data already exists, show info modal with futuristic design
							let sweetAlertConfig = {
								icon: 'success',
								title: '<span style="color: #2E86AB; font-weight: 600;">✨ Data Already Available</span>',
								html: `
									<div style="
										background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
										border-radius: 15px;
										padding: 25px;
										margin: 15px 0;
										color: white;
										box-shadow: 0 8px 32px rgba(52, 152, 219, 0.3);
										backdrop-filter: blur(10px);
										border: 1px solid rgba(255, 255, 255, 0.2);
									">
										<div style="
											display: flex;
											align-items: center;
											margin-bottom: 20px;
											padding-bottom: 15px;
											border-bottom: 1px solid rgba(255, 255, 255, 0.3);
										">
											<div style="
												width: 50px;
												height: 50px;
												background: rgba(255, 255, 255, 0.2);
												border-radius: 50%;
												display: flex;
												align-items: center;
												justify-content: center;
												margin-right: 15px;
												font-size: 24px;
											">🔬</div>
											<div style="text-align: left;">
												<h4 style="margin: 0; font-size: 18px; font-weight: 600;">Testing Module</h4>
												<p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 14px;">${testingType}</p>
											</div>
										</div>
										
										<div style="
											display: flex;
											align-items: center;
											margin-bottom: 20px;
											padding-bottom: 15px;
											border-bottom: 1px solid rgba(255, 255, 255, 0.3);
										">
											<div style="
												width: 50px;
												height: 50px;
												background: rgba(255, 255, 255, 0.2);
												border-radius: 50%;
												display: flex;
												align-items: center;
												justify-content: center;
												margin-right: 15px;
												font-size: 24px;
											">💧</div>
											<div style="text-align: left;">
												<h4 style="margin: 0; font-size: 18px; font-weight: 600;">Sample ID</h4>
												<p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 14px; font-family: monospace; letter-spacing: 1px;">${idOneWaterSample}</p>
											</div>
										</div>
										
										<div style="
											display: flex;
											align-items: center;
											background: rgba(255, 255, 255, 0.15);
											border-radius: 10px;
											padding: 15px;
										">
											<div style="
												width: 50px;
												height: 50px;
												background: rgba(46, 204, 113, 0.3);
												border-radius: 50%;
												display: flex;
												align-items: center;
												justify-content: center;
												margin-right: 15px;
												font-size: 24px;
											">✅</div>
											<div style="text-align: left;">
												<h4 style="margin: 0; font-size: 18px; font-weight: 600;">Status</h4>
												<p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 14px;">Data already exists in the system</p>
											</div>
										</div>
										${isExtractionCulture ? `
										<div style="
											display: flex;
											align-items: center;
											background: rgba(156, 39, 176, 0.2);
											border-radius: 10px;
											padding: 15px;
											margin-top: 15px;
											border: 2px solid rgba(156, 39, 176, 0.3);
										">
											<div style="
												width: 50px;
												height: 50px;
												background: rgba(156, 39, 176, 0.3);
												border-radius: 50%;
												display: flex;
												align-items: center;
												justify-content: center;
												margin-right: 15px;
												font-size: 24px;
											">🧬</div>
											<div style="text-align: left;">
												<h4 style="margin: 0; font-size: 18px; font-weight: 600;">Sequence Data</h4>
												<p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 14px;">Add sequence information for this sample</p>
											</div>
										</div>
										` : ''}
									</div>
								`,
								confirmButtonText: '✨ Got it!',
								confirmButtonColor: '#3498db',
								customClass: {
									popup: 'futuristic-popup',
									title: 'futuristic-title',
									confirmButton: 'futuristic-button'
								},
								showClass: {
									popup: 'animate__animated animate__fadeInUp animate__faster'
								},
								hideClass: {
									popup: 'animate__animated animate__fadeOutDown animate__faster'
								}
							};

							// Add sequence button only for extraction_culture
							if (isExtractionCulture) {
								sweetAlertConfig.showCancelButton = true;
								sweetAlertConfig.cancelButtonText = '🧬 Add Sequence';
								sweetAlertConfig.cancelButtonColor = '#9c27b0';
								sweetAlertConfig.customClass.cancelButton = 'futuristic-button-sequence';
								sweetAlertConfig.buttonsStyling = false;
							}

							Swal.fire(sweetAlertConfig).then((result) => {
								if (result.dismiss === Swal.DismissReason.cancel && isExtractionCulture) {
									// First load available barcode tubes (NEW approach)
									$.ajax({
										url: '<?php echo site_url('Sample_reception/get_barcode_tubes'); ?>',
										type: 'POST',
										data: { id_one_water_sample: idOneWaterSample },
										dataType: 'json',
										success: function(barcodeResponse) {
											// Set sample ID
											$('#seq_id_one_water_sample').val(idOneWaterSample);
											
											// Store tube-to-sample mapping for later use
											window.barcodeTubeMapping = {};
											
											// Populate barcode tube dropdown
											$('#barcode_tube').html('<option value="" disabled selected>-- Select Barcode Tube --</option>');
											if (barcodeResponse.status === 'success' && barcodeResponse.data && barcodeResponse.data.length > 0) {
												$.each(barcodeResponse.data, function(index, item) {
													// Store the complete data for this barcode tube
													window.barcodeTubeMapping[item.barcode_tube] = {
														barcode_sample: item.barcode_sample,
														sequence: item.sequence,
														sequence_id: item.sequence_id,
														sequence_type: item.sequence_type,
														custom_sequence_type: item.custom_sequence_type,
														species_id: item.species_id
													};
													
													let optionText = item.barcode_tube + ' (' + item.sequence_status + ')';
													$('#barcode_tube').append(`<option value="${item.barcode_tube}">${optionText}</option>`);
												});
											} else {
												$('#barcode_tube').append('<option value="" disabled>No barcode tubes found</option>');
											}
											
											// Open sequence modal
											$('#sequence-modal').modal('show');
										},
										error: function() {
											// Even if error, still open modal but show warning
											$('#seq_id_one_water_sample').val(idOneWaterSample);
											$('#barcode_tube').html('<option value="" disabled>Error loading barcode tubes</option>');
											$('#sequence-modal').modal('show');
										}
									});
								} else if (result.isConfirmed) {
									// User clicked "Got it!" - just close the dialog and stay on current page
									// Do nothing, dialog will close automatically
								} else if (!isExtractionCulture) {
									// It's not extraction culture - proceed to module directly
									let fullUrl = `${window.location.origin}/limsonewater/index.php/${url}?barcode=${barcode}&idOneWaterSample=${idOneWaterSample}&idTestingType=${idTestingType}`;
									window.location.href = fullUrl;
								}
							});
						} else {
							// Data doesn't exist or status is not success, proceed to module
							let fullUrl = `${window.location.origin}/limsonewater/index.php/${url}?barcode=${barcode}&idOneWaterSample=${idOneWaterSample}&idTestingType=${idTestingType}`;
							window.location.href = fullUrl;
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						Swal.close(); // Close loading indicator
						
						// On error, show futuristic warning message but still allow navigation
						Swal.fire({
							icon: 'warning',
							title: '<span style="color: #FF6B6B; font-weight: 600;">⚠️ Connection Issue</span>',
							html: `
								<div style="
									background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
									border-radius: 15px;
									padding: 25px;
									margin: 15px 0;
									color: #2c3e50;
									box-shadow: 0 8px 32px rgba(255, 107, 107, 0.3);
									backdrop-filter: blur(10px);
									border: 1px solid rgba(255, 255, 255, 0.2);
								">
									<div style="
										display: flex;
										align-items: center;
										margin-bottom: 20px;
										padding-bottom: 15px;
										border-bottom: 1px solid rgba(255, 255, 255, 0.3);
									">
										<div style="
											width: 50px;
											height: 50px;
											background: rgba(255, 255, 255, 0.3);
											border-radius: 50%;
											display: flex;
											align-items: center;
											justify-content: center;
											margin-right: 15px;
											font-size: 24px;
										">🔌</div>
										<div style="text-align: left;">
											<h4 style="margin: 0; font-size: 18px; font-weight: 600;">Network Status</h4>
											<p style="margin: 5px 0 0 0; opacity: 0.8; font-size: 14px;">Could not verify data availability</p>
										</div>
									</div>
									
									<div style="
										display: flex;
										align-items: center;
										margin-bottom: 20px;
										padding-bottom: 15px;
										border-bottom: 1px solid rgba(255, 255, 255, 0.3);
									">
										<div style="
											width: 50px;
											height: 50px;
											background: rgba(255, 255, 255, 0.3);
											border-radius: 50%;
											display: flex;
											align-items: center;
											justify-content: center;
											margin-right: 15px;
											font-size: 24px;
										">⚡</div>
										<div style="text-align: left;">
											<h4 style="margin: 0; font-size: 18px; font-weight: 600;">Error Details</h4>
											<p style="margin: 5px 0 0 0; opacity: 0.8; font-size: 14px;">${errorThrown || 'Network timeout or connection error'}</p>
										</div>
									</div>
									
									<div style="
										display: flex;
										align-items: center;
										background: rgba(255, 255, 255, 0.2);
										border-radius: 10px;
										padding: 15px;
									">
										<div style="
											width: 50px;
											height: 50px;
											background: rgba(52, 152, 219, 0.3);
											border-radius: 50%;
											display: flex;
											align-items: center;
											justify-content: center;
											margin-right: 15px;
											font-size: 24px;
										">🚀</div>
										<div style="text-align: left;">
											<h4 style="margin: 0; font-size: 18px; font-weight: 600;">Next Action</h4>
											<p style="margin: 5px 0 0 0; opacity: 0.8; font-size: 14px;">Proceeding to module anyway...</p>
										</div>
									</div>
								</div>
							`,
							timer: 3000,
							showConfirmButton: true,
							confirmButtonText: '🚀 Continue',
							confirmButtonColor: '#ff9a9e',
							customClass: {
								popup: 'futuristic-popup',
								title: 'futuristic-title',
								confirmButton: 'futuristic-button-warning'
							},
							showClass: {
								popup: 'animate__animated animate__fadeInUp animate__faster'
							},
							hideClass: {
								popup: 'animate__animated animate__fadeOutDown animate__faster'
							}
						}).then(() => {
							let fullUrl = `${window.location.origin}/limsonewater/index.php/${url}?barcode=${barcode}&idOneWaterSample=${idOneWaterSample}&idTestingType=${idTestingType}`;
							window.location.href = fullUrl;
						});
					}
				});
			}
		});

		// Klik link untuk status dengan fallback ke main module
		$('#example2 tbody').on('click', 'a.url-link-status', function() {
			let barcode = $(this).data('barcode');
			let idOneWaterSample = $(this).data('id_one_water_sample');
			let idTestingType = $(this).data('id_testing_type');
			let url = $(this).data('url');
			let testingType = $(this).text().split(' - ')[0]; // Extract testing type name

			if (url) {
				let fullUrlStatus = `${window.location.origin}/limsonewater/index.php/${url}/read/${idOneWaterSample}`;

				// Show enhanced loading indicator for status check
				Swal.fire({
					title: '<span style="color: #3498db; font-weight: 600;">📊 Checking Status...</span>',
					html: `
						<div style="
							background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
							border-radius: 15px;
							padding: 30px;
							margin: 15px 0;
							color: white;
							box-shadow: 0 8px 32px rgba(52, 152, 219, 0.3);
							backdrop-filter: blur(10px);
							border: 1px solid rgba(255, 255, 255, 0.2);
							text-align: center;
						">
							<div style="
								width: 60px;
								height: 60px;
								background: rgba(255, 255, 255, 0.2);
								border-radius: 50%;
								display: inline-flex;
								align-items: center;
								justify-content: center;
								margin-bottom: 20px;
								animation: pulse 2s infinite;
								font-size: 28px;
							">📈</div>
							<h4 style="margin: 0 0 10px 0; font-size: 20px; font-weight: 600;">Verifying Status Page</h4>
							<p style="margin: 0; opacity: 0.9; font-size: 14px;">
								Checking if status data is available...
							</p>
							<div style="
								margin-top: 20px;
								height: 4px;
								background: rgba(255, 255, 255, 0.3);
								border-radius: 2px;
								overflow: hidden;
							">
								<div style="
									height: 100%;
									background: linear-gradient(90deg, #ffffff, #3498db, #2980b9, #ffffff);
									background-size: 200% 100%;
									animation: shimmer 1.5s infinite;
								"></div>
							</div>
						</div>
					`,
					allowOutsideClick: false,
					showConfirmButton: false,
					customClass: {
						popup: 'futuristic-popup',
						title: 'futuristic-title'
					},
					showClass: {
						popup: 'animate__animated animate__fadeInUp animate__faster'
					}
				});

				// Check if status page exists
				$.ajax({
					url: fullUrlStatus,
					type: 'HEAD',
					timeout: 8000, // 8 second timeout
					success: function() {
						Swal.close();
						// If status page exists, redirect to it
						window.location.href = fullUrlStatus;
					},
					error: function(xhr, textStatus, errorThrown) {
						Swal.close();
						
						// Status page not available, offer fallback to main module
						let mainModuleUrl = `${window.location.origin}/limsonewater/index.php/${url}?idOneWaterSample=${idOneWaterSample}`;
						
						Swal.fire({
							icon: 'warning',
							title: '<span style="color: #3498db; font-weight: 600;">📊 Status Page Not Available</span>',
							html: `
								<div style="
									background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
									border-radius: 15px;
									padding: 25px;
									margin: 15px 0;
									color: white;
									box-shadow: 0 8px 32px rgba(52, 152, 219, 0.3);
									backdrop-filter: blur(10px);
									border: 1px solid rgba(255, 255, 255, 0.2);
								">
									<div style="
										display: flex;
										align-items: center;
										margin-bottom: 20px;
										padding-bottom: 15px;
										border-bottom: 1px solid rgba(255, 255, 255, 0.3);
									">
										<div style="
											width: 50px;
											height: 50px;
											background: rgba(255, 255, 255, 0.2);
											border-radius: 50%;
											display: flex;
											align-items: center;
											justify-content: center;
											margin-right: 15px;
											font-size: 24px;
										">📊</div>
										<div style="text-align: left;">
											<h4 style="margin: 0; font-size: 18px; font-weight: 600;">Status Module</h4>
											<p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 14px;">${testingType} : ${idOneWaterSample} - Status View</p>
										</div>
									</div>
									
									<div style="
										display: flex;
										align-items: center;
										margin-bottom: 20px;
										padding-bottom: 15px;
										border-bottom: 1px solid rgba(255, 255, 255, 0.3);
									">
										<div style="
											width: 50px;
											height: 50px;
											background: rgba(255, 255, 255, 0.2);
											border-radius: 50%;
											display: flex;
											align-items: center;
											justify-content: center;
											margin-right: 15px;
											font-size: 24px;
										">⚠️</div>
										<div style="text-align: left;">
											<h4 style="margin: 0; font-size: 18px; font-weight: 600;">Status</h4>
											<p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 14px;">${testingType} detail page is not available</p>
										</div>
									</div>
									
									<div style="
										display: flex;
										align-items: center;
										background: rgba(255, 255, 255, 0.15);
										border-radius: 10px;
										padding: 15px;
									">
										<div style="
											width: 50px;
											height: 50px;
											background: rgba(52, 152, 219, 0.3);
											border-radius: 50%;
											display: flex;
											align-items: center;
											justify-content: center;
											margin-right: 15px;
											font-size: 24px;
										">🔗</div>
										<div style="text-align: left;">
											<h4 style="margin: 0; font-size: 18px; font-weight: 600;">Alternative</h4>
											<p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 14px;">Redirect to main testing module instead? click cancel</p>
										</div>
									</div>
								</div>
							`,
							showCancelButton: true,
							confirmButtonText: '🚀 Go Main-Module',
							cancelButtonText: '❌ Cancel',
							confirmButtonColor: '#3498db',
							cancelButtonColor: '#f39c12',
							buttonsStyling: false,
							customClass: {
								popup: 'futuristic-popup',
								title: 'futuristic-title',
								confirmButton: 'futuristic-button',
								cancelButton: 'futuristic-button-orange'
							},
							showClass: {
								popup: 'animate__animated animate__fadeInUp animate__faster'
							},
							hideClass: {
								popup: 'animate__animated animate__fadeOutDown animate__faster'
							}
						}).then((result) => {
							if (result.isConfirmed) {
								// Redirect to main module
								window.location.href = mainModuleUrl;
							}
						});
					}
				});
			}
		});

        $('#example2 tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }
        })   


		// $('#addtombol_det').click(function() {
		// 	$('#mode_det').val('insert');
		// 	$('#modal-title-detail').html('<i class="fa fa-wpforms"></i> Detail Sample Reception | New Sample Testing<span id="my-another-cool-loader"></span>');
		// 	$('#idx_sample').hide();
		// 	$('#id2_sample').val(id_sample);
		// 	$('#idx_one_water_sample').val(id_one_water_sample);
		// 	$('#id_testing_type').val('');
		// 	$('#compose-modal').modal('show');
		// });
		$('#addtombol_det').click(function () {
			$('#mode_det').val('insert');
			$('#modal-title-detail').html('<i class="fa fa-wpforms"></i> Detail Sample Reception | New Sample Testing<span id="my-another-cool-loader"></span>');
			$('#idx_sample').hide();
			$('#id2_sample').val(id_sample);
			$('#idx_one_water_sample').val(id_one_water_sample);
			$('#id_testing_type').val('');
			$('#compose-modal').modal('show');

			// Ambil daftar ID testing yang sudah ada dari DataTable
			let selectedTestingTypes = [];
			let table = $('#example2').DataTable();
			table.rows().every(function () {
				let row = this.data();
				if (row.id_testing_type) {
					selectedTestingTypes.push(row.id_testing_type);
				}
			});

			// Disable checkbox jika id sudah ada
			selectedTestingTypes.forEach(function (id) {
				let checkbox = $('#testing_type_' + id);
				checkbox.prop('disabled', true);
				checkbox.closest('label').css('color', 'gray');
			});
		});

		$('#compose-modal').on('hidden.bs.modal', function () {
			// Aktifkan semua kembali dan reset warna label
			$('.testing-type-checkbox').prop('disabled', false).closest('label').css('color', '');
		});




		$('#example2').on('click', '.btn_edit_det', function() {
			let tr = $(this).closest('tr');
			let data = table.row(tr).data();

			$('#cancelButton').click(function() {
				location.reload();
			});

			$('.testing-type-checkbox').change(function() {
					var $checkbox = $(this);
					var isChecked = $checkbox.prop('checked');
					// var inputId = 'input_testing_type_' + $checkbox.val();
					
					// disable other checkboxes
					if (isChecked) {
						$('.testing-type-checkbox').not($checkbox).prop('checked', false);
					}

					// Change atribute related to checkbox
					// $('#' + inputId).prop('required', isChecked);
					
					// Change label
					// updateCheckboxLabelStyling();

					// delete strikethrough style if checkbox is unchecked
					if ($('.testing-type-checkbox:checked').length === 0) {
						$('.testing-type-checkbox').each(function() {
							var $label = $(this).closest('label');
							$label.removeClass('disabled-label');
						});
					}			
			});

			if (data.id_testing_type !== undefined && data.id_testing_type !== null) {
				let testingTypeIds = data.id_testing_type.split(',');

				$('#mode_det').val('edit');
				$('#modal-title-detail').html('<i class="fa fa-pencil-square"></i> Detail Sample Reception | Update Sample Testing<span id="my-another-cool-loader"></span>');
				$('#idx_sample').hide();
				$('#id2_sample').val(data.id_sample);
				$('#idx_one_water_sample').val(id_one_water_sample);
				$('.testing-type-checkbox').prop('checked', false); // Uncheck all checkboxes first
				testingTypeIds.forEach(function(id) {
					$(`input[value="${id}"]`).prop('checked', true); // Check the checkboxes based on testingTypeIds
				});

				$('#compose-modal').modal('show');
			}
		});

		// ============ SEQUENCE MODAL HANDLERS ============
		
		// Initialize sequence hidden field state on page load
		$(document).ready(function() {
			if ($('#sequenceCheckbox').is(':checked')) {
				$('#sequenceHidden').prop('disabled', true);
			} else {
				$('#sequenceHidden').prop('disabled', false);
			}
		});
		
		// Handle sequence checkbox toggle (using hidden field pattern like extraction culture)
		$('#sequenceCheckbox').change(function() {
			if ($(this).is(':checked')) {
				$('#sequenceFields').show();
				$('#sequenceHidden').prop('disabled', true); // Disable hidden when checkbox checked
				$('#sequenceHidden').val('1'); // Set hidden to 1 as backup
				$('#sequence_id').prop('required', false); // Don't make required to allow flexibility
			} else {
				$('#sequenceFields').hide();
				$('#sequenceHidden').prop('disabled', false); // Enable hidden when checkbox unchecked  
				$('#sequenceHidden').val('0'); // Explicitly set to 0
				$('#sequence_id').prop('required', false);
				$('#other_sequence_name').prop('required', false);
				// Clear all sequence-related fields when unchecked
				$('#species_id').val('');
				$('#sequence_id').val('').trigger('change'); // Trigger change to hide other field
				$('#other_sequence_name').hide().val('');
			}
		});

		// Handle sequence type dropdown change
		$('#sequence_id').change(function() {
			if ($(this).val() === 'other') {
				$('#other_sequence_name').show().prop('required', true);
			} else {
				$('#other_sequence_name').hide().prop('required', false).val('');
			}
		});

		// Handle barcode tube selection - enable sequence checkbox and load existing data (NEW approach)
		$('#barcode_tube').change(function() {
			let selectedBarcodeTube = $(this).val();
			
			if (selectedBarcodeTube) {
				// Enable sequence checkbox now that barcode tube is selected
				$('#sequenceCheckbox').prop('disabled', false);
				$('#sequenceHelpText').text('Check to show sequence fields').css('color', '#666');
				
				// Use data from mapping instead of AJAX call for better consistency
				if (window.barcodeTubeMapping && window.barcodeTubeMapping[selectedBarcodeTube]) {
					let data = window.barcodeTubeMapping[selectedBarcodeTube];
					
					// Pre-populate form with existing data for this barcode tube
					// Check sequence checkbox based on sequence field value from mapping
					let isSequenceEnabled = (data.sequence == '1');
					$('#sequenceCheckbox').prop('checked', isSequenceEnabled);
					
					// Set hidden field state based on checkbox
					if (isSequenceEnabled) {
						$('#sequenceHidden').prop('disabled', true);
						$('#sequenceFields').show();
					} else {
						$('#sequenceHidden').prop('disabled', false);
						$('#sequenceFields').hide();
					}
					
					// Populate fields if sequence is enabled
					if (data.sequence_id) {
						$('#sequence_id').val(data.sequence_id);
					}
					if (data.species_id) {
						$('#species_id').val(data.species_id);
					}
					if (data.custom_sequence_type) {
						$('#sequence_id').val('other').trigger('change');
						$('#other_sequence_name').val(data.custom_sequence_type);
					}
				} else {
					// No mapping data found - reset form
					$('#sequenceCheckbox').prop('checked', false).trigger('change');
					$('#species_id').val('');
					$('#sequence_id').val('').trigger('change');
				}
			} else {
				// No barcode tube selected - disable sequence checkbox again
				$('#sequenceCheckbox').prop('disabled', true).prop('checked', false);
				$('#sequenceFields').hide();
				$('#sequenceHidden').prop('disabled', false);
				$('#sequenceHelpText').text('Please select a barcode tube first').css('color', '#999');
			}
		});

		// Handle sequence form submission
		$('#sequenceForm').on('submit', function(e) {
			e.preventDefault();
			
			// Get current checkbox state
			let isSequenceChecked = $('#sequenceCheckbox').is(':checked');
			
			// Basic validation - only check required fields if sequence is checked
			if (isSequenceChecked) {
				let sequenceId = $('#sequence_id').val();
				let otherSequenceName = $('#other_sequence_name').val();
				
				// If sequence is checked, user must select a sequence type OR provide custom name
				if (!sequenceId && !otherSequenceName) {
					Swal.fire({
						icon: 'warning',
						title: 'Validation Error',
						text: 'Please select a sequence type or enter a custom sequence name.',
						confirmButtonColor: '#f39c12'
					});
					return false;
				}
			}
			
			// Validate barcode tube selection
			let selectedBarcodeTube = $('#barcode_tube').val();
			if (!selectedBarcodeTube) {
				Swal.fire({
					icon: 'warning',
					title: 'Validation Error',
					text: 'Please select a barcode tube.',
					confirmButtonColor: '#f39c12'
				});
				return false;
			}
			
			// Get corresponding barcode_sample from mapping
			let correspondingBarcodeSample = '';
			if (window.barcodeTubeMapping && window.barcodeTubeMapping[selectedBarcodeTube]) {
				correspondingBarcodeSample = window.barcodeTubeMapping[selectedBarcodeTube].barcode_sample;
			}
			
			let formData = {
				id_one_water_sample: $('#seq_id_one_water_sample').val(),
				barcode_tube: selectedBarcodeTube, // Add barcode_tube to form data (NEW approach)
				barcode_sample: correspondingBarcodeSample, // Add corresponding barcode_sample for backend processing
				sequence_id: $('#sequence_id').val(),
				other_sequence_name: $('#other_sequence_name').val(),
				species_id: $('#species_id').val()
			};

			// Get sequence value from form (hidden field pattern)
			// This will automatically be 1 if checkbox checked, 0 if unchecked
			let formElement = document.getElementById('sequenceForm');
			let formDataObj = new FormData(formElement);
			formData.sequence = formDataObj.get('sequence');

			// Show loading
			Swal.fire({
				title: '<span style="color: #9c27b0; font-weight: 600;">🧬 Saving Sequence Data...</span>',
				html: `
					<div style="
						background: linear-gradient(135deg, #9c27b0 0%, #673ab7 100%);
						border-radius: 15px;
						padding: 30px;
						margin: 15px 0;
						color: white;
						box-shadow: 0 8px 32px rgba(156, 39, 176, 0.3);
						backdrop-filter: blur(10px);
						border: 1px solid rgba(255, 255, 255, 0.2);
						text-align: center;
					">
						<div style="
							width: 60px;
							height: 60px;
							background: rgba(255, 255, 255, 0.2);
							border-radius: 50%;
							display: inline-flex;
							align-items: center;
							justify-content: center;
							margin-bottom: 20px;
							animation: pulse 2s infinite;
							font-size: 28px;
						">🧬</div>
						<h4 style="margin: 0 0 10px 0; font-size: 20px; font-weight: 600;">Processing Sequence Data</h4>
						<p style="margin: 0; opacity: 0.9; font-size: 14px;">
							Saving sequence information to extraction culture plate...
						</p>
					</div>
				`,
				allowOutsideClick: false,
				showConfirmButton: false,
				customClass: {
					popup: 'futuristic-popup',
					title: 'futuristic-title'
				}
			});

			$.ajax({
				url: '<?php echo site_url('Sample_reception/save_sequence_data'); ?>',
				type: 'POST',
				data: formData,
				dataType: 'json',
				success: function(response) {
					Swal.close();
					
					if (response.status === 'success') {
						let actionIcon = response.action === 'updated' ? '🔄' : '✅';
						let actionText = response.action === 'updated' ? 'Updated' : 'Saved';
						let actionColor = response.action === 'updated' ? '#3498db' : '#27ae60';
						
						Swal.fire({
							icon: 'success',
							title: `<span style="color: ${actionColor}; font-weight: 600;">${actionIcon} Sequence Data ${actionText}!</span>`,
							html: `
								<div style="
									background: linear-gradient(135deg, ${actionColor} 0%, ${response.action === 'updated' ? '#2980b9' : '#2ecc71'} 100%);
									border-radius: 15px;
									padding: 25px;
									margin: 15px 0;
									color: white;
									box-shadow: 0 8px 32px rgba(${response.action === 'updated' ? '52, 152, 219' : '39, 174, 96'}, 0.3);
									backdrop-filter: blur(10px);
									border: 1px solid rgba(255, 255, 255, 0.2);
								">
									<div style="text-align: center;">
										<div style="
											width: 80px;
											height: 80px;
											background: rgba(255, 255, 255, 0.2);
											border-radius: 50%;
											display: inline-flex;
											align-items: center;
											justify-content: center;
											margin-bottom: 20px;
											font-size: 40px;
										">${actionIcon}</div>
										<h4 style="margin: 0 0 15px 0; font-size: 20px; font-weight: 600;">Sequence Data Successfully ${actionText}</h4>
										<p style="margin: 0; opacity: 0.9; font-size: 14px;">
											Sample: ${formData.id_one_water_sample}
										</p>
										<p style="margin: 5px 0 0 0; opacity: 0.8; font-size: 12px;">
											Action: ${response.action === 'updated' ? 'Data was updated with new information' : 'New sequence data was created'}
										</p>
									</div>
								</div>
							`,
							confirmButtonText: '🎉 Great!',
							confirmButtonColor: actionColor,
							customClass: {
								popup: 'futuristic-popup',
								title: 'futuristic-title',
								confirmButton: 'futuristic-button'
							}
						});
						
						$('#sequence-modal').modal('hide');
						// Reset form
						$('#sequenceForm')[0].reset();
						$('#sequenceCheckbox').prop('checked', false).trigger('change');
						
					} else {
						
						Swal.fire({
							icon: 'error',
							title: '<span style="color: #e74c3c; font-weight: 600;">❌ Save Failed</span>',
							text: response.message || 'Could not save sequence data',
							confirmButtonColor: '#e74c3c'
						});
					}
				},
				error: function() {
					Swal.close();
					Swal.fire({
						icon: 'error',
						title: '<span style="color: #e74c3c; font-weight: 600;">❌ Connection Error</span>',
						text: 'Could not connect to server. Please try again.',
						confirmButtonColor: '#e74c3c'
					});
				}
			});
		});

		// Reset sequence modal when closed
		$('#sequence-modal').on('hidden.bs.modal', function () {
			$('#sequenceForm')[0].reset();
			$('#sequenceCheckbox').prop('checked', false).prop('disabled', true).trigger('change');
			$('#barcode_sample').html('<option value="" disabled selected>-- Select Barcode Sample --</option>'); // Reset barcode dropdown
			$('#sequenceHelpText').text('Please select a barcode sample first').css('color', '#999'); // Reset help text
		});

	});
</script>