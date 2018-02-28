<form id="addChecklist" action="<?php echo base_url('index.php/checklists/save'); ?>" method="post">

	<div class="group mainFlow">
<!--		<div class="form-group">-->
<!--			<label for="category" class="control-label lb-lg">Category</label>-->
<!--			<input type="text" id="category" name="category" class="form-control input-lg" value="--><?php //echo $checklist_category_id; ?><!--">-->
<!--		</div>-->

		<label for="equipment_type" class="control-label lb-lg">Equipment Type</label>
		<select id="equipment_type"
				name="equipment_type"
				class="form-control input-lg"
				data-parsley-required="true"
				data-parsley-error-message="Please select the Equipment Type"
				data-parsley-errors-container=".equipment_type_errors">
			<option value="">Select one:</option>
			<?php foreach($equipmenttypes as $equipmenttype) { ?>
				<option value="<?php echo $equipmenttype->id; ?>"<?php echo ($checklist_equipmenttype_id==$equipmenttype->id ? ' selected' : ''); ?>><?php echo $equipmenttype->equipment_type; ?></option>
			<?php } ?>
		</select>
	</div>

	<div class="row">
		<div class="col-sm-4 col-md-4 col-lg-4">
			<br />
			<strong>Pre-Start</strong>
			<ul id="preStartSortableItemList" class="preStart connectedSortable">
			</ul>
		</div>
		<div class="col-sm-4 col-sm-4 col-lg-4">
			<br />
			<strong>Available Items</strong>
			<ul id="availableItemSortableItemList" class="connectedSortable">
			</ul>
		</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<br />
			<strong>Post-Start</strong>
			<ul id="postStartSortableItemList" class="postStart connectedSortable">
			</ul>
		</div>
	</div>

	<input type="hidden" id="checklist_id" name="checklist_id" value="<?php echo $checklist_id; ?>">

	<button id="btnSubmit" type="submit" class="btn btn-lg btn-primary" disabled>Submit</button>

</form>

<script>

	$(function () {

		$("#preStartSortableItemList, #availableItemSortableItemList, #postStartSortableItemList").sortable({
			connectWith: ".connectedSortable",
			update: function( event, ui ) {
				console.log("Something changed...");
				console.log(event);
				console.log(ui);

				var sorted = $( ".preStart" ).sortable( "serialize", { key: "sort" } );
				var sortedIds = $( ".preStart" ).sortable( "toArray" );

				var sorted2 = $( ".postStart" ).sortable( "serialize", { key: "sort" } );
				var sortedIds2 = $( ".postStart" ).sortable( "toArray" );

				console.log(sorted);
				console.log(sortedIds);

				console.log(sorted2);
				console.log(sortedIds2);
			}
		}).disableSelection();

		function loadEmUp() {
			for(i=1; i <= 10; i++) {
				$("#availableItemSortableItemList").append('<li class="ui-state-highlight" id="' + i + '">Item ' + i + '</li>');
			}
		}

		loadEmUp();

	});

</script>
