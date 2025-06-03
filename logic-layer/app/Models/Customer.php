<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User;

class Customer extends User
{
    use HasApiTokens, Notifiable, HasFactory;

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

