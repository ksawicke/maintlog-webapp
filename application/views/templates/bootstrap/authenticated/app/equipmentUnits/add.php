<form id="addEquipmentUnit" action="<?php echo base_url('equipmentunits/save'); ?>" method="post">
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="equipment_unit" class="control-label lb-lg">Equipment Unit</label>
            <input type="text" id="equipment_unit" name="equipment_unit" class="form-control input-lg" value="<?php echo $equipmentunit_equipment_unit; ?>">
        </div>
    </div>
    
    <input type="hidden" id="equipmentunit_id" name="equipmentunit_id" value="<?php echo $equipmentunit_id; ?>">

    <button id="btnSubmit" type="submit" class="btn btn-lg btn-primary">Submit</button>
    
</form>