<div class="form-row">
    <div class="form-group col-12">
        <label for="f_SME" class="col-form-label">Subject Mater Experts:
            <?php if ($helptexts['f_SME']) {
				        echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_SME'] . "'></i>";
			      } ?>
        </label>
        <!--<input type="text" name="f_SME" id="f_SME" value="<?php /*echo !$f_id ? '' : $feature_info['f_SME']; */?>" class="form-control">-->
        <select class="form-control" name="f_SME" id="f_SME">
            <?php
            foreach ($feature_staff as $staff) {
                if ($staff['username']) {
                    $staffname = $staff['staff_firstname'] . ' ' . $staff['staff_lastname'] . ' (' . $staff['username'] . ')';
                } else {
                    $staffname = $staff['staff_firstname'] . ' ' . $staff['staff_lastname'];
                }
                $selected = !$f_id ? '' : ($feature_info['f_SME'] == $staff['staff_id'] ? 'selected="selected"' : ''); ?>
                <option value="<?php echo $staff['staff_id']; ?>" <?php echo $selected; ?>><?php echo $staffname; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group col-6">
        <label for="f_due_date" class="col-form-label">Due Date: <?php if ($helptexts['f_due_date']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_due_date'] . "'></i>";
			} ?></label>
        <input type="text" name="f_due_date" id="f_due_date" value="<?php echo !$f_id ? '' : $feature_info['f_due_date']; ?>" class="form-control">
    </div>
    <div class="form-group col-6">
        <label for="f_responsible" class="col-form-label">Responsible: <?php if ($helptexts['f_responsible']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_responsible'] . "'></i>";
			} ?></label>
        <select class="form-control" name="f_responsible" id="f_responsible">
			<?php
			foreach ($feature_staff as $staff) {
				if ($staff['username']) {
					$staffname = $staff['staff_firstname'] . ' ' . $staff['staff_lastname'] . ' (' . $staff['username'] . ')';
				} else {
					$staffname = $staff['staff_firstname'] . ' ' . $staff['staff_lastname'];
				}
				$selected = !$f_id ? '' : ($feature_info['f_responsible'] == $staff['staff_id'] ? 'selected="selected"' : ''); ?>
                <option value="<?php echo $staff['staff_id']; ?>" <?php echo $selected; ?>><?php echo $staffname; ?></option>
			<?php } ?>
        </select>
    </div>
    <div class="form-group col-8">
        <label for="f_mehr_details" class="col-form-label">Mehr Details: <?php if ($helptexts['f_mehr_details']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_mehr_details'] . "'></i>";
			} ?></label>
        <input type="url" name="f_mehr_details" id="f_mehr_details" value="<?php echo !$f_id ? '' : $feature_info['f_mehr_details']; ?>" class="form-control">
    </div>
    <div class="form-group col-4 mt-5">
        <a class="f_mehr_link" target="_blank" href="<?php echo !$f_id ? '' : $feature_info['f_mehr_details']; ?>"><?php echo !$f_id ? '' : '<i class="fa fa-link" aria-hidden="true"></i>'; ?></a>
    </div>
</div>