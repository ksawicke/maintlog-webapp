<a href="<?php echo base_url('index.php/app/addChecklistItem'); ?>"><button type="button" class="btn btn-success"><i class="fas fa-plus-square" style="color:#fff !important;"></i>&nbsp;&nbsp;Add Checklist Item</button></a><br /><br />

<table id="checklistItemList" class="table table-bordered table-striped" width="100%">
    <thead>
        <tr>
            <th>Checklist Item</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($checklistitems['checklistitems'] as $ctr => $item) { ?>
        <tr>
            <td><?php echo $item['item']; ?></td>
            <td><a href="<?php echo base_url('index.php/app/addChecklistItem/' . $item['id']); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="far fa-edit" style="color:#fff !important;"></i></button></a>&nbsp;<a href="<?php echo base_url('index.php/checklistitems/delete/' . $item['id']); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fas fa-trash" style="color:#fff !important;"></i></button></a></td>
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
            {"width": "100px", "orderable": false}
        ]
    });
  });
</script>
