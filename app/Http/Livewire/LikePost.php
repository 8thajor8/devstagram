<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{

    public $post;
    public $isLiked;
    public $likes;

    public function mount($post){
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }
    //
    public function like(){
        if($this->post->checkLike(auth()->user())){
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->likes--;
            $this->isLiked = false;
        } else{
            $this->post->likes()->create([
            'user_id' => auth()->user()->id
            ]);
            $this->likes++;
            $this->isLiked = true;
        }
    }
    //
    public function render()
    {
        return view('livewire.like-post');
    }
}
