<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    private $roles = [
        [
            'name' => 'Admin',
            'description' => 'Administrator',
            'guard_name' => 'users',
        ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        \DB::table('roles')->truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($this->roles as $role) {
            Role::create($role);
        }
    }
}
