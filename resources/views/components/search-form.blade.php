<section class="find-a-car">
    <div class="container">
        <form action="{{ route('car.search') }}" method="GET" class="find-a-car-form card flex p-medium">
            <div class="find-a-car-inputs">
                <div>
                    <select id="makerSelect" name="maker_id">
                        <option value="" style="display: block">Maker</option>
                        @foreach ($makers as $maker)
                            <option value="{{ $maker->id }}">{{ $maker->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select id="modelSelect" name="model_id" disabled>
                        <option value="" style="display: block">Model</option>
                    </select>
                </div>
                <div>
                    <select id="stateSelect" name="state_id">
                        <option value="">State/Region</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select id="citySelect" name="city_id" disabled>
                        <option value="" style="display: block">City</option>
                    </select>
                </div>
                <div>
                    <select name="car_type_id">
                        <option value="">Type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <input type="number" placeholder="Year From" name="year_from" />
                </div>
                <div>
                    <input type="number" placeholder="Year To" name="year_to" />
                </div>
                <div>
                    <input type="number" placeholder="Price From" name="price_from" />
                </div>
                <div>
                    <input type="number" placeholder="Price To" name="price_to" />
                </div>
                <div>
                    <select name="fuel_type_id">
                        <option value="">Fuel Type</option>
                        @foreach ($fuelTypes as $fuelType)
                            <option value="{{ $fuelType->id }}">{{ $fuelType->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <button type="button" class="btn btn-find-a-car-reset">
                    Reset
                </button>
                <button class="btn btn-primary btn-find-a-car-submit">
                    Search
                </button>
            </div>
        </form>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        function loadDropdown(triggerElement, targetElement, urlPrefix, placeholderText) {
            $(triggerElement).change(function() {
                var id = $(this).val();
                var dropdown = $(targetElement);

                if (id) {
                    $.ajax({
                        url: `${urlPrefix}/${id}`,
                        type: 'GET',
                        success: function(response) {
                            dropdown.empty().append(
                                `<option value="">${placeholderText}</option>`);

                            $.each(response, function(index, item) {
                                dropdown.append(
                                    `<option value="${item.id}">${item.name}</option>`
                                );
                            });

                            dropdown.prop('disabled', false);
                        }
                    });
                } else {
                    dropdown.empty().append(`<option value="">${placeholderText}</option>`).prop(
                        'disabled', true);
                }
            });
        }

        // Load models based on maker selection
        loadDropdown('#makerSelect', '#modelSelect', '/get-models', '-- Select Model --');

        // Load cities based on state selection
        loadDropdown('#stateSelect', '#citySelect', '/get-cities', '-- Select City --');
    });
</script>
