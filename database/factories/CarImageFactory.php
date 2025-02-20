<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarImage>
 */
class CarImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'image_path' => fake()->imageUrl(),
        //     'position' => function(array $attributes) {
        //         return Car::find($attributes['car_id'])->images()->count() +1;
        //     }
        // ];

         // 1️⃣ Ambil semua file gambar dari direktori public/img/cars
         $files = glob(public_path('img/cars/Lexus-RX200t-2016/*.{jpg,jpeg,png,gif}'), GLOB_BRACE);

         // 2️⃣ Pilih gambar secara acak dari daftar file
         $randomFile = $files[array_rand($files)];
 
         // 3️⃣ Buat nama file baru untuk disimpan di storage
         $newFileName = 'cars/' . Str::random(10) . '.' . pathinfo($randomFile, PATHINFO_EXTENSION);
 
         // 4️⃣ Salin gambar ke storage/app/public/cars
         Storage::disk('public')->put($newFileName, file_get_contents($randomFile));
 
         return [
             'car_id' => rand(74, 94), // Sesuaikan dengan jumlah car yang ada
             'image_path' =>  $newFileName, // Simpan path yang bisa diakses oleh browser
         ];
    }
}
