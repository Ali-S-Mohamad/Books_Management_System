<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Copy extends Model
{
    use SoftDeletes;
    public const STATUS_AVAILABLE = 'available';
    public const STATUS_ON_LOAN   = 'on_loan';
    public const STATUS_LOST      = 'lost';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'book_id',
        'barcode',
        'status',
    ];

    /**
     * The book this copy belongs to.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Book, Copy>
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * The loans associated with this copy.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Loan, Copy>
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
