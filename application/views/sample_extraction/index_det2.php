<div class="content-wrapper">
	<section class="content">
		<div class="box box-black box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Water sample reception | New testing</h3>
			</div>
			<form role="form"  id="formKeg" method="post" class="form-horizontal">
				<div class="box-body">
					<!-- <input type="hidden" class="form-control " id="id_req" name="id_req" value="<?php// echo $id_req ?>"> -->
					<!-- <input id="id_req" name="id_req" type="hidden" class="form-control input-sm"> -->

					<div class="form-group">
						<label for="sample_id" class="col-sm-2 control-label">Sample ID</label>
						<div class="col-sm-4">
							<input class="form-control " id="sample_id" name="sample_id" value="<?php echo $sample_id ?>"  disabled>
						</div>

						<label for="sample_description" class="col-sm-2 control-label">Sample Description</label>
						<div class="col-sm-4">
							<input class="form-control " id="sample_description" name="sample_description" value="<?php echo $sample_description ?>"  disabled>
						</div>
					</div>

					

				</div><!-- /.box-body -->
			</form>

				<div class="box-footer">

                <!-- <div class="row"> -->
                    <div class="col-xs-12"> 
                        <div class="box box-primary box-solid">
            
                            <div class="box-header">
                                <h3 class="box-title">Detail Testing</h3>
                            </div>
							<div class="box-body pad table-responsive">
							<?php
								$lvl = $this->session->userdata('id_user_level');
								if ($lvl != 4){
									echo "<button class='btn btn-primary' id='addtombol_det'><i class='fa fa-wpforms' aria-hidden='true'></i> New Data</button>";
								}
							?>
							
							<!-- <button class='btn btn-warning' id='addtombol'><i class="fa fa-wpforms" aria-hidden="true"></i> New Data</button> -->
							<table id="example3" class="table display table-bordered table-striped" width="100%">
								<thead>
									<tr>
										<th>Testing ID</th>
										<th>Test type</th>
										<th>Date collected</th>
										<th>Time collected</th>
										<th>#Submitted</th>
										<th>Sample barcode</th>
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
	<!--                     <button type="submit" name="Save" value="simpan" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button> -->
							<!-- <button type="button" name="excel" id="excel" class="btn btn-success" onclick="location.href='<?php //echo site_url('Water_sample_reception/excel_print'); ?>';"><i class="fa fa-file-excel-o"></i> Excel</button> -->
							<!-- <button type="button" name="excel" id="excel" class="btn btn-success" onclick="javascript:void(0);"><i class="fa fa-file-excel-o"></i> Excel</button>
							<button type="button" name="print" id="print" class="btn btn-primary" onclick="javascript:void(0);"><i class="fa fa-print"></i> Print</button> -->
							<button type="button" name="batal" value="batal" class="btn btn-warning" onclick="window.location.href='<?= site_url('Water_sample_reception/read/'. $project_id); ?>';">
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
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="modal-title-detail">
							<span id="my-another-cool-loader"></span></h4>
                        <!-- <h4 class="modal-title" id="modal-title-detail">Add budget Items<span id="my-another-cool-loader"></span></h4> -->
                    </div>
                    <form id="formDetail" action=<?php echo site_url('Water_sample_reception/savedetail2') ?> method="post" class="form-horizontal">
                        <div class="modal-body">
						<div class="form-group">
                                <div class="col-sm-9">
                                    <input id="mode_det2" name="mode_det2" type="hidden" class="form-control input-sm">
									<input id="sample_id2" name="sample_id2" type="hidden" class="form-control input-sm">
									<input id="testing_id" name="testing_id" type="hidden" class="form-control input-sm">
                                </div>
                            </div>

							<div class="form-group">
								<label for="testing_type_id" class="col-sm-4 control-label">Testing type</label>
								<div class="col-sm-8" >
								<select id='testing_type_id' name="testing_type_id" class="form-control">
									<option>-- Select testing type --</option>
									<?php
									foreach($test as $row){
										if ($testing_type_id == $row['testing_type_id']) {
											echo "<option value='".$row['testing_type_id']."' selected='selected'>".$row['testing_type']."</option>";
										}
										else {
											echo "<option value='".$row['testing_type_id']."'>".$row['testing_type']."</option>";
										}
									}
										?>
								</select>
								</div>
							</div>

							<div class="form-group">
								<label for="date_collected" class="col-sm-4 control-label">Date sample collected</label>
								<div class="col-sm-8">
									<input id="date_collected" name="date_collected" type="date" class="form-control" placeholder="Date sample collected" value="<?php echo date("Y-m-d"); ?>">
								</div>
							</div>

							<div class="form-group">
								<label for="time_collected" class="col-sm-4 control-label">Time sample collected</label>
								<div class="col-sm-8">
									<div class="input-group clockpicker">
									<input id="time_collected" name="time_collected" class="form-control" placeholder="Time sample collected" value="<?php 
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
                                <label for="no_submitted" class="col-sm-4 control-label">No submitted</label>
                                <div class="col-sm-8">
                                    <input id="no_submitted" name="no_submitted" type="number" step=1 min=1 placeholder="No submitted" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sample_barcode" class="col-sm-4 control-label">Sample barcode</label>
                                <div class="col-sm-8">
                                    <input id="sample_barcode" name="sample_barcode" type="text" placeholder="Sample barcode" class="form-control" required>
                                </div>
                            </div>

							<!-- <div class="form-group">
                                <label for="sample_description" class="col-sm-4 control-label">Sample description</label>
                                <div class="col-sm-8">
                                    <textarea id="sample_description" name="sample_description" class="form-control" placeholder="Sample description"> </textarea>
                                </div>
	                        </div> -->
						</div>
                        <div class="modal-footer clearfix">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>

