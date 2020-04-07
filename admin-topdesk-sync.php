<?php

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

	$datagrid_included="yes";



// Include config
include_once 'config.php';

if(!$_SESSION['login_user_data']){
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
		$actual_link = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	} else {
		$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}
	$_SESSION['redirect_url'] = $actual_link;
}

// Collect Data

$selected_team            = ($_GET && $_GET['team']) ? $_GET['team'] : ($teams ? $teams[0]['id'] : 1);
$selectedtopic            = ($_GET && $_GET['topic']) ? $_GET['topic'] : ($topics ? $topics[0]['id'] : 0);
$actual_product_increment = $db->getActualProductIncrement();
$product_increments       = $db->getOtherProductIncrements($actual_product_increment['pi_id']);
//$staff_members            = $db->getStaffByTopic($selected_topic);
$staff_members = $db->getStaffByTeam($selected_team);
if ($selectedtopic != 0) {
	$staff_members = $db->getStaffByTeamAndTopic($selected_team, $selectedtopic);
}

$helptexts = $db->getHelpText();
$teams     = $db->getTeams();
$topics    = $db->getTopicsByTeam($selected_team);



if (!$_SESSION['login_user_data'] || ($_SESSION['login_user_data'] && $_SESSION['login_user_data']['can_edit_roadmap'] == 0)) {
	$error = "Sorry, leider hast Du keine Berechtigung daf&uuml;r oder bist nicht angemeldet [11]. <br><a href='" . W_ROOT . "'>Login-Maske</a>";
}

// Include header
$page_title = 'Jira Importer';      
include_once F_ROOT . 'parts/layout/head.php';



	// including import controller file
	include './controllers/import-controller-topdesk.php';

    // creating object of import controller and passing connection object as a parameter
	$importCtrl      =    	new ImportController($conn);
?>
    <!--Body content-->

    <!-- Auth navigation -->
    <header>
		<?php include_once(F_ROOT . 'parts/header-auth.php'); ?>
    </header>

    <div class="container-fluid mt-3 mb-3">

        <div class="row align-items-center mb-3">
            <!-- Topic select box start -->
            <div class="col-md-12">
            
            
                                    <h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">Import TopDesk
                            <span class="h6" style="display: inline-flex;vertical-align: middle;">
        			       <?php if ($helptexts['title_import_topdesk']) {
							   echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['title_import_topdesk'] . "'></i>";
						   } ?>
                    </span>
                        </h2>
                        </div>  </div>
            
       <div class="row align-items-center mb-3">
            <!-- Topic select box start -->
            <div class="col-md-12">            
            



            	<div class="container-fluid mt-3 mb-3">
            		<form method="post" enctype="multipart/form-data">
            			<div class="row">
            				<div class="col-md-4">
                      <div class="row">
                        <div class="col-md-12 border shadow">
                					<label> Import Data </label>
                						<div class="form-group">					
                							<input type="file" name="file" class="form-control" style="margin-bottom:5px;height:45px;">
                						</div>
                						<div class="form-group">
                							<button type="submit" name="import" class="btn btn-primary">Daten importieren</button>
                              </form>
                              <button type='button' id="helpbutton" class="btn btn-primary ml-2">?</button>
                              
                						</div>				
                				</div>	
                      </div>
                    </div>
            				<div class="col-md-1">
            					&nbsp;
 			
            				</div>
            				<div class="col-md-7 border shadow"  id="helpbox"  style="display:none">
            					<h4>Kurzanleitung</h4>
                      <font color="red">ERKLÄREN UM WAS ES GEHT, WAS IMPORTIERT WIRD UND WIE ES VERARBEITET WIRD!</font>
                      <ol>
                        <li>Auswahl aufrufen im TopDesk:  <a href="https://servicedesk.zhaw.ch/" target="_blank">RfC Evento</a>
                        <br />&nbsp;
                        
                          <textarea id="columnorder"style="width:100%;" rows="4">Selektiere alle 2nd-Level-Incidents 	
die als	Incidentart	gleich 'RFC (request for change)' haben	 	
und 		
die sind erstellt nach '1. August 2019 19:00'</textarea>
                          <button type="button" id="copy_to_clipboard" onclick="CopyToClipboard('columnorder')" style="font-size: 10px;float:right;margin-top:4px;margin-left:5px;"><i class="fa fa-copy"></i></button>                        
                          <br />&nbsp;
                        
                        
                        </li>
                        <li>Exportieren<br />
                          <ul>
                            <li>Memofelder anzeigen > Nicht anzeigen</li>
                            <li>CSV</li>
                            <li>Als Separator ist , zu verwenden (Komma)</li>
                          </ul>
                          <br />
                        </li>
                        <li>File pr&uuml;fen:<br />
                          Die Reihenfolge der Felder/Spalten muss folgende sein:<br />
                          <textarea id="columnorder"style="width:100%;">Incidentnummer, Kurzbeschreibung (Details), Incidentart, Name Anmelder,	Status,	Bearbeiter,	Termin,	Auswirkung,	Kategorie,	Unterkategorie,	Bearbeitergruppe,	Departement,	Erstelldatum/-zeit</textarea>
                          <button type="button" id="copy_to_clipboard" onclick="CopyToClipboard('columnorder')" style="font-size: 10px;float:right;margin-top:4px;margin-left:5px;"><i class="fa fa-copy"></i></button>
                          <br />&nbsp;
                        </li>
                        <li>Hier importieren
                        <br />&nbsp;
                        </li>
                      </ol>
                      <button type='button' id="helpclose" class="btn btn-primary ml-2">schliessen</button><br />&nbsp;
            				</div>	
                    	
            			</div>
            
            			<div class="row mt-4">
            				<div class="col-md-12 m-auto border shadow">
            					<?php
            
            						$importResult   =  $importCtrl->index(); 	
            											
            					?>
            				</div>
            			</div>	
            	</div>
            
            




        </div>
    </div>
</div>
<?php
// Include footer
include_once F_ROOT . 'parts/layout/footer.php';
?>

<script>
$(document).ready(function(){
  $("#helpbutton").click(function(){
    $("#helpbox").show();
  });
});

$(document).ready(function(){
  $("#helpclose").click(function(){
    $("#helpbox").hide();
  });
});                                              
</script>

<script type="text/javascript">
function CopyToClipboard(containerid) {
    if (window.getSelection) {
        if (window.getSelection().empty) { // Chrome
            window.getSelection().empty();
        } else if (window.getSelection().removeAllRanges) { // Firefox
            window.getSelection().removeAllRanges();
        }
    } else if (document.selection) { // IE?
        document.selection.empty();
    }

    if (document.selection) {
        var range = document.body.createTextRange();
        range.moveToElementText(document.getElementById(containerid));
        range.select().createTextRange();
        document.execCommand("copy");
    } else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById(containerid));
        window.getSelection().addRange(range);
        document.execCommand("copy");
    }
}           
</script>  