<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Subscription;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_ADMIN = 'Admin';
    const ROLE_AUTHOR = 'Author';
    const ROLE_READER = 'Reader';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'birth_date', 'source', 'gender', 'phone_number',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isAuthor()
    {
        return $this->role === self::ROLE_AUTHOR;
    }

    public function isReader()
    {
        return $this->role === self::ROLE_READER;
    }
    
    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function hasActiveSubscription()
    {
        return $this->subscriptions()
            ->where('status', 'approved')
            ->where('end_date', '>=', now())
            ->exists();
    }

    protected static function booted()
    {
        static::created(function ($user) {
            if (in_array($user->role, ['Admin', 'Author'])) {
                Subscription::create([
                    'user_id' => $user->id,
                    'start_date' => now(),
                    'end_date' => now()->addYear(),
                    'price' => 0.00,
                    'status' => 'approved',
                ]);
            }
        });
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
