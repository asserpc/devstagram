<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked; //saber si se ha dado like
    public $likes; //cuantos likes tiene el post

    /**
     * esta funcion es el constructor de livewire
     * entonces en ella vamos a verificar si el usuario ya dio like
     */
    public function mount($post)
    {
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }
    
    // esta funcion se ejecuta cuando ocurra el evento en wire
    // importante en wire no este disponible la varible $request esto se 
    // puede parcear en base al modelo
    public function like()
    {
        // en esta funcion vamos a unificar los dos metos del like controler
        if ($this->post->checkLike(auth()->user() ) ){
            # code... $request->user() se cambia por $this ya que este por ka relacion de modelo tiene la funcion like 
            $this->post->likes()->where('post_id',$this->post->id)->delete();
            $this->isLiked=false;
            $this->likes--; //reducir likes
            // esto no se necesita return back();
        } else {
            # 
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked=true;
            $this->likes++; //aumentar likes
        }
        
    }
    
    public function render()
    {
        return view('livewire.like-post');
    }
}
