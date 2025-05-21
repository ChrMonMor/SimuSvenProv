<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorySubcategory extends Model
{
    protected $table = 'categories_subcategories';
    protected $primaryKey = 'category_subcategory_id';
    protected $fillable = ['category_id', 'subcategory_id'];
    public $timestamps = false;

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subcategory(){
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }
}