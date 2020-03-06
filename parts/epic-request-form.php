<?php
$staff         = $db->getStaff();
$epics         = $db->getEpics();
$epic_statuses = $db->getEpicStatuses();
$teams         = $db->getTeams();
$e_id          = isset($_REQUEST['e_id']) ? $_REQUEST['e_id'] : 0;
$epic_info     = $db->getEpicById($e_id);
?>

<form action="<?php echo W_ROOT.'/form-action.php'; ?>" method="post" id="epic_request_form" name="epic_request_form">
	<input type="hidden" name="e_id" value="<?php echo $e_id; ?>">
	<input type="hidden" name="action" id="action" value="epic-request">

	<div class="form-group row">
		<label for="e_title" class="col-3 col-xs-12 col-form-label">Titel: <span class="text-danger ml-1">*</span></label>

		<div class="col-6 col-xs-12">
			<input type="text" name="e_title" class="form-control" id="e_title" value="<?php echo(!$e_id ? "" : $epic_info['e_title']) ?>">
		</div>
	</div>

	<div class="form-group row">
		<label for="e_status_is" class="col-3 col-xs-12 col-form-label">Status:</label>

		<div class="col-2 col-xs-12">

			<?php if (!$e_id) {
				$epic_info['e_status_id'] = 1;
			} ?>

			<select class="form-control" name="e_status_id" id="e_status_id" disabled="true">
				<?php
				foreach ($epic_statuses as $epic_status) {
					$selected = ($epic_info['e_status_id'] == $epic_status['id'] ? 'selected="selected"' : ''); ?>
					<option value="<?php echo $epic_status['id']; ?>" <?php echo $selected; ?>><?php echo $epic_status['name']; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>

	<h5>Zielbeschreibung</h5>

	<div class="form-group row">
		<label for="e_hs_for" class="col-3 col-xs-12 col-form-label">Für:<span class="text-danger ml-1">*</span></label>

		<div class="col-6 col-xs-12">
			<textarea class="form-control" name="e_hs_for" id="e_hs_for" rows="1"><?php echo(!$e_id ? "" : $epic_info['e_hs_for']); ?></textarea>
		</div>
	</div>

	<div class="form-group row">
		<label for="e_hs_for_desc" class="col-3 col-xs-12 col-form-label">die:<span class="text-danger ml-1">*</span></label>

		<div class="col-6 col-xs-12">
			<textarea class="form-control" name="e_hs_for_desc" id="e_hs_for_desc" rows="1"><?php echo(!$e_id ? "" : $epic_info['e_hs_for_desc']); ?></textarea>
		</div>
	</div>

	<div class="form-group row">
		<label for="e_hs_solution" class="col-3 col-xs-12 col-form-label">ist:<span class="text-danger ml-1">*</span></label>

		<div class="col-6 col-xs-12">
			<textarea class="form-control" name="e_hs_solution" id="e_hs_solution" rows="1"><?php echo(!$e_id ? "" : $epic_info['e_hs_solution']); ?></textarea>
		</div>
	</div>

	<div class="form-group row">
		<label for="e_hs_how" class="col-3 col-xs-12 col-form-label">ein:<span class="text-danger ml-1">*</span></label>

		<div class="col-6 col-xs-12">
			<textarea class="form-control" name="e_hs_how" id="e_hs_how" rows="1"><?php echo(!$e_id ? "" : $epic_info['e_hs_how']); ?></textarea>
		</div>
	</div>

	<div class="form-group row">
		<label for="e_hs_value" class="col-3 col-xs-12 col-form-label">welche:<span class="text-danger ml-1">*</span></label>

		<div class="col-6 col-xs-12">
			<textarea class="form-control" name="e_hs_value" id="e_hs_value" rows="1"><?php echo(!$e_id ? "" : $epic_info['e_hs_value']); ?></textarea>
		</div>
	</div>

	<div class="form-group row">
		<label for="e_hs_unlike" class="col-3 col-xs-12 col-form-label">im Vergleich zu:<span class="text-danger ml-1">*</span></label>

		<div class="col-6 col-xs-12">
			<textarea class="form-control" name="e_hs_unlike" id="e_hs_unlike" rows="1"><?php echo(!$e_id ? "" : $epic_info['e_hs_unlike']); ?></textarea>
		</div>
	</div>

	<div class="form-group row">
		<label for="e_hs_oursoluion" class="col-3 col-xs-12 col-form-label">macht unsere Lösung:<span class="text-danger ml-1">*</span></label>

		<div class="col-6 col-xs-12">
			<textarea class="form-control" name="e_hs_oursoluion" id="e_hs_oursoluion" rows="1"><?php echo(!$e_id ? "" : $epic_info['e_hs_oursoluion']); ?></textarea>
		</div>
	</div>

	<h5>Umfang</h5>

	<div class="form-group row">
		<label for="e_hs_businessoutcome" class="col-3 col-xs-12 col-form-label">Schlüsselergebnisse (Hypothese):<span class="text-danger ml-1">*</span></label>

		<div class="col-6 col-xs-12">
			<textarea class="form-control" name="e_hs_businessoutcome" id="e_hs_businessoutcome" rows="1"><?php echo(!$e_id ? "" : $epic_info['e_hs_businessoutcome']); ?></textarea>
		</div>
	</div>

	<div class="form-group row">
		<label for="e_hs_leadingindicators" class="col-3 col-xs-12 col-form-label">Zielführende Indikatoren:<span class="text-danger ml-1">*</span></label>

		<div class="col-6 col-xs-12">
			<textarea class="form-control" name="e_hs_leadingindicators" id="e_hs_leadingindicators" rows="1"><?php echo(!$e_id ? "" : $epic_info['e_hs_leadingindicators']); ?></textarea>
		</div>
	</div>

	<div class="form-group row">
		<label for="e_hs_nfr" class="col-3 col-xs-12 col-form-label">Nicht-funktionale Anforderungen:<span class="text-danger ml-1">*</span></label>

		<div class="col-6 col-xs-12">
			<textarea class="form-control" name="e_hs_nfr" id="e_hs_nfr" rows="1"><?php echo(!$e_id ? "" : $epic_info['e_hs_nfr']); ?></textarea>
		</div>
	</div>

	<h5>Weitergehende Infos</h5>

	<div class="form-group row">
		<label for="e_owner" class="col-3 col-xs-12 col-form-label">Epic Owner:<span class="text-danger ml-1">*</span></label>

		<div class="col-2 col-xs-12">
			<select class="form-control" name="e_owner" id="e_owner">
				<option value="">--bitte w<span>&#228;</span>hlen--</option>
				<?php
				foreach ($staff as $staff_member) {
					if ($staff_member['username']) {
						$staffname = $staff_member['staff_firstname'].' '.$staff_member['staff_lastname'].' ('.$staff_member['username'].')';
					} else {
						$staffname = $staff_member['staff_firstname'].' '.$staff_member['staff_lastname'];
					}
					$selected = !$e_id ? '' : ($epic_info['e_owner'] == $staff_member['staff_id'] ? 'selected="selected"' : '');
					?>
					<option value="<?php echo $staff_member['staff_id']; ?>" <?php echo $selected; ?>><?php echo $staffname; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label for="team_id" class="col-3 col-xs-12 col-form-label">Team:<span class="text-danger ml-1">*</span></label>

		<div class="col-2 col-xs-12">
			<select class="form-control" name="team_id" id="team_id">
				<option value="">--bitte w<span>&#228;</span>hlen--</option>
				<?php
				foreach ($teams as $team) {
					$selected = !$e_id ? '' : ($epic_info['team_id'] == $team['id'] ? 'selected="selected"' : '');
					?>
					<option value="<?php echo $team['id']; ?>" <?php echo $selected; ?>><?php echo $team['name']; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label for="e_notes" class="col-3 col-xs-12 col-form-label">Bemerkung:</label>

		<div class="col-6 col-xs-12">
			<textarea name="e_notes" id="e_notes" class="form-control"><?php echo !$e_id ? '' : $epic_info['e_notes']; ?></textarea>
		</div>
	</div>

	<div class="form-row">
		<button name="speichern" id="SPEICHERN" class="btn btn-primary">SPEICHERN</button>
		<?php if (($e_id && $epic_info['e_status_id'] == 5) || !$e_id) { ?>
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