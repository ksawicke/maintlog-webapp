<form class="serviceLog-form">
    <div class="form-section show-next">
        <label for="date_entered" class="control-label lb-lg">Date Entered</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input id="date_entered"
                   name="date_entered"
                   type="text"
                   class="form-control input-lg"
                   value="<?php echo date("m/d/Y"); ?>"
                   data-parsley-required="true"
                   data-parsley-pattern="/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/"
                   data-parsley-pattern-message="Date must be in MM/DD/YYYY format"
                   data-parsley-errors-container=".date_entered_errors">
        </div>
        <p class="form-error date_entered_errors"></p>
    </div>

    <div class="form-section show-prev show-next">
        <label for="entered_by" class="control-label lb-lg">Entered By</label>
        <select id="entered_by"
                name="entered_by"
                class="form-control input-lg"
                data-parsley-required="true"
                data-parsley-error-message="Please select who entered the record"
                data-parsley-errors-container=".entered_by_errors">
            <option value="">Select one:</option>
            <option value="1"<?php echo ($_SESSION['first_name']=='Bret' && $_SESSION['last_name']=='Johnson' ? ' selected' : ''); ?>>Johnson, Bret</option>
            <option value="2"<?php echo ($_SESSION['first_name']=='Neil' && $_SESSION['last_name']=='Johnson' ? ' selected' : ''); ?>>Johnson, Neil</option>
            <option value="3"<?php echo ($_SESSION['first_name']=='John' && $_SESSION['last_name']=='Leonetti' ? ' selected' : ''); ?>>Leonetti, John</option>
            <option value="4"<?php echo ($_SESSION['first_name']=='Kevin' && $_SESSION['last_name']=='Sawicke' ? ' selected' : ''); ?>>Sawicke, Kevin</option>
        </select>
        <p class="form-error entered_by_errors"></p>
        
        <label for="serviced_by" class="control-label lb-lg">Serviced By</label>
        <select id="serviced_by"
                name="serviced_by"
                class="form-control input-lg"
                multiple
                data-parsley-required="true"
                data-parsley-mincheck="1"
                data-parsley-error-message="Please select at least one person who performed the service"
                data-parsley-errors-container=".serviced_by_errors">
            <option value="11">Doe, John</option>
            <option value="12">Johnson, Neil</option>
            <option value="13">Smith, Joe</option>
            <option value="14">Xavier, Jose</option>
        </select>
        <p class="form-error serviced_by_errors"></p>
    </div>

    <div class="form-section show-prev show-next">
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                
                <label for="equipment_type" class="control-label lb-lg">Equipment Type</label>
                <select id="equipment_type"
                        name="equipment_type"
                        class="form-control input-lg"
                        data-parsley-required="true"
                        data-parsley-error-message="Please select the equipment type"
                        data-parsley-errors-container=".equipment_type_errors">
                    <option value="">Select one:</option>
                    <?php foreach($equipmenttypes as $equipmenttype) { ?>
                        <option value="<?php echo $equipmenttype->id; ?>"><?php echo $equipmenttype->equipment_type; ?></option>
                    <?php } ?>
                </select>
                <p class="form-error equipment_type_errors"></p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                
                <label for="equipment_typeahead" class="control-label lb-lg">Equipment</label>
                <br />
                <input id="equipment_typeahead"
                       name="equipment_typeahead"
                       type="text"
                       class="form-control input-lg"
                       required=""
                       data-parsley-equipmentrequired=""
                       data-parsley-errors-container=".equipment_typeahead_errors">
                <p class="form-error equipment_typeahead_errors"></p>
              
                <input id="equipment_id"
                    name="equipment_id"
                    type="hidden"
                    value="">
                <input id="equipment_description"
                    name="equipment_description"
                    type="hidden"
                    value="">
                
            </div>
        </div>
    </div>

    <div class="form-section show-prev show-next">
        <label for="subflow" class="control-label lb-lg">Entry Selection</label>
        <select
                id="subflow"
                name="subflow"
                class="form-control input-lg"
                data-parsley-required="true"
                data-parsley-error-message="Please select the entry type"
                data-parsley-errors-container=".subflow_errors">
            <option value="">Select one:</option>
            <option value="sus">SMR update</option>
            <option value="pss">PM service</option>
            <option value="ccs">Component Change</option>
        </select>
        <p class="form-error subflow_errors"></p>
    </div>

    <!-- SMR UPDATE SUBFLOW -->
    <div class="form-section subflow sus show-prev show-next">
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <label for="sus_fluid_type" class="control-label lb-lg">Fluid Type</label>
                <select 
                        id="sus_fluid_type"
                        name="sus_fluid_type"
                        class="form-control input-lg"
                        data-parsley-required="true"
                        data-parsley-error-message="Please select the fluid type"
                        data-parsley-errors-container=".sus_fluid_type_errors">
                    <option value="">Select one:</option>
                    <?php foreach($fluidtypes as $fluidtype) { ?>
                        <option value="<?php echo $fluidtype->id; ?>"><?php echo $fluidtype->fluid_type; ?></option>
                    <?php } ?>
                </select>
                <p class="form-error sus_fluid_type_errors"></p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <label for="sus_quantity" class="control-label lb-lg">Quantity</label>
                <input 
                       id="sus_quantity"
                       name="sus_quantity"
                       type="text"
                       class="form-control input-lg"
                       data-parsley-type="number"
                       data-parsley-required="true"
                       data-parsley-gt="0"
                       data-parsley-lt="10000"
                       data-parsley-required-message="Please choose the quantity of fuel used"
                       data-parsley-gt-message="Please enter a quantity greater than 0"
                       data-parsley-lt-message="Please enter a quantity less than 10000.0"
                       data-parsley-errors-container=".sus_quantity_errors">
                <p class="form-error sus_quantity_errors"></p>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-9">
                <label for="sus_units" class="control-label lb-lg">&nbsp;</label>
                <select
                        id="sus_units"
                        name="sus_units"
                        class="form-control input-lg"
                        data-parsley-required="true"
                        data-parsley-error-message="Please choose the units of fuel used"
                        data-parsley-errors-container=".sus_units_errors">
                    <option value="" selected>Select one:</option>
                    <option value="gal">Gallons (gal)</option>
                    <option value="L">Liters (L)</option>
                </select>
                <p class="form-error sus_units_errors"></p>
            </div>
        </div>
        
    </div>

    <div class="form-section subflow sus show-prev show-review">
        <label for="sus_miles" class="control-label lb-lg">SMR / Miles</label>
        <input
               id="sus_miles"
               name="sus_miles"
               type="text"
               class="form-control input-lg"
               value=""
               data-parsley-type="number"
               data-parsley-required="true"
               data-parsley-gt="0"
               data-parsley-lt="9999999"
               data-parsley-required-message="Please enter the current SMR or Miles"
               data-parsley-gt-message="Please enter a quantity greater than 0"
               data-parsley-lt-message="Please enter a quantity less than 9,999,999"
               data-parsley-errors-container=".sus_miles_errors">
        <p class="form-error sus_miles_errors"></p>
    </div>
    <!-- /SMR UPDATE SUBFLOW -->

    <!-- PM SERVICE SUBFLOW -->
    <div class="form-section subflow pss show-prev show-next">
        <label for="pss_pm_type" class="control-label lb-lg">PM Type</label>
        <select id="pss_pm_type"
                name="pss_pm_type"
                class="form-control input-lg"
                data-parsley-required="true"
                data-parsley-error-message="Please select the PM type"
                data-parsley-errors-container=".pss_pm_type_errors">
            <option value="">Select one:</option>
            <option value="smr_based">SMR based</option>
            <option value="mileage_based">Mileage based</option>
            <option value="time_based">Time based</option>
        </select>
        <p class="form-error pss_pm_type_errors"></p>
    </div>

    <div class="form-section subflow pss show-prev show-next">
        <label for="pss_smr" class="control-label lb-lg">SMR</label>
        <select id="pss_smr"
                name="pss_smr"
                class="form-control input-lg"
                data-parsley-required="true"
                data-parsley-error-message="Please select the SMR value"
                data-parsley-errors-container=".pss_smr_errors">
            <option value="">Select one:</option>
            <option value="250">250</option>
            <option value="500">500</option>
            <option value="1000">1000</option>
            <option value="1500">1500</option>
        </select>
        <p class="form-error pss_smr_errors"></p>
    </div>
    
    <div class="form-section subflow pss show-prev show-next">
        SERVICE REMINDER<br /><br />
        <label for="pss_reminder_pm_type" class="control-label lb-lg">PM Type</label>
        <select id="pss_reminder_pm_type"
                name="pss_reminder_pm_type"
                class="form-control input-lg"
                data-parsley-required="true"
                data-parsley-error-message="Please select the PM Type"
                data-parsley-errors-container=".pss_reminder_pm_type_errors">
            <option value="">Select one:</option>
            <option value="smr_based">SMR Based</option>
            <option value="mileage_based">Mileage Based</option>
            <option value="time_based">Time Based</option>
        </select>
        <p class="form-error pss_reminder_pm_type_errors"></p>

        <label for="pss_smr_due" class="control-label lb-lg">SMR Due</label>
        <input type="text" class="form-control input-lg" id="pss_smr_due" name="pss_smr_due" value="">
    </div>

    <div class="form-section subflow pss show-prev show-next">
        <label for="pss_notes"class="control-label lb-lg">Notes</label>
        <textarea type="text"
               class="form-control input-lg"
               id="pss_notes"
               name="pss_notes"
               value=""
               data-parsley-required="true"
               data-parsley-error-message="Please enter some notes"
               data-parsley-errors-container=".pss_notes_errors"></textarea>
        <p class="form-error pss_notes_errors"></p>
    </div>
    
    <div class="form-section subflow pss show-prev show-review">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <label for="pss_reminder_recipients" class="control-label lb-lg">REMINDER RECIPIENTS</label>
                <textarea type="text"
                       id="pss_reminder_recipients"
                       name="pss_reminder_recipients"
                       class="form-control input-lg"
                       data-parsley-required="true"
                       data-parsley-error-message="Please enter recipients email addresses separated by comma"
                       data-parsley-errors-container=".pss_reminder_recipients_errors"
                       readonly>NPJohnson@KOMATSUNA.COM,kevin@rinconmountaintech.com</textarea>
                <p class="form-error pss_reminder_recipients_errors"></p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <label for="pss_reminder_quantity" class="control-label lb-lg">ALERT WINDOW BEFORE DUE</label>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <input type="text"
                       id="pss_reminder_quantity"
                       name="pss_reminder_quantity"
                       class="form-control input-lg"
                       data-parsley-required="true"
                       data-parsley-error-message="Please enter a quantity"
                       data-parsley-errors-container=".pss_reminder_quantity_errors">
                <p class="form-error pss_reminder_quantity_errors"></p>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-9">
                <select id="pss_reminder_units"
                        name="pss_reminder_units"
                        class="form-control input-lg"
                        data-parsley-required="true"
                        data-parsley-error-message="Please select one"
                        data-parsley-errors-container=".pss_reminder_units_errors">
                    <option value="" selected>Select one:</option>
                    <option value="smr">SMR</option>
                    <option value="miles">Miles</option>
                    <option value="days">Days</option>
                </select>
                <p class="form-error pss_reminder_units_errors"></p>
            </div>
        </div>
    </div>
    <!-- /PM SERVICE SUBFLOW -->
    
    <!-- COMPONENT CHANGE SUBFLOW -->
    <div class="form-section subflow ccs show-prev show-next">
        <label for="ccs_component_type" class="control-label lb-lg">Component Type</label>
        <select id="ccs_component_type"
                name="ccs_component_type"
                class="form-control input-lg"
                data-parsley-required="true"
                data-parsley-error-message="Please select a Component Type"
                data-parsley-errors-container=".ccs_component_type_errors">
            <option value="">Select one:</option>
            <option value="78">Engine</option>
            <option value="55">Final Drive</option>
            <option value="444">Suspension</option>
            <option value="3">Software</option>
        </select>
        <p class="form-error ccs_component_type_errors"></p>
    </div>
    
    <div class="form-section subflow ccs show-prev show-next">
        <label for="ccs_component" class="control-label lb-lg">Component</label>
        <select id="ccs_component"
                name="ccs_component"
                class="form-control input-lg"
                data-parsley-required="true"
                data-parsley-error-message="Please select a Component"
                data-parsley-errors-container=".ccs_component_errors">
            <option value="">Select one:</option>
            <option value="626">Serial #</option>
            <option value="235">Revision #</option>
            <option value="23622">Part #</option>
            <option value="355">Campaign #</option>
            <option value="3626">None</option>
        </select>
        <p class="form-error ccs_component_errors"></p>
        
        <label for="ccs_component_data" class="control-label lb-lg">Component Data</label>
        <input
               id="ccs_component_data"
               name="ccs_component_data"
               type="text"
               class="form-control input-lg"
               value=""
               data-parsley-required="true"
               data-parsley-error-message="Please enter the Component Data for the Component selected"
               data-parsley-errors-container=".ccs_component_data_errors">
        <p class="form-error ccs_component_data_errors"></p>
    </div>
    
    <div class="form-section subflow ccs show-prev show-review">
        <label for="ccs_notes"class="control-label lb-lg">Notes</label>
        <textarea type="text"
               class="form-control input-lg"
               id="ccs_notes"
               name="ccs_notes"
               value=""
               data-parsley-required="true"
               data-parsley-error-message="Please enter some notes"
               data-parsley-errors-container=".ccs_notes_errors"></textarea>
        <p class="form-error ccs_notes_errors"></p>
    </div>
    <!-- /COMPONENT CHANGE SUBFLOW -->

    <div id="reviewScreen"></div>
    <span class="clearfix"></span>
    
    <div class="form-navigation">
        <button id="goBackButton" type="button" class="prev btn btn-lg btn-primary">&laquo; Prev</button>
        <button id="goForwardButton" type="button" class="next btn btn-lg btn-primary">Next &raquo;</button>
        <button id="reviewButton" type="button" class="next btn btn-lg btn-primary">Review &raquo;</button>
        <button id="submitButton" type="button" class="next btn btn-lg btn-primary">Submit</button>
    </div>
    
    <span class="clearfix"></span>

