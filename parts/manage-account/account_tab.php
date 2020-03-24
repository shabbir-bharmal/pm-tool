<div class="form-group row mt-3">
    <div class="from-group col-md-6">
        <label for="staff_firstname" class="col-md-12 col-form-label">Vorname: <?php if ($helptexts['staff_firstname']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['staff_firstname'] . "'></i>";
			} ?> </label>

        <div class="col-md-12">
            <input type="text" name="staff_firstname" id="staff_firstname" class="form-control valid" value="<?php echo(!$login_id ? "" : $staff_info['staff_firstname']); ?>" aria-invalid="false" <?php echo $disabled; ?>>
        </div>
    </div>
    <div class="from-group col-md-6">
        <label for="staff_lastname" class="col-md-12 col-form-label">Nachname: <?php if ($helptexts['staff_lastname']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['staff_lastname'] . "'></i>";
			} ?> </label>

        <div class="col-md-12">
            <input type="text" name="staff_lastname" id="staff_lastname" class="form-control valid" value="<?php echo(!$login_id ? "" : $staff_info['staff_lastname']); ?>" aria-invalid="false" <?php echo $disabled; ?>>
        </div>
    </div>
</div>
<div class="form-group row mt-3">
    <div class="from-group col-md-6">
        <label for="email" class="col-md-12 col-form-label">Email: <?php if ($helptexts['email']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['email'] . "'></i>";
			} ?> </label>

        <div class="col-md-12">
            <input type="text" name="email" id="email" class="form-control valid" value="<?php echo(!$login_id ? "" : $staff_info['email']); ?>" aria-invalid="false" <?php echo $disabled; ?>>
        </div>
    </div>
    <div class="from-group col-md-6">
        <label for="username" class="col-md-12 col-form-label">K&uuml;rzel (Login): <?php if ($helptexts['username']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['username'] . "'></i>";
			} ?> </label>

        <div class="col-md-12">
            <input type="text" name="username" id="username" class="form-control valid" value="<?php echo(!$login_id ? "" : $staff_info['username']); ?>" aria-invalid="false" disabled="disabled">
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="from-group col-md-6">
        <label for="password" class="col-md-12 col-form-label">Passwort: <?php if ($helptexts['password']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['password'] . "'></i>";
			} ?> </label>

        <div class="col-md-12">
            <input type="password" name="password_new" id="password_new" class="form-control valid" value="" aria-invalid="false" <?php echo $disabled; ?>>
        </div>
    </div>
    <div class="from-group col-md-6">
        <label for="confirm_password" class="col-md-12 col-form-label">Passwort best&auml;tigen: <?php if ($helptexts['confirm_password']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['confirm_password'] . "'></i>";
			} ?> </label>

        <div class="col-md-12">
            <input type="password" name="confirm_password" id="confirm_password" class="form-control valid" value="" aria-invalid="false" <?php echo $disabled; ?>>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="container">
        <div class="col-md-6">
            <div class="form-group">
                <label>Upload Avatar</label>
                <div class="input-group">
                    <span class="input-group-btn">
                         <input type="file" id="avatarImg" accept="image/*" name="avatarImg">
                    </span>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <img id='img-upload' class="rounded-circle" src="<?php echo ($staff_info['staff_avatar'])?$staff_info['staff_avatar']:''; ?>"/>
        </div>
    </div>
</div>