<form class="serviceLog-form">
    <div class="form-section">
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

    <div class="form-section">
        <label for="entered_by" class="control-label lb-lg">Entered By</label>
        <select id="entered_by"
                name="entered_by"
                class="form-control input-lg"
                data-parsley-required="true"
                data-parsley-error-message="Please select who entered the record"
                data-parsley-errors-container=".entered_by_errors">
            <option value="">Select one:</option>
            <option value="124566"<?php echo ($_SESSION['first_name']=='Bret' && $_SESSION['last_name']=='Johnson' ? ' selected' : ''); ?>>Johnson, Bret</option>
            <option value="622141"<?php echo ($_SESSION['first_name']=='Neil' && $_SESSION['last_name']=='Johnson' ? ' selected' : ''); ?>>Johnson, Neil</option>
            <option value="124512"<?php echo ($_SESSION['first_name']=='John' && $_SESSION['last_name']=='Leonetti' ? ' selected' : ''); ?>>Leonetti, John</option>
            <option value="333333"<?php echo ($_SESSION['first_name']=='Kevin' && $_SESSION['last_name']=='Sawicke' ? ' selected' : ''); ?>>Sawicke, Kevin</option>
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
            <option value="124566">Doe, John</option>
            <option value="124512">Johnson, Neil</option>
            <option value="622141">Smith, Joe</option>
            <option value="622141">Xavier, Jose</option>
        </select>
        <p class="form-error serviced_by_errors"></p>
    </div>

    <div class="form-section">
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

        <label for="equipment_typeahead" class="control-label lb-lg">Equipment</label>
        <br />
        <input id="equipment_typeahead"
               name="equipment_typeahead"
               type="text"
               class="form-control input-lg">
        <p class="form-error equipment_typeahead_errors"></p>
        <input id="equipment"
               name="equipment"
               type="hidden"
               value=""
               data-parsley-required="true"
               data-parsley-error-message="Please choose the equipment affected"
               data-parsley-errors-container=".equipment_typeahead_errors">
    </div>

    <div class="form-section">
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
    <div class="form-section subflow sus">
        
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

    <div class="form-section subflow sus">
        <label for="sus_miles" class="control-label lb-lg">SMR / Miles</label>
        <input
               id="sus_miles"
               name="sus_miles"
               type="text"
               class="form-control input-lg"
               value=""
               data-parsley-required="true"
               data-parsley-error-message="Please enter the current SMR or Miles"
               data-parsley-errors-container=".sus_miles_errors">
        <p class="form-error sus_miles_errors"></p>
    </div>
    <!-- /SMR UPDATE SUBFLOW -->

    <div class="form-section subflow pss">
        <label for="pss_pm_type" class="control-label lb-lg">PM Type</label>
        <select id="pss_pm_type" name="pss_pm_type" class="form-control input-lg">
            <option value="">Select one:</option>
            <option value="smr_based">SMR based</option>
            <option value="mileage_based">Mileage based</option>
            <option value="time_based">Time based</option>
        </select>
    </div>

    <div class="form-section subflow pss">
        <label for="pss_smr" class="control-label lb-lg">SMR</label>
        <select id="pss_smr" name="pss_smr" class="form-control input-lg">
            <option value="">Select one:</option>
            <option value="250">250</option>
            <option value="500">500</option>
            <option value="1000">1000</option>
            <option value="1500">1500</option>
        </select>
    </div>
    <div class="form-section subflow pss">
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

    <div class="form-section subflow pss">
        <label for="pss_notes" class="control-label lb-lg">Notes</label>
        <input type="text" class="form-control input-lg" id="pss_notes" name="pss_notes" value="">
    </div>
    
    <div class="form-section subflow pss">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <label for="pss_reminder_recipients" class="control-label lb-lg">REMINDER RECIPIENTS</label>
                <input type="text" id="pss_reminder_recipients" name="pss_reminder_recipients" class="form-control input-lg" value="email1@email.com,email2@email2.com">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <label for="pss_reminder_recipients" class="control-label lb-lg">ALERT WINDOW BEFORE DUE</label>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <input type="text" id="pss_reminder_quantity" name="pss_reminder_quantity" class="form-control input-lg">
            </div>

            <div class="col-lg-9 col-md-9 col-sm-9">
                <select id="pss_reminder_units" name="pss_reminder_units" class="form-control input-lg">
                    <option value="" selected>Select one:</option>
                    <option value="smr">SMR</option>
                    <option value="miles">Miles</option>
                    <option value="days">Days</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-navigation">
        <button type="button" class="previous btn btn-info">&lt; Previous</button>
        <button type="button" class="next btn btn-lg btn-primary">Next &gt;</button>
        <input type="submit" class="btn btn-default pull-right">
        <span class="clearfix"></span>
    </div>

