<?php

namespace Database\Factories;

use App\Models\Wager;
use App\Models\WagerPurchase;
use Illuminate\Database\Eloquent\Factories\Factory;

class WagerPurchaseFactory extends Factory
{
    protected $model = WagerPurchase::class;

    public function definition()
    {
        return [
            'wager_id' => fn () => Wager::factory()->create(),
            'buying_price' => $this->faker->numberBetween(1, 1000) / 100,
            'bought_at' => $this->faker->dateTime,
        ];
    }
}
