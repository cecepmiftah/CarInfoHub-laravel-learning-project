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
            <h1 class="car-details-page-title">Update car</h1>
            <form action="{{ route('car.update', $car) }}" method="POST" enctype="multipart/form-data"
                class="card add-new-car-form">

                @csrf

                @method('PATCH')


                <div class="form-content">
                    <div class="form-details">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Maker</label>
                                    <select name="maker_id" id="makerSelect" required>
                                        <option value="">Maker</option>
                                        @foreach ($data['makers'] as $maker)
                                            <option value="{{ $maker->id }}"
                                                {{ $maker->id == $car->maker->id ? 'selected' : '' }}>
                                                {{ $maker->name }}</option>
                                        @endforeach

                                    </select>
                                    <p class="error-message">This field is required</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Model</label>

                                    <select name="model_id" id="modelSelect" disabled required>
                                        <option value="{{ $car->model_id }}">{{ $car->model->name }}</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select name="year" required>
                                        <option value="">Year</option>

                                        @foreach ($data['years'] as $year)
                                            <option value="{{ $year }}"
                                                {{ $year == $car->year ? 'selected' : '' }}>{{ $year }}
                                            </option>
                                        @endforeach


                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Car Type</label>
                            <div class="row">
                                <div class="col">
                                    @foreach ($data['carTypes'] as $carType)
                                        <label class="inline-radio">
                                            <input type="radio" name="car_type" value="{{ $carType->id }}"
                                                {{ $carType->id == $car->car_type_id ? 'checked' : '' }} />
                                            {{ $carType->name }}
                                        </label>
                                    @endforeach

                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" name="price" placeholder="Price"
                                        value="{{ $car->price }}" required />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="vin">Vin Code</label>
                                    <input placeholder="Vin Code" name="vin" value="{{ $car->vin }}"
                                        required />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="mileage">Mileage (ml)</label>
                                    <input placeholder="Mileage" name="mileage" value="{{ $car->mileage }}" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Fuel Type</label>
                            <div class="row">
                                @foreach ($data['fuelTypes'] as $fuelType)
                                    <div class="col">
                                        <label class="inline-radio">
                                            <input type="radio" name="fuel_type" value="{{ $fuelType->id }}"
                                                {{ $car->fuel_type_id == $fuelType->id ? 'checked' : '' }} required />
                                            {{ $fuelType->name }}
                                        </label>
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

                                        @foreach ($data['states'] as $state)
                                            <option value="{{ $state->id }}"
                                                {{ $car->city->state->id == $state->id ? 'selected' : '' }}>
                                                {{ $state->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>City</label>
                                    <select name="city_id" id="citySelect" disabled required>
                                        <option value="{{ $car->city_id }}">{{ $car->city->name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input placeholder="Address" name="address" value="{{ $car->address }}" required />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input placeholder="Phone" name="phone" value="{{ $car->phone }}" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col grid grid-cols-2">
                                    @foreach ($data['columnFeatures'] as $feature)
                                        <label class="checkbox">
                                            <input type="hidden" name="{{ $feature }}" value="0" />

                                            <input type="checkbox" name="{{ $feature }}"
                                                {{ $car->features[$feature] == '1' ? 'checked' : '' }}
                                                value="1" />
                                            {{ $feature }}
                                        </label>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Detailed Description</label>
                            <textarea rows="10" name="description">{{ $car->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="checkbox">
                                <input type="hidden" name="published_at" value="0" />
                                <input type="checkbox" name="published_at" value="1"
                                    {{ $car->published_at !== null ? 'checked' : '' }} />
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
                            <input id="carFormImageUpload" type="file" name="images[]" multiple
                                accept="image/*" />
                        </div>
                        <div id="imagePreviews" class="car-form-images">
                            {{-- @foreach ($car->images as $image)
                                <img src="{{ asset('storage/' . $car->primaryImage->image_path) }}" alt="" />
                            @endforeach --}}

                        </div>
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
</x-app-layout>
