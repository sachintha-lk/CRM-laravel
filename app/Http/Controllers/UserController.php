<?php

namespace App\Http\Controllers;

use App\Enums\UserRolesEnum;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('dashboard.manage-users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.manage-users.create-user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Redirect if not admin
        if (auth()->user()->role->name != 'Admin') {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to perform this action.');
        }

        $role = $request['role'];

        if ($role == 'employee') {
            $role_id = UserRolesEnum::Employee;
        } else {
            $role_id = UserRolesEnum::Customer;
        }
 
        try{
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'role_id' => $role_id,
            ]);
        }
        catch (Exception $e) {
            return redirect()->route('manageusers')->with('error', 'User creation failed.');
        }
        
        return redirect()->route('manageusers')->with('success', 'User created successfully.');

      
      

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
