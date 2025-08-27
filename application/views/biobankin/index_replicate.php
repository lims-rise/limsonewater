<div class="content-wrapper">
	<section class="content">
		<div class="box box-black box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Processing | Sample Biobank | Replicates</h3>
			</div>
				<form role="form"  id="formKeg" method="post" class="form-horizontal">
					<div class="box-body">
						<!-- <input type="hidden" class="form-control " id="id_req" name="id_req" value="<?php// echo $id_req ?>"> -->
						<input class="form-control " id="id_biobankin_detail" type="hidden" name="id_biobankin_detail" value="<?php echo $id_biobankin_detail ?>"  disabled>
						<div class="form-group">
							<label for="id_one_water_sample1" class="col-sm-2 control-label">ID One water</label>
							<div class="col-sm-4">
								<input class="form-control " id="id_one_water_sample1" name="id_one_water_sample1" value="<?php echo $id_one_water_sample ?>"  disabled>
							</div>

							<label for="sampletypecombination" class="col-sm-2 control-label">Sample Type</label>
							<div class="col-sm-4">
								<input class="form-control " id="sampletypecombination" name="sampletypecombination" value="<?php echo $sampletypecombination ?>"  disabled>
							</div>
						</div>

						<div class="form-group">

							<!-- <label for="sampletype" class="col-sm-2 control-label">Sample Type</label>
							<div class="col-sm-4">
								<input class="form-control " id="sampletype" name="sampletype" value="<?php echo $sampletype ?>"  disabled>
							</div> -->

							<label for="replicates" class="col-sm-2 control-label">Replicates</label>
							<div class="col-sm-4">
								<input class="form-control " id="replicates" name="replicates" value="<?php echo $replicates ?>"  disabled>
							</div>

							<label for="date_conduct" class="col-sm-2 control-label">Date conduct</label>
							<div class="col-sm-4">
								<input class="form-control " id="date_conduct" name="date_conduct" value="<?php echo $date_conduct ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="realname" class="col-sm-2 control-label">Lab tech</label>
							<div class="col-sm-4">
								<input class="form-control " id="realname" name="realname" value="<?php echo $realname ?>"  disabled>
							</div>

							<label for="comments1" class="col-sm-2 control-label">Comments</label>
							<div class="col-sm-4">
								<!-- <input class="form-control " id="comments" name="comments" value="<?php echo $comments ?>"  disabled> -->
								<textarea id="comments1" name="comments1" class="form-control" disabled> <?php echo $comments ?> </textarea>
							</div>
						</div>



					</div><!-- /.box-body -->
				</form>
				<form id="formSampleReview" method="post">
					<input type="hidden" name="id_one_water_sample" id="id_one_water_sample" value="<?php echo $id_one_water_sample ?>">
					<input type="hidden" id="review" name="review" value="<?php echo $review ?>">
					<input type="hidden" id="user_review" name="user_review" value="<?php echo $user_review ?>">
					<input type="hidden" id="user_created" name="user_created" value="<?php echo $user_created ?>">

					<!-- <div class="form-group row">
						<label for="review" class="col-sm-4 col-form-label"></label>
						<div class="col-sm-8">
							<div class="d-flex align-items-center">
								<span id="review_label" class="form-check-label unreview" role="button" tabindex="0">
									Unreview
								</span>
								<span class="ms-2">Review by: </span>
								<input type="text" id="reviewed_by_label" 
									value="<?php echo $full_name ? $full_name : '-' ?>" 
									readonly style="font-style: italic; font-weight: bold; font-size: 11px;" />
							</div>
						</div>
					</div> -->


					<!-- <div class="modal-footer clearfix" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px;">
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
					</div> -->

				</form>

			<div class="box-footer">
                <!-- <div class="row"> -->
                    <div class="col-xs-12"> 
                        <div class="box box-primary box-solid">
                            <div class="box-header">
                                <h3 class="box-title">Detail Samples</h3>
                            </div>
							<div class="box-body pad table-responsive">
								<?php
									$lvl = $this->session->userdata('id_user_level');
									if ($lvl != 4){
										$q = $this->db->query('
										SELECT a.replicates, COUNT(b.barcode_water) as cb_detail
										FROM biobank_in_detail a
										LEFT JOIN biobank_in_replicate b ON a.id_biobankin_detail = b.id_biobankin_detail
										WHERE a.id_biobankin_detail = "' . $id_biobankin_detail .'"');        
										$response = $q->row();
										if ($response) {
											$replicates = $response->replicates;
											$cb_detail = $response->cb_detail;										
											if ($replicates > $cb_detail) {
												echo "<button class='btn btn-primary' id='addtombol_det'><i class='fa fa-wpforms' aria-hidden='true'></i> Add Replicate</button>";
											}
											else {
												echo "<button class='btn btn-primary' id='addtombol_det' disabled><i class='fa fa-wpforms' aria-hidden='true'></i> Add Replicate</button>";
											}
										}	
									}
								?>
								<table id="examplereplicate" class="table display table-bordered table-striped" width="100%">
									<thead>
										<tr>
											<th>Barcode Tube</th>
											<th>Weight (g)</th>
											<th>Concentration (ng/uL)</th>
											<th>Volume (mL)</th>
											<th>Storage method</th>
											<th>Freezer Location</th>
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
						<button type="button" name="batal" value="batal" class="btn btn-warning" onclick="redirectToBiobankin();">
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
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="modal-title">Biobank-IN | Replicates 
				<!-- <input id="id_one_water_sample" name="id_one_water_sample" type="text" disabled>  -->
				</h4>
			</div>
			<form id="formSample"  action= <?php echo site_url('Biobankin/savereplicate') ?> method="post" class="form-horizontal">
				<div class="modal-body">
					<input id="mode_det" name="mode_det" type="hidden" class="form-control input-sm">
					<input id="id_one_water_samplex" name="id_one_water_samplex" type="hidden" class="form-control">
					<input id="date_conduct2" type="hidden" name="date_conduct2" value="<?php echo $date_conduct ?>">
					<input id="id_person" type="hidden" name="id_person" value="<?php echo $id_person ?>">
					<input id="id_biobankin_detailx" name="id_biobankin_detailx" type="hidden" class="form-control input-sm">
					<input id="id_biobankin_replicatex" name="id_biobankin_replicatex" type="hidden" class="form-control input-sm">
				
					<div class="form-group">
						<label for="weight" class="col-sm-4 control-label">Weight (g)</label>
						<div class="col-sm-8">
							<input id="weight" name="weight" placeholder="Weight" type="number" step="any" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label for="concentration_dna" class="col-sm-4 control-label">Concentration DNA (ng/uL)</label>
						<div class="col-sm-8">
							<input id="concentration_dna" name="concentration_dna" placeholder="Concentration DNA (ng/uL)" type="number" step="0.1" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label for="barcode_water" class="col-sm-4 control-label">Barcode Water</label>
						<div class="col-sm-8">
							<input id="barcode_water" name="barcode_water" placeholder="Barcode Water" type="text" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label for="volume" class="col-sm-4 control-label">Volume (mL)</label>
						<div class="col-sm-8">
							<input id="volume" name="volume" placeholder="Volume (mL)" type="number" step="1" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label for="id_culture" class="col-sm-4 control-label">Storage method</label>
						<div class="col-sm-8">
							<select id="id_culture" name="id_culture" class="form-control">
								<option  >-- Select Storage method --</option>
								<?php
									foreach($culture as $row) {
										if ($id_culture == $row['id_culture']) {
											echo "<option value='".$row['id_culture']."' selected='selected'>".$row['culture']."</option>";
										} else {
											echo "<option value='".$row['id_culture']."'>".$row['culture']."</option>";
										}
									}
								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="barcode_tube" class="col-sm-4 control-label">Barcode Tube</label>
						<div class="col-sm-8">
							<input id="barcode_tube" name="barcode_tube" placeholder="Barcode Tube" type="text" class="form-control">
						</div>
					</div>
					
					<div class="form-group">
						<label for="cryobox" class="col-sm-4 control-label">Cryobox</label>
						<div class="col-sm-8">
							<input id="cryobox" name="cryobox" placeholder="Cryobox" type="text" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label for="id_location" class="col-sm-4 control-label">Freezer Location</label>
						<!-- <input id="id_loc" name="id_loc" type="hidden" class="form-control" required> -->
						<div class="col-sm-2">
						<select id='id_freez' name="id_freez" class="form-control" required>
							<option >Freezer</option>
								<?php
								foreach($freez1 as $row){
									echo "<option value='".$row['freezer']."'>".$row['freezer']."</option>";
								}
								?>
						</select>
						</div>
						<div class="col-sm-2">
						<select id='id_shelf' name="id_shelf" class="form-control" required>
							<option >Shelf</option>
								<?php
								foreach($shelf1 as $row){
									echo "<option value='".$row['shelf']."'>".$row['shelf']."</option>";
								}
								?>
						</select>
						</div>
						<div class="col-sm-2">
						<select id='id_rack' name="id_rack" class="form-control" required>
							<option >Rack</option>
								<?php
								foreach($rack1 as $row){
									echo "<option value='".$row['rack']."'>".$row['rack']."</option>";
								}
								?>
						</select>
						</div>
						<div class="col-sm-2">
						<select id='id_tray' name="id_tray" class="form-control" required>
							<option >Tray</option>
								<?php
								foreach($tray1 as $row){
									echo "<option value='".$row['tray']."'>".$row['tray']."</option>";
								}
								?>
						</select>
						</div>
					</div>							
					
					<div class="form-group">
						<label for="id_position" class="col-sm-4 control-label">Position on Cryobox</label>
						<!-- <input id="id_pos" name="id_pos" type="hidden" class="form-control" required>						 -->
						<div class="col-sm-2">
						<select id='id_row' name="id_row" class="form-control" required>
							<option >Row</option>
								<?php
								foreach($row1 as $row){
									echo "<option value='".$row['rows1']."'>".$row['rows1']."</option>";
								}
								?>
						</select>
						</div>
						<div class="col-sm-2">
						<select id='id_col' name="id_col" class="form-control" required>
							<option >Column</option>
								<?php
								foreach($col1 as $row){
									echo "<option value='".$row['columns1']."'>".$row['columns1']."</option>";
								}
								?>
						</select>
						</div>
					</div>		

					<div class="form-group">
						<label for="comments" class="col-sm-4 control-label">Comments</label>
						<div class="col-sm-8">
							<textarea id="comments" name="comments" class="form-control" placeholder="Comments"> </textarea>
						</div>
					</div>

				</div>
				<div class="modal-footer clearfix">
					<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->        
</div>

<!-- MODAL CONFIRMATION -->
	<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Confirm Your Selection</h4>
				</div>
				<div class="modal-body">
					<div id="confirmation-content">
						<!-- Content will be loaded here dynamically -->
					</div>
				</div>
				<div class="modal-footer clearfix">
					<button type="button" id="confirm-save" class="btn btn-primary"><i class="fa fa-save"></i> Ok</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
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
					<h4 class="modal-title"><i class="fa fa-trash"></i> Sample Biobank - Replicates | Delete <span id="my-another-cool-loader"></span></h4>
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
	let id_one_water_sample = $('#id_one_water_sample1').val();
	let barcode_water = $('#barcode_water').val();
	let id_biobankin_detail = $('#id_biobankin_detail').val();
	let base_url = location.hostname;

	function redirectToBiobankin() {
		let id = document.getElementById('id_one_water_sample').value;
		window.location.href = '<?= site_url('Biobankin/read/'); ?>' + id;
	}

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
							url: '<?php echo site_url('Biobankin/saveReview'); ?>',
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
                    url: '<?php echo site_url('Biobankin/cancelReview'); ?>',
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


		// $('#formSampleReview').on('submit', function(e) {
		// 	e.preventDefault();

		// 	$.ajax({
		// 		url: '<?php echo site_url('Biobankin/saveReview'); ?>',
		// 		method: 'POST',
		// 		data: $(this).serialize(),
		// 		dataType: 'json',
		// 		success: function(response) {
		// 			if (response.status) {
		// 				Swal.fire('Success', response.message, 'success');
		// 			} else {
		// 				Swal.fire('Error', response.message, 'error');
		// 			}
		// 		},
		// 		error: function(xhr, status, error) {
		// 			console.error('AJAX Error: ' + status + error);
		// 			Swal.fire('Error', 'Something went wrong.', 'error');
		// 		}
		// 	});
		// });


		function showConfirmationDelete(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal-delete').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('Biobankin/delete_detail'); ?>/' + id;
            $('#confirm-modal-delete #id').text(id);
            console.log(id);
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
				alert('No Testing Types Checked');
				return;
			}

			$.ajax({
				url: '<?php echo site_url('Biobankin/get_confirmation_data'); ?>',
				type: 'POST',
				data: { id_testing_type: selectedTestingTypes },
				dataType: 'json',
				success: function(response) {
					let confirmationContent = '<ul style="list-style-type:none; font-size: 16px">';
					$.each(response, function(index, item) {
						let barcode = item.barcode || "No Generate";
						confirmationContent += '<li style="font-weight: bold;">' + (index + 1) + '. ' + '<span style="font-weight: normal;">Testing Type: </span>' + item.testing_type_name + ' - ' + '<span style="font-weight: normal;">Barcode: </span>' + barcode + '</li>';
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
			$('#barcode_water').focus();
		});
		
		// $('#sampletype').on("change", function() {
        // });

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

		table = $("#examplereplicate").DataTable({
			oLanguage: {
				sProcessing: "Loading data, please wait..."
			},
			processing: true,
			serverSide: true,
			paging: false,
			// ordering: false,
			info: false,
			bFilter: false,
			ajax: {"url": "../../Biobankin/subjsonreplicate?id="+id_biobankin_detail, "type": "POST"},
			columns: [
				{
                    "data": "barcode_tube",
                    "render": function(data, type, row) {
                        return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
                    }
                },
				{"data": "weight"}, 
				{"data": "concentration_dna"}, 
				{"data": "volume"}, 
				{"data": "culture"}, 
				{"data": "location"}, 
				{
					"data" : "action",
					"orderable": false,
					"className" : "text-center"
				}
			],
			order: [[0, 'asc']],
			rowCallback: function(row, data, iDisplayIndex) {
				let info = this.fnPagingInfo();
				let page = info.iPage;
				let length = info.iLength;
				// var index = page * length + (iDisplayIndex + 1);
				// $('td:eq(0)', row).html(index);
			}
		});

        $('#examplereplicate tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }
        })   


		$('#addtombol_det').click(function() {
			let data1 = $('#sampletypecombination').val();
			if (data1 === 'Sediment' || data1 === 'Faeces' || data1 === 'Soil') {
				$('#weight').closest('.form-group').show();
			} else {
				$('#weight').closest('.form-group').hide();
			}
			if (data1 === 'DNA') {
				$('#concentration_dna').closest('.form-group').show();
			} else {
				$('#concentration_dna').closest('.form-group').hide();
			}
			if (data1 === 'Water' || data1 === 'Sewage' || data1 === 'Other Liquid') {
				$('#barcode_water').closest('.form-group').show();
				$('#volume').closest('.form-group').show();
			} else {
				$('#barcode_water').closest('.form-group').hide();
				$('#volume').closest('.form-group').hide();
			}
			if (data1 === 'Culture' || data1 === 'Culture Plate' || data1 === 'Sediment' || data1 === 'Faeces' || data1 === 'Soil' || data1 === 'Nucleic Acids') {
				$('#id_culture').closest('.form-group').show();
			} else {
				$('#id_culture').closest('.form-group').hide();
			}

			$('#mode_det').val('insert');
			$('#modal-title').html('<i class="fa fa-wpforms"></i> New Replication<span id="my-another-cool-loader"></span>');
            $('#barcode_water').attr('readonly', false);
			$('#barcode_water').val('');
			$('#id_biobankin_detailx').val(id_biobankin_detail);
			$('#id_one_water_samplex').val(id_one_water_sample);
			$('#weight').val('');
			$('#concentration_dna').val('');
			$('#volume').val('');
			$('#id_culture').val('');
			$('#barcode_tube').val('');
			$('#cryobox').val('');
			$('#id_loc').val('');
			$('#id_pos').val('');
            $('#id_freez').val('');
            $('#id_shelf').val('');
            $('#id_rack').val('');
            $('#id_tray').val('');
            $('#id_row').val('');
            $('#id_col').val('');

			$('#comments').val('');
			$('#compose-modal').modal('show');
		});


		$('#examplereplicate').on('click', '.btn_edit_det', function() {
            // $('.val1tip').tooltipster('hide');   
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);

			let data1 = $('#sampletypecombination').val();
			if (data1 === 'Sediment' || data1 === 'Faeces' || data1 === 'Soil') {
				$('#weight').closest('.form-group').show();
			} else {
				$('#weight').closest('.form-group').hide();
			}
			if (data1 === 'DNA') {
				$('#concentration_dna').closest('.form-group').show();
			} else {
				$('#concentration_dna').closest('.form-group').hide();
			}
			if (data1 === 'Water' || data1 === 'Sewage' || data1 === 'Other Liquid') {
				$('#barcode_water').closest('.form-group').show();
				$('#volume').closest('.form-group').show();
			} else {
				$('#barcode_water').closest('.form-group').hide();
				$('#volume').closest('.form-group').hide();
			}
			if (data1 === 'Culture' || data1 === 'Culture Plate' || data1 === 'Sediment' || data1 === 'Faeces' || data1 === 'Soil' || data1 === 'Nucleic Acids') {
				$('#id_culture').closest('.form-group').show();
			} else {
				$('#id_culture').closest('.form-group').hide();
			}

			// var data = this.parents('tr').data();
            $('#mode_det').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Update Replication<span id="my-another-cool-loader"></span>');
			$('#id_biobankin_replicatex').val(data.id_biobankin_replicate);
			$('#id_biobankin_detailx').val(data.id_biobankin_detail);
            $('#barcode_water').attr('readonly', true);
			$('#barcode_water').val(data.barcode_water);
			$('#id_one_water_samplex').val(id_one_water_sample);
			$('#weight').val(data.weight);
			$('#concentration_dna').val(data.concentration_dna);
			$('#volume').val(data.volume);
			$('#id_culture').val(data.id_culture);
			$('#barcode_tube').val(data.barcode_tube);
			$('#cryobox').val(data.cryobox);
            $('#id_freez').val(data.freezer);
            $('#id_shelf').val(data.shelf);
            $('#id_rack').val(data.rack);
            $('#id_tray').val(data.tray);
            $('#id_row').val(data.rows1);
            $('#id_col').val(data.columns1);
			$('#comments').val(data.comments);
            $('#compose-modal').modal('show');
		});
	
	});
</script>