@extends('template_admin.layout')

@section('main')
    <div class="container-fluid p-0">
        <a href="javascript:void(0);" onclick="javascript:history.back();">
            <i class="fa fa-arrow-circle-left fa-3x" aria-hidden="true"></i>
        </a>
        <div class="row mt-3">
            <h1 class="h3 mb-3"><strong>Editar</strong> Cor T-Shirt Código: <b>
                    {{ $color->code }}
                </b> </h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card">
                    <img class="card-img-top" src="{{ $color->fullImageUrl }}" alt="Unsplash">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    <form id="form_colors" novalidate class="needs-validation" method="POST"
                        action="{{ route('colors.update', ['color' => $color]) }}">
                        @csrf
                        @method('PUT')
                        @include('colors.shared.fields')
                        <div class="card-body text-left">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary" name="ok">Guardar Alterações</button>
                                <a href="{{ route('colors.show', ['color' => $color]) }}"
                                    class="btn btn-secondary">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
