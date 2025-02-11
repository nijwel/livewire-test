<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    use HasFactory;
    protected $table    = 'posts';
    protected $fillable = ['name', 'description', 'price', 'quantity', 'image'];

    public function category() {
        return $this->belongsTo( Category::class );
    }
}
