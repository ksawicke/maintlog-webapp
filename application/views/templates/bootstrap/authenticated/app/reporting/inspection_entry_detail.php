<h3>Inspection Entry Detail</h3>


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
			<td align="center"></td>
			<td align="center"></td>
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

<label>Images Taken</label>
<ul>
	<li>

		<?php echo (count($inspectionEntry['images']>0) ? "YES" : "NO"); ?>

	</li>
</ul>
