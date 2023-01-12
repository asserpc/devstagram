<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comentario extends Model
{
    use HasFactory;
    //esto es necesario para que los datos se guarden
    protected $fillable = [
        'user_id',
        'post_id',
        'comentario'
    ];

    //creando una relacion para qye cada comentario se asocie a un solo usuario
    public function user()
    {
        //relacion inversa
        return $this->belongsTo(User::class);
    }
}
