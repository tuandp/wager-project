<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wager extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'total_wager_value',
        'odds',
        'amount_sold',
        'selling_price',
        'selling_percentage',
        'percentage_sold',
        'current_selling_price',
        'placed_at',
    ];

    protected $casts = [
        'placed_at' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function purchases(): HasMany
    {
        return $this->hasMany(WagerPurchase::class, 'wager_id');
    }
}
