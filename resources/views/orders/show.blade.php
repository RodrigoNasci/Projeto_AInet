@extends('template_admin.layout')

@section('main')
    <div class="container-fluid p-0">

        <a href="javascript:void(0);" onclick="javascript:history.back();">
            <i class="fa fa-arrow-circle-left fa-3x" aria-hidden="true"></i>
        </a>

        <div class="row mt-3">
            <h1 class="h3 mb-3"><strong>Detalhes</strong> Encomenda Nº <b> {{ str_pad($order->id, 2, '0', STR_PAD_LEFT) }}
                </b> </h1>
        </div>

        {{-- <div class="row">
        {{-- <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0 p-0">Items da encomenda</h5>
                </div>
                <div class="card-body px-4">
                    <hr>
                    <ul class="list-group mb-3">
                       @foreach ($order->orderItems as $order_item)
                            <li class="list-group-item d-flex align-items-center justify-content-between lh-condensed border-0">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <div class="image-container">
                                        <img class="card-img-top max-height-img" id="tshirt-color"
                                            src="/storage/tshirt_base/{{ $order_item->color->code }}.jpg"
                                            alt="Background Image" />
                                        <img class="card-img-top max-height-img overlay-image"
                                            src="{{ $order_item->tshirtImage->fullImageUrl }}" alt="Overlay Image" />
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 text-center text-nowrap">
                                    <h6 class="my-0">{{ $order_item->tshirtImage->name }}</h6>
                                    <small class="text-muted">{{ $order_item->color->name . ' - ' . $order_item->size }}</small>
                                </div>
                                <div class="col-md-1 col-lg-2 col-xl-2 text-center">
                                    <h6 class="my-0">Qtd</h6>
                                    <small class="text-muted">{{ $order_item->qty }}</small>
                                </div>
                                <div class="col-md-1">
                                    <h6 class="my-0">Price</h6>
                                    <span class="text-muted">{{ $order_item->unit_price . '€' }}</span>
                                </div>
                            </li>
                           <hr>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1 w-50">
            <div class="card flex-fill">
                <div class="card-header">

                    <h5 class="card-title mb-0 p-0">Preview da Fatura</h5>
                </div>
                <div class="card-body text-center">
                    <div class="align-self-center w-100">
                                <img class="fatura-preview" id="tshirt-color" src="{{ asset('img/modelo_fatura.png') }}"
                            alt="Background Image" />
                            <a href="{{ route('orders.fatura', ['receipt_url' => $order->receipt_url]) }}" target="_blank">
                                <img class="card-img-top mb-5 mb-md-0" id="tshirt-color"
                                    src="{{ asset('img/modelo_fatura.png') }}" alt="Background Image" />
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

        <div class="row">
            <div class="col-12 col-lg-8 col-xxl-9 d-flex w-100">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informações da encomenda</h5>
                    </div>
                    <table class="table table-hover my-0 mt-0 text-dark">
                        <tbody>
                            <tr>
                                <td>Estado da encomenda:</td>
                                <td class="d-none d-xl-table-cell">
                                    @include('orders.shared.fields', ['readonlyData' => true])
                                </td>
                                <td>
                                    <a href="{{ route('orders.edit', ['order' => $order]) }}"
                                        class="btn btn-primary btn-sm">
                                        Editar
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>ID do cliente: </td>
                                <td class="d-none d-xl-table-cell">{{ $order->customer_id }}</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Nome do cliente: </td>
                                <td class="d-none d-xl-table-cell">{{ $order->customer->user->name ?? 'null' }}</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Data da encomenda: </td>
                                <td class="d-none d-xl-table-cell">{{ $order->date }}</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Notas sobre a encomenda: </td>
                                <td class="d-none d-xl-table-cell">{{ $order->notes ?? '-' }}</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>NIF:</td>
                                <td class="d-none d-xl-table-cell">{{ $order->nif }}</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Endereço de envio: </td>
                                <td class="d-none d-xl-table-cell">{{ $order->address }}</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Tipo de pagamento: </td>
                                <td class="d-none d-xl-table-cell">{{ $order->payment_type }}</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Referência de pagamento: </td>
                                <td class="d-none d-xl-table-cell">{{ $order->payment_ref }}</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Preço Total: </td>
                                <td class="d-none d-xl-table-cell">{{ $order->total_price }} €</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td><i class="fa fa-file-pdf-o pdf-icon"></i> Fatura</td>
                                <td class="d-none d-xl-table-cell">
                                    @if (isset($order->receipt_url))
                                        <a target="_blank"
                                            href="{{ route('orders.fatura', ['receipt_url' => $order->receipt_url]) }}">{{ $order->receipt_url }}</a>
                                    @else
                                        Sem fatura
                                    @endif
                                </td>
                                <td></td>
                            </tr>
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
        </div>


        <div class="row">
            <div class="col-12 col-lg-8 col-xxl-9 d-flex w-100">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Items da encomenda</h5>
                    </div>
                    <table class="table table-hover my-0 mt-0 text-dark">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nome da imagem</th>
                                <th>Código da cor</th>
                                <th>Tamanho</th>
                                <th>Quantidade</th>
                                <th>Preço Unitário</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderitems as $orderItem)
                                <tr>
                                    <td>{{ $orderItem->id }}</td>
                                    <td>{{ $orderItem->tshirtImage->name }}</td>
                                    <td>{{ $orderItem->color_code }}</td>
                                    <td>{{ $orderItem->size }}</td>
                                    <td>{{ $orderItem->qty }}</td>
                                    <td>{{ $orderItem->unit_price }} €</td>
                                    <td>{{ $orderItem->sub_total }} €</td>
                                </tr>
                            @endforeach
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
        </div>

    </div>
@endsection
