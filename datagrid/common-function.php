<?php
include("config.php");
    
$function2call = $_POST['method'];

/**
* Edit Select Value 
* @switch statement used for all @Feature, @Epics, @Staff
* Pass @post parms
* return updated value of select
*/

switch($function2call) {
	case 'getFeaturesTopicsSelectData' : getFeaturesTopicsSelectData($_POST['featuresTopics'],$_POST['f_id']);
	break;
	case 'getFeaturesPiSelectData' : getFeaturesPiSelectData($_POST['featuresPi'],$_POST['f_id']);
	break;
	case 'getFeaturesStatusSelectData' : getFeaturesStatusSelectData($_POST['featuresStatus'],$_POST['f_id']);
	break;
	case 'getEpicSelectData' : getEpicSelectData($_POST['teamValue'],$_POST['e_id']);
	break;
	case 'getStaffSelectData' : getStaffSelectData($_POST['staffteamValue'],$_POST['staff_id']);
	break;
   case 'getTopicsSelectData' : getTopicsSelectData($_POST['topicValue'],$_POST['staff_id']);
	break;
	case 'other' : // do something;break;
	// other cases
}



/**************************Features Grid Select/Drop-down  Value Update Starts **************/

/**
* @Update select value of the Features Topics
* @post args passed
* return status
*/
function getFeaturesTopicsSelectData($fea1, $fea2){
	global $conn; 
	$sql = "UPDATE features SET f_topic_id='".$fea1."' WHERE f_id='".$fea2."'";	
	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $conn->error;
	}	
}

/**
* @Update select value of the Features Pi
* @post args passed
* return status
*/

function getFeaturesPiSelectData($fea3, $fea4){
	global $conn; 
	$sql = "UPDATE features SET f_PI='".$fea3."' WHERE f_id='".$fea4."'";	
	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $conn->error;
	}	
}

/**
* @Update select value of the Features Status
* @post args passed
* return status
*/

function getFeaturesStatusSelectData($fea5, $fea6){
	global $conn; 
	$sql = "UPDATE features SET f_status_id='".$fea5."' WHERE f_id='".$fea6."'";	
	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $conn->error;
	}	
}




/**************************Features Grid Select/Drop-down Value Update Ends  **************/


/**************************Epic Grid Select/Drop-down Value Update Starts **************/
	
/**
* @Update select value of the Epic Team
* @post args passed
* return status
*/
function getEpicSelectData($arg1, $arg2){
	global $conn; 
	$sql = "UPDATE epics SET team_id='".$arg1."' WHERE e_id='".$arg2."'";	
	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $conn->error;
	}	
}
/**************************Epic Grid Select/Drop-down Value Update Ends **************/

/**************************Staff Grid Select/Drop-down Value Update Starts **************/
/**
* @Update select value of the Staff Team
* @post args passed
* return status
*/
function getStaffSelectData($arg3, $arg4){
	global $conn; 
	$sql = "UPDATE staff SET staff_team_id='".$arg3."' WHERE staff_id='".$arg4."'";	
	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $conn->error;
	}	
}

/**
* @Update select value of the Staff Topics
* @post args passed
* return status
*/
function getTopicsSelectData($arg5, $arg6){
	global $conn; 
	$sql = "UPDATE staff SET staff_topic_id='".$arg5."' WHERE staff_id='".$arg6."'";	
	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $conn->error;
	}	
}
/**************************Staff Grid Select/Drop-down Value Update Ends **************/
	
$conn->close();
?>