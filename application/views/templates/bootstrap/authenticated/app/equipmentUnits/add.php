<form id="addEquipmentUnit" action="<?php echo base_url('equipmentunits/save'); ?>" method="post">
    
    <div class="group mainFlow">
        <div class="form-group">
            <label for="equipment_type" class="control-label lb-lg">Equipment Type</label>
            <select id="equipment_type"
                    name="equipment_type"
                    class="form-control input-lg"
                    data-parsley-required="true"
                    data-parsley-error-message="Please select the equipment type"
                    data-parsley-errors-container=".equipment_type_errors">
                <option value="">Select one:</option>
                <?php foreach($equipmenttypes as $equipmenttype) { ?>
                    <option value="<?php echo $equipmenttype->id; ?>"<?php echo ($equipment_equipmenttype_id==$equipmenttype->id ? ' selected' : ''); ?>><?php echo $equipmenttype->equipment_type; ?></option>
                <?php } ?>
            </select>
            
            <label for="equipmentmodel_id" class="control-label lb-lg">Equipment Model</label>
            <select id="equipmentmodel_id"
                    name="equipmentmodel_id"
                    class="form-control input-lg"
                    data-parsley-required="true"
                    data-parsley-error-message="Please select the equipment model"
                    data-parsley-errors-container=".equipmentmodel_id_errors"
                    disabled>
            </select>
            
            <label for="unit_number" class="control-label lb-lg">Unit Number</label>
            <input type="text" id="unit_number" name="unit_number" class="form-control input-lg" value="<?php echo $equipment_unit_number; ?>">
        </div>
    </div>
    
    <input type="hidden" id="equipmentunit_id" name="equipmentunit_id" value="<?php echo $equipmentunit_id; ?>">

    <button id="btnSubmit" type="submit" class="btn btn-lg btn-primary">Submit</button>
    
</form>

<script type="text/javascript">
    $(function () {
        function populateDropdownWithData(serviceUrl, field) {            
            var jqxhr = $.ajax({
                url: serviceUrl,
                type: "POST",
                dataType: "json",
                data: JSON.stringify({"id": $("#equipment_type").val()}),
                contentType: "application/json"
            }).done(function(object) {
                // Clear dropdown first.
                $('#equipmentmodel_id').empty();
                $('#equipmentmodel_id').append('<option value="">Select one:</option>');
                
                // Populate dropdown via ajax.
                $.each(object.data, function(id, unitData) {
                    //unitData.equipmentmodel_id
                    //unitData.manufacturer_name
                    var id = unitData.equipmentmodel_id,
                        value = unitData.manufacturer_name + " " + unitData.model_number;
                        
                    $('#equipmentmodel_id').append('<option value="' + id + '">' + value + '</option>');
                });
                
                <?php if(!empty($equipmentunit_id)) { ?>
                    $("#equipmentmodel_id").val("<?php echo $equipment_equipmentmodel_id; ?>");
                <?php } ?>
            });
        }  
        
        $("#equipment_type").on('change', function() {
            $("#equipmentmodel_id").prop('disabled', false);
            populateDropdownWithData("/sites/komatsuna/equipmentmodel/getEquipmentByType",
                $("#equipmentmodel_id"));
        });
        
        <?php if(!empty($equipmentunit_id)) { ?>
            $("#equipmentmodel_id").prop('disabled', false);
            populateDropdownWithData("/sites/komatsuna/equipmentmodel/getEquipmentByType",
                $("#equipmentmodel_id"));
        <?php } ?>
    });
</script>