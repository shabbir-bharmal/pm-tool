<div class="form-row">
    <div class="form-group col-12">
        <label for="f_benefit" class="col-form-label">Feature Benefit: <?php if ($helptexts['f_benefit']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_benefit'] . "'></i>";
			} ?></label>
        <textarea name="f_benefit" id="f_benefit" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_benefit']; ?></textarea>
    </div>
    <div class="form-group col-12">
        <label for="f_dependencies" class="col-form-label">Dependencies: <?php if ($helptexts['f_dependencies']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_dependencies'] . "'></i>";
			} ?></label>
        <textarea name="f_dependencies" id="f_dependencies" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_dependencies']; ?></textarea>
    </div>
    <div class="form-group col-12">
        <label for="f_acceptance_criteria" class="col-form-label">Acceptance Criteria: <?php if ($helptexts['f_acceptance_criteria']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_acceptance_criteria'] . "'></i>";
			} ?></label>
        <textarea name="f_acceptance_criteria" id="f_acceptance_criteria" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_acceptance_criteria']; ?></textarea>
    </div>
</div>