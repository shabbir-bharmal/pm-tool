<?php
include_once 'config.php';

// Include header
$page_title = 'Meine Epics';
include_once F_ROOT.'parts/layout/head.php';
$helptexts        = $db->getHelpText();

// Collect data
$my_epics = $db->getEpicsByOwner($_SESSION['login_user_data']['staff_id']);

?>
	<!--Body content-->

	<!-- Auth navigation -->
	<header>
		<?php include_once(F_ROOT.'parts/header-auth.php'); ?>
	</header>

	<div class="container-fluid mt-3 mb-3">

		<div class="row mb-3">
			<div class="col-12">
				<h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">Meine Epics <?php if ($helptexts['title_my_epics']) {
				              echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['title_my_epics'] . "'></i>";
			               } ?>  </h2>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<?php
				if (isset($_SESSION['epic-request-error'])) {
					$msg = $_SESSION['epic-request-error'];
					unset($_SESSION['epic-request-error']);
					?>
					<div class="alert alert-danger" role="alert">
						<?php echo $msg; ?>
					</div>
					<?php
				}
				if (isset($_SESSION['epic-request-success'])) {
					$msg = $_SESSION['epic-request-success'];
					unset($_SESSION['epic-request-success']);
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
				<?php
				if ($my_epics) {
					?>
					<table class="table">
						<thead>
						<tr>
							<th>Epic Title</th>
							<th>Status</th>
						</tr>
						</thead>
						<tbody>
						<?php
						foreach($my_epics as $epic){
							?>
							<tr>
								<td><a href="<?php echo W_ROOT.'/epic-request.php?e_id='.$epic['e_id'];?>"><?php echo $epic['e_title'];?></a></td>
								<td><?php echo $epic['e_status'];?></td>
							</tr>
							<?php
						}
						?>
						</tbody>
					</table>
					<?php
				} else {
					echo "<p>No Epics found.</p>";
				}
				?>
			</div>
		</div>
	</div>

<?php
// Include footer
include_once F_ROOT.'parts/layout/footer.php';
