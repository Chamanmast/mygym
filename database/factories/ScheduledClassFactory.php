<?php

namespace Database\Factories;

use App\Models\ClassType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScheduledClass>
 */
class ScheduledClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'instructor_id' => User::where('role','instructor')->get()->random()->id,
            'class_type_id' => ClassType::inRandomOrder()->value('id'),
            'date_time' => fake()->dateTimeBetween('now', '+2 days'),
        ];
    }
}
