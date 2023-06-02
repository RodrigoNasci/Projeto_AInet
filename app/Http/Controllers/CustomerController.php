<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\StoreUpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CustomerResource::collection(Customer::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateCustomerRequest $request)
    {
        $newCustomer = Customer::create($request->validated());
        return new CustomerResource($newCustomer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());
        return new CustomerResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return true;
    }
}
