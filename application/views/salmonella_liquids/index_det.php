<div class="content-wrapper">
	<section class="content">
		<div class="box box-black box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Processing | Salmonella Liquids | Details</h3>
			</div>
				<form role="form"  id="formKeg" method="post" class="form-horizontal">
					<div class="box-body">
						<!-- <input type="hidden" class="form-control " id="id_req" name="id_req" value="<?php// echo $id_req ?>"> -->
						<input id="id_salmonella_liquids" name="id_salmonella_liquids" type="hidden" class="form-control input-sm" value="<?php echo $id_salmonella_liquids ?>">
						<div class="form-group">
							<label for="id_one_water_sample" class="col-sm-2 control-label">One Water Sample ID</label>
							<div class="col-sm-4">
								<input class="form-control " id="id_one_water_sample" name="id_one_water_sample" value="<?php echo $id_one_water_sample  ?? '-' ?>"  disabled>
							</div>

							<label for="initial" class="col-sm-2 control-label">Lab Tech</label>
							<div class="col-sm-4">
								<input class="form-control " id="initial" name="initial" value="<?php echo $initial  ?? '-' ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="number_of_tubes" class="col-sm-2 control-label">Number of Assay Tubes</label>
							<div class="col-sm-4">
								<input class="form-control " id="number_of_tubes" name="number_of_tubes" value="<?php echo $number_of_tubes  ?? '-' ?>"  disabled>
							</div>

							<label for="sampletype" class="col-sm-2 control-label">Sample Type</label>
							<div class="col-sm-4">
								<input class="form-control " id="sampletype" name="sampletype" value="<?php echo $sampletype ?? '-' ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="mpn_pcr_conducted" class="col-sm-2 control-label">MPN PCR Conducted</label>
							<div class="col-sm-4">
								<input class="form-control " id="mpn_pcr_conducted" name="mpn_pcr_conducted" value="<?php echo $mpn_pcr_conducted  ?? '-' ?>"  disabled>
							</div>

							<label for="salmonella_assay_barcode" class="col-sm-2 control-label">Salmonella Assay Barcode</label>
							<div class="col-sm-4">
								<input class="form-control " id="salmonella_assay_barcode" name="salmonella_assay_barcode" value="<?php echo $salmonella_assay_barcode  ?? '-' ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="date_sample_processed" class="col-sm-2 control-label">Date Sample</label>
							<div class="col-sm-4">
								<input class="form-control " id="date_sample_processed" name="date_sample_processed" value="<?php echo $date_sample_processed  ?? '-' ?>" disabled>
							</div>

							<label for="time_sample_processed" class="col-sm-2 control-label">Time Sample</label>
							<div class="col-sm-4">
								<input class="form-control " id="time_sample_processed" name="time_sample_processed" value="<?php echo $time_sample_processed  ?? '-' ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<!-- <label for="sample_wetweight" class="col-sm-2 control-label">Sample Wet Weight</label>
							<div class="col-sm-4">
								<input class="form-control " id="sample_wetweight" name="sample_wetweight" value="<?php echo $sample_wetweight ?>"  disabled>
							</div> -->

                            <label for="elution_volume" class="col-sm-2 control-label">Elution Volume</label>
							<div class="col-sm-4">
								<input class="form-control " id="elution_volume" name="elution_volume" value="<?php echo $elution_volume  ?? '-' ?>"  disabled>
							</div>

                            <label for="enrichment_media" class="col-sm-2 control-label">Enrichment media</label>
							<div class="col-sm-4">
								<input class="form-control " id="enrichment_media" name="enrichment_media" value="<?php echo $enrichment_media  ?? '-' ?>"  disabled>
							</div>
						</div>

					</div>
				</form>
			<div class="box-footer">
                <div class="col-xs-12"> 
                        <div class="box box-primary box-solid">
                            <div class="box-header">
                                <h3 class="box-title">Results XLD</h3>
                            </div>
							<div class="box-body pad table-responsive">
								<?php
									$lvl = $this->session->userdata('id_user_level');
									if ($lvl != 4){
										echo "<button class='btn btn-primary' id='addtombol_detResultsXld'><i class='fa fa-wpforms' aria-hidden='true'></i> New Data</button>";
									}
								?>
								<table id="example2" class="table display table-bordered table-striped" width="100%">
									<thead>
										<tr>
                                            <th>Salmonella Assay Barcode</th>
                                            <th>Date of Sample</th>
                                            <th>Time of Sample</th>
                                            <th>Black Colony Plate</th>
                                            <th>Action</th>
										</tr>
									</thead>
								</table>
							</div>
                        </div>
                    </div>

                    <div class="col-xs-12"> 
                        <div class="box box-primary box-solid">
                            <div class="box-header">
                                <h3 class="box-title">Results ChroMagar</h3>
                            </div>
							<div class="box-body pad table-responsive">
								<?php
									$lvl = $this->session->userdata('id_user_level');
									if ($lvl != 4){
										echo "<button class='btn btn-primary' id='addtombol_detResultsChromagar'><i class='fa fa-wpforms' aria-hidden='true'></i> New Data</button>";
									}
								?>
								<table id="exampleChromagar" class="table display table-bordered table-striped" width="100%">
									<thead>
										<tr>
                                            <th>Salmonella Assay Barcode</th>
                                            <th>Date of Sample</th>
                                            <th>Time of Sample</th>
                                            <th>Purple Colony Plate</th>
                                            <th>Action</th>
										</tr>
									</thead>
								</table>
							</div>
                        </div>
                    </div>

                    <div class="col-xs-12"> 
                        <div class="box box-primary box-solid" role="dialog" aria-hidden="true" data-bs-scrollable="true">
                            <div class="box-header">
                                <h3 class="box-title">Results</h3>
                            </div>
                            <div id="content-result-biochemical">

                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="box box-primary box-solid">
                            <div class="box-header">
                                <h3 class="box-title">Final Concentration</h3>
                            </div>
                            <div class="box-body pad">
                                <div style="padding-bottom: 10px;">
                                    <button class="btn btn-success" id="exportBtn">
                                        <i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to XLS
                                    </button>
                                </div>
                                <input id="id_salmonella_liquids" name="id_salmonella_liquids" type="hidden" class="form-control input-sm" value="<?php echo $id_salmonella_liquids ?>">

                                <div id="content-final-concentration" class="table-responsive">
                                    <table id="exampleFinalConcentration" class="table display table-bordered table-striped" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID One Water Sample</th>
                                                <th>Salmonella Assay Barcode</th>
                                                <th>Initial</th>
                                                <th>Sample Type</th>
                                                <th>Number of Tubes</th>
                                                <th>MPN PCR Conducted</th>
                                                <th>Date Sample Processed</th>
                                                <th>Time Sample Processed</th>
                                                <th>Sample Wet Weight</th>
                                                <th>Elution Volume</th>
                                                <th>Enrichment Media</th>
                                                <?php if (!empty($finalConcentration)): ?>
                                                    <?php foreach ($finalConcentration[0] as $key => $value): ?>
                                                        <?php if (strpos($key, 'Tube') === 0): ?>
                                                            <th><?= htmlspecialchars($key) ?> Volume</th>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    <?php 
                                                    // Ambil plate_numbers dari data pertama
                                                    $plate_numbers = explode(',', $finalConcentration[0]->plate_numbers);
                                                    foreach ($plate_numbers as $plate_number): ?>
                                                        <th>Tube <?= htmlspecialchars($plate_number) ?> Result</th>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <th colspan="100%" style="text-align: center">No data available</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($finalConcentration)): ?>
                                                <?php foreach ($finalConcentration as $concentration): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($concentration->id_one_water_sample) ?></td>
                                                        <td><?= htmlspecialchars($concentration->salmonella_assay_barcode) ?></td>
                                                        <td><?= htmlspecialchars($concentration->initial) ?></td>
                                                        <td><?= htmlspecialchars($concentration->sampletype ?? '-') ?></td>
                                                        <td><?= htmlspecialchars($concentration->number_of_tubes) ?></td>
                                                        <td><?= htmlspecialchars($concentration->mpn_pcr_conducted) ?></td>
                                                        <td><?= htmlspecialchars($concentration->date_sample_processed) ?></td>
                                                        <td><?= htmlspecialchars($concentration->time_sample_processed) ?></td>
                                                        <td><?= htmlspecialchars($concentration->sample_wetweight) ?></td>
                                                        <td><?= htmlspecialchars($concentration->elution_volume) ?></td>
                                                        <td><?= htmlspecialchars($concentration->enrichment_media) ?></td>

                                                        <?php foreach ($concentration as $key => $value): ?>
                                                            <?php if (strpos($key, 'Tube') === 0): ?>
                                                                <td><?= htmlspecialchars($value) ?></td>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        
                                                        <?php 
                                                        // Ambil plate_numbers dari data
                                                        $plate_numbers = explode(',', $concentration->plate_numbers);
                                                        
                                                        // Loop untuk setiap plate_number
                                                        foreach ($plate_numbers as $plate_number): 
                                                            // Cek jika confirmation untuk plate_number ada
                                                            $confirmation_value = isset($concentration->confirmation[$plate_number]) ? $concentration->confirmation[$plate_number] : 'No Available'; 
                                                        ?>
                                                            <td><?= htmlspecialchars($confirmation_value) ?></td>
                                                        <?php endforeach; ?>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="100%" style="text-align: center">No data available</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

				<div class="form-group">
					<div class="modal-footer clearfix">
						<button type="button" name="batal" value="batal" class="btn btn-warning" onclick="window.location.href='<?= site_url('salmonella_liquids'); ?>';">
							<i class="fa fa-times"></i> Close
						</button>
					</div>
				</div>
			</div> 
		</div>
	</section>
