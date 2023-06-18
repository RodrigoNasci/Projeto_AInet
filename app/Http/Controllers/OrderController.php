<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $closedOrders = Order::query()->where('status', 'closed')->count();
        $paidOrders = Order::query()->where('status', 'paid')->count();
        $pendingOrders = Order::query()->where('status', 'pending')->count();
        $canceledOrders = Order::query()->where('status', 'canceled')->count();

        $filterByYear = $request->year ?? '';
        $filterByStatus = $request->status ?? '';
        $filterByDate = $request->date ?? '';
        $filterByCustomer = $request->customer ?? '';

        //Query para o gráfico de encomendas fechadas por mês
        $closedOrdersPerMonthQuery = Order::selectRaw('COUNT(*) as count, MONTH(date) as month')
            ->where('status', 'closed')
            ->groupBy('month')
            ->orderBy('month');

        //Query para a tabela de encomendas
        $orderQuery = Order::query();

        //Filtrar por cliente (tabela)
        if ($filterByCustomer != '') {
            $customerIds = User::where('name', 'like', "%$filterByCustomer%")->pluck('id');
            $orderQuery->whereIntegerInRaw('customer_id', $customerIds);
        }

        //Filtrar por status (tabela)
        if ($filterByStatus != '') {
            $orderQuery->where('status', 'LIKE', $filterByStatus);
        }

        //Filtrar por data (tabela)
        if ($filterByDate != '') {
            $orderQuery->where('date', 'LIKE', $filterByDate);
        }

        //Filtrar por ano (query para o gráfico)
        if ($filterByYear != '') {
            $closedOrdersPerMonthQuery->whereYear('date', $filterByYear);
        }

        //Paginação (tabela)
        $orders = $orderQuery->paginate(15);

        //Array com o número de encomendas fechadas por mês
        $closedOrdersPerMonth = $closedOrdersPerMonthQuery->pluck('count', 'month')->toArray();
        $closedOrdersPerMonth = array_replace(array_fill(1, 12, 0), $closedOrdersPerMonth);
        $closedOrdersPerMonth = array_values($closedOrdersPerMonth);

        //converter para json (usado no gráfico (js))
        $jsonClosedOrdersPerMonth = json_encode($closedOrdersPerMonth);

        return view('orders.index', compact('orders', 'closedOrders', 'paidOrders', 'pendingOrders', 'canceledOrders', 'filterByStatus', 'filterByDate', 'filterByCustomer', 'filterByYear', 'jsonClosedOrdersPerMonth'));
    }

    public function show(Order $order): View
    {
        return view('orders.show', compact('order'));
    }

    public function minhasEncomendas(Request $request): View
    {
        $orders = $request->user()->customer->orders;
        return view('orders.minhas')->with('orders', $orders);
    }

    public function getFatura(Request $request)
    {
        $receipt_url = $request->receipt_url;
        // Verifica se existe o nome do ficheiro na base de dados
        if ($receipt_url == null) {
            abort(404);
        }

        $path = storage_path('app/pdf_receipts/' . $receipt_url);
        // Verifica se o ficheiro existe na pasta storage/app/pdf_receipts
        if (!File::exists($path)) {
            abort(404);
        }

        cache()->forget($path);
        $response = response()->file($path);
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');
        return $response;
    }
}
