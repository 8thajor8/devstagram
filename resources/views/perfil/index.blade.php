@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{auth()->user()->username}}
@endsection

{{-- @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush --}}

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            {{-- <form  id="dropzone" action="{{route('imagenes.store')}}" enctype="multipart/form-data" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form> --}}
       {{--  </div>

        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0"> --}}
            <form class="mt-10 md:mt-0" action="{{route('perfil.store', $user)}}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="titulo">Username</label>
                    <input 
                        id="username"
                        name="username"
                        type="text"
                        placeholder="Tu Nombre de Usuario"
                        class="border p-3 w-full rounded-lg @error('name')border-red-500 @enderror"
                        value="{{auth()->user()->username}}"
                    />
                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}</p>                        
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="descripcion">Imagen Perfil</label>
                    <input 
                        id="imagen"
                        name="imagen"
                        type="file"
                        class="border p-3 w-full rounded-lg "
                        value=""
                        accept=".jpg, .jpeg, .png"
                    />

                </div>

                
                <input 
                    type="submit"
                    value="Guardar Cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>
        </div>
    </div>
@endsection