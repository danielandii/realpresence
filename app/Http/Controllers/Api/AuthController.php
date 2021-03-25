<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Model\User;
use App\Model\Qrdata;
use App\Model\Presence;

/**
     * request code
     *
     * 200 success
     * 400 error, client should not repeat the request without modification
     * 404 error, server can not find the requested resource
     */

class AuthController extends Controller
{

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
        
        // error json
        if(!Auth::attempt($credentials))
            return response()->json([
                'code' => 400,
                'message' => 'Login Error',
                'data' => 'Invalid Username or Password!'
            ], 400);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        // success json
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
            ],200);
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
            'code' => 200,
            'message' => 'Logout Success',
            'data' => 'Logged Out'
        ],200);
    }


    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|string|confirmed',
            'nama' => 'required|string',
            'email' => 'required|string|email|unique:users',
        ]);
        // error json
        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Signup Error',
                'data' => $validator->messages()
            ], 400);
        }

        $user = new User([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
        ]);
        $user->save();
        
        // success json
        return response()->json([
            'code' => 200,
            'message' => 'Signup Success',
            'data' => $user
        ], 200);
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            // 'username' => 'required',
            // 'password' => 'required|string|confirmed',
            // 'nama' => 'required|string',
        ]);
        // error json
        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Update Error',
                'data' => $validator->messages()
            ], 400);
        }

        $user = User::find($id);
        // dd($user);
        if ($user) {
            $data = $request->except(['_token', '_method', 'password']);

            if($request->get('password')!=''){
                $data['password'] = bcrypt($request->get('password'));
            }

            // dd($user);
            $user->update($data);
            
            return response()->json([
                'code' => 200,
                'message' => 'User Updated',
                'data' => $user
            ],200);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'Update Error',
                'data' => 'User not identified'
            ],400);
        }
        
        // dd($user);
    }

    public function changePass(Request $request)
    {
        $request->validate([
            'old_password'=>'required',
            'new_password'=>'required',
            'new_password_confirmation'=>'required',
        ]);

        
        $user = $request->user();
        // dd($user);
        if($request->get('new_password') != $request->get('new_password_confirmation')){

            return response()->json([
                'code' => 400,
                'message' => 'Change Password Error',
                'data' => 'New Password and Password Confirmation input is not the same'
            ],400);
        }

        if(Hash::check($request->get('old_password'), $user->password)){
            $user->password = bcrypt($request->get('new_password'));
            $user->save();

            return response()->json([
                'code' => 200,
                'message' => 'Change Password Success',
                'data' => $user
            ],200);
        } else {
            
            return response()->json([
                'code' => 400,
                'message' => 'Change Password Error',
                'data' => 'False Old Pass Input'
            ],400);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        // dd($user);
        if ($user) {
            $user->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Delete Success',
                'data' => 'User has been deleted'
            ],200);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'Error Deleting',
                'data' => 'User not identified'
            ],400);
        }
        
        // dd($user);
    }

    public function getRole()
    {
        $role = config('custom.role');
        // dd($role);
        if ($role) {
            return response()->json([
                'code' => 200,
                'message' => 'Get Role Success',
                'data' => $role
            ],200);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'Error getting Role',
                'data' => 'Role not found'
            ],400);
        }
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function show($id, Request $request)
    {
        $user = User::find($id);
        $user['last_presence'] = $user->presence->sortByDesc('id')->first()->tanggal;
        // dd($user);
        if ($user) {
            return response()->json([
                'code' => 200,
                'message' => 'Get User Success',
                'data' => $user
            ],200);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'Error getting User',
                'data' => 'User not found'
            ],400);
        }
    }

    // get user profile that logged in
    public function profile(Request $request)
    {
        $user = $request->user();
        if ($user) {
            return response()->json([
                'code' => 200,
                'message' => 'Get User Success',
                'data' => $request->user()
            ],200);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'Error getting User',
                'data' => 'User not found'
            ],400);
        }
    }

    public function historypresence(Request $request)
    {
        $user = $request->user();
        $month = Carbon::now()->startOfMonth();
        $historyuser = Presence::where('user_id',$user->id)->get()
        ->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->tanggal)->format('F'); // grouping by months
        });;
        // dd($month);
        if (count($historyuser) > 0) {
            return response()->json([
                'code' => 200,
                'message' => 'Get History Success',
                'data' => $historyuser
            ],200);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'Error getting History',
                'data' => 'Data not found'
            ],400);
        }
    }

    public function yearhistorypresence(Request $request)
    {
        $user = $request->user();
        $year = $request->get('year');
        $historyuser = Presence::where('user_id',$user->id)->whereYear('tanggal',$year)->get();

        if (count($historyuser) > 0) {
            return response()->json([
                'code' => 200,
                'message' => 'Get Year History Success',
                'data' => $historyuser
            ],200);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'Error getting History',
                'data' => 'Data not found'
            ],400);
        }
    }

    public function presence(Request $request)
    {
        $request->validate([
            'token_qr'=>'required',
        ],[
            'token_qr.required' => 'QR Token not found'
        ]);

        $user = $request->user();
        $tokenqr = $request->token_qr;
        
        $findtoken = Qrdata::where('token_qr',$tokenqr)->first();

        if ($findtoken) {
            $findpresence = Presence::where('user_id',$user->id)->where('tanggal',$findtoken->tanggal)->first();
            if ($findpresence) {
                return response()->json([
                    'code' => 409,
                    'message' => 'Error',
                    'data' => 'Presence data already recorded'
                ],400);
            }else{
                $presence = Presence::create([
                    'user_id' => $user->id,
                    'tanggal' => $findtoken->tanggal,
                    'jam_masuk' => date('H:i:s'),
                    ]);
    
                return response()->json([
                    'code' => 200,
                    'message' => 'Success',
                    'data' => 'Presence Data has been recorded'
                ],200);
            }
            
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'error',
                'data' => 'Try Again or contact your administrator'
            ],400);
        }
    }

    
    public function unpresence(Request $request)
    {
        $request->validate([
            'token_qr'=>'required',
        ],[
            'token_qr.required' => 'QR Token not found'
        ]);

        $user = $request->user();
        $tokenqr = $request->token_qr;
        
        $findtoken = Qrdata::where('token_qr',$tokenqr)->first();

        if ($findtoken) {
            $findpresence = Presence::where('user_id',$user->id)->where('tanggal',$findtoken->tanggal)->first();
            // dd($findpresence);
            if ($findpresence) {
                if ($findpresence->jam_pulang != null) {
                    return response()->json([
                        'code' => 409,
                        'message' => 'Error',
                        'data' => 'UnPresence data already recorded'
                    ],409);

                }else{
                    $presence = Presence::where('user_id',$user->id)->where('tanggal',$findtoken->tanggal)->first();
                    // dd($presence);
                    $presence->jam_pulang = date('H:i:s');
                    $presence->update();
        
                    return response()->json([
                        'code' => 200,
                        'message' => 'Success',
                        'data' => 'UnPresence Data has been recorded'
                    ],200);
                }
            // jika data user tidak ditemukan
            }else{
                return response()->json([
                    'code' => 400,
                    'message' => 'error',
                    'data' => 'Data Not found, Try Again or contact your administrator'
                ],400);
            }
            
        // jika token tidak ditemukan
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'error',
                'data' => 'Invalid QR Data.'
            ],400);
        }
    }

    

}