</div>

<!-- MODAL FORM Results XLD -->
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-scrollable="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                        <h4 class="modal-title" id="modal-title-Xld">
							<span id="my-another-cool-loader"></span></h4>
                    </div>
                        <form id="formDetail24" action=<?php echo site_url('Salmonella_liquids/saveResultsXld') ?> method="post" class="form-horizontal">
                            <div class="modal-body">
                                <div class="form-group">
                                        <div class="col-sm-9">
                                            <input id="mode_detResultsXld" name="mode_detResultsXld" type="hidden" class="form-control input-sm">
                                            <input id="id_salmonella_liquids1" name="id_salmonella_liquids1" type="hidden" class="form-control input-sm">
                                            <input id="number_of_tubes1" name="number_of_tubes1" type="hidden" class="form-control input-sm">
                                            <input id="id_result_xld" name="id_result_xld" type="hidden" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="salmonella_assay_barcode1" class="col-sm-4 control-label">Salmonella Assay Barcode</label>
                                        <div class="col-sm-8">
                                            <input id="salmonella_assay_barcode1" name="salmonella_assay_barcode1" type="text"  placeholder="Salmonella Assay Barcode" class="form-control">
                                            <div class="val1tip"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="date_sample_processed1" class="col-sm-4 control-label">Date Sample Processed</label>
                                        <div class="col-sm-8">
                                            <input id="date_sample_processed1" name="date_sample_processed1" type="date" class="form-control" placeholder="Date Sample Processed" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="time_sample_processed1" class="col-sm-4 control-label">Time Sample Processed</label>
                                        <div class="col-sm-8">
                                            <div class="input-group clockpicker">
                                                <input id="time_sample_processed1" name="time_sample_processed1" class="form-control" placeholder="Time Sample Processed" value="<?php echo (new DateTime())->format('H:i'); ?>">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="form-group" id="purple_colony_plate">
                                        <label class="col-sm-4 control-label"> Purple Colony Plate</label>
                                        <div class="col-sm-8" id="purpleColonyPlateInputs">
                                        </div>
                                    </div> -->

                                    <div class="form-group" id="black_colony_plate_chromagar">
                                        <label class="col-sm-4 control-label">Black Colony Plate</label>
                                        <div class="col-sm-8" id="blackColonyPlateInputs">
                                            <!-- Radio buttons akan dihasilkan di sini -->
                                        </div>
                                    </div>


                            </div>
                            <div class="modal-footer clearfix">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                <button type="button" id='cancelButton' class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                            </div>
                        </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

