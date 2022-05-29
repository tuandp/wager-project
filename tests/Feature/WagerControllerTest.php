<?php

namespace Tests\Feature;

use App\Models\Wager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Tests\TestCase;

class WagerControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow(new Carbon('2022-05-28 00:00:00'));
    }

    public function test_create_a_wager()
    {
        $response = $this->json('POST', '/wagers', [
            'total_wager_value' => 1000_00,
            'odds' => 10,
            'selling_percentage' => 99,
            'selling_price' => 11.11,
        ]);

        $response->assertStatus(HttpResponse::HTTP_CREATED);
        $wager = Wager::query()->find(data_get($response->json(), 'id'));

        $response->assertJson([
            'id' => $wager->id,
            'total_wager_value' => 1000_00,
            'odds' => 10,
            'amount_sold' => null,
            'selling_price' => 11.11,
            'selling_percentage' => 99,
            'percentage_sold' => 0,
            'current_selling_price' => 11.11,
            'placed_at' => '2022-05-28 00:00:00',
        ]);

        $this->assertDatabaseHas('wagers', [
            'id' => data_get($response->json(), 'id'),
            'total_wager_value' => 1000_00,
            'odds' => 10,
            'selling_percentage' => 99,
            'selling_price' => 11.11,
            'amount_sold' => null,
            'placed_at' => '2022-05-28 00:00:00',
        ]);
    }

    public function test_create_a_wager_with_invalid_selling_price()
    {
        $response = $this->json('POST', '/wagers', [
            'total_wager_value' => 1000_00,
            'odds' => 10,
            'selling_percentage' => 99,
            'selling_price' => 10.01,
        ]);

        $response->assertStatus(HttpResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(['error' => 'The selling price field is invalid.']);
    }

    public function test_get_list_of_wagers()
    {
        Wager::factory()->count(5)->create();

        $response = $this->json('GET', '/wagers?page=1&limit=5')
            ->assertStatus(JsonResponse::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'total_wager_value',
                        'odds',
                        'selling_percentage',
                        'selling_price',
                        'amount_sold',
                        'placed_at',
                    ],
                ],
            ]);
        $this->assertEquals(5, count(data_get($response->json(), 'data')));

        $response = $this->json('GET', '/wagers?page=2&limit=5')
            ->assertStatus(JsonResponse::HTTP_OK);
        $this->assertEquals(0, count(data_get($response->json(), 'data')));
    }
}
