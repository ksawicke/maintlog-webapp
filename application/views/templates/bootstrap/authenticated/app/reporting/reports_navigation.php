<a href="<?php echo base_url('app/reporting/index'); ?>">
    <button type="button" class="btn btn-<?php echo ($report_type=='maintenance_log_reminders' ? 'success' : 'default'); ?>">Maintenance Log Reminders</button>
</a>

<a href="<?php echo base_url('app/reporting/service_logs'); ?>">
    <button type="button" class="btn btn-<?php echo ($report_type=='service_logs' || $report_type=='service_log_detail' ? 'success' : 'default'); ?>">Service Logs</button>
</a>