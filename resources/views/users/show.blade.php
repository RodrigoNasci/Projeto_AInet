@extends('template.layout')

@section('titulo', 'User')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item"><strong>{{ $user->name }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection

@section('main')
    <div class="container py-5" style="margin-bottom:12%">
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('users.fields', ['user' => $user, 'readonlyData' => true])
                <div class="my-1 d-flex justify-content-end">
                    <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmationModal"
                        data-msgLine1="Quer realmente apagar a conta <strong>&quot;{{ $user->name }}&quot;</strong>?"
                        data-action="{{ route('user.destroy', ['user' => $user]) }}">
                        Apagar User
                    </button>
                    <a href="{{ route('user.edit', ['user' => $user]) }}" class="btn btn-secondary ms-3">
                        Alterar User
                    </a>
                </div>
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('users.fields_foto', [
                    'user' => $user,
                    'allowUpload' => false,
                    'allowDelete' => false,
                ])
            </div>
        </div>
    </div>
    @include('shared.confirmationDialog', [
        'title' => 'Apagar User',
        'confirmationButton' => 'Apagar',
        'formMethod' => 'DELETE',
    ])

@endsection
