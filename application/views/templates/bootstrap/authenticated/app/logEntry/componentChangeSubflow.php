<div class="form-section subflow ccs show-prev show-next">
	<label for="ccs_component_type" class="control-label lb-lg">Component Type</label><img id="loading_ccs_component_type" src="<?php echo base_url(); ?>assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
	<select id="ccs_component_type"
			name="ccs_component_type"
			class="form-control input-lg"
			data-parsley-required="true"
			data-parsley-error-message="Please select a Component Type"
			data-parsley-errors-container=".ccs_component_type_errors">
	</select>
	<p class="form-error ccs_component_type_errors"></p>
</div>

<div class="form-section subflow ccs show-prev show-next">
	<label for="ccs_component" class="control-label lb-lg">Component</label><img id="loading_ccs_component" src="<?php echo base_url(); ?>assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
	<select id="ccs_component"
			name="ccs_component"
			class="form-control input-lg"
			data-parsley-required="true"
			data-parsley-error-message="Please select a Component"
			data-parsley-errors-container=".ccs_component_errors">
	</select>
	<p class="form-error ccs_component_errors"></p>

	<label for="ccs_component_data" class="control-label lb-lg">Component Data</label><img id="loading_ccs_component_data" src="<?php echo base_url(); ?>assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
	<input
		id="ccs_component_data"
		name="ccs_component_data"
		type="text"
		class="form-control input-lg"
		value=""
		data-parsley-required="true"
		data-parsley-error-message="Please enter the Component Data for the Component selected"
		data-parsley-errors-container=".ccs_component_data_errors">
	<p class="form-error ccs_component_data_errors"></p>
</div>

<div class="form-section subflow ccs show-prev show-review">
	<label for="ccs_notes" class="control-label lb-lg">Notes</label>
	<textarea type="text"
			  class="form-control input-lg"
			  id="ccs_notes"
			  name="ccs_notes"
			  value=""
			  data-parsley-required="true"
			  data-parsley-error-message="Please enter some notes"
			  data-parsley-errors-container=".ccs_notes_errors"></textarea>
	<p class="form-error ccs_notes_errors"></p>
</div>
