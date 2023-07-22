<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Course;
use App\Models\Topic;
use App\Traits\UUID;

class Section extends Model
{
    use HasApiTokens, HasFactory, Notifiable, UUID {
        HasFactory::factory as traitFactory;
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    protected $fillable = [
        'title',
        'level',
        'category'
    ];
    protected $hidden = [];
}
