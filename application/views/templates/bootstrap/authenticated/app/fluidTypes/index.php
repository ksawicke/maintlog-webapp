<a href="<?php echo base_url('app/addFluidType'); ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Fluid Type</button></a><br /><br />

<table id="fluidTypeList" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Fluid Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($fluidtypes as $fluidtype) { ?>
        <tr>
            <td><?php echo $fluidtype->fluid_type; ?></td>
            <td><a href="<?php echo base_url('app/addFluidType/' . $fluidtype->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button></a>&nbsp;<a href="<?php echo base_url('fluidtypes/delete/' . $fluidtype->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
  //var $ = jQuery;
  $(document).ready(function() {
    $('#fluidTypeList').DataTable({
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