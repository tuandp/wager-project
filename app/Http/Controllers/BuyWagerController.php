<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyWagerRequest;
use App\Http\Resources\WagerPurchaseResource;
use App\Models\Wager;
use App\Services\WagerService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class BuyWagerController
{
    public function buy(BuyWagerRequest $request, Wager $wager, WagerService $service): JsonResponse
    {
        $purchasedWager = $service->buy($request, $wager);

        return new JsonResponse(
            new WagerPurchaseResource($purchasedWager->load('wager')),
            HttpResponse::HTTP_CREATED
        );
    }
}
