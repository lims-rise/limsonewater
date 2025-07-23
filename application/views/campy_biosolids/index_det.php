<div class="content-wrapper">
	<section class="content">
		<div class="box box-black box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Processing | Campy Biosolids | Details</h3>
			</div>
				<form role="form"  id="formKeg" method="post" class="form-horizontal">
					<div class="box-body">
						<!-- <input type="hidden" class="form-control " id="id_req" name="id_req" value="<?php// echo $id_req ?>"> -->
						<input id="id_campy_biosolids" name="id_campy_biosolids" type="hidden" class="form-control input-sm" value="<?php echo $id_campy_biosolids ?>">
						<div class="form-group">
							<label for="id_one_water_sample" class="col-sm-2 control-label">One Water Sample ID</label>
							<div class="col-sm-4">
								<input class="form-control " id="id_one_water_sample" name="id_one_water_sample" value="<?php echo $id_one_water_sample ?>"  disabled>
							</div>

							<label for="initial" class="col-sm-2 control-label">Lab Tech</label>
							<div class="col-sm-4">
								<input class="form-control " id="initial" name="initial" value="<?php echo $initial ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="number_of_tubes" class="col-sm-2 control-label">Number of Assay Tubes</label>
							<div class="col-sm-4">
								<input class="form-control " id="number_of_tubes" name="number_of_tubes" value="<?php echo $number_of_tubes ?>"  disabled>
							</div>

							<label for="sampletype" class="col-sm-2 control-label">Sample Type</label>
							<div class="col-sm-4">
								<input class="form-control " id="sampletype" name="sampletype" value="<?php echo $sampletype ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="mpn_pcr_conducted" class="col-sm-2 control-label">MPN PCR Conducted</label>
							<div class="col-sm-4">
								<input class="form-control " id="mpn_pcr_conducted" name="mpn_pcr_conducted" value="<?php echo $mpn_pcr_conducted ?>"  disabled>
							</div>

							<label for="campy_assay_barcode" class="col-sm-2 control-label">Campy Assay Barcode</label>
							<div class="col-sm-4">
								<input class="form-control " id="campy_assay_barcode" name="campy_assay_barcode" value="<?php echo $campy_assay_barcode ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="date_sample_processed" class="col-sm-2 control-label">Date Sample</label>
							<div class="col-sm-4">
								<input class="form-control " id="date_sample_processed" name="date_sample_processed" value="<?php echo $date_sample_processed ?>" disabled>
							</div>

							<label for="time_sample_processed" class="col-sm-2 control-label">Time Sample</label>
							<div class="col-sm-4">
								<input class="form-control " id="time_sample_processed" name="time_sample_processed" value="<?php echo $time_sample_processed ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="sample_wetweight" class="col-sm-2 control-label">Sample Wet Weight</label>
							<div class="col-sm-4">
								<input class="form-control " id="sample_wetweight" name="sample_wetweight" value="<?php echo $sample_wetweight ?>"  disabled>
							</div>

                            <label for="elution_volume" class="col-sm-2 control-label">Elution Volume</label>
							<div class="col-sm-4">
								<input class="form-control " id="elution_volume" name="elution_volume" value="<?php echo $elution_volume ?>"  disabled>
							</div>
						</div>

					</div>
				</form>
                <form id="formSampleReview" method="post">
					<input type="hidden" name="id_one_water_sample" id="id_one_water_sample" value="<?php echo $id_one_water_sample ?>">
					<input type="hidden" id="review" name="review" value="<?php echo $review ?>">
					<input type="hidden" id="user_review" name="user_review" value="<?php echo $user_review ?>">
					<input type="hidden" id="user_created" name="user_created" value="<?php echo $user_created ?>">

					<div class="modal-footer clearfix" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px;">

						<div class="modal-footer-content" style="flex: 1; display: flex; align-items: center;">
							<div id="textInform2" class="textInform card" style="width: auto; padding: 5px 10px; display: none;">
								<div class="card-body">
									<div class="card-header d-flex justify-content-between align-items-center">
										<h5 class="card-title statusMessage mb-0"></h5>
										<i class="fa fa-times close-card" style="cursor: pointer;"></i>
									</div>
									<p class="statusDescription mb-0"></p>
								</div>
							</div>
						</div>

						<div class="d-flex align-items-center flex-wrap" style="gap: 8px;">
							<span class="text-muted">Status:</span>
							<span id="review_label" class="badge bg-warning text-dark" role="button" tabindex="0" style="cursor: pointer;">
								Unreview
							</span>

							<span class="text-muted ms-3">by:</span>
							<span id="reviewed_by_label" style="font-style: italic; font-weight: 800; font-size: 14px;">
								<?php echo $full_name ? $full_name : '-' ?>
							</span>

							<?php if (in_array($this->session->userdata('id_user_level'), [1, 2])): ?>
								<button type="button" id="cancelReviewBtn" class="btn btn-danger ms-3">
									Cancel Review
								</button>
							<?php endif; ?>
						</div>
					</div>
				</form>
			<div class="box-footer">
                    <div class="col-xs-12"> 
                        <div class="box box-primary box-solid">
                            <div class="box-header">
                                <h3 class="box-title">Results Charcoal</h3>
                            </div>
							<div class="box-body pad table-responsive">
								<?php
									$lvl = $this->session->userdata('id_user_level');
									if ($lvl != 4){
										echo "<button class='btn btn-primary' id='addtombol_detResultsCharcoal'><i class='fa fa-wpforms' aria-hidden='true'></i> New Data</button>";
									}
								?>
								<table id="example2" class="table display table-bordered table-striped" width="100%">
									<thead>
										<tr>
                                            <th>Campy Assay Barcode</th>
                                            <th>Date of Sample</th>
                                            <th>Time of Sample</th>
                                            <th>Growth Plate</th>
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
                                <h3 class="box-title">Results HBA</h3>
                            </div>
							<div class="box-body pad table-responsive">
								<?php
									$lvl = $this->session->userdata('id_user_level');
									if ($lvl != 4){
										echo "<button class='btn btn-primary' id='addtombol_detResultsHBA'><i class='fa fa-wpforms' aria-hidden='true'></i> New Data</button>";
									}
								?>
								<table id="exampleHba" class="table display table-bordered table-striped" width="100%">
									<thead>
										<tr>
                                            <th>Campy Assay Barcode</th>
                                            <th>Date of Sample</th>
                                            <th>Time of Sample</th>
                                            <th>Growth Plate</th>
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
                                <h3 class="box-title">Results Biochemical</h3>
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
                                <input id="id_campy_biosolids" name="id_campy_biosolids" type="hidden" class="form-control input-sm" value="<?php echo $id_campy_biosolids ?>">

                                <div id="content-final-concentration" class="table-responsive">
                                    <table id="exampleFinalConcentration" class="table display table-bordered table-striped" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID One Water Sample</th>
                                                <th>Campy Assay Barcode</th>
                                                <th>Initial</th>
                                                <th>Sample Type</th>
                                                <th>Number of Tubes</th>
                                                <th>MPN PCR Conducted</th>
                                                <th>Date Sample Processed</th>
                                                <th>Time Sample Processed</th>
                                                <th>Sample Wet Weight</th>
                                                <th>Elution Volume</th>
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
                                                        <td><?= htmlspecialchars($concentration->campy_assay_barcode) ?></td>
                                                        <td><?= htmlspecialchars($concentration->initial) ?></td>
                                                        <td><?= htmlspecialchars($concentration->sampletype) ?></td>
                                                        <td><?= htmlspecialchars($concentration->number_of_tubes) ?></td>
                                                        <td><?= htmlspecialchars($concentration->mpn_pcr_conducted) ?></td>
                                                        <td><?= htmlspecialchars($concentration->date_sample_processed) ?></td>
                                                        <td><?= htmlspecialchars($concentration->time_sample_processed) ?></td>
                                                        <td><?= htmlspecialchars($concentration->sample_wetweight) ?></td>
                                                        <td><?= htmlspecialchars($concentration->elution_volume) ?></td>

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
						<button type="button" name="batal" value="batal" class="btn btn-warning" onclick="window.location.href='<?= site_url('campy_biosolids'); ?>';">
							<i class="fa fa-times"></i> Close
						</button>
					</div>
				</div>
			</div> 
		</div>
	</section>
