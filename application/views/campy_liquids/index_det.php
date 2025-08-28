<div class="content-wrapper">
	<section class="content">
		<div class="box box-black box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Processing | Campy Liquids | Details</h3>
			</div>
				<form role="form"  id="formKeg" method="post" class="form-horizontal">
					<div class="box-body">
						<!-- <input type="hidden" class="form-control " id="id_req" name="id_req" value="<?php// echo $id_req ?>"> -->
						<input id="id_campy_liquids" name="id_campy_liquids" type="hidden" class="form-control input-sm" value="<?php echo $id_campy_liquids ?>">
						<div class="form-group">
							<label for="id_one_water_sample" class="col-sm-2 control-label">One Water Sample ID</label>
							<div class="col-sm-4">
								<input class="form-control " id="id_one_water_sample" name="id_one_water_sample" value="<?php echo $id_one_water_sample ?? "-" ?>"  disabled>
							</div>

							<label for="initial" class="col-sm-2 control-label">Lab Tech</label>
							<div class="col-sm-4">
								<input class="form-control " id="initial" name="initial" value="<?php echo $initial ?? "-" ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="number_of_tubes" class="col-sm-2 control-label">Number of Assay Tubes</label>
							<div class="col-sm-4">
								<input class="form-control " id="number_of_tubes" name="number_of_tubes" value="<?php echo $number_of_tubes ?? "-" ?>"  disabled>
							</div>

							<label for="sampletype" class="col-sm-2 control-label">Sample Type</label>
							<div class="col-sm-4">
								<input class="form-control " id="sampletype" name="sampletype" value="<?php echo $sampletype ?? "-" ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="mpn_pcr_conducted" class="col-sm-2 control-label">MPN PCR Conducted</label>
							<div class="col-sm-4">
								<input class="form-control " id="mpn_pcr_conducted" name="mpn_pcr_conducted" value="<?php echo $mpn_pcr_conducted ?? "-" ?>"  disabled>
							</div>

							<label for="campy_assay_barcode" class="col-sm-2 control-label">Campy Assay Barcode</label>
							<div class="col-sm-4">
								<input class="form-control " id="campy_assay_barcode" name="campy_assay_barcode" value="<?php echo $campy_assay_barcode ?? "-" ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="date_sample_processed" class="col-sm-2 control-label">Date Sample</label>
							<div class="col-sm-4">
								<input class="form-control " id="date_sample_processed" name="date_sample_processed" value="<?php echo $date_sample_processed ?? "-" ?>" disabled>
							</div>

							<label for="time_sample_processed" class="col-sm-2 control-label">Time Sample</label>
							<div class="col-sm-4">
								<input class="form-control " id="time_sample_processed" name="time_sample_processed" value="<?php echo $time_sample_processed ?? "-" ?>"  disabled>
							</div>
						</div>

						<div class="form-group">
                            <label for="elution_volume" class="col-sm-2 control-label">Filtration  Volume(mL)</label>
							<div class="col-sm-4">
								<input class="form-control " id="elution_volume" name="elution_volume" value="<?php echo $elution_volume ?? "-" ?>"  disabled>
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
                                    <?php
                                        $lvl = $this->session->userdata('id_user_level');
                                        if ($lvl != 4){
                                            echo '<button class="btn btn-primary" id="calculateMpnBtn" style="margin-left: 10px; position: relative;">
                                                    <i class="fa fa-calculator" aria-hidden="true"></i> Calculate MPN
                                                    <span id="mpnUpdateBadge" class="badge badge-warning" style="position: absolute; top: -5px; right: -5px; background-color: #ff6b6b; color: white; border-radius: 50%; width: 20px; height: 20px; font-size: 10px; line-height: 20px; display: none;">!</span>
                                                  </button>';
                                        }
                                    ?>
                                </div>
                                <input id="id_campy_liquids" name="id_campy_liquids" type="hidden" class="form-control input-sm" value="<?php echo $id_campy_liquids ?>">

                                <div id="content-final-concentration" class="table-responsive">
                                    <!-- <table id="exampleFinalConcentration" class="table display table-bordered table-striped" width="100%">
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
                                                <th>Filtration  Volume(mL)</th>
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
                                    </table> -->
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
                                                <th>Filtration Volume(mL)</th>
                                                <?php if (!empty($finalConcentration)): ?>
                                                    <?php 
                                                        // Tube volume headers
                                                        foreach ($finalConcentration[0] as $key => $value): 
                                                            if (strpos($key, 'Tube ') === 0): ?>
                                                                <th><?= htmlspecialchars($key) ?> Volume</th>
                                                            <?php endif;
                                                        endforeach;
                                                        // Plate number headers
                                                        $plate_numbers = [];
                                                        if (!empty($finalConcentration[0]->plate_numbers)) {
                                                            $plate_numbers = array_map('trim', explode(',', $finalConcentration[0]->plate_numbers));
                                                        }
                                                        foreach ($plate_numbers as $plate_number): ?>
                                                            <th>Tube <?= htmlspecialchars($plate_number) ?> Result</th>
                                                        <?php endforeach; ?>
                                                <?php else: ?>
                                                    <th colspan="100%" style="text-align: center">No data available</th>
                                                <?php endif; ?>
                                                <th>Concentration MPN</th>
                                                <th>Upper CI</th>
                                                <th>Lower CI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($finalConcentration)): ?>
                                                <?php foreach ($finalConcentration as $concentration): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($concentration->id_one_water_sample) ?></td>
                                                        <td><?= htmlspecialchars($concentration->campy_assay_barcode) ?></td>
                                                        <td><?= htmlspecialchars($concentration->initial) ?></td>
                                                        <td><?= htmlspecialchars($concentration->sampletype  ?? '-') ?></td>
                                                        <td><?= htmlspecialchars($concentration->number_of_tubes) ?></td>
                                                        <td><?= htmlspecialchars($concentration->mpn_pcr_conducted) ?></td>
                                                        <td><?= htmlspecialchars($concentration->date_sample_processed) ?></td>
                                                        <td><?= htmlspecialchars($concentration->time_sample_processed) ?></td>
                                                        <td><?= htmlspecialchars($concentration->elution_volume) ?></td>
                                                        <?php 
                                                        // Tube volumes
                                                        foreach ($concentration as $key => $value): 
                                                            if (strpos($key, 'Tube ') === 0): ?>
                                                                <td><?= htmlspecialchars($value) ?></td>
                                                            <?php endif;
                                                        endforeach;

                                                        // Plate numbers
                                                        $plate_numbers = [];
                                                        if (!empty($concentration->plate_numbers)) {
                                                            $plate_numbers = array_map('trim', explode(',', $concentration->plate_numbers));
                                                        }
                                                        // Confirmation values
                                                        $confirmation = isset($concentration->confirmation) && is_array($concentration->confirmation) ? $concentration->confirmation : [];
                                                        foreach ($plate_numbers as $plate_number): 
                                                            // Normalize key for confirmation lookup (remove spaces)
                                                            $lookup_key = trim($plate_number);
                                                            // Try direct match, fallback to match with/without space
                                                            $confirmation_value = isset($confirmation[$lookup_key]) ? $confirmation[$lookup_key] : (
                                                                isset($confirmation[' ' . $lookup_key]) ? $confirmation[' ' . $lookup_key] : (
                                                                    isset($confirmation[$plate_number]) ? $confirmation[$plate_number] : 'No Available'
                                                                )
                                                            );
                                                        ?>
                                                            <td><?= htmlspecialchars($confirmation_value) ?></td>
                                                        <?php endforeach; ?>
                                                        <td><?= htmlspecialchars($concentration->mpn_concentration) ?></td>
                                                        <td><?= htmlspecialchars($concentration->upper_ci) ?></td>
                                                        <td><?= htmlspecialchars($concentration->lower_ci) ?></td>
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
						<button type="button" name="batal" value="batal" class="btn btn-warning" onclick="window.location.href='<?= site_url('campy_liquids'); ?>';">
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
                        <form id="formDetail24" action=<?php echo site_url('Campy_liquids/saveResultsCharcoal') ?> method="post" class="form-horizontal">
                            <div class="modal-body">
                                <div class="form-group">
                                        <div class="col-sm-9">
                                            <input id="mode_detResultsCharcoal" name="mode_detResultsCharcoal" type="hidden" class="form-control input-sm">
                                            <!-- <input id="idx_moisture24" name="idx_moisture24" type="hidden" class="form-control input-sm">
                                            <input id="id_moisture24" name="id_moisture24" type="hidden" class="form-control input-sm"> -->
                                            <input id="id_campy_liquids1" name="id_campy_liquids1" type="hidden" class="form-control input-sm">
                                            <input id="number_of_tubes1" name="number_of_tubes1" type="hidden" class="form-control input-sm">
                                            <input id="id_result_charcoal_liquids" name="id_result_charcoal_liquids" type="hidden" class="form-control input-sm">
                                            <input id="idCharcoal_one_water_sample" name="idCharcoal_one_water_sample" type="hidden" class="form-control input-sm">
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
                        <form id="formDetail24" action=<?php echo site_url('Campy_liquids/saveResultsHBA') ?> method="post" class="form-horizontal">
                            <div class="modal-body">
                                <div class="form-group">
                                        <div class="col-sm-9">
                                            <input id="mode_detResultsHBA" name="mode_detResultsHBA" type="hidden" class="form-control input-sm">
                                            <!-- <input id="idx_moisture24" name="idx_moisture24" type="hidden" class="form-control input-sm">
                                            <input id="id_moisture24" name="id_moisture24" type="hidden" class="form-control input-sm"> -->
                                            <input id="id_campy_liquidsHBA" name="id_campy_liquidsHBA" type="hidden" class="form-control input-sm">
                                            <input id="number_of_tubesHba" name="number_of_tubesHba" type="hidden" class="form-control input-sm">
                                            <input id="id_result_hba_liquids" name="id_result_hba_liquids" type="hidden" class="form-control input-sm">
                                            <input id="idHba_one_water_sample" name="idHba_one_water_sample" type="hidden" class="form-control input-sm">
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
            <form id="formBiochemical" action="<?php echo site_url('Campy_liquids/saveBiochemical') ?>" method="post" class="form-horizontal">
                <div class="modal-body">
                    <input id="mode_detResultsBiochemical" name="mode_detResultsBiochemical" type="hidden" class="form-control input-sm">
                    <input id="id_campy_liquidsBiochemical" name="id_campy_liquidsBiochemical" type="hidden" class="form-control input-sm">
                    <input id="id_result_biochemical_liquids" name="id_result_biochemical_liquids" type="hidden" class="form-control input-sm">
                    <input id="biochemical_tube" name="biochemical_tube" type="hidden" class="form-control input-sm">
                    <input id="id_result_hba1_liquids" name="id_result_hba1_liquids" type="hidden" class="form-control input-sm">
                    <input id="idBiochemical_one_water_sample" name="idBiochemical_one_water_sample" type="hidden" class="form-control input-sm">

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


