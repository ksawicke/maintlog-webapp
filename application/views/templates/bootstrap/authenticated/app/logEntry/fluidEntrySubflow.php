<div class="form-section subflow flu show-prev show-next">

	<?php for($fluidEntryCounter = 1; $fluidEntryCounter <= $maxFluidEntries; $fluidEntryCounter++) { ?>
		<div class="row fluidEntry<?php echo $fluidEntryCounter; ?>">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<label for="flu_fluid_type<?php echo "_" . $fluidEntryCounter; ?>" class="control-label lb-lg">Fluid Type</label>
				<select
					id="flu_fluid_type<?php echo "_" . $fluidEntryCounter; ?>"
					name="flu_fluid_type<?php echo "_" . $fluidEntryCounter; ?>"
					class="form-control input-lg"
					<?php if($fluidEntryCounter==1) { ?>data-parsley-required="true"<?php } ?>
					<?php if($fluidEntryCounter==1) { ?>data-parsley-error-message="Please select the fluid type"<?php } ?>
					<?php if($fluidEntryCounter==1) { ?>data-parsley-errors-container=".flu_fluid_type<?php echo "_" . $fluidEntryCounter; ?>_errors"<?php } ?>>
					<option value="">Select one:</option>
					<?php foreach($fluidtypes as $fluidtype) { ?>
						<option value="<?php echo $fluidtype->id; ?>"><?php echo $fluidtype->fluid_type; ?></option>
					<?php } ?>
				</select>
				<p class="form-error flu_fluid_type<?php echo "_" . $fluidEntryCounter; ?>_errors"></p>
			</div>
		</div>

		<div class="row fluidEntry<?php echo $fluidEntryCounter; ?>">
			<div class="col-lg-1 col-md-1 col-sm-1">
				&nbsp;
			</div>

			<div class="col-lg-2 col-md-2 col-sm-2">
				<label for="flu_quantity<?php echo "_" . $fluidEntryCounter; ?>" class="control-label lb-lg">Quantity</label>
				<input
					id="flu_quantity<?php echo "_" . $fluidEntryCounter; ?>"
					name="flu_quantity<?php echo "_" . $fluidEntryCounter; ?>"
					type="text"
					class="form-control input-lg"
					<?php if($fluidEntryCounter==1) { ?>data-parsley-type="number"
					data-parsley-required="true"
					data-parsley-gt="0"
					data-parsley-lt="10000"
					data-parsley-required-message="Please choose the quantity of fuel used"
					data-parsley-gt-message="Please enter a quantity greater than 0"
					data-parsley-lt-message="Please enter a quantity less than 10000.0"<?php } ?>
					data-parsley-errors-container=".flu_quantity<?php echo "_" . $fluidEntryCounter; ?>_errors">
				<?php echo '<p class="form-error flu_quantity' . $fluidEntryCounter . '_errors"></p>'; ?>
			</div>

			<div class="col-lg-9 col-md-9 col-sm-9">
				<label for="flu_units<?php echo "_" . $fluidEntryCounter; ?>" class="control-label lb-lg">&nbsp;</label>
				<select
					id="flu_units<?php echo "_" . $fluidEntryCounter; ?>"
					name="flu_units<?php echo "_" . $fluidEntryCounter; ?>"
					class="form-control input-lg"
					<?php if($fluidEntryCounter==1) { ?>data-parsley-required="true"
					data-parsley-error-message="Please choose the units of fuel used"<?php } ?>
					data-parsley-errors-container=".flu_units<?php echo "_" . $fluidEntryCounter; ?>_errors">
					<!--option value="" selected>Select one:</option-->
					<option value="gal">Gallons (gal)</option>
					<!--option value="L">Liters (L)</option-->
				</select>
				<?php echo '<p class="form-error flu_units_' . $fluidEntryCounter . '_errors"></p>'; ?>
			</div>
		</div>

	<?php } ?>

	<?php for($fluidEntryCounter = 2; $fluidEntryCounter <= $maxFluidEntries; $fluidEntryCounter++) { ?>
		<button class="btn btn-success showFluidEntry<?php echo ($fluidEntryCounter===2 ? '' : ' hideButton'); ?>" type="button" data-show-fluid-entry="<?php echo $fluidEntryCounter; ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><i class="fas fa-plus-square" style="color:#fff !important;"></i> Add Fluid</button>
	<?php } ?>

</div>

<div class="form-section subflow flu show-prev show-next">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<label for="flu_previous_smr" class="control-label lb-lg">Previous SMR</label>
			<input
				id="flu_previous_smr"
				name="flu_previous_smr"
				type="text"
				class="form-control input-lg"
				disabled>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<label for="flu_units" class="control-label lb-lg"></label>
			<input
				id="flu_units"
				name="flu_units"
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
			<p class="form-error flu_units_errors"></p>
		</div>
	</div>
</div>

<div class="form-section subflow flu show-prev show-review">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<label for="flu_notes" class="control-label lb-lg">Notes</label>
			<textarea type="text"
					  id="flu_notes"
					  name="flu_notes"
					  class="form-control input-lg"
					  value=""></textarea>
		</div>
	</div>
</div>
