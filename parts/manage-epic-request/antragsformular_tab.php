<br />
<h5>Zielbeschreibung</h5>

<div class="form-group row">
    <label for="e_hs_for" class="col-3 col-xs-12 col-form-label">F<span>&#252;</span>r: <?php if ($helptexts['e_hs_for']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_hs_for'] . "'></i>";
		} ?> <span class="text-danger ml-1">*</span></label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_hs_for" id="e_hs_for"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_hs_for']); ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label for="e_hs_for_desc" class="col-3 col-xs-12 col-form-label">die: <?php if ($helptexts['e_hs_for_desc']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_hs_for_desc'] . "'></i>";
		} ?> <span class="text-danger ml-1">*</span></label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_hs_for_desc" id="e_hs_for_desc"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_hs_for_desc']); ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label for="e_hs_solution" class="col-3 col-xs-12 col-form-label">ist: <?php if ($helptexts['e_hs_solution']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_hs_solution'] . "'></i>";
		} ?> <span class="text-danger ml-1">*</span></label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_hs_solution" id="e_hs_solution"  <?php echo $disabled; ?>  ><?php echo(!$e_id ? "" : $epic_info['e_hs_solution']); ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label for="e_hs_how" class="col-3 col-xs-12 col-form-label">ein: <?php if ($helptexts['e_hs_how']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_hs_how'] . "'></i>";
		} ?> <span class="text-danger ml-1">*</span></label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_hs_how" id="e_hs_how"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_hs_how']); ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label for="e_hs_value" class="col-3 col-xs-12 col-form-label">welche: <?php if ($helptexts['e_hs_value']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_hs_value'] . "'></i>";
		} ?> <span class="text-danger ml-1">*</span></label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_hs_value" id="e_hs_value"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_hs_value']); ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label for="e_hs_unlike" class="col-3 col-xs-12 col-form-label">im Vergleich zu: <?php if ($helptexts['e_hs_unlike']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_hs_unlike'] . "'></i>";
		} ?> <span class="text-danger ml-1">*</span></label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_hs_unlike" id="e_hs_unlike"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_hs_unlike']); ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label for="e_hs_oursoluion" class="col-3 col-xs-12 col-form-label">macht unsere L<span>&#246;</span>sung: <?php if ($helptexts['e_hs_oursoluion']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_hs_oursoluion'] . "'></i>";
		} ?> <span class="text-danger ml-1">*</span></label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_hs_oursoluion" id="e_hs_oursoluion"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_hs_oursoluion']); ?></textarea>
    </div>
</div>

<h5>Umfang</h5>

<div class="form-group row">
    <label for="e_hs_businessoutcome" class="col-3 col-xs-12 col-form-label">Schl<span>&#252;</span>sselergebnisse (Hypothese): <?php if ($helptexts['e_hs_businessoutcome']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_hs_businessoutcome'] . "'></i>";
		} ?> <span class="text-danger ml-1">*</span></label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_hs_businessoutcome" id="e_hs_businessoutcome"  <?php echo $disabled; ?>><?php echo(!$e_id ? "" : $epic_info['e_hs_businessoutcome']); ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label for="e_hs_leadingindicators" class="col-3 col-xs-12 col-form-label">Zielf<span>&#252;</span>hrende Indikatoren :<?php if ($helptexts['e_hs_leadingindicators']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_hs_leadingindicators'] . "'></i>";
		} ?> <span class="text-danger ml-1">*</span></label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_hs_leadingindicators" id="e_hs_leadingindicators"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_hs_leadingindicators']); ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label for="e_hs_nfr" class="col-3 col-xs-12 col-form-label">Nicht-funktionale Anforderungen: <?php if ($helptexts['e_hs_nfr']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_hs_nfr'] . "'></i>";
		} ?> <span class="text-danger ml-1">*</span></label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_hs_nfr" id="e_hs_nfr"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_hs_nfr']); ?></textarea>
    </div>
</div>

<h5>Weitergehende Infos</h5>

<div class="form-group row">
    <label for="e_owner" class="col-3 col-xs-12 col-form-label">Epic Owner: <?php if ($helptexts['e_owner']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_owner'] . "'></i>";
		} ?> <span class="text-danger ml-1">*</span></label>

    <div class="col-2 col-xs-12">
        <select class="form-control" name="e_owner" id="e_owner" <?php echo $disabled; ?> >
            <option value="">--bitte w<span>&#228;</span>hlen--</option>
			<?php
			foreach ($staff as $staff_member) {
				if ($staff_member['username']) {
					$staffname = $staff_member['staff_firstname'].' '.$staff_member['staff_lastname'].' ('.$staff_member['username'].')';
				} else {
					$staffname = $staff_member['staff_firstname'].' '.$staff_member['staff_lastname'];
				}
				$selected = !$e_id ? ($_SESSION['login_user_data']['staff_id'] == $staff_member['staff_id'] ? 'selected="selected"' : '') : ($epic_info['e_owner'] == $staff_member['staff_id'] ? 'selected="selected"' : '');
				?>
                <option value="<?php echo $staff_member['staff_id']; ?>" <?php echo $selected; ?>><?php echo $staffname; ?></option>
			<?php } ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="team_id" class="col-3 col-xs-12 col-form-label">Team: <?php if ($helptexts['team_name']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['team_name'] . "'></i>";
		} ?> <span class="text-danger ml-1">*</span></label>

    <div class="col-2 col-xs-12">
        <select class="form-control" name="team_id" id="team_id" <?php echo $disabled; ?>>
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
    <label for="e_notes" class="col-3 col-xs-12 col-form-label">Bemerkung: <?php if ($helptexts['e_notes']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_notes'] . "'></i>";
		} ?></label>

    <div class="col-6 col-xs-12">
        <textarea name="e_notes" id="e_notes" class="form-control"  <?php echo $disabled; ?> ><?php echo !$e_id ? '' : $epic_info['e_notes']; ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label for="watcher" class="col-3 col-xs-12 col-form-label">Watch: </label>
    <input type="hidden" name="watcher" id="watcher" value="<?php echo $is_watching ? 1 : 0;?>">
    <?php
    $class = 'text-secondary';
    if($is_watching){
        $class = "text-success";
    }
    ?>
    <div class="col-6 col-xs-12">
        <i class="fa fa-eye <?php echo $class;?> watch-icon"></i>
    </div>
</div>