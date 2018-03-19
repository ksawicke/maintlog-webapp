<div class="form-section subflow pss show-prev show-next">
	<label for="pss_pm_type" class="control-label lb-lg">PM Type</label>
	<select id="pss_pm_type"
			name="pss_pm_type"
			class="form-control input-lg"
			data-parsley-required="true"
			data-parsley-error-message="Please select the PM type"
			data-parsley-errors-container=".pss_pm_type_errors">
		<option value="">Select one:</option>
		<option value="smr_based">SMR based</option>
		<option value="mileage_based">Mileage based</option>
		<option value="time_based">Time based</option>
	</select>
	<p class="form-error pss_pm_type_errors"></p>
</div>

<div class="form-section subflow pss show-prev show-next">
	<label for="pss_smr_based_pm_level" class="control-label lb-lg pss_smr_based">PM Level</label><img id="loading_pss_smr_based_pm_level" src="<?php echo base_url(); ?>assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
	<select id="pss_smr_based_pm_level"
			name="pss_smr_based_pm_level"
			class="form-control input-lg pss_smr_based">
	</select>
	<p class="form-error pss_smr_based_pm_level_errors"></p>

	<label for="pss_smr_based_previous_smr" class="control-label lb-lg">Previous SMR</label>
	<input
		id="pss_smr_based_previous_smr"
		name="pss_smr_based_previous_smr"
		type="text"
		class="form-control input-lg"
		disabled>

	<label for="pss_smr_based_current_smr" class="control-label lb-lg pss_smr_based">Current SMR</label>
	<input
		id="pss_smr_based_current_smr"
		name="pss_smr_based_current_smr"
		type="text"
		class="form-control input-lg pss_smr_based"
		value="">
	<p class="form-error pss_smr_based_current_smr_errors"></p>

	<label for="pss_smr_based_notes1" class="control-label lb-lg pss_smr_based_notes1">Notes</label>
	<textarea type="text"
			  id="pss_smr_based_notes1"
			  name="pss_smr_based_notes1"
			  class="form-control input-lg pss_smr_based_notes1"
			  value=""></textarea>

	<label for="pss_smr_based_notes2" class="control-label lb-lg pss_smr_based_notes2 hide_me">Notes</label>
	<textarea type="text"
			  id="pss_smr_based_notes2"
			  name="pss_smr_based_notes2"
			  class="form-control input-lg pss_smr_based pss_smr_based_notes2 hide_me"
			  value=""></textarea>

	<label for="pss_smr_based_notes3" class="control-label lb-lg pss_smr_based_notes3 hide_me">Notes</label>
	<textarea type="text"
			  id="pss_smr_based_notes3"
			  name="pss_smr_based_notes3"
			  class="form-control input-lg pss_smr_based pss_smr_based_notes3 hide_me"
			  value=""></textarea>

	<button class="btn btn-success showPssSmrBasedNote" type="button" data-show-smr-based-note="2"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Note</button>

	<button class="btn btn-success showPssSmrBasedNote hideButton" type="button" data-show-smr-based-note="3"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Note</button>
</div>

<div class="form-section subflow pss show-prev show-next">
	SERVICE REMINDER<br /><br />
	<label for="pss_reminder_pm_type" class="control-label lb-lg">PM Type</label>
	<select id="pss_reminder_pm_type"
			name="pss_reminder_pm_type"
			class="form-control input-lg"
			data-parsley-required="true"
			data-parsley-error-message="Please select the PM Type"
			data-parsley-errors-container=".pss_reminder_pm_type_errors">
		<option value="">Select one:</option>
		<option value="smr_based">SMR Based</option>
		<option value="mileage_based">Mileage Based</option>
		<option value="time_based">Time Based</option>
	</select>
	<p class="form-error pss_reminder_pm_type_errors"></p>

	<label for="pss_reminder_pm_level" class="control-label lb-lg">PM Level</label><img id="loading_pss_reminder_pm_level" src="<?php echo base_url(); ?>assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
	<select id="pss_reminder_pm_level"
			name="pss_reminder_pm_level"
			class="form-control input-lg"
			data-parsley-required="true"
			data-parsley-error-message="Please select the PM Level"
			data-parsley-errors-container=".pss_reminder_pm_type_errors">
		<option value="">Select one:</option>
	</select>
	<p class="form-error pss_reminder_pm_type_errors"></p>

	<label for="pss_due_units" class="control-label lb-lg">Due</label>
	<input type="text" class="form-control input-lg" id="pss_due_units" name="pss_due_units" value="">
</div>

<div class="form-section subflow pss show-prev show-next">
	<label for="pss_notes" class="control-label lb-lg">Notes</label>
	<textarea type="text"
			  class="form-control input-lg"
			  id="pss_notes"
			  name="pss_notes"
			  value=""
			  data-parsley-required="true"
			  data-parsley-error-message="Please enter some notes"
			  data-parsley-errors-container=".pss_notes_errors"></textarea>
	<p class="form-error pss_notes_errors"></p>
</div>

<div class="form-section subflow pss show-prev show-review">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<label for="pss_reminder_recipients" class="control-label lb-lg">REMINDER RECIPIENTS</label><img id="loading_pss_reminder_recipients" src="<?php echo base_url(); ?>assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
			<select id="pss_reminder_recipients"
					name="pss_reminder_recipients"
					class="form-control input-lg"
					multiple
					readonly>
			</select>
			<p class="form-error pss_reminder_recipients_errors"></p>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<label for="pss_responsible_reminder_recipients" class="control-label lb-lg">PERSON RESPONSIBLE REMINDER RECIPIENTS</label><img id="loading_pss_responsible_reminder_recipients" src="<?php echo base_url(); ?>assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
			<select id="pss_responsible_reminder_recipients"
					name="pss_responsible_reminder_recipients"
					class="form-control input-lg"
					multiple
					readonly>
			</select>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<label for="pss_additional_reminder_recipients" class="control-label lb-lg">ADDITIONAL REMINDER RECIPIENTS</label><img id="loading_pss_additional_reminder_recipients" src="<?php echo base_url(); ?>assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
			<select id="pss_additional_reminder_recipients"
					name="pss_additional_reminder_recipients"
					class="form-control input-lg"
					multiple>
			</select>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<label for="pss_reminder_quantity" class="control-label lb-lg">ALERT WINDOW BEFORE DUE</label>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-3">
			<input type="text"
				   id="pss_reminder_quantity"
				   name="pss_reminder_quantity"
				   class="form-control input-lg"
				   data-parsley-required="true"
				   data-parsley-error-message="Please enter a quantity"
				   data-parsley-errors-container=".pss_reminder_quantity_errors">
			<p class="form-error pss_reminder_quantity_errors"></p>
		</div>

		<div class="col-lg-9 col-md-9 col-sm-9">
			<select id="pss_reminder_units"
					name="pss_reminder_units"
					class="form-control input-lg"
					data-parsley-required="true"
					data-parsley-error-message="Please select one"
					data-parsley-errors-container=".pss_reminder_units_errors">
				<option value="" selected>Select one:</option>
				<option value="smr">SMR</option>
				<option value="miles">Miles</option>
				<option value="days">Days</option>
			</select>
			<p class="form-error pss_reminder_units_errors"></p>
		</div>
	</div>
</div>
