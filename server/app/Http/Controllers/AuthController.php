<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function signup(Request $request)
    {
        try {
            $user = new User;
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json([
                'success' => true,
                "user" => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                "user" => null,
                "message" => $e->getMessage()
            ], 500);
        }
    }


    function login(Request $request)
    {
        try {
            $password = bcrypt($request->password);

            $user = User::where('email', $request->email)->first();

            if ($user && $user->password === $password) {
                return response()->json([
                    "success" => true,
                    "user" => $user
                ]);
            } else {
                return response()->json([
                    "success" => false,
                    "user" => null
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }
}
