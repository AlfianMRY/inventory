<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message'=> 'Email atau Password Tidak Cocok'
            ],401);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'message'=>'login berhasil',
            'token'=>$token,
            'user'=>$user,
        ],200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message'=>'Berhasil Logout'
        ],200);
    }
}
