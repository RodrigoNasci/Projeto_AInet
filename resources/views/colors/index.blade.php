@extends('template_admin.layout')

@section('main')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Análise</strong> Cores T-Shirts</h1>
        <div class="row">
            <div class="col-xl-6 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">??????</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="tag"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ '?????' }}</h1>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">??????</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="tag"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ '?????' }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">?????</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="tag"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ '?????' }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-xxl-7">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title mb-0">Cores mais vendidas</h5>
                            {{-- <form id="formGraph" method="GET" class="form prevent-scroll"
                                action="{{ route('tshirt_images.index') }}">
                                <input type="hidden" id="jsonMostSoldTshirtImagesPerMonth"
                                    value="{{ $jsonMostSoldTshirtImagesPerMonth }}">
                                <select class="form-select-sm " name="year" id="year"
                                    onChange="document.getElementById('formGraph').submit()">
                                    <option value="" {{ old('year', $filterByYear) === '' ? 'selected' : '' }}>All
                                    </option>
                                    @for ($year = date('Y'); $year >= 2020; $year--)
                                        <option value="{{ $year }}"
                                            {{ old('year', $filterByYear) == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </form> --}}
                        </div>
                    </div>
                    <div class="card-body py-3">
                        <div class="chart chart-sm">
                            <canvas id="chartjs-top-tshirts"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-8 col-xxl-9 w-100">
                <div class="card flex-fill d-flex">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0">Cores T-Shirt</h5>
                        <div>
                            {{-- <form id="formFilters" method="GET" class="form prevent-scroll"
                                action="{{ route('tshirt_images.index') }}">
                                <select class="form-select-sm" name="category"
                                    onChange="document.getElementById('formFilters').submit()">
                                    <option value=""
                                        {{ old('category', $filterByCategory) === '' ? 'selected' : '' }}>
                                        Todas
                                        as Categorias</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->name }}"
                                            {{ old('category', $filterByCategory) == $category->name ? 'selected' : '' }}>
                                            {{ $category->name }}
                                    @endforeach
                                </select>
                                <input type="text" name="name" class="form-select-sm rounded mr-0"
                                    placeholder="Pesquisar por nome" value="{{ old('name', $filterByName) }}" />
                                <input type="text" name="description" class="form-select-sm rounded mr-0"
                                    placeholder="Pesquisar por descrição"
                                    value="{{ old('description', $filterByDescription) }}" />
                                <button type="submit" class="btn m-0 p-1">
                                    <i class="bi bi-search"></i>
                                </button>
                            </form> --}}
                        </div>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">Code</th>
                                <th class="d-none d-xl-table-cell">Nome</th>
                                <th class="d-none d-xl-table-cell">Cor T-shirt</th>
                                <th class="d-none d-xl-table-cell"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($colors->count() == 0)
                                <tr>
                                    <td colspan="6" class="text-center">Não existem cores de T-Shirt</td>
                                </tr>
                            @endif
                            @foreach ($colors as $color)
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $color->code }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $color->name }}</td>
                                    <td><img src="{{ $color->fullImageUrl }}" alt="Image" class="avatar img-fluid"></td>
                                    <td class="text-end">
                                        <a class="btn btn-secondary mx-1" title="Ver detalhes"
                                            href="{{ route('colors.show', ['color' => $color]) }}"><i
                                                data-feather="eye"></i></a>
                                        <a class="btn btn-dark mx-1" title="Editar"
                                            href="{{ route('colors.edit', ['color' => $color]) }}"><i
                                                data-feather="edit"></i></a>
                                        <button type="button" name="delete" class="btn btn-danger mx-1" title="Eliminar"
                                            data-bs-toggle="modal" data-bs-target="#confirmationModal"
                                            data-msgLine1="Quer realmente apagar a cor <strong>&quot;{{ $color->nome }}&quot;</strong>?"
                                            data-action="{{ route('colors.destroy', ['color' => $color]) }}">
                                            <i data-feather="trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="pagination-container">
                {{ $colors->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
