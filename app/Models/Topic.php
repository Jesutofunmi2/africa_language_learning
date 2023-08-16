<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Question;
use App\Models\Section;
use App\Models\Answered;
use App\Traits\UUID;

class Topic extends Model
{
    use HasApiTokens, HasFactory, Notifiable, UUID {
        HasFactory::factory as traitFactory;
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    
    public function answereds()
    {
        return $this->hasMany(Answered::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image_url'
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
}
