<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Question;

class Fourite extends Model
{
    use HasApiTokens, HasFactory, Notifiable
    {
        HasFactory::factory as traitFactory;
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
        'question_name',
        'student_id',
        'question_id',
        ''
    ];


    public function getFullnameAttribute()
    {
        return $this->question_name;
    }

    public static function factory(...$parameters): UserFactory
    {
        return static::traitFactory($parameters);
    }
}