<!-- MODAL FORM Calculate MPN -->
<div class="modal fade" id="compose-modalCalculateMPN" tabindex="-1" role="dialog" aria-hidden="true" data-bs-scrollable="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                <h4 class="modal-title" id="modal-title-calculate-mpn">Calculate MPN | New</h4>
            </div>
            <form id="formCalculateMPN" action="<?php echo site_url('Campy_liquids/saveCalculateMPN') ?>" method="post" class="form-horizontal">
                <div class="modal-body">
                    <input id="mode_calculateMPN" name="mode_calculateMPN" type="hidden" class="form-control input-sm">
                    <input id="id_campy_liquids_mpn" name="id_campy_liquids_mpn" type="hidden" class="form-control input-sm">
                    <input id="id_campy_result_mpn_liquids" name="id_campy_result_mpn_liquids" type="hidden" class="form-control input-sm">
                    <!-- <input id="current_sample_dryweight" name="current_sample_dryweight" type="hidden" class="form-control input-sm"> -->

                    <!-- MPN Concentration -->
                    <div class="form-group">
                        <label for="mpn_concentration" class="col-sm-4 control-label">MPN Concentration</label>
                        <div class="col-sm-8">
                            <input id="mpn_concentration" name="mpn_concentration" type="number" step="any" class="form-control" placeholder="Enter MPN concentration" required>
                        </div>
                    </div>

                    <!-- Upper CI -->
                    <div class="form-group">
                        <label for="upper_ci" class="col-sm-4 control-label">Upper CI</label>
                        <div class="col-sm-8">
                            <input id="upper_ci" name="upper_ci" type="number" step="any" class="form-control" placeholder="Enter upper confidence interval" required>
                        </div>
                    </div>

                    <!-- Lower CI -->
                    <div class="form-group">
                        <label for="lower_ci" class="col-sm-4 control-label">Lower CI</label>
                        <div class="col-sm-8">
                            <input id="lower_ci" name="lower_ci" type="number" step="any" class="form-control" placeholder="Enter lower confidence interval" required>
                        </div>
                    </div>

                    <!-- Concentration MPN/g dry weight -->
                    <!-- <div class="form-group">
                        <label class="col-sm-4 control-label">Auto-calculated Results</label>
                        <div class="col-sm-8">
                            <input id="mpn_concentration_dw" name="mpn_concentration_dw" type="hidden">
                            <input id="upper_ci_dw" name="upper_ci_dw" type="hidden">
                            <input id="lower_ci_dw" name="lower_ci_dw" type="hidden">
                            
                            <div class="auto-calc-cards">
                                <div class="calc-card calc-card-full">
                                    <div class="calc-card-header">
                                        <i class="fa fa-calculator text-primary"></i>
                                        <span class="calc-title">Concentration MPN/g dry weight</span>
                                    </div>
                                    <div class="calc-card-body">
                                        <span id="display_mpn_concentration_dw" class="calc-value">-</span>
                                    </div>
                                </div>
                                
                                <div class="calc-card-row">
                                    <div class="calc-card calc-card-half">
                                        <div class="calc-card-header">
                                            <i class="fa fa-arrow-up text-success"></i>
                                            <span class="calc-title">Upper CI MPN/g dw</span>
                                        </div>
                                        <div class="calc-card-body">
                                            <span id="display_upper_ci_dw" class="calc-value">-</span>
                                        </div>
                                    </div>
                                    
                                    <div class="calc-card calc-card-half">
                                        <div class="calc-card-header">
                                            <i class="fa fa-arrow-down text-warning"></i>
                                            <span class="calc-title">Lower CI MPN/g dw</span>
                                        </div>
                                        <div class="calc-card-body">
                                            <span id="display_lower_ci_dw" class="calc-value">-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer clearfix" style="display: flex; align-items: center; justify-content: flex-end; gap: 10px; padding: 15px 20px; border-top: 1px solid #dee2e6; background-color: #f8f9fa;">
                    <button type="submit" class="btn btn-primary" style="min-width: 100px; padding: 8px 16px; font-weight: 500; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,123,255,0.2); transition: all 0.3s ease;">
                        <i class="fa fa-save" style="margin-right: 6px;"></i> Save
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal" style="min-width: 100px; padding: 8px 16px; font-weight: 500; border-radius: 6px; box-shadow: 0 2px 4px rgba(255,193,7,0.2); transition: all 0.3s ease;">
                        <i class="fa fa-times" style="margin-right: 6px;"></i> Cancel
                    </button>
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

    /* Auto-calculated Cards Styling */
    .auto-calc-cards {
        display: flex !important;
        flex-direction: column !important;
        gap: 15px;
        width: 100%;
        align-items: stretch;
    }

    /* Full width card for main concentration */
    .calc-card-full {
        width: 100% !important;
        flex: none !important;
        display: block !important;
    }

    /* Two column row for CI values */
    .calc-card-row {
        display: flex !important;
        flex-direction: row !important;
        gap: 15px;
        flex-wrap: nowrap;
        width: 100%;
        justify-content: space-between;
    }

    /* Half width cards for CI values */
    .calc-card-half {
        flex: 1 1 calc(50% - 7.5px) !important;
        min-width: 180px;
        max-width: calc(50% - 7.5px);
        box-sizing: border-box;
    }

    .calc-card {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 12px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: block !important;
        width: auto !important;
    }

    .calc-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .calc-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #007bff, #28a745, #ffc107);
        opacity: 0.8;
    }

    .calc-card-header {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        gap: 6px;
    }

    .calc-title {
        font-size: 11px;
        font-weight: 600;
        color: #495057;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .calc-card-body {
        text-align: center;
    }

    .calc-value {
        font-size: 18px;
        font-weight: 700;
        color: #212529;
        display: block;
        font-family: 'Courier New', monospace;
        background: rgba(255,255,255,0.8);
        padding: 4px 8px;
        border-radius: 4px;
        border: 1px solid rgba(0,0,0,0.1);
    }

    .calc-card:nth-child(1) .calc-value {
        color: #007bff;
    }

    .calc-card-row .calc-card:nth-child(1) .calc-value {
        color: #28a745;
    }

    .calc-card-row .calc-card:nth-child(2) .calc-value {
        color: #ffc107;
    }

    @media (max-width: 768px) {
        .calc-card-row {
            flex-direction: column !important;
            gap: 10px;
        }
        
        .calc-card-half {
            flex: 1 1 100% !important;
            min-width: 100% !important;
            max-width: 100% !important;
        }
    }

    @media (min-width: 769px) {
        .calc-card-row {
            flex-direction: row !important;
            flex-wrap: nowrap !important;
        }
        
        .calc-card-half {
            flex: 1 1 calc(50% - 7.5px) !important;
            min-width: calc(50% - 7.5px) !important;
            max-width: calc(50% - 7.5px) !important;
        }
    }

    @media (max-width: 480px) {
        .auto-calc-cards {
            gap: 10px;
        }
        
        .calc-card {
            padding: 8px;
        }
        
        .calc-title {
            font-size: 10px;
        }
        
        .calc-value {
            font-size: 16px;
        }
    }

    /* Enhanced Button Styling */
    .modal-footer .btn {
        transition: all 0.3s ease !important;
        border: none !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 13px;
    }

    .modal-footer .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2) !important;
    }

    .modal-footer .btn:active {
        transform: translateY(0);
        box-shadow: 0 2px 4px rgba(0,0,0,0.2) !important;
    }

    .modal-footer .btn-primary:hover {
        background-color: #0056b3 !important;
        box-shadow: 0 4px 8px rgba(0,123,255,0.3) !important;
    }

    .modal-footer .btn-warning:hover {
        background-color: #e0a800 !important;
        box-shadow: 0 4px 8px rgba(255,193,7,0.3) !important;
    }

    /* Custom SweetAlert2 styling */
    .swal-wide {
        width: 600px !important;
    }

    .swal2-html-container {
        font-size: 14px;
        line-height: 1.5;
    }

    .swal2-html-container p {
        margin: 8px 0;
    }

    .swal2-html-container strong {
        font-weight: 600;
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
        let id_campy_liquids = document.getElementById('id_campy_liquids').value;
        window.location.href = '<?php echo site_url('Campy_liquids/excel') ?>/' + id_campy_liquids;
    });
