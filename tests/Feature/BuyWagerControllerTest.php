<?php

namespace Tests\Feature;

use App\Models\Wager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Tests\TestCase;

class BuyWagerControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow(new Carbon('2022-05-28 00:00:00'));
    }

    public function test_buy_a_wager_with_invalid_data()
    {
        $wager = Wager::factory()->create([
            'total_wager_value' => 1000_00,
            'odds' => 10,
            'selling_percentage' => 99,
            'selling_price' => 11.11,
        ]);

        $this->json('POST', '/buy/' . $wager->id)
            ->assertJson(['error' => 'The buying price field is required.']);

        $this->json('POST', '/buy/' . $wager->id, [
            'buying_price' => 100,
        ])->assertJson(['error' => 'The buying price field is invalid.']);
    }

    public function test_buy_a_wager()
    {
        $wager = Wager::factory()->create([
            'amount_sold' => 1,
            'percentage_sold' => 1,
            'total_wager_value' => 1000_00,
            'odds' => 10,
            'selling_percentage' => 99,
            'selling_price' => 20,
            'current_selling_price' => 11,
        ]);

        $this->json('POST', '/buy/' . $wager->id, [
            'buying_price' => 10,
        ])
            ->assertStatus(HttpResponse::HTTP_CREATED)
            ->assertJsonFragment([
                'buying_price' => 10,
                'wager_id' => $wager->id,
                'bought_at' => '2022-05-28 00:00:00',
            ])
            ->assertJsonStructure([
                'id',
                'wager_id',
                'buying_price',
                'bought_at',
            ]);

        $this->assertDatabaseHas('wagers', [
            'id' => $wager->id,
            'amount_sold' => 2,
            'current_selling_price' => 99990.00,
            'percentage_sold' => 100,
        ]);
    }
}
