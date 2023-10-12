<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

class AssignmentFile extends Model
{
    use HasApiTokens, HasFactory, Notifiable {
        HasFactory::factory as traitFactory;
    }

    protected $fillable = [
        'school_id',
        'class_id',
        'teacher_id',
        'name',
        'deadline',
        'media_url',
        'mark',
        'notification',
    ];

   

    public function getDateAttribute()
    {
    if (is_null($this->deadline)) {
        return null;
    } else {
        return Carbon::parse($this->deadline)->format('d-m-Y');
    } 
  }
}
