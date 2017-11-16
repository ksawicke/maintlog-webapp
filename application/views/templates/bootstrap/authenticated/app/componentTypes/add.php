<form id="addComponentType" action="<?php echo base_url('componenttypes/save'); ?>" method="post">
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="component_type" class="control-label lb-lg">Component Type</label>
            <input type="text" id="component_type" name="component_type" class="form-control input-lg" value="<?php echo $componenttype_component_type; ?>">
        </div>
    </div>
    
    <input type="hidden" id="componenttype_id" name="componenttype_id" value="<?php echo $componenttype_id; ?>">

    <button id="btnSubmit" type="submit" class="btn btn-lg btn-primary">Submit</button>
    
</form>