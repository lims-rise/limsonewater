<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Processing | Moisture Content </h3>
                    </div>
                    <!-- <form role="form"  id="formKeg" method="post" class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <input class="form-control " id="id_project" type="hidden"  value="<?php echo $id_project ?>"  disabled>
                                </div>
                                <div class="col-sm-4">
                                    <input class="form-control " id="client" type="hidden"  value="<?php echo $client ?>"  disabled>
                                </div>
                                <div class="col-sm-4">
                                    <input class="form-control " id="id_one_water_sample" type="hidden"  value="<?php echo $id_one_water_sample ?>"  disabled>
                                </div>
                            </div>
                        </div>
                    </form> -->
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                            <!-- <?php
                                    $lvl = $this->session->userdata('id_user_level');
                                    if ($lvl != 4){
                                        echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Moisture Content</button>";
                                    }
                            ?>         -->
                            <?php echo anchor(site_url('Moisture_content/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to XLS', 'class="btn btn-success"'); ?>
                        </div>
                            <div class="table-responsive">
                                <table class="table ho table-bordered table-striped tbody" id="mytable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID One Water Sample</th>
                                            <th>Lab Tech</th>
                                            <th>Date Assay Start</th>
                                            <th>Sample Type</th>
                                            <th>Barcode Moisture Content</th>
                                            <th>Tray Weight(g)</th>
                                            <th>Tray Sample(g) Wet Weight</th>
                                            <th>Time Incubator</th>
                                            <th>Comments</th>
                                            <!-- <th>Date of Collected</th>
                                            <th>Date of Collected</th> -->
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
                    <form id="formSample"  action= <?php echo site_url('Moisture_content/save') ?> method="post" class="form-horizontal">
                        <div class="modal-body">
                            <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                            <input id="idx_moisture" name="idx_moisture" type="hidden" class="form-control input-sm">
                            <!-- <input id="id_req" name="id_req" type="hidden" class="form-control input-sm"> -->
                            
                            <div class="form-group">
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
                                <label for="date_start" class="col-sm-4 control-label">Date Assay Start</label>
                                <div class="col-sm-8">
                                    <input id="date_start" name="date_start" type="date" class="form-control" placeholder="Date Assay Start" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d'); ?>">
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
                                <label for="barcode_moisture_content" class="col-sm-4 control-label">Barcode Moisture Content</label>
                                <div class="col-sm-8">
                                    <input id="barcode_moisture_content" name="barcode_moisture_content" placeholder="Barcode Moisture Content" type="text" class="form-control" required>
                                    <div class="val1tip"></div>
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <label for="tray_weight" class="col-sm-4 control-label">Try weight(g)</label>
                                <div class="col-sm-8">
                                    <input id="tray_weight" name="tray_weight" type="number" step="0.01"  class="form-control" placeholder="Try weight(g)" required>
                                </div>
                            </div> -->

                            <div class="form-group" id="tray_weight_container" style="display: none;">
                                <label for="tray_weight" class="col-sm-4 control-label">Tray Weight(g)</label>
                                <div class="col-sm-8">
                                    <input id="tray_weight" name="tray_weight" type="number" step="0.01" class="form-control" placeholder="Tray Weight(g)">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="traysample_wetweight" class="col-sm-4 control-label">Tray Sample(g) Wet Weight</label>
                                <div class="col-sm-8">
                                    <input id="traysample_wetweight" name="traysample_wetweight" type="number" step="0.01"  class="form-control" placeholder="Tray Sample(g) Wet Weight" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="time_incubator" class="col-sm-4 control-label">Time in Incubator</label>
                                <div class="col-sm-8">
                                    <input id="time_incubator" name="time_incubator" type="date" class="form-control" placeholder="Time in Incubator" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="comments" class="col-sm-4 control-label">Comments</label>
                                <div class="col-sm-8">
                                    <textarea id="comments" name="comments" class="form-control" placeholder="Comments"></textarea>
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
                <h4 class="modal-title"><i class="fa fa-trash"></i> Moisture Content | Delete <span id="my-another-cool-loader"></span></h4>
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
    // Fungsi untuk mendapatkan parameter dari URL
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        console.log('Current URL:', window.location.search);  // Cek URL yang sedang diakses
        return urlParams.get(param);
    }
    $(document).ready(function() {
        const params = new URLSearchParams(window.location.search);
        const barcodeFromUrl = params.get('barcode');

        if (barcodeFromUrl) {
            $('#barcode_moisture_content').val(barcodeFromUrl);
            $('#barcode_moisture_content').attr('readonly', true);
            $('#compose-modal').modal('show');
            handleSampleTypeInput('#sampletype');
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Moisture Content | New<span id="my-another-cool-loader"></span>');
            $('#id_one_water_sample').val('');
            $('#id_one_water_sample').show();
            $('#idx_one_water_sample').hide();
            $('#id_person').val('');
            $('#sampletype').val('');
            $('#sampletype').attr('readonly', true);
            $('#tray_weight').val('');
            $('#traysample_wetweight').val('');
            $('#comments').val('');
        } else {
            console.log('Barcode tidak ditemukan di URL');
        }

        // Pembatalan dan kembali ke halaman sebelumnya
        $(document).on('click', '#cancelButton', function() {
            // Ambil URL asal dari document.referrer (halaman yang mengarah ke halaman ini)
            var previousUrl = document.referrer;
            
            // Jika ada URL asal, arahkan kembali ke sana
            if (previousUrl) {
                window.location.href = previousUrl;
            } 
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
            let url = '<?php echo site_url('Moisture_content/delete'); ?>/' + id;
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


        
        // Saat form disubmit
        // $('#formSample').on('submit', function(event) {
        //     let sampletype = $('#sampletype').val().toLowerCase();
        //     if (sampletype !== 'soil') {
        //         // Jika sampletype bukan 'soil', pastikan tray_weight tidak divalidasi
        //         $('#tray_weight').removeAttr('required');
        //     } else {
        //         $('#tray_weight').attr('required', 'required'); // Tambahkan required jika sampletype adalah 'soil'
        //     }
        // });

        $('.idOneWaterSampleSelect').change(function() {
            let id_one_water_sample = $(this).val(); // Mendapatkan ID produk yang dipilih
            if (id_one_water_sample) {
                $.ajax({
                    url: '<?php echo site_url('Moisture_content/getIdOneWaterDetails'); ?>', // URL untuk request AJAX
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

        $('#barcode_moisture_content').on("change", function() {
            let barcodeMoistureContent = $('#barcode_moisture_content').val();
            $.ajax({
                type: "GET",
                url: "Moisture_content/validateBarcodeMoistureContent",
                data: { id: barcodeMoistureContent },
                dataType: "json",
                success: function(data) {
                    if (data.length == 1) {
                        let tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode Moisture Content <strong> ' + barcodeMoistureContent +'</strong> is already in the system !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#barcode_moisture_content').focus();
                        $('#barcode_moisture_content').val('');       
                        $('#barcode_moisture_content').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_moisture_content').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_moisture_content').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_moisture_content').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    } else if (/[^a-zA-Z0-9]/.test(barcodeMoistureContent)) {
                        let tip = $('<span><i class="fa fa-exclamation-triangle"></i>  Wrong type <strong>' + barcodeMoistureContent +'</strong> Input must not contain symbols !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#barcode_moisture_content').focus();
                        $('#barcode_moisture_content').val('');
                        $('#barcode_moisture_content').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_moisture_content').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_moisture_content').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_moisture_content').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
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
            ajax: {"url": "Moisture_content/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "id_one_water_sample"},
                {"data": "initial"},
                {"data": "date_start"},
                {"data": "sampletype"},
                {"data": "barcode_moisture_content"},
                {"data": "tray_weight"},
                {"data": "traysample_wetweight"},
                {"data": "time_incubator"},
                {"data": "comments"},
                // {"data": "date_collected"},
                // {"data": "time_collected"},
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
            let rowId = rowData.id_moisture;
            $(this).removeClass('highlight');
            $(this).removeClass('highlight-edit');
        });

        $('#addtombol').click(function() {
            const params = new URLSearchParams(window.location.search);
            const barcodeFromUrl = params.get('barcode');

            if (barcodeFromUrl) {
                $('#barcode_moisture_content').val(barcodeFromUrl).trigger('change');;
            } else {
                console.log('Barcode tidak ditemukan di URL');
            }
            handleSampleTypeInput('#sampletype');
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Moisture Content | New<span id="my-another-cool-loader"></span>');
            $('#id_one_water_sample').val('');
            $('#id_one_water_sample').show();
            $('#idx_one_water_sample').hide();
            $('#id_person').val('');
            $('#sampletype').val('');
            $('#sampletype').attr('readonly', true);
            $('#tray_weight').val('');
            $('#traysample_wetweight').val('');
            $('#comments').val('');
            // $('#barcode_moisture_content').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Moisture Content | Update<span id="my-another-cool-loader"></span>');
            $('#idx_moisture').val(data.id_moisture);
            $('#id_one_water_sample').hide();
            $('#idx_one_water_sample').show();
            $('#idx_one_water_sample').attr('readonly', true);
            $('#idx_one_water_sample').val(data.id_one_water_sample);
            $('#id_person').val(data.id_person);
            $('#date_start').val(data.date_start);
            $('#id_sampletype').val(data.id_sampletype);
            // $('#sampletype').val(data.sampletype);
            $('#sampletype').attr('readonly', true);
            $('#sampletype').on('input', function() {
                if ($(this).val().toLowerCase() === "soil") {
                    $('#tray_weight_container').show();
                } else {
                    $('#tray_weight_container').hide();
                }
            }).val(data.sampletype).trigger('input');
            $('#tray_weight').val(data.tray_weight);
            $('#traysample_wetweight').val(data.traysample_wetweight);
            $('#time_incubator').val(data.time_incubator);
            $('#comments').val(data.comments);
            $('#barcode_moisture_content').val(data.barcode_moisture_content);
            // $('#barcode_moisture_content').attr('readonly', true);
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