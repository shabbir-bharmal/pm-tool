<?php
$feature_staff    = $db->getStaff();
$epics            = $db->getEpics();
$topics           = $db->getTopics();
$feature_statuses = $db->getFeatureStatuses();
$helptexts        = $db->getHelpText();
$f_id             = isset($_REQUEST['f_id']) ? $_REQUEST['f_id'] : 0;
$feature_info     = $db->getFeatureByFeatureId($f_id);
?>





<form action="<?php echo W_ROOT . '/form-action.php'; ?>" method="post" id="feature_request_form" name="feature_request_form">
    <input type="hidden" name="f_id" value="<?php echo $f_id; ?>">
    <input type="hidden" name="action" id="action" value="feature-request">

    <div class="form-group row">
        <label for="f_title" class="col-2 col-xs-12 col-form-label">Titel: <span class="text-danger ml-1">*</span></label>

        <div class="col-6 col-xs-12">
            <input type="text" name="f_title" class="form-control" id="f_title" value="<?php echo(!$f_id ? "" : $feature_info['f_title']) ?>">
        </div>
    </div>
    
    <div class="form-group row">
        <label for="f_title" class="col-2 col-xs-12 col-form-label">Status:</label>

        <div class="col-2 col-xs-12">
        
		<?php if (!$f_id) { 
            $feature_info['f_status_id']=5;
	 }   ?>    
        
        <select class="form-control" name="f_status_id" id="f_status_id" disabled="true">
			<?php
			foreach ($feature_statuses as $feature_status) {
				$selected = !$f_id ? '' : ($feature_info['f_status_id'] == $feature_status['id'] ? 'selected="selected"' : ''); ?>
                <option value="<?php echo $feature_status['id']; ?>" <?php echo $selected; ?>><?php echo $feature_status['name']; ?></option>
			<?php } ?>
        </select>
        </div>
    </div>
    
    <div class="form-group row">
        <label for="f_epic" class="col-2 col-xs-12 col-form-label">Epic:
			<?php if ($helptexts['f_epic']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_epic'] . "'></i>";
			} ?><span class="text-danger ml-1">*</span>
        </label>

        <div class="col-2 col-xs-12">
            <select class="form-control" name="f_epic" id="f_epic">
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
            <select class="form-control" name="f_topic" id="f_topic">
                <option value="">--bitte w<span>&#228;</span>hlen--</option>
				<?php foreach ($topics as $topic) {
					$selected = !$f_id ? '' : ($feature_info['f_topic'] == $topic['t_id'] ? 'selected="selected"' : '');
					?>
                    <option value="<?php echo $topic['t_id']; ?>" <?php echo $selected; ?>><?php echo $topic['t_title']; ?></option>
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
            <textarea class="form-control" name="f_desc" id="f_desc"><?php echo(!$f_id ? "" : $feature_info['f_desc']); ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="f_context" class="col-2 col-xs-12 col-form-label">Kontext:
			<?php if ($helptexts['f_context']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_context'] . "'></i>";
			} ?>
        </label>

        <div class="col-6 col-xs-12">
            <textarea name="f_context" id="f_context" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_context']; ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="f_problemdessc" class="col-2 col-xs-12 col-form-label">Problembeschreibung/ Motivation:
			<?php if ($helptexts['f_problemdessc']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_problemdessc'] . "'></i>";
			} ?>
        </label>

        <div class="col-6 col-xs-12">
            <textarea name="f_problemdessc" id="f_problemdessc" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_problemdessc']; ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="f_currentstate" class="col-2 col-xs-12 col-form-label">Ist-Zustand:
			<?php if ($helptexts['f_currentstate']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_currentstate'] . "'></i>";
			} ?><span class="text-danger ml-1">*</span>
        </label>

        <div class="col-6 col-xs-12">
            <textarea name="f_currentstate" id="f_currentstate" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_currentstate']; ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="f_targetstate" class="col-2 col-xs-12 col-form-label">Soll-Zustand:
			<?php if ($helptexts['f_targetstate']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_targetstate'] . "'></i>";
			} ?><span class="text-danger ml-1">*</span>
        </label>

        <div class="col-6 col-xs-12">
            <textarea name="f_targetstate" id="f_targetstate" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_targetstate']; ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="f_benefit" class="col-2 col-xs-12 col-form-label">Nutzen:
			<?php if ($helptexts['f_benefit']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_benefit'] . "'></i>";
			} ?><span class="text-danger ml-1">*</span>
        </label>

        <div class="col-6 col-xs-12">
            <textarea name="f_benefit" id="f_benefit" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_benefit']; ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="f_inscope" class="col-2 col-xs-12 col-form-label">In Scope:
			<?php if ($helptexts['f_inscope']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_inscope'] . "'></i>";
			} ?><span class="text-danger ml-1">*</span>
        </label>

        <div class="col-6 col-xs-12">
            <textarea name="f_inscope" id="f_inscope" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_inscope']; ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="f_outofscope" class="col-2 col-xs-12 col-form-label">Out-Of-Scope:
			<?php if ($helptexts['f_outofscope']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_outofscope'] . "'></i>";
			} ?><span class="text-danger ml-1">*</span>
        </label>

        <div class="col-6 col-xs-12">
            <textarea name="f_outofscope" id="f_outofscope" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_outofscope']; ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="f_due_date" class="col-2 col-xs-12 col-form-label">Gew&uuml;nschtes Fertigstellungsdatum:
			<?php if ($helptexts['f_due_date']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_due_date'] . "'></i>";
			} ?><span class="text-danger ml-1">*</span>
        </label>

        <div class="col-2 col-xs-12">
            <input type="text" name="f_due_date" id="f_due_date" class="form-control" value="<?php echo !$f_id ? '' : $feature_info['f_due_date']; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="f_SME" class="col-2 col-xs-12 col-form-label">Ansprechspartner:
			<?php if ($helptexts['f_SME']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_SME'] . "'></i>";
			} ?><span class="text-danger ml-1">*</span>
        </label>

        <div class="col-2 col-xs-12">
            <select class="form-control" name="f_SME" id="f_SME">
                <option value="">--bitte w<span>&#228;</span>hlen--</option>
				<?php
				foreach ($feature_staff as $staff) {
					if ($staff['username']) {
						$staffname = $staff['staff_firstname'] . ' ' . $staff['staff_lastname'] . ' (' . $staff['username'] . ')';
					} else {
						$staffname = $staff['staff_firstname'] . ' ' . $staff['staff_lastname'];
					}
					$selected = !$f_id ? '' : ($feature_info['f_SME'] == $staff['staff_id'] ? 'selected="selected"' : '');
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
            <textarea name="f_dependencies" id="f_dependencies" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_dependencies']; ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="f_risks" class="col-2 col-xs-12 col-form-label">Risiken:
			<?php if ($helptexts['f_risks']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_risks'] . "'></i>";
			} ?>
        </label>

        <div class="col-6 col-xs-12">
            <textarea name="f_risks" id="f_risks" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_risks']; ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="f_note" class="col-2 col-xs-12 col-form-label">Bemerkungen:
			<?php if ($helptexts['f_note']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_note'] . "'></i>";
			} ?>
        </label>

        <div class="col-6 col-xs-12">
            <textarea name="f_note" id="f_note" class="form-control"><?php echo !$f_id ? '' : $feature_info['f_note']; ?></textarea>
        </div>
    </div>

    <div class="form-row">
        <button name="speichern" id="SPEICHERN" class="btn btn-primary">SPEICHERN</button>
		<?php if (($f_id && $feature_info['f_status_id'] == 5) || !$f_id) { ?>
            &nbsp;
            <button name="einreichen" id="EINREICHEN" class="btn btn-primary">EINREICHEN</button>
		<?php } ?>
    &nbsp;&nbsp;&nbsp;<span class="text-danger ml-1">*</span> = Pflichtfelder
    </div>
</form>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="errorshow">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&#10005;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Bitte alle Pflichtfelder ausf<span>&#252;</span>llen, um den Feature Request einzureichen.</p>
            </div>
        </div>
    </div>
</div>