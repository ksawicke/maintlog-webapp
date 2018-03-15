<?php

$ctr = 3;

foreach($inspectionItems as $key => $inspectionItem) {
	$sectionLabel = '';

	if($inspectionItem['sectionName']=='pre-start') {
		$sectionLabel = 'Pre-Start Inspection Items';
	}

	if($inspectionItem['sectionName']=='post-start') {
		$sectionLabel = 'Post-Start Inspection Items';
	}
	?>

	<div class="form-section show-prev show-<?php echo (($ctr==(2+count($inspectionItems)))? 'review' : 'next'); ?>" data-section-index="<?php echo $ctr; ?>" data-section-name="<?php echo $inspectionItem['sectionName']; ?>" data-section-item="<?php echo $inspectionItem['itemNameAdjusted']; ?>" data-section-populate-field="<?php echo $inspectionItem['itemFieldName']; ?>">
		<h3><?php echo $sectionLabel; ?></h3>

		<label for="<?php echo $inspectionItem['itemNameAdjusted']; ?>" class="control-label lb-lg"><?php echo $inspectionItem['item']; ?></label>
		<div>

			<div class="inspection-button button-good <?php echo $inspectionItem['itemNameAdjusted']; ?> item-notmarked text-center pa4 white" data-item="<?php echo $inspectionItem['itemNameAdjusted']; ?>" data-inspection-status="good">
				<svg aria-hidden="true" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg"
					 viewBox="0 0 512 512" class="svg-inline--fa fa-check fa-w-16 fa-5x">
					<path fill="currentColor"
						  d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"
						  class=""></path>
				</svg>
			</div>

			<br />

			<div class="inspection-button button-bad <?php echo $inspectionItem['itemNameAdjusted']; ?> item-notmarked text-center pa4 white" data-item="<?php echo $inspectionItem['itemNameAdjusted']; ?>" data-inspection-status="bad" data-inspection-item="<?php echo $inspectionItem['itemNameAdjusted']; ?>">
				<svg aria-hidden="true" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg"
					 viewBox="0 0 384 512" class="svg-inline--fa fa-times fa-w-12 fa-5x">
					<path fill="currentColor"
						  d="M323.1 441l53.9-53.9c9.4-9.4 9.4-24.5 0-33.9L279.8 256l97.2-97.2c9.4-9.4 9.4-24.5 0-33.9L323.1 71c-9.4-9.4-24.5-9.4-33.9 0L192 168.2 94.8 71c-9.4-9.4-24.5-9.4-33.9 0L7 124.9c-9.4 9.4-9.4 24.5 0 33.9l97.2 97.2L7 353.2c-9.4 9.4-9.4 24.5 0 33.9L60.9 441c9.4 9.4 24.5 9.4 33.9 0l97.2-97.2 97.2 97.2c9.3 9.3 24.5 9.3 33.9 0z"
						  class=""></path>
				</svg>
			</div>

			<input type="hidden"
				   id="<?php echo $inspectionItem['itemFieldName']; ?>"
				   name="<?php echo $inspectionItem['itemFieldName']; ?>">

			<label for="<?php echo $inspectionItem['itemFieldName']; ?>[note]" class="control-label lb-lg hidden" style="display:none;">Notes</label>
			<textarea type="text"
					  id="<?php echo $inspectionItem['itemFieldName']; ?>[note]"
					  name="<?php echo $inspectionItem['itemFieldName']; ?>[note]"
					  class="form-control input-lg"
					  style="display:none;"></textarea>
		</div>
	</div>

<?php
	$ctr++;
}
