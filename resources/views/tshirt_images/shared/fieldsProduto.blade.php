<div>
    <select class="form-select" name="code" id="input-color">
        @foreach ($colors as $color)
            <option value="{{ $color->code }}"
                {{ old('code', $orderItem->color_code ?? 'fafafa') == $color->code ? 'selected' : '' }}>
                {{ $color->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="d-flex">
    <select class="form-select" name="size" id="inputSize">
        <option value="XS" {{ old('size', $orderItem->size ?? 'size') === 'XS' ? 'selected' : '' }}>XS
        </option>
        <option value="S" {{ old('size', $orderItem->size ?? 'size') === 'S' ? 'selected' : '' }}>S
        </option>
        <option value="M" {{ old('size', $orderItem->size ?? 'size') === 'M' ? 'selected' : '' }}>M
        </option>
        <option value="L" {{ old('size', $orderItem->size ?? 'size') === 'L' ? 'selected' : '' }}>L
        </option>
        <option value="XL" {{ old('size', $orderItem->size ?? 'size') === 'XL' ? 'selected' : '' }}>XL
        </option>
    </select>
</div>
<br>
<div class="d-flex">
    <input class="form-control text-center me-3" name="qty" id="inputQty" type="number" min="1"
        style="max-width: 3rem" value="{{ old('qty', $orderItem->qty ?? 1) }}" />
</div>
<br>
