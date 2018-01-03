<?php echo $reports_navigation; ?>

<h3>Service Logs Report</h3>

<table id="serviceLogsReport" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Date Entered</th>
            <th>Entered By</th>
            <th>Manufacturer Name</th>
            <th>Model Name</th>
            <th>Unit Number</th>
            <th>Entry Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($service_logs as $ctr => $log) { ?>
        <tr>
            <td><?php echo date('m/d/Y', strtotime($log['date_entered'])); ?></td>
            <td><?php echo $log['last_name'] . ", " . $log['first_name']; ?></td>
            <td><?php echo $log['manufacturer_name']; ?></td>
            <td><?php echo $log['model_number']; ?></td>
            <td><?php echo $log['unit_number']; ?></td>
            <td><?php echo $log['entry_type']; ?></td>
            <td>
                <a href="<?php echo base_url('app/reporting/service_log_detail/') . $log['id']; ?>"><button type="button" class="btn btn-sm btn-primary" title="View Detail"><i class="fa fa-search" aria-hidden="true"></i></button></a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
  $(document).ready(function() {
    $('#serviceLogsReport').DataTable({
        "order": [],
        "columns": [
            null,
            null,
            null,
            null,
            null,
            null,
            {"width": "80px", "orderable": false}
        ]
    });
  });
</script>