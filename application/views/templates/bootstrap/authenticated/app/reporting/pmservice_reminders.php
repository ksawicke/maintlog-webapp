<?php echo $reports_navigation; ?>

<h3>PM Service Reminders Report</h3>

<table id="pmserviceRemindersReport" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Manufacturer Name</th>
            <th>Model Name</th>
            <th>Unit Number</th>
            <th>Email Address</th>
            <th>Warn At</th>
            <th>Last SMR Recorded</th>
            <th>PM Service Due At</th>
            <th>Email Sent On</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Manufacturer Name</th>
            <th>Model Name</th>
            <th>Unit Number</th>
            <th>Email Address</th>
            <th>Warn At</th>
            <th>Last SMR Recorded</th>
            <th>PM Service Due At</th>
            <th>Email Sent On</th>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach ($pmservice_reminders as $ctr => $reminder) { ?>
            <tr>
                <td><?php echo $reminder['manufacturer_name']; ?></td>
                <td><?php echo $reminder['model_number']; ?></td>
                <td><?php echo $reminder['unit_number']; ?></td>
                <td><?php echo $reminder['emails']; ?></td>
                <td><?php echo $reminder['warn_on_quantity'] . " " . $reminder['warn_on_units']; ?></td>
                <td><?php echo ($reminder['last_smr_recorded']!="NULL" ? $reminder['last_smr_recorded'] : ''); ?></td>
                <td><?php echo $reminder['pmservice_due_quantity']; ?></td>
                <td><?php echo (!empty($reminder['sent_on']) ? date('m/d/Y h:i:s', strtotime($reminder['sent_on'])) : ''); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $('#pmserviceRemindersReport').DataTable({
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
                null,
                null
            ]
        });
    });
</script>