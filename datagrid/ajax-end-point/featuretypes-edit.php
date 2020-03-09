<?php
namespace Phppot;

use Phppot\Model\epic;

$columnName = $_POST["column"];
$columnValue = $_POST["editval"];
$questionId = $_POST["id"];

require_once (__DIR__ . "./../Model/epic.php");
$faq = new epic();
$epicsresult = $faq->featuretypeseditRecord($columnName, $columnValue, $questionId);
?>