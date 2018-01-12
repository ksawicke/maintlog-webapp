<form id="addMileageChoice" action="<?php echo base_url('index.php/mileagechoices/save'); ?>" method="post">
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="mileage_choice" class="control-label lb-lg">Mileage Choice</label>
            <input type="text" id="mileage_choice" name="mileage_choice" class="form-control input-lg" value="<?php echo $mileagechoice_mileage_choice; ?>">
        </div>
    </div>
    
    <input type="hidden" id="mileagechoice_id" name="mileagechoice_id" value="<?php echo $mileagechoice_id; ?>">

    <button id="btnSubmit" type="submit" class="btn btn-lg btn-primary">Submit</button>
    
</form>