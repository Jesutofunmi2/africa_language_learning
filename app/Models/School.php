<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Student;
use App\Models\Teacher;
class School extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable
    {
        HasFactory::factory as traitFactory;
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    public function classes()
    {
        return $this->belongsTo(Classes::class);
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
        'type',
        'lga',
        'state',
        'trial_days'
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

    public function getFutureAttribute()
    {
       $time= Carbon::parse($this->attributes['created_at'])->addDays($this->attributes['trial_days']);

       $date = strtotime($time);
       $remaining = $date - time();
       $days_remaining = floor($remaining / 86400);
       $hours_remaining = floor(($remaining % 86400) / 3600);

       if($hours_remaining >= 0){
        return "Trial version: $days_remaining days and $hours_remaining hours left";
       }
       
       return false;
      
    }

    public static function factory(...$parameters): UserFactory
    {
        return static::traitFactory($parameters);
    }
}