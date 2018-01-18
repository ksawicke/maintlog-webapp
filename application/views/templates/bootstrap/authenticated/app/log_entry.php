<?php
$maxFluidEntries = 10;
$maxNotes = 5;

if(array_key_exists('id', $_REQUEST)) {
?>

<div class="alert alert-warning" role="alert">
    <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> <strong>Note!</strong> You are currently edting Service Log #<?php echo $_REQUEST['id']; ?>
</div>

<?php } ?>

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
        <label for="entered_by" class="control-label lb-lg">Entered By</label><img id="loading_entered_by" src="<?php echo base_url(); ?>/assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
        <select id="entered_by"
                name="entered_by"
                class="form-control input-lg"
                data-parsley-required="true"
                data-parsley-error-message="Please select who entered the record"
                data-parsley-errors-container=".entered_by_errors">
        </select>
        <p class="form-error entered_by_errors"></p>
        
        <label for="serviced_by" class="control-label lb-lg">Serviced By</label><img id="loading_serviced_by" src="<?php echo base_url(); ?>/assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
        <select id="serviced_by"
                name="serviced_by"
                class="form-control input-lg"
                multiple
                data-parsley-required="true"
                data-parsley-mincheck="1"
                data-parsley-error-message="Please select at least one person who performed the service"
                data-parsley-errors-container=".serviced_by_errors">
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
                        data-parsley-error-message="Please select the Equipment Type"
                        data-parsley-errors-container=".equipment_type_errors">
                    <option value="">Select one:</option>
                    <?php foreach($equipmenttypes as $equipmenttype) { ?>
                        <option value="<?php echo $equipmenttype->id; ?>"><?php echo $equipmenttype->equipment_type; ?></option>
                    <?php } ?>
                </select>

                <label for="equipmentmodel_id" class="control-label lb-lg">Equipment Model</label><img id="loading_equipmentmodel_id" src="<?php echo base_url(); ?>/assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
                <select id="equipmentmodel_id"
                        name="equipmentmodel_id"
                        class="form-control input-lg"
                        data-parsley-required="true"
                        data-parsley-error-message="Please select the Equipment Model"
                        data-parsley-errors-container=".equipmentmodel_id_errors"
                        disabled>
                </select>

                <label for="unit_number" class="control-label lb-lg">Unit Number</label><img id="loading_unit_number" src="<?php echo base_url(); ?>/assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
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
        <label for="subflow" class="control-label lb-lg">Entry Selection</label>
        <select
                id="subflow"
                name="subflow"
                class="form-control input-lg"
                data-parsley-required="true"
                data-parsley-error-message="Please select the entry type"
                data-parsley-errors-container=".subflow_errors">
            <option value="">Select one:</option>
            <option value="sus">SMR Update</option>
            <option value="flu">Fluid Entry</option>
            <option value="pss">PM Service</option>
            <option value="ccs">Component Change</option>
        </select>
        <p class="form-error subflow_errors"></p>
    </div>

    <!-- SMR UPDATE SUBFLOW -->
    <div class="form-section subflow sus show-prev show-review">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <label for="sus_previous_smr" class="control-label lb-lg">Previous SMR</label>
                <input 
                       id="sus_previous_smr"
                       name="sus_previous_smr"
                       type="text"
                       class="form-control input-lg"
                       value="99"
                       disabled>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <label for="sus_current_smr" class="control-label lb-lg">Current SMR</label>
                <input
                       id="sus_current_smr"
                       name="sus_current_smr"
                       type="text"
                       class="form-control input-lg"
                       value=""
                       data-parsley-type="number"
                       data-parsley-required="true"
                       data-parsley-gt="0"
                       data-parsley-lt="9999999"
                       data-parsley-required-message="Please enter the current SMR"
                       data-parsley-gt-message="Please enter a quantity greater than 0"
                       data-parsley-lt-message="Please enter a quantity less than 9,999,999"
                       data-parsley-errors-container=".sus_current_smr_errors">
                <p class="form-error sus_current_smr_errors"></p>
            </div>
        </div>
    </div>
    <!-- /SMR UPDATE SUBFLOW -->
    
    <!-- FLUID ENTRY SUBFLOW -->
    <div class="form-section subflow flu show-prev show-next">
        
        <?php for($fluidEntryCounter = 1; $fluidEntryCounter <= $maxFluidEntries; $fluidEntryCounter++) { ?>
        <div class="row fluidEntry<?php echo $fluidEntryCounter; ?>">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <label for="flu_fluid_type<?php echo "_" . $fluidEntryCounter; ?>" class="control-label lb-lg">Fluid Type</label>
                <select 
                        id="flu_fluid_type<?php echo "_" . $fluidEntryCounter; ?>"
                        name="flu_fluid_type<?php echo "_" . $fluidEntryCounter; ?>"
                        class="form-control input-lg"
                        <?php if($fluidEntryCounter==1) { ?>data-parsley-required="true"<?php } ?>
                        <?php if($fluidEntryCounter==1) { ?>data-parsley-error-message="Please select the fluid type"<?php } ?>
                        <?php if($fluidEntryCounter==1) { ?>data-parsley-errors-container=".flu_fluid_type<?php echo "_" . $fluidEntryCounter; ?>_errors"<?php } ?>>
                    <option value="">Select one:</option>
                    <?php foreach($fluidtypes as $fluidtype) { ?>
                        <option value="<?php echo $fluidtype->id; ?>"><?php echo $fluidtype->fluid_type; ?></option>
                    <?php } ?>
                </select>
                <p class="form-error flu_fluid_type<?php echo "_" . $fluidEntryCounter; ?>_errors"></p>
            </div>
        </div>

        <div class="row fluidEntry<?php echo $fluidEntryCounter; ?>">
            <div class="col-lg-1 col-md-1 col-sm-1">
                &nbsp;
            </div>
            
            <div class="col-lg-2 col-md-2 col-sm-2">
                <label for="flu_quantity<?php echo "_" . $fluidEntryCounter; ?>" class="control-label lb-lg">Quantity</label>
                <input 
                       id="flu_quantity<?php echo "_" . $fluidEntryCounter; ?>"
                       name="flu_quantity<?php echo "_" . $fluidEntryCounter; ?>"
                       type="text"
                       class="form-control input-lg"
                       <?php if($fluidEntryCounter==1) { ?>data-parsley-type="number"
                       data-parsley-required="true"
                       data-parsley-gt="0"
                       data-parsley-lt="10000"
                       data-parsley-required-message="Please choose the quantity of fuel used"
                       data-parsley-gt-message="Please enter a quantity greater than 0"
                       data-parsley-lt-message="Please enter a quantity less than 10000.0"<?php } ?>
                       data-parsley-errors-container=".flu_quantity<?php echo "_" . $fluidEntryCounter; ?>_errors">
                <?php echo '<p class="form-error flu_quantity' . $fluidEntryCounter . '_errors"></p>'; ?>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-9">
                <label for="flu_units<?php echo "_" . $fluidEntryCounter; ?>" class="control-label lb-lg">&nbsp;</label>
                <select
                        id="flu_units<?php echo "_" . $fluidEntryCounter; ?>"
                        name="flu_units<?php echo "_" . $fluidEntryCounter; ?>"
                        class="form-control input-lg"
                        <?php if($fluidEntryCounter==1) { ?>data-parsley-required="true"
                        data-parsley-error-message="Please choose the units of fuel used"<?php } ?>
                        data-parsley-errors-container=".flu_units<?php echo "_" . $fluidEntryCounter; ?>_errors">
                    <option value="" selected>Select one:</option>
                    <option value="gal">Gallons (gal)</option>
                    <option value="L">Liters (L)</option>
                </select>
                <?php echo '<p class="form-error flu_units_' . $fluidEntryCounter . '_errors"></p>'; ?>
            </div>
        </div>
        
        <?php } ?>
        
        <?php for($fluidEntryCounter = 2; $fluidEntryCounter <= $maxFluidEntries; $fluidEntryCounter++) { ?>
        <button class="btn btn-success showFluidEntry<?php echo ($fluidEntryCounter===2 ? '' : ' hideButton'); ?>" type="button" data-show-fluid-entry="<?php echo $fluidEntryCounter; ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Fluid</button>
        <?php } ?>
        
    </div>

    <div class="form-section subflow flu show-prev show-review">
        <label for="flu_units" class="control-label lb-lg"></label>
        <input
               id="flu_units"
               name="flu_units"
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
               data-parsley-errors-container=".flu_units_errors">
        <p class="form-error flu_units_errors"></p>
    </div>
    <!-- /FLUID ENTRY SUBFLOW -->

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
        <label for="pss_smr_based_pm_level" class="control-label lb-lg pss_smr_based">PM Level</label><img id="loading_pss_smr_based_pm_level" src="<?php echo base_url(); ?>/assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
        <select id="pss_smr_based_pm_level"
                name="pss_smr_based_pm_level"
                class="form-control input-lg pss_smr_based">
        </select>
        <p class="form-error pss_smr_based_pm_level_errors"></p>
        
        <label for="pss_smr_based_current_smr" class="control-label lb-lg pss_smr_based">Current SMR</label>
        <input
               id="pss_smr_based_current_smr"
               name="pss_smr_based_current_smr"
               type="text"
               class="form-control input-lg pss_smr_based"
               value="">
        <p class="form-error pss_smr_based_current_smr_errors"></p>
        
        <label for="pss_smr_based_notes1" class="control-label lb-lg pss_smr_based_notes1">Notes</label>
        <textarea type="text"
               id="pss_smr_based_notes1"
               name="pss_smr_based_notes1"
               class="form-control input-lg pss_smr_based_notes1"
               value=""></textarea>
        
        <label for="pss_smr_based_notes2" class="control-label lb-lg pss_smr_based_notes2 hide_me">Notes</label>
        <textarea type="text"
               id="pss_smr_based_notes2"
               name="pss_smr_based_notes2"
               class="form-control input-lg pss_smr_based pss_smr_based_notes2 hide_me"
               value=""></textarea>
        
        <label for="pss_smr_based_notes3" class="control-label lb-lg pss_smr_based_notes3 hide_me">Notes</label>
        <textarea type="text"
               id="pss_smr_based_notes3"
               name="pss_smr_based_notes3"
               class="form-control input-lg pss_smr_based pss_smr_based_notes3 hide_me"
               value=""></textarea>
        
        <button class="btn btn-success showPssSmrBasedNote" type="button" data-show-smr-based-note="2"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Note</button>
        
        <button class="btn btn-success showPssSmrBasedNote hideButton" type="button" data-show-smr-based-note="3"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Note</button>
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
        
        <label for="pss_reminder_pm_level" class="control-label lb-lg">PM Level</label><img id="loading_pss_reminder_pm_level" src="<?php echo base_url(); ?>/assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
        <select id="pss_reminder_pm_level"
                name="pss_reminder_pm_level"
                class="form-control input-lg"
                data-parsley-required="true"
                data-parsley-error-message="Please select the PM Level"
                data-parsley-errors-container=".pss_reminder_pm_type_errors">
            <option value="">Select one:</option>
        </select>
        <p class="form-error pss_reminder_pm_type_errors"></p>

        <label for="pss_due_units" class="control-label lb-lg">Due</label>
        <input type="text" class="form-control input-lg" id="pss_due_units" name="pss_due_units" value="">
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
                <label for="pss_reminder_recipients" class="control-label lb-lg">REMINDER RECIPIENTS</label><img id="loading_pss_reminder_recipients" src="<?php echo base_url(); ?>/assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
                <select id="pss_reminder_recipients"
                        name="pss_reminder_recipients"
                        class="form-control input-lg"
                        multiple
                        readonly>
                </select>
                <p class="form-error pss_reminder_recipients_errors"></p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <label for="pss_responsible_reminder_recipients" class="control-label lb-lg">PERSON RESPONSIBLE REMINDER RECIPIENTS</label><img id="loading_pss_responsible_reminder_recipients" src="<?php echo base_url(); ?>/assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
                <select id="pss_responsible_reminder_recipients"
                        name="pss_responsible_reminder_recipients"
                        class="form-control input-lg"
                        multiple
                        readonly>
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <label for="pss_additional_reminder_recipients" class="control-label lb-lg">ADDITIONAL REMINDER RECIPIENTS</label><img id="loading_pss_additional_reminder_recipients" src="<?php echo base_url(); ?>/assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
                <select id="pss_additional_reminder_recipients"
                        name="pss_additional_reminder_recipients"
                        class="form-control input-lg"
                        multiple>
                </select>
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
        <label for="ccs_component_type" class="control-label lb-lg">Component Type</label><img id="loading_ccs_component_type" src="<?php echo base_url(); ?>/assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
        <select id="ccs_component_type"
                name="ccs_component_type"
                class="form-control input-lg"
                data-parsley-required="true"
                data-parsley-error-message="Please select a Component Type"
                data-parsley-errors-container=".ccs_component_type_errors">
        </select>
        <p class="form-error ccs_component_type_errors"></p>
    </div>
    
    <div class="form-section subflow ccs show-prev show-next">
        <label for="ccs_component" class="control-label lb-lg">Component</label><img id="loading_ccs_component" src="<?php echo base_url(); ?>/assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
        <select id="ccs_component"
                name="ccs_component"
                class="form-control input-lg"
                data-parsley-required="true"
                data-parsley-error-message="Please select a Component"
                data-parsley-errors-container=".ccs_component_errors">
        </select>
        <p class="form-error ccs_component_errors"></p>
        
        <label for="ccs_component_data" class="control-label lb-lg">Component Data</label><img id="loading_ccs_component_data" src="<?php echo base_url(); ?>/assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
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
    .hide_me,
    .hideButton {
        display: none;
    }
