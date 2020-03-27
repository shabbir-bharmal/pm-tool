<?php
// Include config
include_once 'config.php';

$error = '';
if (isset($_SESSION['error'])) {
	$error = $_SESSION['error'];
	unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
	$success = $_SESSION['success'];
	unset($_SESSION['success']);
}

if (isset($_SESSION['login_user_data'])) {

// Include header
$page       = 'index';
$page_title = 'Welcome';
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
			Ups, Du bist schon angemeldet und willst Dir ein neues Passwort zusenden? <br />
            Du kannst auch oben rechts auf das Zahnrad klicken und Dir ein neues Passwort setzen.
            	
		</div>
	</div>
    </div>

<?php




}else{

// Include header
$page_title = 'Login';
include_once F_ROOT.'parts/layout/head.php';
?>

	<!--Body content-->
	<div class="container-fluid mt-3 ">
		<?php include_once(F_ROOT.'parts/forgotten-pw-form.php'); ?>
	</div>

<?php
} 
// Include footer
include_once F_ROOT.'parts/layout/footer.php';
