<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $primaryKey = 'subcategory_id';
    protected $fillable = ['customer_id', 'subcategory_title'];
    public $timestamps = false; 
    
/*
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_subcategories', 'subcategory_id', 'category_id');
    }
*/
}
