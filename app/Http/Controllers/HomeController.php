<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

    }
    //
    public function __invoke(){
        
        //Obtener a quienes seguimos
        $ids = auth()->user()->following->pluck('id')->toArray(); //el pluck id lo que hace es traer en un array solo los id en vez de todos los datos de la tabla
        $posts = Post::whereIn('user_id',$ids)->latest()->paginate(20);
        return view('home', [
            'posts' => $posts
        ]);        
    }
}
