<a href="#addEquipmentType"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Equipment Type</button></a><br /><br />

<table id="equipmentTypeList" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Equipment Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>All Truck Support Equipment</td>
            <td></td>
        </tr>
        <tr>
            <td>Loader</td>
            <td></td>
        </tr>
        <tr>
            <td>Fork Lift</td>
            <td></td>
        </tr>
        <tr>
            <td>Light Vehicle</td>
            <td></td>
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
    $('#equipmentTypeList').DataTable();
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