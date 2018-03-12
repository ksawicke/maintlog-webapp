<a href="<?php echo base_url('index.php/app/addUser'); ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add User</button></a><br /><br />

<table id="userList" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user) { ?>
        <tr>
            <td><?php echo $user['last_name'] . ', ' . $user['first_name']; ?></td>
            <td><?php echo ($user['active']==1 ? '<i class="fas fa-check" style="color:green !important;"></i>' : '<i class="fas fa-times" style="color:red !important;"></i>'); ?></td>
            <td><a href="<?php echo base_url('index.php/app/addUser/' . $user['id']); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="far fa-edit" style="color:#fff !important;"></i></button></a>&nbsp;<a href="<?php echo base_url('index.php/users/toggle_activation/' . $user['id']); ?>"><button type="button" class="btn btn-sm btn-primary" title="Deactivate"><i class="far fa-pause-circle" style="color:#fff !important;"></i></button></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<style>
#userList td:nth-child(2) {
    text-align : center;
}
</style>

<script>
  //var $ = jQuery;
  $(document).ready(function() {
    $('#userList').DataTable({
        "columns": [
            null,
            {"width": "60px", "orderable": false},
            {"width": "100px", "orderable": false}
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
