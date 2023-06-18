@extends('template.layout')

@section('main')
    <header class="py-5 header_background text-center p-0 m-0">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-left text-white">
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this awesome t-shirt designs</p>
            </div>
        </div>
    </header>

    <section class="py-2 filter-section m-0 p-0">
        <form method="GET" class="form" action="{{ route('tshirt_images.catalogo') }}">
            <div class="container px-4 px-lg-5 mt-5 filter_container">
                <ul class="me-auto mb-2 mb-lg-0 ms-lg-4 ul_filters">
                    <li class="dropdown li_filter">
                        <a class="dropdown-toggle btn dropdown-btn" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Nome</a>
                        <ul class="dropdown-menu dropdown_ul">
                            <li class="li_drop">
                                <div class="input-group rounded">
                                    <input type="text" name="name" class="form-control rounded filter_txtinput"
                                        placeholder="Pesquisar por Nome" aria-label="Search" aria-describedby="search-addon"
                                        value="{{ old('name', $filterByName) }}" />
                                    <button type="submit" class="btn">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown li_filter input_group form-outline">
                        <a class="dropdown-toggle btn dropdown-btn" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Descrição</a>
                        <ul class="dropdown-menu dropdown_ul">
                            <div class="input-group rounded">
                                <input type="text" name="description" class="form-control rounded filter_txtinput"
                                    placeholder="Pesquisar por Descrição" aria-label="Search"
                                    aria-describedby="search-addon"
                                    value="{{ old('description', $filterByDescription) }}" />
                                <button type="submit" class="btn">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </ul>
                    </li>
                    <li class="dropdown li_filter input_group form-outline">
                        <a class="dropdown-toggle btn dropdown-btn" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Categoria</a>
                        <ul class="dropdown-menu dropdown_ul">
                            <div class="input-group rounded div_cat_option">
                                <button type="submit" class="btn category_option" value=""> Todas as
                                    Categorias</button>
                            </div>
                            @foreach ($categories as $category)
                                <div class="input-group rounded div_cat_option">
                                    <button name="category" value="{{ $category->name }}" type="submit"
                                        class="btn category_option">{{ $category->name }}</button>
                                </div>
                            @endforeach
                        </ul>
                    </li>
                </ul>


            </div>
        </form>
    </section>

    <section class="py-2 p-0 m-0">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($tshirt_images as $tshirt_image)
                    <div class="col mb-4">
                        <div class="card h-100">
                            <div class="card-height">
                                <!-- Product image-->
                                <div class="image-container">
                                    <img class="card-img-top max-height-img" id="tshirt-color"
                                        src="/storage/tshirt_base/fafafa.jpg" alt="Background Image" />
                                    <img class="card-img-top max-height-img overlay-image"
                                        src="{{ $tshirt_image->fullImageUrl }}" alt="Overlay Image" />
                                </div>
                            </div>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $tshirt_image->name }}</h5>
                                    <!-- Product description -->
                                    <p class="description">{{ $tshirt_image->description }}</p>
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
    <section class="py-2">
        <div class="container px-4 px-lg-5 mt-3">
            <div class="pagination-container">
                {{ $tshirt_images->withQueryString()->links() }}
            </div>
        </div>
    </section>
@endsection
