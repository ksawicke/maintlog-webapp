<a href="<?php echo base_url('index.php/app/addSmrChoice'); ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add SMR Choice</button></a><br /><br />

<table id="smrChoiceList" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>SMR Choice</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($smrchoices as $smrchoice) { ?>
        <tr>
            <td><?php echo $smrchoice->smr_choice; ?></td>
            <td><a href="<?php echo base_url('index.php/app/addSmrChoice/' . $smrchoice->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="far fa-edit" style="color:#fff !important;"></i></button></a>&nbsp;<a href="<?php echo base_url('index.php/smrchoices/delete/' . $smrchoice->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fas fa-trash" style="color:#fff !important;"></i></button></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
  $(document).ready(function() {
    $('#smrChoiceList').DataTable({
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
