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

	<br />

	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-info">
				<h4><i class="icon fa fa-info-circle"></i> Note:</h4>
				Click and drag items in the order you need under Pre-Start and Post-Start
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="preStartSortableItemList" class="control-label lb-lg">Pre-Start</label>
			<ul id="preStartSortableItemList" class="preStartSelected connectedSortable">
			</ul>
		</div>
		<div class="col-sm-4 col-sm-4 col-lg-4">
			<label for="availableItemSortableItemList" class="control-label lb-lg">Available Items</label>
			<ul id="availableItemSortableItemList" class="connectedSortable">
			</ul>
		</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="postStartSortableItemList" class="control-label lb-lg">Post-Start</label>
			<ul id="postStartSortableItemList" class="postStartSelected connectedSortable">
			</ul>
		</div>
	</div>

	<input type="hidden" id="checklist_id" name="checklist_id" value="<?php echo $checklist_id; ?>">
	<input type="hidden" id="checklist_json" name="checklist_json" value='<?php echo $checklist_json; ?>'>

	<button id="btnSubmit" type="submit" class="btn btn-lg btn-primary" disabled>Submit</button>

</form>

<script>

	$(function () {

		function updateChecklistJson(object, checklist_json) {
			if(object[0].id!='availableItemSortableItemList') {
				$("#checklist_json").val(checklist_json);
				console.log($("#checklist_json").val());
			}
		}

		function populateAvailableItems() {
			for(i=1; i <= 10; i++) {
				$("#availableItemSortableItemList").append('<li class="ui-state-highlight" id="' + i + '">Item ' + i + '</li>');
			}
		}

		$("#preStartSortableItemList, #availableItemSortableItemList, #postStartSortableItemList").sortable({
			connectWith: ".connectedSortable",
			update: function( event, ui ) {
				var preStartData = $(".preStartSelected").sortable( "toArray" );
				var postStartData = $(".postStartSelected").sortable( "toArray" );
				var checklist_json = JSON.stringify({preStartData: preStartData, postStartData: postStartData});

				updateChecklistJson($(this), checklist_json);
			}
		}).disableSelection();

		populateAvailableItems();
	});

</script>
