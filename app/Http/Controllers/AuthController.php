<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function signup(SignupRequest $request) {
        //FIND THE USER
        $user_record = User::query()->where('username', '=', $request->username)->first();
        if ($user_record != null) {
            return response()->json(['error' => true, 'message' => 'User Already Exists'], 401);    
        }
        $request['password'] = bcrypt($request['password']);
        $user = User::query()->create($request->all());
        $token = JWTAuth::fromUser($user);
        $token = 'Bearer ' . $token;
        $token_string = (string)$token;
        return response()->json(['error' => true, 'message' => 'Signed Up Successfully!',
    'user_info' => $user, 'token' => $token_string], 200);
    }

    public function login(LoginRequest $request) {
        //FIND THE USER
        $user_record = User::query()->where('username', '=', $request->username)->first();
        if ($user_record == null) {
            return response()->json(['error' => true, 'message' => 'Username Does Not Exist'], 401);    
        }
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $token = JWTAuth::fromUser($user_record);
            $token = 'Bearer ' . $token;
            $token_string = (string)$token;
            return response()->json(['error' => true, 'message' => 'Logged In Successfully!',
        'user_info' => $user_record, 'token' => $token_string], 200);
        }
        return response()->json(['error' => true, 'message' => 'Wrong Username/Password Combo :('], 401);    
    }
}
