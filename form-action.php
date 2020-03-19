<?php

use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;

// Include config
include_once 'config.php';

$action = $_REQUEST && $_REQUEST['action'] ? $_REQUEST['action'] : '';

switch ($action) {
	case 'user-login':
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		$result = $db->getUserData($username, $password);
		$count  = count($result);
		
		if ($count > 1) {
			$_SESSION['login_user_data'] = $result;
			if($_SESSION['redirect_url']){
				//$redirectlink = $_SESSION['redirect_url'];
				header("location:" .$_SESSION['redirect_url']);
			}else{
				header("location:" . W_ROOT . "/index.php");
			}
			
		} else {
			$error             = "Dein Benutzername resp. Passwort ist ung&uuml;ltig";
			$_SESSION['error'] = $error;
			header("Location: " . W_ROOT);
		}
		break;
	case 'feature-add':
	case 'feature-edit':
	
		$f_id = $db->saveFeature($_POST);
		$topic_id = $_POST['topic_id'];
		$f_title = $_POST['f_title'];
		
		if($f_id){
			$getwatcherlistbyfeature = $db->getWatcherByModelAndModalId('feature',$f_id);
			$getwatcherlistbytopic = $db->getWatcherByModelAndModalId('topic',$topic_id);
			
			$watcherlist = array_unique(array_merge($getwatcherlistbyfeature,$getwatcherlistbytopic));
			if($watcherlist){
				foreach($watcherlist as $watcher){
					
					$staff_data = $db->getUserInfo($watcher);
					if(!empty(trim($staff_data['email'],' '))){
					$mailer->sendWatchlistEmail($action,$f_id,$f_title,$staff_data);
					}
				}
			}

		}
		if ($_POST['return_url']) {
			header("Location: " . $_POST['return_url']);
		} else {
			header("Location: " . W_ROOT . "/roadmap.php?topic=" . $_POST['topic_id']);
		}
		break;
	case 'feature-delete':
		
		$f_id = $_POST['f_id'];
		$feature_info  = $db->getFeatureByFeatureId($f_id);
		$db->deleteFeature($f_id);
		$topic_id = $feature_info['f_topic_id'];
		$f_title = $feature_info['f_title'];
		
		if($f_id){
			$getwatcherlistbyfeature = $db->getWatcherByModelAndModalId('feature',$f_id);
			$getwatcherlistbytopic = $db->getWatcherByModelAndModalId('topic',$topic_id);
			
			$watcherlist = array_unique(array_merge($getwatcherlistbyfeature,$getwatcherlistbytopic));
			if($watcherlist){
				foreach($watcherlist as $watcher){
					
					$staff_data = $db->getUserInfo($watcher);
					if(!empty(trim($staff_data['email'],' '))){
						$mailer->sendWatchlistEmail($action,$f_id,$f_title,$staff_data);
					}
				}
			}
			
		}
		header("Location: " .$_SERVER['HTTP_REFERER']);
		
		break;
	case 'feature-request':
		
		$count = count($_POST['einreichen']);
		if($_POST['f_id'] == 0){
			$mail_action = 'feature-add';
		}else{
			$mail_action = 'feature-edit';
		}
		$request = $db->saveFeatureRequest($_POST);
		
		$f_id = $_POST['f_id'];
		$topic_id = $_POST['f_topic'];
		$f_title = $_POST['f_title'];
		
		if($f_id){
			$getwatcherlistbyfeature = $db->getWatcherByModelAndModalId('feature',$f_id);
			$getwatcherlistbytopic = $db->getWatcherByModelAndModalId('topic',$topic_id);
			
			$watcherlist = array_unique(array_merge($getwatcherlistbyfeature,$getwatcherlistbytopic));
			if($watcherlist){
				foreach($watcherlist as $watcher){
					$staff_data = $db->getUserInfo($watcher);
					if(!empty(trim($staff_data['email'],' '))){
						$mailer->sendWatchlistEmail($mail_action,$f_id,$f_title,$staff_data);
					}
				}
			}
			
		}
		if (!$request) {
			$_SESSION['feature-request-error'] = 'Etwas ging schief, bitte versuche es später';
		} else {
			if ($_POST['f_id']) {
				$_SESSION['feature-request-success'] = 'Feature #' . $_POST['f_id'] . ' request wurder erfolgreich aktualisiert.';
				if ($count == 1) {
					$mailer->sendFeatureRequestEmail($_POST);
				}
			} else {
				$_SESSION['feature-request-success'] = 'Feature Request wurde erfolgreich gespeichert';
			}
		}
		if ($_POST['f_id']) {
			header("Location: " . W_ROOT . "/feature-request.php?f_id=" . $_POST['f_id']);
		} else {
			header("Location: " . W_ROOT . "/feature-request.php");
		}
		break;
	case 'print-feature':
		switch ($_POST['print_option']) {
			case 'title':
				
				$highlight_color          = $db->getFeatureHighlightColor($_POST['f_type']);
				$_POST['highlight_color'] = str_replace("#", "", $highlight_color['highlight_color']);
				printTitleDocument($_POST);
				break;
			case 'title_nemonic':
				$highlight_color          = $db->getFeatureHighlightColor($_POST['f_type']);
				$_POST['highlight_color'] = str_replace("#", "", $highlight_color['highlight_color']);
				printTitleNemonicDocument($_POST);
				break;
			case 'feature_antrag':
				$highlight_color          = $db->getFeatureHighlightColor($_POST['f_type']);
				$sme                      = $db->getStaffById($_POST['f_SME']);
				$_POST['highlight_color'] = str_replace("#", "", $highlight_color['highlight_color']);
				$epic                     = $db->getEpicById($_POST['f_epic']);
				$data                     = $_POST;
				$data['sme_detail']       = $sme;
				printFeatureAntragDocument($data, $epic['e_title']);
				break;
			case 'epic_antrag':
				$data = $_POST;
				printEpicAntragDocument($db, $data);
				break;
			
			case 'detail':
			default:
				$highlight_color          = $db->getFeatureHighlightColor($_POST['f_type']);
				$_POST['highlight_color'] = str_replace("#", "", $highlight_color['highlight_color']);
				printDetailDocument($_POST);
				break;
		}
		break;
	case 'epic-request':
		
		$count   = count($_POST['einreichen']);
		if($_POST['e_id'] == 0){
			$mail_action = 'epic-add';
		}else{
			$mail_action = 'epic-edit';
		}
		$request = $db->saveEpicRequest($_POST);
		
		$e_id = $_POST['e_id'];
		$e_title = $_POST['e_title'];
		
		if($e_id){
			$watcherlist = $db->getWatcherByModelAndModalId('epic',$e_id);
			if($watcherlist){
				foreach($watcherlist as $watcher){
					$staff_data = $db->getUserInfo($watcher);
					if(!empty(trim($staff_data['email'],' '))){
						$mailer->sendWatchlistEmail($mail_action,$e_id,$e_title,$staff_data);
					}
				}
			}
			
		}
		
		if (!$request) {
			$_SESSION['epic-request-error'] = 'Etwas ging schief, bitte versuche es später';
		} else {
			
			if ($_POST['e_id']) {
				if ($count == 1) {
					$mailer->sendEpicRequestEmail($_POST);
				}
				$_SESSION['epic-request-success'] = 'Epic #' . $_POST['e_id'] . ' Request wurder erfolgreich aktualisiert.';
				
			} else {
				$_SESSION['epic-request-success'] = 'Epic Request wurde erfolgreich gespeichert';
			}
		}
		if ($_POST['e_id']) {
			header("Location: " . W_ROOT . "/epic-request.php?e_id=" . $_POST['e_id']);
		} else {
			header("Location: " . W_ROOT . "/epic-request.php");
		}
		break;
	case 'check-capacity':
		$request = $db->checkCapacity();
		if (!$request) {
			$_SESSION['check-capacity-error'] = 'Etwas ging schief, bitte versuche es sp<span>&#xE4;</span>ter';
		} else {
			$_SESSION['check-capacity-success'] = 'Kapazit<span>&#xE4;</span>tstabelle erfolgreich gespeichert';
		}
		header("Location: " . W_ROOT . "/admin-config.php");
		break;
	case 'manage-account':
		$manage_account = $db->manageAccount($_POST);
		$_SESSION['login_user_data'] =$db->getUserInfo($_POST['staff_id']);
		header("Location: " .$_SERVER['HTTP_REFERER']);
		break;
	case 'print-pi-features':
		$features = $_POST['features'];
		
		switch ($_POST['print_option']) {
			case 'title':
				if($features){
					$features = explode(',',$features);
					$features_data = [];
					foreach ($features as $feature){
						$features_data[]  = $db->getFeatureTitleTopicColorByFeatureId($feature);
					}
					printTitleDocumentByPI($features_data);
					header("Location: " .$_SERVER['HTTP_REFERER']);
				}
				break;
			case 'title_nemonic':
				header("Location: " .$_SERVER['HTTP_REFERER']);
				break;
			case 'feature_antrag':
				header("Location: " .$_SERVER['HTTP_REFERER']);
				break;
			case 'epic_antrag':
				header("Location: " .$_SERVER['HTTP_REFERER']);
				break;
			case 'detail':
			default:
			header("Location: " .$_SERVER['HTTP_REFERER']);
				break;
		}
		break;
	default:
		break;
}
function printDetailDocument($data)
{
	include_once F_ROOT . 'Word_Header.php';
	
	if ($data['f_JS'] == 0) {
		$wsjf = 0;
	} else {
		$wsjf = ($data['f_BV'] + $data['f_TC'] + $data['f_RROE']) / $data['f_JS'];
	}
	$cod = ($data['f_BV'] + $data['f_TC'] + $data['f_RROE']);
	
	// New Word Document
	$file_name = $data['f_title'] . ' Details.docx';
	
	$phpWord = new \PhpOffice\PhpWord\PhpWord();
	
	$section = $phpWord->addSection();
	//$section->addTextBreak(1);
	
	
	$fancyTableStyleName      = 'Fancy Table';
	$fancyTableStyle          = array('width' => '100%', 'borderSize' => 1, 'borderColor' => '000000', 'cellMargin' => 1, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 1);
	$fancyTableFirstRowStyle  = array('borderBottomColor' => '000000', 'bgColor' => 'FFFF00');
	$fancyTableCellStyle      = array('valign' => 'center');
	$fancyTableFontStyle      = array('bold' => true, 'size' => 10, 'Name' => 'Calibri');
	$fancyTableFontStyleSmall = array('bold' => false, 'size' => 10, 'Name' => 'Calibri');
	
	$phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
	
	$table = $section->addTable($fancyTableStyleName);
	$table->setWidth(100000);
	
	$table->addRow(300, array('exactHeight' => true));
	$cellFontSize = array('bold' => true, 'size' => 10, 'Name' => 'Calibri');
	$table->addCell(2600)->addText("Feature", $cellFontSize);
	$table->addCell(7300, array('gridSpan' => 4))->addText($data['f_title']);
	
	
	$table->addRow(300, array('exactHeight' => true));
	$table->addCell(2600)->addText("Source Epic", $cellFontSize);
	$table->addCell(7300, array('gridSpan' => 4))->addText("");

// 2600 + 3300 + 4000
	
	$table->addRow(300, array('exactHeight' => true));
	$table->addCell(5900, array('gridSpan' => 2))->addText("Description (Problem Statement)", $cellFontSize);
	$table->addCell(4000, array('gridSpan' => 3))->addText("Acceptance criteria", $cellFontSize);
	
	
	$table->addRow(1500);
	$table->addCell(5900, array('gridSpan' => 2))->addText($data['f_desc']);
	$table->addCell(4000, array('vMerge' => 'restart', 'gridSpan' => 3))->addText("");
	
	$table->addRow(300, array('exactHeight' => true));
	$table->addCell(5900, array('gridSpan' => 2))->addText("Feature Benefit (Hypothesis)", $cellFontSize);
	$table->addCell(4000, array('vMerge' => 'continue', 'gridSpan' => 3));
	
	$table->addRow(1500);
	$table->addCell(5900, array('gridSpan' => 2))->addText("");
	$table->addCell(4000, array('vMerge' => 'continue', 'gridSpan' => 3));
	
	
	$table->addRow(300, array('exactHeight' => true));
	$table->addCell(5900, array('gridSpan' => 2))->addText("Subject matter experts", $cellFontSize);
	$table->addCell(4000, array('gridSpan' => 3))->addText("User/Business Value", $cellFontSize);
	
	$table->addRow(300, array('exactHeight' => false));
	$table->addCell(5900, array('gridSpan' => 2))->addText("");
	$table->addCell(4000, array('gridSpan' => 3))->addText($data['f_BV']);
	
	$table->addRow(300, array('exactHeight' => true));
	$table->addCell(5900, array('gridSpan' => 2))->addText("Dependencies", $cellFontSize);
	$table->addCell(4000, array('gridSpan' => 3))->addText("Timing Critically", $cellFontSize);
	
	$table->addRow(300, array('exactHeight' => false));
	$table->addCell(5900, array('gridSpan' => 2))->addText("");
	$table->addCell(4000, array('gridSpan' => 3))->addText($data['f_TC']);
	
	$table->addRow(300, array('exactHeight' => true));
	$table->addCell(5900, array('gridSpan' => 2))->addText("Non Functional Requirements", $cellFontSize);
	$table->addCell(4000, array('gridSpan' => 3))->addText("Risk Reduction/Opportunity Enablement", $cellFontSize);
	
	$table->addRow(300, array('exactHeight' => false));
	$table->addCell(5900, array('gridSpan' => 2, 'vMerge' => 'restart'))->addText("fasdfdasf sdf asdf dfas asdf asdf asdf sadf afasdf sdf dfsas fasdf asdfasfasdf sdf dfasf asfasdfsfsdf sdf dsf sdf sdf df fasf asdfsd fasdf asdfsd af sdf sdfasdf sdf sf sdfasfasdfdsf sfd sdfasd fsdafsadf sd");
	$table->addCell(4000, array('gridSpan' => 3))->addText($data['f_RROE']);
	
	$table->addRow(300, array('exactHeight' => true));
	$table->addCell(5900, array('gridSpan' => 2, 'vMerge' => 'continue'))->addText("");
	$table->addCell(1333)->addText("Cost of Delay", $cellFontSize);
	$table->addCell(1333)->addText("Size", $cellFontSize);
	$table->addCell(1333)->addText("WSJF", $cellFontSize);
	
	$table->addRow(300, array('exactHeight' => false));
	$table->addCell(5900, array('gridSpan' => 2, 'vMerge' => 'continue'));
	$table->addCell(1333)->addText($cod);
	$table->addCell(1333)->addText($data['f_JS']);
	$table->addCell(1333)->addText($wsjf);
	
	
	$phpWord->save($file_name, 'Word2007', true);
}


