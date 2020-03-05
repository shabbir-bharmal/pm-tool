<?php
// Include config
include_once 'config.php';

$error = '';
if (isset($_SESSION['error'])) {
	$error = $_SESSION['error'];
	unset($_SESSION['error']);
}

if (isset($_SESSION['login_user_data'])) {
	header("location:".W_ROOT."/roadmap.php");
}

// Include header
$page_title = 'Login';
include_once F_ROOT.'parts/layout/head.php';
?>

	<!--Body content-->
	<div class="container-fluid mt-3 ">
		<?php include_once(F_ROOT.'parts/login-form.php'); ?>
	</div>

<?php
// Include footer
include_once F_ROOT.'parts/layout/footer.php';