</script>
<script>
    // Calculate MPN button click handler
    document.getElementById('calculateMpnBtn').addEventListener('click', function() {
        let id_campy_liquids = document.getElementById('id_campy_liquids').value;

        // Validate sample_dryweight before proceeding
        // let sampleDryweight = document.getElementById('sample_dryweight').value;
        
        // Check if sample_dryweight is empty or equals 0
        // if (!sampleDryweight || sampleDryweight.trim() === '' || parseFloat(sampleDryweight) === 0) {
        //     Swal.fire({
        //         title: 'Sample Dry Weight Data is Empty!',
        //         html: `
        //             <div style="text-align: left; margin-top: 15px;">
        //                 <p><i class="fa fa-exclamation-triangle" style="color: #f39c12; margin-right: 8px;"></i><strong>Sample Dry Weight is still empty or equals 0.</strong></p>
        //                 <p style="margin-top: 10px;">Please fill in the <strong>Sample Dry Weight</strong> data first to perform MPN calculation.</p>
        //                 <hr style="margin: 15px 0;">
        //                 <p style="font-size: 13px; color: #666;"><i class="fa fa-info-circle" style="color: #3498db; margin-right: 5px;"></i>Sample Dry Weight data is required to calculate <strong>MPN/g Dry Weight</strong>.</p>
        //             </div>
        //         `,
        //         icon: 'warning',
        //         confirmButtonText: '<i class="fa fa-check"></i> Understood',
        //         confirmButtonColor: '#f39c12',
        //         customClass: {
        //             popup: 'swal-wide'
        //         }
        //     });
        //     return; // Stop execution if sample_dryweight is empty
        // }

        // Set the id_campy_liquids value in the modal
        document.getElementById('id_campy_liquids_mpn').value = id_campy_liquids;

        // Check if MPN calculation already exists
        $.ajax({
            url: '<?php echo site_url('Campy_liquids/getCalculateMPN'); ?>',
            type: 'GET',
            data: { id_campy_liquids: id_campy_liquids },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Data exists, set to edit mode
                    document.getElementById('mode_calculateMPN').value = 'edit';
                    document.getElementById('id_campy_result_mpn_liquids').value = response.data.id_campy_result_mpn_liquids;
                    document.getElementById('mpn_concentration').value = response.data.mpn_concentration;
                    document.getElementById('upper_ci').value = response.data.upper_ci;
                    document.getElementById('lower_ci').value = response.data.lower_ci;
                    // document.getElementById('mpn_concentration_dw').value = response.data.mpn_concentration_dw || '';
                    // document.getElementById('upper_ci_dw').value = response.data.upper_ci_dw || '';
                    // document.getElementById('lower_ci_dw').value = response.data.lower_ci_dw || '';
                    
                    // Update modal title
                    document.getElementById('modal-title-calculate-mpn').innerHTML = 'Calculate MPN | Edit';
                } else {
                    // No data exists, set to insert mode
                    document.getElementById('mode_calculateMPN').value = 'insert';
                    document.getElementById('id_campy_result_mpn_liquids').value = '';
                    document.getElementById('mpn_concentration').value = '';
                    document.getElementById('upper_ci').value = '';
                    document.getElementById('lower_ci').value = '';
                    // document.getElementById('mpn_concentration_dw').value = '';
                    // document.getElementById('upper_ci_dw').value = '';
                    // document.getElementById('lower_ci_dw').value = '';
                    
                    // Update modal title
                    document.getElementById('modal-title-calculate-mpn').innerHTML = 'Calculate MPN | New';
                }
                
                // Show the modal
                $('#compose-modalCalculateMPN').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error checking MPN calculation:', error);
                
                // On error, default to insert mode
                document.getElementById('mode_calculateMPN').value = 'insert';
                document.getElementById('id_campy_result_mpn_liquids').value = '';
                document.getElementById('mpn_concentration').value = '';
                document.getElementById('upper_ci').value = '';
                document.getElementById('lower_ci').value = '';
                // document.getElementById('mpn_concentration_dw').value = '';
                // document.getElementById('upper_ci_dw').value = '';
                // document.getElementById('lower_ci_dw').value = '';
                document.getElementById('modal-title-calculate-mpn').innerHTML = 'Calculate MPN | New';
                
                // Show the modal
                $('#compose-modalCalculateMPN').modal('show');
            }
        });
    });
