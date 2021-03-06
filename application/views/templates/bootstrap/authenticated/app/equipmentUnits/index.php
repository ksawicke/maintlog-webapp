<a href="<?php echo base_url('index.php/app/addEquipmentUnit'); ?>"><button type="button" class="btn btn-success"><i class="fas fa-plus-square" style="color:#fff !important;"></i>&nbsp;&nbsp;Add Equipment Unit</button></a><br /><br />

<table id="equipmentUnitList" class="table table-bordered table-striped" width="100%">
    <thead>
        <tr>
            <th>Manufacturer & Model</th>
            <th>Unit Number</th>
			<th>QR Code</th>
			<th>Equipment Type</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($equipmentunits as $equipmentunit) {
        	$qrCode = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=" .
				trim($equipmentunit['unit_number']) .
				"&choe=UTF-8";
        	?>
        <tr>
            <td><?php echo $equipmentunit['manufacturer_name'] . " " . $equipmentunit['model_number']; ?></td>
            <td><?php echo $equipmentunit['unit_number']; ?></td>
			<td>
				<?php if(trim($equipmentunit['unit_number'])!="N/A") { ?>
					<a href="<?php echo $qrCode; ?>"><img src="<?php echo $qrCode; ?>" width="100"></a>
				<?php } ?>
			</td>
			<td><?php echo $equipmentunit['equipment_type']; ?></td>
            <td><?php echo ($equipmentunit['active']==1 ? '<i class="fas fa-check" style="color:green !important;"></i>' : '<i class="fas fa-times" style="color:red !important;"></i>'); ?></td>
            <td><a href="<?php echo base_url('index.php/app/addEquipmentUnit/' . $equipmentunit['equipmentunit_id']); ?>"><button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="far fa-edit" style="color:#fff !important;"></i></button></a>&nbsp;<a href="<?php echo base_url('index.php/equipmentunits/delete/' . $equipmentunit['equipmentunit_id']); ?>"><button type="button" class="btn btn-sm btn-primary" title="Delete"><i class="fas fa-trash" style="color:#fff !important;"></i></button></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<style>
#equipmentUnitList td:nth-child(4) {
    text-align : center;
}
</style>

<script>
  $(document).ready(function() {
    $('#equipmentUnitList').DataTable({
        responsive: true,
        "columns": [
			{"orderable": false, "class": "text-center"},
			{"orderable": false, "class": "text-center"},
			{"orderable": false, "class": "text-center"},
			{"orderable": false, "class": "text-center"},
            {"width": "60px", "class": "text-center", "orderable": false},
            {"width": "100px", "orderable": false}
        ]
    });
//    $('#example2').DataTable({
//      'paging'      : true,
//      'lengthChange': false,
//      'searching'   : false,
//      'ordering'    : true,
//      'info'        : true,
//      'autoWidth'   : false
//    });
  });
</script>
