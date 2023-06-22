<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColorRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Color;
use Illuminate\Http\RedirectResponse;

class ColorController extends Controller
{
    public function index(Request $request): View
    {
        $colorsQuery = Color::query();

        $colors = $colorsQuery->paginate(15);

        return view('colors.index', [
            'colors' => $colors,
        ]);
    }

    public function show(Color $color): View
    {
        return view('colors.show', compact('color'));
    }


    public function edit(Color $color)
    {
        return view('colors.edit', compact('color'));
    }

    public function update(Request $request, Color $color): RedirectResponse
    {
        if ($color->update($request->all())) {
            $url = route('colors.show', ['color' => $color]);
            $htmlMessage = "Cor <a href='$url'>#{$color->code}</a>
                            <strong>\"{$color->name}\"</strong> foi atualizada com sucesso!";
            return redirect()->route('colors.index')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
        }
        $url = route('colors.show', ['color' => $color]);
        $htmlMessage = "Não foi possível atualizar a Cor <a href='$url'>#{$color->code}</a>
                    <strong>\"{$color->name}\"</strong> porque ocorreu um erro!";
        $alertType = 'danger';
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
}
