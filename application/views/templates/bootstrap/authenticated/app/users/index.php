<a href="#addUser"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add User</button></a><br /><br />

<table id="userList" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Johnson, Bret</td>
            <td><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button>&nbsp;<button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
        </tr>
        <tr>
            <td>Johnson, Neil</td>
            <td><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button>&nbsp;<button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
        </tr>
        <tr>
            <td>Leonetti, John</td>
            <td><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button>&nbsp;<button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
        </tr>
        <tr>
            <td>Sawicke, Kevin</td>
            <td><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button>&nbsp;<button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
        </tr>
        <?php /**foreach($websites as $websitekey => $website) { ?>
        <tr>
            <td><?php echo $website['website_name']; ?></td>
            <td><?php echo $website['company_name']; ?></td>
            <td><?php //echo $contact->email_address; ?></td>
            <td>
                <a href="/websites/add/<?php echo $website['id']; ?>"<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Edit</button>&nbsp;&nbsp;&nbsp;
                <a href="/websites/delete/<?php echo $website['id']; ?>"<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Delete</button>
            </td>
        </tr>
        <?php } **/ ?>
    </tbody>
</table>

<script>
  //var $ = jQuery;
  $(document).ready(function() {
    $('#userList').DataTable({
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