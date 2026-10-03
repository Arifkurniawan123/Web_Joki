<?php

namespace App\Http\Controllers;   // ← INI YANG BEDA

use App\Models\Order;
use App\Models\Post;
use App\Models\Service;
use App\Models\Game;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders'    => Order::count(),
            'pending_orders'  => Order::where('status', Order::STATUS_PENDING)->count(),
            'process_orders'  => Order::where('status', Order::STATUS_PROCESS)->count(),
            'done_orders'     => Order::where('status', Order::STATUS_DONE)->count(),
            'total_revenue'   => Order::where('status', Order::STATUS_DONE)->sum('price'),
            'total_games'     => Game::count(),
            'total_services'  => Service::count(),
            'total_posts'     => Post::count(),
        ];

        $recentOrders = Order::orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact('stats', 'recentOrders'));
    }
}
