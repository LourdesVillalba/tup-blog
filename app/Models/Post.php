<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'titulo',
        'contenido',
        'imagen',
        'categoria_id',
        'user_id',
    ];
    

        public function user()
    {
        return $this->belongsTo(User::class);
    }

        public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

}
