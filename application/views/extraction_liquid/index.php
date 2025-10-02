<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Processing | Extraction liquid </h3>
                    </div>
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                            <!-- <?php
                                $lvl = $this->session->userdata('id_user_level');
                                    if ($lvl != 4){
                                         echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Extraction liquid</button>";
                                    }
                            ?>         -->
                            <?php echo anchor(site_url('Extraction_liquid/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to XLS', 'class="btn btn-success"'); ?>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th></th> <!-- Kolom kosong untuk ikon toggle -->
                                        <th>ID Onewater Sample</th>
                                        <th>Lab Tech</th>
                                        <th>Number Sample</th>
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
                    <h4 class="modal-title" id="modal-title">Extraction liquid | New</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('Extraction_liquid/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <input id="id_testing_type" name="id_testing_type" type="hidden" class="form-control input-sm">
                        <input id="barcode_sample" name="barcode_sample" type="hidden" class="form-control input-sm">

                        <div class="form-group">
                            <label for="id_one_water_sample" class="col-sm-4 control-label">One Water Sample ID</label>
                            <div class="col-sm-8">
                                <input id="id_one_water_sample" name="id_one_water_sample" placeholder="One Water Sample ID" type="text" class="form-control">
                                <div class="val2tip"></div>
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
                            <label for="number_sample" class="col-sm-4 control-label">Number of Samples</label>
                            <div class="col-sm-8">
                                <input id="number_sample" name="number_sample" placeholder="Number of Samples" type="text" class="form-control" required>
                            </div>
                        </div>
                        <hr>		                        
                    </div>
                    <!-- <div class="modal-footer clearfix">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        <button type="button" class="btn btn-warning" id="cancelButton" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    </div> -->
                    <!-- Modal Footer with Dynamic TextInform -->
                    <div class="modal-footer clearfix" style="display: flex; align-items: center; justify-content: space-between;">
                        <!-- Info Card on the left side -->
                        <div class="modal-footer-content" style="flex: 1; display: flex; align-items: center;">
                            <div id="textInform1" class="textInform card" style="width: auto; padding: 5px 10px; display: none;">
                                <div class="card-body">
                                    <div class="card-header">
                                        <h5 class="card-title statusMessage"></h5>
                                        <i class="fa fa-times close-card" style="float: right; cursor: pointer;"></i>
                                    </div>
                                    <p class="statusDescription"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons on the right side -->
                        <div class="modal-buttons">
                            <button type="submit" class="btn btn-primary" id="saveButton"><i class="fa fa-save"></i> Save</button>
                            <button type="button" class="btn btn-warning" id="cancelButton" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->        
</div>

    <!-- MODAL FORM DETAIL -->
    <div class="modal fade" id="compose-modal-child" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                    <h4 class="modal-title" id="modal-title">Extraction liquid | Detail</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('Extraction_liquid/update_child') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode-child" name="mode-child" type="hidden" class="form-control input-sm">
                        <input id="user_review" name="user_review" type="hidden" class="form-control input-sm">

                        <div class="form-group">
                            <label for="barcode_sample1" class="col-sm-4 control-label">Barcode Sample</label>
                            <div class="col-sm-8">
                                <input id="barcode_sample1" name="barcode_sample1" placeholder="Barcode Sample" type="text" class="form-control" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="id_sampletype" class="col-sm-4 control-label">Sample Type</label>
                            <div class="col-sm-8" >
                            <select id='id_sampletype' name="id_sampletype" class="form-control" required>
                                <option value="" disabled>-- Select Sample Type --</option>
                                <?php
                                    foreach($sampletype as $row){
                                        if ($id_sampletype == $row['id_sampletype']) {
                                            echo "<option value='".$row['id_sampletype']."' selected='selected'>".$row['sampletype']."</option>";
                                        }
                                        else {
                                            echo "<option value='".$row['id_sampletype']."'>".$row['sampletype']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                            </div>
                        </div> -->
                        <div class="form-group">
                                <label for="sampletype" class="col-sm-4 control-label">Sample Type</label>
                                <div class="col-sm-8">
                                    <input id="id_sampletype" name="id_sampletype" placeholder="Sample Type" type="hidden" class="form-control">
                                    <input id="sampletype" name="sampletype" placeholder="Sample Type" type="text" class="form-control smple">
                                </div>
                            </div>

                        <hr>

                        <div class="form-group">
                            <label for="filtration_volume" class="col-sm-4 control-label">Filtration volume (ml)</label>
                            <div class="col-sm-8">
                                <input id="filtration_volume" name="filtration_volume" placeholder="Filtration volume (ml)" type="number" step="1" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="membrane_filter" class="col-sm-4 control-label">Membrane filter (µM)</label>
                            <div class="col-sm-8">
                                <div class="membrane-filter-container">
                                    <div style="flex: 1;">
                                        <select id="membrane_filter_dropdown" name="membrane_filter_dropdown" class="form-control">
                                            <option value="" disabled selected>-- Select Standard --</option>
                                            <option value="0.45">0.45µM</option>
                                            <option value="0.22">0.22µM</option>
                                        </select>
                                    </div>
                                    <span class="membrane-filter-or">OR</span>
                                    <div style="flex: 1;">
                                        <input id="membrane_filter_freetext" name="membrane_filter_freetext" placeholder="Enter custom value" type="text" step="any" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- Hidden field to store the final value -->
                            <input type="hidden" id="membrane_filter" name="membrane_filter" value="">
                        </div>

                        <!-- <div class="form-group">
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
                        </div> -->

                        <!-- <div class="form-group">
                            <label for="culture_media" class="col-sm-4 control-label">Culture media</label>
                            <div class="col-sm-8">
                                <select id="culture_media" name="culture_media" class="form-control" required>
                                    <option value="" disabled selected='selected'>-- Select Culture media --</option>
                                    <option value="HBA">HBA</option>
                                    <option value="XLD">XLD</option>
                                </select>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label for="date_extraction" class="col-sm-4 control-label">Date Extraction</label>
                            <div class="col-sm-8">
                                <input id="date_extraction" name="date_extraction" type="date" class="form-control" placeholder="Date Extraction" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>

                        <div class="form-group">
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
                            <label for="fin_volume" class="col-sm-4 control-label">Final Volume (uL)</label>
                            <div class="col-sm-8">
                                <input id="fin_volume" name="fin_volume" placeholder="Final Volume (uL)" type="number" step="1" class="form-control">
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
                        
                        <!-- <div class="form-group">
                            <label for="review" class="col-sm-4 control-label">Status</label>
                            <div class="col-sm-8">
                                <input type="hidden" id="review" name="review" value="0">
                                <span id="review_label" class="form-check-label unreview" role="button">
                                    Unreview
                                </span>
                                    <span id="reviewed_by_label"  style="margin-left: 10px; font-style: italic;  font-weight: bold; font-size: 11px;">
                                </span>
                            </div>
                        </div> -->

                    </div>

                    <!-- <div class="modal-footer clearfix">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    </div> -->

                    <div class="modal-footer clearfix" style="display: flex; align-items: center; justify-content: space-between;">
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
                        <div class="modal-buttons">
                            <button type="submit" class="btn btn-primary" id="saveButtonDetail"><i class="fa fa-save"></i> Save</button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

<!-- MODAL CONFIRMATION DELETE -->
        <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Extraction liquid | Delete <span id="my-another-cool-loader"></span></h4>
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
        margin-left: 20px;
        margin-right: 20px;
        width: calc(100% - 40px);
        border-collapse: collapse;
        table-layout: fixed;
    }

    .child-table th, .child-table td {
        border: 1px solid #ddd;
        padding: 5px;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    /* Styling untuk container dengan scroll */
    .child-table-container {
        max-height: 500px;
        overflow-y: auto;
        overflow-x: auto;
        padding: 10px 0;
        width: 100%;
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
        border-color: gray !important;
        box-shadow: none; /* Override Bootstrap box-shadow */
    }

    /* input.form-check-label. */
    .review {
        color: green !important;
        border-color: green !important;
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
        width: 25%; /* Ensures card uses available space */
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
        margin-left: 20px;
        margin-right: 20px;
        width: calc(100% - 40px);
        border-collapse: collapse;
        table-layout: fixed;
    }

    .child-table th, .child-table td {
        border: 1px solid #ddd;
        padding: 5px;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    /* Styling untuk container dengan scroll */
    .child-table-container {
        max-height: 500px;
        overflow-y: auto;
        overflow-x: auto;
        padding: 10px 0;
        width: 100%;
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

    /* Membrane filter styling */
    #membrane_filter_dropdown:disabled {
        background-color: #f5f5f5;
        opacity: 0.6;
        cursor: not-allowed;
    }

    #membrane_filter_freetext:disabled {
        background-color: #f5f5f5;
        opacity: 0.6;
        cursor: not-allowed;
    }

    .membrane-filter-container {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .membrane-filter-or {
        font-style: italic;
        color: #666;
        margin: 0 5px;
        font-size: 12px;
    }

    /* Parent table container constraints */
    #mytable_wrapper {
        overflow-x: auto;
    }

    /* DataTable row child content container */
    .dataTables_wrapper .child {
        overflow: hidden;
    }

    /* Ensure child table doesn't exceed parent boundaries */
    .child-table-wrapper {
        overflow: hidden;
        width: 100%;
        box-sizing: border-box;
    }

    /* Child table column width distribution */
    .child-table th:nth-child(1),
    .child-table td:nth-child(1) {
        width: 15%;
        min-width: 100px;
    }

    .child-table th:nth-child(2),
    .child-table td:nth-child(2) {
        width: 15%;
        min-width: 100px;
    }

    .child-table th:nth-child(3),
    .child-table td:nth-child(3) {
        width: 12%;
        min-width: 80px;
    }

    .child-table th:nth-child(4),
    .child-table td:nth-child(4) {
        width: 10%;
        min-width: 70px;
    }

    .child-table th:nth-child(5),
    .child-table td:nth-child(5) {
        width: 10%;
        min-width: 70px;
    }

    .child-table th:nth-child(6),
    .child-table td:nth-child(6) {
        width: 12%;
        min-width: 80px;
    }

    .child-table th:nth-child(7),
    .child-table td:nth-child(7) {
        width: 16%;
        min-width: 100px;
    }

    .child-table th:nth-child(8),
    .child-table td:nth-child(8) {
        width: 10%;
        min-width: 70px;
    }

    /* Additional constraints to prevent overflow */
    .dataTables_scrollBody {
        overflow-x: hidden !important;
    }

    /* Ensure DataTable wrapper doesn't overflow */
    .dataTables_wrapper {
        overflow: hidden;
    }

    /* Force child content to stay within parent boundaries */
    td.dataTables_empty,
    td.child {
        overflow: hidden !important;
        max-width: 100% !important;
    }

    /* Constrain the entire child row content */
    tr.child td {
        padding: 0 !important;
        overflow: hidden !important;
    }

    tr.child td > div {
        overflow: hidden !important;
        max-width: 100% !important;
    }
</style>
<style>
	#textInform2 .alert {
    display: block !important;
    margin-top: 20px;
    font-size: 16px;
    z-index: 1000; /* Pastikan info card di atas elemen lain */
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
        // Dapatkan parameter barcode dan id_one_water_sample
        const params = new URLSearchParams(window.location.search);
        const barcodeFromUrl = params.get('barcode');
        const idOneWaterSampleFromUrl = params.get('idOneWaterSample');
        const idTestingTypeFromUrl = params.get('idTestingType');

        // Cek apakah barcode dan id_one_water_sample ada di URL
        if (barcodeFromUrl && idOneWaterSampleFromUrl && idTestingTypeFromUrl) {
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Extraction culture plate | New<span id="my-another-cool-loader"></span>');

            // Set nilai form sesuai dengan parameter yang diterima
            $('#id_one_water_sample').attr('readonly', true);
            $('#id_one_water_sample').val(idOneWaterSampleFromUrl || '');  // Set ID jika ada
            $('#id_testing_type').val(idTestingTypeFromUrl);
            $('#id_person').val('');
            $('#barcode_sample').attr('readonly', true);
            $('#barcode_sample').val(barcodeFromUrl || '');  // Set barcode jika ada
            // $('#sampletype').attr('readonly', true);
            // $('#sampletype').val('');
            $('#comments').val('');
            $('#number_sample').val();


            // Tampilkan modal
            $('#compose-modal').modal('show');
        } else {
            console.log('Barcode atau ID One Water Sample tidak ditemukan di URL');
        }

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

        function showConfirmation(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('Extraction_liquid/delete_extraction'); ?>/' + id;
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
            });

        $("input").keypress(function(){
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
        });

        $("input").click(function(){
            setTimeout(function(){
                $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
            }, 3000);                            
        });

        $('#id_one_water_sample').on("change", function() {
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
            id_one_water_sample = $('#id_one_water_sample').val();
            $.ajax({
                type: "GET",
                url: "Extraction_liquid/barcode_restrict?id1="+id_one_water_sample,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
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
                    else {
                    }
                }
            });
        }).trigger('change');

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

        function load_freez(data1) {
            $.ajax({
                type: "GET",
                url: "Extraction_liquid/load_freez?id1="+data1,
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
                url: "Extraction_liquid/get_freez?id1="+data1+"&id2="+data2+"&id3="+data3+"&id4="+data4,
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

        // Membrane filter functionality - mutual disable between dropdown and freetext
        $('#membrane_filter_dropdown').on('change', function() {
            var dropdownValue = $(this).val();
            if (dropdownValue) {
                // Disable freetext input and set hidden field value
                $('#membrane_filter_freetext').prop('disabled', true).val('');
                $('#membrane_filter').val(dropdownValue);
            } else {
                // Enable freetext input and clear hidden field
                $('#membrane_filter_freetext').prop('disabled', false);
                $('#membrane_filter').val('');
            }
        });

        $('#membrane_filter_freetext').on('input', function() {
            var freetextValue = $(this).val();
            if (freetextValue) {
                // Disable dropdown and set hidden field value
                $('#membrane_filter_dropdown').prop('disabled', true).val('');
                $('#membrane_filter').val(freetextValue);
            } else {
                // Enable dropdown and clear hidden field
                $('#membrane_filter_dropdown').prop('disabled', false);
                $('#membrane_filter').val('');
            }
        });

        // Reset function for membrane filter
        function resetMembraneFilter() {
            $('#membrane_filter_dropdown').prop('disabled', false).val('');
            $('#membrane_filter_freetext').prop('disabled', false).val('');
            $('#membrane_filter').val('');
        }

        // Reset membrane filter when modal is hidden
        $('#compose-modal-child').on('hidden.bs.modal', function() {
            resetMembraneFilter();
        });

        let lastIdProject = localStorage.getItem('last_id_extraction_liquid');
        let lastPage = localStorage.getItem('last_page_extraction_liquid');
        table = $("#mytable").DataTable({
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "Extraction_liquid/json", "type": "POST"},
            displayStart: lastPage ? (parseInt(lastPage) * 10) : 0, // <-- ini di sini ya!
            columns: [
                {"data": "toggle", "orderable": false, "searchable": false }, // Ikon toggle di awal
                {"data": "id_one_water_sample"},
                // {"data": "barcode_sample"},
                {"data": "initial"},
                {"data": "number_sample"},
                { "data": "action", "orderable": false, "searchable": false }
            ],
            columnDefs: [
                {
                    targets: [0],
                    className: 'text-right'
                }
            ],
            drawCallback: function(settings) {
                let api = this.api();
                let pageInfo = api.page.info();

                // Reset semua highlight sebelumnya
                api.rows().every(function() {
                    $(this.node()).removeClass('highlight highlight-edit');
                });

                // Dapatkan waktu saat ini
                let now = new Date();
                let newestRow = null;
                let newestCreatedDate = null;
                let newestUpdatedDate = null;
                let updatedRow = null;

                // Cari baris dengan date_created paling baru dan date_updated paling baru
                api.rows().every(function() {
                    let data = this.data();
                    let createdDate = new Date(data.date_created);
                    let updatedDate = new Date(data.date_updated);

                    // Cari baris dengan date_created paling baru
                    if (now - createdDate < 10 * 100) {
                        if (!newestCreatedDate || createdDate > newestCreatedDate) {
                            newestCreatedDate = createdDate;
                            newestRow = this.node();
                        }
                    }


                    // Cari baris dengan date_updated paling baru (terbaru dalam 5 detik terakhir)
                    if (now - updatedDate < 10 * 1000) {
                        if (!newestUpdatedDate || updatedDate > newestUpdatedDate) {
                            newestUpdatedDate = updatedDate;
                            updatedRow = this.node();
                        }
                    }
                });

                // Highlight baris yang paling baru dimasukkan berdasarkan date_created
                if (newestRow) {
                    $(newestRow).addClass('highlight');
                    setTimeout(function() {
                        $(newestRow).removeClass('highlight');
                    }, 5000);
                }

                if (updatedRow) {
                    $(updatedRow).addClass('highlight-edit');
                    
                    // Hilangkan highlight-edit setelah 10 detik
                    setTimeout(function() {
                        $(updatedRow).removeClass('highlight-edit');
                    }, 5000);
                }

                // Pastikan baris pertama di halaman pertama tetap disorot jika ada baris dalam tabel
                if (pageInfo.page === 0 && api.rows().count() > 0) {
                    let firstRow = api.row(0).node();
                    setTimeout(function() {
                        $(firstRow).addClass('highlight');
                    }, 5000);
                }

                if (lastIdProject) {
                    api.rows().every(function () {
                        let rowData = this.data();
                        if (rowData.id_extraction_liquid === lastIdProject) {
                            $(this.node()).addClass('highlight');
                            $('html, body').animate({
                                scrollTop: $(this.node()).offset().top - 100
                            }, 1000);
                            // buka child-nya otomatis
                            openChildRow($(this.node()), rowData);
                        }
                    });
                }
            }
        });

        $('#mytable tbody').on('click', 'tr', function () {
            const table = $('#mytable').DataTable();
            const rowData = table.row(this).data(); // Ambil data dari DataTable, bukan dari DOM

            if (rowData) {
                const id = rowData.id_extraction_liquid; // pastikan nama field sesuai dari server

                const pageInfo = table.page.info();
                localStorage.setItem('last_id_extraction_liquid', id);
                localStorage.setItem('last_page_extraction_liquid', pageInfo.page);
            }
        });

        function openChildRow(tr, rowData) {
            let row = $('#mytable').DataTable().row(tr);
            let id_one_water_sample = rowData.id_one_water_sample;
            let icon = tr.find('.toggle-child i');

            if (!row.child.isShown()) {
                row.child('<div class="text-center py-2">Loading...</div>').show();
                tr.addClass('shown');
                if (icon.length) {
                    icon.removeClass('fa-plus-square').addClass('fa-spinner fa-spin');
                }

                $.ajax({
                    url: `Extraction_liquid/get_extraction_by_id/${id_one_water_sample}`,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        let uniqueId = `review_${id_one_water_sample}`;
                        let tableContent = `
                            <div class="child-table-wrapper">
                                <div class="child-table-container">
                                    <table class="child-table table table-bordered table-sm">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Barcode Sample</th>
                                            <th>Barcode Tube</th>
                                            <th>Sample Type</th>
                                            <th>Cryobox</th>
                                            <th>Kit Lot</th>
                                            <th>Date Extraction</th>
                                            <th>Comments</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>`;

                        if (data.length > 0) {
                            $.each(data, function (index, extraction) {
                                tableContent += `
                                    <tr>
                                        <td>${extraction.barcode_sample ?? '-'}</td>
                                        <td>${extraction.barcode_tube ?? '-'}</td>
                                        <td>${extraction.sampletype ?? '-'}</td>
                                        <td>${extraction.cryobox ?? '-'}</td>
                                        <td>${extraction.kit_lot ?? '-'}</td>
                                        <td>${extraction.date_extraction ?? '-'}</td>
                                        <td>${extraction.comments ?? '-'}</td>
                                        <td>${extraction.action ?? '-'}</td>
                                    </tr>`;
                            });
                        } else {
                            tableContent += `<tr><td colspan="9" class="text-center">No samples available</td></tr>`;
                        }

                        tableContent += `
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer clearfix mt-3" style="display: flex; justify-content: space-between; gap: 15px;">
                                <div style="flex: 1;">
                                    <div class="textInform card" style="display:none; padding: 5px 10px;" id="textInform_${uniqueId}">
                                        <div class="card-body">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h5 class="card-title statusMessage mb-0"></h5>
                                                <i class="fa fa-times close-card" style="cursor: pointer;"></i>
                                            </div>
                                            <p class="statusDescription mb-0"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center flex-wrap" style="gap: 8px;">
                                    <span class="text-muted">Status:</span>
                                    <span class="review_label badge"
                                        data-uniqueid="${uniqueId}"
                                        data-usercreated="${row.data().user_created}"
                                        data-review="${row.data().review}"
                                        style="cursor: pointer;">
                                        ${row.data().review == 1 ? 'Reviewed' : 'Unreview'}
                                    </span>
                                    <span class="text-muted ms-3">by:</span>
                                    <span id="reviewed_by_label" style="font-style: italic; font-weight: 800; font-size: 14px;">
                                        ${row.data().full_name ? row.data().full_name : '-'}
                                    </span>
                                </div>
                                <?php if (in_array($this->session->userdata('id_user_level'), [1, 2])): ?>
                                <button type="button" class="btn btn-danger ms-3 cancelReviewBtn" data-uniqueid="${uniqueId}" data-review="${row.data().review}">
                                    Cancel Review
                                </button>
                                <?php endif; ?>
                            </div>`;

                        row.child(tableContent).show();

                        if (icon.length) {
                            icon.removeClass('fa-spinner fa-spin').addClass('fa-minus-square');
                        }

                        attachReviewBehavior(uniqueId, row.data().user_created, row.data().review);

                        let $cancelReviewBtn = row.child().find('.cancelReviewBtn');
                        if (parseInt(row.data().review) === 1) {
                            $cancelReviewBtn.prop('disabled', false).removeClass('disabled-btn');
                        } else {
                            $cancelReviewBtn.prop('disabled', true).addClass('disabled-btn');
                        }
                    }
                });
            }
        }

        $('#mytable tbody').on('click', '.toggle-child', function () {
            let loggedInUser = '<?php echo $this->session->userdata('id_users'); ?>';
            let tr = $(this).closest('tr');
            let row = $('#mytable').DataTable().row(tr);
            let id_one_water_sample = row.data().id_one_water_sample;
            let icon = $(this).find('i');

            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
                icon.removeClass('fa-minus-square').addClass('fa-plus-square');
            } else {
                row.child('<div class="text-center py-2">Loading...</div>').show();
                tr.addClass('shown');
                icon.removeClass('fa-plus-square').addClass('fa-spinner fa-spin');

                $.ajax({
                    url: `Extraction_liquid/get_extractions_by_project/${id_one_water_sample}`,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        let uniqueId = `review_${id_one_water_sample}`;
                        let tableContent = `
                            <div class="child-table-wrapper">
                                <div class="child-table-container">
                                    <table class="child-table table table-bordered table-sm">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Barcode Sample</th>
                                            <th>Barcode Tube</th>
                                            <th>Sample Type</th>
                                            <th>Cryobox</th>
                                            <th>Kit Lot</th>
                                            <th>Date Extraction</th>
                                            <th>Comments</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>`;

                        if (data.length > 0) {
                            $.each(data, function (index, extraction) {
                                tableContent += `
                                    <tr>
                                        <td>${extraction.barcode_sample ?? '-'}</td>
                                        <td>${extraction.barcode_tube ?? '-'}</td>
                                        <td>${extraction.sampletype ?? '-'}</td>
                                        <td>${extraction.cryobox ?? '-'}</td>
                                        <td>${extraction.kit_lot ?? '-'}</td>
                                        <td>${extraction.date_extraction ?? '-'}</td>
                                        <td>${extraction.comments ?? '-'}</td>
                                        <td>${extraction.action ?? '-'}</td>
                                    </tr>`;
                            });
                        } else {
                            tableContent += `<tr><td colspan="5" class="text-center">No samples available</td></tr>`;
                        }

                        tableContent += `
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer clearfix mt-3" style="display: flex; justify-content: space-between; gap: 15px;">
                                <div style="flex: 1;">
                                    <div class="textInform card" style="display:none; padding: 5px 10px;" id="textInform_${uniqueId}">
                                        <div class="card-body">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h5 class="card-title statusMessage mb-0"></h5>
                                                <i class="fa fa-times close-card" style="cursor: pointer;"></i>
                                            </div>
                                            <p class="statusDescription mb-0"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center flex-wrap" style="gap: 8px;">
                                    <span class="text-muted">Status:</span>
                                    <span class="review_label badge"
                                        data-uniqueid="${uniqueId}"
                                        data-usercreated="${row.data().user_created}"
                                        data-review="${row.data().review}"
                                        style="cursor: pointer;">
                                        ${row.data().review == 1 ? 'Reviewed' : 'Unreview'}
                                    </span>
                                    <span class="text-muted ms-3">by:</span>
                                    <span id="reviewed_by_label" style="font-style: italic; font-weight: 800; font-size: 14px;">
                                        ${row.data().full_name ? row.data().full_name : '-'}
                                    </span>
                                </div>
                                <?php if (in_array($this->session->userdata('id_user_level'), [1, 2])): ?>
								<button type="button" class="btn btn-danger ms-3 cancelReviewBtn" data-uniqueid="${uniqueId}" data-review="${row.data().review}">
									Cancel Review
								</button>
							    <?php endif; ?>
                            </div>`;

                        row.child(tableContent).show();

                        icon.removeClass('fa-spinner fa-spin').addClass('fa-minus-square');

                        attachReviewBehavior(uniqueId, row.data().user_created, row.data().review);
                        let $cancelReviewBtn = row.child().find('.cancelReviewBtn');
                        if (parseInt(row.data().review) === 1) {
                            $cancelReviewBtn.prop('disabled', false).removeClass('disabled-btn');
                        } else {
                            $cancelReviewBtn.prop('disabled', true).addClass('disabled-btn');
                        }
                    },
                });
            }
        }); 

        // Event handler ketika tombol Cancel Review diklik
        $('#mytable tbody').on('click', '.cancelReviewBtn', function() {
            let loggedInUser = '<?php echo $this->session->userdata('id_users'); ?>';
            let uniqueId = $(this).data('uniqueid');
            let review = $(this).data('review');
            
            // Kamu bisa gunakan uniqueId untuk dapatkan data review yg sesuai
            // Contoh: cari elemen review label di child row ini
            let $child = $(this).closest('.child-table-container').parent(); // atau parent row child
            let $reviewLabel = $child.find('.review_label');
            
            // Lanjutkan logika cancel review, misal AJAX dll
            
            Swal.fire({
                icon: 'warning',
                title: 'Cancel Review?',
                text: 'This will reset the review status so another user can review it again.',
                showCancelButton: true,
                confirmButtonText: 'Yes, cancel it',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // contoh update UI dulu
                    $reviewLabel.text('Unreview').removeClass().addClass('badge unreview');

                    // lalu AJAX cancel review
                    $.ajax({
                        url: '<?php echo site_url('Extraction_liquid/cancelReview'); ?>',
                        method: 'POST',
                        data: {
                            id_one_water_sample: uniqueId.replace('review_', ''),
                            review: review,
                            user_review: loggedInUser
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Review canceled successfully!',
                                    timer: 1000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed to cancel review',
                                    text: response.message
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            if (xhr.responseText && xhr.responseText.trim().startsWith('<')) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Server returned HTML instead of JSON',
                                    text: 'Please check server response. See console for details.',
                                    footer: '<a href="javascript:console.log(xhr.responseText)">Click to view response</a>'
                                });
                            } else {
                                Swal.fire('Error', 'Something went wrong during cancel.', 'error');
                            }
                        }
                    });
                }
            });
        });

        function attachReviewBehavior(uniqueId, userCreated, review) {
            let loggedInUser = '<?php echo $this->session->userdata('id_users'); ?>';
            let currentState = parseInt(review);

            let $label = $(`.review_label[data-uniqueid="${uniqueId}"]`);
            let $card = $(`#textInform_${uniqueId}`);

            const states = [
                { value: 0, label: "Unreview", class: "unreview" },
                { value: 1, label: "Reviewed", class: "review" }
            ];
            const colorClasses = ['bg-warning', 'bg-success', 'text-dark', 'text-white'];

            // if (![0, 1].includes(currentState)) {
            //     currentState = 0; // fallback ke default
            // }

            $label
                .text(states[currentState].label)
                .removeClass(colorClasses.join(' '))
                .addClass(states[currentState].class);

            if (loggedInUser !== userCreated) {
                $label.off('click').on('click', function () {
                    if (currentState === 1) {
                        Swal.fire('Review Locked', 'Already reviewed. No changes allowed.', 'info');
                        return;
                    }

                    Swal.fire({
                        title: 'Review this data?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes'
                    }).then(result => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '<?php echo site_url('Extraction_liquid/saveReview'); ?>',
                                method: 'POST',
                                data: {
                                    id_one_water_sample: uniqueId.replace('review_', ''),
                                    user_review: loggedInUser,
                                    review: 1
                                },
                                dataType: 'json',
                                success: function (response) {
                                    if (response.status) {
                                        currentState = 1;

                                        $label
                                            .text(states[currentState].label)
                                            .removeClass(colorClasses.join(' '))
                                            .addClass(states[currentState].class);

                                        showInfoCard(
                                            `#textInform_${uniqueId}`,
                                            '<i class="fa fa-check-circle"></i> Review Success',
                                            'Review submitted successfully.',
                                            true
                                        );

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Review saved successfully!',
                                            text: response.message,
                                            timer: 1000,
                                            showConfirmButton: false
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Failed to save review',
                                            text: response.message
                                        });
                                    }
                                },
                                error: function (xhr, status, error) {
                                    console.error('AJAX Error: ' + status + error);
                                    Swal.fire('Error', 'Something went wrong during submission.', 'error');
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'info',
                                title: 'Review Not Changed',
                                text: 'No changes were made.',
                                timer: 2000
                            });
                        }
                    });
                });

                $label.hover(
                    function () {
                        if (currentState === 0) $(this).text('Click to Review');
                    },
                    function () {
                        if (currentState === 0) $(this).text('Unreview');
                    }
                );

                showInfoCard(
                    `#textInform_${uniqueId}`,
                    '<i class="fa fa-times-circle"></i> You are not the creator',
                    currentState === 1
                        ? "In this case, you can't review because it has already been reviewed."
                        : "In this case, you can review this data. Hover over the box on the right side to start the review.",
                    false
                );
            } else {
                showInfoCard(
                    `#textInform_${uniqueId}`,
                    '<i class="fa fa-check-circle"></i> You are the creator',
                    "You have full access to edit this data but not review.",
                    true
                );

                $label.off('click').on('click', function () {
                    Swal.fire({
                        icon: 'info',
                        title: 'Action Not Allowed',
                        text: 'You are the creator of this data and cannot perform a review.',
                        confirmButtonText: 'OK'
                    });
                });
            }

                $card.find('.close-card').on('click', function () {
                    $card.fadeOut();
                });
        }

        function showInfoCard(targetSelector, message, description, isSuccess) {
            let $target = $(targetSelector);
            $target.find('.statusMessage').html(message);
            $target.find('.statusDescription').text(description);

            $target.removeClass('card-success card-danger')
                .addClass(isSuccess ? 'card-success' : 'card-danger')
                .fadeIn();
        }

        $('#mytable').on('click', '.btn_edit_child', function() {
            let barcode_sample = $(this).data('id');
            let loggedInUser = '<?php echo $this->session->userdata('id_users'); ?>';
            $('#mode-child').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Sample reception | Update<span id="my-another-cool-loader"></span>');
            $('#modal-sample-body').html('<div class="text-center py-3"><i class="fa fa-spinner fa-spin"></i> Loading...</div>');

            $.ajax({
                url: `Extraction_liquid/get_extraction_child/${barcode_sample}`,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    console.log(data); // 🔍 Debugging response di console

                    if (data.error) {
                        $('#modal-sample-body').html('<div class="text-danger text-center py-3">Data tidak ditemukan</div>');
                        return;
                    }
                    // Mengisi form modal dengan data yang diterima
                    $('#barcode_sample1').val(data.barcode_sample);
                    $('#barcode_sample1').attr('readonly', true);
                    $('#id_sampletype').val(data.id_sampletype);
                    $('#sampletype').val(data.sampletype);
                    $('#sampletype').attr('readonly', true);
                    $('#date_extraction').val(data.date_extraction).trigger('change');
                    $('#filtration_volume').val(data.filtration_volume);
                    
                    // Handle membrane filter for edit mode
                    resetMembraneFilter(); // Reset both fields first
                    if (data.membrane_filter) {
                        // Check if the value matches dropdown options
                        if (data.membrane_filter === '0.45' || data.membrane_filter === '0.22') {
                            $('#membrane_filter_dropdown').val(data.membrane_filter);
                            $('#membrane_filter_freetext').prop('disabled', true);
                        } else {
                            // Custom value, use freetext
                            $('#membrane_filter_freetext').val(data.membrane_filter);
                            $('#membrane_filter_dropdown').prop('disabled', true);
                        }
                        $('#membrane_filter').val(data.membrane_filter);
                    }
                    
                    // $('#dilution').val(data.dilution).trigger('change');
                    // $('#culture_media').val(data.culture_media).trigger('change');
                    $('#id_kit').val(data.id_kit).trigger('change');
                    $('#kit_lot').val(data.kit_lot);
                    $('#barcode_tube').val(data.barcode_tube);
                    $('#fin_volume').val(data.fin_volume);
                    $('#dna_concentration').val(data.dna_concentration);
                    $('#cryobox').val(data.cryobox);
                    $('#id_freez').val(data.freezer);
                    $('#id_shelf').val(data.shelf);
                    $('#id_rack').val(data.rack);
                    $('#id_tray').val(data.tray);
                    $('#id_row').val(data.rows1);
                    $('#id_col').val(data.columns1);
                    $('#comments').val(data.comments);
                    // $('#review').val(data.review);
                    // $('#user_review').val(data.user_review);
                    // $('#reviewed_by_label').text('Reviewed by: ' + (data.full_name ? data.full_name : '-'));
                    // // Set the checkbox state
                    // if (data.user_created !== loggedInUser) {
                    //     $('#user_review').val(loggedInUser);
                    //     // Set the checkbox state
                    //     if (data.review == 1) {
                    //         $('#review').prop('checked', true); // Check the checkbox
                    //         const label = document.getElementById('review_label');
                    //         label.textContent = 'Review';
                    //         label.className = `form-check-label review`;            
                    //     } else if (data.review == 0) {
                    //         $('#review').prop('checked', false); // Uncheck the checkbox
                    //         const label = document.getElementById('review_label');
                    //         label.textContent = 'Unreview';
                    //         label.className = `form-check-label unreview`;            
                    //     }
                    //     $('#review').val(data.review);
                    //                         // Define the states with associated values and labels
                    //                         const states = [
                    //         { value: 0, label: "Unreview", class: "unreview" },
                    //         { value: 1, label: "Review", class: "review" }
                    //         // { value: 2, label: "Crossed", class: "crossed" }
                    //     ];

                    //     let currentState = 0; // Start with "Unchecked"

                    //     // Add event listener to toggle through states
                    //     document.getElementById('review_label').addEventListener('click', function () {
                    //         // Cycle through the states
                    //         currentState = (currentState + 1) % states.length;

                    //         const checkbox = document.getElementById('review');
                    //         const label = document.getElementById('review_label');

                    //         // Update the label text
                    //         label.textContent = states[currentState].label;

                    //         // Apply styling to the label based on the state
                    //         label.className = `form-check-label ${states[currentState].class}`;

                    //         // (Optional) Update a hidden input or store the value somewhere for submission
                    //         checkbox.value = states[currentState].value; // Set the value to the current state
                    //     });                
                    // } else {
                    //     if (data.review == 1) {
                    //             $('#review').prop('checked', true); // Check the checkbox
                    //             const label = document.getElementById('review_label');
                    //             label.textContent = 'Review';
                    //             label.className = `form-check-label review`;            
                    //         } else if (data.review == 0) {
                    //             $('#review').prop('checked', false); // Uncheck the checkbox
                    //             const label = document.getElementById('review_label');
                    //             label.textContent = 'Unreview';
                    //             label.className = `form-check-label unreview`;            
                    //         }
                    // }

                    // console.log('test user', data.user_created);
                    // if (data.user_created === loggedInUser) {
                    //     $('#saveButtonDetail').prop('disabled', false);  // Enable Save button if user is the same as the one who created
                    //     showInfoCard('#textInform2', '<i class="fa fa-check-circle"></i> You are the creator', "You have full access to edit this data.", true);
                    // } else {
                    //     $('#saveButtonDetail').prop('disabled', false);  // Disable Save button if user is not the same as the one who created
                    //     showInfoCard('#textInform2', '<i class="fa fa-times-circle"></i> You are not the creator', "In the case you can review this data and make changes.", false);
                    // }

                      
                    // Display modal
                    $('#compose-modal-child').modal('show');
                    $('#modal-sample-body').html(''); // Clear loading spinner
                },
                error: function () {
                    $('#modal-sample-body').html('<div class="text-danger text-center py-3">Gagal memuat data</div>');
                }
            });
        });

        $(document).on('click', '.btn_delete_child', function() {
            let barcode_sample = $(this).data('id');
            let url = '<?php echo site_url('Extraction_liquid/delete_child'); ?>/' + barcode_sample;
            $('#confirm-modal #id').text(barcode_sample);
            console.log(id);
            showConfirmation(url);
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            let loggedInUser = '<?php echo $this->session->userdata('id_users'); ?>';  // Get the logged-in user from the session or a similar method.
            console.log(data);
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square-o"></i> Extraction culture plate | Update<span id="my-another-cool-loader"></span>');
            // Set nilai form sesuai dengan parameter yang diterima
            $('#id_one_water_sample').attr('readonly', true);
            $('#id_one_water_sample').val(data.id_one_water_sample || '');  // Set ID jika ada
            // $('#id_testing_type').val(idTestingTypeFromUrl);
            $('#id_person').val(data.id_person);
            $('#number_sample').attr('readonly', true);
            $('#number_sample').val(data.number_sample || '');  // Set barcode jika ada
            // $('#user_created').val(data.user_created || '');  // Set barcode jika ada
            // $('#user_created').attr('readonly', true);
            // if (data.user_created === loggedInUser) {
            //     $('#saveButton').prop('disabled', false);  // Enable Save button if user is the same as the one who created
            //     showInfoCard('#textInform1', '<i class="fa fa-check-circle"></i> You are the creator', "You have full access to edit this data.", true);
            // } else {
            //     $('#saveButton').prop('disabled', true);  // Disable Save button if user is not the same as the one who created
            //     showInfoCard('#textInform1', '<i class="fa fa-times-circle"></i> You are not the creator', "You can only view this data and cannot make changes.", false);
            // }
            // $('#sampletype').attr('readonly', true);
            // $('#sampletype').val('');
            // $('#comments').val('');
            // $('#number_sample').val();
            $('#compose-modal').modal('show');
        });  

        // Function to show a dynamic info card
        // function showInfoCard(target, message, description, isSuccess) {
        //     $(target).find('.statusMessage').html(message);
        //     $(target).find('.statusDescription').text(description);

        //     if (isSuccess) {
        //         $(target).removeClass('card-danger').addClass('card-success');
        //     } else {
        //         $(target).removeClass('card-success').addClass('card-danger');
        //     }
        //     $(target).fadeIn();
        // }

        // Close the card when the 'x' icon is clicked
        // $('.close-card').on('click', function() {
        //     $('#textInform1').fadeOut(); // Fade out the card
        //     $('#textInform2').fadeOut();
        // });

        // $('#addtombol').click(function() {
        //     $('#mode').val('insert');
        //     $('#modal-title').html('<i class="fa fa-wpforms"></i> Extraction liquid | New<span id="my-another-cool-loader"></span>');
        //     // $('#project_idx').hide();
        //     $('#id_one_water_sample').attr('readonly', false);
        //     $('#id_one_water_sample').val('');
        //     $('#id_one_water_sample_list').val('');
        //     $('#id_one_water_sample').hide();
        //     $('#id_one_water_sample_list').show();
        //     $('#id_person').val('');
        //     $('#barcode_sample').attr('readonly', false);
        //     $('#barcode_sample').val('');
        //     $('#sampletype').attr('readonly', true);
        //     $('#sampletype').val('');
        //     // $('#date_extraction').val('');
        //     $('#filtration_volume').val('');
        //     $('#membrane_filter').val('');
        //     $('#dilution').val('');
        //     $('#culture_media').val('');
        //     $('#id_kit').val('');
        //     $('#kit_lot').val('');
        //     $('#barcode_tube').val('');
        //     $('#fin_volume').val('');
        //     $('#dna_concentration').val('');
        //     $('#cryobox').val('');
        //     $('#id_freez').val('');
        //     $('#id_shelf').val('');
        //     $('#id_rack').val('');
        //     $('#id_tray').val('');
        //     $('#id_row').val('');
        //     $('#id_col').val('');
        //     $('#comments').val('');
        //     $('#compose-modal').modal('show');
        // });

        // $('#mytable').on('click', '.btn_edit', function(){
        //     let tr = $(this).parent().parent();
        //     let data = table.row(tr).data();
        //     console.log(data);
        //     // var data = this.parents('tr').data();
        //     $('#mode').val('edit');
        //     $('#modal-title').html('<i class="fa fa-pencil-square-o"></i> Extraction liquid | Update<span id="my-another-cool-loader"></span>');
        //     // $('#project_idx').show();
        //     $('#id_one_water_sample').attr('readonly', true);
        //     $('#id_one_water_sample').show();
        //     $('#id_one_water_sample_list').hide();
        //     $('#id_one_water_sample').val(data.id_one_water_sample);
        //     $('#id_one_water_sample_list').val(data.id_one_water_sample).trigger('change');
        //     $('#id_person').val(data.id_person).trigger('change');
        //     $('#barcode_sample').attr('readonly', true);
        //     $('#barcode_sample').val(data.barcode_sample);
        //     $('#sampletype').attr('readonly', true);
        //     $('#sampletype').val(data.sampletype);
        //     $('#date_extraction').val(data.date_extraction).trigger('change');
        //     $('#filtration_volume').val(data.filtration_volume);
        //     $('#membrane_filter').val(data.membrane_filter);
        //     $('#dilution').val(data.dilution).trigger('change');
        //     $('#culture_media').val(data.culture_media).trigger('change');
        //     $('#id_kit').val(data.id_kit).trigger('change');
        //     $('#kit_lot').val(data.kit_lot);
        //     $('#barcode_tube').val(data.barcode_tube);
        //     $('#fin_volume').val(data.fin_volume);
        //     $('#dna_concentration').val(data.dna_concentration);
        //     $('#cryobox').val(data.cryobox);
        //     $('#id_freez').val(data.freezer);
        //     $('#id_shelf').val(data.shelf);
        //     $('#id_rack').val(data.rack);
        //     $('#id_tray').val(data.tray);
        //     $('#id_row').val(data.rows1);
        //     $('#id_col').val(data.columns1);
        //     // load_freez(data.id_location);
        //     $('#comments').val(data.comments);
        //     $('#compose-modal').modal('show');
        // });  

        // $('#mytable tbody').on('click', 'tr', function () {
        //     if ($(this).hasClass('active')) {
        //         $(this).removeClass('active');
        //     } else {
        //         table.$('tr.active').removeClass('active');
        //         $(this).addClass('active');
        //     }
        // })   

        // // Event handler untuk klik pada baris
        // $('#mytable tbody').on('click', 'tr', function() {
        //     let rowData = table.row(this).data();
        //     let rowId = rowData.id_project;
        //     $(this).removeClass('highlight');
        //     $(this).removeClass('highlight-edit');
        // });
                            
    });
</script>