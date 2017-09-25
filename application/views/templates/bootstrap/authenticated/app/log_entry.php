<form id="serviceLog" action="#">
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="date_entered" class="control-label">Date Entered</label>
            <div class="input-group date">
                <div class="input-group-addon">
                   <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control" id="date_entered" name="date_entered" class="form-control" value="<?php echo date("m/d/Y"); ?>">
             </div>
        </div>
    </div>
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="entered_by" class="control-label">Entered By</label>
            <select id="entered_by" name="entered_by" class="form-control">
                <option value="">Select one:</option>
                <option value="124566"<?php echo ($_SESSION['first_name']=='Bret' && $_SESSION['last_name']=='Johnson' ? ' selected' : ''); ?>>Johnson, Bret</option>
                <option value="622141"<?php echo ($_SESSION['first_name']=='Neil' && $_SESSION['last_name']=='Johnson' ? ' selected' : ''); ?>>Johnson, Neil</option>
                <option value="124512"<?php echo ($_SESSION['first_name']=='John' && $_SESSION['last_name']=='Leonetti' ? ' selected' : ''); ?>>Leonetti, John</option>
                <option value="333333"<?php echo ($_SESSION['first_name']=='Kevin' && $_SESSION['last_name']=='Sawicke' ? ' selected' : ''); ?>>Sawicke, Kevin</option>
            </select>
        
            <label for="serviced_by" class="control-label">Serviced By</label>
            <select id="serviced_by" name="serviced_by" class="form-control" multiple>
                <option value="124566">Doe, John</option>
                <option value="124512">Johnson, Neil</option>
                <option value="622141">Smith, Joe</option>
                <option value="622141">Xavier, Jose</option>
            </select>
        </div>
    </div>
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="equipment_type" class="control-label">Equipment Type</label>
            <select id="equipment_type" name="equipment_type" class="form-control">
                <option value="">Select one:</option>
                <option value="22252525">Loader</option>
                <option value="2352">Forklift</option>
                <option value="43435352">Light Vehicle</option>
                <option value="253788">Other</option>
            </select>
        
            <label for="equipment" class="control-label">Equipment</label>
            <select id="equipment" name="equipment" class="form-control" disabled>
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
            <label for="entered_by" class="control-label">Entry Selection</label>
            <select id="entered_by" name="entered_by" class="form-control">
                <option value="">Select one:</option>
                <option value="smr_update">SMR update</option>
                <!--option value="pm_service">PM service</option>
                <option value="component">Component</option>
                <option value="service_reminder">Service reminder</option-->
            </select>
        </div>
    </div>
    
    <!-- SMR UPDATE SUBFLOW -->
    <div class="group smrUpdateSubflow">
        <div class="form-group">
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="fluid_type" class="control-label">Fluid Type</label>
                    <select id="fluid_type" name="fluid_type" class="form-control">
                        <option value="">Select one:</option>
                        <option value="22252525">Diesel - On Highway</option>
                        <option value="2352">Diesel - Off</option>
                        <option value="43435352">Gasoline</option>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="quantity" class="control-label">Quantity</label>
                    <input type="text" id="quantity" name="quantity">
                </div>

                <div class="col-lg-9 col-md-9 col-sm-9">
                    <label for="units" class="control-label">&nbsp;</label>
                    <select id="units" name="units" class="form-control">
                        <option value="" selected>Select one:</option>
                        <option value="gal">Gallons (gal)</option>
                        <option value="L">Liters (L)</option>
                    </select>
                </div>
            </div>
        
        </div>
    </div>
    
    <div class="group smrUpdateSubflow">
        <div class="form-group">
            <label for="smr_miles" class="control-label">SMR / Miles</label>
            <input type="text" class="form-control" id="smr_miles" name="smr_miles" class="form-control" value="">
        </div>
    </div>
    <!-- /SMR UPDATE SUBFLOW -->
    
    
    
    <!-- PM SERVICE SUBFLOW -->
    <div class="group pmServiceSubflow">
        <div class="form-group">
            <label for="pm_type" class="control-label">PM Type</label>
            <select id="pm_type" name="pm_type" class="form-control">
                <option value="">Select one:</option>
                <option value="smr_based">SMR based</option>
                <option value="mileage_based">Mileage based</option>
                <option value="time_based">Time based</option>
            </select>
        </div>
    </div>
    
    <div class="group pmServiceSubflow">
        <div class="form-group">
            <label for="smr" class="control-label">SMR</label>
            <select id="smr" name="smr" class="form-control">
                <option value="">Select one:</option>
                <option value="250">250</option>
                <option value="500">500</option>
                <option value="1000">1000</option>
                <option value="1500">1500</option>
            </select>
        </div>
    </div>
    
    <div class="group pmServiceSubflow">
        <div class="form-group">
            SERVICE REMINDER<br /><br />
            <label for="pm_type" class="control-label">PM Type</label>
            <select id="pm_type" name="pm_type" class="form-control">
                <option value="">Select one:</option>
                <option value="smr_based">SMR Based</option>
                <option value="mileage_based">Mileage Based</option>
                <option value="time_based">Time Based</option>
            </select>
            
            <label for="smr_due" class="control-label">SMR Due</label>
            <input type="text" class="form-control" id="smr_due" name="smr_due" class="form-control" value="">
        </div>
    </div>
    
    <div class="group pmServiceSubflow">
        <div class="form-group">
            <label for="notes" class="control-label">Notes</label>
            <input type="text" class="form-control" id="notes" name="notes" class="form-control" value="">
        </div>
    </div>
    
    <div class="group pmServiceSubflow">
        <div class="form-group">
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="pm_type" class="control-label">REMINDER RECIPIENTS</label>
                    <input type="text" id="pm_type" name="pm_type" class="form-control" value="email1@email.com,email2@email2.com">
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="rminder_quantity" class="control-label">&nbsp;</label>
                    <input type="text" id="rminder_quantity" name="rminder_quantity">
                </div>

                <div class="col-lg-9 col-md-9 col-sm-9">
                    <label for="reminder_units" class="control-label">&nbsp;</label>
                    <select id="reminder_units" name="reminder_units" class="form-control">
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
    <div class="group componentChangeSubflow">
        <div class="form-group">
            <label for="component" class="control-label">Component</label>
            <select id="component" name="component" class="form-control">
                <option value="">Select one:</option>
                <option value="engine">Engine</option>
                <option value="final_drive">Final drive</option>
                <option value="suspension">Suspension</option>
                <option value="software">Software</option>
                <option value="other">Other</option>
            </select>
        </div>
    </div>
    
    <div class="group componentChangeSubflow">
        <div class="form-group">
            <label for="component" class="control-label">Component Info</label>
            <select id="component" name="component" class="form-control">
                <option value="">Select one:</option>
                <option value="serial_no">Serial #</option>
                <option value="revision_no">Revision #</option>
                <option value="part_no">Part #</option>
                <option value="campaign_no">Campaign #</option>
                <option value="none">None</option>
            </select>
            
            <label for="data_entry" class="control-label">Data Entry</label>
            <input type="text" class="form-control" id="data_entry" name="data_entry">
        </div>
    </div>
    
    <div class="group componentChangeSubflow">
        <div class="form-group">
            <label for="notes" class="control-label">Notes</label>
            <input type="text" class="form-control" id="notes" name="notes" class="form-control" value="">
        </div>
    </div>
    <!-- COMPONENT CHANGE SUBFLOW -->
    
    
    
    <!-- SERVICE REMINDER SUBFLOW -->
    
    <!-- SERVICE REMINDER SUBFLOW -->
    
    
    <div class="lastCall">
        <div class="form-group">
            <button id="btnGoBack" type="submit">&laquo; Go Back</button>
            <button id="btnNext" type="submit">Next &raquo;</button>
        </div>
    </div>
    
    <div class="group reviewScreen">
        
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            Please review your entries before submitting.
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
        
        <button id="btnGoBack2" type="submit">&laquo; Go Back</button>
        <button id="btnSubmit" type="submit">Submit</button>
    </div>
    
