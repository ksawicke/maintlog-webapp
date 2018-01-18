<?php echo $appsetting_navigation; ?>

<form id="addReminderRecipient" action="<?php echo base_url('index.php/reminderrecipients/save'); ?>" method="post">
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="reminder_recipient[]" class="control-label lb-lg">Reminder Recipient</label><img id="loading_reminder_recipient" src="http://test.rinconmountaintech.com/sites/komatsuna/assets/templates/komatsuna/img/ajax_loading.gif" class="loading">
            <select id="reminder_recipient"
                name="reminder_recipient[]"
                class="form-control input-lg"
                multiple
                data-parsley-required="true"
                data-parsley-mincheck="1"
                data-parsley-error-message="Please select at least one person that should receive notifications for all service log entries"
                data-parsley-errors-container=".serviced_by_errors">
        </select>
        <p class="form-error reminder_recipient_errors"></p>
        </div>
    </div>

    <button id="btnSubmit" type="submit" class="btn btn-lg btn-primary">Submit</button>
    
</form>

<script>
    $(function () {
        function populateUserData(serviceUrl, field) {      
            $("#loading_reminder_recipient").show();

            var jqxhr = $.ajax({
                url: serviceUrl,
                type: "POST",
                dataType: "json",
                data: JSON.stringify({}), // no need to send data, just get it
                contentType: "application/json"
            }).done(function(object) {
                // Clear dropdowns first.
                $('#reminder_recipient').empty();

                populateEnteredByDropdownWithData(object);
                $("#loading_reminder_recipient").hide();
            });
        }
        
        function populateEnteredByDropdownWithData(object) {
            // Populate dropdown via ajax.
            $.each(object.data, function(id, userData) {
                var id = userData.id,
                    value = userData.last_name + ", " + userData.first_name,
                    current = userData.current,
                    reminderrecipient = userData.logentry_reminderrecipient;

                $('#reminder_recipient').append('<option value="' + id + '"' + (reminderrecipient === '1' ? ' selected' : '' ) + '>' + value + '</option>');
            });
        }
        
        populateUserData("/sites/komatsuna/users/getUsers",
            $("#reminder_recipient"));
    });

</script>