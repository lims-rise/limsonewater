<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Processing | Microbial </h3>
                    </div>
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                            <!-- <?php
                                $lvl = $this->session->userdata('id_user_level');
                                    if ($lvl != 4){
                                         echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Extraction Biosolid</button>";
                                    }
                            ?>         -->
                            <?php echo anchor(site_url('Microbial/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to XLS', 'class="btn btn-success"'); ?>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>One Water Sample ID</th>
                                        <th>Microbial Barcode</th>
                                        <th>Description</th>
                                        <th>Created By</th>
                                        <th>Date Created</th>
                                        <th width="120px">Action</th>
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

    <!-- MODAL FORM -->
    <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                    <h4 class="modal-title" id="modal-title">Microbial | New</h4>
                </div>
                <form id="formSample" action="<?php echo site_url('Microbial/save') ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <input id="id_microbial" name="id_microbial" type="hidden" class="form-control input-sm">

                        <div class="form-group">
                            <label for="id_one_water_sample" class="col-sm-4 control-label">One Water Sample ID</label>
                            <div class="col-sm-8">
                                <input id="id_one_water_sample" name="id_one_water_sample" placeholder="One Water Sample ID" type="text" class="form-control idOneWaterSampleSelect" required>
                                <input id="idx_one_water_sample" name="idx_one_water_sample" placeholder="One Water Sample ID" type="text" class="form-control">
                                <div class="val2tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="microbial_barcode" class="col-sm-4 control-label">Microbial Barcode</label>
                            <div class="col-sm-8">
                                <input id="microbial_barcode" name="microbial_barcode" type="text" class="form-control" placeholder="Microbial Barcode" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="document_file" class="col-sm-4 control-label">Upload Document (PDF)</label>
                            <div class="col-sm-8">
                                <input id="document_file" name="document_file" placeholder="Document Filename" type="text" class="form-control" readonly>
                                <div class="val4tip"></div>
                                <small class="text-muted" id="document-file-status-text" style="display: none;">
                                    <i class="fa fa-info-circle"></i>You can delete the document if needed.
                                </small>
                                <div class="file-buttons-container" style="margin-top: 5px;">
                                    <button type="button" id="btn-open-document-scanner" class="btn btn-success" onclick="openDocumentScanner()">
                                        <i class="fa fa-file-pdf-o"></i> Upload PDF
                                    </button>
                                    <button type="button" id="btn-delete-document-file" class="btn btn-danger" onclick="deleteDocumentFile()" style="margin-left: 10px; display: none;">
                                        <i class="fa fa-trash"></i> Delete PDF
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-sm-4 control-label">Description</label>
                            <div class="col-sm-8">
                                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter description of the microbial testing document..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer clearfix">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        <button type="button" class="btn btn-warning" id="cancelButton" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
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
                <h4 class="modal-title"><i class="fa fa-trash"></i> Microbial | Delete <span id="my-another-cool-loader"></span></h4>
            </div>
            <div class="modal-body">
                <div id="confirmation-content">
                    <div class="modal-body">
                        <p class="text-center" style="font-size: 15px;">Are you sure you want to delete ID <span id="id" style="font-weight: bold;"></span> ?</p>
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
        font-weight: bold !important;
    }



    .d-flex {
        display: flex;
        align-items: center;
    }

    .ms-2 {
        margin-left: 0.5rem;
    }

    .ms-3 {
        margin-left: 1rem;
    }

    .badge {
        font-size: 13px;
        padding: 6px 14px;
        border-radius: 20px;
        margin-top: 0px;
        font-weight: 500;
        min-width: 80px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .badge-success {
        background-color: #28a745;
        color: white;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
    }

    .bg-warning {
        background-color: #ffc107 !important;
        color: #212529 !important;
        border: 1px solid #f0ad4e;
    }

    .bg-success {
        background-color: #28a745 !important;
        color: white !important;
        border: 1px solid #1e7e34;
    }



    .badge1 {
        font-size: 12px;
        padding: 6px 12px;
        border-radius: 20px;
        margin-top: 0px;
        width: 80px;
        text-align: center;
        display: inline-block;
        min-width: 80px;
    }

    .badge1-success {
        background-color: #c3e6c3;
        color: #2d5a2d;
    }

    .badge1-danger {
        background-color: rgba(248, 113, 113, 0.3);
        color: #b91c1c;
    }

    /* File upload styling */
    #dropArea {
        transition: all 0.3s ease;
        border: 2px dashed #ccc !important;
        background-color: #f8f9fa;
        cursor: pointer;
        text-align: center;
        min-height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #dropArea:hover {
        background-color: #e9ecef;
        border-color: #17a2b8 !important;
        box-shadow: 0 2px 8px rgba(23, 162, 184, 0.2);
    }

    #dropArea.drag-over {
        background-color: #d1ecf1;
        border-color: #17a2b8 !important;
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
    }

    #filePreview .alert {
        margin-bottom: 0;
        border-radius: 4px;
    }

    #filePreview .alert .btn {
        margin-left: 10px;
    }
