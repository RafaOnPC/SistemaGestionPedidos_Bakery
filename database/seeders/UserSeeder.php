<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name"=> "Jill",
            "surname" => "Valentine",
            "nickname" => "JillValent",
            "name_org" => "Umbrella Corporation",
            "email" => "jill@umbrella.com",
            "password" => bcrypt("12345678"),
        ])->assignRole('Administrador');
        
    }
}
