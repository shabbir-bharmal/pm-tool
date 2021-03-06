</br>
<div class="form-group row">
    <label for="f_epic" class="col-2 col-xs-12 col-form-label">Epic:
		<?php if ($helptexts['f_epic']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_epic'] . "'></i>";
		} ?><span class="text-danger ml-1">*</span>
    </label>

    <div class="col-2 col-xs-12">
        <select class="form-control" name="f_epic" id="f_epic" <?php echo $disabled; ?>>
            <option value="">--bitte w<span>&#228;</span>hlen--</option>
			<?php foreach ($epics as $epic) {
				$selected = !$f_id ? '' : ($feature_info['f_epic'] == $epic['e_id'] ? 'selected="selected"' : '');
				?>
                <option value="<?php echo $epic['e_id']; ?>" <?php echo $selected; ?>><?php echo $epic['e_title']; ?></option>
			<?php } ?>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="f_epic" class="col-2 col-xs-12 col-form-label">Topic:
		<?php if ($helptexts['f_topic']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_topic'] . "'></i>";
		} ?><span class="text-danger ml-1">*</span>
    </label>

    <div class="col-2 col-xs-12">
        <select class="form-control" name="f_topic" id="f_topic" <?php echo $disabled; ?>>
            <option value="">--bitte w<span>&#228;</span>hlen--</option>
			<?php foreach ($topics as $topic) {
				$selected = !$f_id ? '' : ($feature_info['f_topic_id'] == $topic['id'] ? 'selected="selected"' : '');
				?>
                <option value="<?php echo $topic['id']; ?>" <?php echo $selected; ?>><?php echo $topic['name']; ?></option>
			<?php } ?>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="f_desc" class="col-2 col-xs-12 col-form-label">Kurzbeschreibung:
		<?php if ($helptexts['f_desc']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_desc'] . "'></i>";
		} ?><span class="text-danger ml-1">*</span>
    </label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="f_desc" id="f_desc" <?php echo $disabled; ?>><?php echo(!$f_id ? "" : $feature_info['f_desc']); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="f_context" class="col-2 col-xs-12 col-form-label">Kontext:
		<?php if ($helptexts['f_context']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_context'] . "'></i>";
		} ?>
    </label>

    <div class="col-6 col-xs-12">
        <textarea name="f_context" id="f_context" class="form-control" <?php echo $disabled; ?>><?php echo !$f_id ? '' : $feature_info['f_context']; ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="f_problemdessc" class="col-2 col-xs-12 col-form-label">Problembeschreibung/ Motivation:
		<?php if ($helptexts['f_problemdessc']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_problemdessc'] . "'></i>";
		} ?>
    </label>

    <div class="col-6 col-xs-12">
        <textarea name="f_problemdessc" id="f_problemdessc" class="form-control" <?php echo $disabled; ?>><?php echo !$f_id ? '' : $feature_info['f_problemdessc']; ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="f_currentstate" class="col-2 col-xs-12 col-form-label">Ist-Zustand:
		<?php if ($helptexts['f_currentstate']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_currentstate'] . "'></i>";
		} ?><span class="text-danger ml-1">*</span>
    </label>

    <div class="col-6 col-xs-12">
        <textarea name="f_currentstate" id="f_currentstate" class="form-control" <?php echo $disabled; ?>><?php echo !$f_id ? '' : $feature_info['f_currentstate']; ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="f_targetstate" class="col-2 col-xs-12 col-form-label">Soll-Zustand:
		<?php if ($helptexts['f_targetstate']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_targetstate'] . "'></i>";
		} ?><span class="text-danger ml-1">*</span>
    </label>

    <div class="col-6 col-xs-12">
        <textarea name="f_targetstate" id="f_targetstate" class="form-control" <?php echo $disabled; ?>><?php echo !$f_id ? '' : $feature_info['f_targetstate']; ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="f_benefit" class="col-2 col-xs-12 col-form-label">Nutzen:
		<?php if ($helptexts['f_benefit']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_benefit'] . "'></i>";
		} ?><span class="text-danger ml-1">*</span>
    </label>

    <div class="col-6 col-xs-12">
        <textarea name="f_benefit" id="f_benefit" class="form-control" <?php echo $disabled; ?>><?php echo !$f_id ? '' : $feature_info['f_benefit']; ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="f_inscope" class="col-2 col-xs-12 col-form-label">In Scope:
		<?php if ($helptexts['f_inscope']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_inscope'] . "'></i>";
		} ?><span class="text-danger ml-1">*</span>
    </label>

    <div class="col-6 col-xs-12">
        <textarea name="f_inscope" id="f_inscope" class="form-control" <?php echo $disabled; ?>><?php echo !$f_id ? '' : $feature_info['f_inscope']; ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="f_outofscope" class="col-2 col-xs-12 col-form-label">Out-Of-Scope:
		<?php if ($helptexts['f_outofscope']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_outofscope'] . "'></i>";
		} ?><span class="text-danger ml-1">*</span>
    </label>

    <div class="col-6 col-xs-12">
        <textarea name="f_outofscope" id="f_outofscope" class="form-control" <?php echo $disabled; ?>><?php echo !$f_id ? '' : $feature_info['f_outofscope']; ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="f_due_date" class="col-2 col-xs-12 col-form-label">Gew&uuml;nschtes Fertigstellungsdatum:
		<?php if ($helptexts['f_due_date']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_due_date'] . "'></i>";
		} ?><span class="text-danger ml-1">*</span>
    </label>

    <div class="col-2 col-xs-12">
        <input type="text" name="f_due_date" id="f_due_date" class="form-control" <?php echo $disabled; ?> value="<?php echo !$f_id ? '' : $feature_info['f_due_date']; ?>">
    </div>
