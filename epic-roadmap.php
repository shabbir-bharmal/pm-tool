<?php
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
$teams                    = $db->getTeams();
$selected_team            = ($_GET && $_GET['team']) ? $_GET['team'] : ($teams ? $teams[0]['id'] : 0);
$actual_product_increment = $db->getActualProductIncrement();
$product_increments       = $db->getOtherProductIncrements($actual_product_increment['pi_id']);
$epics                    = $db->getEpicsByTeam($selected_team);
$helptexts                = $db->getHelpText();
$selected_epic            = ($_GET && $_GET['epic']) ? $_GET['epic'] : '';

if (!$_SESSION['login_user_data'] || ($_SESSION['login_user_data'] && $_SESSION['login_user_data']['can_edit_roadmap'] == 0)) {
	$error = "Sorry, leider hast Du keine Berechtigung daf&uuml;r oder bist nicht angemeldet [9]. <br><a href='".W_ROOT."'>Login-Maske</a>";
  
}

// Include header
$page_title = 'Roadmap (nach Epics)';
$page       = 'epic-roadmap';
include_once F_ROOT . 'parts/layout/head.php';

?>

    <!--Body content-->

    <!-- Auth navigation -->
    <header>
		<?php include_once(F_ROOT . 'parts/header-auth.php'); ?>
    </header>

    <div class="container-fluid mt-3 mb-3">

        <div class="row align-items-center mb-3">
            <!-- Topic select box start -->
            <div class="col-md-8">

                <div class="form-group row p-3 mb-0">
                    <h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">Roadmap (nach Epics) <?php if ($helptexts['title_roadmap_topics']) {
							echo "<span class=\"h6\" style=\"display: inline-flex;vertical-align: middle;\"><i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['title_roadmap_topics'] . "'></i></span>";
						} ?> </h2>
                    <form method="get" name="filter_team" class="form-horizontal col-md-3">
                        
                            <select class="form-control" id="team" name="team">
								<?php foreach ($teams as $team) {
									$selected = $team['id'] == $selected_team ? "selected='selected'" : ""; ?>
                                    <option value="<?php echo $team['id']; ?>" <?php echo $selected; ?>><?php echo $team['name']; ?></option>
									<?php
								} ?>
                            </select>
                        
                    </form>
                    <div class="col-md-3">
                        <select class="form-control" id="epic" name="epic">
                            <option value="">--bitte w<span>&#228;</span>hlen--</option>
							<?php
							$getepics = $db->getEpicsByTeam($selected_team);
							foreach ($getepics as $gepics) {
								$selected = $gepics['e_id'] == $selected_epic ? "selected='selected'" : ""; ?>
                                ?>
                                <option value="<?php echo $gepics['e_id']; ?>" <?php echo $selected; ?>><?php echo $gepics['e_title']; ?></option>
								<?php
							}
							?>
                        </select>
                    </div>

                </div>
                <form method="post" action="<?php echo W_ROOT; ?>/form-action.php" name="delete_feature" id="delete_feature" class="form-horizontal">
                    <input type="hidden" id="f_id" name="f_id" value="">
                    <input type="hidden" name="action" class="form-control" value="feature-delete">
                    <input type="hidden" name="return_url" class="form-control" id="return_url" value="<?php echo W_ROOT . '/epic-roadmap.php'; ?>">
                </form>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-2 text-right">
                <select class="form-control" id="event" name="event">
                    <option value="">--Anzeige <span>&#228;</span>ndern--</option>
                    <option value="incpi">+ ein PI anzeigen</option>
                    <option value="decpi">- ein PI entfernen</option>
					<?php
					if($_SESSION['show_all'] == 'scrollable'){ ?>
                        <option value="show_all">H<span>&#246;</span>he vergr<span>&#246;</span>ssern</option>
					<?php }else{ ?>
                        <option value="show_all">H<span>&#246;</span>he minimieren</option>
					<?php }
					if($_SESSION['expand'] == 'height0'){ ?>
                        <option value="expand">Kurzbeschreibung anzeigen</option>
					<?php }else{ ?>
                        <option value="expand">Kurzbeschreibung ausblenden</option>
					<?php }  ?>
                </select>
            </div>
        </div>
        <div class="row">
            <!-- Topic select box end -->

            <!-- PM tool start -->
			<?php include_once(F_ROOT . 'parts/epic-pm-tool.php'); ?>
            <!-- PM tool end -->
        </div>
    </div>

<?php
// Include footer
include_once F_ROOT . 'parts/layout/footer.php';