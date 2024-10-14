<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
        $secretary = Role::create(['name' => 'secretary']);
        $treasurer = Role::create(['name' => 'treasurer']);
        $userRole = Role::create(['name' => 'user']);

        // Create users with specific roles
        User::factory()->create([
            'name' => 'Secretary User',
            'email' => 'secretary@example.com',
            'role_id' => $secretary->id,
        ]);

        User::factory()->create([
            'name' => 'Treasurer User',
            'email' => 'treasurer@example.com',
            'role_id' => $treasurer->id,
        ]);

        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'role_id' => $userRole->id,
        ]);
    }
}
