<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderStatusController extends Controller
{
    public function index()
    {
        $title = 'Cek Status Order';
        return view('public.cek-order', compact('title'));
    }

    public function show($order_code)
    {
        $order = Order::with('items.service', 'items.game')
            ->where('order_code', $order_code)
            ->first();

        $title = 'Cek Status Order';

        if (!$order) {
            return redirect()->route('order.status')
                ->with('error', 'Kode order tidak ditemukan. Periksa kembali.');
        }

        return view('public.cek-order', compact('title', 'order'));
    }
}