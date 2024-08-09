<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">Water | Sample Extraction </h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Sample Reception</button>";
        }
?>        
		<?php echo anchor(site_url('Sample_extraction/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to XLS', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
		    <th>Barcode sample</th>
		    <th>Onewater sample id</th>
		    <th>Lab Tech</th>
            <th>Sample type</th>
		    <th>Date extraction</th>
            <th>Weight</th>
            <th>Volume</th>
		    <th>Comments</th>
		    <th width="120px">Action</th>
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
                    <h4 class="modal-title" id="modal-title">Sample Extraction | New</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('Sample_extraction/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <!-- <input id="id_req" name="id_req" type="hidden" class="form-control input-sm"> -->

                        <div class="form-group">
                            <label for="one_water_sample_id" class="col-sm-4 control-label">One Water Sample ID</label>
                            <div class="col-sm-8">
                                <input id="one_water_sample_id" name="one_water_sample_id" placeholder="One Water Sample ID" type="text" class="form-control">
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
                            <label for="barcode_sample" class="col-sm-4 control-label">Barcode Sample</label>
                            <div class="col-sm-8">
                                <input id="barcode_sample" name="barcode_sample" placeholder="Barcode Sample" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sampletype" class="col-sm-4 control-label">Sample Type</label>
                            <div class="col-sm-8">
                                <input id="sampletype" name="sampletype" placeholder="Sample Type" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_extraction" class="col-sm-4 control-label">Date Extraction</label>
                            <div class="col-sm-8">
                                <input id="date_extraction" name="date_extraction" type="date" class="form-control" placeholder="Date Extraction" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="weight" class="col-sm-4 control-label">Weight</label>
                            <div class="col-sm-8">
                                <input id="weight" name="weight" placeholder="Weight" type="number" step="0.1" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="volume" class="col-sm-4 control-label">Volume</label>
                            <div class="col-sm-8">
                                <input id="volume" name="volume" placeholder="Volume" type="number" step="1" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_kit" class="col-sm-4 control-label">Kit Used</label>
                            <div class="col-sm-8">
                                <select id="id_kit" name="id_kit" class="form-control">
                                    <option>-- Select Kit --</option>
                                    <?php
                                        foreach($kit as $row) {
                                            if ($id_kit == $row['id_kit']) {
                                                echo "<option value='".$row['id_kit']."' selected='selected'>".$row['kit']."</option>";
                                            } else {
                                                echo "<option value='".$row['id_kit']."'>".$row['kit']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kit_lot" class="col-sm-4 control-label">Kit Lot no.</label>
                            <div class="col-sm-8">
                                <input id="kit_lot" name="kit_lot" placeholder="Kit Lot no." type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_tube" class="col-sm-4 control-label">Barcode Tube</label>
                            <div class="col-sm-8">
                                <input id="barcode_tube" name="barcode_tube" placeholder="Barcode Tube" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dna_concentration" class="col-sm-4 control-label">DNA Concentration</label>
                            <div class="col-sm-8">
                                <input id="dna_concentration" name="dna_concentration" placeholder="DNA Concentration" type="number" step="0.1" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cryobox" class="col-sm-4 control-label">Crypbox</label>
                            <div class="col-sm-8">
                                <input id="cryobox" name="cryobox" placeholder="Cryobox" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_location" class="col-sm-4 control-label">Freezer Location</label>
                            <input id="id_loc" name="id_loc" type="hidden" class="form-control" required>
                            <div class="col-sm-2">
                            <select id='id_freez' name="id_freez" class="form-control" required>
                                <option>Freezer</option>
                                    <?php
                                    foreach($freez1 as $row){
                                        echo "<option value='".$row['freezer']."'>".$row['freezer']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                            <div class="col-sm-2">
                            <select id='id_shelf' name="id_shelf" class="form-control" required>
                                <option>Shelf</option>
                                    <?php
                                    foreach($shelf1 as $row){
                                        echo "<option value='".$row['shelf']."'>".$row['shelf']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                            <div class="col-sm-2">
                            <select id='id_rack' name="id_rack" class="form-control" required>
                                <option>Rack</option>
                                    <?php
                                    foreach($rack1 as $row){
                                        echo "<option value='".$row['rack']."'>".$row['rack']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                            <div class="col-sm-2">
                            <select id='id_draw' name="id_draw" class="form-control" required>
                                <option>Drawer</option>
                                    <?php
                                    foreach($draw1 as $row){
                                        echo "<option value='".$row['rack_level']."'>".$row['rack_level']."</option>";
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
			$('#one_water_sample_id').focus();
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

        function load_freez(data1) {
            $.ajax({
                type: "GET",
                url: "Sample_extraction/load_freez?id1="+data1,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        // console.log();
                        $('#id_freez').val(data[0].freezer);    
                        $('#id_shelf').val(data[0].shelf);    
                        $('#id_rack').val(data[0].rack);    
                        $('#id_draw').val(data[0].rack_level);    
                    }
                    else {
                        $('#id_freez').val('');    
                        $('#id_shelf').val('');    
                        $('#id_rack').val('');    
                        $('#id_draw').val('');    
                    }
                }
            });
        }

        function get_freez(data1, data2, data3, data4) {
            $.ajax({
                type: "GET",
                url: "Sample_extraction/get_freez?id1="+data1+"&id2="+data2+"&id3="+data3+"&id4="+data4,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        // console.log();
                        $('#id_loc').val(data[0].id_location);    
                    }
                    else {
                        $('#id_loc').val('');    
                    }
                }
            });
        }

        $('#id_freez').on('change', function (){
            get_freez($('#id_freez').val(), $('#id_shelf').val(), $('#id_rack').val(), $('#id_draw').val())
        });
        $('#id_shelf').on('change', function (){
            get_freez($('#id_freez').val(), $('#id_shelf').val(), $('#id_rack').val(), $('#id_draw').val())
        });
        $('#id_rack').on('change', function (){
            get_freez($('#id_freez').val(), $('#id_shelf').val(), $('#id_rack').val(), $('#id_draw').val())
        });
        $('#id_draw').on('change', function (){
            get_freez($('#id_freez').val(), $('#id_shelf').val(), $('#id_rack').val(), $('#id_draw').val())
        });


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
            ajax: {"url": "Sample_extraction/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_sample"},
                {"data": "one_water_sample_id"},
                {"data": "initial"},
                {"data": "sampletype"},
                {"data": "date_extraction"},
                {"data": "weight"},
                {"data": "volume"},
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
            // $('#project_idx').hide();
            $('#one_water_sample_id').val('');
            $('#id_person').val('');
            $('#barcode_sample').val('');
            $('#sampletype').val('');
            $('#date_extraction').val('');
            $('#weight').val('');
            $('#volume').val('');
            $('#id_kit').val('');
            $('#kit_lot').val('');
            $('#barcode_tube').val('');
            $('#dna_concentration').val('');
            $('#cryobox').val('');
            $('#id_freez').val('');
            $('#id_shelf').val('');
            $('#id_rack').val('');
            $('#id_draw').val('');
            $('#comments').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Water sample reception | Update<span id="my-another-cool-loader"></span>');
            // $('#project_idx').show();
            $('#one_water_sample_id').attr('readonly', true);
            $('#one_water_sample_id').val(data.one_water_sample_id);
            $('#id_person').val(data.id_person).trigger('change');
            $('#barcode_sample').val(data.barcode_sample);
            $('#sampletype').val(data.sampletype);
            $('#date_extraction').val(data.date_extraction).trigger('change');
            $('#weight').val(data.weight);
            $('#volume').val(data.volume);
            $('#id_kit').val(data.id_kit).trigger('change');
            $('#kit_lot').val(data.kit_lot);
            $('#barcode_tube').val(data.barcode_tube);
            $('#dna_concentration').val(data.dna_concentration);
            $('#cryobox').val(data.cryobox);
            load_freez(data.id_location);
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