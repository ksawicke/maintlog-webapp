<form class="serviceLog-form parsley-form">
	<div class="form-section show-next">
		<label for="date_entered" class="control-label lb-lg">Date Entered</label>
		<div class="input-group date">
			<div class="input-group-addon">
				<i class="far fa-calendar-alt fa-2x"></i>
			</div>
			<input id="date_entered"
				   name="date_entered"
				   type="text"
				   class="form-control input-lg"
				   value=""
				   data-parsley-required="true"
				   data-parsley-pattern="/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/"
				   data-parsley-pattern-message="Date must be in MM/DD/YYYY format"
				   data-parsley-errors-container=".date_entered_errors">
		</div>
		<p class="form-error date_entered_errors"></p>
	</div>

	<div class="form-section show-prev show-next">
		<label for="entered_by" class="control-label lb-lg">Entered By</label><img id="loading_entered_by" src="<?php echo base_url(); ?>assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
		<select id="entered_by"
				name="entered_by"
				class="form-control input-lg"
				data-parsley-required="true"
				data-parsley-error-message="Please select who entered the record"
				data-parsley-errors-container=".entered_by_errors">
		</select>
		<p class="form-error entered_by_errors"></p>

		<label for="checked_by" class="control-label lb-lg">Checked By</label><img id="loading_checked_by" src="<?php echo base_url(); ?>assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
		<select id="checked_by"
				name="checked_by"
				class="form-control input-lg"
				multiple
				data-parsley-required="true"
				data-parsley-mincheck="1"
				data-parsley-error-message="Please select at least one person who performed the checkup"
				data-parsley-errors-container=".checked_by_errors">
		</select>
		<p class="form-error checked_by_errors"></p>
	</div>

	<div class="form-section show-prev show-next">

		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">

				<label for="equipment_type" class="control-label lb-lg">Equipment Type</label>
				<select id="equipment_type"
						name="equipment_type"
						class="form-control input-lg"
						data-parsley-required="true"
						data-parsley-error-message="Please select the Equipment Type"
						data-parsley-errors-container=".equipment_type_errors">
					<option value="">Select one:</option>
					<?php foreach($equipmenttypes as $equipmenttype) { ?>
						<option value="<?php echo $equipmenttype->id; ?>"><?php echo $equipmenttype->equipment_type; ?></option>
					<?php } ?>
				</select>

				<label for="equipmentmodel_id" class="control-label lb-lg">Equipment Model</label><img id="loading_equipmentmodel_id" src="<?php echo base_url(); ?>assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
				<select id="equipmentmodel_id"
						name="equipmentmodel_id"
						class="form-control input-lg"
						data-parsley-required="true"
						data-parsley-error-message="Please select the Equipment Model"
						data-parsley-errors-container=".equipmentmodel_id_errors"
						disabled>
				</select>

				<label for="unit_number" class="control-label lb-lg">Unit Number</label><img id="loading_unit_number" src="<?php echo base_url(); ?>assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
				<select id="unit_number"
						name="unit_number"
						class="form-control input-lg"
						data-parsley-required="true"
						data-parsley-error-message="Please select the Unit Number"
						data-parsley-errors-container=".unit_number_errors"
						disabled>
				</select>

			</div>
		</div>

	</div>

	<div class="form-section show-prev show-next">
		<label for="left_front_tire" class="control-label lb-lg">Left Front Tire</label>
		<div>

			<div class="inspection-button button_good left_front_tire item-notmarked text-center pa4 white" data-item="left_front_tire" data-inspection-status="good">
				<svg aria-hidden="true" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg"
					 viewBox="0 0 512 512" class="svg-inline--fa fa-check fa-w-16 fa-5x">
					<path fill="currentColor"
						  d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"
						  class=""></path>
				</svg>
			</div>

			<br />

			<div class="inspection-button button_bad left_front_tire item-notmarked text-center pa4 white" data-item="left_front_tire" data-inspection-status="bad">
				<svg aria-hidden="true" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg"
					 viewBox="0 0 384 512" class="svg-inline--fa fa-times fa-w-12 fa-5x">
					<path fill="currentColor"
						  d="M323.1 441l53.9-53.9c9.4-9.4 9.4-24.5 0-33.9L279.8 256l97.2-97.2c9.4-9.4 9.4-24.5 0-33.9L323.1 71c-9.4-9.4-24.5-9.4-33.9 0L192 168.2 94.8 71c-9.4-9.4-24.5-9.4-33.9 0L7 124.9c-9.4 9.4-9.4 24.5 0 33.9l97.2 97.2L7 353.2c-9.4 9.4-9.4 24.5 0 33.9L60.9 441c9.4 9.4 24.5 9.4 33.9 0l97.2-97.2 97.2 97.2c9.3 9.3 24.5 9.3 33.9 0z"
						  class=""></path>
				</svg>
			</div>

			<label for="left_front_tire_problem_note" class="control-label lb-lg">Notes</label>
			<textarea type="text"
					  id="left_front_tire_problem_note"
					  name="left_front_tire_problem_note"
					  class="form-control input-lg"
					  value=""></textarea>
		</div>
	</div>

	<div class="form-section show-prev show-next">
		<label for="left_rear_tire" class="control-label lb-lg">Left Rear Tire</label>
		<div>

			<div class="inspection-button button_good left_rear_tire item-notmarked text-center pa4 white" data-item="left_rear_tire" data-inspection-status="good">
				<svg aria-hidden="true" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg"
					 viewBox="0 0 512 512" class="svg-inline--fa fa-check fa-w-16 fa-5x">
					<path fill="currentColor"
						  d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"
						  class=""></path>
				</svg>
			</div>

			<br />

			<div class="inspection-button button_bad left_rear_tire item-notmarked text-center pa4 white" data-item="left_rear_tire" data-inspection-status="bad">
				<svg aria-hidden="true" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg"
					 viewBox="0 0 384 512" class="svg-inline--fa fa-times fa-w-12 fa-5x">
					<path fill="currentColor"
						  d="M323.1 441l53.9-53.9c9.4-9.4 9.4-24.5 0-33.9L279.8 256l97.2-97.2c9.4-9.4 9.4-24.5 0-33.9L323.1 71c-9.4-9.4-24.5-9.4-33.9 0L192 168.2 94.8 71c-9.4-9.4-24.5-9.4-33.9 0L7 124.9c-9.4 9.4-9.4 24.5 0 33.9l97.2 97.2L7 353.2c-9.4 9.4-9.4 24.5 0 33.9L60.9 441c9.4 9.4 24.5 9.4 33.9 0l97.2-97.2 97.2 97.2c9.3 9.3 24.5 9.3 33.9 0z"
						  class=""></path>
				</svg>
			</div>

			<label for="left_rear_tire_problem_note" class="control-label lb-lg">Notes</label>
			<textarea type="text"
					  id="left_rear_tire_problem_note"
					  name="left_rear_tire_problem_note"
					  class="form-control input-lg"
					  value=""></textarea>
		</div>
	</div>

	<div class="form-section show-prev show-next">
		<label for="right_front_tire" class="control-label lb-lg">Right Front Tire</label>
		<div>

			<div class="inspection-button button_good right_front_tire item-notmarked text-center pa4 white" data-item="right_front_tire" data-inspection-status="good">
				<svg aria-hidden="true" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg"
					 viewBox="0 0 512 512" class="svg-inline--fa fa-check fa-w-16 fa-5x">
					<path fill="currentColor"
						  d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"
						  class=""></path>
				</svg>
			</div>

			<br />

			<div class="inspection-button button_bad right_front_tire item-notmarked text-center pa4 white" data-item="right_front_tire" data-inspection-status="bad">
				<svg aria-hidden="true" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg"
					 viewBox="0 0 384 512" class="svg-inline--fa fa-times fa-w-12 fa-5x">
					<path fill="currentColor"
						  d="M323.1 441l53.9-53.9c9.4-9.4 9.4-24.5 0-33.9L279.8 256l97.2-97.2c9.4-9.4 9.4-24.5 0-33.9L323.1 71c-9.4-9.4-24.5-9.4-33.9 0L192 168.2 94.8 71c-9.4-9.4-24.5-9.4-33.9 0L7 124.9c-9.4 9.4-9.4 24.5 0 33.9l97.2 97.2L7 353.2c-9.4 9.4-9.4 24.5 0 33.9L60.9 441c9.4 9.4 24.5 9.4 33.9 0l97.2-97.2 97.2 97.2c9.3 9.3 24.5 9.3 33.9 0z"
						  class=""></path>
				</svg>
			</div>

			<label for="right_front_tire_problem_note" class="control-label lb-lg">Notes</label>
			<textarea type="text"
					  id="right_front_tire_problem_note"
					  name="right_front_tire_problem_note"
					  class="form-control input-lg"
					  value=""></textarea>
		</div>
	</div>

	<div id="reviewScreen">
		Review....
	</div>
	<span class="clearfix"></span>

	<div class="form-navigation">
		<button id="goBackButton" type="button" class="prev btn btn-lg btn-primary">&laquo; Prev</button>
		<button id="goForwardButton" type="button" class="next btn btn-lg btn-primary">Next &raquo;</button>
		<button id="reviewButton" type="button" class="next btn btn-lg btn-primary">Review &raquo;</button>
		<button id="submitButton" type="button" class="next btn btn-lg btn-primary">Submit</button>
	</div>

	<span class="clearfix"></span>