<!-- MODAL FORM Results CHROMagar -->
<div class="modal fade" id="compose-modalChroMagar" tabindex="-1" role="dialog" aria-hidden="true" data-bs-scrollable="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                        <h4 class="modal-title" id="modal-title-Chromagar">
							<span id="my-another-cool-loader"></span></h4>
                    </div>
                        <form id="formDetail24" action=<?php echo site_url('Salmonella_liquids/saveResultsChromagar') ?> method="post" class="form-horizontal">
                            <div class="modal-body">
                                <div class="form-group">
                                        <div class="col-sm-9">
                                            <input id="mode_detResultsChromagar" name="mode_detResultsChromagar" type="hidden" class="form-control input-sm">
                                            <input id="id_salmonella_liquidsChromagar" name="id_salmonella_liquidsChromagar" type="hidden" class="form-control input-sm">
                                            <input id="number_of_tubesChromagar" name="number_of_tubesChromagar" type="hidden" class="form-control input-sm">
                                            <input id="id_result_chromagar" name="id_result_chromagar" type="hidden" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="salmonella_assay_barcodeChromagar" class="col-sm-4 control-label">Salmonella Assay Barcode</label>
                                        <div class="col-sm-8">
                                            <input id="salmonella_assay_barcodeChromagar" name="salmonella_assay_barcodeChromagar" type="text"  placeholder="Salmonella Assay Barcode" class="form-control">
                                            <div class="val1tip"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="date_sample_processedChromagar" class="col-sm-4 control-label">Date Sample Processed</label>
                                        <div class="col-sm-8">
                                            <input id="date_sample_processedChromagar" name="date_sample_processedChromagar" type="date" class="form-control" placeholder="Date Sample Processed" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="time_sample_processedChromagar" class="col-sm-4 control-label">Time Sample Processed</label>
                                        <div class="col-sm-8">
                                            <div class="input-group clockpicker">
                                                <input id="time_sample_processedChromagar" name="time_sample_processedChromagar" class="form-control" placeholder="Time Sample Processed" value="<?php echo (new DateTime())->format('H:i'); ?>">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="form-group" id="black_colony_plate_chromagar">
                                        <label class="col-sm-4 control-label">Black Colony Plate</label>
                                        <div class="col-sm-8" id="blackColonyPlateInputsChromagar">
                                        </div>
                                    </div> -->

                                    <div class="form-group" id="purple_colony_plate">
                                        <label class="col-sm-4 control-label"> Purple Colony Plate</label>
                                        <div class="col-sm-8" id="purpleColonyPlateInputs">
                                            <!-- Radio buttons akan dihasilkan di sini -->
                                        </div>
                                    </div>


                            </div>
                            <div class="modal-footer clearfix">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                <button type="button" id='cancelButton' class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                            </div>
                        </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- MODAL FORM Biochemical -->
