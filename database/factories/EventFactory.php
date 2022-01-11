<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Event;
use App\Models\User;

class EventFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'scheluded_at' => $this->faker->dateTime(),
            'user_id' => User::factory(),
        ];
    }
}
