<div id="matched_jira_pm">
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
	
	$page_limit = 1;
	
	$cnt = $db->getFeatureMatchedByJiraIdCount($selected_epic, $selected_status, $selected_pi);
	
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
	
	$feature_list = $db->getFeatureMatchedByJiraId($selected_epic, $selected_status, $selected_pi, $lower_limit, $page_limit);
	
	foreach ($feature_list as $feature) {
		
		$feature_info = $db->getFeatureByFeatureId($feature['f_id']);
		$jira_info    = $db->getJiraTicketById($feature['f_jira_id']);
		?>
        <div class="col-md-12 p-3">
            <table class="table-sm table-bordered col-md-7" style="table-layout: fixed; width: 100%;">
                <thead>
                <tr>
                    <th style="width:20%; min-width:20% !important;max-width:20% !important;"></th>
                    <th style="width:38%; min-width:38% !important;max-width:38% !important;">Jira
                      <?php if ($jira_info['j_key']) { ?>
                         <a class="mr-1 " target="_blank" href="https://jira.zhaw.ch/browse/<?php echo $jira_info['j_key']; ?>" title="Infos auf Jira abrufen"><i class="fa fa-rocket" aria-hidden="true"></i></a>
											<?php } ?>                
                    </th >
                    <th style="width:38%; min-width:38% !important;max-width:38% !important;">PM-Tool
                      <?php if ($feature_info['f_id']) { ?>
                         <a class="mr-1 " target="_blank" href="https://pm.mastaz.ch/feature-request.php?f_id=<?php echo $feature_info['f_id']; ?>" title="Infos auf Jira abrufen"><i class="fa fa-pencil" aria-hidden="true"></i></a>
											<?php } ?>                    
                    </th>
                    <th style="width:4%; min-width:4% !important;max-width:4% !important;">OK?</th>  
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>Titel:</th>
                    <td><?php echo $jira_info['title']; ?></td>
                    <td><?php echo $feature_info['f_title']; ?></td>
                    <?php echo valueequal($jira_info['title'], $feature_info['f_title']) ?>     
                </tr>
                <tr>
                    <th>Jira Key:</th>
                    <td><?php echo $jira_info['j_key']; ?></td>
                    <td><?php echo $feature_info['f_jira_id']; ?></td>
                    <?php echo valueequal($jira_info['j_key'], $feature_info['f_jira_id']) ?>                    
                </tr>
                <tr>
                    <th>***Epic:***</th>
                    <td><?php echo $jira_info['epic']; ?></td>
                    <td><?php echo $allepics[$feature_info['f_epic']]; ?></td>
                    <?php echo valueequal($jira_info['epic'], $feature_info['f_epic']) ?>
                </tr>
                <tr>
                    <th>***Status:***</th>
                    <td><?php echo $jira_info['j_status']; ?></td>
                    <td><?php echo $allfeaturesstatuses[$feature_info['f_status_id']]; ?></td>
                    <td style="background-color:#F0F3F4;">&nbsp;</td>
                </tr>                
<!--  -->                
                <tr>
                    <th>
                      <label for="f_due_date" class="col-form-label">Gew&uuml;nschtes Fertigstellungsdatum: <?php if ($helptexts['f_due_date']) {
                  				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_due_date'] . "'></i>";
                  		    } ?> 
                      </label>                    
                    </th>
                    <td><?php echo $jira_info['j_due_date']; ?></td>
                    <td><?php echo $feature_info['f_due_date']; ?></td>
                    <?php echo valueequal($jira_info['j_due_date'], $feature_info['f_due_date']) ?>
                </tr>
                <tr>
                    <th>
                      <label for="f_storypoints" class="col-form-label">Storypoints: <?php if ($helptexts['f_storypoints']) {
                  				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_storypoints'] . "'></i>";
                  		    } ?> 
                      </label>                     
                    </th>
                    <td><?php echo $jira_info['j_SP']; ?></td>
                    <td><?php echo $feature_info['f_storypoints']; ?></td>
                    <?php echo valueequal($jira_info['j_SP'], $feature_info['f_storypoints']) ?>
                </tr>                
                <tr>
                    <th>
                      <label for="f_BV" class="col-form-label">BV: <?php if ($helptexts['f_BV']) {
                  				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_BV'] . "'></i>";
                  		    } ?> 
                      </label>                     
                    </th>
                    <td><?php echo $jira_info['j_BV']; ?></td>
                    <td><?php echo $feature_info['f_BV']; ?></td>
                    <?php echo valueequal($jira_info['j_BV'], $feature_info['f_BV']) ?>
                </tr>  
                <tr>
                    <th>
                      <label for="f_TC" class="col-form-label">TC: <?php if ($helptexts['f_TC']) {
                  				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_TC'] . "'></i>";
                  		    } ?> 
                      </label>                     
                    </th>
                    <td><?php echo $jira_info['j_TC']; ?></td>
                    <td><?php echo $feature_info['f_TC']; ?></td>
                    <?php echo valueequal($jira_info['j_SP'], $feature_info['f_TC']) ?>
                </tr>   
                <tr>
                    <th>
                      <label for="f_RROE" class="col-form-label">RROE: <?php if ($helptexts['f_RROE']) {
                  				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_RROE'] . "'></i>";
                  		    } ?> 
                      </label>                     
                    </th>
                    <td><?php echo $jira_info['j_RROE']; ?></td>
                    <td><?php echo $feature_info['f_RROE']; ?></td>
                    <?php echo valueequal($jira_info['j_RROE'], $feature_info['f_RROE']) ?>
                </tr>          
                <tr>
                    <th>
                      <label for="f_JS" class="col-form-label">JS: <?php if ($helptexts['f_JS']) {
                  				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_JS'] . "'></i>";
                  		    } ?> 
                      </label>                     
                    </th>
                    <td><?php echo $jira_info['j_JS']; ?></td>
                    <td><?php echo $feature_info['f_JS']; ?></td>
                    <?php echo valueequal($jira_info['j_JS'], $feature_info['f_JS']) ?>
                </tr>  
                <tr>
                    <th>
                      <label for="f_WSJF" class="col-form-label">WSJF <?php if ($helptexts['f_WSJF']) {
                  				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_WSJF'] . "'></i>";
                  		    } ?> 
                      </label>                     
                    </th>
                    <?php
                    $wsjf_pm = ($feature_info['f_BV'] + $feature_info['f_TC'] + $feature_info['f_RROE']) / $feature_info['f_JS'];
                    $wsjf_jira = ($jira_info['j_BV'] + $jira_info['j_TC'] + $jira_info['j_RROE']) / $jira_info['j_JS'];
                    ?>
                    <td><?php echo $wsjf_jira; ?></td>
                    <td><?php echo $wsjf_pm; ?></td>
                    <?php echo valueequal($wsjf_jira, $wsjf_pm) ?>
                </tr>     
                <tr>
                    <th>
                      <label for="f_type" class="col-form-label">Type: <?php if ($helptexts['f_type']) {
                  				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_type'] . "'></i>";
                  		    } ?> 
                      </label>                     
                    </th>
                    <td><?php echo $jira_info['j_type']; ?></td>
                    <td><?php echo $alltypes[$feature_info['f_type']]; ?></td>
                    <?php echo valueequal($jira_info['j_type'], $alltypes[$feature_info['f_type']]) ?>
                </tr>        
                <tr>
                    <th>
                      <label for="f_team" class="col-form-label">Team: <?php if ($helptexts['f_team']) {
                  				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_team'] . "'></i>";
                  		    } ?> 
                      </label>
                    </th>
                    <td><?php echo $jira_info['j_team']; ?></td>
                    <td style="background-color:#F0F3F4;">Keine Teamzuweisung im pm.mastaz.ch</td> 
                    <td style="background-color:#F0F3F4;">&nbsp;</td>
                </tr>     
                <tr>
                    <th>
                      <label for="f_team" class="col-form-label">Topic: <?php if ($helptexts['f_topic']) {
                  				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_topic'] . "'></i>";
                  		    } ?> 
                      </label>
                    </th>
                    <td><?php echo $jira_info['j_topic']; ?></td>
                    <td><?php echo $alltopics[$feature_info['f_topic_id']]; ?></td>    
                    <?php echo valueequal($jira_info['j_topic'], $alltopics[$feature_info['f_topic_id']]) ?>
                </tr>                 
                <tr>
                    <th>
                      <label for="f_PI" class="col-form-label">PI: <?php if ($helptexts['f_PI']) {
                  				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_PI'] . "'></i>";
                  		    } ?> 
                      </label>                     
                    </th>
                    <td><?php echo $jira_info['j_PI']; ?></td>
                    <td><?php echo $allproductincrements[$feature_info['f_PI']]; ?></td>
                    <?php echo valueequal($jira_info['j_PI'], str_replace(' ', '',$allproductincrements[$feature_info['f_PI']])) ?>
                </tr>  
                <tr>
                    <th>
                      <label for="f_desc" class="col-form-label">Kurzbeschreibung: <?php if ($helptexts['f_desc']) {
                  				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_desc'] . "'></i>";
                  		    } ?> 
                      </label>                     
                    </th>
                    <td style="overflow-wrap: break-word;"><?php echo $jira_info['j_desc']; ?></td>
                    <td style="overflow-wrap: break-word;"><?php echo $feature_info['f_desc']; ?></td>
                    <?php echo valueequal($jira_info['j_desc'], $feature_info['f_desc']) ?>
                </tr>                                                                                                                                
                <tr>
                    <th>Notiz zum Abgleich:</th>
                    <td colspan="3"><textarea name="f_jira_notes" data-f_id="<?php echo $feature_info['f_id'];?>" class="f_jira_notes form-group w-100"><?php echo $feature_info['f_jira_notes']; ?></textarea></td>
                </tr>
                </tbody>
            </table>
        </div>
		<?php
	}
	if ($cnt > $page_limit) {
		?>
        <nav aria-label="Page navigation example" class="ml-3">
        <ul class="pagination">
			
			<?php
					if (($pagenum - 1) > 0) {
						?>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);" class="links" onclick="displayRecordsforMatchedPM('<?php echo $page_limit; ?>', '<?php echo 1; ?>');">First</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);" class="links" onclick="displayRecordsforMatchedPM('<?php echo $page_limit; ?>', '<?php echo $pagenum - 1; ?>');">Previous</a></li>
						<?php
					}else{
          ?>
                        <li class="page-item"><span class="page-link" class="links" >First</span></li>
                        <li class="page-item"><span class="page-link" class="links" >Previous</span></li>
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
                <li class="page-item" style="margin-left:10px;"><a class="page-link" href="javascript:void(0);" onclick="displayRecordsforMatchedPM('all', '1');" class="links">All</a></li>      
        </ul>
        </nav>                                                                                                                                            
		<?php
	} ?>
</div>
<?php
  function valueequal($jira_value, $pmvalue)
  {
    if ($jira_value==$pmvalue){
      return '<td style="background-color:green;"><b>OK</b></td>';
    }else{
      return '<td style="background-color:red;;"><b>NOK</b></td>';
    }
  
  }
?>