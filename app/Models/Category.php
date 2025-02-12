<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    use HasFactory;

    protected $table    = 'categories';
    protected $fillable = ['name', 'slug', 'status', 'parent_id'];

    public function posts() {
        return $this->hasMany( Post::class );
    }

    // Parent relation
    public function parent() {
        return $this->belongsTo( Category::class, 'parent_id' );
    }

    // Children relation
    public function children() {
        return $this->hasMany( Category::class, 'parent_id' );
    }
}
