<a href="<?php echo base_url('index.php/reporting/output/screen/maintenance_log_reminders'); ?>">
    <button type="button" class="btn btn-<?php echo ($report_type=='maintenance_log_reminders' ? 'primary' : 'default'); ?>">Maintenance Log Reminders</button>
</a>

<a href="<?php echo base_url('index.php/reporting/output/screen/service_logs'); ?>">
    <button type="button" class="btn btn-<?php echo ($report_type=='service_logs' || $report_type=='service_log_detail' ? 'primary' : 'default'); ?>">Service Logs</button>
</a>

<a href="<?php echo base_url('index.php/reporting/output/screen/pmservice_reminders'); ?>">
    <button type="button" class="btn btn-<?php echo ($report_type=='pmservice_reminders' ? 'primary' : 'default'); ?>">PM Service Reminders</button>
</a>

<a href="<?php echo base_url('index.php/reporting/output/screen/equipment_list'); ?>">
    <button type="button" class="btn btn-<?php echo ($report_type=='equipment_list' ? 'primary' : 'default'); ?>">Equipment List</button>
</a>