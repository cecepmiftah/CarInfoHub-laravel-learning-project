<x-app-layout>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="bg-red-500 text-gray-600 bold m-auto py-2 px-3 text-base">
                {{ $error }}
            </div>
        @endforeach
    @endif
    <main>
        <div class="container-small">
            <h1 class="car-details-page-title">Add new car</h1>
            <form method="POST" action="{{ route('car.store') }}" enctype="multipart/form-data"
                class="card add-new-car-form">

                @csrf

                <div class="form-content">
                    <div class="form-details">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Maker</label>
                                    <select name="maker_id" id="makerSelect" required>
                                        <option value="">Maker</option>
                                        @foreach ($makers as $maker)
                                            <option value="{{ $maker->id }}"
                                                {{ old('maker_id') == $maker->id ? 'selected' : '' }}>
                                                {{ $maker->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('maker_id')
                                        <p class="">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Model</label>

                                    <select name="model_id" id="modelSelect" disabled required>
                                        <option value="">Model</option>
                                    </select>
                                    @error('model_id')
                                        <p class="">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select name="year" required>
                                        <option value="">Year</option>

                                        @foreach ($years as $year)
                                            <option value="{{ $year }}"
                                                {{ old('year') == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endforeach


                                    </select>

                                    @error('year')
                                        <p class="">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Car Type</label>
                            <div class="row">
                                <div class="col">
                                    @foreach ($carTypes as $carType)
                                        <label class="inline-radio">
                                            <input type="radio" name="car_type_id" value="{{ $carType->id }}"
                                                {{ old('car_type_id') == $carType->id ? 'selected' : '' }} />
                                            {{ $carType->name }}
                                        </label>
                                    @endforeach
                                    @error('car_type_id')
                                        <p class="">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" name="price" placeholder="Price"
                                        value="{{ old('price') }}" required />

                                    @error('price')
                                        <p class="">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="vin">Vin Code</label>
                                    <input placeholder="Vin Code" name="vin" value="{{ old('vin') }}"
                                        required />
                                    @error('vin')
                                        <p class=""> {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="mileage">Mileage (ml)</label>
                                    <input placeholder="Mileage" name="mileage" value="{{ old('mileage') }}"
                                        required />
                                    @error('mileage')
                                        <p class="">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Fuel Type</label>
                            <div class="row">
                                @foreach ($fuelTypes as $fuelType)
                                    <div class="col">
                                        <label class="inline-radio">
                                            <input type="radio" name="fuel_type_id" value="{{ $fuelType->id }}"
                                                {{ old('fuel_type_id') == $fuelType->id ? 'selected' : '' }}
                                                required />
                                            {{ $fuelType->name }}
                                        </label>
                                        @error('fuel_type_id')
                                            <p class="">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>State/Region</label>
                                    <select name="state_id" id="stateSelect" required>
                                        <option value="">State/Region</option>

                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}"
                                                {{ old('state_id') == $state->id ? 'selected' : '' }}>
                                                {{ $state->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('state_id')
                                        <p class=""> {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>City</label>
                                    <select name="city_id" id="citySelect" disabled required>
                                        <option value="">City</option>
                                    </select>
                                    @error('city_id')
                                        <p class=""> {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input placeholder="Address" name="address" required
                                        value="{{ old('address') }}" />
                                    @error('address')
                                        <p class=""> {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="number" placeholder="Phone" name="phone" required
                                        value="{{ old('phone') }}" />
                                    @error('phone')
                                        <p class=""> {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col grid grid-cols-2">
                                    @foreach ($columnFeatures as $feature)
                                        <label class="checkbox">
                                            <input type="hidden" name="{{ $feature }}" value="0" />

                                            <input type="checkbox" name="{{ $feature }}"
                                                {{ old($feature) ? 'checked' : '' }} value="1" />
                                            {{ $feature }}
                                        </label>
                                    @endforeach

                                    @foreach ($columnFeatures as $feature)
                                        @error('{{ $feature }}')
                                            <p class=""> {{ $message }}</p>
                                        @enderror
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Detailed Description</label>
                            <textarea rows="10" name="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="checkbox">
                                <input type="hidden" name="published_at" value="0" />
                                <input type="checkbox" name="published_at" {{ old('published_at') ? 'checked' : '' }}
                                    value="1" />
                                Published
                            </label>
                        </div>
                    </div>
                    <div class="form-images">
                        <div class="form-image-upload">
                            <div class="upload-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" style="width: 48px">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <input id="carFormImageUpload" type="file" name="images[]" multiple accept="image/*"
                                required />
                        </div>
                        <div id="imagePreviews" class="car-form-images"></div>
                        @error('images')
                            <p class=""> {{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="p-medium" style="width: 100%">
                    <div class="flex justify-end gap-1">
                        <button type="button" class="btn btn-default">Reset</button>
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </main>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            $('#maker').change(function() {
                var maker_id = $(this).val();
                var modelDropdown = $('#model');

                if (maker_id) {
                    $.ajax({
                        url: '/get-models/' + maker_id,
                        type: 'GET',
                        success: function(response) {
                            modelDropdown.empty().append(
                                '<option value="">-- Select Model --</option>');

                            $.each(response, function(index, model) {
                                modelDropdown.append('<option value="' + model.id +
                                    '">' + model.name + '</option>');
                            });

                            modelDropdown.prop('disabled', false);
                        }
                    });
                } else {
                    modelDropdown.empty().append('<option value="">-- Select Model --</option>').prop(
                        'disabled', true);
                }
            });
        });


        // Get City based on State id
        $(document).ready(function() {
            $('#state').change(function() {
                var state_id = $(this).val();
                var cityDropdown = $('#city');

                if (state_id) {
                    $.ajax({
                        url: '/get-cities/' + state_id,
                        type: 'GET',
                        success: function(response) {
                            cityDropdown.empty().append(
                                '<option value="">-- Select City --</option>');

                            $.each(response, function(index, city) {
                                cityDropdown.append('<option value="' + city.id +
                                    '">' + city.name + '</option>');
                            });

                            cityDropdown.prop('disabled', false);
                        }
                    });
                } else {
                    cityDropdown.empty().append('<option value="">-- Select Model --</option>').prop(
                        'disabled', true);
                }
            });
        });
    </script> --}}

    {{-- <script>
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
            loadDropdown('#maker', '#model', '/get-models', '-- Select Model --');

            // Load cities based on state selection
            loadDropdown('#state', '#city', '/get-cities', '-- Select City --');
        });
    </script> --}}
</x-app-layout>
