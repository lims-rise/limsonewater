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


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    let table;
    // let table1;
    let colilertBarcode = $('#colilert_barcode').val();
    let idColilertIn = $('#id_colilert_in').val();
    console.log(idColilertIn);
    let dilution = $('#dilution').val();
    const BASE_URL = '/limsonewater/index.php';
    let result;

    $(document).ready(function() {

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

        $('#ecoli_largewells').on('change keypress keyup keydown', function(event) {        
            let empn = datachart($('#ecoli_largewells').val(), $('#ecoli_smallwells').val());
            if (empn == 'Invalid'){
                $('#ecoli').css({'background-color' : '#FFE6E7'});
                $('#ecoli_largewells').val('0');
                $('#ecoli_smallwells').val('0');
            }
            else {
                $('#ecoli').css({'background-color' : '#EEEEEE'});
            }
            $("#ecoli").val(empn);
        });

        $('#ecoli_smallwells').on('change keypress keyup keydown', function(event) {        
            let empn = datachart($('#ecoli_largewells').val(), $('#ecoli_smallwells').val());
            if (empn == 'Invalid'){
                $('#ecoli').css({'background-color' : '#FFE6E7'});
                $('#ecoli_largewells').val('0');
                $('#ecoli_smallwells').val('0');
            }
            else {
                $('#ecoli').css({'background-color' : '#EEEEEE'});
            }
            $("#ecoli").val(empn);
        });



        $('#coliforms_largewells').on('change keypress keyup keydown', function(event) {        
            let empn = datachart($('#coliforms_largewells').val(), $('#coliforms_smallwells').val());
            if (empn == 'Invalid'){
                $('#total_coliforms').css({'background-color' : '#FFE6E7'});
                $('#coliforms_largewells').val('0');
                $('#coliforms_smallwells').val('0');
            }
            else {
                $('#total_coliforms').css({'background-color' : '#EEEEEE'});
            }
            $("#total_coliforms").val(empn);
        });

        $('#coliforms_smallwells').on('change keypress keyup keydown', function(event) {        
            let empn = datachart($('#coliforms_largewells').val(), $('#coliforms_smallwells').val());
            if (empn == 'Invalid'){
                $('#total_coliforms').css({'background-color' : '#FFE6E7'});
                $('#coliforms_largewells').val('0');
                $('#coliforms_smallwells').val('0');
            }
            else {
                $('#total_coliforms').css({'background-color' : '#EEEEEE'});
            }
            $("#total_coliforms").val(empn);
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
            $('#lowerdetection').val('');
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
            $('#ecoli').attr('readonly', true);
            $('#lowerdetection').val(data.lowerdetection);
            $('#coliforms_largewells').val(data.coliforms_largewells);
            $('#coliforms_smallwells').val(data.coliforms_smallwells);
            $('#total_coliforms').val(data.total_coliforms);
            $('#total_coliforms').attr('readonly', true);
            $('#remarks').val(data.remarks);
            $('#compose-modal').modal('show');
        });

    });
</script>
