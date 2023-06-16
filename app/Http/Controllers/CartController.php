<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TshirtImage;
use App\Models\Color;
use Illuminate\Support\Facades\DB;

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

    public function editCartItem(Request $request):RedirectResponse
    {
        $cart = session('cart', []);


        if (!isset($request->editAll)) {

            //Editar a quantidade de um item
            if (isset($request->minusQty)) {
                $item = json_decode($request->input('minusQty'));
                $qty = -1;
            }elseif (isset($request->plusQty)) {
                $item = json_decode($request->input('plusQty'));
                $qty = 1;
            }

            $key = $item->tshirt_image_id . '-' . $item->color_code . '-' . $item->size;

            if (array_key_exists($key, $cart)) {
                $cart[$key]->qty += $qty;
                $cart[$key]->sub_total = 10 * $cart[$key]->qty;
                $request->session()->put('cart', $cart);
            }

            $htmlMessage = "A quantidade do item foi atualizada.";
            return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');

        }else{
            //Editar todos os atributos
            $item = json_decode($request->input('editAll'));

            $color = $item->color;
            $color_code = $color->code;
            $tshirt_image_name = $item->tshirtImage->name;

            // $colors = Color::all();
            // return view('tshirt_images.show', compact('tshirt_image','colors'));
            $htmlMessage = $color_code;
            return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
        }
    }

    public function store(Request $request)
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
