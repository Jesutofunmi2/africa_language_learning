<?php

namespace App\Rules;

use App\Enums\ActivityType;
use App\Models\Activity;
use Illuminate\Contracts\Validation\Rule;

class ActivityPlanExist implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value, Activity::TYPES);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please select a valid activity type';
    }
}
