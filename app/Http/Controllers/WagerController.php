<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWagerRequest;
use App\Http\Requests\GetWagerRequest;
use App\Http\Resources\WagerResource;
use App\Models\Wager;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class WagerController
{
    public function index(GetWagerRequest $request): JsonResponse
    {
        $wagers = Wager::query()
            ->paginate($request->input('limit', 10));

        return new JsonResponse(
            WagerResource::collection($wagers)->resource,
            HttpResponse::HTTP_OK
        );
    }

    public function store(CreateWagerRequest $request): JsonResponse
    {
        $wager = Wager::query()->create($request->all());

        return new JsonResponse(new WagerResource($wager), HttpResponse::HTTP_CREATED);
    }
}