<div class="modal fade" id="compose-modalBiochemical" tabindex="-1" role="dialog" aria-hidden="true" data-bs-scrollable="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                <h4 class="modal-title" id="modal-title-biochemical">Tube | New</h4>
            </div>
            <form id="formBiochemical" action="<?php echo site_url('Salmonella_liquids/saveBiochemical') ?>" method="post" class="form-horizontal">
                <div class="modal-body">
                    <input id="mode_detResultsBiochemical" name="mode_detResultsBiochemical" type="hidden" class="form-control input-sm">
                    <input id="id_salmonella_liquidsBiochemical" name="id_salmonella_liquidsBiochemical" type="hidden" class="form-control input-sm">
                    <input id="id_result_biochemical" name="id_result_biochemical" type="hidden" class="form-control input-sm">
                    <input id="biochemical_tube" name="biochemical_tube" type="hidden" class="form-control input-sm">
                    <input id="id_result_chromagar1" name="id_result_chromagar1" type="hidden" class="form-control input-sm">
                    

                    <!-- Oxidase Result -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Oxidase Result</label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <input type="radio" name="oxidase"  value="Positive" required> Positive
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="oxidase"  value="Negative"> Negative
                            </label>
                        </div>
                    </div>

                    <!-- Catalase Result -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Catalase Result</label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <input type="radio" name="catalase"  value="Positive" required> Positive
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="catalase" value="Negative"> Negative
                            </label>
                        </div>
                    </div>

                    <!-- Confirmation -->
                    <div class="form-group">
                        <label for="confirmation" class="col-sm-4 control-label">Confirmation</label>
                        <div class="col-sm-8">
                            <input id="confirmation" name="confirmation" type="text" class="form-control" placeholder="Confirmation" readonly>
                        </div>
                    </div>

                    <!-- Sample Store in Biobank -->
                    <div class="form-group">
                        <label for="sample_store" class="col-sm-4 control-label">Sample Store in Biobank</label>
                        <div class="col-sm-8">
                            <select id="sample_store" name="sample_store" class="form-control" required>
                                <option value="" disabled selected>-- Select --</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
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





<!-- MODAL INFORMATION -->
<div class="modal fade" id="confirm-modal" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #f39c12; color: white;">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
					<h4 class="modal-title">Salmonella Liquids | Information</h4>
				</div>
                <div id="confirmation-content">
                    <div class="modal-body">
                    </div>
                </div>
				<div class="modal-footer clearfix">
					<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Close </button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- MODAL CONFIRMATION DELETE -->
<div class="modal fade" id="confirm-modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div id="confirmation-content">
                    <div class="modal-body">
                        <p class="text-center" style="font-size: 15px;">Are you sure you want to delete ID <span id="id" style="font-weight: bold;"></span> ?</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer clearfix">
                <button type="button" id="confirm-delete" class="btn btn-danger"><i class="fa fa-trash"></i> Yes</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<style>
    #content-result-biochemical {
        max-height: 400px; 
        overflow-y: auto;
    }
    .table-responsive {
    overflow-x: auto;
}

</style>


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script>
    document.getElementById('exportBtn').addEventListener('click', function() {
        let id_salmonella_liquids = document.getElementById('id_salmonella_liquids').value;
        window.location.href = '<?php echo site_url('Salmonella_liquids/excel') ?>/' + id_salmonella_liquids;
    });
