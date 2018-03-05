<form id="addFluidType" class="parsley-form" action="<?php echo base_url('index.php/fluidtypes/save'); ?>" method="post">
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="fluid_type" class="control-label lb-lg">Fluid Type</label>
            <input type="text" id="equipment_type" name="fluid_type" class="form-control input-lg" value="<?php echo $fluidtype_fluid_type; ?>">
        </div>
    </div>
    
    <input type="hidden" id="fluidtype_id" name="fluidtype_id" value="<?php echo $fluidtype_id; ?>">

    <button id="btnSubmit" type="submit" class="btn btn-lg btn-primary">Submit</button>
    
</form>
