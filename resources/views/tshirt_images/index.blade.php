@extends('template.layout')

@section('main')
    <header class="py-5 header_background">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-left text-white">
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
            </div>
        </div>
    </header>
    <form method="GET" action="{{ route('tshirt_images.index') }}">
        <div class="container px-4 px-lg-5 mt-5" id="filters_container">
            <ul class="me-auto mb-2 mb-lg-0 ms-lg-4 ul_filters">
                <li class="dropdown li_filter">
                    <a class="dropdown-toggle btn btn-outline-dark" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">CATEGORIA</a>
                    <ul class="dropdown-menu" name="category">
                        <li {{ old('category', $filterByCategory) === '' ? 'selected' : '' }}><a class="dropdown-item" href="#!">Todas as categorias</a></li>
                        <li> <hr class="dropdown-divider" /> </li>
                        @foreach ($categories as $category)
                            <li {{ old('departamento', $filterByCategory) == $category->name ? 'selected' : '' }}>
                                <a class="dropdown-item" href="#!">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="dropdown li_filter">
                    <a class="dropdown-toggle btn btn-outline-dark" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">NOME</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item li_drop"><input type="text" class="form-control filter_input" name="name"
                            value="{{ old('name', $filterByName) }}"></li>
                    </ul>
                </li>
                <li class="dropdown li_filter">
                    <a class="dropdown-toggle btn btn-outline-dark " href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">DESCRIÇÃO</a>
                    <ul class="dropdown-menu">
                        <input type="text" class="form-control filter_input" name="description"
                    value="{{ old('description', $filterByDescription) }}">
                    </ul>
                </li>
            </ul>

            <div class="filter_container">
                <select class="form-select" name="category" id="FilterinputCategory">
                    <option {{ old('category', $filterByCategory) === '' ? 'selected' : '' }} value=""> Todas as
                        Categorias </option>
                    @foreach ($categories as $category)
                        <option {{ old('category', $filterByCategory) == $category->name ? 'selected' : '' }}
                            value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <!--
            <div class="filter_container">
                <button type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  NOME
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Separated link</a>
                </div>
            </div>
            <div class="filter_container">
                <label for="inputName" class="form-label"><b>NOME</b></label>
                <br>
                <input type="text" class="form-control" name="name" id="FilterinputName"
                    value="{{ old('name', $filterByName) }}">
            </div>
            <div class="filter_container">
                <label for="inputDescription" class="form-label"><b>DESCRIÇÃO</b></label>
                <br>
                <input type="text" class="form-control" name="description" id="FilterinputDescription"
                    value="{{ old('description', $filterByDescription) }}">
                <button type="submit" class="btn btn-outline-dark mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
                <a href="{{ route('tshirt_images.index') }}" class="btn btn-outline-dark mb-3 px-4 flex-grow-1">Limpar</a>
            </div>-->
            <button type="submit" class="btn btn-outline-dark mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
        </div>
    </form>

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($tshirt_images as $tshirt_image)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <div class="card-height">
                                <!-- Product image-->
                                <img class="card-img-top max-height-img" src="{{ $tshirt_image->fullImageUrl }}" alt="..." />
                            </div>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $tshirt_image->name }}</h5>
                                    <!-- Product description -->
                                    <p class="description">{{$tshirt_image->description}}</p>
                                    <!-- Product price-->
                                    <b>$40.00 - $80.00</b>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                        href="{{ route('tshirt_images.show', ['tshirt_image' => $tshirt_image]) }}">View
                                        image</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            {{ $tshirt_images->withQueryString()->links() }}
        </div>
    </section>
@endsection
