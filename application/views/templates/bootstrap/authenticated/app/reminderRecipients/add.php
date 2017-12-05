<form id="addReminderRecipient" action="<?php echo base_url('reminderrecipients/save'); ?>" method="post">
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="reminder_recipient" class="control-label lb-lg">Reminder Recipient</label>
            <input type="text" id="reminder_recipient" name="reminder_recipient" class="form-control input-lg" value="<?php echo $reminderrecipient_reminder_recipient; ?>">
        </div>
    </div>
    
    <input type="hidden" id="reminderrecipient_id" name="reminderrecipient_id" value="<?php echo $reminderrecipient_id; ?>">

    <button id="btnSubmit" type="submit" class="btn btn-lg btn-primary">Submit</button>
    
</form>