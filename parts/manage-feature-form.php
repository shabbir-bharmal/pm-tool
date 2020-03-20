<?php
header('Content-Type: text/html; charset=ISO-8859-1');

$f_id = $_REQUEST['feature_id'];
$pi_id         = $_REQUEST['pi_id'];
$topic_id      = $_REQUEST['topic_id'];
$team_id       = $_REQUEST['team_id'];
$opt_values    = array('0', '1', '2', '3', '5', '8', '13', '20');
$feature_info  = $db->getFeatureByFeatureId($f_id);
$feature_types = $db->getFeatureType();
$feature_statuses = $db->getFeatureStatuses();
$status = 1;
$type = 1;
$f_SME = $_SESSION['login_user_data']['staff_id'];
$is_watching = $db->getWatcher($_SESSION['login_user_data']['staff_id'], 'feature', $f_id);
//$f_responsible = $_SESSION['login_user_data']['staff_id'];

if($feature_info['f_type']){
	$type = $feature_info['f_type'];
}
if($feature_info['f_status_id']){
	$status = $feature_info['f_status_id'];
}
if($feature_info['f_topic_id']){
	$topic_id = $feature_info['f_topic_id'];
}
if($feature_info['f_SME']){
	$f_SME = $feature_info['f_SME'];
}
if($feature_info['f_responsible']){
	$f_responsible = $feature_info['f_responsible'];
}
$topic         = $db->getTopicById($topic_id);
$feature_files  = $db->getFeatureFilesByFeatureId($f_id);
$feature_staff = $db->getStaff();
$epics = $db->getEpics();
$working_epics = $db->getWorkingEpics();
$completed_epics = $db->getCompletedEpics();
$helptexts = $db->getHelpText();
$topics = $db->getTopics();
$topics_by_team = $db->getTopicsByTeam($team_id);
$can_edit_roadmap = $_SESSION['login_user_data']['can_edit_roadmap'];
$login_id   = $_SESSION['login_user_data']['staff_id'];
$topic_permission = $db->getTopicsPermissionByStaffId($login_id);

if($can_edit_roadmap == 1 || $feature_info['f_SME'] == $login_id || in_array($feature_info['f_topic_id'], $topic_permission)){
	$disabled = '';
}else{
	$disabled = 'disabled="true"';
}


?>          
<input type="hidden" name="return_url" class="form-control" id="return_url" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
<input type="hidden" name="topic_id" class="form-control" id="topic_id" value="<?php echo $topic_id; ?>">
<input type="hidden" name="topic_name" class="form-control" id="topic_name" value="<?php echo $topic['name']; ?>">
<input type="hidden" name="f_id" class="form-control" id="f_id" value="<?php echo $f_id; ?>">
<input type="hidden" name="pi_id" class="form-control" id="pi_id" value="<?php echo $pi_id; ?>">
<input type="hidden" name="action" class="form-control" value="<?php echo(!$f_id ? "feature-add" : "feature-edit"); ?>">
<div class="form-group"> 
    <label for="f_title" class="col-form-label">Titel: <?php if ($helptexts['f_title']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_title'] . "'></i>";
			} ?> <span class="text-danger ml-1">*</span>
     </label>
	<?php
	$creation_date= !$f_id ? date("Y-m-d") : date("Y-m-d", strtotime($feature_info['created_date']));
	$edited_timestamp= !$f_id ? date("Y-m-d") : date("Y-m-d H:i:s", strtotime($feature_info['edited_timestamp']));
	$creation_edit_info= "Erstellt am: ". $creation_date." <br> Editiert am: ".$edited_timestamp;
	echo "<i class='col-form-label fa fa-info-circle float-right' data-html='true' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $creation_edit_info . "'></i>";
	?>
  
  
        <input type="hidden" name="watcher" id="watcher" value="<?php echo $is_watching ? 1 : 0; ?>">
		<?php
		$class = 'text-secondary';
		if ($is_watching) {
			$class = "text-success";
		}
		?>
        <i class="fa fa-eye float-right col-form-label <?php echo $class; ?> watch-icon" style="margin-right:10px;"></i>
  
  
    <input type="text" name="f_title" class="form-control" id="f_title" value="<?php echo(!$f_id ? "" : $feature_info['f_title']); ?>"  <?php  echo $disabled; ?>>
</div>

