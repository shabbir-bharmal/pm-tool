<?php
include_once 'config.php';

// Include header
$page       = 'epic-request';
$page_title = 'Epic Request';
include_once F_ROOT.'parts/layout/head.php';
$helptexts        = $db->getHelpText();
?>
	<!--Body content-->
	<!-- Auth navigation -->
	<header>
		<?php include_once(F_ROOT.'parts/header-auth.php'); ?>
	</header>

	<div class="container-fluid mt-3 mb-3">

		<div class="row mb-3">
			<div class="col-12">
				<h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">Epic Request
                    <span class="h6" style="display: inline-flex;vertical-align: middle;">
        			       <?php if ($helptexts['title_epic_request_form']) {
				              echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['title_epic_request_form'] . "'></i>";
			               } ?>                    
                    </span></h2>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-8 col-sm-8 col-xs-12">
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
			<div class="col-12"><?php include_once(F_ROOT.'parts/epic-request-form.php'); ?></div>
		</div>
	</div>

<?php
// Include footer
include_once F_ROOT.'parts/layout/footer.php';
