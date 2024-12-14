<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Tüm izinleri oluştur
        $permissions = [
            'view roles',
            'create roles',
            'update roles',
            'delete roles',
            'view permissions',
            'create permissions',
            'update permissions',
            'delete permissions',
            // Filament Shield'ın otomatik oluşturduğu izinler
            'view_any users',
            'view users',
            'create users',
            'update users',
            'delete users',
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // 2. Superadmin rolünü oluştur ve tüm izinleri ata
        $superAdminRole = Role::firstOrCreate(['name' => 'superadmin']);
        $superAdminRole->syncPermissions(Permission::all());

        // 3. Superadmin kullanıcı oluştur
        $superAdminUser = User::firstOrCreate(
            ['email' => 'admin1@admin.com'], // E-posta ile kullanıcıyı bul veya oluştur
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'), // Şifreyi kendiniz belirleyin
            ]
        );

        // 4. Superadmin rolünü kullanıcıya ata
        $superAdminUser->assignRole($superAdminRole);

        echo "Superadmin kullanıcı oluşturuldu.\n";
        echo "E-posta: admin1@admin.com\n";
        echo "Şifre: password\n";
    }
}
