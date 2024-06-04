<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $admin = Role::create(['name' => 'administrador']);
        $seller = Role::create(['name' => 'seller']);
        $buyer = Role::create(['name' => 'buyer']);

        // Attach roles to users
        User::find(1)->assignRole($admin);
        User::whereIn('id', [2, 3])->each(function ($user) use ($seller) {
            $user->assignRole($seller);
        });
        User::where('id', '>', 3)->each(function ($user) use ($buyer) {
            $user->assignRole($buyer);
        });
    }
}
