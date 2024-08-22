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
									if ($lvl != 7){
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
                <!--</div> row -->    

				<div class="form-group">
					<div class="modal-footer clearfix">
						<button type="button" name="batal" value="batal" class="btn btn-warning" onclick="window.location.href='<?= site_url('Moisture_content'); ?>';">
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
                        <form id="formDetail24" action=<?php echo site_url('Mousture_content/savedetail24') ?> method="post" class="form-horizontal">
                            <div class="modal-body">
                                <div class="form-group">
                                        <div class="col-sm-9">
                                            <input id="mode_det24" name="mode_det24" type="hidden" class="form-control input-sm">
                                            <!-- <input id="id2_project" name="id2_project" type="hidden" class="form-control input-sm">
                                            <input id="idx_client_sample" name="idx_client_sample" type="hidden" class="form-control input-sm"> -->
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="date_moisture24" class="col-sm-4 control-label">Date Moisture</label>
                                        <div class="col-sm-8">
                                            <input id="date_moisture24" name="date_moisture24"type="date" class="form-control" placeholder="Date Moisture" value="<?php echo date("Y-m-d"); ?>">
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
                                        <label for="barcode_tray" class="col-sm-4 control-label">Barcode Tray</label>
                                        <div class="col-sm-8">
                                            <input id="barcode_tray" name="barcode_tray" type="text"  placeholder="Barcode Tray" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="dry_weight24" class="col-sm-4 control-label">Dry Weight 24h (g)</label>
                                        <div class="col-sm-8">
                                            <input id="dry_weight24" name="dry_weight24" type="text"  placeholder="Dry Weight 24h (g)" class="form-control">
                                        </div>
                                    </div>

                                <div class="form-group">
                                        <label for="comments" class="col-sm-4 control-label">Comments</label>
                                        <div class="col-sm-8">
                                            <textarea id="comments" name="comments" class="form-control" placeholder="Comments"></textarea>
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
					<button type="button" id="confirm-save" class="btn btn-primary"><i class="fa fa-save"></i> Ok</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    let table;
	let id_project = $('#id_project').val();
	let id_moisture = $('#id_moisture').val();
    // console.log(id_moisture);
	let base_url = location.hostname;

	$(document).ready(function() {

		// The function to show the congfirmation with testing type data 
		// function showConfirmation() {
		// 	let selectedTestingTypes = [];
		// 	$('.testing-type-checkbox:checked').each(function() {
		// 		let testingTypeId = $(this).val();
		// 		let testingTypeName = $(this).data('testing-type');
		// 		selectedTestingTypes.push(testingTypeId);
		// 	});

		// 	if (selectedTestingTypes.length === 0) {
		// 		alert('No Testing Types Checked');
		// 		return;
		// 	}

		// 	$.ajax({
		// 		url: '<?php echo site_url('Sample_reception/get_confirmation_data'); ?>',
		// 		type: 'POST',
		// 		data: { id_testing_type: selectedTestingTypes },
		// 		dataType: 'json',
		// 		success: function(response) {
		// 			let confirmationContent = '<ul style="list-style-type:none; font-size: 16px">';
		// 			$.each(response, function(index, item) {
		// 				let barcode = item.barcode || "No Generate";
		// 				confirmationContent += '<li style="font-weight: bold;">' + (index + 1) + '. ' + '<span style="font-weight: normal;">Testing Type: </span>' + item.testing_type_name + ' - ' + '<span style="font-weight: normal;">Barcode: </span>' + barcode + '</li>';
		// 			});
		// 			confirmationContent += '</ul>';

		// 			$('#confirmation-content').html(confirmationContent);
		// 			$('#confirm-modal').modal('show');
		// 		}
		// 	});
		// }

		//  When the save button is clicked in modal detail
		// $('#formDetail').on('submit', function(e) {
		// 	e.preventDefault(); // Hold on the automaticly submitted
		// 	showConfirmation();
		// });

		//  When the save button is clicked in modal confirmation
		// $('#confirm-save').click(function() {
		// 	// Sending the data to the controller to be saved
		// 	$('#formDetail').off('submit').submit(); // Deleting the previous submit handler and sending the form
		// });



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

        $('#barcode_tray').on("change", function() {
            data24 = $('#barcode_tray').val();
            $.ajax({
                type: "GET",
                url: "Moisture_content/validate24?id1="+data24,
                dataType: "json",
                success: function(data) {
                    if (data.length == 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data24 +'</strong> is not on moisture sequence or is already in the system !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#barcode_tray').focus();
                        $('#barcode_tray').val('');        
                        $('#barcode_tray').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_tray').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_tray').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_tray').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
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


		// function clearFormFields() {
        //     $('input[type=text], input[type=date], input[type=time]').val('');
        //     $('input[type=checkbox]').prop('checked', false);
        //     // Mengubah tampilan label
		// 	// updateCheckboxLabelStyling1();
		// }

		// Clear form fields when modal is hidden
		// $('#compose-modal').on('hidden.bs.modal', function () {
		// 	clearFormFields();
		// });

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
			ajax: {"url": "../../Moisture_content/subjson24?id="+id_moisture, "type": "POST"},
			columns: [
				{"data": "date_moisture24"},
                {"data": "time_moisture24"}, 
                {"data": "barcode_tray"}, 
                {"data": "dry_weight24"}, 
                {"data": "comments"},
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


		$('#addtombol_det24').click(function() {
			$('#mode_det24').val('insert');
			$('#modal-title-detail').html('<i class="fa fa-wpforms"></i> Moisture Content | 24 Hour <span id="my-another-cool-loader"></span>');
			// $('#id_moisture').val(id_moisture);
			$('#compose-modal').modal('show');
		});


		$('#example2').on('click', '.btn_edit_det', function() {
			let tr = $(this).closest('tr');
			let data = table.row(tr).data();
			console.log(data);

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

				$('#mode_det24').val('edit');
				$('#modal-title-detail').html('<i class="fa fa-pencil-square"></i> Update samples<span id="my-another-cool-loader"></span>');
				$('#idx_sample').hide();
				$('#id_sample').val(data.id_sample);
				$('#id2_project').val(data.id_project);
				$('#idx_client_sample').val(id_client_sample);
				$('.testing-type-checkbox').prop('checked', false); // Uncheck all checkboxes first
				testingTypeIds.forEach(function(id) {
					$(`input[value="${id}"]`).prop('checked', true); // Check the checkboxes based on testingTypeIds
				});

				$('#compose-modal').modal('show');
			} else {
				console.log('Error: id_testing_type is undefined or null');
			}
		});

	});
</script>