<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

     protected $model = School::class;
      /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail,
            'password' =>  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'image_url' => 'https://course-material-dev.s3.us-east-2.amazonaws.com/logoi.png',
            'country' =>  $this->faker->country(),
            'phone_number'=>  $this->faker->phoneNumber(),
            'no_of_pupil'=>  $this->faker->randomNumber(),
            'school_name' =>  $this->faker->lastName(),
            //'lga' =>  $this->faker->citySuffix(),
            'type'=>  $this->faker->text(),
            'how_do_you_see_us' =>  $this->faker->text(),
            //'trial_period_in_days'=>  $this->faker->randomNumber(),
           // 'status' => true,
        ];
    }
}
