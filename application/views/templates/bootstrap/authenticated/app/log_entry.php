<form id="serviceLog" action="#">
    
    <div class="group">
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
    
    <div class="group">
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
    
    <div class="group">
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
    
    <div class="group">
        <div class="form-group">
            <label for="entered_by" class="control-label">Entry Selection</label>
            <select id="entered_by" name="entered_by" class="form-control">
                <option value="">Select one:</option>
                <option value="smr_update">SMR update</option>
                <option value="pm_service">PM service</option>
                <option value="component">Component</option>
                <option value="service_reminder">Service reminder</option>
            </select>
        </div>
    </div>
    
    <div>
        <div class="form-group">
            <button id="btnNext" type="submit">Next &raquo;</button>
        </div>
    </div>
</form>

<script>
var q = 1,
    qMax = 0;

$(function () {
    qMax = $('#serviceLog div.group').length;
    $('#serviceLog div.group').hide();
    $('#serviceLog div.group:nth-child(1)').show();
    $('#btnNext').on('click', function (event) {
        event.preventDefault();
        handleClick();
    });
});

function handleClick() {
    if (q < qMax) {
        $('#serviceLog div.group:nth-child(' + q + ')').hide();
        $('#serviceLog div.group:nth-child(' + (q + 1) + ')').show();
        if (q == (qMax - 1)) {
            $('#btnNext').html('Submit');
            $('#btnNext').prop('disabled', true);
        }
        q++;
    } else {
        alert('Submitting'); // Add code to submit your form
    }
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