@extends('template_admin.layout')

@section('main')
    <div class="container-fluid p-0">
        <div class="row mb-2">
            <a href="javascript:void(0);" onclick="javascript:history.back();">
                <i class="fa fa-arrow-circle-left fa-3x" aria-hidden="true"></i>
            </a>
        </div>

        <div class="row">
            <h1 class="h3 mb-3"><strong>Criar</strong> Imagem T-Shirt</h1>
        </div>
        <form id="form_tshirt_images" novalidate class="needs-validation" method="POST"
            action="{{ route('tshirt_images.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        @include('tshirt_images.shared.fields')
                        <div class="card-body text-left">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary" name="ok">Confirmar</button>
                                <a href="{{ route('tshirt_images.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
