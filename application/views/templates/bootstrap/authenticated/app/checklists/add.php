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
		<div class="col-sm-3 col-md-3 col-lg-3">
			<ul id="sortable1" class="whatMatters connectedSortable">
			</ul>
		</div>
		<div class="col-sm-3 col-sm-3 col-lg-3">
			<ul id="sortable2" class="connectedSortable">
			</ul>
		</div>
	</div>

	<input type="hidden" id="checklist_id" name="checklist_id" value="<?php echo $checklist_id; ?>">

	<button id="btnSubmit" type="submit" class="btn btn-lg btn-primary" disabled>Submit</button>

</form>

<script>

	$(function () {

		$("#sortable1, #sortable2").sortable({
			connectWith: ".connectedSortable",
			change: function( event, ui ) {
				console.log("Something changed...");
				console.log(event);
				console.log(ui);

				var sorted = $( ".whatMatters" ).sortable( "serialize", { key: "sort" } );
				var sortedIds = $( ".whatMatters" ).sortable( "toArray" );

				console.log(sorted);
				console.log(sortedIds);
			}
		}).disableSelection();

		function loadEmUp() {
			for(i=1; i <= 10; i++) {
				$("#sortable2").append('<li class="ui-state-highlight" id="' + i + '">Item ' + i + '</li>');
			}
		}

		loadEmUp();

	});

</script>
