<a href="<?php echo base_url('app/addEquipmentType'); ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Equipment Type</button></a><br /><br />

<table id="equipmentTypeList" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Equipment Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($equipmenttypes as $equipmenttype) { ?>
        <tr>
            <td><?php echo $equipmenttype->equipment_type; ?></td>
            <td><a href="<?php echo base_url('app/addEquipmentType/' . $equipmenttype->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button>&nbsp;<a href="<?php echo base_url('equipmenttypes/delete/' . $equipmenttype->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
  //var $ = jQuery;
  $(document).ready(function() {
    $('#equipmentTypeList').DataTable({
        "columns": [
            null,
            {"width": "50px"}
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