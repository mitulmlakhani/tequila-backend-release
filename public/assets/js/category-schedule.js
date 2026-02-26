$(document).ready(function () {
    $(document).on("click", "#category-add", function (e) {
        $(".main-heading h4").text("Add Category Schedule");
        var categoryAddForm = $("form");
        categoryAddForm.attr("action", categoryCreateUrl);
        categoryAddForm.find("button[type=submit]").text("Add");
        categoryAddForm.find("#title").val("");
        categoryAddForm.find("#status").val("1");
        categoryAddForm.find("#categories").val("").trigger("change");
        categoryAddForm.find('.days_checkbox').each(function () {
            $(this).prop("checked", false);
        });

        setTempData("modal_title", "Add Category Schedule");
        setTempData("add_update", "Add");
        $(".validation-error").hide();
    });

    $(document).on("click", "#category-edit", function (e) {
        $(".main-heading h4").text("Edit Category Schedule");
        var categoryAddForm = $("form");
        var id = $(this).data("id");
        var formUrl = categoryUpdateUrl.replace(":id", id);
        categoryAddForm.attr("action", formUrl);
        categoryAddForm.find("button[type=submit]").text("Update");

        var url = categoryDetailUrl.replace(":id", id);

        $.ajax({
            url: url,
            type: "GET",
            success: function (response) {
                if (response.success) {
                    categoryAddForm.find("#title").val(response.data.title);

                    categoryAddForm.find('.days_checkbox').each(function () {
                        $(this).prop("checked", false);
                    });

                    response.data.days.forEach(function (day) {
                        categoryAddForm.find(`#${day}`).prop("checked", true);
                    });

                    categoryAddForm.find("#status").val(response.data.status);
                    categoryAddForm
                        .find("#categories")
                        .val(response.data.categories)
                        .trigger("change");

                    var [from_hour, from_minute, from_ampm] =
                        response.data.from_time.split(":");
                    var [to_hour, to_minute, to_ampm] =
                        response.data.to_time.split(":");

                    categoryAddForm.find("#from_hour").val(from_hour);
                    categoryAddForm.find("#from_minute").val(from_minute);
                    categoryAddForm.find("#from_ampm").val(from_ampm);

                    categoryAddForm.find("#to_hour").val(to_hour);
                    categoryAddForm.find("#to_minute").val(to_minute);
                    categoryAddForm.find("#to_ampm").val(to_ampm);

                    setTempData("modal_title", "Edit Category");
                    setTempData("add_update", "Update");
                    setTempData("formUrl", formUrl);
                    $(".validation-error").hide();
                }
            },
        });
    });

    $(document).on("click", "#deleteCategory", function (e) {
        var url = $(this).data("url");
        $("#deleteCategoryBtn").attr("href", url);
    });

    $("#all_days").on("click", function () {
        var isChecked = $(this).is(":checked");
        $(".days_checkbox").prop("checked", isChecked);
    });

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
});
