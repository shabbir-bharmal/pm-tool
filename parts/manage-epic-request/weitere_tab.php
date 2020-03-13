</br>
<div class="form-group row">
    <label for="e_in_scope" class="col-3 col-xs-12 col-form-label">In Scope: <?php if ($helptexts['e_in_scope']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_in_scope'] . "'></i>";
		} ?> </label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_in_scope" id="e_in_scope"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_in_scope']); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="e_out_of_scope" class="col-3 col-xs-12 col-form-label">Out of Scope: <?php if ($helptexts['e_out_of_scope']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_out_of_scope'] . "'></i>";
		} ?> </label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_out_of_scope" id="e_out_of_scope"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_out_of_scope']); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="e_mvp_features" class="col-3 col-xs-12 col-form-label">Minimum Viable Product (MVP) Features: <?php if ($helptexts['e_mvp_features']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_mvp_features'] . "'></i>";
		} ?> </label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_mvp_features" id="e_mvp_features"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_mvp_features']); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="e_additional_potential_features" class="col-3 col-xs-12 col-form-label">Additional Potential Features: <?php if ($helptexts['e_additional_potential_features']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_additional_potential_features'] . "'></i>";
		} ?> </label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_additional_potential_features" id="e_additional_potential_features"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_additional_potential_features']); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="e_sponsors" class="col-3 col-xs-12 col-form-label">Sponsors: <?php if ($helptexts['e_sponsors']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_sponsors'] . "'></i>";
		} ?> </label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_sponsors" id="e_sponsors"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_sponsors']); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="e_users_markets_affected" class="col-3 col-xs-12 col-form-label">Users and Markets Affected: <?php if ($helptexts['e_users_markets_affected']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_users_markets_affected'] . "'></i>";
		} ?> </label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_users_markets_affected" id="e_users_markets_affected"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_users_markets_affected']); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="e_impact_products_programs_services" class="col-3 col-xs-12 col-form-label">Impact on Products, Programs and Services: <?php if ($helptexts['e_impact_products_programs_services']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_impact_products_programs_services'] . "'></i>";
		} ?> </label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_impact_products_programs_services" id="e_impact_products_programs_services"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_impact_products_programs_services']); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="e_impact_sales_distribution_deployment" class="col-3 col-xs-12 col-form-label">Impact on Sales, Distribution, Deployment: <?php if ($helptexts['e_impact_sales_distribution_deployment']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_impact_sales_distribution_deployment'] . "'></i>";
		} ?> </label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_impact_sales_distribution_deployment" id="e_impact_sales_distribution_deployment"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_impact_sales_distribution_deployment']); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="e_analysis_summary" class="col-3 col-xs-12 col-form-label">Analysis Summary: <?php if ($helptexts['e_analysis_summary']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_analysis_summary'] . "'></i>";
		} ?> </label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_analysis_summary" id="e_analysis_summary"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_analysis_summary']); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="e_is_go" class="col-3 col-xs-12 col-form-label">Go / No-Go: <?php if ($helptexts['e_is_go']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_is_go'] . "'></i>";
		} ?> </label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_is_go" id="e_is_go"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_is_go']); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="e_estimated_story_points" class="col-3 col-xs-12 col-form-label">Estimated Story Points (MVP): <?php if ($helptexts['e_estimated_story_points']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_estimated_story_points'] . "'></i>";
		} ?> </label>

    <div class="col-2 col-xs-12">
        <input type="number" name="e_estimated_story_points" class="form-control" id="e_estimated_story_points" value="<?php echo(!$e_id ? "" : $epic_info['e_estimated_story_points']); ?>" <?php echo $disabled; ?>>
    </div>
</div>
<div class="form-group row">
    <label for="e_estimated_monetary_cost" class="col-3 col-xs-12 col-form-label">Estimated Monetary Cost (MVP): <?php if ($helptexts['e_estimated_monetary_cost']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_estimated_monetary_cost'] . "'></i>";
		} ?> </label>
    <div class="col-2 col-xs-12">
        <input type="number" name="e_estimated_monetary_cost" class="form-control" id="e_estimated_monetary_cost" value="<?php echo(!$e_id ? "" : $epic_info['e_estimated_monetary_cost']); ?>" <?php echo $disabled; ?>>
    </div>
</div>
<div class="form-group row">
    <label for="e_type_of_return" class="col-3 col-xs-12 col-form-label">Type of Return: <?php if ($helptexts['e_type_of_return']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_type_of_return'] . "'></i>";
		} ?> </label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_type_of_return" id="e_type_of_return"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_type_of_return']); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="e_anticipated_business_impact" class="col-3 col-xs-12 col-form-label">Anticipated Business impact: <?php if ($helptexts['e_anticipated_business_impact']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_anticipated_business_impact'] . "'></i>";
		} ?> </label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_anticipated_business_impact" id="e_anticipated_business_impact"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_anticipated_business_impact']); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="e_development_type" class="col-3 col-xs-12 col-form-label">In-house or Outsourced Development: <?php if ($helptexts['e_development_type']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_development_type'] . "'></i>";
		} ?> </label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_development_type" id="e_development_type"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_development_type']); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="e_start_date" class="col-3 col-xs-12 col-form-label">Start Date: <?php if ($helptexts['e_start_date']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_start_date'] . "'></i>";
		} ?> </label>

    <div class="col-2 col-xs-12">
        <input type="text" name="e_start_date" id="e_start_date" class="form-control valid" value="<?php echo(!$e_id ? "" : $epic_info['e_start_date']); ?>" aria-invalid="false" <?php echo $disabled; ?>>
    </div>
</div>
<div class="form-group row">
    <label for="e_completion_date" class="col-3 col-xs-12 col-form-label">Completion date: <?php if ($helptexts['e_completion_date']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_completion_date'] . "'></i>";
		} ?> </label>

    <div class="col-2 col-xs-12">
        <input type="text" name="e_completion_date" id="e_completion_date" class="form-control valid" value="<?php echo(!$e_id ? "" : $epic_info['e_completion_date']); ?>" aria-invalid="false" <?php echo $disabled; ?>>
    </div>
</div>
<div class="form-group row">
    <label for="e_incremental_implementation_strategy" class="col-3 col-xs-12 col-form-label">Incremental Implementation Strategy: <?php if ($helptexts['e_incremental_implementation_strategy']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_incremental_implementation_strategy'] . "'></i>";
		} ?> </label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_incremental_implementation_strategy" id="e_incremental_implementation_strategy"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_incremental_implementation_strategy']); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="e_sequencing_dependencies" class="col-3 col-xs-12 col-form-label">Sequencing and Dependencies: <?php if ($helptexts['e_sequencing_dependencies']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_sequencing_dependencies'] . "'></i>";
		} ?> </label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_sequencing_dependencies" id="e_sequencing_dependencies"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_sequencing_dependencies']); ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="e_milestones" class="col-3 col-xs-12 col-form-label">Milestones or Checkpoints: <?php if ($helptexts['e_milestones']) {
			echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['e_milestones'] . "'></i>";
		} ?> </label>

    <div class="col-6 col-xs-12">
        <textarea class="form-control" name="e_milestones" id="e_milestones"  <?php echo $disabled; ?> ><?php echo(!$e_id ? "" : $epic_info['e_milestones']); ?></textarea>
    </div>
</div>