function printTitleDocument($data)
{
	
	include_once F_ROOT . 'Word_Header.php';

// New Word Document
	$file_name = $data['f_title'] . '.docx';
	
	$phpWord = new \PhpOffice\PhpWord\PhpWord();
	
	$section = $phpWord->addSection();
	$section->addTextBreak(1);
	
	$fancyTableStyleName      = 'Fancy Table';
	$fancyTableStyle          = array('width' => '100%', 'borderSize' => 1, 'borderColor' => '000000', 'cellMargin' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 0, 'bgColor' => $data['highlight_color']);
	$fancyTableFirstRowStyle  = array('borderBottomSize' => 2, 'borderBottomColor' => '000000', 'bgColor' => $data['highlight_color']);
	$fancyTableCellStyle      = array('valign' => 'center');
	$fancyTableFontStyle      = array('bold' => true, 'size' => 24, 'Name' => 'Calibri');
	$fancyTableFontStyleSmall = array('bold' => false, 'size' => 18, 'Name' => 'Calibri');
	
	$phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
	
	$table = $section->addTable($fancyTableStyleName);
	$table->setWidth(4000);
	$table->addRow(4000, array('exactHeight' => 4000, 'exactWidth' => 4000));
	
	$cell          = $table->addCell(null, $fancyTableCellStyle);
	$cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
	$cell->addText($data['f_title'], $fancyTableFontStyle, $cellHCentered);
	$cell->addText($data['topic_name'], $fancyTableFontStyleSmall, $cellHCentered);
	
	$phpWord->save($file_name, 'Word2007', true);
}

