<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * The books that belong to this category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Book, Category, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function books(){
        return $this->belongsToMany(Book::class)->withTimestamps();
    }
}
