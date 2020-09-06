<?php

use Illuminate\Database\Seeder;
use App\Role_test;

class Role_testsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role_test::create([
            'name' => 'Biên tập viên', 
            'slug' => 'editor',
            'permissions' => [
                'post.update' => true,
                'post.publish' => true,
            ]
        ]);
    }
}
