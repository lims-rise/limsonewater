<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Processing | Protozoa </h3>
                    </div>
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                            <!-- <?php
                                $lvl = $this->session->userdata('id_user_level');
                                    if ($lvl != 4){
                                         echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Extraction Biosolid</button>";
                                    }
                            ?>         -->
                            <?php echo anchor(site_url('Protozoa/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to XLS', 'class="btn btn-success"'); ?>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID One Water Sample</th>
                                        <th>Lab Tech</th>
                                        <th>Sample Type</th>
                                        <th>Target</th>
                                        <th>Date Processed</th>
                                        <th>Time Processed</th>
                                        <th>Volume Analyzed</th>
                                        <th>Weight</th>
                                        <th>Dry Weight %</th>
                                        <th>Mass Analyzed</th>
                                        <th>Conc Cp/L Giard</th>
                                        <th>Conc Cp/G DW Giard</th>
                                         <th>Giardia QC</th>
                                        <th>Conc Cp/L Crypto</th>
                                        <th>Conc Cp/G DW Crypto</th>
                                        <th>Crypto QC</th>
                                        <th>Comment</th>
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
                    <h4 class="modal-title" id="modal-title">Protozoa | New</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('Protozoa/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <input id="id_protozoa" name="id_protozoa" type="hidden" class="form-control input-sm">

                        <div class="form-group">
                            <label for="id_one_water_sample" class="col-sm-4 control-label">One Water Sample ID</label>
                            <div class="col-sm-8">
                                <input id="id_one_water_sample" name="id_one_water_sample" placeholder="One Water Sample ID" type="text"  class="form-control idOneWaterSampleSelect">
                                <input id="idx_one_water_sample" name="idx_one_water_sample" placeholder="One Water Sample ID" type="text" class="form-control">
                                <div class="val2tip"></div>
                            </div>
                         </div>

                        <div class="form-group">
                            <label for="protozoa_barcode" class="col-sm-4 control-label">Protozoa Barcode</label>
                            <div class="col-sm-8">
                                <input id="protozoa_barcode" name="protozoa_barcode" type="text" class="form-control" placeholder="Protozoa Barcode" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_person" class="col-sm-4 control-label">Lab Tech</label>
                            <div class="col-sm-8">
                                <select id="id_person" name="id_person" class="form-control" required>
                                    <option value="" disabled>-- Select Lab Tech --</option>
                                    <?php
                                        foreach($labtech as $row) {
                                            if ($id_person == $row['id_person']) {
                                                echo "<option value='".$row['id_person']."' selected='selected'>".$row['realname']."</option>";
                                            } else {
                                                echo "<option value='".$row['id_person']."'>".$row['realname']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sampletype" class="col-sm-4 control-label">Sample Type</label>
                            <div class="col-sm-8">
                                <input id="id_sampletype" name="id_sampletype" placeholder="Sample Type" type="hidden" class="form-control">
                                <input id="sampletype" name="sampletype" placeholder="Sample Type" type="text" class="form-control smple">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="target" class="col-sm-4 control-label">Target</label>
                            <div class="col-sm-8">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="target[]" value="Giardia" id="target_giardia"> Giardia
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="target[]" value="Cryptosporidium" id="target_cryptosporidium"> Cryptosporidium
                                    </label>
                                </div>
                                <!-- Hidden input to store the combined target value -->
                                <input type="hidden" id="target_combined" name="target" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_processed" class="col-sm-4 control-label">Date Processed</label>
                            <div class="col-sm-8">
                                <input id="date_processed" name="date_processed" type="date" class="form-control" placeholder="Date Processed" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time_processed" class="col-sm-4 control-label">Time Processed</label>
                            <div class="col-sm-8">
                                <div class="input-group clockpicker">
                                    <input id="time_processed" name="time_processed" class="form-control" placeholder="Time Processed" value="<?php 
                                    $datetime = new DateTime();
                                    echo $datetime->format('H:i');
                                    ?>">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="volume_analysed" class="col-sm-4 control-label">Volume Analysed (L)</label>
                            <div class="col-sm-8">
                                <input id="volume_analysed" name="volume_analysed" type="number" step="any" class="form-control" placeholder="Volume Analysed (L)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="weight" class="col-sm-4 control-label">Weight (g)</label>
                            <div class="col-sm-8">
                                <input id="weight" name="weight" type="number" step="any" class="form-control" placeholder="Weight (g)" required readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dry_weight_persen" class="col-sm-4 control-label">Dry Weight (%)</label>
                            <div class="col-sm-8">
                                <input id="dry_weight_persen" name="dry_weight_persen" type="number" step="any" class="form-control" placeholder="Dry Weight (%)" required readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mass_analysed" class="col-sm-4 control-label">Mass Analysed (g/dw)</label>
                            <div class="col-sm-8">
                                <input id="mass_analysed" name="mass_analysed" type="number" step="any" class="form-control" placeholder="Mass Analysed (g/dw)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="conc_copies_per_L_giardia" class="col-sm-4 control-label">Concentration (copies/L) (Giardia)</label>
                            <div class="col-sm-8">
                                <input id="conc_copies_per_L_giardia" name="conc_copies_per_L_giardia" type="text" step="any" class="form-control" placeholder="Concentration (copies/L) (Giardia)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="conc_copies_per_g_dw_giardia" class="col-sm-4 control-label">Concentration (copies/g DW) (Giardia)</label>
                            <div class="col-sm-8">
                                <input id="conc_copies_per_g_dw_giardia" name="conc_copies_per_g_dw_giardia" type="text" step="any" class="form-control" placeholder="Concentration (copies/g DW) (Giardia)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Giardia Quality Control</label>
                            <div class="col-sm-8">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="quality_control_giardia" name="quality_control_giardia" value="1">
                                        <strong>Pass</strong> <span class="text-muted">(Check if quality control passed)</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="conc_copies_per_L_crypto" class="col-sm-4 control-label">Concentration (copies/L) (Crypto)</label>
                            <div class="col-sm-8">
                                <input id="conc_copies_per_L_crypto" name="conc_copies_per_L_crypto" type="text" step="any" class="form-control" placeholder="Concentration (copies/L) (Crypto)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="conc_copies_per_g_dw_crypto" class="col-sm-4 control-label">Concentration (copies/g DW) (Crypto)</label>
                            <div class="col-sm-8">
                                <input id="conc_copies_per_g_dw_crypto" name="conc_copies_per_g_dw_crypto" type="text" step="any" class="form-control" placeholder="Concentration (copies/g DW) (Crypto)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Crypto Quality Control</label>
                            <div class="col-sm-8">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="quality_control_crypto" name="quality_control_crypto" value="1">
                                        <strong>Pass</strong> <span class="text-muted">(Check if quality control passed)</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                                <label for="comments" class="col-sm-4 control-label">Comment</label>
                                <div class="col-sm-8">
                                    <textarea id="comments" name="comments" class="form-control" placeholder="Comment"> </textarea>
                                </div>
                        </div>

                        <!-- Review Component - Only visible in update mode -->
                        <div id="review-section" style="display: none; padding: 15px;">
                            <!-- <hr style="border-top: 1px solid #ddd; margin: 25px 0 20px 0;"> -->
                            
                            <!-- Hidden fields for review data -->
                            <input type="hidden" id="review" name="review" value="">
                            <input type="hidden" id="user_review" name="user_review" value="">
                            <input type="hidden" id="user_created" name="user_created" value="">
                            
                            <!-- Review Section Header -->
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <h5 style="color: #3c8dbc; font-weight: 600; margin-bottom: 15px;">
                                        <i class="fa fa-check-circle" style="margin-right: 8px;"></i>Review Status
                                    </h5>
                                    <!-- Review Status Display -->
                                    <div class="form-group">
                                        <!-- <label class="col-sm-4 control-label">Review Status</label> -->
                                        <div class="col-sm-12">
                                            <div class="review-status-container">
                                                <span id="review_label" class="badge bg-warning text-dark review-badge" role="button" tabindex="0">
                                                    Unreview
                                                </span>
                                                <span class="review-info">
                                                    <span class="text-muted">by:</span>
                                                    <span id="reviewed_by_label" class="reviewer-name">-</span>
                                                </span>
                                                <!-- Cancel Review Button (Admin Only) -->
                                                <button type="button" id="cancelReviewBtn" class="btn btn-danger btn-sm cancel-review-btn" style="display: none;">
                                                    <i class="fa fa-times"></i> Cancel Review
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Info Card -->
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div id="textInformReview" class="textInform review-info-card" style="display: none;">
                                        <div class="card-body">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h6 class="card-title statusMessage mb-0"></h6>
                                                <i class="fa fa-times close-card" style="cursor: pointer;"></i>
                                            </div>
                                            <p class="statusDescription mb-0"></p>
                                        </div>
                                    </div>
                                </div>
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
                <h4 class="modal-title"><i class="fa fa-trash"></i> Protozoa | Delete <span id="my-another-cool-loader"></span></h4>
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

    /* Review Component Styling */
    #review_label {
        cursor: pointer;
        font-size: 13px;
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        min-width: 80px;
        height: 32px;
        text-align: center;
    }

    #review_label:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }

    #reviewed_by_label {
        font-style: italic;
        font-weight: 600;
        font-size: 12px;
        color: #495057;
    }

    .review-status-container {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        padding: 4px 0;
    }

    .review-info {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        margin-left: 5px;
    }

    .reviewer-name {
        /* background: #f8f9fa; */
        padding: 4px 10px;
        border-radius: 20px;
        /* border: 1px solid #e9ecef; */
        min-width: 70px;
        text-align: center;
        font-size: 12px;
        font-weight: 500;
    }

    .cancel-review-btn {
        padding: 6px 14px;
        font-size: 13px;
        border-radius: 20px;
        transition: all 0.3s ease;
        font-weight: 500;
        min-width: 80px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .cancel-review-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(220,53,69,0.25);
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

    .review-info-card {
        border-radius: 6px;
        margin-top: 0px;
        padding: 12px 16px;
        width: 100%;
        border-left: 4px solid #3c8dbc;
        background: #f8f9fa;
        border: 1px solid #e9ecef;
    }

    .card-success {
        border-left-color: #28a745 !important;
        background-color: #d4edda !important;
        border-color: #c3e6cb !important;
    }

    .card-danger {
        border-left-color: #dc3545 !important;
        background-color: #f8d7da !important;
        border-color: #f5c6cb !important;
    }

    .card-title {
        font-size: 14px;
        font-weight: 600;
        text-align: left;
        margin-bottom: 4px;
        color: #495057;
    }

    .card-body {
        font-size: 13px;
        text-align: left;
        padding: 0px;
        line-height: 1.4;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .close-card {
        cursor: pointer;
        font-size: 16px;
        color: #6c757d;
        opacity: 0.7;
        transition: all 0.2s ease;
    }

    .close-card:hover {
        color: #dc3545;
        opacity: 1;
        transform: scale(1.1);
    }

    .unreview {
        color: #856404 !important;
        background-color: #fff3cd !important;
        border-color: #ffeaa7 !important;
    }

    .review {
        color: white !important;
        background-color: #28a745 !important;
        border-color: #1e7e34 !important;
    }

    .review-border {
        border: 2px solid #28a745 !important;
        color: #28a745 !important;
        background-color: #f8fff9 !important;
        box-shadow: 0 0 8px rgba(40, 167, 69, 0.25);
    }

    .textInform {
        margin-bottom: 12px;
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    #textInformReview .statusDescription {
        color: #6c757d;
        margin-top: 4px;
        font-size: 12px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .review-status-container {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
        
        .review-info {
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
        }
        
        .cancel-review-btn {
            width: 100%;
            text-align: center;
        }
    }

    /* Form group spacing for review section */
    #review-section .form-group {
        margin-bottom: 15px;
    }

    #review-section .form-group:last-child {
        margin-bottom: 10px;
    }

    /* Review section header styling */
    #review-section h5 {
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 8px;
        margin-bottom: 15px;
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

        if (barcodeFromUrl) {
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Protozoa | New<span id="my-another-cool-loader"></span>');
            // $('#project_idx').hide();
            // $('#id_one_water_sample').attr('readonly', false);
            // $('#id_one_water_sample').val('');
            // $('#id_one_water_sample_list').val('');
            // $('#id_one_water_sample').hide();
            // $('#id_one_water_sample_list').show();
            $('#id_one_water_sample').attr('readonly', true);
            $('#id_one_water_sample').val(idOneWaterSampleFromUrl || '');  // Set ID jika ada
            $('#idx_one_water_sample').hide();
            $('#protozoa_barcode').val(barcodeFromUrl);
            $('#protozoa_barcode').attr('readonly', true);
            $('#id_person').val('');
            $('#sampletype').attr('readonly', true);
            $('#sampletype').val('');
            $('input[name="target[]"]').prop('checked', false);
            $('#target_combined').val('');
            
            // $('#date_processed').val('');
            // $('#time_processed').val('');
            $('#volume_analysed').val('');
            $('#weight').val('');
            $('#dry_weight_persen').val('');
            $('#mass_analysed').val('');
            $('#weight').attr('readonly', true);
            $('#dry_weight_persen').attr('readonly', true);
            $('#mass_analysed').attr('readonly', true);
            // Reset quality control checkboxes for new record
            $('#quality_control_giardia').prop('checked', false);
            $('#quality_control_crypto').prop('checked', false);
            $('#conc_copies_per_L_giardia').val('');
            $('#conc_copies_per_L_crypto').val('');
            $('#conc_copies_per_g_dw_giardia').val('');
            $('#conc_copies_per_g_dw_crypto').val('');
            $('#comments').val('');
            $('#compose-modal').modal('show');
            
            // Initialize quality control visibility (hide all by default when no target selected)
            handleQualityControlVisibility();
            
            // Auto fetch weight and dry weight data when modal opens with One Water Sample ID
            setTimeout(function() {
                if ($('#id_one_water_sample').val()) {
                    autoFetchWeightData('#id_one_water_sample');
                }
            }, 500);
        } else {
            console.log('Barcode tidak ditemukan di URL');
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
            let url = '<?php echo site_url('Protozoa/delete'); ?>/' + id;
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
            const isEditMode = $('#id_protozoa').val() && $('#id_protozoa').val() !== '';
            
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

        // Function to update combined target value
        function updateTargetCombined() {
            const selectedTargets = [];
            $('input[name="target[]"]:checked').each(function() {
                selectedTargets.push($(this).val());
            });
            $('#target_combined').val(selectedTargets.join(','));
            console.log('Updated target combined:', selectedTargets.join(','));
        }

        // Handle form submission to ensure target value is updated
        $('#formSample').on('submit', function() {
            updateTargetCombined();
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

        
        // Function to handle volume_analysed visibility based on sampletype
        function handleVolumeAnalysedVisibility(sampletype) {
            if (!sampletype) {
                // If no sampletype, show all components by default
                $('#volume_analysed').closest('.form-group').show();
                $('#weight').closest('.form-group').show();
                $('#dry_weight_persen').closest('.form-group').show();
                $('#mass_analysed').closest('.form-group').show();
                return;
            }
            
            // Convert to lowercase for case-insensitive comparison
            const sampletypeLower = sampletype.toLowerCase();
            
            if (sampletypeLower === 'biosolids' || sampletypeLower === 'biosolid') {
                // Hide volume_analysed for biosolids, show weight-related fields
                $('#volume_analysed').closest('.form-group').hide();
                $('#volume_analysed').val(''); // Clear the value when hidden
                $('#weight').closest('.form-group').show();
                $('#dry_weight_persen').closest('.form-group').show();
                $('#mass_analysed').closest('.form-group').show();
            } else if (sampletypeLower === 'liquids' || sampletypeLower === 'liquid'){
                // Hide weight-related fields for liquids, show volume_analysed
                $('#volume_analysed').closest('.form-group').show();
                $('#weight').closest('.form-group').hide();
                $('#weight').val('');
                $('#dry_weight_persen').closest('.form-group').hide();
                $('#dry_weight_persen').val('');
                $('#mass_analysed').closest('.form-group').hide();
                $('#mass_analysed').val('');
            } else {
                // Show all components for other sample types
                $('#volume_analysed').closest('.form-group').show();
                $('#weight').closest('.form-group').show();
                $('#dry_weight_persen').closest('.form-group').show();
                $('#mass_analysed').closest('.form-group').show();
            }
        }


        $('.idOneWaterSampleSelect').change(function() {
            let id_one_water_sample = $(this).val(); // Mendapatkan ID produk yang dipilih
            if (id_one_water_sample) {
                $.ajax({
                    url: '<?php echo site_url('Protozoa/getIdOneWaterDetails'); ?>', // URL untuk request AJAX
                    type: 'POST',
                    data: { id_one_water_sample: id_one_water_sample }, // Data yang dikirim ke server
                    dataType: 'json', // Format data yang diharapkan dari server
                    success: function(response) {
                        // Mengisi field 'unit_of_measure' dengan nilai yang diterima dari server
                        $('#sampletype').val(response.sampletype || '');
                        $('#id_sampletype').val(response.id_sampletype || '');

                        // Trigger input event to handle visibility of tray_weight
                        $('#sampletype').trigger('input');
                        
                        // Handle volume_analysed visibility based on sampletype
                        handleVolumeAnalysedVisibility(response.sampletype);
                        
                        // Handle concentration fields visibility based on sampletype
                        // Check if we're in edit mode to preserve values
                        const isEditMode = $('#id_protozoa').val() && $('#id_protozoa').val() !== '';
                        handleConcentrationFieldsVisibility(response.sampletype, null, isEditMode);
                        
                        // Auto fetch weight and dry weight data
                        autoFetchWeightData('#id_one_water_sample');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Menangani error jika terjadi kesalahan dalam request
                        console.error('AJAX error:', textStatus, errorThrown);
                        $('#sampletype').val('');
                    }
                });
            } else {
                $('#sampletype').val('');
                $('#tray_weight_container').hide(); 
            }
        });

        // Auto fetch weight and dry weight data
        function autoFetchWeightData(inputSelector) {
            const $input = $(inputSelector);
            const id_one_water_sample = $input.val();

            // Validation: element must exist and value must not be empty
            if (!$input.length || !id_one_water_sample || id_one_water_sample.trim() === '') {
                // Set default values to 0 if no sample ID
                $('#weight').val('0');
                $('#dry_weight_persen').val('0');
                calculateMassAnalysed();
                return;
            }

            // Clear previous values first
            $('#weight').val('');
            $('#dry_weight_persen').val('');

            // Log the request for debugging
            console.log('Auto fetching weight data for ID:', id_one_water_sample.trim());

            // Fetch weight data
            $.ajax({
                url: '<?php echo site_url('Protozoa/getWeight'); ?>',
                type: 'POST',
                data: { id_one_water_sample: id_one_water_sample.trim() },
                dataType: 'json',
                cache: false,
                timeout: 10000,
                success: function(response) {
                    console.log('Weight fetch response for [' + id_one_water_sample.trim() + ']:', response);

                    if (response && response.weight !== null && response.weight !== undefined) {
                        const weight = parseFloat(response.weight);
                        if (!isNaN(weight)) {
                            $('#weight').val(response.weight);
                        } else {
                            $('#weight').val('0'); // Default to 0 if invalid
                        }
                    } else {
                        $('#weight').val('0'); // Default to 0 if no data
                    }
                    
                    // After weight is set, calculate mass analysed
                    calculateMassAnalysed();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error for weight [' + id_one_water_sample.trim() + ']:', textStatus, errorThrown);
                    $('#weight').val('0'); // Default to 0 on error
                    calculateMassAnalysed();
                }
            });

            // Fetch dry weight data
            $.ajax({
                url: '<?php echo site_url('Protozoa/getDryWeight'); ?>',
                type: 'POST',
                data: { id_one_water_sample: id_one_water_sample.trim() },
                dataType: 'json',
                cache: false,
                timeout: 10000,
                success: function(response) {
                    console.log('Dry weight fetch response for [' + id_one_water_sample.trim() + ']:', response);

                    if (response && response.dry_weight_persen !== null && response.dry_weight_persen !== undefined) {
                        const dryWeight = parseFloat(response.dry_weight_persen);
                        if (!isNaN(dryWeight)) {
                            $('#dry_weight_persen').val(response.dry_weight_persen);
                        } else {
                            $('#dry_weight_persen').val('0'); // Default to 0 if invalid
                        }
                    } else {
                        $('#dry_weight_persen').val('0'); // Default to 0 if no data
                    }
                    
                    // After dry weight is set, calculate mass analysed
                    calculateMassAnalysed();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error for dry weight [' + id_one_water_sample.trim() + ']:', textStatus, errorThrown);
                    $('#dry_weight_persen').val('0'); // Default to 0 on error
                    calculateMassAnalysed();
                }
            });
        }

        // Auto calculate mass_analysed function
        function calculateMassAnalysed() {
            const weight = parseFloat($('#weight').val()) || 0;
            const dryWeightPersen = parseFloat($('#dry_weight_persen').val()) || 0;
            
            // Calculate mass_analysed = weight * dry_weight_persen
            const massAnalysed = weight * dryWeightPersen;
            
            // Update the mass_analysed field with calculated value
            // Always show the calculated result, even if it's 0
            $('#mass_analysed').val(massAnalysed.toFixed(6)); // 6 decimal places for precision
            
            console.log('Auto calculate: weight =', weight, ', dry_weight_persen =', dryWeightPersen, ', mass_analysed =', massAnalysed);
        }

        // Attach auto calculate to weight and dry_weight_persen input events
        $('#weight, #dry_weight_persen').on('input change keyup', function() {
            calculateMassAnalysed();
        });


        $('#id_one_water_sample').on("change", function() {
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
            id_one_water_sample = $('#id_one_water_sample').val();
            $.ajax({
                type: "GET",
                url: "Protozoa/barcode_restrict?id1="+id_one_water_sample,
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
                        // Auto fetch weight and dry weight data when validation passes
                        autoFetchWeightData('#id_one_water_sample');
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
            ajax: {"url": "Protozoa/json", "type": "POST"},
            columns: [
                {"data": "id_one_water_sample"},
                {"data": "initial"},
                {"data": "sampletype"},
                {"data": "target"},
                {"data": "date_processed"},
                {"data": "time_processed"},
                {
                    "data": "volume_analysed",
                    "render": function(data, type, row) {
                        return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
                    }
                },
                {
                    "data": "weight",
                    "render": function(data, type, row) {
                        return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
                    }
                },
                {
                    "data": "dry_weight_persen",
                    "render": function(data, type, row) {
                        return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
                    }
                },
                {
                    "data": "mass_analysed",
                    "render": function(data, type, row) {
                        return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
                    }
                },
                {
                    "data": "conc_copies_per_L_giardia",
                    "render": function(data, type, row) {
                        return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
                    }
                },
                {
                    "data": "conc_copies_per_g_dw_giardia",
                    "render": function(data, type, row) {
                        return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
                    }
                },
                {
                    "data": "quality_control_giardia",
                    "render": function(data, type, row) {
                        return data == '1' ? '<span class="badge1 badge1-success"><i class="fa fa-check"></i></span>' : '<span class="badge1 badge1-danger"><i class="fa fa-times"></i></span>';
                    },
                    "className": "text-center"
                },
                {
                    "data": "conc_copies_per_L_crypto",
                    "render": function(data, type, row) {
                        return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
                    }
                },
                {
                    "data": "conc_copies_per_g_dw_crypto",
                    "render": function(data, type, row) {
                        return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
                    }
                },
                {
                    "data": "quality_control_crypto",
                    "render": function(data, type, row) {
                        return data == '1' ? '<span class="badge1 badge1-success"><i class="fa fa-check"></i></span>' : '<span class="badge1 badge1-danger"><i class="fa fa-times"></i></span>';
                    },
                    "className": "text-center"
                },
                {"data": "comments"},
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

        $('#addtombol').click(function() {
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Protozoa | New<span id="my-another-cool-loader"></span>');
            // $('#project_idx').hide();
            $('#id_one_water_sample').attr('readonly', false);
            $('#id_one_water_sample').val('');
            $('#id_one_water_sample_list').val('');
            $('#id_one_water_sample').hide();
            $('#id_one_water_sample_list').show();
            $('#id_person').val('');
            $('#sampletype').attr('readonly', true);
            $('#sampletype').val('');
            $('input[name="target[]"]').prop('checked', false);
            $('#target_combined').val('');
            
            
            $('#id_person_proc').val('');
            // $('#date_processed').val('');
            $('#volume_filter').val('');
            $('#volume_eluted').val('');
            $('#weight').val('');
            $('#dry_weight_persen').val('');
            $('#mass_analysed').val('');
            // Reset quality control checkboxes for new record
            $('#quality_control_giardia').prop('checked', false);
            $('#quality_control_crypto').prop('checked', false);
            $('#comments').val('');
            $('#compose-modal').modal('show');
            
            // Initialize quality control visibility (hide all by default when no target selected)
            handleQualityControlVisibility();
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square-o"></i> Protozoa | Update<span id="my-another-cool-loader"></span>');
            $('#id_one_water_sample').hide();
            $('#idx_one_water_sample').attr('readonly', true);
            $('#idx_one_water_sample').val(data.id_one_water_sample);
            $('#id_protozoa').val(data.id_protozoa);
            $('#protozoa_barcode').val(data.protozoa_barcode);
            $('#protozoa_barcode').attr('readonly', true);
            $('#id_person').val(data.id_person).trigger('change');
            $('#sampletype').attr('readonly', true);
            $('#id_sampletype').val(data.id_sampletype);
            $('#sampletype').val(data.sampletype);
            
            // Handle volume_analysed visibility based on sampletype in edit mode
            handleVolumeAnalysedVisibility(data.sampletype);
            
            $('#tartget').val(data.target);
            // Handle target checkboxes
            $('input[name="target[]"]').prop('checked', false);
            if (data.target) {
                // Split comma-separated values and check each checkbox
                const targets = data.target.split(',');
                targets.forEach(function(target) {
                    $('input[name="target[]"][value="' + target.trim() + '"]').prop('checked', true);
                });
                // Update the hidden input with combined value
                $('#target_combined').val(data.target);
            } else {
                $('#target_combined').val('');
            }
            
            // Handle concentration fields visibility based on sampletype and target in edit mode
            handleConcentrationFieldsVisibility(data.sampletype, data.target, true);
            
            // Set concentration values AFTER fields are shown/hidden to prevent data loss
            $('#conc_copies_per_L_giardia').val(data.conc_copies_per_L_giardia);
            $('#conc_copies_per_L_crypto').val(data.conc_copies_per_L_crypto);
            $('#conc_copies_per_g_dw_giardia').val(data.conc_copies_per_g_dw_giardia);
            $('#conc_copies_per_g_dw_crypto').val(data.conc_copies_per_g_dw_crypto);
            
            // Update quality control visibility based on loaded target selection  
            handleQualityControlVisibility(data.target, true);
            
            $('#date_processed').val(data.date_processed).trigger('change');
            $('#time_processed').val(data.time_processed).trigger('change');
            $('#volume_analysed').val(data.volume_analysed);
            $('#weight').val(data.weight);
            $('#dry_weight_persen').val(data.dry_weight_persen);
            $('#mass_analysed').val(data.mass_analysed);
            // Set quality control checkboxes
            $('#quality_control_giardia').prop('checked', data.quality_control_giardia == '1');
            $('#quality_control_crypto').prop('checked', data.quality_control_crypto == '1');
            $('#weight').attr('readonly', true);
            $('#dry_weight_persen').attr('readonly', true);
            $('#mass_analysed').attr('readonly', true);

            // Trigger auto calculation after all data is loaded
            setTimeout(function() {
                calculateMassAnalysed();
            }, 100);

            $('#comments').val(data.comments);

            // Show review section and populate review data
            $('#review-section').show();
            setupReviewComponent(data);
            
            $('#compose-modal').modal('show');
        });

        // Setup review component with data
        function setupReviewComponent(data) {
            $('#review').val(data.review || 0);
            $('#user_review').val(data.user_review || '');
            $('#user_created').val(data.user_created || '');
            
            // Initialize review system with the same logic as campy_biosolids
            initializeReviewSystem(data);
        }

        // Initialize review system with complete logic from campy_biosolids
        function initializeReviewSystem(data) {
            let loggedInUser = '<?php echo $this->session->userdata('id_users'); ?>';
            let userCreated = data.user_created || '';
            let userReview = data.user_review || '';
            let fullName = ''; // Will be fetched if needed

            // Get reviewer name if exists
            if (userReview) {
                $.ajax({
                    url: '<?php echo site_url('Protozoa/getReviewer'); ?>',
                    type: 'POST',
                    data: { user_review: userReview },
                    dataType: 'json',
                    success: function(response) {
                        fullName = response.full_name || '-';
                        $('#reviewed_by_label').text(fullName);
                    },
                    error: function() {
                        $('#reviewed_by_label').text('-');
                    }
                });
            } else {
                $('#reviewed_by_label').text('-');
            }

            // Define review states
            const states = [
                { value: 0, label: "Unreview", class: "unreview" },
                { value: 1, label: "Reviewed", class: "review" }
            ];

            // Get initial state from hidden input
            let currentState = parseInt($('#review').val());
            if (isNaN(currentState) || currentState < 0 || currentState > 1) currentState = 0;

            // Set initial display on review label
            $('#review_label')
                .text(states[currentState].label)
                .removeClass()
                .addClass('badge review-badge ' + (currentState === 1 ? 'bg-success review' : 'bg-warning unreview'));

            // Check if logged in user is NOT the creator
            if (userCreated !== loggedInUser) {
                $('#user_review').val(loggedInUser);

                $('#review_label').off('click').on('click', function () {
                    if ($('#review').val() === '1') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Review Locked',
                            text: 'You have already reviewed this. Further changes are not allowed.',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }

                    Swal.fire({
                        icon: 'question',
                        title: 'Review Sample',
                        text: 'Are you sure you want to review this sample?',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, Review',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            currentState = (currentState + 1) % states.length;

                            $('#review').val(states[currentState].value);
                            $('#review_label')
                                .text(states[currentState].label)
                                .removeClass()
                                .addClass('badge review-badge ' + (currentState === 1 ? 'bg-success review' : 'bg-warning unreview'));

                            // Save review via AJAX
                            saveReviewData();
                        } else {
                            Swal.fire({
                                icon: 'info',
                                title: 'Review Not Changed',
                                text: 'No changes were made.',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    });
                });

                if ($('#review').val() === '1') {
                    showReviewInfoCard(
                        '#textInformReview',
                        '<i class="fa fa-times-circle"></i> You are not the creator',
                        "In this case, you can't review because it has already been reviewed.",
                        false
                    );
                } else {
                    showReviewInfoCard(
                        '#textInformReview',
                        '<i class="fa fa-times-circle"></i> You are not the creator',
                        "In this case, you can review this data. Hover over the box on the top side to start the review.",
                        false
                    );
                }

                // Mouse enter/leave effects for review label
                $('#review_label')
                .on('mouseenter', function() {
                    if ($('#review').val() !== '1') { 
                        $(this).text('Review')
                            .addClass('review-border');
                    }
                })
                .on('mouseleave', function() {
                    if ($('#review').val() !== '1') { 
                        $(this).text('Unreview')
                            .removeClass('review-border');
                    }
                });

            } else {
                $('#user_review').val(loggedInUser);

                showReviewInfoCard(
                    '#textInformReview',
                    '<i class="fa fa-check-circle"></i> You are the creator',
                    "You have full access to edit this data but not review.",
                    true
                );
            }

            // Handle cancel review button (for admin users level 1 & 2)
            const currentUserLevel = '<?php echo $this->session->userdata('id_user_level'); ?>';
            
            // Check review status when page loads
            if ($('#review').val() === '1') {
                // If review status = 1 (reviewed), enable cancel button for admin
                if (currentUserLevel == 1 || currentUserLevel == 2) {
                    $('#cancelReviewBtn').show().prop('disabled', false).removeClass('disabled-btn');
                }
            } else {
                // If review status = 0 (not reviewed), disable cancel button
                $('#cancelReviewBtn').hide().prop('disabled', true).addClass('disabled-btn');
            }

            // Event handler for Cancel Review button
            $('#cancelReviewBtn').off('click').on('click', function () {
                Swal.fire({
                    icon: 'warning',
                    title: 'Cancel Review?',
                    text: 'This will reset the review status so another user can review it again.',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, cancel it',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Set review and user_review for cancel
                        $('#review').val(0);
                        $('#user_review').val('');

                        // Update label status to Unreview
                        $('#review_label')
                            .text('Unreview')
                            .removeClass()
                            .addClass('badge review-badge bg-warning unreview');

                        // Disable the Cancel Review button after canceling
                        $('#cancelReviewBtn').hide().prop('disabled', true).addClass('disabled-btn');

                        // Cancel review via AJAX
                        cancelReviewData();
                    }
                });
            });
        }

        // Save review data function
        function saveReviewData() {
            const idOneWaterSample = $('#idx_one_water_sample').val();
            const review = $('#review').val();
            const userReview = $('#user_review').val();

            $.ajax({
                url: '<?php echo site_url('Protozoa/saveReview'); ?>',
                method: 'POST',
                data: {
                    id_one_water_sample: idOneWaterSample,
                    review: review,
                    user_review: userReview
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Review saved successfully!',
                            text: response.message,
                            timer: 1000,
                            showConfirmButton: false
                        }).then(() => {
                            // Refresh the DataTable and close modal
                            table.ajax.reload(null, false);
                            $('#compose-modal').modal('hide');
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to save review',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                    Swal.fire('Error', 'Something went wrong during submission.', 'error');
                }
            });
        }

        // Cancel review data function
        function cancelReviewData() {
            const idOneWaterSample = $('#idx_one_water_sample').val();

            $.ajax({
                url: '<?php echo site_url('Protozoa/cancelReview'); ?>',
                method: 'POST',
                data: {
                    id_one_water_sample: idOneWaterSample
                },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Review canceled successfully!',
                            timer: 1000,
                            showConfirmButton: false
                        }).then(() => {
                            // Refresh the DataTable and close modal
                            table.ajax.reload(null, false);
                            $('#compose-modal').modal('hide');
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to cancel review',
                            text: response.message
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                    Swal.fire('Error', 'Something went wrong during cancel.', 'error');
                }
            });
        }

        // Function to show dynamic info card for review
        function showReviewInfoCard(target, message, description, isSuccess) {
            // Add dynamic content to the target card
            $(target).find('.statusMessage').html(message);
            $(target).find('.statusDescription').text(description);

            // Apply classes based on success or failure
            if (isSuccess) {
                $(target).removeClass('card-danger').addClass('card-success');
            } else {
                $(target).removeClass('card-success').addClass('card-danger');
            }

            // Show the info card
            $(target).fadeIn();
        }

        // Update review display (simplified version, main logic in initializeReviewSystem)
        function updateReviewDisplay(review, userReview) {
            if (review == 1) {
                $('#review_label').removeClass('bg-warning unreview').addClass('bg-success review').text('Reviewed');
                
                // Show cancel button for admin users (level 1 & 2)
                const currentUserLevel = '<?php echo $this->session->userdata('id_user_level'); ?>';
                if (currentUserLevel == 1 || currentUserLevel == 2) {
                    $('#cancelReviewBtn').show();
                } else {
                    $('#cancelReviewBtn').hide();
                }
                
                // Update reviewer name display
                if (userReview) {
                    $.ajax({
                        url: '<?php echo site_url('Protozoa/getReviewer'); ?>',
                        type: 'POST',
                        data: { user_review: userReview },
                        dataType: 'json',
                        success: function(response) {
                            $('#reviewed_by_label').text(response.full_name || '-');
                        },
                        error: function() {
                            $('#reviewed_by_label').text('-');
                        }
                    });
                } else {
                    $('#reviewed_by_label').text('-');
                }
            } else {
                $('#review_label').removeClass('bg-success review').addClass('bg-warning unreview').text('Unreview');
                $('#reviewed_by_label').text('-');
                $('#cancelReviewBtn').hide();
            }
        }

        // Close card handler
        $(document).on('click', '.close-card', function() {
            $(this).closest('.textInform').hide();
        });

        // Hide review section when modal is hidden
        $("#compose-modal").on('hide.bs.modal', function(){
            $('#review-section').hide();
            $('#textInformReview').hide();
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