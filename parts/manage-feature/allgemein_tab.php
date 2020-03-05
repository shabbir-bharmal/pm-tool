<div class="form-row">
    <div class="form-group col-12">
        <label for="f_desc" class="col-form-label">Kurzbeschreibung: <?php if ($helptexts['f_desc']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_desc'] . "'></i>";
			} ?><span class="text-danger ml-1">*</span></label>
        <textarea class="form-control" name="f_desc" id="f_desc"><?php echo(!$f_id ? "" : $feature_info['f_desc']); ?></textarea>
    </div>
    <div class="form-group col-6">
        <label for="f_type" class="col-form-label">Type: <?php if ($helptexts['f_type']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_type'] . "'></i>";
			} ?></label>
        <select class="form-control" name="f_type" id="f_type">
            <option value="">--bitte w<span>&#228;</span>hlen--</option>
			<?php
			foreach ($feature_types as $feature_type) {
				$selected = ($type == $feature_type['id'] ? 'selected="selected"' : ''); ?>
                <option value="<?php echo $feature_type['id']; ?>" <?php echo $selected; ?>><?php echo $feature_type['name']; ?></option>
			<?php } ?>
        </select>
    </div>
    <div class="form-group col-6">
        <label for="f_status_id" class="col-form-label">Status: <?php if ($helptexts['f_status_id']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_status_id'] . "'></i>";
			} ?></label>
        <select class="form-control" name="f_status_id" id="f_status_id">
            <option value="">--bitte w<span>&#228;</span>hlen--</option>
			<?php
			foreach ($feature_statuses as $feature_status) {
				$selected = ($status == $feature_status['id'] ? 'selected="selected"' : ''); ?>
                <option value="<?php echo $feature_status['id']; ?>" <?php echo $selected; ?>><?php echo $feature_status['name']; ?></option>
			<?php } ?>
        </select>
    </div>

    <div class="form-group col-6">
        <label for="f_epic" class="col-form-label">Epic: <?php if ($helptexts['f_epic']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_epic'] . "'></i>";
			} ?></label>
        <select class="form-control" name="f_epic" id="f_epic">
            <optgroup>
                <option value="">--bitte w<span>&#228;</span>hlen--</option>
				<?php
				foreach ($working_epics as $epic) {
					$selected = !$f_id ? '' : ($feature_info['f_epic'] == $epic['e_id'] ? 'selected="selected"' : ''); ?>
					<option value="<?php echo $epic['e_id']; ?>" <?php echo $selected; ?>><?php echo $epic['e_title']; ?></option>
				<?php } ?>
            </optgroup>
            <optgroup label="-- abgeschlossene Epics ---">
				<?php
				foreach ($completed_epics as $epic) {
					$selected = !$f_id ? '' : ($feature_info['f_epic'] == $epic['e_id'] ? 'selected="selected"' : ''); ?>
                    <option value="<?php echo $epic['e_id']; ?>" <?php echo $selected; ?>><?php echo $epic['e_title']; ?></option>
				<?php } ?>
            </optgroup>
        </select>
    </div>

    <div class="form-group col-6">
        <label for="f_epic" class="col-form-label">Topic: <?php if ($helptexts['f_topic']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_topic'] . "'></i>";
			} ?></label>
        <select class="form-control" name="topic_id" id="topic_id">
            <option value="">--bitte w<span>&#228;</span>hlen--</option>
            <?php
            foreach($topics as $t){
            $selected = !$f_id ? '' : ($feature_info['f_topic_id'] == $t['id'] ? 'selected="selected"' : ''); ?>
            <option value="<?php echo $t['id']; ?>" <?php echo $selected; ?>><?php echo $t['name']; ?></option>
            <?php } ?>

            
        </select>
    </div>    
    <div class="form-group col-12">
        <label for="f_note" class="col-form-label">Bemerkungen: <?php if ($helptexts['f_note']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_note'] . "'></i>";
			} ?></label>
        <textarea name="f_note" id="f_note" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_note']; ?></textarea>
    </div>    
</div>