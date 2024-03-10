@props(['name', 'label', 'value' => '', 'id' => $name])
<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input id="{{ $id }}" {{ $attributes->merge(['class' => 'form-control']) }} name="{{ $name }}" value="{{ $value }}" type="text">
</div>