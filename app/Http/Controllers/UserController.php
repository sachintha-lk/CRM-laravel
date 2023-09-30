<?php

namespace App\Http\Controllers;

use App\Enums\UserRolesEnum;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $search = $request['search'];

        $users = User::where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('phone_number', 'LIKE', "%{$search}%")
            ->paginate(10);

        return view('dashboard.manage-users.index', compact('users'), ['search' => $search]);
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



        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:1|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|max:255',
            'password_confirmation' => 'required|string|min:8|max:255|same:password',
            'phone_number' => ['required', 'string', 'regex:/^[0-9]{10}$/', 'unique:users'],
            'role' => 'required|string|in:employee,customer',
        ]);

        if ($validator->fails()) {
            return redirect()->route('manageusers.create')
                ->withErrors($validator)
                ->withInput();
        }

        $role = $request['role'];

        if ($role == 'employee') {
            $role_id = UserRolesEnum::Employee;
        } else {
            $role_id = UserRolesEnum::Customer;
        }

        try {
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'phone_number' => $request['phone_number'],
                'role_id' => $role_id,
            ]);
        } catch (Exception $e) {
            return redirect()->route('manageusers')->with('errormsg', 'User creation failed.');
        }

        return redirect()->route('manageusers')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        // find the appointments of the user
        $appointments = Appointment::where('user_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

        return view('dashboard.manage-users.show-user', compact('user', 'appointments'));
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
