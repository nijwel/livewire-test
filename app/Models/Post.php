<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    use HasFactory;
    protected $table    = 'posts';
    protected $fillable = ['name', 'slug', 'description', 'price', 'quantity', 'image', 'category_id'];

    public function category() {
        return $this->belongsTo( Category::class );
    }
}
