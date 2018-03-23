<h3>SMR / Miles / Time Used Report</h3>

<a id="downloadReportSMRUsed"
   href="<?php echo base_url('index.php/reporting/output/spreadsheet/smr_used'); ?>"
   class="buttonLink nounderline">

	<button type="button" class="btn btn-primary"><img
			class="excelIconMargin"
			src="<?php echo base_url('/assets/templates/komatsuna/img/excel_logo_24x24.png'); ?>">&nbsp;&nbsp;Download
		Report in Excel</button>

</a>

<br /><br />

<table id="smrUsedReport" class="table table-bordered table-striped" width="100%">
	<thead>
	<tr>
		<th>Date Entered</th>
		<th>Equipment Type</th>
		<th>Manufacturer Name</th>
		<th>Model Name</th>
		<th>Unit Number</th>
		<th>Units Tracked</th>
		<th>Beginning SMR/Miles/Time Used</th>
		<th>End SMR/Miles/Time Used</th>
		<th>Total SMR/Miles/Time Used</th>
		<th>Actions</th>
	</tr>
	</thead>
	<tfoot>
	<tr>
		<th>Date Entered</th>
		<th>Equipment Type</th>
		<th>Manufacturer Name</th>
		<th>Model Name</th>
		<th>Unit Number</th>
		<th>Units Tracked</th>
		<th>Beginning SMR/Miles/Time Used</th>
		<th>End SMR/Miles/Time Used</th>
		<th>Total SMR/Miles/Time Used</th>
		<th>Actions</th>
	</tr>
	</tfoot>
	<tbody>
	</tbody>
</table>
