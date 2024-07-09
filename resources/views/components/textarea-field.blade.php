<!-- resources/views/components/textarea-field.blade.php -->
@props(['name', 'label', 'id'])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}:</label>
    <textarea class="form-control" id="{{ $id }}" name="{{ $name }}" rows="3">{{ $slot }}</textarea>
</div>
