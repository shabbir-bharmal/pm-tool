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
$page_title = 'Roadmap (nach Topics)';
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
                <form method="get" name="filter_topic" class="form-horizontal">
                    <div class="form-group row p-3 mb-0">
                        <h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">Roadmap (nach Topics)
                            <span class="h6" style="display: inline-flex;vertical-align: middle;">
        			       <?php if ($helptexts['title_roadmap_topics']) {
							   echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['title_roadmap_topics'] . "'></i>";
						   } ?>
                    </span>
                        </h2>


                        <div class="col-md-3">
                            <select class="form-control" id="team" name="team">
								<?php foreach ($teams as $team) {
									$selected = $team['id'] == $selected_team ? "selected='selected'" : ""; ?>
                                    <option value="<?php echo $team['id']; ?>" <?php echo $selected; ?>><?php echo $team['name']; ?></option>
									<?php
								} ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" id="topic" name="topic">
                                <option value="">--bitte w<span>&#228;</span>hlen--</option>
								
								
								<?php
								$gettopisc = $db->getTopicsByTeam($selected_team);
								foreach ($gettopisc as $topic) {
									
									$selected = $topic['id'] == $selectedtopic ? "selected='selected'" : ""; ?>
                                    <option value="<?php echo $topic['id']; ?>" <?php echo $selected; ?>><?php echo $topic['name']; ?></option>
								<?php } ?>
                            </select>
                        </div>

                    </div>
                </form>
                <form method="post" action="<?php echo W_ROOT; ?>/form-action.php" name="delete_feature" id="delete_feature" class="form-horizontal">
                    <input type="hidden" id="f_id" name="f_id" value="">
                    <input type="hidden" name="action" class="form-control" value="feature-delete">
                    <input type="hidden" name="topic_id" value="<?php echo $selectedtopic; ?>">
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
                    <option value="prev_pi">Vorheriges PI anzeigen</option>
                </select>
            </div>
        </div>
        <div class="row">
            <!-- Topic select box end -->

            <!-- PM tool start -->
			<?php include_once(F_ROOT . 'parts/pm-tool.php'); ?>
            <!-- PM tool end -->
        </div>
    </div>

<?php
// Include footer
include_once F_ROOT . 'parts/layout/footer.php';