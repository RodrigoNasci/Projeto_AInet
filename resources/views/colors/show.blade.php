@extends('template_admin.layout')

@section('main')
    <div class="container-fluid p-0">

        <a href="javascript:void(0);" onclick="javascript:history.back();">
            <i class="fa fa-arrow-circle-left fa-3x" aria-hidden="true"></i>
        </a>


        <div class="row mt-3">
            <h1 class="h3 mb-3"><strong>Detalhes</strong> Cor T-Shirt Código: <b>
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
                    @include('colors.shared.fields', ['readonlyData' => true])
                    <div class="card-body text-left">
                        <div class="mb-3">
                            <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#confirmationModal"
                                data-msgLine1="Quer realmente apagar a cor <strong>&quot;{{ $color->name }}&quot;</strong>?"
                                data-action="{{ route('colors.destroy', ['color' => $color]) }}">
                                Eliminar
                            </button>
                            <a href="{{ route('colors.edit', ['color' => $color]) }}" class="btn btn-primary">Editar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('shared.confirmationDialog', [
        'title' => 'Apagar Cor de T-Shirt',
        'msgLine1' => 'As alterações efetuadas ao dados da cor vão ser perdidas!',
        'msgLine2' => 'Clique no botão "Apagar" para confirmar a operação.',
        'confirmationButton' => 'Apagar Cor de T-Shirt',
        'formMethod' => 'DELETE',
    ])
@endsection
