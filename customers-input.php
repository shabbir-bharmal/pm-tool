<?php
include_once 'config.php';

// Include header
$page       = 'customers-input';
$page_title = 'Customers Input';
if (!$_SESSION['login_user_data']) {
	if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
		$actual_link = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	} else {
		$actual_link = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	}
	$_SESSION['redirect_url'] = $actual_link;
}
if (!$_SESSION['login_user_data'] || ($_SESSION['login_user_data'] && $_SESSION['login_user_data']['can_edit_customers_inputs'] == 0)) {
	$error = "Sorry, leider hast Du keine Berechtigung daf&uuml;r oder bist nicht angemeldet [1]. <br><a href='" . W_ROOT . "'>Login-Maske</a>";
}

$can_edit_customers_inputs = $_SESSION['login_user_data']['can_edit_customers_inputs'];


include_once F_ROOT . 'parts/layout/head.php';
$helptexts        = $db->getHelpText();

?>
    <!--Body content-->
    <!-- Auth navigation -->
    <header>
		<?php include_once(F_ROOT . 'parts/header-auth.php'); ?>
    </header>
<?php if (!$can_edit_customers_inputs) { ?>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12 text-center">
                <h2><?php echo $error; ?></h2>
            </div>
        </div>
    </div>
<?php } else { ?>
	<?php include_once(F_ROOT . 'parts/customers-input-grid.php'); ?>
<?php } ?>
<?php
// Include footer
include_once F_ROOT . 'parts/layout/footer.php';