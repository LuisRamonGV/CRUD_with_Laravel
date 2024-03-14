<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::create([
            'nombre' => 'Producto 1',
            'precio' => 10.99,
            'cantidad' => 100,
        ]);

        Producto::create([
            'nombre' => 'Producto 2',
            'precio' => 20.50,
            'cantidad' => 50,
        ]);
        
        Producto::create([
            'nombre' => 'Producto 3',
            'precio' => 33.90,
            'cantidad' => 70,
        ]);

        Producto::create([
            'nombre' => 'Producto 4',
            'precio' => 40.99,
            'cantidad' => 20,
        ]);

    }
}
