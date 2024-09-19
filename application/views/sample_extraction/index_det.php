<style>
    .disabled-label {
        /* text-decoration: line-through; */
		color: #999;
    }
	.normal-label {
        /* text-decoration: line-through; */
		color: #000;
    }
</style>


<div class="content-wrapper">
	<section class="content">
		<div class="box box-black box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Water sample reception | New samples</h3>
			</div>
			<form role="form"  id="formKeg" method="post" class="form-horizontal">
				<div class="box-body">
					<!-- <input type="hidden" class="form-control " id="id_req" name="id_req" value="<?php// echo $id_req ?>"> -->
					<!-- <input id="id_req" name="id_req" type="hidden" class="form-control input-sm"> -->

					<div class="form-group">
						<label for="project_id" class="col-sm-2 control-label">Client</label>
						<div class="col-sm-4">
							<input class="form-control " id="project_id" name="project_id" value="<?php echo $project_id ?>"  disabled>
						</div>

						<label for="initial" class="col-sm-2 control-label">Received Lab</label>
						<div class="col-sm-4">
							<input class="form-control " id="initial" name="initial" value="<?php echo $initial ?>"  disabled>
						</div>
					</div>

					<div class="form-group">
						<label for="date_arrival" class="col-sm-2 control-label">Date arrival</label>
						<div class="col-sm-4">
							<input class="form-control " id="date_arrival" name="date_arrival" value="<?php echo $date_arrival ?>" disabled>
						</div>

						<label for="time_arrival" class="col-sm-2 control-label">Time arrival</label>
						<div class="col-sm-4">
							<input class="form-control " id="time_arrival" name="time_arrival" value="<?php echo $time_arrival ?>"  disabled>
						</div>
					</div>

					<div class="form-group">
						<label for="comments" class="col-sm-2 control-label">Comments</label>
						<div class="col-sm-4">
							<input class="form-control " id="comments" name="comments" value="<?php echo $comments ?>"  disabled>
						</div>

						<label for="client_sample_id" class="col-sm-2 control-label">Client Sample ID</label>
						<div class="col-sm-4">
							<input class="form-control " id="client_sample_id" name="client_sample_id" value="<?php echo $client_sample_id ?>"  disabled>
						</div>
					</div>

					<div class="form-group">
						<label for="classification_name" class="col-sm-2 control-label">Type Of Classification</label>
						<div class="col-sm-4">
							<input class="form-control " id="classification_name" name="classification_name" value="<?php echo $classification_name ?>"  disabled>
						</div>
					</div>

					<!-- <div class="form-group">
						<label for="budget_rem" class="col-sm-2 control-label">Budget Remaining</label>
						<div class="col-sm-4">
							<input class="form-control " id="budget_rem" name="budget_rem" value="<?php// echo $budget_rem ?>" disabled>
						</div>
					</div> -->

				</div><!-- /.box-body -->
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
									echo "<button class='btn btn-primary' id='addtombol_det'><i class='fa fa-wpforms' aria-hidden='true'></i> New Data</button>";
								}
							?>
							
							<!-- <button class='btn btn-warning' id='addtombol'><i class="fa fa-wpforms" aria-hidden="true"></i> New Data</button> -->
							<table id="example2" class="table display table-bordered table-striped" width="100%">
								<thead>
									<tr>
										<!-- <th>PO Number</th> -->
										<!-- <th>Sample ID</th>
										<th>Sample Description</th> -->
										<th>Testing Type</th>
										<th>Date Collected</th>
										<th>Time Collected </th>
										<!-- <th>No Submitted</th> -->
										<th>Sample Barcode</th>
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
	<!--                    <button type="submit" name="Save" value="simpan" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button> -->
							<!-- <button type="button" name="excel" id="excel" class="btn btn-success" onclick="location.href='<?php //echo site_url('Water_sample_reception/excel_print'); ?>';"><i class="fa fa-file-excel-o"></i> Excel</button> -->
							<!-- <button type="button" name="excel" id="excel" class="btn btn-success" onclick="javascript:void(0);"><i class="fa fa-file-excel-o"></i> Excel</button>
							<button type="button" name="print" id="print" class="btn btn-primary" onclick="javascript:void(0);"><i class="fa fa-print"></i> Print</button> -->
						<button type="button" name="batal" value="batal" class="btn btn-warning" onclick="window.location.href='<?= site_url('Water_sample_reception'); ?>';">
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
                    <form id="formDetail" action=<?php echo site_url('Water_sample_reception/savedetail') ?> method="post" class="form-horizontal">
                        <div class="modal-body">
						<div class="form-group">
                                <div class="col-sm-9">
                                    <input id="mode_det" name="mode_det" type="hidden" class="form-control input-sm">
									<input id="project_id2" name="project_id2" type="hidden" class="form-control input-sm">
									<!-- <input id="sample_id" name="sample_id" type="hidden" class="form-control input-sm"> -->
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="id_reqdetail" class="col-sm-4 control-label">PO Number</label>
                                <div class="col-sm-8">
                                    <input id="id_reqdetail" name="id_reqdetail" type="text" class="form-control input-sm noEnterSubmit" placeholder="PO Number" required>
                                </div>
                            </div> -->

                            <!-- <div class="form-group">
                                <label for="sample_id" class="col-sm-4 control-label">Sample ID</label>
                                <div class="col-sm-8">
                                    <input id="sample_id" name="sample_id" type="text" placeholder="Sample ID" class="form-control" required>
                                </div>
                            </div>

							<div class="form-group">
                                <label for="sample_description" class="col-sm-4 control-label">Sample description</label>
                                <div class="col-sm-8">
                                    <textarea id="sample_description" name="sample_description" class="form-control" placeholder="Sample description"> </textarea>
                                </div>
	                        </div> -->

							<div class="form-group" id="sample_idx">
                                <label for="sample_id" class="col-sm-4 control-label">Sample ID</label>
                                <div class="col-sm-8">
                                    <input id="sample_id" name="sample_id" type="text"  placeholder="Sample ID" class="form-control">
                                </div>
                            </div>

							<!-- <div class="form-group">
								<label for="testing_type_id" class="col-sm-4 control-label">Testing type</label>
								<div class="col-sm-8">
									<div class="row">
										<div class="col-sm-6">
											<?php $half_count = ceil(count($testing_type) / 2); ?>
											<?php for ($i = 0; $i < $half_count; $i++) : ?>
												<div class="checkbox">
													<label>
														<input type="checkbox" id="testing_type_id" class="testing-type-checkbox" name="testing_type_id" value="<?php echo $testing_type[$i]['testing_type_id']; ?>"> <?php echo $testing_type[$i]['testing_type']; ?>
													</label>
												</div>
											<?php endfor; ?>
										</div>
										<div class="col-sm-6">
											<?php for ($i = $half_count; $i < count($testing_type); $i++) : ?>
												<div class="checkbox">
													<label>
														<input type="checkbox"  id="testing_type_id" class="testing-type-checkbox" name="testing_type_id" value="<?php echo $testing_type[$i]['testing_type_id']; ?>"> <?php echo $testing_type[$i]['testing_type']; ?>
													</label>
												</div>
											<?php endfor; ?>
										</div>
									</div>
								</div>
							</div> -->
							
							<div class="form-group">
								<label for="testing_type_id" class="col-sm-4 control-label">Testing Type</label>
								<div class="col-sm-4">
								<?php foreach ($testing_type as $row): ?>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="testing_type_id" class="testing-type-checkbox" value="<?php echo $row['testing_type_id']; ?>"> <?php echo $row['testing_type']; ?>
										</label>
									</div>
								<?php endforeach; ?>
								</div>
							</div>

							<div class="form-group">
								<label for="date_collected" class="col-sm-4 control-label">Date of sample collected</label>
								<div class="col-sm-8">
									<input id="date_collected" name="date_collected" type="date" class="form-control" placeholder="Date sample collected" value="<?php echo date("Y-m-d"); ?>">
								</div>
							</div>

							<div class="form-group">
								<label for="time_collected" class="col-sm-4 control-label">Time of sample collected</label>
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

							<!-- <div class="form-group">
                                <label for="no_submitted" class="col-sm-4 control-label">No submitted</label>
                                <div class="col-sm-8">
                                    <input id="no_submitted" name="no_submitted" type="number" step=1 min=1 placeholder="No submitted" class="form-control" required>
                                </div>
                            </div> -->

                            <div class="form-group">
                                <label for="sample_barcode" class="col-sm-4 control-label">Sample barcode</label>
                                <div class="col-sm-8">
                                    <input id="sample_barcode" name="sample_barcode" type="text" placeholder="Sample barcode" class="form-control" required>
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

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
	var table
	$(document).ready(function() {
		$('.noEnterSubmit').keypress(function (e) {
			if (e.which == 13) return false;
		});
						
        $('#compose-modal').on('shown.bs.modal', function () {
			$('#sample_id').focus();
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

		
		var project_id = $('#project_id').val();
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

        // $('.testing-type-checkbox').change(function() {
        //     // Uncheck all checkboxes first
        //     $('.testing-type-checkbox').not(this).prop('checked', false);
        // });

		function updateCheckboxLabelStyling() {
			$('.testing-type-checkbox').each(function() {
				var $currentCheckbox = $(this);
				var $label = $currentCheckbox.closest('label');
				
				if ($currentCheckbox.prop('checked')) {
					$label.removeClass('disabled-label');
				} else {
					$label.addClass('disabled-label');
				}
			});
		}


        $('.testing-type-checkbox').change(function() {
            var $checkbox = $(this);
            var isChecked = $checkbox.prop('checked');
			// var inputId = 'input_testing_type_' + $checkbox.val();
            
            // Menonaktifkan kotak centang lainnya
            if (isChecked) {
                $('.testing-type-checkbox').not($checkbox).prop('checked', false);
            }

			// Mengubah atribut required pada input terkait
			// $('#' + inputId).prop('required', isChecked);
            
            // Mengubah tampilan label
			updateCheckboxLabelStyling();

            // Menghapus gaya strikethrough dari label jika tidak ada yang tercentang
            if ($('.testing-type-checkbox:checked').length === 0) {
                $('.testing-type-checkbox').each(function() {
                    var $label = $(this).closest('label');
                    $label.removeClass('disabled-label');
                });
            }			
        });

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


		table = $("#example2").DataTable({
			oLanguage: {
				sProcessing: "Loading data, please wait..."
			},
			processing: true,
			serverSide: true,
			paging: false,
			// ordering: false,
			info: false,
			bFilter: false,
			ajax: {"url": "../../Water_sample_reception/subjson?id="+project_id, "type": "POST"},
			columns: [
				// {"data": "id_reqdetail"},
				// {"data": "sample_id"}, 
				// {"data": "project_id"},
				// {"data": "sample_description"},
				{"data": "testing_type"}, 
				{"data": "date_collected"},
				{"data": "time_collected"},
				// {"data": "no_submitted"},
				{"data": "sample_barcode"},
				{
					"data" : "action",
					"orderable": false,
					"className" : "text-center"
				}
			],
			// columnDefs: [
			// 	{
			// 		targets: [0], // Index of the 'estimate_price' column
			// 		className: 'text-right' // Apply right alignment to this column
			// 	}
			// ],
			order: [[0, 'asc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				// var index = page * length + (iDisplayIndex + 1);
				// $('td:eq(0)', row).html(index);
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
				
		// $('#compose-modal').on('shown.bs.modal', function () {
		// 	if ($('#mode_det').val() == 'insert') {
		// 		let table = $('#example2').DataTable(); 
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
			clearFormFields();
			// $('#mode_det').val('insert');
            // $('#modal-title-detail').html('<i class="fa fa-wpforms"></i> New samples<span id="my-another-cool-loader"></span>');
			// $('#sample_id').attr('readonly', false);
		    // $('#sample_id').val('');
		    // $('#project_id2').val('');
		    // $('#project_id2').val(project_id);
		    // $('#sample_description').val('');
			// $('#compose-modal').modal('show');
			$('#mode_det').val('insert');
			$('#modal-title-detail').html('<i class="fa fa-wpforms"></i> New samples<span id="my-another-cool-loader"></span>');
			$('#sample_idx').hide();
			$('#project_id2').val(project_id);
			// $('#sample_description').val('');
			$('#testing_type_id').val('');
			$('#date_collected').val('<?php echo date("Y-m-d"); ?>');
			$('#time_collected').val('<?php $datetime = new DateTime(); echo $datetime->format('H:i'); ?>');
			// $('#no_submitted').val('');
			$('#sample_barcode').val('');
			// Uncheck all checkboxes
			$('#compose-modal').modal('show');
		});


		$('#example2').on('click', '.btn_edit_det', function(){
			// let tr = $(this).parent().parent();
			// let data = table.row(tr).data();
			// console.log(data);
			// $('#mode_det').val('edit');
			// $('#modal-title-detail').html('<i class="fa fa-pencil-square"></i> Update samples<span id="my-another-cool-loader"></span>');
			// $('#sample_id').attr('readonly', true);
		    // $('#sample_id').val(data.sample_id);
		    // $('#project_id2').val(data.project_id);
		    // $('#sample_description').val(data.sample_description);
			// $('#compose-modal').modal('show');
			let tr = $(this).closest('tr');
			let data = table.row(tr).data();
			let testingTypeIds = data.testing_type_id.split(',');
			console.log(data);
			$('#mode_det').val('edit');
			$('#modal-title-detail').html('<i class="fa fa-pencil-square"></i> Update samples<span id="my-another-cool-loader"></span>');
			$('#sample_idx').hide();
			$('#sample_id').val(data.sample_id);
			$('#project_id2').val(data.project_id);
			// $('#sample_description').val(data.sample_description);
			$('#date_collected').val(data.date_collected);
			$('#time_collected').val(data.time_collected);
			// $('#no_submitted').val(data.no_submitted);
			$('#sample_barcode').val(data.sample_barcode);
			$('.testing-type-checkbox').each(function() {
				var checkboxValue = $(this).val();

				// Periksa apakah checkboxValue ada dalam array testingTypeIds
				if (testingTypeIds.indexOf(checkboxValue) !== -1) {
					$(this).prop('checked', true);
				} else {
					$(this).prop('checked', false);
				}
			});

			$('#compose-modal').modal('show');
		});  

	});
</script>