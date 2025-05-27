<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'category_id';
    protected $fillable = ['customer_id', 'category_title'];
    public $timestamps = false; 
/*
    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class, 'categories_subcategories', 'category_id', 'subcategory_id');
    }
*/
}
