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
        <?php foreach($maintenance_reminders as $ctr => $maintenance_reminder) { ?>
        <tr>
            <td><?php echo date('m/d/Y', strtotime($maintenance_reminder['date_entered'])); ?></th>
            <td><?php echo $maintenance_reminder['current_smr']; ?></th>
            <td><?php echo $maintenance_reminder['manufacturer_name']; ?></th>
            <td><?php echo $maintenance_reminder['model_number']; ?></th>
            <td><?php echo $maintenance_reminder['unit_number']; ?></th>
            <td><?php echo $maintenance_reminder['notes']; ?></th>
            <td><?php echo $maintenance_reminder['due_units']; ?></th>
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