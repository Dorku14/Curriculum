<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ColoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('colores')->insert([
            'descripcion' => 'verde',
            'codigoHex' => '#6AA84F'
        ]);
        DB::table('colores')->insert([
            'descripcion' => 'negro',
            'codigoHex' => '#1c1529'
        ]);
        DB::table('colores')->insert([
            'descripcion' => 'rojo',
            'codigoHex' => '#c4121a'
        ]);
        DB::table('colores')->insert([
            'descripcion' => 'azul',
            'codigoHex' => '#3232d6'
        ]);
        DB::table('colores')->insert([
            'descripcion' => 'gris',
            'codigoHex' => '#cecece'
        ]);
        DB::table('colores')->insert([
            'descripcion' => 'amarillo',
            'codigoHex' => '#fce069'
        ]);
        DB::table('colores')->insert([
            'descripcion' => 'rosa',
            'codigoHex' => '#ed3896'
        ]);

    }
}
