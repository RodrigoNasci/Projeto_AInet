<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\OrderItem;
use App\Models\TshirtImage;

class CartController extends Controller
{
    public function show(): View
    {
        $cart = session('cart', []);
        return view('cart.show', compact('cart'));
    }

    public function addToCart(TshirtImage $tshirt_image, Request $request) //: RedirectResponse
    {
        // Só o clientes e anónimos podem adicionar ao carrinho
        // Fazer as verificações depois com policies ou outra cena qualquer
        $cart = session('cart', []);
        $key = $tshirt_image->id . '-' . $request->color_code . '-' . $request->size;
        if (array_key_exists($key, $cart)) {
            $cart[$key]['qty'] += $request->qty;
            $request->session()->put('cart', $cart);
            $url = route('cart.show', ['cart' => $cart]);
            $htmlMessage = "Adicionado mais uma unidade do Item ao <a href='$url'>carrinho</a>";
        } else {
            // Falta fazer a cena dos preços...
            $cart[$key] = [
                'tshirt_image_id' => $tshirt_image->id,
                'color_code' => $request->color_code,
                'size' => $request->size,
                'qty' => $request->qty,
                'unit_price' => null,
                'sub_total' => null * $request->qty
            ];
            $url = route('cart.show', ['cart' => $cart]);
            $request->session()->put('cart', $cart);
            $htmlMessage = "Item adicionado ao <a href='$url'>carrinho</a>";
        }
        $alertType = 'success';
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
}
