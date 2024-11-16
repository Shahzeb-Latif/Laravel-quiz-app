<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Save the user to the database
        $user = User::create([
            'name' => $request->name,
        ]);

        // Store user id in session
        session(['user_id' => $user->id]);
        
        // Return success response
        return response()->json(['success' => true, 'user_id' => $user->id]);
    }
}
