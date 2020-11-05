<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Model\User;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        $validator = $request->validate([
            'username' => 'required',
            'password' => 'required|string|confirmed',
            'nama' => 'required|string',
            'email' => 'required|string|email|unique:users',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Failed!',
                'data' => $validator->messages()
            ], 200);
        }

        $user = new User([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
        ]);
        $user->save();
        // return response()->json([
        //     'message' => 'Successfully created user!'
        // ], 201);

        return response()->json([
            'code' => 200,
            'message' => 'Successfully created user!',
            'data' => $user
        ], 200);
    }
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['username', 'password']);
        
        // gagal
        if(!Auth::attempt($credentials))
            return response()->json([
                'code' => 401,
                'message' => 'Failed',
                'data' => 'Invalid Username or Password!'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'code' => 200,
            'message' => 'Login Success',
            'data' => [
                'user' => $user,
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                    )->toDateTimeString()
                ],
        ]);
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'code' => 230,
            'message' => 'Successfully logged out',
            'data' => 'Logged Out'
        ]);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json([
            'code' => 200,
            'message' => 'User identified',
            'data' => $request->user()
            ]);
    }

}
