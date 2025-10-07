<div class="content-wrapper">
	<section class="content">
		<div class="box box-black box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Processing | Salmonella PA | Details</h3>
			</div>
				<form role="form"  id="formKeg" method="post" class="form-horizontal">
					<div class="box-body">
						<input id="id_salmonella_pa" name="id_salmonella_pa" type="hidden" class="form-control input-sm" value="<?php echo $id_salmonella_pa ?>">
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

							<label for="salmonella_assay_barcode" class="col-sm-2 control-label">Salmonella Assay Barcode</label>
							<div class="col-sm-4">
								<input class="form-control " id="salmonella_assay_barcode" name="salmonella_assay_barcode" value="<?php echo $salmonella_assay_barcode ?>"  disabled>
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

                            <label for="enrichment_media" class="col-sm-2 control-label">Enrichment Media</label>
							<div class="col-sm-4">
								<input class="form-control " id="enrichment_media" name="enrichment_media" value="<?php echo $enrichment_media ?>"  disabled>
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
                                <h3 class="box-title">Results XLD Agar</h3>
                            </div>
							<div class="box-body pad table-responsive">
								<?php
									$lvl = $this->session->userdata('id_user_level');
									if ($lvl != 4){
										echo "<button class='btn btn-primary' id='addtombol_detResultsXldAgar'><i class='fa fa-wpforms' aria-hidden='true'></i> New Data</button>";
									}
								?>
								<table id="example2" class="table display table-bordered table-striped" width="100%">
									<thead>
										<tr>
                                            <th>Salmonella Assay Barcode</th>
                                            <th>Date of Sample</th>
                                            <th>Time of Sample</th>
                                            <th>Black Colony Plate</th>
                                            <th>Quality Control</th>
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
                                <h3 class="box-title">Results Chromagar</h3>
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
                                            <th>Quality Control</th>
                                            <th>Action</th>
										</tr>
									</thead>
								</table>
							</div>
                        </div>
                    </div>

                    <!-- <div class="col-xs-12"> 
                        <div class="box box-primary box-solid" role="dialog" aria-hidden="true" data-bs-scrollable="true">
                            <div class="box-header">
                                <h3 class="box-title">Results Biochemical</h3>
                                <div class="box-tools pull-right">
                                    <?php 
                                        $lvl = $this->session->userdata('id_user_level');
                                        if ($lvl != 4): 
                                    ?>
                                        <button class="btn btn-success btn-sm" id="autoGenerateBiochemical" title="Auto-generate biochemical results based on XLD and Chromagar">
                                            <i class="fa fa-magic" aria-hidden="true"></i> Auto-Generate
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div id="content-result-biochemical">

                            </div>
                        </div>
                    </div> -->
                    

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
                                <input id="id_salmonella_pa" name="id_salmonella_pa" type="hidden" class="form-control input-sm" value="<?php echo $id_salmonella_pa ?>">

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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($finalConcentration)): ?>
                                                <?php foreach ($finalConcentration as $concentration): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($concentration->id_one_water_sample) ?></td>
                                                        <td><?= htmlspecialchars($concentration->salmonella_assay_barcode) ?></td>
                                                        <td><?= htmlspecialchars($concentration->initial) ?></td>
                                                        <td><?= htmlspecialchars($concentration->sampletype) ?></td>
                                                        <td><?= htmlspecialchars($concentration->number_of_tubes) ?></td>
                                                        <td><?= htmlspecialchars($concentration->mpn_pcr_conducted) ?></td>
                                                        <td><?= htmlspecialchars($concentration->date_sample_processed) ?></td>
                                                        <td><?= htmlspecialchars($concentration->time_sample_processed) ?></td>
                                                        <td><?= htmlspecialchars($concentration->sample_wetweight) ?></td>
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
						<button type="button" name="batal" value="batal" class="btn btn-warning" onclick="window.location.href='<?= site_url('Salmonella_pa'); ?>';">
							<i class="fa fa-times"></i> Close
						</button>
					</div>
				</div>
			</div> 
		</div>
	</section>
</div>

<!-- MODAL FORM Results XldAgar -->
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-scrollable="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                        <h4 class="modal-title" id="modal-title-detail">
							<span id="my-another-cool-loader"></span></h4>
                    </div>
                        <form id="formDetail24" action=<?php echo site_url('Salmonella_pa/saveResultsXldAgar') ?> method="post" class="form-horizontal">
                            <div class="modal-body">
                                <div class="form-group">
                                        <div class="col-sm-9">
                                            <input id="mode_detResultsXldAgar" name="mode_detResultsXldAgar" type="hidden" class="form-control input-sm">
                                            <input id="id_salmonella_pa1" name="id_salmonella_pa1" type="hidden" class="form-control input-sm">
                                            <input id="number_of_tubes1" name="number_of_tubes1" type="hidden" class="form-control input-sm">
                                            <input id="id_result_xld_agar_pa" name="id_result_xld_agar_pa" type="hidden" class="form-control input-sm">
                                            <input id="idXldAgar_one_water_sample" name="idXldAgar_one_water_sample" type="hidden" class="form-control input-sm">
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

                                    <!-- <div class="form-group" id="growth_plate">
                                        <label class="col-sm-4 control-label">Growth Plate</label>
                                        <div class="col-sm-8" id="growthPlateInputs">
                                        </div>
                                    </div> -->

                                    <div class="form-group" id="black_colony_plate_xld_agar">
                                        <label class="col-sm-4 control-label">Black Colony Plate</label>
                                        <div class="col-sm-8" id="blackColonyPlateInputs">
                                            <!-- Radio buttons akan dihasilkan di sini -->
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Quality Control</label>
                                        <div class="col-sm-8">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="quality_control" name="quality_control" value="1">
                                                    <strong>Pass</strong> <span class="text-muted">(Check if quality control passed)</span>
                                                </label>
                                            </div>
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

