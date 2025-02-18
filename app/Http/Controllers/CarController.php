<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarFeatures;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $query = User::find(Auth::user()->id)
                ->cars()
                ->with(['primaryImage', 'maker', 'model'])
                ->orderBy('created_at', 'desc');
        
        $cars = $query->paginate(20);
        

        return view('car.index', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $columnFeatures = (new CarFeatures())->getFillable();
        $columnFeatures = array_diff($columnFeatures, ['car_id']);

        $data = [
            'makers' => Maker::all(),
            'years' => Car::distinct()->orderBy('year', 'desc')->pluck('year'),
            'carTypes' => CarType::all(),
            'fuelTypes' => FuelType::all(),
            'states' => State::all(),
            'columnFeatures' => $columnFeatures,
        ];
    
        return view('car.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validated = $request->validate([
            'maker_id' => 'required|exists:makers,id',
            'model_id' => 'required|exists:models,id',
            'year' => 'required|integer|min:1900',
            'price' => 'required|numeric|min:0',
            'vin' => 'required|string|max:50|unique:cars,vin',
            'mileage' => 'integer|min:0',
            'car_type_id' => 'required|exists:car_types,id',
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'description' => 'nullable|string',
        ]);

    
        $validated = array_merge($validated, ['user_id' => Auth::user()->id, 'published_at' => $request->published_at == '1' ? now() : null]);

        DB::beginTransaction();

        try{

          $car = Car::create($validated)
                    ->features()->save(
                       new CarFeatures(
                        [
                            'abs' => $request->abs == '1' ? 1 : 0,
                            'air_conditioning' => $request->air_conditioning == '1' ? 1 : 0,
                            'power_windows' => $request->power_windows == '1' ? 1 : 0,
                            'power_door_locks' => $request->power_door_locks == '1' ? 1 : 0,
                            'cruise_control' => $request->cruise_control == '1' ? 1 : 0,
                            'bluetooth_connectivity' => $request->bluetooth_connectivity == '1' ? 1 : 0,
                            'remote_start' => $request->remote_start == '1' ? 1 : 0,
                            'gps_navigation' => $request->gps_navigation == '1' ? 1 : 0,
                            'heated_seats' => $request->heated_seats == '1' ? 1 : 0,
                            'climate_control' => $request->climate_control == '1' ? 1 : 0,
                            'rear_parking_sensors' => $request->rear_parking_sensors == '1' ? 1 : 0,
                            'leather_seats' => $request->leather_seats == '1' ? 1 : 0,
                        ])
                    );
    
      
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('cars', 'public');
    
                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $path,
                    'position' => $index + 1
                ]);
    
            };

            DB::commit();

            return redirect()->route('car.index')->with('success', 'Car Created Succesfully!');

        }catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to save data: ' . $e->getMessage());
        }

      
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('car.show', ['car' => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        // $this->authorize('update', $car);

        if(! Gate::allows('edit-car', $car)) {
            abort(403);
        }

        $columnFeatures = (new CarFeatures())->getFillable();
        $columnFeatures = array_diff($columnFeatures, ['car_id']);

        $data = [
            'makers' => Maker::all(),
            'years' => Car::distinct()->orderBy('year', 'desc')->pluck('year'),
            'carTypes' => CarType::all(),
            'fuelTypes' => FuelType::all(),
            'states' => State::all(),
            'columnFeatures' => $columnFeatures,
        ];
        
        return view('car.edit',["car" => $car, "data" => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        if(! Gate::allows('edit-car', $car)) {
            abort(403, 'You are not authorized to edit this car.');
        }

        $validated = $request->validate([
            'maker_id' => 'sometimes|required|exists:makers,id',
            'model_id' => 'sometimes|required|exists:models,id',
            'year' => 'required|integer|min:1900',
            'price' => 'required|numeric|min:0',
            'vin' => 'required|string|max:50',
            'mileage' => 'integer|min:0',
            'car_type_id' => 'sometimes|required|exists:car_types,id',
            'fuel_type_id' => 'sometimes|required|exists:fuel_types,id',
            'city_id' => 'sometimes|required|exists:cities,id',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'description' => 'nullable|string',
        ]);


        $validated = array_merge($validated, ['published_at' => $request['published_at'] != '0' ? ($car->published_at ?? now()) : null]);

        try {
            DB::beginTransaction();

            $car = Car::find($car->id);

            $car->update($validated);
            
            
            $car->features()->update(
                [
                    'abs' => $request->abs == '1' ? 1 : 0,
                    'air_conditioning' => $request->air_conditioning == '1' ? 1 : 0,
                    'power_windows' => $request->power_windows == '1' ? 1 : 0,
                    'power_door_locks' => $request->power_door_locks == '1' ? 1 : 0,
                    'cruise_control' => $request->cruise_control == '1' ? 1 : 0,
                    'bluetooth_connectivity' => $request->bluetooth_connectivity == '1' ? 1 : 0,
                    'remote_start' => $request->remote_start == '1' ? 1 : 0,
                    'gps_navigation' => $request->gps_navigation == '1' ? 1 : 0,
                    'heated_seats' => $request->heated_seats == '1' ? 1 : 0,
                    'climate_control' => $request->climate_control == '1' ? 1 : 0,
                    'rear_parking_sensors' => $request->rear_parking_sensors == '1' ? 1 : 0,
                    'leather_seats' => $request->leather_seats == '1' ? 1 : 0,
                ]
            );

            if ($request->hasFile('images')) {
                $car->images()->delete();
                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('cars', 'public');
        
                    CarImage::create([
                        'car_id' => $car->id,
                        'image_path' => $path,
                        'position' => $index + 1
                    ]);
        
                };
            }

            DB::commit();

            return redirect()->route('car.index')->with('success', 'Car Updated Succesfully!');

        }catch (\Exception $e) {
            return back()->with('error', 'Failed to save data: ' . $e->getMessage());
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        if(! Gate::allows('edit-car', $car)) {
            abort(403, 'You are not authorized to delete this car.');
        }

        $car->images()->delete();
        $car->features()->delete();
        $car->delete();

        return redirect()->back()->with('success', 'Car Deleted Succesfully!');
    }

    public function destroyMultiple(Request $request)
    {
        
        $carIds = json_decode($request->input('car_ids'), true);
        
        if(! Gate::allows('edit-car', Car::find($carIds[0]))) {
            abort(403, 'You are not authorized to delete this car.');
        }

        if (!$carIds || count($carIds) === 0) {
            return redirect()->back()->with('error', 'No cars selected.');
        }
    
        // Hapus semua relasi sebelum menghapus mobilnya
        Car::whereIn('id', $carIds)->each(function ($car) {
            $car->images()->delete();
            $car->features()->delete();
            $car->delete();
        });

        return redirect()->back()->with('success', 'Cars Deleted Succesfully!');
    }

    public function search() 
    {

        $query = Car::where('published_at', '<', now())
                    ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
                    ->orderBy('published_at', 'desc');        
        
        $cars = $query->paginate(15);

        return view('car.search', ['cars' => $cars]);
    }

    public function watchlist()
    {
        $query = User::find(Auth::user()->id)
                ->favouriteCars()
                ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model']);
        
        $cars = $query->paginate(20);
      
        return view('car.watchlist', ['cars' => $cars]);
    }

    public function toggleWatchlist(Car $car)
    {
        $user = User::find(Auth::user()->id);

        if($user->favouriteCars->contains($car)) {
            $user->favouriteCars()->detach($car);
            return redirect()->back()->with('success', 'Car removed from watchlist.');
        }

        $user->favouriteCars()->attach($car);
        return redirect()->back()->with('success', 'Car added to watchlist.');
    }

    public function getModels($maker_id)
    {
        $models = Model::where('maker_id', $maker_id)
                    ->get();


        return response()->json($models);
    }
    public function getCities($state_id)
    {
        $cities = City::where('state_id', $state_id)
                    ->get();


        return response()->json($cities);
    }

    public function editImages(Car $car)
    {
        $car = Car::with(['images' => function ($query) {
            $query->orderBy('position', 'asc');
        } ])->findOrFail($car->id);

        return view('car.images', ['car' => $car]);
    }

    public function updateImages(Request $request, Car $car)
    {


     if($request->has('delete_images')) {
        $car->images()->whereIn('id', $request->delete_images)->delete();
     }

     if($request->has('positions')) {
        foreach ($request->positions as $id => $position) {
            CarImage::where('id', $id)->update(['position' => $position]);
        }
     }

     if($request->hasFile('images')) {
        foreach ($request->file('images') as $index => $image) {
            $path = $image->store('cars', 'public');

            $car->images()->create([
                'image_path' => $path,
                'position' => $car->images->count() + ($index + 1)
            ]);

        }};

        return back()->with('success', 'Images Updated Successfully!');


    }
}
