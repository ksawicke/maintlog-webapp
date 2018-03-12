<table id="pmTypeChoiceList" class="table table-bordered table-striped" width="100%">
    <thead>
        <tr>
            <th>PM Type</th>
            <th>Choice List</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>SMR Based</td>
            <td>250&nbsp;&nbsp;500&nbsp;&nbsp;1,000&nbsp;&nbsp;1,500</td>
            <td><button type="button" class="btn btn-sm btn-primary">Edit</button></td>
        </tr>
        <tr>
            <td>Mileage Based</td>
            <td>10,000&nbsp;&nbsp;50,000&nbsp;&nbsp;10,0000&nbsp;&nbsp;15,0000</td>
            <td><button type="button" class="btn btn-sm btn-primary">Edit</button></td>
        </tr>
        <tr>
            <td>Time Based (days)</td>
            <td>1&nbsp;&nbsp;3&nbsp;&nbsp;9&nbsp;&nbsp;30</td>
            <td><button type="button" class="btn btn-sm btn-primary">Edit</button></td>
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
    $('#pmTypeChoiceList').DataTable();
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
