@php
    $total = 0;
@endphp
@extends('template.layout')

@section('main')
    @dump($cart)
    <section class="h-100 h-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-8">
                                    <div class="p-5">
                                        <div class="d-flex justify-content-between align-items-center mb-5">
                                            <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                            <h6 class="mb-0 text-muted">{{ count($cart) . ' items' }}</h6>
                                        </div>
                                        <hr class="my-4">
                                        @foreach ($cart as $item)
                                            <div class="row mb-4 d-flex align-items-center justify-content-between">
                                                <div class="col-md-2 col-lg-2 col-xl-2">
                                                    <div class="image-container">
                                                        <img class="card-img-top max-height-img" id="tshirt-color" src="/storage/tshirt_base/{{$item->color->code}}.jpg" alt="Background Image" />
                                                        <img class="card-img-top max-height-img overlay-image" src="{{ $item->tshirtImage->fullImageUrl }}" alt="Overlay Image" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <h6 class="text-muted"> {{ $item->tshirtImage->name }}</h6>
                                                    <h6 class="text-black mb-0"> {{ $item->color->name }}</h6>
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex align-items-center justify-content-around">
                                                    <form method="POST" action="{{ route('cart.editCartItem') }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="editOnlyQty" value="{{ json_encode($item) }}">
                                                        <button class="btn px">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <h6 class="text-black mb-0 form-control bg-light border-secondary"> {{ $item->qty }} </h6>

                                                         <button class="btn px">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="col-md-1">
                                                    <h6 class="text-muted">Size</h6>
                                                    <h6 class="text-black mb-0"> {{ $item->size }}</h6>
                                                </div>

                                                <div class="col-md-2 text-nowrap">
                                                    <h6 class="text-muted">Preço Unitario</h6>
                                                    <h6 class="text-black mb-0">{{ $item->unit_price . '€' }}</h6>
                                                </div>

                                                <div class="col-md-2">
                                                    <h6 class="text-muted">Subtotal</h6>
                                                    <h6 class="text-black mb-0">{{ $item->sub_total . '€' }}</h6>
                                                </div>

                                                <div class="col-md-1">
                                                    <form method="POST" action="{{ route('cart.remove') }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="item" value="{{ json_encode($item) }}">
                                                        <button type="submit" class="btn text-muted"><i class="fas fa-times"></i></button>
                                                    </form>
                                                    <form method="POST" action="{{ route('cart.editCartItem') }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn text-muted"><i class="bi bi-pencil-fill"></i></button>
                                                    </form>
                                                </div>

                                                {{-- <div class="col-md-2" style="white-space: nowrap !important;">
                                                    <div>
                                                        Preço Unitario
                                                        <h6 class="mb-0">{{ $item->unit_price . '€' }}</h6>
                                                    </div>
                                                    <br>
                                                    <div>
                                                        Subtotal
                                                        <h6 class="mb-0">{{ $item->sub_total . '€' }}</h6>
                                                    </div>
                                                </div> --}}
                                                {{-- <div class="col-md-1 col-lg-1 col-xl-1 text-end" style="float:right !important;">
                                                    <form method="POST" action="{{ route('cart.remove') }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="item" value="{{ json_encode($item) }}">
                                                        <button type="submit" class="btn text-muted"><i class="fas fa-times"></i></button>
                                                    </form>
                                                 <a href="#!" class="text-muted"><i class="bi bi-pencil-fill"></i></a>
                                                </div> --}}
                                            </div>
                                            <hr class="my-4">
                                        @endforeach
                                        <div class="pt-5">
                                            <h6 class="mb-0"><a href="#!" class="text-body"><i
                                                        class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 bg-grey">
                                    <div class="p-5">
                                        <h3 class="fw-bold mb-5 mt-2 pt-1">Resumo</h3>
                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between mb-4">
                                            <h5 class="text-uppercase">{{ count($cart) . ' items' }}</h5>
                                            <h5>{{ $total . '€' }}</h5>
                                        </div>

                                        <h5 class="text-uppercase mb-3">Shipping</h5>

                                        <div class="mb-4 pb-2">
                                            <select class="select">
                                                <option value="1">Standard-Delivery- €5.00</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                                <option value="4">Four</option>
                                            </select>
                                        </div>

                                        <h5 class="text-uppercase mb-3">Give code</h5>

                                        <div class="mb-5">
                                            <div class="form-outline">
                                                <input type="text" id="form3Examplea2"
                                                    class="form-control form-control-lg" />
                                                <label class="form-label" for="form3Examplea2">Enter your code</label>
                                            </div>
                                        </div>

                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between mb-5">
                                            <h5 class="text-uppercase">Preço Total</h5>
                                            <h5>
                                                <h5>{{ $total . '€' }}</h5>
                                            </h5>
                                        </div>
                                        <a href="{{ route('cart.confirmar') }}" >
                                            <button class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Confirmar</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
