<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Model
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
        'name',
        'email',
        'teacher_id',
        'phone_number',
        'address',
        'language',
        'password',
        'school_id',
        'survey_status'
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
        return $this->name;
    }

    public static function factory(...$parameters): UserFactory
    {
        return static::traitFactory($parameters);
    }


    public function getFutureAttribute()
    {
       $time = Carbon::parse($this->school->created_at)->addDays($this->school->trial_days);

       $date = strtotime($time);
       $remaining = $date - time();
       $days_remaining = floor($remaining / 86400);
       $hours_remaining = floor(($remaining % 86400) / 3600);

       if($hours_remaining >= 0){
        return "Trial version: $days_remaining days and $hours_remaining hours left";
       }
       return false;

    }

}
