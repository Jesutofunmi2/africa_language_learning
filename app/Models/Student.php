<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\School;
use Carbon\Carbon;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable
    {
        HasFactory::factory as traitFactory;
    }


    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'country',
        'phone_number',
        'gendar',
        'language',
        'email',
        'age',
        'marital_status',
        'password',
        'school_id',
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
        return $this->first_name.' '.$this->last_name;
    }

    public function getFutureAttribute()
    {
       $time = Carbon::parse($this->attributes['created_at'])->addDays(90);

       $date = strtotime($time);
       $remaining = $date - time();
       $days_remaining = floor($remaining / 86400);
       $hours_remaining = floor(($remaining % 86400) / 3600);

       return "Trial version: $days_remaining days and $hours_remaining hours left";

    }

    public static function factory(...$parameters): UserFactory
    {
        return static::traitFactory($parameters);
    }
}