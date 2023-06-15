<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\UUID;

class Question extends Model
{ 
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, UUID
    {
        HasFactory::factory as traitFactory;
    }
     
    public function Course(){

        return $this->belongsTo(App\Model\Course::class);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'question_title',
        'question_instruction',
        'language_id',
        'course_id',
        'answered_type',
        'media_type',
        'media_url'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        
    ];

    public function getFullnameAttribute()
    {
        return $this->name;
    }

    public static function factory(...$parameters): UserFactory
    {
        return static::traitFactory($parameters);
    }
}
