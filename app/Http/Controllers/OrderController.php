<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['items.service', 'items.game'])
            ->orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->get();
        $title  = 'Data Order';

        return view('admin.order.index', compact('orders', 'title'));
    }

    public function show(Order $order)
    {
        $order->load(['items.service', 'items.game']);
        $title = 'Detail Order';

        return view('admin.order.show', compact('order', 'title'));
    }
    public function update(Request $request, Order $order)
    {
        $order->update([
            'status' => $request->status,
        ]);

        // Auto hapus kredensial kalau order selesai
        if ($request->status === 'done') {
            foreach ($order->items as $item) {
                $item->update([
                    'game_email'    => null,
                    'game_password' => null,
                ]);
            }
        }

        return redirect()
            ->route('admin.order.show', $order)
            ->with('success', 'Status berhasil diupdate.');
    }
}
