<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolesId = Role::all()->pluck('id');
        User::whereNot('email', 'yazidnasution90@gmail.com')
            ->each(fn($user) => $user->roles()->attach($rolesId->random(rand(1, 2))));

        $userYazid = User::whereEmail('yazidnasution90@gmail.com')->first();
        $userYazid->roles()->attach([1, 2]);
    }
}
