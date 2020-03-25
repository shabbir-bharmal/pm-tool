<?php

if (empty($selected_epic)) {
	$selected_epic = 0;
}
if (empty($selected_status)) {
	$selected_status = 0;
}

$feature_list = $db->getFeatureNoteMatchedByJiraId($selected_epic, $selected_status);

foreach ($feature_list as $feature) {
	
	$feature_info = $db->getFeatureByFeatureId($feature['f_id']);
	?>
	<div class="col-md-12 p-3">
		<table class="table-sm table-bordered">
			<thead>
			<tr>
				<th></th>
				<th>PM</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<th>Titel:</th>
				<td><?php echo $feature_info['f_title'];?></td>
			</tr>
			<tr>
				<th>Jira ID:</th>
				<td><?php echo $feature_info['f_jira_id'];?></td>
			</tr>
			<tr>
				<th>Bemerkung:</th>
				<td><?php echo $feature_info['f_note'];?></td>
			</tr>
			<tr>
				<th>BV (Business Value):</th>
				<td><?php echo $feature_info['f_BV'];?></td>
			</tr>
			<tr>
				<th>Type:</th>
				<td><?php echo $alltypes[$feature_info['f_type']];?></td>
			</tr>
			<tr>
				<th>Epic:</th>
				<td><?php echo $allepics[$feature_info['f_epic']];?></td>
			</tr>
			<tr>
				<th>Kommentar:</th>
				<td colspan="2"></td>
			</tr>
			</tbody>
		</table>
	</div>
	<?php
}
?>

