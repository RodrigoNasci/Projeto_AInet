<?php

namespace App\Http\Controllers;

use App\Http\Requests\TshirtImageRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\TshirtImage;
use App\Models\Category;
use App\Models\Color;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class TshirtImageController extends Controller
{
    public function index(Request $request): View
    {
        // Apenas imagens que fazem parte do catálogo da loja (não são de clientes)
        $tshirtImageQuery = TshirtImage::query()->whereNull('customer_id');

        $tshirt_images = $tshirtImageQuery->paginate(12);

        return view('tshirt_images.index', compact('tshirt_images'));
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

    public function destroy()
    {
    }
}
