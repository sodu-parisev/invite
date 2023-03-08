@props(['field_label', 'name', 'options'])

<?php
$classes = ['form-select'];
if ($errors->has($name)) {
    $classes[] = 'is-invalid';
}
?>

<div class="mb-3">
    <label
            for="{{ $name }}"
            class="form-label"
    >{{ $field_label }}</label>

    <select {!! $attributes->merge(['class' => implode(' ', $classes)]) !!} name="{{ $name }}" id="{{ $name }}">
        <option>{{ __('Choose an option') }}</option>
        @foreach($options as $key => $option)
            <option {!! old($name) == $key ? 'selected' : '' !!} value="{{ $key }}">{{ $option }}</option>
        @endforeach
    </select>
</div>