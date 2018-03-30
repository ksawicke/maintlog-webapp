<h3>Maintenance Log Reminders Report</h3>

<a id="downloadReportMaintenanceLogReminders"
    href="<?php echo base_url('index.php/reporting/output/spreadsheet/maintenance_log_reminders'); ?>"
    class="buttonLink nounderline">
    
    <button type="button" class="btn btn-primary"><img
    class="excelIconMargin"
    src="<?php echo base_url('/assets/templates/komatsuna/img/excel_logo_24x24.png'); ?>">&nbsp;&nbsp;Download
        Report in Excel</button>

</a>

<br /><br />

<table id="maintenanceLogRemindersReport" class="table table-bordered table-striped" width="100%">
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
        $("#downloadReportMaintenanceLogReminders").on('click', function(e) {
            e.preventDefault();

            var fields = ['date_entered', 'current_smr', 'manufacturer_name', 'model_number', 'unit_number', 'notes', 'due_units'],
                dataParams = {data: {}},
                href = $("#downloadReportMaintenanceLogReminders").attr("href"),
                selects = $('#maintenanceLogRemindersReport tfoot tr select');
            
            $.map(fields, function(fieldName, i) {
                var key = fieldName;
                dataParams.data[key] = selects[i].value;
            });
            
            loadSpreadsheet(href + "?" + $.param(dataParams));
        });
        
        function loadSpreadsheet(href) {
            window.open(href, '_blank');
        }
        
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
                {"orderable": false},
                {"orderable": false},
                {"orderable": false},
                {"orderable": false},
                {"orderable": false},
                {"orderable": false},
                {"orderable": false}
            ]
        });
    });
</script>
