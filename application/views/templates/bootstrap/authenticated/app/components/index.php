<a href="<?php echo base_url('index.php/app/addComponent'); ?>"><button type="button" class="btn btn-success"><i class="fas fa-plus-square" style="color:#fff !important;"></i>&nbsp;&nbsp;Add Component</button></a><br /><br />

<table id="componentList" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Component</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($components as $component) { ?>
        <tr>
            <td><?php echo $component->component; ?></td>
            <td><a href="<?php echo base_url('index.php/app/addComponent/' . $component->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="far fa-edit" style="color:#fff !important;"></i></button></a>&nbsp;<a href="<?php echo base_url('index.php/components/delete/' . $component->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fas fa-trash" style="color:#fff !important;"></i></button></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
  $(document).ready(function() {
    $('#componentList').DataTable({
        responsive: true,
        "columns": [
            null,
            {"width": "100px", "orderable": false}
        ]
    });
  });
</script>
