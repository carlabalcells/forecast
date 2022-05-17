<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $forecast = [];
        $location = auth()->user()->location;
        
        if(['middleware' => 'is.admin']) return redirect()->route('admin');       
        else return redirect()->route('forecast.index', ['location' => auth()->user()->location]);

    }
     
}
