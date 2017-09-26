<form id="serviceLog" action="#">
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="date_entered" class="control-label lb-lg">Date Entered</label>
            <div class="input-group date">
                <div class="input-group-addon">
                   <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control input-lg" id="date_entered" name="date_entered" value="<?php echo date("m/d/Y"); ?>">
             </div>
        </div>
    </div>
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="entered_by" class="control-label lb-lg">Entered By</label>
            <select id="entered_by" name="entered_by" class="form-control input-lg">
                <option value="">Select one:</option>
                <option value="124566"<?php echo ($_SESSION['first_name']=='Bret' && $_SESSION['last_name']=='Johnson' ? ' selected' : ''); ?>>Johnson, Bret</option>
                <option value="622141"<?php echo ($_SESSION['first_name']=='Neil' && $_SESSION['last_name']=='Johnson' ? ' selected' : ''); ?>>Johnson, Neil</option>
                <option value="124512"<?php echo ($_SESSION['first_name']=='John' && $_SESSION['last_name']=='Leonetti' ? ' selected' : ''); ?>>Leonetti, John</option>
                <option value="333333"<?php echo ($_SESSION['first_name']=='Kevin' && $_SESSION['last_name']=='Sawicke' ? ' selected' : ''); ?>>Sawicke, Kevin</option>
            </select>
        
            <label for="serviced_by" class="control-label lb-lg">Serviced By</label>
            <select id="serviced_by" name="serviced_by" class="form-control input-lg" multiple>
                <option value="124566">Doe, John</option>
                <option value="124512">Johnson, Neil</option>
                <option value="622141">Smith, Joe</option>
                <option value="622141">Xavier, Jose</option>
            </select>
        </div>
    </div>
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="equipment_type" class="control-label lb-lg">Equipment Type</label>
            <select id="equipment_type" name="equipment_type" class="form-control input-lg">
                <option value="">Select one:</option>
                <option value="22252525">Loader</option>
                <option value="2352">Forklift</option>
                <option value="43435352">Light Vehicle</option>
                <option value="253788">Other</option>
            </select>
        
            <label for="equipment" class="control-label lb-lg">Equipment</label>
            <select id="equipment" name="equipment" class="form-control input-lg" disabled>
                <option value="" selected>Select one:</option>
                <!--option value="1000">Unit 1000 | Manufacturer Model 100</option>
                <option value="1002">Unit 1002 | Manufacturer Model 600</option>
                <option value="1004">Unit 1004 | Manufacturer Model 400</option>
                <option value="1006">Unit 1006 | Manufacturer Model 300</option-->
            </select>
        </div>
    </div>
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="subflow" class="control-label lb-lg">Entry Selection</label>
            <select id="subflow" name="subflow" class="form-control input-lg">
                <option value="">Select one:</option>
                <option value="sus">SMR update</option>
                <option value="pss">PM service</option>
                <option value="ccs">Component Change</option>
                <!--option value="service_reminder">Service reminder</option-->
            </select>
        </div>
    </div>
    
    <!-- SMR UPDATE SUBFLOW -->
    <div class="group smrUpdateSubflow" data-sus-step="1">
        <div class="form-group">
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="sus_fluid_type" class="control-label lb-lg">Fluid Type</label>
                    <select id="sus_fluid_type" name="fluid_type" class="form-control input-lg">
                        <option value="">Select one:</option>
                        <option value="22252525">Diesel - On Highway</option>
                        <option value="2352">Diesel - Off</option>
                        <option value="43435352">Gasoline</option>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="sus_quantity" class="control-label lb-lg">Quantity</label>
                    <input type="text" id="sus_quantity" name="sus_quantity" class="form-control input-lg">
                </div>

                <div class="col-lg-9 col-md-9 col-sm-9">
                    <label for="sus_units" class="control-label lb-lg">&nbsp;</label>
                    <select id="sus_units" name="sus_units" class="form-control input-lg">
                        <option value="" selected>Select one:</option>
                        <option value="gal">Gallons (gal)</option>
                        <option value="L">Liters (L)</option>
                    </select>
                </div>
            </div>
        
        </div>
    </div>
    
    <div class="group smrUpdateSubflow" data-sus-step="2">
        <div class="form-group">
            <label for="sus_miles" class="control-label lb-lg">SMR / Miles</label>
            <input type="text" class="form-control input-lg" id="sus_miles" name="sus_miles" value="">
        </div>
    </div>
    <!-- /SMR UPDATE SUBFLOW -->
    
    
    
    <!-- PM SERVICE SUBFLOW -->
    <div class="group pmServiceSubflow" data-pss-step="1">
        <div class="form-group">
            <label for="pss_pm_type" class="control-label lb-lg">PM Type</label>
            <select id="pss_pm_type" name="pss_pm_type" class="form-control input-lg">
                <option value="">Select one:</option>
                <option value="smr_based">SMR based</option>
                <option value="mileage_based">Mileage based</option>
                <option value="time_based">Time based</option>
            </select>
        </div>
    </div>
    
    <div class="group pmServiceSubflow" data-pss-step="2">
        <div class="form-group">
            <label for="pss_smr" class="control-label lb-lg">SMR</label>
            <select id="pss_smr" name="pss_smr" class="form-control input-lg">
                <option value="">Select one:</option>
                <option value="250">250</option>
                <option value="500">500</option>
                <option value="1000">1000</option>
                <option value="1500">1500</option>
            </select>
        </div>
    </div>
    
    <div class="group pmServiceSubflow" data-pss-step="3">
        <div class="form-group">
            SERVICE REMINDER<br /><br />
            <label for="pss_reminder_pm_type" class="control-label lb-lg">PM Type</label>
            <select id="pss_reminder_pm_type" name="pss_reminder_pm_type" class="form-control input-lg">
                <option value="">Select one:</option>
                <option value="smr_based">SMR Based</option>
                <option value="mileage_based">Mileage Based</option>
                <option value="time_based">Time Based</option>
            </select>
            
            <label for="pss_smr_due" class="control-label lb-lg">SMR Due</label>
            <input type="text" class="form-control input-lg" id="pss_smr_due" name="pss_smr_due" value="">
        </div>
    </div>
    
    <div class="group pmServiceSubflow" data-pss-step="4">
        <div class="form-group">
            <label for="pss_notes" class="control-label lb-lg">Notes</label>
            <input type="text" class="form-control input-lg" id="pss_notes" name="pss_notes" value="">
        </div>
    </div>
    
    <div class="group pmServiceSubflow" data-pss-step="5">
        <div class="form-group">
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="pss_reminder_recipients" class="control-label lb-lg">REMINDER RECIPIENTS</label>
                    <input type="text" id="pss_reminder_recipients" name="pss_reminder_recipients" class="form-control input-lg" value="email1@email.com,email2@email2.com">
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pss_reminder_quantity" class="control-label lb-lg">&nbsp;</label>
                    <input type="text" id="pss_reminder_quantity" name="pss_reminder_quantity" class="form-control input-lg">
                </div>

                <div class="col-lg-9 col-md-9 col-sm-9">
                    <label for="pss_reminder_units" class="control-label lb-lg">&nbsp;</label>
                    <select id="pss_reminder_units" name="pss_reminder_units" class="form-control input-lg">
                        <option value="" selected>Select one:</option>
                        <option value="smr">SMR</option>
                        <option value="miles">Miles</option>
                        <option value="days">Days</option>
                    </select>
                </div>
            </div>
            
        </div>
    </div>
    <!-- PM SERVICE SUBFLOW -->
    
    
    
    <!-- COMPONENT CHANGE SUBFLOW -->
    <div class="group componentChangeSubflow" data-ccs-step="1">
        <div class="form-group">
            <label for="ccs_component" class="control-label lb-lg">Component</label>
            <select id="ccs_component" name="ccs_component" class="form-control input-lg">
                <option value="">Select one:</option>
                <option value="engine">Engine</option>
                <option value="final_drive">Final drive</option>
                <option value="suspension">Suspension</option>
                <option value="software">Software</option>
                <option value="other">Other</option>
            </select>
        </div>
    </div>
    
    <div class="group componentChangeSubflow" data-ccs-step="2">
        <div class="form-group">
            <label for="ccs_component_info" class="control-label lb-lg">Component Info</label>
            <select id="ccs_component_info" name="ccs_component_info" class="form-control input-lg">
                <option value="">Select one:</option>
                <option value="serial_no">Serial #</option>
                <option value="revision_no">Revision #</option>
                <option value="part_no">Part #</option>
                <option value="campaign_no">Campaign #</option>
                <option value="none">None</option>
            </select>
            
            <label for="ccs_data_entry" class="control-label lb-lg">Data Entry</label>
            <input type="text" class="form-control input-lg" id="ccs_data_entry" name="ccs_data_entry">
        </div>
    </div>
    
    <div class="group componentChangeSubflow" data-ccs-step="3">
        <div class="form-group">
            <label for="ccs_notes" class="control-label lb-lg">Notes</label>
            <input type="text" class="form-control input-lg" id="ccs_notes" name="ccs_notes" value="">
        </div>
    </div>
    <!-- COMPONENT CHANGE SUBFLOW -->
    
    
    
    <!-- SERVICE REMINDER SUBFLOW -->
    
    <!-- SERVICE REMINDER SUBFLOW -->
    
    
    <div class="lastCall">
        <div class="form-group">
            <button id="btnGoBack" type="button" class="btn btn-lg btn-primary">&laquo; Go Back</button>
            <button id="btnNext" type="button" class="btn btn-lg btn-primary">Next &raquo;</button>
        </div>
    </div>
    
    <div class="group reviewScreen">
        
        <div class="alert alert-warning" role="alert">
            <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;&nbsp;Please review your entries before submitting.</h4>        
        </div>
        
        
        
        <strong>Field name</strong>
        <ul>
            <li>Response</li>
        </ul>
        
        <strong>Field name</strong>
        <ul>
            <li>Response</li>
        </ul>
        
        <strong>Field name</strong>
        <ul>
            <li>Response</li>
        </ul>
        
        <strong>Field name</strong>
        <ul>
            <li>Response</li>
        </ul>
        
        <strong>Field name</strong>
        <ul>
            <li>Response</li>
        </ul>
        
        <button id="btnGoBack2" type="button" class="btn btn-lg btn-primary">&laquo; Go Back</button>
        <button id="btnSubmit" type="button" class="btn btn-lg btn-primary">Submit</button>
    </div>
    
