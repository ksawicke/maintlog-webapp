<h3>SMR / Miles / Time Used Report</h3>

<div class="alert alert-warning alert-dismissible" id="editing_service_log">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h4><i class="icon fa fa-exclamation-triangle"></i> This report is coming soon.</h4>
</div>

<?php //echo '<pre>';
//var_dump($smrUsed);
//echo '</pre>';
//exit();
//?>

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
			<th>Model Number</th>
			<th>Unit Number</th>
			<th>Track Type</th>
			<th>Beginning SMR/Miles/Time Used</th>
			<th>End SMR/Miles/Time Used</th>
			<th>Total SMR/Miles/Time Used</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Date Entered</th>
			<th>Equipment Type</th>
			<th>Manufacturer Name</th>
			<th>Model Number</th>
			<th>Unit Number</th>
			<th>Track Type</th>
			<th>Beginning SMR/Miles/Time Used</th>
			<th>End SMR/Miles/Time Used</th>
			<th>Total SMR/Miles/Time Used</th>
		</tr>
		</tfoot>
	<tbody>
	<?php foreach ($smrUsed as $suctr => $smrData) { ?>
		<?php $total = ($smrData['max_smr'] - $smrData['min_smr']); ?>
		<tr>
			<td><?php echo date('m/d/Y', strtotime($smrData['date_entered'])); ?></td>
			<td><?php echo $smrData['equipment_type']; ?></td>
			<td><?php echo $smrData['manufacturer_name']; ?></td>
			<td><?php echo $smrData['model_number']; ?></td>
			<td><?php echo $smrData['unit_number']; ?></td>
			<td><?php echo $smrData['track_type']; ?></td>
			<td><?php echo $smrData['min_smr']; ?></td>
			<td><?php echo $smrData['max_smr']; ?></td>
			<td><?php echo $total; ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
