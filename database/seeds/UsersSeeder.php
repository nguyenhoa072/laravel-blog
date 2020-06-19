<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Role::where('slug', 'user')->first();
        $administrator = Role::where('slug', 'administrator')->first();

        $user1 = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456789')
        ]);
        $user1->roles()->attach($user);

        $user2 = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456789')
        ]);
        $user2->roles()->attach($administrator);
    }
}