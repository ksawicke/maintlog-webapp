<h3>Fuel Used Report</h3>

<a id="downloadReportServiceLogs"
   href="<?php echo base_url('index.php/reporting/output/spreadsheet/fuel_used'); ?>"
   class="buttonLink nounderline">

	<button type="button" class="btn btn-primary"><img
			class="excelIconMargin"
			src="<?php echo base_url('/assets/templates/komatsuna/img/excel_logo_24x24.png'); ?>">&nbsp;&nbsp;Download
		Report in Excel</button>

</a>

<br /><br />

<table id="fuelUsedReport" class="table table-bordered table-striped" width="100%">
	<thead>
	<tr>
		<th>Date Entered</th>
		<th>Fluid Type</th>
		<th>Amount Used</th>
		<th>Actions</th>
	</tr>
	</thead>
	<tfoot>
	<tr>
		<th>Date Entered</th>
		<th>Fluid Type</th>
		<th>Amount Used</th>
		<th>Actions</th>
	</tr>
	</tfoot>
	<tbody>
	</tbody>
</table>
