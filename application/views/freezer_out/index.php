<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">Freezer Management - Sample Out</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 4){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Sample</button>";
        }
?>
        
		<?php echo anchor(site_url('Freezer_out/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
                    <th>Barcode Tube</th>
                    <th>Date OUT</th>
                    <th>Time OUT</th>
                    <th>Lab tech</th>
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
                    <h4 class="modal-title" id="modal-title">Freezer - Sample Out</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('Freezer_out/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <input id="id_freez" name="id_freez" type="hidden" class="form-control input-sm">

                        <div class="form-group">
                            <label for="date_out" class="col-sm-4 control-label">Date OUT</label>
                            <div class="col-sm-8">
                                <input id="date_out" name="date_out" type="date" class="form-control" placeholder="Date OUT" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time_out" class="col-sm-4 control-label">Time OUT</label>
                            <div class="col-sm-8">
                                <div class="input-group clockpicker">
                                    <input id="time_out" name="time_out" class="form-control" placeholder="Time OUT" value="<?php 
                                    $datetime = new DateTime( "now", new DateTimeZone( "Asia/Makassar" ) );
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
                                <div class="val1tip"></div>
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
        
        // $('.clockpicker').clockpicker({
        // placement: 'bottom', // clock popover placement
        // align: 'left',       // popover arrow align
        // donetext: 'Done',     // done button text
        // autoclose: true,    // auto close when minute is selected
        // vibrate: true        // vibrate the device when dragging clock hand
        // });                

        $('.val1tip').tooltipster({
            animation: 'swing',
            delay: 1,
            theme: 'tooltipster-default',
            // touchDevices: false,
            // trigger: 'hover',
            autoClose: true,
            position: 'bottom',
            // content: $('<span><i class="fa fa-exclamation-triangle"></i> <strong> This text is in bold case !</strong></span>')
            // content: $('<span><img src="../assets/img/ttd.jpg" /> <strong>This text is in bold case !</strong></span>')
            // content: 'Test tip'
        });


        // function checkBarcode() { col-sm-8
        // $('.modal-body').click(function() {
        // $('#barcode_sample').click(function() {
        //     $('.val1tip').tooltipster('hide');   
        // // $('#barcode_sample').val('');     
        // });

        $('barcode_tube').click(function() {
            $('.val1tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        });

        // function loadSType(data1) {
        //     $.ajax({
        //         type: "GET",
        //         url: "Freezer_out/get_dna_type?id1="+data1,
        //         // data:data1,
        //         dataType: "json",
        //         success: function(data) {
        //             // var barcode = '';
        //             if (data.length > 0) {
        //                 $('#stype').val(data[0].sample);     
        //             }
        //             else {
        //                 tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode DNA <strong> ' + data1 +'</strong> is not found in the system !</span>');
        //                 $('.val1tip').tooltipster('content', tip);
        //                 $('.val1tip').tooltipster('show');
        //                 $('#barcode_dna').focus();
        //                 $('#barcode_dna').val('');     
        //                 $('#stype').val('');     
        //                 $('#barcode_dna').css({'background-color' : '#FFE6E7'});
        //                 setTimeout(function(){
        //                     $('#barcode_dna').css({'background-color' : '#FFFFFF'});
        //                     setTimeout(function(){
        //                         $('#barcode_dna').css({'background-color' : '#FFE6E7'});
        //                         setTimeout(function(){
        //                             $('#barcode_dna').css({'background-color' : '#FFFFFF'});
        //                         }, 300);                            
        //                     }, 300);
        //                 }, 300);

        //                 // barcode = data[0].barcode_sample;
        //                 // console.log(data);
        //             }
        //         }
        //     });            
        // }
        // $('#barcode_dna').on("change", function() {
        //     data1 = $('#barcode_dna').val();
        // });

        $('#barcode_tube').on("change", function() {
            $('.val1tip').tooltipster('hide');   
            data1 = $('#barcode_tube').val();
            // loadSType(data1);
            $.ajax({
                type: "GET",
                url: "freezer_out/valid_bs?id1="+data1,
                // data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length == 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode tube <strong> ' + data1 +'</strong> is not found in the Freezer IN module !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#barcode_tube').focus();
                        $('#barcode_tube').val('');     
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

                        // barcode = data[0].barcode_sample;
                        // console.log(data);
                    }
                }
            });
            // $('.val1tip').tooltipster('content', 'Barcode :' + $(this).val()+' salah input, seharusnya memakai kode bla bla bla');
            setTimeout(function(){
                $('.val1tip').tooltipster('hide');        
            }, 3000);
        });

        // $("input").focusout(function(){
        //     if ($('#barcode_sample').val() == ""){
        //         tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode sample <strong> is required !</strong></span>');
        //         $('.val1tip').tooltipster('content', tip);
        //         $('.val1tip').tooltipster('show');
        //         $('#barcode_sample').focus();
        //         // $('.val1tip').tooltipster('hide');   
        //     }
        // });

        $("input").keypress(function(){
            // $('#barcode_sample').val('');     
            $('.val1tip').tooltipster('hide');   
        });

        $('#compose-modal').on('shown.bs.modal', function () {
            // $('#barcode_sample').val('');     
            $('#date_out').focus();
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
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                        .off('.DT')
                        .on('keyup.DT', function(e) {
                            if (e.keyCode == 13) {
                                api.search(this.value).draw();
                            }
                });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            // select: true;
            processing: true,
            serverSide: true,
            ajax: {"url": "Freezer_out/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_tube"},
                {"data": "date_out"},
                {"data": "time_out"},
                {"data": "initial"},
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

        $('#addtombol').click(function() {
            $('.val1tip').tooltipster('hide');   
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Freezer Management - New sample out<span id="my-another-cool-loader"></span>');
            $('#id_freez').val('');
            $('#id_person').val('');
            $('#barcode_sample').val('');
            $('#barcode_tube').val('');
            $('#comments').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            $('.val1tip').tooltipster('hide');   
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Freezer Management - Update sample out<span id="my-another-cool-loader"></span>');
            // $('#barcode_dna').attr('readonly', true);
            $('#id_freez').val(data.id);
            $('#date_out').val(data.date_out);
            $('#time_out').val(data.time_out);
            $('#id_person').val(data.id_person).trigger('change');
            // $('#stype').attr('readonly', true);
            $('#barcode_sample').val(data.barcode_sample);
            $('#barcode_tube').val(data.barcode_tube);
            $('#comments').val(data.comments);
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