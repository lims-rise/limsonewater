<div class="content-wrapper">
	<section class="content">
		<div class="box box-black box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Processing | Sample Reception | Sample Testing</h3>
			</div>
				<form role="form"  id="formKeg" method="post" class="form-horizontal">
					<div class="box-body">
						<!-- <input type="hidden" class="form-control " id="id_req" name="id_req" value="<?php// echo $id_req ?>"> -->
						
						<input class="form-control " id="id_sample" name="id_sample" value="<?php echo $id_sample ?>"  type="hidden" disabled>
						<div class="form-group">
							<label for="id_project" class="col-sm-2 control-label">COC</label>
							<div class="col-sm-4">
								<input class="form-control " id="id_project" name="id_project" value="<?php echo $id_project ? : '-' ?>"  disabled>
							</div>

							<label for="id_one_water_sample" class="col-sm-2 control-label">One Water Sample ID</label>
							<div class="col-sm-4">
								<input class="form-control " id="id_one_water_sample" name="id_one_water_sample" value="<?php echo $id_one_water_sample  ? : '-'  ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="initial" class="col-sm-2 control-label">Receiving Lab</label>
							<div class="col-sm-4">
								<input class="form-control " id="initial" name="initial" value="<?php echo $initial  ? : '-'  ?>"  disabled>
							</div>

							<label for="sampletype" class="col-sm-2 control-label">Sample Type</label>
							<div class="col-sm-4">
								<input class="form-control " id="sampletype" name="sampletype" value="<?php echo $sampletype ? : '-' ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="date_arrival" class="col-sm-2 control-label">Date arrive</label>
							<div class="col-sm-4">
								<input class="form-control " id="date_arrival" name="date_arrival" value="<?php echo $date_arrival ? : '-' ?>" disabled>
							</div>

							<label for="time_arrival" class="col-sm-2 control-label">Time arrive</label>
							<div class="col-sm-4">
								<input class="form-control " id="time_arrival" name="time_arrival" value="<?php echo $time_arrival ? : '-' ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="date_collected" class="col-sm-2 control-label">Date Collected</label>
							<div class="col-sm-4">
								<input class="form-control " id="date_collected" name="date_collected" value="<?php echo $date_collected ? : '-' ?>" disabled>
							</div>

							<label for="time_collected" class="col-sm-2 control-label">Time Collected</label>
							<div class="col-sm-4">
								<input class="form-control " id="time_collected" name="time_collected" value="<?php echo $time_collected ? : '-' ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="comments" class="col-sm-2 control-label">Comments</label>
							<div class="col-sm-4">
								<input class="form-control " id="comments" name="comments" value="<?php echo $comments ? : '-' ?>"  disabled>
							</div>
						</div>

					</div><!-- /.box-body -->
				</form>
			<div class="box-footer">
                <!-- <div class="row"> -->
                    <div class="col-xs-12"> 
                        <div class="box box-primary box-solid">
                            <div class="box-header">
                                <h3 class="box-title">Sample Testing</h3>
                            </div>
							<div class="box-body pad table-responsive">
								<?php
									// User Level Access Control untuk Add Test Button
									$user_level = (int)$this->session->userdata('id_user_level');
									$allowed_levels = [1, 2, 3]; // Super Admin, Admin, User
									
									if (in_array($user_level, $allowed_levels)): ?>
										<button class='btn btn-primary' id='addtombol_det'>
											<i class='fa fa-wpforms' aria-hidden='true'></i> Add Test
										</button>
								<?php endif; ?>
								
								<table id="example2" class="table display table-bordered table-striped" width="100%">
									<thead>
										<tr>
											<th>Testing Type</th>
											<th>Main module</th>
											<th>Detail module</th>
											<th>Status</th>
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
						<button type="button" name="batal" value="batal" class="btn btn-warning" onclick="window.location.href='<?= site_url('sample_reception'); ?>';">
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
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                        <h4 class="modal-title" id="modal-title-detail">
							<span id="my-another-cool-loader"></span></h4>
                    </div>
                    <form id="formDetail" action=<?php echo site_url('Sample_reception/savedetail') ?> method="post" class="form-horizontal">
                        <div class="modal-body">
						<div class="form-group">
                                <div class="col-sm-9">
                                    <input id="mode_det" name="mode_det" type="hidden" class="form-control input-sm">
									<input id="id2_project" name="id2_project" type="hidden" class="form-control input-sm">
									<input id="idx_one_water_sample" name="idx_one_water_sample" type="hidden" class="form-control input-sm">
                                </div>
                            </div>

							<div class="form-group" id="idx_sample">
                                <label for="id2_sample" class="col-sm-4 control-label">Sample ID</label>
                                <div class="col-sm-8">
                                    <input id="id2_sample" name="id2_sample" type="text"  placeholder="Sample ID" class="form-control">
                                </div>
                            </div>

							<div class="form-group">
								<label for="id_testing_type" class="col-sm-4 control-label">Testing Type</label>
								<div class="col-sm-4" id="conf">
									<!-- <?php foreach ($testing_type as $row): ?>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="id_testing_type[]" class="testing-type-checkbox" data-testing-type="<?php echo $row['testing_type']; ?>" value="<?php echo $row['id_testing_type']; ?>"> <?php echo $row['testing_type']; ?>
											</label>
										</div>
									<?php endforeach; ?> -->

									<?php foreach ($testing_type as $row): ?>
										<div class="checkbox">
											<label>
												<input type="checkbox" 
													id="testing_type_<?php echo $row['id_testing_type']; ?>"
													name="id_testing_type[]" 
													class="testing-type-checkbox" 
													data-testing-type="<?php echo $row['testing_type']; ?>" 
													value="<?php echo $row['id_testing_type']; ?>"> 
												<?php echo $row['testing_type']; ?>
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
            <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                <h4 class="modal-title">Confirm Your Selection</h4>
            </div>
			<div class="modal-body">
                <div id="confirmation-content" >
                    <!-- Content will be loaded here dynamically -->
                </div>
            </div>
            <div class="modal-footer clearfix">
                <!-- Wrap this container to align it properly -->
                <div class="modal-footer-content">
                    <h5 class="modal-title">You have selected the following assays - is this correct ?</h5>
                    <div class="modal-buttons">
                        <button type="button" id="confirm-save" class="btn btn-primary"><i class="fa fa-save"></i> Ok</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                    </div>
                </div>
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
                <h4 class="modal-title"><i class="fa fa-trash"></i> Testing Type | Delete <span id="my-another-cool-loader"></span></h4>
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

