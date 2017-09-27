<form id="editAppsettings" action="<?php echo base_url('appsettings/save'); ?>" method="post">
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="smr_based_choices" class="control-label lb-lg">SMR Based Choices</label>
            <textarea id="smr_based_choices" name="smr_based_choices" class="form-control input-lg"><?php echo $smr_based_choices; ?></textarea>
        </div>
    </div>
    <div class="group mainFlow">
        <div class="form-group">
            <label for="mileage_based_choices" class="control-label lb-lg">Mileage Based Choices</label>
            <textarea id="mileage_based_choices" name="mileage_based_choices" class="form-control input-lg"><?php echo $mileage_based_choices; ?></textarea>
        </div>
    </div>
    <div class="group mainFlow">
        <div class="form-group">
            <label for="time_based_choices" class="control-label lb-lg">Time Based Choices</label>
            <textarea id="time_based_choices" name="time_based_choices" class="form-control input-lg"><?php echo $time_based_choices; ?></textarea>
        </div>
    </div>

    <button id="btnSubmit" type="submit" class="btn btn-lg btn-primary">Submit</button>
    
</form>