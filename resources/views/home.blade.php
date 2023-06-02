@extends('template.layout')

@section('subtitulo')
    <p>Homepage da loja</p>
@endsection

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-light">Homepage</div>
                    <div class="card-body">
                        @auth
                            <p>{{ Auth::user()->name }}</p>
                        @else
                            <p>Bemvindo!</p>
                            <p>Podes fazer o login
                                <a href="{{ route('login') }}">aqui</a>.
                            </p>
                        @endauth
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