</form>

<script>
var groupCount = 1,
    mainFlowGroupCount = 1,
    smrUpdateSubflowGroupCount = 1,
    pmServiceSubflowGroupCount = 1,
    componentChangeSubflowGroupCount = 1,
    subFlowCount = 1,
    mainFlowCount = 1,
    smrUpdateSubflowCount = 1,
    pmServiceSubflowCount = 1,
    componentChangeSubflowCount = 1,
    groupCountMax = 0,
    subflowChosen = '',
    showReviewNext = false;

//$(function () {
$(document).ready(function() {
    /** Handle pop up content **/
    var windowWidth = $(window).width(),
        dialogWidth = windowWidth * 0.65,
        windowHeight = $(window).height(),
        dialogHeight = windowHeight * 0.65;
        
    var confirmationMessage = '<div class="jBoxContentBodyText">Are you sure you want to submit this log?<br /><br /><button id="confirmAnswerNo" type="button">No</button>&nbsp;&nbsp;&nbsp;<button id="confirmAnswerYes" type="button">Yes</button></div>';
    var confirmSubmitJBox = new jBox('Modal', {
        closeButton: 'title',
        responsiveWidth: true,
        responsiveHeight: true,
        minWidth: dialogWidth,
        minHeight: dialogHeight,
        attach: '#btnSubmit',
        title: 'Confirm',
        content: confirmationMessage,
        zIndex: 15000,
            preventDefault: true,
            preloadAudio: false
    });
    
    mainFlowGroupCount = $('#serviceLog div.mainFlow').length;
    smrUpdateSubflowGroupCount = $('#serviceLog div.smrUpdateSubflow').length;
    pmServiceSubflowGroupCount = $('#serviceLog div.pmServiceSubflow').length;
    componentChangeSubflowGroupCount = $('#serviceLog div.componentChangeSubflow').length;
    groupCountMax = $('#serviceLog div.group').length;
//    subflowChosen = $("#subflow").val();
    
    console.log("groupCount: " + groupCount);
    console.log("mainFlowCount: " + mainFlowCount);
    console.log("smrUpdateSubflowCount: " + smrUpdateSubflowCount);
    console.log("pmServiceSubflowCount: " + pmServiceSubflowCount);
    console.log("componentChangeSubflowCount: " + componentChangeSubflowCount);
    
    $("#serviceLog div.reviewScreen").hide();
    $("#btnGoBack").hide();
    $('#serviceLog div.group').hide();
    $('#serviceLog div.group:nth-child(1)').show();
    $('#btnNext').on('click', function (event) {
        event.preventDefault();
        handleClick();
    });
    
    $('#subflow').on('change', function (event) {
        event.preventDefault();
        if($(this).val()!='') {
            $('#btnNext').prop('disabled', false);
            subflowChosen = $("#subflow").val();
        }
    });
    
    $("#btnGoBack2").on('click', function (event) {
        event.preventDefault();
        alert("Clicked Go Back");
    });
    
    $(document).on('click', '#confirmAnswerNo', function (event) {
        event.preventDefault();
        confirmSubmitJBox.close();
    });
    
    $(document).on('click', '#confirmAnswerYes', function (event) {
        event.preventDefault();
        confirmSubmitJBox.close();
        alert('We will submit form here....');
    });
});

