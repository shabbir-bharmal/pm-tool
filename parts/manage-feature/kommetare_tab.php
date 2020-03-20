</br>
<div class="form-group row">
<?php
function convert_from_latin1_to_utf8_recursively($dat)
{
	if (is_string($dat)) {
		return utf8_encode($dat);
	} elseif (is_array($dat)) {
		$ret = [];
		foreach ($dat as $i => $d) $ret[ $i ] = convert_from_latin1_to_utf8_recursively($d);
		
		return $ret;
	} elseif (is_object($dat)) {
		foreach ($dat as $i => $d) $dat->$i = convert_from_latin1_to_utf8_recursively($d);
		
		return $dat;
	} else {
		return $dat;
	}
}
if ($f_id) {
	
	$users = array();
	$i     = 0;
	foreach ($feature_staff as $staff) {
		$users[$i]['id']                  = $staff['staff_id'];
		$users[$i]['fullname']            = htmlentities (  $staff['staff_firstname'] . ' ' . $staff['staff_lastname'], ENT_SUBSTITUTE   , 'utf-8' );
		$users[$i]['email']               = $staff['email'];
		$users[$i]['profile_picture_url'] = $staff['staff_avatar'];
		$i++;
	}
	
	
	$usersdata = json_encode(convert_from_latin1_to_utf8_recursively($users));
	
	$feature_comments  = $db->getCommentsByIdAndType($f_id,'feature');
	$feature_comments_data = array();
	foreach ($feature_comments as $comments) {
		$pings                   = $db->getPingByCommentID($comments['id']);
		$comments['pings']       = $pings;
		
		if ($comments['creator'] != $_SESSION['login_user_data']['staff_id']){
		    $staffcomments = $db->getStaffById($comments['creator']);
			
			$comments['fullname'] = convert_from_latin1_to_utf8_recursively($staffcomments['staff_firstname'] . ' ' . $staffcomments['staff_lastname']);
			
			if($staffcomments['staff_avatar']){
				$comments['profile_picture_url'] = $staffcomments['staff_avatar'];
            }else{
				$comments['profile_picture_url'] = "https://viima-app.s3.amazonaws.com/media/public/defaults/user-icon.png";
			}
			$comments['created_by_current_user']       = false;
	    }else{
			$comments['created_by_current_user']       = true;
		    $comments['fullname'] = 'You';
		    if($_SESSION['login_user_data']['staff_avatar']){
				$comments['profile_picture_url'] = $_SESSION['login_user_data']['staff_avatar'];
            }else{
				$comments['profile_picture_url'] = "https://viima-app.s3.amazonaws.com/media/public/defaults/user-icon.png";
            }
	    }
		$feature_comments_data[] = $comments;
    }

	?>
    <script>
        var usersArray = <?php echo $usersdata; ?>;
        var commentsArray = <?php echo json_encode($feature_comments_data); ?>;
        var modal = 'feature';
        var modal_id = <?php echo $f_id;?>;
        var login_id = <?php echo $_SESSION['login_user_data']['staff_id'];?>;
        var staff_avatar = '<?php echo $_SESSION['login_user_data']['staff_avatar'];?>';
    </script>
    
    <div class="col-12" id="comments-container"></div>
<?php }
?>
</div>
