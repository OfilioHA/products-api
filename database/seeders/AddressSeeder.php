<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Models\User;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::role('buyer')->get();
        $users->each(function (User $user) {
            $default = Address::factory()->make([
                'default' => true
            ]);
            $amount = rand(0, 2);
            $addresses = Address::factory($amount)->make();
            $addresses->prepend($default);
            $user->addresses()->saveMany($addresses);
        });
    }
}
