@extends('template.layout')

@section('main')
    <section class="py-2">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row">
                <div class="col-12">
                    <h1 class="h3 mb-3"><strong>Detalhes</strong> Encomenda Nº <b>
                            {{ str_pad($order->id, 2, '0', STR_PAD_LEFT) }}
                        </b></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8 col-xxl-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Informações da encomenda</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover text-dark">
                                <tbody>
                                    <tr>
                                        <td>Nome do cliente:</td>
                                        <td class="d-none d-xl-table-cell">{{ $order->customer->user->name ?? 'null' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Data da encomenda:</td>
                                        <td class="d-none d-xl-table-cell">{{ $order->date }}</td>
                                    </tr>
                                    <tr>
                                        <td>Notas sobre a encomenda:</td>
                                        <td class="d-none d-xl-table-cell">{{ $order->notes ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>NIF:</td>
                                        <td class="d-none d-xl-table-cell">{{ $order->nif }}</td>
                                    </tr>
                                    <tr>
                                        <td>Endereço de envio:</td>
                                        <td class="d-none d-xl-table-cell">{{ $order->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tipo de pagamento:</td>
                                        <td class="d-none d-xl-table-cell">{{ $order->payment_type }}</td>
                                    </tr>
                                    <tr>
                                        <td>Referência de pagamento:</td>
                                        <td class="d-none d-xl-table-cell">{{ $order->payment_ref }}</td>
                                    </tr>
                                    <tr>
                                        <td>Preço Total:</td>
                                        <td class="d-none d-xl-table-cell">
                                            {{ number_format($order->total_price, 2, ',', '.') }} €</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-file-pdf-o"></i>Fatura</td>
                                        <td class="d-none d-xl-table-cell">
                                            @if (isset($order->receipt_url))
                                                <a target="_blank"
                                                    href="{{ route('orders.fatura', ['receipt_url' => $order->receipt_url]) }}">{{ $order->receipt_url }}</a>
                                            @else
                                                Sem fatura
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8 col-xxl-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Items da encomenda</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover text-dark">
                                <thead>
                                    <tr>
                                        {{-- <th>ID</th>
                                        <th>Nome da imagem</th>
                                        <th>Código da cor</th>
                                        <th>Tamanho</th>
                                        <th>Quantidade</th>
                                        <th>Preço Unitário</th>
                                        <th>Subtotal</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($order->orderitems as $orderItem)
                                        <tr>
                                            <td>{{ $orderItem->id }}</td>
                                            <td>{{ $orderItem->tshirtImage->name }}</td>
                                            <td>{{ $orderItem->color_code }}</td>
                                            <td>{{ $orderItem->size }}</td>
                                            <td>{{ $orderItem->qty }}</td>
                                            <td>{{ number_format($orderItem->unit_price, 2, ',', '.') }} €</td>
                                            <td>{{ number_format($orderItem->sub_total, 2, ',', '.') }} €</td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
