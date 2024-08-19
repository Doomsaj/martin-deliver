<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CourierAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $courier = Courier::where('username', $credentials['username'])->first();

        if ($courier && Hash::check($credentials['password'], $courier->password)) {
            $token = $courier->createToken('courier-token', ['role:courier'])->plainTextToken;

            return response()->json(['token' => $token]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
