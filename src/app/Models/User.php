<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];
    protected $hidden = [
        'password'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Question::class, 'favorites', 'user_id', 'question_id')
            ->withTimestamps();
    }
}
