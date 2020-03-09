<?php
include_once 'config.php';

// Include header
$page_title = 'Meine Feature Requests';
include_once F_ROOT.'parts/layout/head.php';
$helptexts        = $db->getHelpText();

// Collect data
$my_frs = $db->getFeatureRequestsBySME($_SESSION['login_user_data']['staff_id']);
?>
	<!--Body content-->

	<!-- Auth navigation -->
	<header>
		<?php include_once(F_ROOT.'parts/header-auth.php'); ?>
	</header>

	<div class="container-fluid mt-3 mb-3">

		<div class="row mb-3">
			<div class="col-12">
				<h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">Meine Features <?php if ($helptexts['title_my_features']) {
				              echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['title_my_features'] . "'></i>";
			               } ?>  </h2>
        
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<?php
				if (isset($_SESSION['feature-request-error'])) {
					$msg = $_SESSION['feature-request-error'];
					unset($_SESSION['feature-request-error']);
					?>
					<div class="alert alert-danger" role="alert">
						<?php echo $msg; ?>
					</div>
					<?php
				}
				if (isset($_SESSION['feature-request-success'])) {
					$msg = $_SESSION['feature-request-success'];
					unset($_SESSION['feature-request-success']);
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
				if ($my_frs) {
					?>
					<table class="table">
						<thead>
						<tr>
							<th>Feature Title</th>
							<th>Status</th>
						</tr>
						</thead>
						<tbody>
						<?php
						foreach($my_frs as $fr){
							?>
							<tr>
								<td><a href="<?php echo W_ROOT.'/feature-request.php?f_id='.$fr['f_id'];?>"><?php echo $fr['f_title'];?></a></td>
								<td><?php echo $fr['f_status'];?></td>
							</tr>
							<?php
						}
						?>
						</tbody>
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