<script type="text/javascript">
	var table
	$(document).ready(function() {
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
		
						
        $('#compose-modal').on('shown.bs.modal', function () {
			$('#testing_id').focus();
			// $('#estimate_price').on('input', function() {
            //     formatNumber(this);
            //     });
            });

        // function formatNumber(input) {
        //     input.value = input.value.replace(/[^\d.]/g, '').replace(/\.(?=.*\.)/g, '');
        //     if (input.value !== '') {
        //         var numericValue = parseFloat(input.value.replace(/\./g, '').replace(',', '.'));
        //         input.value = numericValue.toLocaleString('en-US', { maximumFractionDigits: 2 });
        //         input.value = input.value.replace(/,/g, '.');
        //     }
        // }

		var sample_id = $('#sample_id').val();
		var base_url = location.hostname;
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

		table = $("#example3").DataTable({
			oLanguage: {
				sProcessing: "Loading data, please wait..."
			},
			processing: true,
			serverSide: true,
			paging: false,
			// ordering: false,
			info: false,
			bFilter: false,
			ajax: {"url": "../../Water_sample_reception/subjson2?id2="+sample_id, "type": "POST"},
			columns: [
				// {"data": "sample_id"}, 
				// {"data": "sample_description"},
				{"data": "testing_id"},
				{"data": "testing_type"}, 
				{"data": "date_collected"},
				{"data": "time_collected"},
				{"data": "no_submitted"},
				{"data": "sample_barcode"},
				{
					"data" : "action",
					"orderable": false,
					"className" : "text-center"
				}
			],
			order: [[0, 'asc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
			}
		});

        $('#example3 tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }
        })   		
				
		// $('#compose-modal').on('shown.bs.modal', function () {
		// 	if ($('#mode_det').val() == 'insert') {
		// 		let table = $('#example3').DataTable(); 
		// 		let rowCount = table.rows().count();
		// 		$('#id_reqdetail').val(rowCount+1);
		// 	}
        //     $('#result').focus();
		// });        

		// $('#print').click(function() {
		// 	location.href = '../../Water_sample_reception/budreq_print/'+id_req;
		// });

		// $('#excel').click(function() {
		// 	location.href = '../../Water_sample_reception/excel_print/'+id_req;
		// });


		$('#addtombol_det').click(function() {
			$('#mode_det2').val('insert');
            $('#modal-title-detail').html('<i class="fa fa-wpforms"></i> New samples<span id="my-another-cool-loader"></span>');
			$('#testing_type_id').val('');
			$('#no_submitted').val('');
			$('#sample_barcode').val('');
			$('#sample_id2').val(sample_id); // Assuming sample_id is defined somewhere
			$('#compose-modal').modal('show');
		});


		$('#example3').on('click', '.btn_edit_det', function(){
			let tr = $(this).parent().parent();
			let data = table.row(tr).data();
			console.log(data);
			$('#mode_det2').val('edit');
			$('#modal-title-detail').html('<i class="fa fa-pencil-square"></i> Update samples<span id="my-another-cool-loader"></span>');
			$('#testing_id').attr('readonly', true);
		    $('#testing_id').val(data.testing_id);
			$('#sample_id2').val(sample_id);

			    // Set the value of the dropdown based on the testing_type
				$('#testing_type_id option').each(function() {
					if ($(this).text() === data.testing_type) {
						$(this).prop('selected', true);
					}
				});

            $('#date_collected').val(data.date_collected).trigger('change');
            $('#time_collected').val(data.time_collected).trigger('change');
		    $('#no_submitted').val(data.no_submitted);
		    $('#sample_barcode').val(data.sample_barcode);
			$('#compose-modal').modal('show');
		});  

	});
</script>--