<?php

namespace App\Models;

use App\Traits\UUID;
use App\Models\Course;
use App\Models\Language;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Option extends Model
{
    use HasApiTokens, HasFactory, Notifiable, UUID {
        HasFactory::factory as traitFactory;
    }

    // public function course()
    // {
    //     return $this->belongsTo(Course::class);
    // }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'language_id',
        'course_id',
        'answered_type',
        'media_type',

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
        return $this->name;
    }

    public static function factory(...$parameters): UserFactory
    {
        return static::traitFactory($parameters);
    }
}