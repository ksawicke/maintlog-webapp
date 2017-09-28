<a href="<?php echo base_url('app/addManufacturer'); ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Manufacturer</button></a><br /><br />

<table id="manufacturerList" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Manufacturer</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($manufacturers as $manufacturer) { ?>
        <tr>
            <td><?php echo $manufacturer->manufacturer_name; ?></td>
            <td><a href="<?php echo base_url('app/addManufacturer/' . $manufacturer->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button></a>&nbsp;<a href="<?php echo base_url('manufacturers/delete/' . $manufacturer->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
  //var $ = jQuery;
  $(document).ready(function() {
    $('#manufacturerList').DataTable({
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