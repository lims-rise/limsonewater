<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">Freezer Management - Sample IN</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 4){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Sample</button>";
        }
?>
        
		<?php echo anchor(site_url('Freezer_in/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
                    <th>Barcode Tube</th>
                    <th>Date IN</th>
                    <th>Time IN</th>
                    <th>Lab Tech</th>
                    <th>Cryobox</th>
                    <th>Location</th>
                    <th>Comments</th>
                    <th>Action</th>
                </tr>
            </thead>
	    
        </table>
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
                <div class="modal-header box">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modal-title">Freezer Management - Sample IN</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('Freezer_in/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <input id="id" name="id" type="hidden" class="form-control input-sm">

                        <div class="form-group">
                            <label for="date_in" class="col-sm-4 control-label">Date IN</label>
                            <div class="col-sm-8">
                                <input id="date_in" name="date_in" type="date" class="form-control" placeholder="Date IN" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time_in" class="col-sm-4 control-label">Time IN</label>
                            <div class="col-sm-8">
                                <div class="input-group clockpicker">
                                    <input id="time_in" name="time_in" class="form-control" placeholder="Time IN" value="<?php 
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
                            <label for="id_person" class="col-sm-4 control-label">Lab tech</label>
                            <div class="col-sm-8">
                            <select id='id_person' name="id_person" class="form-control">
                                <option>-- Select lab tech --</option>
                                <?php
                                foreach($person as $row){
									if ($id_person == $row['id_person']) {
										echo "<option value='".$row['id_person']."' selected='selected'>".$row['realname']."</option>";
									}
									else {
                                        echo "<option value='".$row['id_person']."'>".$row['realname']."</option>";
                                    }
                                }
                                    ?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_tube" class="col-sm-4 control-label">Barcode tube</label>
                            <div class="col-sm-8">
                            <input id="barcode_tube" name="barcode_tube" type="text" class="form-control" placeholder="Barcode tube" required>
                            <input id="barcode_sample" name="barcode_sample" type="hidden" class="form-control" placeholder="Barcode sample" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cryobox" class="col-sm-4 control-label">Cryobox</label>
                            <div class="col-sm-8">
                                <input id="cryobox" name="cryobox" type="text" class="form-control" placeholder="Barcode cryobox">
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="freezer" class="col-sm-4 control-label">Freezer Location</label>
                            <div class="col-sm-2">
                            <select id='freezer' name="freezer" class="form-control">
                                <option>Freezer</option>
                                <?php
                                foreach($freezer as $row){
                                    echo "<option value='".$row['freezer']."'>".$row['freezer']."</option>";
                                }
                                    ?>
                            </select>
                            <!-- <input id="description" name="description" type="text" class="form-control input-sm" placeholder="Item Description" required> -->
                            </div>
                            <div class="col-sm-2">
                            <select id='shelf' name="shelf" class="form-control">
                                <option>Shelf</option>
                                <?php
                                foreach($shelf as $row){
                                    echo "<option value='".$row['shelf']."'>".$row['shelf']."</option>";
                                }
                                    ?>
                            </select>
                            <!-- <input id="description" name="description" type="text" class="form-control input-sm" placeholder="Item Description" required> -->
                            </div>

                            <div class="col-sm-2">
                            <select id='rack' name="rack" class="form-control">
                                <option>Rack</option>
                                <?php
                                foreach($rack as $row){
                                    echo "<option value='".$row['rack']."'>".$row['rack']."</option>";
                                }
                                    ?>
                            </select>
                            <!-- <input id="description" name="description" type="text" class="form-control input-sm" placeholder="Item Description" required> -->
                            </div>

                            <div class="col-sm-2">
                            <select id='tray' name="tray" class="form-control">
                                <option>Tray</option>
                                <?php
                                foreach($tray as $row){
                                    echo "<option value='".$row['tray']."'>".$row['tray']."</option>";
                                }
                                    ?>
                            </select>
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

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    var table
    $(document).ready(function() {
        
        $('.clockpicker').clockpicker({
        placement: 'bottom', // clock popover placement
        align: 'left',       // popover arrow align
        donetext: 'Done',     // done button text
        autoclose: true,    // auto close when minute is selected
        vibrate: true        // vibrate the device when dragging clock hand
        });                

        $('.val1tip').tooltipster({
            animation: 'swing',
            delay: 1,
            theme: 'tooltipster-default',
            autoClose: true,
            position: 'bottom',
        });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        });


        $('#compose-modal').on('shown.bs.modal', function () {
            // $('#barcode_sample').val('');     
            $('#date_in').focus();
        });        
                
        $('#barcode_tube').on("change", function() {
            $('.val1tip').tooltipster('hide');   
            data1 = $('#barcode_tube').val();
            data2 = $('#barcode_sample').val();
            // // ckbar = data1.substring(0,5).toUpperCase();
            // // ckarray = ["N-S2-", "F-S2-", "N-F0-", "F-F0-"];
            // // ck = $.inArray(ckbar, ckarray);
            // if (ck == -1) {
            $.ajax({
                type: "GET",
                url: "Freezer_in/barcode_check?id1="+data1+"&id2="+data2,
                // data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length == 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode tube <strong> ' + data1 +'</strong> is not found or has already in the Freezer!</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#barcode_tube').focus();
                        $('#barcode_tube').val('');     
                        $('#sampletype').val('');    
                        $('#barcode_tube').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_tube').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_tube').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_tube').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                    else {
                        $('#barcode_sample').val(data[0].barcode_sample);    
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
            processing: true,
            serverSide: true,
            ajax: {"url": "Freezer_in/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_tube"},
                {"data": "date_in"},
                {"data": "time_in"},
                {"data": "initial"},
                {"data": "cryobox"},
                {"data": "location"},
                {"data": "comments"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[1, 'desc']],
            // order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                // var index = page * length + (iDisplayIndex + 1);
                // $('td:eq(0)', row).html(index);
            }
        });

        function findfreez(data1) {
            $.ajax({
                type: "GET",
                url: "Freezer_in/load_frez?idfrez="+data1,
                data:data1,
                dataType: "json",
                success: function(data) {
                    var freez = '';
                    var shelf = '';
                    var rack = '';
                    var tray = '';
                    $("#freezer").val('');
                    $("#shelf").val('');
                    $("#rack").val('');
                    $("#tray").val('');                    
                    if (data) {
                        id_location_80 = data[0].id_location_80;
                        freez = data[0].freezer;
                        shelf = data[0].shelf;
                        rack = data[0].rack;
                        tray = data[0].tray;
                        // console.log(data);
                        // $("#comments").val(data[0].tray);
                    }

                    $("#idfrez").val(id_location_80);
                    $("#freezer").val(freez);
                    $("#shelf").val(shelf);
                    $("#rack").val(rack);
                    $("#tray").val(tray);                    
                }
            });
        }

        $('#addtombol').click(function() {
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Freezer Management - New Sample IN<span id="my-another-cool-loader"></span>');
            $('#id').val('');
            $('#id_person').val('');
            $('#barcode_sample').val('');
            $('#barcode_tube').val('');
            // $('#cryobox').attr('readonly', false);
            $('#cryobox').val('');
            $('#freezer').val('');
            $('#shelf').val('');
            $('#rack').val('');
            $('#tray').val('');
            $('#comments').val('');
            $('#idfrez').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            // $('.val1tip').tooltipster('hide');   
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Freezer Management - Update Sample IN<span id="my-another-cool-loader"></span>');
            // $('#barcode_dna').attr('readonly', true);
            $('#id').val(data.id);
            $('#date_in').val(data.date_in);
            $('#time_in').val(data.time_in);
            $('#id_person').val(data.id_person).trigger('change');
            $('#barcode_sample').val(data.barcode_sample);
            $('#barcode_tube').val(data.barcode_tube);
            $('#cryobox').val(data.cryobox);
            $('#idfrez').val(data.id_location);
            $('#comments').val(data.comments);
            findfreez(data.id_location);
            $('#compose-modal').modal('show');
        });  

        // #tblEmployee tbody tr.even:hover {
        //     background-color: cadetblue;
        //     cursor: pointer;
        // }
        // $('#myTable').DataTable( {
        //     select: true
        // } );

        $('#mytable tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }
        })   

        // $('[data-dismiss=modal]').on('click', function(e) {
        //     var $t = $(this),
        //         target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
        //     $(target)
        //         .find("input,textarea,select")
        //         .val('')
        //         .end()
        //         .find("input[type=checkbox], input[type=radio]")
        //         .prop("checked", "")
        //         .end();
        // });
        // $('.modal').on('hidden.bs.modal', function() {
        //     $(this).find('form')[0].reset();
        // });
        // $('.modal').on('shown.bs.modal', function() {
        //     lastfocus = $(this);
        //     $('input:enabled:visible:not([readonly="readonly"])', this).get(0).select();
        // });                                
    });
</script>