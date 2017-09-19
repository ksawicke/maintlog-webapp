<p class="text-center" style="margin-top:100px;">
    <img src="<?php echo $assetDirectoryCustom; ?>img/025_Gloria_blue_nega_r.jpg"><br />
    <h3><strong>Maintenance Log Application</strong></h3><br />
</p>

<?php if(array_key_exists('alert_danger', $flashdata)) { ?>
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
    <?php echo $flashdata['alert_danger']; ?>
</div>
<?php } ?>

<?php if(array_key_exists('alert_success', $flashdata)) { ?>
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-check"></i> Success!</h4>
    <?php echo $flashdata['alert_success']; ?>
</div>
<?php } ?>

<form action="<?php echo base_url(); ?>auth/check" method="post">
    <p>
        <label for="username" class="sr-only">Username</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
    </p>
    
    <p>
        <label for="pin" class="sr-only">PIN</label>
        <input type="password" id="pin" name="pin" class="form-control" placeholder="PIN" required>
    </p>
    
    <button class="btn btn-lg btn-primary btn-block" type="submit">Log In</button>
</form>