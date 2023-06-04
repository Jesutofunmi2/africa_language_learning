<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'title' => $this->faker->words($this->faker->numberBetween(1,3), true),
            'description' => $this->faker->realText(),
            'image_url' => '/storage/placeholder.jpe',
            'date' => Carbon::now(),
            "type" => "personal",
        ];
    }

    /**
     * Create a global activity.
     */
    public function global()
    {
        return $this->state([
            "type" => "global"
        ]);
    }
}
