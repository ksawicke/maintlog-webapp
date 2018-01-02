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
        <?php //foreach($mileagechoices as $mileagechoice) { ?>
        <tr>
            <td>&nbsp;</th>
            <td>&nbsp;</th>
            <td>&nbsp;</th>
            <td>&nbsp;</th>
            <td>&nbsp;</th>
            <td>&nbsp;</th>
            <td>&nbsp;</th>
        </tr>
        <?php //} ?>
    </tbody>
</table>

<pre>
    <?php var_dump($maintenance_reminders); ?>
</pre>

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