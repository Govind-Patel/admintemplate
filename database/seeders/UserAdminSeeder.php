<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(
            ['user_type' => 'admin']
        );

        Role::create(
            ['user_type' => 'Teachers']
        );

        Role::create(
            ['user_type' => 'students']
        );

    }
}
