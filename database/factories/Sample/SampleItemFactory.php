<?php

namespace Database\Factories\Sample;

use App\Enums\Sample\SampleItemEnumerate;
use App\Models\Sample\SampleItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SampleItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SampleItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userFactory = User::factory();

        return [
            'id' => Str::uuid(),
            'user_id' => $userFactory,
            'string' => $this->faker->city(),
            'email' => $this->faker->email(),
            'color' => $this->faker->hexColor(),
            'integer' => $this->faker->randomNumber(0),
            'decimal' => $this->faker->randomFloat(2, 0, 100),
            'npwp' => $this->faker->numerify('##.###.###.#-###.###'),
            'datetime' => $this->faker->dateTime(),
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'ip_address' => $this->faker->ipv4(),
            'boolean' => $this->faker->boolean(),
            'enumerate' => $this->faker->randomElement(SampleItemEnumerate::values()),
            'text' => $this->faker->text(),
            'markdown_text' => $this->faker->text(),
            'wysiwyg' => $this->faker->text(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'created_by' => User::inRandomOrder()->first()?->id,
            'updated_by' => User::inRandomOrder()->first()?->id,
        ];
    }
}
