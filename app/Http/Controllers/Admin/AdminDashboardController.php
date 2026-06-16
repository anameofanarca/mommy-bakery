<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $revenue = Order::whereIn('status', ['paid', 'processing', 'completed'])->sum('total');
        $newOrders = Order::where('status', 'pending_payment')->count();
        $recentOrders = Order::with('items')->latest()->take(5)->get();
        $totalProducts = Product::where('is_active', true)->count();

        // Revenue 7 hari terakhir
        $revenueByDay = collect(range(6, 0))->map(function ($daysAgo) {
            $date = Carbon::now()->subDays($daysAgo);
            $total = Order::whereIn('status', ['paid', 'processing', 'completed'])
                ->whereDate('created_at', $date)
                ->sum('total');
            return [
                'date' => $date->format('d/m'),
                'total' => (int) $total,
            ];
        });

        // Jumlah per status
        $statusCounts = Order::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return view('admin.dashboard', compact(
            'totalOrders', 'revenue', 'newOrders',
            'recentOrders', 'totalProducts',
            'revenueByDay', 'statusCounts'
        ));
    }
}