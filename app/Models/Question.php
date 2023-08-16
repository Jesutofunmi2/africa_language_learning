<?php

namespace App\Models;

use App\Traits\UUID;
use App\Models\Topic;
use App\Models\Language;
use App\Models\Option;
use Laravel\Sanctum\HasApiTokens;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, UUID {
        HasFactory::factory as traitFactory;
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    // public function fourites()
    // {
    //     return $this->belongsTo(Fourite::class);
    // }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'instruction',
        'language_id',
        'topic_id',
        'answered_type',
        'media_type',
        'media_url'
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
