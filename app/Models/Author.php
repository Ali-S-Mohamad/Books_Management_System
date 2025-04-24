<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Represents a book author with biographical information.
 */
class Author extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'bio',
        'dob',
        'nationality'
    ];

    /**
     * The books this author has contributed to.
     * Many-to-Many relationship.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Book, Author, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function books(){
        return $this->belongsToMany(Book::class)->withTimestamps();
    }

}
