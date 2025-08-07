<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Processing | Campy Biosolids </h3>
                    </div>
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                            <!-- <?php
                                    $lvl = $this->session->userdata('id_user_level');
                                    if ($lvl != 4){
                                        echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Campy Biosolids</button>";
                                    }
                            ?>         -->
                            <?php echo anchor(site_url('Campy_biosolids/excel_all'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to XLS', 'class="btn btn-success"'); ?>
                        </div>
                            <div class="table-responsive">
                                <table class="table ho table-bordered table-striped tbody" id="mytable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID One Water Sample</th>
                                            <th>Lab Tech</th>
                                            <th>Sample Type</th>
                                            <th>Number Of Assay Tubes</th>
                                            <th>MPN PCR Conducted</th>
                                            <th>Campy Assay Barcode</th>
                                            <th>Date of Sample</th>
                                            <th>Time of Sample</th>
                                            <th>Sample Wet Weight</th>
                                            <th>Dry Weight (%)</th>
                                            <th>Sample Dry Weight</th>
                                            <th>Elution Volume</th>
                                            <th>Volume of Sample</th>
                                            <th width="120px">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .table tbody tr.selected {
        color: white !important;
        background-color: #9CDCFE !important;
    }
    .highlight {
        background-color: rgba(0, 255, 0, 0.1) !important;
        font-weight: bold !important;
    }
    .highlight-edit {
        background-color: rgba(0, 0, 255, 0.1) !important;
        font-weight: bold !important;
    }
</style>

<!-- MODAL FORM -->

    <div class="modal fade"  id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-scrollable="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                    <h4 class="modal-title" id="modal-title">Moisture Content | New</h4>
                </div>
                <form id="formSample" action="<?php echo site_url('Campy_biosolids/save') ?>" method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <input id="id_campy_biosolids" name="id_campy_biosolids" type="hidden" class="form-control input-sm">
                        
                        <!-- <div class="form-group">
                            <label for="id_one_water_sample" class="col-sm-4 control-label">One Water Sample ID</label>
                            <div class="col-sm-8">
                                <input id="idx_one_water_sample" name="idx_one_water_sample" placeholder="One Water Sample ID" type="text" class="form-control">
                                <select id="id_one_water_sample" name="id_one_water_sample" class="form-control idOneWaterSampleSelect" required>
                                    <option value="" disabled>-- Select Sample ID --</option>
                                    <?php
                                            foreach($id_one as $row) {
                                                if ($id_one_water_sample == $row['id_one_water_sample']) {
                                                    echo "<option value='".$row['id_one_water_sample']."' selected='selected'>".$row['id_one_water_sample']."</option>";
                                                } else {
                                                    echo "<option value='".$row['id_one_water_sample']."'>".$row['id_one_water_sample']."</option>";
                                                }
                                            }
                                    ?>
                                </select>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label for="id_one_water_sample" class="col-sm-4 control-label">One Water Sample ID</label>
                            <div class="col-sm-8">
                                <input id="id_one_water_sample" name="id_one_water_sample" placeholder="One Water Sample ID" type="text" class="form-control idOneWaterSampleSelect">
                                <input id="idx_one_water_sample" name="idx_one_water_sample" placeholder="One Water Sample ID" type="text" class="form-control">
                                <div class="val2tip" style="height: 1px; margin-top: 5px;"></div>
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
                            <label for="number_of_tubes" class="col-sm-4 control-label">Number of Assay Tubes</label>
                            <div class="col-sm-8">
                                <input id="number_of_tubes1" name="number_of_tubes1" type="hidden" class="form-control input-sm">
                                <select id="number_of_tubes" name="number_of_tubes" class="form-control" required>
                                    <option value="" disabled>-- Select Number of Tubes --</option>
                                    <?php
                                          foreach($tubes as $row) {
                                            echo "<option value='".$row['value']."'>".$row['value']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="mpn_pcr_conducted">
                            <label class="col-sm-4 control-label">MPN PCR Conducted</label>
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <input type="radio" name="mpn_pcr_conducted" value="Yes" required> Yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="mpn_pcr_conducted" value="No" required> No
                                </label>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="campy_assay_barcode" class="col-sm-4 control-label">Campy Assay Barcode</label>
                            <div class="col-sm-8">
                                <input id="campy_assay_barcode" name="campy_assay_barcode" placeholder="Campy Assay Barcode" type="text" class="form-control" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_sample_processed" class="col-sm-4 control-label">Date Sample Processed</label>
                            <div class="col-sm-8">
                                <input id="date_sample_processed" name="date_sample_processed" type="date" class="form-control" placeholder="Date Sample Processed" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time_sample_processed" class="col-sm-4 control-label">Time Sample Processed</label>
                            <div class="col-sm-8">
                                <div class="input-group clockpicker">
                                    <input id="time_sample_processed" name="time_sample_processed" class="form-control" placeholder="Time Sample Processed" value="<?php echo (new DateTime())->format('H:i'); ?>">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sample_wetweight" class="col-sm-4 control-label">Sample Wet Weight(g)</label>
                            <div class="col-sm-8">
                                <input id="sample_wetweight" name="sample_wetweight" type="number" step="any" class="form-control" placeholder="Sample Wet Weight(g)" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dry_weight_persen" class="col-sm-4 control-label">Dry Weight (%)</label>
                            <div class="col-sm-8">
                                <input id="dry_weight_persen" name="dry_weight_persen" type="number" step="any" class="form-control" placeholder="Dry Weight (%)" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sample_dryweight" class="col-sm-4 control-label">Sample Dry Weight(g)</label>
                            <div class="col-sm-8">
                                <input id="sample_dryweight" name="sample_dryweight" type="number" step="any" class="form-control" placeholder="Sample Dry Weight(g)" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="elution_volume" class="col-sm-4 control-label">Elution Volume(mL)</label>
                            <div class="col-sm-8">
                                <input id="elution_volume" name="elution_volume" type="number" step="any" class="form-control" placeholder="Elution Volume(mL)" required>
                            </div>
                        </div>

                        <!-- <div class="form-group" id="sampleTubeContainer">
                            <label class="col-sm-4 control-label">Volume of The Sample(uL)</label>
                            <div class="col-sm-8" id="sampleVolumeInputs">
                                <input id="vol_sampletube1" name="vol_sampletube1" type="number" step="0.01" class="form-control" placeholder="Volume of The Sample(uL) Tube1" required>
                            </div>
                        </div> -->
                        <div class="form-group" id="sampleTubeContainer">
                            <label class="col-sm-4 control-label">Volume of The Sample(mL)</label>
                            <div class="col-sm-8" id="sampleVolumeInputs">
                                <input id="vol_sampletube1" name="vol_sampletube1" type="number" step="any" class="form-control" placeholder="Volume of The Sample(mL) Tube1" required>
                            </div>
                        </div>

                        <!-- <div class="form-group d-flex align-items-center" style="margin-bottom: 18px;">
                            <label for="review" class="col-sm-4 control-label" style="margin-bottom:0;">Status</label>
                            <div class="col-sm-8 d-flex align-items-center" style="gap: 12px;">
                                <input type="hidden" id="review" name="review" value="0">
                                <button id="review_label" type="button" class="form-check-label unreview" style="min-width: 80px; text-align:center;">
                                    <i class="fa fa-times-circle"></i> Unreview
                                </button>
                                <?php if (in_array($this->session->userdata('id_user_level'), [1, 2])): ?>
                                    <button type="button" class="btn btn-danger ms-3 btn-sm" id="cancelReviewBtn">
                                        <i class="fa fa-times-circle"></i> Cancel Review
                                    </button>
                                <?php endif; ?>
                                <span id="reviewed_by_label" style="font-style: italic; font-weight: bold; font-size: 12px; color: #3c8dbc;">
                                </span>
                            </div>
                        </div> -->

                    </div>

                    <div class="modal-footer clearfix">
                        <!-- Info Card on the left side -->
                        <!-- <div class="modal-footer-content" style="flex: 1; display: flex; align-items: center;">
                            <div id="textInform2" class="textInform card" style="width: auto; padding: 5px 10px; display: none;">
                                <div class="card-body">
                                    <div class="card-header">
                                        <h5 class="card-title statusMessage"></h5>
                                        <i class="fa fa-times close-card" style="float: right; cursor: pointer;"></i>
                                    </div>
                                    <p class="statusDescription"></p>
                                </div>
                            </div>
                        </div> -->

                        <!-- Buttons on the right side -->
                     
                            <!-- <button type="submit" class="btn btn-primary" id="saveButtonDetail"><i class="fa fa-save"></i> Save</button>
                            <button type="button" class="btn btn-warning" id="cancelButton" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button> -->
                            <button type="submit" class="btn btn-primary" id="saveButtonDetail" style="min-width: 100px; padding: 8px 16px; font-weight: 500; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,123,255,0.2); transition: all 0.3s ease;">
                                <i class="fa fa-save" style="margin-right: 6px;"></i> Save
                            </button>
                            <button type="button" class="btn btn-warning" id="cancelButton" data-dismiss="modal" style="min-width: 100px; padding: 8px 16px; font-weight: 500; border-radius: 6px; box-shadow: 0 2px 4px rgba(255,193,7,0.2); transition: all 0.3s ease;">
                                <i class="fa fa-times" style="margin-right: 6px;"></i> Cancel
                            </button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->        


<!-- MODAL CONFIRMATION DELETE -->
<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Campy Biosolids | Delete <span id="my-another-cool-loader"></span></h4>
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
    .table tbody tr.selected {
        color: white !important;
        background-color: #9CDCFE !important;
    }
    .highlight {
        background-color: rgba(0, 255, 0, 0.1) !important;
        font-weight: bold !important;
    }
    .highlight-edit {
        background-color: rgba(0, 0, 255, 0.1) !important;
        font-weight: bold !important;
    }
        /* Basic button style for the span */
        .form-check-label {
        display: inline-block;
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 12px;
        cursor: pointer;
        text-align: center;
        transition: all 0.3s ease;
    }

    /* Hover effect for the button */
    .form-check-label:hover {
        opacity: 0.8;
    }

    /* Focused effect to make it more accessible */
    .form-check-label:focus {
        outline: none;
    }

    .child-table {
        margin-left: 50px;
        width: 90%;
        border-collapse: collapse;
    }

    .child-table th, .child-table td {
        border: 1px solid #ddd;
        padding: 5px;
    }

    /* Styling untuk container dengan scroll */
    .child-table-container {
        max-height: 500px; /* Atur tinggi maksimal sesuai kebutuhan */
        overflow-y: auto;  /* Aktifkan scroll vertikal */
    }

    /* Style untuk scrollbar itu sendiri */
    .child-table-container::-webkit-scrollbar {
        width: 6px; /* Lebar scrollbar */
    }

    /* Style untuk track (background) scrollbar */
    .child-table-container::-webkit-scrollbar-track {
        background: #e0f2f1; /* Warna hijau toska muda sebagai background track */
        border-radius: 10px; /* Membuat track lebih halus */
    }

    /* Style untuk thumb (pegangan scrollbar) */
    .child-table-container::-webkit-scrollbar-thumb {
        background: #9ACBD0; /* Warna hijau toska gelap untuk thumb scrollbar */
        border-radius: 10px; /* Membuat thumb lebih halus */
    }

    /* Gaya saat thumb scrollbar di-hover */
    .child-table-container::-webkit-scrollbar-thumb:hover {
        background: #48A6A7; /* Warna hijau toska yang lebih gelap saat hover */
    }

    .badge {
        font-size: 14px;
        padding: 8px 12px;
        border-radius: 20px;
        margin-top: 0px;
    }

    .badge-success {
        background-color: #6A9C89;
        color: white;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
    }

    .alert {
        padding: 8px 12px;
        border-radius: 5px;
        font-size: 14px;
        margin-top: 0px;
    }

    .alert-success {
        background-color: #6A9C89;
        color: white;
    }

    .alert-danger {
        background-color: #dc3545;
        color: white;
    }

    .card {
        border-radius: 10px;
        margin-top: 0px;
        padding: 8px 12px;
        width: 100%; /* Ensures card uses available space */
    }

    .card-success {
        border: 1px solid #28a745;
        background-color: #d4edda;
    }

    .card-danger {
        border: 1px solid #dc3545;
        background-color: #f8d7da;
    }

    .card-title {
        font-size: 16px;
        font-weight: bold;
        text-align: left; /* Align title to the left */
        margin-bottom: 0px;
    }

    .card-body {
        font-size: 14px;
        text-align: left; /* Align body text to the left */
    }

    .modal-footer-content {
        float: left;
        width: auto;
        margin-right: 10px;
    }

    .modal-buttons {
        float: right;
    }

    .icon-success {
        color: #28a745;
        margin-right: 10px;
    }

    .icon-fail {
        color: #dc3545;
        margin-right: 10px;
    }

    .modal-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 15px;
    }

    .modal-footer-content {
        flex: 1;
        display: flex;
        align-items: center;
    }

    .modal-buttons {
        display: flex;
        align-items: center;
    }

    .card-body {
        padding: 0px;
    }

    .card-title {
        font-size: 16px;
        font-weight: bold;
    }

    .card-description {
        font-size: 14px;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .close-card {
        cursor: pointer;
        font-size: 18px;
        color: #FDAB9E;  /* Red color for close icon */
    }

    .close-card:hover {
        color: #bd2130; /* Darker red when hovered */
    }

    .unreview {
        color: white !important;
        background-color: gray !important;
        border-color: gray !important;
        box-shadow: none; /* Override Bootstrap box-shadow */
    }

    /* input.form-check-label. */
    .review {
        color: green !important;
        border-color: green !important;
    }

    #review_label.review-hoverable {
        transition: all 0.2s ease-in-out  !important;
        box-shadow: 0 0 4px rgba(0, 128, 0, 0.3)  !important;
    }

    #review_label.review-hoverable:hover {
        border: 1px solid green !important;
        background-color: white  !important;
        color: green  !important;
        padding: 4px 8px  !important;
        border-radius: 4px  !important;
        cursor: pointer  !important;
    }


</style>
<style>
    #review_label {
        cursor: pointer;
        font-size: 14px;  /* Ukuran font untuk label */
        position: relative;
        z-index: 10;  /* Atur nilai z-index yang lebih tinggi */
        pointer-events: auto;  /* Pastikan elemen ini dapat menerima klik */
    }

    #reviewed_by_label {
        margin-left: 10px;
        font-style: italic;
        font-weight: bold;
        font-size: 12px;  /* Ukuran font kecil untuk input reviewer */
    }

    .d-flex {
        display: flex;
        align-items: center;
    }

    .ms-2 {
        margin-left: 0.5rem;  /* Spacing antar elemen */
    }

    .table tbody tr.selected {
        color: white !important;
        background-color: #9CDCFE !important;
    }

    #formKegHidden {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1;
    }

    .hidden {
        visibility: hidden;
        position: absolute;
        width: 0;
        height: 0;
        overflow: hidden;
    }
    .sample-input {
        margin-bottom: 10px; /* Adjust the spacing as needed */
    }

    .modal {
    overflow-y: auto;
    }

    .modal-body {
    max-height: 80vh;
    overflow-y: auto;
    }

    .badge {
        font-size: 14px;
        padding: 8px 12px;
        border-radius: 20px;
        margin-top: 0px;
    }

    .badge-success {
        background-color: #6A9C89;
        color: white;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
    }

    .alert {
        padding: 8px 12px;
        border-radius: 5px;
        font-size: 14px;
        margin-top: 0px;
    }

    .alert-success {
        background-color: #6A9C89;
        color: white;
    }

    .alert-danger {
        background-color: #dc3545;
        color: white;
    }

    .card {
        border-radius: 10px;
        margin-top: 0px;
        padding: 8px 12px;
        width: 100%; /* Ensures card uses available space */
    }

    .card-success {
        border: 1px solid #28a745;
        background-color: #d4edda;
    }

    .card-danger {
        border: 1px solid #dc3545;
        background-color: #f8d7da;
    }

    .card-title {
        font-size: 16px;
        font-weight: bold;
        text-align: left; /* Align title to the left */
        margin-bottom: 0px;
    }

    .card-body {
        font-size: 14px;
        text-align: left; /* Align body text to the left */
    }

    .modal-footer-content {
        float: left;
        width: auto;
        margin-right: 10px;
    }

    .modal-buttons {
        float: right;
    }

    .icon-success {
        color: #28a745;
        margin-right: 10px;
    }

    .icon-fail {
        color: #dc3545;
        margin-right: 10px;
    }

    .modal-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 15px;
    }

    .modal-footer-content {
        flex: 1;
        display: flex;
        align-items: center;
    }

    .modal-buttons {
        display: flex;
        align-items: center;
    }

    .card-body {
        padding: 0px;
    }

    .card-title {
        font-size: 16px;
        font-weight: bold;
    }

    .card-description {
        font-size: 14px;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .close-card {
        cursor: pointer;
        font-size: 18px;
        color: #FDAB9E; 
    }

    .close-card:hover {
        color: #bd2130; 
    }

    .unreview {
        color: white !important;
        border-color: gray !important;
        box-shadow: none; 
    }

    /* input.form-check-label. */
    .review {
        color: white !important;
        background-color: #3D8D7A;
		border: none  !important;
    }

    .highlight {
        background-color: rgba(0, 255, 0, 0.1) !important;
        font-weight: bold !important;
    }
    .highlight-edit {
        background-color: rgba(0, 0, 255, 0.1) !important;
        font-weight: bold !important;
    }
        /* Basic button style for the span */
        .form-check-label {
        display: inline-block;
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 12px;
        cursor: pointer;
        text-align: center;
        transition: all 0.3s ease;
    }

    /* Hover effect for the button */
    .form-check-label:hover {
        opacity: 0.8;
    }

    /* Focused effect to make it more accessible */
    .form-check-label:focus {
        outline: none;
    }

    .child-table {
        margin-left: 50px;
        width: 90%;
        border-collapse: collapse;
    }

    .child-table th, .child-table td {
        border: 1px solid #ddd;
        padding: 5px;
    }

    /* Styling untuk container dengan scroll */
    .child-table-container {
        max-height: 500px; 
        overflow-y: auto; 
    }

    /* Style untuk scrollbar itu sendiri */
    .child-table-container::-webkit-scrollbar {
        width: 6px; 
    }

    /* Style untuk track (background) scrollbar */
    .child-table-container::-webkit-scrollbar-track {
        background: #e0f2f1;
        border-radius: 10px;
    }

    /* Style untuk thumb (pegangan scrollbar) */
    .child-table-container::-webkit-scrollbar-thumb {
        background: #9ACBD0; 
        border-radius: 10px; 
    }

    /* Gaya saat thumb scrollbar di-hover */
    .child-table-container::-webkit-scrollbar-thumb:hover {
        background: #48A6A7;
    }

	.review-border {
		border: 1px solid green  !important;
		color: green  !important;
	}
</style>
<style>
	#textInform2 .alert {
        display: block !important;
        margin-top: 20px;
        font-size: 16px;
        z-index: 1000; /* Pastikan info card di atas elemen lain */
    }

    /* Enhanced Button Styling */
    .modal-footer .btn {
        transition: all 0.3s ease !important;
        border: none !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 13px;
    }

    .modal-footer .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2) !important;
    }

    .modal-footer .btn:active {
        transform: translateY(0);
        box-shadow: 0 2px 4px rgba(0,0,0,0.2) !important;
    }

    .modal-footer .btn-primary:hover {
        background-color: #0056b3 !important;
        box-shadow: 0 4px 8px rgba(0,123,255,0.3) !important;
    }

    .modal-footer .btn-warning:hover {
        background-color: #e0a800 !important;
        box-shadow: 0 4px 8px rgba(255,193,7,0.3) !important;
    }
