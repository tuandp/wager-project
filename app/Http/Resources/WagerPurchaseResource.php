<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WagerPurchaseResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'wager_id' => $this->whenLoaded('wager', fn () => $this->wager->id),
            'buying_price' => $this->buying_price,
            'bought_at' => $this->bought_at->format('Y-m-d H:i:s'),
        ];
    }
}
