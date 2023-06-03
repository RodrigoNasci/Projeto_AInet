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
@if((Auth::user()->user_type ?? '') == 'C')
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" id="inputNif"
        {{ $disabledStr }} value="{{ old('name', $user->name /*customer->nif*/) }}">
    <label for="inputNif" class="form-label">Nif</label>
    @error('nif')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="inputAddress"
        {{ $disabledStr }} value="{{ old('name', $user->name/*customer->address*/) }}">
    <label for="inputAddress" class="form-label">Morada</label>
    @error('address')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <select class="form-control @error('def_pay_type') is-invalid @enderror" name="def_pay_type" id="selDef_pay_type" {{ $disabledStr }}>
        <option value="VISA"{{ old('email', $user->email/*customer->default_payment_type*/)=='VISA' ? 'selected' : '' }} >Visa</option>
        <option value="MC"{{ old('email', $user->email/*customer->default_payment_type*/)=='MC' ? 'selected' : '' }} >Mc</option>
        <option value="PAYPAL"{{ old('email', $user->email/*customer->default_payment_type*/)!='PAYPAL' ? 'selected' : '' }} >Paypal</option>
    </select>
    <label for="selDef_pay_type" class="form-label">Tipo de pagamento</label>
    @error('def_pay_type')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('def_pay_ref') is-invalid @enderror" name="def_pay_ref" id="inputDef_pay_ref"
        {{ $disabledStr }} value="{{ old('name', $user->name/*customer->address*/) }}">
    <label for="inputDef_pay_ref" class="form-label">Referência de pagamento</label>
    @error('def_pay_ref')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
@endif
<div class="mb-3">
    <div class="form-check form-switch" {{ $disabledStr }}>
        @if((Auth::user()->user_type ?? '') == 'A')
            <input type="hidden" name="admin" value="1">
            <input type="checkbox" class="form-check-input @error('admin') is-invalid @enderror" name="admin"
                id="inputOpcional" {{ $disabledStr }} {{ old('user_type', $user->user_type=='A') ? 'checked' : '' }} value="1">
        <label for="inputOpcional" class="form-check-label">Administrador</label>
        @else
            <input type="hidden" name="admin" value="0">
            <input type="checkbox" class="form-check-input @error('admin') is-invalid @enderror" name="admin"
                id="inputOpcional" disabled {{ old('user_type', $user->user_type=='A') ? 'checked' : '' }} value="0">
        <label for="inputOpcional" class="form-check-label">Administrador</label>
        @endif
        @error('admin')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
