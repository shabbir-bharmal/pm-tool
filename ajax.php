<?php
include_once 'config.php';

$action = $_REQUEST && $_REQUEST['action'] ? $_REQUEST['action'] : '';

switch ($action) {
	case 'update-staff-pi-capacity':
		$staff_id = $_REQUEST['staff_id'];
		$pi_id    = $_REQUEST['pi_id'];
		$capacity = $_REQUEST['capacity'];
		$success  = $db->updateStaffCapacityByPI($staff_id, $pi_id, $capacity);
		echo json_encode(['success' => $success]);
		break;
	case 'manage-feature':
		include_once(F_ROOT . 'parts/manage-feature-form.php');
		break;
	
	case 'update-feature-ranking':
		$f_ids    = $_REQUEST['feature_id'];
		$pi_id    = $_REQUEST['pi_id'];
		$topic_id = $_REQUEST['topic_id'];
		
		$success = $db->updateFeatureRanking($pi_id, $f_ids, $topic_id);
		echo json_encode(['success' => $success]);
		break;
	
	case 'delete-file':
		$file_id   = $_REQUEST['file_id'];
		$file_name = $_REQUEST['file_name'];
		$success   = $db->deleteFile($file_id, $file_name);
		echo json_encode(['success' => $success]);
		break;
	
	case 'delete-file-epic':
		$file_id   = $_REQUEST['file_id'];
		$file_name = $_REQUEST['file_name'];
		$success   = $db->deleteFileEpic($file_id, $file_name);
		echo json_encode(['success' => $success]);
		break;
	case 'save-comment':
		$modal    = $_REQUEST['modal'];
		$modal_id = $_REQUEST['modal_id'];
		$login_id = $_REQUEST['login_id'];
		$data     = $_REQUEST['data'];
		$success  = $db->saveComment($modal, $modal_id, $data, $login_id);
		echo $success;
		break;
	
	case 'delete-comment':
		$data            = $_REQUEST['data'];
		$delete_comments = $db->deleteComment($data);
		break;
	case 'event-store-in-session':
		$event = $_REQUEST['event'];
		switch ($event) {
			case 'incpi':
				$_SESSION['show_pi'] = $_SESSION['show_pi'] + 1;
				break;
			case 'decpi':
				$_SESSION['show_pi'] = $_SESSION['show_pi'] - 1;
				break;
			case 'show_all':
				if ($_SESSION['show_all'] == 'scrollable') {
					$_SESSION['show_all'] = '';
				} else {
					$_SESSION['show_all'] = 'scrollable';
				}
				break;
			case 'expand':
				if ($_SESSION['expand'] == 'height0') {
					$_SESSION['expand'] = '';
				} else {
					$_SESSION['expand'] = 'height0';
				}
				break;
			default:
				break;
		}
		//echo $event;
		
		break;
	case 'display-non-matched-pm':
		
		if (!(isset($_GET['pagenum']))) {
			$pagenum = 1;
		} else {
			$pagenum = intval($_GET['pagenum']);
		}
		$page_limit = 10;
		
		$getepicss = $db->getEpics();
		$allepics  = array();
		foreach ($getepicss as $epic) {
			$allepics[$epic['e_id']] = $epic['e_title'];
		}
		$feature_statuses = $db->getFeatureStatuses();
		$feature_types    = $db->getFeatureType();
		$alltypes         = array();
		foreach ($feature_types as $f_type) {
			$alltypes[$f_type['id']] = $f_type['name'];
		}
		
		$selected_epic   = $_GET['epic'];
		$selected_status = $_GET['f_status_id'];
		$selected_pi     = $_GET['f_pi_id'];
		
		$cnt = $db->getFeatureNonMatchedByJiraIdCount($selected_epic, $selected_status, $selected_pi);
		
		$last = ceil($cnt / $page_limit);
		if ($pagenum < 1) {
			$pagenum = 1;
		} elseif ($pagenum > $last) {
			$pagenum = $last;
		}
		$lower_limit = ($pagenum - 1) * $page_limit;
		
		
		if (empty($selected_epic)) {
			$selected_epic = 0;
		}
		if (empty($selected_status)) {
			$selected_status = 0;
		}
		if (empty($selected_pi)) {
			$selected_pi = 0;
		}
		
		
		$feature_list      = $db->getFeatureNonMatchedByJiraId($selected_epic, $selected_status, $selected_pi, $lower_limit, $page_limit);
		$getnotmatchedjira = $db->getJiraTicketsNotMatchedList();
		
		foreach ($feature_list as $feature) {
			
			$feature_info = $db->getFeatureByFeatureId($feature['f_id']);
			?>
            <div class="col-md-12 p-3">
                <table class="table-sm table-bordered col-md-6">
                    <thead>
                    <tr>
                        <th></th>
                        <th>PM</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>Titel:</th>
                        <td><?php echo $feature_info['f_title']; ?></td>
                    </tr>
                    <tr>
                        <th>Jira ID:</th>
                        <td>

                            <select class="form-control f_jira_id" data-f_id="<?php echo $feature_info['f_id']; ?>" name="jira">
                                <option value="">--bitte w<span>&#228;</span>hlen--</option>
								<?php
								foreach ($getnotmatchedjira as $jiraget) {
									
									?>
                                    <option value="<?php echo $jiraget['j_key']; ?>"><?php echo $jiraget['title']; ?> (<?php echo $jiraget['j_key']; if($jiraget['j_PI']) { ?>  / [<?php echo $jiraget['j_PI']; ?>] <?php } ?> )</option>
									<?php
								}
								?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Bemerkung:</th>
                        <td><?php echo $feature_info['f_note']; ?></td>
                    </tr>
                    <tr>
                        <th>BV (Business Value):</th>
                        <td><?php echo $feature_info['f_BV']; ?></td>
                    </tr>
                    <tr>
                        <th>Type:</th>
                        <td><?php echo $alltypes[$feature_info['f_type']]; ?></td>
                    </tr>
                    <tr>
                        <th>Epic:</th>
                        <td><?php echo $allepics[$feature_info['f_epic']]; ?></td>
                    </tr>
                    <tr>
                        <th>Kommentar:</th>
                        <td colspan="2"><textarea name="f_jira_notes" data-f_id="<?php echo $feature_info['f_id']; ?>" class="f_jira_notes form-group w-100"><?php echo $feature_info['f_jira_notes']; ?></textarea></td>
                    </tr>
                    <tr>
                        <th>Ok, dass kein Match?:</th>
                        <td colspan="2"><input class="f_jira_match" type="checkbox" data-f_id="<?php echo $feature_info['f_id']; ?>" name="f_jira_match" <?php if ($feature_info['f_jira_match'] == 1) {
								echo "checked";
							} ?> ></td>
                    </tr>
                    </tbody>
                </table>
            </div>
			<?php
		}
		?>

        <nav aria-label="Page navigation example" class="ml-3">
            <ul class="pagination">
				
				<?php
				if (($pagenum - 1) > 0) {
					?>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" class="links" onclick="displayRecordsforNonMatchedPM('<?php echo $page_limit; ?>', '<?php echo 1; ?>');">First</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" class="links" onclick="displayRecordsforNonMatchedPM('<?php echo $page_limit; ?>', '<?php echo $pagenum - 1; ?>');">Previous</a></li>
					<?php
				}
				//Show page links
				for ($i = 1; $i <= $last; $i++) {
					if ($i == $pagenum) {
						?>
                        <li class="page-item active"><a class="page-link" href="javascript:void(0);" class="selected"><?php echo $i ?></a></li>
						<?php
					} else {
						?>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);" class="links" onclick="displayRecordsforNonMatchedPM('<?php echo $page_limit; ?>', '<?php echo $i; ?>');"><?php echo $i ?></a></li>
						<?php
					}
				}
				if (($pagenum + 1) <= $last) {
					?>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="displayRecordsforNonMatchedPM('<?php echo $page_limit; ?>', '<?php echo $pagenum + 1; ?>');" class="links">Next</a></li>
				<?php }
				if (($pagenum) != $last) { ?>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="displayRecordsforNonMatchedPM('<?php echo $page_limit; ?>', '<?php echo $last; ?>');" class="links">Last</a></li>
					<?php
				}
				?>
            </ul>
        </nav>
		<?php
		break;
	case 'display-matched-pm':
		if (!(isset($_GET['pagenum']))) {
			$pagenum = 10;
		} else {
			$pagenum = intval($_GET['pagenum']);
		}
		
		$getepicss = $db->getEpics();
		$allepics  = array();
		foreach ($getepicss as $epic) {
			$allepics[$epic['e_id']] = $epic['e_title'];
		}
		$feature_statuses = $db->getFeatureStatuses();
		$feature_types    = $db->getFeatureType();
		$alltypes         = array();
		foreach ($feature_types as $f_type) {
			$alltypes[$f_type['id']] = $f_type['name'];
		}
		
		$selected_epic   = $_GET['epic'];
		$selected_status = $_GET['f_status_id'];
		$selected_pi     = $_GET['f_pi_id'];
		
		if (empty($selected_epic)) {
			$selected_epic = 0;
		}
		if (empty($selected_status)) {
			$selected_status = 0;
		}
		if (empty($selected_pi)) {
			$selected_pi = 0;
		}
		
		
		$page_limit = 1;
		
		
		$cnt = $db->getFeatureMatchedByJiraIdCount($selected_epic, $selected_status, $selected_pi);
		
		if ($pagenum == 'All') {
			$page_limit = $cnt;
		}
		
		
		$last = ceil($cnt / $page_limit);
		if ($pagenum < 1) {
			$pagenum = 1;
		} elseif ($pagenum > $last) {
			$pagenum = $last;
		}
		$lower_limit = ($pagenum - 1) * $page_limit;
		
		if (empty($selected_epic)) {
			$selected_epic = 0;
		}
		if (empty($selected_status)) {
			$selected_status = 0;
		}
		if (empty($selected_pi)) {
			$selected_pi = 0;
		}
		
		$feature_list = $db->getFeatureMatchedByJiraId($selected_epic, $selected_status, $selected_pi, $lower_limit, $page_limit);
		
		foreach ($feature_list as $feature) {
			
			$feature_info = $db->getFeatureByFeatureId($feature['f_id']);
			$jira_info    = $db->getJiraTicketById($feature['f_jira_id']);
			?>
            <div class="col-md-12 p-3">
                <table class="table-sm table-bordered col-md-7" style="table-layout: fixed; width: 100%;">
                    <thead>
                    <tr>
                        <th style="width:20%; min-width:20% !important;max-width:20% !important;"></th>
                        <th style="width:38%; min-width:38% !important;max-width:38% !important;">Jira
							<?php if ($jira_info['j_key']) { ?>
                                <a class="mr-1 " target="_blank" href="https://jira.zhaw.ch/browse/<?php echo $jira_info['j_key']; ?>" title="Infos auf Jira abrufen"><i class="fa fa-rocket" aria-hidden="true"></i></a>
							<?php } ?>
                        </th>
                        <th style="width:38%; min-width:38% !important;max-width:38% !important;">PM-Tool
							<?php if ($feature_info['f_id']) { ?>
                                <a class="mr-1 " target="_blank" href="https://pm.mastaz.ch/feature-request.php?f_id=<?php echo $feature_info['f_id']; ?>" title="Infos auf Jira abrufen"><i class="fa fa-pencil" aria-hidden="true"></i></a>
							<?php } ?>
                        </th>
                        <th style="width:4%; min-width:4% !important;max-width:4% !important;">OK?</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>Titel:</th>
                        <td><?php echo $jira_info['title']; ?></td>
                        <td><?php echo $feature_info['f_title']; ?></td>
						<?php echo valueequal($jira_info['title'], $feature_info['f_title']) ?>
                    </tr>
                    <tr>
                        <th>Jira Key:</th>
                        <td><?php echo $jira_info['j_key']; ?></td>
                        <td><?php echo $feature_info['f_jira_id']; ?></td>
						<?php echo valueequal($jira_info['j_key'], $feature_info['f_jira_id']) ?>
                    </tr>
                    <tr>
                        <th>***Epic:***</th>
                        <td><?php echo $jira_info['epic']; ?></td>
                        <td><?php echo $allepics[$feature_info['f_epic']]; ?></td>
						<?php echo valueequal($jira_info['epic'], $feature_info['f_epic']) ?>
                    </tr>
                    <tr>
                        <th>***Status:***</th>
                        <td><?php echo $jira_info['j_status']; ?></td>
                        <td><?php echo $allfeaturesstatuses[$feature_info['f_status_id']]; ?></td>
                        <td style="background-color:#F0F3F4;">&nbsp;</td>
                    </tr>
                    <!--  -->
                    <tr>
                        <th>
                            <label for="f_due_date" class="col-form-label">Gew&uuml;nschtes Fertigstellungsdatum: <?php if ($helptexts['f_due_date']) {
									echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_due_date'] . "'></i>";
								} ?>
                            </label>
                        </th>
                        <td><?php echo $jira_info['j_due_date']; ?></td>
                        <td><?php echo $feature_info['f_due_date']; ?></td>
						<?php echo valueequal($jira_info['j_due_date'], $feature_info['f_due_date']) ?>
                    </tr>
                    <tr>
                        <th>
                            <label for="f_storypoints" class="col-form-label">Storypoints: <?php if ($helptexts['f_storypoints']) {
									echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_storypoints'] . "'></i>";
								} ?>
                            </label>
                        </th>
                        <td><?php echo $jira_info['j_SP']; ?></td>
                        <td><?php echo $feature_info['f_storypoints']; ?></td>
						<?php echo valueequal($jira_info['j_SP'], $feature_info['f_storypoints']) ?>
                    </tr>
                    <tr>
                        <th>
                            <label for="f_BV" class="col-form-label">BV: <?php if ($helptexts['f_BV']) {
									echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_BV'] . "'></i>";
								} ?>
                            </label>
                        </th>
                        <td><?php echo $jira_info['j_BV']; ?></td>
                        <td><?php echo $feature_info['f_BV']; ?></td>
						<?php echo valueequal($jira_info['j_BV'], $feature_info['f_BV']) ?>
                    </tr>
                    <tr>
                        <th>
                            <label for="f_TC" class="col-form-label">TC: <?php if ($helptexts['f_TC']) {
									echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_TC'] . "'></i>";
								} ?>
                            </label>
                        </th>
                        <td><?php echo $jira_info['j_TC']; ?></td>
                        <td><?php echo $feature_info['f_TC']; ?></td>
						<?php echo valueequal($jira_info['j_SP'], $feature_info['f_TC']) ?>
                    </tr>
                    <tr>
                        <th>
                            <label for="f_RROE" class="col-form-label">RROE: <?php if ($helptexts['f_RROE']) {
									echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_RROE'] . "'></i>";
								} ?>
                            </label>
                        </th>
                        <td><?php echo $jira_info['j_RROE']; ?></td>
                        <td><?php echo $feature_info['f_RROE']; ?></td>
						<?php echo valueequal($jira_info['j_RROE'], $feature_info['f_RROE']) ?>
                    </tr>
                    <tr>
                        <th>
                            <label for="f_JS" class="col-form-label">JS: <?php if ($helptexts['f_JS']) {
									echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_JS'] . "'></i>";
								} ?>
                            </label>
                        </th>
                        <td><?php echo $jira_info['j_JS']; ?></td>
                        <td><?php echo $feature_info['f_JS']; ?></td>
						<?php echo valueequal($jira_info['j_JS'], $feature_info['f_JS']) ?>
                    </tr>
                    <tr>
                        <th>
                            <label for="f_WSJF" class="col-form-label">WSJF <?php if ($helptexts['f_WSJF']) {
									echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_WSJF'] . "'></i>";
								} ?>
                            </label>
                        </th>
						<?php
						$wsjf_pm   = ($feature_info['f_BV'] + $feature_info['f_TC'] + $feature_info['f_RROE']) / $feature_info['f_JS'];
						$wsjf_jira = ($jira_info['j_BV'] + $jira_info['j_TC'] + $jira_info['j_RROE']) / $jira_info['j_JS'];
						?>
                        <td><?php echo $wsjf_jira; ?></td>
                        <td><?php echo $wsjf_pm; ?></td>
						<?php echo valueequal($wsjf_jira, $wsjf_pm) ?>
                    </tr>
                    <tr>
                        <th>
                            <label for="f_type" class="col-form-label">Type: <?php if ($helptexts['f_type']) {
									echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_type'] . "'></i>";
								} ?>
                            </label>
                        </th>
                        <td><?php echo $jira_info['j_type']; ?></td>
                        <td><?php echo $alltypes[$feature_info['f_type']]; ?></td>
						<?php echo valueequal($jira_info['j_type'], $alltypes[$feature_info['f_type']]) ?>
                    </tr>
                    <tr>
                        <th>
                            <label for="f_team" class="col-form-label">Team: <?php if ($helptexts['f_team']) {
									echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_team'] . "'></i>";
								} ?>
                            </label>
                        </th>
                        <td><?php echo $jira_info['j_team']; ?></td>
                        <td style="background-color:#F0F3F4;">Keine Teamzuweisung im pm.mastaz.ch</td>
                        <td style="background-color:#F0F3F4;">&nbsp;</td>
                    </tr>
                    <tr>
                        <th>
                            <label for="f_team" class="col-form-label">Topic: <?php if ($helptexts['f_topic']) {
									echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_topic'] . "'></i>";
								} ?>
                            </label>
                        </th>
                        <td><?php echo $jira_info['j_topic']; ?></td>
                        <td><?php echo $alltopics[$feature_info['f_topic_id']]; ?></td>
						<?php echo valueequal($jira_info['j_topic'], $alltopics[$feature_info['f_topic_id']]) ?>
                    </tr>
                    <tr>
                        <th>
                            <label for="f_PI" class="col-form-label">PI: <?php if ($helptexts['f_PI']) {
									echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_PI'] . "'></i>";
								} ?>
                            </label>
                        </th>
                        <td><?php echo $jira_info['j_PI']; ?></td>
                        <td><?php echo $allproductincrements[$feature_info['f_PI']]; ?></td>
						<?php echo valueequal($jira_info['j_PI'], str_replace(' ', '', $allproductincrements[$feature_info['f_PI']])) ?>
                    </tr>
                    <tr>
                        <th>
                            <label for="f_desc" class="col-form-label">Kurzbeschreibung: <?php if ($helptexts['f_desc']) {
									echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_desc'] . "'></i>";
								} ?>
                            </label>
                        </th>
                        <td style="overflow-wrap: break-word;"><?php echo $jira_info['j_desc']; ?></td>
                        <td style="overflow-wrap: break-word;"><?php echo $feature_info['f_desc']; ?></td>
						<?php echo valueequal($jira_info['j_desc'], $feature_info['f_desc']) ?>
                    </tr>
                    <tr>
                        <th>Notiz zum Abgleich:</th>
                        <td colspan="3"><textarea name="f_jira_notes" data-f_id="<?php echo $feature_info['f_id']; ?>" class="f_jira_notes form-group w-100"><?php echo $feature_info['f_jira_notes']; ?></textarea></td>
                    </tr>
                    </tbody>
                </table>
            </div>
			<?php
		}
		if ($cnt > $page_limit) {
			?>
            <nav aria-label="Page navigation example" class="ml-3">
                <ul class="pagination">
					
					<?php
					if (($pagenum - 1) > 0) {
						?>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);" class="links" onclick="displayRecordsforMatchedPM('<?php echo $page_limit; ?>', '<?php echo 1; ?>');">First</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);" class="links" onclick="displayRecordsforMatchedPM('<?php echo $page_limit; ?>', '<?php echo $pagenum - 1; ?>');">Previous</a></li>
						<?php
					} else {
						?>
                        <li class="page-item"><span class="page-link" class="links">First</span></li>
                        <li class="page-item"><span class="page-link" class="links">Previous</span></li>
						<?php
					}
					//Show page links
					for ($i = 1; $i <= $last; $i++) {
						if ($i == $pagenum) {
							?>
                            <li class="page-item active"><a class="page-link" href="javascript:void(0);" class="selected"><?php echo $i ?></a></li>
							<?php
						} else {
							?>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);" class="links" onclick="displayRecordsforMatchedPM('<?php echo $page_limit; ?>', '<?php echo $i; ?>');"><?php echo $i ?></a></li>
							<?php
						}
					}
					if (($pagenum + 1) <= $last) {
						?>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="displayRecordsforMatchedPM('<?php echo $page_limit; ?>', '<?php echo $pagenum + 1; ?>');" class="links">Next</a></li>
					<?php }
					if (($pagenum) != $last) { ?>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="displayRecordsforMatchedPM('<?php echo $page_limit; ?>', '<?php echo $last; ?>');" class="links">Last</a></li>
						<?php
					}
					?>
                </ul>
            </nav>
			<?php
		}
		break;
	case 'display-non-matched-jira':
		if (!(isset($_GET['pagenum']))) {
			$pagenum = 1;
		} else {
			$pagenum = intval($_GET['pagenum']);
		}
		$selected_epic   = $_GET['epic'];
		$selected_status = $_GET['f_status_id'];
		$selected_pi     = $_GET['f_pi_id'];
		if (empty($selected_epic)) {
			$selected_epic = 0;
		}
		if (empty($selected_status)) {
			$selected_status = 0;
		}
		if (empty($selected_pi)) {
			$selected_pi = 0;
		}
		
		$page_limit = 10;
		
		$cnt = $db->getJiraTicketsNotMatchedCount();
		
		$last = ceil($cnt / $page_limit);
		if ($pagenum < 1) {
			$pagenum = 1;
		} elseif ($pagenum > $last) {
			$pagenum = $last;
		}
		$lower_limit = ($pagenum - 1) * $page_limit;
		
		if (empty($selected_epic)) {
			$selected_epic = 0;
		}
		if (empty($selected_status)) {
			$selected_status = 0;
		}
		if (empty($selected_pi)) {
			$selected_pi = 0;
		}
		
		$jira_list = $db->getJiraTicketsNotMatched($lower_limit, $page_limit);
		$getnotmatchedfeature = $db->getFeaturesNotMatchedList($selected_epic, $selected_status, $selected_pi);
		
		foreach ($jira_list as $jira_info) {
			?>
            <div class="col-md-12 p-3">
                <table class="table-sm table-bordered">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Jira</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>Titel:</th>
                        <td><?php echo $jira_info['title']; ?></td>
                    </tr>
                    <tr>
                        <th>Jira ID:</th>
                        <td><?php echo $jira_info['j_key']; ?></td>
                    </tr>
                    <tr>
                        <th>Features:</th>
                        <td>
                            <select class="form-control f_id" data-j_key="<?php echo $jira_info['j_key']; ?>" name="f_id">
                                <option value="">--bitte w<span>&#228;</span>hlen--</option>
								<?php
								foreach ($getnotmatchedfeature as $featuredata) {
				
									?>
                                    <option value="<?php echo $featuredata['f_id']; ?>"><?php echo $featuredata['f_title']; ?> ( [PI<?php echo $featuredata['f_PI']; ?>] )</option>
									<?php
								}
								?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Bemerkung:</th>
                        <td><?php echo $jira_info['bemerkung']; ?></td>
                    </tr>
                    <tr>
                        <th>BV (Business Value):</th>
                        <td><?php echo $jira_info['BV']; ?></td>
                    </tr>
                    <tr>
                        <th>Type:</th>
                        <td><?php echo $jira_info['type']; ?></td>
                    </tr>
                    <tr>
                        <th>Epic:</th>
                        <td><?php echo $jira_info['epic']; ?></td>
                    </tr>
                    <tr>
                        <th>Kommentar:</th>
                        <td><textarea data-j_key="<?php echo $jira_info['j_key']; ?>" name="kommentar" class="kommentar form-group w-100"><?php echo $jira_info['kommentar']; ?></textarea></td>
                    </tr>
                    <tr>
                        <th>Ok, dass kein Match?:</th>
                        <td colspan="2"><input class="jira_match" type="checkbox" data-j_key="<?php echo $jira_info['j_key']; ?>" name="jira_match" <?php if($jira_info['jira_match'] == 1){ echo "checked"; }?> ></td>
                    </tr>
                    </tbody>
                </table>
            </div>
			<?php
		}
		if ($cnt > 10) {
			?>
            <nav aria-label="Page navigation example" class="ml-3">
                <ul class="pagination">
					
					<?php
					if (($pagenum - 1) > 0) {
						?>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);" class="links" onclick="displayRecordsforNonMatchedJira('<?php echo $page_limit; ?>', '<?php echo 1; ?>');">First</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);" class="links" onclick="displayRecordsforNonMatchedJira('<?php echo $page_limit; ?>', '<?php echo $pagenum - 1; ?>');">Previous</a></li>
						<?php
					}
					//Show page links
					for ($i = 1; $i <= $last; $i++) {
						if ($i == $pagenum) {
							?>
                            <li class="page-item active"><a class="page-link" href="javascript:void(0);" class="selected"><?php echo $i ?></a></li>
							<?php
						} else {
							?>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);" class="links" onclick="displayRecordsforNonMatchedJira('<?php echo $page_limit; ?>', '<?php echo $i; ?>');"><?php echo $i ?></a></li>
							<?php
						}
					}
					if (($pagenum + 1) <= $last) {
						?>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="displayRecordsforNonMatchedJira('<?php echo $page_limit; ?>', '<?php echo $pagenum + 1; ?>');" class="links">Next</a></li>
					<?php }
					if (($pagenum) != $last) { ?>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="displayRecordsforNonMatchedJira('<?php echo $page_limit; ?>', '<?php echo $last; ?>');" class="links">Last</a></li>
						<?php
					}
					?>
                </ul>
            </nav>
			<?php
		}
		break;
	case 'update-feature-jira-notes':
		$f_id         = $_REQUEST['f_id'];
		$f_jira_notes = $_REQUEST['f_jira_notes'];
		$db->updateFeatureJiraNote($f_id, $f_jira_notes);
		break;
	case 'update-feature-notes':
		$f_id   = $_REQUEST['f_id'];
		$f_note = $_REQUEST['f_note'];
		$db->updateFeatureNote($f_id, $f_note);
		break;
	case 'update-fp_ranking':
		$fp_id   = $_REQUEST['fp_id'];
		$fp_BV   = $_REQUEST['fp_BV'];
		$fp_TC   = $_REQUEST['fp_TC'];
		$fp_RROE = $_REQUEST['fp_RROE'];
		$fp_JS   = $_REQUEST['fp_JS'];
		
		$db->updateFpRanking($fp_id, $fp_BV, $fp_TC, $fp_RROE, $fp_JS);
		break;
	
	case 'save-dr_ranking':
		$fp_id = $_REQUEST['fp_id'];
		$data  = $_REQUEST;
		$db->saveDrRanking($fp_id, $data);
		break;
	case 'save-dr-notes':
		$fp_id = $_REQUEST['fp_id'];
		$data  = $_REQUEST;
		$db->saveDrNotes($fp_id, $data);
		break;
	case 'update-feature-jira-id':
		$f_id      = $_REQUEST['f_id'];
		$f_jira_id = $_REQUEST['f_jira_id'];
		$db->updateFeatureJiraId($f_id, $f_jira_id);
		break;
	case 'update-feature-jira-match':
		$f_id      = $_REQUEST['f_id'];
		$f_jira_match = $_REQUEST['f_jira_match'];
		$db->updateFeatureJiraMatch($f_id, $f_jira_match);
		break;
	case 'update-jira-kommentar':
		$j_key   = $_REQUEST['j_key'];
		$kommentar = $_REQUEST['kommentar'];
		$db->updateJiraKommentar($j_key, $kommentar);
		break;
	case 'update-jira-match':
		$j_key      = $_REQUEST['j_key'];
		$jira_match = $_REQUEST['jira_match'];
		$db->updateJiraMatch($j_key, $jira_match);
		break;
	default:
		break;
}

function valueequal($jira_value, $pmvalue)
{
	if ($jira_value == $pmvalue) {
		return '<td style="background-color:green;"><b>OK</b></td>';
	} else {
		return '<td style="background-color:red;;"><b>NOK</b></td>';
	}
	
}

?>