<div id="matched_jira_pm">
	<?php
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
                    <td><?php echo $jira_info['jira_id']; ?></td>
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
                    <td colspan="2"><textarea name="f_jira_notes" data-f_id="<?php echo $feature_info['f_id'];?>" class="f_jira_notes form-group w-100"><?php echo $feature_info['f_jira_notes']; ?></textarea></td>
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
	} ?>
</div>
