<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        $password = 'password123'; // default password for test accounts

        return [
            'customer_username' => $this->faker->userName,
            'customer_email' => $this->faker->unique()->safeEmail,
            'customer_password' => Hash::make($password),
        ];
    }
}