</style>
<!-- SweetAlert2 CSS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    let table;
    
    // Global functions that are called from HTML onclick attributes
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        console.log('Current URL:', window.location.search);
        return urlParams.get(param);
    }

    // Document file management functions - following Sample Reception approach
    function openDocumentScanner() {
        const microbialBarcode = $('#microbial_barcode').val();
        if (!microbialBarcode) {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Information',
                text: 'Please enter Microbial Barcode first.'
            });
            return;
        }
        
        const w = 800;
        const h = 600;
        const y = window.top.outerHeight / 2 + window.top.screenY - (h / 2);
        const x = window.top.outerWidth / 2 + window.top.screenX - (w / 2);

        const url = "<?= site_url('scan_page/microbial') ?>?project_id=" + encodeURIComponent(microbialBarcode);

        window.open(url, "Upload Microbial Document",
            `width=${w},height=${h},top=${y},left=${x}`);
    }

    function updateDocumentButtonsState() {
        const fileInput = document.getElementById("document_file");
        const btnOpenScanner = document.getElementById("btn-open-document-scanner");
        const btnDeleteFile = document.getElementById("btn-delete-document-file");
        const fileStatusText = document.getElementById("document-file-status-text");
        const valTip = document.querySelector(".val4tip");

        const hasFile = fileInput && fileInput.value && fileInput.value.trim() !== '';

        if (hasFile) {
            btnOpenScanner.style.display = 'none';
            btnDeleteFile.style.display = 'inline-block';
            fileStatusText.style.display = 'block';
            
            btnDeleteFile.innerHTML = '<i class="fa fa-trash"></i> Delete PDF';
            btnDeleteFile.disabled = false;
            
            if (valTip) {
                valTip.innerHTML = `<span class="text-success"><i class="fa fa-check-circle"></i> PDF <strong>${fileInput.value}</strong> is ready!</span>`;
            }
        } else {
            btnOpenScanner.style.display = 'inline-block';
            btnDeleteFile.style.display = 'none';
            fileStatusText.style.display = 'none';
            
            btnDeleteFile.innerHTML = '<i class="fa fa-trash"></i> Delete PDF';
            btnDeleteFile.disabled = false;
            
            if (valTip) {
                valTip.innerHTML = '';
            }
        }
    }

    function deleteDocumentFile() {
        const fileInput = document.getElementById("document_file");
        const filename = fileInput ? fileInput.value : '';
        
        if (!filename) {
            Swal.fire({
                icon: 'warning',
                title: 'No File Selected',
                text: 'There is no document to delete.',
                confirmButtonText: 'OK'
            });
            return;
        }
        
        Swal.fire({
            icon: 'warning',
            title: 'Delete Document?',
            text: 'Are you sure you want to delete this PDF document? This action cannot be undone.',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                const btnDeleteFile = document.getElementById("btn-delete-document-file");
                const originalText = btnDeleteFile.innerHTML;
                btnDeleteFile.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Deleting...';
                btnDeleteFile.disabled = true;
                
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '<?= site_url("Microbial/delete_document") ?>', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                
                xhr.onload = function() {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        
                        if (response.success) {
                            fileInput.value = '';
                            updateDocumentButtonsState();
                            
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Delete Failed',
                                text: response.message,
                                confirmButtonText: 'OK'
                            });
                            
                            btnDeleteFile.innerHTML = originalText;
                            btnDeleteFile.disabled = false;
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to delete document due to server error.',
                            confirmButtonText: 'OK'
                        });
                        
                        btnDeleteFile.innerHTML = originalText;
                        btnDeleteFile.disabled = false;
                    }
                };
                
                xhr.onerror = function() {
                    console.error('Network error while deleting document');
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Network Error',
                        text: 'Unable to connect to server. Please check your connection.',
                        confirmButtonText: 'OK'
                    });
                    
                    btnDeleteFile.innerHTML = originalText;
                    btnDeleteFile.disabled = false;
                };
                
                xhr.send('filename=' + encodeURIComponent(filename));
            }
        });
    }

    // Listen for document upload completion from scanner popup
    window.addEventListener("message", function(event) {
        if (event.data && event.data.type === 'scan-upload-complete') {
            const filename = event.data.filename;
            console.log("Received document filename from scanner:", filename);

            const fileInput = document.getElementById("document_file");
            if (fileInput) {
                fileInput.value = filename;
            }

            updateDocumentButtonsState();
        }
    });

    // Function to download document
    function downloadDocument(filename) {
        if (!filename) {
            Swal.fire('Error', 'No document file found', 'error');
            return;
        }
        
        // Create download link - this should point to a controller method that handles file download
        window.open('<?php echo site_url('Microbial/download_document'); ?>/' + encodeURIComponent(filename), '_blank');
    }

