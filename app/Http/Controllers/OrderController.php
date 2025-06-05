<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function cart()
    {
        $order = Order::where('user_id', auth()->id())
                    ->where('status', 'pending')
                    ->with('items.product')
                    ->first();

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
            ['user_id' => $user->id, 'status' => 'pending']
        );

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'unit_price' => $product->price,
        ]);

        return redirect()->route('customer.cart')->with('success', "{$product->name} berhasil ditambahkan ke keranjang.");
    }

    /**
     * Menghapus item dari keranjang.
     */
    public function removeItem(OrderItem $item)
    {
        $item->delete();
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

        $order->status = 'paid'; // setelah checkout, status jadi 'paid'
        $order->save();

        return redirect()->route('customer.dashboard')->with('success', 'Pesanan berhasil dibuat.');
    }
}
