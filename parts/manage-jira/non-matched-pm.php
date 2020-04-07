<div id="non_matched_pm">
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
	
	$cnt = $db->getFeatureNonMatchedByJiraIdCount($selected_epic, $selected_status, $selected_pi);
	
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
  
	$feature_list = $db->getFeatureNonMatchedByJiraId($selected_epic, $selected_status, $selected_pi, $lower_limit, $page_limit);
	
	foreach ($feature_list as $feature) {
		
		$feature_info = $db->getFeatureByFeatureId($feature['f_id']);
		?>
        <div class="col-md-12 p-3">
            <table class="table-sm table-bordered col-md-6">
                <thead>
                <tr>
                    <th></th>
                    <th>PM
                      <?php if ($feature_info['f_id']) { ?>
                         <a class="mr-1 " target="_blank" href="https://pm.mastaz.ch/feature-request.php?f_id=<?php echo $feature_info['f_id']; ?>" title="Infos auf Jira abrufen"><i class="fa fa-pencil" aria-hidden="true"></i></a>
											<?php } ?>                        
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>Titel:</th>
                    <td><?php echo $feature_info['f_title']; ?></td>
                </tr>
                <tr>
                    <th>Jira ID:</th>
                    <td>
                    
                            <select class="form-control" id="jira" name="jira">
                                <option value="">--bitte w<span>&#228;</span>hlen--</option>
                    								<?php
                    								foreach ($getjira as $jiraget) {
                    									$selected = $jiraget['e_id'] == $selected_epic ? "selected='selected'" : ""; ?>
                                                        ?>
                                                        <option value="<?php echo $jiraget['id']; ?>" <?php echo $selected; ?>><?php echo $jiraget['title']; ?> (<?php echo $jiraget['j_key']; ?> / [PIx]) </option>
                    									<?php
                    								}
                    								?>
                            </select>
                    </td>                            
                </tr>
                <tr>
                    <th>Bemerkung:</th>
                    <td><?php echo $feature_info['f_note']; ?></td>
                </tr>
                <tr>
                    <th>Type:</th>
                    <td><?php echo $alltypes[$feature_info['f_type']]; ?></td>
                </tr>
                <tr>
                    <th>Epic:</th>
                    <td><?php echo $allepics[$feature_info['f_epic']]; ?></td>
                </tr>
                <tr>
                    <th>Status:</th>
                    <td><?php echo $allfeaturesstatuses[$feature_info['f_status_id']]; ?></td>
                </tr>                
                <tr>
                    <th>
                      <label for="f_PI" class="col-form-label">PI: <?php if ($helptexts['f_PI']) {
                  				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_PI'] . "'></i>";
                  		    } ?> 
                      </label>                     
                    </th>
                    <td><?php echo $allproductincrements[$feature_info['f_PI']]; ?></td>
                </tr>                  
                <tr>
                    <th>Kommentar:</th>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <th>Ok, dass kein Match?:</th>
                    <td colspan="2"><input type="checkbox" id="XXXX" name="XX" value="XXX"></td>
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
                <li class="page-item"><a class="page-link" href="javascript:void(0);" class="links" onclick="displayRecordsforNonMatchedPM('<?php echo $page_limit; ?>', '<?php echo 1; ?>');">First</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0);" class="links" onclick="displayRecordsforNonMatchedPM('<?php echo $page_limit; ?>', '<?php echo $pagenum - 1; ?>');">Previous</a></li>
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
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" class="links" onclick="displayRecordsforNonMatchedPM('<?php echo $page_limit; ?>', '<?php echo $i; ?>');"><?php echo $i ?></a></li>
					<?php
				}
			}
			if (($pagenum + 1) <= $last) {
				?>
                <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="displayRecordsforNonMatchedPM('<?php echo $page_limit; ?>', '<?php echo $pagenum + 1; ?>');" class="links">Next</a></li>
			<?php }
			if (($pagenum) != $last) { ?>
                <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="displayRecordsforNonMatchedPM('<?php echo $page_limit; ?>', '<?php echo $last; ?>');" class="links">Last</a></li>
				<?php
			}
			?>
        </ul>
        </nav>
		<?php
	}
	?>
</div>
<div class="loader"></div>
