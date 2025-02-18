<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate =  fake()->dateTimeBetween('now', '+ 5 months');

        return [
            'user_id' =>  random_int(1, 100),
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph,
            'start_date' => $startDate,
            'end_date' => fake()->dateTimeBetween($startDate, $startDate->modify("+2 months"))
        ];
    }
}
