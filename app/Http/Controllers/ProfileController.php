<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('profile.index');
    }

    public function store(Request $request){
        
        //Modificamos el request 
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,edit-profile']
        ]);
      

        //Saving changes
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->location = $request->location;
        $usuario->save();

        if($request->username == 'admin') return redirect()->route('users.show');
        else return redirect()->route('forecast.index');       
    }
}



