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
            {!! $attributes->merge(['class' => implode(' ', $classes)]) !!}
            type="file"
            id="{{ $name }}"
            name="{{ $name }}"
    >
</div>