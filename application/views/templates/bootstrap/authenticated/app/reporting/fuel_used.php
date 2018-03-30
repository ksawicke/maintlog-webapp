<h3>Fuel Used Report</h3>

<a id="downloadReportFuelUsed"
   href="<?php echo base_url('index.php/reporting/output/spreadsheet/fuel_used'); ?>"
   class="buttonLink nounderline">

    <button type="button" class="btn btn-primary"><img
                class="excelIconMargin"
                src="<?php echo base_url('/assets/templates/komatsuna/img/excel_logo_24x24.png'); ?>">&nbsp;&nbsp;Download
        Report in Excel
    </button>

</a>

<br/><br/>

<table id="fuelUsedReport" class="table table-bordered table-striped" width="100%">
    <thead>
    <tr>
        <th>Date Entered</th>
        <th>Fluid Type</th>
        <th>Amount Used (gal)</th>
        <th>Equipment Type</th>
        <th>Manufacturer Name</th>
        <th>Model Number</th>
        <th>Unit Number</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Date Entered</th>
        <th>Fluid Type</th>
        <th>Amount Used</th>
        <th>Equipment Type</th>
        <th>Manufacturer Name</th>
        <th>Model Number</th>
        <th>Unit Number</th>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($fuelUsed as $fuctr => $fuelData) { ?>
        <tr>
            <td><?php echo date('m/d/Y', strtotime($fuelData['date_entered'])); ?></td>
            <td><?php echo $fuelData['fluid_type']; ?></td>
            <td><?php echo $fuelData['quantity']; ?></td>
            <td><?php echo $fuelData['equipment_type']; ?></td>
            <td><?php echo $fuelData['manufacturer_name']; ?></td>
            <td><?php echo $fuelData['model_number']; ?></td>
            <td><?php echo $fuelData['unit_number']; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $("#downloadReportFuelUsed").on('click', function (e) {
            e.preventDefault();

            var fields = [],
                dataParams = {data: {}},
                href = $("#downloadReportFuelUsed").attr("href"),
                selects = $('#fuelUsedReport tfoot tr select');

            fields = ['1', 'fluid_type', '2', 'equipment_type', 'manufacturer_name', 'model_number', 'unit_number'];

            $.map(fields, function (fieldName, i) {
                var key = fieldName;
                if (fieldName == "date_entered_starting" || fieldName == "date_entered_ending") {
                    dataParams.data[key] = $("#" + fieldName).val();
                } else {
                    dataParams.data[key] = selects[i].value;
                }
            });

            dataParams.data['date_entered_starting'] = $("#date_entered_starting").val();
            dataParams.data['date_entered_ending'] = $("#date_entered_ending").val();

            loadSpreadsheet(href + "?" + $.param(dataParams));
        });

        function loadSpreadsheet(href) {
            window.open(href, '_blank');
        }

        function getURLParam(paramName) {
            var urlString = window.location.href;
            var url = new URL(urlString);

            return url.searchParams.get(paramName);
        }

        function escapeRegExp(string) {
            return string.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
        }

        var dataTable = $('#fuelUsedReport').DataTable({
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

                            if (!!~$.inArray(column.index(), [1, 3, 4, 5, 6])) {
                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            }
                        });

                    if (!!~$.inArray(column.index(), [1, 3, 4, 5, 6])) {
                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                    } else {
                        select.hide();
                    }

                    if (column.index() == 0) {
                        var dateRangeFieldStarting = '<div class="input-group date">' +
                            '<div class="input-group-addon">' +
                            '<i class="far fa-calendar-alt"></i></div>' +
                            '<div><input id="date_entered_starting" name="date_entered_starting" value="<?php echo $dateEnteredStarting; ?>" size="8"> to </div>';

                        var dateRangeFieldEnding = '<div class="input-group date">' +
                            '<div class="input-group-addon">' +
                            '<i class="far fa-calendar-alt"></i></div>' +
                            '<div><input id="date_entered_ending" name="date_entered_ending" value="<?php echo $dateEnteredEnding; ?>" size="8"></div>';

                        // Creates our custom date range inputs for entered on
                        $(dateRangeFieldStarting)
                            .appendTo($(column.footer()));

                        $(dateRangeFieldEnding)
                            .appendTo($(column.footer()));
                    }

                });
            },
            "order": [],
            "columns": [
                {"orderable": false, "width": "150px", "class": "text-center"},
                {"orderable": false, "class": "text-center"},
                {"orderable": false, "class": "text-center"},
                {"orderable": false, "class": "text-center"},
                {"orderable": false, "class": "text-center"},
                {"orderable": false, "class": "text-center"},
                {"orderable": false, "class": "text-center"}
            ]
        });

        function selectDTEntryType(entryType) {
            $("#fuelUsedReport > tfoot > tr > th:nth-child(4) > select").val(entryType);
        }

        var entryType = getURLParam("data[entry_type]");

        selectDTEntryType(entryType);

        $('#date_entered_starting').datepicker({
            autoclose: true,
            dateFormat: 'mm/dd/yyyy'
        });

        $('#date_entered_ending').datepicker({
            autoclose: true,
            dateFormat: 'mm/dd/yyyy'
        });

        $("#date_entered_starting, #date_entered_ending").change(function () {
            dataTable.draw(); // Ensures we use our custom function to filter on date range
        });

        dataTable.draw();
    });

    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {

            var enteredOn = moment(data[0], 'MM/DD/YY');
            var dateEnteredStarting = moment($("#date_entered_starting").val(), 'MM/DD/YY');
            var dateEnteredEnding = moment($("#date_entered_ending").val(), 'MM/DD/YY');

            //Show all rows if start and end date is not selected
            if ($("#date_entered_starting").val() == "" && $("#date_entered_ending").val() == "") {
                return true;
            }

            if (enteredOn.isSameOrAfter(dateEnteredStarting)) {
                if ($("#date_entered_ending").val() == "") {
                    return true;
                }

                if (enteredOn.isSameOrBefore(dateEnteredEnding)) {
                    return true;
                }

                return false;
            }

            return false;
        }
    );
</script>
