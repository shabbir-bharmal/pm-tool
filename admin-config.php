<?php
include_once 'config.php';

// Include header
$page_title = 'Config';

if (!$_SESSION['login_user_data'] || ($_SESSION['login_user_data'] && $_SESSION['login_user_data']['can_manage_config'] == 0)) {
	$error = "You don't have enough permission to view this page.";
}

include_once F_ROOT.'parts/layout/head.php';

// Collect data
$my_epics = $db->getEpicsByOwner($_SESSION['login_user_data']['staff_id']);
?>
	<!--Body content-->

	<!-- Auth navigation -->
	<header>
		<?php include_once(F_ROOT.'parts/header-auth.php'); ?>
	</header>

	<?php	if(!$can_manage_config){ ?>
	<div class="container-fluid mt-3">
		<div class="row">
			<div class="col-12 text-center">
				<h2><?php echo $error;?></h2>
			</div>
		</div>
	</div>
	<?php } else { ?>
	<div class="container-fluid mt-3 mb-3">

		<div class="row mb-3">
			<div class="col-12">
				<h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">Config</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-8 col-sm-8 col-xs-12">
				<?php
				if (isset($_SESSION['check-capacity-error'])) {
					$msg = $_SESSION['check-capacity-error'];
					unset($_SESSION['check-capacity-error']);
					?>
					<div class="alert alert-danger" role="alert">
						<?php echo $msg; ?>
					</div>
					<?php
				}
				if (isset($_SESSION['check-capacity-success'])) {
					$msg = $_SESSION['check-capacity-success'];
					unset($_SESSION['check-capacity-success']);
					?>
					<div class="alert alert-success" role="alert">
						<?php echo $msg; ?>
					</div>
					<?php
				}
				?>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<form name="check-capacity-form" id="check-capacity-form" method="post" action="form-action.php">
					<input type="hidden" name="action" value="check-capacity">
					<button name="submit" class="btn btn-primary">Kapazit<span>&#xE4;</span>tstabelle <span>&#xFC;</span>berpr<span>&#xFC;</span>fen</button>
				</form>
			</div>
		</div>
	</div>
	<?php } ?>
<?php
// Include footer
include_once F_ROOT.'parts/layout/footer.php';
