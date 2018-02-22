<?php echo $appsetting_navigation; ?>

<a href="<?php echo base_url('index.php/app/addFluidType'); ?>" class="nounderline"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Fluid Type</button></a><br /><br />

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
            <td><a href="<?php echo base_url('index.php/app/addFluidType/' . $fluidtype->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button></a>&nbsp;<a href="<?php echo base_url('index.php/fluidtypes/delete/' . $fluidtype->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
  $(document).ready(function() {
    $('#fluidTypeList').DataTable({
        responsive: true,
        "columns": [
            null,
            {"width": "80px", "orderable": false}
        ]
    });
  });
</script>