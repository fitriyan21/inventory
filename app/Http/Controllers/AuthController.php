<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->all();

        $validationRules = [
            'email'=>'required|string',
            'password'=>'required|string',
        ];
        $validator = Validator::make($input, $validationRules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function register(Request $request)
    {
        $input = $request->all();

        $validationRules = [
            'name'=>'required',
            'email'=>'required|unique:users|email',
            'role'=>'required',
          
        ];
        $validator = Validator::make($input, $validationRules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        
        $user = User::create([
            "name"=>$input['name'],
            "email"=>$input['email'],
            "password"=>app('hash')->make($input['password']),
            "role"=>$input['role']
        ]);

        return response()->json($user, 200);
    }
}
