<a href="<?php echo base_url('index.php/reporting/output/screen/maintenance_log_reminders'); ?>" class="nounderline">
    <button type="button" class="btn btn-maintlog-default <?php echo ($report_type=='maintenance_log_reminders' ? 'active' : ''); ?>">Maintenance Log Reminders</button>
</a>

<a href="<?php echo base_url('index.php/reporting/output/screen/service_logs'); ?>" class="nounderline">
    <button type="button" class="btn btn-maintlog-default <?php echo ($report_type=='service_logs' || $report_type=='service_log_detail' ? 'active' : ''); ?>">Service Logs</button>
</a>

<a href="<?php echo base_url('index.php/reporting/output/screen/pmservice_reminders'); ?>" class="nounderline">
    <button type="button" class="btn btn-maintlog-default <?php echo ($report_type=='pmservice_reminders' ? 'active' : ''); ?>">PM Service Reminders</button>
</a>

<a href="<?php echo base_url('index.php/reporting/output/screen/equipment_list'); ?>" class="nounderline">
    <button type="button" class="btn btn-maintlog-default <?php echo ($report_type=='equipment_list' ? 'active' : ''); ?>">Equipment List</button>
</a>