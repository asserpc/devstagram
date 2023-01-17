<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Crear relaciones de usuarios con post
     * relacion 1 a N (hasmany)
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //los que me siguien =Followers
    //debido a que esta tabla no sigue la convencion laravel debe especificarse todos los elementos de la relacion
    public function followers()
    {
        // importante luego de la tabla viene la columna de partida y despues la de llegada
        //en este caso parte de user_id (el muro)  a Follower_id (visitante)
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }

    public function followings()
    {
        // importante luego de la tabla viene la columna de partida y despues la de llegada
        //en este caso parte de Follower_id (visitante) a  user_id (el muro) 
        return $this->belongsToMany(User::class,'followers','follower_id','user_id');
    }

    //para comprobar si un usuario ya esta siguiendo al perfil vistado
    public  function siguiendo(User $user)
    {
        return $this->followers->contains($user->id);
    }
  
     
}
