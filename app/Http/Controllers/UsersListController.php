<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersListController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        $users = User::where('username', '<>', 'admin')->latest()->paginate(20); 

        return view('users', [
            'users' => $users
        ]);
    }
}
