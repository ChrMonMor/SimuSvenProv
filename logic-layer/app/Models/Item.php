<?php

// app/Models/Item.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'item_id';
    public $timestamps = false;

    protected $fillable = [
        'customer_id',
        'tag_id',
        'type_id',
        'item_created_at',
        'item_edit_at',
        'item_title',
        'item_description',
        'item_origin_date',
        'item_barcode_ean',
        'item_barcode_upc',
        'item_price',
        'item_price_currency',
        'category_subcategory_id',
        'item_brand',
        'item_model',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function tag() {
        return $this->belongsTo(Tag::class, 'tag_id');
    }

    public function type() {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function categorySubcategory() {
        return $this->belongsTo(CategorySubcategory::class, 'item_category', 'category_subcategory_id');
    }
}
