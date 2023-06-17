<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $closedOrders = Order::query()->where('status', 'closed')->count();
        $paidOrders = Order::query()->where('status', 'paid')->count();
        $pendingOrders = Order::query()->where('status', 'pending')->count();
        $canceledOrders = Order::query()->where('status', 'canceled')->count();

        $filterByStatus = $request->status ?? '';

        $filterByDate = $request->date ?? '';

        $orderQuery = Order::query();
        if ($filterByStatus != '') {
            $orderQuery->where('status', $filterByStatus);
        }

        if ($filterByDate != '') {
            $orderQuery->where('date', 'LIKE', $filterByDate);
        }

        $orders = $orderQuery->paginate(10);
        return view('orders.index', compact('orders', 'closedOrders', 'paidOrders', 'pendingOrders', 'canceledOrders', 'filterByStatus', 'filterByDate'));
    }

    public function minhasEncomendas(Request $request): View
    {
        $orders = $request->user()->customer->orders;
        return view('orders.minhas')->with('orders', $orders);
    }
}
