<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types'; 
    protected $primaryKey = 'type_id'; 
    public $timestamps = false; 

    protected $fillable = [
        'type_title',
    ];
}
