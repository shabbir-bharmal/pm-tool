<?php
error_reporting(E_ALL);
session_start();
define('WROOT', 'http://localhost/pm_tool');

include_once 'database.php';

use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;


$db            = new Database();
$db_connection = $db->connect();
$action        = $_REQUEST && $_REQUEST['action'] ? $_REQUEST['action'] : '';

switch ($action) {
	case 'feature-add':
	case 'feature-edit':
		
		$db->saveFeature($_POST);
		header("Location: " . WROOT . "/roadmap.php?topic=" . $_POST['topic_id']);
		break;
	case 'feature-delete':
		$db->deleteFeature($_POST['f_id']);
		header("Location: " . WROOT . "/roadmap.php?topic=" . $_POST['topic_id']);
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
				$epic                     = $db->getEpicsByID($_POST['f_epic']);
				$data                     = $_POST;
				$data['sme_detail']       = $sme;
				printFeatureAntragDocument($data, $epic['e_title']);
				break;
			case 'detail':
			default:
				$highlight_color          = $db->getFeatureHighlightColor($_POST['f_type']);
				$_POST['highlight_color'] = str_replace("#", "", $highlight_color['highlight_color']);
				printDetailDocument($_POST);
				break;
		}
		break;
	case 'user-login':
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		$result = $db->getUserData($username, $password);
		$count  = count($result);
		
		if ($count > 1) {
			$_SESSION['login_user_data'] = $result;
			header("location:" . WROOT . "/roadmap.php");
		} else {
			$error             = "Your Username or Password is invalid.";
			$_SESSION['error'] = $error;
			header("Location: " . WROOT);
		}
		break;
	default:
		break;
}
function printDetailDocument($data)
{
	include_once 'Word_Header.php';
	
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
	
	include_once 'Word_Header.php';

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
	
	include_once 'Word_Header.php';

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
			$sme_name = $data['sme_detail']['staff_firstname'].' '.$data['sme_detail']['staff_lastname'].' ('.$data['sme_detail']['username'].')';
		} else {
			$sme_name = $data['sme_detail']['staff_firstname'].' '.$data['sme_detail']['staff_lastname'];
		}
	}

	include_once 'Word_Header.php';
	
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
	
	$section->addTitle("Gewünschtes Fertigstellungsdatum", 2);
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