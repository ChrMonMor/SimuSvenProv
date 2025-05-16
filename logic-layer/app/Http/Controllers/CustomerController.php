<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_username' => 'required|string|max:50',
            'customer_password' => 'required|string|min:6',
            'customer_email' => 'required|email|unique:customers,customer_email',
        ]);

        $customer = Customer::create([
            'customer_username' => $request->customer_username,
            'customer_password' => Hash::make($request->customer_password),
            'customer_email' => $request->customer_email,
        ]);

        return response()->json($customer, 201);
    }
}