function handleClick() {
//    subflowChosen = $("#subflow").val();
    console.log('subflowChosen: ' + subflowChosen);

    if(!showReviewNext) {
        if(subflowChosen === '') {
            console.log(">>> " + groupCount);
            var lastElement = $('#serviceLog div.group:nth-child(' + groupCount + ')'),
                nextElement = $('#serviceLog div.group:nth-child(' + (groupCount + 1) + ')');
        }
        if(subflowChosen === 'sus') {
            console.log(">>> " + smrUpdateSubflowCount);
            $('#serviceLog div.group').hide();
//            var lastElement = $('#serviceLog div.smrUpdateSubflow:nth-child(' + (smrUpdateSubflowCount - 1) + ')'),
//                nextElement = $('#serviceLog div.smrUpdateSubflow:nth-child(' + smrUpdateSubflowCount + ')');
            var lastElement = $('[data-sus-step="' + (smrUpdateSubflowCount - 1) + '"]'),
                nextElement = $('[data-sus-step="' + smrUpdateSubflowCount + '"]');
        }
        if(subflowChosen === 'pss') {
            console.log(">>> " + pmServiceSubflowCount);
            $('#serviceLog div.group').hide();

            var lastElement = $('[data-pss-step="' + (pmServiceSubflowCount - 1) + '"]'),
                nextElement = $('[data-pss-step="' + pmServiceSubflowCount + '"]');
        
            console.log("TEST 1: " + pmServiceSubflowCount);
        }
        if(subflowChosen === 'ccs') {
            console.log(">>> " + componentChangeSubflowCount);
            $('#serviceLog div.group').hide();
//            var lastElement = $('#serviceLog div.componentChangeSubflow:nth-child(' + (componentChangeSubflowCount - 1) + ')'),
//                nextElement = $('#serviceLog div.componentChangeSubflow:nth-child(' + componentChangeSubflowCount + ')');
            var lastElement = $('[data-ccs-step="' + (componentChangeSubflowCount - 1) + '"]'),
                nextElement = $('[data-ccs-step="' + componentChangeSubflowCount + '"]');
        }
        
        console.log(nextElement);
                    
        lastElement.hide();
        nextElement.show();
        
        if(nextElement.hasClass('mainFlow')) {
            console.log("Element is within MAIN FLOW");
            console.log("mainFlowGroupCount: " + mainFlowGroupCount);
            mainFlowCount++;
            
            if(mainFlowCount === 4) {
                $('#btnNext').prop('disabled', true);
            }
        }
        
        if(nextElement.hasClass('smrUpdateSubflow')) {
            console.log("==========================");
            smrUpdateSubflowCount++;
            console.log("Element is within SMR UPDATE SUB FLOW");
            console.log("smrUpdateSubflowCount: " + smrUpdateSubflowCount);
            console.log("smrUpdateSubflowGroupCount: " + smrUpdateSubflowGroupCount);
            subFlowCount++;
            
            if(smrUpdateSubflowCount === smrUpdateSubflowGroupCount + 1) {
                changeNextButtonToReview();
                showReviewNext = true;
            }
            
//            subflowChosen = 'smrUpdateSubflow';
        }
        
        if(nextElement.hasClass('pmServiceSubflow')) {
            console.log("==========================");
            console.log("Element is within PM SERVICE SUBFLOW");
            console.log("### pmServiceSubflowCount: " + pmServiceSubflowCount);
            console.log("pmServiceSubflowGroupCount: " + pmServiceSubflowGroupCount);
            pmServiceSubflowCount++;
            subFlowCount++;
            
            if(pmServiceSubflowCount === pmServiceSubflowGroupCount + 1) {
                changeNextButtonToReview();
                showReviewNext = true;
            }
            
//            subflowChosen = 'pmServiceSubflow';
        }
        
        if(nextElement.hasClass('componentChangeSubflow')) {
            console.log("==========================");
            componentChangeSubflowCount++;
            console.log("Element is within COMPONENT CHANGE FLOW");
            console.log("componentChangeSubflowCount: " + componentChangeSubflowCount);
            console.log("componentChangeSubflowGroupCount: " + componentChangeSubflowGroupCount);
            subFlowCount++;
            
            if(componentChangeSubflowCount === componentChangeSubflowGroupCount + 1) {
                changeNextButtonToReview();
                showReviewNext = true;
            }
            
//            subflowChosen = 'componentChangeSubflow';
        }
        
//        console.log("subFlowCount: " + subFlowCount);
        
//        if (groupCount == (groupCountMax - 1)) {
//            $('#btnNext').html('Submit');
//            $('#btnNext').prop('disabled', true);
//        }
        groupCount++;
    } else {
        showReviewScreen();
//        alert('Submitting'); // Add code to submit your form
    }
}