<!-- MODAL INFORMATION -->
<div class="modal fade" id="confirm-modal-information" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #3c8dbc; color: white;">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
					<h4 class="modal-title">Information Your Selection</h4>
				</div>
				<div class="modal-body">
					<div id="information-content">
						<!-- Content will be loaded here dynamically -->
					</div>
				</div>
				<div class="modal-footer clearfix">
					<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Ok</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

<style>
	/* Flexbox untuk memastikan elemen berada di dalam satu baris */
.modal-footer-content {
    display: flex;
    justify-content: space-between; /* Space between title and buttons */
    align-items: center; /* Vertically center */
    width: 100%;
}

/* Mengatur lebar tombol agar posisinya tetap ke kanan */
.modal-buttons {
    display: flex;
    gap: 10px; /* Memberikan jarak antar tombol */
}

/* Jika diperlukan, memberi margin atau padding khusus pada judul modal */
.modal-footer-content h5 {
    margin: 0; /* Menghapus margin default */
    font-weight: bold;
	margin-left: 40px;
	font-style: italic;
}

/* Menambahkan scroll pada modal-body */
.modal-body {
    max-height: 400px; /* Tentukan tinggi maksimum sesuai kebutuhan */
    overflow-y: auto;  /* Menambahkan scrollbar vertikal */

}

/* Optional: Menambahkan beberapa gaya agar tampilan lebih rapi */
.modal-footer {
    display: flex;
    justify-content: space-between;
}

#conf {
	width: 50%;
}

