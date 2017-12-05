<a href="<?php echo base_url('app/addReminderRecipient'); ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Reminder Recipient</button></a><br /><br />

<table id="reminderRecipientList" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Reminder Recipient</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($reminderrecipients as $reminderrecipient) { ?>
        <tr>
            <td><?php echo $reminderrecipient->reminder_recipient; ?></td>
            <td><a href="<?php echo base_url('app/addReminderRecipient/' . $reminderrecipient->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></button>&nbsp;<a href="<?php echo base_url('reminderrecipients/delete/' . $reminderrecipient->id); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
  $(document).ready(function() {
    $('#reminderRecipientList').DataTable({
        "columns": [
            null,
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