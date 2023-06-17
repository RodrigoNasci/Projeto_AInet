@extends('template_admin.layout')

@section('main')

<section class="py-5">
    <h1 class="h3 mb-3"><strong>Detalhes</strong> Encomenda Nº <b> {{ str_pad($order->id, 2, '0', STR_PAD_LEFT) }}  </b> </h1>
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5">
            <div class="col-md-6">
                <div class="image-container">
                    <img class="card-img-top mb-5 mb-md-0" id="tshirt-color" src="{{ asset('img/modelo_fatura.png') }}"
                        alt="Background Image" />
                </div>
            </div>
            <div class="col-md-6">
                {{-- <div class="medium mb-1 d-flex align-items-center justify-content-start">
                    <div>Encomenda Nº:</div>
                    <div>{{ $order->id }} </div>
                </div> --}}

                <div class="medium mb-1 d-flex align-items-center justify-content-start mb-2">
                    <div>Estado:</div>
                    <div>{{ $order->status }}</div>
                </div>

                <div class="medium mb-1 d-flex align-items-center justify-content-start mb-2">
                    <div>ID Cliente: </div>
                    <div>{{ $order->customer_id }}</div>
                </div>

                <div class="medium mb-1 d-flex align-items-center justify-content-start mb-2">
                    <div>Nome Cliente: </div>
                    <div>{{ $order->customer->user->name ?? 'null' }}</div>
                </div>

                <div class="medium mb-1 d-flex align-items-center justify-content-start mb-2">
                    <div>Data: </div>
                    <div>{{ $order->date }}</div>
                </div>

                <div class="medium mb-1 d-flex align-items-center justify-content-start mb-2">
                    <div>Notas: </div>
                    <div>{{ $order->notes }}</div>
                </div>

                <div class="medium mb-1 d-flex align-items-center justify-content-start mb-2">
                    <div>NIF: </div>
                    <div>{{ $order->nif }}</div>
                </div>

                <div class="medium mb-1 d-flex align-items-center justify-content-start mb-2">
                    <div>Endereço: </div>
                    <div>{{ $order->address }}</div>
                </div>

                <div class="medium mb-1 d-flex align-items-center justify-content-start mb-2">
                    <div>Tipo de pagamento: </div>
                    <div>{{ $order->payment_type }}</div>
                </div>

                <div class="medium mb-1 d-flex align-items-center justify-content-start mb-2">
                    <div>Referência de pagamento: </div>
                    <div>{{ $order->payment_ref }}</div>
                </div>

                <div class="medium mb-1 d-flex align-items-center justify-content-start mb-2">
                    <div>Preço Total: </div>
                    <div>{{ $order->total_price }}</div>
                </div>

                 {{-- <p class="lead">abcd</p>
                <form method="POST" action="">
                    @csrf
                    <button class="btn btn-outline-dark flex-shrink-0" type="submit" name="addToCart">
                        <i class="bi-cart-fill me-1"></i>
                        Marcar como
                    </button>
                </form> --}}
            </div>
        </div>
    </div>
</section>

@endsection
