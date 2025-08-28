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
                                            <input id="idXld_one_water_sample" name="idXld_one_water_sample" type="hidden" class="form-control input-sm">
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
                                            <input id="idChromagar_one_water_sample" name="idChromagar_one_water_sample" type="hidden" class="form-control input-sm">
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
                    <input id="idBiochemical_one_water_sample" name="idBiochemical_one_water_sample" type="hidden" class="form-control input-sm">
                    
                    <!-- Confirmation -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Confirmation</label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <input type="radio" name="confirmation" value="Salmonella" required> Salmonella
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="confirmation" value="Not Salmonella"> Not Salmonella
                            </label>
                        </div>
                    </div>

                    <!-- Sample Store in Biobank -->
                    <!-- <div class="form-group">
                        <label for="sample_store" class="col-sm-4 control-label">Sample Store in Biobank</label>
                        <div class="col-sm-8">
                            <select id="sample_store" name="sample_store" class="form-control" required>
                                <option value="" disabled selected>-- Select --</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div> -->

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
            <form id="formCalculateMPN" action="<?php echo site_url('Salmonella_liquids/saveCalculateMPN') ?>" method="post" class="form-horizontal">
                <div class="modal-body">
                    <input id="mode_calculateMPN" name="mode_calculateMPN" type="hidden" class="form-control input-sm">
                    <input id="id_salmonella_liquids_mpn" name="id_salmonella_liquids_mpn" type="hidden" class="form-control input-sm">
                    <input id="id_salmonella_result_mpn_liquids" name="id_salmonella_result_mpn_liquids" type="hidden" class="form-control input-sm">
                    <!-- <input id="current_sample_dryweight" name="current_sample_dryweight" type="hidden" class="form-control input-sm"> -->

                    <!-- MPN Concentration -->
                    <div class="form-group">
                        <label for="mpn_concentration" class="col-sm-4 control-label">MPN Concentration</label>
                        <div class="col-sm-8">
                            <input id="mpn_concentration" name="mpn_concentration" type="text" class="form-control" placeholder="Enter MPN concentration" required>
                        </div>
                    </div>

                    <!-- Upper CI -->
                    <div class="form-group">
                        <label for="upper_ci" class="col-sm-4 control-label">Upper CI</label>
                        <div class="col-sm-8">
                            <input id="upper_ci" name="upper_ci" type="text" class="form-control" placeholder="Enter upper confidence interval" required>
                        </div>
                    </div>

                    <!-- Lower CI -->
                    <div class="form-group">
                        <label for="lower_ci" class="col-sm-4 control-label">Lower CI</label>
                        <div class="col-sm-8">
                            <input id="lower_ci" name="lower_ci" type="text" class="form-control" placeholder="Enter lower confidence interval" required>
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
        let id_salmonella_liquids = document.getElementById('id_salmonella_liquids').value;
        window.location.href = '<?php echo site_url('Salmonella_liquids/excel') ?>/' + id_salmonella_liquids;
    });
