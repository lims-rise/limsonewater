<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Processing | Hemoflow </h3>
                    </div>
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                            <?php
                                $lvl = $this->session->userdata('id_user_level');
                                    if ($lvl != 4){
                                         echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Extraction Biosolid</button>";
                                    }
                            ?>        
                            <?php echo anchor(site_url('Hemoflow/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to XLS', 'class="btn btn-success"'); ?>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID Onewater Sample</th>
                                        <th>Lab Tech</th>
                                        <th>Sample type</th>
                                        <th>Date Processed</th>
                                        <th>Time Processed</th>
                                        <th>Volume filtered (L)</th>
                                        <th>Volume eluted (mL)</th>
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
                    <h4 class="modal-title" id="modal-title">Hemoflow | New</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('Hemoflow/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <!-- <input id="id_req" name="id_req" type="hidden" class="form-control input-sm"> -->

                        <div class="form-group">
                            <label for="id_one_water_sample" class="col-sm-4 control-label">One Water Sample ID</label>
                            <div class="col-sm-8">
                                <input id="id_one_water_sample" name="id_one_water_sample" placeholder="One Water Sample ID" type="text" class="form-control">
                            <!-- </div>
                        </div>

                        <div class="form-group">
                            <label for="id_one_water_sample" class="col-sm-4 control-label">One Water Sample ID list</label>
                            <div class="col-sm-8"> -->
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
                                <input id="sampletype" name="sampletype" placeholder="Sample Type" type="text" class="form-control">
                            </div>
                        </div>

                        <hr>

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
                            <label for="id_person_proc" class="col-sm-4 control-label">Lab Tech Processed</label>
                            <div class="col-sm-8">
                                <select id="id_person_proc" name="id_person_proc" class="form-control" required>
                                    <option value="" disabled>-- Select Lab Tech Processed --</option>
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
                            <label for="volume_filter" class="col-sm-4 control-label">Volume Filter (L)</label>
                            <div class="col-sm-8">
                                <input id="volume_filter" name="volume_filter" type="number" step="1" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="volume_eluted" class="col-sm-4 control-label">Volume Eluted (mL)</label>
                            <div class="col-sm-8">
                                <input id="volume_eluted" name="volume_eluted" type="number" step="0.1" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                                <label for="comments" class="col-sm-4 control-label">Comments</label>
                                <div class="col-sm-8">
                                    <textarea id="comments" name="comments" class="form-control" placeholder="Comments"> </textarea>
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
</style>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">



    var table
    $(document).ready(function() {


        function showConfirmation(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('Hemoflow/delete'); ?>/' + id;
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


        $('#id_one_water_sample_list').on("change", function() {
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
            data1 = $('#id_one_water_sample_list').val();
            // // ckbar = data1.substring(0,5).toUpperCase();
            // // ckarray = ["N-S2-", "F-S2-", "N-F0-", "F-F0-"];
            // // ck = $.inArray(ckbar, ckarray);
            // if (ck == -1) {
            $.ajax({
                type: "GET",
                url: "Hemoflow/barcode_check?id1="+data1,
                // data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length == 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is not on reception or is already in the system !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#id_one_water_sample_list').focus();
                        $('#id_one_water_sample_list').val('');     
                        $('#sampletype').val('');    
                        $('#id_one_water_sample_list').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#id_one_water_sample_list').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#id_one_water_sample_list').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#id_one_water_sample_list').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                    else {
                        $('#sampletype').val(data[0].sampletype);    
                    }
                }
            });
        // }
        });

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
            ajax: {"url": "Hemoflow/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "id_one_water_sample"},
                {"data": "initial"},
                {"data": "sampletype"},
                {"data": "date_processed"},
                {"data": "time_processed"},
                {"data": "volume_filter"},
                {"data": "volume_eluted"},
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

        $('#addtombol').click(function() {
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Hemoflow | New<span id="my-another-cool-loader"></span>');
            // $('#project_idx').hide();
            $('#id_one_water_sample').attr('readonly', false);
            $('#id_one_water_sample').val('');
            $('#id_one_water_sample_list').val('');
            $('#id_one_water_sample').hide();
            $('#id_one_water_sample_list').show();
            $('#id_person').val('');
            $('#sampletype').attr('readonly', true);
            $('#sampletype').val('');
            $('#id_person_proc').val('');
            // $('#date_processed').val('');
            $('#volume_filter').val('');
            $('#volume_eluted').val('');
            $('#comments').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square-o"></i> Hemoflow | Update<span id="my-another-cool-loader"></span>');
            // $('#project_idx').show();
            $('#id_one_water_sample').attr('readonly', true);
            $('#id_one_water_sample').show();
            $('#id_one_water_sample_list').hide();
            $('#id_one_water_sample').val(data.id_one_water_sample);
            $('#id_one_water_sample_list').val(data.id_one_water_sample).trigger('change');
            $('#id_person').val(data.id_person).trigger('change');
            $('#sampletype').attr('readonly', true);
            $('#sampletype').val(data.sampletype);
            $('#date_processed').val(data.date_processed).trigger('change');
            $('#time_processed').val(data.time_processed).trigger('change');
            $('#id_person_proc').val(data.id_person_proc).trigger('change');
            $('#volume_filter').val(data.volume_filter);
            $('#volume_eluted').val(data.volume_eluted);
            $('#comments').val(data.comments);
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