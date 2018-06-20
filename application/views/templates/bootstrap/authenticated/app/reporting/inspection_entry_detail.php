<h3>Inspection Entry Detail</h3>


<label>Inspection UUID</label>
<ul>
	<li><?php echo $inspectionEntry['inspection_uuid']; ?></li>
</ul>

<label>Date Entered</label>
<ul>
	<li><?php echo date('m/d/Y', strtotime($inspectionEntry['created'])); ?></li>
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

	<?php foreach($inspectionEntry['ratings'] as $ic => $rating) { ?>
		<tr>
			<td align="center"><?php echo $rating['item']; ?></td>
			<td align="center"><img src="<?php echo $assetDirectory; ?>img/icons8-<?php echo (($rating['rating']==1) ? "ok" : "cancel"); ?>@2x.png" width="25"></td>
			<td align="center"><?php echo $rating['note']; ?></td>
			<td align="center">

				<?php if(array_key_exists('images', $rating)) {
					foreach($rating['images'] as $rictr => $image) { ?>
						<a href="<?php echo $assetDirectory . "/" . $image; ?>" target="_new">
							<img src="<?php echo $assetDirectory . "/" . $image; ?>" width="350">
						</a>
					<?php
					}
				}
				?>

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
