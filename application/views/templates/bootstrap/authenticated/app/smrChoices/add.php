<form id="addSmrChoice" action="<?php echo base_url('smrchoices/save'); ?>" method="post">
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="smr_choice" class="control-label lb-lg">SMR Choice</label>
            <input type="text" id="smr_choice" name="smr_choice" class="form-control input-lg" value="<?php echo $smrchoice_smr_choice; ?>">
        </div>
    </div>
    
    <input type="hidden" id="smrchoice_id" name="smrchoice_id" value="<?php echo $smrchoice_id; ?>">

    <button id="btnSubmit" type="submit" class="btn btn-lg btn-primary">Submit</button>
    
</form>