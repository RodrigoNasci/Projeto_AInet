<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\TshirtImage;
use App\Models\Category;

class TshirtImageController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::all();

        $filterByCategory = $request->category ?? '';

        $filterByName = $request->name ?? '';

        $filterByDescription = $request->description ?? '';

        // Apenas mostra as imagens que são do catálogo da loja
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
        $tshirtimages = $tshirtImageQuery->paginate(10);
        //$tshirtimages = $tshirtimages->with('departamentoRef', 'user')->paginate(10);

        return view('tshirtimages.index', compact('tshirtimages', 'categories', 'filterByCategory', 'filterByName', 'filterByDescription'));
    }
}
