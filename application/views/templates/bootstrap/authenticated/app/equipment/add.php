<form id="addEquipment" action="<?php echo base_url('equipment/save'); ?>" method="post">
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="unit_number" class="control-label lb-lg">Unit No.</label>
            <input type="text" id="unit_number" name="unit_number" class="form-control input-lg" value="<?php echo $equipment_unit_number; ?>">
        </div>
        <div class="form-group">
            <label for="manufacturer_id" class="control-label lb-lg">Manufacturer</label>
            <select class="form-control input-lg" id="manufacturer_id" name="manufacturer_id" style="width: 100%;">
            <option value="">Select one:</option>
            <?php
            foreach($manufacturers as $manufacturerkey => $manufacturer) {
                echo '<option value="' . $manufacturer->id . '"' . ($equipment_manufacturer_id==$manufacturerkey ? ' selected' : '') . '>' . $manufacturer->manufacturer_name . '</option>';
            }
            ?>
            </select>
        </div>
        <div class="form-group">
            <label for="model_number" class="control-label lb-lg">Model No.</label>
            <input type="text" id="model_number" name="model_number" class="form-control input-lg" value="<?php echo $equipment_model_number; ?>">
        </div>
        <div class="form-group">
            <label for="equipmenttype_id" class="control-label lb-lg">Equipment Type</label>
            <select id="equipmenttype_id" name="equipmenttype_id" class="form-control input-lg">
                <option value="">Select one:</option>
                <?php foreach($equipmenttypes as $equipmenttype) {
                    echo '<option value="' . $equipmenttype->id . '"' . ($equipmenttype->id==$equipment_equipmenttype_id ? ' selected' : '') . '>' . $equipmenttype->equipment_type . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
    
    <input type="hidden" id="equipment_id" name="equipment_id" value="<?php echo $equipment_id; ?>">

    <button id="btnSubmit" type="submit" class="btn btn-lg btn-primary">Submit</button>
    
</form>