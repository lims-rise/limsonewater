<div class="content-wrapper">
	<section class="content">
		<div class="box box-black box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Processing | Moisture Content | Details</h3>
			</div>
				<form role="form"  id="formKeg" method="post" class="form-horizontal">
					<div class="box-body">
						<!-- <input type="hidden" class="form-control " id="id_req" name="id_req" value="<?php// echo $id_req ?>"> -->
						<input id="id_moisture" name="id_moisture" type="hidden" class="form-control input-sm" value="<?php echo $id_moisture ?>">
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
							<label for="date_start" class="col-sm-2 control-label">Date Assay Start</label>
							<div class="col-sm-4">
								<input class="form-control " id="date_start" name="date_start" value="<?php echo $date_start ?>"  disabled>
							</div>

							<label for="sampletype" class="col-sm-2 control-label">Sample Type</label>
							<div class="col-sm-4">
								<input class="form-control " id="sampletype" name="sampletype" value="<?php echo $sampletype ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="barcode_moisture_content" class="col-sm-2 control-label">Barcode Moisture Content</label>
							<div class="col-sm-4">
								<input class="form-control " id="barcode_moisture_content" name="barcode_moisture_content" value="<?php echo $barcode_moisture_content ?>"  disabled>
							</div>

							<label for="tray_weight" class="col-sm-2 control-label">Tray Weight(g)</label>
							<div class="col-sm-4">
								<input class="form-control " id="tray_weight" name="tray_weight" value="<?php echo $tray_weight ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="traysample_wetweight" class="col-sm-2 control-label">Tray Sample(g) Wet Weight</label>
							<div class="col-sm-4">
								<input class="form-control " id="traysample_wetweight" name="traysample_wetweight" value="<?php echo $traysample_wetweight ?>" disabled>
							</div>

							<label for="time_incubator" class="col-sm-2 control-label">Time Incubator</label>
							<div class="col-sm-4">
								<input class="form-control " id="time_incubator" name="time_incubator" value="<?php echo $time_incubator ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
                            <label for="date_incubator" class="col-sm-2 control-label">Date Incubator</label>
							<div class="col-sm-4">
								<input class="form-control " id="date_incubator" name="date_incubator" value="<?php echo $date_incubator ?>"  disabled>
							</div>

							<label for="comments" class="col-sm-2 control-label">Comments</label>
							<div class="col-sm-4">
								<input class="form-control " id="comments" name="comments" value="<?php echo $comments ?>"  disabled>
							</div>
						</div>

					</div><!-- /.box-body -->
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
                                <h3 class="box-title">24 Hour Moisture</h3>
                            </div>
							<div class="box-body pad table-responsive">
								<?php
									$lvl = $this->session->userdata('id_user_level');
									if ($lvl != 4){
										echo "<button class='btn btn-primary' id='addtombol_det24'><i class='fa fa-wpforms' aria-hidden='true'></i> New Data</button>";
									}
								?>
								<table id="example2" class="table display table-bordered table-striped" width="100%">
									<thead>
										<tr>
											<th>Date Moisture</th>
											<th>Time Moisture Tested</th>
                                            <th>Barcode Tray</th>
                                            <th>Dry Weight 24h (g)</th>
                                            <th>Comments</th>
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
                                <h3 class="box-title">48 Hour Moisture</h3>
                            </div>
							<div class="box-body pad table-responsive">
								<?php
									$lvl = $this->session->userdata('id_user_level');
									if ($lvl != 4){
										echo "<button class='btn btn-primary' id='addtombol_det72'><i class='fa fa-wpforms' aria-hidden='true'></i> New Data</button>";
									}
								?>
								<table id="example3" class="table display table-bordered table-striped" width="100%">
									<thead>
										<tr>
											<th>Date Moisture</th>
											<th>Time Moisture Tested</th>
                                            <th>Barcode Tray</th>
                                            <th>Dry Weight 48h (g)</th>
                                            <th>Moisture Content %</th>
                                            <th>Dry Weight %</th>
                                            <th>Comments</th>
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
						<button type="button" name="batal" value="batal" class="btn btn-warning" onclick="window.location.href='<?= site_url('moisture_content'); ?>';">
							<i class="fa fa-times"></i> Close
						</button>
					</div>
				</div>
			</div> <!--footer -->
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
                        <form id="formDetail24" action=<?php echo site_url('Moisture_content/savedetail24') ?> method="post" class="form-horizontal">
                            <div class="modal-body">
                                <div class="form-group">
                                        <div class="col-sm-9">
                                            <input id="mode_det24" name="mode_det24" type="hidden" class="form-control input-sm">
                                            <input id="idx_moisture24" name="idx_moisture24" type="hidden" class="form-control input-sm">
                                            <input id="id_moisture24" name="id_moisture24" type="hidden" class="form-control input-sm">
                                            <input id="id24_one_water_sample" name="id24_one_water_sample" type="hidden" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="date_moisture24" class="col-sm-4 control-label">Date Moisture</label>
                                        <div class="col-sm-8">
                                            <input id="date_moisture24" name="date_moisture24"type="date" class="form-control" placeholder="Date Moisture" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="time_moisture24" class="col-sm-4 control-label">Time Moisture Tested</label>
                                        <div class="col-sm-8">
                                            <div class="input-group clockpicker">
                                            <input id="time_moisture24" name="time_moisture24" class="form-control" placeholder="Time Moisture Tested" value="<?php 
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
                                        <label for="barcode_tray24" class="col-sm-4 control-label">Barcode Tray</label>
                                        <div class="col-sm-8">
                                            <input id="barcode_tray24" name="barcode_tray24" type="text"  placeholder="Barcode Tray" class="form-control" required>
                                            <div class="val1tip"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="dry_weight24" class="col-sm-4 control-label">Dry Weight 24h (g)</label>
                                        <div class="col-sm-8">
                                            <input id="dry_weight24" name="dry_weight24" type="number"  step="any"  placeholder="Dry Weight 24h (g)" class="form-control">
                                        </div>
                                    </div>

                                <div class="form-group">
                                        <label for="comments24" class="col-sm-4 control-label">Comments</label>
                                        <div class="col-sm-8">
                                            <textarea id="comments24" name="comments24" class="form-control" placeholder="Comments"></textarea>
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

