<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'price', 'content', 'image', 'status', 'category_id', 'brand_id'];
}