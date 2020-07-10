<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = Role::create(['guard_name' => 'api', 'name' => 'doctor']);
        $role = Role::create(['guard_name' => 'api', 'name' => 'patient']);
        $role = Role::create(['guard_name' => 'web', 'name' => 'patient']);
        $role = Role::create(['guard_name' => 'web', 'name' => 'doctor']);
    }
}
