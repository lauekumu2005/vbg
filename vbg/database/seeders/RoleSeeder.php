<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = ['hopital', 'ministere', 'victime', 'prison'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
} 