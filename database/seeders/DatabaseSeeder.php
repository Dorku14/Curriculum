<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ColoresSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name' => 'Alexander Green',
            'email' => 'alexanderGreen@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        \App\Models\habilidades::factory()->times(15)->create(['user_id' => 1] );
        $this->call(ColoresSeeder::class);
    }
}
