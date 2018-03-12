<a href="<?php echo base_url('index.php/app/addTimeChoice'); ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Time Choice</button></a><br /><br />

<table id="timeChoiceList" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Time Choice</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($timechoices as $timechoice) { ?>
        <tr>
            <td><?php echo $timechoice->time_choice; ?></td>
            <td><a href="<?php echo base_url('index.php/app/addTimeChoice/' . $timechoice->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="far fa-edit" style="color:#fff !important;"></i></button></a>&nbsp;<a href="<?php echo base_url('index.php/timechoices/delete/' . $timechoice->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fas fa-trash" style="color:#fff !important;"></i></button></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
  $(document).ready(function() {
    $('#timeChoiceList').DataTable({
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
