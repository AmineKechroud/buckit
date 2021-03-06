<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:70',
            'name' => 'required|max:70',
            'display_name' => 'required|max:70',
        ]);
        if ($validator->fails())
        {
            return response()->json(['error' => true,'status' => 0,'message' => 'missing credintials'],200);
        }
        if(User::query()->where('email', $request['email'])->exists())
        {
            $user = User::query()->where('email', $request['email'])->first();
            $token = JWTAuth::fromUser($user);
            $token = 'Bearer ' . $token;
            $token_string = (string)$token;
        }else{
            $user = User::query()->create($request->all());
            $token = JWTAuth::fromUser($user);
            $token = 'Bearer ' . $token;
            $token_string = (string)$token;
        }
        
        // $user->update(['api_token' => $token]);
        return response()->json(['error' => false, 'message' => 'Signed Up Successfully!',
        'user_info' => $user, 'token' => $token_string], 200);
    }

    public function login(LoginRequest $request) {
        //FIND THE USER
        $user_record = User::query()->where('username', '=', $request->username)->first();
        if ($user_record == null) {
            return response()->json(['error' => true, 'errors' => ['Username Does Not Exist']], 401);    
        }
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $token = JWTAuth::fromUser($user_record);
            $token = 'Bearer ' . $token;
            $token_string = (string)$token;
            return response()->json(['error' => true, 'message' => 'Logged In Successfully!',
        'user_info' => $user_record, 'token' => $token_string], 200);
        }
        return response()->json(['error' => true, 'errors' => ['Wrong Username/Password Combo :(']], 401);    
    }
}
