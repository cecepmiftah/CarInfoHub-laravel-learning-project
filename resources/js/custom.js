document.addEventListener("DOMContentLoaded", function () {
    function loadDropdown(
        triggerElement,
        targetElement,
        urlPrefix,
        placeholderText
    ) {
        document
            .querySelector(triggerElement)
            .addEventListener("change", function () {
                var id = this.value;
                var dropdown = document.querySelector(targetElement);

                if (id) {
                    fetch(`${urlPrefix}/${id}`)
                        .then((response) => response.json())
                        .then((data) => {
                            dropdown.innerHTML = `<option value="">${placeholderText}</option>`;
                            data.forEach((item) => {
                                var option = document.createElement("option");
                                option.value = item.id;
                                option.textContent = item.name;
                                dropdown.appendChild(option);
                            });
                            dropdown.disabled = false;
                        });
                } else {
                    dropdown.innerHTML = `<option value="">${placeholderText}</option>`;
                    dropdown.disabled = true;
                }
            });
    }

    // Load models based on maker selection
    loadDropdown(
        "#makerSelect",
        "#modelSelect",
        "/get-models",
        "-- Select Model --"
    );

    // Load cities based on state selection
    loadDropdown(
        "#stateSelect",
        "#citySelect",
        "/get-cities",
        "-- Select City --"
    );
});
