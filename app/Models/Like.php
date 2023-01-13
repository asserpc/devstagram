<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    // al crear la realacion de likes en post no se requiere aca el post_id
    // protected $fillable = [
    //     'user_id',
    //     'post_id'
    // ];
    protected $fillable = [
            'user_id'
        ];

}
