<?php echo $reports_navigation; ?>

<h3>Maintenance Log Reminders Report</h3>

<a href="<?php echo base_url('index.php/reporting/output/spreadsheet/maintenance_log_reminders'); ?>"><img src="<?php echo base_url('/assets/templates/komatsuna/img/ms-excel.png'); ?>" style="width:48px;height:48px;"></a>

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
    <tfoot>
        <tr>
            <th>Last Entry Date</th>
            <th>Last SMR</th>
            <th>Manufacturer Name</th>
            <th>Model Name</th>
            <th>Unit Number</th>
            <th>Notes</th>
            <th>SMR Due</th>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach ($maintenance_log_reminders as $ctr => $reminder) { ?>
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
    $(document).ready(function () {
        $('#maintenanceLogRemindersReport').DataTable({
            responsive: true,
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                        );

                                column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                            });

                    column.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            },
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