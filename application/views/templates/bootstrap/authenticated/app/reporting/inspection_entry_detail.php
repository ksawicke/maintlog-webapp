<?php
$inspectionCollection = [];

$collectionCounter = 0;
foreach($inspectionEntry['checklist_items'] as $clc => $cli) {
	$inspectionCollection[$collectionCounter]['item'] = $cli['item'];

	foreach($inspectionEntry['ratings'] as $ic => $rating) {
		if($rating['item']==$cli['item']) {
			$inspectionCollection[$collectionCounter]['rating_image'] = '<img src="' . $assetDirectory . 'img/icons8-' . (($rating['rating']==1) ? "ok" : "cancel") . '@2x.png" width="25">';

			$inspectionCollection[$collectionCounter]['note'] = $rating['note'];

			if(array_key_exists('images', $rating)) {
				foreach ($rating['images'] as $rictr => $image) {
					$image_location = base_url('assets/' . $image);

					list($width, $height) = getimagesize($image_location);
					if ($width > $height) {
						// Landscape
						$image_url = '<a href="' . base_url('assets/' . $image) . '" target="_new" ><img src="' . $image_location . '" width="350"></a>';

						$inspectionCollection[$collectionCounter]['inspection_images'][] =
							$image_url;
					} else {
						// Portrait or Square
						$image_url = '<a href="' . base_url('assets/' . $image) . '" target="_new" ><img src="' . $image_location . '" height="350"></a>';

						$inspectionCollection[$collectionCounter]['inspection_images'][] =
							$image_url;
					}
				}
			}
		}
	}

	$collectionCounter++;
}
?>

<h3>Inspection Entry Detail</h3>


<label>Inspection UUID</label>
<ul>
	<li><?php echo $inspectionEntry['inspection_uuid']; ?></li>
</ul>

<label>Date Entered</label>
<ul>
	<li><?php echo date('m/d/Y', strtotime($inspectionEntry['created'])); ?></li>
</ul>

<label>Time of Inspection</label>
<ul>
	<li><?php echo date('h:i A', strtotime($inspectionEntry['created'])); ?></li>
</ul>

<label>Inspected By</label>
<ul>
	<li><?php echo $inspectionEntry['created_by_last_name'] . ", " . $inspectionEntry['created_by_first_name']; ?></li>
</ul>

<label>Unit Number</label>
<ul>
	<li><?php echo $inspectionEntry['unit_number']; ?></li>
</ul>

<label>Manufacturer Name</label>
<ul>
	<li><?php echo $inspectionEntry['manufacturer_name']; ?></li>
</ul>

<label>Model Number</label>
<ul>
	<li><?php echo $inspectionEntry['model_number']; ?></li>
</ul>

<label>Equipment Type</label>
<ul>
	<li><?php echo $inspectionEntry['equipment_type']; ?></li>
</ul>

<label>SMR/Mileage</label>
<ul>
	<li><?php echo $inspectionEntry['last_smr']; ?></li>
</ul>

<label>Good Items</label>
<ul>
	<li>

		<img src="<?php echo $assetDirectory; ?>img/icons8-ok@2x.png" width="25"> <?php echo $inspectionEntry['ratingCount'][0]['count_good']; ?>

	</li>
</ul>

<label>Bad Items</label>
<ul>
	<li>

		<img src="<?php echo $assetDirectory; ?>img/icons8-cancel@2x.png" width=25"> <?php echo $inspectionEntry['ratingCount'][0]['count_bad']; ?>

	</li>
</ul>

<label>Ratings</label>
<table class="table table-bordered table-striped">
	<thead>
		<th align="center">Item</th>
		<th align="center">Rating</th>
		<th align="center">Note</th>
		<th align="center">Image</th>
	</thead>
	<tbody>

	<?php foreach($inspectionCollection as $clc => $cli) { ?>
		<tr>
			<td align="center">

				<?php echo $cli['item']; ?>

			</td>
			<td align="center">

				<?php if(array_key_exists('rating_image', $cli)) { ?>

					<?php echo $cli['rating_image']; ?>

				<?php } ?>

			</td>
			<td align="center">

				<?php if(array_key_exists('note', $cli)) { ?>

					<?php echo $cli['note']; ?>

				<?php } ?>

			</td>
			<td align="center">

				<?php if(array_key_exists('inspection_images', $cli)) { ?>

					<?php foreach($cli['inspection_images'] as $ii => $image) { ?>

						<?php echo $image; ?>

					<?php } ?>

				<?php } ?>

			</td>
		</tr>
	<?php } ?>

	</tbody>
	<tfoot>
		<th align="center">Item</th>
		<th align="center">Rating</th>
		<th align="center">Note</th>
		<th align="center">Image</th>
	</tfoot>
</table>
