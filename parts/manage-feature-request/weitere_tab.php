<br />
<div class="form-row">
    <div class="form-group col-2">
        <label for="f_type" class="col-form-label">Type: <?php if ($helptexts['f_type']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_type'] . "'></i>";
			} ?></label>
        <select class="form-control" name="f_type" id="f_type" <?php echo $disabled; ?>>
            <option value="">--bitte w<span>&#228;</span>hlen--</option>
			<?php
			foreach ($feature_types as $feature_type) {
				$selected = ($type == $feature_type['id'] ? 'selected="selected"' : ''); ?>
                <option value="<?php echo $feature_type['id']; ?>" <?php echo $selected; ?>><?php echo $feature_type['name']; ?></option>
			<?php } ?>
        </select>
    </div>
    <div class="form-group col-2">
        <label for="f_storypoints" class="col-form-label">Storypoint: <?php if ($helptexts['f_storypoints']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_storypoints'] . "'></i>";
			} ?></label>
        <input type="number" name="f_storypoints" class="form-control" id="f_storypoints" value="<?php echo(!$f_id ? "" : $feature_info['f_storypoints']); ?>" <?php echo $disabled; ?>>
    </div>

</div>
<div class="form-row">
    <div class="form-group col-1">
        <label for="f_BV" class="col-form-label">BV: <?php if ($helptexts['f_BV']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_BV'] . "'></i>";
			} ?></label>
        <select class="form-control" name="f_BV" id="f_BV" <?php echo $disabled; ?>>
			<?php
			foreach ($opt_values as $opt) {
				$selected = !$f_id ? '' : ($feature_info['f_BV'] == $opt ? 'selected="selected"' : ''); ?>
                <option value="<?php echo $opt; ?>" <?php echo $selected; ?>><?php echo $opt; ?></option>
			<?php } ?>
        </select>
    </div>
    <div class="form-group col-1">
        <label for="f_TC" class="col-form-label">TC: <?php if ($helptexts['f_TC']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_TC'] . "'></i>";
			} ?></label>
        <select class="form-control" name="f_TC" id="f_TC" <?php echo $disabled; ?>>
			<?php
			foreach ($opt_values as $opt) {
				$selected = !$f_id ? '' : ($feature_info['f_TC'] == $opt ? 'selected="selected"' : ''); ?>
                <option value="<?php echo $opt; ?>" <?php echo $selected; ?>><?php echo $opt; ?></option>
			<?php } ?>
        </select>
    </div>
    <div class="form-group col-1">
        <label for="f_RROE" class="col-form-label">RROE: <?php if ($helptexts['f_RROE']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_RROE'] . "'></i>";
			} ?></label>
        <select class="form-control" name="f_RROE" id="f_RROE" <?php echo $disabled; ?>>
			<?php
			foreach ($opt_values as $opt) {
				$selected = !$f_id ? '' : ($feature_info['f_RROE'] == $opt ? 'selected="selected"' : ''); ?>
                <option value="<?php echo $opt; ?>" <?php echo $selected; ?>><?php echo $opt; ?></option>
			<?php } ?>
        </select>
    </div>
    <div class="form-group col-1">
        <label for="f_JS" class="col-form-label">JS: <?php if ($helptexts['f_JS']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_JS'] . "'></i>";
			} ?></label>
        <select class="form-control" name="f_JS" id="f_JS" <?php echo $disabled; ?>>
			<?php
			foreach ($opt_values as $opt) {
				$selected = !$f_id ? '' : ($feature_info['f_JS'] == $opt ? 'selected="selected"' : ''); ?>
                <option value="<?php echo $opt; ?>" <?php echo $selected; ?>><?php echo $opt; ?></option>
			<?php } ?>
        </select>
    </div>
    <div class="form-group col-1">
        <label for="f_WSJF" class="col-form-label">WSJF: <?php if ($helptexts['f_WSJF']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_WSJF'] . "'></i>";
			} ?></label>
        <span class="form-control f_WSJF">
        <?php if ($feature_info['f_JS'] == 0) {
			$wsjf = 0;
		} else {
			$wsjf = ($feature_info['f_BV'] + $feature_info['f_TC'] + $feature_info['f_RROE']) / $feature_info['f_JS'];
		}
		echo '= ' . $wsjf;
		?>
        </span>
    </div>
</div>
<div class="form-group row">
    <div class="form-group col-8">
        <label for="f_acceptance_criteria" class="col-form-label">Akzeptanz Kriterien: <?php if ($helptexts['f_acceptance_criteria']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_acceptance_criteria'] . "'></i>";
			} ?></label>
        <textarea name="f_acceptance_criteria" id="f_acceptance_criteria" class="form-control" <?php echo $disabled; ?> ><?php echo !$f_id ? '' : $feature_info['f_acceptance_criteria']; ?></textarea>
    </div>
</div>
<div class="form-group row">
<div class="form-group col-7">
    <label for="f_mehr_details" class="col-form-label">Mehr Details: <?php if ($helptexts['f_mehr_details']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_mehr_details'] . "'></i>";
		} ?></label>
    <input type="url" name="f_mehr_details" id="f_mehr_details" value="<?php echo !$f_id ? '' : $feature_info['f_mehr_details']; ?>" class="form-control" <?php echo $disabled; ?> >
</div>
<div class="form-group col-2 mt-5">
    <a class="f_mehr_link" target="_blank" href="<?php echo !$f_id ? '' : $feature_info['f_mehr_details']; ?>"><?php echo !$f_id ? '' : '<i class="fa fa-link" aria-hidden="true"></i>'; ?></a>
</div>
</div>
<div class="form-group row">
<div class="form-group col-2">
    <label for="f_responsible" class="col-form-label">Verantwortlicher Person (ICT): <?php if ($helptexts['f_responsible']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_responsible'] . "'></i>";
		} ?></label>
    <select class="form-control" name="f_responsible" id="f_responsible" <?php echo $disabled; ?> >
        <option value="">--bitte w<span>&#228;</span>hlen--</option>
		<?php
		foreach ($feature_staff as $staff) {
			if ($staff['username']) {
				$staffname = $staff['staff_firstname'] . ' ' . $staff['staff_lastname'] . ' (' . $staff['username'] . ')';
			} else {
				$staffname = $staff['staff_firstname'] . ' ' . $staff['staff_lastname'];
			}
			$selected = ($f_responsible == $staff['staff_id'] ? 'selected="selected"' : ''); ?>
            <option value="<?php echo $staff['staff_id']; ?>" <?php echo $selected; ?>><?php echo $staffname; ?></option>
		<?php } ?>
    </select>
</div>
</div>