<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class School extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable
    {
        HasFactory::factory as traitFactory;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'school_name',
        'country',
        'phone_number',
        'no_of_pupil',
        'image_url',
        'email',
        'password',
        'type'
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
    ];

    public function getFullnameAttribute()
    {
        return $this->name.' '.$this->school_name;
    }

    public static function factory(...$parameters): UserFactory
    {
        return static::traitFactory($parameters);
    }
}