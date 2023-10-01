<?php

namespace App\Http\Controllers;

use App\Enums\UserRolesEnum;
use Illuminate\Http\Request;
use App\Models\User;

class CustomerAPI extends Controller
{
    public function index()
    {
        // get all customers
        $customers = User::where('role_id', UserRolesEnum::Customer->value)->get();
        return response()->json($customers, 200);

    }

    public function store(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|numeric',
            'password' => 'required|min:8',
        ]);

        // json to send to create this
        // {
        //     "name": "APICustomer 1",
        //     "email": "APIcustomer1@gmail",
        //     "phone_number": "1234567890",
        //     "password": "custpassword"
        // }

        // create customer
        $customer = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => '1' . $request->phone_number,
            'password' => bcrypt($request->password),
            'role_id' => UserRolesEnum::Customer->value,
        ]);

        // return customer
        return response()->json($customer, 200);
    }

    public function show($id)
    {
        // get customer
        $customer = User::where('id', $id)->first();
        if ($customer == null) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        return response()->json($customer, 200);

    }

    public function update(Request $request, $id)
    {
        // format
//         {
//             "name": "Updated Customer 1",
//             "email": "updatedcust@gmail",
//             "phone_number": "1233567890",
//             "password": "custpassword"
//         }


        // validate
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone_number' => 'required|numeric',
            'password' => 'required|min:8',
        ]);

        // update customer
        $customer = User::where('id', $id)->first();
        if ($customer == null) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => '1' . $request->phone_number,
            'password' => bcrypt($request->password),
        ]);

        // return customer
        return response()->json($customer, 200);
    }

    public function destroy($id)
    {
        $customer = User::where('id', $id)->first();
        if ($customer == null) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        $customer->delete();

        // return customer
        return response()->json(['message' => 'Customer deleted'], 200);
    }
}
