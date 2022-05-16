<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ForecastController extends Controller
{

    public $location;
    public $date; 

    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $this->location = auth()->user()->location;
        $this->date = '';

        $forecast = $this->sendRequest();
       
        return view('forecast', [
                'location' => $this->location,
                'mode' => 7,
                'forecast' => $forecast ? $forecast : null
        ]);
       
    }      

    public function store(Request $request){
               
        $this->location = $request->location ? $request->location : auth()->user()->location ;
        $this->date = '';
        
        $forecast = $this->sendRequest();
               
        return view('forecast', [
                'location' => $this->location,
                'mode' => 7,
                'forecast' => $forecast ? $forecast : null
        ]);
       
    }

    public function detail(Request $request){       
        
        $day = explode('/',$request->getPathInfo());
        $this->location = urldecode($day[2]); 
        $this->date = $day[3];  
               
        $forecast = $this->sendRequest();      
        
        return view('forecast', [
            'location' => $this->location,
            'mode' => 1,
            'forecast' => $forecast ? $forecast : null
         ]);
    }

    private function sendRequest(){

        if($this->location){ 
                
            $response_coord = Http::acceptJson()->get('http://api.openweathermap.org/data/2.5/weather', [
                'q' => $this->location,            
                'appid' => config('openweather.app_id')
            ]);

            $response_coord = json_decode($response_coord);
            if(!empty($response_coord)){
                $lat = $response_coord->coord->lat;
                $lon = $response_coord->coord->lon;
            }
        }
        else {
            $lat = config('openweather.lat_default');
            $lon = config('openweather.lng_default');
        }
        
        $response = Http::acceptJson()->get('https://api.openweathermap.org/data/2.5/onecall', [
                'lat' => $lat , 
                'lon' => $lon,
                'units' => 'metric',        
                'exclude' => 'minutely',    
                'appid' => config('openweather.app_id')
        ]);
            
        $response = json_decode($response);
                 
        if($this->date) {                    
            $todayDay = date('d');
            $diff = $this->date - $todayDay;
            
            $forecast = array_slice($response->daily,$diff,1);
        }
        else {            
            $forecast = array_slice($response->daily,0,7);
        }
        
        return $forecast;        
    }
}