.url-link-detail {
	color: #FC8F54;
}

.url-link-status {
	color: #FC8F54;
}

.rounded-pill {
  border-radius: 9999px !important;
}


</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    let table;
	let id_sample = $('#id_sample').val();
	let id_one_water_sample = $('#id_one_water_sample').val();
	let base_url = location.hostname;

	// Add event listener for clicks on URL column
	// $(document).on('click', '.url-link', function() {
	// 	var barcode = $(this).data('barcode');
	// 	var url = 'http://localhost/limsonewater/index.php/moisture_content?barcode=' + barcode;
	// 	window.location.href = url;
	// });

	$(document).ready(function() {

		function showConfirmationDelete(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal-delete').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('Sample_reception/delete_detail'); ?>/' + id;
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
				let informationContent = '<ul style="list-style-type:none; font-size: 16px">';
						informationContent += '<li style="font-weight: bold;"> No testing type selected</li>';
					informationContent += '</ul>';

					$('#information-content').html(informationContent);
				$('#confirm-modal-information').modal('show');
				return;
			}

			$.ajax({
				url: '<?php echo site_url('Sample_reception/get_confirmation_data'); ?>',
				type: 'POST',
				data: { id_testing_type: selectedTestingTypes },
				dataType: 'json',
				success: function(response) {
					let confirmationContent = '<ul style="list-style-type:none; font-size: 16px;">';
					$.each(response, function(index, item) {
						let barcode = item.barcode || "No Generate";
						confirmationContent += '<li style="font-weight: bold;">' + (index + 1) + '. ' + '<span style="font-weight: normal;">Testing Type: </span>' + item.testing_type_name + ' - ' + '<span style="font-weight: normal;">"generate barcode : </span>' + barcode + '</li>';
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
			info: false,
			bFilter: false,
			ajax: {
				"url": "../../Sample_reception/subjson?id=" + encodeURIComponent(id_sample),
				"type": "POST"
			},
			columns: [
				{ "data": "testing_type" },
				{
					"data": "url",
					"render": function(data, type, row) {
						return `
							<a href="javascript:void(0);" class="url-link-detail"
								data-url="${data}"
								data-id_testing_type="${row.id_testing_type || '-'}"
								data-barcode="${row.barcode || '-'}"
								data-id_one_water_sample="${row.id_one_water_sample}">
								${row.testing_type || '-'} - ${row.id_one_water_sample || '-'}
							</a>
						`;
					}
				},
				{
					"data": "url",
					"render": function(data, type, row) {
						return `
							<a href="javascript:void(0);" class="url-link-status"
								data-url="${data}"
								data-id_testing_type="${row.id_testing_type || '-'}"
								data-barcode="${row.barcode || '-'}"
								data-id_one_water_sample="${row.id_one_water_sample}">
								${row.testing_type || '-'} - ${row.id_one_water_sample || '-'}
							</a>
						`;
					}
				},
				{
					"data": null, // <- karena kita render manual
					"render": function(data, type, row) {
						let statusBtn = '';
						if (row.review == "1") {
							statusBtn = '<span class="btn btn-xs btn-success rounded-pill">Reviewed</span>';
						} else if (row.review == "0") {
							statusBtn = '<span class="btn btn-xs btn-warning rounded-pill">Unreview</span>';
						} else {
							statusBtn = '<span class="btn btn-xs btn-dark rounded-pill">No data has been entered</span>';
						}

						let fullNameBtn = `<span class="btn btn-xs btn-primary rounded-pill">${row.full_name || 'No user'}</span>`;

						return `${statusBtn} - ${fullNameBtn}`;
					}
				},
				{
					"data": "action",
					"orderable": false,
					"className": "text-center"
				}
			],
			order: [[0, 'asc']],
			rowCallback: function(row, data, iDisplayIndex) {
				// Additional row callbacks if needed
			}
		});



		// Klik link untuk detail
		$('#example2 tbody').on('click', 'a.url-link-detail', function() {
			let barcode = $(this).data('barcode');
			let idOneWaterSample = $(this).data('id_one_water_sample');
			let idTestingType = $(this).data('id_testing_type');
			let url = $(this).data('url');

			if (url) {
				let fullUrl = `${window.location.origin}/limsonewater/index.php/${url}?barcode=${barcode}&idOneWaterSample=${idOneWaterSample}&idTestingType=${idTestingType}`;
				window.location.href = fullUrl;
			}
		});

		// Klik link untuk status
		// $('#example2 tbody').on('click', 'a.url-link-status', function() {
		// 	let idOneWaterSample = $(this).data('id_one_water_sample');
		// 	let url = $(this).data('url');

		// 	if (url) {
		// 		let fullUrlStatus = `${window.location.origin}/limsonewater/index.php/${url}/read/${idOneWaterSample}`;
		// 		window.location.href = fullUrlStatus;
		// 	}
		// });
		$('#example2 tbody').on('click', 'a.url-link-status', function() {
			let idOneWaterSample = $(this).data('id_one_water_sample');
			let url = $(this).data('url');

			if (url) {
				let fullUrlStatus = `${window.location.origin}/limsonewater/index.php/${url}/read/${idOneWaterSample}`;

				// Menambahkan indikator loading
				Swal.fire({
					title: 'Checking...',
					text: 'Please wait while we verify the page availability.',
					didOpen: () => {
						Swal.showLoading();
					}
				});

				// Memeriksa status halaman
				$.ajax({
					url: fullUrlStatus,
					type: 'HEAD',
					success: function() {
						// Jika status 200 OK, lakukan pengalihan
						window.location.href = fullUrlStatus;
					},
					error: function(xhr) {
						// Jika status bukan 200 OK, tampilkan pesan kesalahan
						Swal.fire({
							icon: 'error',
							title: 'Page Not Available',
							text: 'The page you are trying to access is not available.',
							confirmButtonText: 'OK'
						});
					}
				});
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


		// $('#addtombol_det').click(function() {
		// 	$('#mode_det').val('insert');
		// 	$('#modal-title-detail').html('<i class="fa fa-wpforms"></i> Detail Sample Reception | New Sample Testing<span id="my-another-cool-loader"></span>');
		// 	$('#idx_sample').hide();
		// 	$('#id2_sample').val(id_sample);
		// 	$('#idx_one_water_sample').val(id_one_water_sample);
		// 	$('#id_testing_type').val('');
		// 	$('#compose-modal').modal('show');
		// });
		$('#addtombol_det').click(function () {
			$('#mode_det').val('insert');
			$('#modal-title-detail').html('<i class="fa fa-wpforms"></i> Detail Sample Reception | New Sample Testing<span id="my-another-cool-loader"></span>');
			$('#idx_sample').hide();
			$('#id2_sample').val(id_sample);
			$('#idx_one_water_sample').val(id_one_water_sample);
			$('#id_testing_type').val('');
			$('#compose-modal').modal('show');

			// Ambil daftar ID testing yang sudah ada dari DataTable
			let selectedTestingTypes = [];
			let table = $('#example2').DataTable();
			table.rows().every(function () {
				let row = this.data();
				if (row.id_testing_type) {
					selectedTestingTypes.push(row.id_testing_type);
				}
			});

			// Disable checkbox jika id sudah ada
			selectedTestingTypes.forEach(function (id) {
				let checkbox = $('#testing_type_' + id);
				checkbox.prop('disabled', true);
				checkbox.closest('label').css('color', 'gray');
			});
		});

		$('#compose-modal').on('hidden.bs.modal', function () {
			// Aktifkan semua kembali dan reset warna label
			$('.testing-type-checkbox').prop('disabled', false).closest('label').css('color', '');
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

				$('#mode_det').val('edit');
				$('#modal-title-detail').html('<i class="fa fa-pencil-square"></i> Detail Sample Reception | Update Sample Testing<span id="my-another-cool-loader"></span>');
				$('#idx_sample').hide();
				$('#id2_sample').val(data.id_sample);
				$('#idx_one_water_sample').val(id_one_water_sample);
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