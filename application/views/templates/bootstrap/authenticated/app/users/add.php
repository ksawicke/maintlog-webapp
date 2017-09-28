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
        <label for="email_address" class="control-label lb-lg">Email Address</label>
        <input type="text" id="email_address" name="email_address" class="form-control input-lg" value="<?php echo $user_email_address; ?>">
    </div>
    
    <div class="form-group">
        <label for="role" class="control-label lb-lg">Role</label>
        <select id="role" name="role" class="form-control input-lg">
            <option value="">Select one:</option>
            <option value="user"<?php echo ($user_role=="user" ? " selected" : ""); ?>>General User</option>
            <option value="admin"<?php echo ($user_role=="admin" ? " selected" : ""); ?>>Admin</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="pin" class="control-label lb-lg">PIN</label>
        <input type="password" id="pin" name="pin" class="form-control input-lg">
        <p class="help-block">
            When creating a new user, this field is required.<br />
            When editing a user, leave this field blank unless you want to reset the user's PIN.
        </p>
    </div>
    
    <div class="form-group">
        <label for="active" class="control-label lb-lg">Active</label>
        <select id="active" name="active" class="form-control input-lg">
            <option value="">Select one:</option>
            <option value="1"<?php echo ($user_active==1 ? " selected" : ""); ?>>Active</option>
            <option value="0"<?php echo ($user_active==0 ? " selected" : ""); ?>>Inactive</option>
        </select>
    </div>
    
    <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">

    <button id="btnSubmit" type="submit" class="btn btn-lg btn-primary">Submit</button>
    
</form>