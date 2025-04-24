<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'title',
        'publisher_id',
        'published_at',
        'description',
    ];
    protected $dates = [
        'published_at',
    ];

    /**
     * The publisher of this book.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Publisher, Book>
     */
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    /**
     * The authors of this book.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Author, Book, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class)
                    ->withTimestamps();
    }

    /**
     * The categories this book belongs to.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Category, Book, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class)
                    ->withTimestamps();
    }

    /**
     * The physical copies of this book.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Copy, Book>
     */
    public function copies()
    {
        return $this->hasMany(Copy::class);
    }
}
