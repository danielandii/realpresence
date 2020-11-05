<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
    	//
    }

    public function index()
    {
    	return view("login");
    }

    public function login(Request $request){
	    $this->validate($request, [
	        'username' => 'required',
	        'password' => 'required',
	        ]);
	    if (\Auth::attempt([
	        'username' => $request->username,
	        'password' => $request->password])
	    ){
	    	return redirect('/home');
	        
	    }
	    return redirect('/login')->with('error', 'Invalid Email address or Password');
	}
	/* GET
	*/
	public function logout(Request $request)
	{
	    if(\Auth::check())
	    {
	        \Auth::logout();
	        $request->session()->invalidate();
	    }
	    return  redirect('/login');
	}

    public function home()
    {
        return view("index");
    }
}
