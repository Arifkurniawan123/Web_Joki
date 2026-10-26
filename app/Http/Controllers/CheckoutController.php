<?php

namespace App\Http\Controllers;


use App\Validation\CheckoutValidation;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('info', 'Keranjang masih kosong.');
        }

        $total = collect($cart)->sum('price');
        $title = 'Checkout';

        return view('public.checkout', compact('cart', 'total', 'title'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('info', 'Keranjang masih kosong.');
        }

        // PAKAI VALIDASI BARU
        $request->validate(
            CheckoutValidation::rules(),
            CheckoutValidation::messages()
        );

        $total = collect($cart)->sum('price');

        // Bikin order (header)
        $order = Order::create([
            'order_code'    => Order::generateOrderCode(),
            'customer_name' => $request->customer_name,
            'wa_number'     => $request->wa_number,
            'notes'         => $request->notes,
            'total_price'   => $total,
            'status'        => 'pending',
        ]);

        // Bikin order_items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'service_id' => $item['service_id'],
                'game_id'    => $item['game_id'],
                'price'      => $item['price'],
            ]);
        }

        // Kosongin cart
        session()->forget('cart');

        return redirect()->route('payment.show', $order->order_code)
            ->with('success', 'Order berhasil dibuat. Silakan lakukan pembayaran.');
    }
}
