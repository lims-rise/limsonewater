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

							<label for="time_incubator" class="col-sm-2 control-label">Time in Incubator</label>
							<div class="col-sm-4">
								<input class="form-control " id="time_incubator" name="time_incubator" value="<?php echo $time_incubator ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="comments" class="col-sm-2 control-label">Comments</label>
							<div class="col-sm-4">
								<input class="form-control " id="comments" name="comments" value="<?php echo $comments ?>"  disabled>
							</div>
						</div>

					</div><!-- /.box-body -->
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
                                            <input id="barcode_tray24" name="barcode_tray24" type="text"  placeholder="Barcode Tray" class="form-control">
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
                                            <input id="dry_weight72" name="dry_weight72" type="number"  step="any"  placeholder="Dry Weight 72h (g)" class="form-control" required>
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


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    let table;
    let table1;
    let id_moisture = $('#id_moisture').val();
    const BASE_URL = '/limsonewater/index.php';

    $(document).ready(function() {
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
                    $('#addtombol_det24').hide();
                } else {
                    $('#addtombol_det24').show();
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
                    $('#addtombol_det72').hide();
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
            $('#mode_det24').val('insert');
            $('#modal-title-detail').html('<i class="fa fa-wpforms"></i> Moisture Content | 24 Hour <span id="my-another-cool-loader"></span>');
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
            $('#mode_det72').val('insert');
            $('#modal-title-detail72').html('<i class="fa fa-wpforms"></i> Moisture Content | 48 Hour <span id="my-another-cool-loader"></span>');
            $('#barcode_tray72').val('');
            $('#barcode_tray72').attr('readonly', true);
            $('#barcode_tray72').attr('required', true);
            $('#idx_moisture72').val(id_moisture);
            $('#dry_weight72').val('');
            $('#dry_weight_persen').val('');
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
            $('#idx_moisture72').val(id_moisture);
            $('#id_moisture72').val(data.id_moisture72);
            $('#date_moisture72').val(data.date_moisture72);
            $('#time_moisture72').val(data.time_moisture72);
            $('#barcode_tray72').attr('readonly', true);
            $('#barcode_tray72').val(data.barcode_tray);
            $('#dry_weight72').val(data.dry_weight72);
            $('#dry_weight_persen').val(data.dry_weight_persen);
            $('#comments72').val(data.comments72);
            $('#compose-modal72').modal('show');
        });

    });
</script>
