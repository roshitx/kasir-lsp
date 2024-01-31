<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Products;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Muhammad Aulia Rasyid Alzahrawi',
            'email' => 'auliarasyidalzahrawi@gmail.com',
            'telepon' => '089630060333',
            'alamat' => 'Kembaran, Kasihan, Bantul',
            'role' => 'admin',
            'password' => Hash::make('rosyid07'),
        ]);

        \App\Models\User::factory(20)->create();

        \App\Models\Products::factory()->create([
            'name' => 'Kabel Data Type C',
            'description' => 'Kabel data type C dengan kekuatan tinggi.',
            'price' => 20000,
            'stock' => 100,
        ]);

        \App\Models\Products::factory()->create([
            'name' => 'Kabel Data Type E',
            'description' => 'Kabel data type C plug and play.',
            'price' => 15000,
            'stock' => 80,
        ]);

        \App\Models\Products::factory()->create([
            'name' => 'Power Bank 20000 mAh',
            'description' => 'Powerbank samsung',
            'price' => 150000,
            'stock' => 20,
        ]);

        \App\Models\Products::factory()->create([
            'name' => 'Power Bank 10000 mAh',
            'description' => 'Powerbank Advan',
            'price' => 110000,
            'stock' => 15,
        ]);
        Products::factory()->count(10)->create();
    }
}
