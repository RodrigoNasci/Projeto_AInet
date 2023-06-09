@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputNome"
        {{ $disabledStr }} value="{{ old('name', $user->name) }}">
    <label for="inputNome" class="form-label">Nome</label>
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="inputEmail"
        {{ $disabledStr }} value="{{ old('email', $user->email) }}">
    <label for="inputEmail" class="form-label">Email</label>
    @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <div class="form-check form-switch" {{ $disabledStr }}>
        <input type="hidden" name="blocked" value="0">
        <input type="checkbox" class="form-check-input @error('blocked') is-invalid @enderror" name="blocked"
            id="inputBlocked" {{ $disabledStr }} {{ old('blocked', $user->blocked=='1') ? 'checked' : '' }} value="0">
        <label for="inputBlocked" class="form-check-label">Bloqueado</label>
        @error('blocked')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>


<div class="mb-3">
    <div class="form-check form-switch" {{ $disabledStr }}>
        @if((Auth::user()->user_type ?? '') == 'A')
            <input type="hidden" name="user_type" value="A">
            <input type="checkbox" class="form-check-input @error('user_type') is-invalid @enderror" name="user_type"
                id="inputOpcional" disabled {{ old('user_type', $user->user_type=='A') ? 'checked' : '' }} value="A">
        <label for="inputOpcional" class="form-check-label">Administrador</label>
        @elseif ((Auth::user()->user_type ?? '') == 'E')
            <input type="hidden" name="user_type" value="E">
            <input type="checkbox" class="form-check-input @error('user_type') is-invalid @enderror" name="user_type"
                id="inputOpcional" disabled {{ old('user_type', $user->user_type=='E') ? 'checked' : '' }} value="E">
        <label for="inputOpcional" class="form-check-label">Funcionário</label>
        @else
            <input type="hidden" name="user_type" value="C">
            <input type="checkbox" class="form-check-input @error('user_type') is-invalid @enderror" name="user_type"
                id="inputOpcional" disabled {{ old('user_type', $user->user_type=='C') ? 'checked' : '' }} value="C">
    <label for="inputOpcional" class="form-check-label">Cliente</label>
        @endif
        @error('user_type')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
