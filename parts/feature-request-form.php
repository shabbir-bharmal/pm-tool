<?php
$feature_staff = $db->getStaffByTopic(0);
$epics         = $db->getEpics();
$helptexts     = $db->getHelpText();
?>

<form action="<?php echo W_ROOT.'/form-action.php'; ?>" method="post" id="feature_request_form" name="feature_request_form">
	<input type="hidden" name="action" id="action" value="feature-request">

	<div class="form-group row">
		<label for="f_title" class="col-2 col-xs-12 col-form-label">Title:</label>

		<div class="col-4 col-xs-12">
			<input type="text" name="f_title" class="form-control" id="f_title">
		</div>
	</div>
	<div class="form-group row">
		<label for="f_epic" class="col-2 col-xs-12 col-form-label">Epic:
			<?php if ($helptexts['f_epic']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='".$helptexts['f_epic']."'></i>";
			} ?>
		</label>

		<div class="col-4 col-xs-12">
			<select class="form-control" name="f_epic" id="f_epic">
				<?php foreach ($epics as $epic) { ?>
					<option value="<?php echo $epic['e_id']; ?>"><?php echo $epic['e_title']; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label for="f_desc" class="col-2 col-xs-12 col-form-label">Description:
			<?php if ($helptexts['f_desc']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='".$helptexts['f_desc']."'></i>";
			} ?>
		</label>

		<div class="col-4 col-xs-12">
			<textarea class="form-control" name="f_desc" id="f_desc"></textarea>
		</div>
	</div>
	<div class="form-group row">
		<label for="f_context" class="col-2 col-xs-12 col-form-label">Kontext:
			<?php if ($helptexts['f_context']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='".$helptexts['f_context']."'></i>";
			} ?>
		</label>

		<div class="col-4 col-xs-12">
			<textarea name="f_context" id="f_context" class="form-control"></textarea>
		</div>
	</div>
	<div class="form-group row">
		<label for="f_problemdessc" class="col-2 col-xs-12 col-form-label">Problembeschreibung/Motivation:
			<?php if ($helptexts['f_problemdessc']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='".$helptexts['f_problemdessc']."'></i>";
			} ?>
		</label>

		<div class="col-4 col-xs-12">
			<textarea name="f_problemdessc" id="f_problemdessc" class="form-control"></textarea>
		</div>
	</div>
	<div class="form-group row">
		<label for="f_currentstate" class="col-2 col-xs-12 col-form-label">Ist-Zustand:
			<?php if ($helptexts['f_currentstate']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='".$helptexts['f_currentstate']."'></i>";
			} ?>
		</label>

		<div class="col-4 col-xs-12">
			<textarea name="f_currentstate" id="f_currentstate" class="form-control"></textarea>
		</div>
	</div>
	<div class="form-group row">
		<label for="f_targetstate" class="col-2 col-xs-12 col-form-label">Soll-Zustand:
			<?php if ($helptexts['f_targetstate']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='".$helptexts['f_targetstate']."'></i>";
			} ?>
		</label>

		<div class="col-4 col-xs-12">
			<textarea name="f_targetstate" id="f_targetstate" class="form-control"></textarea>
		</div>
	</div>
	<div class="form-group row">
		<label for="f_benefit" class="col-2 col-xs-12 col-form-label">Nutzen:
			<?php if ($helptexts['f_benefit']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='".$helptexts['f_benefit']."'></i>";
			} ?>
		</label>

		<div class="col-4 col-xs-12">
			<textarea name="f_benefit" id="f_benefit" class="form-control"></textarea>
		</div>
	</div>
	<div class="form-group row">
		<label for="f_inscope" class="col-2 col-xs-12 col-form-label">In Scope:
			<?php if ($helptexts['f_inscope']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='".$helptexts['f_inscope']."'></i>";
			} ?>
		</label>

		<div class="col-4 col-xs-12">
			<textarea name="f_inscope" id="f_inscope" class="form-control"></textarea>
		</div>
	</div>
	<div class="form-group row">
		<label for="f_outofscope" class="col-2 col-xs-12 col-form-label">Out-Of-Scope:
			<?php if ($helptexts['f_outofscope']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='".$helptexts['f_outofscope']."'></i>";
			} ?>
		</label>

		<div class="col-4 col-xs-12">
			<textarea name="f_outofscope" id="f_outofscope" class="form-control"></textarea>
		</div>
	</div>
	<div class="form-group row">
		<label for="f_due_date" class="col-2 col-xs-12 col-form-label">Due Date:
			<?php if ($helptexts['f_due_date']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='".$helptexts['f_due_date']."'></i>";
			} ?>
		</label>

		<div class="col-4 col-xs-12">
			<input type="text" name="f_due_date" id="f_due_date" class="form-control">
		</div>
	</div>
	<div class="form-group row">
		<label for="f_SME" class="col-2 col-xs-12 col-form-label">Subject Mater Experts:
			<?php if ($helptexts['f_SME']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='".$helptexts['f_SME']."'></i>";
			} ?>
		</label>

		<div class="col-4 col-xs-12">
			<select class="form-control" name="f_SME" id="f_SME">
				<?php
				foreach ($feature_staff as $staff) {
					if ($staff['username']) {
						$staffname = $staff['staff_firstname'].' '.$staff['staff_lastname'].' ('.$staff['username'].')';
					} else {
						$staffname = $staff['staff_firstname'].' '.$staff['staff_lastname'];
					} ?>
					<option value="<?php echo $staff['staff_id']; ?>"><?php echo $staffname; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label for="f_dependencies" class="col-2 col-xs-12 col-form-label">Abhängigkeit:
			<?php if ($helptexts['f_dependencies']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='".$helptexts['f_dependencies']."'></i>";
			} ?>
		</label>

		<div class="col-4 col-xs-12">
			<textarea name="f_dependencies" id="f_dependencies" class="form-control"></textarea>
		</div>
	</div>
	<div class="form-group row">
		<label for="f_risks" class="col-2 col-xs-12 col-form-label">Risiken:
			<?php if ($helptexts['f_risks']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='".$helptexts['f_risks']."'></i>";
			} ?>
		</label>

		<div class="col-4 col-xs-12">
			<textarea name="f_risks" id="f_risks" class="form-control"></textarea>
		</div>
	</div>
	<div class="form-group row">
		<label for="f_note" class="col-2 col-xs-12 col-form-label">Notes:
			<?php if ($helptexts['f_note']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='".$helptexts['f_note']."'></i>";
			} ?>
		</label>

		<div class="col-4 col-xs-12">
			<textarea name="f_note" id="f_note" class="form-control"></textarea>
		</div>
	</div>

	<div class="form-row">
		<button name="speichern" id="SPEICHERN" class="btn btn-primary">SPEICHERN</button>
		&nbsp;
		<button name="einreichen" id="EINREICHEN" class="btn btn-primary">EINREICHEN</button>
	</div>
</form>