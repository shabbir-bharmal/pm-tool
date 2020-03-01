<div class="form-row">
    <div class="form-group col-12">
        <label for="f_context" class="col-form-label">Kontext: <?php if ($helptexts['f_context']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_context'] . "'></i>";
			} ?></label>
        <textarea name="f_context" id="f_context" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_context']; ?></textarea>
    </div>
    <div class="form-group col-12">
        <label for="f_problemdessc" class="col-form-label">Problembeschreibung/Motivation: <?php if ($helptexts['f_problemdessc']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_problemdessc'] . "'></i>";
			} ?></label>
        <textarea name="f_problemdessc" id="f_problemdessc" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_problemdessc']; ?></textarea>
    </div>
    <div class="form-group col-12">
        <label for="f_currentstate" class="col-form-label">Ist-Zustand: <?php if ($helptexts['f_currentstate']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_currentstate'] . "'></i>";
			} ?></label>
        <textarea name="f_currentstate" id="f_currentstate" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_currentstate']; ?></textarea>
    </div>
    <div class="form-group col-12">
        <label for="f_targetstate" class="col-form-label">Soll-Zustand: <?php if ($helptexts['f_targetstate']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_targetstate'] . "'></i>";
			} ?></label>
        <textarea name="f_targetstate" id="f_targetstate" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_targetstate']; ?></textarea>
    </div>
    <div class="form-group col-12">
        <label for="f_inscope" class="col-form-label">In Scope: <?php if ($helptexts['f_inscope']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_inscope'] . "'></i>";
			} ?> </label>
        <textarea name="f_inscope" id="f_inscope" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_inscope']; ?></textarea>
    </div>
    <div class="form-group col-12">
        <label for="f_outofscope" class="col-form-label">Out-Of-Scope: <?php if ($helptexts['f_outofscope']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_outofscope'] . "'></i>";
			} ?></label>
        <textarea name="f_outofscope" id="f_outofscope" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_outofscope']; ?></textarea>
    </div>
    <div class="form-group col-12">
        <label for="f_risks" class="col-form-label">Risiken: <?php if ($helptexts['f_risks']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_risks'] . "'></i>";
			} ?></label>
        <textarea name="f_risks" id="f_risks" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_risks']; ?></textarea>
    </div>
</div>