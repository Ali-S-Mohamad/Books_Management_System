<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * The loans (borrow transactions) made by this user.
     * One-to-Many relationship.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Loan, User>
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Convenient access to borrowed copies through loans.
     * Can be used to fetch all copies currently or previously borrowed.
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough<Copy, Loan, User>
     */
    public function copies()
    {
        return $this->hasManyThrough(
            Copy::class,
            Loan::class,
            'user_id',  // Foreign key on loans table
            'id',       // Foreign key on copies table
            'id',       // Local key on users table
            'copy_id'   // Local key on loans table
        );
    }
}
