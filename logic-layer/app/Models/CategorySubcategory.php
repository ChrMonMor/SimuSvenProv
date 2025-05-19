<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorySubcategory extends Model
{
    protected $table = 'categories_subcategories';
    protected $primaryKey = 'category_subcategory_id';
    protected $fillable = ['category_id', 'subcategory_id'];
    public $timestamps = false;
}