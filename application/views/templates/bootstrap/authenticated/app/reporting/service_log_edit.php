<?php echo $reports_navigation; ?>

<h3>Edit Service Log <?php echo $service_log['id']; ?></h3>


<pre style="font-size:12px;">
<?php var_dump($service_log); ?>
</pre>


<label for="date_entered" class="control-label lb-lg">Date Entered</label>
<div class="input-group date">
    <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
    </div>
    <input id="date_entered"
           name="date_entered"
           type="text"
           class="form-control input-lg"
           value="<?php echo date('m/d/Y', strtotime($service_log['date_entered'])); ?>"
           data-parsley-required="true"
           data-parsley-pattern="/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/"
           data-parsley-pattern-message="Date must be in MM/DD/YYYY format"
           data-parsley-errors-container=".date_entered_errors">
</div>
<p class="form-error date_entered_errors"></p>


<label for="entered_by" class="control-label lb-lg">Entered By</label>
<select id="entered_by"
        name="entered_by"
        class="form-control input-lg"
        data-parsley-required="true"
        data-parsley-error-message="Please select who entered the record"
        data-parsley-errors-container=".entered_by_errors">
    <option value="">Select one:</option>
    <?php foreach($users as $ctr => $user) { ?>
    <option value="<?php echo $user['id']; ?>"<?php echo ($service_log['entered_by']==$user['id'] ? ' selected' : ''); ?>><?php echo $user['last_name'] . ', ' . $user['first_name']; ?></option>
    <?php } ?>
</select>
<p class="form-error entered_by_errors"></p>


<?php 
//$serviced_by = explode("|", $service_log['serviced_by']);
//var_dump($service_log['serviced_by']);
$serviced_by = [];
foreach($service_log['serviced_by'] as $ctr => $sb) {
    $serviced_by[] = $sb['user_id'];
}
?>



<label for="serviced_by" class="control-label lb-lg">Serviced By</label>
<select id="serviced_by"
        name="serviced_by"
        class="form-control input-lg"
        multiple
        data-parsley-required="true"
        data-parsley-mincheck="1"
        data-parsley-error-message="Please select at least one person who performed the service"
        data-parsley-errors-container=".serviced_by_errors">
    <?php foreach($users as $ctr => $user) { ?>
    <option value="<?php echo $user['id']; ?>"<?php echo (in_array($user['id'], $serviced_by) ? ' selected' : ''); ?>><?php echo $user['last_name'] . ', ' . $user['first_name']; ?></option>
    <?php } ?>
</select>
<p class="form-error serviced_by_errors"></p>


