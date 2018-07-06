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

<div class="form-section subflow ccs show-prev show-next">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<label for="ccs_previous_smr" class="control-label lb-lg">Previous SMR</label>
			<input
				id="ccs_previous_smr"
				name="ccs_previous_smr"
				type="text"
				class="form-control input-lg"
				disabled>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<label for="ccs_units" class="control-label lb-lg"></label>
			<input
				id="ccs_units"
				name="ccs_units"
				type="text"
				class="form-control input-lg"
				value=""
				data-parsley-type="number"
				data-parsley-required="true"
				data-parsley-gt="0"
				data-parsley-lt="9999999"
				data-parsley-required-message="Please enter the current SMR or Miles"
				data-parsley-gt-message="Please enter a quantity greater than 0"
				data-parsley-lt-message="Please enter a quantity less than 9,999,999"
				data-parsley-errors-container=".flu_units_errors">
			<p class="form-error ccs_units_errors"></p>
		</div>
	</div>
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
