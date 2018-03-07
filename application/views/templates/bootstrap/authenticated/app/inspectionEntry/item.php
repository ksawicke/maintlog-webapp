<?php
$data = [
	'preStart' => [
		0 => ['id' => 3, 'item' => 'Suspension'],
		1 => ['id' => 15, 'item' => 'Tires'],
		2 => ['id' => 8, 'item' => 'Horn/Alarm/Lights'],
		3 => ['id' => 16, 'item' => 'Leak Evidence'],
		4 => ['id' => 17, 'item' => 'Seat Belt']
	]
];

foreach($data['preStart'] as $key => $preStartData) {
	$adjustedName = str_replace('/', '_', $preStartData['item']);
	$adjustedName = str_replace(' ', '_', $adjustedName);
	$adjustedName = strtolower($adjustedName);
?>

<div class="form-section show-prev show-next">
	<label for="<?php echo $adjustedName; ?>" class="control-label lb-lg"><?php echo $preStartData['item']; ?></label>
	<div>

		<div class="inspection-button button_good <?php echo $adjustedName; ?> item-notmarked text-center pa4 white" data-item="<?php echo $adjustedName; ?>" data-inspection-status="good">
			<svg aria-hidden="true" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg"
				 viewBox="0 0 512 512" class="svg-inline--fa fa-check fa-w-16 fa-5x">
				<path fill="currentColor"
					  d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"
					  class=""></path>
			</svg>
		</div>

		<br />

		<div class="inspection-button button_bad <?php echo $adjustedName; ?> item-notmarked text-center pa4 white" data-item="<?php echo $adjustedName; ?>" data-inspection-status="bad">
			<svg aria-hidden="true" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg"
				 viewBox="0 0 384 512" class="svg-inline--fa fa-times fa-w-12 fa-5x">
				<path fill="currentColor"
					  d="M323.1 441l53.9-53.9c9.4-9.4 9.4-24.5 0-33.9L279.8 256l97.2-97.2c9.4-9.4 9.4-24.5 0-33.9L323.1 71c-9.4-9.4-24.5-9.4-33.9 0L192 168.2 94.8 71c-9.4-9.4-24.5-9.4-33.9 0L7 124.9c-9.4 9.4-9.4 24.5 0 33.9l97.2 97.2L7 353.2c-9.4 9.4-9.4 24.5 0 33.9L60.9 441c9.4 9.4 24.5 9.4 33.9 0l97.2-97.2 97.2 97.2c9.3 9.3 24.5 9.3 33.9 0z"
					  class=""></path>
			</svg>
		</div>

		<label for="<?php echo $adjustedName; ?>_problem_note" class="control-label lb-lg">Notes</label>
		<textarea type="text"
				  id="<?php echo $adjustedName; ?>_problem_note"
				  name="<?php echo $adjustedName; ?>_problem_note"
				  class="form-control input-lg"
				  value=""></textarea>
	</div>
</div>

<?php } ?>
