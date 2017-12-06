<a href="<?php echo base_url('app/addEquipmentUnit'); ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Equipment Unit</button></a><br /><br />

<table id="equipmentUnitList" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Manufacturer & Model</th>
            <th>Unit Number</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($equipmentunits as $equipmentunit) { ?>
        <tr>
            <td><?php echo $equipmentunit['manufacturer_name'] . " " . $equipmentunit['model_number']; ?></td>
            <td><?php echo $equipmentunit['unit_number']; ?></td>
            <td><a href="<?php echo base_url('app/addEquipmentUnit/' . $equipmentunit['equipmentunit_id']); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button>&nbsp;<a href="<?php echo base_url('equipmentunits/delete/' . $equipmentunit['equipmentunit_id']); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
  $(document).ready(function() {
    $('#equipmentUnitList').DataTable({
        "columns": [
            null,
            {"width": "80px", "orderable": false}
        ]
    });
//    $('#example2').DataTable({
//      'paging'      : true,
//      'lengthChange': false,
//      'searching'   : false,
//      'ordering'    : true,
//      'info'        : true,
//      'autoWidth'   : false
//    });
  });
</script>