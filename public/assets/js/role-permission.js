$('#loadpermission').on('change', function () {
    const role = $(this).val();
    $('.form-check-input').prop('checked', false);
    $('#apply-default-permissions').addClass('d-none');

    if (role) {
        $.get(loadRolePermissionUrl, { role: role }, function (response) {
            if (!response.error && response.resp) {
                response.resp.forEach(function (id) {
                    $('.permisisoncheck' + id).prop('checked', true);
                });

                if (response.has_default) {
                    $('#apply-default-permissions').removeClass('d-none');
                }

                // Update group checkboxes
                $('.select-all-group').each(function () {
                    const group = $(this).data('group');
                    const groupCheckboxes = $('.' + group);
                    const allChecked =
                        groupCheckboxes.length ===
                        groupCheckboxes.filter(':checked').length;
                    $(this).prop('checked', allChecked);
                });
            }
        });
    }
});

$('#update-permissions').on('submit', function (e) {
    const checked = $('.permission_checkbox:checked').length;
    if (checked < 1) {
        alert('Select at least one permission.');
        e.preventDefault();
    }
});

$('.select-all-group').on('change', function () {
    const groupIndex = $(this).data('group');
    const isChecked = $(this).is(':checked');
    $('.' + groupIndex).prop('checked', isChecked);
});

// Prevent permission checkbox interaction when no role is selected
$(document).on('change', '.permission_checkbox, .select-all-group', function (e) {
    const selectedRole = $('#loadpermission').val();
    if (!selectedRole) {
        $('#role-warning').removeClass('d-none');
        $(this).prop('checked', false);
        e.preventDefault();

        // Ensure it hides again after 2 seconds every time it's shown
        setTimeout(() => {
            $('#role-warning').addClass('d-none');
        }, 2000);

        return false;
    }
});

let allSelected = false;

$('#select-all-permissions').on('click', function () {
    const selectedRole = $('#loadpermission').val();

    if (!selectedRole) {
        $('#role-warning').removeClass('d-none');
        setTimeout(() => {
            $('#role-warning').addClass('d-none');
        }, 2000);
        return;
    }

    allSelected = !allSelected;

    $('.permission_checkbox').prop('checked', allSelected);
    $('.select-all-group').prop('checked', allSelected);

    $(this).text(allSelected ? 'Unselect All Permissions' : 'Select All Permissions');
});

$('#apply-default-permissions').on('click', function () {
    const role = $('#loadpermission').val();
    if (!role) return;

    $.post(loadDefaultPermissionUrl, {
        role: role,
        _token: $('meta[name="csrf-token"]').attr('content')
    }, function (response) {
        if (!response.error && response.resp) {
            $('.form-check-input').prop('checked', false); // Reset all
            response.resp.forEach(function (id) {
                $('.permisisoncheck' + id).prop('checked', true);
            });

            // Update group checkboxes
            $('.select-all-group').each(function () {
                const group = $(this).data('group');
                const groupCheckboxes = $('.' + group);
                const allChecked = groupCheckboxes.length === groupCheckboxes.filter(':checked').length;
                $(this).prop('checked', allChecked);
            });
        }
    });
});


// Sync group checkbox if all children are checked manually
$(".permission_checkbox").on("change", function () {
    let checkbox = $(this);
    let classes = checkbox.attr("class").split(/\s+/);

    // Find group_XXX
    let groupClass = classes.find((cls) => cls.startsWith("group_"));
    if (!groupClass) return;

    let all = $("." + groupClass).length;
    let checked = $("." + groupClass + ":checked").length;

    $('.select-all-group[data-group="' + groupClass + '"]').prop(
        "checked",
        all === checked
    );
});