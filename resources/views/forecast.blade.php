@extends('layouts.app');

@section('titulo')
    Weather Forecast in {{ $location }}
@endsection

@section('contenido')

    <div class="p-6 rounded-lg shadow-xl justify-right">
        <form method="POST" action="{{ route('forecast.show') }}" >           
            @csrf
            <input class="h-8 w-250" type="text" name="location" id="location" placeholder="Write a location here....">            
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex 
                        items-center h-8 w-15"
                    type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>Search 
            </button>
        </form>
    </div>

    
    @if(count($forecast))

        @if ($mode === 7)           
            <div class="grid md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-7 gap-1 ">
        @else
            <div class="grid grid-cols-1">
        @endif
            
                @foreach ( $forecast as $f )
                    <div class="flex md:w-12/12 bg-white shadow p-6 items-center justify-center">
                        <a href="{{ route('forecast.detail', [ 'day' => date('j', $f->dt), 'location' => $location ] ) }} " >
                            <span class="md:w-12/12 font-bold items-center justify-center"> {{ date('D', $f->dt) }} </span><br>
                            <span class="text-gray-500 items-center justify-center"> {{ date('j M', $f->dt) }} </span><br>
                            <span> 
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 
                                    5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg> {{ round($f->temp->max) }} 
                            </span>
                            <span> 
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 
                                    14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg> {{ round($f->temp->min) }} </span><br>                        
                            @if ($mode === 1) 
                                <span> 
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
                                    </svg>
                                    Sunrise: {{ date('H:i:s', $f->sunrise) }}  </span><br>
                                <span> 
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                                    </svg>
                                    Sunset: {{ date('H:i:s', $f->sunset) }}  </span><br>
                                <span> Humidity: {{ $f->humidity }} % </span><br>
                                <span> Wind speed: {{ $f->wind_speed }} m/s </span><br>
                                <span> Clouds: {{ $f->clouds }} % </span><br>
                                <span> Pressure: {{ $f->pressure }} % </span><br>
                                <span> Probabilty of Precipitation: {{ $f->pop * 100 }} % </span><br>                            
                                <span> UV index : {{ $f->uvi }}  </span><br>
                            @endif
                            <span> {{ $f->weather[0]->description }} </span><br>
                            <img width=50 src="http://openweathermap.org/img/wn/{{ $f->weather[0]->icon }}.png">
                        </a>
                    </div>
                @endforeach
            </div>       
    @else
        <li>Sorry my dear friend, no forecast here.</li>
    @endif
  
@endsection