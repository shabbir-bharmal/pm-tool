<?php
$actual_pi_date = date('d.m.Y', strtotime($actual_product_increment['pi_start'])) . " - " . date('d.m.Y', strtotime($actual_product_increment['pi_end']));
$can_edit_roadmap = $_SESSION['login_user_data']['can_edit_roadmap'];
if ($can_edit_roadmap == 1) {
	$disabled = "";
} else {
	$disabled = "disabled='true'";
}

$selected_epic    = ($_GET && $_GET['epic']) ? $_GET['epic'] : '';
$show_cardfooter_duedate     = $show_cardfooter['cardfooter_duedate'];
$show_cardfooter_wsjf        = $show_cardfooter['cardfooter_wsjf'];
$show_cardfooter_sp          = $show_cardfooter['cardfooter_sp'];
$show_cardfooter_attachments = $show_cardfooter['cardfooter_attachments'];
$show_cardfooter_sme         = $show_cardfooter['cardfooter_sme'];
$show_cardfooter_comments    = $show_cardfooter['cardfooter_comments'];

?>
<div class="modal fade bd-print-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <form name="print_pi_features" id="print_pi_features" method="post" action="<?php echo W_ROOT; ?>/form-action.php">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <input type="hidden" name="action" value="print-pi-features">
                    <input type="hidden" name="features" id="features">

                    <select name="print_option" class="print_option form-control">
                        <option value="" selected="selected">Drucken</option>
                        <option value="title">Titel-Karte</option>
                        <!--<option value="detail">Detail-Karte</option>
                        <option value="title_nemonic">Titel-Karte (Nemonic)</option>
                        <option value="feature_antrag">Feature-Antrag</option>-->
                    </select>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="print_pi_features" value="Submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="feature" role="dialog" tabindex='-1'>
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Feature</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?php echo W_ROOT; ?>/form-action.php" id="feature_form" name="feature_form" enctype='multipart/form-data'>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <div class="form-group col-md-4 mr-auto p-0">
                        <select name="print_option" class="print_option form-control" <?php echo $disabled; ?>>
                            <option value="" selected="selected">Drucken</option>
                            <option value="title">Titel-Karte</option>
                            <option value="detail">Detail-Karte</option>
                            <option value="title_nemonic">Titel-Karte (Nemonic)</option>
                            <option value="feature_antrag">Feature-Antrag</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="feature_submit" form="feature_form" value="Submit" class="btn btn-primary" <?php echo $disabled; ?>>Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="responsive roadmap-planning">
        <table class="table table-bordered">

            <thead>
            <tr>
                <th scope="col">Funnel
                    <div class="print_pi float-right"><i class="fa fa-print" aria-hidden="true" data-pi="0" title="under construction"></i></div>
                    <div style='font-size:10px;font-weight: normal;'>&nbsp;</div>
                </th>
                <th scope="col">Aktuelles PI - <?php echo $actual_product_increment['pi_title']; ?>
                    <div class="print_pi float-right"><i class="fa fa-print" aria-hidden="true" data-pi="<?php echo $actual_product_increment['pi_id']; ?>" title="under construction"></i></div>
                    <div style='font-size:10px;font-weight: normal;'><?php echo $actual_pi_date; ?></div>
                </th>
				<?php
				$i = 0;
				foreach ($product_increments as $product_increment) { ?>
					<?php
					$sp_totals[$product_increment['pi_id']] = 0;
					$class                                  = '';
					if ($i > 2) {
						$class = 'd-none';
					}
					$pi_date = date('d.m.Y', strtotime($product_increment['pi_start'])) . " - " . date('d.m.Y', strtotime($product_increment['pi_end']));
					?>
                    <th scope="col" class="<?php if ($i > 2) {
						echo 'd-none';
					} ?>"><?php echo $product_increment['pi_title']; ?>
                        <div class="print_pi float-right"><i class="fa fa-print" aria-hidden="true" data-pi="<?php echo $product_increment['pi_id']; ?>" title="under construction"></i></div>
                        <div style='font-size:10px;font-weight: normal;'><?php echo $pi_date; ?></div>
                    </th>
					<?php
					$i++;
				}
				?>
            </tr>
            </thead>
            <tbody>
			<?php
			foreach ($epics as $epic) {
				
				?>
                <tr class="feature-information <?php echo $eclass; ?>" data-epic_id="<?php echo $epic['e_id']; ?>">
                    <!-- Funnel features start -->
                    <td>
                        <div class="product-increment pi_sortable_0" id="pisortable_0">
                            <h4 class="epic_title"><?php echo $epic['e_title']; ?></h4>
							<?php
							$pi_id    = 0;
							$features = $db->getFeaturesByEpicAndPI($epic['e_id'], $pi_id, $selected_team);
							if (isset($features) && !empty($features)) {
								foreach ($features as $feature) {
									$feature_info = $db->getFeatureByFeatureId($feature['f_id']);
									if ($feature['f_JS'] == 0) {
										$wsjf = 0;
									} else {
										$wsjf = ($feature['f_BV'] + $feature['f_TC'] + $feature['f_RROE']) / $feature['f_JS'];
									}
									?>
                                    <div class="card" id="<?php echo $feature['f_id']; ?>" data-sp="<?php echo $feature['f_storypoints']; ?>">
                                        <div class="card-header" style=" background: <?php echo $feature['highlight_color']; ?>;">
                                            <div class="row">
                                                <div class="col-8"><?php echo $feature['f_title']; ?></div>
                                                <div class="col-4">
                                                    <div class="float-right">
														<?php if($can_edit_roadmap == 1 || $feature['f_SME'] == $login_id || in_array($feature['f_topic_id'], $topic_permission)){ ?>
                                                            <span class="manage_feature" data-feature_id="<?php echo $feature['f_id']; ?>" data-pi_id="<?php echo $pi_id; ?>" title="Edit Feature"><i class="fa fa-pencil"></i></span>
														<?php } else {?>
                                                            <span class="manage_feature" data-feature_id="<?php echo $feature['f_id']; ?>" data-pi_id="<?php echo $pi_id; ?>" title="View Feature"><i class="fa fa-sticky-note"></i></span>
														<?php }
														if ($can_edit_roadmap == 1) { ?>
                                                            <span class="delete_feature" data-feature_id="<?php echo $feature['f_id']; ?>" title="Delete Feature"><i class="fa fa-trash"></i></span>
														<?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<?php if ($feature['f_desc']) { ?>
                                            <div class="card-body height0">
												<?php
												if (strlen($feature['f_desc']) > 250) {
													echo substr($feature['f_desc'], 0, 250) . '[...]';
												} else {
													echo $feature['f_desc'];
												}
												?>
                                            </div>
										<?php } ?>

                                        <div class="card-footer">
                                            <div class="text-right">
												<?php if ($feature['f_status_id'] == '3') { ?>
                                                    <span style="color: green;" class="float-left mr-2"><i class="fa fa-check-circle"></i></span>
												<?php } ?>
												<?php if ($feature['f_mehr_details']) { ?>
                                                    <a class="float-left" target="_blank" href="<?php echo $feature['f_mehr_details']; ?>"><i class="fa fa-link" aria-hidden="true"></i></a>
												<?php } ?>
												
												<?php
												$cardfooter = "";
												
												if ($show_cardfooter_comments == 1) {
													//if ($feature_info['f_SME']>0){
													$cardfooter .= '<i class="fa fa-comments" title="Kommentare (under construction)"></i> ;-) | ';
													//}
												}
												if ($show_cardfooter_sme == 1) {
													if ($feature_info['f_SME'] > 0) {
														$sme[0]     = $db->getStaffById($feature_info['f_SME']);
														$cardfooter .= '<i class="fa fa-user" title="Ansprechsperson (Fach)"></i> ' . $sme[0]['username'] . ' | ';
													}
												}
												if ($show_cardfooter_attachments == 1) {
													$feature_files = $db->getFeatureFilesByFeatureId($feature['f_id']);
													
													if (count($feature_files) > 0) {
														$cardfooter .= '<i class="fa fa-paperclip" title="Dateien vorhanden"></i> ' . count($feature_files) . '  | ';
													}
												}
												if ($show_cardfooter_duedate == 1) {
													if ($feature_info['f_due_date']) {
														$cardfooter .= '<i class="fa fa-bell" title="gew&uuml;nschtes Fertigstellungsdatum"></i> ' . $feature_info['f_due_date'] . ' | ';
													}
												}
												if ($show_cardfooter_wsjf == 1) {
													if ($wsjf > 0) {
														$cardfooter .= '<i class="fa fa-calculator" title="WSJF"></i> ' . number_format($wsjf, 3) . " | ";
													}
													
												}
												if ($show_cardfooter_sp == 1) {
													if ($feature['f_storypoints'] > -0.1) {
														$cardfooter .= '<i class="fa fa-tachometer" title="Storypoints"></i> ' . $feature['f_storypoints'] . " | ";
													}
												}
												echo '<font style="font-size:10px;">' . substr($cardfooter, 0, -3) . "</font>";
												?>

                                            </div>
                                        </div>
                                    </div>
									
									
									<?php
								}
							}
							?>
                        </div>
                    </td>
                    <!-- Funnel features end -->

                    <!-- Actual PI features start -->
                    <td>
                        <div class="product-increment pi_sortable_<?php echo $actual_product_increment['pi_id']; ?>" id="_<?php echo $actual_product_increment['pi_id']; ?>">
							
							<?php
							$pi_id    = $actual_product_increment['pi_id'];
							$features = $db->getFeaturesByEpicAndPI($epic['e_id'], $pi_id, $selected_team);
							
							$actual_sp_total = 0;
							if (isset($features) && !empty($features)) {
								foreach ($features as $feature) {
									if ($feature['f_JS'] == 0) {
										$wsjf = 0;
									} else {
										$wsjf = ($feature['f_BV'] + $feature['f_TC'] + $feature['f_RROE']) / $feature['f_JS'];
									}
									$actual_sp_total += $feature['f_storypoints'];
									
									?>
                                    <div class="card" id="<?php echo $feature['f_id']; ?>" data-sp="<?php echo $feature['f_storypoints']; ?>">
                                        <div class="card-header" style=" background: <?php echo $feature['highlight_color'] ?>;">
                                            <div class="row">
                                                <div class="col-8"><?php echo $feature['f_title']; ?></div>
                                                <div class="col-4">

                                                    <div class="float-right">
														<?php if($can_edit_roadmap == 1 || $feature['f_SME'] == $login_id || in_array($feature['f_topic_id'], $topic_permission)){ ?>
                                                            <span class="manage_feature" data-feature_id="<?php echo $feature['f_id']; ?>" data-pi_id="<?php echo $pi_id; ?>" title="Edit Feature"><i class="fa fa-pencil"></i></span>
														<?php } else {?>
                                                            <span class="manage_feature" data-feature_id="<?php echo $feature['f_id']; ?>" data-pi_id="<?php echo $pi_id; ?>" title="View Feature"><i class="fa fa-sticky-note"></i></span>
														<?php }
														if ($can_edit_roadmap == 1) { ?>
                                                            <span class="delete_feature" data-feature_id="<?php echo $feature['f_id']; ?>" title="Delete Feature"><i class="fa fa-trash"></i></span>
														<?php } ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
										<?php if ($feature['f_desc']) { ?>
                                            <div class="card-body height0">
												<?php
												if (strlen($feature['f_desc']) > 250) {
													echo substr($feature['f_desc'], 0, 250) . '[...]';
												} else {
													echo $feature['f_desc'];
												}
												?>
                                            </div>
										<?php } ?>
                                        <div class="card-footer">
                                            <div class="text-right">
												<?php if ($feature['f_status_id'] == '3') { ?>
                                                    <span style="color: green;" class="float-left mr-2"><i class="fa fa-check-circle"></i></span>
												<?php } ?>
												<?php if ($feature['f_mehr_details']) { ?>
                                                    <a class="float-left" target="_blank" href="<?php echo $feature['f_mehr_details']; ?>"><i class="fa fa-link" aria-hidden="true"></i></a>
												<?php } ?>
												<?php
												$cardfooter = "";
												
												if ($show_cardfooter_comments == 1) {
													//if ($feature_info['f_SME']>0){
													$cardfooter .= '<i class="fa fa-comments" title="Kommentare (under construction)"></i> ;-) | ';
													//}
												}
												if ($show_cardfooter_sme == 1) {
													if ($feature_info['f_SME'] > 0) {
														$sme[0]     = $db->getStaffById($feature_info['f_SME']);
														$cardfooter .= '<i class="fa fa-user" title="Ansprechsperson (Fach)"></i> ' . $sme[0]['username'] . ' | ';
													}
												}
												if ($show_cardfooter_attachments == 1) {
													$feature_files = $db->getFeatureFilesByFeatureId($feature['f_id']);
													
													if (count($feature_files) > 0) {
														$cardfooter .= '<i class="fa fa-paperclip" title="Dateien vorhanden"></i> ' . count($feature_files) . '  | ';
													}
												}
												if ($show_cardfooter_duedate == 1) {
													if ($feature_info['f_due_date']) {
														$cardfooter .= '<i class="fa fa-bell" title="gew&uuml;nschtes Fertigstellungsdatum"></i> ' . $feature_info['f_due_date'] . ' | ';
													}
												}
												if ($show_cardfooter_wsjf == 1) {
													if ($wsjf > 0) {
														$cardfooter .= '<i class="fa fa-calculator" title="WSJF"></i> ' . number_format($wsjf, 3) . " | ";
													}
													
												}
												if ($show_cardfooter_sp == 1) {
													if ($feature['f_storypoints'] > -0.1) {
														$cardfooter .= '<i class="fa fa-tachometer" title="Storypoints"></i> ' . $feature['f_storypoints'] . " | ";
													}
												}
												echo '<font style="font-size:10px;">' . substr($cardfooter, 0, -3) . "</font>";
												?>
                                            </div>
                                        </div>
                                    </div>
									<?php
								}
							}
							?>
                        </div>
                    </td>
                    <!-- Actual PI features end -->

                    <!-- Other PI features start -->
					<?php
					$i         = 0;
					$sp_totals = array();
					foreach ($product_increments as $product_increment) {
						if ($i > 2) {
							$class = 'd-none';
						} else {
							$class = '';
						}
						$pi_id = $product_increment['pi_id'];
						echo "<td class='$class'><div class='product-increment pi_sortable_" . $pi_id . "' id='_" . $pi_id . "'>";
						
						$sp_totals[$pi_id] = 0;
						$features          = '';
						$features          = $db->getFeaturesByEpicAndPI($epic['e_id'], $pi_id, $selected_team);
						
						$sp_total = 0;
						if (isset($features) && !empty($features)) {
							foreach ($features as $feature) {
								if ($feature['f_JS'] == 0) {
									$wsjf = 0;
								} else {
									$wsjf = ($feature['f_BV'] + $feature['f_TC'] + $feature['f_RROE']) / $feature['f_JS'];
								}
								$sp_total          += $feature['f_storypoints'];
								$sp_totals[$pi_id] = $sp_total;
								
								?>
                                <div class="card" id="<?php echo $feature['f_id']; ?>" data-sp="<?php echo $feature['f_storypoints']; ?>">
                                    <div class="card-header" style=" background: <?php echo $feature['highlight_color'] ?>; ">
                                        <div class="row">
                                            <div class="col-8"><?php echo $feature['f_title']; ?></div>
                                            <div class="col-4">
                                                <div class="float-right">
													<?php if($can_edit_roadmap == 1 || $feature['f_SME'] == $login_id || in_array($feature['f_topic_id'], $topic_permission)){ ?>
                                                        <span class="manage_feature" data-feature_id="<?php echo $feature['f_id']; ?>" data-pi_id="<?php echo $pi_id; ?>" title="Edit Feature"><i class="fa fa-pencil"></i></span>
													<?php } else {?>
                                                        <span class="manage_feature" data-feature_id="<?php echo $feature['f_id']; ?>" data-pi_id="<?php echo $pi_id; ?>" title="View Feature"><i class="fa fa-sticky-note"></i></span>
													<?php }
													if ($can_edit_roadmap == 1) { ?>
                                                        <span class="delete_feature" data-feature_id="<?php echo $feature['f_id']; ?>" title="Delete Feature"><i class="fa fa-trash"></i></span>
													<?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<?php if ($feature['f_desc']) { ?>
                                        <div class="card-body height0">
											<?php
											if (strlen($feature['f_desc']) > 250) {
												echo substr($feature['f_desc'], 0, 250) . '[...]';
											} else {
												echo $feature['f_desc'];
											}
											?>
                                        </div>
									<?php } ?>
                                    <div class="card-footer">
                                        <div class="text-right">
											<?php if ($feature['f_status_id'] == '3') { ?>
                                                <span style="color: green;" class="float-left mr-2"><i class="fa fa-check-circle"></i></span>
											<?php } ?>
											<?php if ($feature['f_mehr_details']) { ?>
                                                <a class="float-left" target="_blank" href="<?php echo $feature['f_mehr_details']; ?>"><i class="fa fa-link" aria-hidden="true"></i></a>
											<?php } ?>
											<?php
											$cardfooter = "";
											
											if ($show_cardfooter_comments == 1) {
												//if ($feature_info['f_SME']>0){
												$cardfooter .= '<i class="fa fa-comments" title="Kommentare (under construction)"></i> ;-) | ';
												//}
											}
											if ($show_cardfooter_sme == 1) {
												if ($feature_info['f_SME'] > 0) {
													$sme[0]     = $db->getStaffById($feature_info['f_SME']);
													$cardfooter .= '<i class="fa fa-user" title="Ansprechsperson (Fach)"></i> ' . $sme[0]['username'] . ' | ';
												}
											}
											if ($show_cardfooter_attachments == 1) {
												$feature_files = $db->getFeatureFilesByFeatureId($feature['f_id']);
												
												if (count($feature_files) > 0) {
													$cardfooter .= '<i class="fa fa-paperclip" title="Dateien vorhanden"></i> ' . count($feature_files) . '  | ';
												}
											}
											if ($show_cardfooter_duedate == 1) {
												if ($feature_info['f_due_date']) {
													$cardfooter .= '<i class="fa fa-bell" title="gew&uuml;nschtes Fertigstellungsdatum"></i> ' . $feature_info['f_due_date'] . ' | ';
												}
											}
											if ($show_cardfooter_wsjf == 1) {
												if ($wsjf > 0) {
													$cardfooter .= '<i class="fa fa-calculator" title="WSJF"></i> ' . number_format($wsjf, 3) . " | ";
												}
												
											}
											if ($show_cardfooter_sp == 1) {
												if ($feature['f_storypoints'] > -0.1) {
													$cardfooter .= '<i class="fa fa-tachometer" title="Storypoints"></i> ' . $feature['f_storypoints'] . " | ";
												}
											}
											echo '<font style="font-size:10px;">' . substr($cardfooter, 0, -3) . "</font>";
											?>
                                        </div>
                                    </div>
                                </div>
								<?php
							}
						}
						echo "</div></td>";
						$i++;
					} ?>

                </tr>
			<?php } ?>
            </tbody>
        </table>
    </div>
</div>