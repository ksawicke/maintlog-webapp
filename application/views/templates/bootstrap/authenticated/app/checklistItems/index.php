<a href="<?php echo base_url('index.php/app/addChecklistItem'); ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Checklist Item</button></a><br /><br />

<table id="checklistItemList" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Checklist Item</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($checklistitems as $item) { ?>
        <tr>
            <td><?php echo $item->item; ?></td>
            <td><a href="<?php echo base_url('index.php/app/addChecklistItem/' . $item->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button></a>&nbsp;<a href="<?php echo base_url('index.php/checklistitems/delete/' . $item->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
  $(document).ready(function() {
    $('#checklistItemList').DataTable({
        responsive: true,
        "columns": [
            null,
            {"width": "80px", "orderable": false}
        ]
    });
  });
</script>
