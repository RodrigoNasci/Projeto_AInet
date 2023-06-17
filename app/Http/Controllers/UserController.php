<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreCreateUserRequest;
use App\Http\Requests\StoreUpdateUserRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $filterByYearRevenue = $request->year ?? '';
        $filterByYearOrders = $request->year ?? '';
        $filterByStatus = $request->status ?? '';
        $filterByCustomer = $request->customer ?? '';

        $todayOrders = Order::query()->whereRaw('Date(date) = CURDATE()')->count();
        $totalOrders = Order::query()->count();
        $todayRevenue = Order::query()->whereRaw('Date(date) = CURDATE()')->get('total_price')->count();
        $totalRevenue = Order::query()->sum('total_price');


        //Query para o gráfico de encomendas por mês
        $ordersPerMonthQuery = Order::selectRaw('COUNT(*) as count, MONTH(date) as month')
            ->groupBy('month')
            ->orderBy('month');

        //Query para o gráfico de receitas por mês
        $revenuePerMonthQuery = Order::selectRaw('SUM(total_price) as count, MONTH(date) as month')
            ->groupBy('month')
            ->orderBy('month');

        //Query para a tabela de encomendas
        $orderQuery = Order::query();

        //Filtrar por status (tabela)
        if ($filterByStatus != ''){
            $orderQuery->where('status', 'LIKE' ,$filterByStatus);
        }

        //Filtrar por cliente (tabela)
        if ($filterByCustomer != ''){
            $customerIds = User::where('name', 'like', "%$filterByCustomer%")->pluck('id');
            $orderQuery->whereIntegerInRaw('customer_id', $customerIds);
        }

        //Filtrar por ano (query para o gráfico)
        if ($filterByYearOrders != '') {
            $ordersPerMonthQuery->whereYear('date', $filterByYearOrders);
        }

        //Filtrar por ano (query para o gráfico)
        if ($filterByYearRevenue != '') {
            $revenuePerMonthQuery->whereYear('date', $filterByYearRevenue);
        }

        //Paginação (tabela)
        $orders = $orderQuery->orderBy('date', 'desc')->take(10)->get();

        //Array com o número de encomendas por mês
        $ordersPerMonth = $ordersPerMonthQuery->pluck('count', 'month')->toArray();
        $ordersPerMonth = array_replace(array_fill(1, 12, 0), $ordersPerMonth);
        $ordersPerMonth = array_values($ordersPerMonth);
        $jsonOrdersPerMonth = json_encode($ordersPerMonth); //converter para json (usado no gráfico (js))

        //Array com o número de receita por mês
        $revenuePerMonth = $revenuePerMonthQuery->pluck('count', 'month')->toArray();
        $revenuePerMonth = array_replace(array_fill(1, 12, 0), $revenuePerMonth);
        $revenuePerMonth = array_values($revenuePerMonth);
        $jsonRevenuePerMonth = json_encode($revenuePerMonth); //converter para json (usado no gráfico (js))

        return view('users.index', compact('orders', 'totalOrders', 'todayOrders', 'totalRevenue', 'todayRevenue', 'filterByStatus', 'filterByCustomer', 'filterByYearOrders', 'filterByYearRevenue', 'jsonOrdersPerMonth', 'jsonRevenuePerMonth'));
    }

    public function showUsersPaginated()
    {
        return UserResource::collection(User::paginate(20)->where('deleted_at','IS', null));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        $user->load('customer');
        return view('users.show', compact('user'));
    }


    public function edit(User $user): View
    {
        $user->load('customer');
        return view('users.edit', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCreateUserRequest $request): RedirectResponse
    {
        try {
            $formData = $request->validated();
            $user = DB::transaction(function () use ($formData) {
                $newUser = new User();
                $newUser->user_type = $formData['user_type'];
                $newUser->name = $formData['name'];
                $newUser->email = $formData['email'];
                $newUser->password = Hash::make($formData['password']);
                $newUser->save();

                return $newUser;
            });

            $url = route('users.show', ['user' => $user]);
            $htmlMessage = "User <a href='$url'>#{$user->id}</a> <strong>\"{$user->name}\"</strong> foi criado com sucesso!";
            return redirect()->route('tshirt_images.index')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
        } catch (\Exception $error) {
            $url = route('users.show', ['user' => $user]);
            $htmlMessage = "Não foi possível criar o user <a href='$url'>#{$user->id}</a>
                        <strong>\"{$user->name}\"</strong> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateUserRequest $request, User $user): RedirectResponse
    {
        $formData = $request->validated();
        $user = DB::transaction(function () use ($formData, $user, $request) {
            $user->user_type = $formData['user_type'];
            $user->name = $formData['name'];
            $user->email = $formData['email'];
            $user->blocked = $formData['blocked'];
            $user->save();

            if ($request->hasFile('file_foto')) {
                if ($user->url_foto) {
                    Storage::delete('public/photos/' . $user->photo_url);
                }
                $path = $request->file_foto->store('public/photos');
                $user->photo_url = basename($path);
                $user->save();
            }
            return $user;
        });
        $url = route('users.show', ['user' => $user]);
        $htmlMessage = "User <a href='$url'>#{$user->id}</a>
                        <strong>\"{$user->name}\"</strong> foi alterado com sucesso!";
        return redirect()->route('users.show', $user)
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        if($user->customer){
            $customer = $user->customer;
            $customer->delete();
        }
        $user->delete();
        $htmlMessage = "User #{$user->id} <strong>\"{$user->name}\"</strong> foi apagado com sucesso!";
        return redirect()->route('tshirt_images.index')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
    }

    public function destroy_foto(User $user): RedirectResponse
    {
        if ($user->photo_url) {
            Storage::delete('public/photos/' . $user->photo_url);
            $user->photo_url = null;
            $user->save();
        }
        return redirect()->route('users.edit', ['user' => $user])
            ->with('alert-msg', 'Foto do cliente "' . $user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }
}
