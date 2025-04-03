<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    function signup(Request $request)
    {
        try {

            dd(env('APP_URL')); // This should output http://localhost:8000


            $request->validate([
                'full_name' => 'required|string|max:225',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = new User;
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            // return response()->json([
            //     'success' => true,
            //     "user" => $user
            // ]);

            // Request access token from Passport
            // $response = Http::asForm()->post(config('services.passport.login_endpoint'), [
            //     'grant_type' => 'password',
            //     'client_id' => config('services.passport.client_id'),
            //     'client_secret' => config('services.passport.client_secret'),
            //     'username' => $request->email,
            //     'password' => $request->password,
            //     'scope' => '',
            // ]);


            $response = Http::asForm()->post(env('APP_URL') . '/oauth/token', [
                'grant_type' => 'password',
                'client_id' => env('PASSPORT_CLIENT_ID'),
                'client_secret' => env('PASSPORT_CLIENT_SECRET'),
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ]);

            if ($response->failed()) {
                return response()->json([
                    'success' => false,
                    'message' => 'User registered but token could not be generated.',
                ], 500);
            }

            $tokenData = $response->json();

            return response()->json([
                'success' => true,
                'user' => $user,
                'token' => $tokenData,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                "user" => null,
                "message" => $e->getMessage()
            ], 500);
        }
    }
}
