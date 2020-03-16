<?php
$page_title = 'Auth error';
include_once F_ROOT.'parts/layout/head.php';

?>

<div class="container-fluid mt-3 mb-3">
	<div class="row">
		<div class="col-12 text-center">
			<h2>Sorry, leider hast Du keine Berechtigung daf&uuml;r oder bist nicht angemeldet [10]. <br><a href="<?php echo W_ROOT;?>">Login-Maske</a></h2>
		</div>
	</div>
</div>

<?php
// Include footer
include_once F_ROOT.'parts/layout/footer.php';
?>