function changeNextButtonToReview() {
//    $("#btnGoBack").show();
    $('#btnNext').html('Review &raquo;');
//    $('#btnNext').prop('disabled', true);
}

function showReviewScreen() {
    $('#serviceLog div.mainFlow').hide();
    $('#serviceLog div.smrUpdateSubflow').hide();
    $('#serviceLog div.pmServiceSubflow').hide();
    $('#serviceLog div.componentChangeSubflow').hide();
    $('#serviceLog div.lastCall').hide();
    $("#serviceLog div.reviewScreen").show();
    
    reviewScreenData = getReviewScreenData();
    
    $.each( reviewScreenData, function( key, value ) {
        console.log( key + ": " + value );
    });
}

function getReviewScreenData() {
    var reviewScreenData = {
        date_entered: $("#date_entered").val(),
        entered_by: $("#entered_by").val(),
        serviced_by: $("#serviced_by").val(),
        equipment_type: $("#equipment_type").val(),
        subflow: $("#subflow").val()
    };
    
    if(subflowChosen === 'smrUpdateSubflow') {
        reviewScreenData.sus_fluid_type = $("#sus_fluid_type").val();
        reviewScreenData.sus_quantity = $("#sus_quantity").val();
        reviewScreenData.sus_units = $("#sus_units").val();
        reviewScreenData.sus_miles = $("#sus_miles").val();
    }
    
    if(subflowChosen === 'pmServiceSubflow') {
        reviewScreenData.pss_pm_type = $("#pss_pm_type").val();
        reviewScreenData.pss_smr = $("#pss_smr").val();
        reviewScreenData.pss_reminder_pm_type = $("#pss_reminder_pm_type").val();
        reviewScreenData.pss_smr_due = $("#pss_smr_due").val();
        reviewScreenData.pss_notes = $("#pss_notes").val();
        reviewScreenData.pss_reminder_recipients = $("#pss_reminder_recipients").val();
        reviewScreenData.pss_reminder_quantity = $("#pss_reminder_quantity").val();
        reviewScreenData.pss_reminder_units = $("#pss_reminder_units").val();
    }
    
    if(subflowChosen === 'componentChangeSubflow') {
        reviewScreenData.ccs_component = $("#ccs_component").val();
        reviewScreenData.ccs_component_info = $("#ccs_component_info").val();
        reviewScreenData.ccs_data_entry = $("#ccs_data_entry").val();
        reviewScreenData.ccs_notes = $("#ccs_notes").val();  
    }
    
    return reviewScreenData;
}