</form>

<style class="example">
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
            dialogWidth = windowWidth * 0.65,
            windowHeight = $(window).height(),
            dialogHeight = windowHeight * 0.65;
                
        // Set the Options for "Bloodhound" suggestion engine
        // @see https://scotch.io/tutorials/implementing-smart-search-with-laravel-and-typeahead-js
        // @see https://github.com/twitter/typeahead.js/issues/1236
        var engine = new Bloodhound({
            remote: {
                url: '<?php echo base_url("equipment/getEquipmentByType"); ?>',
                //url: '/find?q=%QUERY%',
                prepare: function (query, settings) {
                    settings.type = "POST";
                    settings.contentType = "application/json; charset=UTF-8";
                    customSearch = {id: $("#equipment_type").val(), query: query};
                    settings.data = JSON.stringify(customSearch); //query

                    return settings;
                },
                wildcard: '%QUERY%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });
        
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
//            $("#submitButton").hide();
//            $("#goBackButton").hide();
//            $('.form-navigation').show();
            $('.form-navigation .next').show();
//            $("#reviewButton").hide();
            
//            currentSubflow = '';
//            subflowIndex = 0;
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
//                lastSection = $('.form-section').length - 1,
                thisIndex = thisSection.attr('data-section-index');
//                goToIndex = lastSection;
                
//            console.log("TEST-- thisIndex: " + thisIndex);    
                
            var lastSection = $("div").find("[data-section-index='" + (index - 1) + "']");
            var goToIndex = lastSection.attr('data-section-index');
            
//            var thisSection = $('.form-section').eq(index),
//                lastSection = $('.form-section').length - 1,
//                thisIndex = thisSection.attr('data-section-index'),
//                goToIndex = lastSection;
        
//            var showNextButton = (thisIndex===lastSection ? false : true);
            
            $('.form-section').removeClass('current');
            $("div").find("[data-section-index='" + index + "']").addClass('current').show();
//            $sections.each(function (ctr, section) {
//                if($(section).attr("data-section-index").toString()===index.toString()) {
//                    $(section).addClass("current");
//                    $(section).show();
//                }
//            });
            
//            $sections
//                    .removeClass('current')
//                    .eq(index)
//                    .addClass('current');
            
            if(initialPassCompleted && index===3) {
                setCurrentSubflow();
            }
            
//            var atTheBeginning = (index===0 ? true : false);
            
//            $('.form-section').eq(index).show();
            
//            console.log("INDEX: " + $('.form-section').eq(index).attr('data-section-index'));

//            if(index>0 && currentSubflow) {                
//                if(subflowIndex > $('.' + currentSubflow).length) {
//                    atTheEnd = true;
//                }
//                
//                if(currentSubflow=='sus') {
//                    if(subflowIndex > $('.' + currentSubflow).length) {
////                    if(subflowIndex == 3) {
//                        atTheEnd = true;
//                    }
//                }
//                if(currentSubflow=='pss') {
//                    if(subflowIndex == 4) {
//                        atTheEnd = true;
//                    }
//                }
//                if(currentSubflow=='ccs') {
//                    if(subflowIndex == 4) {
//                        atTheEnd = true;
//                    }
//                }
//            }
//            var atTheBeginning = (index===0 ? true : false);
//            var atReview = ($('.form-section').eq(index).hasClass('show-review') ? true : false);
//            var atReview = ($('.form-section').eq(index).hasClass('show-review') ? true : false);
            
            console.log(thisSection);
            
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
            
            
//            $('.form-navigation .next').toggle(!atTheEnd);
//            $('.form-navigation .prev').toggle(!atTheBeginning && !atTheEnd);
//            $("#reviewButton").toggle(atTheEnd);
//            $("#submitButton").toggle(atReview);
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
        
        function populateDropdownWithData(serviceUrl, field) {
            /*{
                "serviceUrl" : "/sites/komatsuna/appsettings/get_setting",
                "field" : $(this)
            }*/
//            console.log(serviceUrl);
//            console.log(field);
            
            var data = $.ajax({
                url: serviceUrl,
                type: "POST",
                dataType: "json",
                data: JSON.stringify({"field": "smr_based_choices"}),
                contentType: "application/json"
            });
            
            var values = data.split('|');
            
            console.log(values);
            console.log(field);
        }
        
        function saveServiceLog() {
            var serviceUrl = '/sites/komatsuna/servicelog/save',
                jsonData = getJsonToSave(currentSubflow);
            
            $.ajax({
                url: serviceUrl,
                type: "POST",
                dataType: "json",
                data: JSON.stringify(jsonData),
                contentType: "application/json"
            });
            
            confirmSubmitJBox.close();
            
            location.reload(true);
        }
        
        function goBack() {
            var thisSection = $('.form-section.current'),
//                lastSection = $('.form-section').length - 1,
                thisIndex = thisSection.attr('data-section-index');
//                goToIndex = lastSection;
            
            // If we are on the review screen and click "Back"
            // then we need to check which index to send the user back to
            if("undefined"===typeof(thisIndex)) {
                var goToIndex = 3 + parseInt($('.subflow.' + currentSubflow).length);
                navigateTo(goToIndex);
                return;
            }
            
            console.log("####: " + thisSection);    
                
            console.log("TEST-- thisIndex: " + thisIndex);    
                
            var lastSection = $("div").find("[data-section-index='" + (thisIndex - 1) + "']");
            var goToIndex = lastSection.attr('data-section-index');
                        
            if(thisIndex < lastSection && empty(currentSubflow)) {
                var goToIndex = thisSection.prev('.form-section').attr('data-section-index');
                console.log("    -- goToIndex a: " + goToIndex);
            } else if(thisIndex < lastSection && !empty(currentSubflow) && thisSection.prev('.form-section').hasClass(currentSubflow)) {
                var goToIndex = thisSection.prev('.form-section.' + currentSubflow).attr('data-section-index');
                console.log("    -- goToIndex b: " + goToIndex);
            } else if(thisIndex < lastSection && !empty(currentSubflow) && thisSection.prev('.form-section').hasClass(currentSubflow)===false) {
                var goToIndex = thisIndex - 1;
//                var goToIndex = thisSection.prev('.form-section').attr('data-section-index');
                console.log("    -- goToIndex c: " + goToIndex);
            }
            
            console.log("    -- lastSection: " + lastSection);
            console.log("    -- goToIndex: " + goToIndex);
            
            console.log("@@@ SECTION CHECK:");
            $sections.each(function (index, section) {
                console.log(section);
            });
            
            navigateTo(goToIndex);
        }
        
        function setCurrentSubflow() {
            subflowSelected = true;
            currentSubflow = $('#subflow').val();
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
        
        $(document).on("click", "#reviewButton", function () {
            showReview();
        });
        
        $(document).on("toggle", "#reviewButton", function () {
            showReview();
        });
        
        $(document).on("focus", "#pss_smr", function () {
            // Populate with choices from the db
            populateDropdownWithData("/sites/komatsuna/appsettings/get_setting",
                $(this));
        });
        
        $(document).on("click", "#cancelSubmitLogEntryForm", function () {
            confirmSubmitJBox.close();
        });
        
        $(document).on("click", "#submitLogEntryForm", function () {
            saveServiceLog();
        });

        $('#subflow').on('change', function () {
            setCurrentSubflow();
        });

        // Previous button is easy, just go back
        $(document).on("click", ".prev", function () {
            $("#reviewScreen").hide();
            $("#submitButton").hide();
            goBack();
        });

        // Next button goes forward if current block validates
        // KMS 10-11-17 https://stackoverflow.com/questions/27932403/parsleyjs-with-multi-steps-form
        //              https://stackoverflow.com/questions/30054011/duplication-of-field-error-when-using-parsley-js
//        
        $('.form-navigation .next').click(function () {
            $('.serviceLog-form').parsley().whenValidate({
                group: 'block-' + curIndex()
            }).always(function () {
                //
            }).done(function () {
                //$('.form-section').eq(index).attr('data-section-index')
//                var thisSection = $('.form-section.current'),
//                    lastSection = $('.form-section').length - 1,
//                    thisIndex = thisSection.attr('data-section-index'),
//                    goToIndex = lastSection;

//                console.log("thisIndex: " + thisIndex);
//                console.log(typeof(thisIndex));
//                if(thisIndex.toString==="3") {
//                    console.log("select subflow!");
//                }
                
//                var thisSection = $('.form-section.current'),
//                    lastSection = $('.form-section').length - 1,
//                    thisIndex = thisSection.attr('data-section-index'),
//                    goToIndex = lastSection;
//
//                if(thisIndex < lastSection && empty(currentSubflow)) {
//                    var goToIndex = thisSection.next('.form-section').attr('data-section-index');
//                } else if(thisIndex < lastSection && !empty(currentSubflow) && thisSection.prev('.form-section').hasClass(currentSubflow)) {
//                    var goToIndex = thisSection.next('.form-section.' + currentSubflow).attr('data-section-index');
//                } else if(thisIndex < lastSection && !empty(currentSubflow) && thisSection.next('.form-section').hasClass(currentSubflow)===false) {
//                    var goToIndex = thisSection.next('.form-section').attr('data-section-index');
//                }
                
                var thisSection = $('.form-section.current'),
//                lastSection = $('.form-section').length - 1,
                thisIndex = thisSection.attr('data-section-index');
//                goToIndex = lastSection;
                
//                console.log("TEST-- thisIndex: " + thisIndex);    

//                var nextSection = $("div").find("[data-section-index='" + (thisIndex + 1) + "']");
                var goToIndex = parseInt(thisIndex) + 1;
                
                console.log("  @@ thisIndex: " + thisIndex);
                console.log("  @@ goToIndex: " + goToIndex);
                
//                var thisSection = $('.form-section').eq(curIndex());
                var startAtIndex = 4;
                
                /****/
                $sections.each(function (index, section) {
//                    $(section).find(':input').attr('data-parsley-group', 'block-' + index);
//                    $(section).attr("data-section-index", index);
                    
                    // clear section index
                    if(index>=4) {
                        $(section).attr("data-section-index", "");
                    }
                    
                    if(index>=4 && $(section).hasClass(currentSubflow)) {
                        $(section).attr("data-section-index", startAtIndex);
                        startAtIndex++;
//                        console.log("SECTION CHECK");
//                        console.log($(section));
                    }                        
                });
                
                console.log("SECTION CHECK:");
                $sections.each(function (index, section) {
                    console.log(section);
                });
                
                /****/
                
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
//
//                if(thisSection.hasClass("show-review")) {
//                    $('#reviewButton').show();
//                } else {
//                    $('#reviewButton').hide();
//                }

//                var goToIndex = (curIndex() + 1);
                
//                if(currentSubflow && subflowIndex===0) {
//                    subflowIndex++;
//                    goToIndex = $("." + currentSubflow + ":first").data("section-index") - 1;
//                }
//                
//                if(currentSubflow && subflowIndex>0) {
//                    subflowIndex++;
//                    
//                    if(currentSubflow=='sus') {
//                        goToIndex = $("." + currentSubflow + ":first").data("section-index") + subflowIndex - 2;
//                    }
//                    if(currentSubflow=='pss') {
//                        goToIndex = $("." + currentSubflow + ":first").data("section-index") + subflowIndex - 2;
//                    }
//                    if(currentSubflow=='ccs') {
//                        goToIndex = $("." + currentSubflow + ":first").data("section-index") + subflowIndex - 2;
//                    }
//                }
                
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
            $("#equipment_typeahead").val('');
            $("#equipment_id").val('');
        });
        
        $("#equipment_typeahead").on('focus', function() {
           $(this).val('');
           $("#equipment_id").val('');
        });
        
        $("#equipment_typeahead").typeahead({
            hint: true,
            highlight: true,
            minLength: 3
        }, {
            source: engine.ttAdapter(),

            // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
            name: 'equipmentList',

            // the key from the array we want to display (name,id,email,etc...)
            templates: {
                empty: [
                    '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                ],
                header: [
                    '<div class="list-group search-results-dropdown">'
                ],
                suggestion: function (data) {
                    return '<a href="#" class="list-group-item">' + data.search_match + '</a>';
                }
            }
        }).on('typeahead:selected', function(event, selection) {
            $(this).typeahead('val', selection.search_match);
            $("#equipment_id").val(selection.id);
            $("#equipment_description").val(selection.search_match);
        });
    });
</script>
<script>
    function getJsonToSave(currentSubflow) {
        var json = { "date_entered": $("#date_entered").val(),
                     "entered_by": $("#entered_by").val(),
                     "serviced_by": $("#serviced_by option:selected").map(function() {
                        return this.value;
                     }).get().join("|"),
                     "equipment_id": $("#equipment_id").val()
                   };
        
        json.subflow = currentSubflow;
        
        switch(currentSubflow) {
            case 'sus':
                json.sus_fluid_type = $("#sus_fluid_type").val();
                json.sus_quantity = $("#sus_quantity").val();
                json.sus_units = $("#sus_units").val();
                json.sus_miles = $("#sus_miles").val();             
                break

            case 'pss':
                json.pss_reminder_pm_type = $("#pss_reminder_pm_type").val();
                json.pss_smr_due = $("#pss_smr_due").val();
                json.pss_reminder_pm_type = $("#pss_reminder_pm_type").val();
                json.pss_notes = $("#pss_notes").val();
                json.pss_reminder_recipients = $("#pss_reminder_recipients").val();
                json.pss_reminder_quantity = $("#pss_reminder_quantity").val();
                json.pss_reminder_units = $("#pss_reminder_units").val();
                break;

            case 'ccs':
                json.ccs_component_type = $("#ccs_component_type").val();
                json.ccs_component = $("#ccs_component").val();
                json.ccs_component_data = $("#ccs_component_data").val();
                json.ccs_notes = $("#ccs_notes").val();
                break;
        }
         
        return json;
    }
    
    function getJsonObject(currentSubflow) {
        var json = [
                { "label" : "Date Entered",
                  "value" : $("#date_entered").val()
                },
                { "label" : "Entered By",
                  "value" : $("#entered_by option[value='" + $("#entered_by").val() + "']").text()
                },
                { "label" : "Serviced By",
                  "value" : $("#serviced_by option:selected").map(function() {
                      return $("#serviced_by option[value='" + this.value + "']").text();
                  }).get().join("|")
                },
                { "label" : "Equipment Type",
                  "value" : $("#equipment_type option[value='" + $("#equipment_type").val() + "']").text()
                },
                { "label" : "Equipment",
                  "value" : $("#equipment_description").val()
                }
            ];
            
        switch(currentSubflow) {
            case 'sus':
                json.push({ "label": "Entry Selection", "value": "SMR update" });
                objectPush(json, "Fluid Type", "sus_fluid_type", true);

                // Concatenated value so handling differently...
                json.push({ "label": "Quantity",
                            "value": $("#sus_quantity").val() + " " + $("#sus_units option[value='" + $("#sus_units").val() + "']").text()
                });

                objectPush(json, "SMR/Miles", "sus_miles", false);                
                break

            case 'pss':
                json.push({ "label": "Entry Selection", "value": "PM Service" });
                objectPush(json, "PM Type", "pss_reminder_pm_type", true);
                objectPush(json, "SMR", "pss_smr_due", false);
                objectPush(json, "Reminder PM Type", "pss_reminder_pm_type", true);
                objectPush(json, "Notes", "pss_notes", false);
                objectPush(json, "Reminder Recipients", "pss_reminder_recipients", false);

                // Concatenated value so handling differently...
                json.push({ "label": "Reminder due",
                            "value": $("#pss_reminder_quantity").val() + " " + $("#pss_reminder_units option[value='" + $("#pss_reminder_units").val() + "']").text()
                });
                break;

            case 'ccs':
                json.push({ "label": "Entry Selection", "value": "Component change" });
                objectPush(json, "Component Type", "ccs_component_type", true);
                objectPush(json, "Component", "ccs_component", true);
                objectPush(json, "Component Data", "ccs_component_data", false);
                objectPush(json, "Notes", "ccs_notes", false);
                break;
        }
         
        return json;
    }
    
    function objectPush(objectName, objectLabel, fieldName, bool) {
        objectName.push({ "label": objectLabel,
                          "value": ( bool ? $("#" + fieldName + " option[value='" + $("#" + fieldName).val() + "']").text() :
                                            $("#" + fieldName).val()
                                   )
                        });   
    }
    
    function empty(data) {
        if(typeof(data) == 'number' || typeof(data) == 'boolean')
        { 
          return false; 
        }
        if(typeof(data) == 'undefined' || data === null)
        {
          return true; 
        }
        if(typeof(data.length) != 'undefined')
        {
          return data.length == 0;
        }
        var count = 0;
        for(var i in data)
        {
          if(data.hasOwnProperty(i))
          {
            count ++;
          }
        }
        return count == 0;
      }
        
    window.Parsley
        .addValidator('equipmentrequired', {
            requirementType: 'string',
            validateString: function(value, requirement) {
                var equipment_typeahead = $("#equipment_typeahead").val(),
                    equipment_id = $("#equipment_id").val();
                if( !empty(equipment_typeahead)===false || !empty(equipment_id)===false ) {
                    return false;
                } else {
                    return true;
                }
            },
            messages: {
                en: 'Please select a valid piece of equipment.'
            }
        });
</script>