window.initCheckboxSelect = function () {
    function formatOptionWithCheckbox(data, selectedValues) {
        if (!data.id) return data.text;

        const isChecked = selectedValues.includes(data.id);
        const checkbox = `<input class="select2-check me-1 form-check-input select2-checkbox" data-id="${
            data.id
        }" type="checkbox" ${isChecked ? "checked" : ""} />`;
        return $(`<span class="form-check">${checkbox} <label class="form-check-label">${data.text}</label></span>`);
    }

    $(".checkbox-select").each(function () {
        const $select = $(this);
        const containerAttr = $(this).attr('data-containerId');

        if ($select.hasClass("select2-hidden-accessible")) {
            return;
        }

        // Get all option values except 'select_all'
        const allOptionValues = $select
            .find("option")
            .map(function () {
                const val = $(this).val();
                return val !== "select_all" ? val : null;
            })
            .get();

        var select2Opts = {
            closeOnSelect: false,
            templateResult: function (data) {
                const selected = $select.val() || [];
                return formatOptionWithCheckbox(data, selected);
            },
            templateSelection: (data) =>
                data.id === "select_all" ? "" : data.text,
        };

        if (containerAttr) {
            select2Opts.dropdownParent = $("#" + containerAttr);
        }

        $select.select2(select2Opts);

        // Function to check if all options are selected
        function areAllOptionsSelected() {
            const selected = $select.val() || [];
            return (
                allOptionValues.length > 0 &&
                allOptionValues.every((val) => selected.includes(val))
            );
        }

        // Function to update select_all based on other selections
        function updateSelectAllState() {
            const currentValues = $select.val() || [];
            const hasSelectAll = currentValues.includes("select_all");
            const shouldHaveSelectAll = areAllOptionsSelected();

            if (shouldHaveSelectAll && !hasSelectAll) {
                // Add select_all without triggering events
                $select
                    .val([...currentValues, "select_all"])
                    .trigger("change.select2");
            } else if (!shouldHaveSelectAll && hasSelectAll) {
                // Remove select_all without triggering events
                const newValues = currentValues.filter(
                    (val) => val !== "select_all"
                );
                $select.val(newValues).trigger("change.select2");
            }
        }

        // // Select All logic
        $select.on("select2:select", function (e) {
            if (e.params.data.id === "select_all") {
                $select
                    .val(allOptionValues.concat("select_all"))
                    .trigger("change.select2");
            } else {
                setTimeout(updateSelectAllState, 0);
            }
        });

        $select.on("select2:unselect", function (e) {
            if (e.params.data.id === "select_all") {
                $select.val(null).trigger("change.select2");
            } else {
                setTimeout(updateSelectAllState, 0);
            }
        });

        function updateCheckboxStates() {
            const selected = ($select.val() || []).map((s) => s.toString());
            $(".select2-results__option").each(function () {
                const $opt = $(this);
                const checkbox = $opt.find('input[type="checkbox"]');
                const optId = checkbox.data("id");
                if (checkbox.length) {
                    checkbox.prop(
                        "checked",
                        selected.includes(optId.toString())
                    );
                }
            });
        }

        $select.on(
            "select2:open select2:select select2:unselect",
            updateCheckboxStates
        );

        $select.on("select2:open", updateSelectAllState);
    });

    $(document).on(
        "click",
        ".select2-checkbox",
        function (e) {
            e.stopPropagation();
            e.preventDefault();
        }
    );
};