<!-- Tab Functionality Start-->
<ul class="nav nav-tabs nav-fill" id="featureTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="allgemein-tab" data-toggle="tab" href="#allgemein" role="tab" aria-controls="allgemein" aria-selected="true">Allgemein
        <?php
        echo '<i class="fa fa-smile-o" title="in diesem Tab wurde was erfasst :-)"></i>';
        ?>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="kommetare-tab" data-toggle="tab" href="#kommetare" role="tab" aria-controls="kommetare" aria-selected="false">Kommentare</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="ranking-tab" data-toggle="tab" href="#ranking" role="tab" aria-controls="ranking" aria-selected="false">Rangierung
        <?php
        if($feature_info['f_storypoints']>0 ||  $feature_info['f_BV']>0  || $feature_info['f_TC']>0  || $feature_info['f_RROE']>0  ||  $feature_info['f_JS']>0 ){
           echo '<i class="fa fa-smile-o" title="in diesem Tab wurde was erfasst :-)"></i>';
        } 
        ?>        
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="files-tab" data-toggle="tab" href="#files" role="tab" aria-controls="files" aria-selected="false">Dateien
        <?php
        if(count($feature_files)>0){
           echo '<i class="fa fa-smile-o" title="Es sind '.count($feature_files).' Datei(en) vorhanden"></i>';
        } 
        ?>          
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="details-1-tab" data-toggle="tab" href="#details-1" role="tab" aria-controls="details-1" aria-selected="false">Details 1
        <?php
        if($feature_info['f_benefit']<>"" ||  $feature_info['f_dependencies']<>""  || $feature_info['f_acceptance_criteria']<>"" ){
           echo '<i class="fa fa-smile-o" title="in diesem Tab wurde was erfasst :-)"></i>';
        } 
        ?>   
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="details-2-tab" data-toggle="tab" href="#details-2" role="tab" aria-controls="details-2" aria-selected="false">Details 2
        <?php
        if($f_SME>0 ||  $f_responsible>0  || $feature_info['f_due_date']<>""  || $feature_info['f_mehr_details']<>""){
           echo '<i class="fa fa-smile-o" title="in diesem Tab wurde was erfasst :-)"></i>';
        } 
        ?>           
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="details-3-tab" data-toggle="tab" href="#details-3" role="tab" aria-controls="details-3" aria-selected="false">Details 3
        <?php
        if($feature_info['f_context']<>"" ||  $feature_info['f_problemdessc']<>"" || $feature_info['f_currentstate']<>"" || $feature_info['f_targetstate']<>"" ||  $feature_info['f_inscope']<>"" ||  $feature_info['f_outofscope']<>"" ||  $feature_info['f_risks']<>"") {
           echo '<i class="fa fa-smile-o" title="in diesem Tab wurde was erfasst :-)"></i>';
        } 
        ?>           
        </a>
    </li>
</ul>
<div class="tab-content" id="featureTabContent">
    <div class="tab-pane fade show active" id="allgemein" role="tabpanel" aria-labelledby="allgemein-tab">
        <?php include_once(F_ROOT.'parts/manage-feature/allgemein_tab.php'); ?>
    </div>
    <div class="tab-pane fade" id="kommetare" role="tabpanel" aria-labelledby="kommetare-tab">
		<?php include_once(F_ROOT . 'parts/manage-feature/kommetare_tab.php'); ?>
    </div>
    <div class="tab-pane fade" id="ranking" role="tabpanel" aria-labelledby="ranking-tab">
        <?php include_once(F_ROOT.'parts/manage-feature/ranking_tab.php'); ?>
    </div>
    <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="files-tab">
        <?php include_once(F_ROOT.'parts/manage-feature/file_tab.php'); ?>
    </div>
    <div class="tab-pane fade" id="details-1" role="tabpanel" aria-labelledby="details-1-tab">
        <?php include_once(F_ROOT.'parts/manage-feature/details1_tab.php'); ?>
    </div>
    <div class="tab-pane fade" id="details-2" role="tabpanel" aria-labelledby="details-2-tab">
        <?php include_once(F_ROOT.'parts/manage-feature/details2_tab.php'); ?>
    </div>
    <div class="tab-pane fade" id="details-3" role="tabpanel" aria-labelledby="details-3-tab">
		<?php include_once(F_ROOT.'parts/manage-feature/details3_tab.php'); ?>
    </div>
</div>
<!-- Tab Functionality Start-->

