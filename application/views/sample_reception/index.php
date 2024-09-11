<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Processing | Sample Reception </h3>
                    </div>
                    <form role="form"  id="formKegHidden" method="post" class="form-horizontal">
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
                    </form>
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                            <?php
                                    $lvl = $this->session->userdata('id_user_level');
                                    if ($lvl != 7){
                                        echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Sample Reception</button>";
                                    }
                            ?>        
                            <?php echo anchor(site_url('Sample_reception/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to XLS', 'class="btn btn-success"'); ?>
                        </div>
                            <div class="table-responsive">
                                <table class="table ho table-bordered table-striped tbody" id="mytable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Coc</th>
                                            <th>ID Client</th>
                                            <th>Client Sample</th>
                                            <th>ID Sample</th>
                                            <th>Sample Type</th>
                                            <th>Lab Tech</th>
                                            <th>Date Arrive</th>
                                            <th>Time Arrive</th>
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
</style>

<!-- MODAL FORM -->
    <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                        <h4 class="modal-title" id="modal-title">Sample reception | New</h4>
                    </div>
                    <form id="formSample"  action= <?php echo site_url('Sample_reception/save') ?> method="post" class="form-horizontal">
                        <div class="modal-body">
                            <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                            <!-- <input id="id_req" name="id_req" type="hidden" class="form-control input-sm"> -->

                            <div class="form-group">
                                <label for="idx_project" class="col-sm-4 control-label">COC</label>
                                <div class="col-sm-8">
                                    <input id="idx_project" name="idx_project" placeholder="Client (as on CoC)" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="clientx" class="col-sm-4 control-label">ID Client</label>
                                <div class="col-sm-8">
                                    <input id="clientx" name="clientx" placeholder="Client (as on CoC)" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="id_client_sample" class="col-sm-4 control-label">Client Sample</label>
                                <div class="col-sm-8">
                                    <input id="id_client_sample" name="id_client_sample" placeholder="Client Sample" type="text" class="form-control">
                                    <div class="val1tip"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="idx_one_water_sample" class="col-sm-4 control-label">ID Sample</label>
                                <div class="col-sm-8">
                                    <input id="idx_one_water_sample" name="id_one_water_sample" placeholder="One Water Sample ID" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="id_sampletype" class="col-sm-4 control-label">Sample Type</label>
                                <div class="col-sm-8" >
                                <select id='id_sampletype' name="id_sampletype" class="form-control">
                                    <option>-- Select Sample Type --</option>
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

                            <div class="form-group">
                                <label for="id_person" class="col-sm-4 control-label">Lab Tech</label>
                                <div class="col-sm-8">
                                    <select id="id_person" name="id_person" class="form-control">
                                        <option>-- Select Lab Tech --</option>
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
                                <label for="date_arrival" class="col-sm-4 control-label">Date Arrive</label>
                                <div class="col-sm-8">
                                    <input id="date_arrival" name="date_arrival" type="date" class="form-control" placeholder="Date arrival" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="time_arrival" class="col-sm-4 control-label">Time Arrive</label>
                                <div class="col-sm-8">
                                    <div class="input-group clockpicker">
                                    <input id="time_arrival" name="time_arrival" class="form-control" placeholder="Time arrival" value="<?php 
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
                                <label for="date_collected" class="col-sm-4 control-label">Date collected</label>
                                <div class="col-sm-8">
                                    <input id="date_collected" name="date_collected" type="date" class="form-control" placeholder="Date collected" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="time_collected" class="col-sm-4 control-label">Time collected</label>
                                <div class="col-sm-8">
                                    <div class="input-group clockpicker">
                                    <input id="time_collected" name="time_collected" class="form-control" placeholder="Time collected" value="<?php 
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
                <h4 class="modal-title"><i class="fa fa-trash"></i> Sample reception | Delete <span id="my-another-cool-loader"></span></h4>
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
</style>


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    let table;
    let id_project = $('#id_project').val();
	let client = $('#client').val();
    let id_one_water_sample = $('#id_one_water_sample').val();

    $(document).ready(function() {

        function showConfirmation(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('Sample_reception/delete'); ?>/' + id;
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
            $('.val1tip').tooltipster('hide'); 
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

        $('#id_client_sample').click(function() {
            $('.val1tip').tooltipster('hide');   
        });

        $('#id_client_sample').on("change", function() {
            let idClientSample = $('#id_client_sample').val();
            $.ajax({
                type: "GET",
                url: "Sample_reception/validateIdClientSample",
                data: { id: idClientSample },
                dataType: "json",
                success: function(data) {
                    if (data.length == 1) {
                        let tip = $('<span><i class="fa fa-exclamation-triangle"></i> Client Sample <strong> ' + idClientSample +'</strong> is already in the system !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#id_client_sample').focus();
                        $('#id_client_sample').val('');       
                        $('#id_client_sample').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#id_client_sample').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#id_client_sample').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#id_client_sample').css({'background-color' : '#FFFFFF'});
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

        // table = $("#mytable").DataTable({
        //     // initComplete: function() {
        //     //     var api = this.api();
        //     //     $('#mytable_filter input')
        //     //             .off('.DT')
        //     //             .on('keyup.DT', function(e) {
        //     //                 if (e.keyCode == 13) {
        //     //                     api.search(this.value).draw();
        //     //                 }
        //     //     });
        //     // },
        //     oLanguage: {
        //         sProcessing: "loading..."
        //     },
        //     // select: true;
        //     processing: true,
        //     serverSide: true,
        //     ajax: {"url": "Sample_reception/json", "type": "POST"},
        //     columns: [
        //         // {
        //         //     "data": "barcode_sample",
        //         //     "orderable": false
        //         // },
        //         {"data": "id_project"},
        //         {"data": "client"},
        //         {"data": "id_client_sample"},
        //         {"data": "id_one_water_sample"},
        //         {"data": "sampletype"},
        //         {"data": "initial"},
        //         {"data": "date_arrival"},
        //         {"data": "time_arrival"},
        //         {
        //             "data" : "action",
        //             "orderable": false,
        //             "className" : "text-center"
        //         }
        //     ],
		// 	columnDefs: [
		// 		{
		// 			targets: [5], // Index of the 'estimate_price' column
		// 			className: 'text-right' // Apply right alignment to this column
		// 		}
		// 	],
        //     order: [[0, 'asc']],
        //     rowCallback: function(row, data, iDisplayIndex) {
        //         let info = this.fnPagingInfo();
        //         let page = info.iPage;
        //         let length = info.iLength;
        //         // var index = page * length + (iDisplayIndex + 1);
        //         // $('td:eq(0)', row).html(index);
        //     }
        // });

        table = $("#mytable").DataTable({
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "Sample_reception/json", "type": "POST"},
            columns: [
                {"data": "id_project"},
                {"data": "client"},
                {"data": "id_client_sample"},
                {"data": "id_one_water_sample"},
                {"data": "sampletype"},
                {"data": "initial"},
                {"data": "date_arrival"},
                {"data": "time_arrival"},
                {
                    "data": "action",
                    "orderable": false,
                    "className": "text-center"
                }
            ],
            columnDefs: [
                {
                    targets: [5], // Kolom yang ingin diberi kelas
                    className: 'text-right'
                }
            ],
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                // var index = page * length + (iDisplayIndex + 1);
                // $('td:eq(0)', row).html(index);
            },
            initComplete: function() {
                let api = this.api();
                let firstRow = api.row(0).node();
                $(firstRow).addClass('highlight');
            }
        });



        $('#addtombol').click(function() {
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Sample reception | New <span id="my-another-cool-loader"></span>');
            $('#idx_project').val(id_project);
            $('#idx_project').attr('readonly', true);
            $('#clientx').val(client);
            $('#clientx').attr('readonly', true);
            $('#idx_one_water_sample').val(id_one_water_sample);
            $('#idx_one_water_sample').attr('readonly', true);
            $('#initial').val('');
            $('#id_person').val('');
            $('#id_client_sample').val('');
            $('#id_sampletype').val('');
            $('#comments').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Sample reception | Update<span id="my-another-cool-loader"></span>');
            $('#idx_project').attr('readonly', true);
            $('#idx_project').val(data.id_project);
            $('#clientx').val(data.client);
            $('#clientx').attr('readonly', true);
            $('#idx_one_water_sample').val(data.id_one_water_sample);
            $('#idx_one_water_sample').attr('readonly', true);
            $('#id_person').val(data.id_person);
            $('#date_arrival').val(data.date_arrival).trigger('change');
            $('#time_arrival').val(data.time_arrival).trigger('change');
            $('#id_client_sample').val(data.id_client_sample);
            $('#id_sampletype').val(data.id_sampletype);
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