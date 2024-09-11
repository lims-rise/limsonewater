<div class="content-wrapper">
	<section class="content">
		<div class="box box-black box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Processing | Sample Biobank | Replicates</h3>
			</div>
				<form role="form"  id="formKeg" method="post" class="form-horizontal">
					<div class="box-body">
						<!-- <input type="hidden" class="form-control " id="id_req" name="id_req" value="<?php// echo $id_req ?>"> -->
						<!-- <input id="id_req" name="id_req" type="hidden" class="form-control input-sm"> -->
						<div class="form-group">
							<label for="id_one_water_sample1" class="col-sm-2 control-label">ID One water</label>
							<div class="col-sm-4">
								<input class="form-control " id="id_one_water_sample1" name="id_one_water_sample1" value="<?php echo $id_one_water_sample ?>"  disabled>
							</div>

							<label for="date_conduct" class="col-sm-2 control-label">Date conduct</label>
							<div class="col-sm-4">
								<input class="form-control " id="date_conduct" name="date_conduct" value="<?php echo $date_conduct ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="replicates" class="col-sm-2 control-label">Replicates</label>
							<div class="col-sm-4">
								<input class="form-control " id="replicates" name="replicates" value="<?php echo $replicates ?>"  disabled>
							</div>

							<label for="realname" class="col-sm-2 control-label">Lab tech</label>
							<div class="col-sm-4">
								<input class="form-control " id="realname" name="realname" value="<?php echo $realname ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="comments1" class="col-sm-2 control-label">Comments</label>
							<div class="col-sm-10">
								<!-- <input class="form-control " id="comments" name="comments" value="<?php echo $comments ?>"  disabled> -->
								<textarea id="comments1" name="comments1" class="form-control" disabled> <?php echo $comments ?> </textarea>
								</div>
						</div>

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
										$q = $this->db->query('
										SELECT a.replicates, COUNT(b.barcode_water) as cb_detail
										FROM sample_biobank a
										LEFT JOIN sample_biobank_detail b ON a.id_one_water_sample = b.id_one_water_sample
										WHERE a.id_one_water_sample = "' . $id_one_water_sample .'"');        
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
								<table id="example2" class="table display table-bordered table-striped" width="100%">
									<thead>
										<tr>
											<th>Barcode Water</th>
											<th>Weight (g)</th>
											<th>Concentration (ng/uL)</th>
											<th>Volume (mL)</th>
											<th>Culture method</th>
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
						<button type="button" name="batal" value="batal" class="btn btn-warning" onclick="window.location.href='<?= site_url('sample_biobankin'); ?>';">
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
			<div class="modal-header box">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="modal-title">Biobank-IN | Replicates 
				<!-- <input id="id_one_water_sample" name="id_one_water_sample" type="text" disabled>  -->
				</h4>
			</div>
			<form id="formSample"  action= <?php echo site_url('Sample_biobankin/savedetail') ?> method="post" class="form-horizontal">
				<div class="modal-body">
					<input id="mode_det" name="mode_det" type="hidden" class="form-control input-sm">
					<input id="id_one_water_sample" name="id_one_water_sample" type="hidden" class="form-control">
					<!-- <input id="id_req" name="id_req" type="hidden" class="form-control input-sm"> -->


					<div class="form-group">
						<label for="barcode_water" class="col-sm-4 control-label">Barcode Water</label>
						<div class="col-sm-8">
							<input id="barcode_water" name="barcode_water" placeholder="Barcode Water" type="text" class="form-control">
						</div>
					</div>
				
					<div class="form-group">
						<label for="weight" class="col-sm-4 control-label">Weight (g)</label>
						<div class="col-sm-8">
							<input id="weight" name="weight" placeholder="Weight" type="number" step="1" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label for="concentration_dna" class="col-sm-4 control-label">Concentration DNA (ng/uL)</label>
						<div class="col-sm-8">
							<input id="concentration_dna" name="concentration_dna" placeholder="Concentration DNA (ng/uL)" type="number" step="0.1" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label for="volume" class="col-sm-4 control-label">Volume (mL)</label>
						<div class="col-sm-8">
							<input id="volume" name="volume" placeholder="Volume (mL)" type="number" step="1" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label for="id_culture" class="col-sm-4 control-label">Culture storage method</label>
						<div class="col-sm-8">
							<select id="id_culture" name="id_culture" class="form-control">
								<option  >-- Select Culture storage --</option>
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


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    let table;
	let id_one_water_sample = $('#id_one_water_sample1').val();
	let barcode_water = $('#barcode_water').val();
	let base_url = location.hostname;

	$(document).ready(function() {

		function showConfirmationDelete(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal-delete').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('Sample_biobankin/delete_detail'); ?>/' + id;
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
				url: '<?php echo site_url('Sample_biobankin/get_confirmation_data'); ?>',
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
			ajax: {"url": "../../Sample_biobankin/subjson?id="+id_one_water_sample, "type": "POST"},
			columns: [
				{"data": "barcode_water"}, 
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
			$('#modal-title-detail').html('<i class="fa fa-wpforms"></i> New Replication<span id="my-another-cool-loader"></span>');
            $('#barcode_water').attr('readonly', false);
			$('#barcode_water').val('');
			$('#id_one_water_sample').val(id_one_water_sample);
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


		$('#example2').on('click', '.btn_edit_det', function() {
            // $('.val1tip').tooltipster('hide');   
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode_det').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Update Replication<span id="my-another-cool-loader"></span>');
            $('#barcode_water').attr('readonly', true);
			$('#barcode_water').val(data.barcode_water);
			$('#id_one_water_sample').val(id_one_water_sample);
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