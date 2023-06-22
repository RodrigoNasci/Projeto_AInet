<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index(): View
    {
        $price = Price::find(1);
        return view('prices.index', compact('price'));
    }

    public function edit(Price $price): View
    {
        return view('prices.edit', compact('price'));
    }
}
