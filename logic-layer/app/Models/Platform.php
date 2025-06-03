<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;
    protected $table = 'platforms'; 
    protected $primaryKey = 'platform_id'; 
    public $timestamps = false; 

    protected $fillable = [
        'platform_title',
    ];
}