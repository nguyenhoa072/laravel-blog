<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = Role::create([
            'name' => 'Người dùng',
            'slug' => 'user',
            'permissions' => [
                'category.index' => true,
                'category.show' => true,
            ]
        ]);
        $editor = Role::create([
            'name' => 'Người quản lý',
            'slug' => 'administrator',
            'permissions' => [
                'category.index' => true,
                'category.show' => true,
                'category.create' => true,
                'category.store' => true,
                'category.edit' => true,
                'category.update' => true,                
                'category.destroy' => true,
            ]
        ]);
    }
}