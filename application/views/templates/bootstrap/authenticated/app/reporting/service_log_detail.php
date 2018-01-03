<?php echo $reports_navigation; ?>

<h3>SERVICE LOG DETAIL</h3>

<h5>This page is currently being developed.</h5>

<label>Date Entered</label>
<ul>
    <li><?php echo date('m/d/Y', strtotime($service_log['date_entered'])); ?></li>
</ul>

<label>Entered By</label>
<ul>
    <li>...</li>
</ul>

<label>Serviced By</label>
<ul>
    <li>...</li>
</ul>

<label>Manufacturer</label>
<ul>
    <li><?php echo $service_log['manufacturer_name']; ?></li>
</ul>

<label>Equipment Model</label>
<ul>
    <li><?php echo $service_log['model_number']; ?></li>
</ul>

<label>Unit Number</label>
<ul>
    <li><?php echo $service_log['unit_number']; ?></li>
</ul>

<label>Entry Selection</label>
<ul>
    <li><?php echo $service_log['entry_type']; ?></li>
</ul>


<?php if($service_log['entry_type']=='SMR Update') { ?>
    <label>SMR</label>
    <ul>
        <li><?php echo $service_log['update_detail']['smr']; ?></li>
    </ul>
<?php } ?>


<?php if($service_log['entry_type']=='PM Service') { ?>

    <?php
    $pm_type = "";
    switch($service_log['update_detail']['pm_type']) {
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

    <label>PM Type</label>
    <ul>
        <li><?php echo $pm_type; ?></li>
    </ul>
    
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
        
            <ul>
                <li>
                    <label><?php echo $pmservicereminder['emails']; ?></label>
                    <ul>
                        <li><strong>PM Type</strong> <?php echo $pm_type; ?></li>
                        <li><strong>PM Level</strong> <?php echo $pmservicereminder['pm_level']; ?></li>
                        <li><strong>Quantity</strong> <?php echo $pmservicereminder['quantity']; ?></li>
                        <li><strong>Units</strong> <?php echo $pmservicereminder['units']; ?></li>
                        <li><strong>Date</strong> <?php echo date('m/d/Y', strtotime($pmservicereminder['date'])); ?></li>
                        <li><strong>Email Status</strong> <?php echo ($pmservicereminder['sent']=="1" ? 'SENT' : 'SCHEDULED'); ?></li>
                    </ul>
                </li>
            </ul>
        <?php } ?>
    </ul>

<?php } ?>

    
<?php if($service_log['entry_type']=='Fluid Entry') { ?>

    <?php foreach($service_log['update_detail'] as $ctr => $fluid) { ?>
        <ul>
            <li>
                <label>Fluid Entry</label>
                <ul>
                    <li><strong>Fluid Type</strong> <?php echo $fluid['fluid_type']; ?></li>
                    <li><strong>Amount</strong> <?php echo $fluid['quantity']; ?> <?php echo $fluid['units']; ?></li>
                </ul>
        </ul>
    <?php } ?>
    
<?php } ?>    
    

<?php if($service_log['entry_type']=='Component Change') { ?>

    <label>Component Type</label>
    <ul>
        <li><?php echo $service_log['update_detail']['component_type']; ?></li>
    </ul>

    <label>Component</label>
    <ul>
        <li><?php echo $service_log['update_detail']['component']; ?></li>
    </ul>

    <label>Component Data</label>
    <ul>
        <li><?php echo $service_log['update_detail']['component_data']; ?></li>
    </ul>

    <label>Notes</label>
    <ul>
        <li><?php echo $service_log['update_detail']['notes']; ?></li>
    </ul>

<?php } ?>