$(document).ready(function() {
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
                $('#compose-modal').modal('hide');  // Close the modal
            }
        });

        function showConfirmation(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('Microbial/delete'); ?>/' + id;
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

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
        });        

        $('#compose-modal').on('shown.bs.modal', function () {
			$('#id_one_water_sample').focus();
            // $('#budget_req').on('input', function() {
            //     formatNumber(this);
            //     });
            });

        // function formatNumber(input) {
        //     input.value = input.value.replace(/[^\d.]/g, '').replace(/\.(?=.*\.)/g, '');
        //     if (input.value !== '') {
        //         var numericValue = parseFloat(input.value.replace(/\./g, '').replace(',', '.'));
        //         input.value = numericValue.toLocaleString('en-US', { maximumFractionDigits: 2 });
        //         // Replace commas with dots for the display
        //         input.value = input.value.replace(/,/g, '.');
        //     }
        // }

        $("input").keypress(function(){
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
        });

        $("input").click(function(){
            setTimeout(function(){
                $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
            }, 3000);                            
        });

        // Handle target checkbox changes with data safety warning
        $('input[name="target[]"]').change(function() {
            const $checkbox = $(this);
            const targetValue = $checkbox.val();
            const isChecked = $checkbox.is(':checked');
            const isEditMode = $('#id_microbial').val() && $('#id_microbial').val() !== '';
            
            // If checkbox is being unchecked in edit mode, check if related fields have data
            if (!isChecked && isEditMode && hasTargetRelatedData(targetValue)) {
                // Show warning dialog
                const targetDisplayName = targetValue === 'Giardia' ? 'Giardia' : 'Cryptosporidium';
                
                Swal.fire({
                    title: 'Data will be deleted!',
                    html: `Removing target <strong>${targetDisplayName}</strong> will delete the following data:<br/>
                           • Quality Control ${targetDisplayName}<br/>
                           • Concentration (copies/L) (${targetDisplayName})<br/>
                           • Concentration (copies/g DW) (${targetDisplayName})<br/><br/>
                           Data will be deleted after <strong>Save</strong>.<br/>
                           Do you want to proceed?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes!',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed, clear the data and proceed with normal flow
                        clearTargetRelatedData(targetValue);
                        
                        // Continue with normal target change logic
                        proceedWithTargetChange(isEditMode);
                        
                        // Show success message
                        Swal.fire({
                            title: 'Success!',
                            text: `${targetDisplayName} data has been cleared.`,
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } else {
                        // User cancelled, restore checkbox to checked state
                        $checkbox.prop('checked', true);
                        
                        // Show cancellation message
                        Swal.fire({
                            title: 'Cancelled',
                            text: `${targetDisplayName} data has been preserved.`,
                            icon: 'info',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                });
            } else {
                // No data to worry about, proceed normally
                proceedWithTargetChange(isEditMode);
            }
        });

        // Function to handle normal target change logic
        function proceedWithTargetChange(isEditMode) {
            updateTargetCombined();
            
            // Update quality control fields visibility when target selection changes
            handleQualityControlVisibility(null, isEditMode);
            
            // Update concentration fields visibility when target selection changes
            const currentSampletype = $('#sampletype').val();
            if (currentSampletype) {
                handleConcentrationFieldsVisibility(currentSampletype, null, isEditMode);
            }
        }

        // Simplified form submission handler
        $('#formSample').on('submit', function(e) {
            console.log('Form submitted');
            
            // If idx_one_water_sample is visible and has value, copy it to id_one_water_sample
            if ($('#idx_one_water_sample').is(':visible') && $('#idx_one_water_sample').val()) {
                $('#id_one_water_sample').val($('#idx_one_water_sample').val());
            }
            
            // Continue with form submission
            return true;
        });


        // Function to handle concentration fields visibility based on sampletype and target selection
        function handleConcentrationFieldsVisibility(sampletype, targetSelection = null, preserveValues = false) {
            // Get current target selection if not provided
            if (!targetSelection) {
                const selectedTargets = [];
                $('input[name="target[]"]:checked').each(function() {
                    selectedTargets.push($(this).val());
                });
                targetSelection = selectedTargets;
            }
            
            // Ensure targetSelection is an array
            if (typeof targetSelection === 'string') {
                targetSelection = targetSelection.split(',').map(t => t.trim());
            }
            
            if (!sampletype) {
                // If no sampletype, show all concentration fields by default
                $('#conc_copies_per_L_giardia').closest('.form-group').show();
                $('#conc_copies_per_L_crypto').closest('.form-group').show();
                $('#conc_copies_per_g_dw_giardia').closest('.form-group').show();
                $('#conc_copies_per_g_dw_crypto').closest('.form-group').show();
                return;
            }

            // Convert to lowercase for case-insensitive comparison
            const sampletypeLower = sampletype.toLowerCase();
            const hasGiardia = targetSelection.includes('Giardia') || targetSelection.includes('giardia');
            const hasCrypto = targetSelection.includes('Cryptosporidium') || targetSelection.includes('cryptosporidium');

            // Hide all fields first
            $('#conc_copies_per_L_giardia').closest('.form-group').hide();
            if (!preserveValues) {
                $('#conc_copies_per_L_giardia').val('');
            }
            $('#conc_copies_per_L_crypto').closest('.form-group').hide();
            if (!preserveValues) {
                $('#conc_copies_per_L_crypto').val('');
            }
            $('#conc_copies_per_g_dw_giardia').closest('.form-group').hide();
            if (!preserveValues) {
                $('#conc_copies_per_g_dw_giardia').val('');
            }
            $('#conc_copies_per_g_dw_crypto').closest('.form-group').hide();
            if (!preserveValues) {
                $('#conc_copies_per_g_dw_crypto').val('');
            }

            if (sampletypeLower === 'biosolids' || sampletypeLower === 'biosolid') {
                // For biosolids: show conc_copies_per_g_dw fields based on target selection
                if (hasGiardia && hasCrypto) {
                    // Both targets selected: show both g/dw fields
                    $('#conc_copies_per_g_dw_giardia').closest('.form-group').show();
                    $('#conc_copies_per_g_dw_crypto').closest('.form-group').show();
                } else if (hasGiardia) {
                    // Only giardia selected: show only giardia g/dw field
                    $('#conc_copies_per_g_dw_giardia').closest('.form-group').show();
                } else if (hasCrypto) {
                    // Only crypto selected: show only crypto g/dw field
                    $('#conc_copies_per_g_dw_crypto').closest('.form-group').show();
                } else {
                    // No target selected: show both g/dw fields by default
                    // $('#conc_copies_per_L_giardia').closest('.form-group').show();
                    // $('#conc_copies_per_L_crypto').closest('.form-group').show();
                    // $('#conc_copies_per_g_dw_giardia').closest('.form-group').show();
                    // $('#conc_copies_per_g_dw_crypto').closest('.form-group').show();
                }
            } else if (sampletypeLower === 'liquids' || sampletypeLower === 'liquid') {
                // For liquids: show conc_copies_per_L fields based on target selection
                if (hasGiardia && hasCrypto) {
                    // Both targets selected: show both L fields
                    $('#conc_copies_per_L_giardia').closest('.form-group').show();
                    $('#conc_copies_per_L_crypto').closest('.form-group').show();
                } else if (hasGiardia) {
                    // Only giardia selected: show only giardia L field
                    $('#conc_copies_per_L_giardia').closest('.form-group').show();
                } else if (hasCrypto) {
                    // Only crypto selected: show only crypto L field
                    $('#conc_copies_per_L_crypto').closest('.form-group').show();
                } else {
                    // No target selected: show both L fields by default
                    // $('#conc_copies_per_L_giardia').closest('.form-group').show();
                    // $('#conc_copies_per_L_crypto').closest('.form-group').show();
                    // $('#conc_copies_per_g_dw_giardia').closest('.form-group').show();
                    // $('#conc_copies_per_g_dw_crypto').closest('.form-group').show();
                }
            } else {
                // For other sample types: show all fields based on target selection
                if (hasGiardia && hasCrypto) {
                    // Both targets selected: show all fields
                    $('#conc_copies_per_L_giardia').closest('.form-group').show();
                    $('#conc_copies_per_L_crypto').closest('.form-group').show();
                    $('#conc_copies_per_g_dw_giardia').closest('.form-group').show();
                    $('#conc_copies_per_g_dw_crypto').closest('.form-group').show();
                } else if (hasGiardia) {
                    // Only giardia selected: show only giardia fields
                    $('#conc_copies_per_L_giardia').closest('.form-group').show();
                    $('#conc_copies_per_g_dw_giardia').closest('.form-group').show();
                } else if (hasCrypto) {
                    // Only crypto selected: show only crypto fields
                    $('#conc_copies_per_L_crypto').closest('.form-group').show();
                    $('#conc_copies_per_g_dw_crypto').closest('.form-group').show();
                } else {
                    // No target selected: show all fields by default
                    // $('#conc_copies_per_L_giardia').closest('.form-group').show();
                    // $('#conc_copies_per_L_crypto').closest('.form-group').show();
                    // $('#conc_copies_per_g_dw_giardia').closest('.form-group').show();
                    // $('#conc_copies_per_g_dw_crypto').closest('.form-group').show();
                }
            }
        }

        // Function to handle quality control visibility based on target selection
        function handleQualityControlVisibility(targetSelection = null, preserveValues = false) {
            // Get current target selection if not provided
            if (!targetSelection) {
                const selectedTargets = [];
                $('input[name="target[]"]:checked').each(function() {
                    selectedTargets.push($(this).val());
                });
                targetSelection = selectedTargets;
            }
            
            // Ensure targetSelection is an array
            if (typeof targetSelection === 'string') {
                targetSelection = targetSelection.split(',').map(t => t.trim());
            }
            
            const hasGiardia = targetSelection.includes('Giardia') || targetSelection.includes('giardia');
            const hasCrypto = targetSelection.includes('Cryptosporidium') || targetSelection.includes('cryptosporidium');

            // Hide all quality control fields by default and reset values (unless preserveValues is true)
            $('#quality_control_giardia').closest('.form-group').hide();
            if (!preserveValues) {
                $('#quality_control_giardia').prop('checked', false);
            }
            $('#quality_control_crypto').closest('.form-group').hide();
            if (!preserveValues) {
                $('#quality_control_crypto').prop('checked', false);
            }

            if (hasGiardia && hasCrypto) {
                // Both targets selected: show both quality control fields
                $('#quality_control_giardia').closest('.form-group').show();
                $('#quality_control_crypto').closest('.form-group').show();
                console.log('Quality Control Visibility: Both Giardia and Crypto shown');
            } else if (hasGiardia) {
                // Only Giardia selected: show only Giardia quality control
                $('#quality_control_giardia').closest('.form-group').show();
                // In edit mode with preserveValues, only clear crypto if it's not visible
                if (!preserveValues) {
                    $('#quality_control_crypto').prop('checked', false);
                }
                console.log('Quality Control Visibility: Only Giardia shown');
            } else if (hasCrypto) {
                // Only Cryptosporidium selected: show only Crypto quality control
                $('#quality_control_crypto').closest('.form-group').show();
                // In edit mode with preserveValues, only clear giardia if it's not visible  
                if (!preserveValues) {
                    $('#quality_control_giardia').prop('checked', false);
                }
                console.log('Quality Control Visibility: Only Crypto shown');
            } else {
                // No target selected: hide both quality control fields
                console.log('Quality Control Visibility: All hidden (no target selected)');
            }
        }

        // Function to check if target-related fields have data
        function hasTargetRelatedData(target) {
            if (target === 'Giardia' || target === 'giardia') {
                // Check Giardia-related fields
                const hasQualityControl = $('#quality_control_giardia').is(':checked');
                const hasConcentrationL = $('#conc_copies_per_L_giardia').val() && $('#conc_copies_per_L_giardia').val().trim() !== '';
                const hasConcentrationGDW = $('#conc_copies_per_g_dw_giardia').val() && $('#conc_copies_per_g_dw_giardia').val().trim() !== '';
                
                return hasQualityControl || hasConcentrationL || hasConcentrationGDW;
            } else if (target === 'Cryptosporidium' || target === 'cryptosporidium') {
                // Check Crypto-related fields
                const hasQualityControl = $('#quality_control_crypto').is(':checked');
                const hasConcentrationL = $('#conc_copies_per_L_crypto').val() && $('#conc_copies_per_L_crypto').val().trim() !== '';
                const hasConcentrationGDW = $('#conc_copies_per_g_dw_crypto').val() && $('#conc_copies_per_g_dw_crypto').val().trim() !== '';
                
                return hasQualityControl || hasConcentrationL || hasConcentrationGDW;
            }
            return false;
        }

        // Function to clear all data related to a specific target
        function clearTargetRelatedData(target) {
            if (target === 'Giardia' || target === 'giardia') {
                // Clear Giardia-related data
                $('#quality_control_giardia').prop('checked', false);
                $('#conc_copies_per_L_giardia').val('');
                $('#conc_copies_per_g_dw_giardia').val('');
                console.log('Cleared all Giardia-related data');
            } else if (target === 'Cryptosporidium' || target === 'cryptosporidium') {
                // Clear Crypto-related data
                $('#quality_control_crypto').prop('checked', false);
                $('#conc_copies_per_L_crypto').val('');
                $('#conc_copies_per_g_dw_crypto').val('');
                console.log('Cleared all Crypto-related data');
            }
        }

        
        // Simplified form - no complex field visibility management needed


        // Simplified change handler - no complex AJAX calls needed for simplified form
        $('.idOneWaterSampleSelect').change(function() {
            let id_one_water_sample = $(this).val();
            console.log('Selected One Water Sample ID:', id_one_water_sample);
        });

        // Simplified form - no complex calculations needed


        $('#id_one_water_sample').on("change", function() {
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
            id_one_water_sample = $('#id_one_water_sample').val();
            $.ajax({
                type: "GET",
                url: "Microbial/barcode_restrict?id1="+id_one_water_sample,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Id One Water Sample <strong> ' + id_one_water_sample +'</strong> is already in the system !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#id_one_water_sample').focus();
                        $('#id_one_water_sample').val('');        
                        $('#id_one_water_sample').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#id_one_water_sample').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#id_one_water_sample').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#id_one_water_sample').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                        id_one_water_sample = data[0].id_one_water_sample;
                        console.log(data);
                    }
                    else {
                        console.log('One Water Sample ID validation passed:', id_one_water_sample);
                    }
                }
            });
        }).trigger('change');

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
            // select: true;
            processing: true,
            serverSide: true,
            // ajax: {"url": "Microbial/json", "type": "POST"},
            ajax: {
                "url": "Microbial/json", 
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
                {"data": "id_one_water_sample"},
                {"data": "microbial_barcode"},
                {
                    "data": "description",
                    "render": function(data, type, row) {
                        return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
                    }
                },
                {"data": "created_by"},
                {
                    "data": "date_created",
                    "render": function(data, type, row) {
                        if (!data) return "-";
                        return new Date(data).toLocaleDateString();
                    }
                },
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
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

        // Initialize document buttons state
        updateDocumentButtonsState();

        // Check for URL parameters to auto-open modal (from Sample Reception redirect)
        const urlParams = new URLSearchParams(window.location.search);
        const barcodeFromUrl = urlParams.get('barcode');
        const idOneWaterSampleFromUrl = urlParams.get('idOneWaterSample');
        const idTestingTypeFromUrl = urlParams.get('idTestingType');

        console.log('Checking URL parameters for auto-modal:', {
            barcode: barcodeFromUrl,
            idOneWaterSample: idOneWaterSampleFromUrl,
            idTestingType: idTestingTypeFromUrl
        });

        if (barcodeFromUrl && idOneWaterSampleFromUrl) {
            console.log('Auto-opening modal with parameters');
            setTimeout(function() {
                $('#mode').val('insert');
                $('#modal-title').html('<i class="fa fa-wpforms"></i> Microbial | New<span id="my-another-cool-loader"></span>');
                
                // Use idx_one_water_sample for readonly field from URL parameters
                $('#idx_one_water_sample').attr('readonly', true);
                $('#idx_one_water_sample').val(idOneWaterSampleFromUrl);
                $('#idx_one_water_sample').show();
                $('#id_one_water_sample').hide().removeAttr('required');
                
                $('#microbial_barcode').val(barcodeFromUrl);
                $('#microbial_barcode').attr('readonly', true);
                $('#description').val('');
                $('#document_file').val('');
                updateDocumentButtonsState();
                $('#compose-modal').modal('show');
                console.log('Modal opened successfully');
            }, 500); // Small delay to ensure DOM is ready
        }

        // Check if filtered by Sample ID from Sample Reception redirect  
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

        $('#addtombol').click(function() {
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Microbial | New<span id="my-another-cool-loader"></span>');
            
            // Reset form fields for new entry
            $('#id_one_water_sample').attr('readonly', false).attr('required', true).val('').show();
            $('#idx_one_water_sample').hide();
            $('#microbial_barcode').attr('readonly', false).val('');
            $('#description').val('');
            $('#document_file').val('');
            
            // Reset document buttons
            $('#btn-open-document-scanner').show();
            $('#btn-delete-document-file').hide();
            $('#document-file-status-text').hide();
            
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square-o"></i> Microbial | Update<span id="my-another-cool-loader"></span>');
            $('#id_one_water_sample').hide().removeAttr('required');
            $('#idx_one_water_sample').show();
            $('#idx_one_water_sample').attr('readonly', true);
            $('#idx_one_water_sample').val(data.id_one_water_sample);
            $('#id_microbial').val(data.id_microbial);
            $('#microbial_barcode').val(data.microbial_barcode);
            $('#microbial_barcode').attr('readonly', true);
            $('#description').val(data.description);
            
            // Show current document if exists
            if (data.document_filename && data.document_filename !== 'null' && data.document_filename !== '') {
                $('#document_file').val(data.document_filename);
                updateDocumentButtonsState();
            } else {
                $('#document_file').val('');
                updateDocumentButtonsState();
            }





            
            $('#compose-modal').modal('show');
        });

        // Handle view document button click
        $('#mytable').on('click', '.btn_view_document', function(e) {
            e.stopPropagation(); // Prevent row selection
            let filename = $(this).data('filename');
            
            if (filename && filename !== 'null' && filename.trim() !== '') {
                // Open document in new window/tab for viewing
                let viewUrl = '<?= site_url("Microbial/view_document/") ?>' + encodeURIComponent(filename);
                window.open(viewUrl, '_blank', 'width=900,height=700,scrollbars=yes,resizable=yes');
            } else {
                alert('No document available to view.');
            }
        });

        $('#mytable tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }
        });

    });
</script>