<!-- MODAL FORM MOISTURE 72 -->
<div class="modal fade" id="compose-modal72" tabindex="-1" role="dialog" aria-hidden="true">
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
                                            <input id="id27_one_water_sample" name="id27_one_water_sample" type="hidden" class="form-control input-sm">
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
                                        <label for="dry_weight72" class="col-sm-4 control-label">Dry Weight 48h (g)</label>
                                        <div class="col-sm-8 dryweightcount">
                                            <input id="dry_weight72" name="dry_weight72" type="number"  step="any"  placeholder="Dry Weight 48h (g)" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="moisture_content_persen" class="col-sm-4 control-label">Moisture Content %</label>
                                        <div class="col-sm-8 dryweightcount">
                                            <input id="moisture_content_persen" name="moisture_content_persen" type="number"  step="any"  placeholder="Moisture Content %" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="dry_weight_persen" class="col-sm-4 control-label">Dry Weight %</label>
                                        <div class="col-sm-8">
                                            <input id="dry_weight_persen" name="dry_weight_persen" type="number"  step="any"  placeholder="Dry Weight %" class="form-control" required>
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
</div>


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
		/* background-color: blue !important;  */
		color: #fff !important; 
		border: 1px solid #ddd !important; 
		cursor: not-allowed !important; 
		opacity: 0.6 !important;
		/* pointer-events: none; */
	}

	.disabled-btn:hover {
		/* background-color: #ccc !important; */
		color: #fff !important;
		border: 1px solid #ddd !important;
		transform: none !important; /* Nonaktifkan hover effects */
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
    let table1;
    let id_moisture = $('#id_moisture').val();
    let id_one_water_sample = $('#id_one_water_sample').val();
    const BASE_URL = '/limsonewater/index.php';

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
		// if (userCreated !== loggedInUser) {
		// 	$('#user_review').val(loggedInUser);

		// 	$('#review_label').off('click').on('click', function () {
		// 		if ($('#review').val() === '1') {
		// 			Swal.fire({
		// 				icon: 'info',
		// 				title: 'Review Locked',
		// 				text: 'You have already reviewed this. Further changes are not allowed.',
		// 				confirmButtonText: 'OK'
		// 			});
		// 			return;
		// 		}

		// 		Swal.fire({
		// 			icon: 'question',
		// 			title: 'Are you sure?',
		// 			showCancelButton: true,
		// 			confirmButtonText: 'OK',
		// 			cancelButtonText: 'Cancel',
		// 			reverseButtons: true
		// 		}).then((result) => {
		// 			if (result.isConfirmed) {

		// 				currentState = (currentState + 1) % states.length;

		// 				$('#review').val(states[currentState].value);
		// 				$('#review_label')
		// 					.text(states[currentState].label)
		// 					.removeClass()
		// 					.addClass('form-check-label ' + states[currentState].class);

		// 				$.ajax({
		// 					url: '<?php echo site_url('Moisture_content/saveReview'); ?>',
		// 					method: 'POST',
		// 					data: $('#formSampleReview').serialize(),
		// 					dataType: 'json',
		// 					success: function(response) {
		// 						if (response.status) {
		// 							Swal.fire({
		// 								icon: 'success',
		// 								title: 'Review saved successfully!',
		// 								text: response.message,
		// 								timer: 1000,
		// 								showConfirmButton: false
		// 							}).then(() => {
		// 								location.reload();
		// 							});
		// 						} else {
		// 							Swal.fire({
		// 								icon: 'error',
		// 								title: 'Failed to save review',
		// 								text: response.message
		// 							});
		// 						}
		// 					},
		// 					error: function(xhr, status, error) {
		// 						console.error('AJAX Error: ' + status + error);
		// 						Swal.fire('Error', 'Something went wrong during submission.', 'error');
		// 					}
		// 				});
		// 			} else {
		// 				Swal.fire({
		// 					icon: 'info',
		// 					title: 'Review Not Changed',
		// 					text: 'No changes were made.',
		// 					timer: 2000
		// 				});
		// 			}
		// 		});
		// 	});

		// 	if ($('#review').val() === '1') {
		// 		showInfoCard(
		// 			'#textInform2',
		// 			'<i class="fa fa-times-circle"></i> You are not the creator',
		// 			"In this case, you can't review because it has already been reviewed.",

		// 			false
		// 		);
		// 	} else {
		// 		showInfoCard(
		// 			'#textInform2',
		// 			'<i class="fa fa-times-circle"></i> You are not the creator',
		// 			"In this case, you can review this data. Hover over the box on the right side to start the review.",
		// 			false
		// 		);

		// 	}

		// 	$('#review_label')
		// 	.on('mouseenter', function() {
		// 		if ($('#review').val() !== '1') { 
		// 			$(this).text('Review')
		// 				.addClass('review-border');
		// 		}
		// 	})
		// 	.on('mouseleave', function() {
		// 		if ($('#review').val() !== '1') { 
		// 			$(this).text('Unreview')
		// 				.removeClass('review-border');
		// 		}
		// 	});


		// 	$('#saveButtonDetail').prop('disabled', false);
		// } else {
		// 	$('#user_review').val(loggedInUser);

		// 	showInfoCard(
		// 		'#textInform2',
		// 		'<i class="fa fa-check-circle"></i> You are the creator',
		// 		"You have full access to edit this data but not review.",
		// 		true
		// 	);

		// 	$('#saveButtonDetail').prop('disabled', true);
		// }

		// Configuration based on user role
		const isCreator = userCreated === loggedInUser;
		const canReview = !isCreator;
		
		// Set user review value
		$('#user_review').val(loggedInUser);
		
		// Configure UI based on user role
		configureUserInterface(isCreator, canReview);
		
		// Setup review click handler (common for both creator and non-creator)
		setupReviewClickHandler();
		
		// Setup hover effects for review label
		setupReviewHoverEffects();
		
		/**
		 * Configure UI elements based on user role
		 */
		function configureUserInterface(isCreator, canReview) {
			if (canReview) {
				// Non-creator: Can review
				const reviewStatus = $('#review').val();
				const message = reviewStatus === '1' 
					? "In this case, you can't review because it has already been reviewed."
					: "In this case, you can review this data. Hover over the box on the right side to start the review.";
				
				showInfoCard(
					'#textInform2',
					'<i class="fa fa-times-circle"></i> You are not the creator',
					message,
					false
				);
				
				$('#saveButtonDetail').prop('disabled', false);
			} else {
				// Creator: Cannot review
				showInfoCard(
					'#textInform2',
					'<i class="fa fa-check-circle"></i> You are the creator',
					// "You have full access to edit this data but not review.",
					"You have full access to edit this data and review.",
					true
				);
				
				$('#saveButtonDetail').prop('disabled', true);
			}
		}
		
		/**
		 * Setup click handler for review label
		 */
		function setupReviewClickHandler() {
			$('#review_label').off('click').on('click', function () {
				// Check if review is already locked
				if ($('#review').val() === '1') {
					showReviewLockedAlert();
					return;
				}
				
				// Show confirmation dialog
				showReviewConfirmation();
			});
		}
		
		/**
		 * Setup hover effects for review label
		 */
		function setupReviewHoverEffects() {
			$('#review_label')
				.on('mouseenter', function() {
					if ($('#review').val() !== '1') { 
						$(this).text('Review').addClass('review-border');
					}
				})
				.on('mouseleave', function() {
					if ($('#review').val() !== '1') { 
						$(this).text('Unreview').removeClass('review-border');
					}
				});
		}
		
		/**
		 * Show review locked alert
		 */
		function showReviewLockedAlert() {
			Swal.fire({
				icon: 'info',
				title: 'Review Locked',
				text: 'You have already reviewed this. Further changes are not allowed.',
				confirmButtonText: 'OK'
			});
		}
		
		/**
		 * Show review confirmation dialog
		 */
		function showReviewConfirmation() {
			Swal.fire({
				icon: 'question',
				title: 'Are you sure?',
				showCancelButton: true,
				confirmButtonText: 'OK',
				cancelButtonText: 'Cancel',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					processReviewUpdate();
				} else {
					showReviewCancelledAlert();
				}
			});
		}
		
		/**
		 * Process review update
		 */
		function processReviewUpdate() {
			// Update current state
			currentState = (currentState + 1) % states.length;
			
			// Update UI elements
			updateReviewUI();
			
			// Save review via AJAX
			saveReviewData();
		}
		
		/**
		 * Update review UI elements
		 */
		function updateReviewUI() {
			$('#review').val(states[currentState].value);
			$('#review_label')
				.text(states[currentState].label)
				.removeClass()
				.addClass('form-check-label ' + states[currentState].class);
		}
		
		/**
		 * Save review data via AJAX
		 */
		function saveReviewData() {
			$.ajax({
				url: '<?php echo site_url('Moisture_content/saveReview'); ?>',
				method: 'POST',
				data: $('#formSampleReview').serialize(),
				dataType: 'json',
				success: handleReviewSaveSuccess,
				error: handleReviewSaveError
			});
		}
		
		/**
		 * Handle successful review save
		 */
		function handleReviewSaveSuccess(response) {
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
		}
		
		/**
		 * Handle review save error
		 */
		function handleReviewSaveError(xhr, status, error) {
			console.error('AJAX Error: ' + status + error);
			Swal.fire('Error', 'Something went wrong during submission.', 'error');
		}
		
		/**
		 * Show review cancelled alert
		 */
		function showReviewCancelledAlert() {
			Swal.fire({
				icon: 'info',
				title: 'Review Not Changed',
				text: 'No changes were made.',
				timer: 2000
			});
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
                        url: '<?php echo site_url('Moisture_content/cancelReview'); ?>',
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
                $('.modal-title').html('<i class="fa fa-trash"></i> 48 Hour Moisture | Delete <span id="my-another-cool-loader"></span>');
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

        $('#compose-modal72').on('shown.bs.modal', function () {
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

        $('#compose-modal72').on('shown.bs.modal', function () {
            $('#dry_weight72').focus();
        });

        // $('#barcode_tray24').on("change", function() {
        //     let barcode24 = $('#barcode_tray24').val();
        //     $.ajax({
        //         type: "GET",
        //         url: `${BASE_URL}/Moisture_content/validate24`,
        //         data: { id24: barcode24 },
        //         dataType: "json",
        //         success: function(data) {
        //             if (data.length == 0) {
        //                 let tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + barcode24 +'</strong> is not on moisture content or is not already in the system !</span>');
        //                 $('.val1tip').tooltipster('content', tip);
        //                 $('.val1tip').tooltipster('show');
        //                 $('#barcode_tray24').focus();
        //                 $('#barcode_tray24').val('');       
        //                 $('#barcode_tray24').css({'background-color' : '#FFE6E7'});
        //                 setTimeout(function(){
        //                     $('#barcode_tray24').css({'background-color' : '#FFFFFF'});
        //                     setTimeout(function(){
        //                         $('#barcode_tray24').css({'background-color' : '#FFE6E7'});
        //                         setTimeout(function(){
        //                             $('#barcode_tray24').css({'background-color' : '#FFFFFF'});
        //                         }, 300);                            
        //                     }, 300);
        //                 }, 300);
        //             }
        //         }
        //     });
        // });

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

        // Function to calculate moisture_content_persen and dry_weight_persen
        // function calculateMoistureAndDryWeight() {
        //     let traysampleWetweight = parseFloat($('#traysample_wetweight').val()) || 0; // Get the traysample wet weight
        //     let dryWeight72 = parseFloat($('#dry_weight72').val()) || 0; // Get the dry weight 72h
        //     let trayWeight = parseFloat($('#tray_weight').val()) || 0; // Get the tray weight

        //     if (traysampleWetweight > 0 && dryWeight72 > 0 && trayWeight >= 0) {
        //         // Formula for moisture_content_persen: ((traysample_wetweight - dry_weight72) / (traysample_wetweight - tray_weight) * 100)
        //         let moistureContentPersen = ((traysampleWetweight - dryWeight72) / (traysampleWetweight - trayWeight) * 100).toFixed(2);
        //         $('#moisture_content_persen').val(moistureContentPersen);
                
        //         // Formula for dry_weight_persen: (100 - moisture_content_persen)
        //         let dryWeightPersen = (100 - parseFloat(moistureContentPersen)).toFixed(2);
        //         $('#dry_weight_persen').val(dryWeightPersen);
        //     } else {
        //         $('#moisture_content_persen').val(''); // Clear the moisture content field
        //         $('#dry_weight_persen').val(''); // Clear the dry weight percentage field
        //     }
        // }

        function calculateMoistureAndDryWeight() {
            const traysampleWetWeight = parseFloat($('#traysample_wetweight').val()) || 0;
            const dryWeight72 = parseFloat($('#dry_weight72').val()) || 0;
            const trayWeight = parseFloat($('#tray_weight').val()) || 0;

            const wetSampleWeight = traysampleWetWeight - trayWeight;
            const drySampleWeight = dryWeight72 - trayWeight;

            if (traysampleWetWeight > 0 && dryWeight72 > 0 && trayWeight >= 0 && wetSampleWeight > 0) {
                const moistureFraction = (traysampleWetWeight - dryWeight72) / wetSampleWeight;
                const moistureContentPercent = (moistureFraction * 100).toFixed(2);
                const dryWeightPercent = (100 - parseFloat(moistureContentPercent)).toFixed(2);

                $('#moisture_content_persen').val(moistureContentPercent);
                $('#dry_weight_persen').val(dryWeightPercent);
            } else {
                $('#moisture_content_persen').val('');
                $('#dry_weight_persen').val('');
            }
        }


        // Attach the function to the input event of dry_weight72
        $('#dry_weight72').on('input', calculateMoistureAndDryWeight);

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
            ajax: {"url": "../../Moisture_content/subjson24?id24="+id_moisture, "type": "POST"},
            columns: [
                {"data": "date_moisture24"},
                {"data": "time_moisture24"}, 
                {"data": "barcode_tray"}, 
                {"data": "dry_weight24"}, 
                {"data": "comments24"},
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
                    $('#addtombol_det24').prop('disabled', true).addClass('disabled-btn');
                } else {
                    $('#addtombol_det24').prop('disabled', false).removeClass('disabled-btn');
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
                {
                    "data": "moisture_content_persen",
                    "render": function(data, type, row) {
                        return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
                    }
                },
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
                    $('#addtombol_det72').prop('disabled', true).addClass('disabled-btn');
                } else {
                    $('#addtombol_det72').prop('disabled', false).removeClass('disabled-btn');
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

        $('#addtombol_det24').click(function() {
            // Check if button is disabled
            if ($(this).prop('disabled') || $(this).hasClass('disabled-btn')) {
                return false;
            }
            
            $('#mode_det24').val('insert');
            $('#modal-title-detail').html('<i class="fa fa-wpforms"></i> Moisture Content | 24 Hour <span id="my-another-cool-loader"></span>');
            $('#id24_one_water_sample').val(id_one_water_sample);
            $('#barcode_tray24').val('');
            $('#barcode_tray24').attr('readonly', false);
            $('#idx_moisture24').val(id_moisture);
            $('#dry_weight24').val('');
            $('#comments24').val('');
            $('#compose-modal').modal('show');
        });

        $('#example2').on('click', '.btn_edit_det24', function() {
            let tr = $(this).closest('tr');
            let data = table.row(tr).data();
            $('#mode_det24').val('edit');
            $('#modal-title-detail').html('<i class="fa fa-pencil-square"></i> Update Moisture | 24 Hour <span id="my-another-cool-loader"></span>');
            $('#id24_one_water_sample').val(id_one_water_sample);
            $('#idx_moisture24').val(id_moisture);
            $('#id_moisture24').val(data.id_moisture24);
            $('#date_moisture24').val(data.date_moisture24);
            $('#time_moisture24').val(data.time_moisture24);
            $('#barcode_tray24').attr('readonly', true);
            $('#barcode_tray24').val(data.barcode_tray);
            $('#dry_weight24').val(data.dry_weight24);
            $('#comments24').val(data.comments24);
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

        $('#addtombol_det72').on('click', function() {
            // Check if button is disabled
            if ($(this).prop('disabled') || $(this).hasClass('disabled-btn')) {
                return false;
            }
            
            $('#mode_det72').val('insert');
            $('#modal-title-detail72').html('<i class="fa fa-wpforms"></i> Moisture Content | 48 Hour <span id="my-another-cool-loader"></span>');
            $('#id27_one_water_sample').val(id_one_water_sample);
            $('#barcode_tray72').val('');
            $('#barcode_tray72').attr('readonly', true);
            $('#barcode_tray72').attr('required', true);
            $('#idx_moisture72').val(id_moisture);
            $('#dry_weight72').val('');
            $('#moisture_content_persen').val('');
            $('#moisture_content_persen').attr('readonly', true);
            $('#dry_weight_persen').val('');
            $('#dry_weight_persen').attr('readonly', true);
            $('#comments72').val('');

            let td = $('#example2 td:first');
            let data = table.row(td).data();
            
            if (data && data.barcode_tray) {
                let barcode_tray = data.barcode_tray;
                // Parsing data ke komponen
                $('#barcode_tray72').val(barcode_tray);
                $('#compose-modal72').modal('show');
            } else {
                // Tampilkan modal konfirmasi
                $('#confirm-modal').modal('show');
                // Tambahkan pesan ke modal
                $('#confirm-modal .modal-body').html('<p class="text-center" style="font-size: 15px;">You have not filled in the 24-hour moisture data. Please fill in that data first.</p>');
            }
        });
        

        $('#example3').on('click', '.btn_edit_det72', function() {
            let tr = $(this).closest('tr');
            let data = table1.row(tr).data();
            $('#mode_det72').val('edit');
            $('#modal-title-detail72').html('<i class="fa fa-pencil-square"></i> Update Moisture | 48 Hour <span id="my-another-cool-loader"></span>');
            $('#id27_one_water_sample').val(id_one_water_sample);
            $('#idx_moisture72').val(id_moisture);
            $('#id_moisture72').val(data.id_moisture72);
            $('#date_moisture72').val(data.date_moisture72);
            $('#time_moisture72').val(data.time_moisture72);
            $('#barcode_tray72').attr('readonly', true);
            $('#barcode_tray72').val(data.barcode_tray);
            $('#dry_weight72').val(data.dry_weight72);
            $('#moisture_content_persen').val(data.moisture_content_persen);
            $('#moisture_content_persen').attr('readonly', true);
            $('#dry_weight_persen').val(data.dry_weight_persen);
            $('#dry_weight_persen').attr('readonly', true);
            $('#comments72').val(data.comments72);
            $('#compose-modal72').modal('show');
        });

    });
</script>
