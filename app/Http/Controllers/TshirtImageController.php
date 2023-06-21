<?php

namespace App\Http\Controllers;

use App\Http\Requests\TshirtImageRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\TshirtImage;
use App\Models\Category;
use App\Models\Color;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TshirtImageController extends Controller
{
    public function index(Request $request): View
    {
        $clientImages = TshirtImage::query()->whereNotNull('customer_id')->count();
        $catalogueImages = TshirtImage::query()->whereNull('customer_id')->count();
        $totalImages = $clientImages + $catalogueImages;

        $categories = Category::all();

        $filterByYear = $request->year ?? '';

        $filterByCategory = $request->category ?? '';

        $filterByName = $request->name ?? '';

        $filterByDescription = $request->description ?? '';

        $year = $request->input('year', '');

        // Top 10 T-shirts mais vendidas de sempre (inclui imagens de clientes/catálogo e imagens que já não estão disponíveis para venda)
        $jsonMostSoldTshirtImagesPerMonth = DB::table('tshirt_images')
            ->join('order_items', 'tshirt_images.id', '=', 'order_items.tshirt_image_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->select('tshirt_images.name', DB::raw('SUM(order_items.qty) as total_quantity_sold'))
            ->where('orders.status', '=', 'closed')
            ->when($filterByYear, function ($query, $filterByYear) {
                return $query->whereYear('orders.date', $filterByYear);
            })
            ->groupBy('tshirt_images.id', 'tshirt_images.name')
            ->orderByDesc('total_quantity_sold')
            ->limit(10)
            ->get();

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

        $tshirt_images = $tshirtImageQuery->paginate(15);

        return view('tshirt_images.index', compact('tshirt_images', 'totalImages', 'clientImages', 'catalogueImages', 'categories', 'filterByCategory', 'filterByName', 'filterByDescription', 'filterByYear', 'jsonMostSoldTshirtImagesPerMonth'));
    }

    public function catalogo(Request $request): View
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
        $tshirt_images = $tshirtImageQuery->paginate(12);

        // Caso seja necessário fazer “eager loading” dos relacionamentos (em princípio não é necessário)
        //$tshirt_images = $tshirt_images->with('nomeDaRelação', 'nomeDaRelação', '...')->paginate(10);

        return view('tshirt_images.catalogo', compact('tshirt_images', 'categories', 'filterByCategory', 'filterByName', 'filterByDescription'));
    }

    public function edit(TshirtImage $tshirt_image)
    {
        $categories = Category::all();
        return view('tshirt_images.edit', compact('tshirt_image', 'categories'));
    }


    public function show(TshirtImage $tshirt_image): View
    {
        $categories = Category::all();
        return view('tshirt_images.show', compact('tshirt_image', 'categories'));
    }

    public function showProduto(TshirtImage $tshirt_image): View
    {
        $colors = Color::all();
        return view('tshirt_images.produto', compact('tshirt_image', 'colors'));
    }

    public function minhasTshirtImages(Request $request): View
    {
        // Só um utilizador registado é que pode aceder a esta página
        // Redirecionar para a página de login ou register
        // (Utilizei um middleware para fazer isto só por enquanto)

        // Apenas mostra as tshirts do user autenticado.
        // Ainda faltam verificações para o caso de o user não ser um cliente
        // Porque se não as relações dão null.
        $tshirt_images = $request->user()->customer->tshirtImages;
        return view('tshirt_images.minhas')->with('tshirt_images', $tshirt_images);
    }

    public function getPrivateTshirtImage(Request $request)
    {
        $image_url = $request->image_url;
        // Verifica se existe o nome do ficheiro na base de dados
        if ($image_url == null) {
            abort(404);
        }

        $path = storage_path('app/tshirt_images_private/' . $image_url);
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

    public function update(TshirtImageRequest $request, TshirtImage $tshirt_image): RedirectResponse
    {
        $tshirt_image->update($request->validated());
        $url = route('tshirt_images.show', ['tshirt_image' => $tshirt_image]);
        $htmlMessage = "Imagem de Tshirt <a href='$url'>#{$tshirt_image->id}</a>
                        <strong>\"{$tshirt_image->name}\"</strong> foi alterada com sucesso!";
        return redirect()->route('tshirt_images.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    public function store(TshirtImageRequest $request): RedirectResponse
    {
        if ($request->user()->customer == null) {
            // O administrador não precisa de inserir o customer_id pois são imagens para o catálogo da loja
            $newTshirtImage = TshirtImage::create($request->validated());
        } else {
            $formData = $request->validated();
            // Cliente insere tshirt, tem que ter costumer_id mas com categoria null
            $tshirt_image = DB::transaction(function () use ($formData, $request) {
                $newTshirtImage = new TshirtImage();
                $newTshirtImage->customer_id = $request->user()->customer->id;
                $newTshirtImage->description = $formData['description'];
                $newTshirtImage->name = $formData['name'];
                $path = $request->file_image->store('tshirt_images_private');
                $newTshirtImage->image_url = basename($path);
                $newTshirtImage->save();
                return $newTshirtImage;
            });
        }
        $htmlMessage = "Tshirt <strong>\"{$tshirt_image->name}\"</strong> foi criada com sucesso!";
        return redirect()->route('tshirt_images.minhas')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    public function destroy(TshirtImage $tshirt_image): RedirectResponse
    {
        try {
            $tshirt_image->delete();
            if ($tshirt_image->image_url && $tshirt_image->customer_id == null) {
                $path = storage_path('app/public/tshirt_images/' . $tshirt_image->image_url);
                File::delete($path);
            } elseif ($tshirt_image->image_url && $tshirt_image->customer_id != null) {
                $path = storage_path('app/tshirt_images_private/' . $tshirt_image->image_url);
                File::delete($path);
            }
            $htmlMessage = "Tshirt <strong>#{$tshirt_image->id} {$tshirt_image->name}</strong> foi eliminada com sucesso!";
            return redirect()->route('tshirt_images.index')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
        } catch (\Exception $error) {
            $url = route('tshirt_images.show', ['tshirt_image' => $tshirt_image]);
            $htmlMessage = "Não foi possível apagar a T-Shirt <a href='$url'>#{$tshirt_image->id}</a>
                        <strong>\"{$tshirt_image->name}\"</strong> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
}
