@props(['name', 'value' => '', 'class', 'label', 'id' => $name, 'checked' =>false])
<div class="form-check form-check-inline">
    <input {{ $attributes->merge(['class' => 'form-check-input' ]) }} {{ $checked }} type="checkbox" name="{{ $name }}"
        id="{{ $id }}" value="{{ $value }}">
    <label class="form-check-label"
        for="{{ $id }}">{{ $label }}</label>
</div>