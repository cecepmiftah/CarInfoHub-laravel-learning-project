<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() 
    {
        // $cars = Car::get();
        // dump($cars);

        // $state = new State();
        // $state->name = 'West Java';
        // $state->save();

        // $cars = Car::where('price', '>', 20000)->get();

        // $maker = Maker::where('name', 'Toyota')->get();
        
        // $maker = Maker::whereRaw('LOWER(name) = ?', [strtolower('TOYota')])->get();
        // dump($maker);

        // $fuelType = new FuelType();
        // $fuelType->name = 'Electric';
        // $fuelType->save();

        // $car = Car::where('id', 1)->update(['price' => 15000]);
        
        // $car = Car::where('id', 3)->update(['published_at' => now()]);
        // $car = Car::all();
        
        // $car = Car::where('year', '<',2020)->delete();
        // dump($car);


    
        
        // $car = Car::withTrashed()->find(1)->restore();

        
        // Car::where('id', 1)->update(['published_at' => now()]);
        
        // $car = Car::find(3);

        // dump( $car->features, $car->primaryImage);
        // dd($car->carImages);
        // $car->features->abs = 0;
        // $car->features->save();

        // $car->features->update(["abs" => 0]);

        // $newCarFeturesData = new CarFeatures([
        //     'abs' => true,
        //     'air_conditioning' => true,
        //     'power_windows' => false,
        //     'power_door_locks' => true,
        //     'cruise_control' => true,
        //     'bluetooth_connectivity' => true,
        //     'remote_start' => true,
        //     'gps_navigation' => true,
        //     'heated_seats' => true,
        //     'climate_control' => true,
        //     'rear_parking_sensors' => true,
        // ]);

        // $car->features()->save($newCarFeturesData);

        // $newImageData = new CarImage([
        //     "image_path" => 'updateUsingRelation',
        //     "position" => 3,
        // ]);

        // $car->primaryImage()->save($newImageData);


        // $car = Car::find(3);
        // dump($car->carType);
        
        // $carType = CarType::where('name', 'Sedan')->first();
        
        // $cars = Car::whereBelongsTo($carType)->get();

        // dump($cars);

        // $car = Car::find(3);
        // dump($car->fovouredUsers);

        // $user = User::find(1);
        // dump($user->favouriteCars);

        // $user->favouriteCars()->attach([1,3]);

       
        
        // $makers = Maker::factory()->count(5)->create();
        // dump($makers);
       
        // $users = User::factory()
        //                     ->count(3)
        //                     // ->unverified()
        //                     ->afterCreating(function (User $user) {
        //                         dump($user);
        //                     })
        //                     ->create();

        // Maker::factory()
        //             ->count(5)
        //             ->hasModels(5)
        //             ->create();

        // Model::factory()
        //                ->count(5)
        //                ->forMaker(["name"=> "Honda"])
        //                ->create();

        // User::factory()
        //             ->count(1)
        //             ->hasCars(1, function(array $attributes, User $user) {
        //                 return ['phone' => $user->phone];
        //             })
        //             ->create();

        // User::factory()
        //     ->has(Car::factory()->count(5), 'favouriteCars')
        //     // ->hasAttached(Car::factory()->count(5), ['col1'=> 'value'], 'favouriteCars')
        //     ->create();


        $query = Car::where('published_at', '<', now())
                    ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
                    ->orderBy('published_at', 'desc');
        
        $favoriteCarsId = [];

        if(Auth::check()) {
            $favoriteCarsId = Auth::user()->favouriteCars->pluck('id');
        }

        $cars = $query->paginate(30);

        return view('home.index', ['cars' => $cars, 'favoriteCarsId' => $favoriteCarsId]);
    }
}
