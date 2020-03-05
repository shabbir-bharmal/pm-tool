<?php
// Include config
include_once 'config.php';

// Collect Data
$topics                   = $db->getTopics();
$selected_topic           = ($_GET && $_GET['topic']) ? $_GET['topic'] : ($topics ? $topics[0]['id'] : 0);
$actual_product_increment = $db->getActualProductIncrement();
$product_increments       = $db->getOtherProductIncrements($actual_product_increment['pi_id']);
$staff_members            = $db->getStaffByTopic($selected_topic);

if (!$_SESSION['login_user_data'] || ($_SESSION['login_user_data'] && $_SESSION['login_user_data']['can_edit_roadmap'] == 0)) {
	$error = "You don't have enough permission to view this page.";
}

// Include header
$page_title = 'Feature Roadmap';
include_once F_ROOT.'parts/layout/head.php';
?>
	<!--Body content-->

	<!-- Auth navigation -->
	<header>
		<?php include_once(F_ROOT.'parts/header-auth.php'); ?>
	</header>

	<div class="container-fluid mt-3 mb-3">

		<div class="row align-items-center mb-3">
			<!-- Topic select box start -->
			<div class="col-md-8">
				<form method="get" name="filter_topic" class="form-horizontal">
					<div class="form-group row p-3 mb-0">
						<h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">Feature Roadmap</h2>

						<div class="col-md-3">
							<select class="form-control" id="topic" name="topic">
								<?php foreach ($topics as $topic) {
									$selected = $topic['id'] == $selected_topic ? "selected='selected'" : ""; ?>
									<option value="<?php echo $topic['id']; ?>" <?php echo $selected; ?>><?php echo $topic['name']; ?></option>
								<?php } ?>
							</select>
						</div>

					</div>
				</form>
				<form method="post" action="<?php echo W_ROOT; ?>/form-action.php" name="delete_feature" id="delete_feature" class="form-horizontal">
					<input type="hidden" id="f_id" name="f_id" value="">
					<input type="hidden" name="action" class="form-control" id="action" value="feature-delete">
					<input type="hidden" name="topic_id" value="<?php echo $selected_topic; ?>">
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
			<?php include_once(F_ROOT.'parts/pm-tool.php'); ?>
			<!-- PM tool end -->
		</div>
	</div>

<?php
// Include footer
include_once F_ROOT.'parts/layout/footer.php';