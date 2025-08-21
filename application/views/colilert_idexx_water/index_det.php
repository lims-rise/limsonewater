<div class="content-wrapper">
	<section class="content">
		<div class="box box-black box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Processing |  Colilert Idexx Water | Out</h3>
			</div>
				<form role="form"  id="formKeg" method="post" class="form-horizontal">
					<div class="box-body">
						<input id="id_colilert_in" name="id_colilert_in" type="hidden" class="form-control input-sm" value="<?php echo $id_colilert_in ?>">

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
							<label for="sampletype" class="col-sm-2 control-label">Sample Type</label>
							<div class="col-sm-4">
								<input class="form-control " id="sampletype" name="sampletype" value="<?php echo $sampletype ?>"  disabled>
							</div>

                            <label for="colilert_barcode" class="col-sm-2 control-label">Colilert Barcode</label>
							<div class="col-sm-4">
								<input class="form-control " id="colilert_barcode" name="colilert_barcode" value="<?php echo $colilert_barcode ?>"  disabled>
							</div>

						</div>

						<div class="form-group">
							<label for="date_sample" class="col-sm-2 control-label">Date Sample</label>
							<div class="col-sm-4">
								<input class="form-control " id="date_sample" name="date_sample" value="<?php echo $date_sample ?>"  disabled>
							</div>

                            <label for="time_sample" class="col-sm-2 control-label">Time Sample</label>
							<div class="col-sm-4">
								<input class="form-control " id="time_sample" name="time_sample" value="<?php echo $time_sample ?>" disabled>
							</div>

						</div>


						<div class="form-group">
							<label for="volume_bottle" class="col-sm-2 control-label">Volume in Bottle (mL)</label>
							<div class="col-sm-4">
								<input class="form-control " id="volume_bottle" name="volume_bottle" value="<?php echo $volume_bottle ?>"  disabled>
							</div>

                            <label for="dilution" class="col-sm-2 control-label">Dilution</label>
							<div class="col-sm-4">
								<input class="form-control " id="dilution" name="dilution" value="<?php echo $dilution ?>"  disabled>
							</div>
						</div>

					</div>
				</form>
                <form id="formSampleReview" method="post">
					<input type="hidden" name="id_one_water_sample" id="id_one_water_sample" value="<?php echo $id_one_water_sample ?>">
					<input type="hidden" id="review" name="review" value="<?php echo $review ?>">
					<input type="hidden" id="user_review" name="user_review" value="<?php echo $user_review ?>">
					<input type="hidden" id="user_created" name="user_created" value="<?php echo $user_created ?>">

					<div class="modal-footer clearfix" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px;">

						<div class="modal-footer-content" style="flex: 1; display: flex; align-items: center;">
							<div id="textInform2" class="textInform card" style="width: auto; padding: 5px 10px; display: none;">
								<div class="card-body">
									<div class="card-header d-flex justify-content-between align-items-center">
										<h5 class="card-title statusMessage mb-0"></h5>
										<i class="fa fa-times close-card" style="cursor: pointer;"></i>
									</div>
									<p class="statusDescription mb-0"></p>
								</div>
							</div>
						</div>

						<div class="d-flex align-items-center flex-wrap" style="gap: 8px;">
							<span class="text-muted">Status:</span>
							<span id="review_label" class="badge bg-warning text-dark" role="button" tabindex="0" style="cursor: pointer;">
								Unreview
							</span>

							<span class="text-muted ms-3">by:</span>
							<span id="reviewed_by_label" style="font-style: italic; font-weight: 800; font-size: 14px;">
								<?php echo $full_name ? $full_name : '-' ?>
							</span>

							<?php if (in_array($this->session->userdata('id_user_level'), [1, 2])): ?>
								<button type="button" id="cancelReviewBtn" class="btn btn-danger ms-3">
									Cancel Review
								</button>
							<?php endif; ?>
						</div>
					</div>
				</form>
			<div class="box-footer">
                <!-- <div class="row"> -->
                    <div class="col-xs-12"> 
                        <div class="box box-primary box-solid">
                            <div class="box-header">
                                <h3 class="box-title">Colilert Out</h3>
                            </div>
							<div class="box-body pad table-responsive">
								<?php
									$lvl = $this->session->userdata('id_user_level');
									if ($lvl != 4){
										echo "<button class='btn btn-primary' id='addtombol_det'><i class='fa fa-wpforms' aria-hidden='true'></i> New Data</button>";
									}
								?>
								<table id="example2" class="table display table-bordered table-striped" width="100%">
									<thead>
										<tr>
											<th>Colilert Barcode</th>
											<th>Date Sample</th>
                                            <th>Time Sample</th>
                                            <th>E. Coli large wells</th>
                                            <th>E. Coli small wells</th>
                                            <th>E. Coli (MPN/100mL)</th>
                                            <th>Lower detection limit MPN/100 mL</th>
                                            <th>Coliforms large wells</th>
                                            <th>Coliforms small wells</th>
                                            <th>Total Coliforms (MPN/100mL)</th>
                                            <th>Remarks</th>
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
						<button type="button" name="batal" value="batal" class="btn btn-warning" onclick="window.location.href='<?= site_url('colilert_idexx_water'); ?>';">
							<i class="fa fa-times"></i> Close
						</button>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- MODAL FORM MOISTURE 24 -->
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                        <h4 class="modal-title" id="modal-title-detail">
							<span id="my-another-cool-loader"></span></h4>
                    </div>
                        <form id="formDetail" action=<?php echo site_url('Colilert_idexx_water/savedetail') ?> method="post" class="form-horizontal">
                            <div class="modal-body">
                                <div class="form-group">
                                        <div class="col-sm-9">
                                            <input id="mode_det" name="mode_det" type="hidden" class="form-control input-sm">
                                            <input id="idx_colilert_in" name="idx_colilert_in" type="hidden" class="form-control input-sm">
                                            <input id="id_colilert_in" name="id_colilert_in" type="hidden" class="form-control input-sm">
                                            <input id="id_colilert_out" name="id_colilert_out" type="hidden" class="form-control input-sm">
                                            <input id="idx_one_water_sample" name="idx_one_water_sample" type="hidden" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="colilert_barcodex" class="col-sm-4 control-label">Colilert Barcode</label>
                                        <div class="col-sm-8">
                                            <input id="colilert_barcodex" name="colilert_barcodex" placeholder="Colilert Barcode" type="text" class="form-control">
                                            <div class="val1tip"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="date_sample" class="col-sm-4 control-label">Date Sample</label>
                                        <div class="col-sm-8">
                                            <input id="date_sample" name="date_sample" type="date" class="form-control" placeholder="Date Sample" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="time_sample" class="col-sm-4 control-label">Time Sample</label>
                                        <div class="col-sm-8">
                                            <div class="input-group clockpicker">
                                            <input id="time_sample" name="time_sample" class="form-control" placeholder="Time Sample" value="<?php 
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
                                        <label for="ecoli_largewells" class="col-sm-4 control-label">E. Coli large wells</label>
                                        <div class="col-sm-8">
                                            <input id="ecoli_largewells" name="ecoli_largewells" type="number" step="1" min="0" max="49" class="form-control" placeholder="E. Coli large wells" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="ecoli_smallwells" class="col-sm-4 control-label">E. Coli small wells</label>
                                        <div class="col-sm-8">
                                            <input id="ecoli_smallwells" name="ecoli_smallwells" type="number" step="1" min="0" max="48" class="form-control" placeholder="E. Coli small wells" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="ecoli" class="col-sm-4 control-label">E. Coli (MPN/100mL)</label>
                                        <div class="col-sm-8">
                                            <input id="ecoli" name="ecoli" type="text"  placeholder="E. Coli (MPN/100mL)" class="form-control">
                                            <!-- <div class="val1tip"></div> -->
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="lowerdetection" class="col-sm-4 control-label">Lower detection limit MPN/100 mL</label>
                                        <div class="col-sm-8">
                                            <input id="lowerdetection" name="lowerdetection" type="text"  placeholder="Lower detection limit MPN/100 mL" class="form-control">
                                            <!-- <div class="val1tip"></div> -->
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="coliforms_largewells" class="col-sm-4 control-label">Coliforms large wells</label>
                                        <div class="col-sm-8">
                                            <input id="coliforms_largewells" name="coliforms_largewells" type="number" step="1" min="0" max="49" class="form-control" placeholder="Coliforms large wells" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="coliforms_smallwells" class="col-sm-4 control-label">Coliforms small wells</label>
                                        <div class="col-sm-8">
                                            <input id="coliforms_smallwells" name="coliforms_smallwells" type="number" step="1" min="0" max="48" class="form-control" placeholder="Coliforms small wells" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="total_coliforms" class="col-sm-4 control-label">Total Coliforms (MPN/100mL)</label>
                                        <div class="col-sm-8">
                                            <input id="total_coliforms" name="total_coliforms" type="text"  placeholder="Total Coliforms (MPN/100mL)" class="form-control">
                                            <!-- <div class="val1tip"></div> -->
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="remarks" class="col-sm-4 control-label">Remarks</label>
                                        <div class="col-sm-8">
                                            <textarea id="remarks" name="remarks" class="form-control" placeholder="Remarks"></textarea>
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
        </div>


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
                        <p class="text-center" style="font-size: 15px;">Are you sure you want to delete Sample <span id="id" style="font-weight: bold;"></span> ?</p>
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