<!-- MODAL FORM Results Chromagar -->
<div class="modal fade" id="compose-modalChromagar" tabindex="-1" role="dialog" aria-hidden="true" data-bs-scrollable="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #3c8dbc; color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                        <h4 class="modal-title" id="modal-title-Chromagar">
							<span id="my-another-cool-loader"></span></h4>
                    </div>
                        <form id="formDetail24" action=<?php echo site_url('Salmonella_pa/saveResultsChromagar') ?> method="post" class="form-horizontal">
                            <div class="modal-body">
                                <div class="form-group">
                                        <div class="col-sm-9">
                                            <input id="mode_detResultsChromagar" name="mode_detResultsChromagar" type="hidden" class="form-control input-sm">
                                            <input id="id_salmonella_paChromagar" name="id_salmonella_paChromagar" type="hidden" class="form-control input-sm">
                                            <input id="number_of_tubesChromagar" name="number_of_tubesChromagar" type="hidden" class="form-control input-sm">
                                            <input id="id_result_chromagar_pa" name="id_result_chromagar_pa" type="hidden" class="form-control input-sm">
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

                                    <!-- <div class="form-group" id="growth_plateChromagar">
                                        <label class="col-sm-4 control-label">Growth Plate</label>
                                        <div class="col-sm-8" id="growthPlateInputsChromagar">
                                        </div>
                                    </div> -->

                                    <div class="form-group" id="purple_colony_plate_chromagar">
                                        <label class="col-sm-4 control-label"> Purple Colony Plate</label>
                                        <div class="col-sm-8" id="purpleColonyPlateInputs">
                                            <!-- Radio buttons akan dihasilkan di sini -->
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Quality Control</label>
                                        <div class="col-sm-8">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="quality_control_chromagar" name="quality_control_chromagar" value="1">
                                                    <strong>Pass</strong> <span class="text-muted">(Check if quality control passed)</span>
                                                </label>
                                                <div id="qc_chromagar_auto_notice" class="text-warning" style="display: none; margin-top: 5px;">
                                                    <small><em><i class="fa fa-info-circle"></i> Quality Control automatically set to "Not Pass" for auto-generated Chromagar results</em></small>
                                                </div>
                                            </div>
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
            <form id="formBiochemical" action="<?php echo site_url('Salmonella_pa/saveBiochemical') ?>" method="post" class="form-horizontal">
                <div class="modal-body">
                    <input id="mode_detResultsBiochemical" name="mode_detResultsBiochemical" type="hidden" class="form-control input-sm">
                    <input id="id_salmonella_paBiochemical" name="id_salmonella_paBiochemical" type="hidden" class="form-control input-sm">
                    <input id="id_result_biochemical" name="id_result_biochemical" type="hidden" class="form-control input-sm">
                    <input id="biochemical_tube" name="biochemical_tube" type="hidden" class="form-control input-sm">
                    <input id="id_result_chromagar_pa1" name="id_result_chromagar_pa1" type="hidden" class="form-control input-sm">
                    <input id="idBiochemical_one_water_sample" name="idBiochemical_one_water_sample" type="hidden" class="form-control input-sm">

                    <!-- Hidden inputs for auto-calculated values -->

                    <!-- Confirmation (Auto-calculated) -->
                    <div class="form-group">
                        <label for="confirmation" class="col-sm-4 control-label">Confirmation <small class="text-muted">(Auto-calculated)</small></label>
                        <div class="col-sm-8">
                            <input id="confirmation" name="confirmation" type="text" class="form-control" placeholder="Will be calculated automatically" readonly>
                            <small class="text-info">
                                <i class="fa fa-info-circle"></i> Value automatically determined from XLD and Chromagar results
                            </small>
                        </div>
                    </div>

                </div>
                <div class="modal-footer clearfix">
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
					<h4 class="modal-title">Salmonella PA | Information</h4>
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

    /* Styling for MPN concentration field with symbol values */
    .has-symbol-value {
        border-left: 3px solid #28a745 !important;
        background-color: rgba(40, 167, 69, 0.05) !important;
    }

    .symbol-feedback {
        background-color: rgba(40, 167, 69, 0.1);
        border: 1px solid rgba(40, 167, 69, 0.3);
        border-radius: 4px;
        padding: 5px 8px;
        margin-top: 3px;
    }

    .symbol-feedback i {
        margin-right: 4px;
    }

    /* Auto-generated Chromagar Results Visual Indicator */
    .auto-generated-chromagar {
        background-color: rgba(40, 167, 69, 0.1) !important;
        border-left: 4px solid #28a745 !important;
        position: relative;
    }

    .auto-generated-chromagar td:first-child {
        padding-left: 25px !important;
    }

    .auto-generated-chromagar:hover {
        background-color: rgba(40, 167, 69, 0.2) !important;
        cursor: help;
    }
</style>
<style>
	#textInform2 .alert {
        display: block !important;
        margin-top: 20px;
        font-size: 16px;
        z-index: 1000; /* Pastikan info card di atas elemen lain */
    }

    /* SweetAlert custom styling for wider modal */
    .swal-wide {
        width: 600px !important;
    }
    
    .swal-wide .swal2-html-container {
        text-align: left !important;
    }

    .badge1 {
        font-size: 12px;
        padding: 6px 12px;
        border-radius: 20px;
        margin-top: 0px;
        width: 80px;
        text-align: center;
        display: inline-block;
        min-width: 80px;
    }

    .badge1-success {
        background-color: #c3e6c3;
        color: #2d5a2d;
    }

    .badge1-danger {
        background-color: rgba(248, 113, 113, 0.3);
        color: #b91c1c;
    }
</style>

<!-- SweetAlert2 CSS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script>
    document.getElementById('exportBtn').addEventListener('click', function() {
        let id_salmonella_pa = document.getElementById('id_salmonella_pa').value;
        window.location.href = '<?php echo site_url('Salmonella_pa/excel') ?>/' + id_salmonella_pa;
    });