</form>

<style type="text/css">
	#editing_service_log,
	#goBackButton,
	#reviewButton,
	#submitButton,
	#reviewScreen {
		display: none;
	}
	.form-section {
		display: none;
	}
	.form-section.current {
		display: inherit;
	}
	.btn-info, .btn-default, .btn {
		margin-top: 10px;
	}
	.form-error {
		padding-top:5px;
		font-weight: bold;
		color: red;
	}
	.hide_me,
	.hideButton {
		display: none;
	}
</style>

<script type="text/javascript">
	$(function () {
		var $sections = $('.form-section'),
			subflowSelected = false,
			currentSubflow = '',
			subflowIndex = 0,
			initialPassCompleted = false,
			atTheEnd = false,
			atReview = false;

		/** Handle pop up content **/
		var windowWidth = $(window).width(),
			dialogWidth = windowWidth * 0.4,
			windowHeight = $(window).height(),
			dialogHeight = windowHeight * 0.4;

		var confirmationMessage = '<div class="jBoxContentBodyText">Are you sure you want to submit this log?<br /><br /><button id="cancelSubmitLogEntryForm" type="button">No</button>&nbsp;&nbsp;&nbsp;<button id="submitLogEntryForm" type="button">Yes</button></div>';
		var confirmSubmitJBox = new jBox('Modal', {
			closeButton: 'title',
			responsiveWidth: true,
			responsiveHeight: true,
			minWidth: dialogWidth,
			minHeight: dialogHeight,
			attach: '#submitButton',
			title: 'Confirm',
			content: confirmationMessage,
			zIndex: 15000,
			preventDefault: true,
			preloadAudio: false
		});

		function resetVars() {
			var subflowSelected = false,
				currentSubflow = '',
				subflowIndex = 0,
				atTheEnd = false,
				atReview = false;
		}

		function goBackAfterReview() {
			$("#reviewScreen").hide();
			$('.form-section').hide();
			$('.form-navigation .next').show();

			atTheEnd = false;
			atReview = false;
			initialPassCompleted = true;

			currentIndex = curIndex();
			prevIndex = currentIndex - 1;

			$sections
				.removeClass('current')
				.eq(prevIndex)
				.addClass('current');
			$('.form-section').eq(prevIndex).show();
		}

		function navigateTo(index) {
			var thisSection = $("div").find("[data-section-index='" + (index) + "']"),
				thisIndex = thisSection.attr('data-section-index');

			var lastSection = $("div").find("[data-section-index='" + (index - 1) + "']");
			var goToIndex = lastSection.attr('data-section-index');

			$('.form-section').removeClass('current');
			$("div").find("[data-section-index='" + index + "']").addClass('current').show();

			if(initialPassCompleted && index===3) {
				setCurrentSubflow();
			}

			if(thisSection.hasClass("show-prev")) {
				$('#goBackButton').show();
			} else {
				$('#goBackButton').hide();
			}

			if(thisSection.hasClass("show-next")) {
				$('#goForwardButton').show();
			} else {
				$('#goForwardButton').hide();
			}

			if(thisSection.hasClass("show-review")) {
				$('#reviewButton').show();
			} else {
				$('#reviewButton').hide();
			}

			// On click the first "Next" button, let's load the user data into the
			// #entered_by and #serviced_by fields. For the #entered_by
			// field, we will pre-select the logged in user, but still allow the
			// user to change the value.
			if(index===1) {
				populateUserData("<?php echo base_url(); ?>index.php/users/getUsers",
					$("#entered_by"));
			}
		}

		function curIndex() {
			// Return the current index by looking at which section has the class 'current'
			return $sections.index($sections.filter('.current'));
		}

		function printReviewScreen() {
			var text = '<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Please review your entries before submitting.</div>';

			var json = getJsonObject(currentSubflow);

			for(var i = 0; i < json.length; i++) {
				var obj = json[i];
				var value = obj.value;

				text += '<label>' + obj.label + '</label><ul>';

				if(obj.value.indexOf("|") >= 0) {
					var splitText = obj.value.split("|");
					for (var i = 0; i < splitText.length; i++) {
						text += '<li>' + splitText[i] + '</li>';
					}
				} else {
					text += '<li>' + value + '</li>';
				}

				text += '</ul>';
			}

			$("#reviewScreen").html(text);
			$("#goBackButton").show();
			$("#submitButton").show();
		}

		function populateUserData(serviceUrl, field) {
			$("#loading_entered_by").show();
			$("#loading_serviced_by").show();

			var jqxhr = $.ajax({
				url: serviceUrl,
				type: "POST",
				dataType: "json",
				data: JSON.stringify({}), // no need to send data, just get it
				contentType: "application/json"
			}).done(function (object) {
				// Clear dropdowns first.
				$('#entered_by').empty();
				$('#entered_by').append('<option value="">Select one:</option>');

				populateEnteredByDropdownWithData(object);
				$("#loading_entered_by").hide();

				populateCheckedByDropdownWithData(object);
				$("#loading_checked_by").hide();
			});
		}

		function populateEnteredByDropdownWithData(object) {
			// var service_log_object = getServiceLogData();

			// Populate dropdown via ajax.
			$.each(object.data, function(id, userData) {
				var id = userData.id,
					value = userData.last_name + ", " + userData.first_name,
					current = userData.current,
					active = userData.active;

				if(active==="1") {
					$('#entered_by').append('<option value="' + id + '"' + (current==='1' ? ' selected' : '') + '>' + value + '</option>');
				}
				// if(active==="1" && !empty(service_log_object)) {
				// 	$('#entered_by').append('<option value="' + id + '"' + (id==service_log_object.entered_by ? ' selected' : '') + '>' + value + '</option>');
				// } else if(active==="1" && empty(service_log_object)) {
				// 	$('#entered_by').append('<option value="' + id + '"' + (current==='1' ? ' selected' : '') + '>' + value + '</option>');
				// }
			});
		}

		function populateCheckedByDropdownWithData(object) {
			// var service_log_object = getServiceLogData();

			// Populate multiselect using loaded object.
			$.each(object.data, function(id, userData) {
				var id = userData.id,
					display = userData.last_name + ", " + userData.first_name,
					email_address = userData.email_address,
					current = userData.current,
					active = userData.active;

				if(active==="1") {
					$("#checked_by").append('<option value="' + id + '">' + display + '</option>');
				}

				// if(active==="1" && !empty(service_log_object)) {
				// 	var selectMe = 0;
				// 	$.each(service_log_object.serviced_by, function(servicedbyId, servicedbyData) {
				// 		if(selectMe===0 && servicedbyData.user_id==id) {
				// 			selectMe = 1;
				// 		}
				// 	});
                //
				// 	$("#serviced_by").append('<option value="' + id + '"' + (selectMe==1 ? ' selected' : '') + '>' + display + '</option>');
				// } else if(active==="1" && empty(service_log_object)) {
				// 	$("#serviced_by").append('<option value="' + id + '">' + display + '</option>');
				// }
			});
		}

		function populateEquipmentModelDropdownWithData(serviceUrl, field) {
			// var service_log_object = getServiceLogData();

			$("#loading_equipmentmodel_id").show();

			var jqxhr = $.ajax({
				url: serviceUrl,
				type: "POST",
				dataType: "json",
				data: JSON.stringify({"id": $("#equipment_type").val()}),
				contentType: "application/json"
			}).done(function(object) {
				// Clear dropdowns first.
				$('#unit_number').empty();
				$('#equipmentmodel_id').empty();
				$('#equipmentmodel_id').append('<option value="">Select one:</option>');

				// Populate dropdown via ajax.
				$.each(object.data, function(id, unitData) {
					var id = unitData.equipmentmodel_id,
						value = unitData.manufacturer_name + " " + unitData.model_number;

					$('#equipmentmodel_id').append('<option value="' + id + '">' + value + '</option>');
					// if(!empty(service_log_object)) {
					// 	$('#equipmentmodel_id').append('<option value="' + id + '"' + (service_log_object.equipmentmodel_id==id ? ' selected' : '') + '>' + value + '</option>');
					// } else {
					// 	$('#equipmentmodel_id').append('<option value="' + id + '">' + value + '</option>');
					// }
				});
				$('#equipmentmodel_id').attr('disabled', false);

				$("#loading_equipmentmodel_id").hide();
			});
		}

		function populateUnitNumberDropdownWithData(serviceUrl, field) {
			// var service_log_object = getServiceLogData();
			var equipmentmodel_id = $("#equipmentmodel_id").val();
			// var equipmentmodel_id = (!empty(service_log_object) ? service_log_object.equipmentmodel_id : $("#equipmentmodel_id").val());

			$("#loading_unit_number").show();

			var jqxhr = $.ajax({
				url: serviceUrl,
				type: "POST",
				dataType: "json",
				data: JSON.stringify({"id": equipmentmodel_id}),
				contentType: "application/json"
			}).done(function(object) {
				// Clear dropdown first.
				$('#unit_number').empty();
				$('#unit_number').append('<option value="">Select one:</option>');

				// Populate dropdown via ajax.
				$.each(object.data, function(id, unitData) {
					var id = unitData.id,
						value = unitData.unit_number,
						track_type = unitData.track_type,
						person_responsible = unitData.person_responsible,
						fluids_tracked = unitData.fluids_tracked,
						active = unitData.active;

					if(active===1) {
						$('#unit_number').append('<option value="' + id + '" data-track-type="' + track_type + '" data-fluids-tracked="' + fluids_tracked + '" data-person-responsible="' +person_responsible + '">' + value + '</option>');
					}
					// if(active===1 && !empty(service_log_object)) {
					// 	$('#unit_number').append('<option value="' + id + '" data-track-type="' + track_type + '" data-person-responsible="' +person_responsible + '" data-track-type="' + track_type + '" data-fluids-tracked="' + fluids_tracked + '"' + (id==service_log_object.equipmentunit_id ? ' selected' : '') + '>' + value + '</option>');
					// } else if(active===1 && empty(service_log_object)) {
					// 	$('#unit_number').append('<option value="' + id + '" data-track-type="' + track_type + '" data-fluids-tracked="' + fluids_tracked + '" data-person-responsible="' +person_responsible + '">' + value + '</option>');
					// }
				});

				// if(!empty(service_log_object)) {
				// 	if(service_log_object.subflow=="sus") {
				// 		$("#sus_current_smr").val(service_log_object.smr);
				// 	}
                //
				// 	if(service_log_object.subflow=="flu") {
				// 		populateFluUnits();
				// 		$("#flu_units").val(service_log_object.fluidentry_smr_detail.smr);
				// 	}
				// }

				$("#unit_number").attr('disabled', false);

				$("#loading_unit_number").hide();
			});
		}

		function goBack() {
			var thisSection = $('.form-section.current'),
				thisIndex = thisSection.attr('data-section-index');

			// If we are on the review screen and click "Back"
			// then we need to check which index to send the user back to
			if("undefined"===typeof(thisIndex)) {
				var goToIndex = 3 + parseInt($('.subflow.' + currentSubflow).length);
				navigateTo(goToIndex);
				return;
			}

			var lastSection = $("div").find("[data-section-index='" + (thisIndex - 1) + "']");
			var goToIndex = lastSection.attr('data-section-index');

			if(thisIndex < lastSection && empty(currentSubflow)) {
				var goToIndex = thisSection.prev('.form-section').attr('data-section-index');
			} else if(thisIndex < lastSection && !empty(currentSubflow) && thisSection.prev('.form-section').hasClass(currentSubflow)) {
				var goToIndex = thisSection.prev('.form-section.' + currentSubflow).attr('data-section-index');
			} else if(thisIndex < lastSection && !empty(currentSubflow) && thisSection.prev('.form-section').hasClass(currentSubflow)===false) {
				var goToIndex = thisIndex - 1;
			}

			navigateTo(goToIndex);
		}

		function showReview() {
			$('.form-section').hide();
			$("#reviewButton").hide();
			$("#goForwardButton").hide();
			$(".subflow").hide();
			$("#submitButton").show();

			printReviewScreen();

			$("#reviewScreen").show();
		}

		function getRequestVariable(name) {
			var id = 0;
			if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search)) {
				id = Number(decodeURIComponent(name[1]));
			}

			return (isInteger(id) ? id : 0);
		}

		function isInteger(x) {
			return (typeof x === 'number') && (x % 1 === 0);
		}

		function initChecklistEntryData(checklistentry_id) {
			if(checklistentry_id===0) {
				// clearServiceLogData();

				var today = moment().format('MM/DD/YYYY');

				$("#date_entered").val(today);
				return;
			}
		}

		// Previous button is easy, just go back
		$(document).on("click", ".prev", function () {
			$("#reviewScreen").hide();
			$("#submitButton").hide();
			goBack();
		});

		$(document).on("click", ".inspection-button", function () {
			var item = $(this).data('item'),
				thisItemClass = '.' + $(this).data('item'),
				status = $(this).data('inspection-status'),
				problem_note = $(this).data('item') + '_problem_note'; //left_front_tire_problem_note

			console.log(item);
			console.log(status);

			if($(this).hasClass(item) && status=='good') {
				$(thisItemClass).removeClass('item-notmarked');
				$(thisItemClass).removeClass('item-good');
				$(thisItemClass).removeClass('item-bad');
				$(this).addClass('item-good');
				$(thisItemClass + ".button_bad").addClass('item-notmarked');
				$('label[for="' + problem_note + '"]').hide();
				$('#' + problem_note).hide();

				var index = curIndex();
				setTimeout(function(){
					navigateTo(index + 1);
				}, 1000);
			}

			if($(this).hasClass(item) && status=='bad') {
				$(thisItemClass).removeClass('item-notmarked');
				$(thisItemClass).removeClass('item-good');
				$(thisItemClass).removeClass('item-bad');
				$(this).addClass('item-bad');
				$(thisItemClass + ".button_good").addClass('item-notmarked');
				$('label[for="' + problem_note + '"]').show();
				$('#' + problem_note).show();
			}
		});

		// Next button goes forward if current block validates
		$('.form-navigation .next').click(function () {
			$('.serviceLog-form').parsley().whenValidate({
				group: 'block-' + curIndex()
			}).always(function () {
				//
			}).done(function () {
				var thisSection = $('.form-section.current'),
					thisIndex = thisSection.attr('data-section-index');

				var goToIndex = parseInt(thisIndex) + 1;
				var startAtIndex = 4;

				// $sections.each(function (index, section) {
				// 	// clear section index
				// 	if(index>=4) {
				// 		$(section).attr("data-section-index", "");
				// 	}
                //
				// 	if(index>=4 && $(section).hasClass(currentSubflow)) {
				// 		$(section).attr("data-section-index", startAtIndex);
				// 		startAtIndex++;
				// 	}
				// });

				if(thisSection.hasClass("show-prev")) {
					$('#goBackButton').show();
				} else {
					$('#goBackButton').hide();
				}

				if(thisSection.hasClass("show-next")) {
					$('#goForwardButton').show();
				} else {
					$('#goForwardButton').hide();
				}

				navigateTo(goToIndex);
			});
		});

		// Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
		$sections.each(function (index, section) {
			$(section).find(':input').attr('data-parsley-group', 'block-' + index);
			$(section).attr("data-section-index", index);
		});
		navigateTo(0); // Start at the beginning

		$('#date_entered').datepicker({
			autoclose: true,
			dateFormat: 'mm/dd/yyyy'
		});

		$("#equipment_type").on('change', function() {
			$("#equipmentmodel_id").prop('disabled', false);
			populateEquipmentModelDropdownWithData("<?php echo base_url(); ?>index.php/equipmentmodel/getEquipmentByType",
				$("#equipmentmodel_id"));
		});

		$("#equipmentmodel_id").on('change', function() {
			$("#unit_number").prop('disabled', false);
			populateUnitNumberDropdownWithData("<?php echo base_url(); ?>index.php/equipmentunits/getUnitByModelId",
				$("#unit_number"));
		});

		$(document).ready(function() {
			var checklistentry_id = getRequestVariable('id');

			$('label[for="left_front_tire_problem_note"]').hide();
			$('#left_front_tire_problem_note').hide();

			$('label[for="left_rear_tire_problem_note"]').hide();
			$('#left_rear_tire_problem_note').hide();

			$('label[for="right_front_tire_problem_note"]').hide();
			$('#right_front_tire_problem_note').hide();

			initChecklistEntryData(checklistentry_id);
		});

	});
</script>
<script>

	function empty(data) {
		if(typeof(data) === 'number' || typeof(data) === 'boolean')
		{
			return false;
		}
		if(typeof(data) === 'undefined' || data === null)
		{
			return true;
		}
		if(typeof(data.length) !== 'undefined')
		{
			return data.length === 0;
		}
		var count = 0;
		for(var i in data)
		{
			if(data.hasOwnProperty(i))
			{
				count ++;
			}
		}
		return count === 0;
	}

</script>
