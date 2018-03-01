<?php echo $appsetting_navigation; ?>

<a href="<?php echo base_url('index.php/app/addChecklist'); ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Checklist</button></a><br /><br />

<table id="checklistList" class="table table-bordered table-striped">
	<thead>
	<tr>
		<th>Equipment Type</th>
		<th>Actions</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($checklists as $id => $checklist) { ?>
		<tr>
			<td><?php echo $checklist['equipment_type']; ?></td>
			<td><a href="<?php echo base_url('index.php/app/addChecklist/' . $checklist['id']); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button></a>&nbsp;<a href="<?php echo base_url('index.php/checklists/delete/' . $checklist['id']); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td>
		</tr>
	<?php } ?>
	</tbody>
</table>

<script>
	$(document).ready(function() {
		$('#checklistList').DataTable({
			responsive: true,
			"columns": [
				null,
				{"width": "80px", "orderable": false}
			]
		});
	});
</script>
