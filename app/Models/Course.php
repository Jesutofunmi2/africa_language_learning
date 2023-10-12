<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Section;

class Course extends Model
{
    use HasApiTokens, HasFactory, Notifiable, UUID{
        HasFactory::factory as traitFactory;
    }
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
    protected $fillable = [
        'title',
        'description',
        'image'
    ];
    protected $hidden = [];
}