</style>

<script type="text/javascript">
    $(function () {
        var log_entry_data = {};
        
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
            
            console.log(json);
            
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
            }).done(function(object) {
                // Clear dropdowns first.
                $('#entered_by').empty();
                $('#entered_by').append('<option value="">Select one:</option>');
                
                populateEnteredByDropdownWithData(object);
                $("#loading_entered_by").hide();
                
                populateServicedByDropdownWithData(object);
                $("#loading_serviced_by").hide();
            });
        }
        
        function populateEnteredByDropdownWithData(object) {
            log_entry_data_obj = localStorage.getItem("log_entry_data_obj");
            log_entry_data = JSON.parse(log_entry_data_obj);
            var service_log = log_entry_data.service_log;
            
            // Populate dropdown via ajax.
            $.each(object.data, function(id, userData) {
                var id = userData.id,
                    value = userData.last_name + ", " + userData.first_name,
                    current = userData.current,
                    active = userData.active;

                if(active==="1") {
                    var selected = '';
                    <?php if(array_key_exists('id', $_REQUEST)) { ?>
                    if(service_log.entered_by==id) {
                        selected = ' selected';
                    }
                    <?php } else { ?>
                        if(current==='1') {
                            selected = ' selected';
                        }
                    <?php } ?>
                    $('#entered_by').append('<option value="' + id + '"' + selected + '>' + value + '</option>');
                }
            });
            
            $('.serviceLog-form').parsley().validate();
        }
        
        function populateServicedByDropdownWithData(object) {
            log_entry_data_obj = localStorage.getItem("log_entry_data_obj");
            log_entry_data = JSON.parse(log_entry_data_obj);
            var service_log = log_entry_data.service_log;
            
            // Populate multiselect using loaded object.
            $.each(object.data, function(id, userData) {
                var id = userData.id,
                    display = userData.last_name + ", " + userData.first_name,
                    email_address = userData.email_address,
                    current = userData.current,
                    active = userData.active;

                if(active==="1") {
                    var selected = '';
                    for(i = 0; i <= service_log.serviced_by.length-1; i++) {
                        if(service_log.serviced_by[i].user_id==id) {
                            selected = ' selected';
                        }
                    }
                    $("#serviced_by").append('<option value="' + id + '"' + selected + '>' + display + '</option>');
                }
            });
            
            $('.serviceLog-form').parsley().validate();
        }
        
        function populateEquipmentModelDropdownWithData(serviceUrl, field) {
            $("#loading_equipmentmodel_id").show();
            
            log_entry_data_obj = localStorage.getItem("log_entry_data_obj");
            log_entry_data = JSON.parse(log_entry_data_obj);
            var service_log = log_entry_data.service_log;
            
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
                        
                    var selectMe = ((service_log.equipmentmodel_id == id) ? ' selected' : '');
                        
                    $('#equipmentmodel_id').append('<option value="' + id + '"' + selectMe + '>' + value + '</option>');
                });
                
                $("#loading_equipmentmodel_id").hide();
            });
            
            $('.serviceLog-form').parsley().validate();
        }
        
        function populateUnitNumberDropdownWithData(serviceUrl, field) {
            $("#loading_unit_number").show();
            
            log_entry_data_obj = localStorage.getItem("log_entry_data_obj");
            log_entry_data = JSON.parse(log_entry_data_obj);
            var service_log = log_entry_data.service_log;
            
//            console.log("equipmentmodel_id: " + $("#equipmentmodel_id").val());
            console.log("service_log.equipmentmodel_id: " + service_log.equipmentmodel_id);
            
            json = '{"id": ' + service_log.equipmentmodel_id + '}';
            
            <?php
            
            if(!array_key_exists('id', $_REQUEST)) { ?>
                json = '{"id": ' + $("#equipmentmodel_id").val() + '}';
            <?php }
            ?>      
            
            console.log(json);
            
            var jqxhr = $.ajax({
                url: serviceUrl,
                type: "POST",
                dataType: "json",
                data: JSON.stringify(json),
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
                        active = unitData.active;
                        
//                    if(active==1) {
                        var selectMe = ((service_log.equipmentunit_id == id) ? ' selected' : '');
                        console.log(service_log.equipmentunit_id + " :: " + id);
                        $('#unit_number').append('<option value="' + id + '" data-track-type="' + track_type + '" data-person-responsible="' +person_responsible + '"' + selectMe + '>' + value + '</option>');
//                    }
                });
                
                $("#loading_unit_number").hide();
                
                $('.serviceLog-form').parsley().validate();
            });
        }
        
        function populatePMServiceReminderPMLevelDropdownWithSMRChoiceData(serviceUrl, field) {
            $("#loading_pss_reminder_pm_level").show();
            
            var jqxhr = $.ajax({
                url: serviceUrl,
                type: "POST",
                dataType: "json",
                data: JSON.stringify({}),
                contentType: "application/json"
            }).done(function(object) {
                // Clear dropdowns first.
                $('#pss_reminder_pm_level').empty();
                $('#pss_reminder_pm_level').append('<option value="">Select one:</option>');
                
                // Populate dropdown via ajax.
                $.each(object.data, function(id, choiceData) {
                    var id = choiceData.id,
                        choice = choiceData.smr_choice;
                    
                    $('#pss_reminder_pm_level').append('<option value="' + id + '">' + choice + '</option>');
                });
                
                $("#loading_pss_reminder_pm_level").hide();
            });
        }
        
        function populatePMServiceReminderPMLevelDropdownWithMileageChoiceData(serviceUrl, field) {
            $("#loading_pss_reminder_pm_level").show();
            
            var jqxhr = $.ajax({
                url: serviceUrl,
                type: "POST",
                dataType: "json",
                data: JSON.stringify({}),
                contentType: "application/json"
            }).done(function(object) {
                // Clear dropdowns first.
                $('#pss_reminder_pm_level').empty();
                $('#pss_reminder_pm_level').append('<option value="">Select one:</option>');
                
                // Populate dropdown via ajax.
                $.each(object.data, function(id, choiceData) {
                    var id = choiceData.id,
                        choice = choiceData.mileage_choice;
                    
                    $('#pss_reminder_pm_level').append('<option value="' + id + '">' + choice + '</option>');
                });
                
                $("#loading_pss_reminder_pm_level").hide();
            });
        }
        
        function populatePMServiceReminderPMLevelDropdownWithTimeChoiceData(serviceUrl, field) {
            $("#loading_pss_reminder_pm_level").show();
            
            var jqxhr = $.ajax({
                url: serviceUrl,
                type: "POST",
                dataType: "json",
                data: JSON.stringify({}),
                contentType: "application/json"
            }).done(function(object) {
                // Clear dropdowns first.
                $('#pss_reminder_pm_level').empty();
                $('#pss_reminder_pm_level').append('<option value="">Select one:</option>');
                
                // Populate dropdown via ajax.
                $.each(object.data, function(id, choiceData) {
                    var id = choiceData.id,
                        choice = choiceData.time_choice;
                    
                    $('#pss_reminder_pm_level').append('<option value="' + id + '">' + choice + '</option>');
                });
                
                $("#loading_pss_reminder_pm_level").hide();
            });
        }
        
        function populateSMRBasedPMLevelDropdownWithData(serviceUrl, field, type) {
            $("#loading_pss_smr_based_pm_level").show();
            
            var jqxhr = $.ajax({
                url: serviceUrl,
                type: "POST",
                dataType: "json",
                data: JSON.stringify({}),
                contentType: "application/json"
            }).done(function(object) {
                // Clear dropdowns first.
                $('#pss_smr_based_pm_level').empty();
                $('#pss_smr_based_pm_level').append('<option value="">Select one:</option>');
                                
                switch(type) {
                    case 'smr_based':
                        // Populate dropdown via ajax.
                        $.each(object.data, function(id, smrchoiceData) {
                            var id = smrchoiceData.id,
                                smr_choice = smrchoiceData.smr_choice;

                            $('#pss_smr_based_pm_level').append('<option value="' + id + '">' + smr_choice + '</option>');
                        });
                        break;
                    
                    case 'mileage_based':
                        // Populate dropdown via ajax.
                        $.each(object.data, function(id, choiceData) {
                            var id = choiceData.id,
                                choice = choiceData.mileage_choice;

                            $('#pss_smr_based_pm_level').append('<option value="' + id + '">' + choice + '</option>');
                        });
                        break;
                        
                    case 'time_based':
                        // Populate dropdown via ajax.
                        $.each(object.data, function(id, choiceData) {
                            var id = choiceData.id,
                                choice = choiceData.time_choice;

                            $('#pss_smr_based_pm_level').append('<option value="' + id + '">' + choice + '</option>');
                        });
                        break;
                }
                
                $("#loading_pss_smr_based_pm_level").hide();
            });
        }
        
        function populatePSSSmrDropdownWithSMRChoiceData(serviceUrl, field) {
            var jqxhr = $.ajax({
                url: serviceUrl,
                type: "POST",
                dataType: "json",
                data: JSON.stringify({}),
                contentType: "application/json"
            }).done(function(object) {
                // Clear dropdowns first.
                $('#pss_smr').empty();
                $('#pss_smr').append('<option value="">Select one:</option>');
                                
                // Populate dropdown via ajax.
                $.each(object.data, function(id, smrchoiceData) {
                    var id = smrchoiceData.id,
                        smr_choice = smrchoiceData.smr_choice;
                        
                    $('#pss_smr').append('<option value="' + id + '">' + smr_choice + '</option>');
                });
            });
        }
        
        function populateComponentTypeDropdownWithData(serviceUrl, field) {
            $("#loading_ccs_component_type").show();
            
            log_entry_data_obj = localStorage.getItem("log_entry_data_obj");
            log_entry_data = JSON.parse(log_entry_data_obj);
            var service_log = log_entry_data.service_log;
            
            var jqxhr = $.ajax({
                url: serviceUrl,
                type: "POST",
                dataType: "json",
                data: JSON.stringify({}),
                contentType: "application/json"
            }).done(function(object) {
                // Clear dropdowns first.
                $('#ccs_component_type').empty();
                $('#ccs_component_type').append('<option value="">Select one:</option>');
                                
                // Populate dropdown via ajax.
                $.each(object.data, function(id, choiceData) {
                    var id = choiceData.id,
                        choice = choiceData.component_type;
                        
                    var selected = (service_log.update_detail.component_type==choice ? ' selected' : '');    
                        
                    $('#ccs_component_type').append('<option value="' + id + '"' + selected + '>' + choice + '</option>');
                });
                
                $("#loading_ccs_component_type").hide();
            });
        }
        
        function populateReminderRecipientsWithData(serviceUrl) {
//            $("#loading_ccs_component_type").show();
            
            var jqxhr = $.ajax({
                url: serviceUrl,
                type: "POST",
                dataType: "json",
                data: JSON.stringify({}),
                contentType: "application/json"
            }).done(function(object) {
                var personResponsibleSelectedUnit = $("#unit_number").find(":selected").attr('data-person-responsible');
                var personResponsibleArray = personResponsibleSelectedUnit.split("|");
                
                $('#pss_reminder_recipients').empty();
                $('#pss_additional_reminder_recipients').empty();
                
                $.each(object.data, function(id, userData) {
                    var id = userData.id,
                        email_address = userData.email_address,
                        display = userData.last_name + ", " + userData.first_name + " <" + userData.email_address + ">",
                        active = userData.active,
                        logentry_reminderrecipient = userData.logentry_reminderrecipient;
                    var isPersonResponsibleForSelectedUnit = $.inArray(id, personResponsibleArray);

                    if(logentry_reminderrecipient==="1") {
                        $("#pss_reminder_recipients").append('<option value="' + email_address + '" selected>' + display + '</option>');
                    }
                    if(isPersonResponsibleForSelectedUnit!==-1) {
                        $("#pss_responsible_reminder_recipients").append('<option value="' + email_address + '" selected>' + display + '</option>');
                    }
                    $("#pss_additional_reminder_recipients").append('<option value="' + email_address + '">' + display + '</option>');
                });
                
//                $("#loading_ccs_component_type").hide();
            });
        }
        
        function populateComponentDropdownWithData(serviceUrl, field) {
            $("#loading_ccs_component").show();
            
            log_entry_data_obj = localStorage.getItem("log_entry_data_obj");
            log_entry_data = JSON.parse(log_entry_data_obj);
            var service_log = log_entry_data.service_log;
            
            var jqxhr = $.ajax({
                url: serviceUrl,
                type: "POST",
                dataType: "json",
                data: JSON.stringify({}),
                contentType: "application/json"
            }).done(function(object) {
                // Clear dropdowns first.
                $('#ccs_component').empty();
                $('#ccs_component').append('<option value="">Select one:</option>');
                                
                // Populate dropdown via ajax.
                $.each(object.data, function(id, choiceData) {
                    var id = choiceData.id,
                        choice = choiceData.component;
                        
                    var selected = (service_log.update_detail.component==choice ? ' selected' : '');
                        
                    $('#ccs_component').append('<option value="' + id + '"' + selected + '>' + choice + '</option>');
                });
                
                $("#loading_ccs_component").hide();
            });
        }
        
        function saveServiceLog() {
            var serviceUrl = '<?php echo base_url(); ?>index.php/servicelog/save',
                jsonData = getJsonToSave(currentSubflow);
            
//            console.log("-------------------");
//            console.log("Before we submit let's check the data.");
//            console.log(jsonData);
//            console.log("End.");
            
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
        
        function initLogEntryData() {
            console.log("Initialize data here...");
            
            //http://test.rinconmountaintech.com/sites/komatsuna/index.php/app/log_entry?id=39
            <?php if(array_key_exists('id', $_REQUEST)) { ?>
            
            var jqxhr = $.ajax({
                url: '<?php echo base_url(); ?>index.php/app/reporting/service_log_detail_ajax/<?php echo $_REQUEST['id']; ?>',
                type: "POST",
                dataType: "json",
                data: JSON.stringify({}), // no need to send data, just get it
                contentType: "application/json"
            }).done(function(object) {
                // Save data to local object.
                localStorage.setItem("log_entry_data_obj", JSON.stringify(object));
                
//                var test2 = localStorage.getItem("test");
//                console.log(test2); //Logs "{"test":"thing","test2":"thing2","test3":[0,2,44]}"
//                test = JSON.parse(test2); //var test is now re-loaded!
                
//                console.log("TEST");
//                console.log(servicelog.id)
//
//                $("#date_entered").val('01/02/2018');
            });
            
            log_entry_data_obj = localStorage.getItem("log_entry_data_obj");
            log_entry_data = JSON.parse(log_entry_data_obj);
            
            var service_log = log_entry_data.service_log;
            
            // Fill in data into form
            $("#date_entered").val(service_log.date_entered);
            $("#entered_by").val(service_log.entered_by); // TODO
            
            console.log("Serviced by count: ");
            console.log(service_log.serviced_by.length);

            
            //$("#serviced_by").val(); // TODO
            $("#equipment_type").val(service_log.equipmenttype_id);
            
            populateEquipmentModelDropdownWithData("<?php echo base_url(); ?>index.php/equipmentmodel/getEquipmentByType",
                $("#equipmentmodel_id"));
            $("#equipmentmodel_id").prop('disabled', false);
            $('[name=equipmentmodel_id]').val(service_log.equipmentmodel_id);
            
            populateUnitNumberDropdownWithData("<?php echo base_url(); ?>index.php/equipmentunits/getUnitByModelId",
                $("#unit_number"));
                
            // KS 1/17/18 TODO: Finish the rest of the fields
            $("#subflow").val(service_log.subflow);
            setCurrentSubflow();
            
            switch(service_log.subflow) {
                case 'sus':  // SMR Update. Flow for editing an existing one is complete.
                    $("#sus_current_smr").val(service_log.smr);
                    break;
                    
                case 'flu':

                    break;
                    
                case 'pss':
                    $("#pss_pm_type").val(service_log.update_detail_pm_type);
                    break;
                    
                case 'ccs': // Component Change. Flow for editing an existing one is complete.
                    populateComponentTypeDropdownWithData("<?php echo base_url(); ?>index.php/componenttypes/getComponentTypes",
                        $("#ccs_component_type"));
                    populateComponentDropdownWithData("<?php echo base_url(); ?>index.php/components/getComponents",
                        $("#ccs_component"));
                    $("#ccs_component_data").val(service_log.update_detail.component_data);
                    $("#ccs_notes").val(service_log.update_detail.notes);
                    break;
            }
            
            // TODO: 1/17/18 Disable submit button on edit for now.
            $("#submitButton").attr("disabled", "disabled");
            
            // Validate it!
            $('.serviceLog-form').parsley().validate();
            <?php } ?>
            
            console.log(log_entry_data);
            
            
//            $("#entered_by").val();
//            $("#serviced_by").val();
//            $("#equipment_type").val();
//            $("#equipmentmodel_id").val();
//            $("#unit_number").val();
            
//            switch(currentSubflow) {
//                case 'sus':
//                    
//                    break;
//                    
//                case 'flu':
//                    
//                    break;
//                    
//                case 'pss':
//
//                    break;
//                    
//                case 'ccs':
//                    
//                    break;
//            }
            
            
        }
        
        $(document).on("click", "#reviewButton", function () {
            showReview();
        });
        
        $(document).on("toggle", "#reviewButton", function () {
            showReview();
        });
        
        $(document).on("click", "#cancelSubmitLogEntryForm", function () {
            confirmSubmitJBox.close();
        });
        
        $(document).on("click", "#submitLogEntryForm", function () {
            saveServiceLog();
        });

        $(document).on("change", "#subflow", function () {
            setCurrentSubflow();
            if($('#subflow :selected').val()==="ccs") {
                populateComponentTypeDropdownWithData("<?php echo base_url(); ?>index.php/componenttypes/getComponentTypes",
                    $("#ccs_component_type"));
                populateComponentDropdownWithData("<?php echo base_url(); ?>index.php/components/getComponents",
                    $("#ccs_component"));
            }
        });

        // Previous button is easy, just go back
        $(document).on("click", ".prev", function () {
            $("#reviewScreen").hide();
            $("#submitButton").hide();
            goBack();
        });

        $(document).on('change', '#unit_number', function() {
            var fluUnitslabelText = '',
                thisTrackType = $(this).find(":selected").attr('data-track-type');

            switch(thisTrackType) {
                case 'smr':
                    fluUnitslabelText = 'SMR';
                    break;
                    
                case 'miles':
                    fluUnitslabelText = 'Miles';
                    break;

                case 'time':
                    fluUnitslabelText = 'Time';
                    break;
            }
            $("label[for = flu_units]").text(fluUnitslabelText);
            
            populateReminderRecipientsWithData("<?php echo base_url(); ?>index.php/users/getUsers");
        });
        
        $(document).on('change', '#pss_reminder_pm_type', function() {
            var pssdueunitslabelText = '',
                thisSelection = $('#pss_reminder_pm_type :selected').val();
                
            switch(thisSelection) {
                case 'smr_based':
                    populatePMServiceReminderPMLevelDropdownWithSMRChoiceData("<?php echo base_url(); ?>index.php/smrchoices/getSMRChoices",
                        $("#pss_reminder_pm_level"));
                    pssdueunitslabelText = 'SMR Due';
                    break;
                    
                case 'mileage_based':
                    populatePMServiceReminderPMLevelDropdownWithMileageChoiceData("<?php echo base_url(); ?>index.php/mileagechoices/getMileageChoices",
                        $("#pss_reminder_pm_level"));
                    pssdueunitslabelText = 'Mileage Due';
                    break;

                case 'time_based':
                    populatePMServiceReminderPMLevelDropdownWithTimeChoiceData("<?php echo base_url(); ?>index.php/timechoices/getTimeChoices",
                        $("#pss_reminder_pm_level"));
                    pssdueunitslabelText = 'Time Due';
                    break;
            }
            
            $("label[for = pss_due_units]").text(pssdueunitslabelText);
        });
        
        $(document).on('change', '#pss_pm_type', function() {
            var fluUnitslabelText = '',
                thisSelection = $('#pss_pm_type :selected').val();
                
            $('.pss_smr_based').removeClass("hide-me");
            $('.pss_mileage_based').removeClass("hide-me");
            $('.pss_time_based').removeClass("hide-me");
                
            switch(thisSelection) {
                case 'smr_based':
                    // Populate #pss_smr_based_pm_level via ajax with SMR Choices
                    populateSMRBasedPMLevelDropdownWithData("<?php echo base_url(); ?>index.php/smrchoices/getSMRChoices",
                        $("#pss_smr_based_pm_level"), 'smr_based');
                    
                    $('.pss_smr_based').removeClass("hide-me");
                    $('.pss_smr_based_notes2').addClass("hide-me");
                    $('.pss_smr_based_notes3').addClass("hide-me");
                    $('.showPssSmrBasedNote3').addClass("hideButton");
                    break;
                    
                case 'mileage_based':
                    populateSMRBasedPMLevelDropdownWithData("<?php echo base_url(); ?>index.php/mileagechoices/getMileageChoices",
                        $("#pss_smr_based_pm_level"), 'mileage_based');
                    $('.pss_mileage_based').removeClass("hide-me");
                    $('.pss_smr_based_notes2').addClass("hide-me");
                    $('.pss_smr_based_notes3').addClass("hide-me");
                    $('.showPssSmrBasedNote3').addClass("hideButton");
                    break;

                case 'time_based':
                    populateSMRBasedPMLevelDropdownWithData("<?php echo base_url(); ?>index.php/timechoices/getTimeChoices",
                        $("#pss_smr_based_pm_level"), 'time_based');
                    $('.pss_time_based').removeClass("hide-me");
                    $('.pss_smr_based_notes2').addClass("hide-me");
                    $('.pss_smr_based_notes3').addClass("hide-me");
                    $('.showPssSmrBasedNote3').addClass("hideButton");
                    break;
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
                
                /****/
                $sections.each(function (index, section) {
                    // clear section index
                    if(index>=4) {
                        $(section).attr("data-section-index", "");
                    }
                    
                    if(index>=4 && $(section).hasClass(currentSubflow)) {
                        $(section).attr("data-section-index", startAtIndex);
                        startAtIndex++;
                    }                        
                });
                
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
            <?php for($fluidEntryCounter = 2; $fluidEntryCounter <= $maxFluidEntries; $fluidEntryCounter++) { ?>
            $(".fluidEntry<?php echo $fluidEntryCounter; ?>").hide();
            <?php } ?>
                
            $(".hideButton").hide();
//            $(".hide_me").hide();

            <?php for($fluidEntryCounter = 3; $fluidEntryCounter <= $maxFluidEntries; $fluidEntryCounter++) { ?>
            $(document).on('click', '.showFluidEntry', function(e) {
                e.preventDefault();
                
                var fluidEntryNumber = $(this).attr('data-show-fluid-entry');
                $('.fluidEntry' + fluidEntryNumber).show();
                $(this).addClass('hideButton').hide().css("display","none");             
                             
                $('.showFluidEntry')
                    .filter(function(){
                        var nextFluidEntryNumber = parseInt(fluidEntryNumber, 10) + 1;
                          $('.fluidEntry' + fluidEntryNumber).show();
                        return $(this).data('show-fluid-entry') === nextFluidEntryNumber;
                    })
                    .removeClass('hideButton').css("display","block");
            });
            <?php } ?>

            $(document).on('click', '.showPssSmrBasedNote', function() {
                var showNoteNumber = $(this).attr('data-show-smr-based-note'),
                    nextNumber = parseInt(showNoteNumber, 10) + 1;
                $('#pss_smr_based_notes' + showNoteNumber).removeClass("hide_me");
                $(this).addClass('hideButton').hide().css("display","none");
                
                $('.showPssSmrBasedNote')
                    .filter(function(){
                        return $(this).data('show-smr-based-note') === nextNumber;
                    })
                    .removeClass('hideButton').hide().css("display","block");
            });
            
            initLogEntryData();
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
                     "unit_number": $("#unit_number").val()
                   };
        
        json.subflow = currentSubflow;
        
        switch(currentSubflow) {
            case 'sus':
                json.sus_current_smr = $("#sus_current_smr").val();
                break;
                
            case 'flu':
                json.fluid_added = [
                    { type: $("#flu_fluid_type_1").val(),
                      quantity: $("#flu_quantity_1").val(),
                      units: $("#flu_units_1").val()
                    },
                    { type: $("#flu_fluid_type_2").val(),
                      quantity: $("#flu_quantity_2").val(),
                      units: $("#flu_units_2").val()
                    },
                    { type: $("#flu_fluid_type_3").val(),
                      quantity: $("#flu_quantity_3").val(),
                      units: $("#flu_units_3").val()
                    },
                    { type: $("#flu_fluid_type_4").val(),
                      quantity: $("#flu_quantity_4").val(),
                      units: $("#flu_units_4").val()
                    },
                    { type: $("#flu_fluid_type_5").val(),
                      quantity: $("#flu_quantity_5").val(),
                      units: $("#flu_units_5").val()
                    },
                    { type: $("#flu_fluid_type_6").val(),
                      quantity: $("#flu_quantity_6").val(),
                      units: $("#flu_units_6").val()
                    },
                    { type: $("#flu_fluid_type_7").val(),
                      quantity: $("#flu_quantity_7").val(),
                      units: $("#flu_units_7").val()
                    },
                    { type: $("#flu_fluid_type_8").val(),
                      quantity: $("#flu_quantity_8").val(),
                      units: $("#flu_units_8").val()
                    },
                    { type: $("#flu_fluid_type_9").val(),
                      quantity: $("#flu_quantity_9").val(),
                      units: $("#flu_units_9").val()
                    },
                    { type: $("#flu_fluid_type_10").val(),
                      quantity: $("#flu_quantity_10").val(),
                      units: $("#flu_units_10").val()
                    }
                ];            
                break;

            case 'pss':
                json.pss_pm_type = $("#pss_pm_type").val();
                json.pss_smr_based_pm_level = $("#pss_smr_based_pm_level").val();
                json.pss_smr_based_current_smr = $("#pss_smr_based_current_smr").val();
                json.pss_smr_based_notes = [
                    { note: $("#pss_smr_based_notes1").val() },
                    { note: $("#pss_smr_based_notes2").val() },
                    { note: $("#pss_smr_based_notes3").val() }
                ];
                json.pss_reminder_pm_type = $("#pss_reminder_pm_type").val();
                json.pss_reminder_pm_level = $("#pss_reminder_pm_level").val();
                json.pss_due_units = $("#pss_due_units").val();
                json.pss_notes = $("#pss_notes").val();
                json.pss_reminder_recipients = [
                    { email_addresses: $("#pss_reminder_recipients").val() },
                    { email_addresses: $("#pss_responsible_reminder_recipients").val() },
                    { email_addresses: $("#pss_additional_reminder_recipients").val() }
                ];
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
                { "label" : "Equipment Model",
                  "value" : $("#equipmentmodel_id option[value='" + $("#equipmentmodel_id").val() + "']").text()
                },
                { "label" : "Unit Number",
                  "value" : $("#unit_number option[value='" + $("#unit_number").val() + "']").text()
                }
            ];
            
        switch(currentSubflow) {
            case 'sus':
                objectPush(json, "Previous SMR", "sus_previous_smr", false);
                objectPush(json, "Current SMR", "sus_current_smr", false);
                break;
                
            case 'flu':
                json.push({ "label": "Entry Selection", "value": "Fluid Entry" });
                
                console.log($("#flu_quantity_1").val());
                console.log($("#flu_units_1 option[value='" + $("#flu_units_1").val() + "']").text());
                
                // Fluid entry 1
                objectPush(json, "Fluid Type", "flu_fluid_type_1", true);
                json.push({ "label": "Quantity",
                            "value": $("#flu_quantity_1").val() + " " + $("#flu_units_1 option[value='" + $("#flu_units_1").val() + "']").text()
                });
                
                // Fluid entry 2
                if(!empty($("#flu_quantity_2").val())) {
                    objectPush(json, "Fluid Type", "flu_fluid_type_2", true);
                    json.push({ "label": "Quantity",
                                "value": $("#flu_quantity_2").val() + " " + $("#flu_units_2 option[value='" + $("#flu_units_2").val() + "']").text()
                    });
                }
                
                // Fluid entry 3
                if(!empty($("#flu_quantity3").val())) {
                    objectPush(json, "Fluid Type", "flu_fluid_type_3", true);
                    json.push({ "label": "Quantity",
                                "value": $("#flu_quantity_3").val() + " " + $("#flu_units_3 option[value='" + $("#flu_units_3").val() + "']").text()
                    });
                }
                
                // Fluid entry 4
                if(!empty($("#flu_quantity4").val())) {
                    objectPush(json, "Fluid Type", "flu_fluid_type_4", true);
                    json.push({ "label": "Quantity",
                                "value": $("#flu_quantity_4").val() + " " + $("#flu_units_4 option[value='" + $("#flu_units_4").val() + "']").text()
                    });
                }
                
                // Fluid entry 5
                if(!empty($("#flu_quantity5").val())) {
                    objectPush(json, "Fluid Type", "flu_fluid_type_5", true);
                    json.push({ "label": "Quantity",
                                "value": $("#flu_quantity_5").val() + " " + $("#flu_units_5 option[value='" + $("#flu_units_5").val() + "']").text()
                    });
                }
                
                // Fluid entry 6
                if(!empty($("#flu_quantity6").val())) {
                    objectPush(json, "Fluid Type", "flu_fluid_type_6", true);
                    json.push({ "label": "Quantity",
                                "value": $("#flu_quantity_6").val() + " " + $("#flu_units_6 option[value='" + $("#flu_units_6").val() + "']").text()
                    });
                }
                
                // Fluid entry 7
                if(!empty($("#flu_quantity7").val())) {
                    objectPush(json, "Fluid Type", "flu_fluid_type_7", true);
                    json.push({ "label": "Quantity",
                                "value": $("#flu_quantity_7").val() + " " + $("#flu_units_7 option[value='" + $("#flu_units_7").val() + "']").text()
                    });
                }
                
                // Fluid entry 8
                if(!empty($("#flu_quantity8").val())) {
                    objectPush(json, "Fluid Type", "flu_fluid_type_8", true);
                    json.push({ "label": "Quantity",
                                "value": $("#flu_quantity_8").val() + " " + $("#flu_units_8 option[value='" + $("#flu_units_8").val() + "']").text()
                    });
                }
                
                // Fluid entry 9
                if(!empty($("#flu_quantity9").val())) {
                    objectPush(json, "Fluid Type", "flu_fluid_type_9", true);
                    json.push({ "label": "Quantity",
                                "value": $("#flu_quantity_9").val() + " " + $("#flu_units_9 option[value='" + $("#flu_units_9").val() + "']").text()
                    });
                }
                
                // Fluid entry 10
                if(!empty($("#flu_quantity10").val())) {
                    objectPush(json, "Fluid Type", "flu_fluid_type_10", true);
                    json.push({ "label": "Quantity",
                                "value": $("#flu_quantity_10").val() + " " + $("#flu_units_10 option[value='" + $("#flu_units_10").val() + "']").text()
                    });
                }

                objectPush(json, $("label[for = flu_units]").text(), "flu_units", false);
                break;

            case 'pss':
                json.push({ "label": "Entry Selection", "value": "PM Service" });
                
                objectPush(json, "PM Type", "pss_pm_type", true);
                objectPush(json, "PM Level", "pss_smr_based_pm_level", true);
                objectPush(json, "Current SMR", "pss_smr_based_current_smr", false);
                objectPush(json, "Notes", "pss_smr_based_notes1", false);
                
                if(!empty($("#pss_smr_based_notes2").val())) {
                    objectPush(json, "Notes", "pss_smr_based_notes2", false);
                }
                
                if(!empty($("#pss_smr_based_notes3").val())) {
                    objectPush(json, "Notes", "pss_smr_based_notes3", false);
                }
                
                objectPush(json, "PM Type", "pss_reminder_pm_type", true);
                objectPush(json, "PM Level", "pss_reminder_pm_level", true);
                objectPush(json, $("label[for = pss_due_units]").text(), "pss_due_units", false);
                objectPush(json, "Notes", "pss_notes", false);
                
                objectPush(json, "Reminder Recipients", "pss_reminder_recipients", false);
                objectPush(json, "Person Responsible Reminder Recipients", "pss_responsible_reminder_recipients", false);
                objectPush(json, "Additional Reminder Recipients", "pss_additional_reminder_recipients", false);
                
                // Concatenated value so handling differently...
                json.push({ "label": "Reminder Due",
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