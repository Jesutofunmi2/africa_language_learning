<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\ActivityFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Activity extends Model
{
    use HasFactory {
        HasFactory::factory as traitFactory;
    }

    const TYPES = ['personal', 'global'];

    protected $with = ['user'];
    
    protected static function booted()
    {
        static::creating(function ($activity) {
            if (is_null($activity->ref)) {
                $activity->ref = strtoupper(Str::random(10));
            }
        });
    }

    public static function factory(...$parameters): ActivityFactory
    {
        return static::traitFactory($parameters);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * get activities that are specific for the user
     */
    public function scopeUserActivity(Builder $query, $userId): Builder
    {
        return $query->whereUserId($userId);
    }

    /**
     * get activities that are global
     */
    public function scopeGlobalActivity(Builder $query): Builder
    {
        return $query->orWhere('type', 'global');
    }

    /**
     * filter activity within a specific date.
     */
    public function scopeDateBetween(Builder $query, string $start, string $end): Builder
    {
        $start = Carbon::parse($start)->format('Y-m-d');
        $end = Carbon::parse($end)->format('Y-m-d');

        return $query->whereBetween(DB::raw('DATE(date)'), [$start, $end]);
    }
}
