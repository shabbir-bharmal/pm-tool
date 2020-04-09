<?php

$allpi               = array_reverse($db->getAllProductIncrements());
$alldept             = $db->getAllDepartements();
$feature_statuses    = $db->getFeatureStatuses();
$allfeaturesstatuses = array();
foreach ($feature_statuses as $f_status) {
	$allfeaturesstatuses[$f_status['id']] = $f_status['name'];
}

$gettopics = $db->getTopics();
$alltopics = array();
foreach ($gettopics as $topics) {
	$alltopics[$topics['id']] = $topics['name'];
}
$color = [
  0 => '#e0fffc',
	1 => 'blue',
	2 => 'green',
	3 => 'yellow',
	4 => 'orange',
	5 => 'red'
];

$f_pi       = $_GET['f_pi'];
$f_oe       = $_GET['f_oe'];
$f_status   = $_GET['f_status'];
$f_topics   = $_GET['f_topics'];
$opt_values = array('0', '1', '2', '3', '5', '8', '13', '20');
$op_values  = array('0', '1', '2', '3', '4', '5');

if (empty($_GET)) {
	if (count($f_topics) < 1) {
		$f_topics = array(1, 2);
	}
	if (count($f_status) < 1) {
		$f_status = array(1, 2, 5);
	}
	if (count($f_pi) < 1) {
		$actual_product_increment = $db->getActualProductIncrement();
		$product_increments       = $db->getOtherProductIncrements($actual_product_increment['pi_id']);
		$f_pi                     = array($product_increments[0]['pi_id'], $actual_product_increment['pi_id']);
	}
	if (count($f_oe) < 1) {
		$f_oe = array(1, 2, 3, 4, 5, 6, 7, 8);
	}
}
$feature_list = $db->getFeatureByStatusAndTopic($f_status, $f_topics);

$login_id = $_SESSION['login_user_data']['staff_id'];
if($_SERVER['QUERY_STRING']){
       $db->storeCustomerInput($login_id,$_SERVER['QUERY_STRING']);
}else{
   $query_string = $db->getCustomerInput($login_id);
   if($query_string){
	   $url = W_ROOT.'/customers-input.php?'.$query_string;
	   echo "<script>window.location.href='".$url."';</script>";
	   exit;
   }
}

