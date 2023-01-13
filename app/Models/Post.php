<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    
    //debe crearse el filabor siempre para poder guardar en la BD o dara error
    //el filabor es igual al create un arreglo de los mismos campos
     protected $fillable = [
        'titulo',
        'description',
        'image',
        'user_id'
     ];


     // LAS RELACIONES
     /**
      * para crear la relacion inversa de un post a un modelo
      * hay que destacar que en este caso un usuario puede tener
      * Multiples post, pero un post solo pertenece a un usuario
      * entonces la relacion inversa POST->Usuarios es 1 a 1
      * se utiliza "belongsto"
       *
       * otra acotacion las relaciones lo nejor es llamarlas como los modelos asociados
      */
      public function user()
      {
         return $this->belongsTo(User::class);
      }

      //ahora un post puede tener multiples comentarios 
      public function comentarios()
      {
         return $this->hasMany(Comentario::class);
      }

      //relacion likes a post
      public function likes()
      {
         return $this->hasMany(Like::class);
      }

      //validar si un usuario ya ha dado like
      public function checkLike(User $user)
      {
         return $this->likes->contains('user_id', $user->id);
      }
}
