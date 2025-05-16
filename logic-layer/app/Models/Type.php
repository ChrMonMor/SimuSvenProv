<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';
    protected $primaryKey = 'type_id';
    public $timestamps = false;

    protected $fillable = [
        'type_title',
    ];
}
