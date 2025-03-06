<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Processing | Extraction metagenome </h3>
                    </div>
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                            <!-- <?php
                                $lvl = $this->session->userdata('id_user_level');
                                    if ($lvl != 4){
                                         echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Extraction metagenome</button>";
                                    }
                            ?>         -->
                            <?php echo anchor(site_url('Extraction_metagenome/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to XLS', 'class="btn btn-success"'); ?>
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
                    <h4 class="modal-title" id="modal-title">Extraction metagenome | New</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('Extraction_metagenome/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <input id="id_testing_type" name="id_testing_type" type="hidden" class="form-control input-sm">

                        <div class="form-group">
                            <label for="id_one_water_sample" class="col-sm-4 control-label">One Water Sample ID</label>
                            <div class="col-sm-8">
                                <input id="id_one_water_sample" name="id_one_water_sample" placeholder="One Water Sample ID" type="text" class="form-control">
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
                            <label for="number_sample" class="col-sm-4 control-label">Number of Samples</label>
                            <div class="col-sm-8">
                                <input id="number_sample" name="number_sample" placeholder="Number of Samples" type="text" class="form-control" required>
                            </div>
                        </div>
                        <hr>	                        
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

    <!-- MODAL FORM DETAIL -->
    <div class="modal fade" id="compose-modal-child" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                    <h4 class="modal-title" id="modal-title">Extraction Metagenome | Detail </h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('Extraction_metagenome/update_child') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode-child" name="mode-child" type="hidden" class="form-control input-sm">

                        <div class="form-group">
                            <label for="barcode_sample1" class="col-sm-4 control-label">Barcode Sample</label>
                            <div class="col-sm-8">
                                <input id="barcode_sample1" name="barcode_sample1" placeholder="Barcode Sample" type="text" class="form-control" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
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
                        </div>

                        <hr>

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
                            <label for="dna_concentration" class="col-sm-4 control-label">DNA Concentration (ng/ul)</label>
                            <div class="col-sm-8">
                                <input id="dna_concentration" name="dna_concentration" placeholder="DNA Concentration (ng/ul)" type="number" step="0.1" class="form-control">
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

                    </div>
                    <div class="modal-footer clearfix">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        <button type="button" class="btn btn-warning"  data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
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
                <h4 class="modal-title"><i class="fa fa-trash"></i> Extraction metagenome | Delete <span id="my-another-cool-loader"></span></h4>
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
</style>

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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Extraction Metagenome | New<span id="my-another-cool-loader"></span>');

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

        $(document).on('click', '#cancelButton', function() {
            // Ambil URL asal dari document.referrer (halaman yang mengarah ke halaman ini)
            var previousUrl = document.referrer;
            
            // Jika ada URL asal, arahkan kembali ke sana
            if (previousUrl) {
                window.location.href = previousUrl;
            } 
        });


        function showConfirmation(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('Extraction_metagenome/delete_extraction'); ?>/' + id;
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

        $('#id_one_water_sample').on("change", function() {
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
            data1 = $('#id_one_water_sample').val();
            $.ajax({
                type: "GET",
                url: "Extraction_metagenome/barcode_restrict?id1="+data1,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Id One Water Sample <strong> ' + data1 +'</strong> is already in the system !</span>');
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
                url: "Extraction_metagenome/load_freez?id1="+data1,
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
                url: "Extraction_metagenome/get_freez?id1="+data1+"&id2="+data2+"&id3="+data3+"&id4="+data4,
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


        // table = $("#mytable").DataTable({
        //     // initComplete: function() {
        //     //     var api = this.api();
        //     //     $('#mytable_filter input')
        //     //             .off('.DT')
        //     //             .on('keyup.DT', function(e) {
        //     //                 if (e.keyCode == 13) {
        //     //                     api.search(this.value).tray();
        //     //                 }
        //     //     });
        //     // },
        //     oLanguage: {
        //         sProcessing: "loading..."
        //     },
        //     // select: true;
        //     processing: true,
        //     serverSide: true,
        //     ajax: {"url": "Extraction_metagenome/json", "type": "POST"},
        //     columns: [
        //         // {
        //         //     "data": "barcode_sample",
        //         //     "orderable": false
        //         // },
        //         {"data": "barcode_sample"},
        //         {"data": "id_one_water_sample"},
        //         {"data": "initial"},
        //         {"data": "sampletype"},
        //         {"data": "date_extraction"},
        //         {"data": "comments"},
        //         {
        //             "data" : "action",
        //             "orderable": false,
        //             "className" : "text-center"
        //         }
        //     ],
		// 	// columnDefs: [
		// 	// 	{
		// 	// 		targets: [5], // Index of the 'estimate_price' column
		// 	// 		className: 'text-right' // Apply right alignment to this column
		// 	// 	}
		// 	// ],
        //     order: [[1, 'desc']],
        //     order: [[0, 'desc']],
        //     rowCallback: function(row, data, iDisplayIndex) {
        //         var info = this.fnPagingInfo();
        //         var page = info.iPage;
        //         var length = info.iLength;
        //         // var index = page * length + (iDisplayIndex + 1);
        //         // $('td:eq(0)', row).html(index);
        //     },
        //     // initComplete: function() {
        //     //     let api = this.api();
        //     //     let firstRow = api.row(0).node();
        //     //     $(firstRow).addClass('highlight');
        //     // }
        //     drawCallback: function(settings) {
        //         let api = this.api();
        //         let pageInfo = api.page.info();
        //         if (pageInfo.page === 0) {
        //             let firstRow = api.row(0).node();
        //             $(firstRow).addClass('highlight');
        //         }
        //     }
        // });
        table = $("#mytable").DataTable({
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "Extraction_metagenome/json", "type": "POST"},
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
            }
        });

        $('#mytable tbody').on('click', '.toggle-child', function () {
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
                    url: `Extraction_metagenome/get_extractions_by_project/${id_one_water_sample}`,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        let tableContent = `
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
                                    <tbody>
                        `;

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
                                    </tr>
                                `;
                            });
                        } else {
                            tableContent += `<tr><td colspan="5" class="text-center">No samples available</td></tr>`;
                        }

                        tableContent += `</tbody></table></div>`;
                        row.child(tableContent).show();
                        icon.removeClass('fa-spinner fa-spin').addClass('fa-minus-square');
                    },
                });
            }
        }); 

        $('#mytable').on('click', '.btn_edit_child', function() {
            let barcode_sample = $(this).data('id');
            $('#mode-child').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Sample reception | Update<span id="my-another-cool-loader"></span>');
            $('#modal-sample-body').html('<div class="text-center py-3"><i class="fa fa-spinner fa-spin"></i> Loading...</div>');

            $.ajax({
                url: `Extraction_metagenome/get_extraction_child/${barcode_sample}`,
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
                    $('#date_extraction').val(data.date_extraction).trigger('change');
                    $('#id_kit').val(data.id_kit).trigger('change');
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
                    $('#comments').val(data.comments);


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
            let url = '<?php echo site_url('Extraction_metagenome/delete_child'); ?>/' + barcode_sample;
            $('#confirm-modal #id').text(barcode_sample);
            console.log(id);
            showConfirmation(url);
        });

        // $('#addtombol').click(function() {
        //     $('#mode').val('insert');
        //     $('#modal-title').html('<i class="fa fa-wpforms"></i> Extraction metagenome | New<span id="my-another-cool-loader"></span>');
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
        //     $('#id_kit').val('');
        //     $('#kit_lot').val('');
        //     $('#barcode_tube').val('');
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
        //     $('#modal-title').html('<i class="fa fa-pencil-square-o"></i> Extraction metagenome | Update<span id="my-another-cool-loader"></span>');
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
        //     $('#id_kit').val(data.id_kit).trigger('change');
        //     $('#kit_lot').val(data.kit_lot);
        //     $('#barcode_tube').val(data.barcode_tube);
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

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
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
            // $('#sampletype').attr('readonly', true);
            // $('#sampletype').val('');
            // $('#comments').val('');
            // $('#number_sample').val();
            $('#compose-modal').modal('show');
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