?>
<div class="container-fluid mt-3 mb-3">

    <div class="row mb-3">
        <div class="col-12">
            <h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">Inputs des Faches
                <span class="h6" style="display: inline-flex;vertical-align: middle;">
        			       <?php if ($helptexts['title_customers_input']) {
							   echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['title_customers_input'] . "'></i>";
						   } ?>
        </span></h2>
          <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Simple collapsible</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-sm-8 col-xs-12">
			<?php
			if (isset($_SESSION['customers-input-error'])) {
				$msg = $_SESSION['customers-input-error'];
				unset($_SESSION['customers-input-error']);
				?>
                <div class="alert alert-danger" role="alert">
					<?php echo $msg; ?>
                </div>
				<?php
			}
			if (isset($_SESSION['customers-input-success'])) {
				$msg = $_SESSION['customers-input-success'];
				unset($_SESSION['customers-input-success']);
				?>
                <div class="alert alert-success" role="alert">
					<?php echo $msg; ?>
                </div>
				<?php
			}
			?>
        </div>
    </div>

    <div class="container-fluid mt-3 mb-3">
        <form method="get" name="customers_input" class="form-horizontal">
            <div class="row mb-3">
                <div class="col-md-12 border shadow" id="helpbox">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-3">
                                <label for="f_pi" class="col-form-label">PIs</label>
                                <select name="f_pi[]" id="f_pi" multiple class="form-control">
									<?php
									foreach ($allpi as $pi) { ?>
                                        <option value="<?php echo $pi['pi_id']; ?>" <?php if (in_array($pi['pi_id'], $f_pi)) {
											echo 'selected';
										} ?> ><?php echo $pi['pi_title']; ?> (<?php echo $pi['pi_start']; ?> - <?php echo $pi['pi_end']; ?>)
                                        </option>
									<?php } ?>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="f_oe" class="col-form-label">Departemente</label>
                                <select name="f_oe[]" id="f_oe" multiple class="form-control">
									<?php
									foreach ($alldept as $dept) { ?>
                                        <option value="<?php echo $dept['oe_id']; ?>" <?php if (in_array($dept['oe_id'], $f_oe)) {
											echo 'selected';
										} ?>><?php echo $dept['oe_shortname']; ?></option>
									<?php } ?>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="f_status" class="col-form-label">Status</label>
                                <select name="f_status[]" id="f_status" multiple class="form-control">
									<?php
									foreach ($feature_statuses as $feature_status) {
										?>
                                        <option value="<?php echo $feature_status['id']; ?>" <?php if (in_array($feature_status['id'], $f_status)) {
											echo 'selected';
										} ?>><?php echo $feature_status['name']; ?></option>
									<?php } ?>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="f_topics" class="col-form-label">Topics</label>
                                <select name="f_topics[]" multiple class="form-control">
                                    <option value="">--bitte w<span>&#228;</span>hlen--</option>
									<?php
									foreach ($gettopics as $topic) {
										?>
                                        <option value="<?php echo $topic['id']; ?>" <?php if (in_array($topic['id'], $f_topics)) {
											echo 'selected';
										} ?>><?php echo $topic['name']; ?></option>
										<?php
									}
									?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary">Ansicht anpassen</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container-fluid mt-3 mb-3">
        <div class="row mb-3">
            <table class="table table-responsive c_input">
                <thead>
                <tr>
                    <th colspan="5">&nbsp;</th>
					<?php foreach ($f_pi as $pi_id) {
          $i++;
						$pi_info = $db->getProductIncrementById($pi_id);
						$col     = 7 + count($f_oe);
						?>

                        <th colspan="<?php echo $col; ?>" class="<?php
                        if($i % 2 == 0){echo "bg-odd border border-gray";}
                        else{echo "bg-even border border-gray";}
                        ?>">     
							<?php echo $pi_info['pi_title']; ?>
                            <div style="font-size:10px;font-weight: normal;"><?php echo $pi_info['pi_start']; ?> - <?php echo $pi_info['pi_end']; ?></div>
                        </th>
					<?php } ?>
                </tr>
                <tr>                                        
                    <th>Title</th>
                    <th>Notizen</th>
                    <th>Status</th>
                    <th>Topic</th>
                    <th>FG</th>
					<?php foreach ($f_pi as $pi_id) {
						?>
                        <th class="td-block-1">Res</th>
                        <th class="td-block-1">Kommentar</th>
						<?php
						foreach ($f_oe as $oe_id) {
							$oe_info = $db->getOeById($oe_id);
							?>
                            <th class="td-block-1"><?php echo $oe_info['oe_shortname']; ?></th>
						<?php } ?>
                        <th class="td-block-2">BV</th>
                        <th class="td-block-2">TC</th>
                        <th class="td-block-2">RROE</th>
                        <th class="td-block-2">JS</th>
                        <th class="td-block-2">WSJF</th>
					<?php } ?>
                </tr>
                </thead>
                <tbody>
				<?php foreach ($feature_list as $feature) { ?>
                    <tr data-f_id="<?php echo $feature['f_id']; ?>">
                        <td><a style="text-decoration:none" href="https://pm.mastaz.ch/feature-request.php?f_id=<?php echo $feature["f_id"];?>" target="_blank"><?php echo $feature["f_title"]; ?></td>
                        <td><textarea class="form-control f_note" style="width:150px;" name="f_note"><?php echo $feature['f_note']; ?></textarea></td>
                        <td><?php echo $allfeaturesstatuses[$feature['f_status_id']]; ?></td>
                        <td><?php echo $alltopics[$feature['f_topic_id']]; ?></td>
                        <td>StudAdm</td>
						<?php foreach ($f_pi as $pi_id) {
							$fp_rankingdata  = $db->getFPRankingInfo($feature['f_id'], $pi_id);
							$res_rankingdata = $db->getDrRanking($fp_rankingdata['fp_id'], 9);
							?>
                            <td class="td-block-1" style="background-color: <?php echo $color[$res_rankingdata['dr_rankingvalue']];?>">
                                <select class="form-control dr_rankingvalue" data-oe_id="9" data-fp_id="<?php echo $fp_rankingdata['fp_id']; ?>" name="dr_rankingvalue">
									<?php
									foreach ($op_values as $opt) {
										$selected = ($res_rankingdata['dr_rankingvalue'] == $opt ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $opt; ?>" <?php echo $selected; ?>><?php echo $opt; ?></option>
									<?php } ?>
                                </select>
                            </td>
                            <td class="td-block-1">
                                <textarea data-oe_id="9" data-fp_id="<?php echo $fp_rankingdata['fp_id']; ?>" class="form-control dr_notes" name="dr_notes" style="width:150px;"><?php echo $res_rankingdata['dr_notes']; ?></textarea>
                            </td>
							<?php
							foreach ($f_oe as $oe_id) {
								$oe_rankingdata = $db->getDrRanking($fp_rankingdata['fp_id'], $oe_id);
								?>
                                <td class="td-block-1" style="background-color: <?php echo $color[$oe_rankingdata['dr_rankingvalue']];?>">
                                    <select class="form-control dr_rankingvalue" data-oe_id="<?php echo $oe_id ?>" data-fp_id="<?php echo $fp_rankingdata['fp_id']; ?>" name="dr_rankingvalue">
										<?php
										foreach ($op_values as $opt) {
											$selected = ($oe_rankingdata['dr_rankingvalue'] == $opt ? 'selected="selected"' : ''); ?>
                                            <option value="<?php echo $opt; ?>" <?php echo $selected; ?>><?php echo $opt; ?></option>
										<?php } ?>
                                    </select>
                                </td>
							<?php } ?>
                            <td  class="td-block-2">
                                <select class="form-control fp_BV" data-fp_id="<?php echo $fp_rankingdata['fp_id']; ?>" name="fp_BV">
									<?php
									foreach ($opt_values as $opt) {
										$selected = ($fp_rankingdata['fp_BV'] == $opt ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $opt; ?>" <?php echo $selected; ?>><?php echo $opt; ?></option>
									<?php } ?>
                                </select>
                            </td>
                            <td  class="td-block-2">
                                <select class="form-control fp_TC" data-fp_id="<?php echo $fp_rankingdata['fp_id']; ?>" name="fp_TC">
									<?php
									foreach ($opt_values as $opt) {
										$selected = ($fp_rankingdata['fp_TC'] == $opt ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $opt; ?>" <?php echo $selected; ?>><?php echo $opt; ?></option>
									<?php } ?>
                                </select>
                            </td>
                            <td  class="td-block-2">
                                <select class="form-control fp_RROE" data-fp_id="<?php echo $fp_rankingdata['fp_id']; ?>" name="fp_RROE">
									<?php
									foreach ($opt_values as $opt) {
										$selected = ($fp_rankingdata['fp_RROE'] == $opt ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $opt; ?>" <?php echo $selected; ?>><?php echo $opt; ?></option>
									<?php } ?>
                                </select>
                            </td>
                            <td  class="td-block-2">
                                <select class="form-control fp_JS" data-fp_id="<?php echo $fp_rankingdata['fp_id']; ?>" name="fp_JS">
									<?php
									foreach ($opt_values as $opt) {
										$selected = ($fp_rankingdata['fp_JS'] == $opt ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $opt; ?>" <?php echo $selected; ?>><?php echo $opt; ?></option>
									<?php } ?>
                                </select>
                            </td>
                            <td  class="td-block-2">
                                <span class="form-control  fp_WSJF" data-fp_id="<?php echo $fp_rankingdata['fp_id']; ?>"><?php if ($fp_rankingdata['fp_JS'] == 0) {
										$wsjf = 0;
									} else {
										$wsjf = ($fp_rankingdata['fp_BV'] + $fp_rankingdata['fp_TC'] + $fp_rankingdata['fp_RROE']) / $fp_rankingdata['fp_JS'];
									}
									echo round($wsjf, 3);
									?></span>
                            </td>
						<?php } ?>
                    </tr>
                    <tr id="demo" class="collapse">
                    <?php
                      if ($feature['f_desc']<>""){
                    ?>
                      <td  colspan="5">
                      <label>Beschreibung:</label>
                      <?php
                       echo '<div class="form-control divtextarea" style="width:100%;height:100%" >'.nl2br($feature['f_desc']).'</div>';
                       ?>
                      </td>     
                    <?php                                          
                      }
                    ?>                                      
                    </tr>
				<?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


