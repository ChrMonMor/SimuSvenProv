<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    public $timestamps = false;

    protected $fillable = [
        'customer_id',
        'category_title',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class, 'categories_subcategories', 'category_id', 'subcategory_id', 'category_id', 'subcategory_id');
    }
}