<style>

	#review_label {
		cursor: pointer;
		font-size: 14px;  /* Ukuran font untuk label */
	}

	#reviewed_by_label {
		margin-left: 10px;
		font-style: italic;
		font-weight: bold;
		font-size: 12px;  /* Ukuran font kecil untuk input reviewer */
	}

	.d-flex {
		display: flex;
		align-items: center;
	}

	.ms-2 {
		margin-left: 0.5rem;  /* Spacing antar elemen */
	}

    .table tbody tr.selected {
        color: white !important;
        background-color: #9CDCFE !important;
    }

    #formKegHidden {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1;
    }

    .hidden {
        visibility: hidden;
        position: absolute;
        width: 0;
        height: 0;
        overflow: hidden;
    }
    .sample-input {
        margin-bottom: 10px; /* Adjust the spacing as needed */
    }

    .modal {
    overflow-y: auto;
    }

    .modal-body {
    max-height: 80vh;
    overflow-y: auto;
    }

    .badge {
        font-size: 14px;
        padding: 8px 12px;
        border-radius: 20px;
        margin-top: 0px;
    }

    .badge-success {
        background-color: #6A9C89;
        color: white;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
    }

    .alert {
        padding: 8px 12px;
        border-radius: 5px;
        font-size: 14px;
        margin-top: 0px;
    }

    .alert-success {
        background-color: #6A9C89;
        color: white;
    }

    .alert-danger {
        background-color: #dc3545;
        color: white;
    }

    .card {
        border-radius: 10px;
        margin-top: 0px;
        padding: 8px 12px;
        width: 100%; /* Ensures card uses available space */
    }

    .card-success {
        border: 1px solid #28a745;
        background-color: #d4edda;
    }

    .card-danger {
        border: 1px solid #dc3545;
        background-color: #f8d7da;
    }

    .card-title {
        font-size: 16px;
        font-weight: bold;
        text-align: left; /* Align title to the left */
        margin-bottom: 0px;
    }

    .card-body {
        font-size: 14px;
        text-align: left; /* Align body text to the left */
    }

    .modal-footer-content {
        float: left;
        width: auto;
        margin-right: 10px;
    }

    .modal-buttons {
        float: right;
    }

    .icon-success {
        color: #28a745;
        margin-right: 10px;
    }

    .icon-fail {
        color: #dc3545;
        margin-right: 10px;
    }

    .modal-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 15px;
    }

    .modal-footer-content {
        flex: 1;
        display: flex;
        align-items: center;
    }

    .modal-buttons {
        display: flex;
        align-items: center;
    }

    .card-body {
        padding: 0px;
    }

    .card-title {
        font-size: 16px;
        font-weight: bold;
    }

    .card-description {
        font-size: 14px;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .close-card {
        cursor: pointer;
        font-size: 18px;
        color: #FDAB9E; 
    }

    .close-card:hover {
        color: #bd2130; 
    }

    .unreview {
        color: gray !important;
        border-color: gray !important;
        box-shadow: none; 
    }

    /* input.form-check-label. */
    .review {
        color: white !important;
        background-color: #3D8D7A;
		border: none  !important;
    }

    .highlight {
        background-color: rgba(0, 255, 0, 0.1) !important;
        font-weight: bold !important;
    }
    .highlight-edit {
        background-color: rgba(0, 0, 255, 0.1) !important;
        font-weight: bold !important;
    }
        /* Basic button style for the span */
        .form-check-label {
        display: inline-block;
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 12px;
        cursor: pointer;
        text-align: center;
        transition: all 0.3s ease;
    }

    /* Hover effect for the button */
    .form-check-label:hover {
        opacity: 0.8;
    }

    /* Focused effect to make it more accessible */
    .form-check-label:focus {
        outline: none;
    }

    .child-table {
        margin-left: 50px;
        width: 90%;
        border-collapse: collapse;
    }

    .child-table th, .child-table td {
        border: 1px solid #ddd;
        padding: 5px;
    }

    /* Styling untuk container dengan scroll */
    .child-table-container {
        max-height: 500px; 
        overflow-y: auto; 
    }

    /* Style untuk scrollbar itu sendiri */
    .child-table-container::-webkit-scrollbar {
        width: 6px; 
    }

    /* Style untuk track (background) scrollbar */
    .child-table-container::-webkit-scrollbar-track {
        background: #e0f2f1;
        border-radius: 10px;
    }

    /* Style untuk thumb (pegangan scrollbar) */
    .child-table-container::-webkit-scrollbar-thumb {
        background: #9ACBD0; 
        border-radius: 10px; 
    }

    /* Gaya saat thumb scrollbar di-hover */
    .child-table-container::-webkit-scrollbar-thumb:hover {
        background: #48A6A7;
    }

	.review-border {
		border: 1px solid green  !important;
		color: green  !important;
	}

	.disabled-btn {
		background-color: #ccc; /* Ganti warna latar belakang tombol */
		color: #666; /* Ganti warna teks tombol */
		border: 1px solid #ddd; /* Ganti border tombol */
		cursor: not-allowed; /* Set cursor menjadi not-allowed agar tidak bisa diklik */
	}
</style>
<style>
	#textInform2 .alert {
		display: block !important;
		margin-top: 20px;
		font-size: 16px;
		z-index: 1000; /* Pastikan info card di atas elemen lain */
	}
