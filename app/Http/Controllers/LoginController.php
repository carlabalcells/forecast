<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if(!auth()->attempt($request->only('username', 'password'), $request->remember)){
            return back()->with('mensaje', 'Invalid credentials');
        }

        if(['middleware' => 'is.admin']) return redirect()->route('admin');       
        else return redirect()->route('forecast.index', ['location' => auth()->user()->location]);
    }
}
