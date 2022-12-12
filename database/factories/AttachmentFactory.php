<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class AttachmentFactory extends Factory
{
    private const IMAGE_WIDTH = 200;
    private const IMAGE_HEIGHT = 100;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'link' => fake()->imageUrl(self::IMAGE_WIDTH, self::IMAGE_HEIGHT),
        ];
    }
}
