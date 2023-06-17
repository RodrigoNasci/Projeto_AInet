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
                <a href="">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col"><input class="form-check-input" type="checkbox"></th>
                            <th scope="col">Date</th>
                            <th scope="col">Customer Id</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td>01 Jan 2045</td>
                            <td>123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>
                                <span class="badge bg-info">Paid</span>
                            </td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td>01 Jan 2045</td>
                            <td>123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td><span class="badge bg-info">Paid</span></td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td>01 Jan 2045</td>
                            <td>123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td><span class="badge bg-info">Paid</span></td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td>01 Jan 2045</td>
                            <td>123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td><span class="badge bg-info">Paid</span></td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td>01 Jan 2045</td>
                            <td>123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td><span class="badge bg-info">Paid</span></td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

