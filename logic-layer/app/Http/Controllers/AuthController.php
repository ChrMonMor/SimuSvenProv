<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'customer_username' => 'required|string|max:50',
            'customer_email' => 'required|email|unique:customers,customer_email',
            'customer_password' => 'required|string|min:6',
        ]);

        $customer = Customer::create([
            'customer_username' => $request->customer_username,
            'customer_email' => $request->customer_email,
            'customer_password' => Hash::make($request->customer_password),
        ]);

        return $customer; 
        
        // $token = $customer->createToken('api_token')->plainTextToken;

        // return response()->json(['token' => $token, 'customer' => $customer], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'customer_email' => 'required|email',
            'customer_password' => 'required|string',
        ]);

        $customer = Customer::where('customer_email', $request->customer_email)->first();

        
        if (!$customer || !Hash::check($request->customer_password, $customer->customer_password)) {
            throw ValidationException::withMessages([
                'customer_email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $customer; 

        // $token = $customer->createToken('api_token')->plainTextToken;

        // return response()->json(['token' => '$token', 'customer' => $customer]);
        
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
