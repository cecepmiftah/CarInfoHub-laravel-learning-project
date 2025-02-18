@props(['totalCars' => 0, 'car'])

<div class="search-cars-sidebar">
    <div class="card card-found-cars">
        <p class="m-0">Found <strong>{{ $totalCars }}</strong> cars</p>

        <button class="close-filters-button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 24px">
                <path fill-rule="evenodd"
                    d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z"
                    clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    <!-- Find a car form -->
    <section class="find-a-car">
        <form action="{{ route('car.search') }}" method="GET" class="find-a-car-form card flex p-medium">
            <div class="find-a-car-inputs">
                <div class="form-group">
                    <label class="mb-medium">Maker</label>
                    <select id="makerSelect" name="maker_id">
                        <option value="">Maker</option>
                        @foreach ($makers as $maker)
                            <option value="{{ $maker->id }}">{{ $maker->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="mb-medium">Model</label>
                    <select id="modelSelect" name="model_id" disabled>
                        <option value="" style="display: block">Model</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="mb-medium">Type</label>
                    <select name="car_type_id">
                        <option value="">Type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="mb-medium">Year</label>
                    <div class="flex gap-1">
                        <input type="number" placeholder="Year From" name="year_from" />
                        <input type="number" placeholder="Year To" name="year_to" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="mb-medium">Price</label>
                    <div class="flex gap-1">
                        <input type="number" placeholder="Price From" name="price_from" />
                        <input type="number" placeholder="Price To" name="price_to" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="mb-medium">Mileage</label>
                    <div class="flex gap-1">
                        <select name="mileage">
                            <option value="">Any Mileage</option>
                            <option value="10000">10,000 or less</option>
                            <option value="20000">20,000 or less</option>
                            <option value="30000">30,000 or less</option>
                            <option value="40000">40,000 or less</option>
                            <option value="50000">50,000 or less</option>
                            <option value="60000">60,000 or less</option>
                            <option value="70000">70,000 or less</option>
                            <option value="80000">80,000 or less</option>
                            <option value="90000">90,000 or less</option>
                            <option value="100000">100,000 or less</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="mb-medium">State</label>
                    <select id="stateSelect" name="state_id">
                        <option value="">State/Region</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="mb-medium">City</label>
                    <select id="citySelect" name="city_id" disabled>
                        <option value="" style="display: block">City</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="mb-medium">Fuel Type</label>
                    <select name="fuel_type_id">
                        <option value="">Fuel Type</option>
                        @foreach ($fuelTypes as $fuelType)
                            <option value="{{ $fuelType->id }}">{{ $fuelType->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex">
                <button type="button" class="btn btn-find-a-car-reset">
                    Reset
                </button>
                <button class="btn btn-primary btn-find-a-car-submit">
                    Search
                </button>
            </div>
        </form>
    </section>
    <!--/ Find a car form -->
</div>
