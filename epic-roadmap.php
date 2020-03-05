<?php
// Include config
include_once 'config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Collect Data
$teams                    = $db->getTeams();
$selected_team            = ($_GET && $_GET['team']) ? $_GET['team'] : ($teams ? $teams[0]['id'] : 0);
$actual_product_increment = $db->getActualProductIncrement();
$product_increments       = $db->getOtherProductIncrements($actual_product_increment['pi_id']);
$epics                    = $db->getEpicsByTeam($selected_team);

if (!$_SESSION['login_user_data'] || ($_SESSION['login_user_data'] && $_SESSION['login_user_data']['can_edit_roadmap'] == 0)) {
	$error = "You don't have enough permission to view this page.";
}

// Include header
$page_title = 'Epic Roadmap';
$page       = 'epic-roadmap';
include_once F_ROOT . 'parts/layout/head.php';

?>

    <!--Body content-->

    <!-- Auth navigation -->
    <header>
		<?php include_once(F_ROOT . 'parts/header-auth.php'); ?>
    </header>

    <div class="container-fluid mt-3 mb-3">

        <div class="row align-items-center mb-3">
            <!-- Topic select box start -->
            <div class="col-md-8">
                <form method="get" name="filter_team" class="form-horizontal">
                    <div class="form-group row p-3 mb-0">
                        <h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">Epic Roadmap</h2>

                        <div class="col-md-3">
                            <select class="form-control" id="team" name="team">
								<?php foreach ($teams as $team) {
									$selected = $team['id'] == $selected_team ? "selected='selected'" : ""; ?>
                                    <option value="<?php echo $team['id']; ?>" <?php echo $selected; ?>><?php echo $team['name']; ?></option>
								<?php } ?>
                            </select>
                        </div>

                    </div>
                </form>
                <form method="post" action="<?php echo W_ROOT; ?>/form-action.php" name="delete_feature" id="delete_feature" class="form-horizontal">
                    <input type="hidden" id="f_id" name="f_id" value="">
                    <input type="hidden" name="action" class="form-control" id="action" value="feature-delete">
                    <input type="hidden" name="return_url" class="form-control" id="return_url" value="<?php echo W_ROOT . '/epic-roadmap.php'; ?>">
                </form>
            </div>
            <div class="col-md-4 text-right">
                <button type="button" id="decpi" class="btn btn-primary">-1 PI</button>
                <button type="button" id="incpi" class="btn btn-primary">+1 PI</button>
            </div>
        </div>
        <div class="row">
            <!-- Topic select box end -->

            <!-- PM tool start -->
			<?php include_once(F_ROOT . 'parts/epic-pm-tool.php'); ?>
            <!-- PM tool end -->
        </div>
    </div>

<?php
// Include footer
include_once F_ROOT . 'parts/layout/footer.php';