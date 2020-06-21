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
        $admin = Role::where('name', 'admin')->first();
        $author = Role::where('name', 'author')->first();
        $user = Role::where('name', 'user')->first();
        
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456789')
        ]);
        $admin->roles()->attach($admin);        
        
        $author = User::create([
            'name' => 'Author',
            'email' => 'author@gmail.com',
            'password' => bcrypt('123456789')
        ]);
        $author->roles()->attach($author);        

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456789')
        ]);    
        $user->roles()->attach($user);
    }
}