<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class QuestionType extends Model
{
    use HasApiTokens, HasFactory, Notifiable
    {
        HasFactory::factory as traitFactory;
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
    protected $fillable = [
        'name',
        'image_url'
    ];


    public static function factory(...$parameters): UserFactory
    {
        return static::traitFactory($parameters);
    }
}
