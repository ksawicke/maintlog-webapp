<?php echo $reports_navigation; ?>

<h3>Service Logs Report</h3>

<a id="downloadReportServiceLogs"
    href="<?php echo base_url('index.php/reporting/output/spreadsheet/service_logs'); ?>"
    class="buttonLink nounderline">
    
    <button type="button" class="btn btn-maintlog-default"><img
    class="excelIconMargin"
    src="<?php echo base_url('/assets/templates/komatsuna/img/excel_logo_24x24.png'); ?>">&nbsp;&nbsp;Download
        Report in Excel</button>

</a>

<br /><br />

<table id="serviceLogsReport" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Date Entered</th>
            <th>Entered By</th>
            <th>Manufacturer Name</th>
            <th>Model Name</th>
            <th>Unit Number</th>
            <th>Entry Type</th>
            <th>SMR</th>
            <th>Component Type</th>
            <th>Component</th>
            <th>Component Data</th>
            <th>Type of Fluid</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Date Entered</th>
            <th>Entered By</th>
            <th>Manufacturer Name</th>
            <th>Model Name</th>
            <th>Unit Number</th>
            <th>Entry Type</th>
            <th>SMR</th>
            <th>Component Type</th>
            <th>Component</th>
            <th>Component Data</th>
            <th>Type of Fluid</th>
            <th>Actions</th>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach ($service_logs as $ctr => $log) { ?>
            <tr>
                <td><?php echo date('m/d/Y', strtotime($log['date_entered'])); ?></td>
                <td><?php echo $log['enteredby_last_name'] . ", " . $log['enteredby_first_name']; ?></td>
                <td><?php echo $log['manufacturer_name']; ?></td>
                <td><?php echo $log['model_number']; ?></td>
                <td><?php echo $log['unit_number']; ?></td>
                <td><?php echo $log['entry_type']; ?></td>
                <td><?php echo $log['smr']; ?></td>
                <td><?php echo $log['component_type']; ?></td>
                <td><?php echo $log['component']; ?></td>
                <td><?php echo $log['component_data']; ?></td>
                <td><?php echo $log['typeoffluid']; ?></td>
                <td>
                    <a href="<?php echo base_url('index.php/reporting/output/screen/service_log_detail/') . $log['id']; ?>"><button type="button" class="btn btn-sm btn-primary" title="View Detail"><i class="fa fa-search" aria-hidden="true"></i></button></a>
                    
                    <?php if($_SESSION['role']==='admin') { ?>
                    <a href="<?php echo base_url('index.php/app/log_entry?id=') . $log['id']; ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit Service Log"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                    
                    <a href="#"><button data-servicelogid="<?php echo $log['id']; ?>" type="button" class="deleteServiceLog btn btn-sm btn-primary" title="Delete"><i class="fa fa-minus-circle" aria-hidden="true"></i></button></a>
                    <?php } ?>
                    
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        /** Handle pop up content **/
        var windowWidth = $(window).width(),
            dialogWidth = windowWidth * 0.4,
            windowHeight = $(window).height(),
            dialogHeight = windowHeight * 0.4;
        
        var confirmationMessage = '<div class="jBoxContentBodyText">Are you sure you want to delete this Service Log and its related records?<br /><br /><button class="cancelDeleteServiceLogRequest" type="button">No</button>&nbsp;&nbsp;&nbsp;<button id="confirmDeleteServiceLog" data-servicelogid="" type="button">Yes</button></div>';
        var confirmSubmitJBox = new jBox('Modal', {
            closeButton: 'title',
            responsiveWidth: true,
            responsiveHeight: true,
            minWidth: dialogWidth,
            minHeight: dialogHeight,
            attach: '.deleteServiceLog',
            title: 'Confirm',
            content: confirmationMessage,
            zIndex: 15000,
                preventDefault: true,
                preloadAudio: false
        });
        
        var fluidTypes = <?php echo $fluid_types; ?>;
        
        $("#downloadReportServiceLogs").on('click', function(e) {
            e.preventDefault();

            var fields = [],
                dataParams = {data: {}},
                href = $("#downloadReportServiceLogs").attr("href"),
                selects = $('#serviceLogsReport tfoot tr select');
            
            switch(selects[5].value) {
                case 'Component Change':
                    fields = ['date_entered', 'entered_by', 'manufacturer_name', 'model_number', 'unit_number', 'entry_type', 'component_type', 'component', 'component_data'];
                    break;

                case 'Fluid Entry':
                    fields = ['date_entered', 'entered_by', 'manufacturer_name', 'model_number', 'unit_number', 'entry_type', 'fluid_type'];
                    break;

                case 'SMR Update':
                    fields = ['date_entered', 'entered_by', 'manufacturer_name', 'model_number', 'unit_number', 'entry_type', 'smr'];
                    break;
                    
                case 'PM Service':
                default:
                    fields = ['date_entered', 'entered_by', 'manufacturer_name', 'model_number', 'unit_number', 'entry_type'];
                    break;
            }
            
            $.map(fields, function(fieldName, i) {
                var key = fieldName;
                dataParams.data[key] = selects[i].value;
            });
            
            loadSpreadsheet(href + "?" + $.param(dataParams));
        });
        
        function loadSpreadsheet(href) {
            window.open(href, '_blank');
        }
        
        function deleteServiceLog(servicelogid) {
            var jqxhr = $.ajax({
                url: '<?php echo base_url(); ?>index.php/servicelog/deleteServiceLog',
                type: "POST",
                dataType: "json",
                data: JSON.stringify({'action': 'deleteServiceLog',
                                      'servicelogid': servicelogid,
                                      'tokenCheck': 'CBxjkc6b32cb2ccy23b!8acbac%5654@6sdsassf'}),
                contentType: "application/json"
            }).done(function(object) {
                confirmSubmitJBox.close();
            
                location.reload(true);
            });
        }
        
        $(document).on("click", ".deleteServiceLog", function (e) {
            e.preventDefault();
            var servicelogid = $(this).data('servicelogid');
            $('#confirmDeleteServiceLog').data('servicelogid', servicelogid);
        });
        
        $(document).on("click", "#confirmDeleteServiceLog", function (e) {
            e.preventDefault();
            var servicelogid = $(this).data('servicelogid');
            
            deleteServiceLog(servicelogid);
        });
        
        $(document).on("click", ".cancelDeleteServiceLogRequest", function () {
            confirmSubmitJBox.close();
        });
        
        function escapeRegExp(string) {
            return string.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
        }
        
        var dataTable = $('#serviceLogsReport').DataTable({
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

                                if(column.index() != 10) {
                                    column
                                            .search(val ? '^' + val + '$' : '', true, false)
                                            .draw();
                                } else {
                                    /* Search for Fluid Entry like val */
                                    column
                                        .search(val ? '^.*' + val + '.*$' : '', true, false)
                                        .draw();
                                }
                                
                                if(column.index()==5) {
                                    switch(val) {
                                        case 'SMR Update':
                                            dataTable.column(6).visible(true);
                                            dataTable.column(7).visible(false);
                                            dataTable.column(8).visible(false);
                                            dataTable.column(9).visible(false);
                                            dataTable.column(9).visible(false);
                                            break;
                                            
                                        case 'Component Change':
                                            dataTable.column(6).visible(false);
                                            dataTable.column(7).visible(true);
                                            dataTable.column(8).visible(true);
                                            dataTable.column(9).visible(true);
                                            dataTable.column(10).visible(false);
                                            break;

                                        case 'Fluid Entry':
                                            dataTable.column(6).visible(false);
                                            dataTable.column(7).visible(false);
                                            dataTable.column(8).visible(false);
                                            dataTable.column(9).visible(false);
                                            dataTable.column(10).visible(true);
                                            break;
                                            
                                        default:
                                            dataTable.column(6).visible(false);
                                            dataTable.column(7).visible(false);
                                            dataTable.column(8).visible(false);
                                            dataTable.column(9).visible(false);
                                            dataTable.column(10).visible(false);
                                            break;
                                    }
                                }
                            });

                    if(column.index() != 10) {
                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                    } else {
                        /* Populate dropdown for Fluid Entry filter */
                        column.each(function (d, j) {
                            $.each(fluidTypes, function(key, value) {
                                select.append('<option value="' + key + '">' + value + '</option>');
                            });
                        } );
                    }
                });
            },
            "order": [],
            "columns": [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                {"width": "140px", "orderable": false}
            ]
        });
        
        dataTable.column(6).visible(false);
        dataTable.column(7).visible(false);
        dataTable.column(8).visible(false);
        dataTable.column(9).visible(false);
        dataTable.column(10).visible(false);
    });
</script>