<?php echo $equipment_navigation; ?>

<a href="<?php echo base_url('index.php/app/addEquipmentmodel'); ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Equipment Model</button></a><br /><br />

<table id="equipmentmodelList" class="table table-bordered table-striped display nowrap">
    <thead>
        <tr>
            <th>Manufacturer</th>
            <th>Model No.</th>
            <th>Equipment Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($equipmentmodel as $e) { ?>
        <tr>
            <td><?php echo $e['manufacturer_name']; ?></td>
            <td><?php echo $e['model_number']; ?></td>
            <td><?php echo $e['equipment_type']; ?></td>
            <td><a href="<?php echo base_url('index.php/app/addEquipmentmodel/' . $e['id']); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button>&nbsp;<a href="<?php echo base_url('index.php/equipmentmodel/delete/' . $e['id']); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
  $(document).ready(function() {
    $('#equipmentmodelList').DataTable({
        "responsive": true,
        "columns": [
            null,
            null,
            null,
            {"width": "80px", "orderable": false}
        ]
    });
  });
</script>