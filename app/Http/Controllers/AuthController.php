<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{

    public function register(Request $request){
        // return User::create([
        //     'name' => $input['name'],
        //     'email' => $input['email'],
        //     'password' => Hash::make($input['password']),
        //     'phone' => $input['phone'],
        //     'address' => $input['address'],
            
        // ]);

        $validation = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|string|confirmed',
            
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('myAppToken')->plainTextToken;

        return Response::json([
            'user' => $user,
            'token'=> $token
        ],200);
    }


    public function login(Request $request){
        $validation = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email',$request->email)->first();


         
        if(empty($user) && !Hash::check($request->password,$user->password)){
            return Response::json([
                'message' => 'Credential Do Not Match...'
            ],200);
        }

        $token = $user->createToken('myAppToke')->plainTextToken;
        return Response::json([
            'user' => $user,
            'token' => $token
        ],200);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        
        return Response::json([
            'message' => 'Logout Success...',
        ],200);
    }
}
