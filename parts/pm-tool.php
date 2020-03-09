<?php
$actual_pi_date           = date('d.m.Y', strtotime($actual_product_increment['pi_start']))." - ".date('d.m.Y', strtotime($actual_product_increment['pi_end']));
$actual_pi_total_capacity = $db->getTotalCapacityByTopicPI($selected_topic, $actual_product_increment['pi_id']);
$topic         = $db->getTopicById($selected_topic);

$can_edit_roadmap = $_SESSION['login_user_data']['can_edit_roadmap'];

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
					<span class="manage_feature btn btn-primary btn-sm" data-feature_id="0" data-topic_id="<?php echo $selected_topic; ?>" data-pi_id="0" title="Add Feature"><i class="fa fa-plus"></i></span>
				</td>
				<td><?php echo $actual_pi_date; ?></td>
				<?php
				$i = 0;
				foreach ($product_increments as $product_increment) {
					$class = '';
					if ($i > 2) {
						$class = 'd-none';
					}
					$pi_date = date('d.m.Y', strtotime($product_increment['pi_start']))." - ".date('d.m.Y', strtotime($product_increment['pi_end']));
					echo "<td class='$class'>$pi_date</td>";
					$i++;
				} ?>
			</tr>

			<tr class="feature-information">
				<!-- Funnel features start -->
				<td>
					<div class=" product-increment" id="pi_sortable_0">
						<?php
						$pi_id    = 0;
						$features = $db->getFeaturesByTopicAndPI($selected_topic, $pi_id);


						if (isset($features) && !empty($features)) {
							foreach ($features as $feature) {
								if ($feature['f_JS'] == 0) {
									$wsjf = 0;
								} else {
									$wsjf = ($feature['f_BV'] + $feature['f_TC'] + $feature['f_RROE']) / $feature['f_JS'];
								}
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
											<?php echo substr($feature['f_desc'], 0, 100).'...'; ?>
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
					<div class=" product-increment" id="pi_sortable_<?php echo $actual_product_increment['pi_id']; ?>">

						<?php
						$pi_id           = $actual_product_increment['pi_id'];
						$features        = $db->getFeaturesByTopicAndPI($selected_topic, $pi_id);
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
											<?php echo substr($feature['f_desc'], 0, 100).'...'; ?>
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
				$i = 0;


				$sp_totals = array();
				foreach ($product_increments as $product_increment) {
					if ($i > 2) {
						$class = 'd-none';
					} else {
						$class = '';
					}
					$pi_id = $product_increment['pi_id'];
					echo "<td class='$class'><div class=' product-increment' id='pi_sortable_".$pi_id."'>";

					$sp_totals[$pi_id] = 0;
					$features          = $db->getFeaturesByTopicAndPI($selected_topic, $pi_id);
					$sp_total          = 0;
					if (isset($features) && !empty($features)) {
						foreach ($features as $feature) {
							if ($feature['f_JS'] == 0) {
								$wsjf = 0;
							} else {
								$wsjf = ($feature['f_BV'] + $feature['f_TC'] + $feature['f_RROE']) / $feature['f_JS'];
							}
							$sp_total += $feature['f_storypoints'];
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
										<?php echo substr($feature['f_desc'], 0, 100).'...'; ?>
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
				<!-- Other PI features end -->
			</tr>

			<!-- Total capacity row start -->
			<tr class="total-capacity-row">
				<td>Total Kapazit&auml;t [<a href="javascript:void(0);">Detailanzeige</a>]
                    <?php
                    if($topic['capacity_source']){ ?>
						<a target="_blank" href="<?php echo $topic['capacity_source'];?>"><i class="fa fa-link" aria-hidden="true"></i></a>
                    <?php
                    }
                    
                    ?>
                
                </td>
				<td><span class="pi_total_capacity"><?php echo $actual_pi_total_capacity; ?></span></td>
				<?php
				$i = 0;
				foreach ($product_increments as $product_increment) {
					$total_capacity = $db->getTotalCapacityByTopicPI($selected_topic, $product_increment['pi_id']);
					?>
					<td class="<?php if ($i > 2) {
						echo 'd-none';
					} ?>">
						<span class="pi_total_capacity"><?php echo $total_capacity; ?></span>
					</td>
					<?php
					$i++;
				}
				?>
			</tr>
			<!-- Total capacity row end -->

			<!-- Staff member capacity row start -->
			<?php
			foreach ($staff_members as $staff_member) {
				$capacity_input_name = "capacity_".$staff_member['staff_id']."_".$actual_product_increment['pi_id'];
				$pi_capacity         = $db->getStaffCapacityByPI($staff_member['staff_id'], $actual_product_increment['pi_id']);
				?>
				<tr class="capacity-row">
					<td><?php echo($staff_member['staff_firstname']." ".$staff_member['staff_lastname']); ?></td>
					<td><input type="number" name="<?php echo $capacity_input_name; ?>"
					           value="<?php echo $pi_capacity['capacity']; ?>" class="form-control capacity_input"></td>
					<?php
					$i = 0;

					foreach ($product_increments as $product_increment) {
						$capacity_input_name = "capacity_".$staff_member['staff_id']."_".$product_increment['pi_id'];
						$pi_capacity         = $db->getStaffCapacityByPI($staff_member['staff_id'], $product_increment['pi_id']);
						if (!isset($pi_capacity_totals[$product_increment['pi_id']])) {
							$pi_capacity_totals[$product_increment['pi_id']] = 0;
						}
						$pi_capacity_totals[$product_increment['pi_id']] = $pi_capacity_totals[$product_increment['pi_id']] + $pi_capacity['capacity'];
						?>
						<td class="<?php if ($i > 2) {
							echo 'd-none';
						} ?>"><input type="number" name="<?php echo $capacity_input_name; ?>"
						             value="<?php echo $pi_capacity['capacity']; ?>" class="form-control capacity_input">
						</td>

						<?php
						$i++;
					} ?>
				</tr>
				<?php
			}
			?>
			<!-- Staff member capacity row end -->

			<!-- Total sp row start -->
			<tr class="total-sp-row">
				<td>Total eingeplant</td>
				<?php
				if ($actual_pi_total_capacity <= $actual_sp_total) {
					$color = 'text-danger';
				} else {
					$color = 'text-success';
				}
				?>
				<td><span class="pi_total_sp <?php echo $color; ?>"><?php echo $actual_sp_total; ?></span></td>
				<?php
				$i = 0;
				foreach ($product_increments as $product_increment) {
					$total_capacity = $db->getTotalCapacityByTopicPI($selected_topic, $product_increment['pi_id']);

					if ($total_capacity <= $sp_totals[$product_increment['pi_id']]) {
						$color = 'text-danger';
					} else {
						$color = 'text-success';
					}
					?>
					<td class="<?php if ($i > 2) {
						echo 'd-none';
					} ?>">
						<span class="pi_total_sp <?php echo $color; ?>"><?php echo $sp_totals[$product_increment['pi_id']]; ?></span>
					</td>
					<?php
					$i++;
				}
				?>
			</tr>
			<!-- Total sp row end -->

			</tbody>
		</table>
		<button type="button" id="show_all" class="btn btn-primary">H&ouml;he minimieren</button>
		<button type="button" id="expand" class="btn btn-primary">Kurzbeschreibung anzeigen</button>
	</div>
</div>