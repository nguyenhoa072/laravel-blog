<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_test extends Model
{
    protected $fillable = [
        'name', 'slug', 'permissions',
    ];
    protected $casts = [
        'permissions' => 'array',
    ];
}
