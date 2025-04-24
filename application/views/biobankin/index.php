<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Processing | Biobank-IN </h3>
                    </div>
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                            <!-- <?php
                                    $lvl = $this->session->userdata('id_user_level');
                                    if ($lvl != 4){
                                        echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Biobank-IN</button>";
                                    }
                            ?>         -->
                            <!-- <?php echo anchor(site_url('Biobankin/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to XLS', 'class="btn btn-success"'); ?> -->
                        </div>
                            <div class="table-responsive">
                                <table class="table ho table-bordered table-striped tbody" id="mytable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>One Water ID</th>
                                            <th>Date Conduct</th>
                                            <th>Sample Type</th>
                                            <th>Lab Tech</th>
                                            <th>Replicates</th>
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
        </div>
    </section>
</div>

<style>
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
        color: #FDAB9E;  /* Red color for close icon */
    }

    .close-card:hover {
        color: #bd2130; /* Darker red when hovered */
    }

    .unreview {
        color: gray !important;
        border-color: gray !important;
        box-shadow: none; /* Override Bootstrap box-shadow */
    }

    /* input.form-check-label. */
    .review {
        color: green !important;
        border-color: green !important;
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
</style>

<!-- MODAL FORM -->
    <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header box">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="modal-title">Biobank-IN | New</h4>
                    </div>
                    <form id="formSample"  action= <?php echo site_url('Biobankin/save') ?> method="post" class="form-horizontal">
                        <div class="modal-body">
                            <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                            <input id="user_review" name="user_review" type="hidden" class="form-control input-sm">
                            <!-- <input id="id_req" name="id_req" type="hidden" class="form-control input-sm"> -->


                            <!-- <div class="form-group">
                                <label for="id_one_water_sample" class="col-sm-4 control-label">One Water Sample ID</label>
                                <div class="col-sm-8">
                                    <input id="id_one_water_sample" name="id_one_water_sample" placeholder="One Water Sample ID" type="text" class="form-control">
                                    <select id="id_one_water_sample_list" name="id_one_water_sample_list" class="form-control" required>
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
                                    <input id="id_one_water_sample" name="id_one_water_sample" placeholder="One Water Sample ID" type="text"  class="form-control idOneWaterSampleSelect">
                                    <input id="idx_one_water_sample" name="idx_one_water_sample" placeholder="One Water Sample ID" type="text" class="form-control">
                                    <div class="val1tip"></div>
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
                                <label for="date_conduct" class="col-sm-4 control-label">Date Conduct</label>
                                <div class="col-sm-8">
                                    <input id="date_conduct" name="date_conduct" type="date" class="form-control" placeholder="Date Conduct" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d'); ?>">
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
                    
                            <!-- <div class="form-group">
                                <label for="replicates" class="col-sm-4 control-label">Replicates</label>
                                <div class="col-sm-8">
                                    <select id="replicates" name="replicates" class="form-control" required>
                                        <option value="" disabled selected='selected'>-- Select Replication --</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div> -->

                            <div class="form-group">
                                <label for="replicates" class="col-sm-4 control-label">Replicates</label>
                                <div class="col-sm-8">
                                    <input id="replicates" name="replicates" placeholder="Replicates" type="number" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                    <label for="comments" class="col-sm-4 control-label">Comments</label>
                                    <div class="col-sm-8">
                                        <textarea id="comments" name="comments" class="form-control" placeholder="Comments"> </textarea>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label for="review" class="col-sm-4 control-label">Status</label>
                                <div class="col-sm-8">
                                    <input type="hidden" id="review" name="review" value="0">
                                    <span id="review_label" class="form-check-label unreview" role="button">
                                        Unreview
                                    </span>
                                    
                                    <!-- New label to display who reviewed the data -->
                                    <span id="reviewed_by_label"  style="margin-left: 10px; font-style: italic;  font-weight: bold; font-size: 11px;">
                                        <!-- This will display the name of the reviewer, dynamically set -->
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer clearfix" style="display: flex; align-items: center; justify-content: space-between;">
                            <!-- Info Card on the left side -->
                            <div class="modal-footer-content" style="flex: 1; display: flex; align-items: center;">
                                <div id="textInform2" class="textInform card" style="width: auto; padding: 5px 10px; display: none;">
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
                                <button type="submit" class="btn btn-primary" id="saveButtonDetail"><i class="fa fa-save"></i> Save</button>
                                <button type="button" class="btn btn-warning" id="cancelButton" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                            </div>
                        </div>
                        <!-- <div class="modal-footer clearfix">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                            <button type="button" class="btn btn-warning"  id="cancelButton" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                        </div> -->
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
                    <h4 class="modal-title"><i class="fa fa-trash"></i> Sample Biobank - IN | Delete <span id="my-another-cool-loader"></span></h4>
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

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    let table;
    let id_project = $('#id_project').val();
	let client = $('#client').val();
    let id_one_water_sample = $('#id_one_water_sample').val();

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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Sample reception | New<span id="my-another-cool-loader"></span>');
            $('#id_one_water_sample').attr('readonly', true);
            $('#id_one_water_sample').val(idOneWaterSampleFromUrl || '');  // Set ID jika ada
            $('#idx_one_water_sample').hide();
            $('#id_person').val('');
            $('#sampletype').attr('readonly', true);
            $('#sampletype').val('');
            // $('#date_conduct').val('');
            $('#replicates').val('');
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
            let url = '<?php echo site_url('Biobankin/delete'); ?>/' + id;
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

        $('.idOneWaterSampleSelect').change(function() {
            let id_one_water_sample = $(this).val(); // Mendapatkan ID produk yang dipilih
            if (id_one_water_sample) {
                $.ajax({
                    url: '<?php echo site_url('Biobankin/getIdOneWaterDetails'); ?>', // URL untuk request AJAX
                    type: 'POST',
                    data: { id_one_water_sample: id_one_water_sample }, // Data yang dikirim ke server
                    dataType: 'json', // Format data yang diharapkan dari server
                    success: function(response) {
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
                url: "Biobankin/barcode_restrict?id1="+id_one_water_sample,
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
            ajax: {"url": "Biobankin/json", "type": "POST"},
            columns: [
                {"data": "id_one_water_sample"},
                {"data": "date_conduct"},
                {"data": "sampletype"},
                {"data": "initial"},
                {"data": "replicates"},
                {"data": "comments"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
			// columnDefs: [
			// 	{
			// 		targets: [5], // Index of the 'estimate_price' column
			// 		className: 'text-right' // Apply right alignment to this column
			// 	}
			// ],
            order: [[0, 'asc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                // var index = page * length + (iDisplayIndex + 1);
                // $('td:eq(0)', row).html(index);
            }
        });

        // $('#addtombol').click(function() {
        //     $('#mode').val('insert');
        //     $('#modal-title').html('<i class="fa fa-wpforms"></i> Sample reception | New<span id="my-another-cool-loader"></span>');
        //     $('#id_one_water_sample').attr('readonly', false);
        //     $('#id_one_water_sample').val('');
        //     $('#id_one_water_sample_list').val('');
        //     $('#id_one_water_sample').hide();
        //     $('#id_one_water_sample_list').show();
        //     $('#id_person').val('');
        //     $('#sampletype').attr('readonly', true);
        //     $('#sampletype').val('');
        //     // $('#date_conduct').val('');
        //     $('#replicates').val('');
        //     $('#comments').val('');
        //     $('#compose-modal').modal('show');
        // });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            let loggedInUser = '<?php echo $this->session->userdata('id_users'); ?>';
            console.log(data);
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Sample reception | Update<span id="my-another-cool-loader"></span>');
            $('#id_one_water_sample').hide();
            // $('#idx_one_water_sample').show();
            $('#idx_one_water_sample').attr('readonly', true);
            $('#idx_one_water_sample').val(data.id_one_water_sample);
            // $('#id_one_water_sample_list').val(data.id_one_water_sample).trigger('change');
            $('#id_person').val(data.id_person).trigger('change');
            $('#sampletype').attr('readonly', true);
            $('#sampletype').val(data.sampletype);
            $('#date_conduct').val(data.date_conduct).trigger('change');
            $('#replicates').val(data.replicates).trigger('change');
            $('#comments').val(data.comments);
            $('#review').val(data.review);
            $('#user_review').val(data.user_review);
            $('#reviewed_by_label').text('Reviewed by: ' + (data.full_name ? data.full_name : '-'));
            if (data.user_created !== loggedInUser) {
                $('#user_review').val(loggedInUser);
                    // Set the checkbox state
                    if (data.review == 1) {
                        $('#review').prop('checked', true); // Check the checkbox
                        const label = document.getElementById('review_label');
                        label.textContent = 'Review';
                        label.className = `form-check-label review`;            
                    } else if (data.review == 0) {
                        $('#review').prop('checked', false); // Uncheck the checkbox
                        const label = document.getElementById('review_label');
                        label.textContent = 'Unreview';
                        label.className = `form-check-label unreview`;            
                    }
                    $('#review').val(data.review);
                                        // Define the states with associated values and labels
                                        const states = [
                        { value: 0, label: "Unreview", class: "unreview" },
                        { value: 1, label: "Review", class: "review" }
                        // { value: 2, label: "Crossed", class: "crossed" }
                    ];

                    let currentState = 0; // Start with "Unchecked"

                    // Add event listener to toggle through states
                    document.getElementById('review_label').addEventListener('click', function () {
                        // Cycle through the states
                        currentState = (currentState + 1) % states.length;

                        const checkbox = document.getElementById('review');
                        const label = document.getElementById('review_label');

                        // Update the label text
                        label.textContent = states[currentState].label;

                        // Apply styling to the label based on the state
                        label.className = `form-check-label ${states[currentState].class}`;

                        // (Optional) Update a hidden input or store the value somewhere for submission
                        checkbox.value = states[currentState].value; // Set the value to the current state
                    });                
            } else {
                $('#user_review').val(loggedInUser);
                if (data.review == 1) {
                        $('#review').prop('checked', true); // Check the checkbox
                        const label = document.getElementById('review_label');
                        label.textContent = 'Review';
                        label.className = `form-check-label review`;            
                    } else if (data.review == 0) {
                        $('#review').prop('checked', false); // Uncheck the checkbox
                        const label = document.getElementById('review_label');
                        label.textContent = 'Unreview';
                        label.className = `form-check-label unreview`;            
                    }
            }
                    // console.log('test user', data.user_created);
                    if (data.user_created === loggedInUser) {
                        $('#saveButtonDetail').prop('disabled', false);  // Enable Save button if user is the same as the one who created
                        showInfoCard('#textInform2', '<i class="fa fa-check-circle"></i> You are the creator', "You have full access to edit this data.", true);
                    } else {
                        $('#saveButtonDetail').prop('disabled', false);  // Disable Save button if user is not the same as the one who created
                        showInfoCard('#textInform2', '<i class="fa fa-times-circle"></i> You are not the creator', "In the case you can review this data and make changes.", false);
                    }
            $('#compose-modal').modal('show');
        });  

        $('#mytable tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }
        });
        
                // Function to show a dynamic info card
                function showInfoCard(target, message, description, isSuccess) {
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

        // Close the card when the 'x' icon is clicked
        $('.close-card').on('click', function() {
            $('#textInform1').fadeOut(); // Fade out the card
            $('#textInform2').fadeOut();
        });
                            
    });
</script>