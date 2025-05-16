<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategories';
    protected $primaryKey = 'subcategory_id';
    public $timestamps = false;

    protected $fillable = [
        'customer_id',
        'subcategory_title',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_subcategories', 'subcategory_id', 'category_id', 'subcategory_id', 'category_id');
    }
}
