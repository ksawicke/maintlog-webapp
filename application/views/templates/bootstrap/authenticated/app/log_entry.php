<form id="serviceLog" action="#">
    <div class="group">
        <label for="date_entered">Date</label>
        <input type="text" id="date_entered" name="date_entered" />
    </div>
    <div class="group">
        <label for="entered_by">Entered By</label>
        <select id="entered_by" name="entered_by">
            <option value="">Select one:</option>
            <option value="124566">Doe, John</option>
            <option value="124512">Johnson, Neil</option>
            <option value="622141">Smith, Joe</option>
        </select>
        
        <label for="serviced_by">Serviced By</label>
        <select id="serviced_by" name="serviced_by" multiple>
            <option value="124566">Doe, John</option>
            <option value="124512">Johnson, Neil</option>
            <option value="622141">Smith, Joe</option>
            <option value="622141">Xavier, Jose</option>
        </select>
    </div>
    <div class="group">
        <label for="value3">Value 3</label>
        <input type="text" id="value3" name="value3" />
    </div>
    <div class="group">
        <label for="value4">Value 4</label>
        <input type="text" id="value4" name="value4" />
    </div>
    <div class="group">
        <label for="value5">Value 5</label>
        <input type="text" id="value5" name="value5" />
    </div>
    <div class="group">
        <label for="value6">Value 6</label>
        <input type="text" id="value6" name="value6" />
    </div>
    <div class="group">
        <label for="value7">Value 7 (last one)</label>
        <input type="text" id="value7" name="value7" />
    </div>
    <div>
        <button id="btnNext" type="submit">Next</button>
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
            $('#btnNext').html('Submit Answers');
        }
        q++;
    } else {
        alert('Submitting'); // Add code to submit your form
    }
}

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