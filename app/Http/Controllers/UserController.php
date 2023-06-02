<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreCreateUserRequest;
use App\Http\Requests\StoreUpdateUserRequest;

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
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCreateUserRequest $request)
    {
        $newUser = User::create($request->validated());
        $newUser->password = bcrypt($request->validated()['password']);
        $newUser->save();
        return new UserResource($newUser);
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
    public function destroy(User $user)
    {
        $user->delete();
        return true;
    }
}