</form>

<style class="example">
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
                currentSubflow = '';
                
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

//        var confirmationMessage = '<div class="jBoxContentBodyText">Are you sure you want to submit this log?<br /><br /><button id="confirmAnswerNo" type="button">No</button>&nbsp;&nbsp;&nbsp;<button id="confirmAnswerYes" type="button">Yes</button></div>';
//        var confirmSubmitJBox = new jBox('Modal', {
//            closeButton: 'title',
//            responsiveWidth: true,
//            responsiveHeight: true,
//            minWidth: dialogWidth,
//            minHeight: dialogHeight,
//            attach: '#btnSubmit',
//            title: 'Confirm',
//            content: confirmationMessage,
//            zIndex: 15000,
//                preventDefault: true,
//                preloadAudio: false
//        });

        function navigateTo(index) {
            // Mark the current section with the class 'current'
            $sections
                    .removeClass('current')
                    .eq(index)
                    .addClass('current');
            // Show only the navigation buttons that make sense for the current section:
            $('.form-navigation .previous').toggle(index > 0);
            var atTheEnd = index >= $sections.length - 1;
            $('.form-navigation .next').toggle(!atTheEnd);
            $('.form-navigation [type=submit]').toggle(atTheEnd);
        }

        function curIndex() {
            // Return the current index by looking at which section has the class 'current'
            return $sections.index($sections.filter('.current'));
        }

        $('#subflow').on('change', function () {
            subflowSelected = true;
            currentSubflow = $(this).val();

//      console.log("curIndex: " + curIndex());
//      console.log("currentSubflow: " + currentSubflow);
//      console.log("subflowSelected: " + subflowSelected);

//      $("." + currentSubflow + ":first");
            
//      console.log($("." + currentSubflow + ":first"));
//      navigateTo(7);

//      $sections.each(function(index, section) {
//         if(index == curIndex()+1 ) {
//           $(section).find(':input').attr('data-parsley-group', 'block');
//         }
//      });

//      $sections.each(function(index, section) {
//         $(section).find(':input').attr('data-parsley-group', 'block-' + (curIndex() + index));
//      });

//      $sections.each(function(index, section) {
//         $(section).find(':input').attr('data-parsley-group', 'block-' + index);
//      });
        });

        // Previous button is easy, just go back
        $('.form-navigation .previous').click(function () {
            navigateTo(curIndex() - 1);
        });

        // Next button goes forward if current block validates
        $('.form-navigation .next').click(function () {
            $('.serviceLog-form').parsley().whenValidate({
                group: 'block-' + curIndex()
            }).done(function () {
                var nextIndex = (curIndex() + 1);
                if(currentSubflow) {
                    nextIndex = $("." + currentSubflow + ":first").data("section-index");
                }
                navigateTo(nextIndex);
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
            $("#equipment").val('');
        });
        
        $("#equipment_typeahead").on('focus', function() {
           $(this).val('');
           $("#equipment").val('');
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
                    // equipment.unit_number | equipment.manufacturer_name equipment.model_number
                    // or
                    // equipment.search_matchs
                    return '<a href="#" class="list-group-item">' + data.search_match + '</a>';
    //                return '<a href="' + data.id + '" class="list-group-item">' + data.search_match + '</a>';
    //                return '<a href="' + data.profile.username + '" class="list-group-item">' + data.name + '- @' + data.profile.username + '</a>'
                }
            }
        }).on('typeahead:selected', function(event, selection) {

    //        console.log($("#equipment").val());
    //        console.log("Selected: " + selection.id);
            // the second argument has the info you want
    //        alert(selection.value);
    //        $(this).val('');
    //        $("#equipment_typeahead").html('BLAH');

//            $("#equipment_typeahead").prop('disabled', true);
            $(this).typeahead('val', selection.search_match);
            $("#equipment").val(selection.id);

            // clearing the selection requires a typeahead method
    //        $(this).typeahead('setQuery', '');
    //        $(this).typeahead('setQuery', selection.search_match);
        });
    });
</script>