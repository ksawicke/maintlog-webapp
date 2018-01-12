<div class="form-group col-md-12 col-md-12 nopadding">
    <p></p>
    <a href="<?php echo base_url(); ?>index.php/app/log_entry"><button class="btn btn-lg btn-primary btn-block" type="submit">Log Entry</button></a>
</div>

<?php if($_SESSION['role']==='admin') { ?>
    <!--div class="form-group col-md-12 col-md-12 nopadding">
        <p></p>
        <a href="<?php //echo base_url(); ?>index.php/app/employees"><button class="btn btn-lg btn-primary btn-block" type="submit">Employees</button></a>
    </div-->

    <div class="form-group col-md-12 col-md-12 nopadding">
        <p></p>
        <a href="<?php echo base_url(); ?>index.php/app/users"><button class="btn btn-lg btn-primary btn-block" type="submit">Users</button></a>
    </div>

    <div class="form-group col-md-12 col-md-12 nopadding">
        <p></p>
        <a href="<?php echo base_url(); ?>index.php/app/equipmentunit"><button class="btn btn-lg btn-primary btn-block" type="submit">Equipment</button></a>
    </div>

    <div class="form-group col-md-12 col-md-12 nopadding">
        <p></p>
        <a href="<?php echo base_url(); ?>index.php/app/reporting"><button class="btn btn-lg btn-primary btn-block" type="submit">Reporting</button></a>
    </div>
<?php } ?>