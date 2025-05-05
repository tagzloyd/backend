<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\UserModel;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserModel::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $validate = $request ->validated();
        $users = UserModel::create($validate);

        return $users;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return UserModel::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $validate = $request ->validated();
        $users = UserModel::findOrFail($id)
        ->update($validate);

        return $users;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = UserModel::findOrFail($id);
        $users -> delete();

        return $users;
    }
    // Registration method
    public function register(UserRequest $request)
    {
        $validated = $request->validated();

        // Create the user (no password field needed)
        $user = UserModel::create($validated);

        // Log the user in (if necessary)
        Auth::login($user);

        return response()->json(['message' => 'User registered successfully!']);
    }

    // Login method (without password)
    public function login(Request $request)
    {
        $credentials = $request->only('email');

        // Check if user exists and log them in
        $user = UserModel::where('email', $credentials['email'])->first();

        if ($user) {
            Auth::login($user);
            return response()->json(['message' => 'Login successful!']);
        }

        return response()->json(['message' => 'Invalid credentials.'], 401);
    }

    // Logout method
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logout successful!']);
    }
}
