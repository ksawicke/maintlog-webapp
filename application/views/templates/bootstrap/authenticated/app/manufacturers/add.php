<form id="addManufacturer" action="<?php echo base_url('manufacturers/save'); ?>" method="post">
    
    <div class="form-group">
        <label for="manufacturer_name" class="control-label lb-lg">Manufacturer Name</label>
        <input type="text" id="manufacturer_name" name="manufacturer_name" class="form-control input-lg" value="<?php echo $manufacturer_manufacturer_name; ?>">
    </div>
    
    <input type="hidden" id="manufacturer_id" name="manufacturer_id" value="<?php echo $manufacturer_id; ?>">

    <button id="btnSubmit" type="submit" class="btn btn-lg btn-primary">Submit</button>
    
</form>