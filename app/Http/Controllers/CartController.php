<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TshirtImage;
use App\Models\Color;
use App\Models\Price;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function show(Request $request): View
    {
        $cart = session('cart', []);
        $total = $this->getCartTotal($cart);
        return view('cart.show', compact('cart', 'total'));
    }

    public function confirmar(Request $request)
    {
        $cart = session('cart', []);
        // dd($cart);
        // Contar com a variável total
        if (count($cart) < 1) {
            $htmlMessage = "Não existem itens no carrinho de compras.";
            $alertType = 'warning';
            return back()
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', $alertType);
        }
        $customer = $request->user()->customer;
        return view('cart.confirmar', compact('cart', 'customer'));
    }

    public function addToCart(TshirtImage $tshirt_image, Request $request): RedirectResponse
    {
        // Fazer proteções no caso do User alterar o código HTML e mudar o valor do input
        // Só o clientes e anónimos podem adicionar ao carrinho
        // Fazer as verificações depois com policies ou outra cena qualquer
        $orderItem = new OrderItem();
        $orderItem->tshirt_image_id = $tshirt_image->id;
        $orderItem->color_code = $request->code;
        $orderItem->size = $request->size;
        $orderItem->qty = $request->qty;

        $price = Price::find(1);
        if ($tshirt_image->customer) {
            $orderItem->unit_price = $price->unit_price_own;
        } else {
            $orderItem->unit_price = $price->unit_price_catalog;
        }
        $orderItem->sub_total = $price->getPrice($tshirt_image->customer, $orderItem->qty);

        $cart = session('cart', []);
        $key = $tshirt_image->id . '-' . $request->code . '-' . $request->size;
        if (array_key_exists($key, $cart)) {
            $cart[$key]->qty += $request->qty;
            $cart[$key]->sub_total = 10 * $cart[$key]->qty;
            $request->session()->put('cart', $cart);
            $url = route('cart.show', ['cart' => $cart]);
            $htmlMessage = "Adicionado mais uma unidade do Item ao <a href='$url'>carrinho</a>";
        } else {
            $cart[$key] = $orderItem;
            $route = route('cart.show');
            $request->session()->put('cart', $cart);
            $htmlMessage = "Item <strong>" . $tshirt_image->name . "</strong> adicionado ao <a href='$route'>carrinho</a>.";
        }
        $alertType = 'success';
        return back()->withInput()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

    public function removeFromCart(Request $request): RedirectResponse
    {
        $cart = session('cart', []);
        $orderItem = new OrderItem();
        $orderItem->fill(json_decode($request->input('item'), true));
        $key = $orderItem->tshirt_image_id . '-' . $orderItem->color_code . '-' . $orderItem->size;
        if (array_key_exists($key, $cart)) {
            unset($cart[$key]);
        }

        $request->session()->put('cart', $cart);
        $htmlMessage = "Item <strong>" . $orderItem->tshirtImage->name . "</strong> removido do carrinho.";
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    public function editCartItem(Request $request): View
    {
        $orderItem = new OrderItem();
        $orderItem->fill(json_decode($request->input('item'), true));

        $tshirt_image = $orderItem->tshirtImage;

        $colors = Color::all();
        return view('cart.edit', compact('tshirt_image', 'orderItem', 'colors'));
    }


    public function updateCartItem(TshirtImage $tshirt_image, Request $request): RedirectResponse
    {
        $orderItemAntigo = new OrderItem();
        $orderItemAntigo->fill(json_decode($request->input('item'), true));
        $keyAntiga = $orderItemAntigo->tshirtImage->id . '-' . $orderItemAntigo->color_code . '-' . $orderItemAntigo->size;

        $orderItemNovo = new OrderItem();
        $orderItemNovo->tshirt_image_id = $tshirt_image->id;
        $orderItemNovo->color_code = $request->code;
        $orderItemNovo->size = $request->size;
        $orderItemNovo->qty = $request->qty;

        $price = Price::find(1);
        if ($tshirt_image->customer) {
            $orderItemNovo->unit_price = $price->unit_price_own;
        } else {
            $orderItemNovo->unit_price = $price->unit_price_catalog;
        }
        $orderItemNovo->sub_total = $price->getPrice($tshirt_image->customer, $orderItemNovo->qty);

        $keyNova = $tshirt_image->id . '-' . $request->code . '-' . $request->size;

        $cart = session('cart', []);
        if (array_key_exists($keyAntiga, $cart)) {
            unset($cart[$keyAntiga]);
        }
        $cart[$keyNova] = $orderItemNovo;
        $request->session()->put('cart', $cart);

        $htmlMessage = "Item <strong>" . $orderItemAntigo->tshirtImage->name . "</strong> atualizado.";
        return redirect()->route('cart.show')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }


    public function updateItemQty(Request $request)
    {
        $cart = session('cart', []);
        $orderItem = new OrderItem();

        if (isset($request->minusQty)) {
            $orderItem->fill(json_decode($request->input('minusQty'), true));
            $qty = -1;
        } elseif (isset($request->plusQty)) {
            $orderItem->fill(json_decode($request->input('plusQty'), true));
            $qty = 1;
        }

        $key = $orderItem->tshirt_image_id . '-' . $orderItem->color_code . '-' . $orderItem->size;

        if (array_key_exists($key, $cart)) {
            // Se quantidade == 0 remove do carrinho
            if ($cart[$key]->qty + $qty <= 0) {
                unset($cart[$key]);
                $htmlMessage = "Item <strong>" . $orderItem->tshirtImage->name . "</strong> removido do carrinho.";
            } else {
                // Atualiza quantidade
                $cart[$key]->qty += $qty;
                $price = Price::find(1);
                $cart[$key]->sub_total = $price->getPrice($orderItem->tshirtImage->customer, $cart[$key]->qty);
                $htmlMessage = "Quantidade do item <strong>" . $orderItem->tshirtImage->name . "</strong> foi alterada.";
            }
            $request->session()->put('cart', $cart);
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    private function getCartTotal($cart): float
    {
        $total = 0;
        foreach ($cart as $key => $item) {
            if ($key !== 'total') {
                $total += $item->sub_total;
            }
        }
        return $total;
    }

    public function store(Request $request)
    {
        try {
            $userType = $request->user()->user_type ?? 'O';
            if ($userType != 'C') {
                $alertType = 'warning';
                $htmlMessage = 'Apenas clientes podem confirmar encomendas';
            } else {
                $cart = session('cart', []);
                $total = count($cart);
                if ($total < 1) {
                    $alertType = 'warning';
                    $htmlMessage = 'O carrinho está vazio';
                } else {
                    $customer = $request->user()->customer;

                    DB::transaction(function () use ($customer, $cart) {
                        $order = new Order();
                        $order->customer_id = $customer->id;
                        $order->date = date('Y-m-d');
                        $order->status = 'pending';
                        $order->notes = $request->notes;
                        $order->nif = $request->nif;
                        $order->address = $request->endereco . ", " . $request->distrito . ", " . $request->codpostal;
                        $order->payment_type = $request->payment_type;
                        $order->payment_ref = $request->payment_ref;
                        $order->total_price = 125;
                        $order->save();

                        foreach ($cart as $item) {
                            $orderItem = new OrderItem();
                            $orderItem->fill(json_decode($request->input('item'), true));
                            $orderItem->order_id = $order->id;
                            $orderItem->save();
                        }
                    });

                    $htmlMessage = "Carrinho confirmado com sucesso.";

                    $request->session()->forget('cart');

                    // return redirect()->route('orders.minhas')
                    //     ->with('alert-msg', $htmlMessage)
                    //     ->with('alert-type', 'success');
                }
            }
        } catch (\Exception $error) {
            $htmlMessage = $error->getMessage();
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
}
