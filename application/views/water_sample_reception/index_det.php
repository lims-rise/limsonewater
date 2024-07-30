
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
						<label for="project_id" class="col-sm-2 control-label">COC</label>
						<div class="col-sm-4">
							<input class="form-control " id="project_id" name="project_id" value="<?php echo $project_id ?>"  disabled>
						</div>

						<label for="client_sample_id" class="col-sm-2 control-label">Client Sample ID</label>
						<div class="col-sm-4">
							<input class="form-control " id="client_sample_id" name="client_sample_id" value="<?php echo $client_sample_id ?>"  disabled>
						</div>
					</div>

					<div class="form-group">
						<label for="client" class="col-sm-2 control-label">Client</label>
						<div class="col-sm-4">
							<input class="form-control " id="client" name="client" value="<?php echo $client ?>"  disabled>
						</div>

						<label for="one_water_sample_id" class="col-sm-2 control-label">One Water Sample ID</label>
						<div class="col-sm-4">
							<input class="form-control " id="one_water_sample_id" name="one_water_sample_id" value="<?php echo $one_water_sample_id ?>"  disabled>
						</div>
					</div>

					<div class="form-group">
						<label for="initial" class="col-sm-2 control-label">Received Lab</label>
						<div class="col-sm-4">
							<input class="form-control " id="initial" name="initial" value="<?php echo $initial ?>"  disabled>
						</div>

						<label for="classification_name" class="col-sm-2 control-label">Type Of Sample</label>
						<div class="col-sm-4">
							<input class="form-control " id="classification_name" name="classification_name" value="<?php echo $classification_name ?>"  disabled>
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
						<label for="date_collected" class="col-sm-2 control-label">Date Collected</label>
						<div class="col-sm-4">
							<input class="form-control " id="date_collected" name="date_collected" value="<?php echo $date_collected ?>" disabled>
						</div>

						<label for="time_collected" class="col-sm-2 control-label">Time Collected</label>
						<div class="col-sm-4">
							<input class="form-control " id="time_collected" name="time_collected" value="<?php echo $time_collected ?>"  disabled>
						</div>
					</div>

					<div class="form-group">
						<label for="comments" class="col-sm-2 control-label">Comments</label>
						<div class="col-sm-4">
							<input class="form-control " id="comments" name="comments" value="<?php echo $comments ?>"  disabled>
						</div>


					</div>

					<!-- <div class="form-group">
						<label for="classification_name" class="col-sm-2 control-label">Type Of Classification</label>
						<div class="col-sm-4">
							<input class="form-control " id="classification_name" name="classification_name" value="<?php echo $classification_name ?>"  disabled>
						</div>

						<div class="col-sm-4">
							<input class="form-control " id="simple_barcode" type="hidden"  value="<?php echo $simple_barcode ?>"  disabled>
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
								if ($lvl != 7){
									echo "<button class='btn btn-primary' id='addtombol_det'><i class='fa fa-wpforms' aria-hidden='true'></i> New Data</button>";
								}
							?>
							
							<!-- <button class='btn btn-warning' id='addtombol'><i class="fa fa-wpforms" aria-hidden="true"></i> New Data</button> -->
							<table id="example2" class="table display table-bordered table-striped" width="100%">
								<thead>
									<tr>
										<th>Testing Type</th>
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
                    </div>
                    <form id="formDetail" action=<?php echo site_url('Water_sample_reception/savedetail') ?> method="post" class="form-horizontal">
                        <div class="modal-body">
						<div class="form-group">
                                <div class="col-sm-9">
                                    <input id="mode_det" name="mode_det" type="hidden" class="form-control input-sm">
									<input id="project_id2" name="project_id2" type="hidden" class="form-control input-sm">
									<input id="client_sample_idx" name="client_sample_idx" type="hidden" class="form-control input-sm">
                                </div>
                            </div>

							<div class="form-group" id="sample_idx">
                                <label for="sample_id" class="col-sm-4 control-label">Sample ID</label>
                                <div class="col-sm-8">
                                    <input id="sample_id" name="sample_id" type="text"  placeholder="Sample ID" class="form-control">
                                </div>
                            </div>

							<div class="form-group">
								<label for="testing_type_id" class="col-sm-4 control-label">Testing Type</label>
								<div class="col-sm-4">
									<?php foreach ($testing_type as $row): ?>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="testing_type_id[]" class="testing-type-checkbox" data-testing-type="<?php echo $row['testing_type']; ?>" value="<?php echo $row['testing_type_id']; ?>"> <?php echo $row['testing_type']; ?>
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
					<button type="button" id="confirm-save" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    let table;
	let project_id = $('#project_id').val();
	let client_sample_id = $('#client_sample_id').val();
	let base_url = location.hostname;

	$(document).ready(function() {

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
				url: '<?php echo site_url('Water_sample_reception/get_confirmation_data'); ?>',
				type: 'POST',
				data: { testing_type_id: selectedTestingTypes },
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
			// ordering: false,
			info: false,
			bFilter: false,
			ajax: {"url": "../../Water_sample_reception/subjson?id="+client_sample_id, "type": "POST"},
			columns: [
				{"data": "testing_type"}, 
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
				let info = this.fnPagingInfo();
				let page = info.iPage;
				let length = info.iLength;
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


		$('#addtombol_det').click(function() {
			$('#mode_det').val('insert');
			$('#modal-title-detail').html('<i class="fa fa-wpforms"></i> New samples<span id="my-another-cool-loader"></span>');
			$('#sample_idx').hide();
			$('#project_id2').val(project_id);
			$('#client_sample_idx').val(client_sample_id);
			$('#testing_type_id').val('');
			$('#compose-modal').modal('show');
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

			if (data.testing_type_id !== undefined && data.testing_type_id !== null) {
				let testingTypeIds = data.testing_type_id.split(',');

				$('#mode_det').val('edit');
				$('#modal-title-detail').html('<i class="fa fa-pencil-square"></i> Update samples<span id="my-another-cool-loader"></span>');
				$('#sample_idx').hide();
				$('#sample_id').val(data.sample_id);
				$('#project_id2').val(data.project_id);
				$('#client_sample_idx').val(client_sample_id);
				$('.testing-type-checkbox').prop('checked', false); // Uncheck all checkboxes first
				testingTypeIds.forEach(function(id) {
					$(`input[value="${id}"]`).prop('checked', true); // Check the checkboxes based on testingTypeIds
				});

				$('#compose-modal').modal('show');
			} else {
				console.log('Error: testing_type_id is undefined or null');
			}
		});

	});
</script>