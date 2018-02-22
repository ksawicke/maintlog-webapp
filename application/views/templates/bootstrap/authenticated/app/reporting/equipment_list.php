<?php echo $reports_navigation; ?>

<h3>Equipment List</h3>

<a id="downloadEquipmentList"
    href="<?php echo base_url('index.php/reporting/output/spreadsheet/equipment_list'); ?>"
    class="buttonLink nounderline">
    
    <button type="button" class="btn btn-primary"><img
    class="excelIconMargin"
    src="<?php echo base_url('/assets/templates/komatsuna/img/excel_logo_24x24.png'); ?>">&nbsp;&nbsp;Download
        Report in Excel</button>

</a>

<br /><br />

<table id="equipmentList" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Manufacturer Name</th>
            <th>Model Name</th>
            <th>Unit Number</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Manufacturer Name</th>
            <th>Model Name</th>
            <th>Unit Number</th>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach ($equipment_list as $ctr => $equipment) { ?>
            <tr>
                <td><?php echo $equipment['manufacturer_name']; ?></td>
                <td><?php echo $equipment['model_number']; ?></td>
                <td><?php echo $equipment['unit_number']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $("#downloadEquipmentList").on('click', function(e) {
            e.preventDefault();

            var fields = [],
                dataParams = {data: {}},
                href = $("#downloadEquipmentList").attr("href"),
                selects = $('#equipmentList tfoot tr select');
            
            fields = ['manufacturer_name', 'model_number', 'unit_number'];
            
            $.map(fields, function(fieldName, i) {
                var key = fieldName;
                dataParams.data[key] = selects[i].value;
            });
            
            loadSpreadsheet(href + "?" + $.param(dataParams));
        });
        
        function loadSpreadsheet(href) {
            window.open(href, '_blank');
        }
        
        function escapeRegExp(string) {
            return string.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
        }
        
        var dataTable = $('#equipmentList').DataTable({
            /* Disable initial sort */
            "aaSorting": [],
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
            "order": [],
            "columns": [
                null,
                null,
                null
            ]
        });
    });
</script>