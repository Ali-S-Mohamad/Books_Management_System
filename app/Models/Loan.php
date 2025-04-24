<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user_id',
        'copy_id',
        'loaned_at',
        'due_at',
        'returned_at',
    ];
    protected $dates = [
        'loaned_at',
        'due_at',
        'returned_at',
    ];

    /**
     * The member who borrowed the copy.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Loan>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The copy that was borrowed.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Copy, Loan>
     */
    public function copy()
    {
        return $this->belongsTo(Copy::class);
    }
}
