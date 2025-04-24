<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publisher extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'contact_info',
        'website',
    ];

    /**
     * The books published by this publisher.
     * One-to-Many relationship.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Book, Publisher>
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
