<?php
$actual_pi_date = date('d.m.Y', strtotime($actual_product_increment['pi_start'])) . " - " . date('d.m.Y', strtotime($actual_product_increment['pi_end']));

$can_edit_roadmap = $_SESSION['login_user_data']['can_edit_roadmap'];
$selected_epic            = ($_GET && $_GET['epic']) ? $_GET['epic'] : '';
?>

<div class="modal fade" id="feature" role="dialog" tabindex='-1'>
    <div class="modal-dialog modal-lg">
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
                        <select name="print_option" class="print_option form-control">
                            <option value="" selected="selected">Drucken</option>
                            <option value="title">Titel-Karte</option>
                            <option value="detail">Detail-Karte</option>
                            <option value="title_nemonic">Titel-Karte (Nemonic)</option>
                            <option value="feature_antrag">Feature-Antrag</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="feature_form" value="Submit" class="btn btn-primary">Save</button>
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
                <th scope="col">Funnel</th>
                <th scope="col">Aktuelles PI - <?php echo $actual_product_increment['pi_title']; ?></th>
				<?php
				$i = 0;
				foreach ($product_increments as $product_increment) { ?>
                    <th scope="col" class="<?php if ($i > 2) {
						echo 'd-none';
					} ?>"><?php echo $product_increment['pi_title']; ?></th>
					<?php
					$i++;
				}
				?>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                </td>
                <td><?php echo $actual_pi_date; ?></td>
				<?php
				$i = 0;
				foreach ($product_increments as $product_increment) {
					if ($i > 2) {
						$class = 'd-none';
					} else {
						$class = '';
					}
					$pi_date = date('d.m.Y', strtotime($product_increment['pi_start'])) . " - " . date('d.m.Y', strtotime($product_increment['pi_end']));
					echo "<td class='$class'>$pi_date</td>";
					$i++;
				} ?>
            </tr>
			<?php
			foreach ($epics as $epic) {
			 
				?>
                <tr class="feature-information <?php echo $eclass;?>" data-epic_id="<?php echo $epic['e_id']; ?>">
                    <!-- Funnel features start -->
                    <td>
                        <div class="product-increment" id="pisortable_0">
                            <h4 class="epic_title"><?php echo $epic['e_title']; ?></h4>
							<?php
							$pi_id    = 0;
							$features = $db->getFeaturesByEpicAndPI($epic['e_id'], $pi_id, $selected_team);
							
							if (isset($features) && !empty($features)) {
								foreach ($features as $feature) {
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
                                                        <?php if ($can_edit_roadmap == 1) { ?>
                                                            <span class="manage_feature" data-feature_id="<?php echo $feature['f_id']; ?>" data-pi_id="<?php echo $pi_id; ?>" title="Edit Feature"><i class="fa fa-pencil"></i></span>
                                                            <span class="delete_feature" data-feature_id="<?php echo $feature['f_id']; ?>" title="Delete Feature"><i class="fa fa-trash"></i></span>
                                                        <?php }else {?>
                                                            <span class="manage_feature" data-feature_id="<?php echo $feature['f_id']; ?>" data-pi_id="<?php echo $pi_id; ?>" title="View Feature"><i class="fa fa-sticky-note"></i></span>
                                                                                                      
                                                        <?php }?>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
										<?php if ($feature['f_desc']) { ?>
                                            <div class="card-body height0">
												<?php echo substr($feature['f_desc'], 0, 100) . '...'; ?>
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
                                                WSJF: <?php echo number_format($wsjf, 3); ?> |
                                                SP: <?php echo $feature['f_storypoints']; ?>
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
                        <div class="product-increment" id="_<?php echo $actual_product_increment['pi_id']; ?>">
							
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
                                                        <?php if ($can_edit_roadmap == 1) { ?>
                                                            <span class="manage_feature" data-feature_id="<?php echo $feature['f_id']; ?>" data-pi_id="<?php echo $pi_id; ?>" title="Edit Feature"><i class="fa fa-pencil"></i></span>
                                                            <span class="delete_feature" data-feature_id="<?php echo $feature['f_id']; ?>" title="Delete Feature"><i class="fa fa-trash"></i></span>
                                                        <?php }else {?>
                                                            <span class="manage_feature" data-feature_id="<?php echo $feature['f_id']; ?>" data-pi_id="<?php echo $pi_id; ?>" title="View Feature"><i class="fa fa-sticky-note"></i></span>                                                        
                                                        <?php }?>
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
										<?php if ($feature['f_desc']) { ?>
                                            <div class="card-body height0">
												<?php echo substr($feature['f_desc'], 0, 100) . '...'; ?>
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
                                                WSJF: <?php echo number_format($wsjf, 3); ?> |
                                                SP: <?php echo $feature['f_storypoints']; ?>
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
						echo "<td class='$class'><div class='product-increment' id='_" . $pi_id . "'>";
						
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
                                                        <?php if ($can_edit_roadmap == 1) { ?>
                                                            <span class="manage_feature" data-feature_id="<?php echo $feature['f_id']; ?>" data-pi_id="<?php echo $pi_id; ?>" title="Edit Feature"><i class="fa fa-pencil"></i></span>
                                                            <span class="delete_feature" data-feature_id="<?php echo $feature['f_id']; ?>" title="Delete Feature"><i class="fa fa-trash"></i></span>
                                                        <?php }else {?>
                                                            <span class="manage_feature" data-feature_id="<?php echo $feature['f_id']; ?>" data-pi_id="<?php echo $pi_id; ?>" title="View Feature"><i class="fa fa-sticky-note"></i></span>                                                        
                                                        <?php }?>
                                                        </div>
                                            </div>
                                        </div>
                                    </div>
									<?php if ($feature['f_desc']) { ?>
                                        <div class="card-body height0">
											<?php echo substr($feature['f_desc'], 0, 100) . '...'; ?>
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
                                            WSJF: <?php echo number_format($wsjf, 3); ?> |
                                            SP: <?php echo $feature['f_storypoints']; ?>
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
        <button type="button" id="show_all" class="btn btn-primary">H&ouml;he minimieren</button>
        <button type="button" id="expand" class="btn btn-primary">Kurzbeschreibung anzeigen</button>
    </div>
</div>