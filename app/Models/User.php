<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'password',
        'old_password',
        'user_pfp',
        'role_id',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'old_password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($roleName)
    {
        return $this->role && $this->role->role_name === $roleName;
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class, Post::class);
    }
    public function likes()
    {
        return $this->hasMany(Post_like::class);
    }


    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }

    // Users that the user is following
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    public function isFollowing(User $user)
    {
        // Ensure that the user is not trying to follow themselves
        if ($this->id === $user->id) {
            return false;
        }
        return $this->followings()->where('following_id', $user->id)->exists();
    }




    public function follow(User $user)
    {
        if ($this->id !== $user->id && !$this->isFollowing($user)) {
            $this->followings()->attach($user->id);
        }
    }

    public function unfollow(User $user)
    {
        if ($this->id !== $user->id && $this->isFollowing($user)) {
            $this->followings()->detach($user->id);
        }
    }


    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}
