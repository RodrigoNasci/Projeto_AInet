@extends('template_admin.layout')

@section('main')

    <div class="container-fluid pt-4 px-4">
        <div class="bg-white text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Tabela de Clientes</h6>
                <div class="card-header d-flex align-items-center justify-content-start">
                    <form id="formFilters" method="GET" class="form" action="{{ route('users.index') }}">

                        <input type="text" name="user" class="form-select-sm rounded mr-0"
                            placeholder="Pesquisar por staff" value="{{ old('user', $filterByUser) }}" />

                        <button type="submit" class="btn m-0 p-1">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Foto</th>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Email</th>
                            <th scope="col">Bloqueado</th>
                            <th scope="col">Detalhes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td><img src="{{ $user->fullPhotoUrl }}" class="avatar img-fluid rounded me-1" alt="" /></td>
                            <td>{{ $user->id}}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->user_type}}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->blocked == 0)
                                    <span class="badge bg-success">Não</span>
                                @else
                                    <span class="badge bg-danger">Sim</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('users.show', ['user' => $user]) }}">Detalhes</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="pagination-container">
            {{ $users->withQueryString()->links() }}
        </div>
    </div>

@endsection

