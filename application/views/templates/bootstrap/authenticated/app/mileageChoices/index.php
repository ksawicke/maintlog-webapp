<a href="<?php echo base_url('index.php/app/addMileageChoice'); ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Milage Choice</button></a><br /><br />

<table id="mileageChoiceList" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Mileage Choice</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($mileagechoices as $mileagechoice) { ?>
        <tr>
            <td><?php echo $mileagechoice->mileage_choice; ?></td>
            <td><a href="<?php echo base_url('index.php/app/addMileageChoice/' . $mileagechoice->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="far fa-edit" style="color:#fff !important;"></i></button></a>&nbsp;<a href="<?php echo base_url('index.php/mileagechoices/delete/' . $mileagechoice->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fas fa-trash" style="color:#fff !important;"></i></button></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
  $(document).ready(function() {
    $('#mileageChoiceList').DataTable({
        responsive: true,
        "columns": [
            null,
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