function printTitleNemonicDocument($data)
{
	
	include_once F_ROOT . 'Word_Header.php';

// New Word Document
	$file_name = $data['f_title'] . '.docx';
	
	$phpWord = new \PhpOffice\PhpWord\PhpWord();
	$phpWord->setDefaultFontSize(1);
	
	$section = $phpWord->addSection([
										'pageSizeH' => (\PhpOffice\PhpWord\Shared\Converter::cmToTwip(8)),
										'pageSizeW' => (\PhpOffice\PhpWord\Shared\Converter::cmToTwip(8))
									]);
	//$section->addTextBreak(1);
	// 2 cm right margin
	$sectionStyle = $section->getStyle();
	$sectionStyle->setmarginLeft(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.0));
	$sectionStyle->setmarginRight(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.0));
	$sectionStyle->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.5));
	$sectionStyle->setMarginBottom(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.5));
	
	
	$fancyTableStyleName      = 'Fancy Table';
	$fancyTableStyle          = array('width' => '100%', 'borderSize' => 0, 'borderColor' => 'FFFFFF', 'cellMargin' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 0);
	$fancyTableFirstRowStyle  = array('borderBottomSize' => 0, 'borderBottomColor' => 'FFFFFF');
	$fancyTableCellStyle      = array('valign' => 'center');
	$fancyTableFontStyle      = array('bold' => true, 'size' => 24, 'Name' => 'Calibri');
	$fancyTableFontStyleSmall = array('bold' => false, 'size' => 18, 'Name' => 'Calibri');
	
	$phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
	
	$table = $section->addTable($fancyTableStyleName);
	$table->setWidth(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(7));
	$table->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(6.9), array('exactHeight' => false));//erster Teil: Angabe der Höhe
	//$table->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(6.5), array('exactHeight' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(6.5), 'exactWidth' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(6.5)));
	
	
	$cell          = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(7), $fancyTableCellStyle);
	$cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
	$cell->addText($data['f_title'], $fancyTableFontStyle, $cellHCentered);
	$cell->addText($data['topic_name'], $fancyTableFontStyleSmall, $cellHCentered);
	$phpWord->save($file_name, 'Word2007', true);
	
}

