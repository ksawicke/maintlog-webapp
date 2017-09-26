<a href="#addEquipment"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Equipment</button></a><br /><br />

<table id="equipmentList" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Unit No.</th>
            <th>Manufacturer</th>
            <th>Model No.</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>6516513</td>
            <td>Manuf One</td>
            <td>12409124FFF</td>
            <td><button type="button" class="btn btn-sm btn-primary">Edit</button>&nbsp;<button type="button" class="btn btn-sm btn-primary">Delete</button></td>
        </tr>
        <tr>
            <td>98746</td>
            <td>Manuf One</td>
            <td>1000NN</td>
            <td><button type="button" class="btn btn-sm btn-primary">Edit</button>&nbsp;<button type="button" class="btn btn-sm btn-primary">Delete</button></td>
        </tr>
        <tr>
            <td>65412</td>
            <td>Manuf Two</td>
            <td>144-204</td>
            <td><button type="button" class="btn btn-sm btn-primary">Edit</button>&nbsp;<button type="button" class="btn btn-sm btn-primary">Delete</button></td>
        </tr>
        <tr>
            <td>98998</td>
            <td>Manuf One</td>
            <td>KUBWA</td>
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
    $('#equipmentList').DataTable();
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