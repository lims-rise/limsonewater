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
                                <!-- <div class="col-sm-4">
                                    <input class="form-control " id="id_one_water_sample" type="hidden"  value="<?php echo $id_one_water_sample ?>"  disabled>
                                </div> -->
                            </div>
                        </div>
                    </form>
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                            <?php
                                    $lvl = $this->session->userdata('id_user_level');
                                    if ($lvl != 4){
                                        echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms'></i> New Sample Reception</button>";
                                    }
                            ?>        
                            <?php echo anchor(site_url('Sample_reception/excel'), '<i class="fa fa-file-excel-o"></i> Export to XLS', 'class="btn btn-success"'); ?>
                        </div>
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="mytable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th></th> <!-- Kolom kosong untuk ikon toggle -->
                                        <th>Coc</th>
                                        <th>Client Quote Number</th>
                                        <th>Client Sample ID</th>
                                        <th>Client (As On CoC)</th>
                                        <th>Number of Samples</th>
                                        <th>Client Contact</th>
                                        <th>Comments</th>
                                        <th>Date Collected</th>
                                        <th>Time Collected</th>
                                        <th>File Status</th>
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
    <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                        <button type="button" class="close" data-dismiss="modal"  style="color: white;">&times;</button>
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
                                    <input id="client_quote_number" name="client_quote_number" placeholder="Client Quote Number" type="text" class="form-control">
                                </div>
                            </div>

                            
                            <!-- <div class="form-group">
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
                            </div> -->
                            
                            <div class="form-group">
                                <label for="id_client_sample" class="col-sm-4 control-label">Client ID</label>
                                <div class="col-sm-8">
                                    <input id="id_client_sample" name="id_client_sample" placeholder="Client ID" type="text" class="form-control" required>
                                    <div class="val1tip"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="client" class="col-sm-4 control-label">Client (As on CoC)</label>
                                <div class="col-sm-8">
                                    <input id="clientx" name="clientx" placeholder="Client (as on CoC)" type="text" class="form-control" style="display:none;">
                                    <input id="client" name="client" placeholder="Client (as on CoC)" type="text" class="form-control">
                                    <div class="val1tip"></div>
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label for="number_sample" class="col-sm-4 control-label">Number of Samples</label>
                                <div class="col-sm-8">
                                    <input id="number_sample" name="number_sample" placeholder="Number of Samples" type="text" class="form-control" required>
                                    <div class="val1tip"></div>
                                </div>
                            </div>

                            <!-- Dropdown Client Contact -->
                            <div class="form-group">
                                <label for="id_client_contact" class="col-sm-4 control-label">Client Contact</label>
                                <div class="col-sm-8">
                                    <!-- <select id="id_client_contact" name="id_client_contact" class="form-control">
                                        <option value="" selected disabled>-- Select Client Contact --</option>
                                        <?php foreach ($clientcontact as $row): ?>
                                            <option 
                                                value="<?= htmlspecialchars($row['id_client_contact']) ?>"
                                                data-address="<?= htmlspecialchars($row['address']) ?>"
                                                data-telp="<?= htmlspecialchars($row['telp']) ?>"
                                                data-phone="<?= htmlspecialchars($row['phone']) ?>"
                                                data-email="<?= htmlspecialchars($row['email']) ?>"
                                                <?= ($selected_client_id == $row['id_client_contact']) ? 'selected' : '' ?>
                                            >
                                                <?= htmlspecialchars($row['client_name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select> -->
                                    <select id="id_client_contact" name="id_client_contact" class="form-control">
                                        <option value="" selected disabled>-- Select Client Contact --</option>
                                        <?php if (!empty($clientcontact)): ?>
                                            <?php foreach ($clientcontact as $row): ?>
                                                <option 
                                                    value="<?= htmlspecialchars($row['id_client_contact']) ?>"
                                                    data-address="<?= htmlspecialchars($row['address']) ?>"
                                                    data-telp="<?= htmlspecialchars($row['phone1']) ?>"
                                                    data-phone="<?= htmlspecialchars($row['phone2']) ?>"
                                                    data-email="<?= htmlspecialchars($row['email']) ?>"
                                                    <?= ($selected_client_id == $row['id_client_contact']) ? 'selected' : '' ?>
                                                >
                                                    <?= htmlspecialchars($row['client_name']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option value="" disabled>No client contacts available</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Detail Info: Address, Telp, Phone, Email -->
                            <div id="clientDetails" style="margin-top: 15px; display: none;">
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">Address</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="client_address" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">Telp</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="client_telp" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">Phone</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="client_phone" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="client_email" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="files" class="col-sm-4 control-label">Filename</label>
                                <div class="col-sm-8">
                                    <input id="files" name="files" placeholder="Filename" type="text" class="form-control">
                                    <div class="val2tip"></div>
                                    <button type="button" class="btn btn-success" style="margin-top: 5px;" onclick="openScanner()">Open File</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="date_collected" class="col-sm-4 control-label">Date Arrived</label>
                                <div class="col-sm-8">
                                    <input id="date_collected" name="date_collected" type="date" class="form-control" placeholder="Date Arrived" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="time_collected" class="col-sm-4 control-label">Time Arrived</label>
                                <div class="col-sm-8">
                                    <div class="input-group clockpicker">
                                    <input id="time_collected" name="time_collected" class="form-control" placeholder="Time Arrived" value="<?php 
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
                </div>
            </div>
        </div>   
    </div>

<!-- MODAL CONFIRMATION DELETE -->
<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" 
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: white;">
                <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
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


            <!-- MODAL FORM -->
            <div class="modal fade" id="compose-modal-sample" tabindex="-1" role="dialog" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                                    <button type="button" class="close" data-dismiss="modal"  style="color: white;">&times;</button>
                                    <h4 class="modal-title" id="modal-title">Edit sample</h4>
                                </div>
                                <form id="form-sample"  action= <?php echo site_url('Sample_reception/update_sample') ?> method="post" class="form-horizontal">
                                    <div class="modal-body">
                                        <input id="mode_sample" name="mode_sample" type="hidden" class="form-control input-sm">

                                        
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
                                            <label for="date_arrival_sample" class="col-sm-4 control-label">Date Arrive</label>
                                            <div class="col-sm-8">
                                                <input id="date_arrival_sample" name="date_arrival_sample" type="date" class="form-control" 
                                                    placeholder="Date arrival" 
                                                    value="<?php echo date('Y-m-d'); ?>" 
                                                    max="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="time_arrival_sample" class="col-sm-4 control-label">Time Arrive</label>
                                            <div class="col-sm-8">
                                                <div class="input-group clockpicker">
                                                    <input id="time_arrival_sample" name="time_arrival_sample" class="form-control" placeholder="Time arrival" value="<?php 
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
                                            <label for="date_collected_sample" class="col-sm-4 control-label">Date collected</label>
                                            <div class="col-sm-8">
                                                <!-- Dropdown untuk memilih antara tanggal atau NA -->
                                                <select id="date_selector_sample" name="date_collected_sample" class="form-control" onchange="toggleDateInput()">
                                                    <option value="date">Select Date</option>
                                                    <option value="NA">NA</option>
                                                </select>

                                                <!-- Input tanggal yang hanya bisa dipilih jika bukan 'NA' -->
                                                <input id="date_collected_sample" name="date_collected_sample" type="date" class="form-control" placeholder="Date collected" value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" />
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="time_collected_sample" class="col-sm-4 control-label">Time Collected</label>
                                            <div class="col-sm-8">
                                                <div class="input-group clockpicker">
                                                    <input id="time_collected_sample" name="time_collected_sample" class="form-control" placeholder="Time collected" value="<?php 
                                                    $datetime = new DateTime();
                                                    echo $datetime->format('H:i');
                                                    ?>">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-time"></span>
                                                    </span>
                                                </div>
                                                <span id="time_collected_error_sample" class="text-danger" style="display:none;">Time collected cannot be greater than or equal to time arrive.</span>
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

                                        
                                        <div class="form-group">
                                                <label for="comments" class="col-sm-4 control-label">Description</label>
                                                <div class="col-sm-8">
                                                    <textarea id="comments_sample" name="comments_sample" class="form-control" placeholder="Description"> </textarea>
                                                </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer clearfix">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>


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

    .child-table {
        margin-left: 50px;
        width: 90%;
        border-collapse: collapse;
    }

    .child-table th, .child-table td {
        border: 1px solid #ddd;
        padding: 5px;
    }

    /* Styling untuk container dengan scroll */
    .child-table-container {
        max-height: 500px; /* Atur tinggi maksimal sesuai kebutuhan */
        overflow-y: auto;  /* Aktifkan scroll vertikal */
    }

    /* Style untuk scrollbar itu sendiri */
    .child-table-container::-webkit-scrollbar {
        width: 6px; /* Lebar scrollbar */
    }

    /* Style untuk track (background) scrollbar */
    .child-table-container::-webkit-scrollbar-track {
        background: #e0f2f1; /* Warna hijau toska muda sebagai background track */
        border-radius: 10px; /* Membuat track lebih halus */
    }

    /* Style untuk thumb (pegangan scrollbar) */
    .child-table-container::-webkit-scrollbar-thumb {
        background: #9ACBD0; /* Warna hijau toska gelap untuk thumb scrollbar */
        border-radius: 10px; /* Membuat thumb lebih halus */
    }

    /* Gaya saat thumb scrollbar di-hover */
    .child-table-container::-webkit-scrollbar-thumb:hover {
        background: #48A6A7; /* Warna hijau toska yang lebih gelap saat hover */
    }



</style>


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script>
    function toggleDateInput() {
        let dateSelector = $('#date_selector_sample').val();
        let dateInput = $('#date_collected_sample');

            if (dateSelector === 'NA') {
                dateInput.val(''); // Clear date input if 'NA' is selected
                dateInput.prop('disabled', true); // Disable the date input
            } else {
                dateInput.prop('disabled', false); // Enable the date input if 'Select Date' is selected
            }
    }
</script>

<!-- <script>
    $(document).ready(function () {
        function updateClientDetails() {
                    const selected = $('#id_client_contact option:selected');

                    const address = selected.data('address') || '';
                    const telp    = selected.data('telp') || '';
                    const phone   = selected.data('phone') || '';
                    const email   = selected.data('email') || '';

                    $('#client_address').val(address);
                    $('#client_telp').val(telp);
                    $('#client_phone').val(phone);
                    $('#client_email').val(email);

                    // Show the details section
                    if (selected.val()) {
                        $('#clientDetails').slideDown();
                    } else {
                        $('#clientDetails').slideUp();
                    }
                }

                // Trigger on dropdown change
                $('#id_client_contact').on('change', updateClientDetails);

                // Trigger once on page load if a client is already selected
                if ($('#id_client_contact').val()) {
                    updateClientDetails();
                }
        });

        function populateClientDetails() {
            const selectedOption = $('#id_client_contact option:selected');

            if (selectedOption.val()) {
                $('#client_address').val(selectedOption.data('address') || '-');
                $('#client_telp').val(selectedOption.data('telp') || '-');
                $('#client_phone').val(selectedOption.data('phone') || '-');
                $('#client_email').val(selectedOption.data('email') || '-');
                $('#clientDetails').show();
            } else {
                $('#clientDetails').hide();
                $('#client_address, #client_telp, #client_phone, #client_email').val('');
            }
        }

        $('#id_client_contact').on('change', function () {
            populateClientDetails();
        });

        $('#compose_modal').on('hide.bs.modal', function () {
            // Reset all input fields inside the modal
            $(this).find('form')[0].reset();

            // Kosongkan manual jika tidak pakai form
            $(this).find('#client_address, #client_telp, #client_phone, #client_email').val('');

            // Sembunyikan detail client jika ada
            $('#clientDetails').hide();
        });


</script> -->

<script type="text/javascript">
    let table;
    let id_project = $('#id_project').val();

	let client = $('#client').val();

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

        // Handle the delete button click
        $(document).on('click', '.btn_print', function() {
            let id = $(this).data('id');
            // let url = '<?php echo site_url('Sample_reception/spec_print'); ?>/' + id;
            location.href = '../../Sample_reception/spec_print/'+id_spec;
            // $('#confirm-modal #id').text(id);
            console.log(id);
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
			$('#client_quote_number').focus();
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

        let lastIdProject = localStorage.getItem('last_id_project');
        let lastPage = localStorage.getItem('last_page');
        table = $("#mytable").DataTable({
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "Sample_reception/json", "type": "POST"},
            displayStart: lastPage ? (parseInt(lastPage) * 10) : 0, // <-- ini di sini ya!
            columns: [
                { "data": "toggle", "orderable": false, "searchable": false }, // Ikon toggle di awal
                {"data": "id_project"},
                {
                    "data": "client_quote_number",
                    "render": function(data, type, row) {
                        return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
                    }
                },
                // {"data": "client"},
                // {"data": "id_client_sample"},
                {
                    "data": "id_client_sample",
                    "render": function(data, type, row) {
                        return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
                    }
                },
                {
                    "data": "client",
                    "render": function(data, type, row) {
                        return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
                    }
                },
                {"data": "number_sample"},
                // {"data": "client_name"},
                {
                    "data": "client_name",
                    "render": function(data, type, row) {
                        return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
                    }
                },
                {
                    "data": "comments",
                    "render": function(data, type, row) {
                        return (!data || data === "null" || data === null || data === undefined) ? "-" : data;
                    }
                },
                {"data": "date_collected"},
                {"data": "time_collected"},
                {
                    "data": "files",
                    "render": function(data, type, row) {
                        if (!data || data === "null") return `<button type="button" class="btn btn-sm btn-light" disabled>
                                    <i class="fa fa-times"></i> No scan yet
                                </button>`;

                        const fileURL = `<?= site_url('scan_page/view_file/') ?>${data}`;
                        return `<a href="${fileURL}" target="_blank" class="btn btn-sm btn-success">
                                    <i class="fa fa-file-pdf-o"></i> View Scan
                                </a>`;
                    }
                },
                // {
                //     "data": "files",
                //     "render": function(data, type, row) {
                //         if (!data || data === "null") return `<button type="button" class="btn btn-sm btn-light" disabled>
                //                     <i class="fa fa-times"></i> No scan yet
                //                 </button>`;
                //         return `<button type="button" class="btn btn-sm btn-success" disabled>
                //                     <i class="fa fa-check"></i> Scanning
                      // <i class="fa fa-file-pdf-o"></i> Lihat File
                //                 </button>`;
                //     }
                // },
                { "data": "action", "orderable": false, "searchable": false }
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

                // Reset semua highlight sebelumnya
                api.rows().every(function() {
                    $(this.node()).removeClass('highlight highlight-edit');
                });

                // Dapatkan waktu saat ini
                let now = new Date();
                let newestRow = null;
                let newestCreatedDate = null;
                let newestUpdatedDate = null;
                let updatedRow = null;

                // Cari baris dengan date_created paling baru dan date_updated paling baru
                api.rows().every(function() {
                    let data = this.data();
                    let createdDate = new Date(data.date_created);
                    let updatedDate = new Date(data.date_updated);

                    // Cari baris dengan date_created paling baru
                    if (now - createdDate < 10 * 100) {
                        if (!newestCreatedDate || createdDate > newestCreatedDate) {
                            newestCreatedDate = createdDate;
                            newestRow = this.node();
                        }
                    }


                    // Cari baris dengan date_updated paling baru (terbaru dalam 5 detik terakhir)
                    if (now - updatedDate < 10 * 1000) {
                        if (!newestUpdatedDate || updatedDate > newestUpdatedDate) {
                            newestUpdatedDate = updatedDate;
                            updatedRow = this.node();
                        }
                    }
                });

                // Highlight baris yang paling baru dimasukkan berdasarkan date_created
                if (newestRow) {
                    $(newestRow).addClass('highlight');
                    setTimeout(function() {
                        $(newestRow).removeClass('highlight');
                    }, 5000);
                }

                if (updatedRow) {
                    $(updatedRow).addClass('highlight-edit');
                    
                    // Hilangkan highlight-edit setelah 10 detik
                    setTimeout(function() {
                        $(updatedRow).removeClass('highlight-edit');
                    }, 5000);
                }

                // Pastikan baris pertama di halaman pertama tetap disorot jika ada baris dalam tabel
                if (pageInfo.page === 0 && api.rows().count() > 0) {
                    let firstRow = api.row(0).node();
                    setTimeout(function() {
                        $(firstRow).addClass('highlight');
                    }, 5000);
                }

                if (lastIdProject) {
                    api.rows().every(function () {
                        let rowData = this.data();
                        if (rowData.id_project === lastIdProject) {
                            $(this.node()).addClass('highlight');
                            $('html, body').animate({
                                scrollTop: $(this.node()).offset().top - 100
                            }, 1000);
                            // buka child-nya otomatis
                            openChildRow($(this.node()), rowData);
                        }
                    });

                    // localStorage.removeItem('last_id_project');
                    // localStorage.removeItem('last_page');
                }
            }
        });

        $('#mytable tbody').on('click', 'tr', function () {
            const table = $('#mytable').DataTable();
            const rowData = table.row(this).data(); // Ambil data dari DataTable, bukan dari DOM

            if (rowData) {
                const id = rowData.id_project; // pastikan nama field sesuai dari server

                const pageInfo = table.page.info();
                localStorage.setItem('last_id_project', id);
                localStorage.setItem('last_page', pageInfo.page);
            }
        });



        // Event handler untuk klik pada baris
        $('#mytable tbody').on('click', 'tr', function() {
            let rowData = table.row(this).data();
            let rowId = rowData.id_project;
            $(this).removeClass('highlight');
            $(this).removeClass('highlight-edit');
        });

        function openChildRow(tr, rowData) {
            let row = $('#mytable').DataTable().row(tr);
            let id_project = rowData.id_project;
            let icon = tr.find('.toggle-child i');

            if (!row.child.isShown()) {
                row.child('<div class="text-center py-2">Loading...</div>').show();
                tr.addClass('shown');
                if (icon.length) {
                    icon.removeClass('fa-plus-square').addClass('fa-spinner fa-spin');
                }

                $.ajax({
                    url: `Sample_reception/get_samples_by_project/${id_project}`,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        let tableContent = `<div class="child-table-container"><table class="child-table table table-bordered table-sm"><thead class="bg-light"><tr><th>Water Sample ID</th><th>Type of Sample</th><th>Receiving Lab</th><th>Date Arrived</th><th>Time Arrived</th><th>Date Collected</th><th>Time Collected</th><th>Quality Check</th><th>Description</th><th>Action</th></tr></thead><tbody>`;

                        if (data.length > 0) {
                            $.each(data, function (index, sample) {
                                let qualityCheckIcon = '';
                                if (sample.quality_check == 0) qualityCheckIcon = '<i class="fa fa-square-o" style="color: gray;"></i>';
                                else if (sample.quality_check == 1) qualityCheckIcon = '<i class="fa fa-check-square-o" style="color: green;"></i>';
                                else if (sample.quality_check == 2) qualityCheckIcon = '<i class="fa fa-times-circle-o" style="color: red;"></i>';

                                tableContent += `<tr><td>${sample.id_one_water_sample ?? '-'}</td><td>${sample.sampletype ?? '-'}</td><td>${sample.initial ?? '-'}</td><td>${sample.date_arrival ?? '-'}</td><td>${sample.time_arrival ?? '-'}</td><td>${sample.date_collected ?? '-'}</td><td>${sample.time_collected ?? '-'}</td><td>${qualityCheckIcon ?? '-'}</td><td>${sample.comments ?? '-'}</td><td>${sample.action ?? '-'}</td></tr>`;
                            });
                        } else {
                            tableContent += `<tr><td colspan="10" class="text-center">No samples available</td></tr>`;
                        }

                        tableContent += `</tbody></table></div>`;
                        row.child(tableContent).show();

                        if (icon.length) {
                            icon.removeClass('fa-spinner fa-spin').addClass('fa-minus-square');
                        }
                    },
                });
            }
        }

        $('#mytable tbody').on('click', '.toggle-child', function () {
            let tr = $(this).closest('tr');
            let row = $('#mytable').DataTable().row(tr);
            let id_project = row.data().id_project;
            let icon = $(this).find('i');

            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
                icon.removeClass('fa-minus-square').addClass('fa-plus-square');
            } else {
                row.child('<div class="text-center py-2">Loading...</div>').show();
                tr.addClass('shown');
                icon.removeClass('fa-plus-square').addClass('fa-spinner fa-spin');

                $.ajax({
                    url: `Sample_reception/get_samples_by_project/${id_project}`,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        let tableContent = `
                            <div class="child-table-container">
                                <table class="child-table table table-bordered table-sm">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Water Sample ID</th>
                                            <th>Type of Sample</th>
                                            <th>Receiving Lab</th>
                                            <th>Date Arrived</th>
                                            <th>Time Arrived</th>
                                            <th>Date Collected</th>
                                            <th>Time Collected</th>
                                            <th>Quality Check</th>
                                            <th>Note</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                        `;

                        if (data.length > 0) {
                            $.each(data, function (index, sample) {
                                let qualityCheckIcon = '';

                                // Tentukan ikon berdasarkan nilai quality_check
                                if (sample.quality_check == 0) {
                                    qualityCheckIcon = '<i class="fa fa-square-o" style="color: gray;"></i>';
                                } else if (sample.quality_check == 1) {
                                    qualityCheckIcon = '<i class="fa fa-check-square-o" style="color: green;"></i>';
                                } else if (sample.quality_check == 2) {
                                    qualityCheckIcon = '<i class="fa fa-times-circle-o" style="color: red;"></i>';
                                }
                                tableContent += `
                                    <tr>
                                        <td>${sample.id_one_water_sample ?? '-'}</td>
                                        <td>${sample.sampletype ?? '-'}</td>
                                        <td>${sample.initial ?? '-'}</td>
                                        <td>${sample.date_arrival ?? '-'}</td>
                                        <td>${sample.time_arrival ?? '-'}</td>
                                        <td>${sample.date_collected ?? '-'}</td>
                                        <td>${sample.time_collected ?? '-'}</td>
                                        <td>${qualityCheckIcon ?? '-'}</td>
                                        <td>${sample.comments ?? '-'}</td>
                                        <td>${sample.action ?? '-'}</td>
                                    </tr>
                                `;
                            });
                        } else {
                            tableContent += `<tr><td colspan="5" class="text-center">No samples available</td></tr>`;
                        }

                        tableContent += `</tbody></table></div>`;
                        row.child(tableContent).show();
                        icon.removeClass('fa-spinner fa-spin').addClass('fa-minus-square');
                    },
                });
            }
        }); 

        $('#mytable').on('click', '.btn_edit_sample', function() {
            let id_one_water_sample = $(this).data('id');
            $('#mode_sample').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Sample reception | Update<span id="my-another-cool-loader"></span>');

            $('#modal-sample-body').html('<div class="text-center py-3"><i class="fa fa-spinner fa-spin"></i> Loading...</div>');
            $.ajax({
                url: `Sample_reception/get_sample_detail/${id_one_water_sample}`,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    console.log(data); // 🔍 Debugging response di console

                    if (data.error) {
                        $('#modal-sample-body').html('<div class="text-danger text-center py-3">Data tidak ditemukan</div>');
                        return;
                    }

                    // Mengisi form modal dengan data yang diterima
                    $('#idx_one_water_sample').val(data.id_one_water_sample);
                    $('#idx_one_water_sample').attr('readonly', true);
                    $('#id_sampletype').val(data.id_sampletype);
                    $('#id_person').val(data.id_person);
                    $('#time_arrival_sample').val(data.time_arrival).trigger('change');
                    $('#date_arrival_sample').val(data.date_arrival).trigger('change');

                    let dateCollected = data.date_collected;
                    if (dateCollected === '0000-00-00') {
                        $('#date_selector_sample').val('NA');
                        $('#date_collected_sample').val('');
                        $('#date_collected_sample').prop('disabled', true);
                    } else {
                        $('#date_selector_sample').val('date');
                        $('#date_collected_sample').val(dateCollected);
                        $('#date_collected_sample').prop('disabled', false);
                    }

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
                    $('#quality_check').val(data.quality_check);
                    $('#time_collected_sample').val(data.time_collected).trigger('change');
                    $('#comments_sample').val(data.comments);
                            
                    
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

                        // Update the label text
                        label.textContent = states[currentState].label;

                        // Apply styling to the label based on the state
                        label.className = `form-check-label ${states[currentState].class}`;

                        // (Optional) Update a hidden input or store the value somewhere for submission
                        checkbox.value = states[currentState].value; // Set the value to the current state
                    });

                    $('#time_collected_sample').on('change', function() {
                        validateTimeCollected();
                    });

                    $('#form-sample').on('submit', function(e) {
                        if (!validateTimeCollected()) {
                            e.preventDefault(); // Prevent form submission if validation fails
                        }
                    });

                    function validateTimeCollected() {
                        let timeArrival = $('#time_arrival_sample').val();
                        let timeCollected = $('#time_collected_sample').val();
                        let isValid = true;

                        $('#time_collected_error_sample').hide();
                            // Check if time collected is empty
                            if (!timeCollected) {
                                $('#time_collected_error_sample').text('Time collected cannot be empty.').show();
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
                                    $('#time_collected_error_sample').text('Time collected cannot be greater than or equal to time arrive.').show();
                                    isValid = false;
                                }
                            }

                            // If valid, update the input value to prevent the default time from being sent
                            if (isValid) {
                                $('#time_collected_sample').val(timeCollected);
                            } else {
                                $('#time_collected_sample').val('');
                            }

                            return isValid;
                        }

                        toggleDateInput();

                    // Display modal
                    $('#compose-modal-sample').modal('show');
                    $('#modal-sample-body').html(''); // Clear loading spinner
                },
                error: function () {
                    $('#modal-sample-body').html('<div class="text-danger text-center py-3">Gagal memuat data</div>');
                }
            });
        });

        $(document).on('click', '.btn_delete_sample', function() {
            let id_one_water_sample = $(this).data('id');
            let url = '<?php echo site_url('Sample_reception/delete_sample'); ?>/' + id_one_water_sample;
            $('#confirm-modal #id').text(id_one_water_sample);
            console.log(id);
            showConfirmation(url);
        });


        // Function to populate client details based on selected contact
        function populateClientDetails() {
            const selectedOption = $('#id_client_contact option:selected');

            if (selectedOption.val()) {
                $('#client_address').val(selectedOption.data('address') || '-');
                $('#client_telp').val(selectedOption.data('telp') || '-');
                $('#client_phone').val(selectedOption.data('phone') || '-');
                $('#client_email').val(selectedOption.data('email') || '-');
                $('#clientDetails').show();
            } else {
                $('#clientDetails').hide();
                $('#client_address, #client_telp, #client_phone, #client_email').val('');
            }
        }

        // Trigger populateClientDetails on dropdown change
        $('#id_client_contact').on('change', function () {
            populateClientDetails();
        });

        // Function to update client details (already selected client contact)
        function updateClientDetails() {
            const selected = $('#id_client_contact option:selected');
            const address = selected.data('address') || '';
            const telp    = selected.data('telp') || '';
            const phone   = selected.data('phone') || '';
            const email   = selected.data('email') || '';

            $('#client_address').val(address);
            $('#client_telp').val(telp);
            $('#client_phone').val(phone);
            $('#client_email').val(email);

            // Show or hide the client details section based on selection
            if (selected.val()) {
                $('#clientDetails').slideDown();
            } else {
                $('#clientDetails').slideUp();
            }
        }

        // Trigger updateClientDetails on dropdown change and on page load
        $('#id_client_contact').on('change', updateClientDetails);
        if ($('#id_client_contact').val()) {
            updateClientDetails();
        }

        $('#compose-modal').on('hide.bs.modal', function () {
            // Reset seluruh form
            $(this).find('form')[0].reset();

            // Reset dropdown manual
            $('#id_client_contact option:selected').prop('selected', false); // unselect
            $('#id_client_contact').val(''); // clear value
            $('#id_client_contact').prop('selectedIndex', 0); // set ke opsi pertama jika ada
            $('#id_client_contact').trigger('change'); // jaga-jaga, tetap trigger

            // Reset manual semua inputan detail client
            $('#client_address').val('');
            $('#client_telp').val('');
            $('#client_phone').val('');
            $('#client_email').val('');

            // Sembunyikan detail client
            $('#clientDetails').hide();
        });



        // Open the modal for adding new data
        $('#addtombol').click(function() {
            $('#mode').val('insert'); // Set mode to insert
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Sample reception | New <span id="my-another-cool-loader"></span>');

            // Reset form fields for new entry
            $('#idx_project').val(id_project).attr('readonly', true);
            $('#client_quote_number').val('');
            $('#client').val('');
            $('#clientx').hide();
            $('#client').show();
            $('#id_client_contact').val(''); // Clear client contact dropdown
            $('#id_client_sample').val('').attr('readonly', false);
            $('#number_sample').val('').attr('readonly', false);
            $('#files').val('');
            $('#comments').val('');
            $('.val2tip').html('');
            $('#compose-modal').modal('show');
        });

        // Open the modal for editing existing data
        $('#mytable').on('click', '.btn_edit', function() {
            let tr = $(this).closest('tr');
            let data = table.row(tr).data(); // Assuming `table` is your DataTable instance
            console.log(data);
            $('#mode').val('edit'); // Set mode to edit
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Sample reception | Update <span id="my-another-cool-loader"></span>');

            // Pre-fill fields with the selected data for editing
            $('#idx_project').val(data.id_project).attr('readonly', true);
            $('#client_quote_number').val(data.client_quote_number);
            $('#client').hide();
            $('#clientx').show().val(data.client);
            // $('#id_client_sample').val(data.id_client_sample).attr('readonly', true);
            $('#id_client_contact').val(data.id_client_contact);
            
            // Populate client details
            populateClientDetails();

            // Pre-fill other form fields
            $('#number_sample').val(data.number_sample).attr('readonly', true);
            $('#files').val(data.files).attr('readonly', true);
            $('#date_collected').val(data.date_collected);
            $('#time_collected').val(data.time_collected);
            $('#comments').val(data.comments);
            $('#id_client_sample').val(data.id_client_sample);
            $('.val2tip').html('');
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

<!-- <script>
    function openScanner() {
        window.open("<?= base_url('index.php/scan_page') ?>", "_blank");  // Ganti dengan 'scan' karena itu adalah route-nya
    }

</script> -->

<script>
function openScanner() {
  const idxProject = $('#idx_project').val(); // Ambil nilai project dari input form
  const w = 800;
  const h = 600;
  const y = window.top.outerHeight / 2 + window.top.screenY - (h / 2);
  const x = window.top.outerWidth / 2 + window.top.screenX - (w / 2);

  const url = "<?= site_url('scan_page') ?>?project_id=" + encodeURIComponent(idxProject);

  window.open(url, "Scan Document",
    `width=${w},height=${h},top=${y},left=${x}`);
}


// 👇 Tangkap data dari scanner popup
window.addEventListener("message", function(event) {
    if (event.data && event.data.type === 'scan-upload-complete') {
        const filename = event.data.filename;
        console.log("Dapat nama file dari scanner:", filename);

        // Masukkan ke input #files
        const fileInput = document.getElementById("files");
        if (fileInput) {
            fileInput.value = filename;
        }

        // Optional: kasih tanda sukses
        const valTip = document.querySelector(".val2tip");
        if (valTip) {
            valTip.innerHTML = `<span class="text-success">File <b>${filename}</b> has been uploading!</span>`;
        }
    }
});
</script>