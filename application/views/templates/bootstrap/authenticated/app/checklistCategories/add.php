<form id="addChecklistCategory" action="<?php echo base_url('index.php/checklistcategories/save'); ?>" method="post">
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="category" class="control-label lb-lg">Category</label>
            <input type="text" id="category" name="category" class="form-control input-lg" value="<?php echo $checklistcategory_category; ?>">
        </div>
    </div>
    
    <input type="hidden" id="checklistcategory_id" name="checklistcategory_id" value="<?php echo $checklistcategory_id; ?>">

    <button id="btnSubmit" type="submit" class="btn btn-lg btn-primary">Submit</button>
    
</form>