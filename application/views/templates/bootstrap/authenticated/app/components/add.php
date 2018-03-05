<form id="addComponentType" class="parsley-form" action="<?php echo base_url('index.php/components/save'); ?>" method="post">
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="component" class="control-label lb-lg">Component</label>
            <input type="text" id="component" name="component" class="form-control input-lg" value="<?php echo $component_component; ?>">
        </div>
    </div>
    
    <input type="hidden" id="component_id" name="component_id" value="<?php echo $component_id; ?>">

    <button id="btnSubmit" type="submit" class="btn btn-lg btn-primary">Submit</button>
    
</form>