</div>

<!-- MODAL FORM Results Charcoal -->
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-scrollable="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                        <h4 class="modal-title" id="modal-title-detail">
							<span id="my-another-cool-loader"></span></h4>
                    </div>
                        <form id="formDetail24" action=<?php echo site_url('Campy_biosolids/saveResultsCharcoal') ?> method="post" class="form-horizontal">
                            <div class="modal-body">
                                <div class="form-group">
                                        <div class="col-sm-9">
                                            <input id="mode_detResultsCharcoal" name="mode_detResultsCharcoal" type="hidden" class="form-control input-sm">
                                            <!-- <input id="idx_moisture24" name="idx_moisture24" type="hidden" class="form-control input-sm">
                                            <input id="id_moisture24" name="id_moisture24" type="hidden" class="form-control input-sm"> -->
                                            <input id="id_campy_biosolids1" name="id_campy_biosolids1" type="hidden" class="form-control input-sm">
                                            <input id="number_of_tubes1" name="number_of_tubes1" type="hidden" class="form-control input-sm">
                                            <input id="id_result_charcoal" name="id_result_charcoal" type="hidden" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="campy_assay_barcode1" class="col-sm-4 control-label">Campy Assay Barcode</label>
                                        <div class="col-sm-8">
                                            <input id="campy_assay_barcode1" name="campy_assay_barcode1" type="text"  placeholder="Campy Assay Barcode" class="form-control">
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

                                    <div class="form-group" id="growth_plate">
                                        <label class="col-sm-4 control-label">Growth Plate</label>
                                        <div class="col-sm-8" id="growthPlateInputs">
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

