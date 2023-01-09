<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
