<a href="<?php echo base_url(); ?>app/addFluidType"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Fluid Type</button></a><br /><br />

<table id="fluidTypeList" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Fluid Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Diesel</td>
            <td><button type="button" class="btn btn-sm btn-primary">Edit</button>&nbsp;<button type="button" class="btn btn-sm btn-primary">Delete</button></td>
        </tr>
        <tr>
            <td>Gasoline</td>
            <td><button type="button" class="btn btn-sm btn-primary">Edit</button>&nbsp;<button type="button" class="btn btn-sm btn-primary">Delete</button></td>
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
    $('#fluidTypeList').DataTable();
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