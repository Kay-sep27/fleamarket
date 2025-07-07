<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
{
    return [
        'last_name' => $this->faker->lastName,
        'first_name' => $this->faker->firstName,
        'gender' => $this->faker->randomElement(['男性', '女性', 'その他']),
        'email' => $this->faker->unique()->safeEmail,
        'tel' => $this->faker->numerify('080########'),
        'address' => $this->faker->address,
        'building_name' => $this->faker->optional()->secondaryAddress,
        'category_id' => $this->faker->numberBetween(1, 5),
        // 'content' => $this->faker->realText(50),
        'detail' => $this->faker->realText(100),
    ];
}
}
