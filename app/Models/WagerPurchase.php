<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WagerPurchase extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'wager_id',
        'buying_price',
        'bought_at',
    ];

    protected $casts = [
        'bought_at' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function wager()
    {
        return $this->belongsTo(Wager::class);
    }
}