</div>
<div class="form-group row">
    <label for="f_SME" class="col-2 col-xs-12 col-form-label">Ansprechsperson (Fach):
		<?php if ($helptexts['f_SME']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_SME'] . "'></i>";
		} ?><span class="text-danger ml-1">*</span>
    </label>

    <div class="col-2 col-xs-12">
        <select class="form-control" name="f_SME" id="f_SME" <?php echo $disabled; ?>>
            <option value="">--bitte w<span>&#228;</span>hlen--</option>
			<?php
			foreach ($feature_staff as $staff) {
				if ($staff['username']) {
					$staffname = $staff['staff_firstname'] . ' ' . $staff['staff_lastname'] . ' (' . $staff['username'] . ')';
				} else {
					$staffname = $staff['staff_firstname'] . ' ' . $staff['staff_lastname'];
				}
				$selected = ($staff_id == $staff['staff_id'] ? 'selected="selected"' : '');
				?>
                <option value="<?php echo $staff['staff_id']; ?>" <?php echo $selected; ?>><?php echo $staffname; ?></option>
			<?php } ?>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="f_dependencies" class="col-2 col-xs-12 col-form-label">Abh<span>&#228;</span>ngigkeit:
		<?php if ($helptexts['f_dependencies']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_dependencies'] . "'></i>";
		} ?><span class="text-danger ml-1">*</span>
    </label>

    <div class="col-6 col-xs-12">
        <textarea name="f_dependencies" id="f_dependencies" class="form-control" <?php echo $disabled; ?>><?php echo !$f_id ? '' : $feature_info['f_dependencies']; ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="f_risks" class="col-2 col-xs-12 col-form-label">Risiken:
		<?php if ($helptexts['f_risks']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_risks'] . "'></i>";
		} ?>
    </label>

    <div class="col-6 col-xs-12">
        <textarea name="f_risks" id="f_risks" class="form-control" <?php echo $disabled; ?>><?php echo !$f_id ? '' : $feature_info['f_risks']; ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="f_note" class="col-2 col-xs-12 col-form-label">Bemerkungen:
		<?php if ($helptexts['f_note']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_note'] . "'></i>";
		} ?>
    </label>

    <div class="col-6 col-xs-12">
        <textarea name="f_note" id="f_note" class="form-control" <?php echo $disabled; ?>><?php echo !$f_id ? '' : $feature_info['f_note']; ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="watcher" class="col-2 col-xs-12 col-form-label">Watch: </label>
    <input type="hidden" name="watcher" id="watcher" value="<?php echo $is_watching ? 1 : 0; ?>">
	<?php
	$class = 'text-secondary';
	if ($is_watching) {
		$class = "text-success";
	}
	?>
    <div class="col-6 col-xs-12">
        <i class="fa fa-eye <?php echo $class; ?> watch-icon"></i>
    </div>
</div>