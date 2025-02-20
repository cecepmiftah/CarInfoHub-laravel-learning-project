<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    //     CarType::factory()
    //             ->sequence(
    //                 ['name' => 'Sedan'],
    //                 ['name' => 'Hatchback'],
    //                 ['name' => 'SUV'],
    //                 ['name' => 'Pickup Truck'],
    //                 ['name' => 'Minivan'],
    //                 ['name' => 'Jeep'],
    //                 ['name' => 'Coupe'],
    //                 ['name' => 'Crossover'],
    //                 ['name' => 'Sportcar']
    //             )
    //             ->count(9)
    //             ->create();

    //     FuelType::factory()
    //             ->sequence(
    //                 ['name' => 'Gasoline'],
    //                 ['name' => 'Diesel'],
    //                 ['name' => 'Electric'],
    //                 ['name' => 'Hybrid'],
    //             )
    //             ->count(4)
    //             ->create();

    //     $states = [
    //                 'California' => ['Los Angeles', 'San Francisco', 'San Diego'],
    //                 'Texas' => ['Houston', 'Dallas', 'Austin'],
    //                 'Florida' => ['Miami', 'Orlando', 'Tampa'],
    //                 'New York' => ['New York City', 'Buffalo', 'Rochester'],
    //                 'Illinois' => ['Chicago', 'Aurora', 'Naperville'],
    //                 'Pennsylvania' => ['Philadelphia', 'Pittsburgh', 'Allentown'],
    //                 'Ohio' => ['Columbus', 'Cleveland', 'Cincinnati'],
    //                 'Georgia' => ['Atlanta', 'Savannah', 'Augusta'],
    //                 'North Carolina' => ['Charlotte', 'Raleigh', 'Greensboro'],
    //                 'Michigan' => ['Detroit', 'Grand Rapids', 'Warren'],
    //             ];

    //     foreach($states as $state => $cities) {
    //         State::factory()
    //             ->state(['name' => $state])
    //             ->has(City::factory()
    //                 ->count(count($cities)))
    //                 ->sequence(
    //                     ...array_map(fn($city) => ['name' => $city], $cities))
    //                 ->create();
    //     }

    //     $makers = [
    //         'Toyota' => ['Corolla', 'Camry', 'RAV4', 'Hilux', 'Yaris'],
    //         'Honda' => ['Civic', 'Accord', 'CR-V', 'HR-V', 'Fit'],
    //         'Ford' => ['Mustang', 'F-150', 'Explorer', 'Focus', 'Ranger'],
    //         'Chevrolet' => ['Silverado', 'Malibu', 'Equinox', 'Camaro', 'Traverse'],
    //         'Nissan' => ['Altima', 'Sentra', 'Rogue', 'Frontier', 'Pathfinder'],
    //         'BMW' => ['Series 3', 'Series 5', 'X3', 'X5', 'M4'],
    //         'Mercedes-Benz' => ['C-Class', 'E-Class', 'GLC', 'GLE', 'S-Class'],
    //         'Audi' => ['A3', 'A4', 'A6', 'Q5', 'Q7'],
    //         'Hyundai' => ['Elantra', 'Tucson', 'Santa Fe', 'Sonata', 'Kona'],
    //         'Tesla' => ['Model S', 'Model 3', 'Model X', 'Model Y', 'Cybertruck'],
    //     ];
        

    //     foreach($makers as $maker => $models){
    //         Maker::factory()
    //             ->state(['name' => $maker])
    //             ->has(Model::factory()
    //                     ->sequence(...array_map(fn($model) => ['name' => $model], $models)))
    //             ->create();
    //     }


    //     User::factory()
    //         ->count(3)
    //         ->create();
        
    //     User::factory()
    //         ->count(2)
    //         ->has(
    //             Car::factory()
    //                 ->count(20)
    //                 ->has(
    //                     CarImage::factory()
    //                             ->count(5)
    //                             ->sequence(fn(Sequence $sequence) => ['position' => $sequence ->index % 5 + 1 ]),'images'
    //                     )
    //                 ->hasFeatures(), 'favouriteCars'
    //         )
    //         ->create();

            Car::factory()
            ->count(20)
            ->has(
                CarImage::factory()
                        ->count(5)
                        ->sequence(fn(Sequence $sequence) => ['position' => $sequence -> index % 5 + 1 ]), 'images'
                )
            ->hasFeatures()->create();
    }
}
