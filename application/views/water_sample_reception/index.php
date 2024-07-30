<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">Water | Sample reception </h3>
                    </div>
                    <form role="form"  id="formKeg" method="post" class="form-horizontal">
        `				<div class="box-body">
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <input class="form-control " id="project_id" type="hidden"  value="<?php echo $project_id ?>"  disabled>
                                </div>
                                <div class="col-sm-4">
                                    <input class="form-control " id="client" type="hidden"  value="<?php echo $client ?>"  disabled>
                                </div>
                                <div class="col-sm-4">
                                    <input class="form-control " id="one_water_sample_id" type="hidden"  value="<?php echo $one_water_sample_id ?>"  disabled>
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
		<?php echo anchor(site_url('Water_sample_reception/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to XLS', 'class="btn btn-success"'); ?></div>
        <div class="table-responsive">
            <table class="table ho table-bordered table-striped tbody" id="mytable" style="width:100%">
                <thead>
                    <tr>
                        <th>Coc</th>
                        <th>Client as on Coc</th>
                        <th>Client Sample</th>
                        <th>One Water Sample ID</th>
                        <th>Type of Sample</th>
                        <th>Received Lab</th>
                        <th>Date Of Sample Arrival</th>
                        <th>Time Of Sample Arrival</th>
                        <th>Date Of Sample Collected</th>
                        <th>Time Of Sample Collected</th>
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
                    <h4 class="modal-title" id="modal-title">Water sample reception | New</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('Water_sample_reception/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <!-- <input id="id_req" name="id_req" type="hidden" class="form-control input-sm"> -->

                        <div class="form-group">
                            <label for="project_idx" class="col-sm-4 control-label">COC</label>
                            <div class="col-sm-8">
                                <input id="project_idx" name="project_idx" placeholder="Client (as on CoC)" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="clientx" class="col-sm-4 control-label">Client</label>
                            <div class="col-sm-8">
                                <input id="clientx" name="clientx" placeholder="Client (as on CoC)" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="client_sample_id" class="col-sm-4 control-label">Client Sample</label>
                            <div class="col-sm-8">
                                <input id="client_sample_id" name="client_sample_id" placeholder="Client Sample" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="one_water_sample_idx" class="col-sm-4 control-label">One Water Sample ID</label>
                            <div class="col-sm-8">
                                <input id="one_water_sample_idx" name="one_water_sample_id" placeholder="One Water Sample ID" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="classification_id" class="col-sm-4 control-label">Type of Sample</label>
                            <div class="col-sm-8" >
                            <select id='classification_id' name="classification_id" class="form-control">
                                <option>-- Select Type of Sample --</option>
                                <?php
                                foreach($classification as $row){
									if ($classification_id == $row['classification_id']) {
										echo "<option value='".$row['classification_id']."' selected='selected'>".$row['classification_name']."</option>";
									}
									else {
                                        echo "<option value='".$row['classification_id']."'>".$row['classification_name']."</option>";
                                    }
                                }
                                    ?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_person" class="col-sm-4 control-label">Received Lab</label>
                            <div class="col-sm-8">
                                <select id="id_person" name="id_person" class="form-control">
                                    <option>-- Select Received Lab --</option>
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
                            <label for="date_arrival" class="col-sm-4 control-label">Date of arrival</label>
                            <div class="col-sm-8">
                                <input id="date_arrival" name="date_arrival" type="date" class="form-control" placeholder="Date arrival" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time_arrival" class="col-sm-4 control-label">Time of arrival</label>
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
                            <label for="date_collected" class="col-sm-4 control-label">Date of collected</label>
                            <div class="col-sm-8">
                                <input id="date_collected" name="date_collected" type="date" class="form-control" placeholder="Date collected" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time_collected" class="col-sm-4 control-label">Time of collected</label>
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

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    var table;
    let project_id = $('#project_id').val();
	let client = $('#client').val();
    let one_water_sample_id = $('#one_water_sample_id').val();

    $(document).ready(function() {

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
			$('#client_sample_id').focus();
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
            ajax: {"url": "Water_sample_reception/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "project_id"},
                {"data": "client"},
                {"data": "client_sample_id"},
                {"data": "one_water_sample_id"},
                {"data": "classification_name"},
                {"data": "initial"},
                {"data": "date_arrival"},
                {"data": "time_arrival"},
                {"data": "date_collected"},
                {"data": "time_collected"},
                {"data": "comments"},
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
            order: [[1, 'desc']],
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                // var index = page * length + (iDisplayIndex + 1);
                // $('td:eq(0)', row).html(index);
            }
        });

        $('#addtombol').click(function() {
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Water sample reception | New<span id="my-another-cool-loader"></span>');
            $('#project_idx').val(project_id);
            $('#project_idx').attr('readonly', true);
            $('#clientx').val(client);
            $('#clientx').attr('readonly', true);
            $('#one_water_sample_idx').val(one_water_sample_id);
            $('#one_water_sample_idx').attr('readonly', true);
            $('#initial').val('');
            $('#id_person').val('');
            $('#client_sample_id').val('');
            $('#classification_id').val('');
            $('#comments').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Water sample reception | Update<span id="my-another-cool-loader"></span>');
            $('#project_idx').attr('readonly', true);
            $('#project_idx').val(data.project_id);
            $('#clientx').val(data.client);
            $('#clientx').attr('readonly', true);
            $('#one_water_sample_idx').val(data.one_water_sample_id);
            $('#one_water_sample_idx').attr('readonly', true);
            $('#id_person').val(data.id_person);
            $('#date_arrival').val(data.date_arrival).trigger('change');
            $('#time_arrival').val(data.time_arrival).trigger('change');
            $('#client_sample_id').val(data.client_sample_id);
            $('#classification_id').val(data.classification_id);
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