<?php
namespace Phppot;

use Phppot\Model\epic;

$columnName = $_POST["column"];
$columnValue = $_POST["editval"];
$questionId = $_POST["pi_id"];

require_once (__DIR__ . "./../Model/epic.php");
$faq = new epic();
$epicsresult = $faq->productInceditRecord($columnName, $columnValue, $questionId);
?>
