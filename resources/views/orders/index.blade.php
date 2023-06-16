@extends('template_admin.layout')

@section('main')

<div class="container-fluid p-0">

    <h1 class="h3 mb-3"><strong>Análise</strong> Encomendas</h1>

    <div class="row">
        <div class="col-xl-6 col-xxl-5 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Encomendas Fechadas</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="truck"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $closedOrders }}</h1>
                                {{-- <div class="mb-0">
                                    <span class="text-danger"> <i
                                            class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                                    <span class="text-muted">Since last week</span>
                                </div> --}}
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Encomendas Pagas</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="truck"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $paidOrders }}</h1>
                                {{-- <div class="mb-0">
                                    <span class="text-success"> <i
                                            class="mdi mdi-arrow-bottom-right"></i> 5.25% </span>
                                    <span class="text-muted">Since last week</span>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Encomendas Pendentes</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="truck"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $pendingOrders }}</h1>
                                {{-- <div class="mb-0">
                                    <span class="text-success"> <i
                                            class="mdi mdi-arrow-bottom-right"></i> 6.65% </span>
                                    <span class="text-muted">Since last week</span>
                                </div> --}}
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Encomendas Canceladas</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="truck"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $canceledOrders }}</h1>
                                {{-- <div class="mb-0">
                                    <span class="text-danger"> <i
                                            class="mdi mdi-arrow-bottom-right"></i> -2.25% </span>
                                    <span class="text-muted">Since last week</span>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-xxl-7">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">Encomendas por dia</h5>
                </div>
                <div class="card-body py-3">
                    <div class="chart chart-sm">
                        <canvas id="chartjs-dashboard-line"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">Browser Usage</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="py-3">
                            <div class="chart chart-xs">
                                <canvas id="chartjs-dashboard-pie"></canvas>
                            </div>
                        </div>

                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td>Chrome</td>
                                    <td class="text-end">4306</td>
                                </tr>
                                <tr>
                                    <td>Firefox</td>
                                    <td class="text-end">3801</td>
                                </tr>
                                <tr>
                                    <td>IE</td>
                                    <td class="text-end">1689</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">Real-Time</h5>
                </div>
                <div class="card-body px-4">
                    <div id="world_map" style="height:350px;"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
            <div class="card flex-fill">
                <div class="card-header">

                    <h5 class="card-title mb-0">Calendar</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="chart">
                            <div id="datetimepicker-dashboard"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-12 col-lg-8 col-xxl-9 d-flex">
            <div class="card flex-fill">
                <div class="card-header d-flex align-items-center pl-0">
                    <form id="myForm" method="GET" class="form" action="{{ route('orders.index') }}">
                        <select class="form-select-sm" name="status" onChange="document.getElementById('myForm').submit()">
                            <option value="" {{ old('status', $filterByStatus) === '' ? 'selected' : '' }}>Todos os Estados</option>
                            <option value="closed" {{ old('status', $filterByStatus) === 'closed' ? 'selected' : '' }}>Estado Fechado</option>
                            <option value="paid" {{ old('status', $filterByStatus) === 'paid' ? 'selected' : '' }}>Estado Pago</option>
                            <option value="pending" {{ old('status', $filterByStatus) === 'pending' ? 'selected' : '' }}>Estado Pendente</option>
                            <option value="canceled" {{ old('status', $filterByStatus) === 'canceled' ? 'selected' : '' }}>Estado Cancelado</option>
                        </select>
                        <input type="date" id="date" name="date" class="form-select-sm">
                    </form>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Estado</th>
                            <th class="d-none d-xl-table-cell">ID cliente</th>
                            <th class="d-none d-xl-table-cell">Data</th>
                            <th>Preço Total</th>
                            <th class="d-none d-md-table-cell">Tipo Pagamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>
                                    @if ($order->status == 'closed')
                                        <span class="badge bg-success">{{ $order->status }}</span>
                                    @endif
                                    @if ($order->status == 'canceled')
                                        <span class="badge bg-danger">{{ $order->status }}</span>
                                    @endif
                                    @if ($order->status == 'paid')
                                        <span class="badge bg-success">{{ $order->status }}</span>
                                    @endif
                                    @if ($order->status == 'pending')
                                        <span class="badge bg-info">{{ $order->status }}</span>
                                    @endif
                                </td>
                                <td class="d-none d-xl-table-cell">{{ $order->customer_id }}</td>
                                <td class="d-none d-xl-table-cell">{{ $order->date }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td class="d-none d-md-table-cell">{{ $order->payment_type }}</td>
                            </tr>
                        @endforeach
                        {{--
                        <tr>
                            <td>Project Apollo</td>
                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                            <td><span class="badge bg-success">Done</span></td>
                            <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                        </tr>
                         <tr>
                            <td>Project Fireball</td>
                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                            <td><span class="badge bg-danger">Cancelled</span></td>
                            <td class="d-none d-md-table-cell">William Harris</td>
                        </tr>
                        <tr>
                            <td>Project Hades</td>
                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                            <td><span class="badge bg-success">Done</span></td>
                            <td class="d-none d-md-table-cell">Sharon Lessman</td>
                        </tr>
                        <tr>
                            <td>Project Nitro</td>
                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                            <td><span class="badge bg-warning">In progress</span></td>
                            <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                        </tr>
                        <tr>
                            <td>Project Phoenix</td>
                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                            <td><span class="badge bg-success">Done</span></td>
                            <td class="d-none d-md-table-cell">William Harris</td>
                        </tr>
                        <tr>
                            <td>Project X</td>
                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                            <td><span class="badge bg-success">Done</span></td>
                            <td class="d-none d-md-table-cell">Sharon Lessman</td>
                        </tr>
                        <tr>
                            <td>Project Romeo</td>
                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                            <td><span class="badge bg-success">Done</span></td>
                            <td class="d-none d-md-table-cell">Christina Mason</td>
                        </tr>
                        <tr>
                            <td>Project Wombat</td>
                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                            <td><span class="badge bg-warning">In progress</span></td>
                            <td class="d-none d-md-table-cell">William Harris</td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>
        {{-- <div class="col-12 col-lg-4 col-xxl-3 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">Monthly Sales</h5>
                </div>
                <div class="card-body d-flex w-100">
                    <div class="align-self-center chart chart-lg">
                        <canvas id="chartjs-dashboard-bar"></canvas>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
            <div class="card flex-fill">
                <div class="card-header">

                    {{-- <h5 class="card-title mb-0">Calendar</h5> --}}
                </div>
                <div class="card-body d-flex">
                    {{-- <div class="align-self-center w-100">
                        <div class="chart">
                            <div id="datetimepicker-dashboard"></div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="pagination-container">
            {{ $orders->withQueryString()->links() }}
        </div>
    </div>


</div>

@endsection
