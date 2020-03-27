<div class="form-row">
    <div class="form-group col-6">
        <label for="f_SME" class="col-form-label">Ansprechsperson (Fach):
			<?php if ($helptexts['f_SME']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_SME'] . "'></i>";
			} ?> <span class="text-danger ml-1">*</span>
        </label>         
        <!--<input type="text" name="f_SME" id="f_SME" value="<?php /*echo !$f_id ? '' : $feature_info['f_SME']; */ ?>" class="form-control">-->
        <select class="form-control" name="f_SME" id="f_SME" <?php  echo $disabled; ?>>
            <option value="">--bitte w<span>&#228;</span>hlen--</option>        
			<?php
			foreach ($feature_staff as $staff) {
				if ($staff['username']) {
					$staffname = $staff['staff_firstname'] . ' ' . $staff['staff_lastname'] . ' (' . $staff['username'] . ')';
				} else {
					$staffname = $staff['staff_firstname'] . ' ' . $staff['staff_lastname'];
				}
				$selected = ($f_SME == $staff['staff_id'] ? 'selected="selected"' : ''); ?>
                <option value="<?php echo $staff['staff_id']; ?>" <?php echo $selected; ?>><?php echo $staffname; ?></option>
                <?php
                if ($f_SME == $staff['staff_id']){$staffname_hidden= '<input type="hidden" id="staffname" name="staffname" value="'.$staffname.'">';}
                ?>
                
			<?php } ?>
        </select>
        <?php echo $staffname_hidden;?>
    </div>
    <div class="form-group col-6">
        <label for="f_responsible" class="col-form-label">Verantwortlicher Person (ICT): <?php if ($helptexts['f_responsible']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_responsible'] . "'></i>";
			} ?></label>
        <select class="form-control" name="f_responsible" id="f_responsible" <?php  echo $disabled; ?>>
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
 
    <div class="form-group col-6">
        <label for="f_due_date" class="col-form-label">Gew&uuml;nschtes Fertigstellungsdatum: <?php if ($helptexts['f_due_date']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_due_date'] . "'></i>";
			} ?> <span class="text-danger ml-1">*</span> </label>
        <input type="text" name="f_due_date" id="f_due_date" value="<?php echo !$f_id ? '' : $feature_info['f_due_date']; ?>" class="form-control" <?php  echo $disabled; ?>>
        <div>
          <button type="button" id="copy_to_clipboard" onclick="CopyToClipboard('fduedatejira')" style="font-size: 10px;float:right;margin-top:4px;margin-left:5px;"><i class="fa fa-copy"></i></button>
          <div id="fduedatejira" style="font-size:10px;margin-left:5px;float:right;margin-top:8px;"><?php echo date("d/M/y",strtotime ($feature_info['f_due_date']));?></div>
        </div>
    </div>
    
    <div class="form-group col-5">
        <label for="f_due_date" class="col-form-label">Jira Key: <?php if ($helptexts['f_jira_id']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_jira_id'] . "'></i>";
			} ?> </label>
        <input type="jira" name="f_jira_id" id="f_jira_id" value="<?php echo !$f_id ? '' : $feature_info['f_jira_id']; ?>" class="form-control" <?php  echo $disabled; ?>>

    </div>    
    <div class="form-group col-1 mt-5">
        <a class="f_mehr_link" target="_blank" href="https://jira.zhaw.ch/browse/<?php echo !$f_id ? '' : $feature_info['f_jira_id']; ?>" title="Infos auf Jira abrufen"><?php echo !$f_id ? '' : '<i class="fa fa-rocket" aria-hidden="true"></i>'; ?></a>
    </div>            

    <div class="form-group col-10">
        <label for="f_mehr_details" class="col-form-label">Mehr Details: <?php if ($helptexts['f_mehr_details']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_mehr_details'] . "'></i>";
			} ?></label>
        <input type="url" name="f_mehr_details" id="f_mehr_details" value="<?php echo !$f_id ? '' : $feature_info['f_mehr_details']; ?>" class="form-control" <?php  echo $disabled; ?>>
    </div>
    <div class="form-group col-2 mt-5">
        <a class="f_mehr_link" target="_blank" href="<?php echo !$f_id ? '' : $feature_info['f_mehr_details']; ?>"><?php echo !$f_id ? '' : '<i class="fa fa-link" aria-hidden="true"></i>'; ?></a>
    </div>
</div>
<script type="text/javascript">
function CopyToClipboard(containerid) {
    if (window.getSelection) {
        if (window.getSelection().empty) { // Chrome
            window.getSelection().empty();
        } else if (window.getSelection().removeAllRanges) { // Firefox
            window.getSelection().removeAllRanges();
        }
    } else if (document.selection) { // IE?
        document.selection.empty();
    }

    if (document.selection) {
        var range = document.body.createTextRange();
        range.moveToElementText(document.getElementById(containerid));
        range.select().createTextRange();
        document.execCommand("copy");
    } else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById(containerid));
        window.getSelection().addRange(range);
        document.execCommand("copy");
    }
}           
</script>                                                  