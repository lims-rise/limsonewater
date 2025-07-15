<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">Master Data - Person</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
            <?php
                $lvl = $this->session->userdata('id_user_level');
                if ($lvl != 4){
                    echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Client </button>";
                }
            ?>
            
            <!-- <?php echo anchor(site_url('Ref_person/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?> -->
        </div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
		    <th>ID</th>
		    <th>Client name</th>
            <th>Address</th>
            <th>Telpon</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Date Collected</th>
            <th>Time Collected</th>
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
                    <h4 class="modal-title" id="modal-title">Master Data - New Client</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('Ref_client/saveClient') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <input id="id_client_contact" name="id_client_contact" type="hidden" class="form-control input-sm">

                        <div class="form-group">
                            <label for="client_name" class="col-sm-4 control-label">Client Name</label>
                            <div class="col-sm-8">
                                <input id="client_name" name="client_name" type="text" class="form-control" placeholder="Client Name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-sm-4 control-label">Address</label>
                            <div class="col-sm-8">
                                <input id="address" name="address" type="text" class="form-control" placeholder="Address" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone1" class="col-sm-4 control-label">Telp</label>
                            <div class="col-sm-8">
                                <input id="phone1" name="phone1" type="text" class="form-control" placeholder="Telp" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone2" class="col-sm-4 control-label">Phone</label>
                            <div class="col-sm-8">
                                <input id="phone2" name="phone2" type="text" class="form-control" placeholder="Phone" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label">Email</label>
                            <div class="col-sm-8">
                                <input id="email" name="email" type="text" class="form-control" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="form-group">
							<label for="date_collected" class="col-sm-4 control-label">Date collected</label>
							<div class="col-sm-8">
								<input id="date_collected" name="date_collected" type="date" class="form-control" placeholder="Date sample collected" value="<?php echo date("Y-m-d"); ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="time_collected" class="col-sm-4 control-label">Time collected</label>
							<div class="col-sm-8">
								<div class="input-group clockpicker">
									<input id="time_collected" name="time_collected" class="form-control" placeholder="Time sample collected" value="<?php 
									$datetime = new DateTime();
									echo $datetime->format( 'H:i' );
									?>">
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
									</span>
								</div>
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
        $('#barcode_sample').click(function() {
            $('.val1tip').tooltipster('hide');   
        // $('#barcode_sample').val('');     
        });

        // $('.col-sm-8').click(function() {

            // $('.val1tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        // });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        });


        $("input").keypress(function(){
            // $('#barcode_sample').val('');     
            $('.val1tip').tooltipster('hide');   
        });

        $('#compose-modal').on('shown.bs.modal', function () {
            // $('#barcode_sample').val('');     
            $('#realname').focus();
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
            ajax: {"url": "Ref_client/jsonClient", "type": "POST"},
            columns: [
                {"data": "id_client_contact"},
                {"data": "client_name"},
                {"data": "address"},
                {"data": "phone1"},
                {"data": "phone2"},
                {"data": "email"},
                {"data": "date_collected"},
				{"data": "time_collected"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[0, 'asc']],
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Master Data - New Client<span id="my-another-cool-loader"></span>');
            $('#id_client_contact').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            $('.val1tip').tooltipster('hide');   
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Master Data - Update Client<span id="my-another-cool-loader"></span>');
            $('#id_client_contact').val(data.id_client_contact);
            $('#client_name').val(data.client_name);
            $('#address').val(data.address);
            $('#phone1').val(data.phone1);
            $('#phone2').val(data.phone2);
            $('#email').val(data.email);
            $('#date_collected').val(data.date_collected).trigger('change');
            $('#time_collected').val(data.time_collected).trigger('change');
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