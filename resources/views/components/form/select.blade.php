@props(['name', 'label', 'value' => '', 'placeholder' => $label, 'options' => [] ])

<div class="mb-3">
    <label for="" class="form-label">{{ $label }}</label>
    <select {{ $attributes->merge(['class' => 'form-select form-select-sm mb-3']) }}  name="{{ $name }}" aria-label="{{ $name }}">
        <option selected disabled>{{ $placeholder }}</option>
        @foreach ($options as $key => $item)
            <option value="{{ $item }}" @selected($value == $item)>
                {{ $key }}</option>
        @endforeach
        {{ $slot }}
    </select>
</div>