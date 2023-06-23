<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\OrderRequest;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $filterByName = $request->name ?? '';
        $filterByYear = $request->year ?? '';

        $year = 2022;

        //Query para o gráfico de categorias mais vendidas por mês
        $bestSellingCategoriesPerMonth = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('tshirt_images', 'order_items.tshirt_image_id', '=', 'tshirt_images.id')
            ->join('categories', 'tshirt_images.category_id', '=', 'categories.id')
            ->select('categories.name as category_name', DB::raw('SUM(order_items.qty) as total_sold'))
            ->whereYear('orders.date', $year)
            ->whereIn('orders.status', ['closed', 'paid'])
            ->groupBy('categories.name')
            ->orderByRaw('total_sold DESC')
            ->take(10)
            ->get();

        //Query para obter a proporção de categorias nas imagens
        $tshirt_imagesPerCategory = Category::leftJoin('tshirt_images', 'categories.id', '=', 'tshirt_images.category_id')
            ->select('categories.name', DB::raw('COUNT(tshirt_images.id) as tshirt_count'))
            ->groupBy('categories.name')
            ->orderByRaw('tshirt_count DESC')
            ->take(10)
            ->get();

        //Query para a tabela de encomendas
        $categoryQuery = Category::query();

        //Filtrar por nome
        if ($filterByName != '') {
            $categoryQuery->where('name', 'LIKE', "%$filterByName%");
        }

        //Paginação (tabela)
        $categories = $categoryQuery->paginate(5);

        return view('categories.index', compact('categories', 'filterByName', 'filterByYear', 'bestSellingCategoriesPerMonth', 'tshirt_imagesPerCategory'));
    }
}
