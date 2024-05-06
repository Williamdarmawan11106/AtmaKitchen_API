<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'Email' => 'required',
            'Password' => 'required',
        ]);

        $loginData = User::where('email', '=', $request->Email)->select('id', 'username', 'email', 'password', 'tanggal_lahir', 'promo_poin', 'saldo', 'image', 'role', 'active')->first();

        if ($loginData->role == 'Customer' && Hash::check($request->Password, $loginData->password)) {
            return response()->json([
                'message' => 'Selamat Datang Customer',
                'data' => $loginData
            ], 200);
        } else if ($loginData->role == 'MO' && Hash::check($request->Password, $loginData->password)) {
            return response()->json([
                'message' => 'Selamat Datang MO',
                'data' => $loginData
            ], 200);
        } else {
            return response(['message' => 'Invalid login credentials'], 401);
        }
    }
}
