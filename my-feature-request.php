<?php
include_once 'config.php';

// Include header
$page_title = 'My Feature Requests';
include_once F_ROOT.'parts/layout/head.php';

// Collect data
$my_frs = $db->getFeatureRequestsBySME($_SESSION['login_user_data']['staff_id']);
?>
	<!--Body content-->

	<!-- Auth navigation -->
	<header>
		<?php include_once(F_ROOT.'parts/header-auth.php'); ?>
	</header>

	<div class="container-fluid mt-3">

		<div class="row mb-3">
			<div class="col-12">
				<h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">My Feature Requests</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<?php
				if ($my_frs) {
					?>
					<table class="table">
						<thead></thead>
					</table>
					<?php
				} else {
					echo "<p>No Feature Requests found.</p>";
				}
				?>
			</div>
		</div>
	</div>

<?php
// Include footer
include_once F_ROOT.'parts/layout/footer.php';
