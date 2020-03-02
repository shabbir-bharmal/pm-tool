<?php
header('Content-Type: text/html; charset=ISO-8859-1');
$f_id = $_REQUEST['feature_id'];
$pi_id         = $_REQUEST['pi_id'];
$topic_id      = $_REQUEST['topic_id'];
$opt_values    = array('0', '1', '2', '3', '5', '8', '13', '20', '40');
$feature_info  = $db->getFeatureByFeatureId($f_id);
$feature_types = $db->getFeatureType();
$feature_statuses = $db->getFeatureStatuses();
if($feature_info['f_topic_id']){
	$topic_id = $feature_info['f_topic_id'];
}
$topic         = $db->getTopicById($topic_id);
$feature_files  = $db->getFeatureFilesByFeatureId($f_id);
$feature_staff = $db->getStaffByTopic($topic_id);
$epics = $db->getEpics();
$helptexts = $db->getHelpText();

?>
<input type="hidden" name="return_url" class="form-control" id="return_url" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
<input type="hidden" name="topic_id" class="form-control" id="topic_id" value="<?php echo $topic_id; ?>">
<input type="hidden" name="topic_name" class="form-control" id="topic_name" value="<?php echo $topic['name']; ?>">
<input type="hidden" name="f_id" class="form-control" id="f_id" value="<?php echo $f_id; ?>">
<input type="hidden" name="pi_id" class="form-control" id="pi_id" value="<?php echo $pi_id; ?>">
<input type="hidden" name="action" class="form-control" id="action" value="<?php echo(!$f_id ? "feature-add" : "feature-edit"); ?>">
<div class="form-group">
    <label for="f_title" class="col-form-label">Title:</label>
    <input type="text" name="f_title" class="form-control" id="f_title" value="<?php echo(!$f_id ? "" : $feature_info['f_title']); ?>">
</div>
<!-- Tab Functionality Start-->
<ul class="nav nav-tabs nav-fill" id="featureTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="allgemein-tab" data-toggle="tab" href="#allgemein" role="tab" aria-controls="allgemein" aria-selected="true">Allgemein</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="ranking-tab" data-toggle="tab" href="#ranking" role="tab" aria-controls="ranking" aria-selected="false">Ranking</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="files-tab" data-toggle="tab" href="#files" role="tab" aria-controls="files" aria-selected="false">Files</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="details-1-tab" data-toggle="tab" href="#details-1" role="tab" aria-controls="details-1" aria-selected="false">Details 1</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="details-2-tab" data-toggle="tab" href="#details-2" role="tab" aria-controls="details-2" aria-selected="false">Details 2</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="details-3-tab" data-toggle="tab" href="#details-3" role="tab" aria-controls="details-3" aria-selected="false">Details 3</a>
    </li>
</ul>
<div class="tab-content" id="featureTabContent">
    <div class="tab-pane fade show active" id="allgemein" role="tabpanel" aria-labelledby="allgemein-tab">
        <?php include_once(F_ROOT.'parts/manage-feature/allgemein_tab.php'); ?>
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

