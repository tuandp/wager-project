<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WagerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'total_wager_value' => $this->total_wager_value,
            'odds' => $this->odds,
            'amount_sold' => $this->amount_sold,
            'selling_price' => $this->selling_price,
            'selling_percentage' => $this->selling_percentage,
            'percentage_sold' => $this->percentage_sold,
            'current_selling_price' => $this->current_selling_price,
            'placed_at' => $this->placed_at->format('Y-m-d H:i:s'),
        ];
    }
}
