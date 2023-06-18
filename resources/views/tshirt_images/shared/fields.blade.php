@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp
<div class="card-header">
    <h5 class="card-title mb-0">Nome</h5>
</div>
<div class="card-body">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputName"
        value="{{ old('name', $tshirt_image->name) }}" {{ $disabledStr }}>
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="card-header">
    <h5 class="card-title mb-0">Descrição</h5>
</div>
<div class="card-body">
    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="inputDescription"
        rows="2" {{ $disabledStr }}>{{ old('description', $tshirt_image->description) }}</textarea>
    @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="card-header">
    <h5 class="card-title mb-0">Categoria</h5>
</div>
<div class="card-body">
    <select class="form-select mb-3 @error('category_id') is-invalid @enderror" name="category_id" id="category"
        {{ $disabledStr }}>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id', $tshirt_image->category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
