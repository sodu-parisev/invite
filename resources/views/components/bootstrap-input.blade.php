@props(['field_label', 'name'])

<?php
$classes = ['form-control'];
if ($errors->has($name)) {
    $classes[] = 'is-invalid';
}
?>

<div class="mb-3">
    <label
            for="{{ $name }}"
            class="form-label"
    >{{ $field_label }}</label>

    <input
            type="text"
            name="{{ $name }}"
            {!! $attributes->merge(['class' => implode(' ', $classes)]) !!}
            id="{{ $name }}"
            value="{{ old($name) }}"
    >
</div>