</script>
<script type="text/javascript">

    let table;
    let table1;
    let table2;
    let id_moisture = $('#id_moisture').val();
    let salmonella_assay_barcode = $('#salmonella_assay_barcode').val();
    let id_salmonella_pa = $('#id_salmonella_pa').val();
    let number_of_tubes = $('#number_of_tubes').val();
    const BASE_URL = '/limsonewater/index.php';
    let idx_one_water_sample = $('#id_one_water_sample').val();

    // Simple function to ensure Chromagar Quality Control is always enabled
    window.updateChromagarQualityControlLogic = function() {
        // Check if Chromagar modal is open
        if ($('#compose-modalChromagar').hasClass('in') || $('#compose-modalChromagar').is(':visible')) {
            const qualityControlCheckbox = $('#quality_control_chromagar');
            const qcNotice = $('#qc_chromagar_auto_notice');
            
            // Always enable Quality Control - not affected by any growth plates
            qualityControlCheckbox.prop('disabled', false);
            qcNotice.hide();
        }
    };

    $(document).ready(function() {
        // Check for flash messages from controller
        <?php if ($this->session->flashdata('message')): ?>
            let flashMessage = '<?php echo $this->session->flashdata('message'); ?>';

            if (flashMessage.includes('Chromagar Results auto-generated')) {
                // Show special notification for auto-generated Chromagar
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    // html: `
                    //     <div style="text-align: left; margin: 15px 0;">
                    //         <p><i class="fa fa-magic" style="color: #28a745; margin-right: 8px;"></i><strong>All growth plates in Results XldAgar were 0</strong></p>
                    //         <p style="margin-top: 10px;">✅ <strong>Results Chromagar has been automatically generated</strong> with all plates = 0</p>
                    //         <p style="margin-top: 10px;">🚀 This saves you time by eliminating manual Chromagar data entry when the outcome is predictable.</p>
                    //         <hr style="margin: 15px 0;">
                    //         <p style="font-size: 13px; color: #666;"><i class="fa fa-info-circle" style="color: #3498db; margin-right: 5px;"></i>You can now proceed directly to Results Biochemical if needed.</p>
                    //     </div>
                    // `,
                    confirmButtonText: '<i class="fa fa-check"></i> Got it!',
                    confirmButtonColor: '#28a745',
                    timer: 1500,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'swal-wide'
                    }
                });
            } else {
                // Show regular success message
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: flashMessage,
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        <?php endif; ?>

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
		// if (userCreated !== loggedInUser) {
		// 	$('#user_review').val(loggedInUser);

		// 	$('#review_label').off('click').on('click', function () {
		// 		if ($('#review').val() === '1') {
		// 			Swal.fire({
		// 				icon: 'info',
		// 				title: 'Review Locked',
		// 				text: 'You have already reviewed this. Further changes are not allowed.',
		// 				confirmButtonText: 'OK'
		// 			});
		// 			return;
		// 		}

		// 		Swal.fire({
		// 			icon: 'question',
		// 			title: 'Are you sure?',
		// 			showCancelButton: true,
		// 			confirmButtonText: 'OK',
		// 			cancelButtonText: 'Cancel',
		// 			reverseButtons: true
		// 		}).then((result) => {
		// 			if (result.isConfirmed) {

		// 				currentState = (currentState + 1) % states.length;

		// 				$('#review').val(states[currentState].value);
		// 				$('#review_label')
		// 					.text(states[currentState].label)
		// 					.removeClass()
		// 					.addClass('form-check-label ' + states[currentState].class);

		// 				$.ajax({
		// 					url: '<?php echo site_url("Salmonella_pa/saveReview"); ?>',
		// 					method: 'POST',
		// 					data: $('#formSampleReview').serialize(),
		// 					dataType: 'json',
		// 					success: function(response) {
		// 						if (response.status) {
		// 							Swal.fire({
		// 								icon: 'success',
		// 								title: 'Review saved successfully!',
		// 								text: response.message,
		// 								timer: 1000,
		// 								showConfirmButton: false
		// 							}).then(() => {
		// 								location.reload();
		// 							});
		// 						} else {
		// 							Swal.fire({
		// 								icon: 'error',
		// 								title: 'Failed to save review',
		// 								text: response.message
		// 							});
		// 						}
		// 					},
		// 					error: function(xhr, status, error) {
		// 						console.error('AJAX Error: ' + status + error);
		// 						Swal.fire('Error', 'Something went wrong during submission.', 'error');
		// 					}
		// 				});
		// 			} else {
		// 				Swal.fire({
		// 					icon: 'info',
		// 					title: 'Review Not Changed',
		// 					text: 'No changes were made.',
		// 					timer: 2000
		// 				});
		// 			}
		// 		});
		// 	});

		// 	if ($('#review').val() === '1') {
		// 		showInfoCard(
		// 			'#textInform2',
		// 			'<i class="fa fa-times-circle"></i> You are not the creator',
		// 			"In this case, you can't review because it has already been reviewed.",

		// 			false
		// 		);
		// 	} else {
		// 		showInfoCard(
		// 			'#textInform2',
		// 			'<i class="fa fa-times-circle"></i> You are not the creator',
		// 			"In this case, you can review this data. Hover over the box on the right side to start the review.",
		// 			false
		// 		);

		// 	}

		// 	$('#review_label')
		// 	.on('mouseenter', function() {
		// 		if ($('#review').val() !== '1') { 
		// 			$(this).text('Review')
		// 				.addClass('review-border');
		// 		}
		// 	})
		// 	.on('mouseleave', function() {
		// 		if ($('#review').val() !== '1') { 
		// 			$(this).text('Unreview')
		// 				.removeClass('review-border');
		// 		}
		// 	});


		// 	$('#saveButtonDetail').prop('disabled', false);
		// } else {
		// 	$('#user_review').val(loggedInUser);

		// 	showInfoCard(
		// 		'#textInform2',
		// 		'<i class="fa fa-check-circle"></i> You are the creator',
		// 		"You have full access to edit this data but not review.",
		// 		true
		// 	);

		// 	$('#saveButtonDetail').prop('disabled', true);
		// }

		// Configuration based on user role
		const isCreator = userCreated === loggedInUser;
		const canReview = !isCreator;
		
		// Set user review value
		$('#user_review').val(loggedInUser);
		
		// Configure UI based on user role
		configureUserInterface(isCreator, canReview);
		
		// Setup review click handler (common for both creator and non-creator)
		setupReviewClickHandler();
		
		// Setup hover effects for review label
		setupReviewHoverEffects();
		
		/**
		 * Configure UI elements based on user role
		 */
		function configureUserInterface(isCreator, canReview) {
			if (canReview) {
				// Non-creator: Can review
				const reviewStatus = $('#review').val();
				const message = reviewStatus === '1' 
					? "In this case, you can't review because it has already been reviewed."
					: "In this case, you can review this data. Hover over the box on the right side to start the review.";
				
				showInfoCard(
					'#textInform2',
					'<i class="fa fa-times-circle"></i> You are not the creator',
					message,
					false
				);
				
				$('#saveButtonDetail').prop('disabled', false);
			} else {
				// Creator: Cannot review
				showInfoCard(
					'#textInform2',
					'<i class="fa fa-check-circle"></i> You are the creator',
					// "You have full access to edit this data but not review.",
					"You have full access to edit this data and review.",
					true
				);
				
				$('#saveButtonDetail').prop('disabled', true);
			}
		}
		
		/**
		 * Setup click handler for review label
		 */
		function setupReviewClickHandler() {
			$('#review_label').off('click').on('click', function () {
				// Check if review is already locked
				if ($('#review').val() === '1') {
					showReviewLockedAlert();
					return;
				}
				
				// Show confirmation dialog
				showReviewConfirmation();
			});
		}
		
		/**
		 * Setup hover effects for review label
		 */
		function setupReviewHoverEffects() {
			$('#review_label')
				.on('mouseenter', function() {
					if ($('#review').val() !== '1') { 
						$(this).text('Review').addClass('review-border');
					}
				})
				.on('mouseleave', function() {
					if ($('#review').val() !== '1') { 
						$(this).text('Unreview').removeClass('review-border');
					}
				});
		}
		
		/**
		 * Show review locked alert
		 */
		function showReviewLockedAlert() {
			Swal.fire({
				icon: 'info',
				title: 'Review Locked',
				text: 'You have already reviewed this. Further changes are not allowed.',
				confirmButtonText: 'OK'
			});
		}
		
		/**
		 * Show review confirmation dialog
		 */
		function showReviewConfirmation() {
			Swal.fire({
				icon: 'question',
				title: 'Are you sure?',
				showCancelButton: true,
				confirmButtonText: 'OK',
				cancelButtonText: 'Cancel',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					processReviewUpdate();
				} else {
					showReviewCancelledAlert();
				}
			});
		}
		
		/**
		 * Process review update
		 */
		function processReviewUpdate() {
			// Update current state
			currentState = (currentState + 1) % states.length;
			
			// Update UI elements
			updateReviewUI();
			
			// Save review via AJAX
			saveReviewData();
		}
		
		/**
		 * Update review UI elements
		 */
		function updateReviewUI() {
			$('#review').val(states[currentState].value);
			$('#review_label')
				.text(states[currentState].label)
				.removeClass()
				.addClass('form-check-label ' + states[currentState].class);
		}
		
		/**
		 * Save review data via AJAX
		 */
		function saveReviewData() {
			$.ajax({
				url: '<?php echo site_url('Salmonella_pa/saveReview'); ?>',
				method: 'POST',
				data: $('#formSampleReview').serialize(),
				dataType: 'json',
				success: handleReviewSaveSuccess,
				error: handleReviewSaveError
			});
		}
		
		/**
		 * Handle successful review save
		 */
		function handleReviewSaveSuccess(response) {
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
		}
		
		/**
		 * Handle review save error
		 */
		function handleReviewSaveError(xhr, status, error) {
			console.error('AJAX Error: ' + status + error);
			Swal.fire('Error', 'Something went wrong during submission.', 'error');
		}
		
		/**
		 * Show review cancelled alert
		 */
		function showReviewCancelledAlert() {
			Swal.fire({
				icon: 'info',
				title: 'Review Not Changed',
				text: 'No changes were made.',
				timer: 2000
			});
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
                    url: '<?php echo site_url("Salmonella_pa/cancelReview"); ?>',
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


    // Function to automatically calculate confirmation based on XLD and Chromagar results
    function calculateBiochemicalConfirmation() {
        const id_salmonella_pa = $('#id_salmonella_pa').val();
        
        if (!id_salmonella_pa) {
            console.warn('No Salmonella PA ID found');
            return;
        }

        // Fetch XLD and Chromagar results via AJAX
        $.ajax({
            url: '<?php echo site_url("Salmonella_pa/getBiochemicalData"); ?>',
            method: 'POST',
            data: { id_salmonella_pa: id_salmonella_pa },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Apply business rules for confirmation
                    let confirmationValue = '';
                    
                    const xldBlackColony = parseInt(response.xld_black_colony) || 0;
                    const chromPurpleColony = parseInt(response.chrom_purple_colony) || 0;
                    
                    console.log(`XLD Black Colony: ${xldBlackColony}, Chromagar Purple Colony: ${chromPurpleColony}`);
                    
                    // Business rules based on user requirements:
                    if (xldBlackColony === 0 && chromPurpleColony === 0) {
                        confirmationValue = 'Not Salmonella';
                    } else if (xldBlackColony === 1 && chromPurpleColony === 0) {
                        confirmationValue = 'Not Salmonella';
                    } else if (xldBlackColony === 0 && chromPurpleColony === 1) {
                        confirmationValue = 'Not Salmonella';
                    } else if (xldBlackColony === 1 && chromPurpleColony === 1) {
                        confirmationValue = 'Salmonella';
                    } else {
                        // Default case - unexpected values
                        confirmationValue = 'Not Salmonella';
                    }
                    
                    // Set the calculated values
                    $('#confirmation').val(confirmationValue);
                    
                    // Show info to user
                    const infoText = `Auto-calculated based on XLD (${xldBlackColony}) and Chromagar (${chromPurpleColony}) results`;
                    $('#confirmation').next('small').html(`<i class="fa fa-info-circle"></i> ${infoText}`);
                    
                } else {
                    console.error('Failed to fetch biochemical data:', response.message);
                    $('#confirmation').val('');
                    $('#confirmation').next('small').html('<i class="fa fa-exclamation-triangle"></i> Unable to auto-calculate. Please check XLD and Chromagar results.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
                $('#confirmation').val('');
                $('#confirmation').next('small').html('<i class="fa fa-exclamation-triangle"></i> Error fetching data for auto-calculation.');
            }
        });
    }

    // Function to update confirmation options based on XLD Agar and Chromagar values
    function updateConfirmationOptions(xldValue, chromagarValue) {
        const confirmationContainer = $('#confirmation-options');
        confirmationContainer.empty(); // Clear existing options
        
        // Convert string values to integers for comparison
        const xld = parseInt(xldValue) || 0;
        const chromagar = parseInt(chromagarValue) || 0;
        
        console.log(`Updating confirmation options: XLD Agar=${xld}, Chromagar=${chromagar}`);
        
        if (xld === 0 && chromagar === 0) {
            // XLD Agar = 0, Chromagar = 0 → checkbox with "Not Salmonella" option only
            confirmationContainer.html(`
                <label class="checkbox-inline">
                    <input type="checkbox" name="confirmation" value="Not Salmonella" required> Not Salmonella
                </label>
            `);
        } else if (xld === 1 && chromagar === 0) {
            // XLD Agar = 1, Chromagar = 0 → checkbox with "Not Salmonella" option only
            confirmationContainer.html(`
                <label class="checkbox-inline">
                    <input type="checkbox" name="confirmation" value="Not Salmonella" required> Not Salmonella
                </label>
            `);
        } else if (xld === 1 && chromagar === 1) {
            // XLD Agar = 1, Chromagar = 1 → checkbox with "Salmonella" option only
            confirmationContainer.html(`
                <label class="checkbox-inline">
                    <input type="checkbox" name="confirmation" value="Salmonella" required> Salmonella
                </label>
            `);
        } else {
            // Unexpected case - log for debugging and default to "Not Salmonella"
            console.warn(`Unexpected XLD Agar/Chromagar combination: XLD Agar=${xld}, Chromagar=${chromagar}. Defaulting to "Not Salmonella"`);
            confirmationContainer.html(`
                <label class="checkbox-inline">
                    <input type="checkbox" name="confirmation" value="Not Salmonella" required> Not Salmonella
                </label>
            `);
        }
    }

        // function generateGrowthPlateInputs(container, numberOfTubes) {
        //     container.empty(); // Clear existing inputs

        //     // Create the required number of inputs and labels
        //     for (let i = 1; i <= numberOfTubes; i++) {
        //         container.append(
        //             `<div class="d-flex align-items-center mb-2" style="gap: 12px;">
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

        // $('#number_of_tubes').change(function() {
        //     let numberOfTubes = parseInt($(this).val()); // Get the selected value as an integer
        //     generateGrowthPlateInputs($('#growthPlateInputs'), numberOfTubes);
        //     generateGrowthPlateInputs($('#growthPlateInputsChromagar'), numberOfTubes);
        // }).trigger('change');

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
        $(document).on('click', '.btn_deleteXldAgar, .btn_deleteChromagar, .btn_deleteBiochemical', function() {
            let id = $(this).data('id');
            let url;
            if ($(this).hasClass('btn_deleteXldAgar')) {
                url = '<?php echo site_url('Salmonella_pa/delete_detailXldAgar'); ?>/' + id;
                $('.modal-title').html('<i class="fa fa-trash"></i> Result XldAgar | Delete <span id="my-another-cool-loader"></span>');
                $('#confirm-modal-delete #id').text(id);

                // Add warning about cascade delete for XldAgar
                $('#confirm-modal-delete .modal-body').html(
                    '<p><strong>⚠️ Critical Warning:</strong> Deleting this XldAgar result will also delete ALL related data including:</p>' +
                    '<ul style="margin: 10px 0; padding-left: 20px;">' +
                    '<li><strong>All Chromagar results</strong> associated with this sample</li>' +
                    '<li><strong>All Biochemical test results</strong> related to those Chromagar results</li>' +
                    '</ul>' +
                    '<p style="color: #dc3545;"><strong>This action cannot be undone and will remove the entire data chain!</strong></p>' +
                    '<p>Are you sure you want to delete Result XldAgar <strong>' + id + '</strong> and all its related data?</p>'
                );
            } else if ($(this).hasClass('btn_deleteChromagar')) {
                url = '<?php echo site_url('Salmonella_pa/delete_detailChromagar'); ?>/' + id;
                $('.modal-title').html('<i class="fa fa-trash"></i> Result Chromagar | Delete <span id="my-another-cool-loader"></span>');
                $('#confirm-modal-delete #id').text(id);
                
                // Add warning about cascade delete
                $('#confirm-modal-delete .modal-body').html(
                    '<p><strong>⚠️ Warning:</strong> Deleting this Chromagar result will also delete all related Biochemical test results to maintain data integrity.</p>' +
                    '<p>This action cannot be undone. Are you sure you want to delete Result Chromagar <strong>' + id + '</strong> and all its related data?</p>'
                );
            } else if ($(this).hasClass('btn_deleteBiochemical')) {
                url = '<?php echo site_url('Salmonella_pa/delete_detailBiochemical'); ?>/' + id;
                $('.modal-title').html('<i class="fa fa-trash"></i> Result Biochemical | Delete <span id="my-another-cool-loader"></span>');
                $('#confirm-modal-delete #id').text(id);
                
                // Reset modal body to default
                $('#confirm-modal-delete .modal-body').html(
                    '<p>Are you sure you want to delete Result Biochemical <strong>' + id + '</strong>?</p>'
                );
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

        $('#compose-modalChromagar').on('shown.bs.modal', function () {
            $('.val2tip').tooltipster('hide');

            // Update Quality Control logic when Chromagar modal is shown (only for edit mode)
            if (typeof window.updateChromagarQualityControlLogic === 'function') {
                window.updateChromagarQualityControlLogic();
            }
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
            ajax: {"url": "../../Salmonella_pa/subjsonXldAgar?idXldAgar="+id_salmonella_pa, "type": "POST"},
            columns: [
                {"data": "salmonella_assay_barcode"},
                {"data": "date_sample_processed"},
                {"data": "time_sample_processed"},
                {"data": "black_colony_plate"},
                {
                    "data": "quality_control",
                    "render": function(data, type, row) {
                        return data == '1' ? '<span class="badge1 badge1-success"><i class="fa fa-check"></i></span>' : '<span class="badge1 badge1-danger"><i class="fa fa-times"></i></span>';
                    },
                    "className": "text-center"
                },
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
                    $('#addtombol_detResultsXldAgar').prop("disabled", true);
                } else {
                    $('#addtombol_detResultsXldAgar').show();
                }
            },
            drawCallback: function(settings) {
                // This function is called every time the table is redrawn
                window.xldAgarDataChanged = true;
                
                // Auto-processing: Check if all XLD Agar results are 0 for auto-ChroMagar processing
                let hasData = settings.json && settings.json.data && settings.json.data.length > 0;
                if (hasData) {
                    let data = settings.json.data[0]; // Get first (and likely only) row
                    if (data && data.black_colony_plate) {
                        const blackColonyArray = data.black_colony_plate.split(', ');
                        const allZero = blackColonyArray.every(value => value === '0');
                        
                        if (allZero) {
                            console.log('Auto-processing: All XLD Agar results are 0 - ChroMagar will be auto-saved');
                            // Note: The actual auto-save logic should be implemented in the backend
                            // when ChroMagar button is clicked or when saving XLD Agar data
                        }
                    }
                }
                
                console.log('XLD Agar table updated - auto-processing handles biochemical results');
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
            ajax: {"url": "../../Salmonella_pa/subjsonChromagar?idChromagar="+id_salmonella_pa, "type": "POST"},
            columns: [
                {"data": "salmonella_assay_barcode"},
                {"data": "date_sample_processed"},
                {"data": "time_sample_processed"},
                {"data": "purple_colony_plate"},
                {
                    "data": "quality_control",
                    "render": function(data, type, row) {
                        if (data == '1') {
                            return '<span class="badge1 badge1-success"><i class="fa fa-check"></i></span>';
                        } else {
                            return '<span class="badge1 badge1-danger"><i class="fa fa-times"></i></span>';
                        }
                    },
                    "className": "text-center"
                },
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
                    // Check if all XLD Agar results are 0 to decide if button should be available
                    let tdXld = $('#example2 td:first');
                    let dataXld = table.row(tdXld).data();
                    
                    if (dataXld && dataXld.black_colony_plate) {
                        const xldArray = dataXld.black_colony_plate.split(', ');
                        const allZero = xldArray.every(value => value === '0');
                        
                        if (allZero) {
                            // If all XLD Agar are 0, disable button as auto-save will handle it
                            $('#addtombol_detResultsChromagar').prop("disabled", true);
                            $('#addtombol_detResultsChromagar').attr('title', 'Auto-processing: ChroMagar automatically saved (all XLD Agar results are 0)');
                        } else {
                            $('#addtombol_detResultsChromagar').prop("disabled", false);
                            $('#addtombol_detResultsChromagar').attr('title', 'Add new ChroMagar data');
                        }
                    } else {
                        $('#addtombol_detResultsChromagar').show();
                    }
                }
            },
            drawCallback: function(settings) {
                // Auto-processing: No button status checks needed
                console.log('ChroMagar table updated - auto-processing handles biochemical results');
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
                const purpleColonyPlateInputs = data.purple_colony_plate.split(', ');
                const plateNumberArray = data.plate_number.split(', ');

                // Get XLD Agar data as well
                let tdXld = $('#example2 td:first');
                let dataXld = table.row(tdXld).data();
                
                let blackColonyPlateArray = [];
                if (dataXld && dataXld.black_colony_plate) {
                    blackColonyPlateArray = dataXld.black_colony_plate.split(', ');
                }

                // Auto-processing: Biochemical results are now generated automatically after ChroMagar save
                // No manual entry needed - results will be available in Final Concentration
                console.log('Biochemical results will be auto-generated after ChroMagar save');
            } else {
                console.log('Data belum tersedia');
                // No manual biochemical entry needed with auto-processing
            }
        });

        // Improved generateResultBiochemical function
        function generateResultBiochemical(container, numberOfPlates, id_salmonella_pa, plateNumberArray, purpleColonyPlateInputs, blackColonyPlateArray = []) {
            container.empty(); // Clear existing content

            // Get user level from PHP session
            const userLevel = <?php echo $this->session->userdata('id_user_level'); ?>;

            // Iterate through the plateNumberArray
            for (let i = 0; i < numberOfPlates; i++) {
                const plateNumber = plateNumberArray[i]; // Get the corresponding plate number
                const tableId = `exampleBiochemical_${i}`; // Unique table ID
                const buttonId = `addtombol_detResultsBiochemical_${plateNumber}`; // Unique button ID
                
                // Get XLD Agar and Chromagar values for this plate
                const xldValue = blackColonyPlateArray[i] || '0';
                const chromagarValue = purpleColonyPlateInputs[i] || '0';
                
                // Determine button HTML based on user level and growth plate status
                let buttonHtml = '';
                if (userLevel != 4) { // Level 1-3 can see buttons
                    // Tombol tetap aktif berdasarkan instruksi baru
                    const isDisabled = ''; // Semua tombol tetap aktif
                    buttonHtml = `<button class="btn btn-primary" id="${buttonId}" data-index="${plateNumber}" data-xld="${xldValue}" data-chromagar="${chromagarValue}" ${isDisabled}>
                                    <i class="fa fa-wpforms" aria-hidden="true"></i> Biochemical Tube ${plateNumber}
                                  </button>`;
                } // Level 4 (read-only) gets no button (buttonHtml remains empty)
                
                console.log(`Plate ${plateNumber}: XLD Agar=${xldValue}, Chromagar=${chromagarValue}`);

                // Append the table and button for each plate
                container.append(`
                    <div class="box-body pad table-responsive">
                        ${buttonHtml}
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
                initializeDataTable(tableId, id_salmonella_pa, plateNumber); // Pass the actual plate number
            }
        }


        // Fungsi untuk menginisialisasi DataTable
        function initializeDataTable(tableId, id_salmonella_pa, tubeIndex) {
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
                    url: `../../Salmonella_pa/subjsonBiochemical?idBiochemical=${id_salmonella_pa}&biochemical_tube=${tubeIndex}`,
                    type: "POST"
                },
                columns: [
                    {"data": "confirmation"},
                    // {"data": "biochemical_tube"},
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
            // const xldValue = $(this).data('xld'); // Get XLD Agar value
            // const chromagarValue = $(this).data('chromagar'); // Get Chromagar value
            
            // Always get fresh data from tables instead of using potentially stale button data
            let xldValue = '0';
            let chromagarValue = '0';
            
            // Get fresh Chromagar data
            let tdChromagar = $('#exampleChromagar td:first');
            let dataChromagar = table1.row(tdChromagar).data();
            
            // Get fresh XLD Agar data
            let tdXld = $('#example2 td:first');
            let dataXld = table.row(tdXld).data();
            
            if (dataChromagar && dataChromagar.purple_colony_plate) {
                const purpleColonyPlateArray = dataChromagar.purple_colony_plate.split(', ');
                const plateNumberArray = dataChromagar.plate_number.split(', ');
                const tubeIndex = plateNumberArray.indexOf(plateNumber.toString());
                if (tubeIndex !== -1) {
                    chromagarValue = purpleColonyPlateArray[tubeIndex] || '0';
                }
            }
            
            if (dataXld && dataXld.black_colony_plate) {
                const blackColonyPlateArray = dataXld.black_colony_plate.split(', ');
                const plateNumberArray = dataXld.plate_number.split(', ');
                const tubeIndex = plateNumberArray.indexOf(plateNumber.toString());
                if (tubeIndex !== -1) {
                    xldValue = blackColonyPlateArray[tubeIndex] || '0';
                }
            }
            
            let td = $('#exampleChromagar td:first');
            let data = table1.row(td).data();
            console.log('datanya', data.id_result_chromagar_pa);
            console.log(`Tube ${plateNumber}: XLD Agar=${xldValue}, Chromagar=${chromagarValue}`);

            $('#mode_detResultsBiochemical').val('insert');
            $('#modal-title-biochemical').html(`<i class="fa fa-wpforms"></i> Insert | Biochemical Tube ${plateNumber} <span id="my-another-cool-loader"></span>`);
            $('#idBiochemical_one_water_sample').val(idx_one_water_sample);
            $('#id_salmonella_paBiochemical').val(id_salmonella_pa);
            $('#id_result_chromagar_pa1').val(data.id_result_chromagar_pa);
            $('#biochemical_tube').val(plateNumber);
            
            // Update confirmation options based on XLD Agar and Chromagar values
            updateConfirmationOptions(xldValue, chromagarValue);
            
            $('#compose-modalBiochemical').modal('show');
            console.log(`Button for Biochemical Tube: ${plateNumber} clicked`);
        });


        // Event listener untuk tombol edit
        $(document).on('click', '.btn_edit_detResultsBiochemical', function() {
            let tr = $(this).closest('tr'); // Dapatkan elemen baris
            let tableId = $(this).closest('.box-body').find('table').attr('id'); // Dapatkan ID tabel dari konteks
            let data = $(`#${tableId}`).DataTable().row(tr).data(); // Dapatkan data dari DataTable yang sesuai
            console.log(data);

            // Get XLD Agar and Chromagar values for this tube
            let tubeNumber = data.biochemical_tube;
            let xldValue = '0';
            let chromagarValue = '0';
            
            // Always get fresh data from tables for consistency
            let tdChromagar = $('#exampleChromagar td:first');
            let dataChromagar = table1.row(tdChromagar).data();
            let tdXld = $('#example2 td:first');
            let dataXld = table.row(tdXld).data();
            
            if (dataChromagar && dataChromagar.purple_colony_plate) {
                const purpleColonyPlateArray = dataChromagar.purple_colony_plate.split(', ');
                const plateNumberArray = dataChromagar.plate_number.split(', ');
                const tubeIndex = plateNumberArray.indexOf(tubeNumber.toString());
                if (tubeIndex !== -1) {
                    chromagarValue = purpleColonyPlateArray[tubeIndex] || '0';
                }
            }
            
            if (dataXld && dataXld.black_colony_plate) {
                const blackColonyPlateArray = dataXld.black_colony_plate.split(', ');
                const plateNumberArray = dataXld.plate_number.split(', ');
                const tubeIndex = plateNumberArray.indexOf(tubeNumber.toString());
                if (tubeIndex !== -1) {
                    xldValue = blackColonyPlateArray[tubeIndex] || '0';
                }
            }

            // Set nilai-nilai di dalam modal sesuai data yang didapat
            $('#mode_detResultsBiochemical').val('edit');
            $('#modal-title-biochemical').html('<i class="fa fa-pencil-square"></i> Update | Biochemical Tube ' + data.biochemical_tube + ' <span id="my-another-cool-loader"></span>');
            $('#idBiochemical_one_water_sample').val(idx_one_water_sample);
            $('#id_result_biochemical_pa').val(data.id_result_biochemical_pa);
            $('#id_salmonella_paBiochemical').val(data.id_salmonella_pa);
            $('#id_result_chromagar_pa1').val(data.id_result_chromagar_pa);
            
            // Update confirmation options based on XLD Agar and Chromagar values
            updateConfirmationOptions(xldValue, chromagarValue);
            
            // Set the confirmation value after updating the options
            setTimeout(function() {
                if (data.confirmation) {
                    $('input[name="confirmation"][value="' + data.confirmation + '"]').prop('checked', true);
                }
            }, 100);

            // Tampilkan modal untuk edit
            $('#compose-modalBiochemical').modal('show');
        });





        $('#addtombol_detResultsXldAgar').click(function() {
            $('#mode_detResultsXldAgar').val('insert');
            $('#modal-title-detail').html('<i class="fa fa-wpforms"></i> Insert | Results XldAgar <span id="my-another-cool-loader"></span>');
            $('#idXldAgar_one_water_sample').val(idx_one_water_sample);
            $('#salmonella_assay_barcode1').val(salmonella_assay_barcode);
            $('#salmonella_assay_barcode1').attr('readonly', true);
            $('#id_salmonella_pa1').val(id_salmonella_pa);
            $('#number_of_tubes1').val(number_of_tubes);

            // Reset quality control checkbox for new record
            $('#quality_control').prop('checked', false);

            $('#compose-modal').modal('show');
        });

        $('#example2').on('click', '.btn_edit_detResultsXldAgar', function() {
            let tr = $(this).closest('tr');
            let data = table.row(tr).data();
            console.log(data);
            $('#mode_detResultsXldAgar').val('edit');
            $('#modal-title-detail').html('<i class="fa fa-pencil-square"></i> Update | Results XldAgar <span id="my-another-cool-loader"></span>');
            $('#idXldAgar_one_water_sample').val(idx_one_water_sample);
            $('#id_result_xld_agar_pa').val(data.id_result_xld_agar_pa);
            $('#salmonella_assay_barcode1').val(data.salmonella_assay_barcode);
            $('#salmonella_assay_barcode1').attr('readonly', true);
            $('#id_salmonella_pa1').val(data.id_salmonella_pa);
            $('#date_sample_processed1').val(data.date_sample_processed);
            $('#time_sample_processed1').val(data.time_sample_processed);
            $('#number_of_tubes1').val(number_of_tubes);

            // Set quality control checkbox
            $('#quality_control').prop('checked', data.quality_control == '1');

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
                        <label class="control-label me-3" style="margin-bottom: 0; line-height: 1.5;">Black Colony ${plateNumber}:</label>
                        <div class="d-flex align-items-center">
                            <label class="radio-inline me-2" style="margin-bottom: 0;">
                                <input type="radio" id="black_colony_plate${plateNumber}" name="black_colony_plate${plateNumber}" value="1" ${checkedYes}> Yes
                            </label>
                            <label class="radio-inline" style="margin-bottom: 0;">
                                <input type="radio" id="black_colony_plate${plateNumber}" name="black_colony_plate${plateNumber}" value="0" ${checkedNo}> No
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
            console.log(data);

            if (data && data.salmonella_assay_barcode) {
                let salmonella_assay_barcode = data.salmonella_assay_barcode;
                const purpleColonyPlateArray = data.black_colony_plate.split(', ');
                
                // Check if XLD Agar results are all zero
                const allZero = purpleColonyPlateArray.every(value => value === '0');

                if (allZero) {
                    // Show information that ChroMagar will be auto-saved
                    Swal.fire({
                        title: 'Auto-Processing Enabled',
                        html: `
                            <div style="text-align: left; margin-top: 15px;">
                                <p><i class="fa fa-info-circle" style="color: #3498db; margin-right: 8px;"></i><strong>All XLD Agar results are 0 (zero).</strong></p>
                                <p style="margin-top: 10px;">ChroMagar results will be automatically saved with value 0 for all tubes.</p>
                                <hr style="margin: 15px 0;">
                                <p style="font-size: 13px; color: #666;"><i class="fa fa-magic" style="color: #9b59b6; margin-right: 5px;"></i>Auto-processing: <strong>No manual input required</strong></p>
                            </div>
                        `,
                        icon: 'info',
                        confirmButtonText: '<i class="fa fa-check"></i> I Understand',
                        confirmButtonColor: '#3498db',
                        customClass: {
                            popup: 'swal-wide'
                        }
                    });
                    return; // Don't show the modal
                }

                // Parsing data ke komponen
                $('#idChromagar_one_water_sample').val(idx_one_water_sample);
                $('#salmonella_assay_barcodeChromagar').val(salmonella_assay_barcode);
                $('#id_salmonella_paChromagar').val(id_salmonella_pa);
                $('#salmonella_assay_barcodeChromagar').attr('readonly', true);
                $('#number_of_tubesChromagar').val(number_of_tubes);

                // Reset quality control checkbox for new record
                $('#quality_control_chromagar').prop('checked', false);
                $('#quality_control_chromagar').prop('disabled', false);
                $('#qc_chromagar_auto_notice').hide();

                // Clear existing purpleColonyPlateInputs
                let purpleColonyPlateInputs = $('#purpleColonyPlateInputs');
                purpleColonyPlateInputs.empty();

                // split the string into an array
                const plateNumberArray = data.plate_number.split(', ');

                // console.log('purpleColonyPlateArray:', purpleColonyPlateArray);
                // console.log('plateNumberArray:', plateNumberArray);

                // making the input base on the plate number
                plateNumberArray.forEach((plateNumber, index) => {
                    const plate = purpleColonyPlateArray[index] || '';

                    // decide the value radio selected
                    const checkedYes = plate === '1' ? 'checked' : '';
                    const checkedNo = plate === '0' ? 'checked' : '';
                    const disabled = plate === '0' ? 'disabled' : '';

                    purpleColonyPlateInputs.append(
                      `<div class="d-flex align-items-center mb-2">
                            <label class="control-label me-3" style="margin-bottom: 0; line-height: 1.5;">Purple Colony Plate ${plateNumber}:</label>
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

                // Quality Control is always enabled for Chromagar
                const qualityControlCheckbox = $('#quality_control_chromagar');
                const qcNotice = $('#qc_chromagar_auto_notice');

                // Always enable Quality Control - not affected by XldAgar growth plates
                qualityControlCheckbox.prop('disabled', false);
                qcNotice.hide();

                $('#compose-modalChromagar').modal('show');
            } else {
                // Tampilkan modal konfirmasi
                $('#confirm-modal').modal('show');
                // Tambahkan pesan ke modal
                $('#confirm-modal .modal-body').html('<p class="text-center" style="font-size: 15px;">You have not filled in the Result XldAgar. Please fill in that data first.</p>');
            }
        });
        

        $('#exampleChromagar').on('click', '.btn_edit_detResultsChromagar', function() {
            let tr = $(this).closest('tr');
            let data = table1.row(tr).data();
            console.log(data);
            $('#mode_detResultsChromagar').val('edit');
            $('#modal-title-Chromagar').html('<i class="fa fa-pencil-square"></i> Update | Results Chromagar <span id="my-another-cool-loader"></span>');
            $('#idChromagar_one_water_sample').val(idx_one_water_sample);
            $('#id_result_chromagar_pa').val(data.id_result_chromagar_pa);
            $('#salmonella_assay_barcodeChromagar').val(data.salmonella_assay_barcode);
            $('#salmonella_assay_barcodeChromagar').attr('readonly', true);
            $('#id_salmonella_paChromagar').val(data.id_salmonella_pa);
            $('#date_sample_processedChromagar').val(data.date_sample_processed);
            $('#time_sample_processedChromagar').val(data.time_sample_processed);
            $('#number_of_tubesChromagar').val(number_of_tubes);

            // Set quality control checkbox
            $('#quality_control_chromagar').prop('checked', data.quality_control == '1');

            // Clear existing purpleColonyPlateInputs
            let purpleColonyPlateInputs = $('#purpleColonyPlateInputs');
            purpleColonyPlateInputs.empty();

            // split the string into an array
            const purpleColonyPlateArray = data.purple_colony_plate.split(', ');
            const plateNumberArray = data.plate_number.split(', ');

            // making the input base on the plate number
            plateNumberArray.forEach((plateNumber, index) => {
                const plate = purpleColonyPlateArray[index] || '';

                // decide the value radio selected
                const checkedYes = plate === '1' ? 'checked' : '';
                const checkedNo = plate === '0' ? 'checked' : '';
                const disabled = plate === '0' ? 'disabled' : '';

                purpleColonyPlateInputs.append(
                    `<div class="d-flex align-items-center mb-2">
                        <label class="control-label me-3" style="margin-bottom: 0; line-height: 1.5;">Purple Colony Plate ${plateNumber}:</label>
                        <div class="d-flex align-items-center">
                            <input type="hidden" name="purple_colony_plate${plateNumber}" value="${plate}">
                            <label class="radio-inline me-2" style="margin-bottom: 0;">
                                <input type="radio" id="purple_colony_plate${plateNumber}" name="purple_colony_plate${plateNumber}" value="1" ${checkedYes}> Yes
                            </label>
                            <label class="radio-inline" style="margin-bottom: 0;">
                                <input type="radio" id="purple_colony_plate${plateNumber}"  name="purple_colony_plate${plateNumber}" value="0" ${checkedNo}> No
                            </label>
                        </div>
                    </div>`
                );
            });

            // Quality Control is always enabled - not affected by growth plates
            const qualityControlCheckbox = $('#quality_control_chromagar');
            const qcNotice = $('#qc_chromagar_auto_notice');

            qualityControlCheckbox.prop('disabled', false);
            qcNotice.hide();

            $('#compose-modalChromagar').modal('show');
        });

        // Auto-processing: biochemical results are automatically handled by the system
        setTimeout(function() {
            console.log('Page loaded - auto-processing system is active for biochemical results');
            
            // Check if auto-save notification exists and reload tables if needed
            if ($('.alert-success:contains("Auto-Processing Complete")').length > 0) {
                console.log('Auto-save detected - reloading tables');
                table.ajax.reload();
                table1.ajax.reload();
            }
        }, 1000); // Small delay to ensure tables are loaded

        // Event listener for biochemical modal shown event
        $('#compose-modalBiochemical').on('shown.bs.modal', function () {
            console.log('Biochemical modal opened - calculating confirmation automatically');
            calculateBiochemicalConfirmation();
        });

        // Event listener for manual biochemical auto-generation trigger
        // $('#autoGenerateBiochemical').on('click', function() {
        //     const id_salmonella_pa = $('#id_salmonella_pa').val();
            
        //     if (!id_salmonella_pa) {
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Error',
        //             text: 'No Salmonella PA ID found'
        //         });
        //         return;
        //     }

        //     Swal.fire({
        //         icon: 'question',
        //         title: 'Auto-Generate Biochemical Results?',
        //         html: `
        //             <div style="text-align: left; margin: 15px 0;">
        //                 <p>This will automatically generate biochemical results based on:</p>
        //                 <ul style="margin: 10px 0; padding-left: 20px;">
        //                     <li><strong>XLD Black Colony results</strong></li>
        //                     <li><strong>Chromagar Purple Colony results</strong></li>
        //                 </ul>
        //                 <p>The confirmation value will be calculated according to the business rules.</p>
        //                 <hr style="margin: 15px 0;">
        //                 <p style="font-size: 13px; color: #666;"><i class="fa fa-info-circle"></i> This will create or update the biochemical record automatically.</p>
        //             </div>
        //         `,
        //         showCancelButton: true,
        //         confirmButtonText: '<i class="fa fa-magic"></i> Generate',
        //         cancelButtonText: 'Cancel',
        //         confirmButtonColor: '#28a745',
        //         customClass: {
        //             popup: 'swal-wide'
        //         }
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             // Show loading
        //             Swal.fire({
        //                 title: 'Generating...',
        //                 text: 'Please wait while biochemical results are being generated',
        //                 allowOutsideClick: false,
        //                 showConfirmButton: false,
        //                 willOpen: () => {
        //                     Swal.showLoading();
        //                 }
        //             });

        //             $.ajax({
        //                 url: '<?php echo site_url("Salmonella_pa/triggerBiochemicalAutoGeneration"); ?>',
        //                 method: 'POST',
        //                 data: { id_salmonella_pa: id_salmonella_pa },
        //                 dataType: 'json',
        //                 success: function(response) {
        //                     Swal.close();
                            
        //                     if (response.success) {
        //                         Swal.fire({
        //                             icon: 'success',
        //                             title: 'Success!',
        //                             text: response.message,
        //                             timer: 3000,
        //                             showConfirmButton: true
        //                         }).then(() => {
        //                             // Reload the page to show updated results
        //                             window.location.reload();
        //                         });
        //                     } else {
        //                         Swal.fire({
        //                             icon: 'warning',
        //                             title: 'Cannot Generate',
        //                             text: response.message,
        //                             confirmButtonText: 'OK'
        //                         });
        //                     }
        //                 },
        //                 error: function(xhr, status, error) {
        //                     Swal.close();
        //                     Swal.fire({
        //                         icon: 'error',
        //                         title: 'Error',
        //                         text: 'An error occurred while generating biochemical results',
        //                         confirmButtonText: 'OK'
        //                     });
        //                 }
        //             });
        //         }
        //     });
        // });

    });
</script>
