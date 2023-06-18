@extends('template_admin.layout')

@section('main')
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Imagem - T-Shirt</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <img class="card-img-top" src="{{ $tshirt_image->fullImageUrl }}" alt="Unsplash">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    <form id="form_tshirt_images" novalidate class="needs-validation" method="POST"
                        action="{{ route('tshirt_images.store') }}" enctype="multipart/form-data">
                        @csrf
                        @include('tshirt_images.shared.fields', ['readonlyData' => true])
                        <div class="card-body text-left">
                            <div class="mb-3">
                                <a href="{{ route('tshirt_images.edit', ['tshirt_image' => $tshirt_image]) }}"
                                    class="btn btn-primary">Editar
                                </a>
                                <form method="POST"
                                    action="{{ route('tshirt_images.destroy', ['tshirt_image' => $tshirt_image]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="delete" class="btn btn-danger">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
