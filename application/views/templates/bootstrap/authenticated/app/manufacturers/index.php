<a href="<?php echo base_url('index.php/app/addManufacturer'); ?>"><button type="button" class="btn btn-success"><i class="fas fa-plus-square" style="color:#fff !important;"></i>&nbsp;&nbsp;Add Manufacturer</button></a><br /><br />

<table id="manufacturerList" class="table table-bordered table-striped" width="100%">
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
            <td><a href="<?php echo base_url('index.php/app/addManufacturer/' . $manufacturer->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="far fa-edit" style="color:#fff !important;"></i></button></a>&nbsp;<a href="<?php echo base_url('index.php/manufacturers/delete/' . $manufacturer->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fas fa-trash" style="color:#fff !important;"></i></button></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
  $(document).ready(function() {
    $('#manufacturerList').DataTable({
        responsive: true,
        "columns": [
            null,
            {"width": "100px", "orderable": false}
        ]
    });
  });
</script>
