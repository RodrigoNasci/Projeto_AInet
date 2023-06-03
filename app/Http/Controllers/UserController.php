<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreCreateUserRequest;
use App\Http\Requests\StoreUpdateUserRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::all()->where('deleted_at','IS', null));
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
        $formData = $request->validated();
        $user = DB::transaction(function () use ($formData) {
            $newUser = new User();
            $newUser->user_type = 'C';
            $newUser->name = $formData['name'];
            $newUser->email = $formData['email'];
            $newUser->password = Hash::make($formData['password']);
            $newUser->save();
            $newCustomer = new Customer();
            $newCustomer->id = $newUser->id;
            $newCustomer->save();

            return $newUser;
        });
        $url = route('users.show', ['user' => $user]);
        $htmlMessage = "User <a href='$url'>#{$user->id}</a> <strong>\"{$user->name}\"</strong> foi criado com sucesso!";
        return redirect()->route('tshirt_images.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        $htmlMessage = "User #{$user->id} <strong>\"{$user->name}\"</strong> foi apagado com sucesso!";
        return redirect()->route('tshirt_images.index')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
    }
}