<label for="equipment_type" class="control-label lb-lg">Equipment Type</label>
<select id="equipment_type"
        name="equipment_type"
        class="form-control input-lg"
        data-parsley-required="true"
        data-parsley-error-message="Please select the Equipment Type"
        data-parsley-errors-container=".equipment_type_errors">
    <option value="">Select one:</option>
    <?php foreach($equipmenttypes as $equipmenttype) { ?>
        <option value="<?php echo $equipmenttype->id; ?>"<?php echo ($equipmenttype->id==$service_log['equipmenttype_id'] ? ' selected' : ''); ?>><?php echo $equipmenttype->equipment_type; ?></option>
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


<label for="subflow" class="control-label lb-lg">Entry Selection</label>
<select
        id="subflow"
        name="subflow"
        class="form-control input-lg"
        data-parsley-required="true"
        data-parsley-error-message="Please select the entry type"
        data-parsley-errors-container=".subflow_errors">
    <option value="">Select one:</option>
    <option value="sus"<?php echo ($service_log['entry_type']=='SMR Update' ? ' selected' : ''); ?>>SMR Update</option>
    <option value="flu"<?php echo ($service_log['entry_type']=='Fluid Entry' ? ' selected' : ''); ?>>Fluid Entry</option>
    <option value="pss"<?php echo ($service_log['entry_type']=='PM Service' ? ' selected' : ''); ?>>PM Service</option>
    <option value="ccs"<?php echo ($service_log['entry_type']=='Component Change' ? ' selected' : ''); ?>>Component Change</option>
</select>
<p class="form-error subflow_errors"></p>


<?php if($service_log['entry_type']=='SMR Update') { ?>
    <label for="sus_current_smr" class="control-label lb-lg">Current SMR</label>
    <input
           id="sus_current_smr"
           name="sus_current_smr"
           type="text"
           class="form-control input-lg"
           value="<?php echo $service_log['update_detail']['smr']; ?>"
           data-parsley-type="number"
           data-parsley-required="true"
           data-parsley-gt="0"
           data-parsley-lt="9999999"
           data-parsley-required-message="Please enter the current SMR"
           data-parsley-gt-message="Please enter a quantity greater than 0"
           data-parsley-lt-message="Please enter a quantity less than 9,999,999"
           data-parsley-errors-container=".sus_current_smr_errors">
    <p class="form-error sus_current_smr_errors"></p>
<?php } ?>


<?php if($service_log['entry_type']=='PM Service') { ?>

    <label for="pss_pm_type" class="control-label lb-lg">PM Type</label>
    <select id="pss_pm_type"
            name="pss_pm_type"
            class="form-control input-lg"
            data-parsley-required="true"
            data-parsley-error-message="Please select the PM type"
            data-parsley-errors-container=".pss_pm_type_errors">
        <option value="">Select one:</option>
        <option value="smr_based"<?php echo ($service_log['update_detail']['pm_type']=='smr_based' ? ' selected' : ''); ?>>SMR based</option>
        <option value="mileage_based"<?php echo ($service_log['update_detail']['pm_type']=='mileage_based' ? ' selected' : ''); ?>>Mileage based</option>
        <option value="time_based"<?php echo ($service_log['update_detail']['pm_type']=='time_based' ? ' selected' : ''); ?>>Time based</option>
    </select>
    <p class="form-error pss_pm_type_errors"></p>
    
    
    <label for="pss_smr_based_pm_level" class="control-label lb-lg pss_smr_based">PM Level</label>
    <select id="pss_smr_based_pm_level"
            name="pss_smr_based_pm_level"
            class="form-control input-lg pss_smr_based">
    </select>
    <p class="form-error pss_smr_based_pm_level_errors"></p>
    
    <label>PM Level</label>
    <ul>
        <li><?php echo $service_log['update_detail']['pm_level']; ?></li>
    </ul>
    
    <label>Current SMR</label>
    <ul>
        <li><?php echo $service_log['update_detail']['current_smr']; ?></li>
    </ul>
    
    <label>Due Units</label>
    <ul>
        <li><?php echo $service_log['update_detail']['due_units']; ?></li>
    </ul>
    
    <label>Notes</label>
    <ul>
        <li><?php echo $service_log['update_detail']['notes']; ?></li>
    </ul>
    
    <label>PM Service Notes</label>
    <ul>
        <?php foreach($service_log['update_detail']['pmservicenotes'] as $ctr => $pmservicenote) { ?>
            <li><?php echo $pmservicenote['note']; ?></li>
        <?php } ?>
    </ul>
    
    <label>PM Service Reminders</label>
    <ul>
        <?php foreach($service_log['update_detail']['pmservicereminder'] as $ctr => $pmservicereminder) { ?>
        
            <?php
            $pm_type = "";
            switch($pmservicereminder['pm_type']) {
                case 'smr_based':
                    $pm_type = 'SMR based';
                    break;

                case 'mileage_based':
                    $pm_type = 'Mileage based';
                    break;

                case 'time_based':
                    $pm_type = 'Time based';
                    break;
            }
            ?>
        
            <li>
                <?php echo $pmservicereminder['emails']; ?>
                <ul>
                    <li><strong>PM Type</strong> <?php echo $pm_type; ?></li>
                    <li><strong>PM Level</strong> <?php echo $pmservicereminder['pm_level']; ?></li>
                    <li><strong>Quantity</strong> <?php echo $pmservicereminder['quantity']; ?></li>
                    <li><strong>Units</strong> <?php echo $pmservicereminder['units']; ?></li>
                    <li><strong>Date</strong> <?php echo date('m/d/Y', strtotime($pmservicereminder['date'])); ?></li>
                    <li><strong>Email Status</strong> <?php echo ($pmservicereminder['sent']=="1" ? 'SENT' : 'SCHEDULED'); ?></li>
                </ul>
            </li>
        <?php } ?>
    </ul>

<?php } ?>

    
<?php if($service_log['entry_type']=='Fluid Entry') { ?>

    <label>Fluid Entry</label>
    <ul>
    <?php foreach($service_log['update_detail'] as $ctr => $fluid) { ?>
        <li><?php echo $fluid['quantity']; ?> <?php echo $fluid['units']; ?> <?php echo $fluid['fluid_type']; ?></li>
    <?php } ?>
    </ul>
    
<?php } ?>    
    

<?php
/** COMPLETE **/
if($service_log['entry_type']=='Component Change') { ?>

    <label for="ccs_component_type" class="control-label lb-lg">Component Type</label><img id="loading_ccs_component_type" src="<?php echo base_url(); ?>/assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
    <select id="ccs_component_type"
            name="ccs_component_type"
            class="form-control input-lg"
            data-parsley-required="true"
            data-parsley-error-message="Please select a Component Type"
            data-parsley-errors-container=".ccs_component_type_errors">
        <?php foreach($componenttypes as $ctr => $componenttype) { ?>
            <option value="<?php echo $componenttype['id']; ?>"<?php echo ($service_log['update_detail']['component_type']==$componenttype['id'] ? ' selected' : ''); ?>><?php echo $componenttype['component_type']; ?></option>
        <?php } ?>
    </select>
    <p class="form-error ccs_component_type_errors"></p>
    
    <label for="ccs_component" class="control-label lb-lg">Component</label><img id="loading_ccs_component" src="<?php echo base_url(); ?>/assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
    <select id="ccs_component"
            name="ccs_component"
            class="form-control input-lg"
            data-parsley-required="true"
            data-parsley-error-message="Please select a Component"
            data-parsley-errors-container=".ccs_component_errors">
        <?php foreach($components as $ctr => $component) { ?>
            <option value="<?php echo $component['id']; ?>"<?php echo ($service_log['update_detail']['component']==$component['component'] ? ' selected' : ''); ?>><?php echo $component['component']; ?></option>
        <?php } ?>
    </select>
    <p class="form-error ccs_component_errors"></p>
        
    <label for="ccs_component_data" class="control-label lb-lg">Component Data</label><img id="loading_ccs_component_data" src="<?php echo base_url(); ?>/assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
    <input
           id="ccs_component_data"
           name="ccs_component_data"
           type="text"
           class="form-control input-lg"
           value="<?php echo $service_log['update_detail']['component_data']; ?>"
           data-parsley-required="true"
           data-parsley-error-message="Please enter the Component Data for the Component selected"
           data-parsley-errors-container=".ccs_component_data_errors">
    <p class="form-error ccs_component_data_errors"></p>
    
    <label for="ccs_notes"class="control-label lb-lg">Notes</label>
    <textarea type="text"
           class="form-control input-lg"
           id="ccs_notes"
           name="ccs_notes"
           value=""
           data-parsley-required="true"
           data-parsley-error-message="Please enter some notes"
           data-parsley-errors-container=".ccs_notes_errors"><?php echo $service_log['update_detail']['notes']; ?></textarea>
    <p class="form-error ccs_notes_errors"></p>

<?php } ?>