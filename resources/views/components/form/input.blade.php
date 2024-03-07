@props(['name', 'label', 'value' => ''])
<div class="mb-3">
    <label class="form-label">{{ $label }}</label>
    <input class="form-control" name="{{ $name }}" value="{{ $value }}" type="text">
</div>