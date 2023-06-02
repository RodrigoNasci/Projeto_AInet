<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\TshirtImage;
use App\Models\Category;
use App\Models\Color;
use App\Models\OrderItem;
use App\Models\Order;

class TshirtImageController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::all();

        $filterByCategory = $request->category ?? '';

        $filterByName = $request->name ?? '';

        $filterByDescription = $request->description ?? '';

        // Apenas imagens que fazem parte do catálogo da loja (não são de clientes)
        $tshirtImageQuery = TshirtImage::query()->whereNull('customer_id');

        if ($filterByCategory !== '') {
            $categoryIds = Category::where('name', 'like', "%$filterByCategory%")->pluck('id');
            $tshirtImageQuery->whereIntegerInRaw('category_id', $categoryIds);
        }

        if ($filterByName !== '') {
            $tshirtImageQuery->where('name', 'like', "%$filterByName%");
        }

        if ($filterByDescription !== '') {
            $tshirtImageQuery->where('description', 'like', "%$filterByDescription%");
        }
        $tshirt_images = $tshirtImageQuery->paginate(10);

        // Caso seja necessário fazer “eager loading” dos relacionamentos (em princípio não é necessário)
        //$tshirt_images = $tshirt_images->with('nomeDaRelação', 'nomeDaRelação', '...')->paginate(10);

        return view('tshirt_images.index', compact('tshirt_images', 'categories', 'filterByCategory', 'filterByName', 'filterByDescription'));
    }


    public function show(TshirtImage $tshirt_image): View
    {
        $colors = Color::all();
        return view('tshirt_images.show', compact('tshirt_image', 'colors'));
    }
}