<!-- MODAL FORM Results HBA -->
<div class="modal fade" id="compose-modalHBA" tabindex="-1" role="dialog" aria-hidden="true" data-bs-scrollable="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                        <h4 class="modal-title" id="modal-title-HBA">
							<span id="my-another-cool-loader"></span></h4>
                    </div>
                        <form id="formDetail24" action=<?php echo site_url('Campy_biosolids/saveResultsHBA') ?> method="post" class="form-horizontal">
                            <div class="modal-body">
                                <div class="form-group">
                                        <div class="col-sm-9">
                                            <input id="mode_detResultsHBA" name="mode_detResultsHBA" type="hidden" class="form-control input-sm">
                                            <!-- <input id="idx_moisture24" name="idx_moisture24" type="hidden" class="form-control input-sm">
                                            <input id="id_moisture24" name="id_moisture24" type="hidden" class="form-control input-sm"> -->
                                            <input id="id_campy_biosolidsHBA" name="id_campy_biosolidsHBA" type="hidden" class="form-control input-sm">
                                            <input id="number_of_tubesHba" name="number_of_tubesHba" type="hidden" class="form-control input-sm">
                                            <input id="id_result_hba" name="id_result_hba" type="hidden" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="campy_assay_barcodeHBA" class="col-sm-4 control-label">Campy Assay Barcode</label>
                                        <div class="col-sm-8">
                                            <input id="campy_assay_barcodeHBA" name="campy_assay_barcodeHBA" type="text"  placeholder="Campy Assay Barcode" class="form-control">
                                            <div class="val1tip"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="date_sample_processedHBA" class="col-sm-4 control-label">Date Sample Processed</label>
                                        <div class="col-sm-8">
                                            <input id="date_sample_processedHBA" name="date_sample_processedHBA" type="date" class="form-control" placeholder="Date Sample Processed" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="time_sample_processedHBA" class="col-sm-4 control-label">Time Sample Processed</label>
                                        <div class="col-sm-8">
                                            <div class="input-group clockpicker">
                                                <input id="time_sample_processedHBA" name="time_sample_processedHBA" class="form-control" placeholder="Time Sample Processed" value="<?php echo (new DateTime())->format('H:i'); ?>">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" id="growth_plateHBA">
                                        <label class="col-sm-4 control-label">Growth Plate</label>
                                        <div class="col-sm-8" id="growthPlateInputsHBA">
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
                <h4 class="modal-title" id="modal-title-biochemical">Biochemical Tube | New</h4>
            </div>
            <form id="formBiochemical" action="<?php echo site_url('Campy_biosolids/saveBiochemical') ?>" method="post" class="form-horizontal">
                <div class="modal-body">
                    <input id="mode_detResultsBiochemical" name="mode_detResultsBiochemical" type="hidden" class="form-control input-sm">
                    <input id="id_campy_biosolidsBiochemical" name="id_campy_biosolidsBiochemical" type="hidden" class="form-control input-sm">
                    <input id="id_result_biochemical" name="id_result_biochemical" type="hidden" class="form-control input-sm">
                    <input id="biochemical_tube" name="biochemical_tube" type="hidden" class="form-control input-sm">
                    <input id="id_result_hba1" name="id_result_hba1" type="hidden" class="form-control input-sm">
                 
                    <!-- Gramlysis Result -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Gramlysis Result</label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <input type="radio" name="gramlysis" value="Positive" > Positive
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gramlysis" value="Negative"> Negative
                            </label>
                        </div>
                    </div>

                    <!-- Oxidase Result -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Oxidase Result</label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <input type="radio" name="oxidase"  value="Positive" > Positive
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
                                <input type="radio" name="catalase"  value="Positive" > Positive
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
					<h4 class="modal-title">Campy Biosolids | Information</h4>
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

    #review_label {
        cursor: pointer;
        font-size: 14px;  /* Ukuran font untuk label */
    }

    #reviewed_by_label {
        margin-left: 10px;
        font-style: italic;
        font-weight: bold;
        font-size: 12px;  /* Ukuran font kecil untuk input reviewer */
    }

    .d-flex {
        display: flex;
        align-items: center;
    }

    .ms-2 {
        margin-left: 0.5rem;  /* Spacing antar elemen */
    }

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

    .hidden {
        visibility: hidden;
        position: absolute;
        width: 0;
        height: 0;
        overflow: hidden;
    }
    .sample-input {
        margin-bottom: 10px; /* Adjust the spacing as needed */
    }

    .modal {
    overflow-y: auto;
    }

    .modal-body {
    max-height: 80vh;
    overflow-y: auto;
    }

    .badge {
        font-size: 14px;
        padding: 8px 12px;
        border-radius: 20px;
        margin-top: 0px;
    }

    .badge-success {
        background-color: #6A9C89;
        color: white;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
    }

    .alert {
        padding: 8px 12px;
        border-radius: 5px;
        font-size: 14px;
        margin-top: 0px;
    }

    .alert-success {
        background-color: #6A9C89;
        color: white;
    }

    .alert-danger {
        background-color: #dc3545;
        color: white;
    }

    .card {
        border-radius: 10px;
        margin-top: 0px;
        padding: 8px 12px;
        width: 100%; /* Ensures card uses available space */
    }

    .card-success {
        border: 1px solid #28a745;
        background-color: #d4edda;
    }

    .card-danger {
        border: 1px solid #dc3545;
        background-color: #f8d7da;
    }

    .card-title {
        font-size: 16px;
        font-weight: bold;
        text-align: left; /* Align title to the left */
        margin-bottom: 0px;
    }

    .card-body {
        font-size: 14px;
        text-align: left; /* Align body text to the left */
    }

    .modal-footer-content {
        float: left;
        width: auto;
        margin-right: 10px;
    }

    .modal-buttons {
        float: right;
    }

    .icon-success {
        color: #28a745;
        margin-right: 10px;
    }

    .icon-fail {
        color: #dc3545;
        margin-right: 10px;
    }

    .modal-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 15px;
    }

    .modal-footer-content {
        flex: 1;
        display: flex;
        align-items: center;
    }

    .modal-buttons {
        display: flex;
        align-items: center;
    }

    .card-body {
        padding: 0px;
    }

    .card-title {
        font-size: 16px;
        font-weight: bold;
    }

    .card-description {
        font-size: 14px;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .close-card {
        cursor: pointer;
        font-size: 18px;
        color: #FDAB9E; 
    }

    .close-card:hover {
        color: #bd2130; 
    }

    .unreview {
        color: gray !important;
        border-color: gray !important;
        box-shadow: none; 
    }

    /* input.form-check-label. */
    .review {
        color: white !important;
        background-color: #3D8D7A;
		border: none  !important;
    }

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
        max-height: 500px; 
        overflow-y: auto; 
    }

    /* Style untuk scrollbar itu sendiri */
    .child-table-container::-webkit-scrollbar {
        width: 6px; 
    }

    /* Style untuk track (background) scrollbar */
    .child-table-container::-webkit-scrollbar-track {
        background: #e0f2f1;
        border-radius: 10px;
    }

    /* Style untuk thumb (pegangan scrollbar) */
    .child-table-container::-webkit-scrollbar-thumb {
        background: #9ACBD0; 
        border-radius: 10px; 
    }

    /* Gaya saat thumb scrollbar di-hover */
    .child-table-container::-webkit-scrollbar-thumb:hover {
        background: #48A6A7;
    }

	.review-border {
		border: 1px solid green  !important;
		color: green  !important;
	}

	.disabled-btn {
		background-color: #ccc; /* Ganti warna latar belakang tombol */
		color: #666; /* Ganti warna teks tombol */
		border: 1px solid #ddd; /* Ganti border tombol */
		cursor: not-allowed; /* Set cursor menjadi not-allowed agar tidak bisa diklik */
	}
