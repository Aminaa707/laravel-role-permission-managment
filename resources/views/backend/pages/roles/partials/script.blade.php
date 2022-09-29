<!-- script for mark all checkbox at once -->
<script>
    $("#allCheckPermission").click(function() {
        if ($(this).is(':checked')) {
            //Check all the checkbox
            $('input[type=checkbox]').prop('checked', true);
        } else {
            // Un check all the checkbox 
            $('input[type=checkbox]').prop('checked', false);
        }
    })

    function checkPermissionByGroup(className, checkThis) {
        const groupIdName = $("#" + checkThis.id);
        const classCheckBox = $('.' + className + ' input');

        // console.log(classCheckBox);
        if (groupIdName.is(':checked')) {

            classCheckBox.prop('checked', true);
        } else {

            classCheckBox.prop('checked', false);
        }
    }

    function checkSinglePermission(groupClassName, groupId, countTotalPermission) {
        const classCheckbox = $('.' + groupClassName + " input");
        const groupIDCheckbox = $('#' + groupId);

        // if there is any occurance where someting is not selected then make selected = false

        if ($('.' + groupClassName + " input:checked").length == countTotalPermission) {
            groupIDCheckbox.prop('checked', true);
        } else {
            groupIDCheckbox.prop('checked', false);

        }
    }
</script>