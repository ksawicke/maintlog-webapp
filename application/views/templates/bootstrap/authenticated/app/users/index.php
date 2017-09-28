<a href="<?php echo base_url('app/addUser'); ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add User</button></a><br /><br />

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
            <td><?php echo $user->last_name . ', ' . $user->first_name; ?></td>
            <td><?php echo ($user->active==1 ? '<i class="fa fa-check" aria-hidden="true" style="color:green;"></i>' : '<i class="fa fa-times" aria-hidden="true" style="color:red;"></i>'); ?></td>
            <td><a href="<?php echo base_url('app/addUser/' . $user->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button></a>&nbsp;<a href="<?php echo base_url('users/toggle_activation/' . $user->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Deactivate"><i class="fa fa-pause" aria-hidden="true"></i></button></a></td>
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
            {"width": "80px", "orderable": false}
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