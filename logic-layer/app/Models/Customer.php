<?php 

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasApiTokens;

    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'customer_username',
        'customer_password',
        'customer_email',
    ];

    public $timestamps = false;

    protected $table = 'customers';

    protected $hidden = ['customer_password'];

    public function getAuthPassword()
    {
        return $this->customer_password;
    }
}

