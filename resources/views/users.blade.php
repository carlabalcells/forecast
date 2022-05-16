@extends('layouts.app')

@section('titulo')
    Sign up users
@endsection

@section('contenido')

    @if($users->count())
        <table class="md:table-auto items-center">    
            <thead>
                <tr>
                    <th class="w-20">Username</th>
                    <th class="w-20">Location</th>
                    <th class="w-20">Sign Up Date</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg> {{ $user->username }} 
                    </td>
                    <td>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg> {{ $user->location }} 
                    </td>    
                    <td>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg> {{ $user->created_at->diffForHumans() }} 
                    </td>
                </tr>          
            @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center"> There is no users </p>
    @endif

@endsection