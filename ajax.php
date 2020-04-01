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
		
		$cnt = $db->getFeatureNonMatchedByJiraIdCount($selected_epic, $selected_status);
		
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
		
		$feature_list = $db->getFeatureNonMatchedByJiraId($selected_epic, $selected_status, $lower_limit, $page_limit);
		
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
                        <td><?php echo $feature_info['f_jira_id']; ?></td>
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
                        <td colspan="2"></td>
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
		
		if (empty($selected_epic)) {
			$selected_epic = 0;
		}
		if (empty($selected_status)) {
			$selected_status = 0;
		}
		
		$page_limit = 1;
		
		$cnt = $db->getFeatureMatchedByJiraIdCount($selected_epic, $selected_status);
		
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
		
		$feature_list = $db->getFeatureMatchedByJiraId($selected_epic, $selected_status, $lower_limit, $page_limit);
		
		foreach ($feature_list as $feature) {
			
			$feature_info = $db->getFeatureByFeatureId($feature['f_id']);
			$jira_info    = $db->getJiraTicketById($feature['f_jira_id']);
			?>
            <div class="col-md-12 p-3">
                <table class="table-sm table-bordered col-md-6">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Jira</th>
                        <th>PM</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>Titel:</th>
                        <td><?php echo $jira_info['title']; ?></td>
                        <td><?php echo $feature_info['f_title']; ?></td>
                    </tr>
                    <tr>
                        <th>Jira ID:</th>
                        <td><?php echo $jira_info['j_key']; ?></td>
                        <td><?php echo $feature_info['f_jira_id']; ?></td>
                    </tr>
                    <tr>
                        <th>Bemerkung:</th>
                        <td><?php echo $jira_info['bemerkung']; ?></td>
                        <td><?php echo $feature_info['f_note']; ?></td>
                    </tr>
                    <tr>
                        <th>BV (Business Value):</th>
                        <td><?php echo $jira_info['BV']; ?></td>
                        <td><?php echo $feature_info['f_BV']; ?></td>
                    </tr>
                    <tr>
                        <th>Type:</th>
                        <td><?php echo $jira_info['type']; ?></td>
                        <td><?php echo $alltypes[$feature_info['f_type']]; ?></td>
                    </tr>
                    <tr>
                        <th>Epic:</th>
                        <td><?php echo $jira_info['epic']; ?></td>
                        <td><?php echo $allepics[$feature_info['f_epic']]; ?></td>
                    </tr>
                    <tr>
                        <th>Kommentar:</th>
                        <td colspan="2"><textarea name="f_jira_notes" data-f_id="<?php echo $feature_info['f_id']; ?>" class="f_jira_notes form-group w-100"><?php echo $feature_info['f_jira_notes']; ?></textarea></td>
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
                        <li class="page-item"><a class="page-link" href="javascript:void(0);" class="links" onclick="displayRecordsforMatchedPM('<?php echo $page_limit; ?>', '<?php echo 1; ?>');">First</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);" class="links" onclick="displayRecordsforMatchedPM('<?php echo $page_limit; ?>', '<?php echo $pagenum - 1; ?>');">Previous</a></li>
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
		
		if (empty($selected_epic)) {
			$selected_epic = 0;
		}
		if (empty($selected_status)) {
			$selected_status = 0;
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
		
		$jira_list = $db->getJiraTicketsNotMatched($lower_limit, $page_limit);
		
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
                        <td><?php echo $jira_info['kommentar']; ?></td>
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
		
		$db->updateFpRanking($fp_id, $fp_BV,$fp_TC,$fp_RROE,$fp_JS);
		break;
	
	case 'save-dr_ranking':
		$fp_id   = $_REQUEST['fp_id'];
		$data = $_REQUEST;
		$db->saveDrRanking($fp_id,$data);
		break;
	case 'save-dr-notes':
		$fp_id   = $_REQUEST['fp_id'];
		$data = $_REQUEST;
		$db->saveDrNotes($fp_id,$data);
		break;
	default:
		break;
}