</style>

<!-- SweetAlert2 CSS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    let table;
    let deleteUrl; // Variable to hold the delete URL

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

        if (barcodeFromUrl && idOneWaterSampleFromUrl) {
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Campy Biosolids | New<span id="my-another-cool-loader"></span>');
            // $('#id_one_water_sample').val('');
            // $('#id_one_water_sample').show();
            // $('#idx_one_water_sample').hide();
            $('#id_one_water_sample').attr('readonly', true);
            $('#id_one_water_sample').val(idOneWaterSampleFromUrl || '');  // Set ID jika ada);
            $('#idx_one_water_sample').hide();
            $('#id_person').val('');
            $('#number_of_tubes').val('');
            $('#number_of_tubes').prop('disabled', false);
            $('#campy_assay_barcode').val(barcodeFromUrl);
            $('#campy_assay_barcode').attr('readonly', true);
            $('#sampletype').val('');
            $('#sampletype').attr('readonly', true);
            $('#tray_weight').val('');
            $('#traysample_wetweight').val('');
            $('#dry_weight_persen').val('');
            $('#sample_dryweight').val('');
            $('#comments').val('');
            $('#mpn_pcr_conducted').val('');
            // let sampleVolumeInputs = $('#sampleVolumeInputs');
            // if (sampleVolumeInputs.children().length > 1) {
            //     sampleVolumeInputs.empty();
            //     sampleVolumeInputs.append('<input id="vol_sampletube1" name="vol_sampletube1" type="number" step="0.01" class="form-control sample-input" placeholder="Volume of The Sample(uL) Tube1" disabled required>');
            // }
            $('#barcode_moisture_content').val('');
            $('#compose-modal').modal('show');
        } else {
            console.log('Barcode tidak ditemukan di URL');
        }

        // Pembatalan dan kembali ke halaman sebelumnya
        // $(document).on('click', '#cancelButton', function() {
        //     // Ambil URL asal dari document.referrer (halaman yang mengarah ke halaman ini)
        //     var previousUrl = document.referrer;
            
        //     // Jika ada URL asal, arahkan kembali ke sana
        //     if (previousUrl) {
        //         window.location.href = previousUrl;
        //     } 
        // });
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

        $('#compose-modal').on('hide.bs.modal', function () {
            $(this).find('input[type="radio"]').prop('checked', false); // Reset semua radio button
        });


        // $('#number_of_tubes').change(function() {
        //     let numberOfTubes = parseInt($(this).val()); // Get the selected value as an integer
        //     let sampleVolumeInputs = $('#sampleVolumeInputs');
        //     sampleVolumeInputs.empty(); // Clear existing inputs

        //     // Create the required number of inputs and labels
        //     for (let i = 1; i <= numberOfTubes; i++) {
        //         sampleVolumeInputs.append(
        //             `<div class="form-group">
        //                 <label for="vol_sampletube${i}" class="control-label">Volume of The Sample(uL) Tube ${i}</label>
        //                 <input id="vol_sampletube${i}" name="vol_sampletube${i}" type="number" step="0.01" class="form-control sample-input" placeholder="Volume of The Sample(uL) Tube ${i}" required>
        //             </div>`
        //         );
        //     }
        // }).trigger('change');

        $('#number_of_tubes').change(function() {
            let numberOfTubes = parseInt($(this).val()); // Get the selected value as an integer
            let sampleVolumeInputs = $('#sampleVolumeInputs');
            sampleVolumeInputs.empty(); // Clear existing inputs

            // Create the required number of inputs and labels
            for (let i = 1; i <= numberOfTubes; i++) {
                sampleVolumeInputs.append(
                    `<div class="form-group">
                        <label for="vol_sampletube${i}" class="col-sm control-label">Tube ${i}</label>
                        <div class="col-sm-8">
                            <input id="vol_sampletube${i}" name="vol_sampletube${i}" type="number" step="0.01" class="form-control sample-input" placeholder="Volume of The Sample(mL) Tube ${i}" required>
                        </div>
                    </div>`
                );
            }
        }).trigger('change');

        // Function to calculate sample dry weight
        function calculateSampleDryWeight() {
            let sampleWetweight = parseFloat($('#sample_wetweight').val()) || 0;
            let dryWeightPersen = parseFloat($('#dry_weight_persen').val()) || 0;
            
            if (sampleWetweight > 0 && dryWeightPersen > 0) {
                // Calculate Sample Dry Weight = sample_wetweight * dry_weight_persen / 100
                let sampleDryweight = (sampleWetweight * dryWeightPersen / 100).toFixed(4);
                $('#sample_dryweight').val(sampleDryweight);
            } else {
                $('#sample_dryweight').val('');
            }
        }

        // Add event listeners for auto-calculation
        $('#sample_wetweight, #dry_weight_persen').on('input', function() {
            calculateSampleDryWeight();
        });


        function showConfirmation(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_deleteCampyBiosolids', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('Campy_biosolids/delete_campyBiosolids'); ?>/' + id;
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

        // Replace the existing tooltipster initialization with this:
        $('.val1tip').tooltipster({
            animation: 'swing',
            delay: 1,
            theme: 'tooltipster-default',
            autoClose: true,
            position: 'bottom',
            side: 'bottom'
        });

        $('.val2tip').tooltipster({
            animation: 'swing',
            delay: 1,
            theme: 'tooltipster-default',
            autoClose: true,
            position: 'bottom',
            side: 'bottom',
            distance: 10 // Add some distance from the input field
        });

        $('.val3tip').tooltipster({
            animation: 'swing',
            delay: 1,
            theme: 'tooltipster-default',
            autoClose: true,
            position: 'bottom',
            side: 'bottom'
        });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
        });        

        $('#compose-modal').on('shown.bs.modal', function () {
			$('#id_client_sample').focus();
            });
    

        $("input").keypress(function(){
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
        });

        $("input").click(function(){
            setTimeout(function(){
                $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
            }, 3000);                            
        });

        $("input").keypress(function(){
            $('.val1tip').tooltipster('hide');   
        });

        $("input").click(function(){
            setTimeout(function(){
                $('.val1tip').tooltipster('hide');   
            }, 3000);                            
        });

        $('.idOneWaterSampleSelect').change(function() {
            let id_one_water_sample = $(this).val(); // Mendapatkan ID produk yang dipilih
            console.log('test'+ id_one_water_sample)
            if (id_one_water_sample) {
                $.ajax({
                    url: '<?php echo site_url('Campy_biosolids/getIdOneWaterDetails'); ?>', // URL untuk request AJAX
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
                url: "Campy_biosolids/barcode_restrict?id1="+id_one_water_sample,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        // Destroy existing tooltip and recreate with proper positioning
                        $('.val2tip').tooltipster('destroy');
                        $('.val2tip').tooltipster({
                            animation: 'swing',
                            delay: 1,
                            theme: 'tooltipster-default',
                            autoClose: true,
                            side: 'bottom',
                            distance: 15,
                            minWidth: 300
                        });
                        
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Id One Water Sample <strong> ' + id_one_water_sample +'</strong> is already in the system !</span>');
                        $('.val2tip').tooltipster('content', tip);
                        $('.val2tip').tooltipster('show');
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
                }
            });
        }).trigger('change');

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
			$('#id_client_sample').focus();
            // $('#budget_req').on('input', function() {
            //     formatNumber(this);
            //     });
            });
    

        $("input").keypress(function(){
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
        });

        $("input").click(function(){
            setTimeout(function(){
                $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
            }, 3000);                            
        });

        $("input").keypress(function(){
            $('.val1tip').tooltipster('hide');   
        });

        $("input").click(function(){
            setTimeout(function(){
                $('.val1tip').tooltipster('hide');   
            }, 3000);                            
        });

        $('#campy_assay_barcode').on("change", function() {
            let campyAssayBarcode = $('#campy_assay_barcode').val();
            console.log(campyAssayBarcode);
            $.ajax({
                type: "GET",
                url: "Campy_biosolids/validateCampyAssayBarcode",
                data: { id: campyAssayBarcode },
                dataType: "json",
                success: function(data) {
                    if (data.length == 1) {
                        let tip = $('<span><i class="fa fa-exclamation-triangle"></i> Campy Assay Barcode <strong> ' + campyAssayBarcode +'</strong> is already in the system !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#campy_assay_barcode').focus();
                        $('#campy_assay_barcode').val('');       
                        $('#campy_assay_barcode').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#campy_assay_barcode').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#campy_assay_barcode').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#campy_assay_barcode').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    } else if (/[^a-zA-Z0-9]/.test(campyAssayBarcode)) {
                        let tip = $('<span><i class="fa fa-exclamation-triangle"></i>  Wrong type <strong>' + campyAssayBarcode +'</strong> Input must not contain symbols !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#campy_assay_barcode').focus();
                        $('#campy_assay_barcode').val('');
                        $('#campy_assay_barcode').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#campy_assay_barcode').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#campy_assay_barcode').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#campy_assay_barcode').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
        });

        let base_url = location.hostname;
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
            ajax: {"url": "Campy_biosolids/json", "type": "POST"},
            columns: [
                {"data": "id_one_water_sample"},
                {"data": "initial"},
                {"data": "sampletype"},
                {"data": "number_of_tubes"},
                {"data": "mpn_pcr_conducted"},
                {"data": "campy_assay_barcode"},
                {"data": "date_sample_processed"},
                {"data": "time_sample_processed"},
                {"data": "sample_wetweight"},
                {"data": "dry_weight_persen"},
                {"data": "sample_dryweight"},
                {"data": "elution_volume"},
                {"data": "vol_sampletube"},
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
            drawCallback: function(settings) {
                let api = this.api();
                let pageInfo = api.page.info();
                
                // Highlight baris yang baru saja ditambahkan atau diperbarui
                api.rows().every(function() {
                    let data = this.data();
                    let createdDate = new Date(data.date_created);
                    let updatedDate = new Date(data.date_updated);
                    let now = new Date();

                    // Highlight jika baru ditambahkan atau diperbarui dalam 10 detik terakhir
                    if (now - createdDate < 10 * 1000) {
                        $(this.node()).addClass('highlight');
                    } else if (now - updatedDate < 10 * 1000) {
                        $(this.node()).addClass('highlight-edit');
                    }
                });
                
                // Pastikan baris pertama di-highlight jika tabel tidak kosong
                if (pageInfo.page === 0 && api.rows().count() > 0) {
                    let firstRow = api.row(0).node();
                    $(firstRow).addClass('highlight');
                }
            }
        });

        // Event handler untuk klik pada baris
        $('#mytable tbody').on('click', 'tr', function() {
            let rowData = table.row(this).data();
            let rowId = rowData.id_campy_biosolids;
            $(this).removeClass('highlight');
            $(this).removeClass('highlight-edit');
        });

        $('#addtombol').click(function() {
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Campy Biosolids | New<span id="my-another-cool-loader"></span>');
            $('#id_one_water_sample').val('');
            $('#id_one_water_sample').show();
            $('#idx_one_water_sample').hide();
            $('#id_person').val('');
            $('#number_of_tubes').val('');
            $('#number_of_tubes').prop('disabled', false);
            $('#campy_assay_barcode').val('');
            $('#campy_assay_barcode').attr('readonly', false);
            $('#sampletype').val('');
            $('#sampletype').attr('readonly', true);
            $('#tray_weight').val('');
            $('#traysample_wetweight').val('');
            $('#dry_weight_persen').val('');
            $('#sample_dryweight').val('');
            $('#comments').val('');
            $('#mpn_pcr_conducted').val('');
            let sampleVolumeInputs = $('#sampleVolumeInputs');
            if (sampleVolumeInputs.children().length > 1) {
                sampleVolumeInputs.empty();
                sampleVolumeInputs.append('<input id="vol_sampletube1" name="vol_sampletube1" type="number" step="0.01" class="form-control sample-input" placeholder="Volume of The Sample(uL) Tube1" disabled required>');
            }
            $('#barcode_moisture_content').val('');
            $('#compose-modal').modal('show');
        });

        // $('#mytable').on('click', '.btn_edit', function(){
        //     let tr = $(this).parent().parent();
        //     let data = table.row(tr).data();
        //     console.log(data);
        //     $('#mode').val('edit');
        //     $('#modal-title').html('<i class="fa fa-pencil-square"></i> Campy Biosolids | Update<span id="my-another-cool-loader"></span>');
        //     $('#id_campy_biosolids').val(data.id_campy_biosolids);
        //     // $('#id_one_water_sample').hide();
        //     // $('#idx_one_water_sample').show();
        //     // $('#idx_one_water_sample').attr('readonly', true);
        //     // $('#idx_one_water_sample').val(data.id_one_water_sample);
        //     $('#id_campy_liquids').val(data.id_campy_liquids);
        //     $('#id_one_water_sample').hide();
        //     $('#idx_one_water_sample').attr('readonly', true);
        //     $('#idx_one_water_sample').val(data.id_one_water_sample);
        //     $('#id_person').val(data.id_person);
        //     $('#date_start').val(data.date_start);
        //     $('#id_sampletype').val(data.id_sampletype);
        //     $('#sampletype').attr('readonly', true);
        //     $('#sampletype').on('input', function() {
        //         if ($(this).val().toLowerCase() === "soil") {
        //             $('#tray_weight_container').show();
        //         } else {
        //             $('#tray_weight_container').hide();
        //         }
        //     }).val(data.sampletype).trigger('input');
        //     $('#tray_weight').val(data.tray_weight);
        //     // Set radio button value
        //     if (data.mpn_pcr_conducted === 'Yes') {
        //         $('#mpn_pcr_conducted input[type="radio"][value="Yes"]').prop('checked', true);
        //     } else if (data.mpn_pcr_conducted === 'No') {
        //         $('#mpn_pcr_conducted input[type="radio"][value="No"]').prop('checked', true);
        //     }
        //     $('#campy_assay_barcode').val(data.campy_assay_barcode);
        //     $('#campy_assay_barcode').attr('readonly', true);
        //     $('#date_sample_processed').val(data.date_sample_processed);
        //     $('#time_sample_processed').val(data.time_sample_processed);
        //     $('#sample_wetweight').val(data.sample_wetweight);
        //     $('#elution_volume').val(data.elution_volume);
        //     $('#number_of_tubes').val(data.number_of_tubes);
        //     $('#number_of_tubes').prop('disabled', true);
        //     $('#number_of_tubes1').val(data.number_of_tubes);
        //     // Clear existing sample volume inputs
        //     let sampleVolumeInputs = $('#sampleVolumeInputs');
        //     sampleVolumeInputs.empty();

        //     // Pecah data vol_sampletube dan tube_number
        //     const volSampletubeArray = data.vol_sampletube.split(', ');
        //     const tubeNumberArray = data.tube_number.split(', ');

        //     // Buat input berdasarkan tube_number
        //     tubeNumberArray.forEach((tubeNumber, index) => {
        //         const volume = volSampletubeArray[index] || ''; // Dapatkan volume yang sesuai atau kosong jika tidak ada
        //         sampleVolumeInputs.append(
        //             `<div class="form-group">
        //                 <label for="vol_sampletube${tubeNumber}" class="col-sm control-label">Tube ${tubeNumber}</label>
        //                 <div class="col-sm-8">
        //                     <input id="vol_sampletube${tubeNumber}" name="vol_sampletube${tubeNumber}" type="number" step="0.01" class="form-control sample-input" placeholder="Volume of The Sample(mL) Tube ${tubeNumber}" value="${volume}" required>
        //                 </div>
        //             </div>`
        //         );
        //     });
        //     $('#comments').val(data.comments);
        //     $('#barcode_moisture_content').val(data.barcode_moisture_content);
        //     $('#compose-modal').modal('show');
        // });  
        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            let loggedInUser = '<?php echo $this->session->userdata('id_users'); ?>';
            console.log(data);
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Campy Biosolids | Update<span id="my-another-cool-loader"></span>');
            $('#id_campy_biosolids').val(data.id_campy_biosolids);
            // $('#id_one_water_sample').hide();
            // $('#idx_one_water_sample').show();
            // $('#idx_one_water_sample').attr('readonly', true);
            // $('#idx_one_water_sample').val(data.id_one_water_sample);
            $('#id_campy_liquids').val(data.id_campy_liquids);
            $('#id_one_water_sample').hide();
            $('#idx_one_water_sample').attr('readonly', true);
            $('#idx_one_water_sample').val(data.id_one_water_sample);
            $('#id_person').val(data.id_person);
            $('#date_start').val(data.date_start);
            $('#id_sampletype').val(data.id_sampletype);
            $('#sampletype').attr('readonly', true);
            $('#sampletype').on('input', function() {
                if ($(this).val().toLowerCase() === "soil") {
                    $('#tray_weight_container').show();
                } else {
                    $('#tray_weight_container').hide();
                }
            }).val(data.sampletype).trigger('input');
            $('#tray_weight').val(data.tray_weight);
            // Set radio button value
            if (data.mpn_pcr_conducted === 'Yes') {
                $('#mpn_pcr_conducted input[type="radio"][value="Yes"]').prop('checked', true);
            } else if (data.mpn_pcr_conducted === 'No') {
                $('#mpn_pcr_conducted input[type="radio"][value="No"]').prop('checked', true);
            }
            $('#campy_assay_barcode').val(data.campy_assay_barcode);
            $('#campy_assay_barcode').attr('readonly', true);
            $('#date_sample_processed').val(data.date_sample_processed);
            $('#time_sample_processed').val(data.time_sample_processed);
            $('#sample_wetweight').val(data.sample_wetweight);
            $('#dry_weight_persen').val(data.dry_weight_persen);
            $('#sample_dryweight').val(data.sample_dryweight);
            $('#elution_volume').val(data.elution_volume);
            $('#number_of_tubes').val(data.number_of_tubes);
            $('#number_of_tubes').prop('disabled', true);
            $('#number_of_tubes1').val(data.number_of_tubes);
            // Clear existing sample volume inputs
            let sampleVolumeInputs = $('#sampleVolumeInputs');
            sampleVolumeInputs.empty();

            // Pecah data vol_sampletube dan tube_number
            const volSampletubeArray = data.vol_sampletube.split(', ');
            const tubeNumberArray = data.tube_number.split(', ');

            // Buat input berdasarkan tube_number
            tubeNumberArray.forEach((tubeNumber, index) => {
                const volume = volSampletubeArray[index] || ''; // Dapatkan volume yang sesuai atau kosong jika tidak ada
                sampleVolumeInputs.append(
                    `<div class="form-group">
                        <label for="vol_sampletube${tubeNumber}" class="col-sm control-label">Tube ${tubeNumber}</label>
                        <div class="col-sm-8">
                            <input id="vol_sampletube${tubeNumber}" name="vol_sampletube${tubeNumber}" type="number" step="0.01" class="form-control sample-input" placeholder="Volume of The Sample(mL) Tube ${tubeNumber}" value="${volume}" required>
                        </div>
                    </div>`
                );
            });
            // Fill other fields
            $('#comments').val(data.comments);
            $('#review').val(data.review);
            $('#user_review').val(data.user_review);
            $('#reviewed_by_label').text('Reviewed by: ' + (data.full_name || '-'));

            // === Review logic ===
            const reviewStates = [
                { value: 0, label: "Unreview", class: "form-check-label unreview" },
                { value: 1, label: "Review", class: "form-check-label review" }
            ];

            let currentState = parseInt(data.review);
            if (isNaN(currentState) || currentState < 0 || currentState > 1) currentState = 0;
            const $reviewLabel = $('#review_label');
            const $reviewHidden = $('#review');

            $reviewHidden.val(currentState);
            $reviewLabel
                .text(reviewStates[currentState].label)
                .attr('class', reviewStates[currentState].class + ' form-check-label')
                .removeClass('review-hoverable');

            if (currentState === 0 && data.user_created !== loggedInUser) {
                $reviewLabel
                    .addClass('review-hoverable')
                    .off('mouseenter mouseleave')
                    .on('mouseenter', function () {
                        $(this).text('Review');
                    })
                    .on('mouseleave', function () {
                        $(this).text('Unreview');
                    });
            }

            // Role: REVIEWER
            if (data.user_created !== loggedInUser) {
                $('#user_review').val(loggedInUser);

                $reviewLabel.off('click').on('click', function () {
                    // Prevent changing if already reviewed
                    if (currentState === 1) {
                        Swal.fire('Review Locked', 'Already reviewed. No changes allowed.', 'info');
                        return;
                    }

                    let nextValue = currentState === 1 ? 0 : 1;

                    Swal.fire({
                        title: `Mark as ${reviewStates[nextValue].label}?`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes'
                    }).then(result => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '<?php echo site_url('Campy_biosolids/saveReview'); ?>',
                                method: 'POST',
                                data: {
                                    id_one_water_sample: data.id_one_water_sample,
                                    review: nextValue,
                                    user_review: loggedInUser
                                },
                                dataType: 'json',
                                success: function (response) {
                                    if (response.status) {
                                        currentState = nextValue;
                                        $reviewHidden.val(nextValue);
                                        $reviewLabel
                                            .text(reviewStates[nextValue].label)
                                            .attr('class', reviewStates[nextValue].class);

                                        $('#reviewed_by_label').text('Reviewed by: ' + (response.full_name || '-'));

                                        $('#compose-modal').modal('hide');
                                        table.ajax.reload(null, false);

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Review updated',
                                            text: response.message,
                                            timer: 1000,
                                            showConfirmButton: false
                                        });
                                    } else {
                                        Swal.fire('Error', response.message, 'error');
                                    }
                                },
                                error: function () {
                                    Swal.fire('Error', 'Failed to connect to server.', 'error');
                                }
                            });
                        }
                    });
                });

            } else {
                // Role: CREATOR
                $reviewLabel.off('click').on('click', function () {
                    Swal.fire({
                        icon: 'info',
                        title: 'Action Not Allowed',
                        text: 'You are the creator of this data and cannot perform a review.',
                        confirmButtonText: 'OK'
                    });
                });
            }

            // Tambah event handler tombol Cancel Review, hanya jika tombol ada
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
                        const idSample = data.id_one_water_sample;
                        const loggedInUser = '<?php echo $this->session->userdata('id_users'); ?>';

                        $.ajax({
                            url: '<?php echo site_url('Campy_biosolids/cancelReview'); ?>',
                            method: 'POST',
                            data: {
                                id_one_water_sample: idSample,
                                review: 0,
                                user_review: null
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status) {
                                    $('#compose-modal').modal('hide');
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Review canceled successfully!',
                                        timer: 1000,
                                        showConfirmButton: false
                                    });

                                    // 🔄 Update datatable setelah cancel
                                    table.ajax.reload(null, false);
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Failed to cancel review',
                                        text: response.message
                                    });
                                }
                            },

                            error: function () {
                                Swal.fire('Error', 'Something went wrong during cancel.', 'error');
                            }
                        });
                    }
                });
            });

            // Remove or rewrite this block, as 'data' is a plain object and does not have .child() or .data() methods.
            // Example: If you want to enable/disable a button based on review status, use a selector for the button in the modal.
            if (parseInt(data.review) === 1) {
                $('#cancelReviewBtn').prop('disabled', false).removeClass('disabled-btn');
            } else {
                $('#cancelReviewBtn').prop('disabled', true).addClass('disabled-btn');
            }

            // Set Save button + Info
            if (data.user_created === loggedInUser) {
                $('#saveButtonDetail').prop('disabled', false);
                showInfoCard('#textInform2', '<i class="fa fa-check-circle"></i> You are the creator', "You have full access to edit this data but not review.", true);
            } else {
                $('#saveButtonDetail').prop('disabled', false);
                showInfoCard(
                    '#textInform2',
                    data.review == 1
                        ? '<i class="fa fa-check-circle"></i> You are not the creator'
                        : '<i class="fa fa-times-circle"></i> You are not the creator',
                    data.review == 1
                        ? "In this case, you can't review because it has already been reviewed."
                        : "In this case, you can review this data.",
                    false
                );
            }
            $('#barcode_moisture_content').val(data.barcode_moisture_content);
            $('#compose-modal').modal('show');
        });

        // Function to show a dynamic info card
        function showInfoCard(target, message, description, isSuccess) {
            $(target).find('.statusMessage').html(message);
            $(target).find('.statusDescription').text(description);
            if (isSuccess) {
                $(target).removeClass('card-danger').addClass('card-success');
            } else {
                $(target).removeClass('card-success').addClass('card-danger');
            }
            $(target).fadeIn();
        }

        // Close the card when the 'x' icon is clicked
        $('.close-card').on('click', function() {
            $('#textInform1').fadeOut();
            $('#textInform2').fadeOut();
        });
    });
</script>
