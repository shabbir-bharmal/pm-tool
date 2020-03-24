<?php
include_once 'config.php';

// Include header
$page_title = 'Jira';

if (!$_SESSION['login_user_data'] || ($_SESSION['login_user_data'] && $_SESSION['login_user_data']['can_manage_config'] == 0)) {
	$error = "Sorry, leider hast Du keine Berechtigung daf&uuml;r oder bist nicht angemeldet [1]. <br><a href='".W_ROOT."'>Login-Maske</a>";
}

include_once F_ROOT.'parts/layout/head.php';


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
				<h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">Jira</h2>
			</div>
		</div>
		
		<div class="row">
			<div class="col-12">
			
			</div>
		</div>
	</div>
	<?php } ?>
<?php
// Include footer
include_once F_ROOT.'parts/layout/footer.php';