</form>

<script>
var groupCount = 1,
    mainFlowGroupCount = 1,
    smrUpdateSubflowGroupCount = 1,
    pmServiceSubflowGroupCount = 1,
    componentChangeSubflowGroupCount = 1,
    subFlowCount = 1,
    mainFlowCount = 0,
    smrUpdateSubflowCount = 0,
    pmServiceSubflowCount = 0,
    componentChangeSubflowCount = 0,
    groupCountMax = 0,
    showReviewNext = false;

$(function () {
    mainFlowGroupCount = $('#serviceLog div.mainFlow').length;
    smrUpdateSubflowGroupCount = $('#serviceLog div.smrUpdateSubflow').length;
    pmServiceSubflowGroupCount = $('#serviceLog div.pmServiceSubflow').length;
    componentChangeSubflowGroupCount = $('#serviceLog div.componentChangeSubflow').length;
    groupCountMax = $('#serviceLog div.group').length;
    
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
});

function handleClick() {
//    if (groupCount < groupCountMax) {
    if(!showReviewNext) {
        var lastElement = $('#serviceLog div.group:nth-child(' + groupCount + ')'),
            nextElement = $('#serviceLog div.group:nth-child(' + (groupCount + 1) + ')');
            
        lastElement.hide();
        nextElement.show();
        
        if(nextElement.hasClass('mainFlow')) {
            console.log("Element is within MAIN FLOW");
            console.log("mainFlowGroupCount: " + mainFlowGroupCount);
        }
        
        if(nextElement.hasClass('smrUpdateSubflow')) {
            console.log("==========================");
            smrUpdateSubflowCount++;
            console.log("Element is within SMR UPDATE SUB FLOW");
            console.log("smrUpdateSubflowCount: " + smrUpdateSubflowCount);
            console.log("smrUpdateSubflowGroupCount: " + smrUpdateSubflowGroupCount);
            subFlowCount++;
            
            if(smrUpdateSubflowCount == smrUpdateSubflowGroupCount) {
                changeNextButtonToReview();
                showReviewNext = true;
            }
        }
        
        if(nextElement.hasClass('pmServiceSubflow')) {
            console.log("==========================");
            pmServiceSubflowCount++;
            console.log("Element is within COMPONENT CHANGE SUBFLOW");
            console.log("pmServiceSubflowCount: " + pmServiceSubflowCount);
            console.log("pmServiceSubflowGroupCount: " + pmServiceSubflowGroupCount);
            subFlowCount++;
            
            if(pmServiceSubflowCount == pmServiceSubflowGroupCount) {
                changeNextButtonToReview();
                showReviewNext = true;
            }
        }
        
        if(nextElement.hasClass('componentChangeSubflow')) {
            console.log("==========================");
            componentChangeSubflowCount++;
            console.log("Element is within MAIN FLOW");
            console.log("componentChangeSubflowCount: " + componentChangeSubflowCount);
            console.log("componentChangeSubflowGroupCount: " + componentChangeSubflowGroupCount);
            subFlowCount++;
            
            if(componentChangeSubflowCount == componentChangeSubflowGroupCount) {
                changeNextButtonToReview();
                showReviewNext = true;
            }
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