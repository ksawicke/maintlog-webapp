<?php echo $appsetting_navigation; ?>

<a href="<?php echo base_url('index.php/app/addChecklistCategory'); ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Checklist Category</button></a><br /><br />

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
            <td><a href="<?php echo base_url('index.php/app/addChecklistCategory/' . $category->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button></a>&nbsp;<a href="<?php echo base_url('index.php/checklistcategories/delete/' . $category->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td>
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