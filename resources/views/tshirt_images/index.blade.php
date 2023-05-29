@extends('template.layout')

<<<<<<< HEAD:resources/views/tshirtimages/index.blade.php

@section('main_filters')
    <form method="GET" action="{{ route('tshirtimages.index') }}">

            <div class="container" id="filter_container">
                <label for="inputCategory" class="form-label">Categoria</label>
                    <select class="form-select" name="category" id="FilterinputCategory">
                        <option {{ old('category', $filterByCategory) === '' ? 'selected' : '' }} value=""> Todas as Categorias </option>
                            @foreach ($categories as $category)
                                <option {{ old('departamento', $filterByCategory) == $category->name ? 'selected' : '' }}
                                    value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                    </select>
                    <br>

                    <label for="inputName" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="name" id="FilterinputName" value="{{ old('name', $filterByName) }}">
                    <br>

                    <label for="inputDescription" class="form-label">Descrição</label>
                    <input type="text" class="form-control" name="description" id="FilterinputDescription" value="{{ old('description', $filterByDescription) }}">
                    <br>

                    <button type="submit" class="btn btn-info mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
                    <a href="{{ route('tshirtimages.index') }}" class="btn btn-secondary mb-3 px-4 flex-grow-1">Limpar</a>
            </div>

    </form>
@endsection
@section('main')
    @foreach ($tshirtimages as $tshirtimage)
=======
@section('filters')
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-center">
                <form method="GET" action="{{ route('tshirt_images.index') }}">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 mb-3 me-2 form-floating">
                            <select class="form-select" name="category" id="inputCategory">
                                <option {{ old('category', $filterByCategory) === '' ? 'selected' : '' }} value="">
                                    Todas as Categorias </option>
                                @foreach ($categories as $category)
                                    <option
                                        {{ old('departamento', $filterByCategory) == $category->name ? 'selected' : '' }}
                                        value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <label for="inputCategory" class="form-label">Categoria</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="mb-3 me-2 flex-grow-1 form-floating">
                            <input type="text" class="form-control" name="name" id="inputName"
                                value="{{ old('name', $filterByName) }}">
                            <label for="inputName" class="form-label">Nome</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="mb-3 me-2 flex-grow-1 form-floating">
                            <input type="text" class="form-control" name="description" id="inputDescription"
                                value="{{ old('description', $filterByDescription) }}">
                            <label for="inputDescription" class="form-label">Descrição</label>
                        </div>
                    </div>
                    <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                        <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
                        <a href="{{ route('tshirt_images.index') }}"
                            class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('main')
    @foreach ($tshirt_images as $tshirt_image)
>>>>>>> d7cfb071a324e83789e21375148f024e966da269:resources/views/tshirt_images/index.blade.php
        <div class="col mb-5">
            <div class="card h-100">
                <!-- Product image-->
                <img class="card-img-top" src="{{ $tshirt_image->fullImageUrl }}" alt="..." />
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder">{{ $tshirt_image->name }}</h5>
                        <!-- Product price-->
                        $40.00 - $80.00
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View
                            options</a></div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('main_pagination')
    <section class="py-5">
        <div class="container">
            {{ $tshirt_images->withQueryString()->links() }}
        </div>
    </section>
@endsection

{{-- <div class="col mb-5">
        <div class="card h-100">
            <!-- Sale badge-->
            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale
            </div>
            <!-- Product image-->
            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder">Special Item</h5>
                    <!-- Product reviews-->
                    <div class="d-flex justify-content-center small text-warning mb-2">
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                    </div>
                    <!-- Product price-->
                    <span class="text-muted text-decoration-line-through">$20.00</span>
                    $18.00
                </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to
                        cart</a></div>
            </div>
        </div>
    </div>
    <div class="col mb-5">
        <div class="card h-100">
            <!-- Sale badge-->
            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                Sale</div>
            <!-- Product image-->
            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder">Sale Item</h5>
                    <!-- Product price-->
                    <span class="text-muted text-decoration-line-through">$50.00</span>
                    $25.00
                </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to
                        cart</a></div>
            </div>
        </div>
    </div>
    <div class="col mb-5">
        <div class="card h-100">
            <!-- Product image-->
            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder">Popular Item</h5>
                    <!-- Product reviews-->
                    <div class="d-flex justify-content-center small text-warning mb-2">
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                    </div>
                    <!-- Product price-->
                    $40.00
                </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to
                        cart</a></div>
            </div>
        </div>
    </div>
    <div class="col mb-5">
        <div class="card h-100">
            <!-- Sale badge-->
            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                Sale</div>
            <!-- Product image-->
            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder">Sale Item</h5>
                    <!-- Product price-->
                    <span class="text-muted text-decoration-line-through">$50.00</span>
                    $25.00
                </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to
                        cart</a></div>
            </div>
        </div>
    </div>
    <div class="col mb-5">
        <div class="card h-100">
            <!-- Product image-->
            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder">Fancy Product</h5>
                    <!-- Product price-->
                    $120.00 - $280.00
                </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View
                        options</a></div>
            </div>
        </div>
    </div>
    <div class="col mb-5">
        <div class="card h-100">
            <!-- Sale badge-->
            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                Sale</div>
            <!-- Product image-->
            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder">Special Item</h5>
                    <!-- Product reviews-->
                    <div class="d-flex justify-content-center small text-warning mb-2">
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                    </div>
                    <!-- Product price-->
                    <span class="text-muted text-decoration-line-through">$20.00</span>
                    $18.00
                </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to
                        cart</a></div>
            </div>
        </div>
    </div>
    <div class="col mb-5">
        <div class="card h-100">
            <!-- Product image-->
            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder">Popular Item</h5>
                    <!-- Product reviews-->
                    <div class="d-flex justify-content-center small text-warning mb-2">
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                    </div>
                    <!-- Product price-->
                    $40.00
                </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to
                        cart</a></div>
            </div>
        </div>
    </div> --}}
