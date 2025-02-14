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
                                <!-- <div class="col-sm-4">
                                    <input class="form-control " id="client" type="hidden"  value="<?php echo $client ?>"  disabled>
                                </div> -->
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
                                    if ($lvl != 4){
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
                                            <!-- <th>Date Created</th>
                                            <th>Date Updated</th> -->
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

/* Example for styling the three states
.checked {
    color: green;
}
.crossed {
    color: red;
    text-decoration: line-through;
}
.unchecked {
    color: gray;
} */
/* input.form-check-label */
.unchecked {
    color: gray !important;
    border-color: gray !important;
    box-shadow: none; /* Override Bootstrap box-shadow */
}

/* input.form-check-label. */
.checked {
    color: green !important;
    border-color: green !important;
}

/* input.form-check-label */
.crossed {
    color: red !important;
    border-color: red !important;
    text-decoration: line-through !important; /* Bootstrap might override this */
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
                                <label for="client_quote_number" class="col-sm-4 control-label">Client Quote Number</label>
                                <div class="col-sm-8">
                                    <input id="client_quote_number" name="client_quote_number" placeholder="Client Quote Number" type="text" class="form-control" required>
                                    <div class="val1tip"></div>
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <label for="clientx" class="col-sm-4 control-label">ID Client</label>
                                <div class="col-sm-8">
                                    <input id="clientx" name="clientx" placeholder="Client (as on CoC)" type="text" class="form-control">
                                </div>
                            </div> -->

                            
                            <div class="form-group">
                                <label for="client" class="col-sm-4 control-label">ID Client</label>
                                <div class="col-sm-8">
                                    <input id="clientx" name="clientx" placeholder="Client (as on CoC)" type="text" class="form-control" style="display:none;">
                                    <select id="client" name="client" class="form-control" tabindex="text">
                                        <option value="" selected disabled>-- Client (as on CoC) --</option>
                                        <option value="CLT00001">CLT00001</option>
                                        <option value="CLT00002">CLT00002</option>
                                        <option value="CLT00003">CLT00003</option>
                                        <option value="CLT00004">CLT00004</option>
                                        <option value="CLT00005">CLT00005</option>
                                        <option value="CLT00006">CLT00006</option>
                                        <option value="CLT00007">CLT00007</option>
                                        <option value="CLT00008">CLT00008</option>
                                        <option value="CLT00009">CLT00009</option>
                                        <option value="CLT00010">CLT00010</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="id_client_sample" class="col-sm-4 control-label">Client Sample</label>
                                <div class="col-sm-8">
                                    <input id="id_client_sample" name="id_client_sample" placeholder="Client Sample" type="text" class="form-control" required>
                                    <div class="val1tip"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="idx_one_water_sample" class="col-sm-4 control-label">One Water Sample ID</label>
                                <div class="col-sm-8">
                                    <input id="idx_one_water_sample" name="id_one_water_sample" placeholder="One Water Sample ID" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="id_sampletype" class="col-sm-4 control-label">Sample Type</label>
                                <div class="col-sm-8" >
                                <select id='id_sampletype' name="id_sampletype" class="form-control" required>
                                    <option value="" disabled>-- Select Sample Type --</option>
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
                                <label for="date_arrival" class="col-sm-4 control-label">Date Arrive</label>
                                <div class="col-sm-8">
                                    <input id="date_arrival" name="date_arrival" type="date" class="form-control" 
                                        placeholder="Date arrival" 
                                        value="<?php echo date('Y-m-d'); ?>" 
                                        max="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>


                            <!-- <div class="form-group">
                                <label for="time_arrival" class="col-sm-4 control-label">Time Arrive</label>
                                <div class="col-sm-8">
                                    <div class="input-group clockpicker">
                                    <input id="time_arrival" name="time_arrival" class="form-control" placeholder="Time arrival" value="<?php 
                                    // $datetime = new DateTime();
                                    // echo $datetime->format( 'H:i' );
                                    ?>">
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label for="time_arrival" class="col-sm-4 control-label">Time Arrive</label>
                                <div class="col-sm-8">
                                    <div class="input-group clockpicker">
                                        <input id="time_arrival" name="time_arrival" class="form-control" placeholder="Time arrival" value="<?php 
                                        $datetime = new DateTime();
                                        echo $datetime->format('H:i');
                                        ?>">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <label for="date_collected" class="col-sm-4 control-label">Date collected</label>
                                <div class="col-sm-8">
                                    <input id="date_collected" name="date_collected" type="date" class="form-control" placeholder="Date collected" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label for="date_collected" class="col-sm-4 control-label">Date collected</label>
                                <div class="col-sm-8">
                                    <!-- Dropdown untuk memilih antara tanggal atau NA -->
                                    <select id="date_selector" name="date_collected" class="form-control" onchange="toggleDateInput()">
                                        <option value="date">Select Date</option>
                                        <option value="NA">NA</option>
                                    </select>

                                    <!-- Input tanggal yang hanya bisa dipilih jika bukan 'NA' -->
                                    <input id="date_collected" name="date_collected" type="date" class="form-control" placeholder="Date collected" value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" />
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <label for="time_collected" class="col-sm-4 control-label">Time collected</label>
                                <div class="col-sm-8">
                                    <div class="input-group clockpicker">
                                    <input id="time_collected" name="time_collected" class="form-control" placeholder="Time collected" value="<?php 
                                    // $datetime = new DateTime();
                                    // echo $datetime->format( 'H:i' );
                                    ?>">
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    </div>
                                </div>
                            </div> -->

                            <div class="form-group">
                                <label for="time_collected" class="col-sm-4 control-label">Time Collected</label>
                                <div class="col-sm-8">
                                    <div class="input-group clockpicker">
                                        <input id="time_collected" name="time_collected" class="form-control" placeholder="Time collected" value="<?php 
                                        $datetime = new DateTime();
                                        echo $datetime->format('H:i');
                                        ?>">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                    <span id="time_collected_error" class="text-danger" style="display:none;">Time collected cannot be greater than or equal to time arrive.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="quality_check" class="col-sm-4 control-label">Quality Check</label>
                                <div class="col-sm-8">
                                    <input type="hidden" id="quality_check" name="quality_check" value="0">
                                    <span id="quality_check_label" class="form-check-label unchecked" role="button">
                                        Unchecked
                                    </span>
                                </div>
                            </div>               
                            <!-- <div class="form-group">
                                <label for="quality_check" class="col-sm-4 control-label">Quality Check</label>
                                <div class="col-sm-8">
                                    <input id="quality_check" name="quality_check" type="checkbox" value="1" class="form-check-input">
                                    <label for="quality_check" class="form-check-label">Checked</label>
                                </div>
                            </div> -->

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
    .highlight-edit {
        background-color: rgba(0, 0, 255, 0.1) !important;
        font-weight: bold !important;
    }
        /* Basic button style for the span */
        .form-check-label {
        display: inline-block;
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 12px;
        cursor: pointer;
        text-align: center;
        transition: all 0.3s ease;
    }

    /* Hover effect for the button */
    .form-check-label:hover {
        opacity: 0.8;
    }

    /* Focused effect to make it more accessible */
    .form-check-label:focus {
        outline: none;
    }
</style>


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script>
function toggleDateInput() {
    var dateSelector = $('#date_selector').val();
    var dateInput = $('#date_collected');

    if (dateSelector === 'NA') {
        dateInput.val(''); // Clear date input if 'NA' is selected
        dateInput.prop('disabled', true); // Disable the date input
    } else {
        dateInput.prop('disabled', false); // Enable the date input if 'Select Date' is selected
    }
}

</script>

<script type="text/javascript">

    let table;
    let id_project = $('#id_project').val();
	let client = $('#client').val();
    let id_one_water_sample = $('#id_one_water_sample').val();

    $(document).ready(function() {

        // Define the states with associated values and labels
        const states = [
            { value: 0, label: "Unchecked", class: "unchecked" },
            { value: 1, label: "Checked", class: "checked" },
            { value: 2, label: "Crossed", class: "crossed" }
        ];

        let currentState = 0; // Start with "Unchecked"

        // Add event listener to toggle through states
        document.getElementById('quality_check_label').addEventListener('click', function () {
            // Cycle through the states
            currentState = (currentState + 1) % states.length;

            const checkbox = document.getElementById('quality_check');
            const label = document.getElementById('quality_check_label');
            
            // // Update the checkbox state
            // checkbox.checked = (states[currentState].value === 1); // Only true for "Checked"

            // Update the label text
            label.textContent = states[currentState].label;

            // Apply styling to the label based on the state
            label.className = `form-check-label ${states[currentState].class}`;

            // (Optional) Update a hidden input or store the value somewhere for submission
            checkbox.value = states[currentState].value; // Set the value to the current state
        });

        $('#time_collected').on('change', function() {
            validateTimeCollected();
        });

        $('form').on('submit', function(e) {
            if (!validateTimeCollected()) {
                e.preventDefault(); // Prevent form submission if validation fails
            }
        });

        function validateTimeCollected() {
            let timeArrival = $('#time_arrival').val();
            let timeCollected = $('#time_collected').val();
            let isValid = true;

            $('#time_collected_error').hide();
                // Check if time collected is empty
                if (!timeCollected) {
                    $('#time_collected_error').text('Time collected cannot be empty.').show();
                    isValid = false;
                } else {
                    // Convert to Date object for comparison
                    let arrivalParts = timeArrival.split(':');
                    let collectedParts = timeCollected.split(':');

                    let arrivalDate = new Date();
                    arrivalDate.setHours(arrivalParts[0], arrivalParts[1]);

                    let collectedDate = new Date();
                    collectedDate.setHours(collectedParts[0], collectedParts[1]);

                    // Check if time collected is greater than or equal to time arrival
                    if (collectedDate >= arrivalDate) {
                        $('#time_collected_error').text('Time collected cannot be greater than or equal to time arrive.').show();
                        isValid = false;
                    }
                }

                // If valid, update the input value to prevent the default time from being sent
                if (isValid) {
                    $('#time_collected').val(timeCollected);
                } else {
                    $('#time_collected').val('');
                }

                return isValid;
            }

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

        // $('#id_client_sample').on("change", function() {
        //     let idClientSample = $('#id_client_sample').val();
        //     $.ajax({
        //         type: "GET",
        //         url: "Sample_reception/validateIdClientSample",
        //         data: { id: idClientSample },
        //         dataType: "json",
        //         success: function(data) {
        //             if (data.length == 1) {
        //                 let tip = $('<span><i class="fa fa-exclamation-triangle"></i> Client Sample <strong> ' + idClientSample +'</strong> is already in the system !</span>');
        //                 $('.val1tip').tooltipster('content', tip);
        //                 $('.val1tip').tooltipster('show');
        //                 $('#id_client_sample').focus();
        //                 $('#id_client_sample').val('');       
        //                 $('#id_client_sample').css({'background-color' : '#FFE6E7'});
        //                 setTimeout(function(){
        //                     $('#id_client_sample').css({'background-color' : '#FFFFFF'});
        //                     setTimeout(function(){
        //                         $('#id_client_sample').css({'background-color' : '#FFE6E7'});
        //                         setTimeout(function(){
        //                             $('#id_client_sample').css({'background-color' : '#FFFFFF'});
        //                         }, 300);                            
        //                     }, 300);
        //                 }, 300);
        //             }
        //         }
        //     });
        // });


        // $('#id_client_sample').on("blur", function() {
        //     let idClientSample = $('#id_client_sample').val();
        //     if (idClientSample.trim() === '') {
        //         let tip = $('<span><i class="fa fa-exclamation-triangle"></i> Input tidak boleh kosong !</span>');
        //         $('.val1tip').tooltipster('content', tip);
        //         $('.val1tip').tooltipster('show');
        //         $('#id_client_sample').css({'background-color' : '#FFE6E7'});
        //         setTimeout(function(){
        //             $('#id_client_sample').css({'background-color' : '#FFFFFF'});
        //             setTimeout(function(){
        //                 $('#id_client_sample').css({'background-color' : '#FFE6E7'});
        //                 setTimeout(function(){
        //                     $('#id_client_sample').css({'background-color' : '#FFFFFF'});
        //                 }, 300);                            
        //             }, 300);
        //         }, 300);
        //     }
        //     // Tambahkan atribut required pada input field
        //     $('#id_client_sample').attr('required', 'required');

        //     // Hide default notifnya yang muncul dari browser
        //     $('#id_client_sample').on('invalid', function(event) {
        //         event.preventDefault();
        //     });
        // });


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
                    } else if (/[^a-zA-Z0-9]/.test(idClientSample)) {
                        let tip = $('<span><i class="fa fa-exclamation-triangle"></i>  Wrong type <strong>' + idClientSample +'</strong> Input must not contain symbols !</span>');
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
                    targets: [5],
                    className: 'text-right'
                }
            ],
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
            let rowId = rowData.id_project;
            $(this).removeClass('highlight');
            $(this).removeClass('highlight-edit');
        });



        $('#addtombol').click(function() {
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Sample reception | New <span id="my-another-cool-loader"></span>');
            $('#idx_project').val(id_project);
            $('#idx_project').attr('readonly', true);
            $('#client_quote_number').val('');
            // $('#clientx').val(client);
            // $('#clientx').attr('readonly', true);
            $('#client').val('');
            // $('#client').attr('readonly', true);
            $('#clientx').hide();
            $('#client').show();
            $('#idx_one_water_sample').val(id_one_water_sample);
            $('#idx_one_water_sample').attr('readonly', true);
            $('#initial').val('');
            $('#id_person').val('');
            $('#id_client_sample').val('');
            $('#id_sampletype').val('');
            // $('#time_collected').val('');
            $('#quality_check').prop('checked', false); // Uncheck the checkbox
            const label = document.getElementById('quality_check_label');
            label.textContent = 'Unchecked';
            label.className = `form-check-label unchecked`;            
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
            $('#client_quote_number').val(data.client_quote_number);
            // $('#clientx').val(data.client);
            // $('#clientx').attr('readonly', true);
            $('#client').hide();
            $('#clientx').show();
            $('#clientx').val(data.client);
            $('#clientx').attr('readonly', true);
            $('#idx_one_water_sample').val(data.id_one_water_sample);
            $('#idx_one_water_sample').attr('readonly', true);
            $('#id_person').val(data.id_person);
            $('#date_arrival').val(data.date_arrival).trigger('change');
            $('#time_arrival').val(data.time_arrival).trigger('change');
            // $('#date_collected').val(data.date_collected).trigger('change');
                // Handling the date_collected logic
            let dateCollected = data.date_collected;
            if (dateCollected === '0000-00-00') {
                $('#date_selector').val('NA'); // Set dropdown to "NA"
                $('#date_collected').val(''); // Clear date picker
                $('#date_collected').prop('disabled', true); // Disable the date picker
            } else {
                $('#date_selector').val('date'); // Set dropdown to "Select Date"
                $('#date_collected').val(dateCollected); // Set the actual date value
                $('#date_collected').prop('disabled', false); // Enable the date picker
            }
            $('#time_collected').val(data.time_collected).trigger('change');
            $('#id_client_sample').val(data.id_client_sample);
            $('#id_sampletype').val(data.id_sampletype);
            // Set the checkbox state
            if (data.quality_check == 1) {
                $('#quality_check').prop('checked', true); // Check the checkbox
                const label = document.getElementById('quality_check_label');
                label.textContent = 'Checked';
                label.className = `form-check-label checked`;            
            } else if (data.quality_check == 0) {
                $('#quality_check').prop('checked', false); // Uncheck the checkbox
                const label = document.getElementById('quality_check_label');
                label.textContent = 'Unchecked';
                label.className = `form-check-label unchecked`;            
            }
            else if (data.quality_check == 2) {
                $('#quality_check').prop('checked', false); // Uncheck the checkbox
                const label = document.getElementById('quality_check_label');
                label.textContent = 'Crossed';
                label.className = `form-check-label crossed`;
            }
            if (data.quality_check == 1 || data.quality_check === true) {
                $('#quality_check').prop('checked', true); // Check the checkbox
            } else {
                $('#quality_check').prop('checked', false); // Uncheck the checkbox
            }
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