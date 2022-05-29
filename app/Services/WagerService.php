<?php

namespace App\Services;

use App\Http\Requests\BuyWagerRequest;
use App\Models\Wager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class WagerService
{
    public function buy(BuyWagerRequest $request, Wager $wager): Model
    {
        $purchasedWager = $wager->purchases()->create([
            'buying_price' => $request->input('buying_price'),
            'bought_at' => Carbon::now(),
        ]);

        $currentSellingPrice = $wager->total_wager_value - $request->input('buying_price');

        $wager->update([
            'amount_sold' => $wager->amount_sold + 1,
            'current_selling_price' => $currentSellingPrice,
            'percentage_sold' => ($currentSellingPrice * 100) / $wager->total_wager_value,
        ]);

        return $purchasedWager;
    }
}
