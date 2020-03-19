<div class="form-group row mt-3">
	<div class="from-group col-md-12">
  Defintion, was im Footer bei den Karten auf den Roadmaps angezeigt werden soll:
	</div>
</div>


<div class="form-group row mt-3">
	<div class="from-group col-md-6">
		<label for="cardfooter_duedate" class="col-md-9 col-form-label" style="text-align: right;">Gew. Fertigstellungsdatum: <?php if ($helptexts['f_due_date']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_due_date'] . "'></i>";
			} ?> </label>
		<div class="float-right col-md-3">
			<input type="checkbox" name="cardfooter_duedate" id="cardfooter_duedate" <?php if($show_cardfooter['cardfooter_duedate'] == 1 ){ echo 'checked'; } ?>  data-toggle="toggle" data-onstyle="success" data-on="Yes" data-off="No" >
		</div>
	</div>
	<div class="from-group col-md-6">
		<label for="cardfooter_wsjf" class="col-md-9 col-form-label" style="text-align: right;">WSJF: <?php if ($helptexts['f_WSJF']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_WSJF'] . "'></i>";
			} ?> </label>
		<div class="float-right col-md-3">
			<input type="checkbox" name="cardfooter_wsjf" id="cardfooter_wsjf" <?php if($show_cardfooter['cardfooter_wsjf'] == 1 ){ echo 'checked'; } ?> data-toggle="toggle" data-onstyle="success" data-on="Yes" data-off="No" >
		</div>
	</div>
</div>
<div class="form-group row">
	<div class="from-group col-md-6">
		<label for="cardfooter_sp" class="col-md-9 col-form-label" style="text-align: right;">Storypoint: <?php if ($helptexts['f_storypoints']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_storypoints'] . "'></i>";
			} ?> </label>
		<div class="float-right col-md-3">
			<input type="checkbox" name="cardfooter_sp" id="cardfooter_sp" data-onstyle="success" <?php if($show_cardfooter['cardfooter_sp'] == 1 ){ echo 'checked'; } ?> data-toggle="toggle" data-on="Yes" data-off="No" >
		</div>
	</div>
	<div class="from-group col-md-6">
		<label for="cardfooter_attachments" class="col-md-9 col-form-label" style="text-align: right;">Anh&auml;nge: <?php if ($helptexts['f_attachments']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['cardfooter_attachments'] . "'></i>";
			} ?> </label>
		<div class="float-right col-md-3">
			<input type="checkbox" name="cardfooter_attachments" id="cardfooter_attachments" data-onstyle="success" <?php if($show_cardfooter['cardfooter_attachments'] == 1 ){ echo 'checked'; } ?> data-toggle="toggle" data-on="Yes" data-off="No" >
		</div>
	</div>
</div>

<div class="form-group row">
	<div class="from-group col-md-6">
		<label for="cardfooter_sme" class="col-md-9 col-form-label" style="text-align: right;">Ansprechsperson (Fach)(SME): <?php if ($helptexts['f_SME']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_SME'] . "'></i>";
			} ?> </label>
		<div class="float-right col-md-3">
			<input type="checkbox" name="cardfooter_sme" id="cardfooter_sme" data-onstyle="success" <?php if($show_cardfooter['cardfooter_sme'] == 1 ){ echo 'checked'; } ?> data-toggle="toggle" data-on="Yes" data-off="No" >
		</div>
	</div>
	<div class="from-group col-md-6">
		<label for="cardfooter_comments" class="col-md-9 col-form-label" style="text-align: right;">Kommentare: <?php if ($helptexts['f_comments']) {
				echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['f_comments'] . "'></i>";
			} ?> </label>
		<div class="float-right col-md-3">
			<input type="checkbox" name="cardfooter_comments" id="cardfooter_comments" data-onstyle="success" <?php if($show_cardfooter['f_comments'] == 1 ){ echo 'checked'; } ?> data-toggle="toggle" data-on="Yes" data-off="No" >
		</div>
	</div>
</div>
