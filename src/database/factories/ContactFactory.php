<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->randomElement(['男性','女性']),
            'email' => $this->faker->unique()->safeEmail,
            'tel' => $this->faker->regexify('0[789]0-d{4}-\d{4}'),
            'address' => $this->faker->address,
            'building' => $this->faker->secondaryAddress,
                'category_id' => rand(1, 5),
                'detail' => $this->faker->realText(50),
                'created_at' => now(),
                'updated_at' => now(),
        ];
    }
}
