<div id="non_matched_jira">
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
	
	$jira_list = $db->getJiraTicketsNotMatched($lower_limit, $page_limit);
	
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
                    <td><?php echo $jira_info['jira_id']; ?></td>
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
                    <td><?php echo $jira_info['kommentar']; ?></td>
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