</script>
<script type="text/javascript">

    let table;
    let table1;
    let table2;
    let id_moisture = $('#id_moisture').val();
    let salmonella_assay_barcode = $('#salmonella_assay_barcode').val();
    let id_salmonella_liquids = $('#id_salmonella_liquids').val();
    let number_of_tubes = $('#number_of_tubes').val();
    const BASE_URL = '/limsonewater/index.php';

    $(document).ready(function() {

    // Event listener untuk radio button Oxidase
    $('input[name="oxidase"]').on('change', updateConfirmation);
    
    // Event listener untuk radio button Catalase
    $('input[name="catalase"]').on('change', updateConfirmation);
    
    function updateConfirmation() {
        const oxidaseValue = $('input[name="oxidase"]:checked').val();
        const catalaseValue = $('input[name="catalase"]:checked').val();
        
        let confirmationText = '';

        if (oxidaseValue === 'Positive' && catalaseValue === 'Positive') {
            confirmationText = 'Salmonella';
        } else if (oxidaseValue === 'Negative' && catalaseValue === 'Negative') {
            confirmationText = 'Not Salmonella';
        } else if (oxidaseValue === 'Positive' && catalaseValue === 'Negative') {
            confirmationText = 'Not Salmonella';
        } else if (oxidaseValue === 'Negative' && catalaseValue === 'Positive') {
            confirmationText = 'Not Salmonella';
        } else {
            confirmationText = '';
        }

        $('#confirmation').val(confirmationText);
    }

    function generateColonyPlateInputs(container, numberOfTubes) {
            container.empty(); // Clear existing inputs

            // Create the required number of inputs and labels
            for (let i = 1; i <= numberOfTubes; i++) {
                container.append(
                    `<div class="d-flex align-items-center mb-2">
                        <label class="control-label me-3" style="margin-bottom: 0; line-height: 1.5;">Black ${i}:</label>
                        <div class="d-flex align-items-center">
                            <label class="radio-inline me-2" style="margin-bottom: 0;">
                                <input type="radio" name="colony_plate${i}" value="1" required> Yes
                            </label>
                            <label class="radio-inline" style="margin-bottom: 0;">
                                <input type="radio" name="colony_plate${i}" value="0" required> No
                            </label>
                        </div>
                    </div>`
                );
            }
        }

        $('#number_of_tubes').change(function() {
            let numberOfTubes = parseInt($(this).val()); // Get the selected value as an integer
            generateColonyPlateInputs($('#purpleColonyPlateInputs'), numberOfTubes);
            generateColonyPlateInputs($('#blackColonyPlateInputs'), numberOfTubes);
        }).trigger('change');


        function showConfirmationDelete(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal-delete').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_deleteXld, .btn_deleteChromagar, .btn_deleteBiochemical', function() {
            let id = $(this).data('id');
            let url;
            if ($(this).hasClass('btn_deleteXld')) {
                url = '<?php echo site_url('Salmonella_liquids/delete_detailXld'); ?>/' + id;
                $('.modal-title').html('<i class="fa fa-trash"></i> Result XLD | Delete <span id="my-another-cool-loader"></span>');
                $('#confirm-modal-delete #id').text(id);
            } else if ($(this).hasClass('btn_deleteChromagar')) {
                url = '<?php echo site_url('Salmonella_liquids/delete_detailChromagar'); ?>/' + id;
                $('.modal-title').html('<i class="fa fa-trash"></i> Result Chromagar | Delete <span id="my-another-cool-loader"></span>');
                $('#confirm-modal-delete #id').text(id);
            } else if ($(this).hasClass('btn_deleteBiochemical')) {
                url = '<?php echo site_url('Salmonella_liquids/delete_detailBiochemical'); ?>/' + id;
                $('.modal-title').html('<i class="fa fa-trash"></i> Result | Delete <span id="my-another-cool-loader"></span>');
                $('#confirm-modal-delete #id').text(id);
            }

            showConfirmationDelete(url);

        });

        // When the confirm-delete button is clicked
        $('#confirm-delete').click(function() {
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
                    $('#confirm-modal-delete').modal('hide');
                    location.reload();
                }
            });
        });


        $('.noEnterSubmit').keypress(function (e) {
            if (e.which == 13) return false;
        });

        $('.clockpicker').clockpicker({
            placement: 'bottom',
            align: 'left',
            donetext: 'Done',
            autoclose: true,
            vibrate: true
        });                

        $('.val1tip, .val2tip').tooltipster({
            animation: 'swing',
            delay: 1,
            theme: 'tooltipster-default',
            autoClose: true,
            position: 'bottom',
        });

        $('#barcode_tray24').click(function() {
            $('.val1tip').tooltipster('hide');   
        });

        $('#barcode_tray72').click(function() {
            $('.val2tip').tooltipster('hide');   
        });

        $('#compose-modal').on('shown.bs.modal', function () {
            $('.val1tip').tooltipster('hide'); 
        });

        $('#compose-modalCharomagar').on('shown.bs.modal', function () {
            $('.val2tip').tooltipster('hide'); 
        });

        $("input").keypress(function(){
            $('.val1tip').tooltipster('hide'); 
        });

        $("input").keypress(function(){
            $('.val2tip').tooltipster('hide'); 
        });

        $('#compose-modal').on('shown.bs.modal', function () {
            $('#barcode_tray24').focus();
        });

        $('#compose-modalCharomagar').on('shown.bs.modal', function () {
            $('#dry_weight72').focus();
        });

        $('#barcode_tray24').on("change", function() {
            let barcode24 = $('#barcode_tray24').val();
            $.ajax({
                type: "GET",
                url: `${BASE_URL}/Moisture_content/validate24`,
                data: { id24: barcode24 },
                dataType: "json",
                success: function(data) {
                    if (data.length == 0) {
                        let tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + barcode24 +'</strong> is not on moisture content or is not already in the system !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#barcode_tray24').focus();
                        $('#barcode_tray24').val('');       
                        $('#barcode_tray24').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_tray24').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_tray24').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_tray24').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
        });

        // Function to calculate the dry_weight_persen
        function updateDryWeightPersen() {
            let traysampleWetweight = parseFloat($('#traysample_wetweight').val()) || 0; // Get the traysample wet weight
            let dryWeight72 = parseFloat($('#dry_weight72').val()) || 0; // Get the dry weight 72h

            if (traysampleWetweight > 0) { // Ensure traysampleWetweight is not zero to avoid division by zero
                let dryWeightPersen = (1-(((traysampleWetweight - dryWeight72) / dryWeight72) * 100)).toFixed(2); // Calculate percentage
                $('#dry_weight_persen').val(dryWeightPersen); // Update the percentage field
            } else {
                $('#dry_weight_persen').val(''); // Clear the percentage field if traysampleWetweight is zero or invalid
            }
        }

        // Attach the function to the input event of dry_weight72
        $('#dry_weight72').on('input', updateDryWeightPersen);

        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
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


        table = $("#example2").DataTable({
            oLanguage: {
                sProcessing: "Loading data, please wait..."
            },
            processing: true,
            serverSide: true,
            paging: false,
            info: false,
            bFilter: false,
            ajax: {"url": "../../Salmonella_liquids/subjsonXld?idXld="+id_salmonella_liquids, "type": "POST"},
            columns: [
                {"data": "salmonella_assay_barcode"},
                {"data": "date_sample_processed"},
                {"data": "time_sample_processed"},
                {"data": "black_colony_plate"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[0, 'asc']],
            rowCallback: function(row, data, iDisplayIndex) {
                let info = this.fnPagingInfo();
                if (info.iTotal > 0) {
                    $('#addtombol_detResultsXld').prop("disabled", true);
                } else {
                    $('#addtombol_detResultsXld').show();
                }
            }
        });

        $('#example2 tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }
        });

        table1 = $("#exampleChromagar").DataTable({
            oLanguage: {
                sProcessing: "Loading data, please wait..."
            },
            processing: true,
            serverSide: true,
            paging: false,
            info: false,
            bFilter: false,
            ajax: {"url": "../../Salmonella_liquids/subjsonChromagar?idChromagar="+id_salmonella_liquids, "type": "POST"},
            columns: [
                {"data": "salmonella_assay_barcode"},
                {"data": "date_sample_processed"},
                {"data": "time_sample_processed"},
                {"data": "purple_colony_plate"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[0, 'asc']],
            rowCallback: function(row, data, iDisplayIndex) {
                let info = this.fnPagingInfo();
                if (info.iTotal > 0) {
                    $('#addtombol_detResultsChromagar').prop("disabled", true);
                } else {
                    $('#addtombol_detResultsChromagar').show();
                }
            }
        });

        $('#exampleChromagar tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table1.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }
        });


        table1.ajax.reload(function() {
            let td = $('#exampleChromagar td:first');
            let data = table1.row(td).data();
            console.log(data);

            if (data) {
                const purpleColonyPlateArray = data.purple_colony_plate.split(', ');
                const plateNumberArray = data.plate_number.split(', ');

                // Generate the biochemical results for all plate numbers
                generateResultBiochemical($('#content-result-biochemical'), plateNumberArray.length, data.id_salmonella_liquids, plateNumberArray, purpleColonyPlateArray);
            } else {
                console.log('Data belum tersedia');
                $('#content-result-biochemical').empty().append('<p class="text-center">No data available</p>');
            }
        });

        // Improved generateResultBiochemical function
        function generateResultBiochemical(container, numberOfPlates, id_salmonella_liquids, plateNumberArray, purpleColonyPlateArray) {
            container.empty(); // Clear existing content

            // Iterate through the plateNumberArray
            for (let i = 0; i < numberOfPlates; i++) {
                const plateNumber = plateNumberArray[i]; // Get the corresponding plate number
                const tableId = `exampleBiochemical_${i}`; // Unique table ID
                const buttonId = `addtombol_detResultsBiochemical_${plateNumber}`; // Unique button ID
                const isDisabled = purpleColonyPlateArray[i] === '0' ? 'disabled' : ''; // Determine if button should be disabled
                console.log('button biochemical tube', isDisabled);

                // Append the table and button for each plate
                container.append(`
                    <div class="box-body pad table-responsive">
                        <button class="btn btn-primary" id="${buttonId}" data-index="${plateNumber}" ${isDisabled}>
                            <i class="fa fa-wpforms" aria-hidden="true"></i> Tube ${plateNumber}
                        </button>
                        <table id="${tableId}" class="table display table-bordered table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th>Oxidase Result</th>
                                    <th>Catalase Result</th>
                                    <th>Confirmation</th>
                                    <th>Sample Store in Biobank</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                `);

                // Initialize DataTable for the newly created table, passing the plate number
                initializeDataTable(tableId, id_salmonella_liquids, plateNumber); // Pass the actual plate number
            }
        }


        // Fungsi untuk menginisialisasi DataTable
        function initializeDataTable(tableId, id_salmonella_liquids, tubeIndex) {
            console.log(`Tube index: ${tubeIndex}`);
            $(`#${tableId}`).DataTable({
                oLanguage: {
                    sProcessing: "Loading data, please wait..."
                },
                processing: true,
                serverSide: true,
                paging: false,
                info: false,
                bFilter: false,
                ajax: {
                    url: `../../Salmonella_liquids/subjsonBiochemical?idBiochemical=${id_salmonella_liquids}&biochemical_tube=${tubeIndex}`,
                    type: "POST"
                },
                columns: [
                    {"data": "oxidase"},
                    {"data": "catalase"},
                    {"data": "confirmation"},
                    {"data": "sample_store"},
                    {
                        "data": "action",
                        "orderable": false,
                        "className": "text-center"
                    }
                ],
                order: [[0, 'asc']],
                // Tambahkan callback ini untuk menyimpan status tombol saat data dimuat
                initComplete: function(settings, json) {
                // Disable the button if there's data
                if (json.data.length > 0) {
                    $(`#addtombol_detResultsBiochemical_${tubeIndex}`).prop("disabled", true);
                }
                    }
                });
        }

        
  
     
        // Event listener untuk tombol "New Data"
        $(document).on('click', '[id^=addtombol_detResultsBiochemical_]', function() {
            const plateNumber = $(this).data('index'); // Get the plate number directly
            let td = $('#exampleChromagar td:first');
            let data = table1.row(td).data();
            console.log('datanya', data.id_result_chromagar);

            $('#mode_detResultsBiochemical').val('insert');
            $('#modal-title-biochemical').html(`<i class="fa fa-wpforms"></i> Insert | Tube ${plateNumber} <span id="my-another-cool-loader"></span>`);
            $('#id_salmonella_liquidsBiochemical').val(id_salmonella_liquids);
            $('#id_result_chromagar1').val(data.id_result_chromagar);
            $('#oxidase').val('');
            $('#catalase').val('');
            // $('#confirmation').val('');
            $('#sample_store').val('');
            $('#biochemical_tube').val(plateNumber);
            $('#compose-modalBiochemical').modal('show');
            console.log(`Button for Biochemical Tube: ${plateNumber} clicked`);
        });


        // Event listener untuk tombol edit
        $(document).on('click', '.btn_edit_detResultsBiochemical', function() {
            let tr = $(this).closest('tr'); // Dapatkan elemen baris
            let tableId = $(this).closest('.box-body').find('table').attr('id'); // Dapatkan ID tabel dari konteks
            let data = $(`#${tableId}`).DataTable().row(tr).data(); // Dapatkan data dari DataTable yang sesuai
            console.log(data);

            // Set nilai-nilai di dalam modal sesuai data yang didapat
            $('#mode_detResultsBiochemical').val('edit');
            $('#modal-title-biochemical').html('<i class="fa fa-pencil-square"></i> Update | Tube ' + data.biochemical_tube + ' <span id="my-another-cool-loader"></span>');
            $('#id_result_biochemical').val(data.id_result_biochemical);
            $('#id_salmonella_liquidsBiochemical').val(data.id_salmonella_liquids);
            $('#id_result_chromagar1').val(data.id_result_chromagar);
            // Set radio button untuk oxidase
            $('input[name="oxidase"][value="' + data.oxidase + '"]').prop('checked', true);
            
            // Set radio button untuk catalase
            $('input[name="catalase"][value="' + data.catalase + '"]').prop('checked', true);
            $('#confirmation').val(data.confirmation);
            $('#sample_store').val(data.sample_store);
            // Tambahkan nilai lain yang diperlukan sesuai data

            // Tampilkan modal untuk edit
            $('#compose-modalBiochemical').modal('show');
        });





        $('#addtombol_detResultsXld').click(function() {
            $('#mode_detResultsXld').val('insert');
            $('#modal-title-Xld').html('<i class="fa fa-wpforms"></i> Insert | Results XLD <span id="my-another-cool-loader"></span>');
            $('#salmonella_assay_barcode1').val(salmonella_assay_barcode);
            $('#salmonella_assay_barcode1').attr('readonly', true);
            $('#id_salmonella_liquids1').val(id_salmonella_liquids);
            $('#number_of_tubes1').val(number_of_tubes);
            $('#compose-modal').modal('show');
        });

        $('#example2').on('click', '.btn_edit_detResultsXld', function() {
            let tr = $(this).closest('tr');
            let data = table.row(tr).data();
            console.log(data);
            $('#mode_detResultsXld').val('edit');
            $('#modal-title-Xld').html('<i class="fa fa-pencil-square"></i> Update | Results XLD <span id="my-another-cool-loader"></span>');
            $('#id_result_xld').val(data.id_result_xld);
            $('#salmonella_assay_barcode1').val(data.salmonella_assay_barcode);
            $('#salmonella_assay_barcode1').attr('readonly', true);
            $('#id_salmonella_liquids1').val(data.id_salmonella_liquids);
            $('#date_sample_processed1').val(data.date_sample_processed);
            $('#time_sample_processed1').val(data.time_sample_processed);
            $('#number_of_tubes1').val(number_of_tubes);

            // Clear existing blackColonyPlateInputs
            let blackColonyPlateInputs = $('#blackColonyPlateInputs');
            blackColonyPlateInputs.empty();

            // split the string into an array
            const blackColonyPlateArray = data.black_colony_plate.split(', ');
            const plateNumberArray = data.plate_number.split(', ');

            // making the input base on the plate number
            plateNumberArray.forEach((plateNumber, index) => {
                const plate = blackColonyPlateArray[index] || '';

                // decide the value radio selected
                const checkedYes = plate === '1' ? 'checked' : '';
                const checkedNo = plate === '0' ? 'checked' : '';

                blackColonyPlateInputs.append(
                    `<div class="d-flex align-items-center mb-2">
                        <label class="control-label me-3" style="margin-bottom: 0; line-height: 1.5;">Black ${plateNumber}:</label>
                        <div class="d-flex align-items-center">
                            <label class="radio-inline me-2" style="margin-bottom: 0;">
                                <input type="radio" id="black_colony_plate${plateNumber}" name="black_colony_plate${plateNumber}" value="1" ${checkedYes}> Yes
                            </label>
                            <label class="radio-inline" style="margin-bottom: 0;">
                                <input type="radio" id="black_colony_plate${plateNumber}"  name="black_colony_plate${plateNumber}" value="0" ${checkedNo}> No
                            </label>
                        </div>
                    </div>`
                );
            });

            $('#compose-modal').modal('show');
        });
        
        $('#addtombol_detResultsChromagar').on('click', function() {
            $('#mode_detResultsChromagar').val('insert');
            $('#modal-title-Chromagar').html('<i class="fa fa-wpforms"></i> Insert | Results Chromagar <span id="my-another-cool-loader"></span>');

            let td = $('#example2 td:first');
            let data = table.row(td).data();
            // let data1 = table.row(td).data();
            console.log(data);
            
            if (data && data.salmonella_assay_barcode) {
                let salmonella_assay_barcode = data.salmonella_assay_barcode;
                console.log(salmonella_assay_barcode);

                // Parsing data ke komponen
                $('#salmonella_assay_barcodeChromagar').val(salmonella_assay_barcode);
                $('#id_salmonella_liquidsChromagar').val(id_salmonella_liquids);
                $('#salmonella_assay_barcodeChromagar').attr('readonly', true);
                $('#number_of_tubesChromagar').val(number_of_tubes);

                // Clear existing purpleColonyPlateInputs
                let purpleColonyPlateInputs = $('#purpleColonyPlateInputs');
                purpleColonyPlateInputs.empty();

                // split the string into an array
                const purpleColonyPlateArray = data.black_colony_plate.split(', ');
                const plateNumberArray = data.plate_number.split(', ');
                // const purpleColonyPlateArray1 = data1.purple_colony_plate.split(', ');


                // making the input base on the plate number
                plateNumberArray.forEach((plateNumber, index) => {
                    const plate = purpleColonyPlateArray[index] || '';
                    // const plate1 = purpleColonyPlateArray1[index] || '';

                    // decide the value radio selected
                    const checkedYes = plate === '1' ? 'checked' : '';
                    const checkedNo = plate === '0' ? 'checked' : '';
                    const disabled = plate === '0' ? 'disabled' : '';

                    purpleColonyPlateInputs.append(
                        `<div class="d-flex align-items-center mb-2">
                            <label class="control-label me-3" style="margin-bottom: 0; line-height: 1.5;">Purple ${plateNumber}:</label>
                            <div class="d-flex align-items-center">
                                <input type="hidden" name="purple_colony_plate${plateNumber}" value="${plate}">
                                <label class="radio-inline me-2" style="margin-bottom: 0;">
                                    <input type="radio" id="purple_colony_plate${plateNumber}" name="purple_colony_plate${plateNumber}" value="1" ${disabled}> Yes
                                </label>
                                <label class="radio-inline" style="margin-bottom: 0;">
                                    <input type="radio" id="purple_colony_plate${plateNumber}"  name="purple_colony_plate${plateNumber}" value="0" ${disabled}> No
                                </label>
                            </div>
                        </div>`
                    );
                });

                $('#compose-modalChroMagar').modal('show');
            } else {
                // Tampilkan modal konfirmasi
                $('#confirm-modal').modal('show');
                // Tambahkan pesan ke modal
                $('#confirm-modal .modal-body').html('<p class="text-center" style="font-size: 15px;">You have not filled in the Result XLD. Please fill in that data first.</p>');
            }
        });
        

        $('#exampleChromagar').on('click', '.btn_edit_detResultsChromagar', function() {
            let tr = $(this).closest('tr');
            let data = table1.row(tr).data();
            let data1 = table.row(tr).data();
            console.log(data);
            $('#mode_detResultsChromagar').val('edit');
            $('#modal-title-Chromagar').html('<i class="fa fa-pencil-square"></i> Update | Results Chromagar <span id="my-another-cool-loader"></span>');
            $('#id_result_chromagar').val(data.id_result_chromagar);
            $('#salmonella_assay_barcodeChromagar').val(data.salmonella_assay_barcode);
            $('#salmonella_assay_barcodeChromagar').attr('readonly', true);
            $('#id_salmonella_liquidsChromagar').val(data.id_salmonella_liquids);
            $('#date_sample_processedChromagar').val(data.date_sample_processed);
            $('#time_sample_processedChromagar').val(data.time_sample_processed);
            $('#number_of_tubesChromagar').val(number_of_tubes);

            // Clear existing purpleColonyPlateInputs
            let purpleColonyPlateInputs = $('#purpleColonyPlateInputs');
            purpleColonyPlateInputs.empty();

            // split the string into an array
            const purpleColonyPlateArray = data.purple_colony_plate.split(', ');
            const plateNumberArray = data.plate_number.split(', ');
            const purpleColonyPlateArray1 = data1.black_colony_plate.split(', ');
            // making the input base on the plate number
            plateNumberArray.forEach((plateNumber, index) => {
                const plate = purpleColonyPlateArray[index] || '';
                const plate1 = purpleColonyPlateArray1[index] || '';

                // decide the value radio selected
                const checkedYes = plate === '1' ? 'checked' : '';
                const checkedNo = plate === '0' ? 'checked' : '';
                const disabled = plate1 === '0' ? 'disabled' : '';

                purpleColonyPlateInputs.append(
                    `<div class="d-flex align-items-center mb-2">
                        <label class="control-label me-3" style="margin-bottom: 0; line-height: 1.5;">Purple ${plateNumber}:</label>
                        <div class="d-flex align-items-center">
                            <input type="hidden" name="purple_colony_plate${plateNumber}" value="${plate}">
                            <label class="radio-inline me-2" style="margin-bottom: 0;">
                                <input type="radio" id="purple_colony_plate${plateNumber}" name="purple_colony_plate${plateNumber}" value="1" ${checkedYes}  ${disabled}> Yes
                            </label>
                            <label class="radio-inline" style="margin-bottom: 0;">
                                <input type="radio" id="purple_colony_plate${plateNumber}"  name="purple_colony_plate${plateNumber}" value="0" ${checkedNo}  ${disabled}> No
                            </label>
                        </div>
                    </div>`
                );
            });
            $('#compose-modalChroMagar').modal('show');
        });

    });
</script>