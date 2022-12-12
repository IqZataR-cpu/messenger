<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'text' => fake()->realText(255),
            'user_id' => User::factory(),
            'chat_id' => Chat::factory(),
            'created_at' => fake()->dateTimeBetween(
                '-5 days'
            ),
            'updated_at' => fake()->dateTimeBetween(
                '-5 days'
            )
        ];
    }
}
