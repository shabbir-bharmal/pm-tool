<?php

if (empty($selected_epic)) {
	$selected_epic = 0;
}
if (empty($selected_status)) {
	$selected_status = 0;
}
$jira_list = $db->getJiraTicketsNotMatched();

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
				<td><?php echo $jira_info['title'];?></td>
			</tr>
			<tr>
				<th>Jira ID:</th>
				<td><?php echo $jira_info['jira_id'];?></td>
			</tr>
			<tr>
				<th>Bemerkung:</th>
				<td><?php echo $jira_info['bemerkung'];?></td>
			</tr>
			<tr>
				<th>BV (Business Value):</th>
				<td><?php echo $jira_info['BV'];?></td>
			</tr>
			<tr>
				<th>Type:</th>
				<td><?php echo $jira_info['type'];?></td>
			</tr>
			<tr>
				<th>Epic:</th>
				<td><?php echo $jira_info['epic'];?></td>
			</tr>
			<tr>
				<th>Kommentar:</th>
				<td><?php echo $jira_info['kommentar'];?></td>
			</tr>
			</tbody>
		</table>
	</div>
	<?php
}
?>

