<form id="addChecklist" class="parsley-form" action="<?php echo base_url('index.php/checklists/save'); ?>" method="post" data-parsley-validate="">

	<div class="form-group">
		<label for="equipmenttype_id" class="control-label lb-lg">Equipment Type</label>
		<select id="equipmenttype_id"
				name="equipmenttype_id"
				class="form-control input-lg"
				data-parsley-required="true"
				data-parsley-error-message="Please select the Equipment Type"
				data-parsley-errors-container=".equipmenttype_id_errors">
			<option value="">Select one:</option>
			<?php foreach($equipmenttypes as $ctr => $equipmenttype) { ?>
				<option value="<?php echo $equipmenttype['id']; ?>"<?php echo ($checklist_equipmenttype_id==$equipmenttype['id'] ? ' selected' : ''); ?>><?php echo $equipmenttype['equipment_type'] ; ?></option>
			<?php } ?>
		</select>
		<p class="form-error equipmenttype_id_errors"></p>

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
		<div class="col-sm-4 col-sm-4 col-lg-4">
			<label for="availableItemSortableItemList" class="control-label lb-lg">Available Items</label>
			<ul id="availableItemSortableItemList" class="connectedSortable">
			</ul>
		</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="preStartSortableItemList" class="control-label lb-lg">Pre-Start</label>
			<ul id="preStartSortableItemList" class="preStartSelected connectedSortable">
			</ul>
		</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="postStartSortableItemList" class="control-label lb-lg">Post-Start</label>
			<ul id="postStartSortableItemList" class="postStartSelected connectedSortable">
			</ul>
		</div>
	</div>
	<p class="form-error checklistitemspopulated_errors"></p>

	<input type="hidden" id="checklist_id" name="checklist_id" value="<?php echo $checklist_id; ?>">
	<input type="hidden"
		   id="checklist_json"
		   name="checklist_json"
		   data-parsley-checklistitemspopulated=""
		   data-parsley-error-message="Make sure you select at least one item for the Pre-Start and Post-Start checklists."
		   data-parsley-errors-container=".checklistitemspopulated_errors"
		   value='<?php echo $checklist_json; ?>'>

	<button id="btnSubmit" type="submit" class="btn btn-lg btn-primary">Submit</button>

</form>

<script>

	$(document).ready(function () {

		var getChecklistItemUrl = '<?php echo base_url(); ?>index.php/checklistitems/getChecklistItems/<?php echo $checklist_equipmenttype_id; ?>';

		function updateChecklistJson(object, checklist_json) {
			if(object[0].id!='availableItemSortableItemList') {
				$("#checklist_json").val(checklist_json);

				console.log(checklist_json);
			}
		}

		function getChecklistItems() {
			var getChecklistItemsPromise = $.ajax({
				url: getChecklistItemUrl,
				type: "POST",
				dataType: "json",
				data: JSON.stringify({}),
				contentType: "application/json"
			});

			$.when(getChecklistItemsPromise).done(function(object) {
				return object.data;
			});
		}

		function populateAvailableItems() {
			var checklist_json = '{"preStartData":[],"postStartData":[]}';

			$.ajax({
				url: getChecklistItemUrl,
				type: "POST",
				dataType: "json",
				data: JSON.stringify({}), // no need to send data, just get it
				contentType: "application/json"
			}).done(function(object) {
				fillAvailableItemList(object.data);
				fillPreStartList(object.data);
				fillPostStartList(object.data);

				if(object.data.checklist.length !== 'undefined') {
					checklist_json = JSON.stringify(object.data.checklist);
					$("#checklist_json").val(checklist_json);
				}

				console.log($("#checklist_json").val());
			});
		}

		function fillAvailableItemList(data) {
			console.log("AVAILABLE LIST");
			console.log(data);
			$.each( data.checklistitemsremaining, function( key, value ) {
				$("#availableItemSortableItemList").append('<li class="ui-state-highlight" id="' + value.id + '"><i class="fas fa-arrows-alt" style="color:#555 !important;"></i>&nbsp;&nbsp;' + value.item + '</li>');
			});
		}

		function fillPreStartList(data) {
			console.log("PRESTART LIST");
			console.log(data);
			$.each( data.preStartItems, function( key, value ) {
				$("#preStartSortableItemList").append('<li class="ui-state-highlight" id="' + value.id + '">' + value.item + '</li>');
			});
		}

		function fillPostStartList(data) {
			console.log("POSTSTART LIST");
			console.log(data);
			$.each( data.postStartItems, function( key, value ) {
				$("#postStartSortableItemList").append('<li class="ui-state-highlight" id="' + value.id + '">' + value.item + '</li>');
			});
		}

		$("#preStartSortableItemList, #availableItemSortableItemList, #postStartSortableItemList").sortable({
			connectWith: ".connectedSortable",
			update: function( event, ui ) {
				var preStartData = $(".preStartSelected").sortable( "toArray" );
				var postStartData = $(".postStartSelected").sortable( "toArray" );
				var checklist_json = JSON.stringify({preStartData: preStartData, postStartData: postStartData});

				updateChecklistJson($(this), checklist_json);
			},
			beforeStop: function( event, ui ) {
				var preStartData = $(".preStartSelected").sortable( "toArray" );
				var postStartData = $(".postStartSelected").sortable( "toArray" );
				var checklist_json = JSON.stringify({preStartData: preStartData, postStartData: postStartData});

				updateChecklistJson($(this), checklist_json);
			},
			start: function (ev, ui) {
				let scrollTop = $(window).scrollTop();
				if (scrollTop > 0) {
					ui.helper.css('margin-top', scrollTop);
				}
			},
			stop: function (ev, ui) {
				ui.item.css('margin-top', 0);
			}
		}).disableSelection();

		$("#preStartSortableItemList, #availableItemSortableItemList, #postStartSortableItemList").draggable({
			appendTo: 'body'
		});

		window.Parsley.addValidator('checklistitemspopulated', function (value, requirement) {
			var response = false;

			return response;
		}, 32)
			.addMessage('en', 'checklist_json', '!!');

		populateAvailableItems();
	});

</script>
