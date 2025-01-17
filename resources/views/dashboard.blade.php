@extends('layouts.app')

@section('titulo')
    Perfil: {{$user->username}}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{$user->imagen ? asset('perfiles/'.$user->imagen) : asset('img/usuario.svg')}}">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col md:justify-center items-center md:items-start py-10 md:py-10">
                <div class="flex items-center cursor-pointer gap-4">
                    <p class="text-gray-700 text-2xl">{{$user->username}}</p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{route('perfil.index', $user)}}" class="text-gray-500 hover:text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>

                            </a>
                        @endif
                    @endauth
                </div>
                <p class="text-gray-800 text-sm mb-3 mt-5 font-bold">
                    {{$user->followers->count()}}
                    <span class="font-normal">@choice('Seguidor | Seguidores', $user->followers->count())</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$user->following->count()}}
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$user->posts->count()}}
                    <span class="font-normal">Posts</span>
                </p>

            @auth
                @if ($user->id !== auth()->user()->id)
                    @if ($user->siguiendo(auth()->user()))
                        <form method="POST" action="{{route('users.unfollow', $user)}}">
                        @csrf
                        @method('DELETE')
                            <input 
                                type="submit"
                                value="Dejar De Seguir"
                                class="bg-red-600 hover:bg-red-700 transition-colors cursor-pointer uppercase font-bold px-3 py-1 text-white rounded-lg text-xs"
                            />
                        </form>  
                    @else
                        <form method="POST" action="{{route('users.follow', $user)}}">
                        @csrf
                        <input 
                            type="submit"
                            value="Seguir"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold px-3 py-1 text-white rounded-lg text-xs"
                        />
                    </form>  
                    @endif
                    
                    
                    
                @endif
                
            @endauth
                

            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>


       {{-- @if ($posts->count()) Metodo 1 --}}
        <x-listar-post :posts="$posts" />
         {{--@if ($user->posts->count()){{-- Metodo 2 --}}
            
        

    </section>
@endsection