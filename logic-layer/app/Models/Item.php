<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items'; // Optional, Laravel automatically uses the plural of the model name
    protected $primaryKey = 'item_id'; // Set the primary key field if it's not 'id'
    public $timestamps = false; // Disable timestamps since the table uses custom fields

    protected $fillable = [
        'customer_id',
        'item_title',
        'item_description',
        'item_release_date',
        'tag_id',
        'type_id',
        'item_barcode_ean',
        'item_barcode_upc',
        'item_price',
        'item_price_currency',
        'category_subcategory_id',
        'item_brand',
        'platform_id',
    ];

    // Define relationships

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function categorySubcategory()
    {
        return $this->belongsTo(CategorySubcategory::class, 'category_subcategory_id');
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class, 'platform_id');
    }
}
