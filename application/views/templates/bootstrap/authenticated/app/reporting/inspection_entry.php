<h3>Inspection Entry</h3>

<a id="downloadInspectionEntry"
   href="<?php echo base_url('index.php/reporting/output/spreadsheet/inspection_entry'); ?>"
   class="buttonLink nounderline">

	<button type="button" class="btn btn-primary"><img
			class="excelIconMargin"
			src="<?php echo base_url('/assets/templates/komatsuna/img/excel_logo_24x24.png'); ?>">&nbsp;&nbsp;Download
		Report in Excel
	</button>

</a>

<br/><br/>

<table id="inspectionEntry" class="table table-bordered table-striped" width="100%">
	<thead>
	<tr>
		<th>Date Entered</th>
		<th>Time of Inspection</th>
		<th>Inspected By</th>
		<th>Unit Number</th>
		<th>Manufacturer Name</th>
		<th>Model Number</th>
		<th>Equipment Type</th>
		<th>SMR / Mileage</th>
		<th>Good Items</th>
		<th>Bad Items</th>
		<th>Images Taken</th>
		<th>Actions</th>
	</tr>
	</thead>
	<tfoot>
	<tr>
		<th>Date Entered</th>
		<th>Time of Inspection</th>
		<th>Inspected By</th>
		<th>Unit Number</th>
		<th>Manufacturer Name</th>
		<th>Model Number</th>
		<th>Equipment Type</th>
		<th>SMR / Mileage</th>
		<th>Good Items</th>
		<th>Bad Items</th>
		<th>Images Taken</th>
		<th>Actions</th>
	</tr>
	</tfoot>
	<tbody>

	<?php foreach ($inspectionEntry as $ctr => $inspection) { ?>
		<tr>
			<td><?php echo date('m/d/Y', strtotime($inspection['created'])); ?></td>
			<td><?php echo date('h:i A', strtotime($inspection['created'])); ?></td>
			<td><?php echo $inspection['created_by_last_name'] . ", " . $inspection['created_by_first_name']; ?></td>
			<td><?php echo $inspection['unit_number']; ?></td>
			<td><?php echo $inspection['manufacturer_name']; ?></td>
			<td><?php echo $inspection['model_number']; ?></td>
			<td><?php echo $inspection['equipment_type']; ?></td>
			<td><?php echo $inspection['last_smr']; ?></td>
			<td>
				<img src="<?php echo $assetDirectory; ?>img/icons8-ok@2x.png" width="25"> <?php echo $inspection['ratingCount'][0]['count_good']; ?>
			</td>
			<td>
				<img src="<?php echo $assetDirectory; ?>img/icons8-cancel@2x.png" width=25"> <?php echo $inspection['ratingCount'][0]['count_bad']; ?>
			</td>
			<td>
				<?php echo $inspection['imageCount']; ?>
			</td>
			<td>

				<a href="<?php echo base_url('index.php/reporting/output/screen/inspection_entry_detail/') . $inspection['inspection_uuid']; ?>">
					<button type="button" class="btn btn-sm btn-primary" title="View Detail"><i class="fas fa-eye"
																								style="color:#fff !important;"></i>
					</button>
				</a>

			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>

<pre>
<?php var_dump($inspectionEntry); ?>
</pre>

<script>
	$(document).ready(function () {
		$("#downloadInspectionEntry").on('click', function (e) {
			e.preventDefault();

			var fields = [],
				dataParams = {data: {}},
				href = $("#downloadInspectionEntry").attr("href"),
				selects = $('#inspectionEntry tfoot tr select');

			console.log(href);

			fields = ['created', 'unit_number', 'manufacturer_name', 'model_number', 'equipment_type'];

			$.map(fields, function (fieldName, i) {
				var key = fieldName;
				dataParams.data[key] = selects[i].value;
			});

			console.log(dataParams);

			loadSpreadsheet(href + "?" + $.param(dataParams));
		});

		function loadSpreadsheet(href) {
			window.open(href, '_blank');
		}

		function escapeRegExp(string) {
			return string.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
		}

		var dataTable = $('#inspectionEntry').DataTable({
			responsive: true,
			initComplete: function () {
				this.api().columns().every(function () {
					var column = this;
					var select = $('<select><option value=""></option></select>')
						.appendTo($(column.footer()).empty())
						.on('change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);

							column
								.search(val ? '^' + val + '$' : '', true, false)
								.draw();
						});

					if (column.index() >= 0 && column.index() <= 6 && column.index() != 1 &&
					    column.index() != 2) {
						column.data().unique().sort().each(function (d, j) {
							select.append('<option value="' + d + '">' + d + '</option>');
						});
					} else {
						select.hide();
					}

					// column.data().unique().sort().each(function (d, j) {
					// 	select.append('<option value="' + d + '">' + d + '</option>')
					// });
				});
			},
			"order": [],
			"columns": [
				{"orderable": false, "class": "text-center"},
				{"orderable": false, "class": "text-center"},
				{"orderable": false, "class": "text-center"},
				{"orderable": false, "class": "text-center"},
				{"orderable": false, "class": "text-center"},
				{"orderable": false, "class": "text-center"},
				{"orderable": false, "class": "text-center"},
				{"orderable": false, "class": "text-center"},
				{"orderable": false, "class": "text-center"},
				{"orderable": false, "class": "text-center"},
				{"orderable": false, "class": "text-center"},
				{"orderable": false, "class": "text-center"}
			]
		});
	});
</script>

<?php /***
<pre>
	<?php var_dump($inspectionEntry); ?>
</pre> ***/ ?>
