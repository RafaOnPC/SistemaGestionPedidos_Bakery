<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create([
            "name_cat" => "Dulces",
            "descrip_cat" => "Producto con azucares"
        ]
    );

    Categoria::create([
        "name_cat" => "Pasteles",
        "descrip_cat" => "Producto con decoracion"
    ]
    );

    Categoria::create([
        "name_cat" => "Galletas",
        "descrip_cat" => "Producto con diferentes sabores"
    ]
);
    }
}
