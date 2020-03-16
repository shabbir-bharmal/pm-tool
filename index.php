<?php
// Include config
include_once 'config.php';

$error = '';
if (isset($_SESSION['error'])) {
	$error = $_SESSION['error'];
	unset($_SESSION['error']);
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
				<h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">PM.mastaz.ch
                    <span class="h6" style="display: inline-flex;vertical-align: middle;">
        			       <?php if ($helptexts['title_welcome']) {
				              echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['title_welcome'] . "'></i>";
			               } ?>                    
                    </span></h2>
			</div>
		</div>

		<div class="row">
			<div class="col-12">Hallo <?php echo $name;?>, willkommen zur&uuml;ck!</div>
      <div class="col-12">
        <br /><h3>Wichtige Hinweise</h3>
        <ul>
          <li>Applikation ist in Entwicklung, Beta Stadium</li>
          <li>Bei den Kapazit&auml;ts-Angabe (wie viele Kapazit&auml;t wir pro PI verplanen k&ouml;nnen) ist zu beachten, dass dies erste, gesch&auml;tzte Zahlen sind.</li>
        </ul>
        <?php if($_SESSION['login_user_data']['username']=="scho"){ ?>
        <h3>Kurze Info f&uuml;r Dich, <?php echo $name;?></h3>
        <ul> 
        <li>Du kannst am besten unter <a href="https://pm.mastaz.ch/epic-roadmap.php">Roadmaps nach (Epics) </a> nachschauen, welche Features in den n&auml;chsten PIs vorgesehen sind. Alternativ kannst Du aber auch unter <a href="https://pm.mastaz.ch/roadmap.php">Roadmaps nach (Topics)</a> Dir dies anschauen.</li>
        <li>In der Auswahlliste neben dem Titel (z.B. Roadmap (nach Epics)) kannst Du das Team w&auml;hlen und die Anzeige dann einschr&auml;nken.</li>
        </ul>
        <br><font color=red>Nachfolgende Infos sind nicht so 'wichtig' und sind nicht zwingend zu lesen:</font><br />&nbsp;
        <?php } ?>
		  
        <?php if($_SESSION['login_user_data']['username']=="rudl"){ ?>
        <font color=red>
		  <h3>Kurze Info f&uuml;r Dich, <?php echo $name;?></h3>
        <ul> 
        <li>Du kannst unter <a href="https://pm.mastaz.ch/roadmap.php">Roadmaps (nach Topics)</a> (auf Team Ebene, nicht auf Topics) neue Features erfassen und editieren. Auch kannst Du sie dort einem PI zuordnen. Wichtige Felder zum Ausf&uuml;llen sind: Titel, Epic und Topic.</li>
        <li>Unter <a href="https://pm.mastaz.ch/roadmap.php">Roadmaps (nach Topics) </a> kannst Du die Roadmaps nach Epics einsehen (Du kannst zwar die Features editieren, aber nicht verschieben (einem PI zuweisen)).</li>
		<li>Unter <a href="https://pm.mastaz.ch/roadmap.php">Roadmaps (nach Topics) </a> kannst Du die Roadmaps nach Epics einsehen (Du kannst zwar die Features editieren, aber nicht verschieben (einem PI zuweisen)).</li>
		<li>Unter <a href="https://pm.mastaz.ch/my-epic.php">Epics > Meine Epics </a> kannst Du Deine Epics einsehen (und editeiren)).</li>
        </ul>
        <br>Nachfolgende Infos sind nicht so 'wichtig' und sind nicht zwingend zu lesen:</font><br />&nbsp;
        <?php } ?>		  
        <h3>Kurze Infos zu den Menu-Punkten</h3>       
        <h4>Epics</h4>
        <ul>
        <li>Epics sind Projekte resp. RfCs, die nicht in einem Product Increment umgesetzt werden k&ouml;nnen (1 Product Increment dauert 10 Wochen).</li>
        <li>Du kannst unter 'Epics' > 'Neuer Epic erfassen' neue Epics erfassen und per Knopfdruck vorschlagen/beantragen. Es wird ein Email an den PM des entsprechenden Teams ausgel&ouml;st. Er wird dann die Anfrage pr&uuml;fen.</li>
        <li>Unter 'Epics' > 'Meine Epics' sind alle Epics aufgelistet, wo Du als 'Epic Owner' definiert wurdest. Diese kannst Du &ouml;ffnen und editieren.</li>
        </ul>
        <h4>Features</h4>
        <ul>
        <li>Features sind Projekt-Arbeitspakete resp. RfCs, die  in einem Product Increment umgesetzt werden k&ouml;nnen (1 Product Increment dauert 10 Wochen).</li>
        <li>Du kannst unter 'Features' > 'Neuer Feature erfassen' neue Features erfassen und per Knopfdruck vorschlagen/beantragen. Es wird ein Email an den PM des entsprechenden Teams ausgel&ouml;st. Er wird dann die Anfrage pr&uuml;fen.</li>
        <li>Unter 'Features' > 'Meine Features' sind alle Features aufgelistet, wo Du als 'Anspechsperson' (Subject Matter Experts (SME)) definiert wurdest. Diese kannst Du &ouml;ffnen und editieren.</li>
        </ul>
 
        <h4>Roadmaps</h4>
        <ul>
        <li>Unter 'Roadmaps' > 'nach Epics' kannst Du sehen, in welchem PI (Product Increment) die entsprechenden Features eingeplant sind (Gruppiert nach Teams > Epics).</li>
        <li>Unter 'Roadmaps' > 'nach Topics' kannst Du sehen, in welchem PI (Product Increment) die entsprechenden Features eingeplant sind (Gruppiert nach Teams > Topics).</li>
        'Topics' sind Themenfelder wie z.B. FM, Evento, PLP. Die beiden Punkte 'PM SM' und 'PM SA' stehen für Product-Management Scool Management resp. Admin und sind Features, die keinem spezifischen Topic zugewiesen werden können. In der Regel ist ein Topic einem Team zugewiesen.</li>
        <?php if($can_edit_roadmap == 1){ ?>
        <font color="blue">
        <li>Du bist berechtigt, die Features in der Roadmap zu editieren.</li>  
        <li>Du bist berechtigt, die Roadmaps zu erstellen (definerieren, in welchem PI was eingeplant werden soll). Dies ist ausschliesslich unter 'Roadmaps' > 'nach Topics' m&ouml;glich.</li>          
        </font>
        <?php } ?>      
        </ul>
        <?php if($can_manage_config == 1){ ?>

        <font color="blue">
        <h4>Admin</h4>
        <ul>
        <li>Du bist berechtigt, unter Admin diverse Punkte zu administrieren resp. konfigurieren.</li>
        <li>Unter Config befinden sich ein paar Scripte, zur Datenbereinigung.</li>
        <li>Bei den restlichen Punkten kannst Du &uuml;ber Grids Daten managen aber auch Daten exportieren.</li>
        </font>
        </ul>
        <?php } ?>                           

        <h3>Allgemeine Hinweise</h3>
        <ul>
        <li>Diese Applikation wurd von Philipp W&uuml;rmil privat entwickelt. Es kann sein, sobald die ICT eine ad&auml;quate L&ouml;sung anbietet, dass diese abgel&ouml;st wird.</li>
        <li>Feedbacks zur Applikation sowie &auml;nderungs&uuml;nsche k&ouml;nnen gerne an <a href="mailto:wurp@zhaw.ch">wurp@zhaw.ch</a> gesendet werden.</li>
        </ul>
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
		<?php include_once(F_ROOT.'parts/login-form.php'); ?>
	</div>

<?php
} 
// Include footer
include_once F_ROOT.'parts/layout/footer.php';
