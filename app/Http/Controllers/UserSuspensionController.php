<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserSuspensionController extends Controller
{
    public function suspend(string $id) {
        try {
           
            if ($id == 1) {
                return redirect()->route('manageusers')->with('errormsg', 'You cannot suspend admin.');
            }
            $user = User::findOrFail($id);
            // throw new Exception('test');

            $user->status = 0;
            $user->save();
            return redirect()->route('manageusers')->with('success', 'User suspended successfully.');

        } catch (Exception $e) {
            return redirect()->route('manageusers')->with('errormsg', 'User suspension failed.');
        }
    }

    public function activate(string $id) {
        try {
            $user = User::findOrFail($id);
            $user->status = 1;
            $user->save();
            return redirect()->route('manageusers')->with('success', 'User activated successfully.');

        } catch (Exception $e) {
            return redirect()->route('manageusers')->with('errormsg', 'User activation failed.');
        }
    }

}
