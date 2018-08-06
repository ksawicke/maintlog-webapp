<div class="form-section subflow sus show-prev show-next">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<label for="sus_previous_smr" class="control-label lb-lg">Previous SMR</label>
			<input
				id="sus_previous_smr"
				name="sus_previous_smr"
				type="text"
				class="form-control input-lg"
				disabled>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<label for="sus_current_smr" class="control-label lb-lg">Current SMR</label>
			<input
				id="sus_current_smr"
				name="sus_current_smr"
				type="text"
				class="form-control input-lg"
				value=""
				data-parsley-type="number"
				data-parsley-required="true"
				data-parsley-gt="0"
				data-parsley-lt="9999999"
				data-parsley-required-message="Please enter the current SMR"
				data-parsley-gt-message="Please enter a quantity greater than 0"
				data-parsley-lt-message="Please enter a quantity less than 9,999,999"
				data-parsley-errors-container=".sus_current_smr_errors">
			<p class="form-error sus_current_smr_errors"></p>
		</div>
	</div>
</div>

<div class="form-section subflow sus show-prev show-review">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<label for="sus_notes" class="control-label lb-lg">Notes</label>
			<textarea type="text"
					  id="sus_notes"
					  name="sus_notes"
					  class="form-control input-lg"
					  value=""></textarea>
		</div>
	</div>
</div>
