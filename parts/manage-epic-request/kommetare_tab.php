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
	if ($e_id) {
		
		$users = array();
		$i     = 0;
		foreach ($staff as $staff_info) {
			$users[$i]['id']                  = $staff_info['staff_id'];
			$users[$i]['fullname']            = $staff_info['staff_firstname'] . ' ' . $staff_info['staff_lastname'];
			$users[$i]['email']               = $staff_info['email'];
			$users[$i]['profile_picture_url'] = $staff_info['staff_avatar'];
			$i++;
		}
		
		$usersdata = json_encode(convert_from_latin1_to_utf8_recursively($users));
		
		$epic_comments  = $db->getCommentsByIdAndType($e_id,'epic');
		$epic_comments_data = array();
		foreach ($epic_comments as $comments) {
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
			$epic_comments_data[] = $comments;
		}
		
		?>
        <script>
            var usersArray = <?php echo $usersdata; ?>;
            var commentsArray = <?php echo json_encode($epic_comments_data); ?>;
            var modal = 'epic';
            var modal_id = <?php echo $e_id;?>;
            var login_id = <?php echo $_SESSION['login_user_data']['staff_id'];?>;
            var staff_avatar = '<?php echo $_SESSION['login_user_data']['staff_avatar'];?>';

        </script>


        <div class="col-12" id="comments-container"></div>
	<?php }
	?>
</div>
