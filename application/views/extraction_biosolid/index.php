<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Processing | Extraction biosolid </h3>
                    </div>
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                            <!-- <?php
                                $lvl = $this->session->userdata('id_user_level');
                                    if ($lvl != 4){
                                         echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Extraction Biosolid</button>";
                                    }
                            ?>         -->
                            <?php echo anchor(site_url('Extraction_biosolid/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to XLS', 'class="btn btn-success"'); ?>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Barcode sample</th>
                                        <th>ID Onewater Sample</th>
                                        <th>Lab Tech</th>
                                        <th>Sample type</th>
                                        <th>Date extraction</th>
                                        <th>Weight (g)</th>
                                        <!-- <th>Volume (PBS)</th> -->
                                        <th>Comments</th>
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
                    <h4 class="modal-title" id="modal-title">Extraction biosolid | New</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('Extraction_biosolid/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <!-- <input id="id_req" name="id_req" type="hidden" class="form-control input-sm"> -->

                        <div class="form-group">
                            <label for="id_one_water_sample" class="col-sm-4 control-label">One Water Sample ID</label>
                            <div class="col-sm-8">
                                <input id="id_one_water_sample" name="id_one_water_sample" placeholder="One Water Sample ID" type="text"  class="form-control idOneWaterSampleSelect">
                                <input id="idx_one_water_sample" name="idx_one_water_sample" placeholder="One Water Sample ID" type="text" class="form-control">
                                <div class="val1tip"></div>
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
                            <label for="barcode_sample" class="col-sm-4 control-label">Barcode Sample</label>
                            <div class="col-sm-8">
                                <input id="barcode_sample" name="barcode_sample" placeholder="Barcode Sample" type="text" class="form-control" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sampletype" class="col-sm-4 control-label">Sample Type</label>
                            <div class="col-sm-8">
                                <input id="sampletype" name="sampletype" placeholder="Sample Type" type="text" class="form-control">
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="weight" class="col-sm-4 control-label">Weight (g)</label>
                            <div class="col-sm-8">
                                <input id="weight" name="weight" placeholder="Weight (g)" type="number" step="any" class="form-control">
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="volume" class="col-sm-4 control-label">Volume suspended in PBS</label>
                            <div class="col-sm-8">
                                <input id="volume" name="volume" placeholder="Volume suspended in PBS" type="number" step="1" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dilution" class="col-sm-4 control-label">Dilution (uL)</label>
                            <div class="col-sm-8">
                                <select id="dilution" name="dilution" class="form-control" required>
                                    <option value="" disabled selected='selected'>-- Select Dilution --</option>
                                    <option value="2000">2000</option>
                                    <option value="1000">1000</option>
                                    <option value="600">600</option>
                                    <option value="300">300</option>
                                    <option value="200">200</option>
                                    <option value="100">100</option>
                                    <option value="60">60</option>
                                    <option value="30">30</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="culture_media" class="col-sm-4 control-label">Culture media</label>
                            <div class="col-sm-8">
                                <select id="culture_media" name="culture_media" class="form-control" required>
                                    <option value="" disabled selected='selected'>-- Select Culture media --</option>
                                    <option value="HBA">HBA</option>
                                    <option value="XLD">XLD</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="culture_plate" class="col-sm-4 control-label">Culture plate</label>
                            <div class="col-sm-8">
                                <select id="culture_plate" name="culture_plate" class="form-control" required>
                                    <option value="" disabled selected='selected'>-- Select Culture plate --</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                </select>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label for="date_extraction" class="col-sm-4 control-label">Date Extraction</label>
                            <div class="col-sm-8">
                                <input id="date_extraction" name="date_extraction" type="date" class="form-control" placeholder="Date Extraction" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="id_kit" class="col-sm-4 control-label">Kit Used</label>
                            <div class="col-sm-8">
                                <select id="id_kit" name="id_kit" class="form-control">
                                    <option value="" disabled selected='selected'>-- Select Kit --</option>
                                    <?php
                                        foreach($kit as $row) {
                                            if ($id_kit == $row['id_kit']) {
                                                echo "<option value='".$row['id_kit']."' selected='selected'>".$row['kit']."</option>";
                                            } else {
                                                echo "<option value='".$row['id_kit']."'>".$row['kit']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label for="id_kit" class="col-sm-4 control-label">Kit Used</label>
                            <div class="col-sm-8" >
                                <select id='id_kit' name="id_kit" class="form-control" required>
                                    <option value="" disabled>-- Select Kit --</option>
                                        <?php
                                            foreach($kit as $row){
                                                if ($id_kit == $row['id_kit']) {
                                                    echo "<option value='".$row['id_kit']."' selected='selected' data-type='".$row['kit']."'>".$row['kit']."</option>";
                                                }
                                                else {
                                                    echo "<option value='".$row['id_kit']."' data-type='".$row['kit']."'>".$row['kit']."</option>";
                                                }
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>

                        <!-- Additional Type Description Field (appears for Animal/Other) -->
                        <div class="form-group" id="other-kit-group" style="display: none;">
                            <label for="other_kit" class="col-sm-4 control-label">Other</label>
                            <div class="col-sm-8">
                                <input id="other_kit" name="other_kit" placeholder="Please specify the kit..." type="text" class="form-control">
                                <small class="text-muted">Please provide additional details about the sample kit.</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kit_lot" class="col-sm-4 control-label">Kit Lot no.</label>
                            <div class="col-sm-8">
                                <input id="kit_lot" name="kit_lot" placeholder="Kit Lot no." type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                                <label for="comments" class="col-sm-4 control-label">Comments</label>
                                <div class="col-sm-8">
                                    <textarea id="comments" name="comments" class="form-control" placeholder="Comments"> </textarea>
                                </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="barcode_tube" class="col-sm-4 control-label">Barcode Tube</label>
                            <div class="col-sm-8">
                                <input id="barcode_tube" name="barcode_tube" placeholder="Barcode Tube" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dna_concentration" class="col-sm-4 control-label">DNA Concentration (ng/ul)</label>
                            <div class="col-sm-8">
                                <input id="dna_concentration" name="dna_concentration" placeholder="DNA Concentration (ng/ul)" type="number" step="any" class="form-control">
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
                            <input id="id_loc" name="id_loc" type="hidden" class="form-control" required>
                            <div class="col-sm-2">
                            <select id='id_freez' name="id_freez" class="form-control" required>
                                <option>Freezer</option>
                                    <?php
                                    foreach($freez1 as $row){
                                        echo "<option value='".$row['freezer']."'>".$row['freezer']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                            <div class="col-sm-2">
                            <select id='id_shelf' name="id_shelf" class="form-control" required>
                                <option>Shelf</option>
                                    <?php
                                    foreach($shelf1 as $row){
                                        echo "<option value='".$row['shelf']."'>".$row['shelf']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                            <div class="col-sm-2">
                            <select id='id_rack' name="id_rack" class="form-control" required>
                                <option>Rack</option>
                                    <?php
                                    foreach($rack1 as $row){
                                        echo "<option value='".$row['rack']."'>".$row['rack']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                            <div class="col-sm-2">
                            <select id='id_tray' name="id_tray" class="form-control" required>
                                <option>Tray</option>
                                    <?php
                                    foreach($tray1 as $row){
                                        echo "<option value='".$row['tray']."'>".$row['tray']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_position" class="col-sm-4 control-label">Position in Cryobox</label>
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
                <h4 class="modal-title"><i class="fa fa-trash"></i> Extraction biosolid | Delete <span id="my-another-cool-loader"></span></h4>
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
    let id_one_water_sample = $('#id_one_water_sample').val();
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Extraction biosolid | New<span id="my-another-cool-loader"></span>');
            // $('#project_idx').hide();
            // $('#id_one_water_sample').attr('readonly', false);
            // $('#id_one_water_sample').val('');
            // $('#id_one_water_sample_list').val('');
            // $('#id_one_water_sample').hide();
            // $('#id_one_water_sample_list').show();
            $('#id_one_water_sample').attr('readonly', true);
            $('#id_one_water_sample').val(idOneWaterSampleFromUrl || '');  // Set ID jika ada);
            $('#idx_one_water_sample').hide();
            $('#id_person').val('');
            $('#barcode_sample').attr('readonly', true);
            $('#barcode_sample').val(barcodeFromUrl);
            $('#sampletype').attr('readonly', true);
            $('#sampletype').val('');
            // $('#date_extraction').val('');
            $('#weight').val('');
            // $('#volume').val('');
            // $('#dilution').val('');
            // $('#culture_plate').val('');
            // $('#culture_media').val('');
            $('#id_kit').val('');
            $('#kit_lot').val('');
            $('#barcode_tube').val('');
            $('#dna_concentration').val('');
            $('#cryobox').val('');
            $('#id_freez').val('');
            $('#id_shelf').val('');
            $('#id_rack').val('');
            $('#id_tray').val('');
            $('#id_row').val('');
            $('#id_col').val('');
            $('#comments').val('');
            $('#compose-modal').modal('show');
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
            let url = '<?php echo site_url('Extraction_biosolid/delete'); ?>/' + id;
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

        $('#barcode_sample').on("change", function() {
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
            data1 = $('#barcode_sample').val();
            // // ckbar = data1.substring(0,5).toUpperCase();
            // // ckarray = ["N-S2-", "F-S2-", "N-F0-", "F-F0-"];
            // // ck = $.inArray(ckbar, ckarray);
            // if (ck == -1) {
            $.ajax({
                type: "GET",
                url: "Extraction_biosolid/barcode_restrict?id1="+data1,
                // data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#barcode_sample').focus();
                        $('#barcode_sample').val('');     
                        // $('#sampletype').val('Biobank Sample');    
                        $('#barcode_sample').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_sample').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_sample').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_sample').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                        barcode = data[0].barcode_sample;
                        console.log(data);
                    }
                    else {
                        // $('#sampletype').val(data[0].sampletype);    
                        // $('#volume_filtered').val(data[0].vol);     
                        // if (data[0].stype == 'Bootsocks') {
                        //     $('#barcode_falcon2').attr('readonly', false);
                        // } else {
                        //     $('#barcode_falcon2').attr('readonly', true);
                        // }
                    }
                }
            });
        // }
        });    
        
        $('.idOneWaterSampleSelect').change(function() {
            let id_one_water_sample = $(this).val(); // Mendapatkan ID produk yang dipilih
            console.log('test'+ id_one_water_sample)
            if (id_one_water_sample) {
                $.ajax({
                    url: '<?php echo site_url('Extraction_biosolid/getIdOneWaterDetails'); ?>', // URL untuk request AJAX
                    type: 'POST',
                    data: { id_one_water_sample: id_one_water_sample }, // Data yang dikirim ke server
                    dataType: 'json', // Format data yang diharapkan dari server
                    success: function(response) {
                        console.log('ceks:',response);
                        // Mengisi field 'unit_of_measure' dengan nilai yang diterima dari server
                        $('#sampletype').val(response.sampletype || '');
                        $('#id_sampletype').val(response.id_sampletype || '');

                        // Trigger input event to handle visibility of tray_weight
                        $('#sampletype').trigger('input');
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

        $('#id_one_water_sample').on("change", function() {
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
            id_one_water_sample = $('#id_one_water_sample').val();
            $.ajax({
                type: "GET",
                url: "Extraction_biosolid/barcode_restrict?id1="+id_one_water_sample,
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
                    }
                }
            });
        }).trigger('change');

        // $('#id_one_water_sample_list').on("change", function() {
        //     $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
            
        //     data1 = $('#id_one_water_sample_list').val();
        //     // data1 = $('#barcode_sample').val();
        //     // // ckbar = data1.substring(0,5).toUpperCase();
        //     // // ckarray = ["N-S2-", "F-S2-", "N-F0-", "F-F0-"];
        //     // // ck = $.inArray(ckbar, ckarray);
        //     // if (ck == -1) {
        //     $.ajax({
        //         type: "GET",
        //         url: "Extraction_biosolid/barcode_check?id1="+data1,
        //         // data:data1,
        //         dataType: "json",
        //         success: function(data) {
        //             // var barcode = '';
        //             if (data.length == 0) {
        //                 // tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is not on reception or is already in the system !</span>');
        //                 // $('.val1tip').tooltipster('content', tip);
        //                 // $('.val1tip').tooltipster('show');
        //                 // $('#barcode_sample').focus();
        //                 // $('#barcode_sample').val('');     
        //                 $('#sampletype').val('Biobank Sample');    
        //                 // $('#barcode_sample').css({'background-color' : '#FFE6E7'});
        //                 // setTimeout(function(){
        //                 //     $('#barcode_sample').css({'background-color' : '#FFFFFF'});
        //                 //     setTimeout(function(){
        //                 //         $('#barcode_sample').css({'background-color' : '#FFE6E7'});
        //                 //         setTimeout(function(){
        //                 //             $('#barcode_sample').css({'background-color' : '#FFFFFF'});
        //                 //         }, 300);                            
        //                 //     }, 300);
        //                 // }, 300);
        //                 // console.log(data);
        //             }
        //             else {
        //                 $('#sampletype').val(data[0].sampletype);    
        //             }
        //         }
        //     });
        // // }
        // });

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

        function load_freez(data1) {
            $.ajax({
                type: "GET",
                url: "Extraction_biosolid/load_freez?id1="+data1,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        console.log();
                        $('#id_freez').val(data[0].freezer);    
                        $('#id_shelf').val(data[0].shelf);    
                        $('#id_rack').val(data[0].rack);    
                        $('#id_tray').val(data[0].tray);    
                    }
                    else {
                        $('#id_freez').val('');    
                        $('#id_shelf').val('');    
                        $('#id_rack').val('');    
                        $('#id_tray').val('');    
                    }
                }
            });
        }

        function get_freez(data1, data2, data3, data4) {
            $.ajax({
                type: "GET",
                url: "Extraction_biosolid/get_freez?id1="+data1+"&id2="+data2+"&id3="+data3+"&id4="+data4,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        // console.log();
                        $('#id_loc').val(data[0].id_location);    
                    }
                    else {
                        $('#id_loc').val('');    
                    }
                }
            });
        }

        $('#id_freez').on('change', function (){
            get_freez($('#id_freez').val(), $('#id_shelf').val(), $('#id_rack').val(), $('#id_tray').val())
        });
        $('#id_shelf').on('change', function (){
            get_freez($('#id_freez').val(), $('#id_shelf').val(), $('#id_rack').val(), $('#id_tray').val())
        });
        $('#id_rack').on('change', function (){
            get_freez($('#id_freez').val(), $('#id_shelf').val(), $('#id_rack').val(), $('#id_tray').val())
        });
        $('#id_tray').on('change', function (){
            get_freez($('#id_freez').val(), $('#id_shelf').val(), $('#id_rack').val(), $('#id_tray').val())
        });


        table = $("#mytable").DataTable({
            // initComplete: function() {
            //     var api = this.api();
            //     $('#mytable_filter input')
            //             .off('.DT')
            //             .on('keyup.DT', function(e) {
            //                 if (e.keyCode == 13) {
            //                     api.search(this.value).tray();
            //                 }
            //     });
            // },
            oLanguage: {
                sProcessing: "loading..."
            },
            // select: true;
            processing: true,
            serverSide: true,
            ajax: {"url": "Extraction_biosolid/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_sample"},
                {"data": "id_one_water_sample"},
                {"data": "initial"},
                {"data": "sampletype"},
                {"data": "date_extraction"},
                {"data": "weight"},
                // {"data": "volume"},
                {"data": "comments"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
			columnDefs: [
				{
					targets: [5], // Index of the 'estimate_price' column
					className: 'text-right' // Apply right alignment to this column
				}
			],
            order: [[1, 'desc']],
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                // var index = page * length + (iDisplayIndex + 1);
                // $('td:eq(0)', row).html(index);
            },
            // initComplete: function() {
            //     let api = this.api();
            //     let firstRow = api.row(0).node();
            //     $(firstRow).addClass('highlight');
            // }
            drawCallback: function(settings) {
                let api = this.api();
                let pageInfo = api.page.info();
                if (pageInfo.page === 0) {
                    let firstRow = api.row(0).node();
                    $(firstRow).addClass('highlight');
                }
            }
        });

        // Add modal reset for sample modal
        $('#compose-modal').on('hide.bs.modal', function () {
            // Reset form
            $(this).find('form')[0].reset();
            
            // Reset and hide other_kit field
            $('#other_kit').val('');
            $('#other-kit-group').hide();
            $('#other_kit').prop('required', false);
        });

        $('#addtombol').click(function() {
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Extraction biosolid | New<span id="my-another-cool-loader"></span>');
            // $('#project_idx').hide();
            $('#id_one_water_sample').attr('readonly', false);
            $('#id_one_water_sample').val('');
            $('#id_one_water_sample_list').val('');
            $('#id_one_water_sample').hide();
            $('#id_one_water_sample_list').show();
            $('#id_person').val('');
            $('#barcode_sample').attr('readonly', false);
            $('#barcode_sample').val('');
            $('#sampletype').attr('readonly', true);
            $('#sampletype').val('');
            // $('#date_extraction').val('');
            $('#weight').val('');
            // $('#volume').val('');
            // $('#dilution').val('');
            // $('#culture_plate').val('');
            // $('#culture_media').val('');
            $('#id_kit').val('');
            $('#kit_lot').val('');
            $('#barcode_tube').val('');
            $('#dna_concentration').val('');
            $('#cryobox').val('');
            $('#id_freez').val('');
            $('#id_shelf').val('');
            $('#id_rack').val('');
            $('#id_tray').val('');
            $('#id_row').val('');
            $('#id_col').val('');
            $('#comments').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square-o"></i> Extraction biosolid | Update<span id="my-another-cool-loader"></span>');
            // $('#project_idx').show();
            // $('#id_one_water_sample').attr('readonly', true);
            // $('#id_one_water_sample').show();
            // $('#id_one_water_sample_list').hide();
            // $('#id_one_water_sample').val(data.id_one_water_sample);
            // $('#id_one_water_sample_list').val(data.id_one_water_sample).trigger('change');
            $('#id_one_water_sample').hide();
            $('#idx_one_water_sample').attr('readonly', true);
            $('#idx_one_water_sample').val(data.id_one_water_sample);
            $('#id_person').val(data.id_person).trigger('change');
            $('#barcode_sample').attr('readonly', true);
            $('#barcode_sample').val(data.barcode_sample);
            $('#sampletype').attr('readonly', true);
            $('#sampletype').val(data.sampletype);
            $('#date_extraction').val(data.date_extraction).trigger('change');
            $('#weight').val(data.weight);
            // $('#volume').val(data.volume);
            // $('#dilution').val(data.dilution).trigger('change');
            // $('#culture_plate').val(data.culture_plate).trigger('change');
            // $('#culture_media').val(data.culture_media).trigger('change');
            $('#id_kit').val(data.id_kit).trigger('change');

            // Fill typedesc field if available
            $('#other_kit').val(data.other_kit || '');    
            // Trigger sample type change to show/hide typedesc field
            $('#id_kit').trigger('change');

            $('#kit_lot').val(data.kit_lot);
            $('#barcode_tube').val(data.barcode_tube);
            $('#dna_concentration').val(data.dna_concentration);
            $('#cryobox').val(data.cryobox);
            $('#id_freez').val(data.freezer);
            $('#id_shelf').val(data.shelf);
            $('#id_rack').val(data.rack);
            $('#id_tray').val(data.tray);
            $('#id_row').val(data.rows1);
            $('#id_col').val(data.columns1);
            // load_freez(data.id_location);
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
                    url: '<?php echo site_url('Extraction_biosolid/getReviewer'); ?>',
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

            // Allow both creators and non-creators to perform reviews
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
                    title: 'Review Data',
                    text: 'Are you sure you want to review this data?',
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

            // Display different messages for creators vs non-creators
            if (userCreated !== loggedInUser) {
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
            } else {
                if ($('#review').val() === '1') {
                    showReviewInfoCard(
                        '#textInformReview',
                        '<i class="fa fa-check-circle"></i> You are the creator',
                        "You have already reviewed this data as the creator.",
                        true
                    );
                } else {
                    showReviewInfoCard(
                        '#textInformReview',
                        '<i class="fa fa-check-circle"></i> You are the creator',
                        "You have full access to edit and review this data. Hover over the box on the top side to start the review.",
                        true
                    );
                }
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
                url: '<?php echo site_url('Extraction_biosolid/saveReview'); ?>',
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
                url: '<?php echo site_url('Extraction_biosolid/cancelReview'); ?>',
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

        // Handle Sample Type change to show/hide type description field
        $(document).on('change', '#id_kit', function() {
            let selectedOption = $(this).find('option:selected');
            let kitName = selectedOption.data('type');
            let other_kitGroup = $('#other-kit-group');
            let other_kitInput = $('#other_kit');

            // Show field for Other sample types
            if (kitName === 'Other') {
                other_kitGroup.slideDown(300);
                other_kitInput.prop('required', true);
            } else {
                other_kitGroup.slideUp(300);
                other_kitInput.prop('required', false);
                other_kitInput.val(''); // Clear the field when hidden
            }
        });

        // Initialize on page load
        $(document).ready(function() {
            $('#id_kit').trigger('change');
        });

        $('#mytable tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }
        })   
                            
    });
</script>