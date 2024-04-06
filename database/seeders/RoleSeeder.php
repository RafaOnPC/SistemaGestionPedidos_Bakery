<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name'=> 'Productor']);
        $role3 = Role::create(['name'=> 'Distribuidor']);
        $role4 = Role::create(['name'=> 'Ventas']);

        //Gestion de Productos

        Permission::create(['name' => 'productos.listproductos'])->syncRoles([$role1, $role2, $role4]);
        Permission::create(['name' => 'productos.createproducto'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'productos.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'productos.destroy'])->syncRoles([$role1, $role2]);

        //Gestion de Pedidos
        Permission::create(['name' => 'pedidos.listpedidos'])->syncRoles([$role1, $role3, $role4]);
        Permission::create(['name' => 'pedidos.createpedido'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'pedidos.edit'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'pedidos.destroy'])->syncRoles([$role1, $role3]);

        //Gestion de Empleados
        Permission::create(['name' => 'usuarios.list'])->syncRoles([$role1]);
        Permission::create(['name' => 'register'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.destroy'])->syncRoles([$role1]);
    }
}