</style>
<style>
	#textInform2 .alert {
        display: block !important;
        margin-top: 20px;
        font-size: 16px;
        z-index: 1000; /* Pastikan info card di atas elemen lain */
    }
</style>
<!-- SweetAlert2 CSS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script>
    document.getElementById('exportBtn').addEventListener('click', function() {
        let id_campy_biosolids = document.getElementById('id_campy_biosolids').value;
        window.location.href = '<?php echo site_url('Campy_biosolids/excel') ?>/' + id_campy_biosolids;
    });
</script>
<script type="text/javascript">

    let table;
    let table1;
    let table2;
    let id_moisture = $('#id_moisture').val();
    let campy_assay_barcode = $('#campy_assay_barcode').val();
    let id_campy_biosolids = $('#id_campy_biosolids').val();
    let number_of_tubes = $('#number_of_tubes').val();
    const BASE_URL = '/limsonewater/index.php';

    $(document).ready(function() {
        	let loggedInUser = '<?php echo $this->session->userdata('id_users'); ?>';
		let userCreated = $('#user_created').val();
		let userReview = $('#user_review').val();
		let fullName = $('#reviewed_by_label').val();

		$('#reviewed_by_label').val(fullName ? fullName : '-');

		// Definisikan state review
		const states = [
			{ value: 0, label: "Unreview", class: "unreview" },
			{ value: 1, label: "Reviewed", class: "review" }
		];

		// Ambil nilai awal dari input hidden
		let currentState = parseInt($('#review').val());
		if (isNaN(currentState) || currentState < 0 || currentState > 1) currentState = 0;


		// Set tampilan awal pada label review
		$('#review_label')
			.text(states[currentState].label)
			.removeClass()
			.addClass('form-check-label ' + states[currentState].class);

		// Cek apakah user login BUKAN creator
		if (userCreated !== loggedInUser) {
			$('#user_review').val(loggedInUser);

			$('#review_label').off('click').on('click', function () {
				if ($('#review').val() === '1') {
					Swal.fire({
						icon: 'info',
						title: 'Review Locked',
						text: 'You have already reviewed this. Further changes are not allowed.',
						confirmButtonText: 'OK'
					});
					return;
				}

				Swal.fire({
					icon: 'question',
					title: 'Are you sure?',
					showCancelButton: true,
					confirmButtonText: 'OK',
					cancelButtonText: 'Cancel',
					reverseButtons: true
				}).then((result) => {
					if (result.isConfirmed) {

						currentState = (currentState + 1) % states.length;

						$('#review').val(states[currentState].value);
						$('#review_label')
							.text(states[currentState].label)
							.removeClass()
							.addClass('form-check-label ' + states[currentState].class);

						$.ajax({
							url: '<?php echo site_url('Campy_biosolids/saveReview'); ?>',
							method: 'POST',
							data: $('#formSampleReview').serialize(),
							dataType: 'json',
							success: function(response) {
								if (response.status) {
									Swal.fire({
										icon: 'success',
										title: 'Review saved successfully!',
										text: response.message,
										timer: 1000,
										showConfirmButton: false
									}).then(() => {
										location.reload();
									});
								} else {
									Swal.fire({
										icon: 'error',
										title: 'Failed to save review',
										text: response.message
									});
								}
							},
							error: function(xhr, status, error) {
								console.error('AJAX Error: ' + status + error);
								Swal.fire('Error', 'Something went wrong during submission.', 'error');
							}
						});
					} else {
						Swal.fire({
							icon: 'info',
							title: 'Review Not Changed',
							text: 'No changes were made.',
							timer: 2000
						});
					}
				});
			});

			if ($('#review').val() === '1') {
				showInfoCard(
					'#textInform2',
					'<i class="fa fa-times-circle"></i> You are not the creator',
					"In this case, you can't review because it has already been reviewed.",

					false
				);
			} else {
				showInfoCard(
					'#textInform2',
					'<i class="fa fa-times-circle"></i> You are not the creator',
					"In this case, you can review this data. Hover over the box on the right side to start the review.",
					false
				);

			}

			$('#review_label')
			.on('mouseenter', function() {
				if ($('#review').val() !== '1') { 
					$(this).text('Review')
						.addClass('review-border');
				}
			})
			.on('mouseleave', function() {
				if ($('#review').val() !== '1') { 
					$(this).text('Unreview')
						.removeClass('review-border');
				}
			});


			$('#saveButtonDetail').prop('disabled', false);
		} else {
			$('#user_review').val(loggedInUser);

			showInfoCard(
				'#textInform2',
				'<i class="fa fa-check-circle"></i> You are the creator',
				"You have full access to edit this data but not review.",
				true
			);

			$('#saveButtonDetail').prop('disabled', true);
		}
		
		// Fungsi untuk cancel review (khusus admin user 1 & 2)
  // Cek status review ketika halaman dimuat
  if ($('#review').val() === '1') {
        // Jika status review = 0 (belum di-review), disable tombol cancel
        $('#cancelReviewBtn').prop('disabled', false).removeClass('disabled-btn');
    } else {
        // Jika status review = 1 (sudah di-review),  tombol bisa diklik
        $('#cancelReviewBtn').prop('disabled', true).addClass('disabled-btn');
    }

    // Event handler ketika tombol Cancel Review diklik
    $('#cancelReviewBtn').on('click', function () {
        Swal.fire({
            icon: 'warning',
            title: 'Cancel Review?',
            text: 'This will reset the review status so another user can review it again.',
            showCancelButton: true,
            confirmButtonText: 'Yes, cancel it',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                // Set review dan user_review untuk cancel
                $('#review').val(0);
                $('#user_review').val('');  // Kosongkan user review

                // Update label status menjadi Unreview
                $('#review_label')
                    .text('Unreview')
                    .removeClass()
                    .addClass('form-check-label unreview');  // Ubah tampilan label

                // Disable the Cancel Review button after canceling the review
                $('#cancelReviewBtn').prop('disabled', true).addClass('disabled-btn');  // Disable tombol

                // Pastikan ID yang diperlukan ada di form
                let formData = $('#formSampleReview').serialize(); 
                console.log('Form data to be sent: ', formData); // Debugging log

                $.ajax({
                    url: '<?php echo site_url('Campy_biosolids/cancelReview'); ?>',
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Review canceled successfully!',
                                timer: 1000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed to cancel review',
                                text: response.message
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error: ' + status + error);
                        Swal.fire('Error', 'Something went wrong during cancel.', 'error');
                    }
                });
            }
        });
    });



	  // Mouse enter/leave effects for review label
	  $('#review_label')
        .on('mouseenter', function() {
            if ($('#review').val() !== '1') { 
                $(this).text('Review')
                    .addClass('review-border');
            }
        })
        .on('mouseleave', function() {
            if ($('#review').val() !== '1') { 
                $(this).text('Unreview')
                    .removeClass('review-border');
            }
        });



        // Function to show a dynamic info card
		function showInfoCard(target, message, description, isSuccess) {
            // Add dynamic content to the target card
            $(target).find('.statusMessage').html(message);
            $(target).find('.statusDescription').text(description);

            // Apply classes based on success or failure
            if (isSuccess) {
                $(target).removeClass('card-danger').addClass('card-success');
            } else {
                $(target).removeClass('card-success').addClass('card-danger');
            }

            // Show the info card
            $(target).fadeIn();
        }

        // Close the card when the 'x' icon is clicked
        $('.close-card').on('click', function() {
            $('#textInform1').fadeOut(); // Fade out the card
            $('#textInform2').fadeOut();
        });


        // Event handler untuk mengatur nilai null saat klik pada radio button yang sudah dipilih
        $('input[name="gramlysis"], input[name="oxidase"], input[name="catalase"]').on('click', function() {
            // Mengecek apakah radio button yang diklik sudah dipilih
            if ($(this).prop('checked') && $(this).data('clicked')) {
                $(this).prop('checked', false);  // Hapus pilihan
                $(this).data('clicked', false);  // Reset data clicked
            } else {
                $(this).data('clicked', true);  // Tandai radio button sudah diklik
            }
            updateConfirmation(); // Update konfirmasi setelah perubahan
        });

        function updateConfirmation() { 
            const oxidaseValue = $('input[name="oxidase"]:checked').val();
            const catalaseValue = $('input[name="catalase"]:checked').val();
            const gramLysisValue = $('input[name="gramlysis"]:checked').val();
            
            let confirmationText = '';

            // Jika Gram-Lysis positif
            if (gramLysisValue === 'Positive') {
                confirmationText = 'Not Campylobacter';
            } 
            // Jika Gram-Lysis negatif, baru cek Oxidase dan Catalase
            else {
                if (oxidaseValue === 'Positive' && catalaseValue === 'Positive') {
                    confirmationText = 'Campylobacter';
                } else if (oxidaseValue === 'Negative' && catalaseValue === 'Negative') {
                    confirmationText = 'Not Campylobacter';
                } else if (oxidaseValue === 'Positive' && catalaseValue === 'Negative') {
                    confirmationText = 'Not Campylobacter';
                } else if (oxidaseValue === 'Negative' && catalaseValue === 'Positive') {
                    confirmationText = 'Not Campylobacter';
                } else {
                    confirmationText = '';
                }
            }

            // Menampilkan hasil ke kolom confirmation
            $('#confirmation').val(confirmationText);
        }

        function generateGrowthPlateInputs(container, numberOfTubes) {
            container.empty(); // Clear existing inputs

            // Create the required number of inputs and labels
            for (let i = 1; i <= numberOfTubes; i++) {
                container.append(
                    `<div class="d-flex align-items-center mb-2">
                        <label class="control-label me-3" style="margin-bottom: 0; line-height: 1.5;">Growth Plate ${i}:</label>
                        <div class="d-flex align-items-center">
                            <label class="radio-inline me-2" style="margin-bottom: 0;">
                                <input type="radio" name="growth_plate${i}" value="1"> Yes 
                            </label>
                            <label class="radio-inline" style="margin-bottom: 0;">
                                <input type="radio" name="growth_plate${i}" value="0"> No 
                            </label>
                        </div>
                    </div>`
                );
            }
        }

        $('#number_of_tubes').change(function() {
            let numberOfTubes = parseInt($(this).val()); // Get the selected value as an integer
            generateGrowthPlateInputs($('#growthPlateInputs'), numberOfTubes);
            generateGrowthPlateInputs($('#growthPlateInputsHBA'), numberOfTubes);
        }).trigger('change');

        // function generateGrowthPlateInputs(container, numberOfTubes) {
        //     container.empty(); // Clear existing inputs

        //     // Create the required number of inputs and labels
        //     for (let i = 1; i <= numberOfTubes; i++) {
        //         container.append(
        //             `<div class="d-flex align-items-center mb-2">
        //                 <label class="control-label me-3" style="margin-bottom: 0; line-height: 1.5;">Growth Plate ${i}:</label>
        //                 <div class="d-flex align-items-center">
        //                     <label class="radio-inline me-2" style="margin-bottom: 0;">
        //                         <input type="radio" name="growth_plate${i}" value="Yes" required> Yes
        //                     </label>
        //                     <label class="radio-inline" style="margin-bottom: 0;">
        //                         <input type="radio" name="growth_plate${i}" value="No" required> No
        //                     </label>
        //                 </div>
        //             </div>`
        //         );
        //     }
        // }

        // $('#number_of_tubes').change(function() {
        //     let numberOfTubes = parseInt($(this).val()); // Get the selected value as an integer
        //     generateGrowthPlateInputs($('#growthPlateInputs'), numberOfTubes);
        //     generateGrowthPlateInputs($('#growthPlateInputsHBA'), numberOfTubes);
        // }).trigger('change');


        function showConfirmationDelete(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal-delete').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_deleteCharcoal, .btn_deleteHba, .btn_deleteBiochemical', function() {
            let id = $(this).data('id');
            let url;
            if ($(this).hasClass('btn_deleteCharcoal')) {
                url = '<?php echo site_url('Campy_biosolids/delete_detailCharcoal'); ?>/' + id;
                $('.modal-title').html('<i class="fa fa-trash"></i> Result Charcoal | Delete <span id="my-another-cool-loader"></span>');
                $('#confirm-modal-delete #id').text(id);
            } else if ($(this).hasClass('btn_deleteHba')) {
                url = '<?php echo site_url('Campy_biosolids/delete_detailHba'); ?>/' + id;
                $('.modal-title').html('<i class="fa fa-trash"></i> Result HBA | Delete <span id="my-another-cool-loader"></span>');
                $('#confirm-modal-delete #id').text(id);
            } else if ($(this).hasClass('btn_deleteBiochemical')) {
                url = '<?php echo site_url('Campy_biosolids/delete_detailBiochemical'); ?>/' + id;
                $('.modal-title').html('<i class="fa fa-trash"></i> Result Biochemical | Delete <span id="my-another-cool-loader"></span>');
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

        $('#compose-modalHBA').on('shown.bs.modal', function () {
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

        $('#compose-modalHBA').on('shown.bs.modal', function () {
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

        $('#barcode_tray72').on("change", function() {
            let barcode72 = $('#barcode_tray72').val();
            $.ajax({
                type: "GET",
                url: `${BASE_URL}/Moisture_content/validate72`,
                data: { id72: barcode72 },
                dataType: "json",
                success: function(data) {
                    if (data.length == 0) {
                        let tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + barcode72 +'</strong> is not on moisture content or is not already in the system !</span>');
                        $('.val2tip').tooltipster('content', tip);
                        $('.val2tip').tooltipster('show');
                        $('#barcode_tray72').focus();
                        $('#barcode_tray72').val('');       
                        $('#barcode_tray72').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_tray72').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_tray72').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_tray72').css({'background-color' : '#FFFFFF'});
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
            ajax: {"url": "../../Campy_biosolids/subjsonCharcoal?idCharcoal="+id_campy_biosolids, "type": "POST"},
            columns: [
                {"data": "campy_assay_barcode"},
                {"data": "date_sample_processed"},
                {"data": "time_sample_processed"},
                {"data": "growth_plate"},
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
                    $('#addtombol_detResultsCharcoal').prop("disabled", true);
                } else {
                    $('#addtombol_detResultsCharcoal').show();
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

        table1 = $("#exampleHba").DataTable({
            oLanguage: {
                sProcessing: "Loading data, please wait..."
            },
            processing: true,
            serverSide: true,
            paging: false,
            info: false,
            bFilter: false,
            ajax: {"url": "../../Campy_biosolids/subjsonHba?idHba="+id_campy_biosolids, "type": "POST"},
            columns: [
                {"data": "campy_assay_barcode"},
                {"data": "date_sample_processed"},
                {"data": "time_sample_processed"},
                {"data": "growth_plate"},
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
                    $('#addtombol_detResultsHBA').prop("disabled", true);
                } else {
                    $('#addtombol_detResultsHBA').show();
                }
            }
        });

        $('#exampleHba tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table1.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }
        });

        table1.ajax.reload(function() {
            let td = $('#exampleHba td:first');
            let data = table1.row(td).data();
            console.log(data);

            if (data) {
                const growthPlateArray = data.growth_plate.split(', ');
                const plateNumberArray = data.plate_number.split(', ');

                // Generate the biochemical results for all plate numbers
                generateResultBiochemical($('#content-result-biochemical'), plateNumberArray.length, data.id_campy_biosolids, plateNumberArray, growthPlateArray);
            } else {
                console.log('Data belum tersedia');
                $('#content-result-biochemical').empty().append('<p class="text-center">No data available</p>');
            }
        });

        // Improved generateResultBiochemical function
        function generateResultBiochemical(container, numberOfPlates, id_campy_biosolids, plateNumberArray, growthPlateArray) {
            container.empty(); // Clear existing content

            // Iterate through the plateNumberArray
            for (let i = 0; i < numberOfPlates; i++) {
                const plateNumber = plateNumberArray[i]; // Get the corresponding plate number
                const tableId = `exampleBiochemical_${i}`; // Unique table ID
                const buttonId = `addtombol_detResultsBiochemical_${plateNumber}`; // Unique button ID
                const isDisabled = growthPlateArray[i] === '0' ? 'disabled' : ''; // Determine if button should be disabled
                console.log('button biochemical tube', isDisabled);

                // Append the table and button for each plate
                container.append(`
                    <div class="box-body pad table-responsive">
                        <button class="btn btn-primary" id="${buttonId}" data-index="${plateNumber}" ${isDisabled}>
                            <i class="fa fa-wpforms" aria-hidden="true"></i> Biochemical Tube ${plateNumber}
                        </button>
                        <table id="${tableId}" class="table display table-bordered table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th>Gram-lysis Result</th>
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
                initializeDataTable(tableId, id_campy_biosolids, plateNumber); // Pass the actual plate number
            }
        }


        // Fungsi untuk menginisialisasi DataTable
        function initializeDataTable(tableId, id_campy_biosolids, tubeIndex) {
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
                    url: `../../Campy_biosolids/subjsonBiochemical?idBiochemical=${id_campy_biosolids}&biochemical_tube=${tubeIndex}`,
                    type: "POST"
                },
                columns: [
                    {"data": "gramlysis"},
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
            let td = $('#exampleHba td:first');
            let data = table1.row(td).data();
            console.log('datanya', data.id_result_hba);

            $('#mode_detResultsBiochemical').val('insert');
            $('#modal-title-biochemical').html(`<i class="fa fa-wpforms"></i> Insert | Biochemical Tube ${plateNumber} <span id="my-another-cool-loader"></span>`);
            $('#id_campy_biosolidsBiochemical').val(id_campy_biosolids);
            $('#id_result_hba1').val(data.id_result_hba);
            $('#gramlysis').val('');
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
            $('#modal-title-biochemical').html('<i class="fa fa-pencil-square"></i> Update | Biochemical Tube ' + data.biochemical_tube + ' <span id="my-another-cool-loader"></span>');
            $('#id_result_biochemical').val(data.id_result_biochemical);
            $('#id_campy_biosolidsBiochemical').val(data.id_campy_biosolids);
            $('#id_result_hba1').val(data.id_result_hba);
            // Set radio button untuk gramlysis
            $('input[name="gramlysis"][value="' + data.gramlysis + '"]').prop('checked', true); 

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





        $('#addtombol_detResultsCharcoal').click(function() {
            $('#mode_detResultsCharcoal').val('insert');
            $('#modal-title-detail').html('<i class="fa fa-wpforms"></i> Insert | Results Charcoal <span id="my-another-cool-loader"></span>');
            $('#campy_assay_barcode1').val(campy_assay_barcode);
            $('#campy_assay_barcode1').attr('readonly', true);
            $('#id_campy_biosolids1').val(id_campy_biosolids);
            $('#number_of_tubes1').val(number_of_tubes);
            $('#compose-modal').modal('show');
        });

        $('#example2').on('click', '.btn_edit_detResultsCharcoal', function() {
            let tr = $(this).closest('tr');
            let data = table.row(tr).data();
            console.log(data);
            $('#mode_detResultsCharcoal').val('edit');
            $('#modal-title-detail').html('<i class="fa fa-pencil-square"></i> Update | Results Charcoal <span id="my-another-cool-loader"></span>');
            $('#id_result_charcoal').val(data.id_result_charcoal);
            $('#campy_assay_barcode1').val(data.campy_assay_barcode);
            $('#campy_assay_barcode1').attr('readonly', true);
            $('#id_campy_biosolids1').val(data.id_campy_biosolids);
            $('#date_sample_processed1').val(data.date_sample_processed);
            $('#time_sample_processed1').val(data.time_sample_processed);
            $('#number_of_tubes1').val(number_of_tubes);

            // Clear existing growthPlateInputs
            let growthPlateInputs = $('#growthPlateInputs');
            growthPlateInputs.empty();

            // split the string into an array
            const growthPlateArray = data.growth_plate.split(', ');
            const plateNumberArray = data.plate_number.split(', ');

            // making the input base on the plate number
            plateNumberArray.forEach((plateNumber, index) => {
                const plate = growthPlateArray[index] || '';

                // decide the value radio selected
                const checkedYes = plate === '1' ? 'checked' : '';
                const checkedNo = plate === '0' ? 'checked' : '';

                growthPlateInputs.append(
                    `<div class="d-flex align-items-center mb-2">
                        <label class="control-label me-3" style="margin-bottom: 0; line-height: 1.5;">Growth Plate ${plateNumber}:</label>
                        <div class="d-flex align-items-center">
                            <label class="radio-inline me-2" style="margin-bottom: 0;">
                                <input type="radio" id="growth_plate${plateNumber}" name="growth_plate${plateNumber}" value="1" ${checkedYes}> Yes
                            </label>
                            <label class="radio-inline" style="margin-bottom: 0;">
                                <input type="radio" id="growth_plate${plateNumber}"  name="growth_plate${plateNumber}" value="0" ${checkedNo}> No
                            </label>
                        </div>
                    </div>`
                );
            });

            $('#compose-modal').modal('show');
        });

        $('#addtombol_detResultsHBA').on('click', function() {
            $('#mode_detResultsHBA').val('insert');
            $('#modal-title-HBA').html('<i class="fa fa-wpforms"></i> Insert | Results HBA <span id="my-another-cool-loader"></span>');

            let td = $('#example2 td:first');
            let data = table.row(td).data();
            console.log(data);
            
            if (data && data.campy_assay_barcode) {
                let campy_assay_barcode = data.campy_assay_barcode;

                // Parsing data ke komponen
                $('#campy_assay_barcodeHBA').val(campy_assay_barcode);
                $('#id_campy_biosolidsHBA').val(id_campy_biosolids);
                $('#campy_assay_barcodeHBA').attr('readonly', true);
                $('#number_of_tubesHba').val(number_of_tubes);

                // Clear existing growthPlateInputs
                let growthPlateInputsHba = $('#growthPlateInputsHBA');
                growthPlateInputsHba.empty();

                // split the string into an array
                const growthPlateArray = data.growth_plate.split(', ');
                const plateNumberArray = data.plate_number.split(', ');

                console.log('growthPlateArray:', growthPlateArray);
                console.log('plateNumberArray:', plateNumberArray);

                // making the input base on the plate number
                plateNumberArray.forEach((plateNumber, index) => {
                    const plate = growthPlateArray[index] || '';

                    // decide the value radio selected
                    const checkedYes = plate === '1' ? 'checked' : '';
                    const checkedNo = plate === '0' ? 'checked' : '';
                    const disabled = plate === '0' ? 'disabled' : '';

                    growthPlateInputsHba.append(
                      `<div class="d-flex align-items-center mb-2">
                            <label class="control-label me-3" style="margin-bottom: 0; line-height: 1.5;">Growth Plate ${plateNumber}:</label>
                            <div class="d-flex align-items-center">
                                <input type="hidden" name="growth_plate${plateNumber}" value="${plate}">
                                <label class="radio-inline me-2" style="margin-bottom: 0;">
                                    <input type="radio" id="growth_plate${plateNumber}" name="growth_plate${plateNumber}" value="1" ${disabled}> Yes
                                </label>
                                <label class="radio-inline" style="margin-bottom: 0;">
                                    <input type="radio" id="growth_plate${plateNumber}"  name="growth_plate${plateNumber}" value="0" ${disabled}> No
                                </label>
                            </div>
                        </div>`
                    );
                });

                $('#compose-modalHBA').modal('show');
            } else {
                // Tampilkan modal konfirmasi
                $('#confirm-modal').modal('show');
                // Tambahkan pesan ke modal
                $('#confirm-modal .modal-body').html('<p class="text-center" style="font-size: 15px;">You have not filled in the Result Charcoal. Please fill in that data first.</p>');
            }
        });
        

        $('#exampleHba').on('click', '.btn_edit_detResultsHba', function() {
            let tr = $(this).closest('tr');
            let data = table1.row(tr).data();
            let data1 = table.row(tr).data();
            console.log(data);
            $('#mode_detResultsHBA').val('edit');
            $('#modal-title-HBA').html('<i class="fa fa-pencil-square"></i> Update | Results HBA <span id="my-another-cool-loader"></span>');
            $('#id_result_hba').val(data.id_result_hba);
            $('#campy_assay_barcodeHBA').val(data.campy_assay_barcode);
            $('#campy_assay_barcodeHBA').attr('readonly', true);
            $('#id_campy_biosolidsHBA').val(data.id_campy_biosolids);
            $('#date_sample_processedHBA').val(data.date_sample_processed);
            $('#time_sample_processedHBA').val(data.time_sample_processed);
            $('#number_of_tubesHba').val(number_of_tubes);

            // Clear existing growthPlateInputs
            let growthPlateInputsHba = $('#growthPlateInputsHBA');
            growthPlateInputsHba.empty();

            // split the string into an array
            const growthPlateArray = data.growth_plate.split(', ');
            const plateNumberArray = data.plate_number.split(', ');

            const growthPlateArray1 = data1.growth_plate.split(', ');
            const plateNumberArray1 = data1.plate_number.split(', ');

            // making the input base on the plate number
            plateNumberArray.forEach((plateNumber, index) => {
                const plate = growthPlateArray[index] || '';
                const plate1 = growthPlateArray1[index] || '';

                // decide the value radio selected
                const checkedYes = plate === '1' ? 'checked' : '';
                const checkedNo = plate === '0' ? 'checked' : '';
                const disabled = plate1 === '0' ? 'disabled' : '';

                growthPlateInputsHba.append(
                    `<div class="d-flex align-items-center mb-2">
                        <label class="control-label me-3" style="margin-bottom: 0; line-height: 1.5;">Growth Plate ${plateNumber}:</label>
                        <div class="d-flex align-items-center">
                            <input type="hidden" name="growth_plate${plateNumber}" value="${plate}">
                            <label class="radio-inline me-2" style="margin-bottom: 0;">
                                <input type="radio" id="growth_plate${plateNumber}" name="growth_plate${plateNumber}" value="1" ${checkedYes} ${disabled}> Yes
                            </label>
                            <label class="radio-inline" style="margin-bottom: 0;">
                                <input type="radio" id="growth_plate${plateNumber}"  name="growth_plate${plateNumber}" value="0" ${checkedNo} ${disabled}> No
                            </label>
                        </div>
                    </div>`
                );
            });
            $('#compose-modalHBA').modal('show');
        });

    });
</script>
