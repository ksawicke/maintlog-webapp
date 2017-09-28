<form id="addUser" action="<?php echo base_url('users/save'); ?>" method="post">
    
    <div class="form-group">
        <label for="first_name" class="control-label lb-lg">First Name</label>
        <input type="text" id="first_name" name="first_name" class="form-control input-lg" value="<?php echo $user_first_name; ?>">
    </div>
    
    <div class="form-group">
        <label for="last_name" class="control-label lb-lg">Last Name</label>
        <input type="text" id="last_name" name="last_name" class="form-control input-lg" value="<?php echo $user_last_name; ?>">
    </div>
    
    <div class="form-group">
        <label for="email_address" class="control-label lb-lg">Last Name</label>
        <input type="text" id="email_address" name="email_address" class="form-control input-lg" value="<?php echo $user_email_address; ?>">
    </div>
    
    <div class="form-group">
        <label for="role" class="control-label lb-lg">Role</label>
        <select id="role" name="role" class="form-control input-lg">
            <option value="">Select one:</option>
            <option value="user">General User</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="pin" class="control-label lb-lg">PIN</label>
        <input type="text" id="pin" name="pin" class="form-control input-lg">
    </div>
    
    <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">

    <button id="btnSubmit" type="submit" class="btn btn-lg btn-primary">Submit</button>
    
</form>