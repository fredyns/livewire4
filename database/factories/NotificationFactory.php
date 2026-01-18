<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get a random existing user, or create one if none exist
        $user = User::inRandomOrder()->first() ?? User::factory()->create();

        return [
            'id' => Str::uuid(),
            'notifiable_type' => User::class,
            'notifiable_id' => $user->id,
            'type' => $this->faker->randomElement(['item_created', 'item_updated', 'item_deleted']),
            'data' => [
                'item_id' => $this->faker->numberBetween(1, 1000),
                'item_name' => $this->faker->words(3, true),
                'action' => $this->faker->sentence(),
            ],
            'read_at' => null,
        ];
    }

    /**
     * Indicate that the notification should be marked as read.
     */
    public function read(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'read_at' => now(),
            ];
        });
    }

    /**
     * Indicate that the notification should be unread.
     */
    public function unread(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'read_at' => null,
            ];
        });
    }

    /**
     * Set a specific notification type.
     */
    public function type(string $type): static
    {
        return $this->state(function (array $attributes) use ($type) {
            return [
                'type' => $type,
            ];
        });
    }
}
