<a href="<?php echo base_url('app/addEquipment'); ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Equipment</button></a><br /><br />

<table id="equipmentList" class="table table-bordered table-striped display nowrap">
    <thead>
        <tr>
            <th>Unit No.</th>
            <th>Manufacturer</th>
            <th>Model No.</th>
            <th>Equipment Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($equipment as $e) { ?>
        <tr>
            <td><?php echo $e['unit_number']; ?></td>
            <td><?php echo $e['manufacturer_name']; ?></td>
            <td><?php echo $e['model_number']; ?></td>
            <td><?php echo $e['equipment_type']; ?></td>
            <td><a href="<?php echo base_url('app/addEquipment/' . $e['id']); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button>&nbsp;<a href="<?php echo base_url('equipment/delete/' . $e['id']); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
  $(document).ready(function() {
    $('#equipmentList').DataTable({
        "responsive": true,
        "columns": [
            null,
            null,
            null,
            null,
            {"width": "80px", "orderable": false}
        ]
    });
  });
</script>