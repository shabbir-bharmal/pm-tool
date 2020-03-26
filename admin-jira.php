<?php
include_once 'config.php';

// Include header
$page_title = 'Jira';
$page       = 'admin-jira';
if (!$_SESSION['login_user_data'] || ($_SESSION['login_user_data'] && $_SESSION['login_user_data']['can_manage_config'] == 0)) {
	$error = "Sorry, leider hast Du keine Berechtigung daf&uuml;r oder bist nicht angemeldet [1]. <br><a href='" . W_ROOT . "'>Login-Maske</a>";
}

include_once F_ROOT . 'parts/layout/head.php';


?>
    <!--Body content-->

    <!-- Auth navigation -->
    <header>
		<?php include_once(F_ROOT . 'parts/header-auth.php'); ?>
    </header>

<?php if (!$can_manage_config) { ?>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12 text-center">
                <h2><?php echo $error; ?></h2>
            </div>
        </div>
    </div>
<?php } else {
	$getepicss        = $db->getEpics();
	$allepics = array();
	foreach ($getepicss as $epic){
		$allepics[$epic['e_id']] = $epic['e_title'];
    }
	$feature_statuses = $db->getFeatureStatuses();
	$feature_types = $db->getFeatureType();
	$alltypes = array();
	foreach ($feature_types as $f_type){
		$alltypes[$f_type['id']] = $f_type['name'];
    }
	
	$selected_epic = $_GET['epic'];
	$selected_status = $_GET['f_status_id'];
	?>
    <div class="container-fluid mt-3 mb-3">

        <div class="row mb-3">
            <div class="col-12">
                <h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">Jira</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form method="get" name="filter_epic_feature" class="form-horizontal col-md-9">
                    <div class="form-group row p-3 mb-0">
                        <div class="col-md-3">
                            <select class="form-control" id="epic" name="epic">
                                <option value="">--bitte w<span>&#228;</span>hlen--</option>
								<?php
								foreach ($getepicss as $gepics) {
									$selected = $gepics['e_id'] == $selected_epic ? "selected='selected'" : ""; ?>
                                    ?>
                                    <option value="<?php echo $gepics['e_id']; ?>" <?php echo $selected; ?>><?php echo $gepics['e_title']; ?></option>
									<?php
								}
								?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="f_status_id" id="f_status_id" <?php echo $disabled; ?>>
                                <option value="">--bitte w<span>&#228;</span>hlen--</option>
								<?php
								foreach ($feature_statuses as $feature_status) {
									$selected = ($selected_status == $feature_status['id'] ? 'selected="selected"' : ''); ?>
                                    <option value="<?php echo $feature_status['id']; ?>" <?php echo $selected; ?>><?php echo $feature_status['name']; ?></option>
								<?php } ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
    <div class="container-fluid mt-3 mb-3">
        <div class="row mb-3">
            <div class="col-12">
                <h2 class="m-0">Matched Jira With PM Feature</h2>
            </div>
        </div>
        <div class="row m-0">
			<?php include_once(F_ROOT.'parts/manage-jira/matched-jira-pm.php'); ?>
        </div>
    </div>
    <div class="container-fluid mt-3 mb-3">
        <div class="row mb-3">
            <div class="col-12">
                <h2 class="m-0">None Matched Jira</h2>
            </div>
        </div>
        <div class="row m-0">
			<?php include_once(F_ROOT.'parts/manage-jira/non-matched-jira.php'); ?>
        </div>
    </div>
    <div class="container-fluid mt-3 mb-3">
        <div class="row mb-3">
            <div class="col-12">
                <h2 class="m-0">None Matched PM Feature</h2>
            </div>
        </div>
        <div class="row m-0">
			<?php include_once(F_ROOT.'parts/manage-jira/non-matched-pm.php'); ?>
        </div>
    </div>
<?php } ?>
<?php
// Include footer
include_once F_ROOT . 'parts/layout/footer.php';
