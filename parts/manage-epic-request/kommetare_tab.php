</br>
<div class="form-group row">
	<?php
	if ($e_id) {
		
		$users = array();
		$i     = 0;
		foreach ($staff as $staff_info) {
			$users[$i]['id']                  = $staff_info['staff_id'];
			$users[$i]['fullname']            = htmlentities (  $staff_info['staff_firstname'] . ' ' . $staff_info['staff_lastname'], ENT_SUBSTITUTE   , 'utf-8' );
			$users[$i]['email']               = $staff_info['email'];
			$users[$i]['profile_picture_url'] = $staff_info['staff_avatar'];
			$i++;
		}
		
		$usersdata = json_encode($users);
		
		$epic_comments  = $db->getCommentsByIdAndType($e_id,'epic');
		$epic_comments_data = array();
		foreach ($epic_comments as $comments) {
			$pings                   = $db->getPingByCommentID($comments['id']);
			$comments['pings']       = $pings;
			
			if ($comments['creator'] != $_SESSION['login_user_data']['staff_id']){
				$staffcomments = $db->getStaffById($comments['creator']);
				
				$comments['fullname'] = htmlentities (  $staffcomments['staff_firstname'] . ' ' . $staffcomments['staff_lastname'], ENT_SUBSTITUTE   , 'utf-8' );
				
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
