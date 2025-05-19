<?php 

namespace App\Http\Controllers;

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

    public function show($id)
    {
        return Customer::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'customer_username' => 'sometimes|string|max:50',
            'customer_password' => 'sometimes|string|min:6',
            'customer_email' => 'sometimes|email|unique:customers,customer_email,' . $id . ',customer_id',
        ]);

        $customer->customer_username = $request->customer_username ?? $customer->customer_username;
        $customer->customer_email = $request->customer_email ?? $customer->customer_email;

        if ($request->filled('customer_password')) {
            $customer->customer_password = Hash::make($request->customer_password);
        }

        $customer->save();

        return $customer;
    }

    public function destroy($id)
    {
        Customer::destroy($id);
        return response()->noContent();
    }
}
