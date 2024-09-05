<div class="content-wrapper">
	<section class="content">
		<div class="box box-black box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Processing | Enterolert Idexx Biosolids | Out</h3>
			</div>
				<form role="form"  id="formKeg" method="post" class="form-horizontal">
					<div class="box-body">
						<!-- <input type="hidden" class="form-control " id="id_req" name="id_req" value="<?php// echo $id_req ?>"> -->
						<input id="id_enterolert_bio_in" name="id_enterolert_bio_in" type="hidden" class="form-control input-sm" value="<?php echo $id_enterolert_bio_in ?>">
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

                            <label for="enterolert_barcode" class="col-sm-2 control-label">Enterolert Barcode</label>
							<div class="col-sm-4">
								<input class="form-control " id="enterolert_barcode" name="enterolert_barcode" value="<?php echo $enterolert_barcode ?>"  disabled>
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
							<label for="wet_weight" class="col-sm-2 control-label">Wet Weight (g)</label>
							<div class="col-sm-4">
								<input class="form-control " id="wet_weight" name="wet_weight" value="<?php echo $wet_weight ?>"  disabled>
							</div>

                            <label for="elution_volume" class="col-sm-2 control-label">Elution Volume (mL)</label>
							<div class="col-sm-4">
								<input class="form-control " id="elution_volume" name="elution_volume" value="<?php echo $elution_volume ?>"  disabled>
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

					</div><!-- /.box-body -->
				</form>
			<div class="box-footer">
                <!-- <div class="row"> -->
                    <div class="col-xs-12"> 
                        <div class="box box-primary box-solid">
                            <div class="box-header">
                                <h3 class="box-title">Enterolert Out</h3>
                            </div>
							<div class="box-body pad table-responsive">
								<?php
									$lvl = $this->session->userdata('id_user_level');
									if ($lvl != 7){
										echo "<button class='btn btn-primary' id='addtombol_det'><i class='fa fa-wpforms' aria-hidden='true'></i> New Data</button>";
									}
								?>
								<table id="example2" class="table display table-bordered table-striped" width="100%">
									<thead>
										<tr>
											<th>Enterolert Barcode</th>
											<th>Date Sample</th>
                                            <th>Time Sample</th>
                                            <th>Enterococcus large wells</th>
                                            <th>Enterococcus small wells</th>
                                            <th>Enterococcus (Raw MPN)</th>
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
						<button type="button" name="batal" value="batal" class="btn btn-warning" onclick="window.location.href='<?= site_url('Enterolert_idexx_biosolids'); ?>';">
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
                        <form id="formDetail" action=<?php echo site_url('Enterolert_idexx_biosolids/savedetail') ?> method="post" class="form-horizontal">
                            <div class="modal-body">
                                <div class="form-group">
                                        <div class="col-sm-9">
                                            <input id="mode_det" name="mode_det" type="hidden" class="form-control input-sm">
                                            <input id="idx_enterolert_bio_in" name="idx_enterolert_bio_in" type="hidden" class="form-control input-sm">
                                            <input id="id_enterolert_bio_in" name="id_enterolert_bio_in" type="hidden" class="form-control input-sm">
                                            <input id="id_enterolert_bio_out" name="id_enterolert_bio_out" type="hidden" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="enterolert_barcodex" class="col-sm-4 control-label">Enterolert Barcode</label>
                                        <div class="col-sm-8">
                                            <input id="enterolert_barcodex" name="enterolert_barcodex" placeholder="Enterolert Barcode" type="text" class="form-control">
                                            <div class="val1tip"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="date_sample" class="col-sm-4 control-label">Date Sample</label>
                                        <div class="col-sm-8">
                                            <input id="date_sample" name="date_sample" type="date" class="form-control" placeholder="Date Sample" value="<?php echo date("Y-m-d"); ?>">
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
                                        <label for="enterococcus_largewells" class="col-sm-4 control-label">Enterococcus large wells</label>
                                        <div class="col-sm-8">
                                            <input id="enterococcus_largewells" name="enterococcus_largewells" type="number" step="1" min="0" max="49" class="form-control" placeholder="Enterococcus large wells" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="enterococcus_smallwells" class="col-sm-4 control-label">Enterococcus small wells</label>
                                        <div class="col-sm-8">
                                            <input id="enterococcus_smallwells" name="enterococcus_smallwells" type="number" step="1" min="0" max="48" class="form-control" placeholder="Enterococcus small wells" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="enterococcus" class="col-sm-4 control-label">Enterococcus (Raw MPN)</label>
                                        <div class="col-sm-8">
                                            <input id="enterococcus" name="enterococcus" type="text"  placeholder="Enterococcus (Raw MPN)" class="form-control">
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


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    let table;
    // let table1;
    let enterolertBarcode = $('#enterolert_barcode').val();
    let idEnterolertIn = $('#id_enterolert_bio_in').val();
    let dilution = $('#dilution').val();
    const BASE_URL = '/limsonewater/index.php';
    let result;

    $(document).ready(function() {

        function datachart(valueLargeWells, valueSmallWells) {
            $.ajax({
                type: "GET",
                url: `${BASE_URL}/Enterolert_idexx_biosolids/data_chart?valueLargeWells=`+valueLargeWells+"&valueSmallWells="+valueSmallWells,
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

        $('#enterococcus_largewells').on('change keypress keyup keydown', function(event) {        
            let empn = datachart($('#enterococcus_largewells').val(), $('#enterococcus_smallwells').val());
            if (empn == 'Invalid'){
                $('#enterococcus').css({'background-color' : '#FFE6E7'});
                $('#enterococcus_largewells').val('0');
                $('#enterococcus_smallwells').val('0');
            }
            else {
                $('#enterococcus').css({'background-color' : '#EEEEEE'});
            }
            $("#enterococcus").val(empn);
        });

        $('#enterococcus_smallwells').on('change keypress keyup keydown', function(event) {        
            let empn = datachart($('#enterococcus_largewells').val(), $('#enterococcus_smallwells').val());
            if (empn == 'Invalid'){
                $('#enterococcus').css({'background-color' : '#FFE6E7'});
                $('#enterococcus_largewells').val('0');
                $('#enterococcus_smallwells').val('0');
            }
            else {
                $('#enterococcus').css({'background-color' : '#EEEEEE'});
            }
            $("#enterococcus").val(empn);
        });

        function showConfirmationDelete(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal-delete').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete, .btn_delete72', function() {
            let id = $(this).data('id');
            let url;
            if ($(this).hasClass('btn_delete')) {
                url = '<?php echo site_url('Enterolert_idexx_biosolids/delete_detail'); ?>/' + id;
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
            ajax: {"url": "../../Enterolert_idexx_biosolids/subjson?id="+idEnterolertIn, "type": "POST"},
            columns: [
                {"data": "enterolert_barcode"},
                {"data": "date_sample"}, 
                {"data": "time_sample"}, 
                {"data": "enterococcus_largewells"}, 
                {"data": "enterococcus_smallwells"},
                {"data": "enterococcus"},
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
            $('#mode_det').val('insert');
            $('#modal-title-detail').html('<i class="fa fa-wpforms"></i> Enterolert Idexx Out | New <span id="my-another-cool-loader"></span>');
            $('#enterolert_barcodex').val(enterolertBarcode);
            $('#enterolert_barcodex').attr('readonly', true);
            $('#idx_enterolert_bio_in').val(idEnterolertIn);
            $('#enterococcus_largewells').val('0');
            $('#enterococcus_smallwells').val('0');
            $('#enterococcus').val('0');
            $('#remarks').val('');
            $('#compose-modal').modal('show');
        });

        $('#example2').on('click', '.btn_edit_det', function() {
            let tr = $(this).closest('tr');
            let data = table.row(tr).data();
            console.log(data);
            $('#mode_det').val('edit');
            $('#modal-title-detail').html('<i class="fa fa-pencil-square"></i> Enterolert Idexx Out | Update <span id="my-another-cool-loader"></span>');
            $('#idx_enterolert_bio_in').val(idEnterolertIn);
            $('#id_enterolert_bio_out').val(data.id_enterolert_bio_out);
            $('#enterolert_barcodex').val(data.enterolert_barcode);
            $('#enterolert_barcodex').attr('readonly', true);
            $('#date_sample').val(data.date_sample);
            $('#time_sample').val(data.time_sample);
            $('#enterococcus_largewells').val(data.enterococcus_largewells);
            $('#enterococcus_smallwells').val(data.enterococcus_smallwells);
            $('#enterococcus').val(data.enterococcus);
            $('#remarks').val(data.remarks);
            $('#compose-modal').modal('show');
        });

    });
</script>
