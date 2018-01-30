<?php echo $appsetting_navigation; ?>

<a href="<?php echo base_url('index.php/app/addComponentType'); ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Component Type</button></a><br /><br />

<table id="componentTypeList" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Component Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($componenttypes as $componenttype) { ?>
        <tr>
            <td><?php echo $componenttype->component_type; ?></td>
            <td><a href="<?php echo base_url('index.php/app/addComponentType/' . $componenttype->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button></a>&nbsp;<a href="<?php echo base_url('index.php/componenttypes/delete/' . $componenttype->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
  $(document).ready(function() {
    $('#componentTypeList').DataTable({
        responsive: true,
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