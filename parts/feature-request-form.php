<?php
$feature_staff    = $db->getStaff();
$epics            = $db->getEpics();
$topics           = $db->getTopics();
$feature_statuses = $db->getFeatureStatuses();
$f_id             = isset($_REQUEST['f_id']) ? $_REQUEST['f_id'] : 0;
$feature_info     = $db->getFeatureByFeatureId($f_id);

$feature_files  = $db->getFeatureFilesByFeatureId($f_id);
$feature_types = $db->getFeatureType();
$type = 1;
if($feature_info['f_type']){
	$type = $feature_info['f_type'];
}
//$f_responsible = $_SESSION['login_user_data']['staff_id'];
if($feature_info['f_responsible']){
	$f_responsible = $feature_info['f_responsible'];
}

$login_id         = $_SESSION['login_user_data']['staff_id'];
$staff_id         = $login_id;
$can_edit_roadmap = $_SESSION['login_user_data']['can_edit_roadmap'];


if(in_array($feature_info['f_topic_id'], $topic_permission)){
	$can_edit_roadmap = 1;
}


$opt_values    = array('0', '1', '2', '3', '5', '8', '13', '20');
if ($feature_info['f_SME']) {
	$staff_id = $feature_info['f_SME'];
}
if ($login_id !== $staff_id) {
	$disabled = 'disabled="true"';
	if ($can_edit_roadmap == 1) {
		$disabled = '';
	}
} else {
	$disabled = '';
}
?>
<form action="<?php echo W_ROOT . '/form-action.php'; ?>" method="post" id="feature_request_form" name="feature_request_form" enctype='multipart/form-data'>
    <input type="hidden" name="f_id" value="<?php echo $f_id; ?>">
    <input type="hidden" name="action" id="action" value="feature-request">

    <div class="form-group row">
        <label for="f_title" class="col-2 col-xs-12 col-form-label">Titel: <span class="text-danger ml-1">*</span></label>

        <div class="col-6 col-xs-12">
            <input type="text" name="f_title" class="form-control" id="f_title" <?php echo $disabled; ?> value="<?php echo(!$f_id ? "" : $feature_info['f_title']) ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="f_title" class="col-2 col-xs-12 col-form-label">Status:</label>
        <div class="col-2 col-xs-12">
			<?php if (!$f_id) {
				$feature_info['f_status_id'] = 1;
			} ?>
            <select class="form-control" name="f_status_id" id="f_status_id" disabled="true">
                <option value="">--bitte w<span>&#228;</span>hlen--</option>
				<?php
				foreach ($feature_statuses as $feature_status) {
					$selected = ($feature_info['f_status_id'] == $feature_status['id'] ? 'selected="selected"' : ''); ?>
                    <option value="<?php echo $feature_status['id']; ?>" <?php echo $selected; ?>><?php echo $feature_status['name']; ?></option>
				<?php } ?>
            </select>
        </div>
    </div>
    <!--tab Start-->

    <ul class="nav nav-tabs nav-fill" id="featureTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="antragsformular-tab" data-toggle="tab" href="#antragsformular" role="tab" aria-controls="antragsformular" aria-selected="true">Antragsformular
              <?php
                 if($epic['e_title'] <> "" || $feature_info['f_topic_id'] <> "" || $feature_info['f_desc'] <> "" || $feature_info['f_context'] <> "" || $feature_info['f_problemdessc'] <> "" || $feature_info['f_currentstate'] <> "" || $feature_info['f_targetstate'] <> "" || $feature_info['f_benefit'] <> "" || $feature_info['f_inscope'] <> "" || $feature_info['f_outofscope'] <> "" || $feature_info['f_due_date'] <> "" || $feature_info['f_dependencies'] <> "" || $feature_info['f_risks'] <> "" || $feature_info['f_note'] ){
               echo '<i class="fa fa-smile-o" title="in diesem Tab wurde was erfasst :-)"></i>';
              } 
              ?>  
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="kommetare-tab" data-toggle="tab" href="#kommetare" role="tab" aria-controls="kommetare" aria-selected="false">Kommentare</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="dateien-tab" data-toggle="tab" href="#dateien" role="tab" aria-controls="dateien" aria-selected="false">Dateien
              <?php
              if(count($feature_files)>0){
                 echo '<i class="fa fa-smile-o" title="Es sind '.count($feature_files).' Datei(en) vorhanden"></i>';
              } 
              ?>              
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="weitere-tab" data-toggle="tab" href="#weitere" role="tab" aria-controls="weitere" aria-selected="false">Weitere Infos
              <?php
                 if($type <> "" || $feature_info['f_storypoints'] > 0 || $feature_info['f_BV'] > 0 || $feature_info['f_TC'] > 0 || $feature_info['f_RROE'] > 0 || $feature_info['f_JS'] > 0 || $feature_info['f_acceptance_criteria'] <> "" || $feature_info['f_mehr_details'] <> "" || $f_responsible <>"" ){
               echo '<i class="fa fa-smile-o" title="in diesem Tab wurde was erfasst :-)"></i>';
              } 
              ?>             
            </a>
        </li>
    </ul>
    <div class="tab-content" id="featureTabContent">
        <div class="tab-pane fade show active" id="antragsformular" role="tabpanel" aria-labelledby="antragsformular-tab">
			<?php include_once(F_ROOT . 'parts/manage-feature-request/antragsformular_tab.php'); ?>
        </div>
        <div class="tab-pane fade" id="kommetare" role="tabpanel" aria-labelledby="kommetare-tab">
			<?php include_once(F_ROOT . 'parts/manage-feature-request/kommetare_tab.php'); ?>
        </div>
        <div class="tab-pane fade" id="dateien" role="tabpanel" aria-labelledby="dateien-tab">
			<?php include_once(F_ROOT . 'parts/manage-feature-request/file_tab.php'); ?>
        </div>
        <div class="tab-pane fade" id="weitere" role="tabpanel" aria-labelledby="weitere-tab">
			<?php include_once(F_ROOT . 'parts/manage-feature-request/weitere_tab.php'); ?>
        </div>
    </div>

    <!--tab End -->
    <br>

    <div class="form-group row">
        <div class="col-5">
            <button name="speichern" id="SPEICHERN" class="btn btn-primary" <?php echo $disabled; ?>>SPEICHERN</button>
    		<?php if (($f_id && $feature_info['f_status_id'] == 5) || !$f_id) { ?>
                &nbsp;
                <button name="einreichen" id="EINREICHEN" class="btn btn-primary" <?php echo $disabled; ?>>EINREICHEN</button>
    		<?php } ?>
            &nbsp;&nbsp;&nbsp;<div><span class="text-danger ml-1">*</span> = Pflichtfelder</div>
            </div>            
            <div class="col-3">
                <select name="print_option" class="print_option form-control" <?php echo $disabled;?>>
                    <option value="" selected="selected">Drucken</option>
                    <option value="title">Titel-Karte</option>
                    <option value="detail">Detail-Karte</option>
                    <option value="title_nemonic">Titel-Karte (Nemonic)</option>
                    <option value="feature_antrag">Feature-Antrag</option>
                </select>
            </div>

</form>

          <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="errorshow">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&#10005;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <p>Bitte alle Pflichtfelder ausf<span>&#252;</span>llen, um den Feature Request einzureichen.</p>
                      </div>
                  </div>
              </div>
          </div>           

    </div>