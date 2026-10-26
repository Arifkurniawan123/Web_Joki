<?php

namespace App\Http\Controllers;

use App\Models\Order;

class PaymentController extends Controller
{
    public function show($order_code)
    {
        $order = Order::where('order_code', $order_code)->firstOrFail();

        // Redirect kalau sudah lewat tahap pembayaran
        if ($order->status === Order::STATUS_PAID) {
            return redirect()->route('account.show', $order->order_code);
        }
        if ($order->status === Order::STATUS_AWAITING_VERIFY) {
            return redirect()->route('invoice.show', $order->order_code);
        }
        if (in_array($order->status, [Order::STATUS_PROCESS, Order::STATUS_DONE])) {
            return redirect()->route('invoice.show', $order->order_code);
        }

        $title = 'Pembayaran';
        return view('public.payment', compact('order', 'title'));
    }

    public function confirm($order_code)
    {
        $order = Order::where('order_code', $order_code)->firstOrFail();

        if ($order->status !== Order::STATUS_PENDING) {
            return redirect()->route('payment.show', $order->order_code);
        }

        $order->update(['status' => Order::STATUS_PAID]);

        return redirect()->route('account.show', $order->order_code)
            ->with('success', 'Terima kasih! Silakan isi data akun game kamu.');
    }
}