<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct(){

        $this->middleware('auth')->except(['show']);

    }
    //
    public function index(User $user){

        //Metodo 1:
        $posts = Post::where('user_id', $user->id)->paginate(3);

        //Metodo 2: No se puede usar paginacion
        //Se define directo en la vista usando $user->posts

        return view('dashboard',[
            'user'=>$user,
            'posts' => $posts //Si se usa metodo 1
        ]);
    }
    //
    public function create(User $user){
        return view('posts.create',[
            'user'=>$user
        ]);
    }
    //
    public function store(Request $request){
        
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }
    //
    public function show(User $user, Post $post){
        return view('posts.show',[
            'post'=>$post,
            'user'=>$user
        ]);
    }
    //
    public function destroy(Post $post){
        
        $this->authorize('delete', $post);
            $post->delete();

        //Eliminar la imagen
        $imagen_path = public_path('uploads/'.$post->imagen);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
    //
    
}
