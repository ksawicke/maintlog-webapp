<a href="<?php echo base_url('index.php/app/addChecklistCategory'); ?>"><button type="button" class="btn btn-success"><i class="fas fa-plus-square" style="color:#fff !important;"></i>&nbsp;&nbsp;Add Checklist Category</button></a><br /><br />

<table id="checklistCategoryList" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Category Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($checklistcategories as $category) { ?>
        <tr>
            <td><?php echo $category->category; ?></td>
            <td><a href="<?php echo base_url('index.php/app/addChecklistCategory/' . $category->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="far fa-edit" style="color:#fff !important;"></i></button></a>&nbsp;<a href="<?php echo base_url('index.php/checklistcategories/delete/' . $category->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fas fa-trash" style="color:#fff !important;"></i></button></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
  $(document).ready(function() {
    $('#checklistCategoryList').DataTable({
        responsive: true,
        "columns": [
            null,
            {"width": "80px", "orderable": false}
        ]
    });
  });
</script>
