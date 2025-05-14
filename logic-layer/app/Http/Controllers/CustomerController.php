<?php 

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return response()->json(Customer::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_username' => 'required|string|max:50',
            'customer_password' => 'required|string|max:255',
            'customer_email' => 'required|email|unique:customers,customer_email',
        ]);

        $validated['customer_password'] = bcrypt($validated['customer_password']);

        $customer = Customer::create($validated);

        return response()->json($customer, 201);
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $validated = $request->validate([
            'customer_username' => 'sometimes|required|string|max:50',
            'customer_password' => 'sometimes|required|string|max:255',
            'customer_email' => 'sometimes|required|email|unique:customers,customer_email,' . $id . ',customer_id',
        ]);

        if (isset($validated['customer_password'])) {
            $validated['customer_password'] = bcrypt($validated['customer_password']);
        }

        $customer->update($validated);

        return response()->json($customer);
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response()->json(null, 204);
    }
}
