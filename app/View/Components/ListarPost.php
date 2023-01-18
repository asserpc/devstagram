<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class ListarPost extends Component
{
    public $posts;
    
    //para mapear la variable del compornente deben llamarse igual y asignarla al
    //constructor
    public function __construct($posts)
    {
        $this->posts= $posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.listar-post');
    }
}
