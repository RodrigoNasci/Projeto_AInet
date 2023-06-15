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

    public function confirmar(Request $request): View
    {
        $customer = $request->user()->customer;
        $cart = session('cart', []);
        return view('cart.confirmar', compact('cart', 'customer'));
    }

    public function addToCart(TshirtImage $tshirt_image, Request $request): RedirectResponse
    {
        // Só o clientes e anónimos podem adicionar ao carrinho
        // Fazer as verificações depois com policies ou outra cena qualquer
        $orderItem = new OrderItem();
        $orderItem->tshirt_image_id = $tshirt_image->id;
        $orderItem->color_code = $request->code;
        $orderItem->size = $request->size;
        $orderItem->qty = $request->qty;
        $orderItem->unit_price = 10;
        $orderItem->sub_total = 10 * $request->qty;
        $cart = session('cart', []);
        $key = $tshirt_image->id . '-' . $request->code . '-' . $request->size;
        if (array_key_exists($key, $cart)) {
            $cart[$key]->qty += $request->qty;
            $cart[$key]->sub_total = 10 * $request->qty;
            $request->session()->put('cart', $cart);
            $url = route('cart.show', ['cart' => $cart]);
            $htmlMessage = "Adicionado mais uma unidade do Item ao <a href='$url'>carrinho</a>";
        } else {
            $cart[$key] = $orderItem;
            $url = route('cart.show', ['cart' => $cart]);
            $request->session()->put('cart', $cart);
            $htmlMessage = "Item adicionado ao <a href='$url'>carrinho</a>";
        }
        $alertType = 'success';
        return back()->withInput()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

    public function removeFromCart(Request $request): RedirectResponse
    {

        $item = json_decode($request->input('item'));

        $cart = session('cart', []);
        $key = $item->tshirt_image_id . '-' . $item->color_code . '-' . $item->size;

        if (array_key_exists($key, $cart)) {
            unset($cart[$key]);
        }
        $request->session()->put('cart', $cart);
        $htmlMessage = "Item removido do carrinho.";
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    public function editCartItem(Request $request): RedirectResponse
    {

        $item = json_decode($request->input('item'));

        $cart = session('cart', []);
        $key = $item->tshirt_image_id . '-' . $item->color_code . '-' . $item->size;

        if (array_key_exists($key, $cart)) {
            unset($cart[$key]);
        }
        $request->session()->put('cart', $cart);
        $htmlMessage = "Item removido do carrinho.";
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $userType = $request->user()->user_type ?? 'O';
            if ($userType != 'C') {
                $alertType = 'warning';
                $htmlMessage = 'Apenas clientes podem confirmar encomendas';
            }else{
                $cart = session('cart', []);
                $total = count($cart);
                if ($total < 1){
                    $alertType = 'warning';
                    $htmlMessage = 'O carrinho está vazio';
                } else {
                    $customer = $request->user()->customer;
                    // DB::transaction(function () use ($costumer, $cart) {
                    //     //TODO
                    // });

                    $htmlMessage = "Carrinho confirmado com sucesso!";

                    $request->session()->forget('cart');
                    return redirect()->route('orders.minhas')
                        ->with('alert-msg', $htmlMessage)
                        ->with('alert-type', 'success');
                }
            }

        } catch (\Exception $error) {
            $htmlMessage = "Não foi possível confirmar o carrinho, porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
}
