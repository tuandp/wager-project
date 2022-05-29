<?php

namespace Database\Factories;

use App\Models\Wager;
use Illuminate\Database\Eloquent\Factories\Factory;

class WagerFactory extends Factory
{
    protected $model = Wager::class;

    public function definition()
    {
        return [
            'total_wager_value' => $this->faker->numberBetween(10, 50) * 100,
            'odds' => $this->faker->numberBetween(10, 100),
            'amount_sold' => $this->faker->numberBetween(1, 1000),
            'selling_price' => $this->faker->numberBetween(1, 1000) / 100,
            'selling_percentage' => $this->faker->numberBetween(1, 100),
            'percentage_sold' => $this->faker->numberBetween(1, 100),
            'current_selling_price' => $this->faker->numberBetween(1, 1000) / 100,
            'placed_at' => $this->faker->dateTime,
        ];
    }
}
