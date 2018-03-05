<form id="addTimeChoice" class="parsley-form" action="<?php echo base_url('index.php/timechoices/save'); ?>" method="post">
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="time_choice" class="control-label lb-lg">Time Choice</label>
            <input type="text" id="smr_choice" name="time_choice" class="form-control input-lg" value="<?php echo $timechoice_time_choice; ?>">
        </div>
    </div>
    
    <input type="hidden" id="timechoice_id" name="timechoice_id" value="<?php echo $timechoice_id; ?>">

    <button id="btnSubmit" type="submit" class="btn btn-lg btn-primary">Submit</button>
    
</form>
