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
                        <img class="card-img-top max-height-img" id="tshirt-color" src="/storage/tshirt_base/{{$item->color->code}}.jpg" alt="Background Image" />
                        <img class="card-img-top max-height-img overlay-image" src="{{ $item->tshirtImage->fullImageUrl }}" alt="Overlay Image" />
                    </div>
                </div>
                <div  class="col-md-2 col-lg-2 col-xl-2 text-center text-nowrap">
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
                {{-- <li class="list-group-item d-flex align-items-center justify-content-between lh-condensed">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                        <div class="image-container">
                            <img class="card-img-top max-height-img" id="tshirt-color" src="/storage/tshirt_base/{{$item->color->code}}.jpg" alt="Background Image" />
                            <img class="card-img-top max-height-img overlay-image" src="{{ $item->tshirtImage->fullImageUrl }}" alt="Overlay Image" />
                        </div>
                    </div>
                    <div class="col-md-2 col-lg-2 col-xl-2 text-nowrap">
                        <h6 class="my-0">{{ $item->tshirtImage->name }}</h6>
                        <small class="text-muted">{{ $item->color->name . ' - ' . $item->size }}</small>
                    </div> --}}
                    {{-- <div class="col-md-6 col-lg-2 col-xl-2">
                        <h6 class="my-0">Quantidade</h6>
                        <small class="text-muted">{{ $item->qty }}</small>
                    </div>
                    <div class="col-md-1">
                        <h6 class="my-0">Size</h6>
                        <small class="text-muted">{{ $item->size }}</small>
                    </div> --}}
                    {{-- <div class="col-md-1">
                        <h6 class="my-0">Price</h6>
                        <small class="text-muted">{{ $item->unit_price . '€' }}</small>
                    </div>
                </li> --}}
            @endforeach
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (EUR)</span>
              <strong>{{ $item->unit_price . '€'}}</strong>
            </li>
          </ul>
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Billing address</h4>
          <form class="needs-validation" novalidate>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input type="email" class="form-control" id="username" placeholder="you@example.com" required>
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="custom-select d-block w-100" id="country" required>
                  <option value="">Choose...</option>
                  <option>United States</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <select class="custom-select d-block w-100" id="state" required>
                  <option value="">Choose...</option>
                  <option>California</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" placeholder="" required>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>

              <div class="mb-3">
                <label for="email">Observações <span class="text-muted">(Optional)</span></label>
                <input type="text" class="form-control" id="address" placeholder="" required>
              </div>

            </div>
            <hr class="mb-4">
            <h4 class="mb-3">Payment</h4>
            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                <label class="custom-control-label" for="credit">Cartão de crédito VISA</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="debit">Cartão de crédito Master Card</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="paypal">Paypal</label>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label for="cc-number">NIF</label>
              <input type="text" class="form-control" id="NIF" placeholder="" required>
              <div class="invalid-feedback">
                NIF is required
              </div>
            </div>

            {{-- <div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-name">Name on card</label>
                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                <small class="text-muted">Full name as displayed on card</small>
                <div class="invalid-feedback">
                  Name on card is required
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="cc-number">Credit card number</label>
                <input type="text" class="form-control" id="cc-number" placeholder="" required>
                <div class="invalid-feedback">
                  Credit card number is required
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">Expiration</label>
                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                <div class="invalid-feedback">
                  Expiration date required
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">CVV</label>
                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                <div class="invalid-feedback">
                  Security code required
                </div>
              </div>
            </div> --}}
            <hr class="mb-4">
            <button class="btn btn-dark btn-lg btn-block" type="submit">Finalizar encomenda</button>
          </form>
        </div>
      </div>
    </div>
  </body>

@endsection
