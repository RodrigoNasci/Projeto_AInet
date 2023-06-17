@extends('template_admin.layout')

@section('main')

    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-white rounded d-flex align-items-center justify-content-between p-4">
                    <i class="text-primary" data-feather="trending-up" style="height:53px; width:52px"></i>
                    <div class="ms-3">
                        <p class="mb-2">Vendas de Hoje</p>
                        <h6 class="mb-0">$123</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-white rounded d-flex align-items-center justify-content-between p-4">
                    <i class="text-primary" data-feather="bar-chart-2" style="height:53px; width:52px"></i>
                    <div class="ms-3">
                        <p class="mb-2">Vendas Totais</p>
                        <h6 class="mb-0">$1234</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-white rounded d-flex align-items-center justify-content-between p-4">
                    <i class="text-primary" data-feather="bar-chart" style="height:53px; width:52px"></i>
                    <div class="ms-3">
                        <p class="mb-2">Receita de Hoje</p>
                        <h6 class="mb-0">$234</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-white rounded d-flex align-items-center justify-content-between p-4">
                    <i class="text-primary" data-feather="pie-chart" style="height:53px; width:52px"></i>
                    <div class="ms-3">
                        <p class="mb-2">Receita Total</p>
                        <h6 class="mb-0">$13234</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-white text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Worldwide Sales</h6>
                        <a href="">Show All</a>
                    </div>
                    <canvas id="worldwide-sales"></canvas>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-white text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Sales & Revenue</h6>
                        <a href="">Show All</a>
                    </div>
                    <canvas id="salse-revenue"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-4 px-4">
        <div class="bg-white text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Recent Sales</h6>
                <div class="card-header d-flex align-items-center justify-content-start">
                    <form id="formFilters" method="GET" class="form" action="{{ route('dashboard.index') }}">

                        <select class="form-select-sm" name="status"
                            onChange="document.getElementById('formFilters').submit()">
                            <option value="" {{ old('status', $filterByStatus) === '' ? 'selected' : '' }}>Todos os Estados</option>
                            <option value="closed" {{ old('status', $filterByStatus) === 'closed' ? 'selected' : '' }}>Fechado</option>
                            <option value="paid" {{ old('status', $filterByStatus) === 'paid' ? 'selected' : '' }}>Pago</option>
                            <option value="pending"{{ old('status', $filterByStatus) === 'pending' ? 'selected' : '' }}>Pendente</option>
                            <option value="canceled"{{ old('status', $filterByStatus) === 'canceled' ? 'selected' : '' }}>Cancelado</option>
                        </select>

                        <input type="text" name="customer" class="form-select-sm rounded mr-0"
                            placeholder="Pesquisar por cliente" value="{{ old('customer', $filterByCustomer) }}" />

                        <button type="submit" class="btn m-0 p-1">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Data</th>
                            <th scope="col">Cliente Id</th>
                            <th scope="col">Cliente Nome</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Detalhes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->date}}</td>
                                <td>{{ $order->customer_id }}</td>
                                <td>{{ $order->customer->user->name ?? 'null' }}</td>
                                <td>{{ $order->total_price }}€</td>
                                <td>
                                    @if ($order->status == 'closed')
                                        <span class="badge bg-success">{{ $order->status }}</span>
                                    @elseif ($order->status == 'canceled')
                                        <span class="badge bg-danger">{{ $order->status }}</span>
                                    @elseif ($order->status == 'paid')
                                        <span class="badge bg-info">{{ $order->status }}</span>
                                    @elseif ($order->status == 'pending')
                                        <span class="badge bg-warning">{{ $order->status }}</span>
                                    @endif
                                </td>
                                <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

