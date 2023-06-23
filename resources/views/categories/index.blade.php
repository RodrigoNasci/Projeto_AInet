@extends('template_admin.layout')

@section('main')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Análise</strong> Categorias</h1>

        <div class="row">
            <div class="col-xl-6 col-xxl-7 w-100">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title mb-0">Categorias mais vendidas</h5>
                            <form id="formGraph" method="GET" class="form prevent-scroll"
                                action="{{ route('categories.index') }}">
                                {{-- Input hidden para mandar a variável para o javascript --}}
                                <input type="hidden" id="bestSellingCategoriesPerMonth" value="{{ $bestSellingCategoriesPerMonth }}">
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
                            </form>
                        </div>
                    </div>
                    <div class="card-body py-3">
                        <div class="chart chart-sm">
                            <canvas id="chartjs-top-categories"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-8 col-xxl-8">
                <div class="card flex-fill d-flex">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0">Categorias</h5>
                        <div>
                            <form id="formFilters" method="GET" class="form prevent-scroll"
                                action="{{ route('categories.index') }}">

                                <input type="text" name="name" class="form-select-sm rounded mr-0"
                                    placeholder="Pesquisar por nome" value="{{ old('name', $filterByName) }}" />

                                <button type="submit" class="btn m-0 p-1">
                                    <i class="bi bi-search"></i>
                                </button>

                            </form>
                        </div>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">ID</th>
                                <th class="d-none d-xl-table-cell">Nome</th>
                                <th class="d-none d-xl-table-cell"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($categories->count() == 0)
                                <tr>
                                    <td colspan="6" class="text-center">Não existem encomendas</td>
                                </tr>
                            @endif
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $category->name }}</td>
                                    <td class="text-end">

                                        <button type="button" name="delete" class="btn btn-danger mx-1" title="Eliminar"
                                            data-bs-toggle="modal" data-bs-target="#confirmationModal"
                                            data-msgLine1="Quer realmente apagar a categoria <strong>&quot;{{ $category->name }}&quot;</strong>?"
                                            data-action="">
                                            <i data-feather="trash"></i></button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



            <div class="col-12 col-lg-4 col-xxl-4">
                <div class="card flex-fill d-flex">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Gerir categorias</h5>
                        <hr>
                        <div>
                        <h5 class="card-title mb-2">Alterar categoria</h5>
                        <form id="formGerir" method="POST" class="form prevent-scroll"
                            action="{{ route('categories.index') }}">
                            @csrf
                            @method('PUT')
                                <span>ID</span><br>
                                <input type="text" name="id" class="form-select-sm rounded mr-0" placeholder="id da categoria"/>
                                <br>
                                <span>Nome</span><br>
                                <input type="text" name="name" class="form-select-sm rounded mr-0" placeholder="Nome da categoria"/>
                                <br>
                                <button type="submit" class="btn mt-2 p-1 btn-success">
                                    Alterar
                                </button>
                        </form>


                            <hr>

                            <h5 class="card-title mb-2">Criar nova categoria</h5>

                            <form id="formGerir" method="POST" class="form prevent-scroll" action="{{ route('categories.index') }}">
                            @csrf
                            @method('PUT')
                                <span>Nome</span><br>
                                <input type="text" name="name" class="form-select-sm rounded mr-0" placeholder="Nome da categoria" />
                                <br>
                                <button type="submit" class="btn mt-2 mb-1 p-1 btn-primary">
                                    Criar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="pagination-container">
                {{ $categories->withQueryString()->links() }}
            </div>
        </div>

    </div>
@endsection
