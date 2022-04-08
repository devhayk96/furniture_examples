<?php

namespace Database\Seeders;

use App\Enums\StatusesEnum;
use App\Models\Admin;
use App\Services\Permission\InitService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds
     *
     * @throws \Exception
     */
    public function run()
    {
        /* Init permissions service */
        (new InitService())->run();

        foreach (Admin::ROLES as $role_id => $role_names) {
            $role = Role::firstOrCreate([
                'id' => $role_id,
                'name' => $role_names['name'],
                'name_en' => $role_names['name_en'],
                'name_ru' => $role_names['name_ru'],
                'guard_name' => 'admin'
            ]);
            if ($role_id == Admin::ROLE_SUPER_ADMIN) {
                $all_permissions = Permission::pluck('id')->toArray();
                $role->permissions()->attach($all_permissions);
            }
        }

        $super_admin = Admin::create([
            'full_name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'status' => StatusesEnum::STATUSES['active'],
            'password' => Hash::make('12345678'),
        ]);

        $super_admin->profile()->create();
        $super_admin->assignRole(Admin::ROLE_SUPER_ADMIN);
//        $super_admin->syncPermissions(Permission::pluck('id')->toArray());
    }
}
