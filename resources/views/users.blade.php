@extends('layouts.app')

@section('titulo')
    Sign up users
@endsection

@section('contenido')
    <div class="grid grid-cols-3 gap-3" >
        @if($users->count())
            <div class="flex font-bold justify-center items-center"> 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                </svg> 
                Username 
            </div> 
            <div class="flex font-bold justify-center items-center"> 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                </svg>
                Location 
            </div>
            <div class="flex font-bold justify-center items-center"> 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                </svg>
                Sign up Date
            </div>

            @foreach ($users as $user)
                <div class="flex justify-center items-center"> {{ $user->username }} </div>
                <div class="flex justify-center items-center"> {{ $user->location }} </div>
                <div class="flex justify-center items-center"> {{ $user->created_at->diffForHumans() }} </div>
            @endforeach
    </div>
    @else
    <p class="text-center"> There is no users </p>
    @endif    

@endsection