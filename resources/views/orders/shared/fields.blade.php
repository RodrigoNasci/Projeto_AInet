@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

<select class="form-select-sm form-control @error('payment_ref') is-invalid @enderror" name="status" {{ $disabledStr }}>
    <option value="closed" {{ $order->status == 'closed' ? 'selected' : '' }}>
        Estado Fechado
    </option>

    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>
        Estado Pago
    </option>

    <option value="pending"{{ $order->status == 'pending' ? 'selected' : '' }}>
        Estado Pendente
    </option>

    <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>
        Estado Cancelado
    </option>
</select>

@error('status')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
