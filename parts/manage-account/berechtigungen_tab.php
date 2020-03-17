<div class="form-group row mt-3">
    <div class="from-group col-md-6">
        <label for="can_edit_feature" class="col-md-9 col-form-label">Can create and edit Features: <?php if ($helptexts['can_edit_feature']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['can_edit_feature'] . "'></i>";
			} ?> </label>
        <div class="float-right col-md-3">
            <input type="checkbox" name="can_edit_feature" id="can_edit_feature" checked data-toggle="toggle" data-onstyle="success" data-on="Yes" data-off="No" disabled="true">
        </div>
    </div>
    <div class="from-group col-md-6">
        <label for="can_edit_epic" class="col-md-9 col-form-label">Can create and edit Epics: <?php if ($helptexts['can_edit_epic']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['can_edit_epic'] . "'></i>";
			} ?> </label>
        <div class="float-right col-md-3">
            <input type="checkbox" name="can_edit_epic" id="can_edit_epic" checked data-toggle="toggle" data-onstyle="success" data-on="Yes" data-off="No" disabled="true">
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="from-group col-md-6">
        <label for="can_edit_roadmap" class="col-md-9 col-form-label">Can change Roadmap: <?php if ($helptexts['can_edit_roadmap']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['can_edit_roadmap'] . "'></i>";
			} ?> </label>
        <div class="float-right col-md-3">
            <input type="checkbox" name="can_edit_roadmap" id="can_edit_roadmap" data-onstyle="success" <?php if($staff_info['can_edit_roadmap'] == 1 ){ echo 'checked'; } ?> data-toggle="toggle" data-on="Yes" data-off="No" disabled="true">
        </div>
    </div>
    <div class="from-group col-md-6">
        <label for="can_manage_config" class="col-md-9 col-form-label">Can admin the Application: <?php if ($helptexts['can_manage_config']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['can_manage_config'] . "'></i>";
			} ?> </label>
        <div class="float-right col-md-3">
            <input type="checkbox" name="can_manage_config" id="can_manage_config" data-onstyle="success" <?php if($staff_info['can_manage_config'] == 1 ){ echo 'checked'; } ?> data-toggle="toggle" data-on="Yes" data-off="No" disabled="true">
        </div>
    </div>
</div>
