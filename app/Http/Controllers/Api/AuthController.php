<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            // 'code' => 'required|string',
            'name' => 'required|string',
            // 'login' => 'required|string',
            'email' => 'required|string|unique:users,email',
            // 'mobile'  => 'required|integer',
            // 'vendorid' => 'required|integer',
            'password' => 'required|string', //| confirmed',  
            // 'status' => 'required|integer',             
            // 'crby'  => 'required|integer', 
            // 'lmby'  => 'required|integer',            
        ]);

        $user = User::create([
            'usergroup' => 1,
            'kycdata' => 1,
            'code' => rand(1000, 9999),
            'name' => $fields['name'],
            'login' => 1,
            'email' => $fields['email'],
            'mobile' => 1,
            'vendorid' => 1,
            'password' => bcrypt($fields['password']),
            'status' => 1,
            'dtcr' => now(),
            'crby' => 1,
            'dtlm' => now(),
            'lmby' => 1,
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();


        // Check password
        if (!$user || !password_verify($fields['password'], $user->password)) {

            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function users()
    {
        $users =  User::all();
        $response = [
            'users' => $users,
        ];
        return response()->json($response, 201);
    }
}
