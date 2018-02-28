<form id="addChecklistItem" action="<?php echo base_url('index.php/checklistitems/save'); ?>" method="post">
    
    <div class="group mainFlow">        
        <div class="form-group">            
            <label for="item" class="control-label lb-lg">Item</label>
            <input type="text" id="item" name="item" class="form-control input-lg" value="<?php echo $checklistitem_item; ?>">
        </div>
    </div>
    
    <input type="hidden" id="checklistitem_id" name="checklistitem_id" value="<?php echo $checklistitem_id; ?>">

    <button id="btnSubmit" type="submit" class="btn btn-lg btn-primary">Submit</button>
    
</form>