<?php

namespace App\Models;

use App\Traits\UUID;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\Contracts\HasApiTokens;

class AssignedModule extends Model
{
    use  HasFactory, Notifiable, UUID {
        HasFactory::factory as traitFactory;
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    // public function fourites()
    // {
    //     return $this->belongsTo(Fourite::class);
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'school_id',
        'class_id',
        'teacher_id',
        'modules',
        'deadline',
        'time',
        'no_attempts',
        'notification',
    
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    public function getFullnameAttribute()
    {
        return $this->title;
    }

    public static function factory(...$parameters): UserFactory
    {
        return static::traitFactory($parameters);
    }
}
