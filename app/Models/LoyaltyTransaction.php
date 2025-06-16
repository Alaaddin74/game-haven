<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoyaltyTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'points',
        'type',
        'description',
    ];

    /**
     * Get the user associated with the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order associated with the transaction.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }


public function processLoyaltyPoints()
{
    // Make sure items are loaded
    $this->loadMissing('items');

    // Hitung total harga order
    $total = $this->items->sum(function ($item) {
        return $item->price_at_purchase * $item->quantity;
    });

    // Hitung poin (1 poin tiap Rp1000)
    $points = (int) ($total / 1000);

    // Simpan transaksi poin loyalitas
    if ($points > 0) {
        LoyaltyTransaction::create([
            'user_id' => $this->user_id,
            'order_id' => $this->id,
            'points' => $points,
            'type' => 'earn',
            'description' => "Earned {$points} points from order #{$this->id}",
        ]);
    }
}
}
