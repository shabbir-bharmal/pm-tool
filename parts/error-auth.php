<?php
$page_title = 'Auth error';
include_once F_ROOT.'parts/layout/head.php';

?>

<div class="container-fluid mt-3 mb-3">
	<div class="row">
		<div class="col-12 text-center">
			<h2>Sorry, leider hast Du keine Berechtigung daf&uuml;r oder bist nicht angemeldet</h2>
            Du wirst in <span id="countdown"></span> automatisch zur <a href="<?php echo W_ROOT;?>">Startseite resp. Login-Seite</a> gebracht.
    	

<script>
//Using setTimeout to execute a function after 5 seconds.
setTimeout(function () {
   //Redirect with JavaScript
   window.location.href= '<?php echo W_ROOT;?>';
}, 8000);

//counting down 
//please also update above value (8000)
var seconds = 8, $seconds = document.querySelector('#countdown');
(function countdown() {
    $seconds.textContent = seconds + ' Sekunden' + (seconds == 1 ?  '' :  's')
    if(seconds --> 0) setTimeout(countdown, 1000)
})();
</script>
        
        </div>
	</div>
</div>

<?php
// Include footer
include_once F_ROOT.'parts/layout/footer.php';
?>