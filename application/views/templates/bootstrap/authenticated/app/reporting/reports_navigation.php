<a href="<?php echo base_url('index.php/app/reporting/index'); ?>">
    <button type="button" class="btn btn-<?php echo ($report_type=='maintenance_log_reminders' ? 'success' : 'default'); ?>">Maintenance Log Reminders</button>
</a>

<a href="<?php echo base_url('index.php/app/reporting/service_logs'); ?>">
    <button type="button" class="btn btn-<?php echo ($report_type=='service_logs' || $report_type=='service_log_detail' ? 'success' : 'default'); ?>">Service Logs</button>
</a>

<a href="<?php echo base_url('index.php/app/reporting/pmservice_reminders'); ?>">
    <button type="button" class="btn btn-<?php echo ($report_type=='pmservice_reminders' ? 'success' : 'default'); ?>">PM Service Reminders</button>
</a>