<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
           'name' => 'required|string',
           'email' => 'required|email|unique:users,email',
           'password' => 'required|string',
           'confirm_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return response()->json($validator->messages(), 422);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $token = $user->createToken('cloud_project')->plainTextToken;
        return response()->json([
            'user'=> $user,
            'token' => $token
        ]);
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json($validator->messages(), 422);
        }
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return response()->json('user not found', 422);
        }
        if(!Hash::check($request->password, $user->password)){
            return response()->json('password is incorrect', 422);
        }
        $token = $user->createToken('cloud_project')->plainTextToken;
        return response()->json([
            'user'=> $user,
            'token' => $token
        ]);
    }
    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json('logged out', 200);
    }
}
