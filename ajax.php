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
		include_once(F_ROOT.'parts/manage-feature-form.php');
		break;
	
	case 'update-feature-ranking':
		$f_ids = $_REQUEST['feature_id'];
		$pi_id = $_REQUEST['pi_id'];
		$topic_id = $_REQUEST['topic_id'];
		
		$success = $db->updateFeatureRanking($pi_id, $f_ids,$topic_id);
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
		$modal   = $_REQUEST['modal'];
		$modal_id   = $_REQUEST['modal_id'];
		$login_id   = $_REQUEST['login_id'];
		$data   = $_REQUEST['data'];
		$success   = $db->saveComment($modal,$modal_id,$data,$login_id);
		echo $success;
		break;
		
	case 'delete-comment':
		$data   = $_REQUEST['data'];
		$delete_comments = $db->deleteComment($data);
		break;
	
	default:
		break;
}
