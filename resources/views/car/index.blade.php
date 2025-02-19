    <x-app-layout bodyClass="page-my-cars">
        <main>
            <div>
                <div class="container">
                    <h1 class="car-details-page-title font-bold text-gray-500 text-lg ">My Cars</h1>
                    <div class="card p-medium">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Published</th>
                                        <th>Actions

                                            <button class="btn btn-delete items-center p-medium hidden" id="delete-button"
                                                data-open-modal>
                                                Delete
                                                Selected
                                                Cars
                                            </button>

                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cars as $car)
                                        <tr class="even:bg-gray-100">
                                            <td>
                                                <a href="{{ route('car.show', $car) }}">

                                                    <img src="{{ asset('storage/' . $car->primaryImage->image_path) }}"
                                                        alt="" class="my-cars-img-thumbnail" />
                                                </a>
                                            </td>
                                            <td>{{ $car->year }} - {{ $car->maker->name }} {{ $car->model->name }}
                                            </td>
                                            <td>{{ $car->getCreateDate() }}</td>
                                            <td>{{ $car->published_at ? 'Yes' : 'No' }}</td>
                                            <td class="">
                                                <a href="{{ route('car.edit', $car) }}"
                                                    class="btn btn-edit inline-flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        style="width: 12px; margin-right: 5px">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                    </svg>

                                                    edit
                                                </a>
                                                <a href="{{ route('car.editImages', $car) }}"
                                                    class="btn btn-edit inline-flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        style="width: 12px; margin-right: 5px">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                    </svg>
                                                    images
                                                </a>


                                                <button class="btn btn-delete inline-flex items-center" data-open-modal
                                                    data-id="{{ $car->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        style="width: 12px; margin-right: 5px">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>

                                                    delete
                                                </button>


                                                <input type="checkbox" name="delete_cars[]"
                                                    id="delete_cars_{{ $car->id }}" value="{{ $car->id }}"
                                                    data-id="{{ $car->id }}" />


                                            </td>
                                        </tr>
                                    @empty

                                        <tr>
                                            <td colspan="5" class="text-center p-large">
                                                You don't have cars yet. <a href="{{ route('car.create') }}"
                                                    class="text-blue-600 underline">Add New
                                                    Car</a>
                                            </td>
                                        </tr>
                                    @endforelse


                                </tbody>
                            </table>
                        </div>

                        {{-- Paginations --}}
                        {{ $cars->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </main>

        <x-modal />

    </x-app-layout>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteBtn = document.getElementById('delete-button');

            const checkboxes = document.querySelectorAll('input[type="checkbox"]');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", function() {
                    let anyChecked = [...checkboxes].some(checkbox => checkbox.checked);
                    deleteBtn.classList.toggle("hidden", !anyChecked);
                    deleteBtn.textContent =
                        `Delete Selected Cars (${[...checkboxes].filter(checkbox => checkbox.checked).length})`;

                    deleteBtn.setAttribute('data-id', JSON.stringify([...checkboxes].filter(
                        checkbox => checkbox.checked).map(checkbox => checkbox.value)));
                });
            });

        })
    </script>
