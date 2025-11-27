<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Processing | Sequencing </h3>
                    </div>
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">

                            <?php echo anchor(site_url('Sequencing/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to XLS', 'class="btn btn-success"'); ?>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th></th> <!-- Toggle column -->
                                        <th>ID One Water Sample</th>
                                        <th>Sequencing Barcode</th>
                                        <th>Number of Tubes</th>
                                        <th>Sequence Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<style>
    .table tbody tr.selected {
        color: white !important;
        background-color: #9CDCFE !important;
    }
</style>

    <!-- MODAL SEQUENCE DATA - Opened from Sample Reception -->
    <div class="modal fade" id="sequence-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #9c27b0; color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-dna"></i> Sequencing Module | Sequence Data Entry</h4>
                </div>
                <form id="sequenceForm" method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input type="hidden" id="seq_id_one_water_sample" name="id_one_water_sample">
                        <input type="hidden" id="sequencing_barcode" name="sequencing_barcode">
                        
                        <div class="form-group">
                            <label for="sample_info" class="col-sm-4 control-label">Sample ID</label>
                            <div class="col-sm-8">
                                <input id="sample_info" name="sample_info" type="text" class="form-control" readonly>
                                <small class="help-block">Sample from Sample Reception</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_tube" class="col-sm-4 control-label">Barcode Tube <span style="color: red;">*</span></label>
                            <div class="col-sm-8">
                                <select id="barcode_tube" name="barcode_tube" class="form-control" required>
                                    <option value="" disabled selected>-- Loading Barcode Tubes --</option>
                                </select>
                                <small class="help-block">Select which barcode tube to add sequence data to</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sequenceCheckbox" class="col-sm-4 control-label">Sequence</label>
                            <div class="col-sm-8" style="padding-top: 7px;">
                                <input type="hidden" id="sequenceHidden" name="sequence" value="0">
                                <input type="checkbox" id="sequenceCheckbox" name="sequence" value="1" disabled>
                                <span id="sequenceHelpText" style="margin-left: 10px; font-size: 12px; color: #999;">Please select a barcode tube first</span>
                            </div>
                        </div>

                        <div id="sequenceFields" style="display: none;">
                            <div class="form-group">
                                <label for="sequence_id" class="col-sm-4 control-label">Sequence Type</label>
                                <div class="col-sm-8">
                                    <select id="sequence_id" name="sequence_id" class="form-control">
                                        <option value="" disabled selected>-- Select Sequence Type --</option>
                                        <!-- Sequence types will be loaded via AJAX -->
                                    </select>
                                    <input type="text" id="other_sequence_name" name="other_sequence_name" class="form-control" placeholder="Enter new sequence type" style="display:none; margin-top:5px;">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="species_id" class="col-sm-4 control-label">Species ID</label>
                                <div class="col-sm-8">
                                    <input id="species_id" name="species_id" placeholder="Enter Species ID" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer clearfix">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Sequence</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->        
</div>

<!-- MODAL CONFIRMATION DELETE -->
        <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Sequencing | Delete <span id="my-another-cool-loader"></span></h4>
            </div>
            <div class="modal-body">
                <div id="confirmation-content">
                    <div class="modal-body">
                        <p class="text-center" style="font-size: 15px;">Are you sure you want to delete ID <span id="id" style="font-volume_filter: bold;"></span> ?</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer clearfix">
                <button type="button" id="confirm-save" class="btn btn-danger"><i class="fa fa-trash"></i> Yes</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<style>
    .highlight {
        background-color: rgba(0, 255, 0, 0.1) !important;
        font-volume_filter: bold !important;
    }


</style>
<!-- SweetAlert2 CSS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">



    let table;
    // Fungsi untuk mendapatkan parameter dari URL
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        console.log('Current URL:', window.location.search);  // Cek URL yang sedang diakses
        return urlParams.get(param);
    }
    $(document).ready(function() {
        const params = new URLSearchParams(window.location.search);
        const barcodeFromUrl = params.get('barcode');
        const idOneWaterSampleFromUrl = params.get('idOneWaterSample');
        const idTestingTypeFromUrl = params.get('idTestingType');

        // If parameters exist, open sequence modal automatically (from Sample Reception)
        if (barcodeFromUrl && idOneWaterSampleFromUrl && idTestingTypeFromUrl) {
            // Debug log untuk memastikan parameter terambil
            console.log('URL Parameters:', {
                barcode: barcodeFromUrl,
                idOneWaterSample: idOneWaterSampleFromUrl,
                idTestingType: idTestingTypeFromUrl
            });
            
            // Set sample information
            $('#seq_id_one_water_sample').val(idOneWaterSampleFromUrl);
            $('#sample_info').val(idOneWaterSampleFromUrl);
            $('#sequencing_barcode').val(barcodeFromUrl);
            
            // Verify values set
            console.log('Form values set:', {
                seq_id: $('#seq_id_one_water_sample').val(),
                sequencing_barcode: $('#sequencing_barcode').val()
            });
            
            // Load sequence types
            loadSequenceTypes();
            
            // Load barcode tubes for this sample
            loadBarcodeTubesFromSampleReception(idOneWaterSampleFromUrl);
            
            // Open the sequence modal
            $('#sequence-modal').modal('show');
        }

        // Pembatalan dan kembali ke halaman sebelumnya
        $(document).on('click', '#cancelButton', function() {
            // Get URL parameters
            const params = new URLSearchParams(window.location.search);
            const barcodeFromUrl = params.get('barcode');
            const idOneWaterSampleFromUrl = params.get('idOneWaterSample');
            const idTestingTypeFromUrl = params.get('idTestingType');
            
            // Check if the necessary query parameters exist
            if (barcodeFromUrl && idOneWaterSampleFromUrl && idTestingTypeFromUrl) {
                // If the parameters exist, redirect to the previous page
                var previousUrl = document.referrer;
                
                if (previousUrl) {
                    window.location.href = previousUrl;  // Redirect to the previous page
                }
            } else {
                // If the parameters are not found, simply close the modal
                $('#sequence-modal').modal('hide');  // Close the modal
            }
        });

        function showConfirmation(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('Sequencing/delete'); ?>/' + id;
            $('#confirm-modal #id').text(id);
            console.log(id);
            showConfirmation(url);
        });

        // When the confirm-save button is clicked
        $('#confirm-save').click(function() {
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
                    $('#confirm-modal').modal('hide');
                    location.reload();
                }
            });
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





        $("input").keypress(function(){
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
        });

        $("input").click(function(){
            setTimeout(function(){
                $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
            }, 3000);                            
        });













        












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

        table = $("#mytable").DataTable({
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {
                "url": "Sequencing/json", 
                "type": "POST",
                "data": function(d) {
                    // Add search parameters if provided from Sample Reception redirect
                    const urlParams = new URLSearchParams(window.location.search);
                    const searchSampleId = urlParams.get('idOneWaterSample');
                    if (searchSampleId) {
                        d.search_sample_id = searchSampleId;
                    }
                }
            },
            columns: [
                {
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": '<button type="button" class="btn btn-sm btn-primary toggle-child"><i class="fa fa-plus-square"></i></button>'
                },
                {"data": "id_one_water_sample"},
                {"data": "sequencing_barcode"},
                {
                    "data": "tube_count",
                    "render": function(data, type, row) {
                        return data + ' tubes';
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        let sequenced = parseInt(row.sequence_count) || 0;
                        let total = parseInt(row.tube_count) || 0;
                        let status = sequenced > 0 ? 'Has Sequence' : 'No Sequence';
                        let color = sequenced > 0 ? 'green' : 'red';
                        
                        return `<span style="color: ${color};">${status} (${sequenced}/${total})</span>`;
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return `<button type="button" class="btn btn-info btn-sm btn_edit_sequence" 
                                        data-id-sample="${row.id_one_water_sample}" 
                                        data-barcode="${row.sequencing_barcode}">
                                    <i class="fa fa-pencil-square-o"></i> Edit
                                </button>`;
                    },
                    "orderable": false,
                    "searchable": false
                }
            ],
			columnDefs: [
				{
					targets: [-1], // Index of the 'estimate_price' column
					className: 'text-right' // Apply right alignment to this column
				}
			],
            order: [[1, 'desc']],
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                let info = this.fnPagingInfo();
                let page = info.iPage;
                let length = info.iLength;
            },
            drawCallback: function(settings) {
                let api = this.api();
                let pageInfo = api.page.info();
                if (pageInfo.page === 0) {
                    let firstRow = api.row(0).node();
                    $(firstRow).addClass('highlight');
                }
            }
        });

        // Parent-Child row functionality
        $('#mytable tbody').on('click', '.toggle-child', function () {
            let tr = $(this).closest('tr');
            let row = table.row( tr );
            let id = row.data().id_one_water_sample;
            let icon = $(this).find('i');
     
            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
                icon.removeClass('fa-minus-square').addClass('fa-plus-square');
            }
            else {
                // Show loading first
                row.child('<div class="text-center py-2">Loading...</div>').show();
                tr.addClass('shown');
                icon.removeClass('fa-plus-square').addClass('fa-spinner fa-spin');
                
                // Create child table
                let childTable = $('<table class="table table-bordered table-striped" style="margin-left: 50px; width: 95%;">' +
                    '<thead>' +
                        '<tr>' +
                            '<th>Barcode Sample</th>' +
                            '<th>Barcode Tube</th>' +
                            '<th>Sequence</th>' +
                            '<th>Sequence Type</th>' +
                            '<th>Species ID</th>' +
                            '<th>Comments</th>' +
                        '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                        '<tr><td colspan="6" class="text-center">Loading...</td></tr>' +
                    '</tbody>' +
                '</table>');
                
                row.child(childTable).show();
                
                // Load child data via DataTables
                let childDataTable = childTable.DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "Sequencing/subjson",
                        type: "GET",
                        data: {id: id}
                    },
                    columns: [
                        {"data": "barcode_sample"},
                        {"data": "barcode_tube"},
                        {
                            "data": "sequence",
                            "render": function(data, type, row) {
                                let hasSequence = (data == '1' || data == 1 || data === true);
                                return hasSequence ? '<i class="fa fa-check" style="color: green; font-size: 16px;"></i>' : '<i class="fa fa-times" style="color: red; font-size: 16px;"></i>';
                            },
                            "className": "text-center"
                        },
                        {
                            "data": null,
                            "render": function(data, type, row) {
                                if (row.sequence_type) {
                                    return row.sequence_type;
                                } else if (row.custom_sequence_type) {
                                    return row.custom_sequence_type + ' (Custom)';
                                } else {
                                    return '-';
                                }
                            }
                        },
                        {"data": "species_id", "defaultContent": "-"},
                        {"data": "comments", "defaultContent": "-"}
                    ],
                    paging: false,
                    searching: false,
                    info: false,
                    ordering: false,
                    drawCallback: function() {
                        // Change spinner to minus icon after data is loaded
                        icon.removeClass('fa-spinner fa-spin').addClass('fa-minus-square');
                    }
                });
            }
        });

        // Check if filtered by Sample ID from Sample Reception redirect
        const urlParams = new URLSearchParams(window.location.search);
        const searchSampleId = urlParams.get('idOneWaterSample');
        if (searchSampleId) {
            // Show notification that filter is active
            $('<div class="alert alert-info alert-dismissible" style="margin-top: 10px;">' +
              '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
              '<h4><i class="icon fa fa-info-circle"></i> Filter Active!</h4>' +
              'Showing results filtered by Sample ID: <strong>' + searchSampleId + '</strong>' +
              '<br><small>This filter was applied when redirected from Sample Reception. ' +
              '<a href="' + window.location.pathname + '" style="color: #337ab7;">Click here to clear filter</a></small>' +
              '</div>').insertAfter('.box-header');
        }















  

        $('#mytable tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }
        });

        // ============ SEQUENCE MODAL FUNCTIONS ============
        
        // Function to load sequence types
        function loadSequenceTypes() {
            $.ajax({
                url: '<?php echo site_url('Sequencing/get_sequence_types'); ?>',
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    $('#sequence_id').html('<option value="" disabled selected>-- Select Sequence Type --</option>');
                    
                    if (response.status === 'success' && response.data && response.data.length > 0) {
                        $.each(response.data, function(index, item) {
                            $('#sequence_id').append(`<option value="${item.sequence_id}">${item.sequence_type}</option>`);
                        });
                        $('#sequence_id').append('<option value="other">Other</option>');
                    }
                },
                error: function() {
                    $('#sequence_id').html('<option value="" disabled>Error loading sequence types</option>');
                }
            });
        }
        
        // Function to load barcode tubes from Sample Reception
        function loadBarcodeTubesFromSampleReception(idOneWaterSample) {
            $.ajax({
                url: '<?php echo site_url('Sequencing/get_barcode_tubes_for_sequence'); ?>',
                type: 'POST',
                data: { id_one_water_sample: idOneWaterSample },
                dataType: 'json',
                success: function(response) {
                    $('#barcode_tube').html('<option value="" disabled selected>-- Select Barcode Tube --</option>');
                    
                    if (response.status === 'success' && response.data && response.data.length > 0) {
                        // Store tube-to-sample mapping
                        window.barcodeTubeMapping = {};
                        
                        $.each(response.data, function(index, item) {
                            window.barcodeTubeMapping[item.barcode_tube] = {
                                barcode_sample: item.barcode_sample,
                                sequence: item.sequence,
                                sequence_id: item.sequence_id,
                                sequence_type: item.sequence_type,
                                custom_sequence_type: item.custom_sequence_type,
                                species_id: item.species_id
                            };
                            
                            let optionText = item.barcode_tube + ' (' + item.sequence_status + ')';
                            $('#barcode_tube').append(`<option value="${item.barcode_tube}">${optionText}</option>`);
                        });
                    } else {
                        $('#barcode_tube').append('<option value="" disabled>No barcode tubes found for this sample</option>');
                    }
                },
                error: function() {
                    $('#barcode_tube').html('<option value="" disabled>Error loading barcode tubes</option>');
                }
            });
        }
        
        // Handle barcode tube selection - enable sequence checkbox and load existing data
        $('#barcode_tube').change(function() {
            let selectedBarcodeTube = $(this).val();
            
            if (selectedBarcodeTube) {
                // Enable sequence checkbox
                $('#sequenceCheckbox').prop('disabled', false);
                $('#sequenceHelpText').text('Check to show sequence fields').css('color', '#666');
                
                // Load existing data from mapping
                if (window.barcodeTubeMapping && window.barcodeTubeMapping[selectedBarcodeTube]) {
                    let data = window.barcodeTubeMapping[selectedBarcodeTube];
                    
                    // Pre-populate form with existing data
                    let isSequenceEnabled = (data.sequence == '1');
                    $('#sequenceCheckbox').prop('checked', isSequenceEnabled);
                    
                    // Set hidden field state
                    if (isSequenceEnabled) {
                        $('#sequenceHidden').prop('disabled', true);
                        $('#sequenceFields').show();
                    } else {
                        $('#sequenceHidden').prop('disabled', false);
                        $('#sequenceFields').hide();
                    }
                    
                    // Populate fields if sequence is enabled
                    if (data.sequence_id) {
                        $('#sequence_id').val(data.sequence_id);
                    }
                    if (data.species_id) {
                        $('#species_id').val(data.species_id);
                    }
                    if (data.custom_sequence_type) {
                        $('#sequence_id').val('other').trigger('change');
                        $('#other_sequence_name').val(data.custom_sequence_type);
                    }
                } else {
                    // Reset form
                    $('#sequenceCheckbox').prop('checked', false).trigger('change');
                }
            } else {
                // Disable sequence checkbox
                $('#sequenceCheckbox').prop('disabled', true).prop('checked', false);
                $('#sequenceFields').hide();
                $('#sequenceHidden').prop('disabled', false);
                $('#sequenceHelpText').text('Please select a barcode tube first').css('color', '#999');
            }
        });

        // Handle sequence checkbox toggle
        $('#sequenceCheckbox').change(function() {
            if ($(this).is(':checked')) {
                $('#sequenceFields').show();
                $('#sequenceHidden').prop('disabled', true);
                $('#sequenceHidden').val('1');
            } else {
                $('#sequenceFields').hide();
                $('#sequenceHidden').prop('disabled', false);
                $('#sequenceHidden').val('0');
                // Clear fields when unchecked
                $('#species_id').val('');
                $('#sequence_id').val('').trigger('change');
                $('#other_sequence_name').hide().val('');
            }
        });

        // Handle sequence type dropdown change
        $('#sequence_id').change(function() {
            if ($(this).val() === 'other') {
                $('#other_sequence_name').show().prop('required', true);
            } else {
                $('#other_sequence_name').hide().prop('required', false).val('');
            }
        });

        // Handle sequence form submission
        $('#sequenceForm').on('submit', function(e) {
            e.preventDefault();
            
            // Validate required fields
            let selectedBarcodeTube = $('#barcode_tube').val();
            let sampleId = $('#seq_id_one_water_sample').val();
            
            if (!sampleId) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Validation Error',
                    text: 'Sample ID is missing.',
                    confirmButtonColor: '#f39c12'
                });
                return false;
            }
            
            if (!selectedBarcodeTube) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Validation Error',
                    text: 'Please select a barcode tube.',
                    confirmButtonColor: '#f39c12'
                });
                return false;
            }

            // Get corresponding barcode_sample from mapping
            let correspondingBarcodeSample = '';
            if (window.barcodeTubeMapping && window.barcodeTubeMapping[selectedBarcodeTube]) {
                correspondingBarcodeSample = window.barcodeTubeMapping[selectedBarcodeTube].barcode_sample;
            }
            
            let formData = {
                id_one_water_sample: sampleId,
                sequencing_barcode: $('#sequencing_barcode').val(),
                barcode_tube: selectedBarcodeTube,
                barcode_sample: correspondingBarcodeSample,
                sequence_id: $('#sequence_id').val(),
                other_sequence_name: $('#other_sequence_name').val(),
                species_id: $('#species_id').val()
            };

            // Get sequence value from form
            let formElement = document.getElementById('sequenceForm');
            let formDataObj = new FormData(formElement);
            formData.sequence = formDataObj.get('sequence');

            // Debug log untuk memastikan sequencing_barcode terkirim
            console.log('Data yang akan dikirim ke server:', {
                id_one_water_sample: formData.id_one_water_sample,
                sequencing_barcode: formData.sequencing_barcode,
                barcode_tube: formData.barcode_tube,
                barcode_sample: formData.barcode_sample
            });

            // Show loading
            Swal.fire({
                title: 'Saving Sequence Data...',
                html: 'Please wait while we save the sequence information.',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: '<?php echo site_url('Sequencing/save_sequence_data'); ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    Swal.close();
                    
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            confirmButtonColor: '#27ae60'
                        }).then(() => {
                            // Close modal
                            $('#sequence-modal').modal('hide');
                            
                            // Check if we came from Sample Reception (has URL parameters)
                            const params = new URLSearchParams(window.location.search);
                            const barcodeFromUrl = params.get('barcode');
                            const idOneWaterSampleFromUrl = params.get('idOneWaterSample');
                            const idTestingTypeFromUrl = params.get('idTestingType');
                            
                            if (barcodeFromUrl && idOneWaterSampleFromUrl && idTestingTypeFromUrl) {
                                // Redirect back to Sample Reception if came from there
                                if (document.referrer) {
                                    window.location.href = document.referrer;
                                } else {
                                    // Fallback: redirect to sample reception
                                    window.location.href = '<?php echo site_url("Sample_reception"); ?>';
                                }
                            } else {
                                // If editing from sequencing table, just reload to show updated data
                                table.ajax.reload(null, false);
                            }
                        });
                        
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Save Failed',
                            text: response.message || 'Could not save sequence data',
                            confirmButtonColor: '#e74c3c'
                        });
                    }
                },
                error: function() {
                    Swal.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'Connection Error',
                        text: 'Could not connect to server. Please try again.',
                        confirmButtonColor: '#e74c3c'
                    });
                }
            });
        });

        // Handle Edit Sequence button click
        $(document).on('click', '.btn_edit_sequence', function() {
            const idSample = $(this).data('id-sample');
            const sequencingBarcode = $(this).data('barcode');
            
            console.log('Edit sequence clicked:', {
                idSample: idSample,
                sequencingBarcode: sequencingBarcode
            });
            
            // Set form values for edit mode
            $('#seq_id_one_water_sample').val(idSample);
            $('#sample_info').val(idSample);
            $('#sequencing_barcode').val(sequencingBarcode);
            
            // Change modal title to indicate edit mode
            $('.modal-title').html('<i class="fa fa-dna"></i> Sequencing Module | Edit Sequence Data');
            
            // Load sequence types
            loadSequenceTypes();
            
            // Load barcode tubes for this sample
            loadBarcodeTubesFromSampleReception(idSample);
            
            // Open the sequence modal in edit mode
            $('#sequence-modal').modal('show');
        });

        // Reset sequence modal when closed
        $('#sequence-modal').on('hidden.bs.modal', function () {
            // Check if we came from Sample Reception (has URL parameters)
            const params = new URLSearchParams(window.location.search);
            const barcodeFromUrl = params.get('barcode');
            const idOneWaterSampleFromUrl = params.get('idOneWaterSample');
            const idTestingTypeFromUrl = params.get('idTestingType');
            
            if (barcodeFromUrl && idOneWaterSampleFromUrl && idTestingTypeFromUrl) {
                // Redirect back to Sample Reception
                if (document.referrer) {
                    window.location.href = document.referrer;
                } else {
                    // Fallback: redirect to sample reception
                    window.location.href = '<?php echo site_url("Sample_reception"); ?>';
                }
            } else {
                // Reset form for normal usage
                $('#sequenceForm')[0].reset();
                $('#sequenceCheckbox').prop('checked', false).prop('disabled', true).trigger('change');
                $('#barcode_tube').html('<option value="" disabled selected>-- Select Barcode Tube --</option>');
                $('#sequenceHelpText').text('Please select a barcode tube first').css('color', '#999');
                $('#seq_id_one_water_sample').val('');
                $('#sample_info').val('');
                window.barcodeTubeMapping = {};
                
                // Reset modal title to default
                $('.modal-title').html('<i class="fa fa-dna"></i> Sequencing Module | Sequence Data Entry');
            }
        });


                            
    });
</script>