</script>
<script>
    // Calculate MPN button click handler
    document.getElementById('calculateMpnBtn').addEventListener('click', function() {
        let id_salmonella_liquids = document.getElementById('id_salmonella_liquids').value;

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

        // Set the id_salmonella_liquids value in the modal
        document.getElementById('id_salmonella_liquids_mpn').value = id_salmonella_liquids;

        // Check if MPN calculation already exists
        $.ajax({
            url: '<?php echo site_url('Salmonella_liquids/getCalculateMPN'); ?>',
            type: 'GET',
            data: { id_salmonella_liquids: id_salmonella_liquids },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Data exists, set to edit mode
                    document.getElementById('mode_calculateMPN').value = 'edit';
                    document.getElementById('id_salmonella_result_mpn_liquids').value = response.data.id_salmonella_result_mpn_liquids;
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
                    document.getElementById('id_salmonella_result_mpn_liquids').value = '';
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
                document.getElementById('id_salmonella_result_mpn_liquids').value = '';
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
    let salmonella_assay_barcode = $('#salmonella_assay_barcode').val();
    let id_salmonella_liquids = $('#id_salmonella_liquids').val();
    let number_of_tubes = $('#number_of_tubes').val();
    const BASE_URL = '/limsonewater/index.php';
    let idx_one_water_sample = $('#id_one_water_sample').val();

    $(document).ready(function() {
       	let loggedInUser = '<?php echo $this->session->userdata('id_users'); ?>';
		let userCreated = $('#user_created').val();
		let userReview = $('#user_review').val();
		let fullName = $('#reviewed_by_label').val();

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
        //     // Set current sample_dryweight value for syncing to database
        //     $('#current_sample_dryweight').val($('#sample_dryweight').val());
        // });

        // Calculate MPN form submission
        $('#formCalculateMPN').submit(function(e) {
            e.preventDefault();
            
            // Always use the same URL since we handle mode validation in the controller
            let url = '<?php echo site_url('Salmonella_liquids/saveCalculateMPN'); ?>';
            let formData = $(this).serialize();
            
            // Debug logging
            console.log('Form URL:', url);
            console.log('Form Data:', formData);
            console.log('Mode:', $('#mode_calculateMPN').val());
            console.log('ID Salmonella Liquids:', $('#id_salmonella_liquids_mpn').val());

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    console.log('Success Response:', response);
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
                            text: response.message || 'Unknown error occurred.'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error Details:');
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('Response Text:', xhr.responseText);
                    console.error('Status Code:', xhr.status);
                    
                    let errorMessage = 'Something went wrong. Please try again.';
                    if (xhr.responseText) {
                        try {
                            let errorResponse = JSON.parse(xhr.responseText);
                            errorMessage = errorResponse.message || errorMessage;
                        } catch (e) {
                            errorMessage = 'Server error: ' + xhr.responseText.substring(0, 100);
                        }
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMessage
                    });
                }
            });
        });

        // Reset form when modal is hidden
        $('#compose-modalCalculateMPN').on('hidden.bs.modal', function() {
            $('#formCalculateMPN')[0].reset();
            $('#mode_calculateMPN').val('');
            $('#id_salmonella_result_mpn_liquids').val('');
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
							url: '<?php echo site_url('Salmonella_liquids/saveReview'); ?>',
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
                    url: '<?php echo site_url('Salmonella_liquids/cancelReview'); ?>',
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
                                    <th>Confirmation</th>
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
                    {"data": "confirmation"},
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
            $('#idBiochemical_one_water_sample').val(idx_one_water_sample);
            $('#id_salmonella_liquidsBiochemical').val(id_salmonella_liquids);
            $('#id_result_chromagar1').val(data.id_result_chromagar);
            // $('#oxidase').val('');
            // $('#catalase').val('');
            // $('#confirmation').val('');
            // $('#sample_store').val('');
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
            $('#idBiochemical_one_water_sample').val(idx_one_water_sample);
            $('#id_result_biochemical').val(data.id_result_biochemical);
            $('#id_salmonella_liquidsBiochemical').val(data.id_salmonella_liquids);
            $('#id_result_chromagar1').val(data.id_result_chromagar);
            // Set radio button untuk oxidase
            // $('input[name="oxidase"][value="' + data.oxidase + '"]').prop('checked', true);
            
            // Set radio button untuk confirmation
            $('input[name="confirmation"][value="' + data.confirmation + '"]').prop('checked', true);
            // $('#confirmation').val(data.confirmation);
            // $('#sample_store').val(data.sample_store);
            // Tambahkan nilai lain yang diperlukan sesuai data

            // Tampilkan modal untuk edit
            $('#compose-modalBiochemical').modal('show');
        });





        $('#addtombol_detResultsXld').click(function() {
            $('#mode_detResultsXld').val('insert');
            $('#modal-title-Xld').html('<i class="fa fa-wpforms"></i> Insert | Results XLD <span id="my-another-cool-loader"></span>');
            $('#idXld_one_water_sample').val(idx_one_water_sample);
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
            $('#idXld_one_water_sample').val(idx_one_water_sample);
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
                $('#idChromagar_one_water_sample').val(idx_one_water_sample);
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
            $('#idChromagar_one_water_sample').val(idx_one_water_sample);
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