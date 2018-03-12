<a href="<?php echo base_url('index.php/app/addEquipmentmodel'); ?>"><button type="button" class="btn btn-success"><i class="fas fa-plus-square" style="color:#fff !important;"></i>&nbsp;&nbsp;Add Equipment Model</button></a><br /><br />

<table id="equipmentmodelList" class="table table-bordered table-striped display">
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
            <td><a href="<?php echo base_url('index.php/app/addEquipmentmodel/' . $e['id']); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="far fa-edit" style="color:#fff !important;"></i></button></a>&nbsp;<a href="<?php echo base_url('index.php/equipmentmodel/delete/' . $e['id']); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fas fa-trash" style="color:#fff !important;"></i></button></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
  $(document).ready(function() {
    $('#equipmentmodelList').DataTable({
        responsive: true,
        "columns": [
            null,
            null,
            null,
            {"width": "100px", "orderable": false}
        ]
    });
  });
</script>
