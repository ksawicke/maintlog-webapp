<h3>Service Logs Report</h3>

<a id="downloadReportServiceLogs"
    href="<?php echo base_url('index.php/reporting/output/spreadsheet/service_logs'); ?>"
    class="buttonLink nounderline">
    
    <button type="button" class="btn btn-primary"><img
    class="excelIconMargin"
    src="<?php echo base_url('/assets/templates/komatsuna/img/excel_logo_24x24.png'); ?>">&nbsp;&nbsp;Download
        Report in Excel</button>

</a>

<br /><br />

<table id="serviceLogsReport" class="table table-bordered table-striped" width="100%">
    <thead>
        <tr>
            <th>Date Entered</th>
            <th>Entered By</th>
			<th>Serviced By</th>
            <th>Manufacturer Name</th>
            <th>Model Name</th>
            <th>Unit Number</th>
            <th>Entry Type</th>
            <th>SMR / Miles / Time</th>
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
			<th>Serviced By</th>
            <th>Manufacturer Name</th>
            <th>Model Name</th>
            <th>Unit Number</th>
            <th>Entry Type</th>
            <th>SMR / Miles / Time</th>
            <th>Component Type</th>
            <th>Component</th>
            <th>Component Data</th>
            <th>Type of Fluid</th>
            <th>Actions</th>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach ($service_logs as $slctr => $log) { ?>
            <tr>
                <td><?php echo date('m/d/Y', strtotime($log['date_entered'])); ?></td>
                <td><?php echo $log['enteredby_last_name'] . ", " . $log['enteredby_first_name']; ?></td>
				<td><?php
					$servicedByStringArray = [];
					foreach($log['serviced_by'] as $sbctr => $servicedBy) {
						$servicedByStringArray[] = $servicedBy['servicedby_last_name'] . ", " . $servicedBy['servicedby_first_name'];
					}

					echo implode(", ", $servicedByStringArray);
					?></td>
				<td><?php echo $log['manufacturer_name']; ?></td>
                <td><?php echo $log['model_number']; ?></td>
                <td><?php echo $log['unit_number']; ?></td>
                <td><?php echo $log['entry_type']; ?></td>
                <td><?php echo $log['smr']; ?></td>
                <td><?php echo $log['component_type']; ?></td>
                <td><?php echo $log['component']; ?></td>
                <td><?php echo $log['component_data']; ?></td>
                <td><?php
					if(array_key_exists('fluids_administered', $log)) {
						echo $log['fluid_string'];
					}
					?></td>
                <td>
                    <a href="<?php echo base_url('index.php/reporting/output/screen/service_log_detail/') . $log['id']; ?>"><button type="button" class="btn btn-sm btn-primary" title="View Detail"><i class="fas fa-eye" style="color:#fff !important;"></i></button></a>
                    
                    <?php if($_SESSION['role']==='admin') { ?>
                    <a href="<?php echo base_url('index.php/app/log_entry?id=') . $log['id']; ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit Service Log"><i class="far fa-edit" style="color:#fff !important;"></i></button></a>
                    
                    <a href="#"><button data-servicelogid="<?php echo $log['id']; ?>" type="button" class="deleteServiceLog btn btn-sm btn-primary" title="Delete"><i class="fas fa-trash" style="color:#fff !important;"></i></button></a>
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
                    fields = ['date_entered', 'entered_by', 'serviced_by', 'manufacturer_name', 'model_number', 'unit_number', 'entry_type', 'component_type', 'component', 'component_data'];
                    break;

                case 'Fluid Entry':
                    fields = ['date_entered', 'entered_by', 'serviced_by', 'manufacturer_name', 'model_number', 'unit_number', 'entry_type', 'fluid_type'];
                    break;

                case 'SMR Update':
                    fields = ['date_entered', 'entered_by', 'serviced_by', 'manufacturer_name', 'model_number', 'unit_number', 'entry_type', 'smr'];
                    break;
                    
                case 'PM Service':
                default:
                    fields = ['date_entered', 'entered_by', 'serviced_by', 'manufacturer_name', 'model_number', 'unit_number', 'entry_type'];
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

        function getURLParam(paramName) {
			var urlString = window.location.href;
			var url = new URL(urlString);

			return url.searchParams.get(paramName);
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

        function selectDTEntryType(entryType) {
			$("#serviceLogsReport > tfoot > tr > th:nth-child(7) > select").val(entryType);

		}

		function adjustDTColumnsByEntryType(entryType) {
			switch (entryType) {
				case 'SMR Update':
					dataTable.column(7).visible(true); // SMR
					dataTable.column(8).visible(false); // Component Type
					dataTable.column(9).visible(false); // Component
					dataTable.column(10).visible(false); // Component Data
					dataTable.column(11).visible(false); // Type of Fluid
					break;

				case 'Component Change':
					dataTable.column(7).visible(false); // SMR
					dataTable.column(8).visible(true); // Component Type
					dataTable.column(9).visible(true); // Component
					dataTable.column(10).visible(true); // Component Data
					dataTable.column(11).visible(false); // Type of Fluid
					break;

				case 'Fluid Entry':
					dataTable.column(7).visible(false); // SMR
					dataTable.column(8).visible(false); // Component Type
					dataTable.column(9).visible(false); // Component
					dataTable.column(10).visible(false); // Component Data
					dataTable.column(11).visible(true); // Type of Fluid
					break;

				default:
					dataTable.column(7).visible(false); // SMR
					dataTable.column(8).visible(false); // Component Type
					dataTable.column(9).visible(false); // Component
					dataTable.column(10).visible(false); // Component Data
					dataTable.column(11).visible(false); // Type of Fluid
					break;
			}
		}
        
        var dataTable = $('#serviceLogsReport').DataTable({
            /* Disable initial sort */
            "aaSorting": [],
			// "columnDefs" : [{
			// 	"targets": [1],
			// 	"visible": false,
			// }],
            responsive: true,
            initComplete: function () {
				// var dateEnteredStarting = $("#date_entered_starting").val();
				// var dateEnteredEnding = $("#date_entered_ending").val();

				// var iStartDateCol = 6;
				// var iEndDateCol = 7;
				//
				// iFini=iFini.substring(6,10) + iFini.substring(3,5)+ iFini.substring(0,2);
				// iFfin=iFfin.substring(6,10) + iFfin.substring(3,5)+ iFfin.substring(0,2);
				//
				// var datofini=aData[iStartDateCol].substring(6,10) + aData[iStartDateCol].substring(3,5)+ aData[iStartDateCol].substring(0,2);
				// var datoffin=aData[iEndDateCol].substring(6,10) + aData[iEndDateCol].substring(3,5)+ aData[iEndDateCol].substring(0,2);
				//
				// if ( iFini === "" && iFfin === "" )
				// {
				// 	return true;
				// }
				// else if ( iFini <= datofini && iFfin === "")
				// {
				// 	return true;
				// }
				// else if ( iFfin >= datoffin && iFini === "")
				// {
				// 	return true;
				// }
				// else if (iFini <= datofini && iFfin >= datoffin)
				//
				// 	return true;
				// }
				// return false;

                this.api().columns().every(function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                        );

                                if(column.index() != 11) {
                                    column
                                            .search(val ? '^' + val + '$' : '', true, false)
                                            .draw();
                                } else {
                                    /* Search for Fluid Entry like val */
                                    column
                                        .search(val ? '^.*' + val + '.*$' : '', true, false)
                                        .draw();
                                }

								if(column.index()==6) {
									adjustDTColumnsByEntryType(val);
                                }
                            });

                    if(column.index() > 0 && column.index() <= 10) {
                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                    } else if(column.index() == 11) {
                        /* Populate dropdown for Fluid Entry filter */
                        column.each(function (d, j) {
                            $.each(fluidTypes, function(key, value) {
                                select.append('<option value="' + key + '">' + value + '</option>');
                            });
                        } );
                    } else if(column.index() == 0 || column.index() == 12) {
						select.hide();
					}

					// if(column.index() == 0) {
                    	// $("#date_entered_starting").on('change', function() {
					// 		column
					// 			.search(val ? '^.*01/03/2018.*$' : '', true, false)
					// 			.draw();
					// 		console.log("CHANGE START DATE " + $(this).val());
					// 	});
                    //
                    	// $("#date_entered_ending").on('change', function() {
					// 		column
					// 			.search(val ? '^.*' + val + '.*$' : '', true, false)
					// 			.draw();
					// 		console.log("CHANGE END DATE " + $(this).val());
					// 	});
					// }

					if(column.index() == 0) {
						var dateRangeFieldStarting = '<div class="input-group date">' +
							'<div class="input-group-addon">' +
							'<i class="far fa-calendar-alt fa-2x"></i></div>' +
							'<div><input id="date_entered_starting" name="date_entered_starting" value="<?php echo $dateEnteredStarting; ?>" size="8"></div>';

						var dateRangeFieldEnding = '<div class="input-group date">' +
							'<div class="input-group-addon">' +
							'<i class="far fa-calendar-alt fa-2x"></i></div>' +
							'<div><input id="date_entered_ending" name="date_entered_ending" value="<?php echo $dateEnteredEnding; ?>" size="8"></div>';

						var input1 = $(dateRangeFieldStarting)
							.appendTo($(column.footer()))
							.on('change', function () {

								// var tableEnteredOn = $.fn.dataTable.util.escapeRegex(
								// 	$(this).val()
								// );
								var dateEnteredStarting = $("#date_entered_starting").val();
								var dateEnteredEnding = $("#date_entered_ending").val();
								// var tableEnteredOn = data[0];

								// console.log("###");
								column.data().each(function (thisDateEntered, j) {
									// thisDateEntered

									console.log("~-~-~-");
									console.log(moment(thisDateEntered, 'MM/DD/YY'));
									console.log(moment(dateEnteredStarting, 'MM/DD/YY'));
									console.log(moment(dateEnteredEnding, 'MM/DD/YY'));

									console.log(moment(dateEnteredStarting).isSameOrAfter(thisDateEntered));
									console.log(moment(dateEnteredEnding).isSameOrBefore(thisDateEntered));

									// if(moment(thisDateEntered, 'MM/DD/YY').isSameOrAfter(dateEnteredStarting, 'MM/DD/YY')) {
									// 	column.draw();
									// }
								});
								// console.log(column.data());
								// console.log(dateEnteredStarting);
								// console.log(dateEnteredEnding);

						// 		var val = $("#date_entered_starting").val();
                        //
						// 		var val2 = $.fn.dataTable.util.escapeRegex(
						// 			$("#date_entered_starting").val()
						// 		);
                        //
						// 		console.log("val: " + val);
						// 		console.log("val2: " + val2);
                        //
						// 		var isBefore =
                        //
						// 		// moment('2010-10-20').isSameOrBefore('2010-10-21');
						// 		// moment('2010-10-20').isSameOrAfter('2010-10-21');
                        //
						// 		column
						// 			.search(val ? '^' + val + '$' : '', true, false)
						// 			.draw();
                        //
						// 		console.log(val);
							});
                        //
						var input2 = $(dateRangeFieldEnding)
							.appendTo($(column.footer()))
							.on('change', function () {
						// 		var val = $("#date_entered_ending").val();
                        //
						// 		column
						// 			.search(val ? '^' + val + '$' : '', true, false)
						// 			.draw();
                        //
						// 		console.log(val);
							});

						//var dateRangeFields = '<div class="input-group date">' +
						//	'<div class="input-group-addon">' +
						//	'<i class="far fa-calendar-alt fa-2x"></i></div>' +
						//	'<div><input id="date_entered_starting" name="date_entered_starting" value="<?php //echo $dateEnteredStarting; ?>//" size="8"></div>' +
						//	'<div class="input-group date">' +
						//	'<div class="input-group-addon">' +
						//	'<i class="far fa-calendar-alt fa-2x"></i></div>' +
						//	'<div><input id="date_entered_ending" name="date_entered_ending" value="<?php //echo $dateEnteredEnding; ?>//" size="8"></div>';

						// $("#serviceLogsReport > tfoot > tr > th:nth-child(1)").html(dateRangeFields);
					}
                });
            },
            "order": [],
            "columns": [
				{"width": "150px"},
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
                {"orderable": false}
            ]
        });

        dataTable.column(7).visible(false); // SMR
        dataTable.column(8).visible(false); // Component Type
        dataTable.column(9).visible(false); // Component
        dataTable.column(10).visible(false); // Component Data
        dataTable.column(11).visible(false); // Type of Fluid

		var entryType = getURLParam("data[entry_type]");

		adjustDTColumnsByEntryType(entryType);
		selectDTEntryType(entryType);

		$('#date_entered_starting').datepicker({
			autoclose: true,
			dateFormat: 'mm/dd/yyyy'
		});

		$('#date_entered_ending').datepicker({
			autoclose: true,
			dateFormat: 'mm/dd/yyyy'
		});
    });

	// $.fn.dataTable.ext.search.push(
	// 	function( settings, data, dataIndex ) {
	// 		var dateEnteredStarting = $("#date_entered_starting").val();
	// 		var dateEnteredEnding = $("#date_entered_ending").val();
	// 		var tableEnteredOn = data[0];
    //
	// 		// dateEnteredStarting = (dateEnteredStarting == '') ? -1 : moment(dateEnteredStarting, 'MM/DD/YY');
	// 		// dateEnteredEnding = (dateEnteredEnding == '') ? -1 : moment(dateEnteredEnding, 'MM/DD/YY');
    //
    //
	// 		console.log("@");
	// 		console.log(tableEnteredOn);
	// 		console.log(dateEnteredStarting);
	// 		console.log(dateEnteredEnding);
    //
	// 		// var tableEndDate = (data[5] == '--') ? 1 : data[5];
    //
	// 		// console.log("-------------");
	// 		// console.log("data[0]: " + data[0]);
	// 		// console.log("dateEnteredStarting: " + dateEnteredStarting);
	// 		// moment('2010-10-20').isSameOrBefore('2010-10-21')
	// 		// moment("12-25-1995", "MM-DD-YYYY");
    //
	// 		// console.log(moment('01/03/18', 'MM/DD/YY').isSameOrBefore('2018-02-01'));
    //
	// 		// console.log(dateEnteredStarting);
	// 		// console.log(moment(dateEnteredStarting, 'MM/DD/YY').valueOf());
	// 		// console.log(dateEnteredEnding);
	// 		// console.log(moment(dateEnteredEnding, 'MM/DD/YY').valueOf());
	// 		// console.log(tableEnteredOn);
    //
	// 		//Show all rows if start and end date is not selected
	// 		if($("#date_entered_starting").empty() && $("#date_entered_ending").empty()) {
	// 			return true;
	// 		}
    //
	// 		if(tableEnteredOn.isSameOrAfter(dateEnteredStarting)) {
	// 			if($("#date_entered_ending").empty()) {
	// 				console.log("A");
	// 				return true;
	// 			}
    //
	// 			if(tableEnteredOn.isSameOrBefore(dateEnteredEnding)) {
	// 				console.log("B");
	// 				return true;
	// 			}
    //
	// 			console.log("C");
	// 			return false;
	// 		}
	// 		console.log("D");
	// 		return false;
    //
	// 		// if(tableEnteredOn >= dateEnteredStarting) {
	// 		// 	if(dateEnteredEnding == -1) {
	// 		// 		return true;
	// 		// 	}
	// 		//
	// 		// 	if(tableEnteredOn != 1 && tableEnteredOn <= dateEnteredEnding){
	// 		// 		return true;
	// 		// 	}
	// 		// 	return false;
	// 		// }
	// 		// return false;
	// 	}
	// );
</script>
