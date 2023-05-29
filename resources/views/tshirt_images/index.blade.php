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
        <div class="container px-4 px-lg-5 mt-5" id="filter_container">
            <label for="inputCategory" class="form-label">Categoria</label>
            <select class="form-select" name="category" id="FilterinputCategory">
                <option {{ old('category', $filterByCategory) === '' ? 'selected' : '' }} value=""> Todas as
                    Categorias </option>
                @foreach ($categories as $category)
                    <option {{ old('departamento', $filterByCategory) == $category->name ? 'selected' : '' }}
                        value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <label for="inputName" class="form-label">Nome</label>
            <input type="text" class="form-control" name="name" id="FilterinputName"
                value="{{ old('name', $filterByName) }}">
            <label for="inputDescription" class="form-label">Descrição</label>
            <input type="text" class="form-control" name="description" id="FilterinputDescription"
                value="{{ old('description', $filterByDescription) }}">
            <button type="submit" class="btn btn-info mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
            <a href="{{ route('tshirt_images.index') }}" class="btn btn-secondary mb-3 px-4 flex-grow-1">Limpar</a>
        </div>
    </form>

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($tshirt_images as $tshirt_image)
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
