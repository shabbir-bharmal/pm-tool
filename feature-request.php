<?php
include_once 'config.php';

// Include header
$page = 'feature-request';
$page_title = 'Feature Request';
include_once F_ROOT.'parts/layout/head.php';

$msg = '';
if($_SESSION['feature-request-error']){

}
?>
	<!--Body content-->

	<!-- Auth navigation -->
	<header>
		<?php include_once(F_ROOT.'parts/header-auth.php'); ?>
	</header>

	<div class="container-fluid mt-3">

		<div class="row mb-3">
			<div class="col-12">
				<h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">Feature Request</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-12"><?php include_once(F_ROOT.'parts/feature-request-form.php'); ?></div>
		</div>
	</div>

<?php
// Include footer
include_once F_ROOT.'parts/layout/footer.php';
