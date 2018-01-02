<h3>Maintenance Log Reminders Report</h3>

<table id="maintenanceLogRemindersReport" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Last Entry Date</th>
            <th>Last SMR</th>
            <th>Manufacturer Name</th>
            <th>Model Name</th>
            <th>Unit Number</th>
            <th>Notes</th>
            <th>SMR Due</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($maintenance_log_reminders as $ctr => $reminder) { ?>
        <tr>
            <td><?php echo date('m/d/Y', strtotime($reminder['date_entered'])); ?></td>
            <td><?php echo $reminder['current_smr']; ?></td>
            <td><?php echo $reminder['manufacturer_name']; ?></td>
            <td><?php echo $reminder['model_number']; ?></td>
            <td><?php echo $reminder['unit_number']; ?></td>
            <td><?php echo $reminder['notes']; ?></td>
            <td><?php echo $reminder['due_units']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
  $(document).ready(function() {
    $('#maintenanceLogRemindersReport').DataTable({
        "columns": [
            null,
            null,
            null,
            null,
            null,
            null,
            null
//            {"width": "80px", "orderable": false}
        ]
    });
  });
</script>