<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DayController extends Controller
{
    public $location;
    public $start_date; 

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

                
    }
}
