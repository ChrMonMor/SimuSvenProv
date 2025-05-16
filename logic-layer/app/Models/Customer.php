<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'customer_id';
    public $timestamps = false;

    protected $fillable = [
        'customer_username',
        'customer_password',
        'customer_email',
    ];

    protected $hidden = ['customer_password'];
}
