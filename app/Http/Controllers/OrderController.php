<?php

namespace App\Http\Controllers;

use App\Models\LoyaltyTransaction;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')
                       ->orderBy('created_at','desc')
                       ->get();

        return view('admin.histori_transaksi', compact('orders'));
    }

    // Mengubah status order
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,cancelled,refunded',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')
                         ->with('success', 'Status transaksi berhasil diubah.');
    }
    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function cart()
{
    $order = Order::with('items.product') // load items dan relasinya
        ->where('user_id', auth()->id())
        ->where('status', 'pending')
        ->first();

    if ($order && $order->items->count() > 0 && !$order->snap_token) {
        $order = $order->fresh(); // force refresh dari DB
        $this->generateSnapToken($order->load('items.product'));
    }

    return view('customer.cart', compact('order'));
}

    /**
     * Menambahkan produk ke keranjang (order dengan status pending).
     */
    public function addToCart($id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($id);

        $order = Order::firstOrCreate(
            ['user_id' => $user->id, 'status' => 'pending'],
            ['total_price' => 0, 'total_amount' => 0, 'shipping_address' => '']
        );

        $existingItem = OrderItem::where('order_id', $order->id)
            ->where('product_id', $product->id)
            ->first();

        if ($existingItem) {
            $existingItem->increment('quantity');
        } else {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price_at_purchase' => $product->price,
            ]);
        }

        $this->generateSnapToken($order->load('items'));

        return redirect()->route('customer.cart')->with('success', "{$product->name} berhasil ditambahkan ke keranjang.");
    }

    /**
     * Menghapus item dari keranjang.
     */
    public function removeItem(OrderItem $item)
    {
        $order = $item->order;

        $item->delete();

        // Regenerate Snap Token
        if ($order->items()->count() > 0) {
            $this->generateSnapToken($order);
        } else {
            // Kosongkan snap_token kalau tidak ada item lagi
            $order->snap_token = null;
            $order->save();
        }

        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    /**
     * Melakukan checkout keranjang.
     */
    public function checkout()
    {
        $order = Order::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->with('items')
            ->first();

        if (!$order || $order->items->isEmpty()) {
            return back()->with('error', 'Keranjang kamu kosong.');
        }

        $order->status = 'pending'; // setelah checkout, status jadi 'paid'
        $order->save();

        return redirect()->route('customer.dashboard')->with('success', 'Pesanan berhasil dibuat.');
    }

    private function generateSnapToken($order)
    {
        
        // Hitung total dari seluruh item di order
        $totalPrice  = $order->items->sum(fn($item) => $item->quantity * $item->price_at_purchase);
        $totalAmount = $order->items->sum('quantity');

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $order->id.uniqid(),
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            
            $order->snap_token = $snapToken;
            $order->total_price = $totalPrice;
            $order->total_amount = $totalAmount;
            $order->save();
        } catch (\Exception $e) {
            logger()->error('Midtrans Snap Error: ' . $e->getMessage());
        }
    }


    public function success(Order $order)
    {

        // if ($order->status !== 'paid') {
        //     return redirect()->route('customer.cart')->with('error', 'Pesanan belum dibayar.');
        // }
        $order->status = 'paid'; // Update status order menjadi 'paid'


        $order->save();
        $order->processLoyaltyPoints();


        return view('customer.success');
    }


//     public function processLoyaltyPoints()
// {
//     $user = Auth::user();
//     $order = Order::where('user_id', $user->id)
//         ->where('status', 'paid')
//         ->latest()
//         ->first();

//     if (!$order) {
//         return redirect()->route('customer.cart')->with('error', 'Tidak ada pesanan yang dibayar.');
//     }

//     // Hitung poin berdasarkan total harga order
//     $points = (int) ($order->total_price / 1000); // 1 poin untuk setiap Rp 1000

//     // Simpan transaksi poin loyalitas
//     LoyaltyTransaction::create([
//         'user_id' => $user->id,
//         'order_id' => $order->id,
//         'points' => $points,
//         'type' => 'earn',
//         'description' => "Earned {$points} points from order #{$order->id}",
//     ]);

//     // return redirect()->route('customer.dashboard')->with('success', "Poin {$points} berhasil ditambahkan ke akun kamu.");
// }

}
