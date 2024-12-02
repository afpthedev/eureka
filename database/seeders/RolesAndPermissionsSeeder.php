<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // İzinlerin tanımlanması
        Permission::create(['name' => 'manage donations']);



        // Diğer izinler eklenebilir

        // Roller oluşturulması
        $userRole = Role::create(['name' => 'user']);
        $adminRole = Role::create(['name' => 'admin']);

        // İzinlerin rollere atanması
        $adminRole->givePermissionTo(['manage donations', 'manage users']);
        // Kullanıcı rolüne özel izinler ekleyebilirsiniz
        $userRole->givePermissionTo(['manage users']); // Örneğin, kullanıcılar sadece kullanıcıları yönetebilir
        // Diğer izinler için benzer şekilde izin atamaları yapabilirsiniz
    }
}
