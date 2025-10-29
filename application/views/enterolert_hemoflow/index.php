<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Processing | Enterolert Hemoflow </h3>
                    </div>
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                            <!-- <?php
                                    $lvl = $this->session->userdata('id_user_level');
                                    if ($lvl != 4){
                                        echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Enterolert Idexx - Water</button>";
                                    }
                            ?>         -->
                            <?php echo anchor(site_url('Enterolert_hemoflow/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to XLS', 'class="btn btn-success"'); ?>
                        </div>
                            <div class="table-responsive">
                                <table class="table ho table-bordered table-striped tbody" id="mytable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID One Water Sample</th>
                                            <th>Lab Tech</th>
                                            <th>Sample Type</th>
                                            <th>Enterolert Barcode</th>
                                            <th>Date Sample</th>
                                            <th>Time Sample</th>
                                            <th>Volume in Bottle (mL)</th>
                                            <th>Dilution</th>
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
    <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                        <h4 class="modal-title" id="modal-title">Moisture Content | New</h4>
                    </div>
                    <form id="formSample"  action= <?php echo site_url('Enterolert_hemoflow/save') ?> method="post" class="form-horizontal">
                        <div class="modal-body">
                            <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                            <input id="idx_enterolert" name="idx_enterolert" type="hidden" class="form-control input-sm">
                            
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
                                <label for="sampletype" class="col-sm-4 control-label">Sample Type</label>
                                <div class="col-sm-8">
                                    <input id="id_sampletype" name="id_sampletype" placeholder="Sample Type" type="hidden" class="form-control">
                                    <input id="sampletype" name="sampletype" placeholder="Sample Type" type="text" class="form-control smple">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="enterolert_hemoflow_barcode" class="col-sm-4 control-label">Enterolert Barcode</label>
                                <div class="col-sm-8">
                                    <input id="enterolert_hemoflow_barcode" name="enterolert_hemoflow_barcode" placeholder="Enterolert Barcode" type="text" class="form-control" required>
                                    <!-- <div class="val1tip"></div> -->
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="date_sample" class="col-sm-4 control-label">Date Sample</label>
                                <div class="col-sm-8">
                                    <input id="date_sample" name="date_sample" type="date" class="form-control" placeholder="Date Sample" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="time_sample" class="col-sm-4 control-label">Time Sample</label>
                                <div class="col-sm-8">
                                    <div class="input-group clockpicker">
                                    <input id="time_sample" name="time_sample" class="form-control" placeholder="Time Sample" value="<?php 
                                    $datetime = new DateTime();
                                    echo $datetime->format( 'H:i' );
                                    ?>">
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="volume_bottle" class="col-sm-4 control-label">Volume in bottle (mL) added</label>
                                <div class="col-sm-8">
                                    <input id="volume_bottle" name="volume_bottle" type="number" step="0.001"  class="form-control" placeholder="Volume in bottle (mL) added" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="dilution" class="col-sm-4 control-label">Dilution</label>
                                <div class="col-sm-8">
                                    <input id="dilution" name="dilution" type="text" class="form-control" placeholder="Dilution">
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
                <h4 class="modal-title"><i class="fa fa-trash"></i> Enterolert Idexx In | Delete <span id="my-another-cool-loader"></span></h4>
            </div>
            <div class="modal-body">
                <div id="confirmation-content">
                    <div class="modal-body">
                        <p class="text-center" style="font-size: 15px;">Are you sure you want to delete Sample <span id="id" style="font-weight: bold;"></span> ?</p>
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
    .hidden {
        visibility: hidden;
        position: absolute;
        width: 0;
        height: 0;
        overflow: hidden;
    }
</style>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    let table;
    let deleteUrl; // Variable to hold the delete URL
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
            $('#enterolert_hemoflow_barcode').val(barcodeFromUrl);
            $('#enterolert_hemoflow_barcode').attr('readonly', true);
            handleSampleTypeInput('#sampletype');
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Enterolert Hemoflow | New<span id="my-another-cool-loader"></span>');
            $('#id_one_water_sample').attr('readonly', true);
            $('#id_one_water_sample').val(idOneWaterSampleFromUrl || '');  // Set ID jika ada
            $('#idx_one_water_sample').hide();
            // $('#id_one_water_sample').show();
            // $('#idx_one_water_sample').hide();
            $('#id_person').val('');
            $('#sampletype').val('');
            $('#sampletype').attr('readonly', true);
            // $('#enterolert_hemoflow_barcode').val('');
            $('#volume_bottle').val('');
            $('#dilution').val('');
            $('#dilution').attr('readonly', true);
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




        $('#volume_bottle').on("keyup change click", function() {
            $('#dilution').val($('#volume_bottle').val()/100);
        });

        function handleSampleTypeInput(selector) {
            $(selector).on('input', function() {
                let sampleTypeValue = $(this).val().toLowerCase();
                if (sampleTypeValue === 'soil') {
                    $('#tray_weight_container').show();
                } else {
                    $('#tray_weight_container').hide();
                }
            });
        }

        function showConfirmation(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('Enterolert_hemoflow/delete'); ?>/' + id;
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
            console.log('test'+ id_one_water_sample)
            if (id_one_water_sample) {
                $.ajax({
                    url: '<?php echo site_url('Enterolert_hemoflow/getIdOneWaterDetails'); ?>', // URL untuk request AJAX
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
                url: "Enterolert_hemoflow/barcode_restrict?id1="+id_one_water_sample,
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

        // $('#compose-modal').on('shown.bs.modal', function () {
		// 	$('#id_client_sample').focus();
        //      $('#budget_req').on('input', function() {
        //          formatNumber(this);
        //          });
        //     });
    

        // $("input").keypress(function(){
        //     $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
        // });

        // $("input").click(function(){
        //     setTimeout(function(){
        //         $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
        //     }, 3000);                            
        // });

        // $("input").keypress(function(){
        //     $('.val1tip').tooltipster('hide');   
        // });

        // $("input").click(function(){
        //     setTimeout(function(){
        //         $('.val1tip').tooltipster('hide');   
        //     }, 3000);                            
        // });
        
        // $('#enterolert_hemoflow_barcode').on("change", function() {
        //     let enterolertBarcode = $('#enterolert_hemoflow_barcode').val();
        //     $.ajax({
        //         type: "GET",
        //         url: "Enterolert_hemoflow/validateEnterolertBarcode",
        //         data: { id: enterolertBarcode },
        //         dataType: "json",
        //         success: function(data) {
        //             if (data.length == 1) {
        //                 let tip = $('<span><i class="fa fa-exclamation-triangle"></i> Enterolert Barcode <strong> ' + enterolertBarcode +'</strong> is already in the system !</span>');
        //                 $('.val1tip').tooltipster('content', tip);
        //                 $('.val1tip').tooltipster('show');
        //                 $('#enterolert_hemoflow_barcode').focus();
        //                 $('#enterolert_hemoflow_barcode').val('');       
        //                 $('#enterolert_hemoflow_barcode').css({'background-color' : '#FFE6E7'});
        //                 setTimeout(function(){
        //                     $('#enterolert_hemoflow_barcode').css({'background-color' : '#FFFFFF'});
        //                     setTimeout(function(){
        //                         $('#enterolert_hemoflow_barcode').css({'background-color' : '#FFE6E7'});
        //                         setTimeout(function(){
        //                             $('#enterolert_hemoflow_barcode').css({'background-color' : '#FFFFFF'});
        //                         }, 300);
        //                     }, 300);
        //                 }, 300);
        //             } else if (/[^a-zA-Z0-9]/.test(enterolertBarcode)) {
        //                 let tip = $('<span><i class="fa fa-exclamation-triangle"></i>  Wrong type <strong>' + enterolertBarcode +'</strong> Input must not contain symbols !</span>');
        //                 $('.val1tip').tooltipster('content', tip);
        //                 $('.val1tip').tooltipster('show');
        //                 $('#enterolert_hemoflow_barcode').focus();
        //                 $('#enterolert_hemoflow_barcode').val('');
        //                 $('#enterolert_hemoflow_barcode').css({'background-color' : '#FFE6E7'});
        //                 setTimeout(function(){
        //                     $('#enterolert_hemoflow_barcode').css({'background-color' : '#FFFFFF'});
        //                     setTimeout(function(){
        //                         $('#enterolert_hemoflow_barcode').css({'background-color' : '#FFE6E7'});
        //                         setTimeout(function(){
        //                             $('#enterolert_hemoflow_barcode').css({'background-color' : '#FFFFFF'});
        //                         }, 300);
        //                     }, 300);
        //                 }, 300);
        //             }
        //         }
        //     });
        // });

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
            // initComplete: function() {
            //     var api = this.api();
            //     $('#mytable_filter input')
            //             .off('.DT')
            //             .on('keyup.DT', function(e) {
            //                 if (e.keyCode == 13) {
            //                     api.search(this.value).draw();
            //                 }
            //     });
            // },
            oLanguage: {
                sProcessing: "loading..."
            },
            // select: true;
            processing: true,
            serverSide: true,
            ajax: {"url": "Enterolert_hemoflow/json", "type": "POST"},
            columns: [
                {"data": "id_one_water_sample"},
                {"data": "initial"},
                {"data": "sampletype"},
                {"data": "enterolert_hemoflow_barcode"},
                {"data": "date_sample"},
                {"data": "time_sample"},
                {"data": "volume_bottle"},
                {"data": "dilution"},
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
            // order: [[0, 'asc']],
            // rowCallback: function(row, data, iDisplayIndex) {
            //     var info = this.fnPagingInfo();
            //     var page = info.iPage;
            //     var length = info.iLength;
            //     // var index = page * length + (iDisplayIndex + 1);
            //     // $('td:eq(0)', row).html(index);
            // },
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
            let rowId = rowData.id_enterolert_hemoflow;
            $(this).removeClass('highlight');
            $(this).removeClass('highlight-edit');
        });

        $('#addtombol').click(function() {
            const params = new URLSearchParams(window.location.search);
            const barcodeFromUrl = params.get('barcode');

            if (barcodeFromUrl) {
                $('#enterolert_hemoflow_barcode').val(barcodeFromUrl).trigger('change');;
            } else {
                console.log('Barcode tidak ditemukan di URL');
            }
            handleSampleTypeInput('#sampletype');
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Enterolert Hemoflow | New<span id="my-another-cool-loader"></span>');
            $('#id_one_water_sample').val('');
            $('#id_one_water_sample').show();
            $('#idx_one_water_sample').hide();
            $('#id_person').val('');
            $('#sampletype').val('');
            $('#sampletype').attr('readonly', true);
            // $('#enterolert_hemoflow_barcode').val('');
            $('#volume_bottle').val('');
            $('#dilution').val('');
            $('#dilution').attr('readonly', true);
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Enterolert Hemoflow | Update<span id="my-another-cool-loader"></span>');
            $('#idx_enterolert').val(data.id_enterolert_hemoflow);
            $('#id_one_water_sample').hide();
            // $('#idx_one_water_sample').show();
            $('#idx_one_water_sample').attr('readonly', true);
            $('#idx_one_water_sample').val(data.id_one_water_sample);
            $('#id_person').val(data.id_person);
            $('#id_sampletype').val(data.id_sampletype);
            $('#sampletype').val(data.sampletype);
            $('#sampletype').attr('readonly', true);
            $('#enterolert_hemoflow_barcode').val(data.enterolert_hemoflow_barcode);
            $('#enterolert_hemoflow_barcode').attr('readonly', true);
            $('#date_sample').val(data.date_sample);
            $('#time_sample').val(data.time_sample);
            $('#volume_bottle').val(data.volume_bottle);
            $('#dilution').val(data.dilution);
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