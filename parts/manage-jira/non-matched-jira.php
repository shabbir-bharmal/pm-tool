<div id="non_matched_jira">
	<?php
	if (!(isset($_GET['pagenum']))) {
		$pagenum = 1;
	} else {
		$pagenum = intval($_GET['pagenum']);
	}
	
	$selected_epic   = $_GET['epic'];
	$selected_status = $_GET['f_status_id'];
	$selected_pi     = $_GET['f_pi_id'];
	
	if (empty($selected_epic)) {
		$selected_epic = 0;
	}
	if (empty($selected_status)) {
		$selected_status = 0;
	}
	if (empty($selected_pi)) {
		$selected_pi = 0;
	}
	
	$page_limit = 10;
	
	$cnt = $db->getJiraTicketsNotMatchedCount();
	
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
	if (empty($selected_pi)) {
		$selected_pi = 0;
	}
	
	$jira_list            = $db->getJiraTicketsNotMatched($lower_limit, $page_limit);
	$getnotmatchedfeature = $db->getFeaturesNotMatchedList($selected_epic, $selected_status, $selected_pi);
	
	foreach ($jira_list as $jira_info) {
		?>
        <div class="col-md-12 p-3">
            <table class="table-sm table-bordered">
                <thead>
                <tr>
                    <th></th>
                    <th>Jira</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>Titel:</th>
                    <td><?php echo $jira_info['title']; ?></td>
                </tr>
                <tr>
                    <th>Jira ID:</th>
                    <td><?php echo $jira_info['j_key']; ?></td>
                </tr>
                <tr>
                    <th>Features:</th>
                    <td>
                        <select class="form-control f_id" data-j_key="<?php echo $jira_info['j_key']; ?>" name="f_id">
                            <option value="">--bitte w<span>&#228;</span>hlen--</option>
							<?php
							foreach ($getnotmatchedfeature as $featuredata) {
								
								?>
                                <option value="<?php echo $featuredata['f_id']; ?>"><?php echo $featuredata['f_title']; ?> ( [PI<?php echo $featuredata['f_PI']; ?>] )</option>
								<?php
							}
							?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Bemerkung:</th>
                    <td><?php echo $jira_info['bemerkung']; ?></td>
                </tr>
                <tr>
                    <th>BV (Business Value):</th>
                    <td><?php echo $jira_info['BV']; ?></td>
                </tr>
                <tr>
                    <th>Type:</th>
                    <td><?php echo $jira_info['type']; ?></td>
                </tr>
                <tr>
                    <th>Epic:</th>
                    <td><?php echo $jira_info['epic']; ?></td>
                </tr>
                <tr>
                    <th>Kommentar:</th>
                    <td><textarea data-j_key="<?php echo $jira_info['j_key']; ?>" name="kommentar" class="kommentar form-group w-100"><?php echo $jira_info['kommentar']; ?></textarea></td>
                </tr>
                <tr>
                    <th>Ok, dass kein Match?:</th>
                    <td colspan="2"><input class="jira_match" type="checkbox" data-j_key="<?php echo $jira_info['j_key']; ?>" name="jira_match" <?php if($jira_info['jira_match'] == 1){ echo "checked"; }?> ></td>
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
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" class="links" onclick="displayRecordsforNonMatchedJira('<?php echo $page_limit; ?>', '<?php echo 1; ?>');">First</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" class="links" onclick="displayRecordsforNonMatchedJira('<?php echo $page_limit; ?>', '<?php echo $pagenum - 1; ?>');">Previous</a></li>
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
                        <li class="page-item"><a class="page-link" href="javascript:void(0);" class="links" onclick="displayRecordsforNonMatchedJira('<?php echo $page_limit; ?>', '<?php echo $i; ?>');"><?php echo $i ?></a></li>
						<?php
					}
				}
				if (($pagenum + 1) <= $last) {
					?>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="displayRecordsforNonMatchedJira('<?php echo $page_limit; ?>', '<?php echo $pagenum + 1; ?>');" class="links">Next</a></li>
				<?php }
				if (($pagenum) != $last) { ?>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="displayRecordsforNonMatchedJira('<?php echo $page_limit; ?>', '<?php echo $last; ?>');" class="links">Last</a></li>
					<?php
				}
				?>
            </ul>
        </nav>
		<?php
	} ?>
</div>