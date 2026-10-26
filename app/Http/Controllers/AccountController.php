<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Validation\AccountValidation;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function show($order_code)
    {
        $order = Order::with('items.service', 'items.game')
            ->where('order_code', $order_code)
            ->firstOrFail();

        if ($order->status === Order::STATUS_PENDING) {
            return redirect()->route('payment.show', $order->order_code);
        }
        if (
            $order->status === Order::STATUS_AWAITING_VERIFY ||
            in_array($order->status, [Order::STATUS_PROCESS, Order::STATUS_DONE])
        ) {
            return redirect()->route('invoice.show', $order->order_code);
        }

        $itemsByGame = $order->items->groupBy('game_id');

        $title = 'Isi Data Akun';
        return view('public.account', compact('order', 'itemsByGame', 'title'));
    }

    public function store(Request $request, $order_code)
    {
        $order = Order::with('items')->where('order_code', $order_code)->firstOrFail();

        if ($order->status !== Order::STATUS_PAID) {
            return redirect()->route('payment.show', $order->order_code);
        }


        $request->validate(
            AccountValidation::rules(),
            AccountValidation::messages()
        );

        foreach ($order->items as $item) {
            $gameId = $item->game_id;

            if (isset($request->game_email[$gameId])) {
                $item->update([
                    'game_email'    => $request->game_email[$gameId] ?? null,
                    'game_password' => $request->game_password[$gameId] ?? null,
                    'game_server'   => $request->game_server[$gameId] ?? null,
                ]);
            }
        }

        $order->update(['status' => Order::STATUS_AWAITING_VERIFY]);

        return redirect()->route('invoice.show', $order->order_code)
            ->with('success', 'Data akun berhasil disimpan.');
    }
}
