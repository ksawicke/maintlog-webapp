<form id="addEquipmentType" action="<?php echo base_url('equipmenttypes/save'); ?>" method="post">
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="equipment_type" class="control-label lb-lg">Equipment Type</label>
            <input type="text" id="equipment_type" name="equipment_type" class="form-control input-lg" value="<?php echo $equipmenttype_equipment_type; ?>">
        </div>
    </div>
    
    <input type="hidden" id="equipmenttype_id" name="equipmenttype_id" value="<?php echo $equipmenttype_id; ?>">

    <button id="btnSubmit" type="submit" class="btn btn-lg btn-primary">Submit</button>
    
</form>