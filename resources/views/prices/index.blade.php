@extends('template_admin.layout')

@section('main')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Análise</strong> Preços</h1>

        <div class="row">
            <div class="col-xl-6 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Preço Unitário Imagem Catálogo</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $price->unit_price_catalog . '€' }}</h1>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Preço Unitário Imagem Própria</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $price->unit_price_own . '€' }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Desconto Imagem Catálogo</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="percent"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ number_format($price->unit_price_catalog_discount, 1) . '%' }}
                                    </h1>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Desconto Imagem Própria</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="percent"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ number_format($price->unit_price_own_discount, 1) . '%' }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Quantidade Para Ativação de Desconto</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="grid"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $price->qty_discount }}
                                    </h1>
                                </div>
                            </div>
                            <a href="{{ route('prices.edit', ['price' => $price]) }}" class="btn btn-primary">Gerir Preços
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-xl-6 col-xxl-7">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title mb-0">Encomendas fechadas por mês</h5>
                        <form id="formGraph" method="GET" class="form prevent-scroll"
                            action="{{ route('orders.index') }}">
                            <input type="hidden" id="jsonClosedOrdersPerMonth" value="{{ $jsonClosedOrdersPerMonth }}">
                            <select class="form-select-sm " name="year" id="year"
                                onChange="document.getElementById('formGraph').submit()">
                                <option value="" {{ old('year', $filterByYear) === '' ? 'selected' : '' }}>All
                                </option>
                                @for ($year = date('Y'); $year >= 2020; $year--)
                                    <option value="{{ $year }}"
                                        {{ old('year', $filterByYear) == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </form>
                    </div>
                </div>
                <div class="card-body py-3">
                    <div class="chart chart-sm">
                        <canvas id="chartjs-dashboard-line"></canvas>
                    </div>
                </div>
            </div>
        </div> --}}
        </div>
    </div>
@endsection