function printFeatureAntragDocument($data, $epic)
{
	$sme_name = '';
	if ($data['sme_detail']) {
		if ($data['sme_detail']['username']) {
			$sme_name = $data['sme_detail']['staff_firstname'] . ' ' . $data['sme_detail']['staff_lastname'] . ' (' . $data['sme_detail']['username'] . ')';
		} else {
			$sme_name = $data['sme_detail']['staff_firstname'] . ' ' . $data['sme_detail']['staff_lastname'];
		}
	}
	
	include_once F_ROOT . 'Word_Header.php';
	
	// New Word Document
	$file_name = $data['f_title'] . ' Feature-Antrag.docx';
	
	$phpWord = new \PhpOffice\PhpWord\PhpWord();
	
	$phpWord->addTitleStyle(1, array('bold' => true, 'size' => '16', 'Name' => 'Verdana', 'spaceAfter' => 0));
	$phpWord->addTitleStyle(2, array('bold' => true, 'size' => '12', 'Name' => 'Verdana'), array('spaceBefore' => 240, 'spaceAfter' => 0));
	
	$fontStyleName = 'contentstyle';
	$phpWord->addFontStyle($fontStyleName, array('bold' => false, 'italic' => true, 'size' => '11', 'Name' => 'Verdana', 'color' => '#3449eb'));
	
	$paragraphStyleName = 'paragraphstyle';
	$phpWord->addParagraphStyle($paragraphStyleName, array('spaceBefore' => 0, 'spaceAfter' => 0));
	
	$section = $phpWord->addSection();
	$section->addTitle("Feature", 1);
	$section->addTitle("Titel", 2);
	
	//$feature['highlight_color']
	$section->addText($data['highlight_color'], 'contentstyle', 'paragraphstyle');
	$section->addText($data['f_title'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("Projekt Epic (optional)", 2);
	$section->addText($epic, 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("Kurzbeschreibung", 2);
	$section->addText($data['f_desc'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("Kontext (optional))", 2);
	$section->addText($data['f_context'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("Problembeschreibung / Motivation", 2);
	$section->addText($data['f_problemdessc'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("IST-Zustand", 2);
	$section->addText($data['f_currentstate'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("SOLL-Zustand", 2);
	$section->addText($data['f_targetstate'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("Nutzen", 2);
	$section->addText($data['f_benefit'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("In Scope", 2);
	$section->addText($data['f_inscope'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("Out of Scope", 2);
	$section->addText($data['f_outofscope'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("Gew&uuml;nschtes Fertigstellungsdatum", 2);
	$section->addText($data['f_due_date'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("Ansprechpartner", 2);
	$section->addText($sme_name, 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("Abhängigkeiten", 2);
	$section->addText($data['f_dependencies'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("Risiken (optional)", 2);
	$section->addText($data['f_risks'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("Bemerkungen (optional)", 2);
	$section->addText($data['f_note'], 'contentstyle', 'paragraphstyle');
	
	//  $section->addTextBreak(1);
	
	$phpWord->save($file_name, 'Word2007', true);
}

function printEpicAntragDocument($db, $data)
{
	
	
	$status  = $db->getEpicsStatusByID($data['e_status_id']);
	$e_owner = $db->getStaffById($data['e_owner']);
	$team    = $db->getTeamByID($data['team_id']);
	
	if ($team) {
		$team = $team['name'];
	}
	
	include_once F_ROOT . 'Word_Header.php';
	
	// New Word Document
	$file_name = $data['e_title'] . ' Epic-Antrag.docx';
	
	$phpWord = new \PhpOffice\PhpWord\PhpWord();
	
	$phpWord->addTitleStyle(1, array('bold' => true, 'size' => '16', 'Name' => 'Verdana', 'spaceAfter' => 0));
	$phpWord->addTitleStyle(2, array('bold' => true, 'size' => '12', 'Name' => 'Verdana'), array('spaceBefore' => 240, 'spaceAfter' => 0));
	
	$fontStyleName = 'contentstyle';
	$phpWord->addFontStyle($fontStyleName, array('bold' => false, 'italic' => true, 'size' => '11', 'Name' => 'Verdana', 'color' => '#3449eb'));
	
	$paragraphStyleName = 'paragraphstyle';
	$phpWord->addParagraphStyle($paragraphStyleName, array('spaceBefore' => 0, 'spaceAfter' => 0));
	
	$section = $phpWord->addSection();
	$section->addTitle("Epic", 1);
	$section->addTitle("Titel", 2);
	
	$section->addText($data['e_title'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("Status", 2);
	$section->addText($status['name'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("Für", 2);
	$section->addText($data['e_hs_for'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("die", 2);
	$section->addText($data['e_hs_for_desc'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("ist", 2);
	$section->addText($data['e_hs_solution'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("ein", 2);
	$section->addText($data['e_hs_how'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("welche", 2);
	$section->addText($data['e_hs_value'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("im Vergleich zu", 2);
	$section->addText($data['e_hs_unlike'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("macht unsere Lösung", 2);
	$section->addText($data['e_hs_oursoluion'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("Schlüsselergebnisse (Hypothese)", 2);
	$section->addText($data['e_hs_businessoutcome'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("Zielführende Indikatoren", 2);
	$section->addText($data['e_hs_leadingindicators'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("Nicht-funktionale Anforderungen", 2);
	$section->addText($data['e_hs_nfr'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("Epic Owner", 2);
	$section->addText($e_owner['staff_firstname'] . ' ' . $e_owner['staff_lastname'], 'contentstyle', 'paragraphstyle');
	
	$section->addTitle("Team", 2);
	$section->addText($team, 'contentstyle', 'paragraphstyle');
	
	
	$section->addTitle("Bemerkung", 2);
	$section->addText($data['e_notes'], 'contentstyle', 'paragraphstyle');
	
	$phpWord->save($file_name, 'Word2007', true);
}

function printTitleDocumentByPI($data)
{
	
	include_once F_ROOT . 'Word_Header.php';

// New Word Document
	$file_name =  'Titel Karte.docx';
	$phpWord = new \PhpOffice\PhpWord\PhpWord();
	$i = 0;
	foreach ($data as $featureinfo){
		
		$highlight_color = str_replace("#", "", $featureinfo['highlight_color']);
		$fancyTableStyle['bgColor'] = $highlight_color;
		$section = $phpWord->addSection();
		$section->addTextBreak(1);
		$fancyTableStyleName      = 'Fancy Table'.$i;
		$fancyTableStyle          = array('width' => '100%', 'borderSize' => 1, 'borderColor' => '000000', 'cellMargin' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 0, 'bgColor' => $highlight_color);
		$fancyTableFirstRowStyle  = array('borderBottomSize' => 2, 'borderBottomColor' => '000000', 'bgColor' => $highlight_color);
		$fancyTableCellStyle      = array('valign' => 'center');
		$fancyTableFontStyle      = array('bold' => true, 'size' => 24, 'Name' => 'Calibri');
		$fancyTableFontStyleSmall = array('bold' => false, 'size' => 18, 'Name' => 'Calibri');
		
		$phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
		
		$table = $section->addTable($fancyTableStyleName);
		$table->setWidth(4000);
		$table->addRow(4000, array('exactHeight' => 4000, 'exactWidth' => 4000));
		
		$cell          = $table->addCell(null, $fancyTableCellStyle);
		$cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
		$cell->addText($featureinfo['f_title'], $fancyTableFontStyle, $cellHCentered);
		$cell->addText($featureinfo['name'], $fancyTableFontStyleSmall, $cellHCentered);
		$i++;
		
	}
	$phpWord->save($file_name, 'Word2007', true);
}