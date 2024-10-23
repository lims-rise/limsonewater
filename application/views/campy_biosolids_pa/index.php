<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Processing | Campy Biosolids PA </h3>
                    </div>
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                            <?php
                                    $lvl = $this->session->userdata('id_user_level');
                                    if ($lvl != 4){
                                        echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Campy Biosolids PA</button>";
                                    }
                            ?>        
                            <?php echo anchor(site_url('Campy_biosolids_pa/excel_all'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to XLS', 'class="btn btn-success"'); ?>
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
                <form id="formSample" action="<?php echo site_url('Campy_biosolids_pa/save') ?>" method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <input id="id_campy_biosolids_pa" name="id_campy_biosolids_pa" type="hidden" class="form-control input-sm">
                        
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
                                <input id="sample_wetweight" name="sample_wetweight" type="number" step="0.01" class="form-control" placeholder="Sample Wet Weight(g)" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="elution_volume" class="col-sm-4 control-label">Elution Volume(mL)</label>
                            <div class="col-sm-8">
                                <input id="elution_volume" name="elution_volume" type="number" step="0.01" class="form-control" placeholder="Elution Volume(mL)" required>
                            </div>
                        </div>

                        <div class="form-group" id="sampleTubeContainer">
                            <label class="col-sm-4 control-label">Volume of The Sample(uL)</label>
                            <div class="col-sm-8" id="sampleVolumeInputs">
                                <input id="vol_sampletube1" name="vol_sampletube1" type="number" step="0.01" class="form-control" placeholder="Volume of The Sample(uL) Tube1" required>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer clearfix">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
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

</style>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    let table;
    let deleteUrl; // Variable to hold the delete URL
    $(document).ready(function() {

        $('#compose-modal').on('hide.bs.modal', function () {
            $(this).find('input[type="radio"]').prop('checked', false); // Reset semua radio button
        });


        $('#number_of_tubes').change(function() {
            let numberOfTubes = parseInt($(this).val()); // Get the selected value as an integer
            let sampleVolumeInputs = $('#sampleVolumeInputs');
            sampleVolumeInputs.empty(); // Clear existing inputs

            // Create the required number of inputs and labels
            for (let i = 1; i <= numberOfTubes; i++) {
                sampleVolumeInputs.append(
                    `<div class="form-group">
                        <label for="vol_sampletube${i}" class="control-label">Volume of The Sample(uL) Tube ${i}</label>
                        <input id="vol_sampletube${i}" name="vol_sampletube${i}" type="number" step="0.01" class="form-control sample-input" placeholder="Volume of The Sample(uL) Tube ${i}" required>
                    </div>`
                );
            }
        }).trigger('change');



        function showConfirmation(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_deleteCampyBiosolids', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('Campy_biosolids_pa/delete_campyBiosolids'); ?>/' + id;
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

        $('#campy_assay_barcode').on("change", function() {
            let campyAssayBarcode = $('#campy_assay_barcode').val();
            console.log(campyAssayBarcode);
            $.ajax({
                type: "GET",
                url: "Campy_biosolids_pa/validateCampyAssayBarcode",
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
            ajax: {"url": "Campy_biosolids_pa/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "id_one_water_sample"},
                {"data": "initial"},
                {"data": "sampletype"},
                {"data": "number_of_tubes"},
                {"data": "mpn_pcr_conducted"},
                {"data": "campy_assay_barcode"},
                {"data": "date_sample_processed"},
                {"data": "time_sample_processed"},
                {"data": "sample_wetweight"},
                {"data": "elution_volume"},
                {"data": "vol_sampletube"},
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
            let rowId = rowData.id_campy_biosolids_pa;
            $(this).removeClass('highlight');
            $(this).removeClass('highlight-edit');
        });

        $('#addtombol').click(function() {
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Campy Biosolids PA | New<span id="my-another-cool-loader"></span>');
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

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Campy Biosolids PA | Update<span id="my-another-cool-loader"></span>');
            $('#id_campy_biosolids_pa').val(data.id_campy_biosolids_pa);
            $('#id_one_water_sample').hide();
            $('#idx_one_water_sample').show();
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
                        <label for="vol_sampletube${tubeNumber}" class="control-label">Volume of The Sample(uL) Tube ${tubeNumber}</label>
                        <input id="vol_sampletube${tubeNumber}" name="vol_sampletube${tubeNumber}" type="number" step="0.01" class="form-control sample-input" placeholder="Volume of The Sample(uL) Tube ${tubeNumber}" value="${volume}" required>
                    </div>`
                );
            });
            $('#comments').val(data.comments);
            $('#barcode_moisture_content').val(data.barcode_moisture_content);
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
