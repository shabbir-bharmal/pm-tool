<div class="form-row">
    <div class="form-group col-12">
        <label for="f_desc" class="col-form-label">Description: <?php if ($helptexts['f_desc']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_desc'] . "'></i>";
			} ?></label>
        <textarea class="form-control" name="f_desc" id="f_desc"><?php echo(!$f_id ? "" : $feature_info['f_desc']); ?></textarea>
    </div>
    <div class="form-group col-6">
        <label for="f_type" class="col-form-label">Type: <?php if ($helptexts['f_type']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_type'] . "'></i>";
			} ?></label>
        <select class="form-control" name="f_type" id="f_type">
			<?php
			foreach ($feature_types as $feature_type) {
				$selected = !$f_id ? '' : ($feature_info['f_type'] == $feature_type['id'] ? 'selected="selected"' : ''); ?>
                <option value="<?php echo $feature_type['id']; ?>" <?php echo $selected; ?>><?php echo $feature_type['name']; ?></option>
			<?php } ?>
        </select>
    </div>
    <div class="form-group col-6">
        <label for="f_status_id" class="col-form-label">Status: <?php if ($helptexts['f_status_id']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_status_id'] . "'></i>";
			} ?></label>
        <select class="form-control" name="f_status_id" id="f_status_id">
			<?php
			foreach ($feature_statuses as $feature_status) {
				$selected = !$f_id ? '' : ($feature_info['f_status_id'] == $feature_status['id'] ? 'selected="selected"' : ''); ?>
                <option value="<?php echo $feature_status['id']; ?>" <?php echo $selected; ?>><?php echo $feature_status['name']; ?></option>
			<?php } ?>
        </select>
    </div>
    <div class="form-group col-12">
        <label for="f_note" class="col-form-label">Notes: <?php if ($helptexts['f_note']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_note'] . "'></i>";
			} ?></label>
        <textarea name="f_note" id="f_note" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_note']; ?></textarea>
    </div>
    <div class="form-group col-6">
        <label for="f_epic" class="col-form-label">Epic: <?php if ($helptexts['f_epic']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_epic'] . "'></i>";
			} ?></label>
        <select class="form-control" name="f_epic" id="f_epic">
			<?php
			foreach ($epics as $epic) {
				$selected = !$f_id ? '' : ($feature_info['f_epic'] == $epic['e_id'] ? 'selected="selected"' : ''); ?>
                <option value="<?php echo $epic['e_id']; ?>" <?php echo $selected; ?>><?php echo $epic['e_title']; ?></option>
			<?php } ?>
        </select>
    </div>
</div>