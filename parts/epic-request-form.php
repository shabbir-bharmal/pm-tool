<?php
$staff         = $db->getStaff();
$epics         = $db->getEpics();
$epic_statuses = $db->getEpicStatuses();
$teams         = $db->getTeams();
$e_id          = isset($_REQUEST['e_id']) ? $_REQUEST['e_id'] : 0;
$epic_info     = $db->getEpicById($e_id);
$is_watching      = $db->getWatcher($_SESSION['login_user_data']['staff_id'], 'epic', $e_id);
$login_id         = $_SESSION['login_user_data']['staff_id'];
$staff_id         = $login_id;
$can_edit_roadmap = $_SESSION['login_user_data']['can_edit_roadmap'];
$epic_files  = $db->getEpicFilesByFeatureId($e_id);
if ($epic_info['e_owner']) {
	$staff_id = $epic_info['e_owner'];
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

<form action="<?php echo W_ROOT.'/form-action.php'; ?>" method="post" id="epic_request_form" name="epic_request_form" enctype='multipart/form-data'>
	<input type="hidden" name="e_id" value="<?php echo $e_id; ?>">
	<input type="hidden" name="action" id="action" value="epic-request">
	<div class="form-group row">
		<label for="e_title" class="col-3 col-xs-12 col-form-label">Titel: <?php if ($helptexts['e_title']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_title'] . "'></i>";
			} ?> <span class="text-danger ml-1">*</span></label>

		<div class="col-6 col-xs-12">
			<input type="text" name="e_title" class="form-control" id="e_title" <?php echo $disabled; ?> value="<?php echo(!$e_id ? "" : $epic_info['e_title']) ?>">
		</div>
	</div>

	<div class="form-group row">
		<label for="e_status_is" class="col-3 col-xs-12 col-form-label">Status:</label>

		<div class="col-2 col-xs-12">

			<?php if (!$e_id) {
				$epic_info['e_status_id'] = 1;
			} ?>

			<select class="form-control" name="e_status_id" id="e_status_id" readonly="true">
				<?php
				foreach ($epic_statuses as $epic_status) {
					$selected = ($epic_info['e_status_id'] == $epic_status['id'] ? 'selected="selected"' : ''); ?>
					<option value="<?php echo $epic_status['id']; ?>" <?php echo $selected; ?>><?php echo $epic_status['name']; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
    <!----Tab Start -->
    
    <ul class="nav nav-tabs nav-fill" id="featureTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="antragsformular-tab" data-toggle="tab" href="#antragsformular" role="tab" aria-controls="antragsformular" aria-selected="true">Antragsformular
              <?php
              if($epic_info['e_hs_for_desc'] <> "" || $epic_info['e_hs_solution'] <> "" || $epic_info['e_hs_how'] <> "" || $epic_info['e_hs_value'] <> "" || $epic_info['e_hs_unlike'] <> "" || $epic_info['e_hs_oursoluion'] <> "" || $epic_info['e_hs_businessoutcome'] <> "" || $epic_info['e_hs_leadingindicators'] <> "" || $epic_info['e_hs_nfr'] <> "" || epic_info['team_id'] <> "" || $epic_info['e_owner'] <> "" || $epic_info['e_notes']){
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
              if(count($epic_files)>0){
                 echo '<i class="fa fa-smile-o" title="Es sind '.count($epic_files).' Datei(en) vorhanden"></i>';
              } 
              ?>  
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="weitere-tab" data-toggle="tab" href="#weitere" role="tab" aria-controls="weitere" aria-selected="false">Weitere Infos
              <?php
              
              if($epic_info['e_in_scope'] <> "" || $epic_info['e_out_of_scope'] <> "" || $epic_info['e_mvp_features'] <> "" || $epic_info['e_additional_potential_features'] <> "" || $epic_info['e_sponsors'] <> "" || $epic_info['e_users_markets_affected'] <> "" || $epic_info['e_impact_products_programs_services'] <> "" || $epic_info['e_impact_sales_distribution_deployment'] <> "" || $epic_info['e_analysis_summary'] <> "" || $epic_info['e_is_go'] <> "" || $epic_info['e_estimated_story_points'] <> "" || $epic_info['e_estimated_monetary_cost'] <> "" || $epic_info['e_type_of_return'] <> "" || $epic_info['e_anticipated_business_impact'] <> "" || $epic_info['e_development_type'] <> "" || $epic_info['e_start_date'] <> "" || $epic_info['e_completion_date'] <> "" || $epic_info['e_incremental_implementation_strategy'] <> "" || $epic_info['e_sequencing_dependencies'] <> "" || $epic_info['e_milestones']){
               echo '<i class="fa fa-smile-o" title="in diesem Tab wurde was erfasst :-)"></i>';
              } 
              ?> 
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="features-tab" data-toggle="tab" href="#features" role="tab" aria-controls="features" aria-selected="false">Features</a>
        </li>        
    </ul>
    <div class="tab-content" id="featureTabContent">
        <div class="tab-pane fade show active" id="antragsformular" role="tabpanel" aria-labelledby="antragsformular-tab">
			<?php include_once(F_ROOT . 'parts/manage-epic-request/antragsformular_tab.php'); ?>
        </div>
        <div class="tab-pane fade" id="kommetare" role="tabpanel" aria-labelledby="kommetare-tab">
			<?php include_once(F_ROOT . 'parts/manage-epic-request/kommetare_tab.php'); ?>
        </div>
        <div class="tab-pane fade" id="dateien" role="tabpanel" aria-labelledby="dateien-tab">
			<?php include_once(F_ROOT . 'parts/manage-epic-request/file_tab.php'); ?>
        </div>
        <div class="tab-pane fade" id="weitere" role="tabpanel" aria-labelledby="weitere-tab">
			<?php include_once(F_ROOT . 'parts/manage-epic-request/weitere_tab.php'); ?>
        </div>
        <div class="tab-pane fade" id="features" role="tabpanel" aria-labelledby="features-tab">
			<?php include_once(F_ROOT . 'parts/manage-epic-request/features_tab.php'); ?>
        </div>        
    </div>

    <!--tab End -->
    <br>
    
    

	<div class="form-row">
        <div class="col-5">  
		<button name="speichern" id="SPEICHERN" class="btn btn-primary" <?php echo $disabled; ?> >SPEICHERN</button>
		<?php if (($e_id && $epic_info['e_status_id'] == 1) || !$e_id) { ?>
			&nbsp;
			<button name="einreichen" id="EINREICHEN" class="btn btn-primary"  <?php echo $disabled; ?> >EINREICHEN</button>
		<?php } ?>
            &nbsp;&nbsp;&nbsp;<div><span class="text-danger ml-1">*</span> = Pflichtfelder</div>
            </div>            
            <div class="col-3">
            <select name="print_option" class="print_option form-control" <?php echo $disabled;?>>
                <option value="" selected="selected">Drucken</option>
                <option value="epic_antrag">Epic-Antrag</option>
            </select>
        </div>
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
                  <p>Bitte alle Pflichtfelder ausf<span>&#252;</span>llen, um den Epic Request einzureichen.</p>
              </div>
          </div>
      </div>
  </div>  

</div>