$('#date_entered').datepicker({
    autoclose: true,
    dateFormat: 'mm/dd/yyyy'
});

$('#equipment_type').on('change', function() {
    console.log('equipment_type changed');
    $("#equipment").prop('disabled', false);
    $('#equipment').append('<option value="foo" selected="selected">Foo</option>');
    $('#equipment').append('<option value="foo2" selected="selected">Foo 2</option>');
    $('#equipment').append('<option value="foo3" selected="selected">Foo 3</option>');
});

//$(document).ready(function () {
//    var q = 1,
//        qMax = 0,
//        logEntry = {
//            ui : {
//                init : function() {
//                    qMax = $('#serviceLog div.group').length;
//                    $('#serviceLog div.group').hide();
//                    $('#serviceLog div.group:nth-child(1)').show();
//                    $('#btnNext').on('click', function (event) {
//                        event.preventDefault();
//                        logEntry.ui.handleClick();
//                    });
//                },
//                handleClick : function() {
//                    if (q < qMax) {
//                        $('#servicleLog div.group:nth-child(' + q + ')').hide();
//                        $('#serviceLog div.group:nth-child(' + (q + 1) + ')').show();
//                        if (q == (qMax - 1)) {
//                            $('#btnNext').html('Submit Answers');
//                        }
//                        q++;
//                    } else {
//                        alert('Submitting'); // Add code to submit your form
//                    }
//                }
//            }
//        };
//        
//    logEntry.ui.init();
//    var Engine = {
//        ui : {
//            helloWorld : function(){
//                alert("Hello World");
//            }, // helloWorld
//
//            alertFun : function(phrase){
//                /*
//                I can even add comments here as well
//                explaining what the heck this thing does
//                */
//                alert(phrase);
//            }, // alertFun
//        } // ui
//    }; // Engine
//
//    Engine.ui.helloWorld();
//    Engine.ui.alertFun("I like cats");
//});
</script>