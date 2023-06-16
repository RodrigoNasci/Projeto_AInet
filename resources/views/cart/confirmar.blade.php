@extends('template.layout')


@section('main')

    <body class="bg-light">

        @dump($customer)

        <div class="container">
            <div class="py-5 text-center">
                <h2>Checkout</h2>
            </div>

            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-secondary badge-pill">3</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @foreach ($cart as $item)
                            <li class="list-group-item d-flex align-items-center justify-content-between lh-condensed">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <div class="image-container">
                                        <img class="card-img-top max-height-img" id="tshirt-color"
                                            src="/storage/tshirt_base/{{ $item->color->code }}.jpg"
                                            alt="Background Image" />
                                        <img class="card-img-top max-height-img overlay-image"
                                            src="{{ $item->tshirtImage->fullImageUrl }}" alt="Overlay Image" />
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 text-center text-nowrap">
                                    <h6 class="my-0">{{ $item->tshirtImage->name }}</h6>
                                    <small class="text-muted">{{ $item->color->name . ' - ' . $item->size }}</small>
                                </div>
                                <div class="col-md-1 col-lg-2 col-xl-2 text-center">
                                    <h6 class="my-0">Qtd</h6>
                                    <small class="text-muted">{{ $item->qty }}</small>
                                </div>
                                <div class="col-md-1">
                                    <h6 class="my-0">Price</h6>
                                    <span class="text-muted">{{ $item->unit_price . '€' }}</span>
                                </div>
                            </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (EUR)</span>
                            <strong>{{ $item->unit_price . '€' }}</strong>
                        </li>
                    </ul>
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Billing address</h4>
                    <form method="POST" action="{{ route('cart.store') }}">
                        <div class="row">
                            <div class="mb-3">
                                <label for="address">Address</label>
                                <input nome="endereco" type="text" class="form-control" id="address"
                                    placeholder="1234 Main St" required>
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="country">Country</label>
                                <select name="pais" class="custom-select d-block w-100" id="country" required>
                                    <option value="">Choose...</option>
                                    <option>United States</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid country.
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="state">State</label>
                                <select name="distrito" class="custom-select d-block w-100" id="state" required>
                                    <option value="">Choose...</option>
                                    <option>California</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid state.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="zip">Zip</label>
                                <input name="codpostal" type="text" class="form-control" id="zip" placeholder=""
                                    required>
                                <div class="invalid-feedback">
                                    Zip code required.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email">Notas <span class="text-muted">(Optional)</span></label>
                                <input name="notes" type="text" class="form-control" id="address" placeholder=""
                                    required>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row">
                            <h4 class="mb-3">Payment</h4>
                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <input id="credit" name="payment_type" type="radio" class="custom-control-input"
                                        value="VISA" checked required>
                                    <label class="custom-control-label" for="credit">Cartão de crédito VISA</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="debit" name="payment_type" type="radio" class="custom-control-input"
                                        value="MC" required>
                                    <label class="custom-control-label" for="debit">Cartão de crédito Master Card</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="paypal" name="payment_type" type="radio" class="custom-control-input"
                                        value="PAYPAL" required>
                                    <label class="custom-control-label" for="paypal">Paypal</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-number">Referência de pagamento</label>
                                <input name="payment_ref" type="text" class="form-control" id="NIF"
                                    placeholder="" required>
                                <div class="invalid-feedback">
                                    Payment ref is required
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cc-number">NIF</label>
                                <input name="nif" type="text" class="form-control" id="NIF" placeholder=""
                                    required>
                                <div class="invalid-feedback">
                                    NIF is required
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        @csrf
                        <input type="hidden" name="item" value="{{ json_encode($item) }}">
                        <button class="btn btn-dark btn-lg btn-block">Finalizar encomenda</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
@endsection
