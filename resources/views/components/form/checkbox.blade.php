@props(['name', 'value' => '', 'label', 'id' => $name, 'checked' =>false])
<div class="form-check form-check-inline">
    <input class="form-check-input" {{ $checked }} type="checkbox" name="permissions[]"
        id="{{ $id }}" value="{{ $value }}">
    <label class="form-check-label"
        for="{{ $id }}">{{ $label }}</label>
</div>