</style>

<!-- SweetAlert2 CSS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    let table;
    // let table1;
    let id_one_water_sample = $('#id_one_water_sample').val();
    let colilertBarcode = $('#colilert_barcode').val();
    let idColilertIn = $('#id_colilert_in').val();
    console.log(idColilertIn);
    let dilution = $('#dilution').val();
    const BASE_URL = '/limsonewater/index.php';
    let result;

    $(document).ready(function() {
        let loggedInUser = '<?php echo $this->session->userdata('id_users'); ?>';
		let userCreated = $('#user_created').val();
		let userReview = $('#user_review').val();
		let fullName = $('#reviewed_by_label').val();
        $('#reviewed_by_label').val(fullName ? fullName : '-');

		// Definisikan state review
		const states = [
			{ value: 0, label: "Unreview", class: "unreview" },
			{ value: 1, label: "Reviewed", class: "review" }
		];

		// Ambil nilai awal dari input hidden
		let currentState = parseInt($('#review').val());
		if (isNaN(currentState) || currentState < 0 || currentState > 1) currentState = 0;


		// Set tampilan awal pada label review
		$('#review_label')
			.text(states[currentState].label)
			.removeClass()
			.addClass('form-check-label ' + states[currentState].class);

		// Cek apakah user login BUKAN creator
		if (userCreated !== loggedInUser) {
			$('#user_review').val(loggedInUser);

			$('#review_label').off('click').on('click', function () {
				if ($('#review').val() === '1') {
					Swal.fire({
						icon: 'info',
						title: 'Review Locked',
						text: 'You have already reviewed this. Further changes are not allowed.',
						confirmButtonText: 'OK'
					});
					return;
				}

				Swal.fire({
					icon: 'question',
					title: 'Are you sure?',
					showCancelButton: true,
					confirmButtonText: 'OK',
					cancelButtonText: 'Cancel',
					reverseButtons: true
				}).then((result) => {
					if (result.isConfirmed) {

						currentState = (currentState + 1) % states.length;

						$('#review').val(states[currentState].value);
						$('#review_label')
							.text(states[currentState].label)
							.removeClass()
							.addClass('form-check-label ' + states[currentState].class);

						$.ajax({
							url: '<?php echo site_url('Colilert_idexx_water/saveReview'); ?>',
							method: 'POST',
							data: $('#formSampleReview').serialize(),
							dataType: 'json',
							success: function(response) {
								if (response.status) {
									Swal.fire({
										icon: 'success',
										title: 'Review saved successfully!',
										text: response.message,
										timer: 1000,
										showConfirmButton: false
									}).then(() => {
										location.reload();
									});
								} else {
									Swal.fire({
										icon: 'error',
										title: 'Failed to save review',
										text: response.message
									});
								}
							},
							error: function(xhr, status, error) {
								console.error('AJAX Error: ' + status + error);
								Swal.fire('Error', 'Something went wrong during submission.', 'error');
							}
						});
					} else {
						Swal.fire({
							icon: 'info',
							title: 'Review Not Changed',
							text: 'No changes were made.',
							timer: 2000
						});
					}
				});
			});

			if ($('#review').val() === '1') {
				showInfoCard(
					'#textInform2',
					'<i class="fa fa-times-circle"></i> You are not the creator',
					"In this case, you can't review because it has already been reviewed.",

					false
				);
			} else {
				showInfoCard(
					'#textInform2',
					'<i class="fa fa-times-circle"></i> You are not the creator',
					"In this case, you can review this data. Hover over the box on the right side to start the review.",
					false
				);

			}

			$('#review_label')
			.on('mouseenter', function() {
				if ($('#review').val() !== '1') { 
					$(this).text('Review')
						.addClass('review-border');
				}
			})
			.on('mouseleave', function() {
				if ($('#review').val() !== '1') { 
					$(this).text('Unreview')
						.removeClass('review-border');
				}
			});


			$('#saveButtonDetail').prop('disabled', false);
		} else {
			$('#user_review').val(loggedInUser);

			showInfoCard(
				'#textInform2',
				'<i class="fa fa-check-circle"></i> You are the creator',
				"You have full access to edit this data but not review.",
				true
			);

			$('#saveButtonDetail').prop('disabled', true);
		}
		
		// Fungsi untuk cancel review (khusus admin user 1 & 2)
        // Cek status review ketika halaman dimuat
        if ($('#review').val() === '1') {
                // Jika status review = 0 (belum di-review), disable tombol cancel
                $('#cancelReviewBtn').prop('disabled', false).removeClass('disabled-btn');
            } else {
                // Jika status review = 1 (sudah di-review),  tombol bisa diklik
                $('#cancelReviewBtn').prop('disabled', true).addClass('disabled-btn');
            }

        // Event handler ketika tombol Cancel Review diklik
        $('#cancelReviewBtn').on('click', function () {
            Swal.fire({
                icon: 'warning',
                title: 'Cancel Review?',
                text: 'This will reset the review status so another user can review it again.',
                showCancelButton: true,
                confirmButtonText: 'Yes, cancel it',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Set review dan user_review untuk cancel
                    $('#review').val(0);
                    $('#user_review').val('');  // Kosongkan user review

                    // Update label status menjadi Unreview
                    $('#review_label')
                        .text('Unreview')
                        .removeClass()
                        .addClass('form-check-label unreview');  // Ubah tampilan label

                    // Disable the Cancel Review button after canceling the review
                    $('#cancelReviewBtn').prop('disabled', true).addClass('disabled-btn');  // Disable tombol

                    // Pastikan ID yang diperlukan ada di form
                    let formData = $('#formSampleReview').serialize(); 
                    console.log('Form data to be sent: ', formData); // Debugging log

                    $.ajax({
                        url: '<?php echo site_url('Colilert_idexx_water/cancelReview'); ?>',
                        method: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function (response) {
                            if (response.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Review canceled successfully!',
                                    timer: 1000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed to cancel review',
                                    text: response.message
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX Error: ' + status + error);
                            Swal.fire('Error', 'Something went wrong during cancel.', 'error');
                        }
                    });
                }
            });
        });



	  // Mouse enter/leave effects for review label
	  $('#review_label')
        .on('mouseenter', function() {
            if ($('#review').val() !== '1') { 
                $(this).text('Review')
                    .addClass('review-border');
            }
        })
        .on('mouseleave', function() {
            if ($('#review').val() !== '1') { 
                $(this).text('Unreview')
                    .removeClass('review-border');
            }
        });



        // Function to show a dynamic info card
		function showInfoCard(target, message, description, isSuccess) {
            // Add dynamic content to the target card
            $(target).find('.statusMessage').html(message);
            $(target).find('.statusDescription').text(description);

            // Apply classes based on success or failure
            if (isSuccess) {
                $(target).removeClass('card-danger').addClass('card-success');
            } else {
                $(target).removeClass('card-success').addClass('card-danger');
            }

            // Show the info card
            $(target).fadeIn();
        }

        // Close the card when the 'x' icon is clicked
        $('.close-card').on('click', function() {
            $('#textInform1').fadeOut(); // Fade out the card
            $('#textInform2').fadeOut();
        });


        function datachart(valueLargeWells, valueSmallWells) {
            $.ajax({
                type: "GET",
                url: `${BASE_URL}/Colilert_idexx_water/data_chart?valueLargeWells=`+valueLargeWells+"&valueSmallWells="+valueSmallWells,
                dataType: "json",
                success: function(data) {
                    console.log('data mpm '+ data);
                    if (data.length > 0) {
                        if (data[0].mpn == '<Detection') {
                            result = "<"+ Math.round(1 / dilution);
                        }
                        else if (data[0].mpn == '>Detection') {
                            result = ">"+ Math.round(2082 / dilution);
                        }
                        else {
                            result = Math.round(data[0].mpn / dilution);
                        }
                    }
                    else {
                        result = 'Invalid';     
                    }
                }
            });
            
            return result; 
        }

        // $('#ecoli_largewells').on('change keypress keyup keydown', function(event) {        
        //     let empn = datachart($('#ecoli_largewells').val(), $('#ecoli_smallwells').val());
        //     if (empn == 'Invalid'){
        //         $('#ecoli').css({'background-color' : '#FFE6E7'});
        //         $('#ecoli_largewells').val('0');
        //         $('#ecoli_smallwells').val('0');
        //     }
        //     else {
        //         $('#ecoli').css({'background-color' : '#EEEEEE'});
        //     }
        //     $("#ecoli").val(empn);
        // });

        // $('#ecoli_smallwells').on('change keypress keyup keydown', function(event) {        
        //     let empn = datachart($('#ecoli_largewells').val(), $('#ecoli_smallwells').val());
        //     if (empn == 'Invalid'){
        //         $('#ecoli').css({'background-color' : '#FFE6E7'});
        //         $('#ecoli_largewells').val('0');
        //         $('#ecoli_smallwells').val('0');
        //     }
        //     else {
        //         $('#ecoli').css({'background-color' : '#EEEEEE'});
        //     }
        //     $("#ecoli").val(empn);
        // });



        // $('#coliforms_largewells').on('change keypress keyup keydown', function(event) {        
        //     let empn = datachart($('#coliforms_largewells').val(), $('#coliforms_smallwells').val());
        //     if (empn == 'Invalid'){
        //         $('#total_coliforms').css({'background-color' : '#FFE6E7'});
        //         $('#coliforms_largewells').val('0');
        //         $('#coliforms_smallwells').val('0');
        //     }
        //     else {
        //         $('#total_coliforms').css({'background-color' : '#EEEEEE'});
        //     }
        //     $("#total_coliforms").val(empn);
        // });

        // $('#coliforms_smallwells').on('change keypress keyup keydown', function(event) {        
        //     let empn = datachart($('#coliforms_largewells').val(), $('#coliforms_smallwells').val());
        //     if (empn == 'Invalid'){
        //         $('#total_coliforms').css({'background-color' : '#FFE6E7'});
        //         $('#coliforms_largewells').val('0');
        //         $('#coliforms_smallwells').val('0');
        //     }
        //     else {
        //         $('#total_coliforms').css({'background-color' : '#EEEEEE'});
        //     }
        //     $("#total_coliforms").val(empn);
        // });

        function showConfirmationDelete(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal-delete').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete, .btn_delete72', function() {
            let id = $(this).data('id');
            let url;
            if ($(this).hasClass('btn_delete')) {
                url = '<?php echo site_url('Colilert_idexx_water/delete_detail'); ?>/' + id;
                $('.modal-title').html('<i class="fa fa-trash"></i> Enterolert Out | Delete <span id="my-another-cool-loader"></span>');
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


        $('#compose-modal').on('shown.bs.modal', function () {
            $('.val1tip').tooltipster('hide'); 
        });

        $("input").keypress(function(){
            $('.val1tip').tooltipster('hide'); 
        });


        $('#compose-modal').on('shown.bs.modal', function () {
            $('#barcode_tray24').focus();
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


        table = $("#example2").DataTable({
            oLanguage: {
                sProcessing: "Loading data, please wait..."
            },
            processing: true,
            serverSide: true,
            paging: false,
            info: false,
            bFilter: false,
            ajax: {"url": "../../Colilert_idexx_water/subjson?id="+idColilertIn, "type": "POST"},
            columns: [
                {"data": "colilert_barcode"},
                {"data": "date_sample"}, 
                {"data": "time_sample"}, 
                {"data": "ecoli_largewells"}, 
                {"data": "ecoli_smallwells"},
                {"data": "ecoli"},
                {"data": "lowerdetection"},
                {"data": "coliforms_largewells"}, 
                {"data": "coliforms_smallwells"},
                {"data": "total_coliforms"},
                {"data": "remarks"},
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
                    $('#addtombol_det').prop('disabled', true);
                } else {
                    $('#addtombol_det').prop('disabled', false);
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

        $('#addtombol_det').click(function() {
            let id_one_water_sample = $('#id_one_water_sample').val();
            $('#mode_det').val('insert');
            $('#modal-title-detail').html('<i class="fa fa-wpforms"></i> Colilert Idexx Out | New <span id="my-another-cool-loader"></span>');
            $('#idx_one_water_sample').val(id_one_water_sample);
            $('#colilert_barcodex').val(colilertBarcode);
            $('#colilert_barcodex').attr('readonly', true);
            $('#idx_colilert_in').val(idColilertIn);
            $('#ecoli_largewells').val('0');
            $('#ecoli_smallwells').val('0');
            $('#ecoli').val('');
            $('#lowerdetection').val('0');
            $('#coliforms_largewells').val('0');
            $('#coliforms_smallwells').val('0');
            $('#total_coliforms').val('');
            $('#remarks').val('');
            $('#compose-modal').modal('show');
        });

        $('#example2').on('click', '.btn_edit_det', function() {
            let tr = $(this).closest('tr');
            let data = table.row(tr).data();
            let id_one_water_sample = $('#id_one_water_sample').val();
            console.log(data);
            $('#mode_det').val('edit');
            $('#modal-title-detail').html('<i class="fa fa-pencil-square"></i> Colilert Idexx Out | Update <span id="my-another-cool-loader"></span>');
            $('#idx_one_water_sample').val(id_one_water_sample);
            $('#idx_colilert_in').val(idColilertIn);
            $('#id_colilert_out').val(data.id_colilert_out);
            $('#colilert_barcodex').val(data.colilert_barcode);
            $('#colilert_barcodex').attr('readonly', true);
            $('#date_sample').val(data.date_sample);
            $('#time_sample').val(data.time_sample);
            $('#ecoli_largewells').val(data.ecoli_largewells);
            $('#ecoli_smallwells').val(data.ecoli_smallwells);
            $('#ecoli').val(data.ecoli);
            // $('#ecoli').attr('readonly', true);
            $('#lowerdetection').val(data.lowerdetection);
            $('#coliforms_largewells').val(data.coliforms_largewells);
            $('#coliforms_smallwells').val(data.coliforms_smallwells);
            $('#total_coliforms').val(data.total_coliforms);
            // $('#total_coliforms').attr('readonly', true);
            $('#remarks').val(data.remarks);
            $('#compose-modal').modal('show');
        });

    });
</script>
