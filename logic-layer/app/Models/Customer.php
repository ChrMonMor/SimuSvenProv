<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


final class Customer extends Model
{
    protected $table = 'customers';
    
    protected $primaryKey = 'customer_id';
    
    const CREATED_AT = 'customer_created_at';
    
    protected $fillable = [
        'customer_username',
        'customer_email',
        'customer_password',
    ];

    protected $hidden = [
        'customer_password',
    ];

}