</script>
<script type="text/javascript">

    let table;
    let table1;
    let table2;
    let id_moisture = $('#id_moisture').val();
    let campy_assay_barcode = $('#campy_assay_barcode').val();
    let id_campy_liquids = $('#id_campy_liquids').val();
    let number_of_tubes = $('#number_of_tubes').val();
    const BASE_URL = '/limsonewater/index.php';
    let idx_one_water_sample = $('#id_one_water_sample').val();

    $(document).ready(function() {
    	let loggedInUser = '<?php echo $this->session->userdata('id_users'); ?>';
		let userCreated = $('#user_created').val();
		let userReview = $('#user_review').val();
		let fullName = $('#reviewed_by_label').val();

        // Store initial sample_dryweight value for comparison
        // let initialSampleDryweight = parseFloat($('#sample_dryweight_old').val()) || 0;

        // Check if MPN calculation needs to be updated
        // function checkMpnRecalculation() {
        //     let currentSampleDryweight = parseFloat($('#sample_dryweight').val()) || 0;
            
        //     // If sample_dryweight has changed and MPN calculation exists
        //     if (currentSampleDryweight !== initialSampleDryweight && currentSampleDryweight > 0) {
        //         $.ajax({
        //             url: '<?php echo site_url('Campy_biosolids/getCalculateMPN'); ?>',
        //             type: 'GET',
        //             data: { id_campy_biosolids: id_campy_biosolids },
        //             dataType: 'json',
        //             success: function(response) {
        //                 if (response.status === 'success') {
        //                     // Show badge indicator
        //                     $('#mpnUpdateBadge').show();
                            
        //                     // MPN calculation exists, show recalculation notification
        //                     showMpnRecalculationModal();
        //                 }
        //             }
        //         });
        //     } else if (currentSampleDryweight === initialSampleDryweight) {
        //         // Hide badge if values are the same
        //         $('#mpnUpdateBadge').hide();
        //     }
        // }

        // Function to show MPN recalculation notification
        // function showMpnRecalculationModal() {
        //     Swal.fire({
        //         icon: 'warning',
        //         title: 'Sample Dry Weight Changed!',
        //         html: `
        //             <div style="text-align: left; margin: 15px 0;">
        //                 <p><strong>The sample dry weight has been updated:</strong></p>
        //                 <p>• Previous value: <span style="color: #dc3545; font-weight: bold;">${initialSampleDryweight}</span></p>
        //                 <p>• New value: <span style="color: #28a745; font-weight: bold;">${$('#sample_dryweight').val()}</span></p>
        //                 <br>
        //                 <p style="color: #856404; background-color: #fff3cd; padding: 10px; border-radius: 5px; border-left: 4px solid #ffc107;">
        //                     <i class="fa fa-exclamation-triangle"></i> 
        //                     Your MPN calculations may no longer be accurate and need to be recalculated.
        //                 </p>
        //             </div>
        //         `,
        //         showCancelButton: true,
        //         confirmButtonText: '<i class="fa fa-calculator"></i> Recalculate MPN Now',
        //         cancelButtonText: '<i class="fa fa-times"></i> Later',
        //         confirmButtonColor: '#007bff',
        //         cancelButtonColor: '#6c757d',
        //         reverseButtons: true,
        //         allowOutsideClick: false,
        //         customClass: {
        //             popup: 'swal-wide'
        //         }
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             // Update the initial value and open MPN calculation modal
        //             initialSampleDryweight = parseFloat($('#sample_dryweight_old').val()) || 0;
        //             $('#mpnUpdateBadge').hide(); // Hide badge
        //             $('#calculateMpnBtn').click();
        //         } else {
        //             // Update the initial value but don't recalculate
        //             initialSampleDryweight = parseFloat($('#sample_dryweight_old').val()) || 0;
        //             $('#mpnUpdateBadge').hide(); // Hide badge
        //         }
        //     });
        // }

        // Check for MPN recalculation when page loads
        // setTimeout(checkMpnRecalculation, 1000)

        // Function to calculate MPN per gram dry weight values
        // function calculateMpnDryWeight() {
        //     let mpnConcentration = parseFloat($('#mpn_concentration').val()) || 0;
        //     let upperCi = parseFloat($('#upper_ci').val()) || 0;
        //     let lowerCi = parseFloat($('#lower_ci').val()) || 0;
        //     let sampleDryweight = parseFloat($('#sample_dryweight').val()) || 0;

        //     if (sampleDryweight > 0) {
        //         // Calculate Concentration MPN/g dry weight = mpn_concentration / sample_dryweight
        //         let mpnConcentrationDw = (mpnConcentration / sampleDryweight).toFixed(4);
        //         $('#mpn_concentration_dw').val(mpnConcentrationDw);
        //         $('#display_mpn_concentration_dw').text(mpnConcentrationDw);

        //         // Calculate Upper CI MPN/g dw = upper_ci / sample_dryweight
        //         let upperCiDw = (upperCi / sampleDryweight).toFixed(4);
        //         $('#upper_ci_dw').val(upperCiDw);
        //         $('#display_upper_ci_dw').text(upperCiDw);

        //         // Calculate Lower CI MPN/g dw = lower_ci / sample_dryweight
        //         let lowerCiDw = (lowerCi / sampleDryweight).toFixed(4);
        //         $('#lower_ci_dw').val(lowerCiDw);
        //         $('#display_lower_ci_dw').text(lowerCiDw);
        //     } else {
        //         $('#mpn_concentration_dw').val('');
        //         $('#upper_ci_dw').val('');
        //         $('#lower_ci_dw').val('');
        //         $('#display_mpn_concentration_dw').text('-');
        //         $('#display_upper_ci_dw').text('-');
        //         $('#display_lower_ci_dw').text('-');
        //     }
        // }

        // Attach the calculation function to input events
        // $('#mpn_concentration, #upper_ci, #lower_ci').on('input', calculateMpnDryWeight);

        // Also trigger calculation when the modal is shown (in case data is pre-filled)
        // $('#compose-modalCalculateMPN').on('shown.bs.modal', function() {
        //     calculateMpnDryWeight();
        // });

        // Calculate MPN form submission
        $('#formCalculateMPN').submit(function(e) {
            e.preventDefault();
            
            // Always use the same URL since we handle mode validation in the controller
            let url = '<?php echo site_url('Campy_liquids/saveCalculateMPN'); ?>';
            let formData = $(this).serialize();

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        $('#compose-modalCalculateMPN').modal('hide');
                        
                        // Update initialSampleDryweight to current value to prevent further notifications
                        initialSampleDryweight = parseFloat($('#sample_dryweight').val()) || 0;
                        
                        // Hide the badge since we just updated the MPN calculation
                        $('#mpnUpdateBadge').hide();
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(function() {
                            location.reload(); // Reload page to show updated data
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Something went wrong. Please try again.'
                    });
                }
            });
        });

        // Reset form when modal is hidden
        $('#compose-modalCalculateMPN').on('hidden.bs.modal', function() {
            $('#formCalculateMPN')[0].reset();
            $('#mode_calculateMPN').val('');
            $('#id_campy_result_mpn_liquids').val('');
            // $('#current_sample_dryweight').val('');
            // $('#mpn_concentration_dw').val('');
            // $('#upper_ci_dw').val('');
            // $('#lower_ci_dw').val('');
        });

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
							url: '<?php echo site_url('Campy_liquids/saveReview'); ?>',
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
                    url: '<?php echo site_url('Campy_liquids/cancelReview'); ?>',
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

    // // Event listener untuk radio button Oxidase
    // $('input[name="oxidase"]').on('change', updateConfirmation);
    
    // // Event listener untuk radio button Catalase
    // $('input[name="catalase"]').on('change', updateConfirmation);
    
    // function updateConfirmation() {
    //     const oxidaseValue = $('input[name="oxidase"]:checked').val();
    //     const catalaseValue = $('input[name="catalase"]:checked').val();
        
    //     let confirmationText = '';

    //     if (oxidaseValue === 'Positive' && catalaseValue === 'Positive') {
    //         confirmationText = 'Campylobacter';
    //     } else if (oxidaseValue === 'Negative' && catalaseValue === 'Negative') {
    //         confirmationText = 'Not Campylobacter';
    //     } else if (oxidaseValue === 'Positive' && catalaseValue === 'Negative') {
    //         confirmationText = 'Campylobacter';
    //     } else if (oxidaseValue === 'Negative' && catalaseValue === 'Positive') {
    //         confirmationText = 'Not Campylobacter';
    //     } else {
    //         confirmationText = '';
    //     }

    //     $('#confirmation').val(confirmationText);
    // }

        // function generateGrowthPlateInputs(container, numberOfTubes) {
        //     container.empty(); // Clear existing inputs

        //     // Create the required number of inputs and labels
        //     for (let i = 1; i <= numberOfTubes; i++) {
        //         container.append(
        //             `<div class="d-flex align-items-center mb-2">
        //                 <label class="control-label me-3" style="margin-bottom: 0; line-height: 1.5;">Growth Plate ${i}:</label>
        //                 <div class="d-flex align-items-center">
        //                     <label class="radio-inline me-2" style="margin-bottom: 0;">
        //                         <input type="radio" name="growth_plate${i}" value="1"> Yes
        //                     </label>
        //                     <label class="radio-inline" style="margin-bottom: 0;">
        //                         <input type="radio" name="growth_plate${i}" value="0"> No
        //                     </label>
        //                 </div>
        //             </div>`
        //         );
        //     }
        // }

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

            // Check if all required values are selected
            if (gramLysisValue && oxidaseValue) {
                // Logic based on the provided table:
                // Grim=Yes + Oxidase=Yes = Campy (regardless of Catalase)
                // Grim=Yes + Oxidase=No = Not Campy (regardless of Catalase)  
                // Grim=No = Not Campy (regardless of Oxidase and Catalase)
                
                if (gramLysisValue === 'Positive') {
                    // If Gram-lysis is Positive (Yes)
                    if (oxidaseValue === 'Positive') {
                        confirmationText = 'Campylobacter';  // Grim=Yes + Oxidase=Yes = Campy
                    } else {
                        confirmationText = 'Not Campylobacter';  // Grim=Yes + Oxidase=No = Not Campy
                    }
                } else {
                    // If Gram-lysis is Negative (No)
                    confirmationText = 'Not Campylobacter';  // Grim=No = Always Not Campy
                }
            } else {
                // If not all required values are selected, leave confirmation empty
                confirmationText = '';
            }

            // Display result in confirmation field
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



        function showConfirmationDelete(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal-delete').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_deleteCharcoal, .btn_deleteHba, .btn_deleteBiochemical', function() {
            let id = $(this).data('id');
            let url;
            if ($(this).hasClass('btn_deleteCharcoal')) {
                url = '<?php echo site_url('Campy_liquids/delete_detailCharcoal'); ?>/' + id;
                $('.modal-title').html('<i class="fa fa-trash"></i> Result Charcoal | Delete <span id="my-another-cool-loader"></span>');
                $('#confirm-modal-delete #id').text(id);
            } else if ($(this).hasClass('btn_deleteHba')) {
                url = '<?php echo site_url('Campy_liquids/delete_detailHba'); ?>/' + id;
                $('.modal-title').html('<i class="fa fa-trash"></i> Result HBA | Delete <span id="my-another-cool-loader"></span>');
                $('#confirm-modal-delete #id').text(id);
            } else if ($(this).hasClass('btn_deleteBiochemical')) {
                url = '<?php echo site_url('Campy_liquids/delete_detailBiochemical'); ?>/' + id;
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
            ajax: {"url": "../../Campy_liquids/subjsonCharcoal?idCharcoal="+id_campy_liquids, "type": "POST"},
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
            ajax: {"url": "../../Campy_liquids/subjsonHba?idHba="+id_campy_liquids, "type": "POST"},
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
                generateResultBiochemical($('#content-result-biochemical'), plateNumberArray.length, data.id_campy_liquids, plateNumberArray, growthPlateArray);
            } else {
                console.log('Data belum tersedia');
                $('#content-result-biochemical').empty().append('<p class="text-center">No data available</p>');
            }
        });

        // Improved generateResultBiochemical function
        function generateResultBiochemical(container, numberOfPlates, id_campy_liquids, plateNumberArray, growthPlateArray) {
            container.empty(); // Clear existing content

            // Get user level from PHP session
            const userLevel = <?php echo $this->session->userdata('id_user_level'); ?>;

            // Iterate through the plateNumberArray
            for (let i = 0; i < numberOfPlates; i++) {
                const plateNumber = plateNumberArray[i]; // Get the corresponding plate number
                const tableId = `exampleBiochemical_${i}`; // Unique table ID
                const buttonId = `addtombol_detResultsBiochemical_${plateNumber}`; // Unique button ID
                
                // Determine button HTML based on user level and growth plate status
                let buttonHtml = '';
                if (userLevel != 4) { // Level 1-3 can see buttons
                    const isDisabled = growthPlateArray[i] === '0' ? 'disabled' : ''; // Determine if button should be disabled
                    buttonHtml = `<button class="btn btn-primary" id="${buttonId}" data-index="${plateNumber}" ${isDisabled}>
                                    <i class="fa fa-wpforms" aria-hidden="true"></i> Biochemical Tube ${plateNumber}
                                  </button>`;
                } // Level 4 (read-only) gets no button (buttonHtml remains empty)
                
                console.log('button biochemical tube - user level:', userLevel, 'disabled:', growthPlateArray[i] === '0');

                // Append the table and button for each plate
                container.append(`
                    <div class="box-body pad table-responsive">
                        ${buttonHtml}
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
                initializeDataTable(tableId, id_campy_liquids, plateNumber); // Pass the actual plate number
            }
        }


        // Fungsi untuk menginisialisasi DataTable
        function initializeDataTable(tableId, id_campy_liquids, tubeIndex) {
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
                    url: `../../Campy_liquids/subjsonBiochemical?idBiochemical=${id_campy_liquids}&biochemical_tube=${tubeIndex}`,
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
            console.log('datanya', data.id_result_hba_liquids);

            $('#mode_detResultsBiochemical').val('insert');
            $('#modal-title-biochemical').html(`<i class="fa fa-wpforms"></i> Insert | Biochemical Tube ${plateNumber} <span id="my-another-cool-loader"></span>`);
            $('#idBiochemical_one_water_sample').val(idx_one_water_sample);
            $('#id_campy_liquidsBiochemical').val(id_campy_liquids);
            $('#id_result_hba1_liquids').val(data.id_result_hba_liquids);
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
            $('#idBiochemical_one_water_sample').val(idx_one_water_sample);
            $('#id_result_biochemical_liquids').val(data.id_result_biochemical_liquids);
            $('#id_campy_liquidsBiochemical').val(data.id_campy_liquids);
            $('#id_result_hba1_liquids').val(data.id_result_hba_liquids);
            // Set radio button untuk oxidase
            $('input[name="gramlysis"][value="' + data.gramlysis + '"]').prop('checked', true); 
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
            $('#idCharcoal_one_water_sample').val(idx_one_water_sample);
            $('#campy_assay_barcode1').val(campy_assay_barcode);
            $('#campy_assay_barcode1').attr('readonly', true);
            $('#id_campy_liquids1').val(id_campy_liquids);
            $('#number_of_tubes1').val(number_of_tubes);
            $('#compose-modal').modal('show');
        });

        $('#example2').on('click', '.btn_edit_detResultsCharcoal', function() {
            let tr = $(this).closest('tr');
            let data = table.row(tr).data();
            console.log(data);
            $('#mode_detResultsCharcoal').val('edit');
            $('#modal-title-detail').html('<i class="fa fa-pencil-square"></i> Update | Results Charcoal <span id="my-another-cool-loader"></span>');
            $('#idCharcoal_one_water_sample').val(idx_one_water_sample);
            $('#id_result_charcoal_liquids').val(data.id_result_charcoal_liquids);
            $('#campy_assay_barcode1').val(data.campy_assay_barcode);
            $('#campy_assay_barcode1').attr('readonly', true);
            $('#id_campy_liquids1').val(data.id_campy_liquids);
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
                $('#idHba_one_water_sample').val(idx_one_water_sample);
                $('#campy_assay_barcodeHBA').val(campy_assay_barcode);
                $('#id_campy_liquidsHBA').val(id_campy_liquids);
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
            $('#idHba_one_water_sample').val(idx_one_water_sample);
            $('#id_result_hba_liquids').val(data.id_result_hba_liquids);
            $('#campy_assay_barcodeHBA').val(data.campy_assay_barcode);
            $('#campy_assay_barcodeHBA').attr('readonly', true);
            $('#id_campy_liquidsHBA').val(data.id_campy_liquids);
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
