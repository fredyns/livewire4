<?php

namespace Database\Factories;

use App\Models\NotificationPreference;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NotificationPreference>
 */
class NotificationPreferenceFactory extends Factory
{
    protected $model = NotificationPreference::class;

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
            'user_id' => $user->id,
            'type' => $this->faker->randomElement(['item_created', 'item_updated', 'item_deleted']),
            'channel' => $this->faker->randomElement(['in-app', 'email']),
            'enabled' => $this->faker->boolean(80), // 80% chance of being enabled
            'quiet_hours_start' => null,
            'quiet_hours_end' => null,
        ];
    }

    /**
     * Indicate that the preference should be enabled.
     */
    public function enabled(): static
    {
        return $this->state(fn (array $attributes) => ['enabled' => true]);
    }

    /**
     * Indicate that the preference should be disabled.
     */
    public function disabled(): static
    {
        return $this->state(fn (array $attributes) => ['enabled' => false]);
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

    /**
     * Set a specific channel.
     */
    public function channel(string $channel): static
    {
        return $this->state(function (array $attributes) use ($channel) {
            return [
                'channel' => $channel,
            ];
        });
    }

    /**
     * Set quiet hours.
     */
    public function withQuietHours(string $start, string $end): static
    {
        return $this->state(function (array $attributes) use ($start, $end) {
            return [
                'quiet_hours_start' => $start,
                'quiet_hours_end' => $end,
            ];
        });
    }
}
