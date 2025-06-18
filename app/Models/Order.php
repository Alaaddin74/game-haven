<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'total_amount',      // tambahkan
        'total_price',       // tambahkan
        'snap_token',
        'payment_method',    // jika di‑mass assign
        'shipping_address',  // jika di‑mass assign
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loyaltyTransactions()
{
    return $this->hasMany(LoyaltyTransaction::class);
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
